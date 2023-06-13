-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2023 at 12:30 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `old-moinplowing`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `question` varchar(500) NOT NULL,
  `category` int NOT NULL,
  `type` int NOT NULL COMMENT '1=>feedback 2=>report',
  `is_deleted` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `category`, `type`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Was all steps completed on this job', 0, 0, 0, '2021-08-26 05:56:08', '2021-11-17 06:19:09'),
(23, 'Was front , back an all side lawns cut', 1, 2, 1, '2021-10-08 12:13:13', '2022-01-13 06:45:44'),
(24, 'Did you close the gate ?', 1, 0, 0, '2021-10-08 12:13:27', '2022-03-31 17:18:57'),
(26, 'Did you blow or sweep up steps , driveway , sidewalk , street and all concrete areas of grass and debris?', 1, 2, 0, '2021-10-08 12:14:14', '2021-10-12 12:24:19'),
(17, 'Where all jobs notes completed ? ', 2, 2, 0, '2021-10-07 06:30:30', '2021-11-14 00:04:50'),
(29, 'Were all task requested by customer completed ? ( Only pertaining to Mowing)', 1, 0, 0, '2021-10-08 21:01:47', '2022-03-31 17:23:19'),
(30, 'Did you neatly mow all grass areas ? ( Front , Back , and any side lawns ) ', 1, 0, 0, '2021-10-08 21:02:18', '2022-03-31 17:22:09'),
(31, 'Did you edge  all grass areas including front, back, and side lawns with string trimmer? ', 1, 0, 0, '2021-10-08 21:02:58', '2022-03-31 17:21:17'),
(32, 'Did you weed trim the perimeter of front , side, and back lawn and around fences, trees, poles etc ?	', 1, 0, 0, '2021-10-08 21:03:11', '2022-03-31 17:19:45'),
(33, 'Did you clear the snow from required areas ? ', 2, 0, 0, '2021-10-08 21:05:03', '2021-11-14 00:04:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
