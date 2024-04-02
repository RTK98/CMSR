-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 09, 2023 at 11:42 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsr`
--

-- --------------------------------------------------------

--
-- Table structure for table `catergories`
--

DROP TABLE IF EXISTS `catergories`;
CREATE TABLE IF NOT EXISTS `catergories` (
  `CatergoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CatergoryCode` varchar(255) NOT NULL,
  `CatergoryName` varchar(255) NOT NULL,
  `CatergoryImage` varchar(255) DEFAULT NULL,
  `CatergoryDescription` text NOT NULL,
  `CatergoryStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`CatergoryID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nic` varchar(12) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `HouseNo` varchar(10) NOT NULL,
  `Lane1` varchar(50) NOT NULL,
  `Lane2` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) NOT NULL,
  `UpdateDate` date NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_mobile`
--

DROP TABLE IF EXISTS `customer_mobile`;
CREATE TABLE IF NOT EXISTS `customer_mobile` (
  `customberMobileId` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  `MobileNo` int(10) NOT NULL,
  PRIMARY KEY (`customberMobileId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ProductId` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(255) NOT NULL,
  `ProductPrice` decimal(10,2) NOT NULL,
  `ProductQty` int(11) NOT NULL,
  `ProductDescription` text NOT NULL,
  `ProductStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `ProductName`, `ProductPrice`, `ProductQty`, `ProductDescription`, `ProductStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Toyota Oil 15W 30', '1234.00', 10, 'aa', 1, 1, '2023-04-05', NULL, NULL),
(2, 'Toyota Oil 15W 40', '1234.00', 10, 'fff', 1, 1, '2023-04-05', NULL, NULL),
(3, 'Toyota Oil 10W 30', '11800.00', 10, 'hh', 1, 1, '2023-04-05', NULL, NULL),
(4, 'Toyota Oil 10W 40', '11800.00', 10, 'AAA', 1, 1, '2023-04-05', NULL, NULL),
(5, 'Toyota Oil 15W 45', '1234.00', 10, 'sef', 1, 1, '2023-04-05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productsize`
--

DROP TABLE IF EXISTS `productsize`;
CREATE TABLE IF NOT EXISTS `productsize` (
  `ProductSizeId` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(11) NOT NULL,
  `SIze` char(4) NOT NULL,
  PRIMARY KEY (`ProductSizeId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productsize`
--

INSERT INTO `productsize` (`ProductSizeId`, `ProductId`, `SIze`) VALUES
(1, 4, 'S'),
(2, 4, 'M'),
(3, 5, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `reservationID` int(11) NOT NULL AUTO_INCREMENT,
  `RegistrationNO` varchar(15) NOT NULL,
  `UserId` int(11) NOT NULL,
  `ServiceType` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Time` timestamp NOT NULL,
  PRIMARY KEY (`reservationID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserRole` varchar(100) NOT NULL,
  `HouseNo` varchar(100) NOT NULL,
  `Lane` varchar(100) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `NIC` varchar(12) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Title`, `FirstName`, `LastName`, `Email`, `Password`, `UserRole`, `HouseNo`, `Lane`, `Street`, `City`, `NIC`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Mr.', 'Rajindra', 'Tharindu', 'rajindratharindu@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'admin', '136/1,', 'Horahena Road, ', 'Rukmale,', 'Pannipitiya.', '88777777', 1, 1, '2023-03-17', NULL, NULL),
(2, 'Mr.', 'Tharindu', 'Kumara', 'tharindu@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'manager', '136', 'r', 'r', 'r', '88777777', 1, 1, '2023-03-20', NULL, NULL),
(3, 'Mr.', 'Kumara', 'Perera', 'kumara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', '136', 'r', 'r', 'r', '88777777', 1, 1, '2023-03-20', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
