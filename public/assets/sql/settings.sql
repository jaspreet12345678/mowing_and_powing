-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2022 at 07:08 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mowiwzzj_mowingplowing`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `field_key` varchar(500) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  `status` int NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `field_key`, `field_value`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'on_demand_fee', '19.99', 1, 0, '2021-08-27 05:02:08', '2022-04-25 19:36:56'),
(8, 'sale_fee', '25', 1, 0, '2021-08-27 05:02:08', '2021-09-02 06:03:21'),
(7, 'service_fee', '25', 1, 0, '2021-08-27 05:02:08', '2021-09-02 06:03:21'),
(9, 'admin_feeLawn', '.99', 1, 0, '2021-09-10 09:57:29', '2022-05-21 02:25:41'),
(11, 'admin_feeSnow', '1', 1, 0, '2021-09-10 11:00:18', '2021-12-12 18:13:42'),
(12, 'tax_rate_lawn', '5.75', 1, 0, '2021-09-10 11:17:57', '2022-05-21 02:25:33'),
(13, 'tax_rate_snow', '5', 1, 0, '2021-09-10 11:18:34', '2021-11-26 06:56:03'),
(14, 'radius', '50', 1, 0, '2021-09-18 06:59:24', '2022-01-18 13:49:10'),
(15, 'admin_commission', '23', 1, 0, '2021-09-28 07:36:51', '2022-08-22 20:22:00'),
(16, 'defaultsection1', '/city/1661168007599ypuj.png', 1, 0, '2022-08-22 06:22:43', '2022-08-22 11:33:27'),
(17, 'defaultsection2', '/city/16611679820644m6xs.png', 1, 0, '2022-08-22 06:22:43', '2022-08-22 11:33:02'),
(18, 'auto_refill_limit', '20', 1, 0, '2022-08-22 06:22:43', '2022-08-22 11:33:02'),
(19, 'cancel_job_charges', '7', 1, 0, '2022-08-22 06:22:43', '2022-08-22 11:33:02'),
(20, 'referral_bonus', '50.00', 1, 0, '2022-08-12 06:02:43', '2022-08-12 11:03:02'),
(21, 'auto_accept_proposal_after_mins', '30', 1, 0, '2022-08-12 06:02:43', '2022-08-12 11:03:02'),
(22, 'send_job_requests_to_remaining_providers_after_mins', '30', 1, 0, '2022-08-12 06:02:43', '2022-08-12 11:03:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
