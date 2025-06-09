require_once 'logger.php';
if ($stmt->rowCount() > 0) {
    logAttempt($username, 'Başarılı');
    header("Location: dashboard.php");
    exit;
} else {
    logAttempt($username, 'Başarısız');
    $message = "❌ Giriş başarısız.";
}

<?php
require_once 'db_secure.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Güvenli sorgu: prepared statement
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->execute([
        ':username' => $username,
        ':password' => $password
    ]);

    if ($stmt->rowCount() > 0) {
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "❌ Giriş başarısız.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Güvenli Giriş</title>
</head>
<body>
    <h2>PDO ile Güvenli Giriş</h2>
    <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Kullanıcı Adı"><br><br>
        <input type="password" name="password" placeholder="Parola"><br><br>
        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>
