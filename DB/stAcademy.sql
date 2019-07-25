-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2019 at 12:21 PM
-- Server version: 5.7.26-0ubuntu0.18.10.1
-- PHP Version: 7.2.19-0ubuntu0.18.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stAcademy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(7, 'Santosh', 'admin@gmail.com', 'zzzz');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `options` json NOT NULL,
  `answer` text NOT NULL,
  `test_number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `question`, `options`, `answer`, `test_number`) VALUES
(1, 'loop', '[\"looping\", \"loopings\", \"loops\", \"loop\'s\"]', '4', '1'),
(3, 'loop', '[\"looping\", \"loopings\", \"loops\", \"loop\'s\"]', '4', '1');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(10) UNSIGNED NOT NULL,
  `sub_name` varchar(250) NOT NULL,
  `admin` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`, `admin`) VALUES
(1, 'Web Development', 'admin@gmail.com'),
(2, 'App Development', 'admin@gmail.com'),
(3, 'BCA', 'admin@gmail.com'),
(4, 'web', 'admin@gmail.com'),
(5, 'MCA', 'admin@gmail.com'),
(6, 'NodeJs', 'admin@gmail.com'),
(7, 'IOS development', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_no` int(10) UNSIGNED NOT NULL,
  `test_name` varchar(200) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `test_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_no`, `test_name`, `subject`, `test_date`) VALUES
(1, 'test-2019', 'IOS development', '24/07/2019');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'applw', 'apple@gmail.com', 'apple1234'),
(2, 'micle', 'micle@gmail.com', 'micle1234'),
(3, 'sfca', 'fgugvu@agbsch.fchshgb', 'hbiujbib'),
(4, 'hnoujcbsa', 'dvcsd@acvg.scyags', 'hbiujbib'),
(5, 'sascabvh', 'ohoincja@svcsgabs.asc', 'hbiujbib'),
(6, 'sahcu9a', 'huhguyib@fgcvfgd.acasgu', 'guycgbvzxhc'),
(7, 'bhucvbzds', 'hiuacgbs@cs.chhasg', 'guycgbvzxhc'),
(8, 'znadbn', 'uhvuhvuh@dcxhgas.chasy', 'guycgbvzxhc'),
(9, 'adqaty', 'vcygsdcv@cfsa.asscs', 'guycgbvzxhc'),
(10, 'scvaytgcv', 'buyhvbcygzv@scvgabs.caf', 'guycgbvzxhc'),
(11, 'adas', 'jjgiyuhb@rfscxats.sxas', 'guvguyv'),
(12, 'niusqw', 'ijbh@safxg.sxcas', 'guvguyv');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
