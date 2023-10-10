-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 05:01 AM
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
-- Table structure for table `system_admin_otp`
--

CREATE TABLE `system_admin_otp` (
  `otp_id` int(11) NOT NULL,
  `otp_number` varchar(10) NOT NULL,
  `otp_expired_time` datetime NOT NULL,
  `otp_admin_id` int(11) NOT NULL,
  `otp_trash` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_admin_otp`
--

INSERT INTO `system_admin_otp` (`otp_id`, `otp_number`, `otp_expired_time`, `otp_admin_id`, `otp_trash`) VALUES
(1, '552394', '2023-04-04 15:17:50', 1, '1'),
(2, '979800', '2023-04-05 18:17:41', 1, '1'),
(3, '227060', '2023-04-05 20:36:10', 1, '1'),
(4, '558539', '2023-04-06 09:00:21', 1, '1'),
(5, '255690', '2023-04-11 09:14:04', 1, '1'),
(6, '803344', '2023-04-20 15:41:01', 1, '1'),
(7, '738658', '2023-04-27 12:57:29', 1, '1'),
(8, '252103', '2023-04-27 20:26:00', 1, '1'),
(9, '309885', '2023-05-08 20:07:57', 1, '1'),
(10, '347405', '2023-06-21 09:53:25', 1, '1'),
(11, '455582', '2023-06-21 10:17:32', 1, '1'),
(12, '277169', '2023-06-21 10:36:19', 1, '1'),
(13, '147069', '2023-06-21 10:57:04', 1, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_admin_otp`
--
ALTER TABLE `system_admin_otp`
  ADD PRIMARY KEY (`otp_id`),
  ADD KEY `otp_admin_id` (`otp_admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_admin_otp`
--
ALTER TABLE `system_admin_otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `system_admin_otp`
--
ALTER TABLE `system_admin_otp`
  ADD CONSTRAINT `system_admin_otp_ibfk_1` FOREIGN KEY (`otp_admin_id`) REFERENCES `system_admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
