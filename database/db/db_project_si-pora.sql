-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Apr 2023 pada 03.03
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project_si-pora`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aaa_access`
--

CREATE TABLE `aaa_access` (
  `id` int(11) NOT NULL,
  `url` varchar(225) NOT NULL,
  `access` varchar(50) NOT NULL,
  `status_actived` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aaa_access`
--

INSERT INTO `aaa_access` (`id`, `url`, `access`, `status_actived`) VALUES
(1, 'http://192.168.192.131/e-rekap/public/', 'qrcode', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bpar_badan_usaha`
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
-- Dumping data untuk tabel `bpar_badan_usaha`
--

INSERT INTO `bpar_badan_usaha` (`id_badan_usaha`, `nm_badan_usaha`, `status_actived`, `no_urut`, `created_at`, `updated_at`) VALUES
(1, 'PT', '1', 1, '2023-04-15 15:35:14', '2023-04-15 15:35:14'),
(2, 'CV', '1', 2, '2023-04-15 15:35:14', '2023-04-15 15:35:14'),
(3, 'Koperasi', '1', 5, '2023-04-15 15:35:14', '2023-04-15 15:35:14'),
(4, 'Personal / Perorangan', '1', 6, '2023-04-15 15:35:14', '2023-04-15 15:35:14'),
(5, 'BUMN', '1', 3, '2023-04-15 15:35:14', '2023-04-15 15:35:14'),
(6, 'BUMD', '1', 4, '2023-04-15 15:35:14', '2023-04-15 15:35:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_angkutan_001_jenis_angkutan`
--

CREATE TABLE `cpar_angkutan_001_jenis_angkutan` (
  `id_jenis_angkutan` int(11) NOT NULL,
  `nm_jenis_angkutan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cpar_angkutan_001_jenis_angkutan`
--

INSERT INTO `cpar_angkutan_001_jenis_angkutan` (`id_jenis_angkutan`, `nm_jenis_angkutan`, `created_at`, `updated_at`) VALUES
(1, 'Angkutan Orang', '2023-04-17 04:59:56', '2023-04-17 04:59:56'),
(2, 'Angkutan Barang Umum', '2023-04-17 04:59:56', '2023-04-17 04:59:56'),
(3, 'Angkutan Barang Khusus', '2023-04-17 04:59:56', '2023-04-17 04:59:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
--

CREATE TABLE `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan` (
  `id_mapping_angkutan_jenis_permohonan` int(11) NOT NULL,
  `id_jenis_angkutan` int(11) NOT NULL,
  `id_jenis_permohonan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
--

INSERT INTO `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan` (`id_mapping_angkutan_jenis_permohonan`, `id_jenis_angkutan`, `id_jenis_permohonan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 1, 2, NULL, NULL),
(5, 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_kendaraan_001_merek_kendaraan`
--

CREATE TABLE `cpar_kendaraan_001_merek_kendaraan` (
  `id_merek_kendaraan` int(11) NOT NULL,
  `nm_merek_kendaraan` varchar(100) NOT NULL,
  `slug_merek_kendaraan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cpar_kendaraan_001_merek_kendaraan`
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
(10, 'NISSAN', 'nissan', '2023-04-13 17:32:55', '2023-04-13 17:32:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_kendaraan_002_type_kendaraan`
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
-- Dumping data untuk tabel `cpar_kendaraan_002_type_kendaraan`
--

INSERT INTO `cpar_kendaraan_002_type_kendaraan` (`id_type_kendaraan`, `id_merek_kendaraan`, `nm_type_kendaraan`, `slug_type_kendaraan`, `status_actived`, `created_at`, `updated_at`) VALUES
(4, 1, 'MOBILIO', '', '1', '2023-04-13 18:51:21', '2023-04-13 18:51:21'),
(5, 3, 'SIGRA', '-1', '1', '2023-04-13 18:51:32', '2023-04-13 18:51:32'),
(6, 4, 'NEW AVANZA', '-2', '1', '2023-04-13 18:51:44', '2023-04-13 18:51:44'),
(7, 4, 'AVANZA', '-3', '1', '2023-04-13 18:51:56', '2023-04-13 18:51:56'),
(8, 3, 'XENIA', '-4', '1', '2023-04-13 18:52:08', '2023-04-13 18:52:08'),
(9, 1, 'BRIO', '-5', '1', '2023-04-13 18:52:19', '2023-04-13 18:52:19'),
(10, 4, 'CALYA', '-6', '1', '2023-04-13 18:52:32', '2023-04-13 18:52:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_mengangkut_001_mengangkut`
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
-- Dumping data untuk tabel `cpar_mengangkut_001_mengangkut`
--

INSERT INTO `cpar_mengangkut_001_mengangkut` (`id_mengangkut`, `nm_mengangkut`, `slug_mengangkut`, `status_actived`, `created_at`, `updated_at`) VALUES
(3, 'Orang', 'orang', '1', '2023-04-14 16:41:28', '2023-04-14 16:41:28'),
(4, 'Orang / Barang', 'orang-barang', '1', '2023-04-14 16:41:51', '2023-04-14 16:41:51'),
(5, 'Barang', 'barang', '1', '2023-04-14 16:42:59', '2023-04-14 16:42:59'),
(6, 'Pupuk', 'pupuk', '1', '2023-04-14 16:43:08', '2023-04-14 16:43:08'),
(7, 'Karyawan', 'karyawan', '1', '2023-04-14 16:43:14', '2023-04-14 16:43:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_mengangkut_002_mapping`
--

CREATE TABLE `cpar_mengangkut_002_mapping` (
  `id_mapping_mengangkut` int(11) NOT NULL,
  `id_mengangkut` int(11) NOT NULL,
  `id_jenis_angkutan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cpar_mengangkut_002_mapping`
--

INSERT INTO `cpar_mengangkut_002_mapping` (`id_mapping_mengangkut`, `id_mengangkut`, `id_jenis_angkutan`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2023-04-18 05:41:49', '2023-04-18 05:41:49'),
(7, 4, 1, '2023-04-18 05:41:59', '2023-04-18 05:41:59'),
(8, 4, 2, '2023-04-18 05:42:08', '2023-04-18 05:42:08'),
(9, 4, 3, '2023-04-18 05:42:14', '2023-04-18 05:42:14'),
(10, 5, 2, '2023-04-18 05:42:26', '2023-04-18 05:42:26'),
(12, 6, 3, '2023-04-18 05:42:42', '2023-04-18 05:42:42'),
(16, 7, 1, '2023-04-18 06:00:47', '2023-04-18 06:00:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_permohonan_001_jenis_permohonan`
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
-- Dumping data untuk tabel `cpar_permohonan_001_jenis_permohonan`
--

INSERT INTO `cpar_permohonan_001_jenis_permohonan` (`id_jenis_permohonan`, `nm_jenis_permohonan`, `alias_jenis_permohonan`, `status_actived`, `created_at`, `updated_at`) VALUES
(1, 'Rekomendasi TNKB', 'TNKB', 1, '2023-04-13 04:17:05', '2023-04-13 04:17:05'),
(2, 'Rekomendasi Trayek Angkutan Penumpang', 'Trayek', 1, '2023-04-13 04:17:05', '2023-04-13 04:17:05'),
(3, 'Rekomendasi Angkutan Barang Khusus', 'Mengangkut', 1, '2023-04-13 04:17:05', '2023-04-13 04:17:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_permohonan_002_permohonan`
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
-- Dumping data untuk tabel `cpar_permohonan_002_permohonan`
--

INSERT INTO `cpar_permohonan_002_permohonan` (`id_par_permohonan`, `nm_par_permohonan`, `id_jenis_permohonan`, `status_actived`, `created_at`, `updated_at`) VALUES
(1, 'Plat Kuning ke Plat Hitam', 1, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(2, 'Plat Hitam ke Plat Kuning', 1, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(3, 'Antar Jemput Dalam Provinsi (AJDP)', 2, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(4, 'Antar Kota Dalam Provinsi (AKDP)', 2, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(5, 'Angkutan Sewa Khusus', 2, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20'),
(6, 'Angkutan Barang Khusus', 3, '1', '2023-04-13 04:43:20', '2023-04-13 04:43:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_ttd_dokumen`
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
-- Dumping data untuk tabel `cpar_ttd_dokumen`
--

INSERT INTO `cpar_ttd_dokumen` (`id_ttd_dok`, `nm_ttd`, `pangkat_gol`, `nip_ttd`, `jabatan_ttd`, `kode_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Drs. H. ARINARSA JS', 'Pembina Utama Madya (IV/d)', '19710603 199101 1 002', 'KEPALA DINAS PERHUBUNGAN', 1, '2023-04-24 04:11:48', '2023-04-25 14:04:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpar_z001_trayek`
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
-- Dumping data untuk tabel `cpar_z001_trayek`
--

INSERT INTO `cpar_z001_trayek` (`id_trayek`, `nm_trayek`, `status_actived`, `slug_trayek`, `id_par_permohonan`, `created_at`, `updated_at`) VALUES
(4, 'Antar Jemput Dalam Provinsi (AJDP)', '1', 'antar-jemput-dalam-provinsi-ajdp', 3, '2023-04-14 16:24:02', '2023-04-14 16:25:38'),
(5, 'Antar Kota Dalam Provinsi (AKDP)', '1', 'antar-kota-dalam-provinsi-akdp', 4, '2023-04-14 16:25:27', '2023-04-15 14:38:54'),
(7, 'Tidak Dalam Trayek', '1', 'tidak-dalam-trayek', 5, '2023-04-14 16:30:19', '2023-04-14 17:58:13'),
(8, 'Term. Karya Jaya Palembang - Indralaya PP', '1', 'term-karya-jaya-palembang-indralaya-pp', 3, '2023-04-14 16:31:17', '2023-04-14 16:33:34'),
(9, 'PALEMBANG - PRABUMULIH', '1', '', 4, '2023-04-17 06:45:12', '2023-04-17 06:45:12'),
(10, 'PLG-M.DUA-RANAU (PP)', '1', '-1', 4, '2023-04-17 06:45:44', '2023-04-17 06:45:44'),
(11, 'TER. JK.BARING-INDRALAYA', '1', '-2', 4, '2023-04-17 06:45:56', '2023-04-17 06:45:56'),
(12, 'TER. ALANG ALANG LEBAR - SEKAYU', '1', 'ter-alang-alang-lebar-sekayu', 4, '2023-04-17 06:46:05', '2023-04-17 06:46:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ddd_biodata`
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
-- Dumping data untuk tabel `ddd_biodata`
--

INSERT INTO `ddd_biodata` (`id_biodata`, `id_badan_usaha`, `nm_perusahaan_personal`, `nm_pimpinan_pemilik`, `alamat_biodata`, `email`, `no_telp`, `slug_biodata`, `id_user`, `created_at`, `updated_at`) VALUES
(14, 1, 'PT. BATURAJA MULTI USAHA', 'PT. BATURAJA MULTI USAHA', 'JL. BATURAJA', 'rio@gmail.com', '123312311111', 'pt-baturaja-multi-usaha-1', 6, '2023-04-15 18:54:43', '2023-04-16 04:01:45'),
(15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', 'anta-salam', 7, '2023-04-18 06:54:18', '2023-04-18 06:54:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ddd_biodata_upload_dok`
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
-- Dumping data untuk tabel `ddd_biodata_upload_dok`
--

INSERT INTO `ddd_biodata_upload_dok` (`id_upload_dok`, `jenis_dok`, `file_dokumen`, `id_biodata`, `created_at`, `updated_at`) VALUES
(11, 1, '230427125614.pdf', 15, '2023-04-26 17:56:14', '2023-04-26 17:56:14'),
(12, 3, '230427125621.pdf', 15, '2023-04-26 17:56:21', '2023-04-26 17:56:21'),
(13, 4, '230427125630.pdf', 15, '2023-04-26 17:56:30', '2023-04-26 17:56:30'),
(14, 2, '230427125638.pdf', 15, '2023-04-26 17:56:38', '2023-04-26 17:56:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ddd_data_kendaraan`
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
-- Dumping data untuk tabel `ddd_data_kendaraan`
--

INSERT INTO `ddd_data_kendaraan` (`id_kendaraan`, `id_merek_kendaraan`, `id_type_kendaraan`, `nm_kendaraan`, `plat_no_kendaraan`, `daya_angkut_orang`, `daya_angkut_barang`, `thn_pembuatan`, `no_rangka`, `no_mesin`, `id_biodata`, `status_actived`, `file_kir`, `file_stnk`, `created_at`, `updated_at`) VALUES
(4, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, '1', '230426115156.pdf', '230426115708.pdf', '2023-04-18 06:55:07', '2023-04-26 16:57:08'),
(6, 1, 9, 'Brio G Type x RIo', 'B 1231 AX', 45, 35, 2020, 'MJEFM8JW2PJX11x085', 'J08EWDJ20962x', 14, '1', NULL, NULL, '2023-04-18 19:27:55', '2023-04-18 20:01:28'),
(10, 3, 8, 'Type G RIo', 'BG 1233 ASS', 6, 50, 2020, 'FFDDDRRRRRF', '1123DDDSSAAAAA', 14, '1', NULL, NULL, '2023-04-18 19:49:15', '2023-04-18 20:01:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_permohonan`
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tr_permohonan`
--

INSERT INTO `tr_permohonan` (`id_permohonan_izin`, `id_jenis_permohonan`, `id_par_permohonan`, `id_trayek`, `id_jenis_angkutan`, `id_mengangkut`, `id_merek_kendaraan`, `id_type_kendaraan`, `nm_kendaraan`, `plat_no_kendaraan`, `daya_angkut_orang`, `daya_angkut_barang`, `thn_pembuatan`, `no_rangka`, `no_mesin`, `id_biodata`, `id_badan_usaha`, `nm_perusahaan_personal`, `nm_pimpinan_pemilik`, `alamat_biodata`, `email`, `no_telp`, `tgl_kirim_permohonan`, `status_permohonan`, `file_kir`, `file_stnk`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 0, 1, 3, 1, 9, 'Brio \'1231312 CC tio', 'BG \"12321', 1232, 3111, 2023, '/1231AACC:', '243242;', 14, 1, 'PT. BATURAJA MULTI USAHA', 'PT. BATURAJA MULTI USAHA', 'JL. BATURAJA', 'rio@gmail.com', '123312311111', '2023-04-19 01:24:43', '2', NULL, NULL, '2023-04-18 18:24:43', '2023-04-19 08:02:48'),
(7, 2, 4, 11, 1, 7, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-19 03:03:27', '2', NULL, NULL, '2023-04-18 20:03:27', '2023-04-19 08:02:43'),
(9, 3, 6, 0, 3, 6, 1, 9, 'Brio G Type x RIo', 'B 1231 AX', 45, 35, 2020, 'MJEFM8JW2PJX11x085', 'J08EWDJ20962x', 14, 1, 'PT. BATURAJA MULTI USAHA', 'PT. BATURAJA MULTI USAHA', 'JL. BATURAJA', 'rio@gmail.com', '123312311111', '2023-04-19 22:41:50', '2', NULL, NULL, '2023-04-19 15:41:50', '2023-04-23 16:41:49'),
(10, 1, 1, 0, 1, 3, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-20 02:30:29', '2', NULL, NULL, '2023-04-19 19:30:29', '2023-04-23 16:41:07'),
(11, 1, 2, 0, 1, 7, 1, 9, 'Brio G Type x RIo', 'B 1231 AX', 45, 35, 2020, 'MJEFM8JW2PJX11x085', 'J08EWDJ20962x', 14, 1, 'PT. BATURAJA MULTI USAHA', 'PT. BATURAJA MULTI USAHA', 'JL. BATURAJA', 'rio@gmail.com', '123312311111', '2023-04-21 23:05:46', '2', NULL, NULL, '2023-04-21 16:05:46', '2023-04-23 16:40:53'),
(12, 2, 4, 10, 1, 4, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-21 23:20:06', '2', NULL, NULL, '2023-04-21 16:20:06', '2023-04-21 17:32:59'),
(13, 2, 4, 9, 1, 4, 1, 9, 'Brio G Type x RIo', 'B 1231 AX', 45, 35, 2020, 'MJEFM8JW2PJX11x085', 'J08EWDJ20962x', 14, 1, 'PT. BATURAJA MULTI USAHA', 'PT. BATURAJA MULTI USAHA', 'JL. BATURAJA', 'rio@gmail.com', '123312311111', '2023-04-21 23:56:19', '2', NULL, NULL, '2023-04-21 16:56:19', '2023-04-23 16:40:41'),
(15, 2, 4, 9, 1, 4, 4, 10, 'Calya Ribon', 'bg 1221 dd', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-23 22:45:41', '5', NULL, NULL, '2023-04-23 15:45:41', '2023-04-25 13:50:29'),
(17, 1, 1, 0, 3, 4, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 00:03:44', '2', NULL, NULL, '2023-04-26 17:03:44', '2023-04-26 17:03:44'),
(18, 1, 1, 0, 2, 5, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 00:32:41', '2', NULL, NULL, '2023-04-26 17:32:41', '2023-04-26 17:32:41'),
(19, 1, 1, 0, 2, 5, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 00:33:09', '2', NULL, NULL, '2023-04-26 17:33:09', '2023-04-26 17:33:09'),
(20, 1, 1, 0, 2, 5, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 00:42:11', '2', NULL, NULL, '2023-04-26 17:42:11', '2023-04-26 17:42:11'),
(21, 1, 1, 0, 2, 5, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 00:49:50', '2', NULL, NULL, '2023-04-26 17:49:50', '2023-04-26 17:49:50'),
(22, 1, 1, 0, 2, 5, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 00:52:29', '2', NULL, NULL, '2023-04-26 17:52:29', '2023-04-26 17:52:29'),
(23, 1, 1, 0, 2, 5, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 00:56:45', '2', NULL, NULL, '2023-04-26 17:56:45', '2023-04-26 17:56:45'),
(24, 1, 1, 0, 2, 5, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 00:58:17', '4', NULL, NULL, '2023-04-26 17:58:17', '2023-04-26 18:43:43'),
(25, 2, 3, 4, 1, 4, 4, 10, 'Calya Ribon', '123211232', 123, 312, 2023, '123', '321', 15, 4, 'Anta Salam', 'Anta Salam', 'palembang', 'anta@gmail.com', '12312312', '2023-04-27 01:52:34', '2', '230426115156.pdf', '230426115708.pdf', '2023-04-26 18:52:34', '2023-04-26 18:52:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_permohonan_002_validasi`
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
  `status_validasi` enum('1','2','3','4','5') NOT NULL COMMENT '''1 = draft, 2 = kirim, 3 = ditolak, 4 = di proses, 5 = selesai / diterima'';',
  `id_permohonan_izin` int(11) NOT NULL,
  `tgl_validasi_proses` datetime DEFAULT NULL,
  `tgl_validasi_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tr_permohonan_002_validasi`
--

INSERT INTO `tr_permohonan_002_validasi` (`id_validasi_permohonan`, `no_kartu_pengawas`, `tgl_sk`, `no_sk`, `tgl_awal`, `tgl_akhir`, `tgl_kir_awal`, `tgl_kir_akhir`, `status_validasi`, `id_permohonan_izin`, `tgl_validasi_proses`, `tgl_validasi_selesai`, `created_at`, `updated_at`) VALUES
(23, 'SKEP. 46/551.2/DISHUB/2023/4/100', '2023-04-12', 'Skep. 40/41/551.2/DISHUB/2023', '2023-04-12', '2023-10-12', '2023-04-24', '2023-04-24', '5', 15, '2023-04-23 23:50:27', '2023-04-25', '2023-04-23 16:50:27', '2023-04-25 13:50:29'),
(25, '-', NULL, '-', NULL, NULL, NULL, NULL, '4', 24, '2023-04-27 01:43:42', NULL, '2023-04-26 18:43:42', '2023-04-26 18:43:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_permohonan_003_histori_data`
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
-- Dumping data untuk tabel `tr_permohonan_003_histori_data`
--

INSERT INTO `tr_permohonan_003_histori_data` (`id_histori_data`, `status_permohonan`, `keterangan_histori`, `id_permohonan_izin`, `created_at`, `updated_at`) VALUES
(1, '3', 'salah pada format isian\r\nsesuaikan lagi \r\ntolong ya', 12, '2023-04-21 17:32:59', '2023-04-21 17:32:59'),
(2, '3', 'tolakk', 14, '2023-04-23 16:20:39', '2023-04-23 16:20:39'),
(3, '3', 'asdsadas', 15, '2023-04-23 16:40:32', '2023-04-23 16:40:32'),
(4, '3', 'aaaaaaaaaa', 13, '2023-04-23 16:40:41', '2023-04-23 16:40:41'),
(5, '3', 'sadas', 11, '2023-04-23 16:40:53', '2023-04-23 16:40:53'),
(6, '3', 'aaaaaaaaaaaa', 10, '2023-04-23 16:41:07', '2023-04-23 16:41:07'),
(7, '3', 'cccccccc', 9, '2023-04-23 16:41:49', '2023-04-23 16:41:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_permohonan_004_upload_biodata`
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
-- Dumping data untuk tabel `tr_permohonan_004_upload_biodata`
--

INSERT INTO `tr_permohonan_004_upload_biodata` (`id_upload_dok_permohonan`, `jenis_dok`, `file_dokumen`, `id_biodata`, `id_permohonan_izin`, `created_at`, `updated_at`) VALUES
(12, 1, '230427125614.pdf', 15, 23, NULL, NULL),
(13, 3, '230427125621.pdf', 15, 23, NULL, NULL),
(14, 4, '230427125630.pdf', 15, 23, NULL, NULL),
(15, 2, '230427125638.pdf', 15, 23, NULL, NULL),
(16, 1, '230427125614.pdf', 15, 24, NULL, NULL),
(17, 3, '230427125621.pdf', 15, 24, NULL, NULL),
(18, 4, '230427125630.pdf', 15, 24, NULL, NULL),
(19, 2, '230427125638.pdf', 15, 24, NULL, NULL),
(20, 1, '230427125614.pdf', 15, 25, NULL, NULL),
(21, 3, '230427125621.pdf', 15, 25, NULL, NULL),
(22, 4, '230427125630.pdf', 15, 25, NULL, NULL),
(23, 2, '230427125638.pdf', 15, 25, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_permohonan_validasi`
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
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2023-02-25 17:44:11', '$2y$10$mwkrr.d49EW2gIJOB37b7eTEBW.5nqiBkGccf5AcCAEDyKsXeXSoe', '1', NULL, '2023-02-25 17:44:54', '2023-04-26 03:41:19'),
(6, 'pt.rio', 'rio@gmail.com', '2023-02-25 17:44:11', '$2y$10$IXrV38hHRXGmt4BYb7ksleXhVk4la9aCS2JHwtVe2cAUxqyRlTOXK', '3', NULL, '2023-02-25 17:44:54', '2023-03-21 10:47:24'),
(7, 'PT. Anta', 'anta@gmail.com', '2023-02-25 17:44:11', '$2y$10$hrsr6SeaB1D7SpZyKiALp.mAxv3R4CJnNUtKDn5XycH49obarvhZS', '3', NULL, '2023-02-25 17:44:54', '2023-04-26 01:38:12'),
(8, 'Petugas KIR', 'kir@gmail.com', '2023-02-25 17:44:11', '$2y$10$IXrV38hHRXGmt4BYb7ksleXhVk4la9aCS2JHwtVe2cAUxqyRlTOXK', '2', NULL, '2023-02-25 17:44:54', '2023-03-21 10:47:24'),
(9, 'pindah sementara', 'rio007@gmail.com', NULL, '$2y$10$FWu5aJ3Fc6s0M1YX8S.UkuKRAS/c0oFTtWr9BCwJdgIsWIy3tfx5m', '3', NULL, '2023-04-25 18:52:11', '2023-04-26 01:45:58'),
(10, 'Sekretariat', 'sekretariat@gmail.com', NULL, '$2y$10$pBt.siHvv1aDs1q28bvfJOlnfA6vkyHetFn0atr.KED3A3oHN.Q5y', '3', NULL, '2023-04-26 13:31:41', '2023-04-26 13:31:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_aktivasi_akun`
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
-- Struktur dari tabel `xcpar_angkut_001_jenis_angkutan`
--

CREATE TABLE `xcpar_angkut_001_jenis_angkutan` (
  `id_jenis_angkutan` int(11) NOT NULL,
  `nm_jenis_angkutan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `xcpar_angkut_001_jenis_angkutan`
--

INSERT INTO `xcpar_angkut_001_jenis_angkutan` (`id_jenis_angkutan`, `nm_jenis_angkutan`, `created_at`, `updated_at`) VALUES
(1, 'Angkutan Orang', '2023-04-12 16:16:37', '2023-04-12 16:16:37'),
(2, 'Angkutan Barang Khusus', '2023-04-12 16:16:37', '2023-04-12 16:16:37'),
(3, 'Angkutan Barang Umum', '2023-04-12 16:16:37', '2023-04-12 16:16:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `xcpar_angkut_002_mengangkut`
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
-- Indeks untuk tabel `aaa_access`
--
ALTER TABLE `aaa_access`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bpar_badan_usaha`
--
ALTER TABLE `bpar_badan_usaha`
  ADD PRIMARY KEY (`id_badan_usaha`);

--
-- Indeks untuk tabel `cpar_angkutan_001_jenis_angkutan`
--
ALTER TABLE `cpar_angkutan_001_jenis_angkutan`
  ADD PRIMARY KEY (`id_jenis_angkutan`);

--
-- Indeks untuk tabel `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
--
ALTER TABLE `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
  ADD PRIMARY KEY (`id_mapping_angkutan_jenis_permohonan`);

--
-- Indeks untuk tabel `cpar_kendaraan_001_merek_kendaraan`
--
ALTER TABLE `cpar_kendaraan_001_merek_kendaraan`
  ADD PRIMARY KEY (`id_merek_kendaraan`);

--
-- Indeks untuk tabel `cpar_kendaraan_002_type_kendaraan`
--
ALTER TABLE `cpar_kendaraan_002_type_kendaraan`
  ADD PRIMARY KEY (`id_type_kendaraan`);

--
-- Indeks untuk tabel `cpar_mengangkut_001_mengangkut`
--
ALTER TABLE `cpar_mengangkut_001_mengangkut`
  ADD PRIMARY KEY (`id_mengangkut`);

--
-- Indeks untuk tabel `cpar_mengangkut_002_mapping`
--
ALTER TABLE `cpar_mengangkut_002_mapping`
  ADD PRIMARY KEY (`id_mapping_mengangkut`);

--
-- Indeks untuk tabel `cpar_permohonan_001_jenis_permohonan`
--
ALTER TABLE `cpar_permohonan_001_jenis_permohonan`
  ADD PRIMARY KEY (`id_jenis_permohonan`);

--
-- Indeks untuk tabel `cpar_permohonan_002_permohonan`
--
ALTER TABLE `cpar_permohonan_002_permohonan`
  ADD PRIMARY KEY (`id_par_permohonan`);

--
-- Indeks untuk tabel `cpar_ttd_dokumen`
--
ALTER TABLE `cpar_ttd_dokumen`
  ADD PRIMARY KEY (`id_ttd_dok`);

--
-- Indeks untuk tabel `cpar_z001_trayek`
--
ALTER TABLE `cpar_z001_trayek`
  ADD PRIMARY KEY (`id_trayek`);

--
-- Indeks untuk tabel `ddd_biodata`
--
ALTER TABLE `ddd_biodata`
  ADD PRIMARY KEY (`id_biodata`);

--
-- Indeks untuk tabel `ddd_biodata_upload_dok`
--
ALTER TABLE `ddd_biodata_upload_dok`
  ADD PRIMARY KEY (`id_upload_dok`);

--
-- Indeks untuk tabel `ddd_data_kendaraan`
--
ALTER TABLE `ddd_data_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indeks untuk tabel `tr_permohonan`
--
ALTER TABLE `tr_permohonan`
  ADD PRIMARY KEY (`id_permohonan_izin`);

--
-- Indeks untuk tabel `tr_permohonan_002_validasi`
--
ALTER TABLE `tr_permohonan_002_validasi`
  ADD PRIMARY KEY (`id_validasi_permohonan`);

--
-- Indeks untuk tabel `tr_permohonan_003_histori_data`
--
ALTER TABLE `tr_permohonan_003_histori_data`
  ADD PRIMARY KEY (`id_histori_data`);

--
-- Indeks untuk tabel `tr_permohonan_004_upload_biodata`
--
ALTER TABLE `tr_permohonan_004_upload_biodata`
  ADD PRIMARY KEY (`id_upload_dok_permohonan`);

--
-- Indeks untuk tabel `tr_permohonan_validasi`
--
ALTER TABLE `tr_permohonan_validasi`
  ADD PRIMARY KEY (`id_validasi_permohonan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `users_aktivasi_akun`
--
ALTER TABLE `users_aktivasi_akun`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `xcpar_angkut_001_jenis_angkutan`
--
ALTER TABLE `xcpar_angkut_001_jenis_angkutan`
  ADD PRIMARY KEY (`id_jenis_angkutan`);

--
-- Indeks untuk tabel `xcpar_angkut_002_mengangkut`
--
ALTER TABLE `xcpar_angkut_002_mengangkut`
  ADD PRIMARY KEY (`id_mengangkut`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aaa_access`
--
ALTER TABLE `aaa_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bpar_badan_usaha`
--
ALTER TABLE `bpar_badan_usaha`
  MODIFY `id_badan_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cpar_angkutan_001_jenis_angkutan`
--
ALTER TABLE `cpar_angkutan_001_jenis_angkutan`
  MODIFY `id_jenis_angkutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
--
ALTER TABLE `cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan`
  MODIFY `id_mapping_angkutan_jenis_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cpar_kendaraan_001_merek_kendaraan`
--
ALTER TABLE `cpar_kendaraan_001_merek_kendaraan`
  MODIFY `id_merek_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `cpar_kendaraan_002_type_kendaraan`
--
ALTER TABLE `cpar_kendaraan_002_type_kendaraan`
  MODIFY `id_type_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `cpar_mengangkut_001_mengangkut`
--
ALTER TABLE `cpar_mengangkut_001_mengangkut`
  MODIFY `id_mengangkut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `cpar_mengangkut_002_mapping`
--
ALTER TABLE `cpar_mengangkut_002_mapping`
  MODIFY `id_mapping_mengangkut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `cpar_permohonan_001_jenis_permohonan`
--
ALTER TABLE `cpar_permohonan_001_jenis_permohonan`
  MODIFY `id_jenis_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `cpar_permohonan_002_permohonan`
--
ALTER TABLE `cpar_permohonan_002_permohonan`
  MODIFY `id_par_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cpar_ttd_dokumen`
--
ALTER TABLE `cpar_ttd_dokumen`
  MODIFY `id_ttd_dok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cpar_z001_trayek`
--
ALTER TABLE `cpar_z001_trayek`
  MODIFY `id_trayek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `ddd_biodata`
--
ALTER TABLE `ddd_biodata`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `ddd_biodata_upload_dok`
--
ALTER TABLE `ddd_biodata_upload_dok`
  MODIFY `id_upload_dok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `ddd_data_kendaraan`
--
ALTER TABLE `ddd_data_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tr_permohonan`
--
ALTER TABLE `tr_permohonan`
  MODIFY `id_permohonan_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tr_permohonan_002_validasi`
--
ALTER TABLE `tr_permohonan_002_validasi`
  MODIFY `id_validasi_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tr_permohonan_003_histori_data`
--
ALTER TABLE `tr_permohonan_003_histori_data`
  MODIFY `id_histori_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tr_permohonan_004_upload_biodata`
--
ALTER TABLE `tr_permohonan_004_upload_biodata`
  MODIFY `id_upload_dok_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tr_permohonan_validasi`
--
ALTER TABLE `tr_permohonan_validasi`
  MODIFY `id_validasi_permohonan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `xcpar_angkut_001_jenis_angkutan`
--
ALTER TABLE `xcpar_angkut_001_jenis_angkutan`
  MODIFY `id_jenis_angkutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `xcpar_angkut_002_mengangkut`
--
ALTER TABLE `xcpar_angkut_002_mengangkut`
  MODIFY `id_mengangkut` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
