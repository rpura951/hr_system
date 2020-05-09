-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 04, 2020 at 11:36 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_data`
--

DROP TABLE IF EXISTS `emp_data`;
CREATE TABLE IF NOT EXISTS `emp_data` (
  `fname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ssn` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  UNIQUE KEY `ssn` (`ssn`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_data`
--

INSERT INTO `emp_data` (`fname`, `lname`, `phone_number`, `address`, `username`, `ssn`, `isAdmin`) VALUES
('Ralph', 'Pura', '9515814298', '123 Fake Adress', 'rpura', '123456789', 1),
('New', 'User', '0987654321', '432 Somewhere', 'NUser', '444559999', 0),
('Levi', 'Person', '4567879874', '54684 Riverside Drive', 'LPerson', '549876666', 0),
('Juan', 'Gay', '9119874561', 'Levis Butthole', 'JGay', '654789123', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
