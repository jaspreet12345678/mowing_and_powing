-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2022 at 04:39 PM
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
-- Table structure for table `walkways`
--

CREATE TABLE `walkways` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT '	CAR,HOME,BUSINESS	',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `walkways`
--

INSERT INTO `walkways` (`id`, `name`, `price`, `type`, `created_at`, `updated_at`) VALUES
(2, 'Medium', 30.50, 'HOME', '2021-08-16 12:00:39', '2021-11-23 05:25:43'),
(3, 'Large', 40.69, 'HOME', '2021-08-16 12:00:39', '2021-11-26 06:51:21'),
(4, 'Small', 25.05, 'BUSINESS', '2021-08-16 12:00:39', '2021-11-23 05:26:59'),
(5, 'Medium', 30.05, 'BUSINESS', '2021-08-16 12:00:39', '2021-11-23 05:27:03'),
(6, 'Large', 40.05, 'BUSINESS', '2021-08-16 12:00:39', '2021-11-23 05:27:08'),
(13, 'Small ', 25.78, 'HOME', '2021-09-30 10:48:51', '2021-11-23 05:26:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `walkways`
--
ALTER TABLE `walkways`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `walkways`
--
ALTER TABLE `walkways`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
