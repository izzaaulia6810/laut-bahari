<?php
require_once __DIR__ . '/includes/auth.php';
require_role('user');
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya — Wisata Bahari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="account-page">
    <header class="account-header">
        <a class="auth-brand" href="index.php">Wisata<strong>Bahari</strong></a>
        <form method="post" action="logout.php">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <button class="btn btn--primary" type="submit">Keluar</button>
        </form>
    </header>
    <main class="account-main">
        <span class="auth-eyebrow">AKUN WISATAWAN</span>
        <h1>Halo, <?= e($user['name']) ?>.</h1>
        <p class="auth-intro">Selamat datang kembali di Wisata Bahari.</p>
        <div class="account-detail">
            <span>Email akun</span>
            <strong><?= e($user['email']) ?></strong>
        </div>
        <a class="btn btn--primary" href="index.php#paket">Jelajahi paket wisata</a>
    </main>
</body>
</html>