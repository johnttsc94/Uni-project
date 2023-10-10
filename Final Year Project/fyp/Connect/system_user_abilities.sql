-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 05:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_user_abilities`
--

CREATE TABLE `system_user_abilities` (
  `ab_id` int(11) NOT NULL,
  `ab_user_id` int(11) DEFAULT NULL,
  `ab_title` varchar(255) DEFAULT NULL,
  `ab_index` int(5) DEFAULT NULL,
  `ab_trash` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_user_abilities`
--

INSERT INTO `system_user_abilities` (`ab_id`, `ab_user_id`, `ab_title`, `ab_index`, `ab_trash`) VALUES
(1, 1, 'Computer Programming', 70, '1'),
(2, 1, 'System Administrator and Maintenance', 100, '1'),
(3, 1, 'Computer Programming', 100, '0'),
(4, 1, 'System Administrator and Maintenance', 40, '1'),
(5, 1, 'System Admin', 10, '1'),
(6, 1, 'System Administrator and Maintenance', 40, '1'),
(7, 1, 'System Administrator and Maintenance', 40, '1'),
(8, 1, 'System Administrator and Maintenance', 40, '1'),
(9, 1, 'System Admin', 20, '0'),
(10, 36, 'Computer Programming', 40, '1'),
(11, 36, 'System Administrator and Maintenance', 60, '1'),
(12, 2, 'System Analysis and Design', 100, '0'),
(13, 2, 'Data Mining', 90, '1'),
(14, 2, 'Data Structure and Algorithm', 60, '0'),
(15, 2, 'HI', 70, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_user_abilities`
--
ALTER TABLE `system_user_abilities`
  ADD PRIMARY KEY (`ab_id`),
  ADD KEY `ab_user_id` (`ab_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_user_abilities`
--
ALTER TABLE `system_user_abilities`
  MODIFY `ab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `system_user_abilities`
--
ALTER TABLE `system_user_abilities`
  ADD CONSTRAINT `system_user_abilities_ibfk_1` FOREIGN KEY (`ab_user_id`) REFERENCES `system_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
