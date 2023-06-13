-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2022 at 04:37 PM
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
-- Table structure for table `driveways`
--

CREATE TABLE `driveways` (
  `id` int NOT NULL,
  `on_first_6_cars` double(10,2) NOT NULL COMMENT 'number of cars(6) fit in, 6 cars',
  `on_more_than_6_cars` double(10,2) NOT NULL COMMENT 'this is more then 6 cars',
  `type` varchar(255) NOT NULL COMMENT '	CAR,HOME,BUSINESS	',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driveways`
--

INSERT INTO `driveways` (`id`, `on_first_6_cars`, `on_more_than_6_cars`, `type`, `created_at`, `updated_at`) VALUES
(1, 65.00, 15.00, 'HOME', '2021-08-16 07:58:51', '2022-02-08 04:57:31'),
(2, 150.00, 30.00, 'BUSINESS', '2021-08-16 07:58:51', '2022-02-03 19:47:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driveways`
--
ALTER TABLE `driveways`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driveways`
--
ALTER TABLE `driveways`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
