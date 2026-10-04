<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';

$role = ($_GET['role'] ?? 'user') === 'admin' ? 'admin' : 'user';
$error = '';
$adminCount = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();

if (($_SESSION['user']['role'] ?? null) === $role) {
    header('Location: ' . ($role === 'admin' ? 'admin/' : 'dashboard.php'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');

    if (!csrf_is_valid()) {
        $error = 'Sesi formulir tidak valid. Muat ulang halaman dan coba lagi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Email atau kata sandi tidak valid.';
    } else {
        $statement = $pdo->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = :email LIMIT 1');
        $statement->execute(['email' => $email]);
        $account = $statement->fetch();

        if ($account && $account['role'] === $role && password_verify($password, $account['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => (int) $account['id'],
                'name' => $account['name'],
                'email' => $account['email'],
                'role' => $account['role'],
            ];
            unset($_SESSION['csrf_token']);
            header('Location: ' . ($role === 'admin' ? 'admin/' : 'dashboard.php'));
            exit;
        }

        $error = 'Email atau kata sandi tidak cocok untuk halaman ini.';
    }
}

$pageTitle = $role === 'admin' ? 'Masuk Admin' : 'Masuk Pengguna';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> — Wisata Bahari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(app_url('assets/css/style.css')) ?>">
</head>
<body class="auth-page">
    <main class="auth-layout">
        <section class="auth-story" aria-label="Wisata Bahari">
            <a class="auth-brand" href="<?= e(app_url('index.php')) ?>">Wisata<strong>Bahari</strong></a>
            <div class="auth-story__copy">
                <span class="auth-eyebrow">LAUT MENUNGGU UNTUK DIJELAJAHI</span>
                <h1>Mulai cerita liburanmu dari sini.</h1>
                <p>Kelola perjalanan bahari dengan mudah, dari memilih paket hingga menyiapkan hari keberangkatan.</p>
            </div>
            <div class="auth-story__mark" aria-hidden="true">WB</div>
        </section>

        <section class="auth-panel">
            <a class="auth-back" href="<?= e(app_url('index.php')) ?>">&larr; Kembali ke beranda</a>
            <div class="auth-form-wrap">
                <span class="auth-eyebrow"><?= $role === 'admin' ? 'AREA PENGELOLA' : 'AKUN WISATAWAN' ?></span>
                <h2><?= e($pageTitle) ?></h2>
                <p class="auth-intro"><?= $role === 'admin' ? 'Gunakan akun pengelola untuk melanjutkan.' : 'Masuk untuk mengakses akun Wisata Bahari.' ?></p>

                <div class="auth-switch" aria-label="Jenis akun">
                    <a class="<?= $role === 'user' ? 'is-active' : '' ?>" href="<?= e(app_url('login.php')) ?>">Pengguna</a>
                    <a class="<?= $role === 'admin' ? 'is-active' : '' ?>" href="<?= e(app_url('admin/login.php')) ?>">Admin</a>
                </div>

                <?php if ($error !== ''): ?>
                    <p class="auth-alert" role="alert"><?= e($error) ?></p>
                <?php elseif (($_GET['registered'] ?? '') === '1'): ?>
                    <p class="auth-success" role="status">Akun berhasil dibuat. Silakan masuk.</p>
                <?php endif; ?>

                <?php $loginAction = $role === 'admin' && basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'admin' ? '../login.php?role=admin' : 'login.php' . ($role === 'admin' ? '?role=admin' : ''); ?>
                <form class="auth-form" method="post" action="<?= e($loginAction) ?>">
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-input" type="email" id="email" name="email" autocomplete="username" placeholder="nama@email.com" value="<?= e((string) ($_POST['email'] ?? '')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Kata sandi</label>
                        <input class="form-input" type="password" id="password" name="password" autocomplete="current-password" placeholder="Masukkan kata sandi" required>
                    </div>
                    <button class="btn btn--primary auth-submit" type="submit">Masuk</button>
                </form>
                <?php if ($role === 'user'): ?>
                    <p class="auth-footnote">Belum punya akun? <a href="<?= e(app_url('register.php')) ?>">Daftar sebagai pengguna</a></p>
                <?php else: ?>
                    <p class="auth-footnote"><a href="<?= e(app_url('admin/setup.php')) ?>">Setup atau reset admin lokal</a></p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>