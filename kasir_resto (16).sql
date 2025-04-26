-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 26 Apr 2025 pada 07.24
-- Versi server: 8.3.0
-- Versi PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_resto`
--

DELIMITER $$
--
-- Prosedur
--
DROP PROCEDURE IF EXISTS `income_bulan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `income_bulan` ()   BEGIN
SELECT DATE_FORMAT(created_at, '%Y-%m') AS bulan,
SUM(total) AS total FROM transaksi
GROUP BY bulan 
ORDER BY bulan desc;
END$$

DROP PROCEDURE IF EXISTS `income_monthly_by_year`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `income_monthly_by_year` (IN `i_tahun` INT)   BEGIN 
SELECT MONTH(created_at) AS month,
SUM(total) AS T_income FROM transaksi
WHERE YEAR(created_at) = i_tahun
GROUP BY MONTH(created_at)
ORDER BY bulan;
END$$

DROP PROCEDURE IF EXISTS `karyawan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `karyawan` ()   BEGIN 
SELECT nama FROM users;
end$$

DROP PROCEDURE IF EXISTS `meja`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `meja` ()   BEGIN
SELECT * FROM meja;
END$$

DROP PROCEDURE IF EXISTS `menu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `menu` ()   BEGIN
SELECT * FROM menu;
END$$

DROP PROCEDURE IF EXISTS `PendapatanHarian`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PendapatanHarian` (IN `i_bulan` VARCHAR(8), IN `i_minggu` INT)   BEGIN
    DECLARE start_date DATE;
    DECLARE end_date DATE;
    DECLARE first_of_month DATE;
    DECLARE last_of_month DATE;

    SET first_of_month = STR_TO_DATE(CONCAT(i_bulan, '-01'), '%Y-%m-%d');
    SET last_of_month = LAST_DAY(first_of_month);

    SET start_date = DATE_ADD(first_of_month, INTERVAL (i_minggu - 1) * 7 DAY);
    SET end_date = DATE_ADD(start_date, INTERVAL 6 DAY);

    IF end_date > last_of_month THEN
        SET end_date = last_of_month;
    END IF;

    SELECT 
        DATE_FORMAT(created_at, '%W') AS Hari,
        DATE(created_at) AS Tanggal,
        SUM(total) AS TotalPendapatan
    FROM transaksi
    WHERE created_at BETWEEN start_date AND end_date
    GROUP BY DATE(created_at), DATE_FORMAT(created_at, '%W')
    ORDER BY DATE(created_at);
END$$

DROP PROCEDURE IF EXISTS `tambah_pelanggan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_pelanggan` (IN `i_nama` VARCHAR(150), IN `i_jk` ENUM('laki-laki','perempuan'), IN `i_hp` VARCHAR(50), IN `i_alamat` VARCHAR(50))   BEGIN
    INSERT INTO pelanggan(Namapelanggan, Jeniskelamin, Nohp, alamat, created_at, updated_at)
    VALUES (i_nama, i_jk, i_hp, i_alamat, NOW(), NOW());
END$$

DROP PROCEDURE IF EXISTS `tambah_penjualan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_penjualan` (IN `i_id` BIGINT, IN `i_terjual` INT)   BEGIN
  UPDATE menu
  SET terjual = i_terjual WHERE idmenu = i_id;
  end$$

DROP PROCEDURE IF EXISTS `total_masuk`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_masuk` ()   BEGIN
SELECT sum(total) as total_masuk FROM transaksi;
end$$

