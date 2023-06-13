-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2022 at 02:22 PM
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
-- Table structure for table `lawn_sizes`
--

CREATE TABLE `lawn_sizes` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `seven_days_price` double(10,2) NOT NULL,
  `ten_days_price` double(10,2) NOT NULL,
  `fourteen_days_price` double(10,2) NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lawn_sizes`
--

INSERT INTO `lawn_sizes` (`id`, `name`, `price`, `seven_days_price`, `ten_days_price`, `fourteen_days_price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(52, '0-.25 Acres', 50.00, 40.10, 42.60, 45.61, 0, '2021-10-10 00:55:16', '2022-07-13 23:20:54'),
(64, '.25 - .50 Acres', 61.30, 47.00, 55.00, 59.00, 0, '2021-11-13 23:05:15', '2022-06-10 21:09:02'),
(65, '.50 - .75 Acres', 85.00, 72.00, 80.00, 85.00, 0, '2021-11-13 23:17:04', '2022-06-10 21:09:43'),
(66, '.75 - 1 Acres ', 95.23, 75.38, 80.11, 85.31, 0, '2021-11-13 23:18:12', '2022-04-06 02:52:40'),
(67, '1 - 1.25 Acres', 120.01, 96.23, 101.34, 107.78, 0, '2021-11-13 23:18:54', '2022-04-06 02:55:20'),
(68, '1.25 - 1.50 Acres', 195.00, 120.01, 128.77, 133.56, 0, '2021-11-13 23:19:25', '2022-04-06 02:57:12'),
(69, '1.50 - 1.75 Acres', 180.25, 150.03, 157.72, 168.14, 0, '2021-11-13 23:20:12', '2022-04-06 02:59:05'),
(70, '1.75 - 2 Acres ', 240.00, 190.23, 200.21, 215.36, 0, '2021-11-13 23:21:20', '2022-03-21 14:04:02'),
(71, '2 - 2.25 Acres', 298.00, 239.00, 250.00, 268.00, 0, '2021-11-13 23:22:09', '2022-04-06 03:03:12'),
(72, '2.25 - 2.50 Acres', 337.96, 270.37, 287.26, 304.16, 0, '2021-11-13 23:22:51', '2022-02-08 18:35:37'),
(73, '2.50 - 2.75 Acres', 422.45, 369.01, 380.36, 400.80, 0, '2021-11-13 23:23:30', '2022-04-06 03:04:22'),
(74, '2.75 - 3 Acres', 560.02, 450.36, 480.96, 510.01, 0, '2021-11-13 23:24:18', '2022-04-06 03:06:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lawn_sizes`
--
ALTER TABLE `lawn_sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lawn_sizes`
--
ALTER TABLE `lawn_sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
