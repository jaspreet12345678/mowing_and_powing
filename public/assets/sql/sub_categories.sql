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
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `type` int NOT NULL DEFAULT '0' COMMENT '1=>commercial,2=>residential',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `image`, `name`, `price`, `category_id`, `type`, `created_at`, `updated_at`) VALUES
(34, 'default.png', 'Coupe', 31.22, '2', 0, '2021-11-13 23:51:32', '2021-11-26 05:07:49'),
(35, 'default.png', 'Hatchback', 35.96, '2', 0, '2021-11-13 23:53:31', '2021-11-29 05:43:14'),
(36, 'default.png', 'Minivan', 40.00, '2', 0, '2021-11-13 23:53:54', '2021-11-13 23:55:07'),
(37, 'default.png', 'Sedan', 30.00, '2', 0, '2021-11-13 23:54:09', '2021-11-13 23:54:09'),
(38, 'default.png', 'Station Wagon', 40.00, '2', 0, '2021-11-13 23:54:37', '2021-11-13 23:55:01'),
(39, 'default.png', 'SUV', 40.00, '2', 0, '2021-11-13 23:54:51', '2021-11-13 23:54:51'),
(40, 'default.png', 'Truck', 40.00, '2', 0, '2021-11-13 23:55:56', '2021-11-13 23:55:56'),
(41, 'default.png', 'Small Car', 30.00, '2', 0, '2021-11-13 23:56:10', '2021-11-13 23:56:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
