-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2017 at 11:06 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CS304`
--

-- --------------------------------------------------------

--
-- Table structure for table `CreditCard`
--

CREATE TABLE `CreditCard` (
  `CardId` int(11) NOT NULL,
  `PersonId` int(11) NOT NULL,
  `CreditCard` char(19) NOT NULL,
  `CreditExpDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CreditCard`
--

INSERT INTO `CreditCard` (`CardId`, `PersonId`, `CreditCard`, `CreditExpDate`) VALUES
(1, 8, '6205105105105100', '2017-12-00'),
(2, 8, '5105105105105100', '2019-01-00');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderId` int(11) NOT NULL,
  `BuyerId` int(11) DEFAULT NULL,
  `ShopName` char(15) DEFAULT NULL,
  `ProductId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Type` tinyint(1) DEFAULT NULL,
  `OrderStatus` tinyint(1) DEFAULT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CardId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`OrderId`, `BuyerId`, `ShopName`, `ProductId`, `Quantity`, `Price`, `Type`, `OrderStatus`, `TIMESTAMP`, `CardId`) VALUES
(2, 7, 'HongShop', 1, 4, 22, 0, 0, '2017-03-27 04:38:52', NULL),
(3, 3, 'HongShop', 1, 4, 30, 1, 0, '2017-03-31 20:40:27', NULL),
(4, 8, 'Apple', 2, 1, 800, 1, 0, '2017-03-31 20:54:05', 1),
(5, 8, 'Apple', 2, 2, 1600, 1, 0, '2017-03-31 20:59:37', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `PersonId` int(11) NOT NULL,
  `Phone` bigint(10) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `FirstName` varchar(15) NOT NULL,
  `LastName` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`PersonId`, `Phone`, `Password`, `Address`, `FirstName`, `LastName`, `Email`, `TimeStamp`) VALUES
