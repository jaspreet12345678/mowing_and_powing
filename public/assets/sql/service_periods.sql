-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2022 at 07:11 PM
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
-- Table structure for table `service_periods`
--

CREATE TABLE `service_periods` (
  `id` int NOT NULL,
  `duration` varchar(255) NOT NULL,
  `duration_type` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `type` int NOT NULL COMMENT '1=>one time , 2=>recurring',
  `recommended` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` int DEFAULT '1',
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_periods`
--

INSERT INTO `service_periods` (`id`, `duration`, `duration_type`, `price`, `type`, `recommended`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '7', 'Days', 30.00, 2, 'Yes', 1, 0, '2021-08-06 13:47:11', '2021-11-13 23:33:50'),
(2, '10', 'Days', 40.00, 2, 'No', 1, 0, '2021-08-06 13:47:11', '2021-11-13 23:33:50'),
(3, ' ', 'ONE TIME', 30.00, 1, 'No', 1, 0, '2021-08-06 13:47:11', '2021-11-13 23:33:50'),
(47, '14', 'Days', 40.00, 2, 'No', 1, 0, '2021-09-06 14:23:58', '2021-11-13 23:33:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `service_periods`
--
ALTER TABLE `service_periods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `service_periods`
--
ALTER TABLE `service_periods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
