<!-- Navbar -->
<header id="navbar" class="navbar" role="banner">
    <div class="container navbar__inner">
        <!-- Logo -->
        <a href="#beranda" class="navbar__logo" aria-label="Wisata Bahari - Beranda">
            <svg class="navbar__logo-icon" width="36" height="36" viewBox="0 0 36 36" fill="none" aria-hidden="true">
                <circle cx="18" cy="18" r="18" fill="url(#logoGrad)"/>
                <path d="M8 22c2-3 4-4 6-2s4 1 6-1 4-3 6-1 2 4 2 4" stroke="#fff" stroke-width="2" stroke-linecap="round" fill="none"/>
                <path d="M12 18c1-4 3-6 6-6s5 2 6 6" stroke="#fff" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.7"/>
                <circle cx="18" cy="10" r="2.5" fill="#fbbf24"/>
                <defs>
                    <linearGradient id="logoGrad" x1="0" y1="0" x2="36" y2="36">
                        <stop offset="0%" stop-color="#0ea5e9"/>
                        <stop offset="100%" stop-color="#0369a1"/>
                    </linearGradient>
                </defs>
            </svg>
            <span class="navbar__logo-text">Wisata<strong>Bahari</strong></span>
        </a>

        <!-- Desktop Nav -->
        <nav class="navbar__nav" aria-label="Navigasi utama">
            <ul class="navbar__menu" id="navMenu">
                <li><a href="#beranda" class="navbar__link active" data-section="beranda">Beranda</a></li>
                <li><a href="#paket" class="navbar__link" data-section="paket">Paket Wisata</a></li>
                <li><a href="#itinerary" class="navbar__link" data-section="itinerary">Itinerary</a></li>
                <li><a href="#galeri" class="navbar__link" data-section="galeri">Galeri</a></li>
                <li><a href="#harga" class="navbar__link" data-section="harga">Harga</a></li>
                <li><a href="#kontak" class="navbar__link" data-section="kontak">Kontak</a></li>
                <li><a href="login.php" class="navbar__link">Masuk</a></li>
            </ul>
        </nav>

        <!-- CTA Button -->
        <a href="#kontak" class="btn btn--primary navbar__cta">Pesan Sekarang</a>

        <!-- Hamburger Toggle -->
        <button id="hamburger" class="navbar__hamburger" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobileMenu">
            <span class="navbar__hamburger-line"></span>
            <span class="navbar__hamburger-line"></span>
            <span class="navbar__hamburger-line"></span>
        </button>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenu" class="navbar__mobile" aria-hidden="true">
        <nav aria-label="Navigasi mobile">
            <ul class="navbar__mobile-menu">
                <li><a href="#beranda" class="navbar__mobile-link active" data-section="beranda">Beranda</a></li>
                <li><a href="#paket" class="navbar__mobile-link" data-section="paket">Paket Wisata</a></li>
                <li><a href="#itinerary" class="navbar__mobile-link" data-section="itinerary">Itinerary</a></li>
                <li><a href="#galeri" class="navbar__mobile-link" data-section="galeri">Galeri</a></li>
                <li><a href="#harga" class="navbar__mobile-link" data-section="harga">Harga</a></li>
                <li><a href="#kontak" class="navbar__mobile-link" data-section="kontak">Kontak</a></li>
                <li><a href="login.php" class="navbar__mobile-link">Masuk Pengguna</a></li>
                <li><a href="admin/login.php" class="navbar__mobile-link">Masuk Admin</a></li>
                <li><a href="#kontak" class="btn btn--primary navbar__mobile-cta">Pesan Sekarang</a></li>
            </ul>
        </nav>
    </div>
</header>
