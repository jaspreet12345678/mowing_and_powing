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
-- Table structure for table `lawn_heights`
--

CREATE TABLE `lawn_heights` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `seven_days_price` double(10,2) NOT NULL,
  `ten_days_price` double(10,2) NOT NULL,
  `fourteen_days_price` double(10,2) NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lawn_heights`
--

INSERT INTO `lawn_heights` (`id`, `name`, `price`, `seven_days_price`, `ten_days_price`, `fourteen_days_price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(35, '0 - 4 inches', 0.00, 0.00, 0.00, 0.00, 0, '2021-11-17 21:44:36', '2021-12-04 04:20:59'),
(36, '5 - 9 Inches ', 7.55, 0.00, 0.00, 0.00, 0, '2021-11-17 21:45:06', '2022-03-25 20:08:37'),
(37, '10 - 12 Inches', 21.56, 0.00, 0.00, 0.00, 0, '2021-11-17 21:45:30', '2022-03-25 20:08:49'),
(38, '13 - 24 Inches', 49.35, 0.00, 0.00, 0.00, 0, '2021-11-17 21:45:59', '2022-03-25 20:08:10'),
(39, '25 - 30 Inches', 72.52, 0.00, 0.00, 0.00, 0, '2021-11-17 21:46:23', '2022-03-25 20:08:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lawn_heights`
--
ALTER TABLE `lawn_heights`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lawn_heights`
--
ALTER TABLE `lawn_heights`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
