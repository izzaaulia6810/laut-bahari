<?php
/**
 * Data paket wisata dan itinerary
 * File ini berisi semua data statis yang digunakan di website
 */

require_once __DIR__ . '/db.php';

// === PAKET WISATA ===
$paket_wisata = [
    [
        'id'       => 'hemat',
        'nama'     => 'Paket Hemat',
        'tagline'  => 'Cocok untuk rombongan besar',
        'harga'    => 185000,
        'durasi'   => '1 Hari',
        'icon'     => 'sun',
        'color'    => '#0ea5e9',
        'fitur'    => [
            'Transportasi PP',
            'Snorkeling dasar',
            'Makan siang 1x',
            'Air mineral',
            'Guide lokal',
            'P3K standar',
        ],
    ],
    [
        'id'       => 'favorit',
        'nama'     => 'Paket Favorit',
        'tagline'  => 'Paling banyak dipilih!',
        'harga'    => 350000,
        'durasi'   => '2 Hari 1 Malam',
        'icon'     => 'star',
        'color'    => '#f59e0b',
        'popular'  => true,
        'fitur'    => [
            'Transportasi PP',
            'Snorkeling + Banana Boat',
            'Penginapan 1 malam',
            'Makan 3x',
            'BBQ malam di pantai',
            'Dokumentasi foto',
            'Guide profesional',
            'Asuransi perjalanan',
        ],
    ],
    [
        'id'       => 'premium',
        'nama'     => 'Paket Premium',
        'tagline'  => 'Pengalaman VIP lengkap',
        'harga'    => 575000,
        'durasi'   => '3 Hari 2 Malam',
        'icon'     => 'diamond',
        'color'    => '#8b5cf6',
        'fitur'    => [
            'Transportasi VIP PP',
            'All watersport activities',
            'Resort tepi pantai',
            'Makan 5x + snack',
            'BBQ + api unggun',
            'Island hopping',
            'Dokumentasi drone',
            'Guide + medis',
            'Asuransi premium',
            'Souvenir eksklusif',
        ],
    ],
];

$default_paket_wisata = $paket_wisata;
$hasPackageTable = $pdo->query("SHOW TABLES LIKE 'packages'")->fetchColumn();
if ($hasPackageTable) {
    $packageRows = $pdo->query('SELECT id, nama, tagline, harga, durasi, icon, color, popular, fitur FROM packages ORDER BY sort_order, id')->fetchAll();
    if ($packageRows) {
        $paket_wisata = array_map(static function (array $package): array {
            $package['harga'] = (int) $package['harga'];
            $package['popular'] = (bool) $package['popular'];
            $package['fitur'] = json_decode($package['fitur'], true) ?: [];

            return $package;
        }, $packageRows);
    } elseif ($hasPackageTable) {
        $paket_wisata = [];
    }
}

