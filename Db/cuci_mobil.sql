-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2026 at 01:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuci_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED DEFAULT NULL,
  `nama_pemilik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_plat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kendaraan_id` bigint UNSIGNED NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `member_id`, `nama_pemilik`, `no_plat`, `tipe_kendaraan_id`, `merk`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 15, 'Andi', 'B 1234 CD', 2, 'Mitsubishi', '0987-1234-1325', NULL, '2026-01-15 02:26:21'),
(5, 5, 'Ridho', 'B 4351 L', 2, 'Ferrari sf90', '0819-9999-2222', '2025-12-26 21:31:25', '2026-01-12 01:15:13'),
(6, 7, 'Galih', 'SS 12T4 BR', 1, 'Kawasaki ZX 25 R', '0819-2334-2627', '2026-01-02 12:00:18', '2026-01-12 01:16:10'),
(10, 3, 'Gabriel', 'J 1 RR', 2, 'Ferrari F1', '0928-2736-2826', '2026-01-03 05:34:48', '2026-01-11 08:27:27'),
(11, 12, 'Mr Owen', 'AA 34E C', 13, 'Mitsubishi Fuso', '0818-1217-2273', '2026-01-03 10:50:44', '2026-01-13 00:05:21'),
(24, 6, 'Ahmad hafidz Maulana', 'P 65GT RR', 6, 'Telolet', '0819-1212-2345', '2026-01-05 00:36:43', '2026-01-12 02:44:41'),
(27, NULL, 'Bayu Saputra', 'SS 3576 RR', 2, 'Toyota Supra mk 5', '0812-2183-2382', '2026-01-05 06:32:39', '2026-01-15 02:26:07'),
(28, 4, 'Riko Anwar', 'G 5675 TT', 2, 'canter', '0916-1272-2828', '2026-01-05 06:37:22', '2026-01-12 01:10:42'),
(29, 16, 'Pak Danang', 'SS 3442 R', 2, 'Toyota Supra mk5', '1212-2323-2122', '2026-01-08 07:11:50', '2026-01-19 00:45:44'),
(33, NULL, 'Yuliance', 'FG 4567 JJ', 1, 'Honda Vario 160', '0978-3543-4344', '2026-01-11 07:24:11', '2026-01-12 01:14:55'),
(34, 6, 'Ahmad hafidz', 'GG 4567 RR', 2, 'Ferrari', '0819-1212-2345', '2026-01-12 01:17:35', '2026-01-12 01:17:35'),
(35, 8, 'Mikael', 'M 6765 TT', 1, 'Kawasaki ZX 25 R', '0892-2822-2832', '2026-01-12 02:43:16', '2026-01-12 02:43:16'),
(36, 9, 'M.Nizam Abidin', 'GH 5678 YY', 2, 'Innova Reborn', '0867-6655-8768', '2026-01-12 02:45:55', '2026-01-12 02:45:55'),
(37, 10, 'M.Rizqi Pratama Aryadi', 'S 6676 YT', 2, 'Pajero Sport', '0817-3286-7362', '2026-01-12 23:57:00', '2026-01-12 23:57:00'),
(38, 5, 'Ridho', 'R 5689 TR', 2, 'Ferarri F1', '0819-9999-2222', '2026-01-12 23:59:57', '2026-01-12 23:59:57'),
(39, 13, 'Grinida', 'S5676 HV', 1, 'Honda Beat Street', '0819-2737-2868', '2026-01-14 01:32:32', '2026-01-14 01:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_member` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_member` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `kode_member`, `nama_member`, `telepon`, `created_at`, `updated_at`) VALUES
(3, 'MBR260111368', 'Gabriel', '0928-2736-2826', '2026-01-11 08:27:27', '2026-01-11 08:27:27'),
(4, 'MBR260112556', 'Riko Anwar', '0916-1272-2828', '2026-01-12 01:10:41', '2026-01-12 01:10:41'),
(5, 'MBR260112383', 'Ridho', '0819-9999-2222', '2026-01-12 01:15:13', '2026-01-12 01:15:13'),
(6, 'MBR260112220', 'Ahmad hafidz Maulana', '0819-1212-2345', '2026-01-12 01:15:40', '2026-01-12 02:44:17'),
(7, 'MBR260112963', 'Galih', '0819-2334-2627', '2026-01-12 01:16:10', '2026-01-12 01:16:10'),
(8, 'MBR-ARXMYH', 'Mikael', '0892-2822-2832', '2026-01-12 02:43:16', '2026-01-12 02:43:16'),
(9, 'MBR-DUQCWG', 'M.Nizam Abidin', '0867-6655-8768', '2026-01-12 02:45:55', '2026-01-12 02:45:55'),
(10, 'MBR-O9JJGI', 'M.Rizqi Pratama Aryadi', '0817-3286-7362', '2026-01-12 23:57:00', '2026-01-12 23:57:00'),
(12, 'MBR260113890', 'Mr Owen', '0818-1217-2273', '2026-01-13 00:05:21', '2026-01-13 00:05:21'),
(13, 'MBR-ORHLB3', 'Grinida', '0819-2737-2868', '2026-01-14 01:32:32', '2026-01-14 01:32:32'),
(15, 'MBR260115203', 'Andi', '0987-1234-1325', '2026-01-15 02:26:21', '2026-01-15 02:26:21'),
(16, 'MBR260119431', 'Pak Danang', '1212-2323-2122', '2026-01-19 00:45:44', '2026-01-19 00:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_20_070842_create_tipe_kendaraans_table', 1),
(5, '2025_11_20_070850_create_paket_cucis_table', 1),
(6, '2025_11_20_070905_create_paket_hargas_table', 1),
(7, '2025_11_20_070927_create_kendaraans_table', 1),
(8, '2025_11_20_070941_create_transaksis_table', 1),
(9, '2025_11_20_070950_create_transaksi_items_table', 1),
(10, '2025_12_07_031719_add_role_to_users_table', 1),
(11, '2025_11_20_070850_create_paket_cuci_table', 1),
(12, '2026_01_02_190803_add_pembayaran_to_transaksi_table', 2),
(17, '2026_01_09_091428_create_members_table', 3),
(18, '2026_01_09_091541_add_member_id_to_kendaraans_table', 4),
(19, '2026_01_11_141001_add_kode_member_to_members', 5),
(20, '2026_01_13_113529_create_paket_tambahan_table', 6),
(21, '2026_01_13_113607_create_transaksi_tambahan_table', 999);

-- --------------------------------------------------------

--
-- Table structure for table `paket_cuci`
--

CREATE TABLE `paket_cuci` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_paket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_cuci`
--

INSERT INTO `paket_cuci` (`id`, `nama_paket`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Paket Basic Wash', 'Cuci bagian luar kendaraan menggunakan sampo khusus, bilas, dan pengeringan manual.\r\nCocok untuk kendaraan yang hanya kotor ringan.', NULL, '2026-01-13 00:23:45'),
(2, 'Paket Clean & Shine', 'Cuci luar + semprot ban, pembersihan kaca, dan pengeringan halus agar tampilan lebih mengkilap.', NULL, '2026-01-13 00:24:06'),
(6, 'Paket Interior & Exterior', 'Cuci luar kendaraan sekaligus pembersihan bagian dalam seperti karpet, jok, dashboard, dan vacuum.', '2025-12-06 20:22:51', '2026-01-13 00:24:23'),
(7, 'Paket Premium Detailing', 'Perawatan menyeluruh mulai dari cuci, pembersihan interior detail, semir ban, wax body, dan pengharum kabin.', '2025-12-08 02:47:56', '2026-01-13 00:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `paket_harga`
--

CREATE TABLE `paket_harga` (
  `id` bigint UNSIGNED NOT NULL,
  `paket_cuci_id` bigint UNSIGNED NOT NULL,
  `tipe_kendaraan_id` bigint UNSIGNED NOT NULL,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_harga`
--

INSERT INTO `paket_harga` (`id`, `paket_cuci_id`, `tipe_kendaraan_id`, `harga`, `created_at`, `updated_at`) VALUES
(13, 1, 1, 10000, '2025-12-15 21:27:32', '2025-12-15 21:27:32'),
(14, 2, 1, 15000, '2025-12-15 21:27:59', '2025-12-15 21:27:59'),
(15, 6, 1, 20000, '2025-12-15 21:28:14', '2025-12-15 21:28:14'),
(17, 7, 1, 30000, '2025-12-26 21:52:21', '2025-12-26 21:52:35'),
(18, 1, 2, 15000, '2026-01-02 04:16:27', '2026-01-02 04:17:37'),
(19, 2, 2, 20000, '2026-01-02 04:17:25', '2026-01-02 04:17:25'),
(20, 6, 2, 25000, '2026-01-02 04:17:59', '2026-01-02 04:17:59'),
(21, 7, 2, 35000, '2026-01-02 04:18:12', '2026-01-02 04:18:12'),
(22, 1, 6, 30000, '2026-01-03 03:01:46', '2026-01-03 03:01:46'),
(23, 2, 6, 50000, '2026-01-03 03:01:58', '2026-01-03 03:01:58'),
(24, 6, 6, 70000, '2026-01-03 03:02:10', '2026-01-03 03:02:10'),
(25, 7, 6, 100000, '2026-01-03 03:02:22', '2026-01-03 03:02:22'),
(28, 1, 13, 100000, '2026-01-03 10:47:46', '2026-01-03 10:47:46'),
(29, 2, 13, 150000, '2026-01-03 10:48:02', '2026-01-03 10:48:02'),
(30, 6, 13, 200000, '2026-01-03 10:48:18', '2026-01-03 10:48:18'),
(31, 7, 13, 250000, '2026-01-03 10:48:28', '2026-01-03 10:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `paket_tambahan`
--

CREATE TABLE `paket_tambahan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_tambahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_tambahan`
--

INSERT INTO `paket_tambahan` (`id`, `nama_tambahan`, `deskripsi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Poles Body', 'Mengkilapkan bodi kendaraan, menghilangkan kusam ringan dan membuat cat terlihat lebih cerah dan halus.', 50000, '2026-01-13 06:08:19', '2026-01-13 06:15:21'),
(2, 'Wax Protection', 'Memberikan lapisan pelindung pada cat kendaraan agar lebih mengkilap, tahan air, dan debu tidak mudah menempel.', 100000, '2026-01-13 06:11:28', '2026-01-13 06:11:28'),
(3, 'Fogging Interior', 'Menghilangkan bau tidak sedap, bakteri, dan jamur di dalam kabin menggunakan cairan khusus.', 150000, '2026-01-13 06:12:02', '2026-01-13 06:12:02'),
(4, 'Cuci Mesin', 'Membersihkan ruang mesin dari debu, oli, dan kotoran agar terlihat rapi dan lebih awet.', 200000, '2026-01-13 06:12:34', '2026-01-13 06:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ubicyK00tGLG0PXRaqTnfu8J0gl6uoeLXcxNjY6Q', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYjdQdldrQWFReldMeVhlQTZYbnNHRmhwemNGczdLejNEWFpnb1QwdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sYXBvcmFuL3ByaW50P2Rhcmk9MjAyNi0wMS0wMSZzYW1wYWk9MjAyNi0wMS0xOSI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4ubGFwb3Jhbi5wcmludCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1768785096);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kendaraan`
--

CREATE TABLE `tipe_kendaraan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipe_kendaraan`
--

INSERT INTO `tipe_kendaraan` (`id`, `nama_tipe`, `created_at`, `updated_at`) VALUES
(1, 'Motor', NULL, NULL),
(2, 'Mobil', NULL, '2025-12-06 23:44:32'),
(6, 'Bus', '2025-12-06 20:22:51', '2026-01-03 04:22:10'),
(13, 'Truck', '2026-01-03 05:32:26', '2026-01-03 05:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kendaraan_id` bigint UNSIGNED DEFAULT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_polisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_kendaraan_id` bigint UNSIGNED NOT NULL,
  `total_harga` int NOT NULL DEFAULT '0',
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bayar` int DEFAULT NULL,
  `kembalian` int DEFAULT NULL,
  `waktu_transaksi` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `kendaraan_id`, `nama_pelanggan`, `no_polisi`, `tipe_kendaraan_id`, `total_harga`, `metode_pembayaran`, `bayar`, `kembalian`, `waktu_transaksi`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Andi', 'B 1234 CD', 2, 10000, '', NULL, NULL, NULL, '2025-12-15 22:00:39', '2025-12-15 22:00:39'),
(5, 3, 5, 'Ridho', 'B 4351 L', 2, 35000, '', NULL, NULL, NULL, '2026-01-02 04:30:52', '2026-01-02 04:30:52'),
(6, 3, 5, 'Ridho', 'B 4351 L', 2, 25000, '', NULL, NULL, NULL, '2026-01-02 04:49:16', '2026-01-02 04:49:16'),
(7, 3, 1, 'Andi', 'B 1234 CD', 2, 15000, '', NULL, NULL, NULL, '2026-01-02 04:55:24', '2026-01-02 04:55:24'),
(8, 3, 6, 'Galih', 'SS 12T4 BR', 1, 20000, '', NULL, NULL, NULL, '2026-01-02 12:01:29', '2026-01-02 12:01:29'),
(9, 3, 6, 'Galih', 'SS 12T4 BR', 1, 20000, '', NULL, NULL, NULL, '2026-01-02 12:02:18', '2026-01-02 12:02:18'),
(10, 3, 6, 'Galih', 'SS 12T4 BR', 1, 20000, '', NULL, NULL, NULL, '2026-01-02 12:03:56', '2026-01-02 12:03:56'),
(11, 3, 6, 'Galih', 'SS 12T4 BR', 1, 30000, 'cash', 30000, 0, '2026-01-02 12:26:03', '2026-01-02 12:26:03', '2026-01-02 12:26:03'),
(12, 3, 5, 'Ridho', 'B 4351 L', 2, 20000, 'cash', 25000, 5000, '2026-01-02 12:26:35', '2026-01-02 12:26:35', '2026-01-02 12:26:35'),
(13, 3, 5, 'Ridho', 'B 4351 L', 2, 20000, 'cash', 50000, 30000, '2026-01-02 12:27:28', '2026-01-02 12:27:28', '2026-01-02 12:27:28'),
(14, 3, 5, 'Ridho', 'B 4351 L', 2, 20000, 'cash', 20000, 0, '2026-01-02 14:15:34', '2026-01-02 14:15:34', '2026-01-02 14:15:34'),
(15, 3, 5, 'Ridho', 'B 4351 L', 2, 20000, 'cash', 20000, 0, '2026-01-02 14:43:42', '2026-01-02 14:43:42', '2026-01-02 14:43:42'),
(16, 3, 5, 'Ridho', 'B 4351 L', 2, 20000, 'cash', 20000, 0, '2026-01-02 14:44:09', '2026-01-02 14:44:09', '2026-01-02 14:44:09'),
(17, 3, 5, 'Ridho', 'B 4351 L', 2, 20000, 'cash', 20000, 0, '2026-01-02 14:44:25', '2026-01-02 14:44:25', '2026-01-02 14:44:25'),
(18, 3, 5, 'Ridho', 'B 4351 L', 2, 25000, 'cash', 30000, 5000, '2026-01-03 02:58:49', '2026-01-03 02:58:49', '2026-01-03 02:58:49'),
(19, 3, 5, 'Ridho', 'B 4351 L', 2, 25000, 'cash', 30000, 5000, '2026-01-03 03:00:07', '2026-01-03 03:00:07', '2026-01-03 03:00:07'),
(20, 3, NULL, 'Joko', 'R 16R4 TT', 6, 100000, 'transfer', 0, 0, '2026-01-03 03:04:14', '2026-01-03 03:04:14', '2026-01-03 03:04:14'),
(21, 3, NULL, 'Aulia', 'AS 1E3A SS', 1, 30000, 'transfer', 0, 0, '2026-01-03 04:43:27', '2026-01-03 04:43:27', '2026-01-03 04:43:27'),
(22, 3, 10, 'Gabriel', 'J 1 RR', 2, 35000, 'cash', 40000, 5000, '2026-01-03 05:35:20', '2026-01-03 05:35:20', '2026-01-03 05:35:20'),
(23, 2, 10, 'Gabriel', 'J 1 RR', 2, 15000, 'cash', 20000, 5000, '2026-01-03 08:45:41', '2026-01-03 08:45:41', '2026-01-03 08:45:41'),
(24, 2, 10, 'Gabriel', 'J 1 RR', 2, 20000, 'transfer', 0, 0, '2026-01-03 10:45:30', '2026-01-03 10:45:30', '2026-01-03 10:45:30'),
(25, 9, 11, 'Mr Owen', 'AA 34E C', 13, 250000, 'transfer', 0, 0, '2026-01-03 11:22:57', '2026-01-03 11:22:57', '2026-01-03 11:22:57'),
(26, 2, 11, 'Mr Owen', 'AA 34E C', 13, 200000, 'cash', 200000, 0, '2026-01-03 11:26:26', '2026-01-03 11:26:26', '2026-01-03 11:26:26'),
(27, 2, 10, 'Gabriel', 'J 1 RR', 2, 15000, 'transfer', 0, 0, '2026-01-04 04:38:35', '2026-01-04 04:38:35', '2026-01-04 04:38:35'),
(28, 9, 6, 'Galih', 'SS 12T4 BR', 1, 10000, 'transfer', 0, 0, '2026-01-04 04:44:43', '2026-01-04 04:44:43', '2026-01-04 04:44:43'),
(29, 2, NULL, 'Achmad Ridho', 'R 1DH0 K', 2, 35000, 'transfer', 0, 0, '2026-01-04 05:59:54', '2026-01-04 05:59:54', '2026-01-04 05:59:54'),
(30, 2, NULL, 'Achmad Ridho', 'R 1DH0 K', 2, 35000, 'transfer', 0, 0, '2026-01-04 06:02:38', '2026-01-04 06:02:38', '2026-01-04 06:02:38'),
(31, 9, NULL, 'Achmad Ridho', 'R 1DH0 K', 2, 25000, 'transfer', 0, 0, '2026-01-04 06:04:25', '2026-01-04 06:04:25', '2026-01-04 06:04:25'),
(32, 2, 24, 'Ahmad hafidz', 'P 65GT RR', 6, 100000, 'transfer', 0, 0, '2026-01-05 00:38:22', '2026-01-05 00:38:22', '2026-01-05 00:38:22'),
(33, 9, NULL, 'Galih', 'F RYYF T', 1, 30000, 'transfer', 0, 0, '2026-01-05 02:22:05', '2026-01-05 02:22:05', '2026-01-05 02:22:05'),
(34, 9, NULL, 'Galih', 'SS 567 T', 1, 10000, 'transfer', 0, 0, '2026-01-05 02:38:40', '2026-01-05 02:38:40', '2026-01-05 02:38:40'),
(35, 9, 6, 'Galih', 'SS 12T4 BR', 1, 30000, 'transfer', 0, 0, '2026-01-05 02:39:04', '2026-01-05 02:39:04', '2026-01-05 02:39:04'),
(36, 9, 27, 'Bayu Saputra', 'SS 3576 RR', 2, 35000, 'cash', 35000, 0, '2026-01-05 06:34:33', '2026-01-05 06:34:33', '2026-01-05 06:34:33'),
(37, 2, 28, 'Riko Anwar', 'G 5675 TT', 2, 20000, 'cash', 50000, 30000, '2026-01-05 06:38:19', '2026-01-05 06:38:19', '2026-01-05 06:38:19'),
(38, 2, 10, 'Gabriel', 'J 1 RR', 2, 20000, 'transfer', 0, 0, '2026-01-07 05:57:35', '2026-01-07 05:57:35', '2026-01-07 05:57:35'),
(39, 9, 29, 'Pak Danang', 'SS 3442 R', 2, 15000, 'transfer', 0, 0, '2026-01-08 07:16:54', '2026-01-08 07:16:54', '2026-01-08 07:16:54'),
(40, 2, 5, 'Ridho', 'B 4351 L', 2, 25000, 'cash', 30000, 5000, '2026-01-12 04:50:19', '2026-01-12 04:50:19', '2026-01-12 04:50:19'),
(41, 9, 28, 'Riko Anwar', 'G 5675 TT', 2, 35000, 'transfer', 0, 0, '2026-01-12 04:57:12', '2026-01-12 04:57:12', '2026-01-12 04:57:12'),
(42, 9, 6, 'Galih', 'SS 12T4 BR', 1, 30000, 'transfer', 0, 0, '2026-01-12 04:57:37', '2026-01-12 04:57:37', '2026-01-12 04:57:37'),
(43, 9, 24, 'Ahmad hafidz Maulana', 'P 65GT RR', 6, 100000, 'transfer', 0, 0, '2026-01-12 05:13:57', '2026-01-12 05:13:57', '2026-01-12 05:13:57'),
(44, 9, 24, 'Ahmad hafidz Maulana', 'P 65GT RR', 6, 100000, 'transfer', 0, 0, '2026-01-12 05:16:21', '2026-01-12 05:16:21', '2026-01-12 05:16:21'),
(45, 9, 24, 'Ahmad hafidz Maulana', 'P 65GT RR', 6, 100000, 'transfer', 0, 0, '2026-01-12 05:20:05', '2026-01-12 05:20:05', '2026-01-12 05:20:05'),
(46, 9, 24, 'Ahmad hafidz Maulana', 'P 65GT RR', 6, 100000, 'transfer', 0, 0, '2026-01-12 05:20:30', '2026-01-12 05:20:30', '2026-01-12 05:20:30'),
(47, 9, 24, 'Ahmad hafidz Maulana', 'P 65GT RR', 6, 100000, 'transfer', 0, 0, '2026-01-12 05:21:05', '2026-01-12 05:21:05', '2026-01-12 05:21:05'),
(48, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 20000, 'transfer', 0, 0, '2026-01-12 07:24:58', '2026-01-12 07:24:58', '2026-01-12 07:24:58'),
(49, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 20000, 'transfer', 0, 0, '2026-01-12 07:28:43', '2026-01-12 07:28:43', '2026-01-12 07:28:43'),
(50, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 20000, 'transfer', 0, 0, '2026-01-12 07:29:17', '2026-01-12 07:29:17', '2026-01-12 07:29:17'),
(51, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 20000, 'transfer', 0, 0, '2026-01-12 07:29:43', '2026-01-12 07:29:43', '2026-01-12 07:29:43'),
(52, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 20000, 'transfer', 0, 0, '2026-01-12 07:30:04', '2026-01-12 07:30:04', '2026-01-12 07:30:04'),
(53, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 20000, 'transfer', 0, 0, '2026-01-12 07:30:31', '2026-01-12 07:30:31', '2026-01-12 07:30:31'),
(54, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 20000, 'transfer', 0, 0, '2026-01-12 07:31:38', '2026-01-12 07:31:38', '2026-01-12 07:31:38'),
(55, 9, 35, 'Mikael', 'M 6765 TT', 1, 20000, 'transfer', 0, 0, '2026-01-12 07:32:41', '2026-01-12 07:32:41', '2026-01-12 07:32:41'),
(56, 9, 35, 'Mikael', 'M 6765 TT', 1, 20000, 'transfer', 0, 0, '2026-01-12 07:38:44', '2026-01-12 07:38:44', '2026-01-12 07:38:44'),
(57, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 20000, 'transfer', 0, 0, '2026-01-12 07:44:21', '2026-01-12 07:44:21', '2026-01-12 07:44:21'),
(58, 9, 5, 'Ridho', 'B 4351 L', 2, 35000, 'cash', 350000, 315000, '2026-01-12 07:44:48', '2026-01-12 07:44:48', '2026-01-12 07:44:48'),
(59, 2, 37, 'M.Rizqi Pratama Aryadi', 'S 6676 YT', 2, 25000, 'transfer', 0, 0, '2026-01-12 23:57:29', '2026-01-12 23:57:29', '2026-01-12 23:57:29'),
(60, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 35000, 'transfer', 0, 0, '2026-01-13 00:08:35', '2026-01-13 00:08:35', '2026-01-13 00:08:35'),
(62, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 70000, 'cash', 70000, 0, '2026-01-13 08:05:11', '2026-01-13 08:05:11', '2026-01-13 08:05:11'),
(63, 9, 5, 'Ridho', 'B 4351 L', 2, 35000, 'transfer', NULL, NULL, '2026-01-13 08:09:33', '2026-01-13 08:09:33', '2026-01-13 08:09:33'),
(64, 9, 37, 'M.Rizqi Pratama Aryadi', 'S 6676 YT', 2, 125000, 'cash', 125000, 0, '2026-01-13 08:10:18', '2026-01-13 08:10:18', '2026-01-13 08:10:18'),
(65, 2, 38, 'Ridho', 'R 5689 TR', 2, 220000, 'cash', 220000, 0, '2026-01-14 00:26:00', '2026-01-14 00:26:00', '2026-01-14 00:26:00'),
(66, 2, 5, 'Ridho', 'B 4351 L', 2, 175000, 'cash', 200000, 25000, '2026-01-14 00:26:35', '2026-01-14 00:26:35', '2026-01-14 00:26:35'),
(67, 2, 24, 'Ahmad hafidz Maulana', 'P 65GT RR', 6, 150000, 'cash', 150000, 0, '2026-01-14 01:15:29', '2026-01-14 01:15:29', '2026-01-14 01:15:29'),
(68, 2, 10, 'Gabriel', 'J 1 RR', 2, 185000, 'cash', 20000, 0, '2026-01-14 01:31:01', '2026-01-14 01:31:01', '2026-01-14 01:31:01'),
(69, 2, 39, 'Grinida', 'S5676 HV', 1, 230000, 'transfer', NULL, NULL, '2026-01-14 01:33:25', '2026-01-14 01:33:25', '2026-01-14 01:33:25'),
(70, 9, 34, 'Ahmad hafidz Maulana', 'GG 4567 RR', 2, 75000, 'transfer', NULL, NULL, '2026-01-15 02:03:28', '2026-01-15 02:03:28', '2026-01-15 02:03:28'),
(71, 2, 5, 'Ridho', 'B 4351 L', 2, 220000, 'transfer', NULL, NULL, '2026-01-15 02:21:19', '2026-01-15 02:21:19', '2026-01-15 02:21:19'),
(72, 9, 6, 'Galih', 'SS 12T4 BR', 1, 80000, 'transfer', NULL, NULL, '2026-01-17 11:56:22', '2026-01-17 11:56:22', '2026-01-17 11:56:22'),
(73, 9, 10, 'Gabriel', 'J 1 RR', 2, 135000, 'cash', 0, 0, '2026-01-17 12:05:22', '2026-01-17 12:05:22', '2026-01-17 12:05:22'),
(74, 9, 37, 'M.Rizqi Pratama Aryadi', 'S 6676 YT', 2, 220000, 'transfer', NULL, NULL, '2026-01-17 12:10:07', '2026-01-17 12:10:07', '2026-01-17 12:10:07'),
(75, 9, 29, 'Pak Danang', 'SS 3442 R', 2, 65000, 'cash', 65000, 0, '2026-01-19 00:46:23', '2026-01-19 00:46:23', '2026-01-19 00:46:23'),
(76, 9, 29, 'Pak Danang', 'SS 3442 R', 2, 70000, 'cash', 100000, 30000, '2026-01-19 00:56:22', '2026-01-19 00:56:22', '2026-01-19 00:56:22'),
(77, 9, 29, 'Pak Danang', 'SS 3442 R', 2, 225000, 'cash', 250000, 25000, '2026-01-19 01:07:00', '2026-01-19 01:07:00', '2026-01-19 01:07:00'),
(78, 9, 29, 'Pak Danang', 'SS 3442 R', 2, 65000, 'cash', 65000, 0, '2026-01-19 01:11:07', '2026-01-19 01:11:07', '2026-01-19 01:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_item`
--

CREATE TABLE `transaksi_item` (
  `id` bigint UNSIGNED NOT NULL,
  `transaksi_id` bigint UNSIGNED NOT NULL,
  `paket_harga_id` bigint UNSIGNED DEFAULT NULL,
  `paket_cuci_id` bigint UNSIGNED NOT NULL,
  `tipe_kendaraan_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `subtotal` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_item`
--

INSERT INTO `transaksi_item` (`id`, `transaksi_id`, `paket_harga_id`, `paket_cuci_id`, `tipe_kendaraan_id`, `qty`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 1, 2, 1, 10000, '2025-12-15 22:00:39', '2025-12-15 22:00:39'),
(2, 5, 21, 7, 2, 1, 35000, '2026-01-02 04:30:52', '2026-01-02 04:30:52'),
(3, 6, 20, 6, 2, 1, 25000, '2026-01-02 04:49:16', '2026-01-02 04:49:16'),
(4, 7, 18, 1, 2, 1, 15000, '2026-01-02 04:55:24', '2026-01-02 04:55:24'),
(5, 8, 15, 6, 1, 1, 20000, '2026-01-02 12:01:29', '2026-01-02 12:01:29'),
(6, 9, 15, 6, 1, 1, 20000, '2026-01-02 12:02:18', '2026-01-02 12:02:18'),
(7, 10, 15, 6, 1, 1, 20000, '2026-01-02 12:03:56', '2026-01-02 12:03:56'),
(8, 11, 17, 7, 1, 1, 30000, '2026-01-02 12:26:03', '2026-01-02 12:26:03'),
(9, 12, 19, 2, 2, 1, 20000, '2026-01-02 12:26:35', '2026-01-02 12:26:35'),
(10, 13, 19, 2, 2, 1, 20000, '2026-01-02 12:27:28', '2026-01-02 12:27:28'),
(11, 14, 19, 2, 2, 1, 20000, '2026-01-02 14:15:34', '2026-01-02 14:15:34'),
(12, 15, 19, 2, 2, 1, 20000, '2026-01-02 14:43:42', '2026-01-02 14:43:42'),
(13, 16, 19, 2, 2, 1, 20000, '2026-01-02 14:44:09', '2026-01-02 14:44:09'),
(14, 17, 19, 2, 2, 1, 20000, '2026-01-02 14:44:25', '2026-01-02 14:44:25'),
(15, 18, 20, 6, 2, 1, 25000, '2026-01-03 02:58:49', '2026-01-03 02:58:49'),
(16, 19, 20, 6, 2, 1, 25000, '2026-01-03 03:00:07', '2026-01-03 03:00:07'),
(17, 20, 25, 7, 6, 1, 100000, '2026-01-03 03:04:14', '2026-01-03 03:04:14'),
(18, 21, 17, 7, 1, 1, 30000, '2026-01-03 04:43:27', '2026-01-03 04:43:27'),
(19, 22, 21, 7, 2, 1, 35000, '2026-01-03 05:35:20', '2026-01-03 05:35:20'),
(20, 23, 18, 1, 2, 1, 15000, '2026-01-03 08:45:41', '2026-01-03 08:45:41'),
(21, 24, 19, 2, 2, 1, 20000, '2026-01-03 10:45:30', '2026-01-03 10:45:30'),
(22, 25, 31, 7, 13, 1, 250000, '2026-01-03 11:22:57', '2026-01-03 11:22:57'),
(23, 26, 30, 6, 13, 1, 200000, '2026-01-03 11:26:26', '2026-01-03 11:26:26'),
(24, 27, 18, 1, 2, 1, 15000, '2026-01-04 04:38:35', '2026-01-04 04:38:35'),
(25, 28, 13, 1, 1, 1, 10000, '2026-01-04 04:44:43', '2026-01-04 04:44:43'),
(26, 29, 21, 7, 2, 1, 35000, '2026-01-04 05:59:54', '2026-01-04 05:59:54'),
(27, 30, 21, 7, 2, 1, 35000, '2026-01-04 06:02:38', '2026-01-04 06:02:38'),
(28, 31, 20, 6, 2, 1, 25000, '2026-01-04 06:04:25', '2026-01-04 06:04:25'),
(29, 32, 25, 7, 6, 1, 100000, '2026-01-05 00:38:22', '2026-01-05 00:38:22'),
(30, 33, 17, 7, 1, 1, 30000, '2026-01-05 02:22:05', '2026-01-05 02:22:05'),
(31, 34, 13, 1, 1, 1, 10000, '2026-01-05 02:38:40', '2026-01-05 02:38:40'),
(32, 35, 17, 7, 1, 1, 30000, '2026-01-05 02:39:04', '2026-01-05 02:39:04'),
(33, 36, 21, 7, 2, 1, 35000, '2026-01-05 06:34:33', '2026-01-05 06:34:33'),
(34, 37, 19, 2, 2, 1, 20000, '2026-01-05 06:38:19', '2026-01-05 06:38:19'),
(35, 38, 19, 2, 2, 1, 20000, '2026-01-07 05:57:35', '2026-01-07 05:57:35'),
(36, 39, 18, 1, 2, 1, 15000, '2026-01-08 07:16:54', '2026-01-08 07:16:54'),
(37, 40, 20, 6, 2, 1, 25000, '2026-01-12 04:50:19', '2026-01-12 04:50:19'),
(38, 41, 21, 7, 2, 1, 35000, '2026-01-12 04:57:12', '2026-01-12 04:57:12'),
(39, 42, 17, 7, 1, 1, 30000, '2026-01-12 04:57:37', '2026-01-12 04:57:37'),
(40, 43, 25, 7, 6, 1, 100000, '2026-01-12 05:13:57', '2026-01-12 05:13:57'),
(41, 44, 25, 7, 6, 1, 100000, '2026-01-12 05:16:21', '2026-01-12 05:16:21'),
(42, 45, 25, 7, 6, 1, 100000, '2026-01-12 05:20:05', '2026-01-12 05:20:05'),
(43, 46, 25, 7, 6, 1, 100000, '2026-01-12 05:20:30', '2026-01-12 05:20:30'),
(44, 47, 25, 7, 6, 1, 100000, '2026-01-12 05:21:05', '2026-01-12 05:21:05'),
(45, 48, 19, 2, 2, 1, 20000, '2026-01-12 07:24:58', '2026-01-12 07:24:58'),
(46, 49, 19, 2, 2, 1, 20000, '2026-01-12 07:28:43', '2026-01-12 07:28:43'),
(47, 50, 19, 2, 2, 1, 20000, '2026-01-12 07:29:17', '2026-01-12 07:29:17'),
(48, 51, 19, 2, 2, 1, 20000, '2026-01-12 07:29:43', '2026-01-12 07:29:43'),
(49, 52, 19, 2, 2, 1, 20000, '2026-01-12 07:30:04', '2026-01-12 07:30:04'),
(50, 53, 19, 2, 2, 1, 20000, '2026-01-12 07:30:31', '2026-01-12 07:30:31'),
(51, 54, 19, 2, 2, 1, 20000, '2026-01-12 07:31:38', '2026-01-12 07:31:38'),
(52, 55, 15, 6, 1, 1, 20000, '2026-01-12 07:32:41', '2026-01-12 07:32:41'),
(53, 56, 15, 6, 1, 1, 20000, '2026-01-12 07:38:44', '2026-01-12 07:38:44'),
(54, 57, 19, 2, 2, 1, 20000, '2026-01-12 07:44:21', '2026-01-12 07:44:21'),
(55, 58, 21, 7, 2, 1, 35000, '2026-01-12 07:44:48', '2026-01-12 07:44:48'),
(56, 59, 20, 6, 2, 1, 25000, '2026-01-12 23:57:29', '2026-01-12 23:57:29'),
(57, 60, 21, 7, 2, 1, 35000, '2026-01-13 00:08:35', '2026-01-13 00:08:35'),
(59, 62, 19, 2, 2, 1, 20000, '2026-01-13 08:05:11', '2026-01-13 08:05:11'),
(60, 63, 21, 7, 2, 1, 35000, '2026-01-13 08:09:33', '2026-01-13 08:09:33'),
(61, 64, 20, 6, 2, 1, 25000, '2026-01-13 08:10:18', '2026-01-13 08:10:18'),
(62, 65, 19, 2, 2, 1, 20000, '2026-01-14 00:26:00', '2026-01-14 00:26:00'),
(63, 66, 20, 6, 2, 1, 25000, '2026-01-14 00:26:35', '2026-01-14 00:26:35'),
(64, 67, 25, 7, 6, 1, 100000, '2026-01-14 01:15:29', '2026-01-14 01:15:29'),
(65, 68, 21, 7, 2, 1, 35000, '2026-01-14 01:31:01', '2026-01-14 01:31:01'),
(66, 69, 17, 7, 1, 1, 30000, '2026-01-14 01:33:25', '2026-01-14 01:33:25'),
(67, 70, 20, 6, 2, 1, 25000, '2026-01-15 02:03:28', '2026-01-15 02:03:28'),
(68, 71, 19, 2, 2, 1, 20000, '2026-01-15 02:21:19', '2026-01-15 02:21:19'),
(69, 72, 17, 7, 1, 1, 30000, '2026-01-17 11:56:22', '2026-01-17 11:56:22'),
(70, 73, 21, 7, 2, 1, 35000, '2026-01-17 12:05:22', '2026-01-17 12:05:22'),
(71, 74, 19, 2, 2, 1, 20000, '2026-01-17 12:10:07', '2026-01-17 12:10:07'),
(72, 75, 18, 1, 2, 1, 15000, '2026-01-19 00:46:23', '2026-01-19 00:46:23'),
(73, 76, 19, 2, 2, 1, 20000, '2026-01-19 00:56:22', '2026-01-19 00:56:22'),
(74, 77, 20, 6, 2, 1, 25000, '2026-01-19 01:07:00', '2026-01-19 01:07:00'),
(75, 78, 18, 1, 2, 1, 15000, '2026-01-19 01:11:07', '2026-01-19 01:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tambahan`
--

CREATE TABLE `transaksi_tambahan` (
  `id` bigint UNSIGNED NOT NULL,
  `transaksi_id` bigint UNSIGNED NOT NULL,
  `paket_tambahan_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_tambahan`
--

INSERT INTO `transaksi_tambahan` (`id`, `transaksi_id`, `paket_tambahan_id`, `qty`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 62, 1, 1, 50000, '2026-01-13 08:05:11', '2026-01-13 08:05:11'),
(2, 64, 2, 1, 100000, '2026-01-13 08:10:18', '2026-01-13 08:10:18'),
(3, 65, 4, 1, 200000, '2026-01-14 00:26:00', '2026-01-14 00:26:00'),
(4, 66, 3, 1, 150000, '2026-01-14 00:26:35', '2026-01-14 00:26:35'),
(5, 67, 1, 1, 50000, '2026-01-14 01:15:29', '2026-01-14 01:15:29'),
(6, 68, 3, 1, 150000, '2026-01-14 01:31:01', '2026-01-14 01:31:01'),
(7, 69, 4, 1, 200000, '2026-01-14 01:33:25', '2026-01-14 01:33:25'),
(8, 70, 1, 1, 50000, '2026-01-15 02:03:28', '2026-01-15 02:03:28'),
(9, 71, 4, 1, 200000, '2026-01-15 02:21:19', '2026-01-15 02:21:19'),
(10, 72, 1, 1, 50000, '2026-01-17 11:56:22', '2026-01-17 11:56:22'),
(11, 73, 2, 1, 100000, '2026-01-17 12:05:22', '2026-01-17 12:05:22'),
(12, 74, 4, 1, 200000, '2026-01-17 12:10:07', '2026-01-17 12:10:07'),
(13, 75, 1, 1, 50000, '2026-01-19 00:46:23', '2026-01-19 00:46:23'),
(14, 76, 1, 1, 50000, '2026-01-19 00:56:22', '2026-01-19 00:56:22'),
(15, 77, 4, 1, 200000, '2026-01-19 01:07:00', '2026-01-19 01:07:00'),
(16, 78, 1, 1, 50000, '2026-01-19 01:11:07', '2026-01-19 01:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','kasir') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kasir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(2, 'Kasir', 'kasir@cuci.com', NULL, '$2y$12$WXb.Vnoj62FwaiGmh7BEc.QW5DVPatS2qN4ZtBNPPlwWF069nuMQO', NULL, '2025-12-06 20:22:51', '2026-01-03 04:06:41', 'kasir'),
(3, 'Ridho', 'ridho@gmail.com', NULL, '$2y$12$Boj45TN2FkY2STBuGrwFeOq0HkbEW/dkFA94uz439rBl3jQQo5JTm', NULL, '2025-12-06 23:08:11', '2026-01-03 05:31:17', 'admin'),
(9, 'Admin', 'admin@cuci.com', NULL, '$2y$12$fW1wFzSOAYcyAf0uUGpKJe.VGgdL5bq706bR8c3IX2IqJ82fJpOEC', NULL, '2026-01-03 05:30:41', '2026-01-03 05:31:29', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kendaraan_tipe_kendaraan_id_foreign` (`tipe_kendaraan_id`),
  ADD KEY `kendaraan_member_id_foreign` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_kode_member_unique` (`kode_member`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_harga`
--
ALTER TABLE `paket_harga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_harga_paket_cuci_id_foreign` (`paket_cuci_id`),
  ADD KEY `paket_harga_tipe_kendaraan_id_foreign` (`tipe_kendaraan_id`);

--
-- Indexes for table `paket_tambahan`
--
ALTER TABLE `paket_tambahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tipe_kendaraan`
--
ALTER TABLE `tipe_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_user_id_foreign` (`user_id`),
  ADD KEY `transaksi_kendaraan_id_foreign` (`kendaraan_id`),
  ADD KEY `transaksi_tipe_kendaraan_id_foreign` (`tipe_kendaraan_id`);

--
-- Indexes for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_item_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `transaksi_item_paket_harga_id_foreign` (`paket_harga_id`),
  ADD KEY `transaksi_item_paket_cuci_id_foreign` (`paket_cuci_id`),
  ADD KEY `transaksi_item_tipe_kendaraan_id_foreign` (`tipe_kendaraan_id`);

--
-- Indexes for table `transaksi_tambahan`
--
ALTER TABLE `transaksi_tambahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paket_harga`
--
ALTER TABLE `paket_harga`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `paket_tambahan`
--
ALTER TABLE `paket_tambahan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tipe_kendaraan`
--
ALTER TABLE `tipe_kendaraan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `transaksi_tambahan`
--
ALTER TABLE `transaksi_tambahan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kendaraan_tipe_kendaraan_id_foreign` FOREIGN KEY (`tipe_kendaraan_id`) REFERENCES `tipe_kendaraan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paket_harga`
--
ALTER TABLE `paket_harga`
  ADD CONSTRAINT `paket_harga_paket_cuci_id_foreign` FOREIGN KEY (`paket_cuci_id`) REFERENCES `paket_cuci` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paket_harga_tipe_kendaraan_id_foreign` FOREIGN KEY (`tipe_kendaraan_id`) REFERENCES `tipe_kendaraan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_tipe_kendaraan_id_foreign` FOREIGN KEY (`tipe_kendaraan_id`) REFERENCES `tipe_kendaraan` (`id`),
  ADD CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  ADD CONSTRAINT `transaksi_item_paket_cuci_id_foreign` FOREIGN KEY (`paket_cuci_id`) REFERENCES `paket_cuci` (`id`),
  ADD CONSTRAINT `transaksi_item_paket_harga_id_foreign` FOREIGN KEY (`paket_harga_id`) REFERENCES `paket_harga` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_item_tipe_kendaraan_id_foreign` FOREIGN KEY (`tipe_kendaraan_id`) REFERENCES `tipe_kendaraan` (`id`),
  ADD CONSTRAINT `transaksi_item_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
