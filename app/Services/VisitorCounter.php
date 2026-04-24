<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VisitorCounter
{
    private const DEFAULT_DAYS = 7;
    private const UNIQUE_WINDOW_SECONDS = 86400;
    private const RECENT_VISITS_LIMIT = 500;

    public function track(Request $request): void
    {
        if ($this->isBot($request)) {
            return;
        }

        $now = time();
        $today = date('Y-m-d');
        $ip = $this->clientIp($request);
        $deviceType = $this->detectDevice($request);
        $path = trim($request->path(), '/');
        $path = $path === '' ? '/' : '/'.$path;

        $baseDir = storage_path('app/stats');
        $ipLogFile = $baseDir.DIRECTORY_SEPARATOR.'ip_log.json';
        $counterFile = $baseDir.DIRECTORY_SEPARATOR.'counter_daily.json';
        $recentVisitsFile = $baseDir.DIRECTORY_SEPARATOR.'recent_visits.json';
        $geoCacheFile = $baseDir.DIRECTORY_SEPARATOR.'geo_cache.json';

        if (! is_dir($baseDir)) {
            mkdir($baseDir, 0775, true);
        }

        $log = $this->readJsonFile($ipLogFile);

        $log = array_filter($log, function ($entry) use ($now) {
            $timestamp = is_array($entry) ? ($entry['ts'] ?? 0) : (int) $entry;

            return ($now - (int) $timestamp) < self::UNIQUE_WINDOW_SECONDS;
        });

        $counts = $this->readJsonFile($counterFile);

        if (! isset($counts[$today])) {
            $counts[$today] = $this->emptyDailyCounts();
        }

        $counts[$today]['pageviews']++;
        $counts[$today]['pages'][$path] = (int) ($counts[$today]['pages'][$path] ?? 0) + 1;

        if (isset($log[$ip])) {
            file_put_contents($counterFile, json_encode($counts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
            return;
        }

        $location = $this->resolveLocation($request, $ip, $geoCacheFile);

        $log[$ip] = [
            'ts' => $now,
            'date' => $today,
            'device' => $deviceType,
            'ip' => $ip,
            'country' => $location['country'],
            'country_code' => $location['country_code'],
            'city' => $location['city'],
            'path' => $path,
            'ua' => $request->userAgent() ?? '',
        ];

        file_put_contents($ipLogFile, json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);

        $counts[$today]['unique']++;

        if (isset($counts[$today][$deviceType])) {
            $counts[$today][$deviceType]++;
        }

        $countryKey = $location['country'] !== '' ? $location['country'] : 'Ismeretlen';
        $counts[$today]['countries'][$countryKey] = (int) ($counts[$today]['countries'][$countryKey] ?? 0) + 1;

        file_put_contents($counterFile, json_encode($counts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);

        $recentVisits = $this->readJsonFile($recentVisitsFile);
        $recentVisits[] = [
            'ts' => $now,
            'date' => $today,
            'time' => date('H:i', $now),
            'ip' => $ip,
            'device' => $deviceType,
            'path' => $path,
            'country' => $location['country'],
            'country_code' => $location['country_code'],
            'city' => $location['city'],
        ];
        $recentVisits = array_slice($recentVisits, -self::RECENT_VISITS_LIMIT);

        file_put_contents($recentVisitsFile, json_encode(array_values($recentVisits), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
    }

    public function statistics(int $days = self::DEFAULT_DAYS): array
    {
        $baseDir = storage_path('app/stats');
        $ipLogFile = $baseDir.DIRECTORY_SEPARATOR.'ip_log.json';
        $counterFile = $baseDir.DIRECTORY_SEPARATOR.'counter_daily.json';
        $recentVisitsFile = $baseDir.DIRECTORY_SEPARATOR.'recent_visits.json';

        $counts = $this->readJsonFile($counterFile);
        ksort($counts);

        $recentDays = array_slice($counts, max(0, count($counts) - max(1, $days)), null, true);
        $today = date('Y-m-d');
        $todayCounts = array_merge($this->emptyDailyCounts(), $counts[$today] ?? []);

        $totals = [
            'unique' => 0,
            'pageviews' => 0,
            'Desktop' => 0,
            'Mobile' => 0,
            'Tablet' => 0,
            'countries' => [],
            'pages' => [],
        ];

        foreach ($counts as $dayCounts) {
            $totals['unique'] += (int) ($dayCounts['unique'] ?? 0);
            $totals['pageviews'] += (int) ($dayCounts['pageviews'] ?? 0);
            $totals['Desktop'] += (int) ($dayCounts['Desktop'] ?? 0);
            $totals['Mobile'] += (int) ($dayCounts['Mobile'] ?? 0);
            $totals['Tablet'] += (int) ($dayCounts['Tablet'] ?? 0);

            foreach (($dayCounts['countries'] ?? []) as $country => $count) {
                $totals['countries'][$country] = (int) ($totals['countries'][$country] ?? 0) + (int) $count;
            }

            foreach (($dayCounts['pages'] ?? []) as $page => $count) {
                $totals['pages'][$page] = (int) ($totals['pages'][$page] ?? 0) + (int) $count;
            }
        }

        $chart = [];
        foreach ($recentDays as $date => $dayCounts) {
            $chart[] = [
                'date' => $date,
                'label' => date('m.d.', strtotime($date)),
                'unique' => (int) ($dayCounts['unique'] ?? 0),
                'pageviews' => (int) ($dayCounts['pageviews'] ?? 0),
            ];
        }

        arsort($totals['countries']);
        arsort($totals['pages']);

        $todayCountries = $todayCounts['countries'] ?? [];
        arsort($todayCountries);

        $recentVisitors = $this->readJsonFile($recentVisitsFile);
        usort($recentVisitors, function ($left, $right) {
            return (int) ($right['ts'] ?? 0) <=> (int) ($left['ts'] ?? 0);
        });

        $latestVisitors = array_slice(array_map(function ($entry) {
            return [
                'date' => $entry['date'] ?? '',
                'time' => $entry['time'] ?? '--:--',
                'ip' => $entry['ip'] ?? '-',
                'device' => $entry['device'] ?? 'Desktop',
                'country' => $entry['country'] ?? 'Ismeretlen',
                'city' => $entry['city'] ?? '',
                'path' => $entry['path'] ?? '/',
            ];
        }, $recentVisitors), 0, 12);

        return [
            'today' => [
                'unique' => (int) ($todayCounts['unique'] ?? 0),
                'pageviews' => (int) ($todayCounts['pageviews'] ?? 0),
                'Desktop' => (int) ($todayCounts['Desktop'] ?? 0),
                'Mobile' => (int) ($todayCounts['Mobile'] ?? 0),
                'Tablet' => (int) ($todayCounts['Tablet'] ?? 0),
            ],
            'totals' => $totals,
            'recentDays' => $recentDays,
            'chart' => $chart,
            'todayCountries' => array_slice($todayCountries, 0, 6, true),
            'topCountries' => array_slice($totals['countries'], 0, 10, true),
            'topPages' => array_slice($totals['pages'], 0, 10, true),
            'latestVisitors' => $latestVisitors,
        ];
    }

    private function emptyDailyCounts(): array
    {
        return [
            'unique' => 0,
            'pageviews' => 0,
            'Desktop' => 0,
            'Mobile' => 0,
            'Tablet' => 0,
            'countries' => [],
            'pages' => [],
        ];
    }

    private function readJsonFile(string $path): array
    {
        if (! is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);

        return is_array($decoded) ? $decoded : [];
    }

    private function resolveLocation(Request $request, string $ip, string $geoCacheFile): array
    {
        $fallback = [
            'country' => $this->headerCountry($request),
            'country_code' => strtoupper((string) $request->headers->get('CF-IPCountry', '')),
            'city' => '',
        ];

        if (! filter_var($ip, FILTER_VALIDATE_IP) || ! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return $fallback;
        }

        $cache = $this->readJsonFile($geoCacheFile);

        if (isset($cache[$ip]) && is_array($cache[$ip])) {
            return array_merge($fallback, $cache[$ip]);
        }

        try {
            $response = Http::timeout(3)->acceptJson()->get("https://ipapi.co/{$ip}/json/");

            if ($response->successful()) {
                $data = $response->json();

                $location = [
                    'country' => (string) ($data['country_name'] ?? $fallback['country']),
                    'country_code' => strtoupper((string) ($data['country_code'] ?? $fallback['country_code'])),
                    'city' => (string) ($data['city'] ?? ''),
                ];

                $cache[$ip] = $location;
                file_put_contents($geoCacheFile, json_encode($cache, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);

                return $location;
            }
        } catch (\Throwable) {
            //
        }

        return $fallback;
    }

    private function headerCountry(Request $request): string
    {
        $countryCode = strtoupper((string) $request->headers->get('CF-IPCountry', ''));

        return match ($countryCode) {
            'HU' => 'Hungary',
            'US' => 'United States',
            'GB' => 'United Kingdom',
            'DE' => 'Germany',
            'AT' => 'Austria',
            'RO' => 'Romania',
            'SK' => 'Slovakia',
            'RS' => 'Serbia',
            'HR' => 'Croatia',
            default => '',
        };
    }

    private function clientIp(Request $request): string
    {
        foreach (['CF-Connecting-IP', 'X-Forwarded-For', 'Client-IP'] as $header) {
            $value = $request->headers->get($header);

            if (! $value) {
                continue;
            }

            $ip = trim(explode(',', $value)[0]);

            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }

        return $request->ip() ?? '0.0.0.0';
    }

    private function detectDevice(Request $request): string
    {
        $userAgent = strtolower($request->userAgent() ?? '');

        if ($userAgent === '') {
            return 'Desktop';
        }

        if (preg_match('/ipad|tablet/i', $userAgent)) {
            return 'Tablet';
        }

        if (preg_match('/mobile|iphone|android/i', $userAgent)) {
            return 'Mobile';
        }

        return 'Desktop';
    }

    private function isBot(Request $request): bool
    {
        $userAgent = strtolower($request->userAgent() ?? '');

        return (bool) preg_match('/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|monitor/i', $userAgent);
    }
}
