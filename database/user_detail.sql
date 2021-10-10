-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 08:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

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
  `user_gender` varchar(10) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `user_disable` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userdata`
--

INSERT INTO `tbl_userdata` (`id`, `user_firstname`, `user_email`, `user_password`, `user_confirm_pass`, `user_phone`, `user_address`, `user_gender`, `user_status`, `user_disable`) VALUES
(69, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(71, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(72, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(73, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(74, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(75, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(77, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(78, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(79, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(81, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(82, ' Shahab ud din ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' HTML ', ' disable '),
(83, 'Hassan Khalid', 'mughalarsla996@gmail.com', '123456789', '321654987', '03177638978', 'Fattomand', 'Female', 'Javascript', ''),
(84, 'Hassan Khalid', 'mughalarsla996@gmail.com', '123456789', '321654987', '03177638978', 'Fattomand', 'Female', 'Javascript', ''),
(85, 'Ehsan Ullah', 'mughalarslan996@gmail.com', '123456789', '123456789', '03177638978', 'Kaccha Fattomand Road', 'Male', 'JAVASCRIPT', ''),
(86, '  Ilyas ', ' mughalarslan996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Female ', ' CSS ', ' disable '),
(87, '     Muskan     ', ' muskan@gmail.com ', '     987654321     ', '     987654321 ', '     03049762436     ', '     Kaccha Fattomand Road     ', ' Female ', ' HTML ', ' disable '),
(88, ' Ilyas', 'mughalarslan996@gmail.com', '123456789', '123456789', '03177638978', 'Kaccha Fattomand Road', 'Female', 'CSS', 'disable'),
(89, ' Hassan Khalid ', ' mughalarsla996@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Fattomand ', ' Male ', ' HTML', ' disable '),
(90, 'Hassan Khalid', 'mughalarsla996@gmail.com', '123456789', '321654987', '03177638978', 'Fattomand', 'Female', 'Javascript', ''),
(91, ' aaa ', ' aaa@gmail.com ', ' 123456789 ', ' 123456789 ', ' 03177638978 ', ' Kaccha Fattomand Road ', ' Male ', ' CSS ', ' disable '),
(92, ' text ', ' test@gmail.com ', ' 123456789', ' 123456789', ' 03177638978', 'Kaccha Fattomand Road', 'Male', 'HTML', 'disable'),
(93, ' testtwo  ', ' aaatest@gmail.com ', ' 123456789  ', ' 123456789  ', ' 03177638978  ', ' Kaccha Fattomand Road  ', ' Male ', ' PHP ', ' disable '),
(94, 'hamza', 'hamza@gmail.com', '123456789', '123456789', '03177638978', 'Kaccha Fattomand Road', 'Male', 'HTML', 'disable'),
(95, 'Muhammad Arslan', 'mughalarslan996@gmail.com', '123456789', '123456789', '03177638978', 'Kaccha Fattomand Road', 'Male', 'HTML', 'active'),
(96, 'Muhammad Ilyas', 'mughalarslan996@gmail.com', '123456789', '123456789', '03177638978', 'Kaccha Fattomand Road', 'Male', 'JAVASCRIPT', 'active');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
