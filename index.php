<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$error = '';

if (isset($_POST["login"])) {
    try {
        $connect = new PDO("mysql:host=localhost;dbname=coder_login", "root", "");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (empty($_POST["email"])) {
            $error = 'Please enter your email';
        } elseif (empty($_POST["password"])) {
            $error = 'Please enter your password';
        } else {
            $query = "SELECT * FROM users WHERE user_email = ?";
            $statement = $connect->prepare($query);
            $statement->execute([$_POST["email"]]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                if (password_verify($_POST['password'], $data['user_password'])) {
                    $key = 'your-secret-key-123456'; // 🔑 replace with a strong secret key

                    $token = JWT::encode(
                        [
                            'iat'  => time(),
                            'nbf'  => time(),
                            'exp'  => time() + 3600,
                            'data' => [
                                'user_id'   => $data['user_id'],
                                'user_name' => $data['user_name']
                            ]
                        ],
                        $key,
                        'HS256'
                    );

                    setcookie("token", $token, time() + 3600, "/", "", false, true);
                    header('Location: welcome.php');
                    exit();
                } else {
                    $error = 'Wrong password';
                }
            } else {
                $error = 'Wrong email address';
            }
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Login with JWT</title>
</head>
<body>
<div class="container">
  <h1 class="text-center mt-5 mb-5">Login using JWT in PHP</h1>
  <div class="row">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-4">
      <?php if ($error !== ''): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>
      <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method="post">
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required />
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required />
            </div>
            <div class="text-center">
              <input type="submit" name="login" class="btn btn-primary" value="Login" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
