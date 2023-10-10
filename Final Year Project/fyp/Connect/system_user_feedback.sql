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
-- Indexes for table `system_user_feedback`
--
ALTER TABLE `system_user_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_user_feedback`
--
ALTER TABLE `system_user_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
