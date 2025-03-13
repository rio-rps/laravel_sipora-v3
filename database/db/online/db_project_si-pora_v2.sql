-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 03:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project_si-pora_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `aaa_access`
--

CREATE TABLE `aaa_access` (
  `id` int(11) NOT NULL,
  `url` varchar(225) NOT NULL,
  `access` varchar(50) NOT NULL,
  `status_actived` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aaa_access`
--

INSERT INTO `aaa_access` (`id`, `url`, `access`, `status_actived`) VALUES
(1, 'http://192.168.192.131/e-rekap/public/', 'qrcode', '2');

-- --------------------------------------------------------

--
-- Table structure for table `bpar_badan_usaha`
--

CREATE TABLE `bpar_badan_usaha` (
  `id_badan_usaha` int(11) NOT NULL,
  `nm_badan_usaha` text NOT NULL,
  `status_actived` enum('1','2') NOT NULL,
  `no_urut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bpar_badan_usaha`
--

INSERT INTO `bpar_badan_usaha` (`id_badan_usaha`, `nm_badan_usaha`, `status_actived`, `no_urut`, `created_at`, `updated_at`) VALUES
(1, 'PT', '1', 1, '2023-04-15 15:35:14', '2023-04-15 15:35:14'),
(2, 'CV', '1', 2, '2023-04-15 15:35:14', '2023-04-15 15:35:14'),
(3, 'Koperasi', '1', 3, '2023-04-15 15:35:14', '2023-04-15 15:35:14'),
(4, 'Personal / Perorangan', '1', 4, '2023-04-15 15:35:14', '2023-04-15 15:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_angkutan_001_jenis_angkutan`
--

CREATE TABLE `cpar_angkutan_001_jenis_angkutan` (
  `id_jenis_angkutan` int(11) NOT NULL,
  `nm_jenis_angkutan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_angkutan_001_jenis_angkutan`
--

INSERT INTO `cpar_angkutan_001_jenis_angkutan` (`id_jenis_angkutan`, `nm_jenis_angkutan`, `created_at`, `updated_at`) VALUES
(1, 'Angkutan Orang', '2023-04-17 04:59:56', '2023-04-17 04:59:56'),
(2, 'Angkutan Barang Umum', '2023-04-17 04:59:56', '2023-04-17 04:59:56'),
(3, 'Angkutan Barang Khusus', '2023-04-17 04:59:56', '2023-04-17 04:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
--

CREATE TABLE `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan` (
  `id_mapping_angkutan_jenis_permohonan` int(11) NOT NULL,
  `id_jenis_angkutan` int(11) NOT NULL,
  `id_jenis_permohonan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
--

INSERT INTO `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan` (`id_mapping_angkutan_jenis_permohonan`, `id_jenis_angkutan`, `id_jenis_permohonan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 1, 2, NULL, NULL),
(5, 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpar_kendaraan_001_merek_kendaraan`
--

CREATE TABLE `cpar_kendaraan_001_merek_kendaraan` (
  `id_merek_kendaraan` int(11) NOT NULL,
  `nm_merek_kendaraan` varchar(100) NOT NULL,
  `slug_merek_kendaraan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_kendaraan_001_merek_kendaraan`
--

INSERT INTO `cpar_kendaraan_001_merek_kendaraan` (`id_merek_kendaraan`, `nm_merek_kendaraan`, `slug_merek_kendaraan`, `created_at`, `updated_at`) VALUES
(1, 'HONDA', 'honda-1', '2023-04-13 17:05:53', '2023-04-13 17:22:43'),
(3, 'DAIHATSU', 'daihatsu-1', '2023-04-13 17:22:56', '2023-04-13 17:29:19'),
(4, 'TOYOTA', 'toyota', '2023-04-13 17:31:08', '2023-04-13 17:31:08'),
(5, 'DATSUN', 'datsun', '2023-04-13 17:31:35', '2023-04-13 17:31:35'),
(6, 'SUZUKI', 'suzuki', '2023-04-13 17:31:47', '2023-04-13 17:31:47'),
(7, 'MITSUBISHI', 'mitsubishi', '2023-04-13 17:31:59', '2023-04-13 17:31:59'),
(8, 'KIA', 'kia', '2023-04-13 17:32:27', '2023-04-13 17:32:27'),
(9, 'ISUZU', 'isuzu', '2023-04-13 17:32:44', '2023-04-13 17:32:44'),
(10, 'NISSAN', 'nissan', '2023-04-13 17:32:55', '2023-04-13 17:32:55'),
(12, 'HINO', 'hino', '2023-05-13 08:21:34', '2023-05-13 08:21:34'),
(13, 'TATA', 'tata', '2023-05-13 08:21:46', '2023-05-13 08:21:46'),
(14, 'UD.TRUCK', 'udtruck', '2023-05-13 14:14:12', '2023-05-13 14:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_kendaraan_002_type_kendaraan`
--

CREATE TABLE `cpar_kendaraan_002_type_kendaraan` (
  `id_type_kendaraan` int(11) NOT NULL,
  `id_merek_kendaraan` int(11) NOT NULL,
  `nm_type_kendaraan` varchar(100) NOT NULL,
  `slug_type_kendaraan` text NOT NULL,
  `status_actived` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_kendaraan_002_type_kendaraan`
--

INSERT INTO `cpar_kendaraan_002_type_kendaraan` (`id_type_kendaraan`, `id_merek_kendaraan`, `nm_type_kendaraan`, `slug_type_kendaraan`, `status_actived`, `created_at`, `updated_at`) VALUES
(4, 1, 'MOBILIO', '', '1', '2023-04-13 18:51:21', '2023-04-13 18:51:21'),
(5, 3, 'SIGRA', '-1', '1', '2023-04-13 18:51:32', '2023-04-13 18:51:32'),
(6, 4, 'NEW AVANZA', '-2', '1', '2023-04-13 18:51:44', '2023-04-13 18:51:44'),
(7, 4, 'AVANZA', '-3', '1', '2023-04-13 18:51:56', '2023-04-13 18:51:56'),
(8, 3, 'XENIA', '-4', '1', '2023-04-13 18:52:08', '2023-04-13 18:52:08'),
(9, 1, 'BRIO', '-5', '1', '2023-04-13 18:52:19', '2023-04-13 18:52:19'),
(10, 4, 'CALYA', '-6', '1', '2023-04-13 18:52:32', '2023-04-13 18:52:32'),
(11, 12, 'DUMP TRUCK', '-7', '1', '2023-05-13 08:22:38', '2023-05-13 08:22:38'),
(12, 7, 'DUMP TRUCK', '-8', '1', '2023-05-13 08:23:00', '2023-05-13 08:23:00'),
(13, 9, 'DUMP TRUCK', '-9', '1', '2023-05-13 08:23:18', '2023-05-13 08:23:18'),
(14, 13, 'DUMP TRUCK', '-10', '1', '2023-05-13 08:23:35', '2023-05-13 08:23:35'),
(15, 4, 'DUMP TRUCK', '-11', '1', '2023-05-13 08:23:58', '2023-05-13 08:23:58'),
(16, 7, 'L 300', '-12', '1', '2023-05-13 10:43:58', '2023-05-13 10:43:58'),
(17, 7, 'DUMP TRUCK ENGKEL', '-13', '1', '2023-05-13 14:15:11', '2023-05-13 14:15:11'),
(18, 7, 'DUMP TRUCK TRONTON', '-14', '1', '2023-05-13 14:15:42', '2023-05-13 14:15:42'),
(19, 7, 'TRONTON LOST BAK', '-15', '1', '2023-05-13 14:16:15', '2023-05-13 14:16:15'),
(20, 7, 'TRONTON KAPSUL/ HIBLOW', '-16', '1', '2023-05-13 14:16:48', '2023-05-13 14:16:48'),
(21, 12, 'DUMP TRUCK TRONTON', '-17', '1', '2023-05-14 01:39:43', '2023-05-14 01:39:43'),
(22, 14, 'TRONTON LOST BAK', '-18', '1', '2023-05-14 01:40:22', '2023-05-14 01:40:22'),
(23, 12, 'TRONTON KAPSUL/ HIBLOW', '-19', '1', '2023-05-14 01:40:33', '2023-05-14 01:40:33'),
(24, 7, 'TRUCK TANGKI', '-20', '1', '2024-01-08 02:17:39', '2024-01-08 02:17:39'),
(25, 12, 'BUS BESAR', '-21', '1', '2024-01-08 04:06:26', '2024-01-08 04:06:26'),
(26, 7, 'TRUCK TRONTON', '-22', '1', '2024-01-08 04:06:43', '2024-01-08 04:06:43'),
(27, 7, 'MOBIL BUS', '-23', '1', '2024-01-08 04:42:46', '2024-01-08 04:42:46'),
(28, 12, 'MOBIL BUS', '-24', '1', '2024-01-08 05:03:27', '2024-01-08 05:03:27'),
(29, 14, 'TRUCK TRONTON', '-25', '1', '2024-01-08 05:09:33', '2024-01-08 05:09:33'),
(30, 7, 'TRUCK TOWING', '-26', '1', '2024-01-08 06:46:33', '2024-01-08 06:46:33'),
(31, 12, 'TRUCK TRONTON', '-27', '1', '2024-01-09 02:31:16', '2024-01-09 02:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_mengangkut_001_mengangkut`
--

CREATE TABLE `cpar_mengangkut_001_mengangkut` (
  `id_mengangkut` int(11) NOT NULL,
  `nm_mengangkut` varchar(100) NOT NULL,
  `slug_mengangkut` text NOT NULL,
  `status_actived` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_mengangkut_001_mengangkut`
--

INSERT INTO `cpar_mengangkut_001_mengangkut` (`id_mengangkut`, `nm_mengangkut`, `slug_mengangkut`, `status_actived`, `created_at`, `updated_at`) VALUES
(3, 'Orang', 'orang', '1', '2023-04-14 16:41:28', '2023-04-14 16:41:28'),
(4, 'Orang / Barang', 'orang-barang', '1', '2023-04-14 16:41:51', '2023-04-14 16:41:51'),
(5, 'Barang', 'barang', '1', '2023-04-14 16:42:59', '2023-04-14 16:42:59'),
(6, 'Pupuk', 'pupuk', '1', '2023-04-14 16:43:08', '2023-04-14 16:43:08'),
(7, 'Karyawan', 'karyawan', '1', '2023-04-14 16:43:14', '2023-04-14 16:43:14'),
(10, 'CLINGKER', 'clingker', '1', '2023-05-13 14:18:22', '2023-05-13 14:20:32'),
(11, 'BARANG KHUSUS', 'barang-khusus', '1', '2023-05-13 14:20:56', '2023-05-13 14:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_mengangkut_002_mapping`
--

CREATE TABLE `cpar_mengangkut_002_mapping` (
  `id_mapping_mengangkut` int(11) NOT NULL,
  `id_mengangkut` int(11) NOT NULL,
  `id_jenis_angkutan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_mengangkut_002_mapping`
--

INSERT INTO `cpar_mengangkut_002_mapping` (`id_mapping_mengangkut`, `id_mengangkut`, `id_jenis_angkutan`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2023-04-18 05:41:49', '2023-04-18 05:41:49'),
(8, 4, 2, '2023-04-18 05:42:08', '2023-04-18 05:42:08'),
(9, 4, 3, '2023-04-18 05:42:14', '2023-04-18 05:42:14'),
(10, 5, 2, '2023-04-18 05:42:26', '2023-04-18 05:42:26'),
(12, 6, 3, '2023-04-18 05:42:42', '2023-04-18 05:42:42'),
(16, 7, 1, '2023-04-18 06:00:47', '2023-04-18 06:00:47'),
(17, 4, 1, '2023-04-26 06:45:28', '2023-04-26 06:45:28'),
(18, 10, 3, '2023-05-13 14:19:10', '2023-05-13 14:19:10'),
(19, 11, 3, '2023-05-13 14:21:32', '2023-05-13 14:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_permohonan_001_jenis_permohonan`
--

CREATE TABLE `cpar_permohonan_001_jenis_permohonan` (
  `id_jenis_permohonan` int(11) NOT NULL,
  `nm_jenis_permohonan` varchar(100) NOT NULL,
  `alias_jenis_permohonan` varchar(100) NOT NULL,
  `status_actived` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_permohonan_001_jenis_permohonan`
--

INSERT INTO `cpar_permohonan_001_jenis_permohonan` (`id_jenis_permohonan`, `nm_jenis_permohonan`, `alias_jenis_permohonan`, `status_actived`, `created_at`, `updated_at`) VALUES
(1, 'Rekomendasi TNKB', 'TNKB', 1, '2023-04-13 04:17:05', '2023-04-13 04:17:05'),
(2, 'Rekomendasi Trayek Angkutan Penumpang', 'Trayek', 1, '2023-04-13 04:17:05', '2023-04-13 04:17:05'),
(3, 'Rekomendasi Angkutan Barang Khusus', 'Mengangkut', 1, '2023-04-13 04:17:05', '2023-04-13 04:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_permohonan_002_permohonan`
--

CREATE TABLE `cpar_permohonan_002_permohonan` (
  `id_par_permohonan` int(11) NOT NULL,
  `nm_par_permohonan` varchar(100) NOT NULL,
  `id_jenis_permohonan` int(11) NOT NULL,
  `status_actived` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_permohonan_002_permohonan`
--

INSERT INTO `cpar_permohonan_002_permohonan` (`id_par_permohonan`, `nm_par_permohonan`, `id_jenis_permohonan`, `status_actived`, `created_at`, `updated_at`) VALUES
(1, 'Plat Kuning ke Plat Hitam', 1, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(2, 'Plat Hitam ke Plat Kuning', 1, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(3, 'Antar Jemput Dalam Provinsi (AJDP)', 2, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(4, 'Antar Kota Dalam Provinsi (AKDP)', 2, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(5, 'Angkutan Sewa Khusus', 2, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(6, 'Angkutan Barang Khusus', 3, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(7, 'Plat Kuning', 1, '1', '2024-01-08 03:00:55', '2024-01-08 03:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_ttd_dokumen`
--

CREATE TABLE `cpar_ttd_dokumen` (
  `id_ttd_dok` int(11) NOT NULL,
  `nm_ttd` varchar(225) NOT NULL,
  `pangkat_gol` varchar(225) NOT NULL,
  `nip_ttd` varchar(21) NOT NULL,
  `jabatan_ttd` varchar(225) NOT NULL,
  `kode_jabatan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_ttd_dokumen`
--

INSERT INTO `cpar_ttd_dokumen` (`id_ttd_dok`, `nm_ttd`, `pangkat_gol`, `nip_ttd`, `jabatan_ttd`, `kode_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Drs. H. ARINARSA JS', 'Pembina Utama Madya (IV/d)', '19710603 199101 1 002', 'KEPALA DINAS PERHUBUNGAN', 1, '2023-04-24 04:11:48', '2023-04-25 14:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `cpar_z001_trayek`
--

CREATE TABLE `cpar_z001_trayek` (
  `id_trayek` int(11) NOT NULL,
  `nm_trayek` text NOT NULL,
  `status_actived` enum('1','2') NOT NULL,
  `slug_trayek` text NOT NULL,
  `id_par_permohonan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpar_z001_trayek`
--

INSERT INTO `cpar_z001_trayek` (`id_trayek`, `nm_trayek`, `status_actived`, `slug_trayek`, `id_par_permohonan`, `created_at`, `updated_at`) VALUES
(4, 'Antar Jemput Dalam Provinsi (AJDP)', '1', 'antar-jemput-dalam-provinsi-ajdp', 3, '2023-04-14 16:24:02', '2023-04-14 16:25:38'),
(5, 'Antar Kota Dalam Provinsi (AKDP)', '1', 'antar-kota-dalam-provinsi-akdp', 4, '2023-04-14 16:25:27', '2023-04-15 14:38:54'),
(7, 'Tidak Dalam Trayek', '1', 'tidak-dalam-trayek', 5, '2023-04-14 16:30:19', '2023-04-14 17:58:13'),
(8, 'Term. Karya Jaya Palembang - Indralaya PP', '1', 'term-karya-jaya-palembang-indralaya-pp', 3, '2023-04-14 16:31:17', '2023-04-14 16:33:34'),
(9, 'PALEMBANG - PRABUMULIH', '1', '', 4, '2023-04-17 06:45:12', '2023-04-17 06:45:12'),
(10, 'PLG-M.DUA-RANAU (PP)', '1', '-1', 4, '2023-04-17 06:45:44', '2023-04-17 06:45:44'),
(11, 'TER. JK.BARING-INDRALAYA', '1', '-2', 4, '2023-04-17 06:45:56', '2023-04-17 06:45:56'),
(12, 'TER. ALANG ALANG LEBAR - SEKAYU', '1', 'ter-alang-alang-lebar-sekayu', 4, '2023-04-17 06:46:05', '2023-04-17 06:46:14'),
(13, 'TER. JK.BARING-K.AGUNG', '1', '-3', 4, '2024-01-08 04:56:37', '2024-01-08 04:56:37'),
(14, 'TER. JK.BARING-PRABU', '1', '-4', 4, '2024-01-08 04:57:06', '2024-01-08 04:57:06'),
(15, 'TER. JK.BARING-PRABU-M. ENIM-TJ. ENIM', '1', '-5', 4, '2024-01-08 04:57:27', '2024-01-08 04:57:27'),
(16, 'TER. JK.BARING-K.AGUNG-TUGU MULYO-P.PANGGANG', '1', '-6', 4, '2024-01-08 04:57:40', '2024-01-08 04:57:40'),
(17, 'TER. JK.BARING-BATURAJA PP', '1', '-7', 4, '2024-01-08 04:57:57', '2024-01-08 04:57:57'),
(18, 'TER. ALANG ALANG LEBAR - TJ. API API', '1', '-8', 4, '2024-01-08 04:58:10', '2024-01-08 04:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `ddd_biodata`
--

CREATE TABLE `ddd_biodata` (
  `id_biodata` int(11) NOT NULL,
  `id_badan_usaha` int(11) NOT NULL,
  `nm_perusahaan_personal` varchar(100) NOT NULL,
  `nm_pimpinan_pemilik` varchar(100) NOT NULL,
  `alamat_biodata` text NOT NULL,
  `email` text DEFAULT NULL,
  `no_telp` varchar(12) NOT NULL,
  `slug_biodata` text NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ddd_biodata`
--

INSERT INTO `ddd_biodata` (`id_biodata`, `id_badan_usaha`, `nm_perusahaan_personal`, `nm_pimpinan_pemilik`, `alamat_biodata`, `email`, `no_telp`, `slug_biodata`, `id_user`, `created_at`, `updated_at`) VALUES
(14, 1, 'PT. BATURAJA MULTI USAHA', 'PT. BATURAJA MULTI USAHA', 'JL. BATURAJA', 'rio@gmail.com', '123312311111', 'pt-baturaja-multi-usaha-1', 6, '2023-04-15 18:54:43', '2023-04-26 05:08:20'),
(15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', 'anta-salam', 7, '2023-04-18 06:54:18', '2023-04-18 06:54:18'),
(16, 4, 'Rio Alba Trackindo', 'Rio Pranata Saputra', 'Jln. Sosial Gandus', 'rio.rps007@gmail.com', '085381947893', 'rio-alba-trackindo', 10, '2023-04-26 05:30:54', '2023-04-26 05:30:54'),
(17, 1, 'PT. BATURAJA MULTI USAHA', 'AMIN', 'Jl. Palembang', 'mutiara@gmail.com', '081283211231', 'pt-baturaja-multi-usaha-1', 11, '2023-04-26 06:36:15', '2023-04-26 06:36:15'),
(18, 1, 'pt.AAABC', 'aaa', 'palembang', 'pt.AAABC@gmail.com', '0812345678', 'ptaaabc', 12, '2023-04-26 06:57:58', '2023-04-26 06:57:58'),
(19, 3, 'mmm', 'hjhjhh', 'gfddsa', 'fansyuri@gmail.com', '09876567898', 'mmm', 13, '2023-04-26 07:11:52', '2023-04-26 07:11:52'),
(20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', 'cv-po-batang-hari-wisata', 15, '2023-05-13 10:41:02', '2023-05-13 10:41:02'),
(21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', 'pt-baturaja-multi-usaha-3', 16, '2023-05-13 14:09:23', '2023-05-14 11:56:54'),
(22, 1, 'PT. SAHALA TRANS LOGISTIK', 'BENNI DEDI SULAIMAN TAMPUBOLON', 'JL. LINTAS MUARA ENIM-LAHAT KM 3, DEPAN SPBU, DESA MUARA LAWAI, KEC. MERAPI TIMUR, KAB. LAHAT, PROVINSI SUMATERA SELATAN', 'sahalatranslogistik@gmail.com', '08115948889', 'pt-sahala-trans-logistik', 17, '2023-05-14 06:01:55', '2023-05-14 06:01:55'),
(23, 1, 'HABIBIE', 'AZMI', 'PALEMBANG', 'azmihabibie17@gmail.com', '123', 'habibie', 19, '2023-09-11 02:15:01', '2023-09-11 02:15:01'),
(24, 1, 'Bumi Intitama Mega Artha', 'Vicky Sumantri', 'Jalan Prof. M. Yamin No. 08', 'ptbima@yahoo.co.id', '082225315044', 'bumi-intitama-mega-artha', 24, '2023-11-13 02:25:00', '2023-11-13 02:25:00'),
(25, 1, 'majumundur', '-', 'jl.', 'anesliorita@gmail.com', '123456', 'majumundur', 25, '2024-01-08 01:53:34', '2024-01-08 01:53:34'),
(26, 1, 'ANUGERAH BUMI MUSI', '-', 'Palembang', 'pt.anugerahbumimusi@gmail.com', '123456', 'anugerah-bumi-musi', 26, '2024-01-08 02:16:25', '2024-01-08 02:16:25'),
(27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', 'ptdamri-cabang-palembang', 27, '2024-01-08 04:03:44', '2024-01-08 04:03:44'),
(28, 1, 'LESTARI TRANS ENERGY', '-', 'Palembang', 'pt.lestaritransenergy@gmail.com', '123456', 'lestari-trans-energy', 28, '2024-01-08 04:05:22', '2024-01-08 04:05:22'),
(29, 1, 'BAGONG DEKAKA MAKMUR', '-', 'Muaraenim', 'pt.bagongdekakamakmur@gmail.com', '123456', 'bagong-dekaka-makmur', 29, '2024-01-08 04:41:58', '2024-01-08 04:41:58'),
(30, 1, 'SUMBARAMULTI ARTHA', '-', 'Ogan Komering Ulu', 'pt.sumbaramultiartha@gmail.com', '123456', 'sumbaramulti-artha', 30, '2024-01-08 05:02:36', '2024-01-08 05:02:36'),
(31, 1, 'BARA UNGGUL SUMATERA', '-', 'Palembang', 'pt.baraunggulsumatera@gmail.com', '123456', 'bara-unggul-sumatera', 31, '2024-01-08 05:08:51', '2024-01-08 05:08:51'),
(32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', 'semangus-indah-express', 32, '2024-01-08 05:17:21', '2024-01-08 05:17:21'),
(33, 2, 'LAPAN ENAM HP', '-', 'Palembang', 'cv.lapanenamhp@gmail.com', '123456', 'lapan-enam-hp', 33, '2024-01-08 06:45:45', '2024-01-08 06:45:45'),
(34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', 'samudra-jaya-bersama', 34, '2024-01-09 02:26:30', '2024-01-09 02:26:30'),
(35, 4, 'Satu', 'Ya', 'Palembang', 'angkutanpemprovsumsel@gmail.com', '0866', 'satu', 14, '2024-01-09 03:22:44', '2024-01-09 03:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `ddd_biodata_upload_dok`
--

CREATE TABLE `ddd_biodata_upload_dok` (
  `id_upload_dok` int(11) NOT NULL,
  `jenis_dok` int(11) NOT NULL,
  `file_dokumen` text NOT NULL,
  `id_biodata` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ddd_biodata_upload_dok`
--

INSERT INTO `ddd_biodata_upload_dok` (`id_upload_dok`, `jenis_dok`, `file_dokumen`, `id_biodata`, `created_at`, `updated_at`) VALUES
(19, 1, '230427075529.xlsx', 14, '2023-04-27 00:55:29', '2023-04-27 00:55:29'),
(20, 3, '230427075541.docx', 14, '2023-04-27 00:55:41', '2023-04-27 00:55:41'),
(21, 1, '230514090858.pdf', 21, '2023-05-14 02:08:58', '2023-05-14 02:08:58'),
(22, 1, '230514010732.pdf', 22, '2023-05-14 06:07:32', '2023-05-14 06:07:32'),
(23, 4, '230514010745.pdf', 22, '2023-05-14 06:07:45', '2023-05-14 06:07:45'),
(24, 3, '230514010929.pdf', 22, '2023-05-14 06:09:29', '2023-05-14 06:09:29'),
(25, 3, '230514065746.pdf', 21, '2023-05-14 11:57:46', '2023-05-14 11:57:46'),
(26, 1, '231114023227.pdf', 24, '2023-11-14 07:32:27', '2023-11-14 07:32:27'),
(27, 2, '231114023256.pdf', 24, '2023-11-14 07:32:56', '2023-11-14 07:32:56'),
(28, 3, '231114023328.pdf', 24, '2023-11-14 07:33:28', '2023-11-14 07:33:28'),
(29, 4, '231114023344.pdf', 24, '2023-11-14 07:33:44', '2023-11-14 07:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `ddd_data_kendaraan`
--

CREATE TABLE `ddd_data_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `id_merek_kendaraan` int(11) NOT NULL,
  `id_type_kendaraan` int(11) NOT NULL,
  `nm_kendaraan` varchar(100) NOT NULL,
  `plat_no_kendaraan` varchar(11) NOT NULL,
  `daya_angkut_orang` int(11) NOT NULL,
  `daya_angkut_barang` int(11) NOT NULL,
  `thn_pembuatan` int(4) NOT NULL,
  `no_rangka` varchar(50) NOT NULL,
  `no_mesin` varchar(50) NOT NULL,
  `id_biodata` int(11) NOT NULL,
  `status_actived` enum('1','2') NOT NULL,
  `file_kir` text DEFAULT NULL,
  `file_stnk` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ddd_data_kendaraan`
--

INSERT INTO `ddd_data_kendaraan` (`id_kendaraan`, `id_merek_kendaraan`, `id_type_kendaraan`, `nm_kendaraan`, `plat_no_kendaraan`, `daya_angkut_orang`, `daya_angkut_barang`, `thn_pembuatan`, `no_rangka`, `no_mesin`, `id_biodata`, `status_actived`, `file_kir`, `file_stnk`, `created_at`, `updated_at`) VALUES
(4, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, '1', NULL, NULL, '2023-04-18 06:55:07', '2023-04-18 06:55:07'),
(6, 1, 9, 'Brio G Type x RIo', 'B 1231 AX', 45, 35, 2020, 'MJEFM8JW2PJX11x085', 'J08EWDJ20962x', 14, '1', '230427090035.docx', '230427092401.xlsx', '2023-04-18 19:27:55', '2023-04-27 02:24:01'),
(10, 3, 8, 'Type G RIo', 'BG 1233 ASS', 6, 50, 2020, 'FFDDDRRRRRF', '1123DDDSSAAAAA', 14, '1', NULL, NULL, '2023-04-18 19:49:15', '2023-04-18 20:01:35'),
(11, 4, 7, 'Avanza Veloz', 'BG 2333 IK', 6, 122, 2016, '718272626261', '8384746474747', 16, '1', NULL, NULL, '2023-04-26 05:34:44', '2023-04-26 05:34:44'),
(12, 1, 4, 'Mobilio PZX', 'BG 1231 SS', 6, 1111, 2014, '13123ASAHHHB', 'HHAGGSHSHS887', 17, '1', NULL, NULL, '2023-04-26 06:38:13', '2023-04-26 06:38:13'),
(13, 4, 6, 'veloz', 'bg 1234 aa', 6, 150, 2022, '123456789', '123456', 18, '1', NULL, NULL, '2023-04-26 06:59:30', '2023-04-26 06:59:30'),
(14, 1, 4, 'mmm', '67677', 10, 1000, 2023, '1245555', '3211111', 19, '1', NULL, NULL, '2023-04-26 07:17:30', '2023-04-26 07:17:30'),
(15, 7, 16, 'L 300', 'BG 7120 VB', 12, 110, 2018, 'MK2LOPU39JJ009114', '4D56C-S64518', 20, '1', NULL, NULL, '2023-05-13 10:48:03', '2023-05-13 10:48:03'),
(16, 7, 16, 'L 300', 'BG 7001 VA', 10, 90, 2016, 'MHMLOWY39GK010045', '4D56C-P47314', 20, '1', NULL, NULL, '2023-05-13 10:49:06', '2023-05-13 10:49:06'),
(17, 7, 16, 'L 300', 'BG 7051 VA', 12, 110, 2017, 'MK2LOWY39HK000242', '4D56C-R62740', 20, '1', NULL, NULL, '2023-05-13 10:49:55', '2023-05-13 10:49:55'),
(18, 7, 16, 'L 300', 'BG 7018 VA', 12, 110, 2016, 'MHMLOWY39GK009851', '4D56C-P10992', 20, '1', NULL, NULL, '2023-05-13 10:50:36', '2023-05-13 10:50:36'),
(19, 7, 16, 'L 300', 'BG 7426 VA', 12, 110, 2018, 'MK2LOWY39JK000519', '4D56C-S29131', 20, '1', NULL, NULL, '2023-05-13 10:51:16', '2023-05-13 10:51:16'),
(20, 7, 16, 'L 300', 'BG 7027 VA', 10, 90, 2016, 'MHMLOWY39GK010248', '4D56C-P73451', 20, '1', NULL, NULL, '2023-05-13 10:51:59', '2023-05-13 10:51:59'),
(21, 7, 16, 'L 300', 'BG 7121 VB', 12, 110, 2018, 'MK2LOPU39JJ001912', '4D56C-S64502', 20, '1', NULL, NULL, '2023-05-13 10:52:37', '2023-05-13 10:52:37'),
(22, 7, 16, 'L 300', 'BG 7425 VA', 12, 110, 2018, 'MHMLOWY39JK000515', '4D56C-S29129', 20, '1', NULL, NULL, '2023-05-13 10:53:13', '2023-05-13 10:53:13'),
(23, 7, 16, 'L 300', 'BG 7013 VA', 12, 110, 2015, 'MHMLOWY39FK009692', '4D56C-L70464', 20, '1', NULL, NULL, '2023-05-13 10:53:51', '2023-05-13 10:53:51'),
(24, 7, 16, 'L 300', 'BG 7294 V', 12, 110, 2012, 'MHMLOWY39CK007201', '4D56C-H51101', 20, '1', NULL, NULL, '2023-05-13 10:54:38', '2023-05-13 10:54:38'),
(25, 7, 12, 'L 300', 'BG 1487 VC', 12, 110, 2018, 'MK2LOPU39JJ014049', '4D56C-SX6719', 20, '1', NULL, NULL, '2023-05-13 10:55:19', '2023-05-13 10:55:19'),
(26, 7, 16, 'L 300', 'BG 7052 VA', 12, 110, 2017, 'MK2LOWY39HK000279', '4D56C-R62789', 20, '1', NULL, NULL, '2023-05-13 10:55:52', '2023-05-13 10:55:52'),
(27, 7, 16, 'L 300', 'BG 7047 VA', 12, 110, 2017, 'MK2LOPU39HK000903', '4D56C-R49107', 20, '1', NULL, NULL, '2023-05-13 10:56:30', '2023-05-13 10:56:30'),
(28, 7, 16, 'L 300', 'BG 7048 VA', 12, 110, 2017, 'MK2LOPU39HK000906', '4D56C-R49105', 20, '1', NULL, NULL, '2023-05-13 10:57:06', '2023-05-13 10:57:06'),
(29, 7, 16, 'L 300', 'BG 7010 VA', 12, 110, 2015, 'MHMLOWY39FK009507', '4D56C-L46285', 20, '1', NULL, NULL, '2023-05-13 10:57:46', '2023-05-13 10:57:46'),
(30, 7, 16, 'L 300', 'BG 7019 VA', 12, 110, 2016, 'MHMLOWY39GK009853', '4D56C-P11014', 20, '1', NULL, NULL, '2023-05-13 10:58:23', '2023-05-13 10:58:23'),
(31, 7, 16, 'L 300', 'BG 7032 V', 12, 110, 2017, 'MHMLOWY39HK010457', '4D56C-R12660', 20, '1', NULL, NULL, '2023-05-13 10:59:09', '2023-05-13 10:59:09'),
(32, 7, 16, 'L 300', 'BG 7025 VA', 17, 160, 2016, 'MHMFE71P9GK05902', '4D34T-P44810', 20, '1', NULL, NULL, '2023-05-13 10:59:55', '2023-05-13 10:59:55'),
(33, 7, 16, 'L 300', 'BG 7002 VC', 10, 110, 2016, 'MHMLOWY39GK010046', '4D56C-P47309', 20, '1', NULL, NULL, '2023-05-13 11:00:34', '2023-05-13 11:00:34'),
(34, 7, 16, 'L 300', 'BG 7443 V', 12, 110, 2011, 'MHMLOWY39BK005436', '4D56C-G15270', 20, '1', NULL, NULL, '2023-05-13 11:01:25', '2023-05-13 11:01:25'),
(35, 7, 16, 'L 300', 'BG 7291 V', 11, 100, 2012, 'MHMLOWY39CK006853', '4D56C-H27542', 20, '1', NULL, NULL, '2023-05-13 11:02:08', '2023-05-13 11:02:08'),
(36, 7, 12, 'DUMP TRUCK', 'BG 8386 IB', 3, 5320, 2018, 'MHMFM517AJK012116', '6D16RY6014', 21, '1', NULL, NULL, '2023-05-13 14:25:46', '2023-05-13 14:25:46'),
(37, 7, 12, 'DUMP TRUCK', 'BG 8382 IB', 3, 3970, 2017, 'MHMFE75PFHK004980', '4D34TR84475', 21, '1', NULL, NULL, '2023-05-13 14:27:14', '2023-05-13 14:27:14'),
(38, 7, 12, 'DUMP TRUCK', 'BG 8384 IB', 3, 3970, 2017, 'MHMFE75PFHK004979', '4D34TR84416', 21, '1', NULL, NULL, '2023-05-13 14:28:27', '2023-05-13 14:28:27'),
(39, 7, 12, 'DUMP TRUCK', 'BG 8256 IB', 3, 3970, 2017, 'MHMFE75PFHK004836', '4D34TR84165', 21, '1', NULL, NULL, '2023-05-13 14:29:54', '2023-05-13 14:29:54'),
(40, 7, 12, 'DUMP TRUCK', 'BG 8391 IB', 3, 3970, 2017, 'MHMFE75PFHK004981', '4D34TR84417', 21, '1', NULL, NULL, '2023-05-13 14:30:38', '2023-05-13 14:30:38'),
(41, 7, 17, 'ENGKEL', 'BG 8427 IC', 3, 5320, 2018, 'MHMFM517AJK012105', '6D16RY5982', 21, '1', NULL, NULL, '2023-05-13 14:32:03', '2023-05-13 14:32:03'),
(42, 7, 17, 'ENGKEL', 'BG 8387 IC', 3, 5320, 2018, 'MHMFM517AJK012112', '6D16RY6017', 21, '1', NULL, NULL, '2023-05-13 14:32:49', '2023-05-13 14:32:49'),
(43, 7, 17, 'ENGKEL', 'BG 8389 IC', 3, 5320, 2018, 'MHMFM517AJK012103', '6D16RY6019', 21, '1', NULL, NULL, '2023-05-13 14:33:37', '2023-05-13 14:33:37'),
(44, 7, 17, 'ENGKEL', 'BG 8566 IC', 3, 5320, 2018, 'MHMFM517AJK012130', '6D16RY6182', 21, '1', NULL, NULL, '2023-05-13 14:34:19', '2023-05-13 14:34:19'),
(45, 7, 17, 'ENGKEL', 'BG 8386 IC', 3, 5320, 2018, 'MHMFM517AJK012117', '6D16RY6015', 21, '1', NULL, NULL, '2023-05-13 14:37:22', '2023-05-13 14:37:22'),
(47, 12, 21, 'DUMP TRUCK', 'BG 8893 IC', 3, 9170, 2018, 'MJEFM8JN1JJ21996', 'J08EUF195280', 21, '1', NULL, NULL, '2023-05-14 01:42:30', '2023-05-14 01:42:30'),
(48, 12, 21, 'DUMP TRUCK', 'BG 8891 IC', 3, 9170, 2018, 'MJEFM8JN1JJ21997', 'J08EUF195281', 21, '1', NULL, NULL, '2023-05-14 01:43:34', '2023-05-14 01:43:34'),
(49, 12, 21, 'DUMP TRUCK', 'BG 8892 IC', 3, 9170, 2018, 'MJEFM8JN1JE21998', 'J08EUFJ95280', 21, '1', NULL, NULL, '2023-05-14 01:44:17', '2023-05-14 01:44:17'),
(50, 12, 21, 'DUMP TRUCK', 'BG 8894 IC', 3, 9170, 2018, 'MJEFM8JNIJJE21994', 'J08EUFJ95278', 21, '1', NULL, NULL, '2023-05-14 01:44:59', '2023-05-14 01:44:59'),
(51, 12, 21, 'DUMP TRUCK', 'BG 8890 IC', 3, 9170, 2018, 'MJEFM8JIJJE21995', 'J08EUFJ95279', 21, '1', NULL, NULL, '2023-05-14 01:45:34', '2023-05-14 01:45:34'),
(52, 14, 22, 'TRONTON', 'BG 8551 IL', 3, 13590, 2016, 'JPCZZ30D6HT015664', 'GH8438237A1P', 21, '1', NULL, NULL, '2023-05-14 01:46:45', '2023-05-14 01:46:45'),
(53, 14, 22, 'TRONTON', 'BG 8554 IL', 3, 13590, 2016, 'JPCZZ30D8HT015731', 'GH8438823A1P', 21, '1', NULL, NULL, '2023-05-14 01:47:23', '2023-05-14 01:47:23'),
(54, 14, 22, 'TRONTON', 'BG 8857 IL', 3, 13590, 2016, 'JPCZZ30D2HJ015577', 'GH8435165A1P', 21, '1', NULL, NULL, '2023-05-14 01:47:57', '2023-05-14 01:47:57'),
(55, 14, 22, 'TRONTON', 'BG 8859 IL', 3, 13590, 2016, 'JPCZZ30D8HJ015566', 'GH8437717A1P', 21, '1', NULL, NULL, '2023-05-14 01:49:28', '2023-05-14 01:49:28'),
(56, 14, 22, 'TRONTON', 'BG 8560 IL', 3, 10920, 2016, 'JPCZZ0DD1HT015554', 'GH8437811A1P', 21, '1', NULL, NULL, '2023-05-14 01:50:41', '2023-05-14 01:50:41'),
(57, 12, 23, 'KAPSUL/ HIBLOW', 'BG 8856 IC', 3, 9680, 2018, 'MJEFM8JWIJJW12088', 'J08EUFJ94171', 21, '1', NULL, NULL, '2023-05-14 01:55:47', '2023-05-14 01:55:47'),
(58, 12, 23, 'KAPSUL/ HIBLOW', 'BG 8860 IC', 3, 12000, 2018, 'MJEFM8JWIJJE12103', 'J08EUFJ94342', 21, '1', NULL, NULL, '2023-05-14 01:56:30', '2023-05-14 01:56:30'),
(59, 12, 23, 'KAPSUL/ HIBLOW', 'BG 8865 IC', 3, 12000, 2018, 'MJEFM8JWIJJE12102', 'J08EUFJ94335', 21, '1', NULL, NULL, '2023-05-14 01:57:13', '2023-05-14 01:57:13'),
(60, 12, 11, 'KAPSUL/ HIBLOW', 'BG 8867 IC', 3, 9680, 2018, 'MJEUFM8JWIJJE12090', 'J08EUFJ94174', 21, '1', NULL, NULL, '2023-05-14 01:57:53', '2023-05-14 01:57:53'),
(61, 12, 23, 'KAPSUL/ HIBLOW', 'BG 8870 IC', 3, 12000, 2018, 'MJEFM8JWIJJE12084', 'J08EUFJ94121', 21, '1', NULL, NULL, '2023-05-14 01:58:41', '2023-05-14 01:58:41'),
(62, 7, 12, 'DUMP TRUCK', 'BG 8031', 3, 0, 2018, '-', '-', 22, '1', NULL, NULL, '2023-05-14 06:11:42', '2023-05-14 06:11:42'),
(63, 12, 23, 'MOBIL TANGKI', 'BG 8014 CI', 3, 11120, 2020, 'MJEFM8JNKEJM-44087', 'J08EUFJ67507', 24, '1', '231116091310.pdf', '231116091324.pdf', '2023-11-14 06:59:21', '2023-11-16 02:13:24'),
(64, 7, 20, 'MOBIL TANGKI', 'BG  8116 CG', 3, 10900, 2020, 'MHMFN527MLK007865', '6D16-U26043', 24, '1', '231116091356.pdf', '231116091407.pdf', '2023-11-14 07:03:32', '2023-11-16 02:14:07'),
(65, 7, 20, 'MOBIL TANGKI', 'BG 8649 CD', 3, 5080, 2021, 'MHMFN527HCK007809', '6D16H64117', 24, '1', '231116091423.pdf', '231116091435.pdf', '2023-11-14 07:06:53', '2023-11-16 02:14:35'),
(67, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', 'BE 8190 KU', 3, 8000, 2021, 'MHMFE75PRMK040516', '4D34TXY6612', 26, '1', NULL, NULL, '2024-01-08 02:19:43', '2024-01-08 02:30:47'),
(68, 12, 25, 'BUS BESAR', 'BG 7424 AO', 46, 450, 2015, 'MJERK8JSKFJN17692', 'J08EUFJ72572', 27, '1', NULL, NULL, '2024-01-08 04:08:20', '2024-01-08 04:08:20'),
(70, 12, 25, 'BUS BESAR', 'BG 7420 AO', 46, 450, 2015, 'MJERK8JSKFJN17699', 'J08EUFJ72501', 27, '1', NULL, NULL, '2024-01-08 04:09:19', '2024-01-08 04:09:19'),
(71, 12, 25, 'BUS BESAR', 'BG 7849 AO', 56, 550, 2014, 'MJERK8JSKFJN16989', 'J08EUFJ65455', 27, '1', NULL, NULL, '2024-01-08 04:10:37', '2024-01-08 04:10:37'),
(72, 12, 25, 'BUS BESAR', 'BG 7416 AO', 46, 450, 2015, 'MJERK8JSKFJN17706', 'J08EUFJ72598', 27, '1', NULL, NULL, '2024-01-08 04:11:17', '2024-01-08 04:11:17'),
(73, 12, 25, 'BUS BESAR', 'BG 7417 AO', 46, 450, 2015, 'MJERK8JSKFJN17707', 'J08EUFJ72599', 27, '1', NULL, NULL, '2024-01-08 04:11:59', '2024-01-08 04:11:59'),
(74, 12, 11, 'BUS BESAR', 'BG 7419 AO', 46, 450, 2015, 'MJERK8JSKFJN17708', 'J08EUFJ72600', 27, '1', NULL, NULL, '2024-01-08 04:13:13', '2024-01-08 04:13:13'),
(75, 12, 25, 'BUS BESAR', 'BG 7841 AO', 56, 550, 2014, 'MJERK8JSKFJN16905', 'J08EUFJ64533', 27, '1', NULL, NULL, '2024-01-08 04:13:55', '2024-01-08 04:13:55'),
(76, 12, 25, 'BUS BESAR', 'BG 7751 AO', 56, 550, 2014, 'MJERK8JSKEJM16796', 'J08EUFJ64458', 27, '1', NULL, NULL, '2024-01-08 04:14:33', '2024-01-08 04:14:33'),
(77, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '1', 3, 26000, 2023, 'MHMFN62GPPK001624', '6M60-293089', 28, '1', NULL, NULL, '2024-01-08 04:14:58', '2024-01-08 04:14:58'),
(78, 12, 25, 'BUS BESAR', 'BG 7418 AO', 46, 450, 2015, 'MJERK8JSKFJN172759', 'J08EUFJ72759', 27, '1', NULL, NULL, '2024-01-08 04:15:17', '2024-01-08 04:15:17'),
(79, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '2', 3, 26000, 2023, 'MHMFN62GPPK001611', '6M60-293027', 28, '1', NULL, NULL, '2024-01-08 04:15:51', '2024-01-08 04:15:51'),
(80, 12, 25, 'BUS BESAR', 'BG 7757 AO', 46, 450, 2015, 'MJERK8JSKFJN17819', 'J08EUFJ72831', 27, '1', NULL, NULL, '2024-01-08 04:15:56', '2024-01-08 04:15:56'),
(81, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '3', 3, 26000, 2023, 'MHMFN62GPPK001621', '6M60-293082', 28, '1', NULL, NULL, '2024-01-08 04:16:26', '2024-01-08 04:16:26'),
(82, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '4', 3, 26000, 2023, 'MHMFN62GPPK001632', '6M60-293092', 28, '1', NULL, NULL, '2024-01-08 04:17:02', '2024-01-08 04:17:02'),
(83, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '5', 3, 26000, 2023, 'MHMFN62GPPK001613', '6M60-293090', 28, '1', NULL, NULL, '2024-01-08 04:17:42', '2024-01-08 04:17:42'),
(84, 12, 25, 'BUS BESAR', 'BG 7456 AO', 46, 450, 2015, 'MJERK8JSKFJN17824', 'J08EUFJ72836', 27, '1', NULL, NULL, '2024-01-08 04:20:18', '2024-01-08 04:20:18'),
(85, 12, 25, 'BUS BESAR', 'BG 7430 AO', 46, 450, 2015, 'MJERK8JSKFJN17826', 'J08EUFJ72844', 27, '1', NULL, NULL, '2024-01-08 04:21:00', '2024-01-08 04:21:00'),
(86, 12, 25, 'BUS BESAR', 'BG 7759 AO', 56, 550, 2014, 'MJERK8JSKEJM6792', 'J08EUFJ64424', 27, '1', NULL, NULL, '2024-01-08 04:34:49', '2024-01-08 04:34:49'),
(87, 12, 25, 'BUS BESAR', 'BG 7427 AO', 46, 450, 2015, 'MJERK8JSKFJN17793', 'J08EUFJ72763', 27, '1', NULL, NULL, '2024-01-08 04:35:41', '2024-01-08 04:35:41'),
(88, 12, 25, 'BUS BESAR', 'BG 7844 AO', 56, 550, 2014, 'MJERK8JSKFJN16807', 'J08EUFJ84535', 27, '1', NULL, NULL, '2024-01-08 04:36:19', '2024-01-08 04:36:19'),
(89, 12, 25, 'BUS BESAR', 'BG 7843 AO', 46, 450, 2015, 'MJERK8JSKEJN17858', 'J08EUFJ72906', 27, '1', NULL, NULL, '2024-01-08 04:40:42', '2024-01-08 04:40:42'),
(90, 12, 25, 'BUS BESAR', 'BG 7839 AO', 46, 450, 2018, 'MJERK8JSKRJN17859', 'J08EUGJ72907', 27, '1', NULL, NULL, '2024-01-08 04:43:22', '2024-01-08 04:43:22'),
(91, 12, 25, 'BUS BESAR', 'BG 7749 AO', 56, 550, 2014, 'MJERK8JSJN16798', 'J08EUFJ64460', 27, '1', NULL, NULL, '2024-01-08 04:44:03', '2024-01-08 04:44:03'),
(92, 7, 27, 'MOBIL BUS', 'N 7144 UI', 0, 8000, 2022, 'MHMFE84ENNJ000360', '4V21Y08346', 29, '1', NULL, NULL, '2024-01-08 04:44:06', '2024-01-08 04:44:06'),
(93, 12, 25, 'BUS BESAR', 'BG 7765 AO', 56, 550, 2014, 'MJERK8JSKEJN16799', 'J08EUFJ64491', 27, '1', NULL, NULL, '2024-01-08 04:44:44', '2024-01-08 04:44:44'),
(94, 7, 27, 'MOBIL BUS', 'N 7142 UI', 0, 8000, 2022, 'MHMFE84ENNJ000374', '4V21Y08952', 29, '1', NULL, NULL, '2024-01-08 04:44:58', '2024-01-08 04:44:58'),
(95, 12, 25, 'BUS BESAR', 'BG 7845 AO', 56, 550, 2014, 'MJERK8JSKEJN16810', 'J08EUFJ64538', 27, '1', NULL, NULL, '2024-01-08 04:45:20', '2024-01-08 04:45:20'),
(96, 7, 27, 'MOBIL BUS', 'N 7146 UI', 0, 8000, 2022, 'MHMFE84ENNJ000349', '4V21Y08338', 29, '1', NULL, NULL, '2024-01-08 04:45:45', '2024-01-08 04:45:45'),
(97, 12, 25, 'BUS BESAR', 'BG 7848 AO', 56, 550, 2014, 'MJERK8JSKEJN16809', 'J08EUFJ64537', 27, '1', NULL, NULL, '2024-01-08 04:46:06', '2024-01-08 04:46:06'),
(98, 12, 25, 'BUS BESAR', 'BG 7432 AO', 46, 450, 2015, 'MJERK8JSKFJN17798', 'J08EUFJ72760', 27, '1', NULL, NULL, '2024-01-08 04:47:16', '2024-01-08 04:47:16'),
(99, 12, 25, 'BUS BESAR', 'BG 7428 AO', 46, 450, 2015, 'MJERK8JSKFJN17792', 'J08EUFJ72762', 27, '1', NULL, NULL, '2024-01-08 04:48:35', '2024-01-08 04:48:35'),
(100, 12, 25, 'BUS BESAR', 'BG 7415 AO', 46, 450, 2015, 'MJERK8JSKFJN17705', 'J08EUFJ72597', 27, '1', NULL, NULL, '2024-01-08 04:49:23', '2024-01-08 04:49:23'),
(101, 12, 25, 'BUS BESAR', 'BG 7851 AO', 56, 550, 2014, 'MJERK8JSKEJN16808', 'J08EUFJ64536', 27, '1', NULL, NULL, '2024-01-08 04:50:11', '2024-01-08 04:50:11'),
(102, 12, 25, 'BUS BESAR', 'BG 7850 AO', 56, 550, 2014, 'MJERK8JSKEJN16969', 'J08EUFJ65357', 27, '1', NULL, NULL, '2024-01-08 04:50:49', '2024-01-08 04:50:49'),
(103, 12, 25, 'BUS BESAR', 'BG 7993 AO', 45, 440, 2010, 'MHL368006AJ000281', '904973U0819587', 27, '1', NULL, NULL, '2024-01-08 04:51:58', '2024-01-08 04:51:58'),
(104, 12, 25, 'BUS BESAR', 'BG 7342 AO', 46, 450, 2015, 'MJEFB2WGLFJE14325', 'W04DTNJ84325', 27, '1', NULL, NULL, '2024-01-08 04:52:59', '2024-01-08 04:52:59'),
(105, 12, 25, 'BUS BESAR', 'BG 7414 AO', 46, 450, 2015, 'MJERK8JSKFJN17702', 'J08EUFJ72894', 27, '1', NULL, NULL, '2024-01-08 04:53:39', '2024-01-08 04:53:39'),
(106, 12, 28, 'MOBIL BUS', '6', 0, 8000, 2023, 'MJERK8JSLPJP13656', 'J08EWDJ26742', 30, '1', NULL, NULL, '2024-01-08 05:04:44', '2024-01-08 05:04:44'),
(107, 14, 29, 'MOBIL BARANG / TRUCK TRONTON', 'B 9265 WDB', 3, 26000, 2020, 'MFFCWZ30RLK813097', 'GH8521295A1P', 31, '1', NULL, NULL, '2024-01-08 05:10:40', '2024-01-08 05:10:40'),
(108, 14, 29, 'MOBIL BARANG / TRUCK TRONTON', 'B 9252 WDB', 3, 26000, 2020, 'MFFCWZ30RLK812353', 'GH8511632A1P', 31, '1', NULL, NULL, '2024-01-08 05:11:32', '2024-01-08 05:11:32'),
(109, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '7', 3, 7500, 2023, 'MHMFE75EKPK017711', '4V21Z76918', 32, '1', NULL, NULL, '2024-01-08 05:18:07', '2024-01-08 05:18:07'),
(110, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '8', 3, 7500, 2023, 'MHMFE75EKPK017712', '4V21Z76917', 32, '1', NULL, NULL, '2024-01-08 05:19:02', '2024-01-08 05:19:02'),
(111, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '9', 3, 7500, 2023, 'MHMFE75EKPK017715', '4V21Z76903', 32, '1', NULL, NULL, '2024-01-08 05:20:23', '2024-01-08 05:20:23'),
(112, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '11', 3, 7500, 2023, 'MHMFE75EKPK017706', '4V21Z76907', 32, '1', NULL, NULL, '2024-01-08 05:20:54', '2024-01-08 05:20:54'),
(113, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '10', 3, 7500, 2023, 'MHMFE75EKPK017681', '4V21Z76725', 32, '1', NULL, NULL, '2024-01-08 05:21:23', '2024-01-08 05:21:23'),
(114, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '12', 3, 7500, 2023, 'MHMFE75EKPK015035', '4V21Z48916', 32, '1', NULL, NULL, '2024-01-08 05:21:52', '2024-01-08 05:21:52'),
(115, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '13', 3, 7500, 2023, 'MHMFE75EKPK015036', '4V21Z48917', 32, '1', NULL, NULL, '2024-01-08 05:22:20', '2024-01-08 05:22:20'),
(116, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '14', 3, 7500, 2023, 'MHMFE75EKPK015836', '4V21Z51507', 32, '1', NULL, NULL, '2024-01-08 05:22:53', '2024-01-08 05:22:53'),
(117, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '15', 3, 7500, 2023, 'MHMFE75EKPK015845', '4V21Z51571', 32, '1', NULL, NULL, '2024-01-08 05:23:19', '2024-01-08 05:23:19'),
(118, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '16', 3, 7500, 2023, 'MHMFE75EKPK015851', '4V21Z51564', 32, '1', NULL, NULL, '2024-01-08 05:23:52', '2024-01-08 05:23:52'),
(119, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '17', 3, 7500, 2023, 'MHMFE75EKPK015024', '4V21Z48901', 32, '1', NULL, NULL, '2024-01-08 05:24:23', '2024-01-08 05:24:23'),
(120, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '18', 3, 7500, 2023, 'MHMFE75EKPK015031', '4V21Z48912', 32, '1', NULL, NULL, '2024-01-08 05:25:05', '2024-01-08 05:25:05'),
(121, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '19', 3, 7500, 2023, 'MHMFE75EKPK015033', '4V21Z48918', 32, '1', NULL, NULL, '2024-01-08 05:25:36', '2024-01-08 05:25:36'),
(122, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '20', 3, 7500, 2023, 'MHMFE75EKPK015034', '4V21Z48919', 32, '1', NULL, NULL, '2024-01-08 05:26:07', '2024-01-08 05:26:07'),
(123, 7, 30, 'MOBIL BARANG', '21', 3, 8000, 2023, 'MHMFE84EMPK001898', '4V21-Z64253', 33, '1', NULL, NULL, '2024-01-08 06:48:48', '2024-01-08 06:48:48'),
(124, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '22', 3, 26000, 2023, 'MJEFM8JW2PJX12004', 'J08EWDJ30530', 34, '1', NULL, NULL, '2024-01-09 02:33:15', '2024-01-09 02:33:15'),
(125, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '23', 3, 26000, 2023, 'MJEFM8JW2PJX12003', 'J08EWDJ30529', 34, '1', NULL, NULL, '2024-01-09 02:33:54', '2024-01-09 02:33:54'),
(126, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '24', 3, 26000, 2023, 'MJEFM8JW2PJX12002', 'J08EWDJ30520', 34, '1', NULL, NULL, '2024-01-09 02:34:20', '2024-01-09 02:34:20'),
(127, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '25', 3, 26000, 2023, 'MJEFM8JW2PJX11976', 'J08EWDJ30444', 34, '1', NULL, NULL, '2024-01-09 02:34:52', '2024-01-09 02:34:52'),
(128, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '26', 3, 26000, 2023, 'MJEFM8JW2PJX11975', 'J08EWDJ30443', 34, '1', NULL, NULL, '2024-01-09 02:35:24', '2024-01-09 02:35:24'),
(129, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '27', 3, 26000, 2023, 'MJEFM8JW2PJX11907', 'J08EWDJ30231', 34, '1', NULL, NULL, '2024-01-09 02:37:04', '2024-01-09 02:37:04'),
(130, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '28', 3, 26000, 2023, 'MJEFM8JW2PJX11906', 'J08EWDJ30210', 34, '1', NULL, NULL, '2024-01-09 02:37:28', '2024-01-09 02:37:28'),
(131, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '29', 3, 26000, 2023, 'MJEFM8JW2PJX11904', 'J08EWDJ30207', 34, '1', NULL, NULL, '2024-01-09 02:38:02', '2024-01-09 02:38:02'),
(132, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '30', 3, 26000, 2023, 'MJEFM8JW2PJX11903', 'J08EWDJ30206', 34, '1', NULL, NULL, '2024-01-09 02:38:30', '2024-01-09 02:38:30'),
(133, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '31', 3, 26000, 2023, 'MJEFM8JW2PJX11863', 'J08EWDJ30038', 34, '1', NULL, NULL, '2024-01-09 02:39:04', '2024-01-09 02:39:04'),
(134, 1, 9, '-', '-', 4, 4, 2024, 'Jks', 'Jje', 35, '1', NULL, NULL, '2024-01-09 03:32:36', '2024-01-09 03:32:36'),
(135, 14, 22, 'aaaaaaa', '20', 22, 12, 2024, '21', '12', 32, '1', NULL, NULL, '2024-01-09 17:05:10', '2024-01-09 17:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `tr_permohonan`
--

CREATE TABLE `tr_permohonan` (
  `id_permohonan_izin` int(11) NOT NULL,
  `id_jenis_permohonan` int(11) NOT NULL,
  `id_par_permohonan` int(11) NOT NULL,
  `id_trayek` int(11) NOT NULL,
  `id_jenis_angkutan` int(11) DEFAULT NULL,
  `id_mengangkut` int(11) NOT NULL,
  `id_merek_kendaraan` int(11) NOT NULL,
  `id_type_kendaraan` int(11) NOT NULL,
  `nm_kendaraan` varchar(100) NOT NULL,
  `plat_no_kendaraan` varchar(11) NOT NULL,
  `daya_angkut_orang` int(11) NOT NULL,
  `daya_angkut_barang` int(11) NOT NULL,
  `thn_pembuatan` int(4) NOT NULL,
  `no_rangka` varchar(50) NOT NULL,
  `no_mesin` varchar(50) NOT NULL,
  `id_biodata` int(11) NOT NULL,
  `id_badan_usaha` int(11) NOT NULL,
  `nm_perusahaan_personal` varchar(100) NOT NULL,
  `nm_pimpinan_pemilik` varchar(100) NOT NULL,
  `alamat_biodata` text NOT NULL,
  `email` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `tgl_kirim_permohonan` datetime NOT NULL,
  `status_permohonan` enum('1','2','3','4','5') NOT NULL COMMENT '1 = draft, 2 = kirim, 3 = ditolak, 4 = di proses, 5 = selesai / diterima',
  `file_kir` text DEFAULT NULL,
  `file_stnk` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_kendaraan_history` bigint(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tr_permohonan`
--

INSERT INTO `tr_permohonan` (`id_permohonan_izin`, `id_jenis_permohonan`, `id_par_permohonan`, `id_trayek`, `id_jenis_angkutan`, `id_mengangkut`, `id_merek_kendaraan`, `id_type_kendaraan`, `nm_kendaraan`, `plat_no_kendaraan`, `daya_angkut_orang`, `daya_angkut_barang`, `thn_pembuatan`, `no_rangka`, `no_mesin`, `id_biodata`, `id_badan_usaha`, `nm_perusahaan_personal`, `nm_pimpinan_pemilik`, `alamat_biodata`, `email`, `no_telp`, `tgl_kirim_permohonan`, `status_permohonan`, `file_kir`, `file_stnk`, `created_at`, `updated_at`, `id_kendaraan_history`) VALUES
(15, 2, 4, 9, 1, 4, 4, 10, 'Calya Ribon', 'bg 1221 dd', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-23 22:45:41', '3', NULL, NULL, '2023-04-23 15:45:41', '2023-05-13 08:55:58', NULL),
(21, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7120 VB', 12, 110, 2018, 'MK2LOPU39JJ009114', '4D56C-S64518', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 18:03:37', '4', NULL, NULL, '2023-05-13 11:03:37', '2023-05-14 14:00:26', NULL),
(22, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7001 VA', 10, 90, 2016, 'MHMLOWY39GK010045', '4D56C-P47314', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 18:04:50', '2', NULL, NULL, '2023-05-13 11:04:50', '2023-05-13 11:04:50', NULL),
(23, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7051 VA', 12, 110, 2017, 'MK2LOWY39HK000242', '4D56C-R62740', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 18:05:55', '2', NULL, NULL, '2023-05-13 11:05:55', '2023-05-13 11:05:55', NULL),
(24, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7018 VA', 12, 110, 2016, 'MHMLOWY39GK009851', '4D56C-P10992', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 18:06:24', '2', NULL, NULL, '2023-05-13 11:06:24', '2023-05-13 11:06:24', NULL),
(25, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7426 VA', 12, 110, 2018, 'MK2LOWY39JK000519', '4D56C-S29131', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 18:06:57', '2', NULL, NULL, '2023-05-13 11:06:57', '2023-05-13 11:06:57', NULL),
(26, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7027 VA', 10, 90, 2016, 'MHMLOWY39GK010248', '4D56C-P73451', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 18:07:26', '2', NULL, NULL, '2023-05-13 11:07:26', '2023-05-13 11:07:26', NULL),
(27, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7121 VB', 12, 110, 2018, 'MK2LOPU39JJ001912', '4D56C-S64502', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 19:05:53', '2', NULL, NULL, '2023-05-13 12:05:53', '2023-05-13 12:05:53', NULL),
(28, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7425 VA', 12, 110, 2018, 'MHMLOWY39JK000515', '4D56C-S29129', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:30:12', '2', NULL, NULL, '2023-05-13 13:30:12', '2023-05-13 13:30:12', NULL),
(29, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7013 VA', 12, 110, 2015, 'MHMLOWY39FK009692', '4D56C-L70464', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:31:11', '2', NULL, NULL, '2023-05-13 13:31:11', '2023-05-13 13:31:11', NULL),
(30, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7294 V', 12, 110, 2012, 'MHMLOWY39CK007201', '4D56C-H51101', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:32:12', '2', NULL, NULL, '2023-05-13 13:32:12', '2023-05-13 13:32:12', NULL),
(31, 2, 4, 5, 1, 3, 7, 12, 'L 300', 'BG 1487 VC', 12, 110, 2018, 'MK2LOPU39JJ014049', '4D56C-SX6719', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:33:12', '2', NULL, NULL, '2023-05-13 13:33:12', '2023-05-13 13:33:12', NULL),
(32, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7052 VA', 12, 110, 2017, 'MK2LOWY39HK000279', '4D56C-R62789', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:35:37', '2', NULL, NULL, '2023-05-13 13:35:37', '2023-05-13 13:35:37', NULL),
(33, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7047 VA', 12, 110, 2017, 'MK2LOPU39HK000903', '4D56C-R49107', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:36:41', '2', NULL, NULL, '2023-05-13 13:36:41', '2023-05-13 13:36:41', NULL),
(34, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7048 VA', 12, 110, 2017, 'MK2LOPU39HK000906', '4D56C-R49105', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:37:27', '2', NULL, NULL, '2023-05-13 13:37:27', '2023-05-13 13:37:27', NULL),
(35, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7010 VA', 12, 110, 2015, 'MHMLOWY39FK009507', '4D56C-L46285', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:38:15', '2', NULL, NULL, '2023-05-13 13:38:15', '2023-05-13 13:38:15', NULL),
(36, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7019 VA', 12, 110, 2016, 'MHMLOWY39GK009853', '4D56C-P11014', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:38:58', '3', NULL, NULL, '2023-05-13 13:38:58', '2023-05-13 13:59:13', NULL),
(37, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7032 V', 12, 110, 2017, 'MHMLOWY39HK010457', '4D56C-R12660', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:39:35', '4', NULL, NULL, '2023-05-13 13:39:35', '2023-05-13 13:57:12', NULL),
(38, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7025 VA', 17, 160, 2016, 'MHMFE71P9GK05902', '4D34T-P44810', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:40:20', '4', NULL, NULL, '2023-05-13 13:40:20', '2023-05-13 13:54:34', NULL),
(39, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7002 VC', 10, 110, 2016, 'MHMLOWY39GK010046', '4D56C-P47309', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:41:00', '2', NULL, NULL, '2023-05-13 13:41:00', '2023-05-13 13:41:00', NULL),
(40, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7443 V', 12, 110, 2011, 'MHMLOWY39BK005436', '4D56C-G15270', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:41:35', '4', NULL, NULL, '2023-05-13 13:41:35', '2023-05-13 13:53:10', NULL),
(41, 2, 4, 5, 1, 3, 7, 16, 'L 300', 'BG 7291 V', 11, 100, 2012, 'MHMLOWY39CK006853', '4D56C-H27542', 20, 2, 'CV. PO. BATANG HARI WISATA', 'TIARA FITRIA', 'JL. TP. RUSTAM EFFENDI NO.376, KEL. 17 ILIR, KEC. ILIR TIMUR I, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'batanghariwisata@gmail.com', '081272720075', '2023-05-13 20:42:09', '5', NULL, NULL, '2023-05-13 13:42:09', '2023-05-13 13:49:00', NULL),
(43, 3, 6, 0, 3, 11, 7, 12, 'DUMP TRUCK', 'BG 8382 IB', 3, 3970, 2017, 'MHMFE75PFHK004980', '4D34TR84475', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:14:25', '2', NULL, NULL, '2023-05-14 02:14:25', '2023-05-14 14:23:01', NULL),
(44, 3, 6, 0, 3, 11, 7, 12, 'DUMP TRUCK', 'BG 8384 IB', 3, 3970, 2017, 'MHMFE75PFHK004979', '4D34TR84416', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:14:59', '2', NULL, NULL, '2023-05-14 02:14:59', '2023-05-14 02:14:59', NULL),
(45, 3, 6, 0, 3, 11, 7, 12, 'DUMP TRUCK', 'BG 8256 IB', 3, 3970, 2017, 'MHMFE75PFHK004836', '4D34TR84165', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:15:27', '2', NULL, NULL, '2023-05-14 02:15:27', '2023-05-14 02:15:27', NULL),
(46, 3, 6, 0, 3, 11, 7, 12, 'DUMP TRUCK', 'BG 8391 IB', 3, 3970, 2017, 'MHMFE75PFHK004981', '4D34TR84417', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:15:59', '2', NULL, NULL, '2023-05-14 02:15:59', '2023-05-14 02:15:59', NULL),
(47, 3, 6, 0, 3, 11, 7, 17, 'ENGKEL', 'BG 8427 IC', 3, 5320, 2018, 'MHMFM517AJK012105', '6D16RY5982', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:16:33', '2', NULL, NULL, '2023-05-14 02:16:33', '2023-05-14 02:16:33', NULL),
(48, 3, 6, 0, 3, 11, 7, 17, 'ENGKEL', 'BG 8387 IC', 3, 5320, 2018, 'MHMFM517AJK012112', '6D16RY6017', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:17:07', '2', NULL, NULL, '2023-05-14 02:17:07', '2023-05-14 02:17:07', NULL),
(49, 3, 6, 0, 3, 11, 7, 17, 'ENGKEL', 'BG 8389 IC', 3, 5320, 2018, 'MHMFM517AJK012103', '6D16RY6019', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:17:40', '2', NULL, NULL, '2023-05-14 02:17:40', '2023-05-14 02:17:40', NULL),
(50, 3, 6, 0, 3, 11, 7, 17, 'ENGKEL', 'BG 8566 IC', 3, 5320, 2018, 'MHMFM517AJK012130', '6D16RY6182', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:18:08', '2', NULL, NULL, '2023-05-14 02:18:08', '2023-05-14 02:18:08', NULL),
(51, 3, 6, 0, 3, 11, 7, 17, 'ENGKEL', 'BG 8386 IC', 3, 5320, 2018, 'MHMFM517AJK012117', '6D16RY6015', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:18:40', '2', NULL, NULL, '2023-05-14 02:18:40', '2023-05-14 02:18:40', NULL),
(52, 3, 6, 0, 3, 10, 12, 21, 'DUMP TRUCK', 'BG 8893 IC', 3, 9170, 2018, 'MJEFM8JN1JJ21996', 'J08EUF195280', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:20:08', '2', NULL, NULL, '2023-05-14 02:20:08', '2023-05-14 02:20:08', NULL),
(53, 3, 6, 0, 3, 11, 7, 17, 'ENGKEL', 'BG 8386 IC', 3, 5320, 2018, 'MHMFM517AJK012117', '6D16RY6015', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:23:11', '2', NULL, NULL, '2023-05-14 02:23:11', '2023-05-14 02:23:11', NULL),
(54, 3, 6, 0, 3, 10, 12, 21, 'DUMP TRUCK', 'BG 8891 IC', 3, 9170, 2018, 'MJEFM8JN1JJ21997', 'J08EUF195281', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:24:34', '2', NULL, NULL, '2023-05-14 02:24:34', '2023-05-14 02:24:34', NULL),
(55, 3, 6, 0, 3, 10, 12, 21, 'DUMP TRUCK', 'BG 8892 IC', 3, 9170, 2018, 'MJEFM8JN1JE21998', 'J08EUFJ95280', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:28:00', '2', NULL, NULL, '2023-05-14 02:28:00', '2023-05-14 02:28:00', NULL),
(56, 3, 6, 0, 3, 10, 12, 21, 'DUMP TRUCK', 'BG 8894 IC', 3, 9170, 2018, 'MJEFM8JNIJJE21994', 'J08EUFJ95278', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:29:52', '2', NULL, NULL, '2023-05-14 02:29:52', '2023-05-14 02:29:52', NULL),
(57, 3, 6, 0, 3, 10, 12, 21, 'DUMP TRUCK', 'BG 8890 IC', 3, 9170, 2018, 'MJEFM8JIJJE21995', 'J08EUFJ95279', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:30:52', '2', NULL, NULL, '2023-05-14 02:30:52', '2023-05-14 02:30:52', NULL),
(58, 3, 6, 0, 3, 11, 14, 22, 'TRONTON', 'BG 8551 IL', 3, 13590, 2016, 'JPCZZ30D6HT015664', 'GH8438237A1P', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:32:16', '2', NULL, NULL, '2023-05-14 02:32:16', '2023-05-14 02:32:16', NULL),
(59, 3, 6, 0, 3, 11, 14, 22, 'TRONTON', 'BG 8554 IL', 3, 13590, 2016, 'JPCZZ30D8HT015731', 'GH8438823A1P', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:32:48', '2', NULL, NULL, '2023-05-14 02:32:48', '2023-05-14 02:32:48', NULL),
(60, 3, 6, 0, 3, 11, 14, 22, 'TRONTON', 'BG 8857 IL', 3, 13590, 2016, 'JPCZZ30D2HJ015577', 'GH8435165A1P', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:33:18', '2', NULL, NULL, '2023-05-14 02:33:18', '2023-05-14 02:33:18', NULL),
(61, 3, 6, 0, 3, 11, 14, 22, 'TRONTON', 'BG 8859 IL', 3, 13590, 2016, 'JPCZZ30D8HJ015566', 'GH8437717A1P', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:33:54', '2', NULL, NULL, '2023-05-14 02:33:54', '2023-05-14 02:33:54', NULL),
(62, 3, 6, 0, 3, 11, 14, 22, 'TRONTON', 'BG 8560 IL', 3, 10920, 2016, 'JPCZZ0DD1HT015554', 'GH8437811A1P', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:34:27', '3', NULL, NULL, '2023-05-14 02:34:27', '2023-05-14 14:24:19', NULL),
(63, 3, 6, 0, 3, 6, 12, 23, 'KAPSUL/ HIBLOW', 'BG 8856 IC', 3, 9680, 2018, 'MJEFM8JWIJJW12088', 'J08EUFJ94171', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:35:52', '2', NULL, NULL, '2023-05-14 02:35:52', '2023-05-14 02:35:52', NULL),
(64, 3, 6, 0, 3, 6, 12, 23, 'KAPSUL/ HIBLOW', 'BG 8860 IC', 3, 12000, 2018, 'MJEFM8JWIJJE12103', 'J08EUFJ94342', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:36:24', '3', NULL, NULL, '2023-05-14 02:36:24', '2023-05-14 02:49:37', NULL),
(65, 3, 6, 0, 3, 6, 12, 23, 'KAPSUL/ HIBLOW', 'BG 8865 IC', 3, 12000, 2018, 'MJEFM8JWIJJE12102', 'J08EUFJ94335', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:36:57', '5', NULL, NULL, '2023-05-14 02:36:57', '2023-05-14 02:48:37', NULL),
(66, 3, 6, 0, 3, 6, 12, 11, 'KAPSUL/ HIBLOW', 'BG 8867 IC', 3, 9680, 2018, 'MJEUFM8JWIJJE12090', 'J08EUFJ94174', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:37:29', '5', NULL, NULL, '2023-05-14 02:37:29', '2023-05-14 14:06:38', NULL),
(67, 3, 6, 0, 3, 6, 12, 23, 'KAPSUL/ HIBLOW', 'BG 8870 IC', 3, 12000, 2018, 'MJEFM8JWIJJE12084', 'J08EUFJ94121', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 09:38:00', '5', NULL, NULL, '2023-05-14 02:38:00', '2023-05-14 02:43:32', NULL),
(68, 3, 6, 0, 3, 11, 7, 12, 'DUMP TRUCK', 'BG 8386 IB', 3, 5320, 2018, 'MHMFM517AJK012116', '6D16RY6014', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 19:00:41', '5', NULL, NULL, '2023-05-14 12:00:41', '2023-05-14 14:12:44', NULL),
(69, 3, 6, 0, 3, 10, 7, 12, 'DUMP TRUCK', 'BG 8386 IB', 3, 5320, 2018, 'MHMFM517AJK012116', '6D16RY6014', 21, 1, 'PT. BATURAJA MULTI USAHA', 'BASTHONY SANTRI', 'JL. K.H. BASTARI PERUMAHAN OGAN PERMATA INDAH (OPI) JAKABARING BLOK DA 21 D, 21 E, 21 F, KEL. 15 ULU, KEC. JAKABARING, KOTA PALEMBANG, PROVINSI SUMATERA SELATAN', 'baturajamultiusaha@semenbaturaja.co.id', '07115541379', '2023-05-14 19:16:52', '5', NULL, NULL, '2023-05-14 12:16:52', '2023-05-14 12:24:13', NULL),
(73, 3, 6, 0, 3, 11, 12, 23, 'MOBIL TANGKI', 'BG 8014 CI', 3, 11120, 2020, 'MJEFM8JNKEJM-44087', 'J08EUFJ67507', 24, 1, 'Bumi Intitama Mega Artha', 'Vicky Sumantri', 'Jalan Prof. M. Yamin No. 08', 'ptbima@yahoo.co.id', '082225315044', '2023-11-16 09:21:39', '2', '231116091310.pdf', '231116091324.pdf', '2023-11-16 02:21:39', '2023-11-16 02:21:39', NULL),
(74, 3, 6, 0, 3, 11, 7, 20, 'MOBIL TANGKI', 'BG  8116 CG', 3, 10900, 2020, 'MHMFN527MLK007865', '6D16-U26043', 24, 1, 'Bumi Intitama Mega Artha', 'Vicky Sumantri', 'Jalan Prof. M. Yamin No. 08', 'ptbima@yahoo.co.id', '082225315044', '2023-11-16 09:22:15', '2', '231116091356.pdf', '231116091407.pdf', '2023-11-16 02:22:15', '2023-11-16 02:22:15', NULL),
(75, 3, 6, 0, 3, 11, 7, 20, 'MOBIL TANGKI', 'BG 8649 CD', 3, 5080, 2021, 'MHMFN527HCK007809', '6D16H64117', 24, 1, 'Bumi Intitama Mega Artha', 'Vicky Sumantri', 'Jalan Prof. M. Yamin No. 08', 'ptbima@yahoo.co.id', '082225315044', '2023-11-16 09:22:36', '2', '231116091423.pdf', '231116091435.pdf', '2023-11-16 02:22:36', '2023-11-16 02:22:36', NULL),
(79, 1, 2, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', 'BE 8190 KU', 3, 8000, 2021, 'MHMFE75PRMK040516', '4D34TXY6612', 26, 1, 'ANUGERAH BUMI MUSI', '-', 'Palembang', 'pt.anugerahbumimusi@gmail.com', '123456', '2024-01-08 09:39:22', '5', NULL, NULL, '2024-01-08 02:39:22', '2024-01-08 04:00:32', NULL),
(80, 1, 7, 0, 2, 5, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '1', 3, 26000, 2023, 'MHMFN62GPPK001624', '6M60-293089', 28, 1, 'LESTARI TRANS ENERGY', '-', 'Palembang', 'pt.lestaritransenergy@gmail.com', '123456', '2024-01-08 11:18:11', '5', NULL, NULL, '2024-01-08 04:18:11', '2024-01-08 04:27:06', NULL),
(81, 1, 7, 0, 2, 5, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '2', 3, 26000, 2023, 'MHMFN62GPPK001611', '6M60-293027', 28, 1, 'LESTARI TRANS ENERGY', '-', 'Palembang', 'pt.lestaritransenergy@gmail.com', '123456', '2024-01-08 11:18:37', '5', NULL, NULL, '2024-01-08 04:18:37', '2024-01-08 04:29:13', NULL),
(82, 1, 7, 0, 2, 5, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '3', 3, 26000, 2023, 'MHMFN62GPPK001621', '6M60-293082', 28, 1, 'LESTARI TRANS ENERGY', '-', 'Palembang', 'pt.lestaritransenergy@gmail.com', '123456', '2024-01-08 11:19:56', '5', NULL, NULL, '2024-01-08 04:19:56', '2024-01-08 04:30:59', NULL),
(83, 1, 7, 0, 2, 5, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '4', 3, 26000, 2023, 'MHMFN62GPPK001632', '6M60-293092', 28, 1, 'LESTARI TRANS ENERGY', '-', 'Palembang', 'pt.lestaritransenergy@gmail.com', '123456', '2024-01-08 11:20:13', '5', NULL, NULL, '2024-01-08 04:20:13', '2024-01-08 04:36:37', NULL),
(84, 1, 7, 0, 2, 5, 7, 12, 'MOBIL BARANG/ DUMP TRUCK', '5', 3, 26000, 2023, 'MHMFN62GPPK001613', '6M60-293090', 28, 1, 'LESTARI TRANS ENERGY', '-', 'Palembang', 'pt.lestaritransenergy@gmail.com', '123456', '2024-01-08 11:20:28', '5', NULL, NULL, '2024-01-08 04:20:28', '2024-01-08 04:38:52', NULL),
(85, 1, 7, 0, 1, 7, 7, 27, 'MOBIL BUS', 'N 7144 UI', 0, 8000, 2022, 'MHMFE84ENNJ000360', '4V21Y08346', 29, 1, 'BAGONG DEKAKA MAKMUR', '-', 'Muaraenim', 'pt.bagongdekakamakmur@gmail.com', '123456', '2024-01-08 11:47:27', '5', NULL, NULL, '2024-01-08 04:47:27', '2024-01-08 04:55:31', NULL),
(86, 1, 7, 0, 1, 7, 7, 27, 'MOBIL BUS', 'N 7142 UI', 0, 8000, 2022, 'MHMFE84ENNJ000374', '4V21Y08952', 29, 1, 'BAGONG DEKAKA MAKMUR', '-', 'Muaraenim', 'pt.bagongdekakamakmur@gmail.com', '123456', '2024-01-08 11:47:48', '5', NULL, NULL, '2024-01-08 04:47:48', '2024-01-08 04:59:10', NULL),
(87, 1, 7, 0, 1, 7, 7, 27, 'MOBIL BUS', 'N 7146 UI', 0, 8000, 2022, 'MHMFE84ENNJ000349', '4V21Y08338', 29, 1, 'BAGONG DEKAKA MAKMUR', '-', 'Muaraenim', 'pt.bagongdekakamakmur@gmail.com', '123456', '2024-01-08 11:48:01', '5', NULL, NULL, '2024-01-08 04:48:01', '2024-01-08 04:55:48', NULL),
(88, 2, 4, 11, 1, 3, 12, 25, 'BUS BESAR', 'BG 7424 AO', 46, 450, 2015, 'MJERK8JSKFJN17692', 'J08EUFJ72572', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 11:58:54', '5', NULL, NULL, '2024-01-08 04:58:54', '2024-01-08 10:44:02', NULL),
(89, 2, 4, 11, 1, 3, 12, 25, 'BUS BESAR', 'BG 7420 AO', 46, 450, 2015, 'MJERK8JSKFJN17699', 'J08EUFJ72501', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:00:40', '5', NULL, NULL, '2024-01-08 05:00:40', '2024-01-08 10:41:30', NULL),
(90, 2, 4, 11, 1, 3, 12, 25, 'BUS BESAR', 'BG 7849 AO', 56, 550, 2014, 'MJERK8JSKFJN16989', 'J08EUFJ65455', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:01:13', '5', NULL, NULL, '2024-01-08 05:01:13', '2024-01-08 10:39:53', NULL),
(91, 2, 4, 13, 1, 3, 12, 25, 'BUS BESAR', 'BG 7416 AO', 46, 450, 2015, 'MJERK8JSKFJN17706', 'J08EUFJ72598', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:01:55', '5', NULL, NULL, '2024-01-08 05:01:55', '2024-01-08 10:37:02', NULL),
(92, 2, 4, 13, 1, 3, 12, 25, 'BUS BESAR', 'BG 7417 AO', 46, 450, 2015, 'MJERK8JSKFJN17707', 'J08EUFJ72599', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:02:33', '5', NULL, NULL, '2024-01-08 05:02:33', '2024-01-08 10:35:20', NULL),
(93, 2, 4, 13, 1, 3, 12, 11, 'BUS BESAR', 'BG 7419 AO', 46, 450, 2015, 'MJERK8JSKFJN17708', 'J08EUFJ72600', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:03:05', '5', NULL, NULL, '2024-01-08 05:03:05', '2024-01-08 10:33:30', NULL),
(94, 2, 4, 12, 1, 3, 12, 25, 'BUS BESAR', 'BG 7841 AO', 56, 550, 2014, 'MJERK8JSKFJN16905', 'J08EUFJ64533', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:03:32', '5', NULL, NULL, '2024-01-08 05:03:32', '2024-01-08 10:31:28', NULL),
(95, 2, 4, 12, 1, 3, 12, 25, 'BUS BESAR', 'BG 7751 AO', 56, 550, 2014, 'MJERK8JSKEJM16796', 'J08EUFJ64458', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:04:05', '5', NULL, NULL, '2024-01-08 05:04:05', '2024-01-08 10:29:44', NULL),
(96, 2, 4, 12, 1, 3, 12, 25, 'BUS BESAR', 'BG 7418 AO', 46, 450, 2015, 'MJERK8JSKFJN172759', 'J08EUFJ72759', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:04:39', '5', NULL, NULL, '2024-01-08 05:04:39', '2024-01-08 10:28:02', NULL),
(97, 1, 7, 0, 1, 3, 12, 28, 'MOBIL BUS', '6', 0, 8000, 2023, 'MJERK8JSLPJP13656', 'J08EWDJ26742', 30, 1, 'SUMBARAMULTI ARTHA', '-', 'Ogan Komering Ulu', 'pt.sumbaramultiartha@gmail.com', '123456', '2024-01-08 12:05:05', '5', NULL, NULL, '2024-01-08 05:05:05', '2024-01-08 05:06:13', NULL),
(98, 2, 4, 14, 1, 3, 12, 25, 'BUS BESAR', 'BG 7757 AO', 46, 450, 2015, 'MJERK8JSKFJN17819', 'J08EUFJ72831', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:05:09', '5', NULL, NULL, '2024-01-08 05:05:09', '2024-01-08 10:26:05', NULL),
(99, 2, 4, 14, 1, 3, 12, 25, 'BUS BESAR', 'BG 7456 AO', 46, 450, 2015, 'MJERK8JSKFJN17824', 'J08EUFJ72836', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:05:57', '5', NULL, NULL, '2024-01-08 05:05:57', '2024-01-08 10:24:08', NULL),
(100, 2, 4, 14, 1, 3, 12, 25, 'BUS BESAR', 'BG 7430 AO', 46, 450, 2015, 'MJERK8JSKFJN17826', 'J08EUFJ72844', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:06:40', '5', NULL, NULL, '2024-01-08 05:06:40', '2024-01-08 10:21:45', NULL),
(101, 2, 4, 14, 1, 3, 12, 25, 'BUS BESAR', 'BG 7759 AO', 56, 550, 2014, 'MJERK8JSKEJM6792', 'J08EUFJ64424', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:07:14', '5', NULL, NULL, '2024-01-08 05:07:14', '2024-01-08 08:24:10', NULL),
(102, 2, 4, 14, 1, 3, 12, 25, 'BUS BESAR', 'BG 7427 AO', 46, 450, 2015, 'MJERK8JSKFJN17793', 'J08EUFJ72763', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:07:55', '5', NULL, NULL, '2024-01-08 05:07:55', '2024-01-08 08:19:25', NULL),
(103, 1, 7, 0, 2, 5, 14, 29, 'MOBIL BARANG / TRUCK TRONTON', 'B 9265 WDB', 3, 26000, 2020, 'MFFCWZ30RLK813097', 'GH8521295A1P', 31, 1, 'BARA UNGGUL SUMATERA', '-', 'Palembang', 'pt.baraunggulsumatera@gmail.com', '123456', '2024-01-08 12:11:52', '5', NULL, NULL, '2024-01-08 05:11:52', '2024-01-08 05:12:55', NULL),
(104, 1, 7, 0, 2, 5, 14, 29, 'MOBIL BARANG / TRUCK TRONTON', 'B 9252 WDB', 3, 26000, 2020, 'MFFCWZ30RLK812353', 'GH8511632A1P', 31, 1, 'BARA UNGGUL SUMATERA', '-', 'Palembang', 'pt.baraunggulsumatera@gmail.com', '123456', '2024-01-08 12:12:06', '5', NULL, NULL, '2024-01-08 05:12:06', '2024-01-08 05:14:51', NULL),
(105, 2, 4, 15, 1, 3, 12, 25, 'BUS BESAR', 'BG 7844 AO', 56, 550, 2014, 'MJERK8JSKFJN16807', 'J08EUFJ84535', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:12:53', '5', NULL, NULL, '2024-01-08 05:12:53', '2024-01-08 08:16:45', NULL),
(106, 2, 4, 15, 1, 3, 12, 25, 'BUS BESAR', 'BG 7843 AO', 46, 450, 2015, 'MJERK8JSKEJN17858', 'J08EUFJ72906', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:14:03', '5', NULL, NULL, '2024-01-08 05:14:03', '2024-01-08 08:14:40', NULL),
(107, 2, 4, 15, 1, 3, 12, 25, 'BUS BESAR', 'BG 7839 AO', 46, 450, 2018, 'MJERK8JSKRJN17859', 'J08EUGJ72907', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:14:44', '5', NULL, NULL, '2024-01-08 05:14:44', '2024-01-08 08:12:32', NULL),
(108, 2, 4, 15, 1, 3, 12, 25, 'BUS BESAR', 'BG 7749 AO', 56, 550, 2014, 'MJERK8JSJN16798', 'J08EUFJ64460', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:15:20', '5', NULL, NULL, '2024-01-08 05:15:20', '2024-01-08 08:09:51', NULL),
(109, 2, 4, 15, 1, 3, 12, 25, 'BUS BESAR', 'BG 7765 AO', 56, 550, 2014, 'MJERK8JSKEJN16799', 'J08EUFJ64491', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:15:58', '5', NULL, NULL, '2024-01-08 05:15:58', '2024-01-08 08:07:15', NULL),
(110, 2, 4, 15, 1, 3, 12, 25, 'BUS BESAR', 'BG 7845 AO', 56, 550, 2014, 'MJERK8JSKEJN16810', 'J08EUFJ64538', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:16:28', '5', NULL, NULL, '2024-01-08 05:16:28', '2024-01-08 08:02:17', NULL),
(111, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '7', 3, 7500, 2023, 'MHMFE75EKPK017711', '4V21Z76918', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:28:31', '5', NULL, NULL, '2024-01-08 05:28:31', '2024-01-08 05:46:19', NULL),
(112, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '8', 3, 7500, 2023, 'MHMFE75EKPK017712', '4V21Z76917', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:28:52', '5', NULL, NULL, '2024-01-08 05:28:52', '2024-01-08 06:15:30', NULL),
(113, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '9', 3, 7500, 2023, 'MHMFE75EKPK017715', '4V21Z76903', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:29:08', '5', NULL, NULL, '2024-01-08 05:29:08', '2024-01-08 05:49:07', NULL),
(115, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '10', 3, 7500, 2023, 'MHMFE75EKPK017681', '4V21Z76725', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:29:53', '5', NULL, NULL, '2024-01-08 05:29:53', '2024-01-08 05:51:10', NULL),
(116, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '11', 3, 7500, 2023, 'MHMFE75EKPK017706', '4V21Z76907', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:30:14', '5', NULL, NULL, '2024-01-08 05:30:14', '2024-01-08 06:16:49', NULL),
(117, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '12', 3, 7500, 2023, 'MHMFE75EKPK015035', '4V21Z48916', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:41:51', '5', NULL, NULL, '2024-01-08 05:41:51', '2024-01-08 05:53:52', NULL),
(118, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '13', 3, 7500, 2023, 'MHMFE75EKPK015036', '4V21Z48917', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:42:12', '5', NULL, NULL, '2024-01-08 05:42:12', '2024-01-08 05:55:44', NULL),
(120, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '14', 3, 7500, 2023, 'MHMFE75EKPK015836', '4V21Z51507', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:42:55', '5', NULL, NULL, '2024-01-08 05:42:55', '2024-01-08 05:59:05', NULL),
(121, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '15', 3, 7500, 2023, 'MHMFE75EKPK015845', '4V21Z51571', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:43:11', '5', NULL, NULL, '2024-01-08 05:43:11', '2024-01-08 06:04:17', NULL),
(122, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '16', 3, 7500, 2023, 'MHMFE75EKPK015851', '4V21Z51564', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:43:25', '5', NULL, NULL, '2024-01-08 05:43:25', '2024-01-08 06:07:17', NULL),
(123, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '17', 3, 7500, 2023, 'MHMFE75EKPK015024', '4V21Z48901', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:43:53', '5', NULL, NULL, '2024-01-08 05:43:53', '2024-01-08 06:08:50', NULL),
(124, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '18', 3, 7500, 2023, 'MHMFE75EKPK015031', '4V21Z48912', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:44:13', '5', NULL, NULL, '2024-01-08 05:44:13', '2024-01-08 06:10:23', NULL),
(125, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '19', 3, 7500, 2023, 'MHMFE75EKPK015033', '4V21Z48918', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:44:41', '5', NULL, NULL, '2024-01-08 05:44:41', '2024-01-08 06:11:54', NULL),
(126, 1, 7, 0, 2, 5, 7, 24, 'MOBIL BARANG / TRUCK TANGKI', '20', 3, 7500, 2023, 'MHMFE75EKPK015034', '4V21Z48919', 32, 2, 'SEMANGUS INDAH EXPRESS', '-', 'Palembang', 'cv.semangusindahexpress@gmail.com', '123456', '2024-01-08 12:45:01', '5', NULL, NULL, '2024-01-08 05:45:01', '2024-01-08 06:13:23', NULL),
(127, 2, 4, 16, 1, 3, 12, 25, 'BUS BESAR', 'BG 7848 AO', 56, 550, 2014, 'MJERK8JSKEJN16809', 'J08EUFJ64537', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:51:50', '5', NULL, NULL, '2024-01-08 05:51:50', '2024-01-08 07:59:41', NULL),
(128, 2, 4, 16, 1, 3, 12, 25, 'BUS BESAR', 'BG 7432 AO', 46, 450, 2015, 'MJERK8JSKFJN17798', 'J08EUFJ72760', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:52:42', '5', NULL, NULL, '2024-01-08 05:52:42', '2024-01-08 07:55:22', NULL),
(129, 2, 4, 16, 1, 3, 12, 25, 'BUS BESAR', 'BG 7428 AO', 46, 450, 2015, 'MJERK8JSKFJN17792', 'J08EUFJ72762', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:53:13', '5', NULL, NULL, '2024-01-08 05:53:13', '2024-01-08 07:45:38', NULL),
(132, 2, 4, 17, 1, 3, 12, 25, 'BUS BESAR', 'BG 7415 AO', 46, 450, 2015, 'MJERK8JSKFJN17705', 'J08EUFJ72597', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:56:34', '4', NULL, NULL, '2024-01-08 05:56:34', '2024-01-08 07:26:07', NULL),
(133, 2, 4, 17, 1, 3, 12, 25, 'BUS BESAR', 'BG 7851 AO', 56, 550, 2014, 'MJERK8JSKEJN16808', 'J08EUFJ64536', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:57:09', '5', NULL, NULL, '2024-01-08 05:57:09', '2024-01-08 07:25:08', NULL),
(134, 2, 4, 18, 1, 3, 12, 25, 'BUS BESAR', 'BG 7850 AO', 56, 550, 2014, 'MJERK8JSKEJN16969', 'J08EUFJ65357', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:57:43', '5', NULL, NULL, '2024-01-08 05:57:43', '2024-01-08 07:18:28', NULL),
(135, 2, 4, 18, 1, 3, 12, 25, 'BUS BESAR', 'BG 7993 AO', 45, 440, 2010, 'MHL368006AJ000281', '904973U0819587', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:58:12', '5', NULL, NULL, '2024-01-08 05:58:12', '2024-01-08 06:14:38', NULL),
(136, 2, 4, 18, 1, 3, 12, 25, 'BUS BESAR', 'BG 7342 AO', 46, 450, 2015, 'MJEFB2WGLFJE14325', 'W04DTNJ84325', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:58:40', '5', NULL, NULL, '2024-01-08 05:58:40', '2024-01-08 06:12:02', NULL),
(137, 2, 4, 18, 1, 3, 12, 25, 'BUS BESAR', 'BG 7414 AO', 46, 450, 2015, 'MJERK8JSKFJN17702', 'J08EUFJ72894', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 12:59:09', '5', NULL, NULL, '2024-01-08 05:59:09', '2024-01-08 06:05:34', NULL),
(138, 1, 7, 0, 2, 5, 7, 30, 'MOBIL BARANG', '21', 3, 8000, 2023, 'MHMFE84EMPK001898', '4V21-Z64253', 33, 2, 'LAPAN ENAM HP', '-', 'Palembang', 'cv.lapanenamhp@gmail.com', '123456', '2024-01-08 13:49:06', '5', NULL, NULL, '2024-01-08 06:49:06', '2024-01-08 07:37:38', NULL),
(139, 2, 4, 17, 1, 3, 12, 25, 'BUS BESAR', 'BG 7415 AO', 46, 450, 2015, 'MJERK8JSKFJN17705', 'J08EUFJ72597', 27, 1, 'PT.DAMRI CABANG PALEMBANG', 'RIZKY ADITYA', 'Jl. Kol. H burlian No. 848 KM.9 Kel. Karya Baru Kec. Alang alang Lebar Palembang', 'pt.damricabpalembang@gmail.com', '089533591945', '2024-01-08 17:52:03', '5', NULL, NULL, '2024-01-08 10:52:03', '2024-01-08 11:05:01', NULL),
(140, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '22', 3, 26000, 2023, 'MJEFM8JW2PJX12004', 'J08EWDJ30530', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:39:28', '5', NULL, NULL, '2024-01-09 02:39:28', '2024-01-09 02:44:22', NULL),
(141, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '23', 3, 26000, 2023, 'MJEFM8JW2PJX12003', 'J08EWDJ30529', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:39:43', '5', NULL, NULL, '2024-01-09 02:39:43', '2024-01-09 02:45:00', NULL),
(142, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '24', 3, 26000, 2023, 'MJEFM8JW2PJX12002', 'J08EWDJ30520', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:40:07', '5', NULL, NULL, '2024-01-09 02:40:07', '2024-01-09 02:45:35', NULL),
(143, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '25', 3, 26000, 2023, 'MJEFM8JW2PJX11976', 'J08EWDJ30444', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:40:28', '5', NULL, NULL, '2024-01-09 02:40:28', '2024-01-09 02:46:10', NULL),
(144, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '26', 3, 26000, 2023, 'MJEFM8JW2PJX11975', 'J08EWDJ30443', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:40:46', '5', NULL, NULL, '2024-01-09 02:40:46', '2024-01-09 02:46:45', NULL),
(145, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '27', 3, 26000, 2023, 'MJEFM8JW2PJX11907', 'J08EWDJ30231', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:41:00', '5', NULL, NULL, '2024-01-09 02:41:00', '2024-01-09 02:47:18', NULL),
(146, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '28', 3, 26000, 2023, 'MJEFM8JW2PJX11906', 'J08EWDJ30210', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:41:17', '5', NULL, NULL, '2024-01-09 02:41:17', '2024-01-09 02:47:52', NULL),
(147, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '29', 3, 26000, 2023, 'MJEFM8JW2PJX11904', 'J08EWDJ30207', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:41:33', '5', NULL, NULL, '2024-01-09 02:41:33', '2024-01-09 02:48:26', NULL),
(148, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '30', 3, 26000, 2023, 'MJEFM8JW2PJX11903', 'J08EWDJ30206', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:41:49', '5', NULL, NULL, '2024-01-09 02:41:49', '2024-01-09 02:49:04', NULL),
(150, 1, 7, 0, 2, 5, 12, 31, 'MOBIL BARANG / TRUCK TRONTON', '31', 3, 26000, 2023, 'MJEFM8JW2PJX11863', 'J08EWDJ30038', 34, 2, 'SAMUDRA JAYA BERSAMA', '-', 'Palembang', 'cv.samudrajayabersama@gmail.com', '0000000', '2024-01-09 09:42:39', '5', NULL, NULL, '2024-01-09 02:42:39', '2024-01-09 02:49:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr_permohonan_002_validasi`
--

CREATE TABLE `tr_permohonan_002_validasi` (
  `id_validasi_permohonan` int(11) NOT NULL,
  `no_kartu_pengawas` varchar(50) NOT NULL,
  `tgl_sk` date DEFAULT NULL,
  `no_sk` varchar(50) NOT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `tgl_kir_awal` date DEFAULT NULL,
  `tgl_kir_akhir` date DEFAULT NULL,
  `ck_tgl_kir_awal_clear` enum('1','0') NOT NULL,
  `ck_tgl_kir_akhir_clear` enum('1','0') NOT NULL,
  `status_validasi` enum('1','2','3','4','5') NOT NULL COMMENT '''1 = draft, 2 = kirim, 3 = ditolak, 4 = di proses, 5 = selesai / diterima'';',
  `id_permohonan_izin` int(11) NOT NULL,
  `tgl_validasi_proses` datetime DEFAULT NULL,
  `tgl_validasi_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tr_permohonan_002_validasi`
--

INSERT INTO `tr_permohonan_002_validasi` (`id_validasi_permohonan`, `no_kartu_pengawas`, `tgl_sk`, `no_sk`, `tgl_awal`, `tgl_akhir`, `tgl_kir_awal`, `tgl_kir_akhir`, `ck_tgl_kir_awal_clear`, `ck_tgl_kir_akhir_clear`, `status_validasi`, `id_permohonan_izin`, `tgl_validasi_proses`, `tgl_validasi_selesai`, `created_at`, `updated_at`) VALUES
(28, '551.21/3785/3/DISHUB/3/23/1', '2023-02-02', '551.21/3785/3/DISHUB', '2023-02-02', '2024-02-02', '2023-04-21', '2023-10-21', '1', '1', '5', 41, '2023-05-13 20:43:49', '2023-02-03', '2023-05-13 13:43:49', '2023-05-13 13:49:00'),
(29, '-', NULL, '-', NULL, NULL, NULL, NULL, '0', '0', '4', 40, '2023-05-13 20:53:10', NULL, '2023-05-13 13:53:10', '2023-05-13 13:53:10'),
(30, '-', NULL, '-', NULL, NULL, NULL, NULL, '0', '0', '4', 38, '2023-05-13 20:54:34', NULL, '2023-05-13 13:54:34', '2023-05-13 13:54:34'),
(31, '-', NULL, '-', NULL, NULL, NULL, NULL, '0', '0', '4', 37, '2023-05-13 20:57:12', NULL, '2023-05-13 13:57:12', '2023-05-13 13:57:12'),
(32, '551.2/2857/3/DISHUB/2022/09/01', '2023-05-12', '551.2/2857/3/DISHUB/2023', '2023-05-12', '2023-11-12', '2023-01-12', '2023-06-12', '1', '1', '5', 67, '2023-05-14 09:39:04', '2023-05-12', '2023-05-14 02:39:04', '2023-05-14 02:43:32'),
(33, '551.2/2857/3/DISHUB/2023/05/02', '2023-05-12', '551.2/2857/3/DISHUB/2023', '2023-05-12', '2023-11-12', '2022-10-17', '2023-03-17', '1', '1', '5', 65, '2023-05-14 09:44:58', '2023-05-12', '2023-05-14 02:44:58', '2023-05-14 02:48:37'),
(34, 'SKEP.34/123/DISHUB/2023/5/1', '2023-05-14', 'SKEP.34/123/DISHUB/2023/', '2023-05-14', '2023-11-14', '2023-04-14', '2023-10-14', '1', '1', '5', 69, '2023-05-14 19:20:52', '2023-05-14', '2023-05-14 12:20:52', '2023-05-14 12:24:13'),
(35, '551.2/2857/3/DISHUB/2023/05/01', '2023-05-14', '551.2/2857/3/DISHUB/2023', '2023-05-14', '2023-11-14', '2022-12-29', '2023-06-29', '1', '1', '5', 68, '2023-05-14 21:00:01', '2023-05-14', '2023-05-14 14:00:01', '2023-05-14 14:12:44'),
(36, '-', NULL, '-', NULL, NULL, NULL, NULL, '0', '0', '4', 21, '2023-05-14 21:00:26', NULL, '2023-05-14 14:00:26', '2023-05-14 14:00:26'),
(38, '551.2/2857/3/DISHUB/2023/05/24', '2023-05-14', '551.2/2857/3/DISHUB/2023/05/24', '2023-05-14', '2023-11-14', '2022-12-29', '2023-06-29', '1', '1', '5', 66, '2023-05-14 21:01:36', '2023-05-14', '2023-05-14 14:01:36', '2023-05-14 14:06:38'),
(40, '551.21/101/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 79, '2024-01-08 09:39:44', '2024-01-08', '2024-01-08 02:39:44', '2024-01-08 04:00:32'),
(41, '551.21/107/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 80, '2024-01-08 11:21:15', '2024-01-08', '2024-01-08 04:21:15', '2024-01-08 04:27:06'),
(42, '551.21/102/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 81, '2024-01-08 11:28:25', '2024-01-08', '2024-01-08 04:28:25', '2024-01-08 04:29:13'),
(43, '551.21/106/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 82, '2024-01-08 11:30:21', '2024-01-08', '2024-01-08 04:30:21', '2024-01-08 04:30:59'),
(44, '551.21/108/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 83, '2024-01-08 11:35:54', '2024-01-08', '2024-01-08 04:35:54', '2024-01-08 04:36:37'),
(45, '551.21/109/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 84, '2024-01-08 11:38:10', '2024-01-08', '2024-01-08 04:38:10', '2024-01-08 04:38:52'),
(46, '551.21/103/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 85, '2024-01-08 11:48:26', '2024-01-08', '2024-01-08 04:48:26', '2024-01-08 04:55:31'),
(47, '551.21/104/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 87, '2024-01-08 11:50:23', '2024-01-08', '2024-01-08 04:50:23', '2024-01-08 04:55:48'),
(48, '551.21/105/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 86, '2024-01-08 11:58:39', '2024-01-08', '2024-01-08 04:58:39', '2024-01-08 04:59:10'),
(49, '551.21/110/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 97, '2024-01-08 12:05:45', '2024-01-08', '2024-01-08 05:05:45', '2024-01-08 05:06:13'),
(50, '551.21/124/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 103, '2024-01-08 12:12:25', '2024-01-08', '2024-01-08 05:12:25', '2024-01-08 05:12:55'),
(51, '551.21/123/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 104, '2024-01-08 12:14:22', '2024-01-08', '2024-01-08 05:14:22', '2024-01-08 05:14:51'),
(52, '551.21/111/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 111, '2024-01-08 12:45:41', '2024-01-08', '2024-01-08 05:45:41', '2024-01-08 05:46:19'),
(53, '551.21/125/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 112, '2024-01-08 12:47:37', '2024-01-08', '2024-01-08 05:47:37', '2024-01-08 06:15:30'),
(54, '551.21/113/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 113, '2024-01-08 12:48:21', '2024-01-08', '2024-01-08 05:48:21', '2024-01-08 05:49:07'),
(55, '551.21/112/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 115, '2024-01-08 12:50:18', '2024-01-08', '2024-01-08 05:50:18', '2024-01-08 05:51:10'),
(56, '551.21/126/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 116, '2024-01-08 12:52:31', '2024-01-08', '2024-01-08 05:52:31', '2024-01-08 06:16:49'),
(57, '551.21/114/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 117, '2024-01-08 12:53:02', '2024-01-08', '2024-01-08 05:53:02', '2024-01-08 05:53:52'),
(58, '551.21/116/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 118, '2024-01-08 12:54:58', '2024-01-08', '2024-01-08 05:54:58', '2024-01-08 05:55:44'),
(59, '551.21/115/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 120, '2024-01-08 12:56:58', '2024-01-08', '2024-01-08 05:56:58', '2024-01-08 05:59:05'),
(60, '551.2/131/3/DISHUB/2/23/29', '2023-01-11', '81200172405310052', '2024-01-11', '2025-01-11', '2020-03-18', '2020-08-18', '1', '1', '5', 137, '2024-01-08 13:00:01', '2024-01-08', '2024-01-08 06:00:01', '2024-01-08 06:05:34'),
(61, '551.21/117/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 121, '2024-01-08 13:03:44', '2024-01-08', '2024-01-08 06:03:44', '2024-01-08 06:04:17'),
(62, '551.21/118/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 122, '2024-01-08 13:06:38', '2024-01-08', '2024-01-08 06:06:38', '2024-01-08 06:07:17'),
(63, '551.21/119/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 123, '2024-01-08 13:08:18', '2024-01-08', '2024-01-08 06:08:18', '2024-01-08 06:08:50'),
(64, '551.2/131/3/DISHUB/2/23/28', '2023-01-11', '81200172405310052', '2024-01-08', '2024-01-08', '2022-09-22', '2023-02-22', '1', '1', '5', 136, '2024-01-08 13:08:57', '2024-01-08', '2024-01-08 06:08:57', '2024-01-08 06:12:02'),
(65, '551.21/120/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 124, '2024-01-08 13:09:52', '2024-01-08', '2024-01-08 06:09:52', '2024-01-08 06:10:23'),
(66, '551.21/121/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 125, '2024-01-08 13:11:24', '2024-01-08', '2024-01-08 06:11:24', '2024-01-08 06:11:54'),
(67, '551.21/122/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-08', '1', '1', '5', 126, '2024-01-08 13:12:49', '2024-01-08', '2024-01-08 06:12:49', '2024-01-08 06:13:23'),
(68, '551.2/131/3/DISHUB/2/23/27', '2023-01-11', '81200172405310052', '2024-01-11', '2025-01-11', '2022-02-04', '2023-02-04', '1', '1', '5', 135, '2024-01-08 13:12:53', '2024-01-08', '2024-01-08 06:12:53', '2024-01-08 06:14:38'),
(69, '551.21/127/3/DISHUB', '2024-01-08', '-', '2024-01-08', '2024-01-08', '2024-01-08', '2024-01-09', '1', '1', '5', 138, '2024-01-08 13:49:29', '2024-01-08', '2024-01-08 06:49:29', '2024-01-08 07:37:38'),
(70, '551.2/131/3/DISHUB/2/23/26', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-09-04', '2023-02-04', '1', '1', '5', 134, '2024-01-08 14:16:08', '2024-01-08', '2024-01-08 07:16:08', '2024-01-08 07:18:28'),
(71, '551.2/131/3/DISHUB/2/23/25', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-05-19', '2022-11-19', '1', '1', '5', 133, '2024-01-08 14:19:43', '2024-01-08', '2024-01-08 07:19:43', '2024-01-08 07:25:08'),
(72, '551.2/131/3/DISHUB/2/23/24', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', NULL, '2024-01-10', '0', '1', '4', 132, '2024-01-08 14:26:07', NULL, '2024-01-08 07:26:07', '2024-01-09 16:59:57'),
(73, '551.2/131/3/DISHUB/2/23/23', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-13', '2023-04-13', '1', '1', '5', 129, '2024-01-08 14:43:00', '2024-01-08', '2024-01-08 07:43:00', '2024-01-08 07:45:38'),
(74, '551.2/131/3/DISHUB/2/23/22', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-17', '2023-04-17', '1', '1', '5', 128, '2024-01-08 14:53:39', '2024-01-08', '2024-01-08 07:53:39', '2024-01-08 07:55:22'),
(75, '551.2/131/3/DISHUB/2/23/21', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-28', '2023-04-28', '1', '1', '5', 127, '2024-01-08 14:56:50', '2024-01-08', '2024-01-08 07:56:50', '2024-01-08 07:59:41'),
(76, '551.2/131/3/DISHUB/2/23/20', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-05', '2023-04-05', '1', '1', '5', 110, '2024-01-08 15:00:39', '2024-01-08', '2024-01-08 08:00:39', '2024-01-08 08:02:17'),
(77, '551.2/131/3/DISHUB/2/23/19', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-05-30', '2022-11-30', '1', '1', '5', 109, '2024-01-08 15:05:03', '2024-01-08', '2024-01-08 08:05:03', '2024-01-08 08:07:15'),
(78, '551.2/131/3/DISHUB/2/23/18', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-07', '2023-04-07', '1', '1', '5', 108, '2024-01-08 15:08:22', '2024-01-08', '2024-01-08 08:08:22', '2024-01-08 08:09:51'),
(79, '551.2/131/3/DISHUB/2/23/17', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2021-09-09', '2022-03-09', '1', '1', '5', 107, '2024-01-08 15:10:54', '2024-01-08', '2024-01-08 08:10:54', '2024-01-08 08:12:32'),
(80, '551.2/131/3/DISHUB/2/23/16', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-05-25', '2022-11-25', '1', '1', '5', 106, '2024-01-08 15:13:23', '2024-01-08', '2024-01-08 08:13:23', '2024-01-08 08:14:40'),
(81, '551.2/131/3/DISHUB/2/23/15', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-01-04', '2022-07-04', '1', '1', '5', 105, '2024-01-08 15:15:25', '2024-01-08', '2024-01-08 08:15:25', '2024-01-08 08:16:45'),
(82, '551.2/131/3/DISHUB/2/23/14', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-07-28', '2023-01-28', '1', '1', '5', 102, '2024-01-08 15:17:37', '2024-01-08', '2024-01-08 08:17:37', '2024-01-08 08:19:25'),
(83, '551.2/131/3/DISHUB/2/23/13', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-05-30', '2022-11-30', '1', '1', '5', 101, '2024-01-08 15:22:12', '2024-01-08', '2024-01-08 08:22:12', '2024-01-08 08:24:10'),
(84, '551.2/131/3/DISHUB/2/23/12', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2020-11-10', '2021-05-10', '1', '1', '5', 100, '2024-01-08 17:20:16', '2024-01-08', '2024-01-08 10:20:16', '2024-01-08 10:21:45'),
(85, '551.2/131/3/DISHUB/2/23/11', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-05-30', '2022-11-30', '1', '1', '5', 99, '2024-01-08 17:22:42', '2024-01-08', '2024-01-08 10:22:42', '2024-01-08 10:24:08'),
(86, '551.2/131/3/DISHUB/2/23/10', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2020-10-20', '2021-04-20', '1', '1', '5', 98, '2024-01-08 17:24:41', '2024-01-08', '2024-01-08 10:24:41', '2024-01-08 10:26:05'),
(87, '551.2/131/3/DISHUB/2/23/9', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-28', '2023-04-28', '1', '1', '5', 96, '2024-01-08 17:26:43', '2024-01-08', '2024-01-08 10:26:43', '2024-01-08 10:28:02'),
(88, '551.2/131/3/DISHUB/2/23/8', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-21', '2023-04-21', '1', '1', '5', 95, '2024-01-08 17:28:45', '2024-01-08', '2024-01-08 10:28:45', '2024-01-08 10:29:44'),
(89, '551.2/131/3/DISHUB/2/23/7', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2021-12-30', '2022-06-30', '1', '1', '5', 94, '2024-01-08 17:30:27', '2024-01-08', '2024-01-08 10:30:27', '2024-01-08 10:31:28'),
(90, '551.2/131/3/DISHUB/2/23/6', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-07-11', '2023-01-11', '1', '1', '5', 93, '2024-01-08 17:32:06', '2024-01-08', '2024-01-08 10:32:06', '2024-01-08 10:33:30'),
(91, '551.2/131/3/DISHUB/2/23/5', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-05-30', '2022-11-30', '1', '1', '5', 92, '2024-01-08 17:34:12', '2024-01-08', '2024-01-08 10:34:12', '2024-01-08 10:35:20'),
(92, '551.2/131/3/DISHUB/2/23/4', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-07', '2023-04-07', '1', '1', '5', 91, '2024-01-08 17:35:58', '2024-01-08', '2024-01-08 10:35:58', '2024-01-08 10:37:02'),
(93, '551.2/131/3/DISHUB/2/23/3', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-13', '2023-04-13', '1', '1', '5', 90, '2024-01-08 17:37:45', '2024-01-08', '2024-01-08 10:37:45', '2024-01-08 10:39:53'),
(94, '551.2/131/3/DISHUB/2/23/2', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-06', '2023-04-06', '1', '1', '5', 89, '2024-01-08 17:40:31', '2024-01-08', '2024-01-08 10:40:31', '2024-01-08 10:41:30'),
(95, '551.2/131/3/DISHUB/2/23/1', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-14', '2023-04-14', '1', '1', '5', 88, '2024-01-08 17:42:11', '2024-01-08', '2024-01-08 10:42:11', '2024-01-08 10:44:02'),
(97, '551.2/131/3/DISHUB/2/22/24', '2023-01-11', '81200172405310052', '2024-01-08', '2025-01-08', '2022-10-13', '2023-04-13', '1', '1', '5', 139, '2024-01-08 17:58:58', '2024-01-08', '2024-01-08 10:58:58', '2024-01-08 11:05:01'),
(98, '551.21/143/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 140, '2024-01-09 09:43:31', '2024-01-09', '2024-01-09 02:43:31', '2024-01-09 02:44:22'),
(99, '551.21/144/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 141, '2024-01-09 09:44:33', '2024-01-09', '2024-01-09 02:44:33', '2024-01-09 02:45:00'),
(100, '551.21/145/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 142, '2024-01-09 09:45:09', '2024-01-09', '2024-01-09 02:45:09', '2024-01-09 02:45:35'),
(101, '551.21/146/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 143, '2024-01-09 09:45:42', '2024-01-09', '2024-01-09 02:45:42', '2024-01-09 02:46:10'),
(102, '551.21/147/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 144, '2024-01-09 09:46:19', '2024-01-09', '2024-01-09 02:46:19', '2024-01-09 02:46:45'),
(103, '551.21/148/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 145, '2024-01-09 09:46:54', '2024-01-09', '2024-01-09 02:46:54', '2024-01-09 02:47:18'),
(104, '551.21/149/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 146, '2024-01-09 09:47:25', '2024-01-09', '2024-01-09 02:47:25', '2024-01-09 02:47:52'),
(105, '551.21/150/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 147, '2024-01-09 09:47:58', '2024-01-09', '2024-01-09 02:47:58', '2024-01-09 02:48:26'),
(106, '551.21/151/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 148, '2024-01-09 09:48:36', '2024-01-09', '2024-01-09 02:48:36', '2024-01-09 02:49:04'),
(107, '551.21/152/3/DISHUB', '2024-01-09', '-', '2024-01-09', '2024-01-09', '2024-01-09', '2024-01-09', '1', '1', '5', 150, '2024-01-09 09:49:11', '2024-01-09', '2024-01-09 02:49:11', '2024-01-09 02:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `tr_permohonan_003_histori_data`
--

CREATE TABLE `tr_permohonan_003_histori_data` (
  `id_histori_data` int(11) NOT NULL,
  `status_permohonan` enum('1','2','3','4','5') NOT NULL COMMENT '''1 = draft, 2 = kirim, 3 = ditolak, 4 = di proses, 5 = selesai / diterima'';',
  `keterangan_histori` text NOT NULL,
  `id_permohonan_izin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tr_permohonan_003_histori_data`
--

INSERT INTO `tr_permohonan_003_histori_data` (`id_histori_data`, `status_permohonan`, `keterangan_histori`, `id_permohonan_izin`, `created_at`, `updated_at`) VALUES
(1, '3', 'salah pada format isian\r\nsesuaikan lagi \r\ntolong ya', 12, '2023-04-21 17:32:59', '2023-04-21 17:32:59'),
(2, '3', 'tolakk', 14, '2023-04-23 16:20:39', '2023-04-23 16:20:39'),
(3, '3', 'asdsadas', 15, '2023-04-23 16:40:32', '2023-04-23 16:40:32'),
(4, '3', 'aaaaaaaaaa', 13, '2023-04-23 16:40:41', '2023-04-23 16:40:41'),
(5, '3', 'sadas', 11, '2023-04-23 16:40:53', '2023-04-23 16:40:53'),
(6, '3', 'aaaaaaaaaaaa', 10, '2023-04-23 16:41:07', '2023-04-23 16:41:07'),
(7, '3', 'cccccccc', 9, '2023-04-23 16:41:49', '2023-04-23 16:41:49'),
(8, '3', 'data tidak lengkap', 15, '2023-05-13 08:55:58', '2023-05-13 08:55:58'),
(9, '3', 'MASA UJI KENDARAAN BELUM DIPERPANJANG', 36, '2023-05-13 13:59:13', '2023-05-13 13:59:13'),
(10, '3', 'MASA BERLAKU UJI KENDARAAN TELAH HABIS', 64, '2023-05-14 02:49:37', '2023-05-14 02:49:37'),
(11, '3', 'MASA UJI KENDARAAN BELUM DIPERPANJANG', 62, '2023-05-14 14:24:19', '2023-05-14 14:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `tr_permohonan_004_upload_biodata`
--

CREATE TABLE `tr_permohonan_004_upload_biodata` (
  `id_upload_dok_permohonan` int(11) NOT NULL,
  `jenis_dok` int(11) NOT NULL,
  `file_dokumen` text NOT NULL,
  `id_biodata` int(11) NOT NULL,
  `id_permohonan_izin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tr_permohonan_004_upload_biodata`
--

INSERT INTO `tr_permohonan_004_upload_biodata` (`id_upload_dok_permohonan`, `jenis_dok`, `file_dokumen`, `id_biodata`, `id_permohonan_izin`, `created_at`, `updated_at`) VALUES
(24, 1, '230427075529.xlsx', 14, 20, NULL, NULL),
(25, 3, '230427075541.docx', 14, 20, NULL, NULL),
(26, 1, '230514090858.pdf', 21, 42, NULL, NULL),
(27, 1, '230514090858.pdf', 21, 43, NULL, NULL),
(28, 1, '230514090858.pdf', 21, 44, NULL, NULL),
(29, 1, '230514090858.pdf', 21, 45, NULL, NULL),
(30, 1, '230514090858.pdf', 21, 46, NULL, NULL),
(31, 1, '230514090858.pdf', 21, 47, NULL, NULL),
(32, 1, '230514090858.pdf', 21, 48, NULL, NULL),
(33, 1, '230514090858.pdf', 21, 49, NULL, NULL),
(34, 1, '230514090858.pdf', 21, 50, NULL, NULL),
(35, 1, '230514090858.pdf', 21, 51, NULL, NULL),
(36, 1, '230514090858.pdf', 21, 52, NULL, NULL),
(37, 1, '230514090858.pdf', 21, 53, NULL, NULL),
(38, 1, '230514090858.pdf', 21, 54, NULL, NULL),
(39, 1, '230514090858.pdf', 21, 55, NULL, NULL),
(40, 1, '230514090858.pdf', 21, 56, NULL, NULL),
(41, 1, '230514090858.pdf', 21, 57, NULL, NULL),
(42, 1, '230514090858.pdf', 21, 58, NULL, NULL),
(43, 1, '230514090858.pdf', 21, 59, NULL, NULL),
(44, 1, '230514090858.pdf', 21, 60, NULL, NULL),
(45, 1, '230514090858.pdf', 21, 61, NULL, NULL),
(46, 1, '230514090858.pdf', 21, 62, NULL, NULL),
(47, 1, '230514090858.pdf', 21, 63, NULL, NULL),
(48, 1, '230514090858.pdf', 21, 64, NULL, NULL),
(49, 1, '230514090858.pdf', 21, 65, NULL, NULL),
(50, 1, '230514090858.pdf', 21, 66, NULL, NULL),
(51, 1, '230514090858.pdf', 21, 67, NULL, NULL),
(52, 1, '230514090858.pdf', 21, 68, NULL, NULL),
(53, 3, '230514065746.pdf', 21, 68, NULL, NULL),
(54, 1, '230514090858.pdf', 21, 69, NULL, NULL),
(55, 3, '230514065746.pdf', 21, 69, NULL, NULL),
(56, 1, '231114023227.pdf', 24, 73, NULL, NULL),
(57, 2, '231114023256.pdf', 24, 73, NULL, NULL),
(58, 3, '231114023328.pdf', 24, 73, NULL, NULL),
(59, 4, '231114023344.pdf', 24, 73, NULL, NULL),
(60, 1, '231114023227.pdf', 24, 74, NULL, NULL),
(61, 2, '231114023256.pdf', 24, 74, NULL, NULL),
(62, 3, '231114023328.pdf', 24, 74, NULL, NULL),
(63, 4, '231114023344.pdf', 24, 74, NULL, NULL),
(64, 1, '231114023227.pdf', 24, 75, NULL, NULL),
(65, 2, '231114023256.pdf', 24, 75, NULL, NULL),
(66, 3, '231114023328.pdf', 24, 75, NULL, NULL),
(67, 4, '231114023344.pdf', 24, 75, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr_permohonan_validasi`
--

CREATE TABLE `tr_permohonan_validasi` (
  `id_validasi_permohonan` int(11) NOT NULL,
  `no_kartu_pengawas` varchar(50) NOT NULL,
  `tgl_sk` date NOT NULL,
  `no_sk` varchar(50) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `tgl_kir_awal` date NOT NULL,
  `tgl_kir_akhir` date NOT NULL,
  `status_validasi` enum('1','2','3','4','5') NOT NULL COMMENT '''1 = draft, 2 = kirim, 3 = ditolak, 4 = di proses, 5 = selesai / diterima'';',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(5) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2023-02-25 17:44:11', '$2y$10$mwkrr.d49EW2gIJOB37b7eTEBW.5nqiBkGccf5AcCAEDyKsXeXSoe', '1', NULL, '2023-02-25 17:44:54', '2023-04-26 03:41:19'),
(6, 'pt.rio', 'rio@gmail.com', '2023-02-25 17:44:11', '$2y$10$neSWoatJd4guOCs6Hnzym.rNSj0yfXJfso22sl7wX8yaVkOeU0ize', '3', NULL, '2023-02-25 17:44:54', '2023-12-02 03:50:17'),
(7, 'PT. Anta', 'anta@gmail.com', '2023-02-25 17:44:11', '$2y$10$vA76/i1o0yfLUA6aX01Zh.aCvVE4oTFHrFD3KofUPefxrkiG2MViW', '3', NULL, '2023-02-25 17:44:54', '2023-05-13 08:10:21'),
(8, 'Petugas KIR', 'kir@gmail.com', '2023-02-25 17:44:11', '$2y$10$IXrV38hHRXGmt4BYb7ksleXhVk4la9aCS2JHwtVe2cAUxqyRlTOXK', '2', NULL, '2023-02-25 17:44:54', '2023-03-21 10:47:24'),
(9, 'pindah sementara', 'rio007@gmail.com', NULL, '$2y$10$CpDWYgKF0s1mOO4Lj5XHn.vpQ4/l3ChbbkHjM6YRgjHncXgBH49KK', '3', NULL, '2023-04-25 18:52:11', '2023-05-13 08:10:42'),
(10, 'Haha', 'rio.rps007@gmail.com', NULL, '$2y$10$e6xZXdZmP0lmxZoazncv..CrwS45wSZhGP1/3Zu4XwJCs06NuaT/e', '3', NULL, '2023-04-26 05:14:19', '2023-05-13 08:10:55'),
(11, 'PT. Batubara Mutiara', 'mutiara@gmail.com', NULL, '$2y$10$lLFr9Sw.j1I7lVW14k4.eOCPC4iQU6e9uGz78K5PnazzdJRykVTnC', '3', NULL, '2023-04-26 06:34:40', '2023-05-13 08:11:03'),
(12, 'pt. AAABC', 'pt.AAABC@gmail.com', NULL, '$2y$10$qdOYQ7CEHg6T9CyyGwPWXO8svimnGa2kZphe2BNeXsTI2EHLDZ3iS', '3', NULL, '2023-04-26 06:56:54', '2023-05-13 08:11:13'),
(13, 'PT. SEPAKATBERSAMA', 'fansyuri@gmail.com', NULL, '$2y$10$PnxLJZozK.oaIgrNUHHzv.KqHjtdP2ETiwdFrcw66xX9jxUfLC9Ay', '3', NULL, '2023-04-26 07:10:06', '2023-05-13 08:11:20'),
(14, 'Habibie', 'angkutanpemprovsumsel@gmail.com', NULL, '$2y$10$LcGQ9GDT/o0aFXxwlO7izOvLoZZIYes0Gr4/9xz9vFFN4n9A9NYuu', '3', NULL, '2023-04-27 10:47:49', '2023-04-27 10:47:49'),
(15, 'CV. PO. BATANG HARI WISATA', 'batanghariwisata@gmail.com', NULL, '$2y$10$yccug6uXoLPGL9W2KFhDg.SMCeWZqQ066nwKdTjbWaRhS2VwIQomu', '3', NULL, '2023-05-13 10:37:04', '2023-05-13 10:37:04'),
(16, 'PT. BATURAJA MULTI USAHA', 'baturajamultiusaha@semenbaturaja.co.id', NULL, '$2y$10$UXYy1qjwiZZMJW1i3dBgFurpmw8H.SY8efNrvq9GRCnPtivDe4QJm', '3', NULL, '2023-05-13 14:04:50', '2023-05-13 14:04:50'),
(17, 'PT. SAHALA TRANS LOGISTIK', 'sahalatranslogistik@gmail.com', NULL, '$2y$10$s9lj5PpTvIa.n.RJtCXAOuCNVrC61sdirePwbA.g6JeDe2aWccYqC', '3', NULL, '2023-05-14 05:57:20', '2023-05-14 05:57:20'),
(18, 'unggul yoga', 'unggulyoga1@gmail.com', NULL, '$2y$10$X4sNGvsADLB4sbaw/LEW7.vV3PGZwUcHNuyki0F0ZMdFfvxpcLLSq', '3', NULL, '2023-05-25 06:39:24', '2023-05-25 06:39:24'),
(19, 'AZMI', 'azmihabibie17@gmail.com', NULL, '$2y$10$RFgFMnEf4cpmAYnJ8snrgukhpaJ3u4kkqxCcgtleEFXy2QIoWEbRe', '3', NULL, '2023-09-11 02:14:10', '2023-09-11 02:14:10'),
(20, 'Elbanus Benedictus Atmaja', 'elbanusbenedictus@gmail.com', NULL, '$2y$10$v3V/ET4G0TxYfd07ZeWLAecqyugWn2QcV0IFo.Mpbucv7OOVE12jK', '3', NULL, '2023-09-13 03:14:06', '2023-09-13 03:14:06'),
(21, 'Nicholas Sebastian', 'nicholassebastian1710@gmail.com', NULL, '$2y$10$tOn1GAmf4XlWKkw6k3YoyORYLdkVufRYG/UdT72VMAHz/.2ImYTP.', '3', NULL, '2023-09-13 03:14:14', '2023-09-13 03:14:14'),
(22, 'Erwin', 'karyaprimaalfatih08@gmail.com', NULL, '$2y$10$gQfsJwJ6Ma7BFQ7qrZNZpuOwMFdxiOfJejkGfjtRASyy.ZfAH06v6', '3', NULL, '2023-09-14 09:29:09', '2023-09-14 09:29:09'),
(23, 'PT. PUSHPA MAKMUR JAYA', 'pushpamakmurjaya@gmail.com', NULL, '$2y$10$P9ZuoTGCcdpnrYiKExqqouNRr5uqdEJZOHRQKkvnWRoWfdaew9.zm', '3', NULL, '2023-09-23 10:19:40', '2023-09-23 10:19:40'),
(24, 'PT.Bumi Intitama Mega Artha', 'ptbima@yahoo.co.id', NULL, '$2y$10$TJkUGMxtGWnwz5jzr9TKSOmdpAD6X8zCVWdoj4kDYzKowHn1/dWhW', '3', NULL, '2023-11-13 02:19:20', '2023-11-13 02:19:20'),
(25, 'angkutan', 'anesliorita@gmail.com', NULL, '$2y$10$noSl/jve9lQtMGIHtbOj1OUaXD83YgOxxYQ2Ncvtp3G6ewmwTo6AO', '3', NULL, '2024-01-08 01:51:57', '2024-01-08 01:51:57'),
(26, 'pt.anugerahbumimusi', 'pt.anugerahbumimusi@gmail.com', NULL, '$2y$10$TLxzqwmMQxcP9XAsOZyoy.lXAenhlbOTJAC5janVnD7UF.udgIOO.', '3', NULL, '2024-01-08 02:15:08', '2024-01-08 02:15:08'),
(27, 'PT.DAMRI CAB.PALEMBANG', 'pt.damricabpalembang@gmail.com', NULL, '$2y$10$fsgiOqpYlJDXPAOF/nrMKuwVQC9QA1qMvpNgLVrIvgwnzGjan73Fq', '3', NULL, '2024-01-08 03:58:43', '2024-01-08 03:58:43'),
(28, 'pt.lestaritransenergy', 'pt.lestaritransenergy@gmail.com', NULL, '$2y$10$me29idTci97vLT64B1IL9uU5lrHDcGUg/rF5RsXGGii9LFQsIJ.W6', '3', NULL, '2024-01-08 04:04:31', '2024-01-08 04:04:31'),
(29, 'pt.bagongdekakamakmur', 'pt.bagongdekakamakmur@gmail.com', NULL, '$2y$10$hYLgj3Eojc0mxb6uAYsKpehT.q7yAzO3.gsRCaGkTxCda1IAdg26e', '3', NULL, '2024-01-08 04:41:12', '2024-01-08 04:41:12'),
(30, 'pt.sumbaramultiartha', 'pt.sumbaramultiartha@gmail.com', NULL, '$2y$10$qhLvUFo1HTzQIjpfD0oMEeD3HjBwYkwtaA7i92mAw3NkkdJrj9OrK', '3', NULL, '2024-01-08 05:01:59', '2024-01-08 05:01:59'),
(31, 'pt.baraunggulsumatera', 'pt.baraunggulsumatera@gmail.com', NULL, '$2y$10$04cxrebA8TmUY2v6QJPtDOfAmTkCykaUjnr5wuFL8.WpFiQ/h7oq.', '3', NULL, '2024-01-08 05:08:20', '2024-01-08 05:08:20'),
(32, 'cv.semangusindahexpress', 'cv.semangusindahexpress@gmail.com', NULL, '$2y$10$.y5hgQMcXWVPZwD4FaYOz.b8A/52kuKRBxpiMe34URZTqCjHHKW6q', '3', NULL, '2024-01-08 05:16:41', '2024-01-08 05:16:41'),
(33, 'cv.lapanenamhp', 'cv.lapanenamhp@gmail.com', NULL, '$2y$10$ri4aQGQxHG7pvOTJhJU1LeCNUEJgIaVJYZkRJnJa.euk2mTfddMHm', '3', NULL, '2024-01-08 06:44:54', '2024-01-08 06:44:54'),
(34, 'cv.samudrajayabersama', 'cv.samudrajayabersama@gmail.com', NULL, '$2y$10$9R7bctoCsCPVi.3pJOvDkOdWgsA1ZJ9gXrbMtQ1N/lBP7GeicShjW', '3', NULL, '2024-01-09 02:25:15', '2024-01-09 02:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `users_aktivasi_akun`
--

CREATE TABLE `users_aktivasi_akun` (
  `id_user` int(11) NOT NULL,
  `id_biodata` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xcpar_angkut_001_jenis_angkutan`
--

CREATE TABLE `xcpar_angkut_001_jenis_angkutan` (
  `id_jenis_angkutan` int(11) NOT NULL,
  `nm_jenis_angkutan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xcpar_angkut_001_jenis_angkutan`
--

INSERT INTO `xcpar_angkut_001_jenis_angkutan` (`id_jenis_angkutan`, `nm_jenis_angkutan`, `created_at`, `updated_at`) VALUES
(1, 'Angkutan Orang', '2023-04-12 16:16:37', '2023-04-12 16:16:37'),
(2, 'Angkutan Barang Khusus', '2023-04-12 16:16:37', '2023-04-12 16:16:37'),
(3, 'Angkutan Barang Umum', '2023-04-12 16:16:37', '2023-04-12 16:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `xcpar_angkut_002_mengangkut`
--

CREATE TABLE `xcpar_angkut_002_mengangkut` (
  `id_mengangkut` int(11) NOT NULL,
  `id_angkutan` int(11) NOT NULL,
  `nm_mengangkut` varchar(100) NOT NULL,
  `status_actived` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aaa_access`
--
ALTER TABLE `aaa_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bpar_badan_usaha`
--
ALTER TABLE `bpar_badan_usaha`
  ADD PRIMARY KEY (`id_badan_usaha`);

--
-- Indexes for table `cpar_angkutan_001_jenis_angkutan`
--
ALTER TABLE `cpar_angkutan_001_jenis_angkutan`
  ADD PRIMARY KEY (`id_jenis_angkutan`);

--
-- Indexes for table `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
--
ALTER TABLE `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
  ADD PRIMARY KEY (`id_mapping_angkutan_jenis_permohonan`);

--
-- Indexes for table `cpar_kendaraan_001_merek_kendaraan`
--
ALTER TABLE `cpar_kendaraan_001_merek_kendaraan`
  ADD PRIMARY KEY (`id_merek_kendaraan`);

--
-- Indexes for table `cpar_kendaraan_002_type_kendaraan`
--
ALTER TABLE `cpar_kendaraan_002_type_kendaraan`
  ADD PRIMARY KEY (`id_type_kendaraan`);

--
-- Indexes for table `cpar_mengangkut_001_mengangkut`
--
ALTER TABLE `cpar_mengangkut_001_mengangkut`
  ADD PRIMARY KEY (`id_mengangkut`);

--
-- Indexes for table `cpar_mengangkut_002_mapping`
--
ALTER TABLE `cpar_mengangkut_002_mapping`
  ADD PRIMARY KEY (`id_mapping_mengangkut`);

--
-- Indexes for table `cpar_permohonan_001_jenis_permohonan`
--
ALTER TABLE `cpar_permohonan_001_jenis_permohonan`
  ADD PRIMARY KEY (`id_jenis_permohonan`);

--
-- Indexes for table `cpar_permohonan_002_permohonan`
--
ALTER TABLE `cpar_permohonan_002_permohonan`
  ADD PRIMARY KEY (`id_par_permohonan`);

--
-- Indexes for table `cpar_ttd_dokumen`
--
ALTER TABLE `cpar_ttd_dokumen`
  ADD PRIMARY KEY (`id_ttd_dok`);

--
-- Indexes for table `cpar_z001_trayek`
--
ALTER TABLE `cpar_z001_trayek`
  ADD PRIMARY KEY (`id_trayek`);

--
-- Indexes for table `ddd_biodata`
--
ALTER TABLE `ddd_biodata`
  ADD PRIMARY KEY (`id_biodata`);

--
-- Indexes for table `ddd_biodata_upload_dok`
--
ALTER TABLE `ddd_biodata_upload_dok`
  ADD PRIMARY KEY (`id_upload_dok`);

--
-- Indexes for table `ddd_data_kendaraan`
--
ALTER TABLE `ddd_data_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `tr_permohonan`
--
ALTER TABLE `tr_permohonan`
  ADD PRIMARY KEY (`id_permohonan_izin`);

--
-- Indexes for table `tr_permohonan_002_validasi`
--
ALTER TABLE `tr_permohonan_002_validasi`
  ADD PRIMARY KEY (`id_validasi_permohonan`);

--
-- Indexes for table `tr_permohonan_003_histori_data`
--
ALTER TABLE `tr_permohonan_003_histori_data`
  ADD PRIMARY KEY (`id_histori_data`);

--
-- Indexes for table `tr_permohonan_004_upload_biodata`
--
ALTER TABLE `tr_permohonan_004_upload_biodata`
  ADD PRIMARY KEY (`id_upload_dok_permohonan`);

--
-- Indexes for table `tr_permohonan_validasi`
--
ALTER TABLE `tr_permohonan_validasi`
  ADD PRIMARY KEY (`id_validasi_permohonan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_aktivasi_akun`
--
ALTER TABLE `users_aktivasi_akun`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `xcpar_angkut_001_jenis_angkutan`
--
ALTER TABLE `xcpar_angkut_001_jenis_angkutan`
  ADD PRIMARY KEY (`id_jenis_angkutan`);

--
-- Indexes for table `xcpar_angkut_002_mengangkut`
--
ALTER TABLE `xcpar_angkut_002_mengangkut`
  ADD PRIMARY KEY (`id_mengangkut`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aaa_access`
--
ALTER TABLE `aaa_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bpar_badan_usaha`
--
ALTER TABLE `bpar_badan_usaha`
  MODIFY `id_badan_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cpar_angkutan_001_jenis_angkutan`
--
ALTER TABLE `cpar_angkutan_001_jenis_angkutan`
  MODIFY `id_jenis_angkutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
--
ALTER TABLE `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
  MODIFY `id_mapping_angkutan_jenis_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cpar_kendaraan_001_merek_kendaraan`
--
ALTER TABLE `cpar_kendaraan_001_merek_kendaraan`
  MODIFY `id_merek_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cpar_kendaraan_002_type_kendaraan`
--
ALTER TABLE `cpar_kendaraan_002_type_kendaraan`
  MODIFY `id_type_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cpar_mengangkut_001_mengangkut`
--
ALTER TABLE `cpar_mengangkut_001_mengangkut`
  MODIFY `id_mengangkut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cpar_mengangkut_002_mapping`
--
ALTER TABLE `cpar_mengangkut_002_mapping`
  MODIFY `id_mapping_mengangkut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cpar_permohonan_001_jenis_permohonan`
--
ALTER TABLE `cpar_permohonan_001_jenis_permohonan`
  MODIFY `id_jenis_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cpar_permohonan_002_permohonan`
--
ALTER TABLE `cpar_permohonan_002_permohonan`
  MODIFY `id_par_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cpar_ttd_dokumen`
--
ALTER TABLE `cpar_ttd_dokumen`
  MODIFY `id_ttd_dok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cpar_z001_trayek`
--
ALTER TABLE `cpar_z001_trayek`
  MODIFY `id_trayek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ddd_biodata`
--
ALTER TABLE `ddd_biodata`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ddd_biodata_upload_dok`
--
ALTER TABLE `ddd_biodata_upload_dok`
  MODIFY `id_upload_dok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ddd_data_kendaraan`
--
ALTER TABLE `ddd_data_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tr_permohonan`
--
ALTER TABLE `tr_permohonan`
  MODIFY `id_permohonan_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tr_permohonan_002_validasi`
--
ALTER TABLE `tr_permohonan_002_validasi`
  MODIFY `id_validasi_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tr_permohonan_003_histori_data`
--
ALTER TABLE `tr_permohonan_003_histori_data`
  MODIFY `id_histori_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tr_permohonan_004_upload_biodata`
--
ALTER TABLE `tr_permohonan_004_upload_biodata`
  MODIFY `id_upload_dok_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tr_permohonan_validasi`
--
ALTER TABLE `tr_permohonan_validasi`
  MODIFY `id_validasi_permohonan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `xcpar_angkut_001_jenis_angkutan`
--
ALTER TABLE `xcpar_angkut_001_jenis_angkutan`
  MODIFY `id_jenis_angkutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `xcpar_angkut_002_mengangkut`
--
ALTER TABLE `xcpar_angkut_002_mengangkut`
  MODIFY `id_mengangkut` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
