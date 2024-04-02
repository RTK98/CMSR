-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 23, 2023 at 07:26 AM
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
-- Table structure for table `appointmenthandling`
--

DROP TABLE IF EXISTS `appointmenthandling`;
CREATE TABLE IF NOT EXISTS `appointmenthandling` (
  `AppHandling` int(11) NOT NULL AUTO_INCREMENT,
  `TimeSlotId` int(11) NOT NULL,
  `AppointmentId` int(11) DEFAULT NULL,
  `AppDate` date NOT NULL,
  PRIMARY KEY (`AppHandling`),
  KEY `AppointmentId` (`AppointmentId`),
  KEY `TimeSlotId` (`TimeSlotId`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointmenthandling`
--

INSERT INTO `appointmenthandling` (`AppHandling`, `TimeSlotId`, `AppointmentId`, `AppDate`) VALUES
(1, 1, 1, '2023-05-29'),
(2, 1, 2, '2023-05-29'),
(3, 1, 3, '2023-05-29'),
(4, 1, 4, '2023-05-29'),
(5, 1, 5, '2023-05-29'),
(6, 22, 6, '2023-05-18'),
(7, 12, 7, '2023-05-30'),
(8, 43, 8, '2023-06-04'),
(9, 15, 9, '2023-06-07'),
(10, 36, 10, '2023-06-10'),
(11, 36, 11, '2023-06-10'),
(12, 8, 12, '2023-06-13'),
(13, 8, 13, '2023-06-13'),
(14, 8, 14, '2023-06-13'),
(15, 9, 15, '2023-06-13'),
(18, 8, 16, '2023-06-20'),
(19, 8, 17, '2023-06-20'),
(20, 8, 18, '2023-06-20'),
(21, 8, 19, '2023-06-21'),
(22, 8, 20, '2023-06-20'),
(23, 8, 21, '2023-06-20'),
(24, 9, 22, '2023-06-20'),
(25, 9, 23, '2023-06-20'),
(26, 9, 24, '2023-06-20'),
(27, 9, 25, '2023-06-20'),
(28, 9, 26, '2023-06-20'),
(29, 10, 27, '2023-06-20'),
(30, 10, 28, '2023-06-20'),
(31, 15, 29, '2023-06-21'),
(32, 23, 30, '2023-06-22'),
(33, 16, 31, '2023-06-21'),
(34, 16, 32, '2023-06-21'),
(35, 23, 33, '2023-06-22'),
(36, 16, 35, '2023-06-21'),
(37, 23, 36, '2023-06-22'),
(38, 28, 37, '2023-06-22'),
(39, 15, 38, '2023-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `AppointmentId` int(11) NOT NULL AUTO_INCREMENT,
  `AppointmentNo` varchar(255) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `VehicleNo` int(11) NOT NULL,
  `AppDate` date NOT NULL,
  `TimeSlotStart` int(11) NOT NULL,
  `ServiceType` varchar(255) NOT NULL,
  `appointmentStatus` int(1) DEFAULT NULL,
  `AddUser` int(11) DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`AppointmentId`),
  KEY `TimeSlotStart` (`TimeSlotStart`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`AppointmentId`, `AppointmentNo`, `CustomerID`, `VehicleNo`, `AppDate`, `TimeSlotStart`, `ServiceType`, `appointmentStatus`, `AddUser`, `UpdateUser`, `UpdateDate`) VALUES
(1, '202305181402684869', 1, 1, '2023-05-18', 1, 'Full Service', NULL, 1, NULL, NULL),
(2, '202305181497302576', 1, 2, '2023-05-18', 1, 'Full Service', NULL, 1, NULL, NULL),
(3, '202305181210422964', 1, 3, '2023-05-18', 1, 'Full Service', NULL, 1, NULL, NULL),
(4, '202305181226139891', 1, 4, '2023-05-18', 1, 'Full Service', NULL, 1, NULL, NULL),
(5, '202305181163073859', 1, 5, '2023-05-18', 1, 'Full Service', NULL, 1, NULL, NULL),
(6, '20230526290541435', 1, 1, '2023-05-30', 12, 'Full Service', 1, NULL, NULL, NULL),
(7, '20230526912705580', 1, 3, '2023-05-30', 12, 'Full Service', 1, NULL, NULL, NULL),
(8, '202306042005706932', 2, 1, '2023-06-04', 43, 'Full Service', 1, NULL, NULL, NULL),
(9, '202306071239024326', 1, 16, '2023-06-07', 15, 'Under Wash', 1, NULL, NULL, NULL),
(10, '202306091701693832', 1, 2, '2023-06-10', 36, 'Full Service', 1, NULL, NULL, NULL),
(11, '202306091279967415', 1, 2, '2023-06-10', 36, 'Full Service', 1, NULL, NULL, NULL),
(12, '2023061263498618', 1, 1, '2023-06-13', 8, 'Full Service', 1, NULL, NULL, NULL),
(13, '202306122078987878', 1, 1, '2023-06-13', 8, 'Full Service', 1, NULL, NULL, NULL),
(14, '202306121489580880', 1, 1, '2023-06-13', 8, 'Full Service', 1, NULL, NULL, NULL),
(15, '202306121677858256', 1, 1, '2023-06-13', 9, 'Full Service', 1, NULL, NULL, NULL),
(16, '202306191543444864', 1, 18, '2023-06-20', 8, 'Full Service Car', 1, NULL, NULL, NULL),
(17, '2023061928891267', 1, 1, '2023-06-20', 8, 'Full Service Car', 1, NULL, NULL, NULL),
(18, '20230619196811695', 1, 1, '2023-06-20', 8, 'Full Service Car', 1, NULL, NULL, NULL),
(19, '202306191357828457', 1, 1, '2023-06-20', 8, 'Full qqService Car', 1, NULL, NULL, NULL),
(20, '20230619708453686', 1, 1, '2023-06-20', 8, 'Full qqService Car', 1, NULL, NULL, NULL),
(21, '202306191760517007', 1, 4, '2023-06-22', 8, '2', 1, NULL, NULL, NULL),
(22, '202306201147516721', 1, 1, '2023-06-20', 9, '1', 1, NULL, NULL, NULL),
(23, '202306201490625898', 1, 2, '2023-06-20', 9, '1', 1, NULL, NULL, NULL),
(24, '20230620545057994', 1, 3, '2023-06-20', 9, '1', 1, NULL, NULL, NULL),
(25, '20230620950652079', 1, 3, '2023-06-20', 9, '1', 1, NULL, NULL, NULL),
(26, '20230620692762432', 1, 4, '2023-06-20', 9, '1', 1, NULL, NULL, NULL),
(27, '202306201209969169', 1, 18, '2023-06-20', 10, '1', 1, NULL, NULL, NULL),
(28, '20230620688449824', 1, 18, '2023-06-20', 10, '2', 1, NULL, NULL, NULL),
(29, '20230620798911622', 1, 18, '2023-06-21', 15, '1', 1, NULL, NULL, NULL),
(30, '20230620873231262', 1, 18, '2023-06-22', 23, '1', 1, NULL, NULL, NULL),
(31, '202306202082749798', 1, 18, '2023-06-21', 16, '2', 1, NULL, NULL, NULL),
(32, '202306201150151454', 1, 18, '2023-06-21', 16, '2', 1, NULL, NULL, NULL),
(33, '202306201016219088', 1, 18, '2023-06-22', 23, '2', 1, NULL, NULL, NULL),
(34, '20230620295056378', 1, 18, '2023-06-21', 16, '1', 1, NULL, NULL, NULL),
(35, '2023062077546861', 1, 18, '2023-06-21', 16, '1', 1, NULL, NULL, NULL),
(36, '20230620701617851', 1, 18, '2023-06-22', 23, '2', 1, NULL, NULL, NULL),
(37, '202306201551388495', 1, 5, '2023-06-22', 28, '2', 1, NULL, NULL, NULL),
(38, '20230620427399570', 1, 18, '2023-06-21', 15, '1', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `AttId` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `LoggedTime` varchar(11) NOT NULL,
  `LoggedDate` date NOT NULL,
  `LogoutTime` varchar(11) DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`AttId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttId`, `User_Id`, `LoggedTime`, `LoggedDate`, `LogoutTime`, `LogoutDate`, `Status`) VALUES
(1, 1, '17:16', '2023-06-12', '18:08', '2023-06-12', 0),
(2, 2, '17:29', '2023-06-12', '17:59', '2023-06-12', 0),
(3, 3, '17:38', '2023-06-12', NULL, NULL, 1),
(4, 4, '17:39', '2023-06-12', NULL, NULL, 1),
(5, 2, '17:40', '2023-06-12', '17:59', '2023-06-12', 0),
(6, 2, '17:42', '2023-06-12', '17:59', '2023-06-12', 0),
(7, 1, '18:03', '2023-06-12', '18:08', '2023-06-12', 0),
(8, 7, '18:08', '2023-06-12', NULL, NULL, 1),
(9, 2, '18:09', '2023-06-12', NULL, NULL, 1);

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
  `CatergoryStatus` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`CatergoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catergories`
--

INSERT INTO `catergories` (`CatergoryID`, `CatergoryCode`, `CatergoryName`, `CatergoryImage`, `CatergoryDescription`, `CatergoryStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(4, 'OIL123', 'Oil', '644d0cdd488292.08049451Shobs.jpg', 'ljkll', 1, 1, '2023-04-10', NULL, NULL),
(5, 'Shobs123', 'Shobs', '644d0cdd488292.08049451Shobs.jpg', 'Catergory Description', 1, 1, '2023-04-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `NIC` varchar(12) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `HouseNo` varchar(10) NOT NULL,
  `Lane` varchar(50) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Email`, `Password`, `NIC`, `FirstName`, `LastName`, `HouseNo`, `Lane`, `Street`, `City`, `Gender`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'rajindratharindu@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '982130140V', 'B.A.W.A.Rajindra', 'Tharindu', '136', 'Horahena Road', 'Rukmale', 'Pannipitiya', '1', 1, NULL, NULL, NULL, NULL),
(2, 'pasan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1111100000', 'Pasan', 'Manahara', '134', 'G', 'H', 'Pannipitiya', '1', 1, NULL, NULL, NULL, NULL),
(3, 'himansa@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1111100444', 'Himansa', 'Kavyanjalee', '135', 'ha', 'hf', 'Colombo', '1', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customervehicles`
--

DROP TABLE IF EXISTS `customervehicles`;
CREATE TABLE IF NOT EXISTS `customervehicles` (
  `vehicleId` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `VehicleModel` varchar(255) NOT NULL,
  `VehicleImage` varchar(255) NOT NULL,
  `VehicleType` int(11) NOT NULL,
  `registerLetter` varchar(20) NOT NULL,
  `RegistrationNo` varchar(255) NOT NULL,
  PRIMARY KEY (`vehicleId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customervehicles`
--

INSERT INTO `customervehicles` (`vehicleId`, `CustomerID`, `VehicleModel`, `VehicleImage`, `VehicleType`, `registerLetter`, `RegistrationNo`) VALUES
(1, 1, '', '6490404f038629.73703486.jpg', 1, 'CCA', '1234'),
(2, 1, '', '6490404f038629.73703486.jpg', 1, 'CCA', '1235'),
(3, 1, '', '6490404f038629.73703486.jpg', 1, 'CCA', '1236'),
(4, 1, '', '6490404f038629.73703486.jpg', 1, 'CCA', '1237'),
(5, 1, '', '6490404f038629.73703486.jpg', 1, 'CCA', '1238'),
(6, 2, '', '', 1, 'CCA', '1239'),
(7, 2, '', '', 1, 'CCA', '1240'),
(8, 2, '', '', 1, 'CCA', '1241'),
(9, 2, '', '', 1, 'CCA', '1242'),
(10, 2, '', '', 1, 'CCA', '1243'),
(11, 3, '', '', 1, 'CCA', '1244'),
(12, 3, '', '', 1, 'CCA', '1245'),
(13, 3, '', '', 1, 'CCA', '1246'),
(14, 3, '', '6490404f038629.73703486.jpg', 1, 'CCA', '1247'),
(15, 3, '', '6490404f038629.73703486.jpg', 1, 'CCA', '1248'),
(16, 1, '', '6490404f038629.73703486.jpg', 1, 'CCA', '1249'),
(17, 1, '', '6490404f038629.73703486.jpg', 2, 'PF', '6970'),
(18, 1, 'Evolution IX MR', '64905a2f2da760.45259199.jpg', 1, 'KX', '9999');

-- --------------------------------------------------------

--
-- Table structure for table `customer_mobile`
--

DROP TABLE IF EXISTS `customer_mobile`;
CREATE TABLE IF NOT EXISTS `customer_mobile` (
  `customberMobileId` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  `MobileNo` int(10) NOT NULL,
  `countryCode` int(4) DEFAULT NULL,
  PRIMARY KEY (`customberMobileId`),
  KEY `customerID` (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_mobile`
--

INSERT INTO `customer_mobile` (`customberMobileId`, `customerID`, `MobileNo`, `countryCode`) VALUES
(1, 1, 703966282, 94),
(2, 2, 779200480, 94);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dayName` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `dayName`, `status`) VALUES
(1, 'Monday', 'Mon', 1),
(2, 'Tuesday', 'Tue', 1),
(3, 'Wednesday', 'Wed', 1),
(4, 'Thursday', 'Thu', 1),
(5, 'Friday', 'Fri', 1),
(6, 'Saturday', 'Sat', 1),
(7, 'Sunday', 'Sun', 1);

-- --------------------------------------------------------

--
-- Table structure for table `desgination`
--

DROP TABLE IF EXISTS `desgination`;
CREATE TABLE IF NOT EXISTS `desgination` (
  `DesId` int(11) NOT NULL AUTO_INCREMENT,
  `UserRole` varchar(100) NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`DesId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desgination`
--

INSERT INTO `desgination` (`DesId`, `UserRole`, `Status`) VALUES
(1, 'admin', 1),
(2, 'manager', 1),
(3, 'inspectionOfficer', 1),
(4, 'supervisor', 1),
(5, 'technician', 1),
(6, 'stockKeeper', 1);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
CREATE TABLE IF NOT EXISTS `holidays` (
  `HolidayId` int(11) NOT NULL AUTO_INCREMENT,
  `HolidayName` varchar(255) NOT NULL,
  `HolidayDate` date NOT NULL,
  `HolidayTime` time NOT NULL,
  `HolidayStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`HolidayId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`HolidayId`, `HolidayName`, `HolidayDate`, `HolidayTime`, `HolidayStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Cloed', '2023-04-10', '10:59:00', 1, 1, '2023-04-10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inspections`
--

DROP TABLE IF EXISTS `inspections`;
CREATE TABLE IF NOT EXISTS `inspections` (
  `InspectionId` int(11) NOT NULL AUTO_INCREMENT,
  `InspectionNo` varchar(255) NOT NULL,
  `VehicleNo` varchar(255) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Millege` varchar(255) NOT NULL,
  `FuelType` varchar(255) DEFAULT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`InspectionId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`InspectionId`, `InspectionNo`, `VehicleNo`, `CustomerName`, `Millege`, `FuelType`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, '', 'CCA-1234', 'Rajindra Tharindu', '123456KM', NULL, 1, '2023-04-20', NULL, NULL),
(2, '', 'CCA-1235', 'Rajindra Tharindu', '123456KM', NULL, 1, '2023-04-20', NULL, NULL),
(3, '', 'CCA-1236', 'Rajindra Tharindu', '123456KM', NULL, 1, '2023-04-20', NULL, NULL),
(4, '', 'CCA-1237', 'Rajindra Tharindu', '123456KM', NULL, 1, '2023-04-20', NULL, NULL),
(5, '', 'CCA-1238', 'Tharindu', '123456KM', NULL, 1, '2023-04-20', NULL, NULL),
(6, '', 'CCA-1239', 'Rajindra 1', '1234567KM', NULL, 1, '2023-04-23', NULL, NULL),
(7, '2023-04-2351754221', 'CCA-1240', 'Rajindra 2', '123456KM', NULL, 1, '2023-04-23', NULL, NULL),
(8, '20230423777290720', 'CCA-1241', 'Rajindra 3', '123456KM', NULL, 1, '2023-04-23', NULL, NULL),
(9, '202304231736528482', 'CCA-1243', 'Rajindra 4', '123456KM', NULL, 1, '2023-04-23', NULL, NULL),
(10, '2023042371005357', 'asdasd', 'asd', 'asd', NULL, 1, '2023-04-23', NULL, NULL),
(11, '202304231479868010', 'asd', 'asd', 'asdasd', NULL, 1, '2023-04-23', NULL, NULL),
(12, '20230423832846375', 'sdfsdf', 'sdfsd', 'sdf', NULL, 1, '2023-04-23', NULL, NULL),
(13, '20230423832781225', 'xczxc', 'zxc', 'zxc', NULL, 1, '2023-04-23', NULL, NULL),
(14, '20230423703259503', 'CCA-1244', 'Rajindra 5', '123456KM', NULL, 1, '2023-04-23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inspectionsreport`
--

DROP TABLE IF EXISTS `inspectionsreport`;
CREATE TABLE IF NOT EXISTS `inspectionsreport` (
  `InspectionsReportId` int(11) NOT NULL AUTO_INCREMENT,
  `InspectionId` int(11) NOT NULL,
  `InspectionStatus` char(255) NOT NULL,
  PRIMARY KEY (`InspectionsReportId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectionsreport`
--

INSERT INTO `inspectionsreport` (`InspectionsReportId`, `InspectionId`, `InspectionStatus`) VALUES
(1, 3, '1'),
(2, 3, '1'),
(3, 4, '1'),
(4, 4, '4'),
(5, 5, '1'),
(6, 6, '1'),
(7, 6, '4'),
(8, 7, '1'),
(9, 7, '4'),
(10, 8, '1'),
(11, 8, '4'),
(12, 9, '1'),
(13, 9, '4'),
(14, 10, '1'),
(15, 10, '2'),
(16, 11, '1'),
(17, 11, '2'),
(18, 11, '3'),
(19, 12, '3'),
(20, 13, '2'),
(21, 13, '3'),
(22, 14, '1'),
(23, 14, '3'),
(24, 14, '4');

-- --------------------------------------------------------

--
-- Table structure for table `job_cards`
--

DROP TABLE IF EXISTS `job_cards`;
CREATE TABLE IF NOT EXISTS `job_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AppointmentId` int(11) NOT NULL,
  `AppDate` date NOT NULL,
  `AppointmentNo` varchar(255) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `VehicleNo` varchar(50) NOT NULL,
  `CustomerNo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_cards`
--

INSERT INTO `job_cards` (`id`, `AppointmentId`, `AppDate`, `AppointmentNo`, `CustomerId`, `VehicleNo`, `CustomerNo`) VALUES
(1, 1, '2023-05-18', '202305181402684869', 1, '1', 1),
(2, 6, '2023-05-30', '20230526290541435', 1, '1', 1),
(3, 2, '2023-05-18', '202305181497302576', 1, '2', 1),
(4, 8, '2023-06-04', '202306042005706932', 2, '8', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oil`
--

DROP TABLE IF EXISTS `oil`;
CREATE TABLE IF NOT EXISTS `oil` (
  `oilMasterId` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(11) NOT NULL,
  `oilId` int(10) NOT NULL,
  PRIMARY KEY (`oilMasterId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oil`
--

INSERT INTO `oil` (`oilMasterId`, `ProductId`, `oilId`) VALUES
(1, 2, 3),
(2, 0, 4),
(3, 0, 5),
(4, 0, 5),
(5, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `oilliters`
--

DROP TABLE IF EXISTS `oilliters`;
CREATE TABLE IF NOT EXISTS `oilliters` (
  `oilId` int(10) NOT NULL AUTO_INCREMENT,
  `OilName` int(10) NOT NULL,
  PRIMARY KEY (`oilId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oilliters`
--

INSERT INTO `oilliters` (`oilId`, `OilName`) VALUES
(1, 2),
(2, 4),
(3, 6),
(4, 8),
(5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Date` date NOT NULL,
  `IssueQty` int(11) DEFAULT NULL,
  `IssueLastDate` date DEFAULT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ProductId`, `Qty`, `Date`, `IssueQty`, `IssueLastDate`, `Status`) VALUES
(1, 1, 30, '2023-05-28', 21, '2023-05-28', 2),
(2, 2, 45, '2023-05-28', NULL, NULL, 1),
(3, 2, 45, '2023-05-28', NULL, NULL, 1);

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
  `SellingType` varchar(255) DEFAULT NULL,
  `ProductDescription` text NOT NULL,
  `ProductStatus` int(1) NOT NULL,
  `AddUser` int(11) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `ProductName`, `ProductPrice`, `ProductQty`, `SellingType`, `ProductDescription`, `ProductStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Toyota Oil 15W 30', '1234.00', 10, 'inquiry', 'aa', 1, 1, '2023-04-05', 1, '2023-05-18'),
(2, 'Toyota Oil 15W 40', '1234.00', 10, 'onlineSell', 'fff', 1, 1, '2023-04-05', NULL, NULL),
(3, 'Toyota Oil 10W 30', '11800.00', 10, 'both', 'hh', 1, 1, '2023-04-05', NULL, NULL),
(4, 'Toyota Oil 10W 40', '11800.00', 10, 'onlineSell', 'AAA', 1, 1, '2023-04-05', NULL, NULL),
(5, 'Toyota Oil 15W 45', '1234.00', 10, 'inquiry', 'sef', 1, 1, '2023-04-05', NULL, NULL),
(6, 'Shell Oil', '13400.00', 12, 'onlineSell', 'Product Description', 1, 1, '2023-04-10', NULL, NULL),
(7, 'Toyota Oil 15W 36', '1234.00', 10, 'both', 'uiuiuiu', 1, 1, '2023-04-10', NULL, NULL),
(8, 'Toyota Oil SN 15W 30', '11800.00', 10, 'both', 'tyutututututu', 1, 1, '2023-04-12', NULL, NULL),
(9, 'Toyota Oil 15W 37', '11800.00', 10, 'onlineSell', 'Test Product Description', 1, 1, '2023-04-15', 1, '2023-04-15'),
(10, 'Toyota Oil 15W 30 2L', '11799.99', 10, NULL, 'Product Description', 1, 1, '2023-04-25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productsize`
--

DROP TABLE IF EXISTS `productsize`;
CREATE TABLE IF NOT EXISTS `productsize` (
  `ProductSizeId` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(11) NOT NULL,
  `Size` char(4) NOT NULL,
  PRIMARY KEY (`ProductSizeId`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productsize`
--

INSERT INTO `productsize` (`ProductSizeId`, `ProductId`, `Size`) VALUES
(1, 4, 'S'),
(2, 4, 'M'),
(3, 5, 'S'),
(4, 6, 'S'),
(5, 6, 'M'),
(15, 7, 'S'),
(16, 8, 'S'),
(17, 9, 'S'),
(18, 9, 'M'),
(19, 9, 'L'),
(20, 9, 'XL'),
(93, 10, 'S'),
(97, 1, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `repaircatergory`
--

DROP TABLE IF EXISTS `repaircatergory`;
CREATE TABLE IF NOT EXISTS `repaircatergory` (
  `RepairId` int(11) NOT NULL AUTO_INCREMENT,
  `RepairCode` varchar(255) NOT NULL,
  `RepairName` varchar(255) NOT NULL,
  `RepairPrice` varchar(255) NOT NULL,
  `WarrantyType` varchar(255) DEFAULT NULL,
  `RepairStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`RepairId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repaircatergory`
--

INSERT INTO `repaircatergory` (`RepairId`, `RepairCode`, `RepairName`, `RepairPrice`, `WarrantyType`, `RepairStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, '1', 'Enginee Gasket Repair', '1500', NULL, 1, 1, '2023-04-17', NULL, NULL),
(2, '2', 'Enginee Mount Repair', '1500', NULL, 1, 1, '2023-04-17', NULL, NULL),
(3, '3', 'Turbo Repair', '1200', '6 Month Warranty', 1, 1, '2023-04-17', NULL, NULL),
(4, '4', 'Gear Box Repair', '1500', '6 Month Warranty', 1, 1, '2023-04-20', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `selected_inspectionreports`
--

DROP TABLE IF EXISTS `selected_inspectionreports`;
CREATE TABLE IF NOT EXISTS `selected_inspectionreports` (
  `selectedInspectionReportsId` int(11) NOT NULL AUTO_INCREMENT,
  `InspectionId` int(11) NOT NULL,
  `InspectionStatus` char(255) NOT NULL,
  PRIMARY KEY (`selectedInspectionReportsId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selected_inspectionreports`
--

INSERT INTO `selected_inspectionreports` (`selectedInspectionReportsId`, `InspectionId`, `InspectionStatus`) VALUES
(22, 14, '1'),
(23, 14, '4'),
(24, 15, '1'),
(25, 15, '4');

-- --------------------------------------------------------

--
-- Table structure for table `selected_inspections`
--

DROP TABLE IF EXISTS `selected_inspections`;
CREATE TABLE IF NOT EXISTS `selected_inspections` (
  `SelectedInspectionId` int(11) NOT NULL AUTO_INCREMENT,
  `InspectionNo` varchar(255) NOT NULL,
  `VehicleNo` varchar(255) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Millege` varchar(255) NOT NULL,
  `FuelType` varchar(255) DEFAULT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`SelectedInspectionId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selected_inspections`
--

INSERT INTO `selected_inspections` (`SelectedInspectionId`, `InspectionNo`, `VehicleNo`, `CustomerName`, `Millege`, `FuelType`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(14, '20230423703259503', 'CCA-1244', 'Rajindra 5', '123456KM', NULL, 1, '2023-04-23', NULL, NULL),
(15, '2023-04-2351754221', 'CCA-1240', 'Rajindra 2', '123456KM', NULL, 1, '2023-06-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `ServiceId` int(11) NOT NULL AUTO_INCREMENT,
  `ServiceName` varchar(255) NOT NULL,
  `CatergoryName` varchar(10) NOT NULL,
  `ServiceCost` int(11) NOT NULL,
  `ServicePrice` int(11) NOT NULL,
  `ServiceStatus` int(1) NOT NULL,
  `AddUser` int(10) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(10) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`ServiceId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ServiceId`, `ServiceName`, `CatergoryName`, `ServiceCost`, `ServicePrice`, `ServiceStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Full Service Car', '1', 16500, 22500, 1, 1, '2023-06-13', NULL, NULL),
(2, 'Full qqService Car', '1', 16500, 22500, 1, 1, '2023-06-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `servicetypes`
--

DROP TABLE IF EXISTS `servicetypes`;
CREATE TABLE IF NOT EXISTS `servicetypes` (
  `ServiceTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `Service_Id` int(11) NOT NULL,
  `VCatergory_Id` int(11) NOT NULL,
  `Product_Id` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  PRIMARY KEY (`ServiceTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servicetypes`
--

INSERT INTO `servicetypes` (`ServiceTypeId`, `Service_Id`, `VCatergory_Id`, `Product_Id`, `Qty`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 1, 8, 2),
(3, 2, 1, 1, 1),
(4, 2, 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Product_Id` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Qty` int(11) NOT NULL,
  `SalePrice` decimal(10,2) NOT NULL,
  `Date` date NOT NULL,
  `Status` int(11) NOT NULL,
  `IssueQty` int(11) DEFAULT '0',
  `IssueLastDate` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`Id`, `Product_Id`, `Price`, `Qty`, `SalePrice`, `Date`, `Status`, `IssueQty`, `IssueLastDate`) VALUES
(1, 1, '1400.00', 50, '1690.00', '2023-05-08', 1, 21, '2023-05-28'),
(2, 2, '1300.00', 50, '1590.00', '2023-05-08', 1, 0, NULL),
(3, 1, '1400.00', 50, '1690.00', '2023-05-17', 1, 21, '2023-05-28'),
(4, 1, '100.00', 145, '650.00', '2023-05-27', 1, 21, '2023-05-28'),
(5, 1, '100.00', 145, '650.00', '2023-05-27', 1, 21, '2023-05-28'),
(6, 6, '55000.00', 2, '56000.00', '2023-05-28', 1, 0, NULL),
(7, 7, '5000.00', 10, '6500.00', '2023-06-04', 1, 0, NULL),
(8, 8, '14500.00', 45, '16000.00', '2023-06-20', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
CREATE TABLE IF NOT EXISTS `stockitems` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(100) NOT NULL,
  `Size` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

DROP TABLE IF EXISTS `tbl_city`;
CREATE TABLE IF NOT EXISTS `tbl_city` (
  `CityId` int(11) NOT NULL,
  `DistrictCode` varchar(10) NOT NULL,
  `City` varchar(50) NOT NULL,
  PRIMARY KEY (`CityId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`CityId`, `DistrictCode`, `City`) VALUES
(1, 'CMB', 'Nugegoda'),
(2, 'CMB', 'Battaramulla'),
(3, 'CMB', 'Homagama'),
(4, 'KAN', 'Kandy'),
(5, 'KAN', 'Peradeniya'),
(6, 'MAT', 'Matara');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

DROP TABLE IF EXISTS `tbl_customers`;
CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nic` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`Id`, `nic`, `name`, `address`) VALUES
(1, '925605623v', 'Amila', 'Colombo'),
(2, '95056789v', 'Kamal', 'Matara');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

DROP TABLE IF EXISTS `tbl_district`;
CREATE TABLE IF NOT EXISTS `tbl_district` (
  `district_code` varchar(10) NOT NULL,
  `district_name` varchar(50) NOT NULL,
  PRIMARY KEY (`district_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_code`, `district_name`) VALUES
('CMB', 'Colombo'),
('GAM', 'Gampha'),
('HAM', 'Hambanthota'),
('KAL', 'Kaluthara'),
('KAN', 'Kandy'),
('MAT', 'Matara');

-- --------------------------------------------------------

--
-- Table structure for table `technicianitems`
--

DROP TABLE IF EXISTS `technicianitems`;
CREATE TABLE IF NOT EXISTS `technicianitems` (
  `itemId` int(11) NOT NULL AUTO_INCREMENT,
  `AppointmentId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `RepairId` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  PRIMARY KEY (`itemId`),
  KEY `AppointmentId` (`AppointmentId`),
  KEY `RepairId` (`RepairId`),
  KEY `UserId` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timeslots`
--

DROP TABLE IF EXISTS `timeslots`;
CREATE TABLE IF NOT EXISTS `timeslots` (
  `TimeSlotId` int(11) NOT NULL AUTO_INCREMENT,
  `TimeSlotName` varchar(255) NOT NULL,
  `day_Id` int(11) NOT NULL,
  `TimeSlotStart` time NOT NULL,
  `TimeSlotEnd` time NOT NULL,
  `PerVehicles` int(11) NOT NULL,
  `TimeSlotStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`TimeSlotId`),
  KEY `day_Id` (`day_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeslots`
--

INSERT INTO `timeslots` (`TimeSlotId`, `TimeSlotName`, `day_Id`, `TimeSlotStart`, `TimeSlotEnd`, `PerVehicles`, `TimeSlotStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Monday Morning 1', 1, '08:00:00', '09:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(2, 'Monday Morning 2', 1, '09:15:00', '10:15:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(3, 'Monday Morning 3', 1, '10:30:00', '11:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(4, 'Monday Morning 4', 1, '11:45:00', '12:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(5, 'Monday Evening 1', 1, '13:30:00', '14:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(6, 'Monday Evening 2', 1, '14:45:00', '15:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(7, 'Monday Evening 3', 1, '16:00:00', '17:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(8, 'Tuesday Morning 1', 2, '08:00:00', '09:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(9, 'Tuesday Morning 2', 2, '09:15:00', '10:15:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(10, 'Tuesday Morning 3', 2, '10:30:00', '11:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(11, 'Tuesday Morning 4', 2, '11:45:00', '12:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(12, 'Tuesday Evening 1', 2, '13:30:00', '14:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(13, 'Tuesday Evening 2', 2, '14:45:00', '15:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(14, 'Tuesday Evening 3', 2, '16:00:00', '17:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(15, 'Wednesday Morning 1', 3, '08:00:00', '09:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(16, 'Wednesday Morning 2', 3, '09:15:00', '10:15:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(17, 'Wednesday Morning 3', 3, '10:30:00', '11:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(18, 'Wednesday Morning 4', 3, '11:45:00', '12:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(19, 'Wednesday Evening 1', 3, '13:30:00', '14:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(20, 'Wednesday Evening 2', 3, '14:45:00', '15:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(21, 'Wednesday Evening 3', 3, '16:00:00', '17:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(22, 'Thursday Morning 1', 4, '08:00:00', '09:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(23, 'Thursday Morning 2', 4, '09:15:00', '10:15:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(24, 'Thursday Morning 3', 4, '10:30:00', '11:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(25, 'Thursday Morning 4', 4, '11:45:00', '12:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(26, 'Thursday Evening 1', 4, '13:30:00', '14:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(27, 'Thursday Evening 2', 4, '14:45:00', '15:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(28, 'Thursday Evening 3', 4, '16:00:00', '17:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(29, 'Friday Morning 1', 5, '08:00:00', '09:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(30, 'Friday Morning 2', 5, '09:15:00', '10:15:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(31, 'Friday Morning 3', 5, '10:30:00', '11:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(32, 'Friday Morning 4', 5, '11:45:00', '12:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(33, 'Friday Evening 1', 5, '13:30:00', '14:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(34, 'Friday Evening 2', 5, '14:45:00', '15:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(35, 'Friday Evening 3', 5, '16:00:00', '17:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(36, 'Saturday Morning 1', 6, '08:00:00', '09:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(37, 'Saturday Morning 2', 6, '09:15:00', '10:15:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(38, 'Saturday Morning 3', 6, '10:30:00', '11:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(39, 'Saturday Morning 4', 6, '11:45:00', '12:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(40, 'Saturday Evening 1', 6, '13:30:00', '14:30:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(41, 'Saturday Evening 2', 6, '14:45:00', '15:45:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(42, 'Saturday Evening 3', 6, '16:00:00', '17:00:00', 5, 1, 1, '2023-05-18', NULL, NULL),
(43, 'Sunday Morning 1', 7, '08:00:00', '09:00:00', 5, 0, 1, '2023-05-18', NULL, NULL),
(44, 'Sunday Morning 2', 7, '09:15:00', '10:15:00', 5, 0, 1, '2023-05-18', NULL, NULL),
(45, 'Sunday Morning 3', 7, '10:30:00', '11:30:00', 5, 0, 1, '2023-05-18', NULL, NULL),
(46, 'Sunday Morning 4', 7, '11:45:00', '12:45:00', 5, 0, 1, '2023-05-18', NULL, NULL),
(47, 'Sunday Evening 1', 7, '13:30:00', '14:30:00', 5, 0, 1, '2023-05-18', NULL, NULL),
(48, 'Sunday Evening 2', 7, '14:45:00', '15:45:00', 5, 0, 1, '2023-05-18', NULL, NULL),
(49, 'Sunday Evening 3', 7, '16:00:00', '17:00:00', 5, 0, 1, '2023-05-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

DROP TABLE IF EXISTS `title`;
CREATE TABLE IF NOT EXISTS `title` (
  `titleId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(5) NOT NULL,
  PRIMARY KEY (`titleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`titleId`, `Name`) VALUES
(1, 'Mr.'),
(2, 'Mrs.'),
(3, 'Miss.'),
(4, 'Rev.');

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
  `Gender` varchar(10) NOT NULL,
  `NIC` varchar(12) NOT NULL,
  `Status` int(1) NOT NULL,
  `passwordreset` varchar(255) DEFAULT NULL,
  `AddUser` int(11) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Title`, `FirstName`, `LastName`, `Email`, `Password`, `UserRole`, `HouseNo`, `Lane`, `Street`, `City`, `Gender`, `NIC`, `Status`, `passwordreset`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Mr.', 'Rajindra', 'Tharindu', 'rajindratharindu@gmail.com', '39b947de5b295a150eaed0b1af60a2316e17a687', 'admin', '136/1,', 'Horahena Road, ', 'Rukmale,', 'Pannipitiya.', '', '88777777', 1, '6486238ee47e3', 1, '2023-03-17', 1, '2023-06-11'),
(2, 'Mr.', 'Tharindu', 'Kumara', 'tharindu@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'manager', '136', 'r', 'r', 'r', '', '88777777', 1, '648610eeb46c4', 1, '2023-03-20', NULL, '2023-06-11'),
(3, 'Mr.', 'Kumara', 'Perera', 'kumara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', '136', 'r', 'r', 'r', '', '88777777', 1, '', 1, '2023-03-20', NULL, NULL),
(4, 'Mr.', 'Thiwanka', 'Madushan', 'thiwanka@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'supervisor', '146', 'Munamalle watta', 'Kaluaggala', 'Hanwella', '1', '1111111', 1, '', 1, '2023-06-10', NULL, NULL),
(5, 'Mr.', 'Tharindu', 'Saumya', 'saumya@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'inspectionOfficer', '1', 'Hokandara East', 'Hokandara', 'Pannipitiya', '1', '982130240V', 1, '', NULL, NULL, NULL, NULL),
(6, 'Mr.', 'Chulochana', 'Sandeepa', 'chulochana@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'stockKeeper', '25', 'Amuatamulla Road', 'Kottawa', 'Pannipitiya', '1', '199821300140', 1, '', NULL, NULL, NULL, NULL),
(7, 'Mr.', 'Athukorala', 'Perera', 'athukorala@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', '132', 'Horahena Road', 'Rukmale', 'Pannipitiya', '1', '70667716V', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicletype`
--

DROP TABLE IF EXISTS `vehicletype`;
CREATE TABLE IF NOT EXISTS `vehicletype` (
  `vehicleId` int(11) NOT NULL AUTO_INCREMENT,
  `VehicleTypeName` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`vehicleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_catergories`
--

DROP TABLE IF EXISTS `vehicle_catergories`;
CREATE TABLE IF NOT EXISTS `vehicle_catergories` (
  `VCatergoryId` int(11) NOT NULL AUTO_INCREMENT,
  `CatergoryName` varchar(10) NOT NULL,
  `CatergoryStatus` int(1) NOT NULL,
  `AddUser` int(10) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(10) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`VCatergoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_catergories`
--

INSERT INTO `vehicle_catergories` (`VCatergoryId`, `CatergoryName`, `CatergoryStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'CAR', 1, 1, '2023-05-09', NULL, NULL),
(2, 'VAN', 1, 1, '2023-06-13', NULL, NULL),
(3, 'SUV', 1, 1, '2023-06-13', NULL, NULL),
(4, 'BUS', 1, 1, '2023-06-13', NULL, NULL),
(5, 'LORRY', 1, 1, '2023-06-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warranty`
--

DROP TABLE IF EXISTS `warranty`;
CREATE TABLE IF NOT EXISTS `warranty` (
  `WarrentyId` int(11) NOT NULL AUTO_INCREMENT,
  `WarrentyName` varchar(255) NOT NULL,
  `Duration` varchar(255) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`WarrentyId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warranty`
--

INSERT INTO `warranty` (`WarrentyId`, `WarrentyName`, `Duration`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, '6 Month Warranty', '6 month', 1, '2023-04-17', NULL, NULL),
(2, '12 month Warranty', '12 month', 1, '2023-04-17', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointmenthandling`
--
ALTER TABLE `appointmenthandling`
  ADD CONSTRAINT `appointmenthandling_ibfk_1` FOREIGN KEY (`TimeSlotId`) REFERENCES `timeslots` (`TimeSlotId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `appointmenthandling_ibfk_2` FOREIGN KEY (`AppointmentId`) REFERENCES `appointments` (`AppointmentId`) ON UPDATE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`TimeSlotStart`) REFERENCES `timeslots` (`TimeSlotId`) ON UPDATE CASCADE;

--
-- Constraints for table `customer_mobile`
--
ALTER TABLE `customer_mobile`
  ADD CONSTRAINT `customer_mobile_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`CustomerID`) ON UPDATE CASCADE;

--
-- Constraints for table `technicianitems`
--
ALTER TABLE `technicianitems`
  ADD CONSTRAINT `technicianitems_ibfk_1` FOREIGN KEY (`AppointmentId`) REFERENCES `appointments` (`AppointmentId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `technicianitems_ibfk_2` FOREIGN KEY (`RepairId`) REFERENCES `repaircatergory` (`RepairId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `technicianitems_ibfk_3` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON UPDATE CASCADE;

--
-- Constraints for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD CONSTRAINT `timeslots_ibfk_1` FOREIGN KEY (`day_Id`) REFERENCES `days` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
