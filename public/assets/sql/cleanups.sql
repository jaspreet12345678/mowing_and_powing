-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2022 at 10:58 AM
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
-- Table structure for table `cleanups`
--

CREATE TABLE `cleanups` (
  `id` int NOT NULL,
  `lawn_size_id` int NOT NULL,
  `name` varchar(500) NOT NULL,
  `price` double(10,2) NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cleanups`
--

INSERT INTO `cleanups` (`id`, `lawn_size_id`, `name`, `price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1366, 52, 'Light Cleanup ', 180.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1367, 64, 'Light Cleanup ', 280.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1368, 65, 'Light Cleanup ', 380.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1369, 66, 'Light Cleanup ', 480.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1370, 67, 'Light Cleanup ', 580.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1371, 68, 'Light Cleanup ', 680.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1372, 69, 'Light Cleanup ', 780.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1373, 70, 'Light Cleanup ', 880.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1374, 71, 'Light Cleanup ', 980.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1375, 72, 'Light Cleanup ', 1080.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1376, 73, 'Light Cleanup ', 1180.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1377, 74, 'Light Cleanup ', 1280.00, 0, '2021-11-13 23:38:28', '2021-11-13 23:38:28'),
(1378, 52, 'Heavy Cleanup ', 230.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1379, 64, 'Heavy Cleanup ', 380.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1380, 65, 'Heavy Cleanup ', 530.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1381, 66, 'Heavy Cleanup ', 680.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1382, 67, 'Heavy Cleanup ', 830.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1383, 68, 'Heavy Cleanup ', 980.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1384, 69, 'Heavy Cleanup ', 1130.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1385, 70, 'Heavy Cleanup ', 1280.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1386, 71, 'Heavy Cleanup ', 1430.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1387, 72, 'Heavy Cleanup ', 1580.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1388, 73, 'Heavy Cleanup ', 1730.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07'),
(1389, 74, 'Heavy Cleanup ', 1880.00, 0, '2021-11-13 23:43:07', '2021-11-13 23:43:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cleanups`
--
ALTER TABLE `cleanups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cleanups`
--
ALTER TABLE `cleanups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1390;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
