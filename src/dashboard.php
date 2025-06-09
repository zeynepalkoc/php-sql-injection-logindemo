<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kontrol Paneli</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: white;
            text-align: center;
            padding-top: 100px;
        }
        .dashboard {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        h1 {
            font-size: 2.5em;
        }
        .logout-btn {
            margin-top: 30px;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            background-color: #e74c3c;
            color: white;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>🎉 Giriş Başarılı!</h1>
        <p>Hoş geldiniz <strong>kullanıcı</strong>, kontrol panelinize eriştiniz.</p>
        <form action="logout.php" method="POST">
            <button class="logout-btn">Çıkış Yap</button>
        </form>
    </div>
</body>
</html>
