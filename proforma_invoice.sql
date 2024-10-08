-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2024 at 12:26 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proforma_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `proforma_invoice`
--

CREATE TABLE `proforma_invoice` (
  `id` int UNSIGNED NOT NULL,
  `invoice_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `business_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ship_to` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_references` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contact_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_terms` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_box` int UNSIGNED DEFAULT NULL,
  `total_qty` int UNSIGNED NOT NULL,
  `sub_total` float(10,2) UNSIGNED NOT NULL,
  `freight_charges` float(10,2) DEFAULT NULL,
  `scheme` float(10,2) UNSIGNED DEFAULT NULL,
  `scheme_amount` float(10,2) UNSIGNED NOT NULL,
  `subminusscheme` float(10,2) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `gst` int UNSIGNED NOT NULL,
  `gst_amount` float(10,2) UNSIGNED NOT NULL,
  `total_amount` float(10,2) UNSIGNED NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Open',
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proforma_invoice`
--

INSERT INTO `proforma_invoice` (`id`, `invoice_id`, `client_id`, `business_name`, `address`, `ship_to`, `other_references`, `contact_name`, `contact_number`, `gst_number`, `payment_terms`, `total_box`, `total_qty`, `sub_total`, `freight_charges`, `scheme`, `scheme_amount`, `subminusscheme`, `amount`, `gst`, `gst_amount`, `total_amount`, `created_by`, `user_id`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, NULL, 38, 'BOTHMAL MEGHRAJ', '314, AMBAVADI BAZAR, ELLISBRIDGE, AMBAVADI, AHMEDABAD 380015', '314, AMBAVADI BAZAR, ELLISBRIDGE, AMBAVADI, AHMEDABAD 380015', NULL, 'BOTHMAL MEGHRAJ', '9998457164', '24ALFPJ8284M1ZL', '100% ADV.', 71, 37400, 65900.00, 1000.00, 7.00, 4613.00, 61287.00, 62287.00, 18, 11211.66, 73498.66, 'Ramesh Yadav', 1, 'Close', 'Dispacted on 5', '2024-10-07 05:33:18', '2024-10-08 00:45:17'),
(2, '1', 105, 'M/s HERITAGE MARKETING', 'LAXMINAGAR MAIN ROAD', 'LAXMINAGAR MAIN ROAD', NULL, 'MR. JAY PANSERIYA', '9558999198', 'asdfswdfsdf34234', '100% ADV.', 15, 3000, 9500.00, 0.00, 7.00, 665.00, 8835.00, 8835.00, 18, 1590.30, 10425.30, 'Ramesh Yadav', 1, 'Open', NULL, '2024-10-08 05:39:04', '2024-10-08 05:39:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `proforma_invoice`
--
ALTER TABLE `proforma_invoice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `proforma_invoice`
--
ALTER TABLE `proforma_invoice`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
