<!-- Footer -->
<footer class="footer">
    <div class="footer__wave" aria-hidden="true">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,40 C360,80 720,0 1080,50 C1260,75 1380,20 1440,40 L1440,0 L0,0Z" fill="#ffffff"/>
        </svg>
    </div>
    <div class="container footer__inner">
        <div class="footer__grid">
            <!-- Brand -->
            <div class="footer__brand">
                <a href="#beranda" class="navbar__logo" aria-label="Wisata Bahari">
                    <svg class="navbar__logo-icon" width="36" height="36" viewBox="0 0 36 36" fill="none" aria-hidden="true">
                        <circle cx="18" cy="18" r="18" fill="url(#logoGrad2)"/>
                        <path d="M8 22c2-3 4-4 6-2s4 1 6-1 4-3 6-1 2 4 2 4" stroke="#fff" stroke-width="2" stroke-linecap="round" fill="none"/>
                        <circle cx="18" cy="10" r="2.5" fill="#fbbf24"/>
                        <defs><linearGradient id="logoGrad2" x1="0" y1="0" x2="36" y2="36"><stop offset="0%" stop-color="#0ea5e9"/><stop offset="100%" stop-color="#0369a1"/></linearGradient></defs>
                    </svg>
                    <span class="navbar__logo-text">Wisata<strong>Bahari</strong></span>
                </a>
                <p class="footer__desc">Paket wisata pantai dan pulau kecil untuk liburan sekolah & keluarga. Buat momen kebersamaan yang tak terlupakan.</p>
            </div>

            <!-- Quick Links -->
            <div class="footer__links">
                <h4 class="footer__heading">Menu</h4>
                <ul>
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#paket">Paket Wisata</a></li>
                    <li><a href="#itinerary">Itinerary</a></li>
                    <li><a href="#galeri">Galeri</a></li>
                    <li><a href="#harga">Harga</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>

            <!-- Paket -->
            <div class="footer__links">
                <h4 class="footer__heading">Paket Wisata</h4>
                <ul>
                    <?php foreach ($paket_wisata as $paket): ?>
                    <li><a href="#paket"><?= htmlspecialchars($paket['nama']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="footer__links">
                <h4 class="footer__heading">Hubungi Kami</h4>
                <ul>
                    <li>+62 812-3456-7890</li>
                    <li>info@wisatabahari.id</li>
                    <li>Jl. Pantai Indah No. 88</li>
                </ul>
            </div>
        </div>

        <div class="footer__bottom">
            <p>&copy; <?= date('Y') ?> Wisata Bahari. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>
