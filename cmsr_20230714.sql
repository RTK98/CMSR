-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2023 at 09:59 PM
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
-- Table structure for table `appointmentcanceled`
--

DROP TABLE IF EXISTS `appointmentcanceled`;
CREATE TABLE IF NOT EXISTS `appointmentcanceled` (
  `CanceledId` int(11) NOT NULL AUTO_INCREMENT,
  `AppCanceledId` int(11) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `AddUser` int(11) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `AddCustomer` int(11) DEFAULT NULL,
  `AddCustomerDate` date DEFAULT NULL,
  PRIMARY KEY (`CanceledId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointmentcanceled`
--

INSERT INTO `appointmentcanceled` (`CanceledId`, `AppCanceledId`, `Reason`, `AddUser`, `AddDate`, `AddCustomer`, `AddCustomerDate`) VALUES
(1, 26, 'Change my mind', NULL, NULL, 1, '2023-07-10'),
(2, 27, 'Change my mind', NULL, NULL, 1, '2023-07-10'),
(3, 28, 'Change my mind', NULL, NULL, 1, '2023-07-10'),
(4, 29, 'Change my mind', NULL, NULL, 1, '2023-07-10'),
(5, 30, 'Test', NULL, NULL, 1, '2023-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `appointmenthandling`
--

DROP TABLE IF EXISTS `appointmenthandling`;
CREATE TABLE IF NOT EXISTS `appointmenthandling` (
  `AppHandling` int(11) NOT NULL AUTO_INCREMENT,
  `TimeSlotId` int(11) NOT NULL,
  `AppointmentId` int(11) DEFAULT NULL,
  `Vehicle_Id` int(11) NOT NULL,
  `AppDate` date NOT NULL,
  PRIMARY KEY (`AppHandling`),
  KEY `AppointmentId` (`AppointmentId`),
  KEY `TimeSlotId` (`TimeSlotId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointmenthandling`
--

INSERT INTO `appointmenthandling` (`AppHandling`, `TimeSlotId`, `AppointmentId`, `Vehicle_Id`, `AppDate`) VALUES
(1, 29, 1, 18, '2023-06-23'),
(2, 36, 2, 18, '2023-06-24'),
(3, 36, 3, 18, '2023-06-24'),
(4, 36, 4, 18, '2023-06-24'),
(5, 36, 5, 18, '2023-06-24'),
(6, 37, 6, 18, '2023-06-24'),
(7, 34, 7, 18, '2023-06-23'),
(8, 34, 8, 16, '2023-06-23'),
(9, 36, 9, 5, '2023-06-24'),
(10, 7, 10, 18, '2023-06-26'),
(11, 7, 11, 16, '2023-06-26'),
(12, 7, 12, 4, '2023-06-26'),
(13, 8, 13, 18, '2023-06-27'),
(14, 9, 14, 18, '2023-06-27'),
(15, 9, 15, 5, '2023-06-27'),
(16, 9, 16, 16, '2023-06-27'),
(17, 14, 17, 18, '2023-06-27'),
(18, 14, 18, 16, '2023-06-27'),
(19, 29, 19, 18, '2023-06-30'),
(20, 36, 20, 2, '2023-07-01'),
(21, 47, 21, 18, '2023-07-02'),
(22, 1, 22, 18, '2023-07-03'),
(23, 5, 23, 18, '2023-07-03'),
(24, 15, 24, 18, '2023-07-12'),
(25, 8, 25, 3, '2023-07-11');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`AppointmentId`, `AppointmentNo`, `CustomerID`, `VehicleNo`, `AppDate`, `TimeSlotStart`, `ServiceType`, `appointmentStatus`, `AddUser`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'APP202306231361', 1, 18, '2023-06-23', 29, '1', 1, NULL, NULL, NULL),
(2, 'APP202306239054', 1, 18, '2023-06-24', 36, '1', 2, NULL, NULL, NULL),
(3, 'APP202306238327', 1, 18, '2023-06-24', 36, '1', 1, NULL, NULL, NULL),
(4, 'APP202306236625', 1, 18, '2023-06-24', 36, '1', 1, NULL, NULL, NULL),
(5, 'APP202306235060', 1, 18, '2023-06-24', 36, '1', 1, NULL, NULL, NULL),
(6, 'APP202306232912', 1, 18, '2023-06-24', 37, '1', 1, NULL, NULL, NULL),
(7, 'APP202306232259', 1, 18, '2023-06-23', 34, '1', 1, NULL, NULL, NULL),
(8, 'APP202306231159', 1, 16, '2023-06-23', 34, '1', 1, NULL, NULL, NULL),
(9, 'APP202306234701', 1, 5, '2023-06-24', 36, '1', 1, NULL, NULL, NULL),
(10, 'APP202306264579', 1, 18, '2023-06-26', 7, '1', 1, NULL, NULL, NULL),
(11, 'APP202306268467', 1, 16, '2023-06-26', 7, '1', 1, NULL, NULL, NULL),
(12, 'APP202306264827', 1, 4, '2023-06-26', 7, '1', 2, NULL, NULL, NULL),
(13, 'APP202306266600', 1, 18, '2023-06-27', 8, '1', 1, NULL, NULL, NULL),
(14, 'APP202306261137', 1, 18, '2023-06-27', 9, '1', 1, NULL, NULL, NULL),
(15, 'APP202306264849', 1, 5, '2023-06-27', 9, '1', 1, NULL, NULL, NULL),
(16, 'APP202306264312', 1, 16, '2023-06-27', 9, '2', 1, NULL, NULL, NULL),
(17, 'APP202306272212', 1, 18, '2023-06-27', 14, '1', 1, NULL, NULL, NULL),
(18, 'APP202306277441', 1, 16, '2023-06-27', 14, '2', 1, NULL, NULL, NULL),
(19, 'APP202306298985', 1, 18, '2023-06-30', 29, '1', 1, NULL, NULL, NULL),
(20, 'APP202306307731', 1, 2, '2023-07-01', 36, '1', 1, NULL, NULL, NULL),
(21, 'APP202307029398', 1, 18, '2023-07-02', 47, '1', 4, NULL, NULL, NULL),
(22, 'APP202307023824', 1, 18, '2023-07-03', 1, '1', 3, NULL, NULL, NULL),
(23, 'APP202307036792', 1, 18, '2023-07-03', 5, '1', 2, NULL, NULL, NULL),
(24, 'APP202307104648', 1, 18, '2023-07-12', 15, '1', 1, NULL, NULL, NULL),
(25, 'APP202307108213', 1, 3, '2023-07-11', 8, '1', 1, NULL, NULL, NULL),
(26, 'APP202307104482', 1, 18, '2023-07-13', 22, '1', 4, NULL, NULL, NULL),
(27, 'APP202307102150', 1, 16, '2023-07-14', 29, '1', 4, NULL, NULL, NULL),
(28, 'APP202307105954', 1, 18, '2023-07-13', 22, '1', 4, NULL, NULL, NULL),
(29, 'APP202307108685', 1, 18, '2023-07-13', 22, '1', 4, NULL, NULL, NULL),
(30, 'APP202307102252', 1, 5, '2023-07-14', 29, '1', 4, NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

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
(9, 2, '18:09', '2023-06-12', NULL, NULL, 1),
(10, 8, '02:29', '2023-06-30', NULL, NULL, 1),
(11, 2, '11:29', '2023-06-30', NULL, NULL, 1),
(12, 2, '18:20', '2023-07-01', NULL, NULL, 1),
(13, 2, '09:52', '2023-07-02', NULL, NULL, 1),
(14, 2, '00:38', '2023-07-03', NULL, NULL, 1),
(15, 2, '09:32', '2023-07-03', NULL, NULL, 1),
(16, 8, '13:28', '2023-07-03', NULL, NULL, 1),
(17, 2, '19:17', '2023-07-03', NULL, NULL, 1),
(18, 8, '19:18', '2023-07-03', NULL, NULL, 1),
(19, 5, '22:36', '2023-07-03', NULL, NULL, 1),
(20, 2, '22:44', '2023-07-03', NULL, NULL, 1),
(21, 5, '00:00', '2023-07-04', NULL, NULL, 1),
(22, 5, '13:09', '2023-07-04', NULL, NULL, 1),
(23, 5, '16:11', '2023-07-04', NULL, NULL, 1),
(24, 8, '14:57', '2023-07-06', NULL, NULL, 1),
(25, 5, '14:58', '2023-07-06', NULL, NULL, 1),
(26, 2, '17:35', '2023-07-06', NULL, NULL, 1),
(27, 5, '17:40', '2023-07-06', NULL, NULL, 1),
(28, 5, '00:46', '2023-07-07', NULL, NULL, 1),
(29, 2, '17:14', '2023-07-07', NULL, NULL, 1),
(30, 5, '17:16', '2023-07-07', NULL, NULL, 1),
(31, 2, '14:54', '2023-07-08', NULL, NULL, 1),
(32, 5, '15:06', '2023-07-08', NULL, NULL, 1),
(33, 1, '18:55', '2023-07-08', NULL, NULL, 1),
(34, 9, '18:57', '2023-07-08', NULL, NULL, 1),
(35, 5, '21:11', '2023-07-08', NULL, NULL, 1),
(36, 5, '01:08', '2023-07-09', NULL, NULL, 1),
(37, 5, '14:03', '2023-07-10', NULL, NULL, 1),
(38, 2, '20:25', '2023-07-10', NULL, NULL, 1),
(39, 2, '23:03', '2023-07-10', NULL, NULL, 1),
(40, 5, '23:04', '2023-07-10', NULL, NULL, 1),
(41, 1, '01:09', '2023-07-11', NULL, NULL, 1),
(42, 5, '01:10', '2023-07-11', NULL, NULL, 1),
(43, 5, '01:40', '2023-07-11', NULL, NULL, 1),
(44, 5, '12:12', '2023-07-11', NULL, NULL, 1),
(45, 2, '17:57', '2023-07-11', NULL, NULL, 1),
(46, 3, '18:01', '2023-07-11', NULL, NULL, 1),
(47, 4, '18:01', '2023-07-11', NULL, NULL, 1),
(48, 2, '19:53', '2023-07-11', NULL, NULL, 1),
(49, 5, '19:53', '2023-07-11', NULL, NULL, 1),
(50, 2, '20:43', '2023-07-11', NULL, NULL, 1),
(51, 7, '21:50', '2023-07-11', NULL, NULL, 1),
(52, 2, '01:37', '2023-07-12', NULL, NULL, 1),
(53, 7, '02:10', '2023-07-12', NULL, NULL, 1),
(54, 1, '02:43', '2023-07-12', NULL, NULL, 1),
(55, 6, '19:46', '2023-07-12', NULL, NULL, 1),
(56, 5, '21:24', '2023-07-12', NULL, NULL, 1),
(57, 1, '22:58', '2023-07-12', NULL, NULL, 1),
(58, 5, '23:19', '2023-07-12', NULL, NULL, 1),
(59, 1, '23:22', '2023-07-12', NULL, NULL, 1),
(60, 2, '00:40', '2023-07-13', NULL, NULL, 1),
(61, 5, '13:06', '2023-07-13', NULL, NULL, 1),
(62, 7, '13:08', '2023-07-13', NULL, NULL, 1),
(63, 6, '13:24', '2023-07-13', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `batchno`
--

DROP TABLE IF EXISTS `batchno`;
CREATE TABLE IF NOT EXISTS `batchno` (
  `BatchId` int(11) NOT NULL AUTO_INCREMENT,
  `BatchNo` varchar(255) DEFAULT NULL,
  `SupplierId` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  PRIMARY KEY (`BatchId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batchno`
--

INSERT INTO `batchno` (`BatchId`, `BatchNo`, `SupplierId`, `CategoryId`, `ProductId`, `AddUser`, `AddDate`) VALUES
(1, 'BC230713S1C4P10001', 1, 4, 1, 6, '2023-07-13'),
(2, 'BC230713S1C4P20002\n', 1, 4, 2, 6, '2023-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `bestskills`
--

DROP TABLE IF EXISTS `bestskills`;
CREATE TABLE IF NOT EXISTS `bestskills` (
  `bestSkillsId` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`bestSkillsId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bestskills`
--

INSERT INTO `bestskills` (`bestSkillsId`, `emp_id`, `skill_id`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(2, 3, 4, 2, '2023-06-29', NULL, NULL),
(3, 8, 4, 2, '2023-06-29', NULL, NULL),
(4, 3, 7, 2, '2023-06-29', NULL, NULL),
(5, 8, 6, 2, '2023-06-29', NULL, NULL),
(8, 8, 7, 2, '2023-06-29', NULL, NULL),
(9, 7, 2, 2, '2023-06-29', NULL, NULL),
(10, 7, 3, 2, '2023-06-29', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Email`, `Password`, `NIC`, `FirstName`, `LastName`, `HouseNo`, `Lane`, `Street`, `City`, `Gender`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'rajindratharindu@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '982130140V', 'B.A.W.A.Rajindra', 'Tharindu', '136', 'Horahena Road', 'Rukmale', 'Pannipitiya', '1', 1, NULL, NULL, NULL, NULL),
(2, 'pasan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1111100000', 'Pasan', 'Manahara', '134', 'G', 'H', 'Pannipitiya', '1', 1, NULL, NULL, NULL, NULL),
(3, 'himansa@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1111100444', 'Himansa', 'Kavyanjalee', '135', 'ha', 'hf', 'Colombo', '1', 1, NULL, NULL, NULL, NULL),
(4, 'sakuni@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '981143426V', 'Sakuni', 'Hegodage', '305/D/3', 'Gonamadiththa Road', 'Kesbawa', 'Kesbawa', '2', 1, NULL, NULL, NULL, NULL),
(5, 'charanamj@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '199726301299', 'Charana', 'Jayakody', '447/21', 'Grama Sanwaradana Lane', 'Kottawa Road', 'Athurugiriya', '1', 1, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

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
(18, 1, 'Evolution IX MR', '64905a2f2da760.45259199.jpg', 1, 'KX', '9999'),
(19, 4, 'Subaru Sti 9', '64a4321a3e1a35.95457287.jpg', 1, 'KS', '1234'),
(20, 5, 'Maruti Alto', '64a7b8f2d2db86.62529498.jpg', 1, 'CAO', '9609');

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
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `depId` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`depId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depId`, `DepartmentName`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Managment', 1, 2, '2023-06-27', NULL, NULL),
(2, 'Service', 1, 2, '2023-06-27', NULL, NULL),
(3, 'Repair', 1, 2, '2023-06-27', NULL, NULL),
(4, 'Accounts', 1, 2, '2023-06-27', NULL, NULL),
(5, 'Stock', 1, 2, '2023-06-27', NULL, NULL);

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
-- Table structure for table `estimate`
--

DROP TABLE IF EXISTS `estimate`;
CREATE TABLE IF NOT EXISTS `estimate` (
  `EstimateID` int(11) NOT NULL AUTO_INCREMENT,
  `EstimateNo` varchar(255) NOT NULL,
  `InspectionId` int(11) NOT NULL,
  `EstimateStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateCustomer` int(11) DEFAULT NULL,
  `UpdateCusDate` date DEFAULT NULL,
  PRIMARY KEY (`EstimateID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estimate`
--

INSERT INTO `estimate` (`EstimateID`, `EstimateNo`, `InspectionId`, `EstimateStatus`, `AddUser`, `AddDate`, `UpdateCustomer`, `UpdateCusDate`) VALUES
(1, 'EST202307113209', 4, 1, 5, '2023-07-11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `estimateitems`
--

DROP TABLE IF EXISTS `estimateitems`;
CREATE TABLE IF NOT EXISTS `estimateitems` (
  `estimateItemID` int(11) NOT NULL AUTO_INCREMENT,
  `estimateID` int(11) NOT NULL,
  `ProdcutId` int(11) DEFAULT NULL,
  `RepairId` int(11) DEFAULT NULL,
  `Qty` int(11) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  PRIMARY KEY (`estimateItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estimateitems`
--

INSERT INTO `estimateitems` (`estimateItemID`, `estimateID`, `ProdcutId`, `RepairId`, `Qty`, `Amount`) VALUES
(1, 1, 1, NULL, 2, '1690.00'),
(2, 1, 2, NULL, 2, '1590.00'),
(3, 1, NULL, 1, 1, '1500');

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
(1, 'Cloed', '2023-07-10', '10:59:00', 1, 1, '2023-04-10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inspectioncatergory`
--

DROP TABLE IF EXISTS `inspectioncatergory`;
CREATE TABLE IF NOT EXISTS `inspectioncatergory` (
  `insCatId` int(11) NOT NULL AUTO_INCREMENT,
  `INSname` varchar(255) NOT NULL,
  `INSstatus` int(1) NOT NULL,
  PRIMARY KEY (`insCatId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectioncatergory`
--

INSERT INTO `inspectioncatergory` (`insCatId`, `INSname`, `INSstatus`) VALUES
(1, 'engine', 1),
(2, 'electrical', 1),
(3, 'gear box', 1),
(4, 'body', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspectioncustomerselected`
--

DROP TABLE IF EXISTS `inspectioncustomerselected`;
CREATE TABLE IF NOT EXISTS `inspectioncustomerselected` (
  `InsCusSelectedId` int(11) NOT NULL AUTO_INCREMENT,
  `Inspecion_id` int(11) NOT NULL,
  `InspectionItem_Id` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddUser` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`InsCusSelectedId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectioncustomerselected`
--

INSERT INTO `inspectioncustomerselected` (`InsCusSelectedId`, `Inspecion_id`, `InspectionItem_Id`, `AddDate`, `AddUser`, `Status`) VALUES
(2, 1, 1, '2023-07-07', 5, 1),
(3, 1, 3, '2023-07-07', 5, 1),
(6, 2, 2, '2023-07-07', 5, 1),
(7, 2, 3, '2023-07-07', 5, 1),
(8, 2, 4, '2023-07-07', 5, 1),
(9, 3, 1, '2023-07-11', 5, 1),
(10, 3, 4, '2023-07-11', 5, 1),
(11, 4, 2, '2023-07-11', 5, 1),
(12, 4, 4, '2023-07-11', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspectionitems`
--

DROP TABLE IF EXISTS `inspectionitems`;
CREATE TABLE IF NOT EXISTS `inspectionitems` (
  `InspectionItemId` int(11) NOT NULL AUTO_INCREMENT,
  `InsItemName` varchar(255) NOT NULL,
  `insCat_Id` int(11) NOT NULL,
  `InsItemStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`InspectionItemId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectionitems`
--

INSERT INTO `inspectionitems` (`InspectionItemId`, `InsItemName`, `insCat_Id`, `InsItemStatus`, `AddUser`, `AddDate`, `UpdateDate`) VALUES
(1, 'engine oil level', 1, 1, 2, '2023-07-03', NULL),
(2, 'head light (working)', 2, 1, 2, '2023-07-03', NULL),
(3, 'clutch (working)', 3, 1, 2, '2023-07-03', NULL),
(4, 'fron left door damage', 4, 1, 2, '2023-07-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inspectionrecord`
--

DROP TABLE IF EXISTS `inspectionrecord`;
CREATE TABLE IF NOT EXISTS `inspectionrecord` (
  `InsRecId` int(11) NOT NULL AUTO_INCREMENT,
  `InspectionId` int(11) NOT NULL,
  `InspectionItemId` int(11) NOT NULL,
  `VehicleCondition` int(1) NOT NULL,
  PRIMARY KEY (`InsRecId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectionrecord`
--

INSERT INTO `inspectionrecord` (`InsRecId`, `InspectionId`, `InspectionItemId`, `VehicleCondition`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 3, 2),
(4, 1, 4, 3),
(5, 2, 1, 1),
(6, 2, 2, 1),
(7, 2, 3, 3),
(8, 2, 4, 1),
(9, 3, 1, 3),
(10, 3, 2, 2),
(11, 3, 3, 2),
(12, 3, 4, 1),
(13, 4, 1, 1),
(14, 4, 2, 2),
(15, 4, 3, 2),
(16, 4, 4, 3);

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
  `inspectionNotes` varchar(255) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`InspectionId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`InspectionId`, `InspectionNo`, `VehicleNo`, `CustomerName`, `Millege`, `FuelType`, `inspectionNotes`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'INS202307043514', '19', '4', '123456KM', NULL, '', 5, 5, '2023-07-04', NULL, NULL),
(2, 'INS202307071173', '20', '5', '23456', NULL, '', 2, 5, '2023-07-07', NULL, NULL),
(3, 'INS202307117531', '20', '5', '1245678', NULL, 'test description', 1, 5, '2023-07-11', NULL, NULL),
(4, 'INS202307119961', '19', '4', '123456KM', NULL, 'Test', 5, 5, '2023-07-11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inspectionsestimateitems`
--

DROP TABLE IF EXISTS `inspectionsestimateitems`;
CREATE TABLE IF NOT EXISTS `inspectionsestimateitems` (
  `estimateitemid` int(11) NOT NULL AUTO_INCREMENT,
  `estimateinspectionid` int(11) NOT NULL,
  `addedproductid` int(11) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `addeduser` int(11) NOT NULL,
  `addeddate` date NOT NULL,
  `estimatedtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`estimateitemid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectionsestimateitems`
--

INSERT INTO `inspectionsestimateitems` (`estimateitemid`, `estimateinspectionid`, `addedproductid`, `Qty`, `addeduser`, `addeddate`, `estimatedtimestamp`) VALUES
(4, 2, 1, 1, 5, '2023-07-09', '2023-07-08 22:52:12'),
(6, 3, 4, 1, 5, '2023-07-11', '2023-07-10 18:35:53'),
(18, 4, 2, 1, 5, '2023-07-12', '2023-07-12 17:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `inspectionsestimateitemsrepair`
--

DROP TABLE IF EXISTS `inspectionsestimateitemsrepair`;
CREATE TABLE IF NOT EXISTS `inspectionsestimateitemsrepair` (
  `insEstimatedRepairId` int(11) NOT NULL AUTO_INCREMENT,
  `insEstimatedInspectionId` int(11) NOT NULL,
  `addedrepairid` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `estimatedtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AddUser` int(11) NOT NULL,
  PRIMARY KEY (`insEstimatedRepairId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectionsestimateitemsrepair`
--

INSERT INTO `inspectionsestimateitemsrepair` (`insEstimatedRepairId`, `insEstimatedInspectionId`, `addedrepairid`, `Qty`, `AddDate`, `estimatedtimestamp`, `AddUser`) VALUES
(1, 3, 1, 1, '2023-07-11', '2023-07-10 18:36:09', 5);

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
  `empId` int(11) NOT NULL,
  `AppDate` date NOT NULL,
  `AppointmentNo` varchar(255) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `VehicleNo` varchar(50) NOT NULL,
  `CustomerNo` int(11) NOT NULL,
  `timeslotidappointment` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_cards`
--

INSERT INTO `job_cards` (`id`, `AppointmentId`, `empId`, `AppDate`, `AppointmentNo`, `CustomerId`, `VehicleNo`, `CustomerNo`, `timeslotidappointment`, `Status`) VALUES
(1, 1, 0, '2023-05-18', '202305181402684869', 1, '1', 1, 0, 0),
(2, 6, 0, '2023-05-30', '20230526290541435', 1, '1', 1, 0, 0),
(3, 2, 0, '2023-05-18', '202305181497302576', 1, '2', 1, 0, 1),
(4, 8, 0, '2023-06-04', '202306042005706932', 2, '8', 2, 0, 0),
(5, 18, 0, '2023-06-27', 'APP202306277441', 1, '16', 1, 0, 0),
(6, 21, 8, '2023-07-02', 'APP202307029398', 1, '18', 1, 47, 0),
(7, 22, 8, '2023-07-03', 'APP202307023824', 1, '18', 1, 1, 2),
(8, 23, 8, '2023-07-03', 'APP202307036792', 1, '18', 1, 5, 1),
(9, 2, 8, '2023-06-24', 'APP202306239054', 1, '18', 1, 36, 0),
(10, 6, 8, '2023-06-24', 'APP202306232912', 1, '18', 1, 37, 0),
(11, 12, 8, '2023-06-26', 'APP202306264827', 1, '4', 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_cardsrepair`
--

DROP TABLE IF EXISTS `job_cardsrepair`;
CREATE TABLE IF NOT EXISTS `job_cardsrepair` (
  `jobCardsRepairId` int(11) NOT NULL AUTO_INCREMENT,
  `JobCardNo` varchar(255) NOT NULL,
  `InspectionId` int(11) NOT NULL,
  `empId` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddTime` time NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateTime` time DEFAULT NULL,
  PRIMARY KEY (`jobCardsRepairId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_cardsrepair`
--

INSERT INTO `job_cardsrepair` (`jobCardsRepairId`, `JobCardNo`, `InspectionId`, `empId`, `Status`, `AddUser`, `AddDate`, `AddTime`, `UpdateUser`, `UpdateDate`, `UpdateTime`) VALUES
(1, 'JCR202307124923', 4, 7, 1, 4, '2023-07-12', '02:01:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nskills`
--

DROP TABLE IF EXISTS `nskills`;
CREATE TABLE IF NOT EXISTS `nskills` (
  `nSkillsId` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`nSkillsId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nskills`
--

INSERT INTO `nskills` (`nSkillsId`, `emp_id`, `skill_id`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 3, 4, 2, '2023-06-29', NULL, NULL),
(2, 3, 5, 2, '2023-06-29', NULL, NULL),
(3, 3, 6, 2, '2023-06-29', NULL, NULL),
(4, 8, 5, 2, '2023-06-29', NULL, NULL),
(5, 3, 7, 2, '2023-06-29', NULL, NULL),
(6, 8, 7, 2, '2023-06-29', NULL, NULL),
(7, 7, 1, 2, '2023-06-29', NULL, NULL),
(8, 7, 8, 2, '2023-06-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nskillsrepair`
--

DROP TABLE IF EXISTS `nskillsrepair`;
CREATE TABLE IF NOT EXISTS `nskillsrepair` (
  `nSkillsRepairId` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`nSkillsRepairId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nskillsrepair`
--

INSERT INTO `nskillsrepair` (`nSkillsRepairId`, `emp_id`, `skill_id`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 7, 1, 2, '2023-06-29', NULL, NULL),
(2, 7, 1, 2, '2023-06-29', NULL, NULL),
(3, 7, 1, 2, '2023-06-29', NULL, NULL),
(4, 7, 1, 2, '2023-06-29', NULL, NULL),
(5, 7, 1, 2, '2023-06-29', NULL, NULL);

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
  `ProductCatergory` int(11) NOT NULL,
  `SupplierName` int(11) NOT NULL,
  `ProductDescription` text NOT NULL,
  `Qty` int(11) DEFAULT '0',
  `IssuedQty` int(11) DEFAULT '0',
  `IssueLastDate` date DEFAULT NULL,
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

INSERT INTO `products` (`ProductId`, `ProductName`, `ProductCatergory`, `SupplierName`, `ProductDescription`, `Qty`, `IssuedQty`, `IssueLastDate`, `ProductStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Toyota Oil 15W 30', 4, 1, 'aa', 3, 0, NULL, 1, 1, '2023-04-05', 1, '2023-05-18'),
(2, 'Toyota Oil 15W 40', 4, 1, 'fff', 0, 0, NULL, 1, 1, '2023-04-05', NULL, NULL),
(3, 'Toyota Oil 10W 30', 4, 1, 'hh', 0, 0, NULL, 1, 1, '2023-04-05', NULL, NULL),
(4, 'Toyota Oil 10W 40', 4, 1, 'AAA', 0, 0, NULL, 1, 1, '2023-04-05', NULL, NULL),
(5, 'Toyota Oil 15W 45', 4, 1, 'sef', 0, 0, NULL, 1, 1, '2023-04-05', NULL, NULL),
(6, 'Mitsubishi Lancer Evo 6 Rear Shob', 5, 2, 'Product Description', 0, 0, NULL, 1, 1, '2023-04-10', NULL, NULL),
(7, 'Toyota Oil 15W 36', 4, 1, 'uiuiuiu', 0, 0, NULL, 1, 1, '2023-04-10', NULL, NULL),
(8, 'Toyota Glanza Rear Shob', 5, 1, 'tyutututututu', 0, 0, NULL, 1, 1, '2023-04-12', NULL, NULL),
(9, 'Toyota Oil 15W 37', 4, 1, 'Test Product Description', 0, 0, NULL, 1, 1, '2023-04-15', 1, '2023-04-15'),
(10, 'Toyota Oil 15W 30 2L', 4, 1, 'Product Description', 0, 0, NULL, 1, 1, '2023-04-25', NULL, NULL);

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
(1, 'Full Service', '1', 16500, 22500, 1, 1, '2023-06-13', NULL, NULL),
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
-- Table structure for table `skillcatergory`
--

DROP TABLE IF EXISTS `skillcatergory`;
CREATE TABLE IF NOT EXISTS `skillcatergory` (
  `SCatergoryId` int(11) NOT NULL AUTO_INCREMENT,
  `CatergoryName` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`SCatergoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skillcatergory`
--

INSERT INTO `skillcatergory` (`SCatergoryId`, `CatergoryName`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Service', 1, 2, '2023-06-27', NULL, NULL),
(2, 'Repair', 1, 2, '2023-06-27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `SId` int(11) NOT NULL AUTO_INCREMENT,
  `SkillName` varchar(255) NOT NULL,
  `SCatergory_Id` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(1) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`SId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`SId`, `SkillName`, `SCatergory_Id`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Engine Repair', 2, 1, 2, '2023-06-27', NULL, NULL),
(2, 'Engine Tuneup', 2, 1, 2, '2023-06-27', NULL, NULL),
(3, 'Gear Box Repair', 2, 1, 2, '2023-06-27', NULL, NULL),
(4, 'Body Wash', 1, 1, 2, '2023-06-27', NULL, NULL),
(5, 'Under Wash', 1, 1, 2, '2023-06-27', NULL, NULL),
(6, 'interior Cleaning', 1, 1, 2, '2023-06-27', NULL, NULL),
(7, 'Oil Change Service', 1, 1, 2, '2023-06-27', NULL, NULL),
(8, 'Oil Change Repair', 2, 1, 2, '2023-06-27', NULL, NULL),
(9, 'Injector Cleaning', 2, 1, 2, '2023-06-27', NULL, NULL),
(10, 'Turbo Repair', 2, 1, 2, '2023-06-27', NULL, NULL);

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
  `StockId` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierName` int(11) NOT NULL,
  `CatergoryName` int(11) NOT NULL,
  `ProductName` int(11) NOT NULL,
  `BatchNo` int(11) NOT NULL,
  `SerialNo` varchar(255) NOT NULL,
  `Cost` float(11,2) NOT NULL,
  `SalePrice` float(11,2) NOT NULL,
  `MfgDate` date NOT NULL,
  `ExpDate` date NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  PRIMARY KEY (`StockId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockitems`
--

INSERT INTO `stockitems` (`StockId`, `SupplierName`, `CatergoryName`, `ProductName`, `BatchNo`, `SerialNo`, `Cost`, `SalePrice`, `MfgDate`, `ExpDate`, `Status`, `AddUser`, `AddDate`) VALUES
(1, 1, 4, 1, 1, '1234567890', 10500.00, 16000.00, '2023-07-01', '2024-01-01', 1, 6, '2023-07-14'),
(2, 1, 4, 1, 1, '1234567891', 15000.00, 20500.00, '2023-07-09', '2024-01-09', 1, 6, '2023-07-14'),
(3, 1, 4, 1, 1, '1234567892', 12500.00, 17500.00, '2023-07-14', '2024-01-14', 1, 6, '2023-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `SupplierId` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierName` varchar(255) NOT NULL,
  `ContactNo` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`SupplierId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierId`, `SupplierName`, `ContactNo`, `email`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'toyota lanka', '0703966282', 'toyotaLanka@gmail.com', 1, 1, '2023-07-12', NULL, NULL),
(2, 'united motors', '0779200480', 'unitedmotors@gmail.com', 1, 1, '2023-07-13', NULL, NULL),
(3, 'shell', '0112123456', 'shell@gmail.com', 1, 1, '2023-07-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliercatergories`
--

DROP TABLE IF EXISTS `suppliercatergories`;
CREATE TABLE IF NOT EXISTS `suppliercatergories` (
  `SupCatId` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierId` int(11) NOT NULL,
  `CatergoryId` int(11) NOT NULL,
  PRIMARY KEY (`SupCatId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliercatergories`
--

INSERT INTO `suppliercatergories` (`SupCatId`, `SupplierId`, `CatergoryId`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 2, 5),
(4, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `TaskId` int(11) NOT NULL AUTO_INCREMENT,
  `Appointment_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `AppDate` date NOT NULL,
  `TimeSlotId` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddTime` varchar(255) NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`TaskId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskId`, `Appointment_id`, `User_id`, `AppDate`, `TimeSlotId`, `AddUser`, `AddDate`, `AddTime`, `UpdateUser`, `UpdateDate`, `Status`) VALUES
(1, 21, 8, '2023-07-02', 47, 2, '2023-07-02', '12:58', NULL, NULL, 0),
(2, 22, 8, '2023-07-03', 1, 2, '2023-07-03', '12:58', 8, '2023-07-03', 2),
(3, 23, 8, '2023-07-03', 5, 2, '2023-07-03', '12:58', NULL, NULL, 1),
(4, 2, 8, '2023-06-24', 36, 2, '2023-07-03', '12:58', NULL, NULL, 1),
(5, 12, 8, '2023-06-26', 7, 2, '2023-07-03', '13:24', NULL, NULL, 1),
(6, 25, 8, '2023-07-11', 8, 2, '2023-07-12', '01:41', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasksrepair`
--

DROP TABLE IF EXISTS `tasksrepair`;
CREATE TABLE IF NOT EXISTS `tasksrepair` (
  `TaskRepairId` int(11) NOT NULL AUTO_INCREMENT,
  `Inspection_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddTime` varchar(255) NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateTime` varchar(255) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`TaskRepairId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasksrepair`
--

INSERT INTO `tasksrepair` (`TaskRepairId`, `Inspection_id`, `User_id`, `AddUser`, `AddDate`, `AddTime`, `UpdateUser`, `UpdateDate`, `UpdateTime`, `Status`) VALUES
(1, 4, 7, 4, '2023-07-12', '02:01', NULL, NULL, NULL, 1);

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
  `UserImage` varchar(255) DEFAULT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserRole` varchar(100) NOT NULL,
  `depId` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Title`, `UserImage`, `FirstName`, `LastName`, `Email`, `Password`, `UserRole`, `depId`, `HouseNo`, `Lane`, `Street`, `City`, `Gender`, `NIC`, `Status`, `passwordreset`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Mr.', '', 'Rajindra', 'Tharindu', 'rajindratharindu@gmail.com', '39b947de5b295a150eaed0b1af60a2316e17a687', 'admin', 0, '136/1,', 'Horahena Road, ', 'Rukmale,', 'Pannipitiya.', '', '88777777', 1, '6486238ee47e3', 1, '2023-03-17', 1, '2023-06-11'),
(2, 'Mr.', '', 'Tharindu', 'Kumara', 'tharindu@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'manager', 1, '136', 'r', 'r', 'r', '', '88777777', 1, '648610eeb46c4', 1, '2023-03-20', NULL, '2023-06-11'),
(3, 'Mr.', '199821300140649c3fb3742d65.85581620.png', 'Kumara', 'Perera', 'kumara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', 2, '136', 'r', 'r', 'r', '', '88777777', 1, '', 1, '2023-03-20', NULL, NULL),
(4, 'Mr.', '', 'Thiwanka', 'Madushan', 'thiwanka@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'supervisor', 1, '146', 'Munamalle watta', 'Kaluaggala', 'Hanwella', '1', '1111111', 1, '', 1, '2023-06-10', NULL, NULL),
(5, 'Mr.', '', 'Tharindu', 'Saumya', 'saumya@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'inspectionOfficer', 3, '1', 'Hokandara East', 'Hokandara', 'Pannipitiya', '1', '982130240V', 1, '', NULL, NULL, NULL, NULL),
(6, 'Mr.', '', 'Chulochana', 'Sandeepa', 'chulochana@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'stockKeeper', 5, '25', 'Amuatamulla Road', 'Kottawa', 'Pannipitiya', '1', '199821300140', 1, '', NULL, NULL, NULL, NULL),
(7, 'Mr.', '199821300140649c3fb3742d65.85581620.png', 'Athukorala', 'Perera', 'athukorala@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', 3, '132', 'Horahena Road', 'Rukmale', 'Pannipitiya', '1', '70667716V', 1, NULL, NULL, NULL, NULL, NULL),
(8, 'Mr.', '199821300140649c3fb3742d65.85581620.png', 'Pasan', 'Manahara', 'pasan@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', 2, '23/43', 'Ambalangoda', 'Polgasowita', 'Piliynadala', '1', '199821300140', 1, NULL, NULL, NULL, NULL, NULL),
(9, 'Mr.', '19972630129964a964147271d3.79989169.png', 'Hasith', 'Athukorala', 'hasitha@gmail.com', '49a6508835d3ccc815fb6e82a99e2d198b1bc815', 'technician', NULL, '134', 'Grama Sanwaradana Lane', 'Kottawa Road', 'Pannipitiya', '1', '199726301299', 1, NULL, NULL, NULL, NULL, NULL);

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
