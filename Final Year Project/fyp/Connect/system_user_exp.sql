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
-- Table structure for table `system_user_exp`
--

CREATE TABLE `system_user_exp` (
  `exp_id` int(11) NOT NULL,
  `exp_user_id` int(11) DEFAULT NULL,
  `exp_title` varchar(255) NOT NULL,
  `exp_start_date` date DEFAULT NULL,
  `exp_end_date` date DEFAULT NULL,
  `exp_present` varchar(5) DEFAULT NULL,
  `exp_institute` varchar(255) DEFAULT NULL,
  `exp_description` longtext DEFAULT NULL,
  `exp_trash` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_user_exp`
--

INSERT INTO `system_user_exp` (`exp_id`, `exp_user_id`, `exp_title`, `exp_start_date`, `exp_end_date`, `exp_present`, `exp_institute`, `exp_description`, `exp_trash`) VALUES
(1, 1, 'Web Design & Development Team Leader', '2022-10-09', '0000-00-00', '0', 'IPS Software Sdn. Bhd', '', '1'),
(2, 1, 'Java Senior Developer', '2022-10-11', '0000-00-00', '1', 'IPS Software Sdn. Bhd', '', '1'),
(3, 1, 'C++ Senior Developer', '2022-10-18', '0000-00-00', '0', 'IPS Software Sdn.Bhd', '', '1'),
(4, 1, 'Java Senior Developer', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(5, 1, 'Java Senior Developer', '2023-03-22', '0000-00-00', '1', '', '', '1'),
(6, 1, 'Java Senior Developer', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(7, 1, 'Java Senior Developer', '0000-00-00', '0000-00-00', '1', '', '', '1'),
(8, 1, 'Web Design & Development Team Leader', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(9, 1, 'Web Design & Development Team Leader', '2018-10-03', '2020-06-03', '0', 'Inspired software development company', 'Cozy environment', '0'),
(10, 1, 'Security Analyst', '2021-01-11', '0000-00-00', '1', 'Defender Coop', 'Well known company in industry', '0'),
(11, 36, 'Web Design & Development Team Leader', '2023-03-16', '0000-00-00', '0', 'one', 'one', '1'),
(12, 36, 'Java Senior Developer', '2023-03-29', '0000-00-00', '1', 'two', 'two', '1'),
(13, 36, 'C++ Senior Developer', '2023-03-27', '2023-03-29', '0', 'three', 'three', '1'),
(14, 36, 'Web Design & Development Team Leader', '2023-03-02', '0000-00-00', '0', '', '', '1'),
(15, 36, 'Java Senior Developer', '2023-03-15', '2023-03-17', '0', '', '', '1'),
(16, 36, 'C++ Senior Developer', '2023-03-22', '0000-00-00', '0', '', '', '1'),
(17, 36, 'Java Senior Developer', '2023-03-25', '2023-03-30', '0', '', '', '1'),
(18, 36, 'Java Senior Developer', '2023-03-10', '0000-00-00', '0', '', '', '1'),
(19, 36, 'Web Design & Development Team Leader', '2023-03-16', '2023-03-17', '0', '', '', '1'),
(20, 36, 'Web Design & Development Team Leader', '2023-03-20', '0000-00-00', '1', '', '', '1'),
(21, 36, 'Java Senior Developer', '2023-03-29', '2023-03-30', '0', '', '', '1'),
(22, 36, 'Web Design & Development Team Leader', '2023-03-23', '0000-00-00', '1', '', '', '1'),
(23, 36, 'Java Senior Developer', '2023-03-25', '2023-03-27', '0', '', '', '1'),
(24, 36, 'Web Design & Development Team Leader', '2023-03-15', '0000-00-00', '0', '', '', '1'),
(25, 36, 'Java Senior Developer', '2023-03-17', '2023-03-20', '0', '', '', '1'),
(26, 36, 'Web Design & Development Team Leader', '2023-03-08', '0000-00-00', '', '', '', '1'),
(27, 36, 'Java Senior Developer', '2023-03-26', '2023-03-30', '', '', '', '1'),
(28, 36, 'Web Design & Development Team Leader', '2023-03-08', '0000-00-00', '0', '', '', '0'),
(29, 36, 'Web Design & Development Team Leader', '2023-03-08', '0000-00-00', '', '', '', '1'),
(30, 2, 'Java Senior Developer', '2023-03-01', '0000-00-00', '0', 'Inspired software development company', '', '0'),
(31, 2, 'Data Structure Programmer', '2023-03-23', '0000-00-00', '1', 'Tree Builder Coop', '', '0'),
(32, 2, 'IDK', '0000-00-00', '0000-00-00', '0', '', '', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_user_exp`
--
ALTER TABLE `system_user_exp`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `exp_user_id` (`exp_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_user_exp`
--
ALTER TABLE `system_user_exp`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `system_user_exp`
--
ALTER TABLE `system_user_exp`
  ADD CONSTRAINT `system_user_exp_ibfk_1` FOREIGN KEY (`exp_user_id`) REFERENCES `system_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
