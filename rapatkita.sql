-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 03:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rapatkita`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_29_024023_create_permissions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `topic` text NOT NULL,
  `participants` text NOT NULL,
  `note` text DEFAULT NULL,
  `status` enum('draft','pending','approved','rejected') NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `creator_id`, `date`, `time`, `location`, `topic`, `participants`, `note`, `status`, `approved_by`, `approved_at`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-05-30', '09:00:00', 'Loby Hotel', 'g', 'g', 'g', 'pending', NULL, NULL, '2025-05-28 19:44:45', '2025-05-28 19:44:45'),
(2, 3, '2025-05-30', '10:00:00', 'a', 'a', '[{\"value\":\"Pegawai\"}]', 'a', 'pending', NULL, NULL, '2025-05-28 20:38:56', '2025-05-28 20:38:56'),
(3, 3, '2025-05-31', '10:44:00', 'd', 'd', '[{\"value\":\"Pegawai\"},{\"value\":\"Atasan\"},{\"value\":\"Admin\"}]', NULL, 'approved', 2, '2025-06-05 02:40:03', '2025-05-28 20:44:12', '2025-05-28 20:44:12'),
(4, 2, '2025-05-31', '14:50:00', 'Loby Hotel', 'a', '[{\"value\":\"Admin\"},{\"value\":\"Atasan\"}]', 'a', 'approved', 2, '2025-06-03 00:28:10', '2025-05-30 00:45:39', '2025-06-03 00:28:10'),
(5, 2, '2025-06-07', '15:15:00', 'Loby Hotel', 'l', '[{\"value\":\"Atasan\"},{\"value\":\"Pegawai\"},{\"value\":\"Admin\"}]', 'a', 'pending', NULL, NULL, '2025-06-03 01:13:15', '2025-06-03 01:13:15'),
(6, 2, '2025-06-07', '16:20:00', 'Loby Hotel', 'a', '[{\"value\":\"Admin\"}]', 'a', 'pending', NULL, NULL, '2025-06-03 01:20:50', '2025-06-03 01:20:50'),
(7, 2, '2025-06-23', '12:00:00', 'Loby Hotel', 'l', '[{\"value\":\"Atasan\"},{\"value\":\"Pegawai\"}]', NULL, 'pending', NULL, NULL, '2025-06-11 18:47:05', '2025-06-11 18:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `no_wa` varchar(255) DEFAULT NULL,
  `gaji` double(15,2) DEFAULT NULL,
  `tanggal_bergabung` date DEFAULT NULL,
  `gender` enum('L','P','Spesial') NOT NULL,
  `umur` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','atasan','pegawai') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `no_wa`, `gaji`, `tanggal_bergabung`, `gender`, `umur`, `jabatan`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '12345678', 8000000.00, '2024-01-01', 'L', '17', 'anak biasa', '$2y$10$Cop6Ecadpoaq1q6lGBXmhuZTf0K45gCSO/hvteFh.xJoEO3ol9l7C', 'admin', NULL, '2025-05-28 19:42:28', '2025-05-28 19:42:28'),
(2, 'Atasan', 'atasan@gmail.com', NULL, '09876543', 8000000.00, '2020-01-01', 'L', '47', 'Kepala Sekolah', '$2y$10$BIuaqoM2Z9TsHC21JEZutu32YDYjpoccMuAa2qhT.1GScXNFZa43G', 'atasan', NULL, '2025-05-28 19:42:29', '2025-05-28 19:42:29'),
(3, 'Pegawai', 'pegawai@gmail.com', NULL, '78901234', 2000000.00, '2020-09-09', 'P', '29', 'Staff', '$2y$10$RZEni6ubHZhj1PtQK3q8qO6RW4lW4b/GY1R6/lVR76Srtj/TyDvh.', 'pegawai', NULL, '2025-05-28 19:42:29', '2025-05-28 19:42:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_creator_id_foreign` (`creator_id`),
  ADD KEY `permissions_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permissions_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
