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
-- Table structure for table `timeclock`
--

DROP TABLE IF EXISTS `timeclock`;
CREATE TABLE IF NOT EXISTS `timeclock` (
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `clockin` time NOT NULL,
  `clockout` time NOT NULL,
  `lunchout` time NOT NULL,
  `lunchin` time NOT NULL,
  `totalworked` float NOT NULL,
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timeclock`
--

INSERT INTO `timeclock` (`username`, `date`, `clockin`, `clockout`, `lunchout`, `lunchin`, `totalworked`) VALUES
('rpura', '2020-05-03', '06:00:00', '10:00:00', '11:00:00', '16:00:00', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `timeclock`
--
ALTER TABLE `timeclock`
  ADD CONSTRAINT `un` FOREIGN KEY (`username`) REFERENCES `emp_data` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
