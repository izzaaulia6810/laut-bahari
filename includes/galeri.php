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
                <div class="galeri__placeholder">
                    <!-- SVG Illustration per card -->
                    <?php if (!empty($item['image'])): ?>
                    <img
                        class="galeri__photo"
                        src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>"
                        alt="<?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?>"
                        loading="lazy"
                    >
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
