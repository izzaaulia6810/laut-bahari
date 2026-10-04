<!-- Paket Wisata Section -->
<section id="paket" class="section paket">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">🏖️ Pilih Paketmu</span>
            <h2 class="section__title">Paket Wisata <span class="text-gradient">Pilihan</span></h2>
            <p class="section__desc">Pilih paket yang sesuai dengan kebutuhan dan budget kamu. Semua paket sudah termasuk fasilitas lengkap.</p>
        </div>

        <div class="paket__grid">
            <?php foreach ($paket_wisata as $index => $paket): ?>
            <div class="paket__card <?= !empty($paket['popular']) ? 'paket__card--popular' : '' ?>" data-animate="fade-up" data-delay="<?= $index * 150 ?>">
                <?php if (!empty($paket['popular'])): ?>
                    <div class="paket__card-badge">⭐ Paling Populer</div>
                <?php endif; ?>

                <div class="paket__card-header" style="--accent: <?= $paket['color'] ?>">
                    <div class="paket__card-icon">
                        <?php if ($paket['icon'] === 'sun'): ?>
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" aria-hidden="true"><circle cx="20" cy="20" r="8" fill="currentColor" opacity="0.2" stroke="currentColor" stroke-width="2"/><g stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="20" y1="4" x2="20" y2="9"/><line x1="20" y1="31" x2="20" y2="36"/><line x1="4" y1="20" x2="9" y2="20"/><line x1="31" y1="20" x2="36" y2="20"/><line x1="8.5" y1="8.5" x2="12" y2="12"/><line x1="28" y1="28" x2="31.5" y2="31.5"/><line x1="8.5" y1="31.5" x2="12" y2="28"/><line x1="28" y1="12" x2="31.5" y2="8.5"/></g></svg>
                        <?php elseif ($paket['icon'] === 'star'): ?>
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" aria-hidden="true"><path d="M20 4l4.9 10 11.1 1.6-8 7.8 1.9 11L20 29l-9.9 5.4 1.9-11-8-7.8L15.1 14 20 4z" fill="currentColor" opacity="0.15" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                        <?php elseif ($paket['icon'] === 'diamond'): ?>
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" aria-hidden="true"><path d="M20 4L6 16l14 20 14-20L20 4z" fill="currentColor" opacity="0.15" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M6 16h28M14 16L20 4l6 12" stroke="currentColor" stroke-width="1.5" opacity="0.5"/></svg>
                        <?php endif; ?>
                    </div>
                    <h3 class="paket__card-name"><?= htmlspecialchars($paket['nama']) ?></h3>
                    <p class="paket__card-tagline"><?= htmlspecialchars($paket['tagline']) ?></p>
                    <span class="paket__card-duration"><?= htmlspecialchars($paket['durasi']) ?></span>
                </div>

                <div class="paket__card-price">
                    <span class="paket__card-price-label">Mulai dari</span>
                    <span class="paket__card-price-value">
                        <small>Rp</small><?= number_format($paket['harga'], 0, ',', '.') ?>
                    </span>
                    <span class="paket__card-price-unit">/ orang</span>
                </div>

                <ul class="paket__card-features" aria-label="Fasilitas <?= htmlspecialchars($paket['nama']) ?>">
                    <?php foreach ($paket['fitur'] as $fitur): ?>
                    <li class="paket__card-feature">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="7" fill="currentColor" opacity="0.1"/><path d="M5 8l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?= htmlspecialchars($fitur) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <a href="#harga" class="btn <?= !empty($paket['popular']) ? 'btn--primary' : 'btn--outline' ?> paket__card-btn">
                    Pilih Paket Ini
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
