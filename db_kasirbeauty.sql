-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Mar 2025 pada 17.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasirbeauty`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin2@gmail|127.0.0.1', 'i:3;', 1740809536),
('admin2@gmail|127.0.0.1:timer', 'i:1740809536;', 1740809536);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `custemer`
--

CREATE TABLE `custemer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `id_karyawan` bigint(20) UNSIGNED NOT NULL,
  `id_treatment` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `custemer`
--

INSERT INTO `custemer` (`id`, `nama`, `phone`, `address`, `id_karyawan`, `id_treatment`, `created_at`, `updated_at`) VALUES
(27, 'SAFIQUR ROHMAN', '082228459083', 'Dusun Bajur, RT/RW 04/10, Desa Bullaan, Kecamatan Batuputih', 2, 1, '2025-02-28 22:32:05', '2025-02-28 22:32:05'),
(28, 'SAFIQUR ROHMAN', '082228459083', 'Dusun Bajur, RT/RW 04/10, Desa Bullaan, Kecamatan Batuputih', 1, 1, '2025-02-28 22:42:24', '2025-02-28 22:42:24'),
(29, 'SAFIQUR ROHMAN', '082228459083', 'Dusun Bajur, RT/RW 04/10, Desa Bullaan, Kecamatan Batuputih', 2, 3, '2025-02-28 23:07:32', '2025-02-28 23:07:32'),
(30, 'sindy', '08878736528', 'nganjuk, jawa timur', 2, 1, '2025-03-02 04:50:56', '2025-03-02 04:50:56'),
(31, 'Mei', '098787262', 'surabaya', 2, 3, '2025-03-02 04:58:51', '2025-03-02 04:58:51'),
(32, 'Frendiya', '08787625246', 'nganjuk, kota', 2, 1, '2024-03-02 05:01:24', '2024-03-02 05:01:24'),
(33, 'Frendiya Mei Sindy', '08757624252', 'Nganjuk', 6, 28, '2025-03-02 09:38:21', '2025-03-02 09:38:21'),
(34, 'Ima', '0877651775', 'Sumenep', 6, 12, '2025-03-02 09:40:02', '2025-03-02 09:40:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_custemer` bigint(20) UNSIGNED NOT NULL,
  `id_treatment` bigint(20) UNSIGNED NOT NULL,
  `harga` decimal(50,2) NOT NULL,
  `komisi` decimal(50,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id`, `id_custemer`, `id_treatment`, `harga`, `komisi`, `created_at`, `updated_at`) VALUES
(1, 2, 27, 1, 90000.00, 9000.00, '2025-02-28 22:32:05', '2025-02-28 22:32:05'),
(2, 1, 28, 1, 90000.00, 9000.00, '2025-02-28 22:42:24', '2025-02-28 22:42:24'),
(3, 2, 29, 3, 100000.00, 10000.00, '2025-02-28 23:07:32', '2025-02-28 23:07:32'),
(4, 2, 30, 1, 90000.00, 9000.00, '2025-03-02 04:50:56', '2025-03-02 04:50:56'),
(6, 2, 31, 3, 100000.00, 10000.00, '2025-03-02 04:58:51', '2025-03-02 04:58:51'),
(7, 2, 32, 1, 90000.00, 9000.00, '2024-03-02 05:01:24', '2024-03-02 05:01:24'),
(8, 6, 33, 28, 120000.00, 12000.00, '2025-03-02 09:38:21', '2025-03-02 09:38:21'),
(9, 6, 34, 12, 110000.00, 11000.00, '2025-03-02 09:40:02', '2025-03-02 09:40:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_13_123651_create_treatment_table', 1),
(5, '2025_02_13_124327_create_custemer_table', 1),
(6, '2025_02_25_133053_create__transaksi_table', 1),
(7, '2025_02_25_133126_create__laporan_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fxVzNlxoXPsVjthtrrVg5Cq2LvOHyKV6GnqWORRM', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTHo4MXZOU3I3MGk0WWV3Wm54YWRJSTRYSms5Y0pOWVp5REFnN1luMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2Frc2kiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc0MDkzMzQzMjt9fQ==', 1740934003);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_custemer` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_treatment` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_custemer`, `id`, `id_treatment`, `created_at`, `updated_at`) VALUES
(7, 27, 2, 1, '2025-02-28 22:32:05', '2025-02-28 22:32:05'),
(8, 28, 1, 1, '2025-02-28 22:42:24', '2025-02-28 22:42:24'),
(9, 29, 2, 3, '2025-02-28 23:07:32', '2025-02-28 23:07:32'),
(10, 30, 2, 1, '2025-03-02 04:50:56', '2025-03-02 04:50:56'),
(11, 31, 2, 3, '2025-03-02 04:58:51', '2025-03-02 04:58:51'),
(12, 32, 2, 1, '2024-03-02 05:01:24', '2024-03-02 05:01:24'),
(13, 33, 6, 28, '2025-03-02 09:38:21', '2025-03-02 09:38:21'),
(14, 34, 6, 12, '2025-03-02 09:40:02', '2025-03-02 09:40:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `treatment`
--

CREATE TABLE `treatment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `harga` decimal(50,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `treatment`
--

INSERT INTO `treatment` (`id`, `nama`, `kategori`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Hair  SPA', 'HAIR TREATMENT', 90000.00, '2025-02-28 19:25:53', '2025-03-02 09:18:15'),
(3, 'Hair  Creambath', 'HAIR TREATMENT', 80000.00, '2025-02-28 23:06:57', '2025-03-02 09:18:52'),
(4, 'Hair Mask', 'HAIR TREATMENT', 65000.00, '2025-03-02 09:19:12', '2025-03-02 09:19:12'),
(5, 'Treatment Anti Dandruff', 'HAIR TREATMENT', 100000.00, '2025-03-02 09:19:42', '2025-03-02 09:19:42'),
(6, 'Full Color', 'HAIR TREATMENT', 200000.00, '2025-03-02 09:20:07', '2025-03-02 09:20:07'),
(7, 'Peek A Boo', 'HAIR TREATMENT', 200000.00, '2025-03-02 09:20:34', '2025-03-02 09:20:34'),
(8, 'HighLights', 'HAIR TREATMENT', 250000.00, '2025-03-02 09:21:10', '2025-03-02 09:21:10'),
(9, 'Cuci atau Catok', 'HAIR TREATMENT', 30000.00, '2025-03-02 09:21:34', '2025-03-02 09:21:34'),
(10, 'Hair Toning', 'HAIR TREATMENT', 100000.00, '2025-03-02 09:23:06', '2025-03-02 09:23:06'),
(11, 'Nail ART(kuku asli)', 'NAIL SERVICES', 65000.00, '2025-03-02 09:23:49', '2025-03-02 09:23:49'),
(12, 'Nail ART Soft Gel Tip', 'NAIL SERVICES', 110000.00, '2025-03-02 09:24:23', '2025-03-02 09:24:23'),
(13, 'Manicure', 'NAIL SERVICES', 35000.00, '2025-03-02 09:24:48', '2025-03-02 09:24:48'),
(14, 'Remove Nail ART/Eyelash', 'NAIL SERVICES', 30000.00, '2025-03-02 09:25:28', '2025-03-02 09:25:28'),
(15, 'Accesoris', 'NAIL SERVICES', 10000.00, '2025-03-02 09:26:00', '2025-03-02 09:26:00'),
(16, 'Facial Black Doll', 'FACIAL AND MAKEUP', 130000.00, '2025-03-02 09:26:50', '2025-03-02 09:26:50'),
(17, 'Facial Whitening', 'FACIAL AND MAKEUP', 130000.00, '2025-03-02 09:27:15', '2025-03-02 09:27:15'),
(18, 'Facial Acne', 'FACIAL AND MAKEUP', 130000.00, '2025-03-02 09:27:38', '2025-03-02 09:27:38'),
(19, 'Facial Ant Aging', 'FACIAL AND MAKEUP', 150000.00, '2025-03-02 09:28:05', '2025-03-02 09:28:05'),
(20, 'MakeUp  Anak-anak', 'FACIAL AND MAKEUP', 100000.00, '2025-03-02 09:28:28', '2025-03-02 09:28:28'),
(21, 'MakeUp Party/Wisuda', 'FACIAL AND MAKEUP', 200000.00, '2025-03-02 09:28:51', '2025-03-02 09:28:51'),
(22, 'MakeUp Engagement', 'FACIAL AND MAKEUP', 250000.00, '2025-03-02 09:29:25', '2025-03-02 09:29:25'),
(23, 'Single Lash Natural', 'BROWS CLASSIC', 60000.00, '2025-03-02 09:30:22', '2025-03-02 09:30:22'),
(24, 'Single Lash Medium', 'BROWS CLASSIC', 80000.00, '2025-03-02 09:30:45', '2025-03-02 09:31:31'),
(25, 'Single Lash Volume', 'BROWS CLASSIC', 100000.00, '2025-03-02 09:31:10', '2025-03-02 09:31:10'),
(26, 'Rusian Lash Natural', 'BROWS RUSIAN', 75000.00, '2025-03-02 09:32:12', '2025-03-02 09:32:12'),
(27, 'Rusian Lash Medium', 'BROWS RUSIAN', 95000.00, '2025-03-02 09:32:37', '2025-03-02 09:32:37'),
(28, 'Rusian Lash Volume', 'BROWS RUSIAN', 120000.00, '2025-03-02 09:33:01', '2025-03-02 09:33:01'),
(29, 'Yy Lash Natural', 'BROWS YY LASH', 80000.00, '2025-03-02 09:33:31', '2025-03-02 09:33:31'),
(30, 'Yy Lash Medium', 'BROWS YY LASH', 95000.00, '2025-03-02 09:33:52', '2025-03-02 09:33:52'),
(31, 'Yy Lash Volume', 'BROWS YY LASH', 115000.00, '2025-03-02 09:34:10', '2025-03-02 09:34:10'),
(32, 'Whispy', 'BROWS', 100000.00, '2025-03-02 09:35:19', '2025-03-02 09:35:19'),
(33, 'Last Lift', 'BROWS', 70000.00, '2025-03-02 09:35:39', '2025-03-02 09:35:39'),
(34, 'Last Lift & Tint', 'BROWS', 85000.00, '2025-03-02 09:36:04', '2025-03-02 09:36:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','karyawan','custemer') NOT NULL DEFAULT 'custemer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin1', 'admin1@gmail.com', NULL, '$2y$12$epEskoOkiDXN2OKaHDED3.Dqt/lvw/j2bDtsHmI9.O2dQYxfVf1NG', 'admin', NULL, '2025-02-28 19:24:27', '2025-02-28 19:24:27'),
(2, 'Karyawan1', 'admin2@gmail.com', NULL, '$2y$12$7R4g5MSEhpAngmSgK3Xyv.nwLDrZYS/CpFZGo9vYiQEKHIWliFwQu', 'karyawan', '0EIDoLyKkZGSwh6T6Fw5pCSmU6BeLoPAaANVjm2EQTvfxS0gM5UOQoJoh291', '2025-02-28 19:24:27', '2025-02-28 19:31:30'),
(3, 'Karyawan2', 'tobi@gmail.com', NULL, '$2y$12$HgYlPuUvtoRgXbozDekA8.09rcWKI3qen0TFIbCwCvyLdnquDy2d.', 'karyawan', NULL, '2025-03-01 02:35:19', '2025-03-01 02:35:19'),
(4, 'FrendiyaMei', 'frendiya@gmail.com', NULL, '$2y$12$IbvOV9K70x08T3KahkHGb.FnqIGHJNnCigr95qCiU.wPjfAowffwS', 'karyawan', NULL, '2025-03-02 09:10:03', '2025-03-02 09:10:03'),
(5, 'sindy', 'sindy@gmail.com', NULL, '$2y$12$i0maLJGoJT4mZ7bI8p.ijOXcJLIS06R6k5L/TVFn3vm8OXq1ZXIxu', 'karyawan', NULL, '2025-03-02 09:11:11', '2025-03-02 09:11:11'),
(6, 'safi', 'safi@gmail.com', NULL, '$2y$12$Forh6tkB7VDOg9HuwWa01Oxufy0pD6E6cQLw5Mqya6OP7PxXh8UGS', 'karyawan', NULL, '2025-03-02 09:11:31', '2025-03-02 09:11:31'),
(7, 'rohman', 'rohman@gmail.com', NULL, '$2y$12$zEhLNAk.GUzLCpbavzQNhea7zWX/xsG6gtq6aSWV0/BrzDpMPFQ9.', 'karyawan', NULL, '2025-03-02 09:12:14', '2025-03-02 09:12:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `custemer`
--
ALTER TABLE `custemer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custemer_id_karyawan_foreign` (`id_karyawan`),
  ADD KEY `custemer_id_treatment_foreign` (`id_treatment`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `laporan_id_karyawan_foreign` (`id`),
  ADD KEY `laporan_id_custemer_foreign` (`id_custemer`),
  ADD KEY `laporan_id_treatment_foreign` (`id_treatment`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id_custemer_foreign` (`id_custemer`),
  ADD KEY `transaksi_id_karyawan_foreign` (`id`),
  ADD KEY `transaksi_id_treatment_foreign` (`id_treatment`);

--
-- Indeks untuk tabel `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `custemer`
--
ALTER TABLE `custemer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `treatment`
--
ALTER TABLE `treatment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `custemer`
--
ALTER TABLE `custemer`
  ADD CONSTRAINT `custemer_id_karyawan_foreign` FOREIGN KEY (`id_Karyawan`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `custemer_id_treatment_foreign` FOREIGN KEY (`id_treatment`) REFERENCES `treatment` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_id_custemer_foreign` FOREIGN KEY (`id_custemer`) REFERENCES `custemer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_id_karyawan_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_id_treatment_foreign` FOREIGN KEY (`id_treatment`) REFERENCES `treatment` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_custemer_foreign` FOREIGN KEY (`id_custemer`) REFERENCES `custemer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_id_karyawan_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_id_treatment_foreign` FOREIGN KEY (`id_treatment`) REFERENCES `treatment` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
