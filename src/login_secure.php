<?php
require_once 'db_vuln.php';
require_once 'logger.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // SQL Injection'a açık sorgu
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        logAttempt($username, "Zafiyetli Giriş - Başarılı");
        header("Location: dashboard.php");
        exit;
    } else {
        logAttempt($username, "Zafiyetli Giriş - Başarısız");
        $message = "❌ Giriş başarısız.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Zafiyetli Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-box {
            margin-top: 8%;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="login-box text-center">
        <h4><span class="me-2">🛡️</span> Zafiyetli Giriş</h4>

        <?php if ($message): ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="mt-4">
            <input type="text" name="username" class="form-control mb-3" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Parola" required>
            <button type="submit" class="btn btn-danger w-100">Giriş Yap</button>
        </form>

        <div class="alert alert-danger mt-3 py-2">
            Bu sayfa <strong>SQL Injection'a açıktır</strong> ⚠️
        </div>
    </div>
</body>
</html>
