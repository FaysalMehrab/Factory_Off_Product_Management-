-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 07:00 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brothers`
--

-- --------------------------------------------------------

--
-- Table structure for table `available`
--

CREATE TABLE `available` (
  `id` int(255) NOT NULL,
  `board_name` varchar(255) NOT NULL,
  `length_width` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `available` int(255) NOT NULL,
  `usage_of_board` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `available`
--

INSERT INTO `available` (`id`, `board_name`, `length_width`, `category`, `available`, `usage_of_board`) VALUES
(17, '12-MM MDF One Side Veneer(Beech)', '1220X675', 'A', 12, 'For chair'),
(18, '18-MM MDF One Side Veneer(Beech)', '1220X440', 'A', 10, '***'),
(19, '12-MM MDF Plain', '1220X675', 'A', 12, 'For chair'),
(20, '18-MM MDF One Side Veneer(Beech)', '395X2440', 'A', 6, '***'),
(21, '18-MM MDF Plain', '295X2440', 'C', 110, '***'),
(22, '16-MM Melamine(LB)', '600X1220', 'A', 6, '***'),
(23, '18-MM MDF One Side Veneer(Beech)', '668X320', 'B', 24, '***'),
(24, '15-MM MDF One Side Veneer(Beech)', '663X320', 'B', 24, '***'),
(25, '15-MM MDF Plain', '365X538', 'B', 6, '***'),
(26, '12-MM MDF One Side Veneer(Beech)', '365X538', 'B', 24, '***'),
(27, '15-MM MDF One Side Veneer(Beech)', '365X538', 'B', 24, '***'),
(28, '12-MM MDF Plain', '650X1220', 'A', 24, 'Chair backrest'),
(29, '15-MM MDF Plain', '650X1220', 'A', 24, '***'),
(30, '16-MM Antic(LB)', '1220X1185', 'A', 145, '***'),
(31, '16-MM Melamine(LB)', '483X1802', 'A', 12, '***');

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nid` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`id`, `name`, `nid`, `email`, `password`, `user_type`) VALUES
(1, 'Semanto Ghosh Swaccha', '36987458745', 'semanto@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(3, 'Semanto', '10236548925', 'ghosh@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `off_entry`
--

CREATE TABLE `off_entry` (
  `id` int(255) NOT NULL,
  `board_name` varchar(255) NOT NULL,
  `length_width` varchar(255) NOT NULL,
  `entry_date` varchar(255) NOT NULL,
  `entry_ammount` int(255) NOT NULL,
  `usage_of_board` mediumtext NOT NULL,
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `off_entry`
--

INSERT INTO `off_entry` (`id`, `board_name`, `length_width`, `entry_date`, `entry_ammount`, `usage_of_board`, `category`) VALUES
(66, '12-MM MDF One Side Veneer(Beech)', '1220X675', '2024-06-10', 20, 'For chair', 'A'),
(67, '18-MM MDF One Side Veneer(Beech)', '1220X440', '2024-06-10', 15, '***', 'A'),
(71, '12-MM MDF Plain', '1220X675', '2024-06-10', 15, 'For chair', 'A'),
(72, '18-MM MDF One Side Veneer(Beech)', '395X2440', '2024-06-10', 10, '***', 'A'),
(73, '18-MM MDF Plain', '295X2440', '2024-06-10', 110, '***', 'C'),
(74, '16-MM Melamine(LB)', '600X1220', '2024-06-10', 6, '***', 'A'),
(75, '18-MM MDF One Side Veneer(Beech)', '668X320', '2024-06-10', 24, '***', 'B'),
(76, '15-MM MDF One Side Veneer(Beech)', '663X320', '2024-06-10', 24, '***', 'B'),
(77, '15-MM MDF Plain', '365X538', '2024-06-10', 6, '***', 'B'),
(78, '12-MM MDF One Side Veneer(Beech)', '365X538', '2024-06-10', 24, '***', 'B'),
(79, '15-MM MDF One Side Veneer(Beech)', '365X538', '2024-06-10', 24, '***', 'B'),
(80, '12-MM MDF Plain', '650X1220', '2024-06-10', 24, 'Chair backrest', 'A'),
(81, '15-MM MDF Plain', '650X1220', '2024-06-10', 24, '***', 'A'),
(82, '16-MM Antic(LB)', '1220X1185', '2024-06-10', 145, '***', 'A'),
(83, '16-MM Melamine(LB)', '483X1802', '2024-06-10', 12, '***', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `off_exit`
--

CREATE TABLE `off_exit` (
  `id` int(255) NOT NULL,
  `board_name` varchar(255) NOT NULL,
  `length_width` varchar(255) NOT NULL,
  `exit_date` varchar(255) NOT NULL,
  `exit_ammount` int(255) NOT NULL,
  `usage_of_board` mediumtext NOT NULL,
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `off_exit`
--

INSERT INTO `off_exit` (`id`, `board_name`, `length_width`, `exit_date`, `exit_ammount`, `usage_of_board`, `category`) VALUES
(37, '12-MM MDF One Side Veneer(Beech)', '1220X675', '2024-06-10', 8, '***', 'A'),
(38, '18-MM MDF One Side Veneer(Beech)', '1220X440', '2024-06-10', 5, '***', 'A'),
(39, '12-MM MDF Plain', '1220X675', '2024-06-10', 3, '***', 'A'),
(40, '18-MM MDF One Side Veneer(Beech)', '395X2440', '2024-06-10', 4, '***', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `register_info`
--

CREATE TABLE `register_info` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nid` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available`
--
ALTER TABLE `available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `off_entry`
--
ALTER TABLE `off_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `off_exit`
--
ALTER TABLE `off_exit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_info`
--
ALTER TABLE `register_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available`
--
ALTER TABLE `available`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `login_info`
--
ALTER TABLE `login_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `off_entry`
--
ALTER TABLE `off_entry`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `off_exit`
--
ALTER TABLE `off_exit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `register_info`
--
ALTER TABLE `register_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
