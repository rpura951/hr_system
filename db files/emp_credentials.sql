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
-- Table structure for table `emp_credentials`
--

DROP TABLE IF EXISTS `emp_credentials`;
CREATE TABLE IF NOT EXISTS `emp_credentials` (
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_credentials`
--

INSERT INTO `emp_credentials` (`username`, `password`) VALUES
('rpura', '$2y$10$jyIppcnX4nuwMk45LMX5teHOps0CrXL/.yANhy80y/hvJ.rRYq2cO'),
('JGay', '$2y$10$3y70jNlya3nL6vh1MWWx0O9AHUlbY0iHCxNvM4rnNI0T62F06lVdy'),
('NUser', '$2y$10$NjARW683GK2EF8/cZ2tFOOjw3ylOHiwvrpf0TuMvpbXASpqyQTUba'),
('LPerson', '$2y$10$OrKUIhzu2yjj9Y0X52IQ1e0k3CbGO789S7y.lQy.ZPCzBvY/w7OHC');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emp_credentials`
--
ALTER TABLE `emp_credentials`
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `emp_data` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