// === ITINERARY ===
$itinerary = [
    'hemat' => [
        'nama' => 'Paket Hemat — 1 Hari',
        'hari' => [
            [
                'label' => 'Hari 1',
                'jadwal' => [
                    ['waktu' => '06:00', 'kegiatan' => 'Berkumpul & Berangkat', 'icon' => 'bus'],
                    ['waktu' => '08:30', 'kegiatan' => 'Tiba di Pantai & Briefing', 'icon' => 'flag'],
                    ['waktu' => '09:00', 'kegiatan' => 'Snorkeling & Bermain Air', 'icon' => 'wave'],
                    ['waktu' => '12:00', 'kegiatan' => 'Makan Siang Bersama', 'icon' => 'food'],
                    ['waktu' => '13:00', 'kegiatan' => 'Eksplorasi Pantai & Foto', 'icon' => 'camera'],
                    ['waktu' => '15:00', 'kegiatan' => 'Persiapan & Perjalanan Pulang', 'icon' => 'bus'],
                ],
            ],
        ],
    ],
    'favorit' => [
        'nama' => 'Paket Favorit — 2 Hari 1 Malam',
        'hari' => [
            [
                'label' => 'Hari 1',
                'jadwal' => [
                    ['waktu' => '06:00', 'kegiatan' => 'Berkumpul & Berangkat', 'icon' => 'bus'],
                    ['waktu' => '09:00', 'kegiatan' => 'Tiba & Check-in Penginapan', 'icon' => 'home'],
                    ['waktu' => '10:00', 'kegiatan' => 'Snorkeling & Banana Boat', 'icon' => 'wave'],
                    ['waktu' => '12:30', 'kegiatan' => 'Makan Siang', 'icon' => 'food'],
                    ['waktu' => '14:00', 'kegiatan' => 'Beach Games & Olahraga Pantai', 'icon' => 'games'],
                    ['waktu' => '17:00', 'kegiatan' => 'Sunset Viewing', 'icon' => 'sunset'],
                    ['waktu' => '19:00', 'kegiatan' => 'BBQ Dinner di Pantai', 'icon' => 'fire'],
                ],
            ],
            [
                'label' => 'Hari 2',
                'jadwal' => [
                    ['waktu' => '06:00', 'kegiatan' => 'Sunrise & Sarapan', 'icon' => 'sun'],
                    ['waktu' => '08:00', 'kegiatan' => 'Eksplorasi Pulau Kecil', 'icon' => 'island'],
                    ['waktu' => '11:00', 'kegiatan' => 'Free Time & Foto-foto', 'icon' => 'camera'],
                    ['waktu' => '12:00', 'kegiatan' => 'Makan Siang & Check-out', 'icon' => 'food'],
                    ['waktu' => '13:30', 'kegiatan' => 'Perjalanan Pulang', 'icon' => 'bus'],
                ],
            ],
        ],
    ],
    'premium' => [
        'nama' => 'Paket Premium — 3 Hari 2 Malam',
        'hari' => [
            [
                'label' => 'Hari 1',
                'jadwal' => [
                    ['waktu' => '06:00', 'kegiatan' => 'Berkumpul & Berangkat VIP', 'icon' => 'bus'],
                    ['waktu' => '09:00', 'kegiatan' => 'Welcome Drink & Check-in Resort', 'icon' => 'home'],
                    ['waktu' => '10:30', 'kegiatan' => 'Full Watersport Activities', 'icon' => 'wave'],
                    ['waktu' => '13:00', 'kegiatan' => 'Lunch di Restoran Tepi Pantai', 'icon' => 'food'],
                    ['waktu' => '15:00', 'kegiatan' => 'Diving Introduction', 'icon' => 'diving'],
                    ['waktu' => '18:00', 'kegiatan' => 'Sunset Cruise', 'icon' => 'sunset'],
                    ['waktu' => '19:30', 'kegiatan' => 'Gala BBQ Dinner', 'icon' => 'fire'],
                ],
            ],
            [
                'label' => 'Hari 2',
                'jadwal' => [
                    ['waktu' => '06:00', 'kegiatan' => 'Yoga Pagi di Pantai', 'icon' => 'sun'],
                    ['waktu' => '07:30', 'kegiatan' => 'Sarapan di Resort', 'icon' => 'food'],
                    ['waktu' => '09:00', 'kegiatan' => 'Island Hopping 3 Pulau', 'icon' => 'island'],
                    ['waktu' => '12:30', 'kegiatan' => 'Lunch di Pulau Tersembunyi', 'icon' => 'food'],
                    ['waktu' => '14:00', 'kegiatan' => 'Snorkeling Spot Rahasia', 'icon' => 'wave'],
                    ['waktu' => '17:00', 'kegiatan' => 'Kembali ke Resort', 'icon' => 'home'],
                    ['waktu' => '19:00', 'kegiatan' => 'Api Unggun & Live Music', 'icon' => 'fire'],
                ],
            ],
            [
                'label' => 'Hari 3',
                'jadwal' => [
                    ['waktu' => '06:30', 'kegiatan' => 'Sunrise Photography', 'icon' => 'camera'],
                    ['waktu' => '08:00', 'kegiatan' => 'Sarapan & Packing', 'icon' => 'food'],
                    ['waktu' => '09:30', 'kegiatan' => 'Belanja Souvenir Lokal', 'icon' => 'gift'],
                    ['waktu' => '11:00', 'kegiatan' => 'Foto Drone & Farewell', 'icon' => 'camera'],
                    ['waktu' => '12:00', 'kegiatan' => 'Check-out & Perjalanan Pulang', 'icon' => 'bus'],
                ],
            ],
        ],
    ],
];

// === KEUNGGULAN ===
$keunggulan = [
    [
        'icon'  => 'shield',
        'title' => 'Aman & Terpercaya',
        'desc'  => 'Dilengkapi asuransi, guide berpengalaman, dan peralatan safety standar internasional.',
    ],
    [
        'icon'  => 'smile',
        'title' => 'Ramah Keluarga',
        'desc'  => 'Aktivitas dirancang untuk semua usia, dari anak-anak hingga orang tua.',
    ],
    [
        'icon'  => 'wallet',
        'title' => 'Harga Transparan',
        'desc'  => 'Tidak ada biaya tersembunyi. Harga sudah termasuk semua fasilitas.',
    ],
    [
        'icon'  => 'group',
        'title' => 'Paket Rombongan',
        'desc'  => 'Diskon spesial untuk rombongan sekolah mulai dari 20 orang.',
    ],
];

// === GALERI ===
$galeri = [
    ['title' => 'Snorkeling di Terumbu Karang', 'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?fit=crop&w=1200&q=82&fm=jpg', 'color' => '#0ea5e9'],
    ['title' => 'Bermain di Pasir Putih', 'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?fit=crop&w=1200&q=82&fm=jpg', 'color' => '#f59e0b'],
    ['title' => 'Sunset di Dermaga', 'image' => 'https://images.unsplash.com/photo-1473116763249-2faaef81ccda?fit=crop&w=1200&q=82&fm=jpg', 'color' => '#f97316'],
    ['title' => 'BBQ Malam di Pantai', 'image' => 'https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?fit=crop&w=1200&q=82&fm=jpg', 'color' => '#ef4444'],
    ['title' => 'Island Hopping', 'image' => 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?fit=crop&w=1200&q=82&fm=jpg', 'color' => '#10b981'],
    ['title' => 'Banana Boat Seru', 'image' => 'https://images.unsplash.com/photo-1518837695005-2083093ee35b?fit=crop&w=1200&q=82&fm=jpg', 'color' => '#8b5cf6'],
];
