-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 02:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_detail`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userdata`
--

CREATE TABLE `tbl_userdata` (
  `id` int(11) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_confirm_pass` varchar(15) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_course` varchar(255) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_disable` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userdata`
--

INSERT INTO `tbl_userdata` (`id`, `user_firstname`, `user_email`, `user_password`, `user_confirm_pass`, `user_phone`, `user_address`, `user_course`, `user_gender`, `user_disable`) VALUES
(84, 'Hassan Khalid', '963@gmail.com', '123456789', '123456789', '33333333333', 'jinnah Road Gujranwala', 'MYSQL', 'Male', 'disable'),
(92, 'Text', 'test@gmail.com', '123456789', '123456789', '03177638978', 'Kaccha Fattomand Road', 'HTML', 'Male', ''),
(94, 'Hamza', 'hamza@gmail.com', '123456789', '123456789', '03177638978', 'Kaccha Fattomand Road', 'HTML', 'Male', ''),
(130, 'Baba', 'baba@mail.com', '123456789', '123456789', '03269857415', 'DFG DFG DFHG FHDG FGH', 'CSS', 'Female', ''),
(131, 'Arslan', '123ad@gmail.com', '123456789', '123456789', '03629587415', 'asjk dhsdfh sdfg', 'CSS', 'Male', ''),
(132, 'Zamana', 'zaman@gmail.com', '123456789', '123456789', '03698521475', 'sdf gsdfg dsfg', 'HTML', 'Other', ''),
(133, 'Arslan', '123ewdf@gmail.com', '123456789', '123456789', '09693258740', 'df dsfg df', 'CSS', 'Male', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_userdata`
--
ALTER TABLE `tbl_userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_userdata`
--
ALTER TABLE `tbl_userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
