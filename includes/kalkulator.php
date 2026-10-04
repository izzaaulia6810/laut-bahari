<!-- Kalkulator Harga Section -->
<section id="harga" class="section kalkulator">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">💰 Hitung Biaya</span>
            <h2 class="section__title">Kalkulator <span class="text-gradient">Harga Paket</span></h2>
            <p class="section__desc">Hitung estimasi biaya perjalananmu dengan mudah. Pilih paket dan masukkan jumlah peserta.</p>
        </div>

        <div class="kalkulator__wrapper">
            <form class="kalkulator__form" id="kalkulatorForm" aria-label="Kalkulator harga paket wisata">
                <div class="kalkulator__inputs">
                    <!-- Pilihan Paket -->
                    <div class="form-group">
                        <label for="pilihPaket" class="form-label">Pilih Paket Wisata</label>
                        <select id="pilihPaket" class="form-select" required aria-describedby="paketHelp">
                            <option value="" disabled selected>— Pilih Paket —</option>
                            <?php foreach ($paket_wisata as $paket): ?>
                            <option value="<?= $paket['id'] ?>" data-harga="<?= $paket['harga'] ?>" data-nama="<?= htmlspecialchars($paket['nama']) ?>">
                                <?= htmlspecialchars($paket['nama']) ?> — <?= htmlspecialchars($paket['durasi']) ?> (Rp <?= number_format($paket['harga'], 0, ',', '.') ?>/orang)
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <small id="paketHelp" class="form-help">Pilih paket sesuai kebutuhan perjalananmu</small>
                    </div>

                    <!-- Jumlah Orang -->
                    <div class="form-group">
                        <label for="jumlahOrang" class="form-label">Jumlah Peserta</label>
                        <div class="form-counter">
                            <button type="button" class="form-counter__btn" id="btnMinus" aria-label="Kurangi peserta">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><line x1="4" y1="9" x2="14" y2="9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            </button>
                            <input type="number" id="jumlahOrang" class="form-input form-counter__input" value="1" min="1" max="500" required aria-describedby="orangHelp">
                            <button type="button" class="form-counter__btn" id="btnPlus" aria-label="Tambah peserta">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><line x1="9" y1="4" x2="9" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="4" y1="9" x2="14" y2="9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            </button>
                        </div>
                        <small id="orangHelp" class="form-help">Minimal 1 orang, diskon mulai 20 orang</small>
                    </div>

                    <button type="submit" class="btn btn--primary btn--lg kalkulator__submit" id="btnHitung">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><rect x="3" y="2" width="14" height="16" rx="2" stroke="currentColor" stroke-width="1.5"/><line x1="6" y1="6" x2="14" y2="6" stroke="currentColor" stroke-width="1.5"/><circle cx="7.5" cy="10" r="1" fill="currentColor"/><circle cx="10" cy="10" r="1" fill="currentColor"/><circle cx="12.5" cy="10" r="1" fill="currentColor"/><circle cx="7.5" cy="13" r="1" fill="currentColor"/><circle cx="10" cy="13" r="1" fill="currentColor"/><rect x="11.5" y="12" width="3" height="4" rx="0.5" fill="currentColor" opacity="0.5"/></svg>
                        Hitung Sekarang
                    </button>
                </div>

                <!-- Hasil Kalkulasi -->
                <div class="kalkulator__result" id="kalkulatorResult" aria-live="polite" hidden>
                    <h3 class="kalkulator__result-title">📋 Estimasi Biaya</h3>
                    <div class="kalkulator__result-grid">
                        <div class="kalkulator__result-item">
                            <span class="kalkulator__result-label">Paket Dipilih</span>
                            <span class="kalkulator__result-value" id="resultPaket">-</span>
                        </div>
                        <div class="kalkulator__result-item">
                            <span class="kalkulator__result-label">Harga per Orang</span>
                            <span class="kalkulator__result-value" id="resultHargaOrang">-</span>
                        </div>
                        <div class="kalkulator__result-item">
                            <span class="kalkulator__result-label">Jumlah Peserta</span>
                            <span class="kalkulator__result-value" id="resultJumlah">-</span>
                        </div>
                        <div class="kalkulator__result-item kalkulator__result-item--discount" id="discountRow" hidden>
                            <span class="kalkulator__result-label">Diskon Rombongan (10%)</span>
                            <span class="kalkulator__result-value kalkulator__result-value--discount" id="resultDiskon">-</span>
                        </div>
                        <div class="kalkulator__result-item kalkulator__result-item--total">
                            <span class="kalkulator__result-label">Total Harga</span>
                            <span class="kalkulator__result-value kalkulator__result-value--total" id="resultTotal">-</span>
                        </div>
                    </div>
                    <a href="#kontak" class="btn btn--primary btn--lg kalkulator__cta">
                        ✨ Saya Tertarik — Hubungi Kami
                    </a>
                    <p class="kalkulator__note">* Harga dapat berubah sewaktu-waktu. Hubungi kami untuk konfirmasi.</p>
                </div>
            </form>
        </div>
    </div>
</section>
