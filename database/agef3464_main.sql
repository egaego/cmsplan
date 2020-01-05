-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2020 at 09:30 AM
-- Server version: 10.1.43-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plax5742_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_holder` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `account_branch` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `account_name`, `account_holder`, `account_number`, `account_branch`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BCA', 'Planyourdays', '2240 0262 55', 'Sawah Besar Jakarta Pusat', 1, NULL, '2019-11-10 06:58:43'),
(2, 'Mandiri', 'Planyourdays', '2240 0262 55', 'Jakarta Barat', 1, NULL, '2019-11-10 08:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `concept`
--

CREATE TABLE `concept` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `description` text,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concept`
--

INSERT INTO `concept` (`id`, `name`, `file`, `icon`, `description`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Catering', 'catering-034603.jpg', 'restaurant', NULL, 1, 0, '2018-02-20 03:00:00', '2019-06-25 20:46:03'),
(2, 'Decoration', 'decoration-034327.jpg', 'hammer', NULL, 1, 0, '2019-06-25 20:38:34', '2019-06-25 20:43:27'),
(3, 'Photography', 'photography-035122.jpg', 'images', NULL, 1, 0, '2019-06-25 20:46:43', '2019-06-25 20:51:22'),
(4, 'Hair & MakeUp', 'hair-makeup-034759.jpg', 'bowtie', NULL, 1, 0, '2019-06-25 20:47:59', '2019-06-25 20:47:59'),
(5, 'Honymoon', 'honymoon-035314.jpg', 'wine', NULL, 1, 0, '2019-06-25 20:53:14', '2019-06-25 20:53:14'),
(6, 'Invitation', 'invitation-035523.jpg', 'mail', NULL, 1, 0, '2019-06-25 20:55:23', '2019-06-25 20:55:23'),
(7, 'Entertainment', 'entertainment-035830.jpg', 'microphone', NULL, 1, 0, '2019-06-25 20:58:30', '2019-06-25 20:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `concept_detail`
--

CREATE TABLE `concept_detail` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `concept_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='save konsep rincian ';

--
-- Dumping data for table `concept_detail`
--

INSERT INTO `concept_detail` (`id`, `user_id`, `concept_id`, `vendor_id`, `date`, `created_at`, `updated_at`) VALUES
(55, 22, 2, 8, '2019-07-05', '2019-07-05 04:34:20', '2019-07-05 04:34:20'),
(64, 38, 1, 3, '2019-07-06', '2019-07-06 05:09:43', '2019-07-06 05:09:43'),
(34, 20, 3, 22, '2019-07-04', '2019-07-03 14:36:26', '2019-07-03 14:36:26'),
(45, 20, 1, 5, '2019-07-07', '2019-07-04 15:36:33', '2019-07-04 15:36:33'),
(50, 18, 2, 8, '2019-07-04', '2019-07-04 22:13:32', '2019-07-04 22:13:32'),
(53, 24, 2, 8, '2020-07-05', '2019-07-05 02:19:44', '2019-07-05 02:19:44'),
(63, 34, 3, 23, '2019-07-08', '2019-07-06 04:29:26', '2019-07-06 04:29:26'),
(26, 18, 1, 4, '2019-06-29', '2019-06-29 10:01:43', '2019-06-29 10:01:43'),
(28, 22, 1, 4, '2019-07-02', '2019-07-02 03:02:56', '2019-07-02 03:02:56'),
(74, 16, 2, 9, '2020-09-19', '2019-10-19 21:06:24', '2019-10-19 21:06:24'),
(52, 20, 2, 8, '2019-07-08', '2019-07-05 01:43:42', '2019-07-05 01:43:42'),
(54, 26, 3, 23, '2019-07-14', '2019-07-05 02:24:33', '2019-07-05 02:24:33'),
(56, 22, 3, 22, '2019-07-07', '2019-07-05 06:38:44', '2019-07-05 06:38:44'),
(58, 30, 1, 4, '2019-07-05', '2019-07-05 07:14:37', '2019-07-05 07:14:37'),
(59, 22, 2, 9, '2019-07-08', '2019-07-06 01:47:49', '2019-07-06 01:47:49'),
(60, 30, 2, 8, '2019-07-09', '2019-07-06 03:34:21', '2019-07-06 03:34:21'),
(61, 32, 2, 8, '2019-07-08', '2019-07-06 03:50:02', '2019-07-06 03:50:02'),
(66, 44, 1, 5, '2020-07-06', '2019-07-06 07:10:02', '2019-07-06 07:10:02'),
(67, 44, 5, 16, '2020-08-06', '2019-07-06 07:10:54', '2019-07-06 07:10:54'),
(69, 18, 4, 15, '2020-09-11', '2019-09-10 03:13:22', '2019-09-10 03:13:22'),
(70, 16, 2, 7, '2019-09-14', '2019-09-14 02:08:27', '2019-09-14 02:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` smallint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `concept_id`, `name`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Arya Dekorasi', 'arya-dekorasi-160518.jpeg', 1, '2019-06-12 13:51:16', '2019-06-28 09:05:18'),
(2, 1, 'ega', 'ega-155914.jpg', 1, '2019-06-16 09:22:05', '2019-06-28 08:59:14'),
(3, 1, 'Arya Dekorasi', 'arya-dekorasi-153604.jpg', 1, '2019-06-16 09:26:51', '2019-06-28 08:36:05'),
(4, 1, 'Wedding', 'wedding-114435.jpg', 1, '2019-06-26 04:44:35', '2019-06-26 04:44:35'),
(5, 1, 'Wedding', 'wedding-114511.jpg', 1, '2019-06-26 04:45:11', '2019-06-26 04:45:11'),
(6, 1, 'Pre Widding', 'pre-widding-114656.jpg', 1, '2019-06-26 04:46:57', '2019-06-26 04:46:57'),
(7, 1, 'Garuda Dekorasi', 'garuda-dekorasi-153904.jpg', 1, '2019-06-26 04:47:21', '2019-06-28 08:39:05'),
(8, 1, 'Pre Widding', 'pre-widding-114735.jpg', 1, '2019-06-26 04:47:35', '2019-06-26 04:47:35'),
(9, 1, 'Pre Widding', 'pre-widding-114753.jpg', 1, '2019-06-26 04:47:54', '2019-06-26 04:47:54'),
(10, 1, 'Garuda Dekorasi', 'garuda-dekorasi-174154.jpg', 1, '2019-06-26 04:48:18', '2019-06-28 10:41:54'),
(11, 1, 'Photograpy', 'photograpy-171936.jpg', 1, '2019-06-26 04:49:26', '2019-06-28 10:19:36'),
(12, 1, 'catering', 'catering-170900.jpg', 1, '2019-06-26 04:49:50', '2019-06-28 10:09:00'),
(13, 1, 'catering', 'catering-115011.jpg', 1, '2019-06-26 04:50:11', '2019-06-26 04:50:11'),
(14, 1, 'catering', 'catering-115027.jpg', 1, '2019-06-26 04:50:27', '2019-06-26 04:50:27'),
(15, 1, 'Dekorasi', 'dekorasi-163235.jpg', 1, '2019-06-26 04:51:12', '2019-06-28 09:32:36'),
(16, 1, 'Dekorasi', 'dekorasi-115134.jpg', 1, '2019-06-26 04:51:34', '2019-06-26 04:51:34'),
(17, 1, 'Dekorasi', 'dekorasi-163500.jpeg', 1, '2019-06-26 04:51:52', '2019-06-28 09:35:00'),
(18, 1, 'Dekorasi', 'dekorasi-115206.jpg', 1, '2019-06-26 04:52:06', '2019-06-26 04:52:06'),
(19, 1, 'Garuda Dekorasi', 'garuda-dekorasi-153649.jpg', 1, '2019-06-26 04:52:55', '2019-06-28 08:36:49'),
(20, 2, 'Pre Widding', 'pre-widding-173942.jpg', 1, '2019-06-28 08:54:37', '2019-06-28 10:39:43'),
(21, 2, 'Photograpy', 'photograpy-160713.jpg', 1, '2019-06-28 09:07:13', '2019-06-28 09:07:13'),
(22, 2, 'Photograpy', 'photograpy-160739.jpg', 1, '2019-06-28 09:07:39', '2019-06-28 09:07:39'),
(23, 2, 'Photograpy', 'photograpy-174027.jpg', 1, '2019-06-28 09:07:56', '2019-06-28 10:40:28'),
(24, 2, 'Dekorasi', 'dekorasi-160911.jpg', 1, '2019-06-28 09:09:12', '2019-06-28 09:09:12'),
(25, 2, 'Photograpy', 'photograpy-171804.jpg', 1, '2019-06-28 09:16:50', '2019-06-28 10:18:04'),
(26, 3, 'catering', 'catering-161752.jpg', 1, '2019-06-28 09:17:52', '2019-06-28 09:17:52'),
(27, 3, 'Pre Widding', 'pre-widding-161959.jpg', 1, '2019-06-28 09:19:59', '2019-06-28 09:19:59'),
(28, 3, 'Dekorasi', 'dekorasi-162037.jpg', 1, '2019-06-28 09:20:37', '2019-06-28 09:20:37'),
(29, 3, 'Pre Widding', 'pre-widding-171044.jpg', 1, '2019-06-28 09:21:56', '2019-06-28 10:10:44'),
(30, 3, 'Wedding', 'wedding-162846.jpg', 1, '2019-06-28 09:24:55', '2019-06-28 09:28:48'),
(31, 4, 'Dekorasi', 'dekorasi-163034.jpg', 1, '2019-06-28 09:30:34', '2019-06-28 09:30:34'),
(32, 4, 'Dekorasi', 'dekorasi-163335.jpg', 1, '2019-06-28 09:33:35', '2019-06-28 09:33:35'),
(33, 4, 'catering', 'catering-165752.jpg', 1, '2019-06-28 09:41:29', '2019-06-28 09:57:52'),
(34, 4, 'Photograpy', 'photograpy-164904.jpg', 1, '2019-06-28 09:49:04', '2019-06-28 09:49:04'),
(35, 4, 'Pre Widding', 'pre-widding-164926.jpg', 1, '2019-06-28 09:49:26', '2019-06-28 09:49:26'),
(36, 4, 'Pre Widding', 'pre-widding-170407.jpg', 1, '2019-06-28 09:49:48', '2019-06-28 10:04:07'),
(37, 4, 'Pre Widding', 'pre-widding-165008.jpg', 1, '2019-06-28 09:50:08', '2019-06-28 09:50:08'),
(38, 4, 'Pre Widding', 'pre-widding-165056.jpg', 1, '2019-06-28 09:50:56', '2019-06-28 09:50:56'),
(39, 4, 'Pre Widding', 'pre-widding-165300.jpg', 1, '2019-06-28 09:53:00', '2019-06-28 09:53:00'),
(40, 4, 'Photograpy', 'photograpy-173818.jpg', 1, '2019-06-28 10:21:16', '2019-06-28 10:38:18'),
(41, 4, 'Photograpy', 'photograpy-172208.jpg', 1, '2019-06-28 10:22:08', '2019-06-28 10:22:08'),
(42, 4, 'Photograpy', 'photograpy-172443.jpg', 1, '2019-06-28 10:24:43', '2019-06-28 10:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_relation_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_all_date` smallint(6) NOT NULL DEFAULT '0',
  `message_at` timestamp NULL DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_relation_id`, `name`, `file`, `description`, `start_date`, `end_date`, `is_all_date`, `message_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Persiapan: Gwjwb', 'default.jpg', 'Tanggal 03 Jul 2018 16:02 dan bertempat di Gsisb', '2018-07-03', '2018-07-04', 0, '2018-07-03 08:00:02', 1, '2018-07-03 08:00:02', '2018-07-03 08:00:02'),
(2, 3, 'Testing', 'testing-000154.jpg', '<p>Ok</p>', '2019-06-28', '2019-06-29', 1, '2019-06-28 17:00:00', 1, '2019-06-25 17:01:54', '2019-06-27 20:55:23'),
(3, NULL, 'Test Notif', 'test-notif-214429.png', '<p>Pohon pepaya pohon manggah</p><p>jawab iya padahal mah ogah</p>', '2019-07-02', '2019-07-03', 0, '2019-07-02 17:00:00', 1, '2019-07-02 14:43:32', '2019-07-02 14:54:07'),
(4, NULL, 'Feedback Vendor', '', '<p>Terima kasih Sudah mempercayai kami untuk acara pentingmu.</p><p>ayo berikan feedback kamu kepada vendor kami untuk kelanjutan yang lebih baik</p>', '2019-12-14', '2019-12-16', 0, '2019-12-14 17:00:00', 1, '2019-12-13 19:00:50', '2019-12-13 19:00:50'),
(5, NULL, 'Test notif', 'test-notif-184550.png', '<p>halloo</p>', '2019-12-19', '2019-12-20', 0, '2019-12-19 17:00:00', 1, '2019-12-19 11:45:50', '2019-12-19 11:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `category` smallint(6) NOT NULL,
  `name` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `category`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kebijakan Privasi', '<p>PlanYourDays menawarkan aplikasi selular . Antara lain bertujuan untuk sebagai acuan/catatan bagi pasangan calon pengantin. Dalam bentuk aplikasi seluler dan bersama vendor-vendor yang terkait didalamnya disebut sebagai layanan. Kami berharap Anda memahami secara jelas bagaimana kami, berdasarkan kebijakan privasi, menggunakan informasi anda saat anda menggunakan Layanan kami, serta hak opsi yang tersedia untuk anda sesuai dengan informasi Anda.</p>\r\n<br>\r\n<h4>Sorotan Kebijakan:</h4>\r\n<p>Aspek Kebijakan Privasi ini disoroti hanya demi kenyamanan dan pelengkap bagi anda, namun tidak menggantikan, kebijakan Privasi lengkap.</p>', '2018-02-24 02:48:34', '2019-07-04 09:44:13'),
(2, 2, 'Tentang Kami', '<h3 style=\"text-align: center;\"><span style=\"color: rgb(136, 141, 168); font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.2px;=\"\" font-weight:=\"\" bolder;\"=\"\"><b>PlanYourDays</b></span></h3><div style=\"text-align: center;\"><span style=\"color: rgb(136, 141, 168); font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.2px;=\"\" font-weight:=\"\" bolder;\"=\"\"><br></span></div><p style=\"text-align: center;\"><span style=\"color: rgb(136, 141, 168); font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.2px;=\"\" font-weight:=\"\" bolder;\"=\"\">PlanYourDays</span><span style=\"color: rgb(136, 141, 168); font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.2px;\"=\"\">&nbsp;</span><span style=\"color: rgb(136, 141, 168); font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" letter-spacing:=\"\" 0.2px;\"=\"\">merupakan Marketplace yang menghubungkan para profesional vendor dengan para calon pengantin yang ingin menjadikan acara pernikahannya special dan memberikan momen yang tidak akan terlupakan.</span></p><p style=\"text-align: center;\">Dengan fitur-fitur sederhana yang mampu memberikan kemudahan bagi para calon pengantin untuk memilih vendor apa saja yang dibutuhkan untuk acara resepsi pernikahannya dan menjadwalkan persiapan apa saja yang akan dilakukan menuju acara pernikahannya yang sesuai dengan impian.</p><p style=\"text-align: center;\">Dibuat oleh anak bangsa Indonesia untuk Indonesia</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">TTD</p><div style=\"text-align: center;\"><br style=\"letter-spacing: 0.2px;\"></div>', '2018-02-24 02:48:50', '2019-06-24 07:18:46'),
(3, 3, 'Ketentuan Penggunaan', '<p>Aplikasi seluler ini bertujuan untuk anda yang membutuhkan Acuan/catatan sebelum acara Pernikahan</p>\r\n<h4>DAPAT DIAKSES OLEH PASANGAN</h4>\r\n<p>Sistem kami akan menghubungkan anda dengan pasangan anda dan dapat bersama melihat/menambah isi (catatan) kedalam aplikasi ini dalam akses dua jalur secara real time.</p>\r\n<h4>LIST VENDOR</h4>\r\n<p>Kami menambahkan list VENDOR kedalam aplikasi ini sehingga dapat memudahkan kepada calon pengantin untuk mendapat INFO lebih tentang Vendor Vendor yang dibutuhkan.</p>\r\n<h4>KALKULASI BIAYA</h4>\r\n<p>Kami juga memberikan fitur kalkulasi anggaran BIAYA yang dapat menghitung TOTAL keseluruhan dari biaya. Biaya yang telah dimasukan calon pengantin menjadi JUMLAH TOTAL biaya keseluruhan acara.</p>', '2018-03-08 04:54:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `name`, `status`) VALUES
(1, 'Bank Transfer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report_problem`
--

CREATE TABLE `report_problem` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `category` smallint(6) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_problem`
--

INSERT INTO `report_problem` (`id`, `user_id`, `category`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Test', 1, '2019-12-05 16:52:37', '2019-12-05 16:52:37'),
(2, 16, 2, 'Test', 1, '2019-12-19 11:41:49', '2019-12-19 11:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(30) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT NULL,
  `payment_paid_at` timestamp NULL DEFAULT NULL,
  `total` decimal(14,2) NOT NULL,
  `admin_fee` decimal(14,2) NOT NULL,
  `grand_total` decimal(14,2) NOT NULL,
  `status` int(11) NOT NULL,
  `status_payment` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `code`, `bank_id`, `payment_type_id`, `payment_paid_at`, `total`, `admin_fee`, `grand_total`, `status`, `status_payment`, `created_at`, `updated_at`) VALUES
(1, 2, '1001', 1, 1, '2019-11-04 17:25:10', 300000.00, 0.00, 300000.00, 10, 1, '2019-11-04 17:25:10', NULL),
(2, 2, '720313', 2, 1, NULL, 300000.00, 0.00, 300000.00, 5, 0, '2019-11-08 18:18:20', '2019-11-08 19:09:00'),
(3, 46, '756176', 1, 1, NULL, 100000.00, 0.00, 100000.00, 5, 0, '2019-11-09 06:30:28', '2019-11-09 08:26:58'),
(4, 46, '253979', NULL, 1, '2019-11-10 09:22:23', 200000.00, 0.00, 200000.00, 10, 1, '2019-11-09 17:29:16', '2019-11-10 09:22:23'),
(5, 2, '654923', 1, 1, '2019-12-14 08:36:25', 100000.00, 0.00, 100000.00, 10, 1, '2019-11-14 15:46:38', '2019-12-14 08:36:25'),
(6, 2, '844521', 1, 1, '2019-12-30 07:45:37', 100000.00, 0.00, 100000.00, 10, 1, '2019-11-14 15:53:33', '2019-12-30 07:45:37'),
(7, 46, '759602', 1, 1, NULL, 100000.00, 0.00, 100000.00, 5, 0, '2019-11-14 16:24:16', '2019-11-14 16:24:41'),
(8, 50, '671845', 1, 1, '2019-12-02 18:34:28', 100000.00, 0.00, 100000.00, 10, 1, '2019-11-27 18:25:50', '2019-12-02 18:34:28'),
(9, 46, '431520', NULL, 1, NULL, 100000.00, 0.00, 100000.00, 0, 0, '2019-12-02 10:53:58', '2019-12-02 18:35:13'),
(10, 16, '134346', 1, 1, '2019-12-03 18:52:04', 100000.00, 0.00, 100000.00, 10, 1, '2019-12-03 07:06:56', '2019-12-03 18:52:04'),
(11, 50, '488504', NULL, 1, NULL, 100000.00, 0.00, 100000.00, 1, 0, '2019-12-04 07:54:55', '2019-12-04 07:54:55'),
(12, 2, '977127', 1, 1, '2020-01-02 08:31:43', 100000.00, 666.00, 100666.00, 10, 1, '2019-12-04 08:02:51', '2020-01-02 08:31:43'),
(14, 46, '812938', 2, 1, '2019-12-10 14:28:34', 100000.00, 972.00, 100972.00, 10, 1, '2019-12-10 14:18:41', '2019-12-10 14:28:34'),
(15, 16, '321356', 2, 1, '2019-12-13 19:05:34', 100000.00, 449.00, 100449.00, 10, 1, '2019-12-13 18:55:07', '2019-12-13 19:05:34'),
(17, 46, '901805', 1, 1, '2020-01-02 09:06:00', 3400000.00, 739.00, 3400739.00, 8, 1, '2020-01-02 09:03:06', '2020-01-02 09:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `concept_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `vendor_package_id` int(11) NOT NULL,
  `vendor_voucher_id` int(11) DEFAULT NULL,
  `total` decimal(14,2) NOT NULL,
  `voucher_discount` decimal(14,2) NOT NULL,
  `grand_total` decimal(14,2) NOT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_id`, `user_id`, `concept_id`, `vendor_id`, `vendor_package_id`, `vendor_voucher_id`, `total`, `voucher_discount`, `grand_total`, `note`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 1, 3, 1, NULL, 300000.00, 0.00, 300000.00, NULL, NULL, NULL),
(7, 2, 2, 1, 3, 1, 1, 200000.00, 100000.00, 300000.00, NULL, '2019-11-08 18:26:20', '2019-11-08 18:26:20'),
(10, 3, 46, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-11-09 06:40:48', '2019-11-09 06:40:48'),
(11, 4, 46, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-11-09 17:29:16', '2019-11-09 17:29:16'),
(12, 4, 46, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-11-10 04:12:21', '2019-11-10 04:12:21'),
(13, 5, 2, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-11-14 15:46:38', '2019-11-14 15:46:38'),
(14, 6, 2, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-11-14 15:53:33', '2019-11-14 15:53:33'),
(15, 7, 46, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-11-14 16:24:16', '2019-11-14 16:24:16'),
(16, 8, 50, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-11-27 18:25:50', '2019-11-27 18:25:50'),
(17, 9, 46, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-12-02 10:53:58', '2019-12-02 10:53:58'),
(18, 10, 16, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-12-03 07:06:56', '2019-12-03 07:06:56'),
(19, 11, 50, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-12-04 07:54:55', '2019-12-04 07:54:55'),
(22, 12, 2, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-12-04 08:13:14', '2019-12-04 08:13:14'),
(25, 14, 46, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-12-10 14:18:41', '2019-12-10 14:18:41'),
(26, 15, 16, 1, 3, 1, 1, 200000.00, 100000.00, 100000.00, NULL, '2019-12-13 18:55:07', '2019-12-13 18:55:07'),
(28, 17, 46, 1, 3, 3, 1, 3500000.00, 100000.00, 3400000.00, NULL, '2020-01-02 09:03:06', '2020-01-02 09:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_payment`
--

CREATE TABLE `transaction_payment` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `user_bank_account_name` varchar(100) NOT NULL,
  `user_account_holder` varchar(100) NOT NULL,
  `user_account_number` varchar(100) NOT NULL,
  `total` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_payment`
--

INSERT INTO `transaction_payment` (`id`, `transaction_id`, `user_id`, `bank_id`, `file`, `user_bank_account_name`, `user_account_holder`, `user_account_number`, `total`, `created_at`, `updated_at`) VALUES
(1, 10, 16, 1, '153325.jpg', 'BCA', 'Ega', '156238653268', 100000.00, '2019-12-03 08:33:26', '2019-12-03 08:33:26'),
(2, 12, 2, 1, '002322.jpeg', 'BCA', 'asd', '123123123', 100000.00, '2019-12-05 17:23:22', '2019-12-05 17:23:22'),
(3, 6, 2, 1, '002455.jpeg', 'vas', 'sad12312', '123123123', 100000.00, '2019-12-05 17:24:55', '2019-12-05 17:24:55'),
(4, 5, 2, 1, '002659.jpeg', 'BCA', '123asdas', '123123123', 100000.00, '2019-12-05 17:26:59', '2019-12-05 17:26:59'),
(5, 14, 46, 2, '212557.jpeg', 'BRI', 'Ega Ego', '099978978787', 100972.00, '2019-12-10 14:25:59', '2019-12-10 14:25:59'),
(6, 15, 16, 1, '020249.jpg', 'BCA', 'Ega', '65565653', 100449.00, '2019-12-13 19:02:49', '2019-12-13 19:02:49'),
(7, 15, 16, 1, '020330.jpg', 'BCA', 'Ega', '435683834', 100449.00, '2019-12-13 19:03:30', '2019-12-13 19:03:30'),
(8, 17, 46, 1, '160442.jpg', 'BCA', 'Fjdj', '8653254', 3400739.00, '2020-01-02 09:04:42', '2020-01-02 09:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` smallint(6) DEFAULT NULL,
  `gender_label` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_device_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_token` text COLLATE utf8mb4_unicode_ci,
  `registered_at` timestamp NULL DEFAULT NULL,
  `forgot_token` text COLLATE utf8mb4_unicode_ci,
  `token` text COLLATE utf8mb4_unicode_ci,
  `status` smallint(6) DEFAULT NULL,
  `role` smallint(6) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `gender_label`, `email`, `phone`, `photo`, `password`, `remember_token`, `user_id_token`, `firebase_token`, `device_number`, `registered_device_number`, `registered_token`, `registered_at`, `forgot_token`, `token`, `status`, `role`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', NULL, NULL, 'admin@planyourdays.id', NULL, NULL, '$2y$10$JxpunDrKXU8bzcuoggx4GeFqZIRABR/jyhG4IrhD8wp2ZcJFkBAZ2', 'US81AFqPB87ICpBo9oWRyJ7FdVxDB5rH0kKxY2X98riuS6yoSZQhyWjVd7rW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2018-05-17 20:31:33', '2018-05-17 20:31:33', NULL),
(2, 'Hendri Gunawan', 1, NULL, 'hendri.gnw@gmail.com', '08561471500', 'photo-223001.jpg', '$2y$10$R5.zZZyDgN8L2ePPFMyW5..cJ4OB1EftG4lsMhTWE2ahA8b.kMrge', NULL, 'f91045d9-dc1c-49e2-83fd-8712e81a0d7f', 'd7o1bkQrBNc:APA91bGXaiYTDKaZICtzYAlJZLtMe_mmCdeqxJoBc8XERNLHtCtQoxU0VL1g8xlq8-RwOi7ozMHF0YEdtrD640UjGiVFbb-mUaH7Loc67O2i7sLNCu_euDHJ796mylXjniOHeXXyQ1nz', 'xxx', '3db1b9c6f66c72a7', NULL, '2018-05-31 01:25:13', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9wbGFueW91cmRheXMuaWQvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE1NzYyNjIyNzYsImV4cCI6MTU3NzQ3MTg3NiwibmJmIjoxNTc2MjYyMjc2LCJqdGkiOiI0RW45UGhhZ0RKQnBKclVMIn0.4Iof1bo22lZcFBkB9JlUe8dKPYoW9lRpsb0hx7Eln0E', 1, 10, '2019-12-13 18:37:56', '2018-05-31 01:25:13', '2019-12-13 18:37:56', NULL),
(3, 'Wina Marlina g', 0, NULL, 'winamarlina97@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bVsC9mrbh4qdun9tsJqsgxSLq', NULL, NULL, NULL, 5, 10, NULL, '2018-05-31 01:25:13', '2019-06-24 15:35:43', NULL),
(4, 'Muhamaf Ega', 1, NULL, 'ega281291@gamil.com', '085771012095', NULL, '$2y$10$99IXZLnYoIv3z/EENGysteBiLzw8Je.UMmx9v1HVBLegJBmbB2irK', NULL, NULL, 'APA91bHde9bnY2c7g4e0qRb0-0Eg1W5dbIW4KWzIecjjEgFaH8KcyetOpWlJoiR9BJY9E7xGKKYqtDScDW8f8BAe8f9sOKn_U7hl0xuAt77y2P_D_hNsQHVZdhGfBafs4c4kk92bb8H5', '23483bd3789914a4', '23483bd3789914a4', NULL, '2018-05-31 02:02:46', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6Ly9hZ2VuZGFuaWthaC5jb20vYXBpL3YxL2F1dGgvcmVnaXN0ZXIiLCJpYXQiOjE1Mjc3NTczNjgsImV4cCI6MTUyODk2Njk2OCwibmJmIjoxNTI3NzU3MzY4LCJqdGkiOiJlZENpUFhqbExCZzl3a3dZIn0.2PweKfMDXLpqcxWs2flPqEeGgXI4UxWayPQya3JXT5I', 1, 10, '2018-05-31 02:02:48', '2018-05-31 02:02:46', '2018-05-31 02:02:48', NULL),
(5, 'Endah', 0, NULL, 'jaduldong@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JX9TlqKJpHtAQW0G5uL8jA8kp', NULL, NULL, NULL, 5, 10, NULL, '2018-05-31 02:02:48', '2018-05-31 02:02:48', NULL),
(6, 'Annisa Fidianti', 0, NULL, 'annisa.fidianti@gmail.com', '087888492752', NULL, '$2y$10$ejEK0Edye1OfNXfZtP4dsOOEo1Qh.AXun6ILGhFlX4Hx9W7Tcq75C', NULL, '34d27d53-580b-4025-b0c4-40482347f3b9', '105d41cf80e049d52cc6c77d430d959d200515e949c06ad55acc9e8ff4724d39', '3D56A62B-23F8-4C87-B3F9-5B38064E1F7F', '3D56A62B-23F8-4C87-B3F9-5B38064E1F7F', NULL, '2018-06-04 02:04:37', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjYsImlzcyI6Imh0dHA6Ly9hZ2VuZGFuaWthaC5jb20vYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE1MzEwNDgxODcsImV4cCI6MTUzMjI1Nzc4NywibmJmIjoxNTMxMDQ4MTg3LCJqdGkiOiI3WTVjczFiV0F3cXBkQlk1In0.4SnSxgSTW4WHu-yeNVn0nRqZL3zAhloS8y4JX94hFUc', 1, 10, '2018-07-08 11:09:47', '2018-06-04 02:04:37', '2018-07-08 11:09:47', NULL),
(7, 'Fadel Assegaf', 1, NULL, 'fadilfdl@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'onvEaghKdDyi69mYlxX5zYLeR', NULL, NULL, NULL, 5, 10, NULL, '2018-06-04 02:04:37', '2018-06-04 02:04:37', NULL),
(8, 'Gaga', 1, NULL, 'gaga@gmail.com', NULL, NULL, '$2y$10$AlqIoAEfY0/vREdJby4EquGLnZJBKDl5zHzpd18u9rMEKJZ03vS7q', NULL, 'cfd411c9-de96-450f-b8c6-58f37eab7361', NULL, 'EBD9EFA3-E2B9-4A18-8DBE-ACB244FED555', 'EBD9EFA3-E2B9-4A18-8DBE-ACB244FED555', NULL, '2019-06-14 06:23:52', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjgsImlzcyI6Imh0dHA6Ly8xOTIuMTY4LjQzLjE5OTo0MDQwL3BsYW4teW91ci1kYXlzL3B1YmxpYy9hcGkvdjEvYXV0aC9yZWdpc3RlciIsImlhdCI6MTU2MDQ5MzQzMiwiZXhwIjoxNTYxNzAzMDMyLCJuYmYiOjE1NjA0OTM0MzIsImp0aSI6InFlYjJ4bXY2WUVoRGJsSHUifQ.gFWuIPKSx4iVZn-v8w287NZtm51XyIzrOndZPO2rD8o', 1, 10, '2019-06-14 06:23:52', '2019-06-14 06:23:52', '2019-06-14 06:23:52', NULL),
(9, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fojMFaEw289rmGkWMoxfsrh7W', NULL, NULL, NULL, 5, 10, NULL, '2019-06-14 06:23:52', '2019-06-14 06:23:52', NULL),
(10, 'Hendri', 1, NULL, 'hendri.gnw1@gmail.com', NULL, NULL, '$2y$10$RgWajxVqIewvSDDkeKbwGOAkt1gOwPcD5utl09KSqTugPS0DfV5CS', NULL, NULL, NULL, NULL, '123', NULL, '2019-06-14 06:25:20', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjQwNDAvcGxhbi15b3VyLWRheXMvcHVibGljL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYwNDkzNTIwLCJleHAiOjE1NjE3MDMxMjAsIm5iZiI6MTU2MDQ5MzUyMCwianRpIjoiQTdLRTc5UHNCampxNExOTCJ9.h5vqVXtnhBQvT87dlRwn36DnD4t9RiopZe_zeAA187s', 1, 10, '2019-06-14 06:25:20', '2019-06-14 06:25:20', '2019-06-14 06:25:20', NULL),
(11, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6rVLOGMQ4TkizAs3Ji4tHMWBS', NULL, NULL, NULL, 5, 10, NULL, '2019-06-14 06:25:20', '2019-06-14 06:25:20', NULL),
(12, 'Hendri', 1, NULL, 'hendri.gnw2@gmail.com', NULL, NULL, '$2y$10$0xEfocbQCjP0sfXvHPyETeVQlbS8PEpdijIIFbUd0R3WOdC72tucS', NULL, NULL, NULL, NULL, '123', NULL, '2019-06-14 06:26:15', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjQwNDAvcGxhbi15b3VyLWRheXMvcHVibGljL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYwNDkzNTc1LCJleHAiOjE1NjE3MDMxNzUsIm5iZiI6MTU2MDQ5MzU3NSwianRpIjoibXRLSUM4OUh2aWFUQVFhWCJ9.Z5I9ZzT2BylQQ8PnALLLbcp78sjzeURSA4BV7mfX-Bc', 1, 10, '2019-06-14 06:26:15', '2019-06-14 06:26:15', '2019-06-14 06:26:15', NULL),
(13, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uiZvQEDT2SCTMNAZfrbsN7gbc', NULL, NULL, NULL, 5, 10, NULL, '2019-06-14 06:26:15', '2019-06-14 06:26:15', NULL),
(14, 'Gaga 123', 1, NULL, 'gaga123@gmail.com', NULL, NULL, '$2y$10$Ruvj0DR.sSJNykndYBEQFuxIldl7ew0Z2LulTCVuO9tZ.L4yd9t7.', NULL, 'cfd411c9-de96-450f-b8c6-58f37eab7361', NULL, 'xxx', 'EBD9EFA3-E2B9-4A18-8DBE-ACB244FED555', NULL, '2019-06-14 06:26:52', 'MtuTGNUEoq9bdXMEgNAlTP3xW', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE0LCJpc3MiOiJodHRwOi8vMTkyLjE2OC40My4xOTk6NDA0MC9wbGFuLXlvdXItZGF5cy9wdWJsaWMvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE1NjA0OTM2NzAsImV4cCI6MTU2MTcwMzI3MCwibmJmIjoxNTYwNDkzNjcwLCJqdGkiOiJBb294WXJ5UnhRdVBISTMxIn0.3U4rAE_cNNt1uXb7fNvbseLACOxdJkrWWiOByC72GXE', 1, 10, '2019-06-14 06:27:50', '2019-06-14 06:26:52', '2019-06-14 06:51:13', NULL),
(15, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'qhimDMfFe9ZoieJQrlespoGry', NULL, NULL, NULL, 5, 10, NULL, '2019-06-14 06:26:52', '2019-06-14 06:26:52', NULL),
(16, 'Muhamad Ega', 1, '1', 'ega281291@gmail.com', '087882408009', 'photo-101003.jpg', '$2y$10$NphDoLas6ZtNbk2wldWdAeG7NO9beG2i8YGO.CeVIfZ6GGiOFcawO', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, 'xxx', '923fbc4e9dbb5ce5', NULL, '2019-06-16 09:09:23', '6jA9kjuQ1oRsWS8n02e2BeZfo', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE2LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTc3NDcwMjUwLCJleHAiOjE1Nzg2Nzk4NTAsIm5iZiI6MTU3NzQ3MDI1MCwianRpIjoiQm12TEhGZFJSMDZkSHl2aCJ9.-a8DIemYAGwnjx9MBSUnYD-ZB1c0W2KR329JFBKhlEs', 1, 10, '2019-12-27 18:10:50', '2019-06-16 09:09:23', '2019-12-27 18:10:50', NULL),
(17, 'Endah Zhuraedah', 0, NULL, 'zhurazhura1822@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yJ4zVsMyIT5cNFrX1Nk2uyDcK', NULL, NULL, NULL, 5, 10, NULL, '2019-06-16 09:09:23', '2019-06-24 16:28:46', NULL),
(18, 'Tio Mafaza', 1, '1', 'tiomafaza16@gmail.com', NULL, NULL, '$2y$10$lwOqUpWoyf7InpJM2CGbRunVkLJs1f8/fDvaoTAJhfzH3WkAOHHqO', NULL, '7250145a-414c-4c51-81ff-1bad64c595c7', 'fwRl_xTGwes:APA91bF6sAUY2e5RDmK0_OONMVstdk2ixcKXQpfesxUOpgHjN2GcPL-oFUSKkxpetleJaHT0TdeZ73Y0PE2o36gul_ll3ZmII2pXDALGEFqHrCKGegJoF-9aEKSKlfEc3E39ZBMKpg5A', 'xxx', '69826c0e2ddb866b', NULL, '2019-06-25 08:12:36', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE4LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTc2NzM5MzE2LCJleHAiOjE1Nzc5NDg5MTYsIm5iZiI6MTU3NjczOTMxNiwianRpIjoiZ1NET014Ukp3VEFBSXViayJ9.V6zpNeVuogAkK3vpcOiOO5XoOGfQKz5VYY4E-AddxnQ', 1, 10, '2019-12-19 07:08:36', '2019-06-25 08:12:36', '2019-12-19 07:08:36', NULL),
(19, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zwGdCyA1RJLdVN15VeXOVPeFM', NULL, NULL, NULL, 5, 10, NULL, '2019-06-25 08:12:36', '2019-06-25 08:12:36', NULL),
(20, 'Dendi', 1, NULL, 'jadidendi@gmail.com', NULL, 'photo-084125.jpg', '$2y$10$A8mgXjPijZyh2eeCWGnZJedGsllZKsFJUXDMxnZz1RG9rjp4oD39a', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, 'xxx', '923fbc4e9dbb5ce5', NULL, '2019-06-25 21:12:40', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIwLCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTYyMjk4NjU2LCJleHAiOjE1NjM1MDgyNTYsIm5iZiI6MTU2MjI5ODY1NiwianRpIjoidFluN1FpcnZycEdLbmtqbCJ9.qcAn8ly2y0ubvENL09poLMg2PFattlsZzKM21nj62_w', 1, 10, '2019-07-05 03:50:56', '2019-06-25 21:12:40', '2019-07-05 03:50:56', NULL),
(21, 'Anisa jkt48', 0, NULL, 'anis@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6ht7soHS8O6ZhZ0T2BPyf6m5m', NULL, NULL, NULL, 5, 10, NULL, '2019-06-25 21:12:40', '2019-06-25 21:14:52', NULL),
(22, 'Muhammad Rizky Novaldi', 1, '1', 'alditechz@gmail.com', NULL, NULL, '$2y$10$SVpPvO8vD9xFfH6MJ/oVPeD0J9oyQwWnkNSygGtnqsQBdaMgYMG56', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, 'xxx', 'b469212529f28082', NULL, '2019-07-01 01:58:31', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIyLCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTYyMzAxMTM2LCJleHAiOjE1NjM1MTA3MzYsIm5iZiI6MTU2MjMwMTEzNiwianRpIjoiUlZmNDFmUnJ3MERtQktIUCJ9.uqRJGWUIibWTr9BuNhwI0eUQG14rKh9y30gqYITl-kg', 1, 10, '2019-07-05 04:32:16', '2019-07-01 01:58:31', '2019-07-05 04:32:16', NULL),
(23, 'Ler', 0, NULL, 'alditechzz@gmail.com', '080989999', NULL, '$2y$10$HYOKMWJEV.HTE8SPY26OouZuGm3IYtJDZjg.FQuoyb1oTfARwItFW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, NULL, '2019-07-01 01:58:31', '2019-07-06 03:40:09', NULL),
(24, 'Pebri Oktaviani', 1, '0', 'febyokta27@gmail.com', '08114011997', NULL, '$2y$10$bv9SewZibpO/o/h7v3PUCOk86P0LtPd4y5opQKU2arguctNvVeWrG', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-05 02:16:18', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjI0LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMjkyOTc4LCJleHAiOjE1NjM1MDI1NzgsIm5iZiI6MTU2MjI5Mjk3OCwianRpIjoiWDdwbEJmREFMUnNGVzNDTSJ9.LKxp555lyFcujSp6oNKIgzA9UGQ5w6IfYRR7W5WpCDg', 1, 10, '2019-07-05 02:16:18', '2019-07-05 02:16:18', '2019-07-05 02:18:44', NULL),
(25, 'Muhammad Ardhi Prakasa', 0, NULL, 'ardprakasa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'EhU3dxD2VIxOjJsDW1LwBYNG5', NULL, NULL, NULL, 5, 10, NULL, '2019-07-05 02:16:18', '2019-07-05 02:17:45', NULL),
(26, 'Muthia ismah', 1, '0', 'muthiaismah12@gmail.com', '085694564222', NULL, '$2y$10$nHOnE3qwpoKpBBMRbXudEeUNai4vmi2DWHZP5KAwiVAXEmPEcqeue', NULL, 'e91cdbf8-1e4d-4ab8-ab74-e236d426a2d8', 'fnCbrXmfU9E:APA91bFb1w__wtAQKNYoH6VBd1CHbxqvtfPY7g1IlwtsEIwkT7MP1mCevtI6Hh8do0DvjykCCJUepy994R2z-pkJhpJsRDhSuh6-fkYmMAKzHI31TFBJfI-XHE6HRZv2EG-GQVG6K7gj', '923fbc4e9dbb5ce5', '923fbc4e9dbb5ce5', NULL, '2019-07-05 02:21:30', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjI2LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMjkzMjkwLCJleHAiOjE1NjM1MDI4OTAsIm5iZiI6MTU2MjI5MzI5MCwianRpIjoiSEFOR2x6Q0ZkUW1YenRpaCJ9.7Z__eBgu1Bfjkk98MQ6fiu-pEZjz9btZofkPO3QwzJo', 1, 10, '2019-07-05 02:21:30', '2019-07-05 02:21:30', '2019-07-05 02:23:30', NULL),
(27, 'Kenny', 0, NULL, 'kennygeraldi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ZuDoAy5VE29DO1CS3CmjPLEcF', NULL, NULL, NULL, 5, 10, NULL, '2019-07-05 02:21:30', '2019-07-05 02:22:09', NULL),
(28, 'Callisto apriarsa', 1, '1', 'callistoapriarsa@gmail.com', '08128568570', NULL, '$2y$10$uF2tQrGwyCaP7PyYYRZDhuxOrRSg8EilV/3LqcMGvisyXXPL6leSW', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-05 02:21:55', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjI4LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMjkzMzE1LCJleHAiOjE1NjM1MDI5MTUsIm5iZiI6MTU2MjI5MzMxNSwianRpIjoiOVdvd1JidUhGVmlqQlgxdSJ9.iO6HlVl-hwZ2rZBJzb6xdIPTJ7aZOCZKYwSN1n39bq8', 1, 10, '2019-07-05 02:21:55', '2019-07-05 02:21:55', '2019-07-05 02:23:37', NULL),
(29, 'Raisa', 0, NULL, 'totoarsa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a3jdzut5wVm12aCWTNa5KnrYP', NULL, NULL, NULL, 5, 10, NULL, '2019-07-05 02:21:55', '2019-07-05 02:22:46', NULL),
(30, 'Subhan', 1, NULL, 'akhmadsubhan48@gmail.com', NULL, NULL, '$2y$10$AMdL1q/I9oAUT4BA4bhqiO/9Uc0FMatPtR4fZwfIX4AtSm8WWzpZG', NULL, 'e91cdbf8-1e4d-4ab8-ab74-e236d426a2d8', 'fnCbrXmfU9E:APA91bFb1w__wtAQKNYoH6VBd1CHbxqvtfPY7g1IlwtsEIwkT7MP1mCevtI6Hh8do0DvjykCCJUepy994R2z-pkJhpJsRDhSuh6-fkYmMAKzHI31TFBJfI-XHE6HRZv2EG-GQVG6K7gj', '923fbc4e9dbb5ce5', '923fbc4e9dbb5ce5', NULL, '2019-07-05 07:12:20', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMwLCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMzEwNzQwLCJleHAiOjE1NjM1MjAzNDAsIm5iZiI6MTU2MjMxMDc0MCwianRpIjoiVHh0VmYxM1VnZVVhZjZtNyJ9.V8DRmuoC5D4RV_IlUQJyXepp3TyZmegV8Qp7zB_YNEI', 1, 10, '2019-07-05 07:12:20', '2019-07-05 07:12:20', '2019-07-05 07:12:20', NULL),
(31, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mdCARcMraRYI7lEx7PzVmQPVQ', NULL, NULL, NULL, 5, 10, NULL, '2019-07-05 07:12:20', '2019-07-05 07:12:20', NULL),
(32, 'Laura flara', 1, '0', 'lauraflra18@gmail.com', '083818037282', NULL, '$2y$10$K.GyOXgNqqKtazkxf6M91eS5wZRx2CgMTIqQYayNOs7OrsO8lj6y2', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-06 03:47:20', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMyLCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMzg0ODQwLCJleHAiOjE1NjM1OTQ0NDAsIm5iZiI6MTU2MjM4NDg0MCwianRpIjoiUm56UGdzeVBZWlJKbEF6TiJ9.k8F7cpvp3CcpmB0JWG9MAQsf2gavdO6XSPRDkPDvz5Q', 1, 10, '2019-07-06 03:47:20', '2019-07-06 03:47:20', '2019-07-06 03:48:45', NULL),
(33, 'Laras', 0, NULL, 'laraswulandari27@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'q7yz8xJKxMrlKmlwTB2vGqod4', NULL, NULL, NULL, 5, 10, NULL, '2019-07-06 03:47:20', '2019-07-06 03:49:15', NULL),
(34, 'Erin', 1, NULL, 'erin@gmail.com', NULL, NULL, '$2y$10$I4Q/yXOBTgogg6M8SiDywuijyxk5.OXQef/7y1BNOJAj7dg7itkNm', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-06 04:28:41', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjM0LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMzg3MzIxLCJleHAiOjE1NjM1OTY5MjEsIm5iZiI6MTU2MjM4NzMyMSwianRpIjoiU1V5cmFCeVdxQWZ5dks3WSJ9.2tRdK88-Dm_B-8JoxSUgCYq9Vx_FbRA87HWT7Gv62RM', 1, 10, '2019-07-06 04:28:41', '2019-07-06 04:28:41', '2019-07-06 04:28:41', NULL),
(35, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LgAJT7Wlafr4mJNYecYLxqvEO', NULL, NULL, NULL, 5, 10, NULL, '2019-07-06 04:28:41', '2019-07-06 04:28:41', NULL),
(36, 'Ika Siti Rohani', 1, '0', 'ikasitirohani8@gmail.com', NULL, NULL, '$2y$10$0AUjioTwHmKQwOFl4oCqL.PT0L69czQJ5E0.whh1UQbknFLa5lFRO', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-06 05:01:41', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjM2LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMzg5MzAxLCJleHAiOjE1NjM1OTg5MDEsIm5iZiI6MTU2MjM4OTMwMSwianRpIjoiYVBGZGxvVE5OSTg3dVZtayJ9.x4nCFSfWVxrOAxEXeB4XJywUJj1-Yq2-JxNfxHrbjHA', 1, 10, '2019-07-06 05:01:41', '2019-07-06 05:01:41', '2019-07-06 05:05:10', NULL),
(37, 'Masih dicari', 0, NULL, 'fitri.mariyam29@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ddIpUA6bEFMjx7gV9JKGka6ZZ', NULL, NULL, NULL, 5, 10, NULL, '2019-07-06 05:01:41', '2019-07-06 05:03:08', NULL),
(38, 'Ika', 1, NULL, 'ikanur97@gmail.com', NULL, NULL, '$2y$10$tEqX4SB00LOUHSsTU9mZ3O23ePoOGxBn4Z7vcL4kqtQZ8eJ8YW0Eq', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-06 05:08:47', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjM4LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMzg5NzI3LCJleHAiOjE1NjM1OTkzMjcsIm5iZiI6MTU2MjM4OTcyNywianRpIjoiOEFHZHE4WmJ1RTZBSE9SbyJ9.RBJ6Z9RQj43_2kooFhkm65RkrUyerBm9ENiJSzhBD20', 1, 10, '2019-07-06 05:08:47', '2019-07-06 05:08:47', '2019-07-06 05:08:47', NULL),
(39, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XZxPZakypwCjQQoIcmJzZwddT', NULL, NULL, NULL, 5, 10, NULL, '2019-07-06 05:08:47', '2019-07-06 05:08:47', NULL),
(40, 'Fachri', 1, '1', 'taufanfachri66@gmail.com', NULL, NULL, '$2y$10$RpcmnZ2zuuZks8t15iNQVOhlMLsmoSlR2YxSBab23rLX0/hOwd8hy', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-06 05:27:43', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQwLCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMzkwODYzLCJleHAiOjE1NjM2MDA0NjMsIm5iZiI6MTU2MjM5MDg2MywianRpIjoiMDBxVWxvZ2tlNGxyOFB4ayJ9.C05kxx1kg2wDtVtXKRjylLW9SBK4VRynqMsup0EXNkY', 1, 10, '2019-07-06 05:27:43', '2019-07-06 05:27:43', '2019-07-06 05:28:25', NULL),
(41, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uGGAS8D1VqqcvXTXGIzK8VEUp', NULL, NULL, NULL, 5, 10, NULL, '2019-07-06 05:27:43', '2019-07-06 05:27:43', NULL),
(42, 'Ahmad', 1, NULL, 'ahmadkurniawan97@gmail.com', NULL, NULL, '$2y$10$2jQOaEqJA/5uIWWeVYcumePxT045UBBy5sHhefnB.aq5NaL4Bkhuu', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-06 06:23:11', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQyLCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMzk0MTkxLCJleHAiOjE1NjM2MDM3OTEsIm5iZiI6MTU2MjM5NDE5MSwianRpIjoiYkFGb05BV1EzRDNlQ0xXeSJ9.nDbBAQp4BbMlIQkoCfmFzy-nO3K9lzNkwkd71drOoGU', 1, 10, '2019-07-06 06:23:11', '2019-07-06 06:23:11', '2019-07-06 06:23:11', NULL),
(43, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MiePk4cZhuJxEo4QUx1dHsgmy', NULL, NULL, NULL, 5, 10, NULL, '2019-07-06 06:23:11', '2019-07-06 06:23:11', NULL),
(44, 'Ilham', 1, '1', 'ilhamwarning10@gmail.com', NULL, NULL, '$2y$10$y3zSP5JvXJD79xsn2GZ3FeRwodhD77jM6GA/e0szyaqQvSWflui/i', NULL, '6ac27334-4efa-41da-b38d-7d69f85d5cf5', NULL, '999F9E32-EF44-49FF-910F-64F11902350F', '999F9E32-EF44-49FF-910F-64F11902350F', NULL, '2019-07-06 07:07:39', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQ0LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTYyMzk2ODU5LCJleHAiOjE1NjM2MDY0NTksIm5iZiI6MTU2MjM5Njg1OSwianRpIjoiVFFtYmZqZ2oySE5VMEFFUiJ9.7RUyGwoJQHLLki22xrWDAqYcaULEPJYPbVwpYF7fB-E', 1, 10, '2019-07-06 07:07:39', '2019-07-06 07:07:39', '2019-07-06 07:08:17', NULL),
(45, 'Ananda', 0, NULL, 'nanda@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rgq3JY5aWsKXHUMAYMoHJ89u2', NULL, NULL, NULL, 5, 10, NULL, '2019-07-06 07:07:39', '2019-07-06 07:09:04', NULL),
(46, 'Ega', 1, NULL, 'egalupa@gmail.com', NULL, NULL, '$2y$10$iUwwg5w7FzPVVs4ir11L4OZ3/SwmkREGmG/omzNoyW5Tb3BYF.7HS', NULL, 'e91cdbf8-1e4d-4ab8-ab74-e236d426a2d8', 'd-rdGyAVJ3o:APA91bFvtXFRU1Hw2i97HPtcXcw3nKfsjJsWUmHmphCjWh8iJPmWtpVnvYdop0XgG0CeM6HkeVn5ulRlufsuu5QXUq82Cvse-LoTAhCdoIFdHdyRCxyeP701Q8DFKH28GFLe3aSt1zhP', 'xxx', '923fbc4e9dbb5ce5', NULL, '2019-09-29 08:38:03', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQ2LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTc3NDU0NjcyLCJleHAiOjE1Nzg2NjQyNzIsIm5iZiI6MTU3NzQ1NDY3MiwianRpIjoiMjh3SGkzZlhpU2VpV293QyJ9.p6p9QIxrKGFNGre0pIB0VpU8JV90PX_X1hLkv9udzHM', 1, 10, '2019-12-27 13:51:12', '2019-09-29 08:38:03', '2019-12-27 13:51:12', NULL),
(47, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '337ksylvF0qF2odU3q4D2N2ym', NULL, NULL, NULL, 5, 10, NULL, '2019-09-29 08:38:03', '2019-09-29 08:38:03', NULL),
(48, 'Ega', 1, NULL, 'testto@gmail.com', NULL, NULL, '$2y$10$YSL6L1g8XYjohwuGnFzn1.HllmEeeYN8/Ag37qND/gk05dxKssT8.', NULL, 'e91cdbf8-1e4d-4ab8-ab74-e236d426a2d8', 'fnCbrXmfU9E:APA91bFb1w__wtAQKNYoH6VBd1CHbxqvtfPY7g1IlwtsEIwkT7MP1mCevtI6Hh8do0DvjykCCJUepy994R2z-pkJhpJsRDhSuh6-fkYmMAKzHI31TFBJfI-XHE6HRZv2EG-GQVG6K7gj', '923fbc4e9dbb5ce5', '923fbc4e9dbb5ce5', NULL, '2019-10-05 08:37:10', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQ4LCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNTcwMjY0NjMwLCJleHAiOjE1NzE0NzQyMzAsIm5iZiI6MTU3MDI2NDYzMCwianRpIjoieWlKRDIwR3d3MmNaWTNSQiJ9.VGD_UVQ4DVhxf91uha_rewkRJaEWG3uwi7gypHM8EgI', 1, 10, '2019-10-05 08:37:10', '2019-10-05 08:37:10', '2019-10-05 08:37:10', NULL),
(49, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'm014Z6Je8EZitwNqeD46o4xfP', NULL, NULL, NULL, 5, 10, NULL, '2019-10-05 08:37:10', '2019-10-05 08:37:10', NULL),
(50, 'Hendri Gunawan', 1, NULL, 'hendri.gnw222@gmail.com', NULL, NULL, '$2y$10$cxrIcE5XSunDqLIUhQo/FOTYVx00g24E2FKixp3i7c1qUK1gcxD1m', NULL, 'f4f73286-3aa6-4655-bfdc-cbcfdf54a10d', NULL, 'xxx', 'xxx', NULL, '2019-11-27 18:00:00', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjUwLCJpc3MiOiJodHRwOi8vcGxhbnlvdXJkYXlzLmlkL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTc0ODc3NjMzLCJleHAiOjE1NzYwODcyMzMsIm5iZiI6MTU3NDg3NzYzMywianRpIjoiQmpJeXFtYlp4eUFqdDdGaSJ9.yuIWs4Q0cj4bffpx89odPmT6IW4Buk_luCA78L78SNk', 1, 10, '2019-11-27 18:00:33', '2019-11-27 18:00:00', '2019-11-27 18:00:33', NULL),
(51, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'L1kKJPNgyPcrulp1nepN0EbhY', NULL, NULL, NULL, 5, 10, NULL, '2019-11-27 18:00:00', '2019-11-27 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_favorite_vendor`
--

CREATE TABLE `user_favorite_vendor` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_favorite_vendor`
--

INSERT INTO `user_favorite_vendor` (`id`, `user_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(11, 20, 23, '2019-06-26 10:03:24', '2019-06-26 10:03:24'),
(13, 18, 3, '2019-07-01 16:09:27', '2019-07-01 16:09:27'),
(14, 22, 3, '2019-07-02 03:06:02', '2019-07-02 03:06:02'),
(15, 2, 3, '2019-07-03 22:18:54', '2019-07-03 22:18:54'),
(16, 18, 4, '2019-07-04 22:13:51', '2019-07-04 22:13:51'),
(17, 20, 7, '2019-07-05 01:42:34', '2019-07-05 01:42:34'),
(18, 18, 16, '2019-07-06 03:08:23', '2019-07-06 03:08:23'),
(19, 44, 7, '2019-07-06 07:12:02', '2019-07-06 07:12:02'),
(20, 16, 20, '2019-07-14 06:31:06', '2019-07-14 06:31:06'),
(21, 46, 3, '2019-12-02 18:31:18', '2019-12-02 18:31:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_gallery`
--

CREATE TABLE `user_gallery` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_gallery`
--

INSERT INTO `user_gallery` (`id`, `user_id`, `gallery_id`, `created_at`, `updated_at`) VALUES
(16, 16, 41, '2019-07-01 04:28:26', '2019-07-01 04:28:26'),
(17, 16, 20, '2019-07-01 04:28:38', '2019-07-01 04:28:38'),
(18, 16, 39, '2019-07-01 04:28:55', '2019-07-01 04:28:55'),
(19, 22, 42, '2019-07-02 03:04:11', '2019-07-02 03:04:11'),
(21, 20, 27, '2019-07-04 17:05:13', '2019-07-04 17:05:13'),
(22, 20, 24, '2019-07-04 17:05:15', '2019-07-04 17:05:15'),
(23, 18, 15, '2019-07-04 22:14:29', '2019-07-04 22:14:29'),
(24, 18, 20, '2019-07-04 22:14:46', '2019-07-04 22:14:46'),
(25, 22, 7, '2019-07-06 02:32:39', '2019-07-06 02:32:39'),
(26, 16, 31, '2019-07-06 04:14:06', '2019-07-06 04:14:06'),
(27, 34, 28, '2019-07-06 04:30:34', '2019-07-06 04:30:34'),
(28, 16, 38, '2019-07-06 06:21:02', '2019-07-06 06:21:02'),
(29, 44, 25, '2019-07-06 07:11:37', '2019-07-06 07:11:37'),
(30, 16, 27, '2019-09-22 12:40:37', '2019-09-22 12:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_relation`
--

CREATE TABLE `user_relation` (
  `id` bigint(20) NOT NULL,
  `male_user_id` bigint(20) UNSIGNED NOT NULL,
  `female_user_id` bigint(20) UNSIGNED NOT NULL,
  `wedding_day` date DEFAULT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_relation`
--

INSERT INTO `user_relation` (`id`, `male_user_id`, `female_user_id`, `wedding_day`, `venue`, `photo`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2019-12-30', 'xxx', NULL, '2018-05-31', '2019-11-28'),
(2, 4, 5, '2020-01-26', 'dimana ya.', 'endah-muhamaf-ega-090427.jpg', '2018-05-31', '2018-05-31'),
(3, 7, 6, '2019-04-06', 'Balai Kartini', NULL, '2018-06-04', '2018-06-07'),
(4, 8, 9, NULL, NULL, NULL, '2019-06-14', '2019-06-14'),
(5, 10, 11, NULL, NULL, NULL, '2019-06-14', '2019-06-14'),
(6, 12, 13, NULL, NULL, NULL, '2019-06-14', '2019-06-14'),
(7, 14, 15, NULL, NULL, NULL, '2019-06-14', '2019-06-14'),
(8, 16, 17, '2020-06-23', 'Balai kartini', NULL, '2019-06-16', '2019-07-08'),
(9, 18, 19, '2021-01-22', 'Gedung serba guna', NULL, '2019-06-25', '2019-10-07'),
(10, 20, 21, '2019-08-30', 'Rumah', 'anisa-jkt48-dendi-084134.jpg', '2019-06-26', '2019-07-05'),
(11, 22, 23, '2019-07-13', 'Jakarta', NULL, '2019-07-01', '2019-07-05'),
(12, 24, 25, '2020-07-05', 'Jakarta', NULL, '2019-07-05', '2019-07-05'),
(13, 26, 27, '2019-09-12', 'Jakarta', NULL, '2019-07-05', '2019-07-05'),
(14, 28, 29, '2022-12-12', 'Rumah', NULL, '2019-07-05', '2019-07-05'),
(15, 30, 31, NULL, NULL, NULL, '2019-07-05', '2019-07-05'),
(16, 32, 33, '2019-09-07', 'Jakarta', NULL, '2019-07-06', '2019-07-06'),
(17, 34, 35, NULL, NULL, NULL, '2019-07-06', '2019-07-06'),
(18, 36, 37, '2020-07-06', 'Taman', NULL, '2019-07-06', '2019-07-06'),
(19, 38, 39, NULL, NULL, NULL, '2019-07-06', '2019-07-06'),
(20, 40, 41, '2019-10-06', 'Mercu', NULL, '2019-07-06', '2019-07-06'),
(21, 42, 43, '2019-10-06', 'Jakarta', NULL, '2019-07-06', '2019-07-06'),
(22, 44, 45, '2020-07-06', 'Malang', NULL, '2019-07-06', '2019-07-06'),
(23, 46, 47, NULL, NULL, NULL, '2019-09-29', '2019-09-29'),
(24, 48, 49, NULL, NULL, NULL, '2019-10-05', '2019-10-05'),
(25, 50, 51, NULL, NULL, NULL, '2019-11-28', '2019-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `user_relation_concept`
--

CREATE TABLE `user_relation_concept` (
  `id` int(11) NOT NULL,
  `user_relation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `concept_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `concept_id`, `name`, `description`, `file`, `avatar`, `address`, `latitude`, `longitude`, `phone`, `email`, `instagram`, `facebook`, `price`, `status`, `order`, `created_at`, `updated_at`) VALUES
(3, 1, 'The NJONJA, Goumet Catering', 'Set Menu :\r\n\r\nStart from IDR 650.000 / Pax\r\n\r\nWe are open for any requests upon client\'s budget', 'the-njonja-goumet-catering-043131.jpg', 'the-njonja-goumet-catering-160029.png', 'Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 11630', -6.164843, 106.814659, '+6281299118899', 'catering@jdv.co.id', 'the_njonja', '#', '2000000', 1, 0, '2019-06-16 09:50:45', '2020-01-02 09:00:29'),
(4, 1, 'Dwi Tunggal Citra', 'Catering Service  & Wedding Consultant', 'dwi-tunggal-citra-140038.png', 'dwi-tunggal-citra-230527.jpg', 'Jl. Dempo 2 No.22 Mayestik Kebayoran Baru - Jakarta Selatan', NULL, NULL, '0816713562', 'dwitunggalcitra@gmail.com', 'dwitunggalcitra', NULL, '650000', 1, 0, '2019-06-26 07:00:39', '2019-07-04 16:05:27'),
(5, 1, 'Alfabet Catering', 'Salah satu perusahaan jasa katering terbaik dan terkemuka\r\nDibangun atas fondasi kepercayaan serta kepuasan konsumen sejak tahun 1996.\r\n\r\n\r\nKatering untuk setiap jenis acara\r\nMulai dari katering untuk korporasi dan institusi, pernikahan, acara ulang tahun, serta acara elaborasi lainnya.\r\n\r\n\r\nStaf dan koki profesional kami siap melayani Anda\r\nKami senantiasa memberikan produk berkualitas dengan penyajian yang inovatif.', 'alfabet-catering-141035.png', NULL, 'Jl. Minangkabau No. 24 Jakarta Selatan', NULL, NULL, '0218313634', 'marketing@alfabetcatering.com', 'alfabetcatering', NULL, '650000', 1, 0, '2019-06-26 07:10:35', '2019-06-26 07:10:35'),
(6, 1, 'Kiki Catering', 'Kiki Catering adalah sebuah perusahaan jasa boga yang telah pengalaman lebih dari 25 tahun. Kami melayani berbagai jenis acara, mulai dari resepsi pernikahan, ulang tahun, acara kantor dan acara lainnya yang memiliki komitmen untuk terus berinovasi dalam pilihan menu maupun penyajian secara kreatif dan menarik untuk memberikan yang terbaik bagi konsumennya', 'kiki-catering-141827.png', NULL, 'Jl. Elang Malindo No. 10\r\n\r\nCurug Indah, Jatiwaringin\r\n\r\nJakarta Timur, 13620\r\n\r\nIndonesia​', NULL, NULL, '085776449288', 'afi@kikicatering.co.id', 'kiki.catering', NULL, '650000', 1, 0, '2019-06-26 07:18:27', '2019-06-26 07:18:27'),
(7, 2, 'Garda Dekorasi', 'Garda Dekorasi telah berdiri sejak tahun 1998 dan telah memiliki pengalaman lebih dari 10 tahun. Garda Dekorasi bergerak di bidang jasa, yang melayani dekorasi untuk pelaminan dengan bergaya internasional,nasional, tradisional, dll sesuai dengan permintaan anda.', 'garda-dekorasi-142250.png', NULL, 'Mutiara Taman Palem Bloc C7 No.18 Cengkareng, Jakarta Barat', NULL, NULL, '08129081122', 'gardaweddingdecoration@yahoo.com', 'garda_dekorasi', NULL, '1000000', 1, 0, '2019-06-26 07:22:50', '2019-06-26 07:22:50'),
(8, 2, 'Arrya Decoration', 'Arrya Decoration adalah suatu perusahaan yang bergerak dalam bidang Dekorasi Pernikahan (Wedding Decoration), disamping itu kami tidak hanya menyediakan Jasa dalam bidang Dekorasi Pernikahan saja, tetapi juga melayani jasa Paket Pernikahan ( Wedding Package ) dan juga jasa Wedding Organizer maupun Wedding Planner yang dal am istilahnya dikenal dengan “One-Stop Wedding”. Perusahaan kami telah berdiri lebih dari 12 Tahun dan kami telah melayani lebih dari 16.000 event di hampir semua gedung dan hotel di Jakarta. Dalam kurun waktu tersebut, kami telah bekerjasama lebih dari 80 wedding Venue di Jakarta, meliputi Gedung Pertemuan, Hotel, maupun Lokasi Outdoor di Jakarta. Dan kamipun juga melayani Event Event diluar Jakarta, seperti Bandung, Natuna, Bali. Dsb', 'arrya-decoration-142758.jpg', NULL, 'Jl. Assirot No 90 Kebayoran Lama 11560', NULL, NULL, '0818811201', 'arrya_decoration@yahoo.com', 'arryadecoration', NULL, '1000000', 1, 0, '2019-06-26 07:28:00', '2019-06-26 07:28:00'),
(9, 2, 'Joelle Decoration', 'Why Joelle Decoration?\r\nWe love art, We do arts\r\nWe design\r\nWe strive to be creatives\r\nWe love detail\r\nWe do love Modern Decoration\r\nWe serve UptoDate decoration\r\nCompetitive rates\r\nMany satisfied Clients\r\n\r\nMembuat pernikahan anda berkesan ialah dekorasi.\r\nMemberi memory tidak terlupakan ialah dekorasi.\r\nMenakjubkan banyak tamu ialah dekorasi.\r\nMelengkapi pernikahan anda menjadi Special ialah dekorasi.\r\n\r\nKami Joelle Decoration hadir mewujudkan impian terindah anda', 'joelle-decoration-143527.png', NULL, 'Jln Jomas no 21A ,RT 007 / RW 005 ,Pessangrahan,11620, Jakarta Barat\r\nKembangan', NULL, NULL, '08176670477', 'Decor.Joelle@Gmail.Com', 'joelledecoration', NULL, '1000000', 1, 0, '2019-06-26 07:35:27', '2019-06-26 07:35:27'),
(10, 7, 'The Red Carpet Entertainment', 'Let us help you to create a wonderful memories for the biggest moment in your life (wedding celebration, birthday party, gathering, and product launching) through our services (MC, Band, and Sound System) based on your creation and budget.', 'the-red-carpet-entertainment-144117.jfif', NULL, 'Belmont Residence, Everest 10.01 West Jakarta 11620', NULL, NULL, '0817121877', 'theredcarpetent@gmail.com', 'theredcarpetentertainment', NULL, '400000', 1, 0, '2019-06-26 07:41:17', '2019-06-26 07:41:17'),
(11, 7, 'Jova Musique', 'Jova Musique menyediakan berbagai pilihan MC (Master of Ceremony) dengan karakter dan style yang variatif, tentunya dengan price yang berbeda-beda. MC yang disediakan untuk acara bertema nasional/international, Male MC/Female MC, dan lain sebagainya.', 'jova-musique-144403.jpg', NULL, 'Confirm by Call or Email', NULL, NULL, '087885735546', 'jovamusique@yahoo.com', 'jovamusique', NULL, '4500000', 1, 0, '2019-06-26 07:44:03', '2019-06-26 07:44:03'),
(12, 7, 'Luxe Voir Enterprise', 'We provide professional MC and session player for Wedding, Event, Gathering, etc', 'luxe-voir-enterprise-144727.png', NULL, 'Citra Garden I No.F3/13, RT.8/RW.1, Kalideres, Kec. Kalideres, Jakarta, Daerah Khusus Ibukota Jakarta 11840', NULL, NULL, '082217418688', 'luxevoir@gmail.com', 'luxevoirid', NULL, '3000000', 1, 0, '2019-06-26 07:47:27', '2019-06-26 07:47:27'),
(13, 4, 'Ciel Makeup Artist', 'Runner up of Shu Uemura Beauty Competition 2016.    It\'s  an honor for us to be a part of your special day', 'ciel-makeup-artist-145145.jfif', NULL, 'Confirm by contact', NULL, NULL, '081996662888', 'Priscielee@Gmail.Com', 'cielmakeupartist', NULL, '100000', 1, 0, '2019-06-26 07:51:45', '2019-06-26 07:51:45'),
(14, 4, 'Tanmell Makeup', 'soft, strong makeup as your request', 'tanmell-makeup-145351.PNG', NULL, 'Confirm by Contact', NULL, NULL, '087877243225', 'Tanmell25@Yahoo.Com', 'tanmellmakeup', NULL, '6000000', 1, 0, '2019-06-26 07:53:51', '2019-06-26 07:53:51'),
(15, 4, 'Megautari Anjani', 'I am a freelance Makeup Artist, but I am willing to join a team or work with others.\r\nMy specification is makeup art. I have been doing makeup for more than 2 years. My style is to bring the best features of your face and correct the flaw. I do not change someone\'s face, I just bring the best out of her.', 'megautari-anjani-145609.PNG', NULL, 'Jakarta Barat 11430', NULL, NULL, '082298772200', 'Megautarianjani@Gmail.Com', 'megautarianjani', NULL, '6000000', 1, 0, '2019-06-26 07:56:09', '2019-06-26 07:56:09'),
(16, 5, 'DREAMSCAPE', 'Inspired by your stories, we help build with you your perfect destination wedding experience and honeymoon journey. Choosing the right gorgeous destination venue to celebrate your wedding and ensure it is an ideal fit for two personalities can be tricky work. When working with us, you will benefit from our vast and varied expertise to ensure that our special couple will receive full customization in every step of the process, while streamlining your communications, budget and cost.', 'dreamscape-150139.png', NULL, 'Komp. Ruko Darmawangsa Square no. 29. Jl. Darmawangsa VI Jakarta Selatan', NULL, NULL, '02122770178', 'service@my-dscape.com', 'mydscape', NULL, '10000000', 1, 0, '2019-06-26 08:01:40', '2019-06-26 08:01:40'),
(17, 5, 'VC Tailormade Travel', 'No two journeys along the same path are alike. Whether it is celebrating a personal milestone, reconnecting with nature, engaging in a new culture, or just simply having fun, we design a journey that you will remember for life', 'vc-tailormade-travel-150407.jpg', NULL, 'Jalan Terusan Bandengan Utara, Komplek Air Baja Blok I No 101 Jakarta Utara', NULL, NULL, '08111088677', 'Rendra@Vcwisata.Com', 'vcwisata', NULL, '9000000', 1, 0, '2019-06-26 08:04:07', '2019-06-26 08:04:07'),
(18, 5, 'Sweet Escape', 'SweetEscape is an online platform that connects you with local photographers in 300+ cities around the world. \r\nOur mission is to capture your life\'s precious moments, anywhere. \r\n\r\nSweetEscape is perfect for proposals, engagements, casual preweddings, honeymoons, bachelorette trips, etc.', 'sweet-escape-150606.png', NULL, 'Gandaria 8 Office Towers, 3rd floor, Unit AG, Jl. Sultan Iskandar Muda, Jakarta Selatan 12240', NULL, NULL, '081218121800', 'Hello@Sweetescape.Com', 'sweet.escape', NULL, '11000000', 1, 0, '2019-06-26 08:06:06', '2019-06-26 08:06:06'),
(20, 6, 'Meltiq Invitation', 'At Meltiq, it is our desire to continuously provide a huge selection of top quality wedding invitations and set the standards for luxury invitation. Our mission is not only to provide high quality products, but to also provide outstanding services such as affordable prices, punctuality and providing quick, friendly, reliable service for the clients.', 'meltiq-invitation-151250.jpg', NULL, 'Jl peta, Komplek taman anggrek, Suka Asih, Kec. Bojongloa Kaler, Kota Bandung, Jawa Barat 40233', NULL, NULL, '08112257035', 'Info@Meltiq.Com', 'meltiq_invitation', NULL, '19000', 1, 0, '2019-06-26 08:12:51', '2019-06-26 08:12:51'),
(21, 6, 'Sentimeter Card', 'Sejak tahun 2014, kami telah banyak membantu calon pasangan pengantin dalam mempersiapkan kebutuhan pernikahan mereka khususnya kartu undangan, souvenir pernikahan, buku tamu, boks untuk souvenir pedamping pria & wanita, buku akad nikah/pemberkatan, serta perlengkapan pernikahan lainnya.\r\n\r\nMenurut kami, desain merupakan kunci pertama dari sebuah kartu undangan. Kami terbiasa dengan pembuatan desain custom, tapi juga banyak pilihan desain template yang mungkin cocok dengan selera kamu dengan harga yang lebih efisien.\r\n\r\nKalau kamu bingung dengan konsep untuk kartu undangannya, banyak referensi yang bisa kita gunakan diantaranya konsep acara pernikahan kamu sendiri. Kamu bisa hubungi kami untuk sekedar konsultasi terlebih dahulu dan kadang kamu bisa dapat promo-promo khusus juga.', 'sentimeter-card-151528.jpeg', NULL, 'Jl. Hanoman I, Jl. Bojong Indah Raya No.29, RT.2/RW.9, Rw. Buaya, Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11740', NULL, NULL, '081228822826', 'Sentimetercard@Gmail.Com', 'sentimetercard', NULL, '8000', 1, 0, '2019-06-26 08:15:28', '2019-06-26 08:15:28'),
(22, 3, 'Warna Project', 'Our goal is to give you the freedom and peace of mind to enjoy your day while we capture the laughter, tears, and moments that you will look back on and reminisce with warmth.', 'warna-project-151818.jpg', NULL, 'Kemang Pratama, Jalan Taman Alamanda, Sepanjang Jaya, Rawalumbu, Sepanjang Jaya, Bekasi Barat, Jawa Barat 15411', NULL, NULL, '0818725255', 'Warnaprojects@Gmail.Com', 'warnaproject_', NULL, '2000000', 1, 0, '2019-06-26 08:18:18', '2019-06-26 08:18:18'),
(23, 3, 'Alissha Bride', 'Established in 2012, Alissha is known for its up to date gowns and spectacular quality of its dress. We served the best quality of our dresses, make-up, and photography. And now we also have venue, decoration, and Wedding Organizer & Entertainment (All-In Packages)\r\n\r\nOur highly-rated gowns designs are beloved by brides all across Greater Jakarta Area and our showroom is an oasis of ideas of wedding dream. And our All-In Packages will help you to get more affordable, more efficient, less worries', 'alissha-bride-152024.jpg', NULL, 'Jl. Bisma Tengah 2 No.21, RT.7/RW.9, Papanggo, Tj. Priok, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14340', NULL, NULL, '082334523345', 'Alisshadevelopment@Gmail.Com', 'alisshabride', NULL, '6000000', 1, 0, '2019-06-26 08:20:24', '2019-06-26 08:20:24'),
(24, 3, 'Lumilo Photography', 'We’re a bunch pf passionate folks that love to create a beautiful output of your lovely BIG day', 'lumilo-photography-152231.png', NULL, 'Jalan Tampak Siring Timur no. 27 11840', NULL, NULL, '087875542857', 'Lumilophoto@Gmail.Com', 'lumilophoto', NULL, '5000000', 1, 0, '2019-06-26 08:22:31', '2019-06-26 08:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_detail`
--

CREATE TABLE `vendor_detail` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_detail`
--

INSERT INTO `vendor_detail` (`id`, `vendor_id`, `name`, `file`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 3, 'Test Detail', 'test-detail-155708.png', 1, 0, '2020-01-02 08:57:09', '2020-01-02 08:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_package`
--

CREATE TABLE `vendor_package` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(14,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_package`
--

INSERT INTO `vendor_package` (`id`, `vendor_id`, `name`, `description`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Pax 1', 'Pax 1 : 500 box\r\n\r\n1. Nasi\r\n2. sayur\r\n3. Ayam Bakar\r\n4. Telur rebus\r\n5. Sambal\r\n6. Air Mineral\r\n7. Jeruk', 2000000.00, 1, '2019-11-04 16:54:21', '2020-01-02 08:36:28'),
(2, 4, 'Nasi Ikan Asam', '400 pax', 15000000.00, 1, '2019-11-10 10:26:40', '2019-11-10 10:26:40'),
(3, 3, 'Pax 2', 'Pax 2 : 1000 box\r\n\r\n1. Nasi\r\n2. Ayam Bakar\r\n3. Sayur\r\n4. Telur Rebus\r\n5. Sambal\r\n6. Air Mineral\r\n7. Jeruk', 3500000.00, 1, '2020-01-02 08:42:41', '2020-01-02 08:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_voucher`
--

CREATE TABLE `vendor_voucher` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_voucher`
--

INSERT INTO `vendor_voucher` (`id`, `vendor_id`, `name`, `discount`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Voucher Perdana Gratis', 100000, '2019-11-01 17:00:00', '2019-11-07 17:00:00', 1, '2019-11-04 16:02:47', '2019-11-04 16:02:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concept`
--
ALTER TABLE `concept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concept_detail`
--
ALTER TABLE `concept_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `concept_id` (`concept_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concept_id_fk` (`concept_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_relation_id` (`user_relation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_problem`
--
ALTER TABLE `report_problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bank_id` (`bank_id`),
  ADD KEY `payment_type_id` (`payment_type_id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `concept_id` (`concept_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `vendor_package_id` (`vendor_package_id`),
  ADD KEY `vendor_voucher_id` (`vendor_voucher_id`);

--
-- Indexes for table `transaction_payment`
--
ALTER TABLE `transaction_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_favorite_vendor`
--
ALTER TABLE `user_favorite_vendor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `user_gallery`
--
ALTER TABLE `user_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `gallery_id` (`gallery_id`);

--
-- Indexes for table `user_relation`
--
ALTER TABLE `user_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `male_user_id` (`male_user_id`),
  ADD KEY `female_user_id` (`female_user_id`);

--
-- Indexes for table `user_relation_concept`
--
ALTER TABLE `user_relation_concept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_relation_id` (`user_relation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concept_id` (`concept_id`);

--
-- Indexes for table `vendor_detail`
--
ALTER TABLE `vendor_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `vendor_package`
--
ALTER TABLE `vendor_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `vendor_voucher`
--
ALTER TABLE `vendor_voucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `concept`
--
ALTER TABLE `concept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `concept_detail`
--
ALTER TABLE `concept_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report_problem`
--
ALTER TABLE `report_problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `transaction_payment`
--
ALTER TABLE `transaction_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_favorite_vendor`
--
ALTER TABLE `user_favorite_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_gallery`
--
ALTER TABLE `user_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_relation`
--
ALTER TABLE `user_relation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_relation_concept`
--
ALTER TABLE `user_relation_concept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vendor_detail`
--
ALTER TABLE `vendor_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_package`
--
ALTER TABLE `vendor_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_voucher`
--
ALTER TABLE `vendor_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `concept_id_fk` FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`user_relation_id`) REFERENCES `user_relation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_5` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_6` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `transaction_detail_ibfk_10` FOREIGN KEY (`vendor_package_id`) REFERENCES `vendor_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_detail_ibfk_11` FOREIGN KEY (`vendor_voucher_id`) REFERENCES `vendor_voucher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_detail_ibfk_6` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_detail_ibfk_7` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_detail_ibfk_8` FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_detail_ibfk_9` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_payment`
--
ALTER TABLE `transaction_payment`
  ADD CONSTRAINT `transaction_payment_ibfk_4` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_payment_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_payment_ibfk_6` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_favorite_vendor`
--
ALTER TABLE `user_favorite_vendor`
  ADD CONSTRAINT `user_favorite_vendor_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_favorite_vendor_ibfk_4` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_gallery`
--
ALTER TABLE `user_gallery`
  ADD CONSTRAINT `user_gallery_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_gallery_ibfk_4` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_relation`
--
ALTER TABLE `user_relation`
  ADD CONSTRAINT `user_relation_ibfk_3` FOREIGN KEY (`male_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_relation_ibfk_4` FOREIGN KEY (`female_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_relation_concept`
--
ALTER TABLE `user_relation_concept`
  ADD CONSTRAINT `user_relation_concept_ibfk_3` FOREIGN KEY (`user_relation_id`) REFERENCES `user_relation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_relation_concept_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_2` FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_detail`
--
ALTER TABLE `vendor_detail`
  ADD CONSTRAINT `vendor_detail_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_package`
--
ALTER TABLE `vendor_package`
  ADD CONSTRAINT `vendor_package_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_voucher`
--
ALTER TABLE `vendor_voucher`
  ADD CONSTRAINT `vendor_voucher_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