(2, 7782227777, 'afdd0b4ad2ec172c586e2150770fbf9e', 'vancouver bc', 'Hong', 'Li', 'yoolooad@gmail.com', '2017-03-13 00:06:15'),
(3, 7782339483, 'afdd0b4ad2ec172c586e2150770fbf9e', 'vancouver bc 24324', 'boe', 'li', 'boeftw@gmail.com', '2017-03-22 06:04:41'),
(4, 7782339481, 'afdd0b4ad2ec172c586e2150770fbf9e', 'vancouver bc 24324', 'boe', 'li', 'boeftw01@gmail.com', '2017-03-22 06:05:04'),
(5, 7782339482, 'afdd0b4ad2ec172c586e2150770fbf9e', 'vancouver bc 24324', 'boe', 'li', 'boeftw02@gmail.com', '2017-03-22 06:06:28'),
(6, 7782339484, 'afdd0b4ad2ec172c586e2150770fbf9e', 'vancouver bc 24324', 'boe', 'li', 'boeftw04@gmail.com', '2017-03-22 06:07:10'),
(7, 7782339485, 'afdd0b4ad2ec172c586e2150770fbf9e', 'vancouver bc 24324', 'boe', 'li', 'boeftw05@gmail.com', '2017-03-22 06:07:23'),
(8, 7788616112, 'b6eedb02ba6085dad80730ece3453633', '2366 Main Mall, Vancouver, BC V6T 1Z4', 'John', 'Smith', 'john@gmail.com', '2017-03-31 20:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ProductId` int(11) NOT NULL,
  `ProductName` char(50) NOT NULL,
  `ProductDescription` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductId`, `ProductName`, `ProductDescription`) VALUES
(1, 'UBC U-PASS', 'UBC U-PASS 2017'),
(2, 'iPhone 7 Red', 'Latest iPhone from Apple 4-7 inch display');

-- --------------------------------------------------------

--
-- Table structure for table `Quality`
--

CREATE TABLE `Quality` (
  `QualityId` int(11) NOT NULL,
  `Name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Quality`
--

INSERT INTO `Quality` (`QualityId`, `Name`) VALUES
(1, 'Very Good'),
(2, 'Good'),
(3, 'Normal'),
(4, 'Bad');

-- --------------------------------------------------------

--
-- Table structure for table `Rating`
--

CREATE TABLE `Rating` (
  `ProductId` int(11) NOT NULL,
  `Rating` float DEFAULT NULL,
  `OrderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rating`
--

INSERT INTO `Rating` (`ProductId`, `Rating`, `OrderId`) VALUES
(1, 5, 2),
(1, 3, 3),
(2, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Retailers`
--

CREATE TABLE `Retailers` (
  `PersonId` int(11) NOT NULL,
  `ShopName` char(15) NOT NULL,
  `DepositAccount` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Retailers`
--

INSERT INTO `Retailers` (`PersonId`, `ShopName`, `DepositAccount`) VALUES
(7, 'Apple', '51607500'),
(2, 'HongShop', '1234567'),
(8, 'Microsoft', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `Sells`
--

CREATE TABLE `Sells` (
  `ProductId` int(11) NOT NULL,
  `ShopName` char(50) NOT NULL,
  `Type` tinyint(1) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `QualityId` int(11) DEFAULT NULL,
  `Price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Sells`
--

INSERT INTO `Sells` (`ProductId`, `ShopName`, `Type`, `Quantity`, `QualityId`, `Price`) VALUES
(1, 'HongShop', 0, 2, 3, 22),
(1, 'HongShop', 1, 1, NULL, 30),
(2, 'Apple', 1, 28, NULL, 800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CreditCard`
--
ALTER TABLE `CreditCard`
  ADD PRIMARY KEY (`CardId`),
  ADD KEY `PersonId` (`PersonId`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `BuyerId` (`BuyerId`),
  ADD KEY `ShopName` (`ShopName`),
  ADD KEY `CardId` (`CardId`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`PersonId`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductId`);

--
-- Indexes for table `Quality`
--
ALTER TABLE `Quality`
  ADD PRIMARY KEY (`QualityId`);

--
-- Indexes for table `Rating`
--
ALTER TABLE `Rating`
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indexes for table `Retailers`
--
ALTER TABLE `Retailers`
  ADD PRIMARY KEY (`ShopName`),
  ADD UNIQUE KEY `ShopName` (`ShopName`),
  ADD KEY `PersonId` (`PersonId`);

--
-- Indexes for table `Sells`
--
ALTER TABLE `Sells`
  ADD KEY `QualityId` (`QualityId`),
  ADD KEY `ProductId` (`ProductId`,`ShopName`,`Type`) USING BTREE,
  ADD KEY `ShopName` (`ShopName`,`ProductId`,`Type`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CreditCard`
--
ALTER TABLE `CreditCard`
  MODIFY `CardId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `PersonId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `CreditCard`
--
ALTER TABLE `CreditCard`
  ADD CONSTRAINT `creditcard_ibfk_1` FOREIGN KEY (`PersonId`) REFERENCES `Person` (`PersonId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `CardId` FOREIGN KEY (`CardId`) REFERENCES `CreditCard` (`CardId`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`ProductId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`BuyerId`) REFERENCES `Person` (`PersonId`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`ShopName`) REFERENCES `Retailers` (`ShopName`);

--
-- Constraints for table `Rating`
--
ALTER TABLE `Rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`ProductId`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`OrderId`);

--
-- Constraints for table `Retailers`
--
ALTER TABLE `Retailers`
  ADD CONSTRAINT `retailers_ibfk_1` FOREIGN KEY (`PersonId`) REFERENCES `Person` (`PersonId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Sells`
--
ALTER TABLE `Sells`
  ADD CONSTRAINT `sells_ibfk_1` FOREIGN KEY (`ShopName`) REFERENCES `Retailers` (`ShopName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sells_ibfk_2` FOREIGN KEY (`QualityId`) REFERENCES `Quality` (`QualityId`),
  ADD CONSTRAINT `sells_ibfk_3` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`ProductId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