DROP PROCEDURE IF EXISTS `total_meja`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_meja` ()   BEGIN
SELECT COUNT(id) AS t_meja FROM meja;
END$$

DROP PROCEDURE IF EXISTS `total_menu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_menu` ()   BEGIN
SELECT COUNT(idmenu) AS t_menu FROM menu;
end$$

DROP PROCEDURE IF EXISTS `total_pesanan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_pesanan` ()   BEGIN
SELECT COUNT(idpesanan) AS t_pesanan FROM pesanan;
END$$

DROP PROCEDURE IF EXISTS `total_transaksi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_transaksi` ()   BEGIN
SELECT COUNT(total) AS t_transaksi FROM transaksi;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb3_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `meja`
--

DROP TABLE IF EXISTS `meja`;
CREATE TABLE IF NOT EXISTS `meja` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `NoMeja` int NOT NULL,
  `status` enum('kosong','terpakai') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NoMeja` (`NoMeja`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data untuk tabel `meja`
--

INSERT INTO `meja` (`id`, `NoMeja`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'terpakai', '2025-02-22 07:57:26', '2025-04-25 05:32:16'),
(4, 2, 'kosong', '2025-02-22 11:19:58', '2025-04-16 18:49:57'),
(5, 3, 'terpakai', '2025-02-22 23:19:49', '2025-04-16 19:15:46'),
(6, 4, 'terpakai', '2025-02-22 23:20:04', '2025-04-25 05:26:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Namamenu` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`idmenu`, `Namamenu`, `Harga`, `created_at`, `updated_at`) VALUES
(3, 'Crevelles', 50000, '2025-03-27 08:38:04', '2025-03-27 08:38:04'),
(4, 'Surimi', 25000, '2025-03-27 08:43:03', '2025-03-27 08:43:03'),
(5, 'Special Sushi', 1000000, '2025-03-28 09:40:03', '2025-03-28 09:40:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_02_23_144358_add_column_to_transaksi', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `idpelanggan` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Namapelanggan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Jeniskelamin` enum('laki-laki','perempuan') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nohp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idpelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `Namapelanggan`, `Jeniskelamin`, `Nohp`, `alamat`, `created_at`, `updated_at`) VALUES
(8, 'bayu', 'laki-laki', '089576758904', 'tpu jeruk purut', '2025-03-28 09:38:20', '2025-03-28 09:38:20'),
(9, 'uli', 'laki-laki', '08987898878', 'jl.', '2025-03-30 21:17:29', '2025-03-30 21:17:29'),
(10, 'nabris pratama', 'laki-laki', '089576758904', 'jl.soekarno', '2025-04-16 17:01:35', '2025-04-16 17:01:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE IF NOT EXISTS `pesanan` (
  `idpesanan` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `idmenu` bigint UNSIGNED NOT NULL,
  `idpelanggan` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `iduser` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meja_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`idpesanan`),
  KEY `pesanan_idmenu_foreign` (`idmenu`),
  KEY `pesanan_idpelanggan_foreign` (`idpelanggan`),
  KEY `pesanan_iduser_foreign` (`iduser`),
  KEY `pesanan_meja_id_foreign` (`meja_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `idmenu`, `idpelanggan`, `jumlah`, `iduser`, `created_at`, `updated_at`, `meja_id`) VALUES
(31, 5, 9, 2, 2, '2025-04-16 19:15:46', '2025-04-16 19:15:46', 5),
(33, 3, 10, 3, 2, '2025-04-16 19:19:09', '2025-04-16 19:19:09', 6),
(34, 4, 8, 3, 2, '2025-04-25 05:26:06', '2025-04-25 05:26:06', 6),
(35, 5, 8, 2, 2, '2025-04-25 05:26:06', '2025-04-25 05:26:06', 6),
(36, 4, 8, 3, 2, '2025-04-25 05:26:30', '2025-04-25 05:26:30', 6),
(37, 5, 8, 2, 2, '2025-04-25 05:26:30', '2025-04-25 05:26:30', 6),
(38, 4, 9, 4, 2, '2025-04-25 05:29:29', '2025-04-25 05:29:29', 1),
(40, 4, 9, 4, 2, '2025-04-25 05:31:43', '2025-04-25 05:31:43', 1),
(41, 4, 9, 4, 2, '2025-04-25 05:32:16', '2025-04-25 05:32:16', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pqX1HuFwHMkWKI1rh4rCl3vha0B43X8NG8ZBIPlg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickU3YUhQaGR1T3ZvTTBsdklTMXNBMWNVSTFQdkdpbFVKSzhsbEpMeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXNhbmFuL3Nob3cvOSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745640759),
('TMFDxO2J1IKgjw5Bhu8jAF5hx3f2L7ubPN9p6zoy', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUo1OFlqRHRyTUJ3bGdzeE9XRXppUXFnbnFsaFA5NmtPWGU2SXhsYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXNhbmFuL3Nob3cvOCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1745645153),
('XJ0EsMxsLYmyR1a2fXhC9GNJxCdpkqRqP0ckF8yH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZThxZE9iU3ZkalB5UnFCalFyTW90SE5UeTBJZk1TcnRLOHh3eldkWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXNhbmFuL3Nob3cvOSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745640757);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `idtransaksi` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `idpelanggan` bigint UNSIGNED NOT NULL,
  `total` bigint NOT NULL,
  `bayar` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kembalian` bigint DEFAULT NULL,
  `Kurang` bigint DEFAULT NULL,
  PRIMARY KEY (`idtransaksi`),
  KEY `idpelanggan` (`idpelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `idpelanggan`, `total`, `bayar`, `created_at`, `updated_at`, `kembalian`, `Kurang`) VALUES
(60, 8, 1000, 24000000, '2025-03-15 18:38:52', '2025-04-16 18:38:52', 1000000, 0),
(61, 8, 23000000, 24000000, '2025-04-14 18:40:48', '2025-04-16 18:40:48', 1000000, 0),
(62, 10, 5000, 0, '2025-04-13 18:43:27', '2025-04-16 18:43:27', 1000, 0),
(63, 10, 25000, 26000, '2025-04-20 18:45:00', '2025-04-16 18:45:00', 1000, 0),
(64, 10, 120000, 300000, '2025-04-16 18:49:57', '2025-04-16 18:49:57', 180000, 0),
(65, 9, 4000000, 5000000, '2025-04-16 18:50:35', '2025-04-16 18:50:35', 1000000, 0),
(66, 8, 40000, 50000, '2025-04-19 18:54:39', '2025-04-16 18:54:39', 10000, 0),
(67, 10, 60000000, 2000000, '2025-02-11 19:01:27', '2025-04-16 19:01:27', 1000000, 0),
(68, 10, 175000, 200000, '2025-04-20 19:20:28', '2025-04-16 19:20:28', 25000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `iduser` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `level` enum('admin','waiter','kasir','owner') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`iduser`, `nama`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bayu', '$2y$12$VzPkMDk7sBe8xv8NSrhUeeOK6Hq2wSmxQousOq3424EkYiLGYV8yC', 'admin', NULL, NULL, NULL),
(2, 'Rere', '$2y$12$g9oJxrAqkqstL3lYKiP5u.ZSmkh1kpJqTBLzPwoi56I6ESy4v9srG', 'waiter', NULL, NULL, NULL),
(3, 'yuba', '$2y$12$.WVh0g07AgIgcTVrsGvnp.8SFsgAQjARLBUCX11oKaT1jodVZTe3q', 'kasir', NULL, NULL, NULL),
(4, 'johari', '$2y$12$2FsZZpYOw/YPIq.8xHy38uZwCdaSJobEbgTG8eNyIS1iqtLYTSEdm', 'owner', NULL, NULL, NULL);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_idmenu_foreign` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_idpelanggan_foreign` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_iduser_foreign` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_meja_id_foreign` FOREIGN KEY (`meja_id`) REFERENCES `meja` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
