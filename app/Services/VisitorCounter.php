<?php

namespace App\Services;

use Illuminate\Http\Request;

class VisitorCounter
{
    public function track(Request $request): void
    {
        if ($this->isBot($request)) {
            return;
        }

        $now = time();
        $today = date('Y-m-d');
        $ip = $this->clientIp($request);
        $deviceType = $this->detectDevice($request);

        $baseDir = storage_path('app/stats');
        $ipLogFile = $baseDir.DIRECTORY_SEPARATOR.'ip_log.json';
        $counterFile = $baseDir.DIRECTORY_SEPARATOR.'counter_daily.json';

        if (! is_dir($baseDir)) {
            mkdir($baseDir, 0775, true);
        }

        $log = $this->readJsonFile($ipLogFile);

        $log = array_filter($log, function ($entry) use ($now) {
            $timestamp = is_array($entry) ? ($entry['ts'] ?? 0) : (int) $entry;

            return ($now - (int) $timestamp) < 86400;
        });

        if (isset($log[$ip])) {
            return;
        }

        $log[$ip] = [
            'ts' => $now,
            'date' => $today,
            'device' => $deviceType,
            'ua' => $request->userAgent() ?? '',
        ];

        file_put_contents($ipLogFile, json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);

        $counts = $this->readJsonFile($counterFile);

        if (! isset($counts[$today])) {
            $counts[$today] = [
                'unique' => 0,
                'Desktop' => 0,
                'Mobile' => 0,
                'Tablet' => 0,
            ];
        }

        $counts[$today]['unique']++;

        if (isset($counts[$today][$deviceType])) {
            $counts[$today][$deviceType]++;
        }

        file_put_contents($counterFile, json_encode($counts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
    }

    private function readJsonFile(string $path): array
    {
        if (! is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);

        return is_array($decoded) ? $decoded : [];
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
