<!-- Kontak Section -->
<section id="kontak" class="section kontak">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">📞 Hubungi Kami</span>
            <h2 class="section__title">Yuk, Rencanakan <span class="text-gradient">Liburanmu!</span></h2>
            <p class="section__desc">Kami siap membantu merencanakan perjalanan wisata bahari impianmu. Hubungi kami sekarang!</p>
        </div>

        <div class="kontak__grid">
            <!-- Contact Info -->
            <div class="kontak__info" data-animate="fade-up">
                <div class="kontak__info-card">
                    <div class="kontak__info-item">
                        <div class="kontak__info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="1.5" fill="none"/></svg>
                        </div>
                        <div>
                            <h4 class="kontak__info-label">Telepon / WhatsApp</h4>
                            <p class="kontak__info-value">+62 812-3456-7890</p>
                        </div>
                    </div>

                    <div class="kontak__info-item">
                        <div class="kontak__info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="1.5" fill="none"/><polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="1.5" fill="none"/></svg>
                        </div>
                        <div>
                            <h4 class="kontak__info-label">Email</h4>
                            <p class="kontak__info-value">info@wisatabahari.id</p>
                        </div>
                    </div>

                    <div class="kontak__info-item">
                        <div class="kontak__info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="currentColor" stroke-width="1.5" fill="none"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/></svg>
                        </div>
                        <div>
                            <h4 class="kontak__info-label">Kantor</h4>
                            <p class="kontak__info-value">Jl. Pantai Indah No. 88, Pelabuhan Ratu, Jawa Barat</p>
                        </div>
                    </div>

                    <div class="kontak__info-item">
                        <div class="kontak__info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" fill="none"/><polyline points="12,6 12,12 16,14" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/></svg>
                        </div>
                        <div>
                            <h4 class="kontak__info-label">Jam Operasional</h4>
                            <p class="kontak__info-value">Senin — Sabtu: 08:00 — 17:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="kontak__form-wrap" data-animate="fade-up" data-delay="200">
                <form class="kontak__form" id="kontakForm" aria-label="Formulir kontak">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" class="form-input" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-input" placeholder="email@contoh.com" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="form-label">No. WhatsApp</label>
                            <input type="tel" id="telepon" class="form-input" placeholder="0812xxxxxxxx" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="paketKontak" class="form-label">Paket yang Diminati</label>
                        <select id="paketKontak" class="form-select">
                            <option value="">— Pilih Paket —</option>
                            <?php foreach ($paket_wisata as $paket): ?>
                            <option value="<?= $paket['id'] ?>"><?= htmlspecialchars($paket['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pesan" class="form-label">Pesan</label>
                        <textarea id="pesan" class="form-input form-textarea" rows="4" placeholder="Tuliskan pertanyaan atau permintaan khusus..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary btn--lg kontak__submit">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M18 2L9 11M18 2l-5 16-4-7-7-4 16-5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
