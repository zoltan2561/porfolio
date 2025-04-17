<?php
$ip = $_SERVER['REMOTE_ADDR'];
$now = time();
$date = date('Y-m-d');

$ipLogFile = 'ip_log.json';
$counterFile = 'counter_daily.txt';

// IP log biztonságos beolvasása
$logRaw = file_exists($ipLogFile) ? file_get_contents($ipLogFile) : '';
$log = json_decode($logRaw, true);
if (!is_array($log)) {
    $log = [];
}

// 24 óránál frissebb IP-k megtartása
$log = array_filter($log, fn($timestamp) => ($now - $timestamp) < 86400);

// Ha új IP, számolunk és mentünk
if (!array_key_exists($ip, $log)) {
    $log[$ip] = $now;
    file_put_contents($ipLogFile, json_encode($log, JSON_PRETTY_PRINT));

    $countRaw = file_exists($counterFile) ? file_get_contents($counterFile) : '';
    $counts = json_decode($countRaw, true);
    if (!is_array($counts)) {
        $counts = [];
    }

    if (!isset($counts[$date])) {
        $counts[$date] = 0;
    }

    $counts[$date]++;
    file_put_contents($counterFile, json_encode($counts, JSON_PRETTY_PRINT));
}
