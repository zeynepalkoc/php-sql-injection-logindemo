<?php
// SQL Injection'a açık mysqli bağlantısı
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'sql_injection_demo';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
