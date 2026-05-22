-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2026 at 12:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datajoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-04-20-000001', 'App\\Database\\Migrations\\CreateLookupTables', 'default', 'App', 1776651203, 1),
(2, '2026-04-20-000002', 'App\\Database\\Migrations\\CreateAllTables', 'default', 'App', 1776651203, 1),
(3, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1776651607, 2),
(4, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1776651607, 2),
(5, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1776651607, 2),
(6, '2026-05-06-013505', 'App\\Database\\Migrations\\AddCustomFieldsToUsers', 'default', 'App', 1778039095, 3),
(7, '2026-05-19-080000', 'App\\Database\\Migrations\\AddProfileImageToUsers', 'default', 'App', 1779175696, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc001msettings`
--

CREATE TABLE `pjoc001msettings` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc001msettings`
--

INSERT INTO `pjoc001msettings` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'kadar_jam_default', '6.50', '2026-04-20 02:13:23', NULL, NULL, NULL, NULL, NULL),
(2, 'max_jam_tahun', '320', '2026-04-20 02:13:23', NULL, NULL, NULL, NULL, NULL),
(3, 'max_jam_minggu_semester', '40', '2026-04-20 02:13:23', NULL, NULL, NULL, NULL, NULL),
(4, 'max_jam_minggu_luar_semester', '20', '2026-04-20 02:13:23', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc002miklanpekerjaan`
--

CREATE TABLE `pjoc002miklanpekerjaan` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod_ptj` varchar(20) NOT NULL,
  `ukmper_penyelia` varchar(7) NOT NULL,
  `ukmper_ketua_projek` varchar(7) DEFAULT NULL,
  `kodgl` varchar(50) DEFAULT NULL,
  `tajuk` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `tkh_mula` date NOT NULL,
  `tkh_tamat` date NOT NULL,
  `tkh_tutup_calon` date DEFAULT NULL,
  `perlu_temuduga` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `tkh_temuduga_default` date DEFAULT NULL,
  `masa_temuduga_default` time DEFAULT NULL,
  `lokasi_temuduga_default` varchar(255) DEFAULT NULL,
  `kemahiran` text DEFAULT NULL,
  `kekosongan` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `jenis_peruntukan` varchar(50) NOT NULL DEFAULT 'ptj',
  `mod_kerja` varchar(50) NOT NULL DEFAULT 'timesheet',
  `kadar_jam` decimal(8,2) NOT NULL DEFAULT 6.50,
  `status` varchar(50) NOT NULL DEFAULT 'draft',
  `sebab_penolakan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc003mmohonkerja`
--

CREATE TABLE `pjoc003mmohonkerja` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_kerja` int(11) UNSIGNED NOT NULL,
  `matrik` varchar(7) NOT NULL,
  `source` varchar(50) NOT NULL,
  `import_batch_id` int(11) UNSIGNED DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `remarks` text DEFAULT NULL,
  `tkh_temuduga` date DEFAULT NULL,
  `masa_temuduga` time DEFAULT NULL,
  `lokasi_temuduga` varchar(255) DEFAULT NULL,
  `tkh_tamat_kerja` date DEFAULT NULL,
  `sebab_tamat` text DEFAULT NULL,
  `ditamatkan_oleh` varchar(7) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc004msurattawaran`
--

CREATE TABLE `pjoc004msurattawaran` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_calon` int(11) UNSIGNED NOT NULL,
  `letter_file` varchar(500) DEFAULT NULL,
  `respon_pelajar` varchar(50) NOT NULL DEFAULT 'pending',
  `tarikh_respon` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc005mtimesheets`
--

CREATE TABLE `pjoc005mtimesheets` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_calon` int(11) UNSIGNED NOT NULL,
  `minggu_bermula` date NOT NULL,
  `minggu_berakhir` date NOT NULL,
  `jumlah_jam` decimal(6,2) NOT NULL DEFAULT 0.00,
  `remarks` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `id_sah` varchar(7) DEFAULT NULL,
  `tkh_sah` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc006mtuntutan`
--

CREATE TABLE `pjoc006mtuntutan` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_calon` int(11) UNSIGNED NOT NULL,
  `bulan` varchar(7) NOT NULL COMMENT 'Format YYYY-MM',
  `jumlah_jam` decimal(8,2) NOT NULL DEFAULT 0.00,
  `jumlah_bayaran` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fail_bukti` varchar(500) DEFAULT NULL,
  `pautan_bukti` varchar(500) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending_supervisor',
  `sebab_penolakan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc007mperuntukanbajetcareer`
--

CREATE TABLE `pjoc007mperuntukanbajetcareer` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_diperuntukkan` decimal(14,2) NOT NULL DEFAULT 0.00,
  `jumlah_dibelanjakan` decimal(14,2) NOT NULL DEFAULT 0.00,
  `baki` decimal(14,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc008mbatchimportpelajar`
--

CREATE TABLE `pjoc008mbatchimportpelajar` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_kerja` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `jumlah_rows` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `jumlah_berjaya` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `jumlah_gagal` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc009mstudentimport`
--

CREATE TABLE `pjoc009mstudentimport` (
  `id` int(11) UNSIGNED NOT NULL,
  `batch_id` int(11) UNSIGNED NOT NULL,
  `row_number` int(11) UNSIGNED NOT NULL,
  `row_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`row_data`)),
  `matrik` varchar(7) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `error_message` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc010mnotifications`
--

CREATE TABLE `pjoc010mnotifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `matrik` varchar(7) NOT NULL,
  `tajuk` varchar(255) NOT NULL,
  `mesej` text DEFAULT NULL,
  `pautan` varchar(500) DEFAULT NULL,
  `telah_dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc011murusetia`
--

CREATE TABLE `pjoc011murusetia` (
  `id` int(11) UNSIGNED NOT NULL,
  `ukmper` varchar(7) NOT NULL COMMENT 'Staff ID from SSO (session id)',
  `nama` varchar(255) NOT NULL,
  `tahap_akses` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=Pegawai, 2=Penyelia Urusetia, 3=Pentadbir',
  `aktif` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=Aktif, 0=Tidak Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(7) DEFAULT NULL,
  `updated_by` varchar(7) DEFAULT NULL,
  `deleted_by` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjoc101kstsiklan`
--

CREATE TABLE `pjoc101kstsiklan` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc101kstsiklan`
--

INSERT INTO `pjoc101kstsiklan` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'draft', 'Draft', 'Draf', 'secondary', 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'pending_kp', 'Pending KP', 'Menunggu KP', 'info', 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'pending_ketua_projek', 'Pending Project Head', 'Menunggu Ketua Projek', 'info', 3, 1, '2026-04-20 02:13:23', NULL),
(4, 'pending_career', 'Pending Approval', 'Menunggu Kelulusan', 'warning', 4, 1, '2026-04-20 02:13:23', NULL),
(5, 'active', 'Active', 'Aktif', 'success', 5, 1, '2026-04-20 02:13:23', NULL),
(6, 'rejected', 'Rejected', 'Ditolak', 'danger', 6, 1, '2026-04-20 02:13:23', NULL),
(7, 'closed', 'Closed', 'Ditutup', 'dark', 7, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc102kstscalon`
--

CREATE TABLE `pjoc102kstscalon` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc102kstscalon`
--

INSERT INTO `pjoc102kstscalon` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pending', 'Pending', 'Menunggu', 'warning', 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'interview', 'Called for Interview', 'Dipanggil Temuduga', 'info', 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'recommended', 'Recommended', 'Disyorkan', 'info', 3, 1, '2026-04-20 02:13:23', NULL),
(4, 'offer_issued', 'Offer Issued', 'Tawaran Dikeluarkan', 'primary', 4, 1, '2026-04-20 02:13:23', NULL),
(5, 'offer_declined', 'Offer Declined', 'Tawaran Ditolak', 'danger', 5, 1, '2026-04-20 02:13:23', NULL),
(6, 'active', 'Active', 'Aktif', 'success', 6, 1, '2026-04-20 02:13:23', NULL),
(7, 'ended', 'Ended', 'Tamat', 'secondary', 7, 1, '2026-04-20 02:13:23', NULL),
(8, 'rejected', 'Rejected', 'Ditolak', 'danger', 8, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc103kststimesheet`
--

CREATE TABLE `pjoc103kststimesheet` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc103kststimesheet`
--

INSERT INTO `pjoc103kststimesheet` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pending', 'Pending', 'Menunggu', 'warning', 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'verified', 'Verified', 'Disahkan', 'success', 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'rejected', 'Rejected', 'Ditolak', 'danger', 3, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc104kststuntutan`
--

CREATE TABLE `pjoc104kststuntutan` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc104kststuntutan`
--

INSERT INTO `pjoc104kststuntutan` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pending_supervisor', 'Supervisor Review', 'Semakan Penyelia', 'warning', 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'pending_career', 'Career Review', 'Semakan Kerjaya', 'info', 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'pending_kp', 'KP Review', 'Semakan KP', 'info', 3, 1, '2026-04-20 02:13:23', NULL),
(4, 'approved', 'Approved', 'Diluluskan', 'success', 4, 1, '2026-04-20 02:13:23', NULL),
(5, 'rejected', 'Rejected', 'Ditolak', 'danger', 5, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc105kstsbatchimport`
--

CREATE TABLE `pjoc105kstsbatchimport` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc105kstsbatchimport`
--

INSERT INTO `pjoc105kstsbatchimport` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pending', 'Pending', 'Menunggu', 'warning', 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'processing', 'Processing', 'Memproses', 'info', 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'completed', 'Completed', 'Selesai', 'success', 3, 1, '2026-04-20 02:13:23', NULL),
(4, 'failed', 'Failed', 'Gagal', 'danger', 4, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc106kstsrowimport`
--

CREATE TABLE `pjoc106kstsrowimport` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc106kstsrowimport`
--

INSERT INTO `pjoc106kstsrowimport` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pending', 'Pending', 'Menunggu', 'warning', 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'success', 'Success', 'Berjaya', 'success', 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'failed', 'Failed', 'Gagal', 'danger', 3, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc107kjnsperuntukan`
--

CREATE TABLE `pjoc107kjnsperuntukan` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc107kjnsperuntukan`
--

INSERT INTO `pjoc107kjnsperuntukan` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'career_dept', 'Career Division', 'Bahagian Kerjaya', NULL, 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'ptj', 'Department', 'PTJ', NULL, 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'projek_tabung', 'Project/Fund', 'Projek/Tabung', NULL, 3, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc108kmodkerja`
--

CREATE TABLE `pjoc108kmodkerja` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc108kmodkerja`
--

INSERT INTO `pjoc108kmodkerja` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'timesheet', 'Timesheet', 'Timesheet', NULL, 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'task_proof', 'Task Proof', 'Bukti Tugasan', NULL, 2, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc109krespontawaran`
--

CREATE TABLE `pjoc109krespontawaran` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc109krespontawaran`
--

INSERT INTO `pjoc109krespontawaran` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pending', 'Pending Response', 'Menunggu Respons', 'warning', 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'accepted', 'Accepted', 'Diterima', 'success', 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'declined', 'Declined', 'Ditolak', 'danger', 3, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pjoc110ksumbercalon`
--

CREATE TABLE `pjoc110ksumbercalon` (
  `id` int(11) UNSIGNED NOT NULL,
  `kod` varchar(50) NOT NULL,
  `label_en` varchar(100) NOT NULL,
  `label_ms` varchar(100) NOT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pjoc110ksumbercalon`
--

INSERT INTO `pjoc110ksumbercalon` (`id`, `kod`, `label_en`, `label_ms`, `badge`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pelajar_mohon', 'Self-Applied', 'Permohonan Sendiri', 'info', 1, 1, '2026-04-20 02:13:23', NULL),
(2, 'penyelia_keyin', 'Supervisor Key-in', 'Key-in Penyelia', 'primary', 2, 1, '2026-04-20 02:13:23', NULL),
(3, 'import_excel', 'Excel Import', 'Import Excel', 'secondary', 3, 1, '2026-04-20 02:13:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `identity_no` varchar(20) DEFAULT NULL,
  `user_category` enum('pelajar','kakitangan') DEFAULT 'pelajar',
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`, `first_name`, `last_name`, `identity_no`, `user_category`, `profile_image`) VALUES
(1, 'A051405', NULL, NULL, 1, '2026-05-20 08:17:20', '2026-05-11 01:58:01', '2026-05-20 03:44:40', NULL, 'Umairah', 'Sabri', 'A051405', 'pelajar', NULL),
(2, 'K006011', NULL, NULL, 1, '2026-05-20 08:19:12', '2026-05-20 01:27:52', '2026-05-20 01:28:17', NULL, 'Nur', 'Umairah', 'K006011', 'kakitangan', NULL),
(3, 'K001611', NULL, NULL, 1, '2026-05-20 08:20:13', '2026-05-20 02:10:54', '2026-05-20 02:11:51', NULL, 'Aliya', 'Rizal', 'K001611', 'kakitangan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users2`
--

CREATE TABLE `users2` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users2`
--

INSERT INTO `users2` (`id`, `username`, `email`, `password`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'lkoh', 'yau.renuga@example.net', '$2y$12$9GfQFKAdYRSY9nNDDAzdXevriS8iXkwjnjK.e9jWnz3kIaC3IYewy', '+6015-424 6936', '2026-05-20 06:52:05', '2026-05-20 06:52:05'),
(2, 'sasya.rasyid', 'jemie.zubir@example.net', '$2y$12$RDNzJTr7.ti8YhUGY51Y0.hta8qDwH002wR/M2qcbacKtA9CwhEdm', '+6015-144 9582', '2026-05-20 06:52:06', '2026-05-20 06:52:06'),
(3, 'shanmuganathan.sihgui', 'rishyakaran.hooiway@example.com', '$2y$12$kB0rkrKTJX0WtsY651bOOO8Ybfyz.PVNYtkOhghiq7nMoq3i.otpW', '+6012-297 3970', '2026-05-20 06:52:06', '2026-05-20 06:52:06'),
(4, 'wliong', 'fuzi.tracy@example.net', '$2y$12$/qr7rKU90/avk8Et6U7Jo..bZeppeJzmlX344ioSD6ysuiDvYnDXy', '+6018-853 6077', '2026-05-20 06:52:06', '2026-05-20 06:52:06'),
(5, 'zolkafeli.nahkit', 'shuolap.basaruddin@example.org', '$2y$12$Ug7CCqKDDdwTGbYe34cAA.EdWVm50bp9jXNRJOAwQBF.ivzF0NSyC', '+6010-275 1163', '2026-05-20 06:52:06', '2026-05-20 06:52:06'),
(6, 'quincy.karathu', 'lok.muahok@example.com', '$2y$12$g8lW1Sd5hcKcsXtmVy5E9OKw0C6mmMJKdqadHr3.ve9h/IMm3Mpku', '+6015-449 5891', '2026-05-20 06:52:07', '2026-05-20 06:52:07'),
(7, 'khirulrezal.khoimeg', 'lietchee78@example.com', '$2y$12$m1nJemyCzdALNYynILyr4.yo616WgKRlTER9raY/bk.SjKN46uUNK', '+6015-264 9155', '2026-05-20 06:52:07', '2026-05-20 06:52:07'),
(8, 'rashdan97', 'saniru.shuba@example.com', '$2y$12$UH32aMjME3ANQfIX0080DuLugZb/q.FqFp9ys5JBYYSQ6pP4bWz4K', '+6015-636 9546', '2026-05-20 06:52:07', '2026-05-20 06:52:07'),
(9, 'cchiang', 'jeongyeong.lum@example.net', '$2y$12$c5Hxu3CH.YQZULOLHmPMUeKvs0YiAirt1kPR8GQPVsYr1q7ZwuiBq', '+6014-210 2478', '2026-05-20 06:52:07', '2026-05-20 06:52:07'),
(10, 'sofya.mu', 'kharngan.siu@example.net', '$2y$12$DR1/a5nU8w11Eqi33JgNuulEel6mSzb8Ap8CgDUpvuN7A/7vPFjG.', '+6014-629 0516', '2026-05-20 06:52:08', '2026-05-20 06:52:08'),
(11, 'kausthar.yaaccob', 'hafizh.edmund@example.com', '$2y$12$ruZmIP13y3HbOIpGvgTZf.Er13UuBbLfAt/VTrzWXk.8PqAIpe5Vu', '+604-239 8948', '2026-05-20 06:52:08', '2026-05-20 06:52:08'),
(12, 'anaika.neoh', 'nrayer@example.org', '$2y$12$7Pg3UwXLjJ0QEqN2YWQAquLZVA8YpfhUQKCHF25u3Kv1MEzaWer9C', '+606-943 9753', '2026-05-20 06:52:08', '2026-05-20 06:52:08'),
(13, 'xrasiah', 'michelle38@example.org', '$2y$12$JGI75Yl2UlTcDaBRqPv1BuEPr9vemrilM/Xc22HM/Pik0LvegdMQy', '+6013-118 1047', '2026-05-20 06:52:08', '2026-05-20 06:52:08'),
(14, 'naidu.thanuja', 'peter82@example.com', '$2y$12$OghYUvcXlCfAcGOrnsOQsu8YG1cW7bZ.z77vhAhCF36OvpivV1eL.', '+606-460 1953', '2026-05-20 06:52:09', '2026-05-20 06:52:09'),
(15, 'badrulhisham.gheetha', 'ibrahim73@example.com', '$2y$12$JZpfP8n9zbm.n9ENqwfMBeW6kGcqXsN0fGx3W6s9WjUKDRwX9tRyS', '+6015-935 9660', '2026-05-20 06:52:09', '2026-05-20 06:52:09'),
(16, 'fnahappan', 'jsiauw@example.com', '$2y$12$PqJN6ER2UA9QXOfG8LzxCeZf0acm4R.wlsWDV6biAcBBex0ANEvOm', '+607-987 2323', '2026-05-20 06:52:09', '2026-05-20 06:52:09'),
(17, 'yarumugam', 'sangeeta.dazila@example.org', '$2y$12$nvsIauU48B8J5eKm5plNkeutY8uGC0RvC39mU2pHeVFNUs283Rc02', '+6015-425 7330', '2026-05-20 06:52:09', '2026-05-20 06:52:09'),
(18, 'liao.thurgai', 'linda81@example.net', '$2y$12$IM29GznHHrZY8DfgTP4Eh.2m8EYZLTIwJfldDSnRGa3gcxTOuf7vK', '+603-7898 2877', '2026-05-20 06:52:10', '2026-05-20 06:52:10'),
(19, 'mahathir.shazwan', 'tay.thanuja@example.com', '$2y$12$vGmLwkOvu3QbpeqqCgEN9ONz8SHYHhlRzCrx6Fku7M784gvImfq8C', '+605-913 4651', '2026-05-20 06:52:10', '2026-05-20 06:52:10'),
(20, 'cfoong', 'aizat.sofya@example.com', '$2y$12$Qezz712PSdeBGS7z1vZ10ODnwAsLlKH1OUX2GqTug8C5ZmGZLUvry', '+6019-835 0244', '2026-05-20 06:52:10', '2026-05-20 06:52:10'),
(21, 'soh.syarafana', 'hannah48@example.org', '$2y$12$14PcMhvf7Ej5aWtGhc.Use1ljyXf7B2gomvNqMgbHGXNV44qV7q8G', '+609-828 3705', '2026-05-20 06:52:10', '2026-05-20 06:52:10'),
(22, 'fernandez.varatharaju', 'tbahari@example.com', '$2y$12$Uy0IKFRwSALC7DU9Xu6S.eNMjkpP2WxHskf2xIHd7NnK/ms0AtLIi', '+6015-249 2667', '2026-05-20 06:52:11', '2026-05-20 06:52:11'),
(23, 'likcen.yiaw', 'insyirah88@example.org', '$2y$12$fWHTvOSyY1GAIo5.9OuuWene4FvAoQ244GldrVIJmI4pyng4sDNCK', '+6015-296 6617', '2026-05-20 06:52:11', '2026-05-20 06:52:11'),
(24, 'samantha81', 'dzul.karzin@example.com', '$2y$12$v4469cuKjkWLatpT5N2F0OEtW2GQOkh.v7M99RXnGZ6gbqF0skqgi', '+6015-649 0020', '2026-05-20 06:52:11', '2026-05-20 06:52:11'),
(25, 'nursyaffira.liong', 'syafiyana.rizwan@example.net', '$2y$12$0u2AcHQpNOFiEt9JyQaXbu3sWYCLoWx6OhKxsNznOxrj87HmjUlLq', '+6012-377 5308', '2026-05-20 06:52:12', '2026-05-20 06:52:12'),
(26, 'mas04', 'gengadharan.kaliappan@example.org', '$2y$12$1caePgH2G6a8EX6M1qK5w.4acz0LcYaTzOEWMdOTVBY.U0My/C/eu', '+607-063 2332', '2026-05-20 06:52:12', '2026-05-20 06:52:12'),
(27, 'siafah58', 'misnan.andrea@example.org', '$2y$12$jywe1zaBRcA8VPGfSEB8Ne4ITE1lHvzwjhWjFWQxRUKo9iBs/Ga/m', '+605-904 5730', '2026-05-20 06:52:12', '2026-05-20 06:52:12'),
(28, 'loganathan77', 'timaw.zainuddin@example.org', '$2y$12$CTXO4X4SzikAFehKGcI9.ObhkEHIEaectQEAx/NZE3qI07UlZzDCS', '+6015-220 3060', '2026-05-20 06:52:12', '2026-05-20 06:52:12'),
(29, 'dingchor68', 'sarudin73@example.net', '$2y$12$7K.Q4MxPlIXbUnkkHm0lOuU.2TJaV8SXjsBO3cBSZA/bnhSg7tWJe', '+6015-686 6432', '2026-05-20 06:52:13', '2026-05-20 06:52:13'),
(30, 'sueib.sivakumar', 'kathleen.jaya@example.org', '$2y$12$pZ.e2Vbn677IIPytRVKAmetHUna75GsvU25wFJEWvzAS9sL47yLOG', '+6010-350 6809', '2026-05-20 06:52:13', '2026-05-20 06:52:13'),
(31, 'elena.afsyal', 'sangalimuthu.nelson@example.org', '$2y$12$zASLNz370Ssl2tvzoeUBiuCXBnGQQeDWbfeSf0eN0rh7xCIcDBxau', '+6016-164 3217', '2026-05-20 06:52:13', '2026-05-20 06:52:13'),
(32, 'gurmit.kundargal', 'leiujung.tang@example.net', '$2y$12$NNQqQ6NwvpACFvT4o9M3L.p1LkmfOA8ik/uD5m0qDS5lxlL8ZuVoq', '+6015-659 7633', '2026-05-20 06:52:13', '2026-05-20 06:52:13'),
(33, 'saipol56', 'lchia@example.net', '$2y$12$wwwEKtMa5w5/0FuNIvXsi.JW61QIsHUh4Ga89K.dxQjGPYv9PuK0u', '+6013-388 4573', '2026-05-20 06:52:14', '2026-05-20 06:52:14'),
(34, 'sinnandavar.linda', 'kumutha.vengatarakoo@example.net', '$2y$12$VFbb0lpScyYvcpBovtUNl.QiW1tcztwlTK4BmjaERXc1.HCR9bFa.', '+6088-58 2873', '2026-05-20 06:52:14', '2026-05-20 06:52:14'),
(35, 'muitia.narayan', 'deeching10@example.net', '$2y$12$p/mvf6YK0urWI2vBhM0Rk..jk/fhuJdMb9xNN9HX8s57ZtgylI9AG', '+6015-922 1930', '2026-05-20 06:52:14', '2026-05-20 06:52:14'),
(36, 'quak.simmang', 'syuqeri93@example.com', '$2y$12$EwFPn8wuhKBCIH7mFwaTL.fBv52jwnJrfX1bqXyzLRmkbnIB1v9HG', '+6012-837 9929', '2026-05-20 06:52:14', '2026-05-20 06:52:14'),
(37, 'muzamil64', 'rahman.peiklian@example.com', '$2y$12$4D9kk9eJtfsGNancjMZj5OfiY1eNFVsH47WW5STgcSVnPE72YTyn.', '+6015-352 6277', '2026-05-20 06:52:15', '2026-05-20 06:52:15'),
(38, 'selvaraju.yiaw', 'talib.nurzafira@example.com', '$2y$12$wcJyQ7QKwPcec4pmPG4Cy.zdHCkboGzJnPeKM.ZIBvfuVy2SOioOu', '+6018-907 4612', '2026-05-20 06:52:15', '2026-05-20 06:52:15'),
(39, 'shukthey.shankar', 'saraswati.leau@example.com', '$2y$12$bgGq4LqHCblYrryu.slYheRc7taUzsHJtvX1VkMzVcCAIQ0nAiaaG', '+607-536 2873', '2026-05-20 06:52:15', '2026-05-20 06:52:15'),
(40, 'sarath.hadi', 'hormiin.dahalan@example.net', '$2y$12$KpIntf5c15sP6sUNFWkMBuYbW7/ZyA9OiJas7pQCOaNvCk23cdVQ.', '+6017-793 6490', '2026-05-20 06:52:16', '2026-05-20 06:52:16'),
(41, 'yugendran.zuraidi', 'shihpooi07@example.org', '$2y$12$Cpy1BtG0hwgBuCvm1pXsVOOn13igo.TbSEIK3l0STQvRAXVejapnS', '+6015-155 4337', '2026-05-20 06:52:16', '2026-05-20 06:52:16'),
(42, 'lyndel.salehudin', 'kundargal.alyaa@example.org', '$2y$12$tPgIBdgK1I0AHp6GhGEGueQiSWd.i9pDinlqhokdbVNiCBQgEZncG', '+6010-469 5375', '2026-05-20 06:52:16', '2026-05-20 06:52:16'),
(43, 'shuhada.yow', 'uthayakumar.ang@example.net', '$2y$12$00B.MR79bUzYjtaT9B6cNuRgVNVhlDV/ZF.67aYWR3qZIEJ5YRn0G', '+6015-200 0484', '2026-05-20 06:52:16', '2026-05-20 06:52:16'),
(44, 'liemhua24', 'nbamadhaj@example.net', '$2y$12$bAqS4ObPp2H3LDZDChT1cuC3H11/Ska/ASNNYOCtNj9KpHBNfAQxm', '+6013-090 7305', '2026-05-20 06:52:17', '2026-05-20 06:52:17'),
(45, 'veerappen03', 'gong.asmin@example.com', '$2y$12$bMgG0jsJGXprUyEj5mBQkOi.VkCn3n8pzJiLbT/p6R7oO/Q3cWfFe', '+6015-561 5966', '2026-05-20 06:52:17', '2026-05-20 06:52:17'),
(46, 'betty32', 'mahathevan.alis@example.net', '$2y$12$oG7rvgXKhPWYhYyQ6GAbTOMAWISkjhCztYRxtW8flDNXTCHZsWb8e', '+6015-263 0539', '2026-05-20 06:52:17', '2026-05-20 06:52:17'),
(47, 'renuga60', 'sau.hidayatullah@example.net', '$2y$12$ksBCN07Vs3HlSrTaWKXF5uRt4SsIJ8sNAEs4Dw0TZ/I7vSTcxXj.m', '+607-852 4803', '2026-05-20 06:52:17', '2026-05-20 06:52:17'),
(48, 'zuineu50', 'tianshok.yam@example.com', '$2y$12$IhHo.P4YkT7HFI8dzZJ17e3rFV7u0VcxGPB7.ODEYTawi8R9Dwlmm', '+606-884 0313', '2026-05-20 06:52:18', '2026-05-20 06:52:18'),
(49, 'siongsiang.viswalingam', 'roszainal.tiffany@example.com', '$2y$12$hkviewUJQ10Sdrg3YpkUAe5S9G4kQ4eCdWXep7Mkt6Itaxp595UKq', '+6015-192 2316', '2026-05-20 06:52:18', '2026-05-20 06:52:18'),
(50, 'ozain', 'fsaifudin@example.org', '$2y$12$QI4UGhGY./MGQsl5Mb6qMOzEtg5dQ.0QqUf8EeaN5qzr33jSwssvi', '+606-082 4681', '2026-05-20 06:52:18', '2026-05-20 06:52:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pjoc001msettings`
--
ALTER TABLE `pjoc001msettings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `pjoc002miklanpekerjaan`
--
ALTER TABLE `pjoc002miklanpekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pjoc003mmohonkerja`
--
ALTER TABLE `pjoc003mmohonkerja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_job_student` (`id_kerja`,`matrik`);

--
-- Indexes for table `pjoc004msurattawaran`
--
ALTER TABLE `pjoc004msurattawaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjoc004msurattawaran_id_calon_foreign` (`id_calon`);

--
-- Indexes for table `pjoc005mtimesheets`
--
ALTER TABLE `pjoc005mtimesheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjoc005mtimesheets_id_calon_foreign` (`id_calon`);

--
-- Indexes for table `pjoc006mtuntutan`
--
ALTER TABLE `pjoc006mtuntutan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjoc006mtuntutan_id_calon_foreign` (`id_calon`);

--
-- Indexes for table `pjoc007mperuntukanbajetcareer`
--
ALTER TABLE `pjoc007mperuntukanbajetcareer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`);

--
-- Indexes for table `pjoc008mbatchimportpelajar`
--
ALTER TABLE `pjoc008mbatchimportpelajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjoc008mbatchimportpelajar_id_kerja_foreign` (`id_kerja`);

--
-- Indexes for table `pjoc009mstudentimport`
--
ALTER TABLE `pjoc009mstudentimport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjoc009mstudentimport_batch_id_foreign` (`batch_id`);

--
-- Indexes for table `pjoc010mnotifications`
--
ALTER TABLE `pjoc010mnotifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matrik` (`matrik`);

--
-- Indexes for table `pjoc011murusetia`
--
ALTER TABLE `pjoc011murusetia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ukmper` (`ukmper`);

--
-- Indexes for table `pjoc101kstsiklan`
--
ALTER TABLE `pjoc101kstsiklan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc102kstscalon`
--
ALTER TABLE `pjoc102kstscalon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc103kststimesheet`
--
ALTER TABLE `pjoc103kststimesheet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc104kststuntutan`
--
ALTER TABLE `pjoc104kststuntutan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc105kstsbatchimport`
--
ALTER TABLE `pjoc105kstsbatchimport`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc106kstsrowimport`
--
ALTER TABLE `pjoc106kstsrowimport`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc107kjnsperuntukan`
--
ALTER TABLE `pjoc107kjnsperuntukan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc108kmodkerja`
--
ALTER TABLE `pjoc108kmodkerja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc109krespontawaran`
--
ALTER TABLE `pjoc109krespontawaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `pjoc110ksumbercalon`
--
ALTER TABLE `pjoc110ksumbercalon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kod` (`kod`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `identity_no` (`identity_no`);

--
-- Indexes for table `users2`
--
ALTER TABLE `users2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pjoc001msettings`
--
ALTER TABLE `pjoc001msettings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pjoc002miklanpekerjaan`
--
ALTER TABLE `pjoc002miklanpekerjaan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc003mmohonkerja`
--
ALTER TABLE `pjoc003mmohonkerja`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc004msurattawaran`
--
ALTER TABLE `pjoc004msurattawaran`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc005mtimesheets`
--
ALTER TABLE `pjoc005mtimesheets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc006mtuntutan`
--
ALTER TABLE `pjoc006mtuntutan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc007mperuntukanbajetcareer`
--
ALTER TABLE `pjoc007mperuntukanbajetcareer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc008mbatchimportpelajar`
--
ALTER TABLE `pjoc008mbatchimportpelajar`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc009mstudentimport`
--
ALTER TABLE `pjoc009mstudentimport`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc010mnotifications`
--
ALTER TABLE `pjoc010mnotifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc011murusetia`
--
ALTER TABLE `pjoc011murusetia`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjoc101kstsiklan`
--
ALTER TABLE `pjoc101kstsiklan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pjoc102kstscalon`
--
ALTER TABLE `pjoc102kstscalon`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pjoc103kststimesheet`
--
ALTER TABLE `pjoc103kststimesheet`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pjoc104kststuntutan`
--
ALTER TABLE `pjoc104kststuntutan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pjoc105kstsbatchimport`
--
ALTER TABLE `pjoc105kstsbatchimport`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pjoc106kstsrowimport`
--
ALTER TABLE `pjoc106kstsrowimport`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pjoc107kjnsperuntukan`
--
ALTER TABLE `pjoc107kjnsperuntukan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pjoc108kmodkerja`
--
ALTER TABLE `pjoc108kmodkerja`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pjoc109krespontawaran`
--
ALTER TABLE `pjoc109krespontawaran`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pjoc110ksumbercalon`
--
ALTER TABLE `pjoc110ksumbercalon`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users2`
--
ALTER TABLE `users2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pjoc003mmohonkerja`
--
ALTER TABLE `pjoc003mmohonkerja`
  ADD CONSTRAINT `pjoc003mmohonkerja_id_kerja_foreign` FOREIGN KEY (`id_kerja`) REFERENCES `pjoc002miklanpekerjaan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pjoc004msurattawaran`
--
ALTER TABLE `pjoc004msurattawaran`
  ADD CONSTRAINT `pjoc004msurattawaran_id_calon_foreign` FOREIGN KEY (`id_calon`) REFERENCES `pjoc003mmohonkerja` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pjoc005mtimesheets`
--
ALTER TABLE `pjoc005mtimesheets`
  ADD CONSTRAINT `pjoc005mtimesheets_id_calon_foreign` FOREIGN KEY (`id_calon`) REFERENCES `pjoc003mmohonkerja` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pjoc006mtuntutan`
--
ALTER TABLE `pjoc006mtuntutan`
  ADD CONSTRAINT `pjoc006mtuntutan_id_calon_foreign` FOREIGN KEY (`id_calon`) REFERENCES `pjoc003mmohonkerja` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pjoc008mbatchimportpelajar`
--
ALTER TABLE `pjoc008mbatchimportpelajar`
  ADD CONSTRAINT `pjoc008mbatchimportpelajar_id_kerja_foreign` FOREIGN KEY (`id_kerja`) REFERENCES `pjoc002miklanpekerjaan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pjoc009mstudentimport`
--
ALTER TABLE `pjoc009mstudentimport`
  ADD CONSTRAINT `pjoc009mstudentimport_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `pjoc008mbatchimportpelajar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
