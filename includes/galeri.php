<!-- Galeri Section -->
<section id="galeri" class="section galeri">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">📸 Momen Indah</span>
            <h2 class="section__title">Galeri <span class="text-gradient">Wisata</span></h2>
            <p class="section__desc">Intip keseruan yang menanti kamu di setiap perjalanan bersama kami.</p>
        </div>

        <div class="galeri__grid">
            <?php foreach ($galeri as $index => $item): ?>
            <div class="galeri__item" data-animate="fade-up" data-delay="<?= $index * 100 ?>">
                <div class="galeri__placeholder" style="background: linear-gradient(135deg, <?= $item['color'] ?>22, <?= $item['color'] ?>44);">
                    <?php if (!empty($item['image'])): ?>
                    <img class="galeri__photo" src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy" decoding="async">
                    <?php else: ?>
                    <svg class="galeri__svg" viewBox="0 0 300 200" fill="none" aria-hidden="true">
                        <?php if ($index === 0): // Snorkeling ?>
                        <rect width="300" height="200" fill="url(#ocean<?= $index ?>)"/>
                        <ellipse cx="150" cy="170" rx="100" ry="20" fill="#c4b88e" opacity="0.4"/>
                        <path d="M80 140c10-5 20 0 30-5s20-10 30-5 20 10 30 5 20-10 30-5 20 8 30 3" stroke="<?= $item['color'] ?>" stroke-width="2" fill="none" opacity="0.5"/>
                        <circle cx="120" cy="120" r="15" fill="<?= $item['color'] ?>" opacity="0.3"/>
                        <circle cx="180" cy="110" r="10" fill="<?= $item['color'] ?>" opacity="0.2"/>
                        <path d="M140 150c5-20 20-30 30-25s15 20 10 35" stroke="<?= $item['color'] ?>" stroke-width="2" fill="<?= $item['color'] ?>" fill-opacity="0.15"/>
                        <defs><linearGradient id="ocean<?= $index ?>" x1="0" y1="0" x2="0" y2="200"><stop offset="0%" stop-color="<?= $item['color'] ?>" stop-opacity="0.1"/><stop offset="100%" stop-color="<?= $item['color'] ?>" stop-opacity="0.25"/></linearGradient></defs>
                        <?php elseif ($index === 1): // Pasir putih ?>
                        <rect width="300" height="200" fill="url(#sand<?= $index ?>)"/>
                        <path d="M0 130 Q75 110 150 130 T300 120 L300 200 L0 200Z" fill="#c4b88e" opacity="0.3"/>
                        <circle cx="80" cy="100" r="4" fill="<?= $item['color'] ?>" opacity="0.5"/>
                        <circle cx="200" cy="90" r="3" fill="<?= $item['color'] ?>" opacity="0.4"/>
                        <path d="M140 80l5-30 5 30" stroke="#22863a" stroke-width="3" fill="#22863a" fill-opacity="0.2"/>
                        <path d="M135 82c0 0 5-5 10 0s10 0 10 0" stroke="#22863a" stroke-width="2" fill="none"/>
                        <defs><linearGradient id="sand<?= $index ?>" x1="0" y1="0" x2="0" y2="200"><stop offset="0%" stop-color="#87CEEB" stop-opacity="0.15"/><stop offset="60%" stop-color="<?= $item['color'] ?>" stop-opacity="0.15"/></linearGradient></defs>
                        <?php elseif ($index === 2): // Sunset ?>
                        <rect width="300" height="200" fill="url(#sunset<?= $index ?>)"/>
                        <circle cx="150" cy="100" r="30" fill="<?= $item['color'] ?>" opacity="0.4"/>
                        <circle cx="150" cy="100" r="20" fill="<?= $item['color'] ?>" opacity="0.3"/>
                        <path d="M0 140 Q150 120 300 140 L300 200 L0 200Z" fill="#1a365d" opacity="0.2"/>
                        <path d="M120 160l3-20 2 8 5-15 3 12 4-10 2 18" stroke="#8B7355" stroke-width="2" fill="none" opacity="0.3"/>
                        <defs><linearGradient id="sunset<?= $index ?>" x1="0" y1="0" x2="0" y2="200"><stop offset="0%" stop-color="#fbbf24" stop-opacity="0.2"/><stop offset="100%" stop-color="<?= $item['color'] ?>" stop-opacity="0.2"/></linearGradient></defs>
                        <?php elseif ($index === 3): // BBQ ?>
                        <rect width="300" height="200" fill="url(#bbq<?= $index ?>)"/>
                        <path d="M100 160 Q110 100 120 160 Q130 100 140 160 Q150 110 160 160" stroke="<?= $item['color'] ?>" stroke-width="3" fill="none" opacity="0.4"/>
                        <ellipse cx="130" cy="170" rx="50" ry="10" fill="#8B7355" opacity="0.3"/>
                        <circle cx="130" cy="80" r="5" fill="#fbbf24" opacity="0.5"/>
                        <circle cx="150" cy="70" r="3" fill="#fbbf24" opacity="0.3"/>
                        <defs><linearGradient id="bbq<?= $index ?>" x1="0" y1="0" x2="0" y2="200"><stop offset="0%" stop-color="#1a1a2e" stop-opacity="0.15"/><stop offset="100%" stop-color="<?= $item['color'] ?>" stop-opacity="0.15"/></linearGradient></defs>
                        <?php elseif ($index === 4): // Island Hopping ?>
                        <rect width="300" height="200" fill="url(#hop<?= $index ?>)"/>
                        <path d="M50 140 C70 120 90 130 100 140" fill="#22863a" opacity="0.3"/>
                        <path d="M150 130 C175 100 210 115 220 130" fill="#22863a" opacity="0.25"/>
                        <path d="M0 150 Q150 135 300 150 L300 200 L0 200Z" fill="<?= $item['color'] ?>" opacity="0.15"/>
                        <path d="M70 140l2-20 3 10 2-8" stroke="#22863a" stroke-width="2" fill="none" opacity="0.4"/>
                        <defs><linearGradient id="hop<?= $index ?>" x1="0" y1="0" x2="0" y2="200"><stop offset="0%" stop-color="#87CEEB" stop-opacity="0.15"/><stop offset="100%" stop-color="<?= $item['color'] ?>" stop-opacity="0.15"/></linearGradient></defs>
                        <?php else: // Banana Boat ?>
                        <rect width="300" height="200" fill="url(#boat<?= $index ?>)"/>
                        <path d="M80 120 L100 110 L200 110 L220 120 C180 130 120 130 80 120Z" fill="<?= $item['color'] ?>" opacity="0.3"/>
                        <path d="M60 130 Q150 110 240 130" stroke="<?= $item['color'] ?>" stroke-width="2" fill="none" opacity="0.3"/>
                        <path d="M60 140 Q150 120 240 140" stroke="<?= $item['color'] ?>" stroke-width="1.5" fill="none" opacity="0.2"/>
                        <defs><linearGradient id="boat<?= $index ?>" x1="0" y1="0" x2="0" y2="200"><stop offset="0%" stop-color="#87CEEB" stop-opacity="0.1"/><stop offset="100%" stop-color="<?= $item['color'] ?>" stop-opacity="0.15"/></linearGradient></defs>
                        <?php endif; ?>
                    </svg>
                    <?php endif; ?>
                    <div class="galeri__overlay">
                        <span class="galeri__title"><?= htmlspecialchars($item['title']) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
