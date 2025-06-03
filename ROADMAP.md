
# ROADMAP.md: SQL Injection Açığına Sahip ve Güvenli Giriş Sistemi (PHP)

## Giriş
Bu yol haritası, PHP kullanılarak geliştirilecek bir kullanıcı giriş sisteminin güvenlik analizini ve geliştirme sürecini adım adım sunar. Projenin ilk aşamasında, SQL Injection zafiyeti bilerek bırakılmıştır. İkinci aşamada, aynı sistem PDO ve Prepared Statements kullanılarak güvenli hale getirilmiştir. Amaç, SQL Injection zafiyetinin nasıl çalıştığını göstermek ve çözümünü uygulamalı olarak öğretmektir.

> ❗ Bu proje **eğitim ve farkındalık amaçlıdır**. Güvenlik açıkları sadece kontrollü ortamlarda test edilmelidir.

---

## Ön Koşullar

- **PHP 7.x veya 8.x**
- **MySQL veya MariaDB**
- **Apache veya XAMPP/WAMP/LAMP ortamı**
- Temel düzeyde PHP ve SQL bilgisi
- Web tarayıcısı

---

## Aşamalar ve Görevler

### 1. Ortam Kurulumu

- XAMPP veya WAMP gibi yerel sunucu kurulumu yapılır.
- `htdocs` dizinine proje klasörü oluşturulur (`/sql-login-demo`).
- MySQL veritabanı oluşturulur:
  ```sql
  CREATE DATABASE login_demo;
  ```

### 2. Güvensiz Sürümün Geliştirilmesi (SQL Injection Açığı İçerir)

#### 2.1 Kullanıcı Tablosunun Oluşturulması
```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(100) NOT NULL
);
```
```sql
INSERT INTO users (username, password) VALUES ('admin', 'admin123');
```

#### 2.2 Güvensiz Giriş Formu (login.php)

```php
<?php
$conn = new mysqli("localhost", "root", "", "login_demo");

if (isset($_POST['login'])) {
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "Giriş başarılı!";
  } else {
    echo "Kullanıcı adı veya şifre yanlış.";
  }
}
?>
<form method="POST">
  <input name="username" placeholder="Kullanıcı Adı">
  <input name="password" placeholder="Şifre" type="password">
  <button name="login">Giriş Yap</button>
</form>
```

#### 2.3 Test Edilecek SQL Injection Payload
```sql
admin' -- 
```

---

### 3. Güvenli Sürümün Geliştirilmesi (PDO + Prepared Statements)

#### 3.1 PDO ile Güvenli Giriş

```php
<?php
try {
  $conn = new PDO("mysql:host=localhost;dbname=login_demo", "root", "");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['login'])) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->execute([
      'username' => $_POST['username'],
      'password' => $_POST['password']
    ]);

    if ($stmt->rowCount() > 0) {
      echo "Giriş başarılı!";
    } else {
      echo "Hatalı giriş.";
    }
  }
} catch (PDOException $e) {
  echo "Bağlantı hatası: " . $e->getMessage();
}
?>
<form method="POST">
  <input name="username" placeholder="Kullanıcı Adı">
  <input name="password" placeholder="Şifre" type="password">
  <button name="login">Giriş Yap</button>
</form>
```

---

## Gelişmiş Geliştirmeler

- Parola hashleme (password_hash, password_verify kullanımı)
- CSRF koruması
- Giriş deneme limiti
- Log tutma mekanizması (başarısız girişler için)

---

## Test Adımları

1. Güvensiz sürümde `admin' --` gibi payload'larla giriş yapılmaya çalışılır.
2. PDO sürümünde aynı giriş denemeleri başarısız olur.
3. Tarayıcı geliştirici araçları ile POST istekleri analiz edilir.

---

## Sonuç

Bu yol haritası, PHP ile oluşturulmuş bir giriş sisteminde SQL Injection açığının nasıl istismar edildiğini ve nasıl önlendiğini adım adım göstermektedir. Uygulamalı örneklerle geliştirilen bu proje, temel güvenlik farkındalığı kazanmak isteyen geliştiriciler için rehber niteliğindedir.

---
