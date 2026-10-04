CREATE DATABASE IF NOT EXISTS laut_bahari
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE laut_bahari;

CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY users_email_unique (email),
    KEY users_role_index (role)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS packages (
    id VARCHAR(60) NOT NULL,
    nama VARCHAR(120) NOT NULL,
    tagline VARCHAR(255) NOT NULL,
    harga INT UNSIGNED NOT NULL,
    durasi VARCHAR(80) NOT NULL,
    icon VARCHAR(40) NOT NULL DEFAULT 'sun',
    color CHAR(7) NOT NULL DEFAULT '#0ea5e9',
    popular TINYINT(1) NOT NULL DEFAULT 0,
    fitur JSON NOT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY packages_order_index (sort_order)
) ENGINE=InnoDB;

INSERT IGNORE INTO packages (id, nama, tagline, harga, durasi, icon, color, popular, fitur, sort_order) VALUES
('hemat', 'Paket Hemat', 'Cocok untuk rombongan besar', 185000, '1 Hari', 'sun', '#0ea5e9', 0, JSON_ARRAY('Transportasi PP', 'Snorkeling dasar', 'Makan siang 1x', 'Air mineral', 'Guide lokal', 'P3K standar'), 1),
('favorit', 'Paket Favorit', 'Paling banyak dipilih!', 350000, '2 Hari 1 Malam', 'star', '#f59e0b', 1, JSON_ARRAY('Transportasi PP', 'Snorkeling + Banana Boat', 'Penginapan 1 malam', 'Makan 3x', 'BBQ malam di pantai', 'Dokumentasi foto', 'Guide profesional', 'Asuransi perjalanan'), 2),
('premium', 'Paket Premium', 'Pengalaman VIP lengkap', 575000, '3 Hari 2 Malam', 'diamond', '#8b5cf6', 0, JSON_ARRAY('Transportasi VIP PP', 'All watersport activities', 'Resort tepi pantai', 'Makan 5x + snack', 'BBQ + api unggun', 'Island hopping', 'Dokumentasi drone', 'Guide + medis', 'Asuransi premium', 'Souvenir eksklusif'), 3);