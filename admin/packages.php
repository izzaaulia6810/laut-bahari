<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_role('admin');

$error = '';
$success = (string) ($_SESSION['package_notice'] ?? '');
unset($_SESSION['package_notice']);
$allowedIcons = ['sun', 'star', 'diamond'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string) ($_POST['action'] ?? 'save');
    if (!csrf_is_valid()) {
        $error = 'Sesi formulir tidak valid. Muat ulang halaman dan coba lagi.';
    } elseif ($action === 'delete') {
        $id = (string) ($_POST['id'] ?? '');
        $statement = $pdo->prepare('DELETE FROM packages WHERE id = :id');
        $statement->execute(['id' => $id]);
        $_SESSION['package_notice'] = $statement->rowCount() ? 'Paket berhasil dihapus.' : 'Paket tidak ditemukan.';
        header('Location: packages.php');
        exit;
    } else {
        $originalId = trim((string) ($_POST['original_id'] ?? ''));
        $id = strtolower(trim((string) ($_POST['id'] ?? '')));
        $name = trim((string) ($_POST['nama'] ?? ''));
        $tagline = trim((string) ($_POST['tagline'] ?? ''));
        $price = filter_var($_POST['harga'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 2147483647]]);
        $duration = trim((string) ($_POST['durasi'] ?? ''));
        $icon = (string) ($_POST['icon'] ?? 'sun');
        $color = (string) ($_POST['color'] ?? '');
        $features = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) ($_POST['fitur'] ?? '')))));

        if (!preg_match('/^[a-z0-9-]{2,60}$/', $id)) {
            $error = 'ID paket hanya boleh berisi huruf kecil, angka, dan tanda hubung.';
        } elseif ($name === '' || mb_strlen($name) > 120 || mb_strlen($tagline) > 255 || $tagline === '' || !$price || $duration === '' || mb_strlen($duration) > 80) {
            $error = 'Lengkapi nama, tagline, harga, dan durasi paket dengan benar.';
        } elseif (!in_array($icon, $allowedIcons, true) || !preg_match('/^#[0-9a-fA-F]{6}$/', $color)) {
            $error = 'Pilih ikon dan warna paket yang valid.';
        } elseif (!$features) {
            $error = 'Tambahkan minimal satu fasilitas paket.';
        } else {
            try {
                $values = [
                    'nama' => $name,
                    'tagline' => $tagline,
                    'harga' => $price,
                    'durasi' => $duration,
                    'icon' => $icon,
                    'color' => $color,
                    'popular' => isset($_POST['popular']) ? 1 : 0,
                    'fitur' => json_encode($features, JSON_THROW_ON_ERROR),
                ];

                if ($originalId !== '') {
                    $statement = $pdo->prepare('UPDATE packages SET nama = :nama, tagline = :tagline, harga = :harga, durasi = :durasi, icon = :icon, color = :color, popular = :popular, fitur = :fitur WHERE id = :id');
                    $statement->execute($values + ['id' => $originalId]);
                    $_SESSION['package_notice'] = 'Paket berhasil diperbarui.';
                } else {
                    $nextOrder = (int) $pdo->query('SELECT COALESCE(MAX(sort_order), 0) + 1 FROM packages')->fetchColumn();
                    $statement = $pdo->prepare('INSERT INTO packages (id, nama, tagline, harga, durasi, icon, color, popular, fitur, sort_order) VALUES (:id, :nama, :tagline, :harga, :durasi, :icon, :color, :popular, :fitur, :sort_order)');
                    $statement->execute($values + ['id' => $id, 'sort_order' => $nextOrder]);
                    $_SESSION['package_notice'] = 'Paket baru berhasil ditambahkan.';
                }
                header('Location: packages.php');
                exit;
            } catch (PDOException $exception) {
                $error = $exception->getCode() === '23000'
                    ? 'ID paket sudah digunakan. Gunakan ID lain.'
                    : 'Paket tidak dapat disimpan. Periksa data lalu coba lagi.';
            }
        }
    }
}

