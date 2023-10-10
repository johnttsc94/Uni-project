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
-- Table structure for table `system_user_edu`
--

CREATE TABLE `system_user_edu` (
  `edu_id` int(11) NOT NULL,
  `edu_user_id` int(11) DEFAULT NULL,
  `edu_title` varchar(255) NOT NULL,
  `edu_start_date` date DEFAULT NULL,
  `edu_end_date` date DEFAULT NULL,
  `edu_present` varchar(5) DEFAULT NULL,
  `edu_institute` varchar(255) DEFAULT NULL,
  `edu_description` longtext DEFAULT NULL,
  `edu_trash` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_user_edu`
--

INSERT INTO `system_user_edu` (`edu_id`, `edu_user_id`, `edu_title`, `edu_start_date`, `edu_end_date`, `edu_present`, `edu_institute`, `edu_description`, `edu_trash`) VALUES
(1, 1, 'Primary School', '2022-10-05', '0000-00-00', '0', 'SJK (C) Pei Yang', '', '1'),
(2, 1, 'Secondary School', '2022-10-07', '0000-00-00', '1', 'SMK AT ANDREW', 'nice st', '1'),
(3, 1, 'Tertiary Education', '2022-10-01', '0000-00-00', '0', '', 'a good place to learn', '1'),
(4, 1, '', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(5, 1, 'Primary School', '2023-02-08', '0000-00-00', '0', 'SJK (C) Pei Yang', 'test', '1'),
(6, 1, 'Secondary School', '2023-02-02', '0000-00-00', '1', 'SMK AT ANDREW', '', '1'),
(7, 1, 'Primary School', '2023-02-01', '0000-00-00', '1', 'hi', '', '1'),
(8, NULL, 'Secondary School', '2023-02-01', '2023-02-10', '1', 'hi', '', '0'),
(9, NULL, 'Secondary School', '2023-02-09', '0000-00-00', '0', 'bye', '', '0'),
(10, NULL, 'Tertiary Education', '2023-02-28', NULL, '1', 'test', '', '0'),
(11, NULL, 'Secondary School', '2023-02-09', '0000-00-00', '0', 'bye', '', '0'),
(12, NULL, 'Tertiary Education', '2023-02-28', NULL, '1', 'test', '', '0'),
(13, NULL, 'Secondary School', '2023-02-09', '0000-00-00', '0', 'bye', '', '0'),
(14, NULL, 'Tertiary Education', '2023-02-28', NULL, '1', 'test', '', '0'),
(15, NULL, 'Secondary School', '2023-02-07', '0000-00-00', '0', 'bye', '', '0'),
(16, NULL, 'Tertiary Education', '2023-02-28', NULL, '1', 'test', '', '0'),
(17, NULL, 'Secondary School', '2023-02-07', '0000-00-00', '0', 'bye', '', '0'),
(18, NULL, 'Tertiary Education', '2023-02-28', NULL, '1', 'test', '', '0'),
(19, NULL, 'Secondary School', '2023-02-07', '0000-00-00', '0', 'bye', '', '0'),
(20, NULL, 'Tertiary Education', '2023-02-28', NULL, '1', 'test', '', '0'),
(21, 1, 'Secondary School', '2023-02-07', '2023-02-09', '0', 'bye', '', '1'),
(22, 1, 'Tertiary Education', '2023-02-28', '0000-00-00', '1', 'test', '', '1'),
(23, 1, 'Primary School', '2023-02-02', '0000-00-00', '1', '', '', '1'),
(24, 1, 'Secondary School', '2023-02-09', '0000-00-00', '0', '', '', '1'),
(25, 1, 'Primary School', '2023-02-01', '0000-00-00', '1', '', '', '1'),
(26, 1, 'Secondary School', '2023-02-01', '0000-00-00', '1', '', '', '1'),
(27, 1, 'Tertiary Education', '2023-02-03', '0000-00-00', '0', '', '', '1'),
(28, 1, 'Secondary School', '2023-02-24', '0000-00-00', '0', '', '', '1'),
(29, 1, 'Secondary School', '2023-02-22', '0000-00-00', '0', '', '', '1'),
(30, 1, 'Primary School', '2023-02-16', '0000-00-00', '0', '', '', '1'),
(31, 1, 'Secondary School', '0000-00-00', '0000-00-00', '1', '', '', '1'),
(32, 1, 'Tertiary Education', '2023-02-06', '0000-00-00', '0', 'SJK (C) Pei Yang', '', '1'),
(33, 1, 'Secondary School', '2023-02-08', '0000-00-00', '1', '', '', '1'),
(34, 1, 'Primary School', '2023-02-09', '0000-00-00', '0', '', '', '1'),
(35, 1, 'Secondary School', '2023-02-02', '0000-00-00', '0', '', '', '1'),
(36, 1, 'Primary School', '2023-02-02', '0000-00-00', '0', '', '', '1'),
(37, 1, 'Secondary School', '2023-02-03', '0000-00-00', '0', '', '', '1'),
(38, 1, 'Primary School', '2023-02-08', '0000-00-00', '0', '', '', '1'),
(39, 1, 'Secondary School', '2023-02-15', '0000-00-00', '1', '', '', '1'),
(40, 1, 'Primary School', '0000-00-00', '0000-00-00', '1', '', '', '1'),
(41, 1, 'Secondary School', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(42, 1, 'Tertiary Education', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(43, 1, 'Secondary School', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(44, 1, 'Primary School', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(45, 1, 'Primary School', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(46, 1, 'Tertiary Education', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(47, 1, 'Primary School', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(48, 1, 'Secondary School', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(49, 1, 'Secondary School', '2023-03-09', '0000-00-00', '0', '', '', '1'),
(50, 1, 'Secondary School', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(51, 1, 'Tertiary Education', '0000-00-00', '0000-00-00', '0', '', '', '1'),
(52, 1, 'Primary School', '0000-00-00', '0000-00-00', '1', '', '', '1'),
(53, 1, 'Secondary School', '2023-03-10', '0000-00-00', '1', 'good education', 'test', '1'),
(54, 1, 'Primary School', '2023-03-22', '0000-00-00', '1', '', '', '1'),
(55, 1, 'Tertiary Education', '2023-03-08', '0000-00-00', '0', '', '', '1'),
(56, 1, 'Primary School', '2023-03-09', '0000-00-00', '0', '', '', '1'),
(57, 1, 'Secondary School', '2023-03-23', '2023-03-14', '1', '', '', '1'),
(58, 1, 'Primary School', '2023-03-08', '0000-00-00', '1', '', '', '1'),
(59, 1, 'Secondary School', '2023-03-10', '2023-03-14', '0', '', '', '1'),
(60, 1, 'Tertiary Education', '2023-03-23', '0000-00-00', '0', '', '', '1'),
(61, 36, 'Primary School', '2023-01-01', '0000-00-00', '1', 'one', 'one', '1'),
(62, 36, 'Secondary School', '2023-03-15', '2023-03-28', '0', 'two', 'two', '1'),
(63, 36, 'Tertiary Education', '2023-03-29', '0000-00-00', '1', 'three', 'three', '1'),
(64, 36, 'quad', '2023-03-15', '0000-00-00', '0', 'four', 'four', '1'),
(65, 36, 'Primary School', '2023-03-09', '0000-00-00', '0', 'one', 'one', '1'),
(66, 36, 'Secondary School', '2023-03-16', '0000-00-00', '0', 'two', 'two', '1'),
(67, 36, 'Primary School', '2023-03-09', '0000-00-00', '1', 'one', 'one', '1'),
(68, 36, 'Secondary School', '2023-03-22', '0000-00-00', '0', 'two', 'two', '1'),
(69, 36, 'Primary School', '2023-03-09', '0000-00-00', '0', '', '', '1'),
(70, 36, 'Secondary School', '2023-03-22', '0000-00-00', '0', '', '', '1'),
(71, 36, 'Primary School', '2023-03-15', '0000-00-00', '0', '', '', '1'),
(72, 36, 'Secondary School', '2023-03-22', '0000-00-00', '0', '', '', '1'),
(73, 36, 'Primary School', '2023-03-17', '0000-00-00', '0', '', '', '1'),
(74, 36, 'Secondary School', '2023-03-24', '0000-00-00', '0', '', '', '1'),
(75, 36, 'Primary School', '2023-03-02', '0000-00-00', '0', '', '', '1'),
(76, 36, 'Secondary School', '2023-03-15', '0000-00-00', '0', '', '', '1'),
(77, 36, 'Primary School', '2023-03-09', '0000-00-00', '0', '', '', '1'),
(78, 36, 'Secondary School', '2023-03-15', '0000-00-00', '0', '', '', '1'),
(79, 36, 'Primary School', '2023-03-16', '0000-00-00', '0', '', '', '1'),
(80, 36, 'Secondary School', '2023-03-26', '2023-03-17', '0', '', '', '1'),
(81, 36, 'Primary School', '2023-03-08', '0000-00-00', '0', '', '', '1'),
(82, 36, 'Secondary School', '2023-03-20', '2023-03-25', '0', '', '', '1'),
(83, 36, 'Primary School', '2023-03-07', '0000-00-00', '0', '', '', '1'),
(84, 36, 'Secondary School', '2023-03-23', '2023-03-29', '0', '', '', '1'),
(85, 36, 'Primary School', '2023-03-15', '0000-00-00', '1', '', '', '1'),
(86, 36, 'Secondary School', '2023-03-29', '0000-00-00', '0', '', '', '1'),
(87, 36, 'Primary School', '2023-03-16', '0000-00-00', '1', '', '', '1'),
(88, 36, 'Secondary School', '2023-03-30', '2023-03-30', '0', '', '', '1'),
(89, 36, 'Primary School', '2023-03-16', '0000-00-00', '0', '', '', '1'),
(90, 36, 'Secondary School', '2023-03-20', '2023-03-22', '0', '', '', '1'),
(91, 36, 'Primary School', '2023-03-15', '0000-00-00', '1', '', '', '1'),
(92, 36, 'Secondary School', '2023-03-21', '2023-03-28', '0', '', '', '1'),
(93, 36, 'Primary School', '2023-03-01', '0000-00-00', '0', '', '', '1'),
(94, 36, 'Secondary School', '2023-03-14', '0000-00-00', '0', '', '', '1'),
(95, 36, 'Primary School', '2023-03-16', '0000-00-00', '', '', '', '1'),
(96, 36, 'Primary School', '2023-03-16', '0000-00-00', '', '', '', '1'),
(97, 36, 'Primary School', '2023-03-15', '0000-00-00', '', '', '', '1'),
(98, 36, 'Secondary School', '2023-03-26', '2023-03-30', '', '', '', '1'),
(99, 36, 'Primary School', '2023-03-07', '0000-00-00', '0', '', '', '1'),
(100, 36, 'Secondary School', '2023-03-22', '2023-03-25', '0', '', '', '1'),
(101, 36, 'Primary School', '2023-03-15', '0000-00-00', '1', '', '', '1'),
(102, 36, 'Secondary School', '2023-03-20', '2023-03-25', '0', '', '', '1'),
(103, 36, 'Primary School', '2023-03-03', '0000-00-00', '', '', '', '1'),
(104, 36, 'Secondary School', '2023-03-16', '2023-03-18', '', '', '', '1'),
(105, 36, 'Primary School', '2023-03-01', '0000-00-00', '0', '', '', '1'),
(106, 36, 'Secondary School', '2023-03-22', '2023-03-30', '0', '', '', '1'),
(107, 36, 'Primary School', '2023-03-04', '0000-00-00', '', '', '', '1'),
(108, 36, 'Secondary School', '2023-03-16', '2023-03-18', '0', '', '', '0'),
(109, 36, 'Primary School', '2023-03-15', '2023-03-18', '0', '', '', '0'),
(110, 2, 'Primary School', '2015-01-03', '2020-11-23', '0', 'SJK (C) Pei Yang', 'comfortable environment', '1'),
(111, 2, 'Secondary School', '2021-01-04', '0000-00-00', '', 'SMK AT ANDREW', '', '0'),
(112, 2, 'Primary School', '2023-03-23', '2023-03-28', '', '', '', '0'),
(113, 2, 'Kindergarten', '0000-00-00', '0000-00-00', '', '', '', '0'),
(114, 1, 'Secondary School', '2013-01-01', '2018-12-31', '', 'SMK ST. ANDREW', 'teachers are very friendly', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_user_edu`
--
ALTER TABLE `system_user_edu`
  ADD PRIMARY KEY (`edu_id`),
  ADD KEY `edu_user_id` (`edu_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_user_edu`
--
ALTER TABLE `system_user_edu`
  MODIFY `edu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `system_user_edu`
--
ALTER TABLE `system_user_edu`
  ADD CONSTRAINT `system_user_edu_ibfk_1` FOREIGN KEY (`edu_user_id`) REFERENCES `system_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
