<?php
/**
 * Wisata Bahari - Website Paket Wisata Pantai & Pulau
 * Entry point utama website
 */

// Data paket wisata (bisa dipindah ke database nanti)
require_once __DIR__ . '/includes/data.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Paket wisata pantai dan pulau kecil untuk liburan sekolah & keluarga. Nikmati laut biru, pasir putih, aktivitas seru, dan momen kebersamaan.">
    <meta name="keywords" content="wisata bahari, paket wisata pantai, liburan keluarga, wisata pulau, rombongan sekolah">
    <meta name="author" content="Wisata Bahari">
    <title>Wisata Bahari — Liburan Seru ke Pantai & Pulau</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Loading Screen -->
    <div id="loader" class="loader" aria-hidden="true">
        <div class="loader__wave">
            <span></span><span></span><span></span><span></span><span></span>
        </div>
    </div>

    <!-- Navbar -->
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main>
        <!-- Hero Section -->
        <?php include __DIR__ . '/includes/hero.php'; ?>

        <!-- Keunggulan Section -->
        <?php include __DIR__ . '/includes/keunggulan.php'; ?>

        <!-- Paket Wisata Section -->
        <?php include __DIR__ . '/includes/paket.php'; ?>

        <!-- Kalkulator Harga Section -->
        <?php include __DIR__ . '/includes/kalkulator.php'; ?>

        <!-- Itinerary Section -->
        <?php include __DIR__ . '/includes/itinerary.php'; ?>

        <!-- Galeri Section -->
        <?php include __DIR__ . '/includes/galeri.php'; ?>

        <!-- Kontak Section -->
        <?php include __DIR__ . '/includes/kontak.php'; ?>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- Back to Top -->
    <button id="backToTop" class="back-to-top" aria-label="Kembali ke atas" title="Kembali ke atas">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <path d="M10 3L3 12h4.5v5h5v-5H17L10 3z" fill="currentColor"/>
        </svg>
    </button>

    <!-- JavaScript -->
    <script src="assets/js/main.js"></script>
</body>
</html>
