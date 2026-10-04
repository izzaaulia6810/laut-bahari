<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');
    $passwordConfirmation = (string) ($_POST['password_confirmation'] ?? '');

    if (!csrf_is_valid()) {
        $error = 'Sesi formulir tidak valid. Muat ulang halaman dan coba lagi.';
    } elseif ($name === '' || mb_strlen($name) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Periksa kembali nama dan alamat email.';
    } elseif (strlen($password) < 8) {
        $error = 'Kata sandi minimal 8 karakter.';
    } elseif ($password !== $passwordConfirmation) {
        $error = 'Konfirmasi kata sandi belum cocok.';
    } else {
        try {
            $statement = $pdo->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, \'user\')');
            $statement->execute([
                'name' => $name,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);
            header('Location: ' . app_url('login.php?registered=1'));
            exit;
        } catch (PDOException $exception) {
            if ($exception->getCode() === '23000') {
                $error = 'Email tersebut sudah terdaftar.';
            } else {
                throw $exception;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna — Wisata Bahari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">
    <main class="auth-layout">
        <section class="auth-story" aria-label="Wisata Bahari">
            <a class="auth-brand" href="index.php">Wisata<strong>Bahari</strong></a>
            <div class="auth-story__copy">
                <span class="auth-eyebrow">WAKTUNYA MELAUT</span>
                <h1>Petualangan berikutnya dimulai bersama.</h1>
                <p>Buat akun untuk menyimpan perjalanan dan menikmati pengalaman wisata bahari yang lebih praktis.</p>
            </div>
            <div class="auth-story__mark" aria-hidden="true">WB</div>
        </section>

        <section class="auth-panel">
            <a class="auth-back" href="index.php">&larr; Kembali ke beranda</a>
            <div class="auth-form-wrap">
                <span class="auth-eyebrow">AKUN WISATAWAN</span>
                <h2>Buat akun</h2>
                <p class="auth-intro">Daftar untuk mulai merencanakan perjalananmu.</p>
                <?php if ($error !== ''): ?>
                    <p class="auth-alert" role="alert"><?= e($error) ?></p>
                <?php endif; ?>
                <form class="auth-form" method="post" action="register.php">
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <div class="form-group">
                        <label class="form-label" for="name">Nama lengkap</label>
                        <input class="form-input" type="text" id="name" name="name" autocomplete="name" maxlength="120" value="<?= e((string) ($_POST['name'] ?? '')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-input" type="email" id="email" name="email" autocomplete="email" value="<?= e((string) ($_POST['email'] ?? '')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Kata sandi</label>
                        <input class="form-input" type="password" id="password" name="password" autocomplete="new-password" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Ulangi kata sandi</label>
                        <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" minlength="8" required>
                    </div>
                    <button class="btn btn--primary auth-submit" type="submit">Daftar</button>
                </form>
                <p class="auth-footnote">Sudah punya akun? <a href="login.php">Masuk</a></p>
            </div>
        </section>
    </main>
</body>
</html>