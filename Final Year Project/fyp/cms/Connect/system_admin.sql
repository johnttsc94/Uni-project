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
-- Table structure for table `system_admin`
--

CREATE TABLE `system_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` longtext NOT NULL,
  `admin_fullname` varchar(255) NOT NULL,
  `admin_contact` varchar(30) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_created_date` date NOT NULL DEFAULT current_timestamp(),
  `admin_trash` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_admin`
--

INSERT INTO `system_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_fullname`, `admin_contact`, `admin_email`, `admin_created_date`, `admin_trash`) VALUES
(1, 'kahchuan', '4297f44b13955235245b2497399d7a93', 'Siah Kah Chuan', '+6017 622 6799', 'kahchuan1911@gmail.com', '2022-08-27', '0'),
(2, 'leeabc', '4297f44b13955235245b2497399d7a93', '', '', 'kahchuan1911@gmail.com', '2023-02-27', '1'),
(3, 'lee', '4297f44b13955235245b2497399d7a93', '', '', 'kahchuan1911@gmail.com', '2023-02-27', '1'),
(4, 'lee', '4297f44b13955235245b2497399d7a93', '', '', 'kahchuan1911@gmail.com', '2023-02-27', '1'),
(5, 'lee', '4297f44b13955235245b2497399d7a93', '', '', 'kahchuan1911@gmail.com', '2023-03-08', '1'),
(6, 'lee', '4297f44b13955235245b2497399d7a93', '', '', 'kahchuan1911@gmail.com', '2023-03-08', '1'),
(7, 'lee', '4297f44b13955235245b2497399d7a93', '', '', 'kahchuan1911@gmail.com', '2023-03-08', '1'),
(8, 'lee', '4297f44b13955235245b2497399d7a93', 'Lee Fil', '+6012 345 6789', 'kahchuan1911@gmail.com', '2023-03-08', '1'),
(9, 'leeabc', '4297f44b13955235245b2497399d7a93', '', '', 'kahchuan1911@gmail.com', '2023-03-08', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_admin`
--
ALTER TABLE `system_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_admin`
--
ALTER TABLE `system_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
