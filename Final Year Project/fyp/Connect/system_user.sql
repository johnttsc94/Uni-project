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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `system_user_ibfk_1` (`user_business`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_user`
--
ALTER TABLE `system_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `system_user`
--
ALTER TABLE `system_user`
  ADD CONSTRAINT `system_user_ibfk_1` FOREIGN KEY (`user_business`) REFERENCES `system_user_business` (`business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
