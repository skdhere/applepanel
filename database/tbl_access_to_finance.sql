-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2019 at 07:32 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hpapple_2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_to_finance`
--

DROP TABLE IF EXISTS `tbl_access_to_finance`;
CREATE TABLE IF NOT EXISTS `tbl_access_to_finance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_id` int(11) DEFAULT NULL,
  `main_source_of_finance` varchar(255) DEFAULT NULL,
  `main_source_other_flag` int(11) DEFAULT NULL,
  `main_source_other_value` varchar(255) DEFAULT NULL,
  `crop_insurance` varchar(50) DEFAULT NULL,
  `insurance_type` varchar(255) DEFAULT NULL,
  `insurance_scheme` text,
  `insurance_value` varchar(100) DEFAULT NULL,
  `insurance_premium_per_year` varchar(255) DEFAULT NULL,
  `insurance_tot_coverage` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
