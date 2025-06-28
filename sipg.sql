-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2024 at 01:05 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipg`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_12_20_102435_create_table_roles', 1),
(2, '2020_12_20_102506_create_table_users', 1),
(3, '2020_12_23_114942_create_table_position', 1),
(4, '2020_12_23_115044_create_table_departement', 1),
(5, '2020_12_23_115444_create_table_staff', 1),
(6, '2020_12_23_120038_create_table_absensi', 1),
(7, '2020_12_23_121157_create_table_cuti', 1),
(8, '2020_12_23_121505_create_table_overtime', 1),
(9, '2020_12_23_121836_create_table_salary', 1),
(10, '2020_12_23_122258_create_table_schedule', 1),
(11, '2021_01_02_135908_create_table_attendance', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `kode_pasien` int(10) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `alamat` longtext NOT NULL,
  `no_hp` int(15) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `kode_pasien`, `nama_pasien`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(0, 123123, 'Jokowi', 'Banjarbaru', 123123123, '2023-08-14 20:10:17', '2023-08-14 20:10:17'),
(1, 123123, 'Pak Yusri', 'Banjarbaru', 829122122, '2023-08-14 20:09:31', '2023-08-14 20:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2023-01-05 07:56:57', '2023-01-05 07:56:57'),
(2, 'karyawan', 'Karyawan', '2023-01-05 07:56:57', '2023-01-05 07:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `attendance_id` int(10) UNSIGNED NOT NULL,
  `bulan_ke` int(11) NOT NULL,
  `jumlah_lembur` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Staff','Daily Worker') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_absen` date NOT NULL,
  `waktu_masuk` time NOT NULL,
  `waktu_keluar` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `schedule_id`, `attendance_id`, `bulan_ke`, `jumlah_lembur`, `code`, `periode`, `status`, `tanggal_absen`, `waktu_masuk`, `waktu_keluar`, `created_at`, `updated_at`) VALUES
