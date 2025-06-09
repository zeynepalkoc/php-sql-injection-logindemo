<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "sql_injection_demo";

// Bağlantı
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Form verileri
$username = $_POST['username'];
$password = $_POST['password'];

// SQL Injection'a açık sorgu
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $_SESSION['user'] = $username;
    header("Location: dashboard.php");
} else {
    header("Location: login_vuln.php?error=1");
}
$conn->close();
?>
