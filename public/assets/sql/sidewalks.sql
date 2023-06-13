-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2022 at 04:38 PM
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
-- Table structure for table `sidewalks`
--

CREATE TABLE `sidewalks` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'CAR,HOME,BUSINESS',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sidewalks`
--

INSERT INTO `sidewalks` (`id`, `name`, `price`, `type`,`created_at`, `updated_at`) VALUES
(1, 'Small', 25.36, 'HOME', '2021-08-16 07:59:36', '2021-11-23 05:25:15'),
(2, 'Medium', 30.39, 'HOME', '2021-08-16 07:59:36', '2021-11-26 06:51:07'),
(5, 'Medium', 30.05, 'BUSINESS', '2021-08-16 07:59:36', '2021-11-23 05:26:42'),
(6, 'Large', 40.05, 'BUSINESS', '2021-08-16 07:59:36', '2021-11-23 05:26:48'),
(21, 'Large', 40.50, 'HOME', '2021-09-30 06:48:26', '2021-11-23 05:25:35'),
(22, 'Small ', 25.05, 'BUSINESS', '2021-09-30 06:49:36', '2021-11-23 05:26:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sidewalks`
--
ALTER TABLE `sidewalks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sidewalks`
--
ALTER TABLE `sidewalks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
