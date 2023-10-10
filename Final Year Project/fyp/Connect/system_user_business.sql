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
-- Table structure for table `system_user_business`
--

CREATE TABLE `system_user_business` (
  `business_id` int(11) NOT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `business_trash` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_user_business`
--

INSERT INTO `system_user_business` (`business_id`, `business_name`, `business_trash`) VALUES
(1, 'Accounting', '0'),
(2, 'IT & Software', '0'),
(3, 'Marketing', '0'),
(4, 'Banking', '0'),
(5, 'Manufacturing', '0'),
(6, 'Servicing', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_user_business`
--
ALTER TABLE `system_user_business`
  ADD PRIMARY KEY (`business_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_user_business`
--
ALTER TABLE `system_user_business`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
