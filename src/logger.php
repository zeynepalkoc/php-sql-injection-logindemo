<?php
function logAttempt($username, $status) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = date("Y-m-d H:i:s");
    $log = "[$timestamp] Giriş: $username | Durum: $status | IP: $ip" . PHP_EOL;
    file_put_contents(__DIR__ . '/../logs/login_attempts.log', $log, FILE_APPEND);
}
