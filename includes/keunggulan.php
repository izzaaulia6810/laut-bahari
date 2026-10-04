<!-- Keunggulan Section -->
<section id="keunggulan" class="section keunggulan">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Mengapa Kami?</span>
            <h2 class="section__title">Keunggulan <span class="text-gradient">Wisata Bahari</span></h2>
            <p class="section__desc">Kami memastikan setiap perjalanan menjadi pengalaman yang aman, menyenangkan, dan tak terlupakan.</p>
        </div>

        <div class="keunggulan__grid">
            <?php foreach ($keunggulan as $index => $item): ?>
            <div class="keunggulan__card" data-animate="fade-up" data-delay="<?= $index * 100 ?>">
                <div class="keunggulan__icon keunggulan__icon--<?= $item['icon'] ?>">
                    <?php include __DIR__ . '/icons/' . $item['icon'] . '.svg.php'; ?>
                </div>
                <h3 class="keunggulan__card-title"><?= htmlspecialchars($item['title']) ?></h3>
                <p class="keunggulan__card-desc"><?= htmlspecialchars($item['desc']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
