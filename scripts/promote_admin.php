<?php

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

if ($argc !== 2 || !filter_var($argv[1], FILTER_VALIDATE_EMAIL)) {
    fwrite(STDERR, "Penggunaan: php scripts/promote_admin.php email-pengguna\n");
    exit(1);
}

require_once __DIR__ . '/../includes/db.php';
$statement = $pdo->prepare("UPDATE users SET role = 'admin' WHERE email = :email AND role = 'user'");
$statement->execute(['email' => strtolower($argv[1])]);

if ($statement->rowCount() !== 1) {
    fwrite(STDERR, "Pengguna tidak ditemukan atau sudah menjadi admin.\n");
    exit(1);
}

fwrite(STDOUT, "Akun {$argv[1]} sekarang memiliki akses admin.\n");