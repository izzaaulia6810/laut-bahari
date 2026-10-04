<!-- Itinerary Section -->
<section id="itinerary" class="section itinerary-section">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">🗺️ Jadwal Perjalanan</span>
            <h2 class="section__title">Itinerary <span class="text-gradient">Perjalanan</span></h2>
            <p class="section__desc">Lihat detail jadwal perjalanan untuk setiap paket wisata yang tersedia.</p>
        </div>

        <!-- Tab Buttons -->
        <div class="itinerary__tabs" role="tablist" aria-label="Pilih paket itinerary">
            <?php $first = true; foreach ($itinerary as $id => $data): ?>
            <button
                class="itinerary__tab <?= $first ? 'itinerary__tab--active' : '' ?>"
                role="tab"
                id="tab-<?= $id ?>"
                aria-controls="panel-<?= $id ?>"
                aria-selected="<?= $first ? 'true' : 'false' ?>"
                data-tab="<?= $id ?>"
            >
                <?= htmlspecialchars($data['nama']) ?>
            </button>
            <?php $first = false; endforeach; ?>
        </div>

        <!-- Tab Panels -->
        <?php $first = true; foreach ($itinerary as $id => $data): ?>
        <div
            class="itinerary__panel <?= $first ? 'itinerary__panel--active' : '' ?>"
            role="tabpanel"
            id="panel-<?= $id ?>"
            aria-labelledby="tab-<?= $id ?>"
            <?= !$first ? 'hidden' : '' ?>
        >
            <?php if (count($data['hari']) > 1): ?>
            <!-- Day Sub-tabs -->
            <div class="itinerary__days" role="tablist" aria-label="Pilih hari">
                <?php foreach ($data['hari'] as $hIndex => $hari): ?>
                <button
                    class="itinerary__day-tab <?= $hIndex === 0 ? 'itinerary__day-tab--active' : '' ?>"
                    role="tab"
                    data-day="<?= $id ?>-<?= $hIndex ?>"
                    aria-selected="<?= $hIndex === 0 ? 'true' : 'false' ?>"
                >
                    <?= htmlspecialchars($hari['label']) ?>
                </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php foreach ($data['hari'] as $hIndex => $hari): ?>
            <div
                class="itinerary__day-panel <?= $hIndex === 0 ? 'itinerary__day-panel--active' : '' ?>"
                data-day-panel="<?= $id ?>-<?= $hIndex ?>"
                <?= $hIndex !== 0 ? 'hidden' : '' ?>
            >
                <div class="itinerary__timeline">
                    <?php foreach ($hari['jadwal'] as $jadwal): ?>
                    <div class="itinerary__item" data-animate="fade-up">
                        <div class="itinerary__time"><?= htmlspecialchars($jadwal['waktu']) ?></div>
                        <div class="itinerary__dot"></div>
                        <div class="itinerary__content">
                            <span class="itinerary__activity"><?= htmlspecialchars($jadwal['kegiatan']) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php $first = false; endforeach; ?>
    </div>
</section>
