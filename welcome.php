<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = 'your-secret-key-123456'; // same as in index.php
$userName = '';

if (isset($_COOKIE['token'])) {
    try {
        $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
        $userName = $decoded->data->user_name;
    } catch (Exception $e) {
        die("❌ Invalid token: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Welcome, <?= htmlspecialchars($userName) ?> 🎉</h2>
  <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>
</body>
</html>
