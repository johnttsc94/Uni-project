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

-- --------------------------------------------------------

--
-- Table structure for table `system_user`
--

CREATE TABLE `system_user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(255) DEFAULT NULL,
  `user_lname` varchar(255) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_country` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_cv` varchar(255) DEFAULT NULL,
  `user_cv_size` decimal(4,2) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_facebook` mediumtext DEFAULT NULL,
  `user_twitter` mediumtext DEFAULT NULL,
  `user_profile` longtext DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_language` varchar(255) DEFAULT NULL,
  `user_gender` varchar(5) DEFAULT NULL,
  `user_skill` varchar(255) DEFAULT NULL,
  `user_phone` varchar(50) DEFAULT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` longtext NOT NULL,
  `user_business` int(11) DEFAULT NULL,
  `user_vlink` varchar(255) DEFAULT NULL,
  `user_theme1` varchar(50) DEFAULT 'blue',
  `user_theme2` varchar(50) DEFAULT 'light',
  `user_createdDate` date NOT NULL DEFAULT current_timestamp(),
  `user_trash` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_user`
--

INSERT INTO `system_user` (`user_id`, `user_fname`, `user_lname`, `user_address`, `user_country`, `user_image`, `user_cv`, `user_cv_size`, `user_email`, `user_facebook`, `user_twitter`, `user_profile`, `user_dob`, `user_language`, `user_gender`, `user_skill`, `user_phone`, `user_username`, `user_password`, `user_business`, `user_vlink`, `user_theme1`, `user_theme2`, `user_createdDate`, `user_trash`) VALUES
(1, 'Siah', 'Kah Chuan', 'No.1,  jalan sakeh, taman indah, jalan parit setongkat, 84000, muar, johor', 'Malaysia', 'avatar.png', 'Room Contract.pdf', 0.53, 'kahchuan1911@gmail.com', 'https://www.facebook.com', 'https://www.twitter.com', 'Intern developer with over 5 year\'s experience working in both the public and private sectors. Diplomatic, personable, and adept at managing sensitive situations. Highly organized, self-motivated, and proficient with computers. Looking to boost students’ satisfactions scores for International University. Bachelor\'s degree in communications.', '2005-09-04', 'English, German, French, Chinese,India', 'M', 'Social Media, Marketing, Problem-Solving', '0176226799', 'johnttsc', '49d10b739717d0e2a3f0709feeb2797d', 1, 'http://localhost/fyp/vcard/index.php?id=1', 'blue', 'light', '2023-02-14', '0'),
(2, 'Chong', 'Wei Lun', 'Howling Abyss', 'Runeterra', 'dog.jpg', NULL, 0.59, 'kahchuan1911@gmail.com', 'https://www.facebook.com', 'https://www.twitter.com', 'A good guy', '2022-01-11', 'Chinese, French, English,Malay', 'F', 'Problem solving, Data organization, Data Structure and Algorithm', '012345678', 'chong', '4297f44b13955235245b2497399d7a93', 2, 'http://localhost/fyp/vcard/index.php?id=2', 'green', 'dark', '2023-03-14', '0'),
(3, '', '', '', '', '', '', 0.00, 'kahchuan1911@gmail.com', '', '', '', '0000-00-00', '', '', '', '', 'liew', 'a7aed969c34749dd2f0a9b29193f90a7', NULL, NULL, 'blue', 'light', '2023-03-20', '1'),
(4, '', '', '', '', '', '', 0.00, 'kahchuan1911@gmail.com', '', '', '', '0000-00-00', '', '', '', '', 'liew', 'a7aed969c34749dd2f0a9b29193f90a7', NULL, NULL, 'blue', 'light', '2023-03-20', '1'),
(5, '', '', '', '', '', '', 0.00, 'kahchuan1911@gmail.com', '', '', '', '0000-00-00', '', '', '', '', 'liew', 'a7aed969c34749dd2f0a9b29193f90a7', NULL, NULL, 'blue', 'light', '2023-03-20', '1'),
(6, '', '', '', '', '', '', 0.00, 'kahchuan1911@gmail.com', '', '', '', '0000-00-00', '', '', '', '', 'liew', '070962bd190167ad5756a4bb3fe645d8', NULL, 'http://localhost/fyp/vcard/index.php?id=6', 'blue', 'light', '2023-03-20', '1'),
(7, '', '', '', 'N/A', '', '', 0.00, 'kahchuan1911@gmail.com', '', '', '', '0000-00-00', '', '', '', '', 'test', '4297f44b13955235245b2497399d7a93', NULL, 'http://localhost/fyp/vcard/index.php?id=7', 'blue', 'light', '2023-03-20', '0'),
(8, '', '', '', 'N/A', '404.png', 'API-ACR122U-2.04.pdf', 0.59, 'kahchuan1911@gmail.com', '', '', '', '0000-00-00', '', '', '', '', 'liew', '4297f44b13955235245b2497399d7a93', NULL, 'http://localhost/fyp/vcard/index.php?id=8', 'blue', 'light', '2023-03-21', '1'),
(9, '', '', '', '', 'user.png', NULL, NULL, 'kahchuan1911@gmail.com', '', '', '', '0000-00-00', '', '', '', '', 'liew', '4297f44b13955235245b2497399d7a93', NULL, 'http://localhost/fyp/vcard/index.php?id=9', 'blue', 'light', '2023-04-01', '1'),
(10, '', '', '', '', 'user.png', '', 0.00, 'kahchuan1911@gmail.com', '', '', '', '0000-00-00', '', '', '', '', 'test2', 'a7aed969c34749dd2f0a9b29193f90a7', NULL, 'http://localhost/fyp/vcard/index.php?id=10', 'blue', 'light', '2023-04-01', '1'),
(11, 'Thinesh', 'Ganesan', '', 'N/A', 'IMG_6439.jpg', '', 0.00, 'misthinesh@gmail.com', '', '', '', '1994-01-28', '', 'M', '', '0163741528', 'thinesh281', '4de93544234adffbb681ed60ffcfb941', NULL, 'http://localhost/fyp/vcard/index.php?id=11', 'blue', 'light', '2023-04-27', '0');

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

-- --------------------------------------------------------

--
-- Table structure for table `system_user_feedback`
--

CREATE TABLE `system_user_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_name` varchar(100) DEFAULT NULL,
  `feedback_email` varchar(100) DEFAULT NULL,
  `feedback_subject` varchar(255) DEFAULT NULL,
  `feedback_message` longtext DEFAULT NULL,
  `feedback_status` varchar(5) NOT NULL DEFAULT '0',
  `feedback_replied_message` longtext DEFAULT NULL,
  `feedback_trash` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_user_feedback`
