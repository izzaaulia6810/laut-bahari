<!-- Hero Section -->
<section id="beranda" class="hero">
    <!-- SVG Background Scene -->
    <div class="hero__bg" aria-hidden="true">
        <!-- Sky gradient -->
        <div class="hero__sky"></div>

        <!-- Sun -->
        <div class="hero__sun"></div>

        <!-- Clouds -->
        <div class="hero__cloud hero__cloud--1">
            <svg viewBox="0 0 200 80" fill="white" opacity="0.8"><ellipse cx="70" cy="50" rx="60" ry="25"/><ellipse cx="110" cy="40" rx="50" ry="30"/><ellipse cx="140" cy="55" rx="40" ry="20"/></svg>
        </div>
        <div class="hero__cloud hero__cloud--2">
            <svg viewBox="0 0 180 70" fill="white" opacity="0.6"><ellipse cx="60" cy="45" rx="50" ry="22"/><ellipse cx="100" cy="35" rx="45" ry="28"/><ellipse cx="130" cy="48" rx="35" ry="18"/></svg>
        </div>
        <div class="hero__cloud hero__cloud--3">
            <svg viewBox="0 0 160 60" fill="white" opacity="0.5"><ellipse cx="50" cy="40" rx="40" ry="18"/><ellipse cx="90" cy="30" rx="40" ry="24"/><ellipse cx="120" cy="42" rx="30" ry="16"/></svg>
        </div>

        <!-- Island silhouette -->
        <svg class="hero__island" viewBox="0 0 300 120" fill="none" aria-hidden="true">
            <path d="M0 120 C30 90, 60 50, 100 40 C120 35, 140 30, 150 25 C160 30, 170 35, 180 40 C220 55, 260 80, 300 120Z" fill="#2d9a4e" opacity="0.3"/>
            <path d="M140 25 C142 15, 148 8, 150 5 C152 8, 155 12, 155 18 C158 14, 162 10, 163 8 C164 12, 163 20, 160 25" fill="#22863a" opacity="0.4"/>
        </svg>

        <!-- Boat -->
        <div class="hero__boat">
            <svg viewBox="0 0 80 50" fill="none" aria-hidden="true">
                <path d="M10 35 L15 25 L65 25 L70 35 C55 40 25 40 10 35Z" fill="#fff" opacity="0.9"/>
                <line x1="35" y1="25" x2="35" y2="8" stroke="#8B7355" stroke-width="2"/>
                <path d="M35 8 L55 18 L35 22Z" fill="#fff" opacity="0.8"/>
            </svg>
        </div>

        <!-- Birds -->
        <div class="hero__birds">
            <svg class="hero__bird hero__bird--1" viewBox="0 0 30 12" fill="none"><path d="M0 8 Q7 0 15 6 Q23 0 30 8" stroke="#fff" stroke-width="1.5" fill="none" opacity="0.6"/></svg>
            <svg class="hero__bird hero__bird--2" viewBox="0 0 24 10" fill="none"><path d="M0 7 Q6 0 12 5 Q18 0 24 7" stroke="#fff" stroke-width="1.5" fill="none" opacity="0.4"/></svg>
            <svg class="hero__bird hero__bird--3" viewBox="0 0 20 8" fill="none"><path d="M0 6 Q5 0 10 4 Q15 0 20 6" stroke="#fff" stroke-width="1.2" fill="none" opacity="0.5"/></svg>
        </div>
    </div>

    <!-- Hero Content -->
    <div class="container hero__content">
        <span class="hero__badge">🌴 Liburan Sekolah & Keluarga</span>
        <h1 class="hero__title">
            Liburan Seru ke Pantai &amp; Pulau,<br>
            <span class="hero__title-highlight">Jadi Cerita yang Tak Terlupakan!</span>
        </h1>
        <p class="hero__subtitle">
            Paket wisata ceria untuk keluarga dan rombongan sekolah.<br class="hide-mobile">
            Nikmati laut biru, pasir putih, aktivitas seru, dan momen kebersamaan.
        </p>
        <div class="hero__actions">
            <a href="#paket" class="btn btn--primary btn--lg">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M3 7l7-4 7 4v6l-7 4-7-4V7z" stroke="currentColor" stroke-width="1.5" fill="none"/><path d="M3 7l7 4m0 0l7-4m-7 4v7" stroke="currentColor" stroke-width="1.5"/></svg>
                Lihat Paket Wisata
            </a>
            <a href="#harga" class="btn btn--outline btn--lg">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><circle cx="10" cy="10" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M10 6v8M8 8.5c0-1 .9-1.5 2-1.5s2 .5 2 1.5-.9 1.5-2 2-2 .5-2 1.5.9 1.5 2 1.5 2-.5 2-1.5" stroke="currentColor" stroke-width="1.2" fill="none"/></svg>
                Hitung Harga
            </a>
        </div>

        <!-- Stats -->
        <div class="hero__stats">
            <div class="hero__stat">
                <span class="hero__stat-number" data-count="2500">0</span><span>+</span>
                <span class="hero__stat-label">Wisatawan Puas</span>
            </div>
            <div class="hero__stat">
                <span class="hero__stat-number" data-count="150">0</span><span>+</span>
                <span class="hero__stat-label">Rombongan Sekolah</span>
            </div>
            <div class="hero__stat">
                <span class="hero__stat-number" data-count="12">0</span>
                <span class="hero__stat-label">Destinasi Pulau</span>
            </div>
        </div>
    </div>

    <!-- Multi-layer Waves -->
    <div class="hero__waves" aria-hidden="true">
        <svg class="hero__wave hero__wave--3" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,60 C180,120 360,0 540,60 C720,120 900,0 1080,60 C1260,120 1440,30 1440,60 L1440,120 L0,120Z" fill="rgba(255,255,255,0.3)"/>
        </svg>
        <svg class="hero__wave hero__wave--2" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,80 C240,20 480,100 720,60 C960,20 1200,100 1440,60 L1440,120 L0,120Z" fill="rgba(255,255,255,0.5)"/>
        </svg>
        <svg class="hero__wave hero__wave--1" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,40 C320,100 640,0 960,60 C1120,90 1280,40 1440,80 L1440,120 L0,120Z" fill="#ffffff"/>
        </svg>
    </div>
</section>
