<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/data.php';

$remoteAddress = $_SERVER['REMOTE_ADDR'] ?? '';
if (!in_array($remoteAddress, ['127.0.0.1', '::1'], true)) {
    http_response_code(404);
    exit;
}

$pdo->exec("CREATE TABLE IF NOT EXISTS packages (
    id VARCHAR(60) NOT NULL,
    nama VARCHAR(120) NOT NULL,
    tagline VARCHAR(255) NOT NULL,
    harga INT UNSIGNED NOT NULL,
    durasi VARCHAR(80) NOT NULL,
    icon VARCHAR(40) NOT NULL DEFAULT 'sun',
    color CHAR(7) NOT NULL DEFAULT '#0ea5e9',
    popular TINYINT(1) NOT NULL DEFAULT 0,
    fitur JSON NOT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY packages_order_index (sort_order)
) ENGINE=InnoDB");

if ((int) $pdo->query('SELECT COUNT(*) FROM packages')->fetchColumn() === 0) {
    $insertPackage = $pdo->prepare('INSERT INTO packages (id, nama, tagline, harga, durasi, icon, color, popular, fitur, sort_order) VALUES (:id, :nama, :tagline, :harga, :durasi, :icon, :color, :popular, :fitur, :sort_order)');
    foreach ($default_paket_wisata as $index => $package) {
        $insertPackage->execute([
            'id' => $package['id'],
            'nama' => $package['nama'],
            'tagline' => $package['tagline'],
            'harga' => $package['harga'],
            'durasi' => $package['durasi'],
            'icon' => $package['icon'],
            'color' => $package['color'],
            'popular' => !empty($package['popular']) ? 1 : 0,
            'fitur' => json_encode($package['fitur'], JSON_THROW_ON_ERROR),
            'sort_order' => $index + 1,
        ]);
    }
}

$adminCount = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string) ($_POST['action'] ?? 'create');
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');
    $passwordConfirmation = (string) ($_POST['password_confirmation'] ?? '');

    if (!csrf_is_valid()) {
        $error = 'Sesi formulir tidak valid. Muat ulang halaman dan coba lagi.';
    } elseif ($action === 'reset' && $adminCount > 0) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Masukkan email admin yang benar.';
        } elseif (strlen($password) < 8 || $password !== $passwordConfirmation) {
            $error = 'Kata sandi minimal 8 karakter dan harus cocok dengan konfirmasi.';
        } else {
            $statement = $pdo->prepare("UPDATE users SET password_hash = :password_hash WHERE email = :email AND role = 'admin'");
            $statement->execute([
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
            ]);
            $accountStatement = $pdo->prepare("SELECT id, name, email FROM users WHERE email = :email AND role = 'admin' LIMIT 1");
            $accountStatement->execute(['email' => $email]);
            $account = $accountStatement->fetch();

            if ($account) {
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id' => (int) $account['id'],
                    'name' => $account['name'],
                    'email' => $account['email'],
                    'role' => 'admin',
                ];
                unset($_SESSION['csrf_token']);
                header('Location: index.php');
                exit;
            }
            $error = 'Email tersebut tidak terdaftar sebagai admin.';
        }
    } elseif ($adminCount === 0) {
        $name = trim((string) ($_POST['name'] ?? ''));
        if ($name === '' || mb_strlen($name) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Periksa kembali nama dan email.';
        } elseif (strlen($password) < 8) {
            $error = 'Kata sandi minimal 8 karakter.';
        } elseif ($password !== $passwordConfirmation) {
            $error = 'Konfirmasi kata sandi belum cocok.';
        } else {
            try {
                $pdo->beginTransaction();
                $adminCount = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();
                if ($adminCount > 0) {
                    $pdo->rollBack();
                    $error = 'Admin sudah dibuat. Silakan masuk melalui halaman admin.';
                } else {
                    $statement = $pdo->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, 'admin')");
                    $statement->execute([
                        'name' => $name,
                        'email' => $email,
                        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    ]);
                    $accountId = (int) $pdo->lastInsertId();
                    $pdo->commit();

                    session_regenerate_id(true);
                    $_SESSION['user'] = [
                        'id' => $accountId,
                        'name' => $name,
                        'email' => $email,
                        'role' => 'admin',
                    ];
                    unset($_SESSION['csrf_token']);
                    header('Location: index.php');
                    exit;
                }
            } catch (PDOException $exception) {
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }
                $error = $exception->getCode() === '23000'
                    ? 'Email tersebut sudah digunakan. Silakan pakai email lain.'
                    : 'Admin tidak dapat dibuat. Periksa koneksi database dan coba lagi.';
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
    <title>Setup Admin — Wisata Bahari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(app_url('assets/css/style.css')) ?>">
</head>
<body class="account-page">
    <main class="auth-form-wrap setup-admin">
        <a class="auth-brand" href="<?= e(app_url('index.php')) ?>">Wisata<strong>Bahari</strong></a>
        <span class="auth-eyebrow">SETUP LOKAL</span>
        <h2>Admin pertama</h2>
        <?php if ($adminCount > 0): ?>
            <p class="auth-intro">Akun admin sudah dibuat. Setup pertama kali telah ditutup.</p>
            <p class="auth-intro">Jika tidak bisa masuk, reset password akun admin dari komputer lokal.</p>
            <?php if ($error !== ''): ?>
                <p class="auth-alert" role="alert"><?= e($error) ?></p>
            <?php endif; ?>
            <form class="auth-form" method="post" action="setup.php">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="action" value="reset">
                <div class="form-group">
                    <label class="form-label" for="email">Email admin</label>
                    <input class="form-input" type="email" id="email" name="email" autocomplete="username" value="<?= e((string) ($_POST['email'] ?? '')) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Kata sandi baru</label>
                    <input class="form-input" type="password" id="password" name="password" minlength="8" autocomplete="new-password" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Ulangi kata sandi</label>
                    <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" minlength="8" autocomplete="new-password" required>
                </div>
                <button class="btn btn--primary auth-submit" type="submit">Reset password dan masuk</button>
            </form>
        <?php else: ?>
            <p class="auth-intro">Buat akun admin. Halaman ini hanya tersedia dari komputer lokal dan akan ditutup setelah akun dibuat.</p>
            <?php if ($error !== ''): ?>
                <p class="auth-alert" role="alert"><?= e($error) ?></p>
            <?php endif; ?>
            <form class="auth-form" method="post" action="setup.php">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <div class="form-group">
                    <label class="form-label" for="name">Nama admin</label>
                    <input class="form-input" id="name" name="name" maxlength="120" autocomplete="name" value="<?= e((string) ($_POST['name'] ?? '')) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input" type="email" id="email" name="email" autocomplete="email" value="<?= e((string) ($_POST['email'] ?? '')) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Kata sandi</label>
                    <input class="form-input" type="password" id="password" name="password" minlength="8" autocomplete="new-password" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Ulangi kata sandi</label>
                    <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" minlength="8" autocomplete="new-password" required>
                </div>
                <button class="btn btn--primary auth-submit" type="submit">Buat admin dan masuk</button>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>