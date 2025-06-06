<?php
require_once 'db_vuln.php';

$message = '';

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // ⚠️ SQL Injection'a açık sorgu
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "❌ Giriş başarısız.";
        }
    }
} catch (Exception $e) {
    $message = "💥 Hata: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Zafiyetli Giriş</title>
</head>
<body>
    <h2>SQL Injection'a Açık Giriş Sayfası</h2>
    <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Kullanıcı Adı"><br><br>
        <input type="text" name="password" placeholder="Parola"><br><br>
        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>