--

INSERT INTO `system_user_feedback` (`feedback_id`, `feedback_name`, `feedback_email`, `feedback_subject`, `feedback_message`, `feedback_status`, `feedback_replied_message`, `feedback_trash`) VALUES
(1, 'Siah', 'kahchuan1911@gmail.com', 'Test ', 'A good thing to  knows', '1', 'Glad to hear that', '1'),
(2, 'Lim', 'kahchuan1911@gmail.com', 'Test2', 'This place is intentionally left blank', '1', 'Testing reply', '0'),
(3, 'Chong', 'kahchuan1911@gmail.com', 'TEST3', 'Not available at the momment', '1', 'Test feedback', '0'),
(4, 'test', 'kahchuan1911@gmail.com', 'TEST', 'It is a testing email', '1', 'Reply of testing email', '0'),
(5, 'Tester', 'kahchuan1911@gmail.com', 'Test feedback', 'Test message', '1', 'Test feedback', '1'),
(6, 'Tester', 'kahchuan1911@gmail.com', 'Test feedback', 'Test message', '0', NULL, '0'),
(7, 'chong', '123@gmail.com', 'nope', 'testing', '0', NULL, '0'),
(8, 'hello', 'kahchuan1911@gmail.com', 'BLANK', 'Dont ask about my email ????', '0', NULL, '0'),
(9, 'Tester', 'kahchuan1911@gmail.com', 'Test feedback', 'Test', '0', NULL, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_admin`
--
ALTER TABLE `system_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `system_admin_otp`
--
ALTER TABLE `system_admin_otp`
  ADD PRIMARY KEY (`otp_id`),
  ADD KEY `otp_admin_id` (`otp_admin_id`);

--
-- Indexes for table `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `system_user_ibfk_1` (`user_business`);

--
-- Indexes for table `system_user_abilities`
--
ALTER TABLE `system_user_abilities`
  ADD PRIMARY KEY (`ab_id`),
  ADD KEY `ab_user_id` (`ab_user_id`);

--
-- Indexes for table `system_user_business`
--
ALTER TABLE `system_user_business`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `system_user_edu`
--
ALTER TABLE `system_user_edu`
  ADD PRIMARY KEY (`edu_id`),
  ADD KEY `edu_user_id` (`edu_user_id`);

--
-- Indexes for table `system_user_exp`
--
ALTER TABLE `system_user_exp`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `exp_user_id` (`exp_user_id`);

--
-- Indexes for table `system_user_feedback`
--
ALTER TABLE `system_user_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_admin`
--
ALTER TABLE `system_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `system_admin_otp`
--
ALTER TABLE `system_admin_otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `system_user`
--
ALTER TABLE `system_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `system_user_abilities`
--
ALTER TABLE `system_user_abilities`
  MODIFY `ab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `system_user_business`
--
ALTER TABLE `system_user_business`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_user_edu`
--
ALTER TABLE `system_user_edu`
  MODIFY `edu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `system_user_exp`
--
ALTER TABLE `system_user_exp`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `system_user_feedback`
--
ALTER TABLE `system_user_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `system_admin_otp`
--
ALTER TABLE `system_admin_otp`
  ADD CONSTRAINT `system_admin_otp_ibfk_1` FOREIGN KEY (`otp_admin_id`) REFERENCES `system_admin` (`admin_id`);

--
-- Constraints for table `system_user`
--
ALTER TABLE `system_user`
  ADD CONSTRAINT `system_user_ibfk_1` FOREIGN KEY (`user_business`) REFERENCES `system_user_business` (`business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `system_user_abilities`
--
ALTER TABLE `system_user_abilities`
  ADD CONSTRAINT `system_user_abilities_ibfk_1` FOREIGN KEY (`ab_user_id`) REFERENCES `system_user` (`user_id`);

--
-- Constraints for table `system_user_edu`
--
ALTER TABLE `system_user_edu`
  ADD CONSTRAINT `system_user_edu_ibfk_1` FOREIGN KEY (`edu_user_id`) REFERENCES `system_user` (`user_id`);

--
-- Constraints for table `system_user_exp`
--
ALTER TABLE `system_user_exp`
  ADD CONSTRAINT `system_user_exp_ibfk_1` FOREIGN KEY (`exp_user_id`) REFERENCES `system_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
