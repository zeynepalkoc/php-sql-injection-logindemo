<?php
$conn = new mysqli("localhost", "root", "", "sql_injection_demo");
if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}
?>
