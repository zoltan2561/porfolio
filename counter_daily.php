<?php
// ---- Segédfüggvények ----
function clientIp(): string {
    foreach (['HTTP_CF_CONNECTING_IP','HTTP_X_FORWARDED_FOR','HTTP_CLIENT_IP','REMOTE_ADDR'] as $k) {
        if (!empty($_SERVER[$k])) {
            $raw = trim($_SERVER[$k]);
            // XFF lehet lista
            $ip = explode(',', $raw)[0];
            $ip = trim($ip);
            if (filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
        }
    }
    return '0.0.0.0';
}

function detectDevice(): string {
    $ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
    if ($ua === '') return 'Desktop';
    if (preg_match('/ipad|tablet/i', $ua))  return 'Tablet';
    if (preg_match('/mobile|iphone|android/i', $ua)) return 'Mobile';
    return 'Desktop';
}

function isBot(): bool {
    $ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
    return (bool)preg_match('/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|monitor/i', $ua);
}

// ---- Alap változók ----
$now        = time();
$today      = date('Y-m-d');
$ip         = clientIp();
$deviceType = detectDevice();

//  Robotok kizárása a statból
if (isBot()) { return; }

// ---- Tárolási helyek ----
$baseDir      = __DIR__ . '/stats';
$ipLogFile    = $baseDir . '/ip_log.json';
$counterFile  = $baseDir . '/counter_daily.json';


if (!is_dir($baseDir)) {
    @mkdir($baseDir, 0775, true);
}

// ---- IP log betöltése ----
$log = [];
if (is_file($ipLogFile)) {
    $tmp = json_decode(@file_get_contents($ipLogFile), true);
    if (is_array($tmp)) $log = $tmp;
}

// 24 óránál frissebb bejegyzések megtartása
$log = array_filter($log, function($entry) use ($now) {
    // támogatjuk a régi formátumot (csak timestamp), és az újat (assoc tömb)
    $ts = is_array($entry) ? ($entry['ts'] ?? 0) : (int)$entry;
    return ($now - (int)$ts) < 86400;
});


$alreadySeen = isset($log[$ip]);

if (!$alreadySeen) {
    // IP napló frissítése: ts + device
    $log[$ip] = [
        'ts'     => $now,
        'date'   => $today,
        'device' => $deviceType,
        'ua'     => ($_SERVER['HTTP_USER_AGENT'] ?? '')
    ];
    @file_put_contents($ipLogFile, json_encode($log, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES), LOCK_EX);

    // ---- Napi számláló ----
    $counts = [];
    if (is_file($counterFile)) {
        $tmp = json_decode(@file_get_contents($counterFile), true);
        if (is_array($tmp)) $counts = $tmp;
    }

    // Napi rekord inicializálása
    if (!isset($counts[$today])) {
        $counts[$today] = [
            'unique'  => 0,
            'Desktop' => 0,
            'Mobile'  => 0,
            'Tablet'  => 0
        ];
    }

    $counts[$today]['unique']++;
    if (isset($counts[$today][$deviceType])) {
        $counts[$today][$deviceType]++;
    }

    @file_put_contents($counterFile, json_encode($counts, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES), LOCK_EX);
}

