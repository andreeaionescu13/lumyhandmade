-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 04:46 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop1`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(128) DEFAULT NULL,
  `Password` varchar(128) DEFAULT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `CustomerPhoneNumber` int(15) DEFAULT NULL,
  `CustomerEmail` varchar(255) DEFAULT NULL,
  `CustomerAddress` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`, `CustomerName`, `CustomerPhoneNumber`, `CustomerEmail`, `CustomerAddress`, `admin`) VALUES
(14, 'adrianholobut', '$2y$10$tYOpg3cEWtBJUE4xnKJI8u4gTOJiQq/C/qhNsgrJdF3EDUicEmz6u', 'Adrian Holobut', 0, 'adrian.holobut@gmail.com', 'str. buna ziua', 1),
(17, 'testuser3', '$2y$10$IPLAiuQxdJa3qXRZ/DO63e6uzAKwdO6xUfaXawt8NL9K6qSjLnY7W', NULL, NULL, NULL, NULL, 1),
(18, 'testuser', '$2y$10$GMzK3DsdnSCKexeYEOW2DOl5frfqrFQd8U.s522gDTaqYaT0jPdaW', NULL, NULL, NULL, NULL, 0),
(20, 'testuser50', '$2y$10$fmnyPgvJ.lBC5OYFJHt3NeLZzIaC3wtSzuAaD.RpNEUmmd2tBzC8S', 'Test User cincizeci', 32423, 'testuser50@gmail.com', 'test', 1),
(21, 'testuser100', '$2y$10$T/Br0buC/0b9zd5M327x5unVQn1JoozhOSuHFz5zhaBJ831JUwpm2', 'Adrian Test', NULL, 'adrian.holobut2@gmail.com', 'address', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
