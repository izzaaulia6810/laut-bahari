<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_role('admin');

$userCount = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$packageCount = (int) $pdo->query('SELECT COUNT(*) FROM packages')->fetchColumn();
$admin = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Wisata Bahari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="account-page">
    <header class="account-header">
        <a class="auth-brand" href="../index.php">Wisata<strong>Bahari</strong><span class="admin-tag">ADMIN</span></a>
        <form method="post" action="../logout.php">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <button class="btn btn--primary" type="submit">Keluar</button>
        </form>
    </header>
    <main class="account-main">
        <span class="auth-eyebrow">DASHBOARD PENGELOLA</span>
        <h1>Selamat datang, <?= e($admin['name']) ?>.</h1>
        <p class="auth-intro">Ringkasan akun Wisata Bahari.</p>
        <div class="admin-stat">
            <span>Total akun terdaftar</span>
            <strong><?= $userCount ?></strong>
        </div>
        <div class="admin-stat">
            <span>Paket wisata</span>
            <strong><?= $packageCount ?></strong>
        </div>
        <a class="btn btn--primary" href="packages.php">Kelola paket wisata</a>
        <a class="admin-secondary-link" href="../index.php#paket">Lihat paket di situs</a>
    </main>
</body>
</html>