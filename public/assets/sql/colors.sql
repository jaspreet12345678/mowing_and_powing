-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2022 at 07:55 PM
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
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `color_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `color_code`, `created_at`, `updated_at`) VALUES
(10, 'black', '#1c0303', '2021-09-03 06:40:36', '2021-09-03 06:56:28'),
(6338, 'Charcoal', '#585151', '2021-11-13 23:57:30', '2021-11-13 23:57:30'),
(6339, 'Grey', '#aaa7a7', '2021-11-13 23:57:43', '2021-11-13 23:57:43'),
(6340, 'Silver', '#b0b0b0', '2021-11-13 23:58:06', '2021-11-13 23:58:06'),
(6341, 'White', '#fafafa', '2021-11-13 23:58:47', '2021-11-13 23:58:47'),
(6342, 'Off Whit', '#f0f0f0', '2021-11-14 00:00:15', '2021-11-14 00:00:15'),
(6343, 'Tan', '#fdbd81', '2021-11-14 00:01:00', '2021-11-14 00:01:00'),
(6344, 'Beige', '#efa134', '2021-11-14 00:01:31', '2021-11-14 00:01:31'),
(6345, 'Yellow', '#fff714', '2021-11-14 00:01:41', '2021-11-14 00:01:41'),
(6346, 'gold', '#cec01c', '2021-11-14 00:02:04', '2021-11-14 00:02:04'),
(6347, 'Brown', '#d36d0d', '2021-11-14 00:02:19', '2021-11-14 00:02:19'),
(6348, 'Brown', '#d36d0d', '2021-11-14 00:02:19', '2021-11-14 00:02:19'),
(6349, 'Orange', '#ffbb00', '2021-11-14 00:02:58', '2021-11-14 00:02:58'),
(6350, 'Red', '#ed0707', '2021-11-14 00:03:09', '2021-11-14 00:03:09'),
(6351, 'Burgandy', '#ad5c00', '2021-11-14 00:03:31', '2021-11-14 00:03:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6355;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