(36, 11, 1, 0, 0, '', 'oktober-2023', 'Staff', '2023-10-14', '00:00:00', '00:00:00', '2023-10-13 09:31:23', '2023-10-13 09:31:23'),
(37, 10, 1, 0, 0, '', 'oktober-2023', 'Staff', '2023-10-17', '00:00:00', '00:00:00', '2023-10-16 18:10:09', '2023-10-16 18:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_attendance`
--

CREATE TABLE `tb_attendance` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `singkatan` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_attendance`
--

INSERT INTO `tb_attendance` (`id`, `name`, `label`, `singkatan`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Present', 'badge badge-success', 'H', 1, '2023-01-05 07:56:57', '2023-01-05 07:56:57'),
(2, 'Permision', 'badge badge-warning', 'I', 0, '2023-01-05 07:56:57', '2023-01-05 07:56:57'),
(3, 'Sick', 'badge badge-info', 'S', 0, '2023-01-05 07:56:57', '2023-01-05 07:56:57'),
(4, 'Alpha', 'badge badge-danger', 'A', 0, '2023-01-05 07:56:57', '2023-01-05 07:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cuti`
--

CREATE TABLE `tb_cuti` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `jumlah_cuti` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_cuti`
--

INSERT INTO `tb_cuti` (`id`, `staff_id`, `jumlah_cuti`, `tgl_mulai`, `tgl_selesai`, `keterangan`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(23, 15, 3, '2023-10-14', '2023-10-17', 'sakittt', 'harus pulang tepat waktu', 'disetujui', '2023-10-13 04:56:20', '2023-10-13 04:57:08'),
(24, 16, 3, '2023-10-17', '2023-10-20', 'Liburan bersama keluarga', 'harus pulang tepat waktu', 'disetujui', '2023-10-15 18:15:24', '2023-10-15 18:16:00'),
(25, 13, 2, '2023-10-28', '2023-10-30', 'sakit brok', 'Masuk jam 8', 'disetujui', '2023-10-26 10:07:30', '2023-10-26 10:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_departement`
--

CREATE TABLE `tb_departement` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_departement`
--

INSERT INTO `tb_departement` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PENJUALAN DAN PEMASARAN', '2023-01-05 07:56:57', '2023-06-07 20:07:19'),
(2, 'PENGEMBANG PERANGKAT LUNAK', '2023-06-07 01:29:05', '2023-06-07 20:06:42'),
(3, 'MANAJEMEN PRODUK', '2023-06-07 20:07:04', '2023-06-07 20:07:04'),
(4, 'PENGELOLA PROYEK', '2023-06-07 20:07:30', '2023-06-07 20:07:30'),
(5, 'ANALISIS DATA & BISNIS', '2023-06-07 20:07:55', '2023-06-07 20:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mutasi`
--

CREATE TABLE `tb_mutasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `position_id` int(11) UNSIGNED NOT NULL,
  `dari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ke` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_mutasi`
--

INSERT INTO `tb_mutasi` (`id`, `staff_id`, `position_id`, `dari`, `ke`, `keterangan`, `created_at`, `updated_at`) VALUES
(12, 15, 15, 'Jakarta', 'Bekasi', 'Membutuhkan backend developer di kantor cabang', '2023-08-14 03:49:27', '2023-08-14 15:38:01'),
(13, 12, 14, 'Jakarta', 'Surabaya', 'Membutuhkan tenaga frontend di kantor cabang', '2023-08-14 03:49:34', '2023-08-14 15:37:02'),
(14, 14, 17, 'Jakarta', 'Cikarang', 'Kekurangan product manager di kantor cabang', '2023-08-14 03:49:40', '2023-08-14 15:38:28'),
(15, 13, 14, 'Jakarta', 'Bandung', 'Kekurangan tenaga kerja', '2023-08-14 03:49:45', '2023-08-14 15:38:56'),
(16, 16, 21, 'Jakarta', 'Bekasi', 'Kekurangan cloud engineer', '2023-08-14 03:49:52', '2023-08-14 15:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_overtime`
--

CREATE TABLE `tb_overtime` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `departement_id` int(10) UNSIGNED NOT NULL,
  `waktu_mulai` time DEFAULT '00:00:00',
  `waktu_selesai` time DEFAULT NULL,
  `tgl_overtime` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_overtime`
--

INSERT INTO `tb_overtime` (`id`, `staff_id`, `departement_id`, `waktu_mulai`, `waktu_selesai`, `tgl_overtime`, `created_at`, `updated_at`) VALUES
(10, 16, 4, '20:48:00', '22:44:00', '2023-10-17', '2023-10-16 22:44:34', '2023-10-16 22:44:34'),
(11, 16, 4, '17:51:00', '22:51:00', '2023-10-18', '2023-10-16 22:51:16', '2023-10-16 22:51:16'),
(12, 16, 4, '14:52:00', '23:52:00', '2023-11-01', '2023-10-16 22:52:18', '2023-10-16 22:52:18'),
(13, 16, 4, '14:58:00', '22:58:00', '2023-10-17', '2023-10-16 22:59:13', '2023-10-16 22:59:13'),
(14, 16, 4, '18:01:00', '20:01:00', '2023-10-17', '2023-10-16 23:02:27', '2023-10-16 23:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peringatan`
--

CREATE TABLE `tb_peringatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_peringatan`
--

INSERT INTO `tb_peringatan` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SP1', '2023-01-05 07:56:57', '2023-01-05 07:56:57'),
(2, 'SP2', '2023-01-05 07:56:57', '2023-01-05 07:56:57'),
(3, 'SP3', '2023-01-05 07:56:57', '2023-01-05 07:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_position`
--

CREATE TABLE `tb_position` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Staff','Daily Worker') COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_position`
--

INSERT INTO `tb_position` (`id`, `name`, `status`, `salary`, `created_at`, `updated_at`) VALUES
(12, 'Sales Executive', 'Staff', 4500000, '2023-06-07 20:16:54', '2023-06-07 20:16:54'),
(13, 'Account Manager', 'Staff', 7000000, '2023-06-07 20:17:15', '2023-06-07 20:17:15'),
(14, 'Frontend Developer', 'Staff', 6000000, '2023-06-07 20:18:13', '2023-06-07 20:18:13'),
(15, 'Backend Developer', 'Staff', 6500000, '2023-06-07 20:18:37', '2023-06-07 20:18:37'),
(16, 'Mobile Developer', 'Daily Worker', 5000000, '2023-06-07 20:19:31', '2023-06-07 20:19:31'),
(17, 'Product Manager', 'Staff', 6700000, '2023-06-07 20:19:59', '2023-06-07 20:19:59'),
(18, 'Product Owner', 'Staff', 6400000, '2023-06-07 20:20:14', '2023-06-07 20:20:14'),
(19, 'Project Manager', 'Staff', 8000000, '2023-06-07 20:20:44', '2023-06-07 20:20:44'),
(20, 'Scrum Master', 'Staff', 8400000, '2023-06-07 20:21:00', '2023-06-07 20:21:00'),
(21, 'Cloud Engineer', 'Staff', 7500000, '2023-06-07 20:21:35', '2023-06-07 20:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_salary`
--

CREATE TABLE `tb_salary` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `salary` double NOT NULL DEFAULT '0',
  `uang_overtime` double NOT NULL DEFAULT '0',
  `pot_bpjs` double NOT NULL DEFAULT '0',
  `tgl_salary` date NOT NULL,
  `periode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transportasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` double DEFAULT '0',
  `status_gaji` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_overtime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_salary`
--

INSERT INTO `tb_salary` (`id`, `staff_id`, `salary`, `uang_overtime`, `pot_bpjs`, `tgl_salary`, `periode`, `transportasi`, `total`, `status_gaji`, `status`, `jumlah_overtime`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 14, 4500000, 30000, 150000, '2023-08-15', 'Agustus-2023', '100000', 4870000, 'Lunas', 'Staff', '4', '2023-08-14 15:23:59', '2023-08-14 15:23:59', NULL),
(2, 15, 5000000, 15000, 0, '2023-08-15', 'Agustus-2023', '0', 5045000, 'Lunas', 'Daily Worker', '3', '2023-08-14 15:28:06', '2023-08-14 15:28:06', NULL),
(3, 12, 8000000, 0, 100000, '2023-08-15', 'Agustus-2023', '150000', 8250000, 'Lunas', 'Staff', NULL, '2023-08-14 15:28:56', '2023-08-14 15:28:56', NULL),
(4, 13, 6500000, 0, 100000, '2023-08-15', 'Agustus-2023', '150000', 6750000, 'Lunas', 'Staff', NULL, '2023-08-14 15:29:31', '2023-08-14 15:29:31', NULL),
(5, 16, 7000000, 0, 100000, '2023-08-15', 'Agustus-2023', '150000', 7250000, 'Lunas', 'Staff', NULL, '2023-08-14 15:29:58', '2023-08-14 15:29:58', NULL),
(6, 12, 8000000, 0, 100000, '2023-08-15', 'September-2023', '150000', 8250000, 'Lunas', 'Staff', NULL, '2023-08-14 15:30:31', '2023-08-14 15:30:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sanksi`
--

CREATE TABLE `tb_sanksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `position_id` int(11) UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peringatan_id` int(15) UNSIGNED NOT NULL,
  `dokumen` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_sanksi`
--

INSERT INTO `tb_sanksi` (`id`, `staff_id`, `position_id`, `keterangan`, `peringatan_id`, `dokumen`, `created_at`, `updated_at`) VALUES
(14, 16, 15, 'Lalai dalam pekerjaan', 1, 'dokumen/pB3LQepKwjYsV7UpS7sRhOwk3Vv8ZpY4hWQ4Vejp.docx', '2023-10-15 18:13:58', '2023-10-15 18:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_schedule`
--

CREATE TABLE `tb_schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `tgl_masuk` date NOT NULL,
  `ket_schedule` enum('Morning(05:00-14:00)','Afternoon(13:00-22:00)','Middle Morning(10:00-19:00)','Middle Afternoon(12:00-21:00)','Evening (19:00-04:00)','Mignight (22:00-07:00)') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Staff','Daily Worker') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_schedule`
--

INSERT INTO `tb_schedule` (`id`, `staff_id`, `tgl_masuk`, `ket_schedule`, `status`, `created_at`, `updated_at`) VALUES
(10, 16, '2023-08-14', 'Mignight (22:00-07:00)', 'Staff', '2023-08-14 03:48:11', '2023-08-14 03:59:59'),
(11, 12, '2023-08-14', 'Middle Morning(10:00-19:00)', 'Staff', '2023-08-14 03:48:45', '2023-08-14 04:00:12'),
(12, 14, '2023-07-18', 'Middle Afternoon(12:00-21:00)', 'Staff', '2023-08-14 03:48:52', '2023-08-14 03:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff`
--

CREATE TABLE `tb_staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `departement_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` int(100) DEFAULT NULL,
  `birth` date NOT NULL,
  `jenis_kelamin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addres` text COLLATE utf8mb4_unicode_ci,
  `startdate` date NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_staff`
--

INSERT INTO `tb_staff` (`id`, `position_id`, `departement_id`, `users_id`, `name`, `nik`, `birth`, `jenis_kelamin`, `addres`, `startdate`, `phone`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 19, 1, 9, 'VALENTINE BEASLEY', 2147483647, '1970-11-28', 'Pria', 'Indonesia', '1994-08-28', '082926372211', NULL, '2023-08-14 03:39:48', '2023-08-14 04:20:16', NULL),
(13, 15, 5, 10, 'MALCOLM GAMBLE', 21123111, '1991-10-19', 'Wanita', 'Indonesia', '1989-03-14', '08219554112', NULL, '2023-08-14 03:41:05', '2023-08-14 04:20:33', NULL),
(14, 12, 5, 11, 'HAMISH GILBERT', 2212222, '1985-11-14', 'Wanita', 'Enim hic quia fugiat', '1974-07-03', '0829105210222', NULL, '2023-08-14 03:41:40', '2023-08-14 04:20:55', NULL),
(15, 16, 2, 12, 'LOUISI JACOBS', 29011221, '2022-08-12', 'Wanita', 'Indonesia', '1993-03-03', '082919292922', NULL, '2023-08-14 03:43:15', '2023-08-14 04:19:41', NULL),
(16, 13, 4, 13, 'GARRETT DAY', 188777566, '1988-11-19', 'Pria', 'Dolor rerum lorem de', '2012-01-28', '0829219312', NULL, '2023-08-14 03:43:40', '2023-08-14 04:21:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `name`, `username`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin@gmail.com', 'Administrator', 'admin', '$2y$10$6IId8BWJncb.9il4RvTYRe0yG1vdejyCTeqhO.IQ7fh9EIHc70EG.', NULL, NULL, '2023-01-05 07:56:57', '2023-03-07 05:00:11', NULL),
(9, 2, NULL, 'Valentine Beasley', 'valentine', '$2y$10$qnFcjXB7DoZucYYSHCeqPehx606hjTRS5axTG7DFb3QuJMxLwkmai', NULL, NULL, '2023-08-14 03:39:48', '2023-08-14 03:39:48', NULL),
(10, 2, NULL, 'MALCOLM GAMBLE', 'malcolm', '$2y$10$BVFHLtC2bVJkVdtVvutMuu/gVbVR2tfg9UMfonA0GON20pbN8JOA.', NULL, NULL, '2023-08-14 03:41:21', '2023-08-14 03:41:21', NULL),
(11, 2, NULL, 'HAMISH GILBERT', 'hamish', '$2y$10$4.7/NrG3xOrJ0WLHr6GvVuNrYvpA7CqGrARFxRoIB0/EufnbagODK', NULL, NULL, '2023-08-14 03:41:55', '2023-08-14 03:41:55', NULL),
(12, 2, NULL, 'Louisi Jacobs', 'Louisi', '$2y$10$6pl3L43FnJ5pJUrWU/nIReYIcceeQyZNL1hH5fsNLr8Gkhp/XpYzK', NULL, NULL, '2023-08-14 03:43:15', '2023-08-14 03:43:15', NULL),
(13, 2, NULL, 'Garrett Day', 'garrett', '$2y$10$mEqxbIMABFBlNfzJqxnshuMf105f4cUOSADz0q4cGFmiz6YLuEsni', NULL, NULL, '2023-08-14 03:43:40', '2023-08-14 03:43:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_absensi_attendance_id_foreign` (`attendance_id`);

--
-- Indexes for table `tb_attendance`
--
ALTER TABLE `tb_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_cuti_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `tb_departement`
--
ALTER TABLE `tb_departement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mutasi`
--
ALTER TABLE `tb_mutasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_schedule_staff_id_foreign` (`staff_id`),
  ADD KEY `tb_sanksi_position_id_foreign` (`position_id`);

--
-- Indexes for table `tb_overtime`
--
ALTER TABLE `tb_overtime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_overtime_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `tb_peringatan`
--
ALTER TABLE `tb_peringatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_position`
--
ALTER TABLE `tb_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_salary`
--
ALTER TABLE `tb_salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_salary_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `tb_sanksi`
--
ALTER TABLE `tb_sanksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_schedule_staff_id_foreign` (`staff_id`),
  ADD KEY `tb_sanksi_position_id_foreign` (`position_id`);

--
-- Indexes for table `tb_schedule`
--
ALTER TABLE `tb_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_schedule_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_staff_position_id_foreign` (`position_id`),
  ADD KEY `tb_staff_departement_id_foreign` (`departement_id`),
  ADD KEY `tb_staff_users_id_foreign` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_attendance`
--
ALTER TABLE `tb_attendance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_departement`
--
ALTER TABLE `tb_departement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_mutasi`
--
ALTER TABLE `tb_mutasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_overtime`
--
ALTER TABLE `tb_overtime`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_peringatan`
--
ALTER TABLE `tb_peringatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_position`
--
ALTER TABLE `tb_position`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_salary`
--
ALTER TABLE `tb_salary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_sanksi`
--
ALTER TABLE `tb_sanksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_schedule`
--
ALTER TABLE `tb_schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_staff`
--
ALTER TABLE `tb_staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `tb_attendance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD CONSTRAINT `tb_cuti_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `tb_staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_overtime`
--
ALTER TABLE `tb_overtime`
  ADD CONSTRAINT `tb_overtime_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `tb_staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_salary`
--
ALTER TABLE `tb_salary`
  ADD CONSTRAINT `tb_salary_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `tb_staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_schedule`
--
ALTER TABLE `tb_schedule`
  ADD CONSTRAINT `tb_schedule_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `tb_staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD CONSTRAINT `tb_staff_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `tb_departement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_staff_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `tb_position` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_staff_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
