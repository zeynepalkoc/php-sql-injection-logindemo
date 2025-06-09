<?php
// Oturumu başlat
session_start();

// Oturumu temizle
session_unset();
session_destroy();

// Ana giriş sayfasına yönlendir
header("Location: login_secure.php"); // veya login_vuln.php, test ettiğin versiyona göre değiştir
exit;
