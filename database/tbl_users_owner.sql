-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2019 at 01:27 AM
-- Server version: 5.7.25
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thefarme_hpapple`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_owner`
--

CREATE TABLE `tbl_users_owner` (
  `id` int(11) NOT NULL,
  `orgid` int(11) NOT NULL,
  `clientname` varchar(30) NOT NULL,
  `shortcode` varchar(10) NOT NULL,
  `promocode` varchar(30) NOT NULL,
  `sms_per_rs` tinyint(2) NOT NULL DEFAULT '0',
  `cl_limit` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users_owner`
--

INSERT INTO `tbl_users_owner` (`id`, `orgid`, `clientname`, `shortcode`, `promocode`, `sms_per_rs`, `cl_limit`, `created_by`, `created`, `modified_by`, `modified`, `status`) VALUES
(1, 5, 'hpapple', 'hpapple', 'hpapple', 0, '', 0, '0000-00-00 00:00:00', 1, '2017-10-04 16:38:18', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users_owner`
--
ALTER TABLE `tbl_users_owner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users_owner`
--
ALTER TABLE `tbl_users_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
