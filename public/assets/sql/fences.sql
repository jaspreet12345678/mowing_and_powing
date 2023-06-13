-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2022 at 02:23 PM
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
-- Table structure for table `fences`
--

CREATE TABLE `fences` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `seven_days_price` double(10,2) NOT NULL,
  `ten_days_price` double(10,2) NOT NULL,
  `fourteen_days_price` double(10,2) NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fences`
--

INSERT INTO `fences` (`id`, `name`, `price`, `seven_days_price`, `ten_days_price`, `fourteen_days_price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, 'Over 52 inches', 0.00, 0.00, 0.00, 0.00, 0, '2021-08-06 06:08:04', '2021-12-04 03:13:10'),
(13, 'Under 52  Inches', 5.23, 7.23, 8.23, 9.23, 0, '2021-09-02 05:47:21', '2022-03-25 20:09:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fences`
--
ALTER TABLE `fences`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fences`
--
ALTER TABLE `fences`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
