-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 13, 2023 at 08:41 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `ProductID` varchar(50) DEFAULT NULL,
  `Price` double(12,2) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `TotalPrice` double(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderID`, `ProductID`, `Quantity`) VALUES
(1654878258, 1654872289, 1),
(1654878258, 1654871258, 2),
(1654878258, 1654872419, 1),
(1654878258, 0, 0),
(1654878350, 1654872289, 1),
(1654878350, 1654871258, 2),
(1654878350, 1654872419, 1),
(1654878351, 1654872289, 1),
(1654878351, 1654871258, 2),
(1654878351, 1654872419, 1),
(1654878352, 1654872289, 1),
(1654878352, 1654871258, 2),
(1654878352, 1654872419, 1),
(1654878354, 1654872289, 1),
(1654878354, 1654871258, 2),
(1654878354, 1654872419, 1),
(1654878355, 1654872289, 1),
(1654878355, 1654871258, 2),
(1654878355, 1654872419, 1),
(2, 1654871258, 2),
(2, 1654871289, 1),
(4, 1654872419, 1),
(4, 1654871258, 3),
(4, 1654872289, 1),
(5, 1654872419, 1),
(5, 1654871258, 3),
(5, 1654872289, 1),
(4, 1654871289, 1),
(4, 1654871258, 2),
(5, 1654871258, 1),
(6, 1654871258, 1),
(6, 1654871289, 1),
(7, 1654871258, 1),
(7, 1654872289, 1),
(3, 1654871258, 3),
(3, 1654872289, 2),
(3, 1655718431, 3),
(1, 1654871258, 2),
(1, 1654871258, 1),
(1, 1654871289, 1),
(2, 1654871258, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` varchar(50) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `Description` text,
  `ManufacturerID` varchar(50) DEFAULT NULL,
  `Price` double(12,2) DEFAULT NULL,
  `PieceNR` int(100) DEFAULT NULL,
  `Image` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Description`, `ManufacturerID`, `Price`, `PieceNR`, `Image`) VALUES
('1654871258', 'VV Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '324353', 25.00, NULL, 'Image2.jpeg'),
('1654871289', 'Shabby Chic Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '236789', 20.00, NULL, 'Image27.jpg'),
('1654872289', 'Vintage Cottage Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '232213', 24.00, NULL, 'Image21.jpg'),
('1654872419', 'Modern Heart Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '234252', 14.00, NULL, 'Image29.jpg'),
('1655718431', 'Love Jar Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '503427', 16.00, NULL, 'Image18.jpg'),
('1655997809', 'Chic Peasant Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '546792', 21.00, NULL, 'Image26.jpg'),
('1655997868', 'Vintage Peasant Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '478201', 23.00, NULL, 'Image25.jpg'),
('1655997894', 'Industrial Style Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '562839', 17.00, NULL, 'Image10.jpg'),
('1655997914', 'The Glass of Roses Candle', 'Decorative scented candles are something special and unique, handmade.  These can be the perfect gift for you or your loved ones!\r\nEach candle is made by hand, individually and uses a unique method. It fits perfectly in any type of room, both indoors and on any terrace, with a minimalist and special design.', '562838', 19.00, NULL, 'Image12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE `shop_order` (
  `OrderID` int(255) NOT NULL,
  `CustomerID` int(255) DEFAULT NULL,
  `TotalPrice` int(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `DatePurchase` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_order`
--

INSERT INTO `shop_order` (`OrderID`, `CustomerID`, `TotalPrice`, `Status`, `DatePurchase`) VALUES
(1, 23, 95, 'pending', '2022-06-24 18:01:09'),
(2, 22, 25, 'pending', '2022-06-24 18:08:15');

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
(22, 'admin', '$2y$10$2SVmRY2M8aFHm/jq1Hd6DeHDqFdmS/3Z.6KhZugAeshedS6uApQIC', 'admin', 766666666, 'admin@gmail.com', 'cluj-Napoca', 1),
(23, 'user', '$2y$10$WUFkWkMGjfsNkVITHT6vfexedqfZnQ0u/E.U8jpoZlQ.Me5XMDAM.', 'user', 766666669, 'user@gmail.com', 'adresa', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `BookID` (`ProductID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
  MODIFY `OrderID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
