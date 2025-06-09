<!-- src/login_vuln.php -->
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SQL Injection Açık Giriş</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh;">
      <div class="col-4">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">🛡️ Giriş Yap</h3>
            <?php
              if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger">❌ Giriş başarısız.</div>';
              }
            ?>
            <form method="POST" action="login_vuln_process.php">
              <div class="mb-3">
                <label class="form-label">Kullanıcı Adı</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Parola</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
            </form>
          </div>
        </div>
        <p class="text-center mt-3 text-muted">Bu sayfa SQL Injection'a açıktır ⚠️</p>
      </div>
    </div>
  </div>
</body>
</html>