$editing = null;
if (isset($_GET['edit'])) {
    $statement = $pdo->prepare('SELECT * FROM packages WHERE id = :id');
    $statement->execute(['id' => (string) $_GET['edit']]);
    $editing = $statement->fetch() ?: null;
    if ($editing) {
        $editing['fitur'] = json_decode($editing['fitur'], true) ?: [];
    }
}
$packages = $pdo->query('SELECT id, nama, harga, durasi, popular FROM packages ORDER BY sort_order, id')->fetchAll();
$admin = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Paket — Wisata Bahari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="account-page">
    <header class="account-header">
        <a class="auth-brand" href="index.php">Wisata<strong>Bahari</strong><span class="admin-tag">ADMIN</span></a>
        <nav class="admin-nav" aria-label="Navigasi admin">
            <a href="index.php">Dashboard</a>
            <form method="post" action="../logout.php">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <button class="btn btn--primary" type="submit">Keluar</button>
            </form>
        </nav>
    </header>
    <main class="admin-content">
        <div class="admin-page-heading">
            <div>
                <span class="auth-eyebrow">PENGELOLAAN KONTEN</span>
                <h1>Paket wisata</h1>
                <p class="auth-intro">Perubahan paket akan langsung tampil di halaman utama dan kalkulator harga.</p>
            </div>
            <a class="admin-secondary-link" href="../index.php#paket">Lihat situs</a>
        </div>

        <?php if ($error !== ''): ?>
            <p class="auth-alert" role="alert"><?= e($error) ?></p>
        <?php elseif ($success !== ''): ?>
            <p class="auth-success" role="status"><?= e($success) ?></p>
        <?php endif; ?>

        <section class="admin-section" aria-labelledby="package-form-title">
            <h2 id="package-form-title"><?= $editing ? 'Edit paket' : 'Tambah paket' ?></h2>
            <form class="admin-package-form" method="post" action="packages.php<?= $editing ? '?edit=' . rawurlencode($editing['id']) : '' ?>">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="original_id" value="<?= e((string) ($editing['id'] ?? '')) ?>">
                <div class="form-group">
                    <label class="form-label" for="id">ID paket</label>
                    <input class="form-input" id="id" name="id" maxlength="60" pattern="[a-z0-9\-]{2,60}" value="<?= e((string) ($editing['id'] ?? $_POST['id'] ?? '')) ?>" <?= $editing ? 'readonly' : 'required' ?>>
                </div>
                <div class="form-group">
                    <label class="form-label" for="nama">Nama paket</label>
                    <input class="form-input" id="nama" name="nama" maxlength="120" value="<?= e((string) ($editing['nama'] ?? $_POST['nama'] ?? '')) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="tagline">Tagline</label>
                    <input class="form-input" id="tagline" name="tagline" maxlength="255" value="<?= e((string) ($editing['tagline'] ?? $_POST['tagline'] ?? '')) ?>" required>
                </div>
                <div class="admin-form-row">
                    <div class="form-group">
                        <label class="form-label" for="harga">Harga per orang (Rp)</label>
                        <input class="form-input" type="number" id="harga" name="harga" min="1000" step="1000" value="<?= e((string) ($editing['harga'] ?? $_POST['harga'] ?? '')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="durasi">Durasi</label>
                        <input class="form-input" id="durasi" name="durasi" maxlength="80" placeholder="2 Hari 1 Malam" value="<?= e((string) ($editing['durasi'] ?? $_POST['durasi'] ?? '')) ?>" required>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="form-group">
                        <label class="form-label" for="icon">Ikon</label>
                        <select class="form-select" id="icon" name="icon">
                            <?php foreach (['sun' => 'Matahari', 'star' => 'Bintang', 'diamond' => 'Berlian'] as $iconValue => $iconLabel): ?>
                                <option value="<?= e($iconValue) ?>" <?= ($editing['icon'] ?? $_POST['icon'] ?? 'sun') === $iconValue ? 'selected' : '' ?>><?= e($iconLabel) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="color">Warna paket</label>
                        <input class="admin-color-input" type="color" id="color" name="color" value="<?= e((string) ($editing['color'] ?? $_POST['color'] ?? '#0ea5e9')) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="fitur">Fasilitas, satu per baris</label>
                    <textarea class="form-input admin-features-input" id="fitur" name="fitur" rows="6" required><?= e(implode("\n", $editing['fitur'] ?? (isset($_POST['fitur']) ? preg_split('/\r\n|\r|\n/', (string) $_POST['fitur']) : []))) ?></textarea>
                </div>
                <label class="admin-checkbox"><input type="checkbox" name="popular" value="1" <?= !empty($editing['popular']) || isset($_POST['popular']) ? 'checked' : '' ?>> Tandai sebagai paket populer</label>
                <div class="admin-form-actions">
                    <button class="btn btn--primary" type="submit"><?= $editing ? 'Simpan perubahan' : 'Tambah paket' ?></button>
                    <?php if ($editing): ?><a class="admin-secondary-link" href="packages.php">Batal edit</a><?php endif; ?>
                </div>
            </form>
        </section>

        <section class="admin-section" aria-labelledby="package-list-title">
            <h2 id="package-list-title">Daftar paket <span class="admin-count"><?= count($packages) ?></span></h2>
            <?php if ($packages): ?>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead><tr><th>Paket</th><th>Durasi</th><th>Harga</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php foreach ($packages as $package): ?>
                                <tr>
                                    <td><strong><?= e($package['nama']) ?></strong><small><?= e($package['id']) ?></small></td>
                                    <td><?= e($package['durasi']) ?></td>
                                    <td>Rp <?= number_format((int) $package['harga'], 0, ',', '.') ?></td>
                                    <td><?= $package['popular'] ? 'Populer' : 'Aktif' ?></td>
                                    <td class="admin-table-actions">
                                        <a class="admin-action-link" href="packages.php?edit=<?= rawurlencode($package['id']) ?>">Edit</a>
                                        <form method="post" action="packages.php" onsubmit="return confirm('Hapus paket ini?')">
                                            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= e($package['id']) ?>">
                                            <button class="admin-delete-button" type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="auth-intro">Belum ada paket. Tambahkan paket pertama melalui formulir.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>