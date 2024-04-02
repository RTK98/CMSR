-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2024 at 07:07 PM
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
  `CustomerId` int(11) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `AddUser` int(11) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `AddCustomer` int(11) DEFAULT NULL,
  `AddCustomerDate` date DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`CanceledId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointmentcanceled`
--

INSERT INTO `appointmentcanceled` (`CanceledId`, `AppCanceledId`, `CustomerId`, `Reason`, `AddUser`, `AddDate`, `AddCustomer`, `AddCustomerDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 6, 1, '3', NULL, NULL, NULL, NULL, 1, '2023-07-31'),
(2, 8, 1, '1', NULL, NULL, NULL, NULL, 1, '2023-07-31');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointmenthandling`
--

INSERT INTO `appointmenthandling` (`AppHandling`, `TimeSlotId`, `AppointmentId`, `Vehicle_Id`, `AppDate`) VALUES
(4, 13, 4, 1, '2023-07-25'),
(10, 14, 10, 1, '2023-08-01'),
(11, 30, 11, 1, '2023-07-28'),
(12, 32, 12, 1, '2023-08-04'),
(13, 25, 13, 1, '2023-08-03'),
(14, 27, 14, 1, '2023-08-01'),
(15, 1, 15, 1, '2023-08-01'),
(16, 19, 16, 1, '2023-08-02'),
(17, 39, 17, 1, '2023-08-05'),
(18, 26, 18, 4, '2023-08-03'),
(19, 17, 19, 4, '2023-08-09'),
(20, 31, 20, 5, '2023-08-04'),
(21, 12, 21, 6, '2023-08-08'),
(22, 36, 22, 1, '2023-08-05'),
(24, 42, 24, 3, '2023-08-05'),
(25, 42, 25, 2, '2023-08-05'),
(26, 42, 26, 5, '2023-08-05'),
(27, 42, 27, 6, '2023-08-05'),
(28, 42, 28, 7, '2023-08-05'),
(30, 37, 30, 8, '2023-08-05'),
(31, 2, 31, 2, '2023-08-07');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`AppointmentId`, `AppointmentNo`, `CustomerID`, `VehicleNo`, `AppDate`, `TimeSlotStart`, `ServiceType`, `appointmentStatus`, `AddUser`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'APP202307246849', 1, 1, '2023-07-25', 8, '1', 4, NULL, NULL, NULL),
(2, 'APP202307254083', 1, 1, '2023-07-25', 12, '1', 4, NULL, NULL, NULL),
(3, 'APP202307258973', 1, 1, '2023-07-25', 13, '1', 4, NULL, NULL, NULL),
(4, 'APP202307253253', 1, 1, '2023-07-25', 13, '1', 2, NULL, NULL, NULL),
(5, 'APP202307254857', 1, 1, '2023-07-26', 15, '1', 4, NULL, NULL, NULL),
(6, 'APP202307257667', 1, 1, '2023-07-27', 26, '1', 4, NULL, NULL, NULL),
(7, 'APP202307274857', 1, 1, '2023-07-28', 29, '1', 4, NULL, NULL, NULL),
(8, 'APP202307275634', 1, 1, '2023-07-28', 31, '1', 4, NULL, NULL, NULL),
(9, 'APP202307276883', 1, 1, '2023-08-01', 9, '0', 4, NULL, NULL, NULL),
(10, 'APP202307271873', 1, 1, '2023-08-01', 14, '1', 2, NULL, NULL, NULL),
(11, 'APP202307273339', 1, 1, '2023-07-28', 30, '1', 1, NULL, NULL, NULL),
(12, 'APP202307309520', 1, 1, '2023-08-04', 32, '1', 2, NULL, NULL, NULL),
(13, 'APP202307306751', 1, 1, '2023-08-03', 25, '1', 2, NULL, NULL, NULL),
(14, 'APP202307307709', 1, 1, '2023-08-01', 27, '1', 2, NULL, NULL, NULL),
(15, 'APP202307316945', 1, 1, '2023-08-01', 1, '2', 2, NULL, NULL, NULL),
(16, 'APP202307319376', 1, 1, '2023-08-02', 19, '1', 3, NULL, 4, '2023-08-03'),
(17, 'APP202308013749', 1, 1, '2023-08-05', 39, '1', 3, NULL, 4, '2023-08-05'),
(18, 'APP202308024043', 2, 4, '2023-08-03', 26, '3', 3, NULL, 4, '2023-08-03'),
(19, 'APP202308024550', 2, 4, '2023-08-04', 17, '3', 3, NULL, 4, '2023-08-04'),
(20, 'APP202308037587', 3, 5, '2023-08-04', 31, '3', 2, NULL, NULL, NULL),
(21, 'APP202308042072', 12, 6, '2023-08-04', 12, '1', 2, NULL, NULL, NULL),
(22, 'APP202308048113', 1, 1, '2023-08-05', 36, '1', 1, NULL, NULL, NULL),
(23, 'APP202308048284', 1, 1, '2023-08-10', 22, '1', 4, NULL, NULL, NULL),
(24, 'APP202308043639', 2, 3, '2023-08-05', 42, '3', 1, NULL, NULL, NULL),
(25, 'APP202308047773', 1, 2, '2023-08-05', 42, '1', 1, NULL, NULL, NULL),
(26, 'APP202308048805', 3, 5, '2023-08-05', 42, '3', 1, NULL, NULL, NULL),
(27, 'APP202308046202', 12, 6, '2023-08-05', 42, '1', 1, NULL, NULL, NULL),
(28, 'APP202308043811', 13, 7, '2023-08-05', 42, '2', 1, NULL, NULL, NULL),
(30, 'APP202308044941', 14, 8, '2023-08-05', 37, '3', 1, NULL, NULL, NULL),
(31, 'APP202308046424', 1, 2, '2023-08-07', 2, '1', 1, NULL, NULL, NULL);

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
  `BatchStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`BatchId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batchno`
--

INSERT INTO `batchno` (`BatchId`, `BatchNo`, `SupplierId`, `CategoryId`, `ProductId`, `BatchStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'BC230713S1C4P10001', 1, 4, 1, 0, 6, '2023-07-13', 6, '2023-07-14'),
(2, 'BC230713S1C4P20002\n', 1, 4, 2, 1, 6, '2023-07-13', NULL, NULL),
(3, 'BC230714S1C4P10003\n', 1, 4, 1, 1, 6, '2023-07-14', NULL, NULL),
(4, 'BC230717S2C5P60004\n', 2, 5, 6, 1, 6, '2023-07-17', NULL, NULL),
(5, 'BC230727S1C1P40005\n', 1, 1, 4, 1, 6, '2023-07-27', NULL, NULL),
(6, 'BC230731S1C1P10006\n', 1, 1, 1, 0, 6, '2023-07-31', 6, '2023-07-31'),
(7, 'BC230801S1C2P160007\n', 1, 2, 16, 1, 6, '2023-08-01', NULL, NULL),
(8, 'BC230801S1C2P200008\n', 1, 2, 20, 1, 6, '2023-08-01', NULL, NULL),
(9, 'BC230801S1C2P210009\n', 1, 2, 21, 1, 6, '2023-08-01', NULL, NULL),
(10, 'BC230801S1C1P20010\n', 1, 1, 2, 1, 6, '2023-08-01', NULL, NULL),
(11, 'BC230801S1C1P20011\n', 1, 1, 2, 1, 6, '2023-08-01', NULL, NULL);

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
-- Table structure for table `cancelreasoninternal`
--

DROP TABLE IF EXISTS `cancelreasoninternal`;
CREATE TABLE IF NOT EXISTS `cancelreasoninternal` (
  `ReasonId` int(11) NOT NULL AUTO_INCREMENT,
  `ReasonName` varchar(100) NOT NULL,
  PRIMARY KEY (`ReasonId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cancelreasoninternal`
--

INSERT INTO `cancelreasoninternal` (`ReasonId`, `ReasonName`) VALUES
(1, 'We are Closed'),
(2, 'Customer did not showed up'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `catergories`
--

DROP TABLE IF EXISTS `catergories`;
CREATE TABLE IF NOT EXISTS `catergories` (
  `CatergoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CatergoryCode` varchar(255) DEFAULT NULL,
  `CatergoryName` varchar(255) NOT NULL,
  `CatergoryImage` varchar(255) DEFAULT NULL,
  `CatergoryDescription` text NOT NULL,
  `CatergoryStatus` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`CatergoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catergories`
--

INSERT INTO `catergories` (`CatergoryID`, `CatergoryCode`, `CatergoryName`, `CatergoryImage`, `CatergoryDescription`, `CatergoryStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'CAT0001\n', 'engine oil', '64bf64b3a08244.52294203engine oil.png', 'Keep Your Vehicles Engine Running Smoothly With Our High-quality Engine Oil. Our Engine Oil Is Specially Formulated To Provide Excellent Lubrication And Protect Your Engine From Wear And Tear. It Helps To Reduce Friction And Heat, Ensuring Optimal Performance And Fuel Efficiency.', 1, 2, '2023-07-25', NULL, NULL),
(2, 'CAT0002\n', 'gear oil', '64becce24719e1.31304356gear oil.png', 'Experience smoother gear shifts and enhanced performance with our premium gear oil. Specially designed for manual transmissions, differentials, and other gear systems, our gear oil provides superior protection against wear, corrosion, and extreme pressure. Its advanced formula ensures optimal lubrication, reducing friction and heat, thereby extending the life of your gears. Whether you have a car, truck, or other heavy-duty equipment, our gear oil is engineered to meet the demands of modern gearboxes. Trust in our gear oil to maintain the integrity of your gear system, ensuring a quiet and efficient ride every time. Gear up for smooth operation and long-lasting performance with our top-quality gear oil.', 1, 2, '2023-07-25', NULL, NULL),
(3, 'CAT0003\n', 'brake oil', '64becdaf5395f0.54496165brake oil.png', 'Ensure reliable and responsive braking with our high-performance brake oil. Designed to meet the demanding requirements of modern braking systems, our brake oil offers exceptional protection against high temperatures and heavy braking loads. It effectively transfers hydraulic pressure to the brake components, resulting in smooth and consistent braking performance.', 1, 2, '2023-07-25', NULL, NULL),
(4, 'CAT0004\n', 'power steering oil', '64bece2e766c85.40879077power steering oil.png', 'Keep your vehicle power steering system running smoothly with our premium power steering oil. Specifically formulated to meet the unique demands of power steering systems, our oil provides excellent lubrication, ensuring smooth and effortless steering performance.', 1, 2, '2023-07-25', NULL, NULL),
(5, 'CAT0005\n', 'lights', '64becf2728fbc3.59692005lights.png', 'Illuminate your way with our wide range of high-quality lights designed to enhance visibility and safety on the road. From headlights to taillights, fog lights, and interior lighting, we have the perfect lighting solutions for your vehicle.', 1, 2, '2023-07-25', NULL, NULL),
(6, 'CAT0006\n', 'socket shober', '64bed02112ae72.02186593socket shober.png', 'Socket Shobers', 1, 2, '2023-07-25', NULL, NULL),
(7, 'CAT0007\n', 'oil sealer', '64bed0f63173f7.79298522oil sealer.png', 'A vehicle oil sealer, also known as an engine oil leak sealer or oil stop leak additive, is a product designed to address or reduce oil leaks from the engine. It is commonly used as a temporary solution to mitigate minor oil leaks without the need for expensive repairs or component replacements.', 1, 2, '2023-07-25', NULL, NULL),
(8, 'CAT0008\n', 'engine repair kit', '64bed170edc2c6.43931622engine repair kit.png', 'A vehicle engine repair kit, often referred to as an engine overhaul or rebuild kit, is a comprehensive package that includes various components and parts necessary to repair or rebuild an engine. These kits are typically used when an engine has significant wear, damage, or internal issues that require more than just minor repair', 1, 2, '2023-07-25', NULL, NULL),
(9, 'CAT0009\n', 'oil filter', '64bed2126ba3c2.65832431oil filter.png', 'An oil filter in a vehicle is an essential component designed to remove contaminants and impurities from the engine oil as it circulates through the engine. It plays a crucial role in maintaining the cleanliness and efficiency of the engine, protecting its internal components, and ensuring smooth operation.', 1, 2, '2023-07-25', NULL, NULL),
(10, 'CAT0010\n', 'air filter', '64bed341c560b0.73660505air filter.png', 'An air filter is an essential component of a vehicle engine. It helps to remove contaminants from the air before it enters the engine\'s combustion chamber. Regular replacement of the air filter is important to maintain engine performance and fuel efficiency.', 1, 2, '2023-07-25', NULL, NULL),
(11, 'CAT0011\n', 'engine mounts', '64bed4536e70a2.78829225engine mounts.png', 'An engine mount also known as a motor mount or engine support, is a crucial component in a vehicle engine assembly. Its primary function is to secure the engine to the vehicle chassis or frame while dampening vibrations and minimizing engine movement during operation.', 1, 2, '2023-07-25', NULL, NULL),
(12, 'CAT0012\n', 'fuel filter', '64bed50cb47bc1.01917859fuel filter.jpg', 'A fuel filter is a critical component in a vehicles fuel system that is responsible for filtering out impurities and contaminants from the fuel before it reaches the engine. It plays a crucial role in maintaining the performance  efficiency and longevity of the engine by ensuring that clean fuel is delivered to the fuel injectors or carburetor.', 1, 2, '2023-07-25', NULL, NULL),
(13, 'CAT0013\n', 'coolent', '64bed55d9d2bd0.68432403coolent.jpeg', 'Coolant also known as antifreeze is a vital liquid used in a vehicle cooling system to regulate and maintain the engine temperature. It serves multiple essential functions to ensure that the engine operates within the optimal temperature range.', 1, 2, '2023-07-25', NULL, NULL),
(14, 'CAT0014\n', 'viper blades', '64bed60f7faa36.14761874viper blades.png', 'Viper blades typically refers to windshield wiper blades used in vehicles. Windshield wiper blades are essential components of a vehicle wiper system designed to clear rain snow dirt and other debris from the windshield to provide the driver with a clear view of the road during adverse weather conditions.', 1, 2, '2023-07-25', NULL, NULL),
(15, 'CAT0015\n', 'brake pads', '64bed712a1f840.40281736brake pads.png', 'Brake pads are a crucial component of a vehicle braking system responsible for providing the necessary friction to slow down or stop the vehicle when the brakes are applied. They play a vital role in ensuring safe and efficient braking performance.', 1, 2, '2023-07-25', NULL, NULL),
(16, 'CAT0016\n', 'brake liner', '64bed81b2c9552.59670527brake liner.png', 'Brake Liners', 1, 2, '2023-07-25', NULL, NULL),
(17, 'CAT0017\n', 'turbo', '64bed87c4879b2.96554974turbo.jpg', 'A turbo vehicle also known as a turbocharged vehicle, is a type of internal combustion engine-equipped with a turbocharger. The turbocharger is a device that increases the engine power and efficiency by forcing more air into the combustion chambers thereby allowing more fuel to be burned and producing more power.', 1, 2, '2023-07-25', NULL, NULL),
(18, 'CAT0018\n', 'intercooler', '64bed909956a76.69098721intercooler.png', 'An intercooler  also known as an aftercooler is a heat exchanger used in certain turbocharged or supercharged vehicles to improve the efficiency and performance of the engine. It is specifically designed to cool down the compressed air before it enters the engine intake manifold.', 1, 2, '2023-07-25', NULL, NULL),
(19, 'CAT0019\n', 'blow off valve (bov)', '64bed992831406.47004272blow off valve (bov).jpg', 'A blow-off valve (BOV) is a component used in turbocharged and supercharged engines to vent excess pressure from the intake system when the throttle is suddenly closed such as during gear changes or lifting off the accelerator pedal. Its also known as a diverter valve or compressor bypass valve.', 1, 2, '2023-07-25', NULL, NULL),
(20, 'CAT0020\n', 'ecu', '64beda1d45d6a5.85709496ecu.png', 'ECU stands for Engine Control Unit. It is a critical component in modern vehicles that controls and manages various aspects of the engines operation to ensure optimal performance efficiency and emissions control.', 1, 2, '2023-07-25', NULL, NULL),
(21, 'CAT0021\n', 'timing belts', '64beda9ee6a8c9.41168366timing belts.png', 'A timing belt also known as a timing chain in some vehicles is a critical component of a vehicle engine that ensures the synchronization of the engine internal components such as the crankshaft and camshaft(s). It plays a crucial role in the proper timing of the engine valves allowing for efficient and smooth operation.', 1, 2, '2023-07-25', NULL, NULL),
(22, 'CAT0022\n', 'radiator', '64bedb020e4534.89175882radiator.png', 'A radiator is a crucial component of a vehicle cooling system responsible for dissipating heat from the engine to prevent it from overheating during operation. It helps regulate the engine temperature and ensures that it operates within a safe and efficient range.', 1, 2, '2023-07-25', NULL, NULL),
(23, 'CAT0023\n', 'engines', '64bedb6b8f6976.91295095engines.png', 'A engine, also known as an internal combustion engine is the primary power source in most automobiles. It is responsible for converting fuel into mechanical energy which propels the vehicle forward. engines come in various types.', 1, 2, '2023-07-25', NULL, NULL),
(24, 'CAT0024\n', 'gear box', '64bedbd256d741.60013784gear box.jpg', 'The gearbox also known as the transmission is a critical component in a vehicle that transmits power from the engine to the wheels, allowing the vehicle to move at different speeds and deliver torque for various driving conditions. It plays a crucial role in optimizing the engine power output and fuel efficiency.', 1, 2, '2023-07-25', NULL, NULL),
(25, 'CAT0025\n', 'differential gear oil', '64c3b423dcc633.98106965differential gear oil.jpg', 'High-performance lubricant for automotive differentials.', 1, 2, '2023-07-28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `name_en` varchar(45) DEFAULT NULL,
  `name_si` varchar(45) DEFAULT NULL,
  `name_ta` varchar(45) DEFAULT NULL,
  `sub_name_en` varchar(45) DEFAULT NULL,
  `sub_name_si` varchar(45) DEFAULT NULL,
  `sub_name_ta` varchar(45) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_cities_districts1` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2214 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `district_id`, `name_en`, `name_si`, `name_ta`, `sub_name_en`, `sub_name_si`, `sub_name_ta`, `postcode`, `latitude`, `longitude`) VALUES
(1, 1, 'Akkaraipattu', 'අක්කරපත්තුව', 'அக்கரைப்பற்று', NULL, NULL, NULL, '32400', '7.21842790', '81.85411610'),
(2, 1, 'Ambagahawatta', 'අඹගහවත්ත', 'அம்பகஹவத்த', NULL, NULL, NULL, '90326', '7.30175630', '81.67472950'),
(3, 1, 'Ampara', 'අම්පාර', 'அம்பாறை', NULL, NULL, NULL, '32000', '7.30175630', '81.67472950'),
(4, 1, 'Bakmitiyawa', 'බක්මිටියාව', 'பக்மிடியாவ', NULL, NULL, NULL, '32024', '7.02963180', '81.68020540'),
(5, 1, 'Deegawapiya', 'දීඝවාපිය', 'தீகவாபி', NULL, NULL, NULL, '32006', '7.30175630', '81.67472950'),
(6, 1, 'Devalahinda', 'දෙවලහිඳ', 'தேவாலஹிந்தா', NULL, NULL, NULL, '32038', '7.30175630', '81.67472950'),
(7, 1, 'Digamadulla Weeragoda', 'දිගාමඩුල්ල වීරගොඩ', 'திகாமடுள்ள வீரகொட', NULL, NULL, NULL, '32008', '7.39012540', '81.69658760'),
(8, 1, 'Dorakumbura', 'දොරකුඹුර', 'டோரகும்புரா', NULL, NULL, NULL, '32104', '7.35886970', '81.30142840'),
(9, 1, 'Gonagolla', 'ගොනගොල්ල', 'கோனாகொல்லா', NULL, NULL, NULL, '32064', '7.43037350', '81.55892520'),
(10, 1, 'Hulannuge', 'හුලංනුගේ', 'ஹுலனுகே', NULL, NULL, NULL, '32514', '6.92847170', '81.65467140'),
(11, 1, 'Kalmunai', 'කල්මුණේ', 'கல்முனை', NULL, NULL, NULL, '32300', '7.39567810', '81.83336560'),
(12, 1, 'Kannakipuram', 'කන්නකිපුරම්', 'கண்ணகிபுரம்', NULL, NULL, NULL, '32405', '7.49350210', '81.79578880'),
(13, 1, 'Karativu', 'කරතිව්', 'காரைதீவு', NULL, NULL, NULL, '32250', '7.37702820', '81.84150650'),
(14, 1, 'Kekirihena', 'කැකිරිහේන', 'கெகிரிஹேன', NULL, NULL, NULL, '32074', '7.50745450', '81.33512840'),
(15, 1, 'Koknahara', 'කොක්නහර', 'கோக்னஹாரா', NULL, NULL, NULL, '32035', '7.22390810', '81.56234740'),
(16, 1, 'Kolamanthalawa', 'කෝලමන්තලාව', 'கொலமந்தலாவ', NULL, NULL, NULL, '32102', '7.29429160', '81.27941230'),
(17, 1, 'Komari', 'කෝමාරි', 'கோமாரி', NULL, NULL, NULL, '32418', '6.98626030', '81.86477870'),
(18, 1, 'Lahugala', 'ලාහුගල', 'லாஹுகல', NULL, NULL, NULL, '32512', '6.87208720', '81.72262980'),
(19, 1, 'Irakkamam', 'ඉරක්කමම්', 'இறக்காமம்', NULL, NULL, NULL, '32450', '7.24424420', '81.74588450'),
(20, 1, 'Mahaoya', 'මහඔය', 'மகா ஓயா', NULL, NULL, NULL, '32070', '7.53121600', '81.35609520'),
(21, 1, 'Marathamune', 'මාරත්මුනේ', 'மருதமுனை', NULL, NULL, NULL, '32314', '7.30175630', '81.67472950'),
(22, 1, 'Namaloya', 'නාමල්ඔය', 'நாமல் ஓய', NULL, NULL, NULL, '32037', '7.33119270', '81.53221490'),
(23, 1, 'Navithanveli', 'නාවිදන්වෙලි', 'நாவிதன்வெளி', NULL, NULL, NULL, '32308', '7.42577260', '81.77456990'),
(24, 1, 'Nintavur', 'නින්දවූර්', 'நிந்தவூர்', NULL, NULL, NULL, '32340', '7.32116800', '81.85785230'),
(25, 1, 'Oluvil', 'ඔළුවිල', 'ஒலுவில்', NULL, NULL, NULL, '32360', '7.29444730', '81.86068210'),
(26, 1, 'Padiyatalawa', 'පදියතලාව', 'பதியதலாவ', NULL, NULL, NULL, '32100', '7.39251260', '81.24362270'),
(27, 1, 'Pahalalanda', 'පහලලන්ද', 'பஹலாலண்ட', NULL, NULL, NULL, '32034', '7.22268810', '81.58980160'),
(28, 1, 'Panama', 'පානම', 'பாணம', NULL, NULL, NULL, '32508', '6.75805890', '81.80877210'),
(29, 1, 'Pannalagama', 'පන්නලගම', 'பன்னலகம', NULL, NULL, NULL, '32022', '7.30175630', '81.67472950'),
(30, 1, 'Paragahakele', 'පරගහකැලේ', 'பரகஹகலே', NULL, NULL, NULL, '32031', '7.25777050', '81.60898730'),
(31, 1, 'Periyaneelavanai', 'පෙරියනීලවන්නි', 'பெரியநீலாவணை', NULL, NULL, NULL, '32316', '7.45160600', '81.81423800'),
(32, 1, 'Polwaga Janapadaya', 'පොල්වග ජනපදය', 'போல்வக ஜனபதய', NULL, NULL, NULL, '32032', '7.24344700', '81.55690030'),
(33, 1, 'Pottuvil', 'පොතුවිල්', 'பொத்துவில்', NULL, NULL, NULL, '32500', '6.87527060', '81.83063340'),
(34, 1, 'Sainthamaruthu', 'සායින්දමරුදු', 'சாய்ந்தமருது', NULL, NULL, NULL, '32280', '7.39304920', '81.83609770'),
(35, 1, 'Samanthurai', 'සමන්තුරේ', 'சம்மாந்துறை', NULL, NULL, NULL, '32200', '7.35748410', '81.79510540'),
(36, 1, 'Serankada', 'සේරන්කද', 'சேரன்காடா', NULL, NULL, NULL, '32101', '7.45677530', '81.27872420'),
(37, 1, 'Tempitiya', 'ටැම්පිටිය', 'தெம்பிட்டிய', NULL, NULL, NULL, '32072', '7.62289350', '81.37293720'),
(38, 1, 'Thambiluvil', 'තම්බිලුවිල්', 'தம்பிலுவில்', NULL, NULL, NULL, '32415', '7.12851220', '81.84861640'),
(39, 1, 'Tirukovil', 'තිරුකෝවිල', 'திருக்கோவில்', NULL, NULL, NULL, '32420', '7.11531220', '81.85248820'),
(40, 1, 'Uhana', 'උහන', 'உஹன', NULL, NULL, NULL, '32060', '7.36303600', '81.63527700'),
(41, 1, 'Wadinagala', 'වඩිනාගල', 'வடினாகல', NULL, NULL, NULL, '32039', '7.12631470', '81.57335280'),
(42, 1, 'Wanagamuwa', 'වනගමුව', 'வணகமுவ', NULL, NULL, NULL, '32454', '7.30175630', '81.67472950'),
(43, 2, 'Angamuwa', 'අංගමුව', 'அங்கமுவா', NULL, NULL, NULL, '50248', '8.18133110', '80.20703280'),
(44, 2, 'Anuradhapura', 'අනුරාධපුරය', 'அநுராதபுரம்', NULL, NULL, NULL, '50000', '8.31135180', '80.40365080'),
(45, 2, 'Awukana', 'අව්කන', 'அவுகனா', NULL, NULL, NULL, '50169', '8.01014200', '80.51311560'),
(46, 2, 'Bogahawewa', 'බෝගහවැව', 'போகஹவெவ', NULL, NULL, NULL, '50566', '8.32554500', '80.24885960'),
(47, 2, 'Dematawewa', 'දෙමටවැව', 'தெமடவெவ', NULL, NULL, NULL, '50356', '8.28333300', '80.58333300'),
(48, 2, 'Dimbulagala', 'දිඹුලාගල', 'திம்புலாகல', NULL, NULL, NULL, '51031', '7.85934130', '81.10305730'),
(49, 2, 'Dutuwewa', 'දුටුවැව', 'டுடுவெவ', NULL, NULL, NULL, '50393', '8.62798020', '80.86545340'),
(50, 2, 'Elayapattuwa', 'ඇලයාපත්තුව', 'எலயபத்துவ', NULL, NULL, NULL, '50014', '8.35534470', '80.39647510'),
(51, 2, 'Ellewewa', 'ඇල්ලේවැව', 'எல்லேவெவ', NULL, NULL, NULL, '51034', '7.78077700', '81.07822530'),
(52, 2, 'Eppawala', 'එප්පාවල', 'எப்பாவெல', NULL, NULL, NULL, '50260', '8.14409500', '80.41187210'),
(53, 2, 'Etawatunuwewa', 'ඇතාවැටුනවැව', 'எடவதுனுவெவ', NULL, NULL, NULL, '50584', '8.31135180', '80.40365080'),
(54, 2, 'Etaweeragollewa', 'ඇතාවීරගොලෑව', 'எடவீரகொல்லேவ', NULL, NULL, NULL, '50518', '8.61460480', '80.53828890'),
(55, 2, 'Galapitagala', 'ගලපිටගල', 'கலபிட்டிகல', NULL, NULL, NULL, '32066', '8.09808990', '80.68262540'),
(56, 2, 'Galenbindunuwewa', 'ගලෙන්බිඳුනුවැව', 'கலன்பிந்துனுவெவை', NULL, NULL, NULL, '50390', '8.29213380', '80.71728370'),
(57, 2, 'Galkadawala', 'ගල්කඩවල', 'கல்கடவல', NULL, NULL, NULL, '50006', '8.25944620', '80.14425400'),
(58, 2, 'Galkiriyagama', 'ගල්කිරියාගම', 'கல்கிரியாகம', NULL, NULL, NULL, '50120', '7.92634930', '80.57187720'),
(59, 2, 'Galkulama', 'ගල්කුලම', 'கல்குலமா', NULL, NULL, NULL, '50064', '8.30612950', '80.45037230'),
(60, 2, 'Galnewa', 'ගල්නෑව', 'கல்னேவை', NULL, NULL, NULL, '50170', '8.03692110', '80.47253460'),
(61, 2, 'Gambirigaswewa', 'ගම්බිරිගස්වැව', 'கம்பீரிகஸ்வெவ', NULL, NULL, NULL, '50057', '8.48075710', '80.39369940'),
(62, 2, 'Ganewalpola', 'ගනේවල්පොල', 'கணேவல்பொல', NULL, NULL, NULL, '50142', '8.08761040', '80.62791750'),
(63, 2, 'Gemunupura', 'ගැමුණුපුර', 'கெமுனுபுர', NULL, NULL, NULL, '50224', '8.19657290', '80.16797580'),
(64, 2, 'Getalawa', 'ගෙතලාව', 'கெட்டலாவா', NULL, NULL, NULL, '50392', '8.31826200', '80.77406080'),
(65, 2, 'Gnanikulama', 'ඝාණිකුළම', 'ஞானிகுலம', NULL, NULL, NULL, '50036', '8.29901660', '80.43682450'),
(66, 2, 'Gonahaddenawa', 'ගෝනහද්දෙනෑව', 'கோனஹத்தேனாவ', NULL, NULL, NULL, '50554', '8.31135180', '80.40365080'),
(67, 2, 'Habarana', 'හබරන', 'ஹபரணை', NULL, NULL, NULL, '50150', '8.03221470', '80.75192720'),
(68, 2, 'Halmillawa Dambulla', 'හල්මිලෑව දඹුල්ල', 'ஹல்மில்லாவ தம்புள்ளை', NULL, NULL, NULL, '50124', '8.17185550', '80.75342070'),
(69, 2, 'Halmillawetiya', 'හල්මිල්ලවැටිය', 'ஹல்மில்லவெட்டிய', NULL, NULL, NULL, '50552', '8.73197780', '80.66598420'),
(70, 2, 'Hidogama', 'හිද්දෝගම', 'ஹிடோகாமா', NULL, NULL, NULL, '50044', '8.26194340', '80.41317800'),
(71, 2, 'Horawpatana', 'හොරොව්පතාන', 'ஹோரவ்பதானா', NULL, NULL, NULL, '50350', '8.55697630', '80.83129110'),
(72, 2, 'Horiwila', 'හොරිවිල', 'ஹோரிவில', NULL, NULL, NULL, '50222', '7.86666700', '81.08333300'),
(73, 2, 'Hurigaswewa', 'හුරිගස්වැව', 'ஹுரிகஸ்வெவ', NULL, NULL, NULL, '50176', '8.09486350', '80.37004070'),
(74, 2, 'Hurulunikawewa', 'හුරුලුනිකවැව', 'ஹுருலுனிகாவெவ', NULL, NULL, NULL, '50394', '8.27086140', '80.75918140'),
(75, 2, 'Ihala Puliyankulama', 'ඉහල පුලියන්කුලම', 'இஹல புளியங்குளம', NULL, NULL, NULL, '61316', '8.15202380', '80.56328840'),
(76, 2, 'Kagama', 'කගම', 'ககம', NULL, NULL, NULL, '50282', '8.04226330', '80.50723210'),
(77, 2, 'Kahatagasdigiliya', 'කහටගස්දිගිලිය', 'ககட்டகஸ்திகிலியை', NULL, NULL, NULL, '50320', '8.42598100', '80.68725300'),
(78, 2, 'Kahatagollewa', 'කහටගොල්ලෑව', 'கஹடகொல்லேவ', NULL, NULL, NULL, '50562', '8.73523570', '80.79901850'),
(79, 2, 'Kalakarambewa', 'කලකරඹෑව', 'கலகரம்பேவா', NULL, NULL, NULL, '50288', '8.31135180', '80.40365080'),
(80, 2, 'Kalaoya', 'කලාඔය', 'கலா ஓய', NULL, NULL, NULL, '50226', '8.21001910', '80.10754390'),
(81, 2, 'Kalawedi Ulpotha', 'කලාවැදි උල්පොත', 'கலாவெடி உல்பொத', NULL, NULL, NULL, '50556', '7.90669100', '80.37530500'),
(82, 2, 'Kallanchiya', 'කලංචිය', 'கல்லஞ்சியா', NULL, NULL, NULL, '50454', '8.46341190', '80.57161990'),
(83, 2, 'Kalpitiya', 'කල්පිටිය', 'கல்பிட்டி', NULL, NULL, NULL, '61360', '8.32274050', '80.40861190'),
(84, 2, 'Kalukele Badanagala', 'කළුකැලේ බදනාගල', 'களுகேலே படனகல', NULL, NULL, NULL, '51037', '7.78305910', '81.05890600'),
(85, 2, 'Kapugallawa', 'කපුගල්ලව', 'கபுகல்லாவ', NULL, NULL, NULL, '50370', '8.31135180', '80.40365080'),
(86, 2, 'Karagahawewa', 'කරගහවැව', 'கரகஹவெவ', NULL, NULL, NULL, '50232', '8.33692640', '80.41545860'),
(87, 2, 'Kashyapapura', 'කාශ්‍යපපුර', 'காஷ்யபபுரா', NULL, NULL, NULL, '51032', '8.31135180', '80.40365080'),
(88, 2, 'Kebithigollewa', 'කැබිතිගොල්ලෑව', 'கெப்பிட்டிக்கொல்லாவை', NULL, NULL, NULL, '50500', '8.64112290', '80.66969990'),
(89, 2, 'Kekirawa', 'කැකිරාව', 'கெக்கிராவ', NULL, NULL, NULL, '50100', '8.04210300', '80.59383300'),
(90, 2, 'Kendewa', 'කේන්දෑව', 'கெண்டேவா', NULL, NULL, NULL, '50452', '8.49101270', '80.60420240'),
(91, 2, 'Kiralogama', 'කිරළෝගම', 'கிரலோகம', NULL, NULL, NULL, '50259', '8.19062870', '80.36864880'),
(92, 2, 'Kirigalwewa', 'කිරිගල්වැව', 'கிரிகல்வெவ', NULL, NULL, NULL, '50511', '8.53632700', '80.55773360'),
(93, 2, 'Kirimundalama', 'කිරිමුන්ඩලම', 'கிரிமுண்டலம', NULL, NULL, NULL, '61362', '8.31135180', '80.40365080'),
(94, 2, 'Kitulhitiyawa', 'කිතුල්හිටියාව', 'கிதுல்ஹிட்டியாவ', NULL, NULL, NULL, '50132', '8.31135180', '80.40365080'),
(95, 2, 'Kurundankulama', 'කුරුන්දන්කුලම', 'குருந்தன்குளம்', NULL, NULL, NULL, '50062', '8.35485670', '80.45212160'),
(96, 2, 'Labunoruwa', 'ලබුනෝරුව', 'லாபுனோருவா', NULL, NULL, NULL, '50088', '8.16498510', '80.59799730'),
(97, 2, 'Ihalagama', 'ඉහලගම', 'இஹலகம', NULL, NULL, NULL, '50304', '8.33183050', '80.40290170'),
(98, 2, 'Ipologama', 'ඉපොලොගම', 'இப்பலோகம', NULL, NULL, NULL, '50280', '8.06502700', '80.53551070'),
(99, 2, 'Madatugama', 'මාදතුගම', 'மடடுகம', NULL, NULL, NULL, '50130', '7.94585760', '80.62714150'),
(100, 2, 'Maha Elagamuwa', 'මහ ඇලගමුව', 'மஹா எலகமுவா', NULL, NULL, NULL, '50126', '7.99146130', '80.61881560'),
(101, 2, 'Mahabulankulama', 'මහබුලංකුලම', 'மஹாபுலன்குளம', NULL, NULL, NULL, '50196', '8.34481060', '80.39723910'),
(102, 2, 'Mahailluppallama', 'මහඉලුප්පල්ලම', 'மகைல்லுப்பல்லம', NULL, NULL, NULL, '50270', '8.10373640', '80.46046430'),
(103, 2, 'Mahakanadarawa', 'මහකනදරාව', 'மகாகனதரவ', NULL, NULL, NULL, '50306', '8.35002930', '80.39636870'),
(104, 2, 'Mahapothana', 'මහපොතාන', 'மஹாபோதனா', NULL, NULL, NULL, '50327', '8.38787430', '80.76120640'),
(105, 2, 'Mahasenpura', 'මහසෙන්පුර', 'மகாசென்புரா', NULL, NULL, NULL, '50574', '8.86182610', '80.84884980'),
(106, 2, 'Mahawilachchiya', 'මහවිලච්චිය', 'மஹாவிலச்சியா', NULL, NULL, NULL, '50022', '8.47075510', '80.20982190'),
(107, 2, 'Mailagaswewa', 'මයිලගස්වැව', 'மைலகஸ்வெவ', NULL, NULL, NULL, '50384', '8.28185290', '80.68262540'),
(108, 2, 'Malwanagama', 'මල්වනගම', 'மல்வானகம', NULL, NULL, NULL, '50236', '8.31135180', '80.40365080'),
(109, 2, 'Maneruwa', 'මනේරුව', 'மானேருவா', NULL, NULL, NULL, '50182', '7.90214030', '80.47992730'),
(110, 2, 'Maradankadawala', 'මරදන්කඩවල', 'மரதன்கடவல', NULL, NULL, NULL, '50080', '8.11686520', '80.56051110'),
(111, 2, 'Maradankalla', 'මරදන්කල්ල', 'மரதன்கல்ல', NULL, NULL, NULL, '50308', '8.11686520', '80.56051110'),
(112, 2, 'Medawachchiya', 'මැදවච්චිය', 'மதவாச்சி', NULL, NULL, NULL, '50500', '8.53748130', '80.49098060'),
(113, 2, 'Megodawewa', 'මීගොඩවැව', 'மெகொடவெவ', NULL, NULL, NULL, '50334', '8.21570610', '80.70237990'),
(114, 2, 'Mihintale', 'මිහින්තලේ', 'மிஹிந்தலை', NULL, NULL, NULL, '50300', '8.35342320', '80.50494450'),
(115, 2, 'Morakewa', 'මොරකෑව', 'மொரகேவா', NULL, NULL, NULL, '50349', '8.50922770', '80.78517100'),
(116, 2, 'Mulkiriyawa', 'මුල්කිරියාව', 'முல்கிரியாவா', NULL, NULL, NULL, '50324', '8.31135180', '80.40365080'),
(117, 2, 'Muriyakadawala', 'මුරියකඩවල', 'முறியகடவல', NULL, NULL, NULL, '50344', '8.14464530', '80.58841560'),
(118, 5, 'Colombo 15', 'කොළඹ 15', 'கொழும்பு 15', 'Modara', 'මෝදර', 'முகத்துவாரம்', '01500', '6.96547650', '79.87083950'),
(119, 2, 'Nachchaduwa', 'නච්චදූව', 'நாச்சதுவ', NULL, NULL, NULL, '50046', '8.25549640', '80.48270740'),
(120, 2, 'Namalpura', 'නාමල්පුර', 'நாமல்புர', NULL, NULL, NULL, '50339', '8.14396200', '80.74731900'),
(121, 2, 'Negampaha', 'නෑගම්පහ', 'நெகம்பஹா', NULL, NULL, NULL, '50180', '7.95785590', '80.51122380'),
(122, 2, 'Nochchiyagama', 'නොච්චියාගම', 'நொச்சியாகம', NULL, NULL, NULL, '50200', '8.29255010', '80.22655450'),
(123, 2, 'Nuwaragala', 'නුවරගල', 'நுவரகல', NULL, NULL, NULL, '51039', '7.79264660', '81.00368210'),
(124, 2, 'Padavi Maithripura', 'පදවි මෛත්‍රීපුර', 'பதவிமைத்ரிபுர', NULL, NULL, NULL, '50572', '8.34481060', '80.39723910'),
(125, 2, 'Padavi Parakramapura', 'පදවි පරාක්‍රමපුර', 'பதவிபராக்ரமபுர', NULL, NULL, NULL, '50582', '8.90344220', '80.77579840'),
(126, 2, 'Padavi Sripura', 'පදවි ශ්‍රීපුර', 'பதவி சிரபுர', NULL, NULL, NULL, '50587', '8.91950600', '80.80871030'),
(127, 2, 'Padavi Sritissapura', 'පදවි ශ්‍රීතිස්සපුර', 'பதவி ஸ்ரீதிஸ்ஸபுர', NULL, NULL, NULL, '50588', '8.31135180', '80.40365080'),
(128, 2, 'Padaviya', 'පදවිය', 'பதவிய', NULL, NULL, NULL, '50570', '8.83409980', '80.76073890'),
(129, 2, 'Padikaramaduwa', 'පඩිකරමඩුව', 'படிகாரமடுவ', NULL, NULL, NULL, '50338', '8.23585720', '80.74734750'),
(130, 2, 'Pahala Halmillewa', 'පහල හල්මිල්ලෑව', 'பஹல ஹல்மில்லேவா', NULL, NULL, NULL, '50206', '8.30461820', '80.61799520'),
(131, 2, 'Pahala Maragahawe', 'පහල මරගහවෙ', 'பஹல மரகஹவே', NULL, NULL, NULL, '50220', '8.24286010', '80.15319510'),
(132, 2, 'Pahalagama', 'පහලගම', 'பஹலகம', NULL, NULL, NULL, '50244', '8.18585380', '80.28230630'),
(133, 2, 'Palugaswewa', 'පලුගස්වැව', 'பலுகஸ்வெவ', NULL, NULL, NULL, '50144', '8.06044070', '80.68817180'),
(134, 2, 'Pandukabayapura', 'පන්ඩුකාබයපුර', 'பாண்டுகபயபுர', NULL, NULL, NULL, '50448', '8.31135180', '80.40365080'),
(135, 2, 'Pandulagama', 'පන්ඩුලගම', 'பந்துலகம', NULL, NULL, NULL, '50029', '8.32751600', '80.36110910'),
(136, 2, 'Parakumpura', 'පරාක්‍රමපුර', 'பரகும்புரா', NULL, NULL, NULL, '50326', '8.31135180', '80.40365080'),
(137, 2, 'Parangiyawadiya', 'පරංගියාවාඩිය', 'பரங்கியவாடியா', NULL, NULL, NULL, '50354', '8.48798500', '80.92077370'),
(138, 2, 'Parasangahawewa', 'පරසන්ගහවැව', 'பரசங்கஹவெவ', NULL, NULL, NULL, '50055', '8.35534470', '80.39647510'),
(139, 2, 'Pelatiyawa', 'පැලටියාව', 'பெலட்டியவா', NULL, NULL, NULL, '51033', '7.81604000', '81.09202180'),
(140, 2, 'Pemaduwa', 'පෙමදූව', 'பேமதுவ', NULL, NULL, NULL, '50020', '8.49536680', '80.19151100'),
(141, 2, 'Perimiyankulama', 'පෙරිමියන්කුලම', 'பெரிமியங்குளம', NULL, NULL, NULL, '50004', '8.35534470', '80.39647510'),
(142, 2, 'Pihimbiyagolewa', 'පිහිඹියගොල්ලෑව', 'பிஹிம்பியகோலேவா', NULL, NULL, NULL, '50512', '8.31135180', '80.40365080'),
(143, 2, 'Pubbogama', 'පුබ්බෝගම', 'புப்போகம', NULL, NULL, NULL, '50122', '7.92807970', '80.59681890'),
(144, 2, 'Punewa', 'පූනෑව', 'புனேவா', NULL, NULL, NULL, '50506', '8.61016710', '80.46880610'),
(145, 2, 'Rajanganaya', 'රාජාංගනය', 'ராஜநாயகை', NULL, NULL, NULL, '50246', '8.16572070', '80.19644430'),
(146, 2, 'Rambewa', 'රම්බෑව්', 'ரம்பேவ', NULL, NULL, NULL, '50450', '8.44010740', '80.50494450'),
(147, 2, 'Rampathwila', 'රම්පත්විල', 'ரம்பத்வில', NULL, NULL, NULL, '50386', '8.40259460', '80.63546650'),
(148, 2, 'Rathmalgahawewa', 'රත්මල්ගහවැව', 'ரத்மல்கஹவெவ', NULL, NULL, NULL, '50514', '8.52339920', '80.69649050'),
(149, 2, 'Saliyapura', 'සාලියපුර', 'சாலியபுர', NULL, NULL, NULL, '50008', '8.40542620', '80.41596030'),
(150, 2, 'Seeppukulama', 'සීප්පුකුලම', 'சீப்புக்குளம', NULL, NULL, NULL, '50380', '8.38161270', '80.58905790'),
(151, 2, 'Senapura', 'සේනාපුර', 'சேனாபுர', NULL, NULL, NULL, '50284', '8.00068170', '81.15821120'),
(152, 2, 'Sivalakulama', 'සිවලකුලම', 'சீவலக்குளம', NULL, NULL, NULL, '50068', '8.25643610', '80.63604780'),
(153, 2, 'Siyambalewa', 'සියඹලෑව', 'சியம்பலேவா', NULL, NULL, NULL, '50184', '8.01668610', '80.42708850'),
(154, 2, 'Sravasthipura', 'ස්‍රාවස්තිපුර', 'ஸ்ரவஸ்திபுரா', NULL, NULL, NULL, '50042', '8.29881970', '80.37702160'),
(155, 2, 'Talawa', 'තලාව', 'தலாவ', NULL, NULL, NULL, '50230', '8.23651890', '80.35077300'),
(156, 2, 'Tambuttegama', 'තඹුත්තේගම', 'தம்புத்தேகம', NULL, NULL, NULL, '50240', '8.15400150', '80.30459670'),
(157, 2, 'Tammennawa', 'තම්මැන්නාව', 'தம்மென்னாவா', NULL, NULL, NULL, '50104', '8.35002930', '80.39636870'),
(158, 2, 'Tantirimale', 'තන්තිරිමලේ', 'தந்திரிமலை', NULL, NULL, NULL, '50016', '8.57228020', '80.25722250'),
(159, 2, 'Telhiriyawa', 'තෙල්හිරියාව', 'தெல்ஹிரியாவ', NULL, NULL, NULL, '50242', '8.14312930', '80.31413490'),
(160, 2, 'Tirappane', 'තිරප්පනේ', 'திரப்பனே', NULL, NULL, NULL, '50072', '8.21330460', '80.52717560'),
(161, 2, 'Tittagonewa', 'තිත්තගෝනෑව', 'திட்டகோனேவா', NULL, NULL, NULL, '50558', '8.69645040', '80.77132100'),
(162, 2, 'Udunuwara Colony', 'උඩුනුවර කොළණිය', 'உடுநுவர காலனி', NULL, NULL, NULL, '50207', '7.23197260', '80.56606570'),
(163, 2, 'Upuldeniya', 'උපුල්දෙනිය', 'உபுல்தெனிய', NULL, NULL, NULL, '50382', '8.31380840', '80.66043640'),
(164, 2, 'Uttimaduwa', 'උට්ටිමඩුව', 'உத்திமடுவ', NULL, NULL, NULL, '50067', '8.42457530', '80.25833250'),
(165, 2, 'Vellamanal', 'වෙල්ලමනල්', 'வெல்லமணல்', NULL, NULL, NULL, '31053', '8.31135180', '80.40365080'),
(166, 2, 'Viharapalugama', 'විහාරපාළුගම', 'விஹாரபாலுகம', NULL, NULL, NULL, '50012', '8.36304860', '80.40542270'),
(167, 2, 'Wahalkada', 'වාහල්කඩ', 'வஹல்கடா', NULL, NULL, NULL, '50564', '8.72249360', '80.83501090'),
(168, 2, 'Wahamalgollewa', 'වහමල්ගොල්ලෑව', 'வஹமல்கொல்லேவ', NULL, NULL, NULL, '50492', '8.48070790', '80.50216520'),
(169, 2, 'Walagambahuwa', 'වලගම්බාහුව', 'வலகம்பஹுவ', NULL, NULL, NULL, '50086', '8.15586220', '80.49660620'),
(170, 2, 'Walahaviddawewa', 'වලහාවිද්දෑව', 'வலஹவித்தவெவ', NULL, NULL, NULL, '50516', '8.45887190', '80.86599690'),
(171, 2, 'Welimuwapotana', 'වැලිමුවපතාන', 'வெலிமுவபொதன', NULL, NULL, NULL, '50358', '8.55929760', '80.83501090'),
(172, 2, 'Welioya Project', 'වැලිඔය ව්‍යාපෘතිය', 'வெலிஓயா திட்டம்', NULL, NULL, NULL, '50586', '8.96404140', '80.78794070'),
(173, 3, 'Akkarasiyaya', 'අක්කරසියය', 'அக்கரசியாய', NULL, NULL, NULL, '90166', '6.99340090', '81.05498150'),
(174, 3, 'Aluketiyawa', 'අලුකෙටියාව', 'அலுகெட்டியவா', NULL, NULL, NULL, '90736', '7.30000000', '81.11666700'),
(175, 3, 'Aluttaramma', 'අළුත්තරම', 'அழுதாரம்மா', NULL, NULL, NULL, '90722', '6.99340090', '81.05498150'),
(176, 3, 'Ambadandegama', 'අඹදන්ඩෙගම', 'அம்பதண்டேகம', NULL, NULL, NULL, '90108', '6.81900520', '81.05614580'),
(177, 3, 'Ambagasdowa', 'අඹගස්දූව', 'அம்பகஸ்டோவா', NULL, NULL, NULL, '90300', '6.92807100', '80.89657580'),
(178, 3, 'Arawa', 'අරාව', 'அரவா', NULL, NULL, NULL, '90017', '7.16666700', '81.08333300'),
(179, 3, 'Arawakumbura', 'අරාවකුඹුර', 'அரவகும்புரா', NULL, NULL, NULL, '90532', '7.08738620', '81.19955110'),
(180, 3, 'Arawatta', 'අරාවත්ත', 'அரவத்தா', NULL, NULL, NULL, '90712', '7.34330130', '81.03716620'),
(181, 3, 'Atakiriya', 'අටකිරියාව', 'அடகிரியா', NULL, NULL, NULL, '90542', '6.98189520', '81.07628300'),
(182, 3, 'Badulla', 'බදුල්ල', 'பதுளை', NULL, NULL, NULL, '90000', '6.99340090', '81.05498150'),
(183, 3, 'Baduluoya', 'බදුලුඔය', 'பதுலுஓயா', NULL, NULL, NULL, '90019', '7.12482550', '81.03026390'),
(184, 3, 'Ballaketuwa', 'බල්ලකැටුව', 'பதுலு ஓய', NULL, NULL, NULL, '90092', '6.86225690', '81.10029850'),
(185, 3, 'Bambarapana', 'බඹරපාන', 'பம்பரபான', NULL, NULL, NULL, '90322', '6.98156960', '80.95118350'),
(186, 3, 'Bandarawela', 'බණ්ඩාරවෙල', 'பண்டாரவளை', NULL, NULL, NULL, '90100', '6.82587800', '80.99815760'),
(187, 3, 'Beramada', 'බෙරමඩ', 'பெரமடா', NULL, NULL, NULL, '90066', '6.92125060', '79.84778520'),
(188, 3, 'Bibilegama', 'බිබිලේගම', 'பிபிலேகம', NULL, NULL, NULL, '90502', '6.89617300', '81.14029050'),
(189, 3, 'Boragas', 'බොරගස්', 'போரகஸ்', NULL, NULL, NULL, '90362', '6.89990100', '80.84608220'),
(190, 3, 'Boralanda', 'බොරලන්ද', 'பொரலண்டா', NULL, NULL, NULL, '90170', '6.82790440', '80.89450140'),
(191, 3, 'Bowela', 'බෝවෙල', 'போவேலா', NULL, NULL, NULL, '90302', '6.98189520', '81.07628300'),
(192, 3, 'Central Camp', 'මධ්‍යම කඳවුර', 'மத்திய முகாம்', NULL, NULL, NULL, '32050', '6.99340090', '81.05498150'),
(193, 3, 'Damanewela', 'දමනෙවෙල', 'தமனேவல', NULL, NULL, NULL, '32126', '6.99340090', '81.05498150'),
(194, 3, 'Dambana', 'දඹාන', 'தம்பானை', NULL, NULL, NULL, '90714', '7.41362290', '81.10834830'),
(195, 3, 'Dehiattakandiya', 'දෙහිඅත්තකන්ඩිය', 'தெகியத்தகண்டிய', NULL, NULL, NULL, '32150', '7.67127960', '81.04648400'),
(196, 3, 'Demodara', 'දෙමෝදර', 'தெமோதர', NULL, NULL, NULL, '90080', '6.89928290', '81.05817760'),
(197, 3, 'Diganatenna', 'දිගනතැන්න', 'திகனதென்ன', NULL, NULL, NULL, '90132', '6.85588490', '80.96526170'),
(198, 3, 'Dikkapitiya', 'දික්කපිටිය', 'திக்கபிட்டிய', NULL, NULL, NULL, '90214', '6.89368620', '80.93736230'),
(199, 3, 'Dimbulana', 'දිඹුලාන', 'டிம்புலான', NULL, NULL, NULL, '90324', '7.01527780', '80.94000000'),
(200, 3, 'Divulapelessa', 'දිවුලපැලැස්ස', 'திவுலபெலஸ்ஸ', NULL, NULL, NULL, '90726', '7.57782550', '81.00368210'),
(201, 3, 'Diyatalawa', 'දියතලාව', 'தியத்தலாவை', NULL, NULL, NULL, '90150', '6.80695100', '80.95720210'),
(202, 3, 'Dulgolla', 'දුල්ගොල්ල', 'துல்கொல்லா', NULL, NULL, NULL, '90104', '6.85685410', '80.88343670'),
(203, 3, 'Ekiriyankumbura', 'ඇකිරියන්කුඹුර', 'எகிரியன்கும்புர', NULL, NULL, NULL, '91502', '7.29888840', '81.24086890'),
(204, 3, 'Ella', 'ඇල්ල', 'எல்ல', NULL, NULL, NULL, '90090', '6.86669880', '81.04655300'),
(205, 3, 'Ettampitiya', 'ඇට්ටම්පිටිය', 'எட்டம்பிட்டிய', NULL, NULL, NULL, '90140', '6.93645060', '80.98779800'),
(206, 3, 'Galauda', 'ගලඋඩ', 'கல உட', NULL, NULL, NULL, '90065', '6.99340090', '81.05498150'),
(207, 3, 'Galporuyaya', 'ගල්පොරුයාය', 'கல்போருயாய', NULL, NULL, NULL, '90752', '7.42852030', '81.03682110'),
(208, 3, 'Gawarawela', 'ගවරවෙල', 'கவரவெல', NULL, NULL, NULL, '90082', '6.90284970', '81.07132610'),
(209, 3, 'Girandurukotte', 'ගිරාඳුරුකෝට්ටෙ', 'கிரந்துருகோட்டே', NULL, NULL, NULL, '90750', '7.46291690', '81.01749170'),
(210, 3, 'Godunna', 'ගොඩුන්න', 'கோடுன்னா', NULL, NULL, NULL, '90067', '7.06682380', '80.97488400'),
(211, 3, 'Gurutalawa', 'ගුරුතලාව', 'குருத்தலாவை', NULL, NULL, NULL, '90208', '6.84350900', '80.90002230'),
(212, 3, 'Haldummulla', 'හල්දුම්මුල්ල', 'ஹல்துமுல்ல', NULL, NULL, NULL, '90180', '6.76892280', '80.89266810'),
(213, 3, 'Hali Ela', 'හාලි ඇල', 'ஆலி-எலை', NULL, NULL, NULL, '90060', '6.95552540', '81.03143840'),
(214, 3, 'Hangunnawa', 'හඟුන්නෑව', 'ஹங்குன்னாவ', NULL, NULL, NULL, '90224', '6.94950730', '80.87237050'),
(215, 3, 'Haputale', 'හපුතලේ', 'அப்புத்தளை', NULL, NULL, NULL, '90160', '6.76541360', '80.95256550'),
(216, 3, 'Hebarawa', 'හබරාව', 'ஹெபராவா', NULL, NULL, NULL, '90724', '7.53197770', '80.98987010'),
(217, 3, 'Heeloya', 'හීලොය', 'ஹீல் ஓய', NULL, NULL, NULL, '90112', '6.86669880', '81.04655300'),
(218, 3, 'Helahalpe', 'හෙලහල්පේ', 'ஹெலஹல்பே', NULL, NULL, NULL, '90122', '6.88928830', '81.03450680'),
(219, 3, 'Helapupula', 'හෙලපුපුළ', 'ஹெலபுபுலா', NULL, NULL, NULL, '90094', '6.98189520', '81.07628300'),
(220, 3, 'Hopton', 'හෝප්ටන්', 'ஹொப்டன்', NULL, NULL, NULL, '90524', '6.98823220', '81.19748460'),
(221, 3, 'Idalgashinna', 'ඉදල්ගස්ඉන්න', 'இதல்கஸ்ஹின்ன', NULL, NULL, NULL, '96167', '6.78296900', '80.90003310'),
(222, 3, 'Kahataruppa', 'කහටරුප්ප', 'கஹடருப்பா', NULL, NULL, NULL, '90052', '6.98189520', '81.07628300'),
(223, 3, 'Kalugahakandura', 'කළුගහකණ්ඳුර', 'களுகஹகந்துர', NULL, NULL, NULL, '90546', '7.12266830', '81.09478080'),
(224, 3, 'Kalupahana', 'කළුපහණ', 'களுபஹன', NULL, NULL, NULL, '90186', '6.79100550', '80.84537710'),
(225, 3, 'Kebillawela', 'කොබිල්ලවෙල', 'கெபில்லவெல', NULL, NULL, NULL, '90102', '6.83496050', '80.99328360'),
(226, 3, 'Kendagolla', 'කන්දෙගොල්ල', 'கெந்தகொல்ல', NULL, NULL, NULL, '90048', '6.99275530', '81.10846340'),
(227, 3, 'Keselpotha', 'කෙසෙල්පොත', 'கெசல்பொத', NULL, NULL, NULL, '90738', '7.32834070', '81.09421320'),
(228, 3, 'Ketawatta', 'කේතවත්ත', 'கெட்டவத்த', NULL, NULL, NULL, '90016', '6.98189520', '81.07628300'),
(229, 3, 'Kiriwanagama', 'කිරිවනගම', 'கிரிவணகம', NULL, NULL, NULL, '90184', '6.77335170', '80.83121380'),
(230, 3, 'Koslanda', 'කොස්ලන්ද', 'கொஸ்லாந்தை', NULL, NULL, NULL, '90190', '6.74312340', '81.01783690'),
(231, 3, 'Kuruwitenna', 'කුරුවිතැන්න', 'குருவிட்டென்ன', NULL, NULL, NULL, '90728', '6.98189520', '81.07628300'),
(232, 3, 'Kuttiyagolla', 'කුට්ටියාගොල්ල', 'குட்டியகொல்ல', NULL, NULL, NULL, '90046', '7.02684860', '81.09478080'),
(233, 3, 'Landewela', 'ලන්දේවෙල', 'லண்டேவெலா', NULL, NULL, NULL, '90068', '7.00514020', '81.00230100'),
(234, 3, 'Liyangahawela', 'ලියන්ගහවෙල', 'லியங்கஹவெல', NULL, NULL, NULL, '90106', '6.81189130', '81.02991830'),
(235, 3, 'Lunugala', 'ලුණුගල', 'லுணுகல', NULL, NULL, NULL, '90530', '7.04036760', '81.20167370'),
(236, 3, 'Lunuwatta', 'ලුණුවත්ත', 'லுனுவத்த', NULL, NULL, NULL, '90310', '6.95572350', '80.91939120'),
(237, 3, 'Madulsima', 'මඩොල්සිම', 'மடுல்சீம', NULL, NULL, NULL, '90535', '7.04667480', '81.15821120'),
(238, 3, 'Mahiyanganaya', 'මහියංගනය', 'மஹியங்கனை', NULL, NULL, NULL, '90700', '7.33161020', '81.00368210'),
(239, 3, 'Makulella', 'මකුලැල්ල', 'மகுலெல்லா', NULL, NULL, NULL, '90114', '6.82919910', '81.03406010'),
(240, 3, 'Malgoda', 'මල්ගොඩ', 'மல்கொட', NULL, NULL, NULL, '90754', '6.98189520', '81.07628300'),
(241, 3, 'Mapakadawewa', 'මාපාකඩවැව', 'மபகடவெவ', NULL, NULL, NULL, '90730', '7.28932120', '81.02577630'),
(242, 3, 'Maspanna', 'මස්පන්න', 'மஸ்பன்னா', NULL, NULL, NULL, '90328', '7.02794930', '80.94427320'),
(243, 3, 'Maussagolla', 'මාඋස්සාගොල්ල', 'மவுஸ்ஸாகொல்ல', NULL, NULL, NULL, '90582', '6.91240280', '81.13856710'),
(244, 3, 'Mawanagama', 'මාවනගම', 'மவனகம', NULL, NULL, NULL, '32158', '7.59697890', '81.15269760'),
(245, 3, 'Medawela Udukinda', 'මැදවෙල උඩුකිඳ', 'மெதவெல உடுகிந்த', NULL, NULL, NULL, '90218', '6.86256990', '80.85776300'),
(246, 3, 'Meegahakiula', 'මීගහකිවුල', 'மீகஹகியுலா', NULL, NULL, NULL, '90015', '7.01864620', '81.05639800'),
(247, 3, 'Metigahatenna', 'මැටිගහතැන්න', 'மெட்டிகஹதென்ன', NULL, NULL, NULL, '90540', '7.07720390', '81.15407600'),
(248, 3, 'Mirahawatta', 'මිරහවත්ත', 'மிராஹவத்த', NULL, NULL, NULL, '90134', '6.87515400', '80.93397920'),
(249, 3, 'Miriyabedda', 'මිරියාබැද්ද', 'மிரியபெத்த', NULL, NULL, NULL, '90504', '6.99340090', '81.05498150'),
(250, 3, 'Nawamedagama', 'නවමැදගම', 'நவமேதகம', NULL, NULL, NULL, '32120', '7.52535610', '81.05890600'),
(251, 3, 'Nelumgama', 'නෙළුම්ගම', 'நெலும்கம', NULL, NULL, NULL, '90042', '6.99417300', '81.07000500'),
(252, 3, 'Nikapotha', 'නිකපොතගම', 'நிகபோத', NULL, NULL, NULL, '90165', '6.74527170', '80.97298900'),
(253, 3, 'Nugatalawa', 'නුගතලාව', 'நுகத்தலாவை', NULL, NULL, NULL, '90216', '6.90191460', '80.90770790'),
(254, 3, 'Ohiya', 'ඔහිය', 'ஒஹிய', NULL, NULL, NULL, '90168', '6.81901030', '80.84469840'),
(255, 3, 'Pahalarathkinda', 'පහළරත්කිඳ', 'பஹலரத்கிந்தா', NULL, NULL, NULL, '90756', '6.99340090', '81.05498150'),
(256, 3, 'Pallekiruwa', 'පල්ලේකිරුව', 'பல்லேகிருவ', NULL, NULL, NULL, '90534', '7.01599390', '81.22434440'),
(257, 3, 'Passara', 'පස්සර', 'பசறை', NULL, NULL, NULL, '90500', '6.93490880', '81.15269760'),
(258, 3, 'Pattiyagedara', 'පට්ටියගෙදර', 'பட்டியகெதர', NULL, NULL, NULL, '90138', '6.90433540', '80.97438700'),
(259, 3, 'Pelagahatenna', 'පල්ලෙගහතැන්න', 'பெலகஹதென்ன', NULL, NULL, NULL, '90522', '6.96096040', '81.12512350'),
(260, 3, 'Perawella', 'පේරවැල්ල', 'பெரவெல்ல', NULL, NULL, NULL, '90222', '6.94737520', '80.83078860'),
(261, 3, 'Pitamaruwa', 'පිටමාරුව', 'பிடமருவா', NULL, NULL, NULL, '90544', '7.11015220', '81.15916800'),
(262, 3, 'Pitapola', 'පිටපොළ', 'பிடபொல', NULL, NULL, NULL, '90171', '6.80930280', '80.89173530'),
(263, 3, 'Puhulpola', 'පුහුපොළ', 'புழுல்பொல', NULL, NULL, NULL, '90212', '6.98189520', '81.07628300'),
(264, 3, 'Rajagalatenna', 'රජගලතැන්න', 'ராஜகலதென்ன', NULL, NULL, NULL, '32068', '6.98189520', '81.07628300'),
(265, 3, 'Rathkarawwa', 'රත්කරව්ව', 'ரத்கரவ்வா', NULL, NULL, NULL, '90164', '6.80691400', '80.90556450'),
(266, 3, 'Ridimaliyadda', 'රිදීමල්දෙණිය', 'ரிதிமாலியத்த', NULL, NULL, NULL, '90704', '7.21816000', '81.12050680'),
(267, 3, 'Silmiyapura', 'සිල්මියාපුර', 'சில்மியாபுரா', NULL, NULL, NULL, '90364', '6.91441390', '80.84193070'),
(268, 3, 'Sirimalgoda', 'සිරිමල්ගොඩ', 'சிறிமல்கொட', NULL, NULL, NULL, '90044', '6.98189520', '81.07628300'),
(269, 3, 'Siripura', 'සිරිපුර', 'சிரிபுர', NULL, NULL, NULL, '32155', '6.96852990', '80.91082680'),
(270, 3, 'Sorabora Colony', 'සොරබොර කොලනිය', 'சொரபோரா காலனி', NULL, NULL, NULL, '90718', '7.36061250', '80.98434460'),
(271, 3, 'Soragune', 'සොරගුනේ', 'சொரகுனே', NULL, NULL, NULL, '90183', '6.74491800', '80.89279720'),
(272, 3, 'Soranathota', 'සොරණාතොට', 'சொரணாதோட்டை', NULL, NULL, NULL, '90008', '7.02284960', '81.04495180'),
(273, 3, 'Taldena', 'තල්දෙන', 'டால்டேனா', NULL, NULL, NULL, '90014', '7.09199130', '81.04835830'),
(274, 3, 'Timbirigaspitiya', 'තිඹිරිගස්පිටිය', 'திம்பிரிகஸ்பிட்டிய', NULL, NULL, NULL, '90012', '6.99340090', '81.05498150'),
(275, 3, 'Uduhawara', 'උඩුහාවර', 'உடுஹவர', NULL, NULL, NULL, '90226', '6.94799280', '80.86268640'),
(276, 3, 'Uraniya', 'උරණිය', 'ஊரணியா', NULL, NULL, NULL, '90702', '7.26054430', '81.08523180'),
(277, 3, 'Uva Karandagolla', 'ඌව කරඳගොල්ල', 'ஊவா கரந்தகொல்ல', NULL, NULL, NULL, '90091', '6.98189520', '81.07628300'),
(278, 3, 'Uva Mawelagama', 'ඌව මාවැල්ගම', 'ஊவா மாவெலகம', NULL, NULL, NULL, '90192', '6.98189520', '81.07628300'),
(279, 3, 'Uva Tenna', 'ඌව තැන්න', 'ஊவா தென்ன', NULL, NULL, NULL, '90188', '6.98189520', '81.07628300'),
(280, 3, 'Uva Tissapura', 'ඌව තිස්සපුර', 'ஊவா திஸ்ஸபுர', NULL, NULL, NULL, '90734', '6.98189520', '81.07628300'),
(281, 3, 'Welimada', 'වැලිමඩ', 'வெளிமடை', NULL, NULL, NULL, '90200', '6.90190720', '80.90792450'),
(282, 3, 'Weranketagoda', 'වෑරැන්කැටගොඩ', 'வெரன்கெட்டகொட', NULL, NULL, NULL, '32062', '6.98189520', '81.07628300'),
(283, 3, 'Wewatta', 'වෑවත්ත', 'வெவட்ட', NULL, NULL, NULL, '90716', '7.38626820', '81.16441360'),
(284, 3, 'Wineethagama', 'විනීතගම', 'வினீதகம', NULL, NULL, NULL, '90034', '6.98088050', '81.07696420'),
(285, 3, 'Yalagamuwa', 'යාලගමුව', 'யலகமுவ', NULL, NULL, NULL, '90329', '6.98189520', '81.07628300'),
(286, 3, 'Yalwela', 'යල්වෙල', 'யல்வெல', NULL, NULL, NULL, '90706', '7.26420680', '81.15676260'),
(287, 4, 'Addalaichenai', 'අඩ්ඩාලච්චේන', 'அட்டாளைச்சேனை', NULL, NULL, NULL, '32350', '7.24425790', '81.85480710'),
(288, 4, 'Ampilanthurai', 'අම්පිලන්තුරෙයි', 'அம்பிளாந்துறை', NULL, NULL, NULL, '30162', '7.71655610', '81.69881720'),
(289, 4, 'Araipattai', 'අරෙයිපට්ටායි', 'அரைப்பட்டை', NULL, NULL, NULL, '30150', '7.73099710', '81.67472950'),
(290, 4, 'Ayithiyamalai', 'අයිතියමලෙයි', 'ஆயித்தியமலை', NULL, NULL, NULL, '30362', '7.67361980', '81.57030650'),
(291, 4, 'Bakiella', 'බකිඇල්ල', 'பாக்கியெல்லா', NULL, NULL, NULL, '30206', '7.73099710', '81.67472950'),
(292, 4, 'Batticaloa', 'මඩකලපුව', 'மட்டக்களப்பு', NULL, NULL, NULL, '30000', '7.73099710', '81.67472950'),
(293, 4, 'Cheddipalayam', 'චෙඩ්ඩිපලයම්', 'செட்டிபாளையம்', NULL, NULL, NULL, '30194', '7.57957080', '81.78493010'),
(294, 4, 'Chenkaladi', 'චෙන්කලඩි', 'செங்கலடி', NULL, NULL, NULL, '30350', '7.78585710', '81.58980160'),
(295, 4, 'Eravur', 'එරාවූර්', 'ஏறாவூர்', NULL, NULL, NULL, '30300', '7.77689720', '81.60420280'),
(296, 4, 'Kaluwanchikudi', 'කළුවංචිකුඩි', 'களுவாஞ்சிக்குடி', NULL, NULL, NULL, '30200', '7.52937250', '81.79460920'),
(297, 4, 'Kaluwankemy', 'කළුවන්කෙමි', 'களுவங்கேணி', NULL, NULL, NULL, '30372', '7.52937250', '81.79460920'),
(298, 4, 'Kannankudah', 'කන්නන්කුඩා', 'கன்னங்குடா', NULL, NULL, NULL, '30016', '7.67886980', '81.67250220'),
(299, 4, 'Karadiyanaru', 'කරදියනාරු', 'கரடியனாறு', NULL, NULL, NULL, '30354', '7.70074660', '81.53838700'),
(300, 4, 'Kathiraveli', 'කදිරවේලි', 'கதிரவெளி', NULL, NULL, NULL, '30456', '8.22288100', '81.40385770'),
(301, 4, 'Kattankudi', 'කාත්තන්කුඩි', 'காத்தான்குடி', NULL, NULL, NULL, '30100', '7.68536950', '81.72601230'),
(302, 4, 'Kiran', 'කිරාන්', 'கிரான்', 'கிரான்', NULL, NULL, '30394', '7.86777970', '81.51026550'),
(303, 4, 'Kirankulam', 'කිරාන්කුලම්', 'கிரான்குளம்', NULL, NULL, NULL, '30159', '7.60532060', '81.76838280'),
(304, 4, 'Koddaikallar', 'කොඩ්ඩෙයිකල්ලාර්', 'கோட்டைக்கல்லாறு', NULL, NULL, NULL, '30249', '7.48387900', '81.80798530'),
(305, 4, 'Kokkaddicholai', 'කොක්කඩිචෝලෙයි', 'கொக்கட்டிச்சோலை', NULL, NULL, NULL, '30160', '7.61605700', '81.71031550'),
(306, 4, 'Kurukkalmadam', 'කුරුක්කල්මඩම්', 'குருக்கள்மடம்', NULL, NULL, NULL, '30192', '7.58799500', '81.78041500'),
(307, 4, 'Mandur', 'මන්දූර්', 'மண்டூர்', NULL, NULL, NULL, '30220', '7.48266490', '81.75409020'),
(308, 4, 'Miravodai', 'මිරවෝඞායි', 'மீராவோடை', NULL, NULL, NULL, '30426', '7.88934640', '81.51026550'),
(309, 4, 'Murakottanchanai', 'මුරකොට්ටන්චනෛ', 'முருகண்டிச்சேனை', NULL, NULL, NULL, '30392', '7.73099710', '81.67472950'),
(310, 4, 'Navagirinagar', 'නවගිරිනගර්', 'நவகிரிநகர்', NULL, NULL, NULL, '30238', '7.73099710', '81.67472950'),
(311, 4, 'Navatkadu', 'නවත්කදු', 'நாவற்குடா', NULL, NULL, NULL, '30018', '7.20452670', '81.84019570'),
(312, 4, 'Oddamavadi', 'ඔට්ටමාවඩ්', 'ஓட்டமாவடி', NULL, NULL, NULL, '30420', '7.90310760', '81.52398460'),
(313, 4, 'Palamunai', 'පාලමුන', 'பாலமுனை', NULL, NULL, NULL, '32354', '7.66111430', '81.74725220'),
(314, 4, 'Pankudavely', 'පාන්කුඩාවේලි', 'பான்குடாவெளி', NULL, NULL, NULL, '30352', '7.73099710', '81.67472950'),
(315, 4, 'Periyaporativu', 'පෙරියපෝරතිවු', 'பெரியபோரைதீவு', NULL, NULL, NULL, '30230', '7.51916300', '81.76913180'),
(316, 4, 'Periyapullumalai', 'පෙරියපුල්ලුමලෙයි', 'பெரியபுல்லுமலை', NULL, NULL, NULL, '30358', '7.58167990', '81.46085600'),
(317, 4, 'Pillaiyaradi', 'පිල්ලියරදී', 'பிள்ளையாரடி', NULL, NULL, NULL, '30022', '7.73099710', '81.67472950'),
(318, 4, 'Punanai', 'පූනානයි', 'புணாணை', NULL, NULL, NULL, '30428', '7.96500740', '81.38897480'),
(319, 4, 'Thannamunai', 'තන්නමුනෛ', 'தன்னாமுனை', NULL, NULL, NULL, '30024', '7.75310300', '81.63780190'),
(320, 4, 'Thettativu', 'තෙටිටතිවු', 'தேத்தாத்தீவு', NULL, NULL, NULL, '30196', '7.55581030', '81.79670110'),
(321, 4, 'Thikkodai', 'තික්කොඞයි', 'திக்கோடை', NULL, NULL, NULL, '30236', '7.52434860', '81.68841840'),
(322, 4, 'Thirupalugamam', 'තිරුපලුගාමම්', 'திருப்பழுகாமம்', NULL, NULL, NULL, '30234', '7.73099710', '81.67472950'),
(323, 4, 'Unnichchai', 'උන්නිච්චේ', 'உன்னிச்சை', NULL, NULL, NULL, '30364', '7.61828800', '81.54882070'),
(324, 4, 'Vakaneri', 'වාගනේරි', 'வாகனேரி', NULL, NULL, NULL, '30424', '7.92654340', '81.48281980'),
(325, 4, 'Vakarai', 'වාකරෙයි', 'வாகரை', NULL, NULL, NULL, '30450', '8.13690990', '81.43407900'),
(326, 4, 'Valaichenai', 'වාලච්චේන', 'வாழைச்சேனை', NULL, NULL, NULL, '30400', '7.92132760', '81.52467050'),
(327, 4, 'Vantharumoolai', 'වන්තරුමූලෙයි', 'வந்தாறுமூலை', NULL, NULL, NULL, '30376', '7.79058820', '81.55690030'),
(328, 4, 'Vellavely', 'වේල්ලාවෙලි', 'வெல்லாவெளி', NULL, NULL, NULL, '30204', '7.49561360', '81.72947020'),
(329, 5, 'Akarawita', 'අකරවිට', 'அகரவிட்ட', NULL, NULL, NULL, '10732', '6.84221160', '80.00302570'),
(330, 5, 'Ambalangoda', 'අම්බලන්ගොඩ', 'அம்பலாங்கொடை', NULL, NULL, NULL, '80300', '6.77508470', '79.96543240'),
(331, 5, 'Athurugiriya', 'අතුරුගිරිය', 'அத்துருகிரிய', NULL, NULL, NULL, '10150', '6.87231850', '80.00038750'),
(332, 5, 'Avissawella', 'අවිස්සාවේල්ල', 'அவிசாவளை', NULL, NULL, NULL, '10700', '6.95432890', '80.20457680'),
(333, 5, 'Batawala', 'බටවැල', 'படவாலா', NULL, NULL, NULL, '10513', '6.87742700', '80.05488940'),
(334, 5, 'Battaramulla', 'බත්තරමුල්ල', 'பத்தரமுல்லை', NULL, NULL, NULL, '10120', '6.89838190', '79.91784130'),
(335, 5, 'Biyagama', 'බියගම', 'பியகம', NULL, NULL, NULL, '11650', '6.94621530', '79.98920340'),
(336, 5, 'Bope', 'බෝපෙ', 'போபே', NULL, NULL, NULL, '10522', '6.82488950', '80.13727570'),
(337, 5, 'Boralesgamuwa', 'බොරලැස්ගමුව', 'பொரலெஸ்கமுவ', NULL, NULL, NULL, '10290', '6.82335500', '79.90902460'),
(338, 5, 'Colombo 8', 'කොළඹ 8', 'கொழும்பு 8', 'Borella', 'බොරැල්ල', 'பொறளை', '00800', '6.91217960', '79.88288280'),
(339, 5, 'Dedigamuwa', 'දැඩිගමුව', 'தெடிகமுவ', NULL, NULL, NULL, '10656', '6.89801900', '80.02694400'),
(340, 5, 'Dehiwala', 'දෙහිවල', 'தெஹிவளை', NULL, NULL, NULL, '10350', '6.83011850', '79.88008320'),
(341, 5, 'Deltara', 'දෙල්තර', 'டெல்டாரா', NULL, NULL, NULL, '10302', '6.78513280', '79.91371250'),
(342, 5, 'Habarakada', 'හබරකඩ', 'ஹபரகட', NULL, NULL, NULL, '10204', '6.86596670', '80.01296790'),
(343, 5, 'Hanwella', 'හන්වැල්ල', 'ஹங்வெல்ல', NULL, NULL, NULL, '10650', '6.89783440', '80.08142920'),
(344, 5, 'Hiripitya', 'හිරිපිටිය', 'ஹிரிபிட்டிய', NULL, NULL, NULL, '10232', '6.83346570', '79.97661950'),
(345, 5, 'Hokandara', 'හොකන්දර', 'ஹோகந்தர', NULL, NULL, NULL, '10118', '6.87431920', '79.96962770'),
(346, 5, 'Homagama', 'හෝමාගම', 'ஹோமாகம', NULL, NULL, NULL, '10200', '6.84327620', '80.00318330'),
(347, 5, 'Horagala', 'හොරගල', 'ஹொரகல', NULL, NULL, NULL, '10502', '6.81482950', '80.07236730'),
(348, 5, 'Kaduwela', 'කඩුවෙල', 'கடுவெல', NULL, NULL, NULL, '10640', '6.94058620', '79.95226860'),
(349, 5, 'Kaluaggala', 'කළුගල්ල', 'கலுஅகல', NULL, NULL, NULL, '11224', '6.93278990', '80.10656460'),
(350, 5, 'Kapugoda', 'කපුගොඩ', 'கப்புகொட', NULL, NULL, NULL, '10662', '6.94498250', '80.07466280'),
(351, 5, 'Kehelwatta', 'කොහල්වත්ත', 'கெஹல்வத்த', NULL, NULL, NULL, '12550', '6.93352580', '79.85978310'),
(352, 5, 'Kiriwattuduwa', 'කිරිවත්තුඩුව', 'கிரிவத்துடுவ', NULL, NULL, NULL, '10208', '6.80237970', '80.00737680'),
(353, 5, 'Kolonnawa', 'කොලොන්නාව', 'கொலன்னாவ', NULL, NULL, NULL, '10600', '6.92801560', '79.89083080'),
(354, 5, 'Kosgama', 'කොස්ගම', 'கொஸ்கம', NULL, NULL, NULL, '10730', '6.93971650', '80.13692680'),
(355, 5, 'Madapatha', 'මඩපාත', 'மடபத', NULL, NULL, NULL, '10306', '6.76904650', '79.92906420'),
(356, 5, 'Maharagama', 'මහරගම', 'மகரகம', NULL, NULL, NULL, '10280', '6.84780040', '79.92176150'),
(357, 5, 'Malabe', 'මාළඹේ', 'மாலபே', NULL, NULL, NULL, '10115', '6.90784830', '79.94740870'),
(358, 5, 'Moratuwa', 'මොරටුව', 'மொரட்டுவ', NULL, NULL, NULL, '10400', '6.78807060', '79.89128130'),
(359, 5, 'Mount Lavinia', 'ගල්කිස්ස', 'கல்கிசை', NULL, NULL, NULL, '10370', '6.82215880', '79.87317740'),
(360, 5, 'Mullegama', 'මුල්ලේගම', 'முல்லேகம', NULL, NULL, NULL, '10202', '6.88452810', '80.01285620'),
(361, 5, 'Napawela', 'නාපාවෙල', 'நாபாவெல', NULL, NULL, NULL, '10704', '6.89641910', '79.88848190'),
(362, 5, 'Nugegoda', 'නුගේගොඩ', 'நுகேகொட', NULL, NULL, NULL, '10250', '6.86490810', '79.89967890'),
(363, 5, 'Padukka', 'පාදුක්ක', 'பாதுக்கை', NULL, NULL, NULL, '10500', '6.84536340', '80.10377210'),
(364, 5, 'Pannipitiya', 'පන්නිපිටිය', 'பன்னிப்பிட்டிய', NULL, NULL, NULL, '10230', '6.84639930', '79.94843460'),
(365, 5, 'Piliyandala', 'පිළියන්දල', 'பிலியந்தலை', NULL, NULL, NULL, '10300', '6.80175750', '79.92273130'),
(366, 5, 'Pitipana Homagama', 'පිටිපාන හෝමාගම', 'பிடிபன ஹோமாகம', NULL, NULL, NULL, '10206', '6.84444250', '80.02062030'),
(367, 5, 'Polgasowita', 'පොල්ගස්ඕවිට', 'பொல்கஸ்சோவிட', NULL, NULL, NULL, '10320', '6.78993580', '79.98081430'),
(368, 5, 'Pugoda', 'පූගොඩ', 'பூகொடை', NULL, NULL, NULL, '10660', '6.95903420', '80.13172030'),
(369, 5, 'Ranala', 'රණාල', 'ரணால', NULL, NULL, NULL, '10654', '6.91537590', '80.03393120'),
(370, 5, 'Siddamulla', 'සිද්ධමුල්ල', 'சித்தமுல்ல', NULL, NULL, NULL, '10304', '6.81725160', '79.95983830'),
(371, 5, 'Siyambalagoda', 'සියඹලාගොඩ', 'சியம்பலாகொட', NULL, NULL, NULL, '81462', '6.79228810', '79.96683080'),
(372, 5, 'Sri Jayawardenepura', 'ශ්‍රී ජයවර්ධනපුර', 'ஸ்ரீ ஜயவர்தனபுரக் கோட்டை', NULL, NULL, NULL, '10100', '6.87927560', '79.90080740'),
(373, 5, 'Talawatugoda', 'තලවතුගොඩ', 'தலவத்துகொட', NULL, NULL, NULL, '10116', '6.87586480', '79.93919360'),
(374, 5, 'Tummodara', 'තුම්මෝදර', 'தும்மோதர', NULL, NULL, NULL, '10682', '6.86589500', '80.16906420'),
(375, 5, 'Waga', 'වග', 'வாகா', NULL, NULL, NULL, '10680', '6.88051870', '80.14006710'),
(376, 5, 'Colombo 6', 'කොළඹ 6', 'கொழும்பு 6', 'Wellawatta', 'වැල්ලවත්ත', 'வெள்ளவத்தை', '00600', '6.87465790', '79.86048310'),
(377, 6, 'Agaliya', 'අගලිය', 'அகலியா', NULL, NULL, NULL, '80212', '6.00854630', '80.24223830'),
(378, 6, 'Ahangama', 'අහංගම', 'அஹங்கம', NULL, NULL, NULL, '80650', '5.97397470', '80.36215950'),
(379, 6, 'Ahungalla', 'අහුන්ගල්ල', 'அஹுங்கல்லா', NULL, NULL, NULL, '80562', '6.31327760', '80.04091780'),
(380, 6, 'Akmeemana', 'අක්මීමාන', 'அக்மீமான', NULL, NULL, NULL, '80090', '6.08363060', '80.29623850'),
(381, 6, 'Alawatugoda', 'අලවතුගොඩ', 'அலவதுகொட', NULL, NULL, NULL, '20140', '7.40899340', '80.61879420'),
(382, 6, 'Aluthwala', 'අළුත්වල', 'அலுத்வாலா', NULL, NULL, NULL, '80332', '6.18019580', '80.14006710'),
(383, 6, 'Ampegama', 'අම්පෙගම', 'அம்பேகம', NULL, NULL, NULL, '80204', '6.19467440', '80.14425400'),
(384, 6, 'Amugoda', 'අමුගොඩ', 'அமுகொட', NULL, NULL, NULL, '80422', '6.32125570', '80.21888580'),
(385, 6, 'Anangoda', 'අනන්ගොඩ', 'அனங்கோடா', NULL, NULL, NULL, '80044', '6.04756420', '80.25304120'),
(386, 6, 'Angulugaha', 'අඟුලුගහ', 'அங்குலுகாஹா', NULL, NULL, NULL, '80122', '6.03185250', '80.32409600'),
(387, 6, 'Ankokkawala', 'අංකොක්කාවල', 'அங்கொக்காவல', NULL, NULL, NULL, '80048', '6.05329180', '80.28091290'),
(388, 6, 'Aselapura', 'ඇසලපුර', 'அசேலபுர', NULL, NULL, NULL, '51072', '6.05351850', '80.22097730'),
(389, 6, 'Baddegama', 'බද්දේගම', 'பத்தேகம', NULL, NULL, NULL, '80200', '6.16882920', '80.17939760'),
(390, 6, 'Balapitiya', 'බලපිටිය', 'பலபிட்டிய', NULL, NULL, NULL, '80550', '6.27835460', '80.04030470'),
(391, 6, 'Banagala', 'බනගල', 'பனகல', NULL, NULL, NULL, '80143', '6.28153610', '80.42590530'),
(392, 6, 'Batapola', 'බටපොල', 'படபொல', NULL, NULL, NULL, '80320', '6.22418210', '80.11383690'),
(393, 6, 'Bentota', 'බෙන්තොට', 'பெந்தோட்டை', NULL, NULL, NULL, '80500', '6.41891750', '80.00597900'),
(394, 6, 'Boossa', 'බූස්ස', 'பூஸ்ஸ', NULL, NULL, NULL, '80270', '6.08894940', '80.15606480'),
(395, 6, 'Dellawa', 'දෙල්ලව', 'டெல்லாவா', NULL, NULL, NULL, '81477', '6.32489590', '80.44934050'),
(396, 6, 'Dikkumbura', 'දික්කුඹුර', 'திக்கும்புர', NULL, NULL, NULL, '80654', '6.01834760', '80.37282450'),
(397, 6, 'Dodanduwa', 'දොඩන්දූව', 'தொடந்துவ', NULL, NULL, NULL, '80250', '6.10283470', '80.13029690'),
(398, 6, 'Ella Tanabaddegama', 'ඇල්ල තනබද්දේගම', 'எல்ல தனபத்தேகம', NULL, NULL, NULL, '80402', '6.05774900', '80.21755720'),
(399, 6, 'Elpitiya', 'ඇල්පිටිය', 'எல்பிட்டிய', NULL, NULL, NULL, '80400', '6.28799690', '80.15960410'),
(400, 6, 'Galle', 'ගාල්ල', 'காலி', NULL, NULL, NULL, '80000', '6.04819180', '80.21539980'),
(401, 6, 'Ginimellagaha', 'ගිනිමෙල්ලගහ', 'கினிமெல்லகஹா', NULL, NULL, NULL, '80220', '6.12970640', '80.16937100'),
(402, 6, 'Gintota', 'ගින්තොට', 'கிந்தொட', NULL, NULL, NULL, '80280', '6.06001210', '80.18002210'),
(403, 6, 'Godahena', 'ගොඩහේන', 'கொடஹேன', NULL, NULL, NULL, '80302', '6.23458620', '80.07456270'),
(404, 6, 'Gonamulla Junction', 'ගෝනමුල්ල හංදිය', 'கோணமுல்ல சந்தி', NULL, NULL, NULL, '80054', '6.08208300', '80.29091100'),
(405, 6, 'Gonapinuwala', 'ගොනාපිනූවල', 'கோனாபினுவல', NULL, NULL, NULL, '80230', '6.14345180', '80.13448420'),
(406, 6, 'Habaraduwa', 'හබරාදූව', 'ஹபரதுவ', NULL, NULL, NULL, '80630', '5.99835900', '80.30782020'),
(407, 6, 'Haburugala', 'හබුරුගල', 'ஹபுருகல', NULL, NULL, NULL, '80506', '6.40370130', '80.03393120'),
(408, 6, 'Hikkaduwa', 'හික්කඩුව', 'ஹிக்கடுவ', NULL, NULL, NULL, '80240', '6.13946760', '80.10628610'),
(409, 6, 'Hiniduma', 'හිනිදුම', 'ஹினிடும', NULL, NULL, NULL, '80080', '6.30944820', '80.32409600'),
(410, 6, 'Hiyare', 'හියාරෙ', 'ஹியாரே', NULL, NULL, NULL, '80056', '6.07201140', '80.34258010'),
(411, 6, 'Kahaduwa', 'කහදූව', 'கஹதுவா', NULL, NULL, NULL, '80460', '6.22345150', '80.21261090'),
(412, 6, 'Kahawa', 'කහව', 'கஹாவா', NULL, NULL, NULL, '80312', '6.18818520', '80.07723920'),
(413, 6, 'Karagoda', 'කරාගොඩ', 'கரகோடா', NULL, NULL, NULL, '80151', '6.03524350', '80.21049500'),
(414, 6, 'Karandeniya', 'කරන්දෙණිය', 'கரந்தெனிய', NULL, NULL, NULL, '80360', '6.26832170', '80.08980850'),
(415, 6, 'Kosgoda', 'කොස්ගොඩ', 'கொஸ்கொட', NULL, NULL, NULL, '80570', '6.33544240', '80.03393120'),
(416, 6, 'Kottawagama', 'කොට්ටාවගම', 'கொட்டவாகம', NULL, NULL, NULL, '80062', '6.10781390', '80.30358840'),
(417, 6, 'Kottegoda', 'කෝට්ටේගොඩ', 'கொட்டேகொட', NULL, NULL, NULL, '81180', '6.96152440', '80.93610230'),
(418, 6, 'Kuleegoda', 'කුලීගොඩ', 'குலீகொட', NULL, NULL, NULL, '80328', '6.21382060', '80.07033080'),
(419, 6, 'Magedara', 'මාගෙදර', 'மகேதரா', NULL, NULL, NULL, '80152', '6.09993990', '80.40343930'),
(420, 6, 'Mahawela Sinhapura', 'මහවෙල සිංහපුර', 'மஹாவெல சிங்கபுர', NULL, NULL, NULL, '51076', '6.68192410', '80.40587410'),
(421, 6, 'Mapalagama', 'මාපලගම', 'மபலகம', NULL, NULL, NULL, '80112', '6.22356070', '80.28927270'),
(422, 6, 'Mapalagama Central', 'මාපලගම මධ්‍යම', 'மாபலகம மத்திய', NULL, NULL, NULL, '80116', '6.22356070', '80.28927270'),
(423, 6, 'Mattaka', 'මට්ටක', 'மட்டக்கா', NULL, NULL, NULL, '80424', '6.30295010', '80.25722250'),
(424, 6, 'Meda-Keembiya', 'මැද කීඹිය', 'மெத கீம்பிய', NULL, NULL, NULL, '80092', '6.11400500', '80.24049590'),
(425, 6, 'Meetiyagoda', 'මීටියාගොඩ', 'மீடியாகொட', NULL, NULL, NULL, '80330', '6.18983430', '80.09539420'),
(426, 6, 'Nagoda', 'නාගොඩ', 'நாகொட', NULL, NULL, NULL, '80110', '6.19797800', '80.27465470'),
(427, 6, 'Nakiyadeniya', 'නාකියාදෙණිය', 'நாகியதெனிய', NULL, NULL, NULL, '80064', '6.14332850', '80.34219840'),
(428, 6, 'Nawandagala', 'නවඳගල', 'நவந்தகல', NULL, NULL, NULL, '80416', '6.31123550', '80.14006710'),
(429, 6, 'Neluwa', 'නෙළුව', 'நெலுவ', NULL, NULL, NULL, '80082', '6.37310280', '80.35751280'),
(430, 6, 'Nindana', 'නින්දාන', 'நிந்தனா', NULL, NULL, NULL, '80318', '6.20709000', '80.10796080'),
(431, 6, 'Pahala Millawa', 'පහළ මිල්ලෑව', 'பஹல மில்லவா', NULL, NULL, NULL, '81472', '6.29379580', '80.47158660'),
(432, 6, 'Panangala', 'පනංගල', 'பனங்கலா', NULL, NULL, NULL, '80075', '6.26290960', '80.32370430'),
(433, 6, 'Pannimulla Panagoda', 'පැණිමුල්ල පනාගොඩ', 'பன்னிமுல்ல பனாகொட', NULL, NULL, NULL, '80086', '6.35379140', '80.40869950'),
(434, 6, 'Parana Thanayamgoda', 'පරණ තානායම්ගොඩ', 'பரண தனயம்கொட', NULL, NULL, NULL, '80114', '6.23054990', '80.31295410'),
(435, 6, 'Patana', 'පතාන', 'பதான', NULL, NULL, NULL, '22012', '6.05351850', '80.22097730'),
(436, 6, 'Pitigala', 'පිටිගල', 'பிட்டிகல', NULL, NULL, NULL, '80420', '6.34195530', '80.23770780'),
(437, 6, 'Poddala', 'පෝද්දල', 'போத்தலா', NULL, NULL, NULL, '80170', '6.10846880', '80.22376600'),
(438, 6, 'Polgampola', 'පොල්ගම්පොල', 'பொல்கம்பொல', NULL, NULL, NULL, '12136', '6.46518930', '80.19612050'),
(439, 6, 'Porawagama', 'පොරවගම', 'பொறவகம', NULL, NULL, NULL, '80408', '6.28720780', '80.22494260'),
(440, 6, 'Rantotuwila', 'රන්තොටුවිල', 'ரந்தொடுவில', NULL, NULL, NULL, '80354', '6.05351850', '80.22097730'),
(441, 6, 'Talagampola', 'තලගම්පොල', 'தலகம்பொல', NULL, NULL, NULL, '80058', '6.08706280', '80.30354180'),
(442, 6, 'Talgaspe', 'තල්ගස්පෙ', 'டல்காஸ்பே', NULL, NULL, NULL, '80406', '6.05423480', '80.22446310'),
(443, 6, 'Talpe', 'තල්පෙ', 'தல்பே', NULL, NULL, NULL, '80615', '6.00099540', '80.27812620'),
(444, 6, 'Tawalama', 'තවලම', 'தவலம', NULL, NULL, NULL, '80148', '6.33472690', '80.34219840'),
(445, 6, 'Tiranagama', 'තිරණගම', 'திரணகம', NULL, NULL, NULL, '80244', '6.12857980', '80.11121550'),
(446, 6, 'Udalamatta', 'උඩලමත්ත', 'உடலமட்டா', NULL, NULL, NULL, '80108', '6.18359350', '80.29825070'),
(447, 6, 'Udugama', 'උඩුගම', 'உடுகம', NULL, NULL, NULL, '80070', '6.21790470', '80.33802130'),
(448, 6, 'Uluvitike', 'උලුවිටිකේ', 'உலுவிதிகே', NULL, NULL, NULL, '80168', '6.08339890', '80.21121640'),
(449, 6, 'Unawatuna', 'උණවටුන', 'உணவட்டுன', NULL, NULL, NULL, '80600', '6.01744690', '80.24885960'),
(450, 6, 'Unawitiya', 'උනවිටිය', 'உனவிட்டிய', NULL, NULL, NULL, '80214', '6.05351850', '80.22097730'),
(451, 6, 'Uragaha', 'ඌරගහ', 'உரகஹா', NULL, NULL, NULL, '80352', '6.34904400', '80.09786370'),
(452, 6, 'Uragasmanhandiya', 'ඌරගස්මන්හන්දිය', 'ஊரகஸ்மண்டிய', NULL, NULL, NULL, '80350', '6.34904400', '80.09786370'),
(453, 6, 'Wakwella', 'වක්වැල්ල', 'வக்வெள்ள', NULL, NULL, NULL, '80042', '6.09216840', '80.19029630'),
(454, 6, 'Walahanduwa', 'වලහන්දූව', 'வலஹந்துவா', NULL, NULL, NULL, '80046', '6.05155910', '80.25722250'),
(455, 6, 'Wanchawela', 'වංචාවල', 'வஞ்சாவெல', NULL, NULL, NULL, '80120', '6.03571080', '80.26859670'),
(456, 6, 'Wanduramba', 'වඳුරඹ', 'வந்துரம்ப', NULL, NULL, NULL, '80100', '6.13247130', '80.24885960'),
(457, 6, 'Warukandeniya', 'වාරුකන්දෙනිය', 'வாருகந்தெனிய', NULL, NULL, NULL, '80084', '6.36610380', '80.40483060'),
(458, 6, 'Watugedara', 'වටුගෙදර', 'வடுகெதர', NULL, NULL, NULL, '80340', '6.26121210', '80.06047740'),
(459, 6, 'Weihena', 'වැයිහේන', 'வெய்ஹேனா', NULL, NULL, NULL, '80216', '6.30777980', '80.23491960'),
(460, 6, 'Welikanda', 'වැලිකන්ද', 'வெலிகந்ந', NULL, NULL, NULL, '51070', '7.94596540', '81.24912980'),
(461, 6, 'Wilanagama', 'විලනගම', 'விலானகம', NULL, NULL, NULL, '20142', '6.00417960', '80.41381130'),
(462, 6, 'Yakkalamulla', 'යක්කලමුල්ල', 'யக்கலமுல்ல', NULL, NULL, NULL, '80150', '6.10134950', '80.35910020'),
(463, 6, 'Yatalamatta', 'යටලමත්ත', 'யாதலமட்டா', NULL, NULL, NULL, '80107', '6.17373330', '80.28648620'),
(464, 7, 'Akaragama', 'අකරගම', 'அகரகம', NULL, NULL, NULL, '11536', '7.27348030', '79.95704110'),
(465, 7, 'Ambagaspitiya', 'අඹගස්පිටිය', 'அம்பகஸ்பிட்டிய', NULL, NULL, NULL, '11052', '7.08445090', '80.06533660'),
(466, 7, 'Ambepussa', 'අඹේපුස්ස', 'அம்பேபுசா', NULL, NULL, NULL, '11212', '7.25610360', '80.16932850'),
(467, 7, 'Andiambalama', 'ආඬිඅම්බලම', 'ஆண்டிஅம்பலமா', NULL, NULL, NULL, '11558', '7.17881270', '79.90685340'),
(468, 7, 'Attanagalla', 'අත්තනගල්ල', 'அத்தனகல்ல', NULL, NULL, NULL, '11120', '7.11374270', '80.13550050'),
(469, 7, 'Badalgama', 'බඩල්ගම', 'படல்கம', NULL, NULL, NULL, '11538', '7.28865230', '79.98081430'),
(470, 7, 'Banduragoda', 'බඳුරගොඩ', 'பாண்டுராகொட', NULL, NULL, NULL, '11244', '7.22779350', '80.05768340'),
(471, 7, 'Batuwatta', 'බටුවත්ත', 'படுவத்த', NULL, NULL, NULL, '11011', '7.06225400', '79.94123680'),
(472, 7, 'Bemmulla', 'බෙම්මුල්ල', 'பெம்முல்லா', NULL, NULL, NULL, '11040', '7.11313180', '80.02718930'),
(473, 7, 'Biyagama IPZ', 'බියගම IPZ', 'பியகம IPZ', NULL, NULL, NULL, '11672', '6.96228400', '80.00903670'),
(474, 7, 'Bokalagama', 'බොකලගම', 'பொகலகம', NULL, NULL, NULL, '11216', '7.21532070', '80.10292600'),
(475, 7, 'Bollete (WP)', 'බොල්ලතේ', 'பொல்லட் (WP)', NULL, NULL, NULL, '11024', '7.08404840', '80.00983140'),
(476, 7, 'Bopagama', 'බෝපගම', 'போபகம', NULL, NULL, NULL, '11134', '7.07130690', '80.16369600'),
(477, 7, 'Buthpitiya', 'බුත්පිටිය', 'புத்பிட்டிய', NULL, NULL, NULL, '11720', '7.05470030', '80.05322640'),
(478, 7, 'Dagonna', 'දාගොන්න', 'டகோன்ன', NULL, NULL, NULL, '11524', '7.21005490', '79.91647170'),
(479, 7, 'Danowita', 'දංඕවිට', 'தனோவிட்ட', NULL, NULL, NULL, '11896', '7.22087770', '80.16797580');
INSERT INTO `cities` (`id`, `district_id`, `name_en`, `name_si`, `name_ta`, `sub_name_en`, `sub_name_si`, `sub_name_ta`, `postcode`, `latitude`, `longitude`) VALUES
(480, 7, 'Debahera', 'දෙබහැර', 'டெபஹேரா', NULL, NULL, NULL, '11889', '7.15797470', '80.14983620'),
(481, 7, 'Dekatana', 'දෙකටන', 'தெகடன', NULL, NULL, NULL, '11690', '6.97023240', '80.04241920'),
(482, 7, 'Delgoda', 'දෙල්ගොඩ', 'தெல்கொட', NULL, NULL, NULL, '11700', '6.98928850', '80.01437660'),
(483, 7, 'Delwagura', 'දෙල්වගුර', 'தெல்வகுரா', NULL, NULL, NULL, '11228', '7.26524820', '80.00597900'),
(484, 7, 'Demalagama', 'දෙමළගම', 'தெமலகம', NULL, NULL, NULL, '11692', '6.99127630', '80.05209520'),
(485, 7, 'Demanhandiya', 'දෙමන්හන්දිය', 'தேமன்ஹந்தியா', NULL, NULL, NULL, '11270', '7.22438790', '79.88451350'),
(486, 7, 'Dewalapola', 'දේවාලපොල', 'தெவலபொல', NULL, NULL, NULL, '11102', '7.16120370', '79.99199950'),
(487, 7, 'Divulapitiya', 'දිවුලපිටිය', 'திவுலபிட்டிய', NULL, NULL, NULL, '11250', '7.23031430', '80.01647400'),
(488, 7, 'Divuldeniya', 'දිවුල්දෙණිය', 'திவுல்தெனிய', NULL, NULL, NULL, '11208', '7.28072540', '80.04371230'),
(489, 7, 'Dompe', 'දොම්පෙ', 'தொம்பே', NULL, NULL, NULL, '11680', '6.94039470', '80.07719620'),
(490, 7, 'Dunagaha', 'දුනගහ', 'துணகஹா', NULL, NULL, NULL, '11264', '7.22205330', '79.97801780'),
(491, 7, 'Ekala', 'ඒකල', 'எக்கலை', NULL, NULL, NULL, '11380', '7.10229130', '79.90947510'),
(492, 7, 'Ellakkala', 'ඇල්ලක්කල', 'எல்லக்கல', NULL, NULL, NULL, '11116', '7.14166500', '80.13308850'),
(493, 7, 'Essella', 'එස්සැල්ල', 'எஸ்செல்லா', NULL, NULL, NULL, '11108', '7.17651350', '80.02546960'),
(494, 7, 'Galedanda', 'ගලේදණ්ඩ', 'கலேடாண்டா', NULL, NULL, NULL, '90206', '6.96486420', '79.93186230'),
(495, 7, 'Gampaha', 'ගම්පහ', 'கம்பஹா', NULL, NULL, NULL, '11000', '7.08404840', '80.00983140'),
(496, 7, 'Ganemulla', 'ගණේමුල්ල', 'கணேமுல்லை', NULL, NULL, NULL, '11020', '7.08271900', '79.94825480'),
(497, 7, 'Giriulla', 'ගිරිවුල්ල', 'கிரியுள்ளை', NULL, NULL, NULL, '60140', '7.34867490', '80.13801950'),
(498, 7, 'Gonawala', 'ගෝනවල', 'கோனவளை', NULL, NULL, NULL, '11630', '6.95417030', '79.93661870'),
(499, 7, 'Halpe', 'හල්පෙ', 'ஹல்பே', NULL, NULL, NULL, '70145', '7.26221070', '79.92906420'),
(500, 7, 'Hapugastenna', 'හපුගස්තැන්න', 'ஹப்புகஸ்தென்ன', NULL, NULL, NULL, '70164', '6.74054400', '80.18881730'),
(501, 7, 'Heiyanthuduwa', 'හෙයියන්තුඩුව', 'ஹெய்யந்துடுவ', NULL, NULL, NULL, '11618', '6.97187680', '79.97376420'),
(502, 7, 'Hinatiyana Madawala', 'හීනටියන මඩවල', 'ஹினாட்டியான மடவல', NULL, NULL, NULL, '11568', '7.15015720', '79.91227380'),
(503, 7, 'Hiswella', 'හිස්වැල්ල', 'ஹிஸ்வெல்லா', NULL, NULL, NULL, '11734', '7.02015740', '80.16379010'),
(504, 7, 'Horampella', 'හොරම්පැල්ල', 'ஹோரம்பெல்ல', NULL, NULL, NULL, '11564', '7.17023150', '79.97941610'),
(505, 7, 'Hunumulla', 'හුණුමුල්ල', 'ஹுனுமுல்லா', NULL, NULL, NULL, '11262', '7.23365100', '79.98930900'),
(506, 7, 'Hunupola', 'හුණුපොල', 'ஹுனுபொல', NULL, NULL, NULL, '60582', '7.61421880', '80.38952480'),
(507, 7, 'Ihala Madampella', 'ඉහල මදම්පෙල්ල', 'இஹல மடம்பெல்லா', NULL, NULL, NULL, '11265', '7.24895350', '79.95371930'),
(508, 7, 'Imbulgoda', 'ඉඹුල්ගොඩ', 'இம்புல்கொட', NULL, NULL, NULL, '11856', '7.08704600', '80.01751040'),
(509, 7, 'Ja-Ela', 'ජා-ඇල', 'ஜா-எல', NULL, NULL, NULL, '11350', '7.08575960', '79.92544450'),
(510, 7, 'Kadawatha', 'කඩවත', 'கடவதை', NULL, NULL, NULL, '11850', '7.00467190', '79.95420020'),
(511, 7, 'Kahatowita', 'කහටෝවිට', 'கஹடோவிட்ட', NULL, NULL, NULL, '11144', '7.09745510', '80.11223900'),
(512, 7, 'Kalagedihena', 'කලගෙඩිහේන', 'கலகெடிஹேன', NULL, NULL, NULL, '11875', '7.12014350', '80.05908040'),
(513, 7, 'Kaleliya', 'කල්එළිය', 'கலேலியா', NULL, NULL, NULL, '11160', '7.19702310', '80.11075310'),
(514, 7, 'Kandana', 'කඳාන', 'கந்தான', NULL, NULL, NULL, '11320', '7.04778970', '79.89703480'),
(515, 7, 'Katana', 'කටාන', 'கட்டான', NULL, NULL, NULL, '11534', '7.24802840', '79.89936650'),
(516, 7, 'Katudeniya', 'කටුදෙණිය', 'கட்டுதெனிய', NULL, NULL, NULL, '21016', '7.43831900', '80.64154520'),
(517, 7, 'Katunayake', 'කටුනායක', 'கட்டுநாயக்க', NULL, NULL, NULL, '11450', '7.17248490', '79.88534840'),
(518, 7, 'Katunayake Air Force Camp', 'කටුනායක ගුවන් හමුදා කඳවුර', 'கட்டுநாயக்க விமானப் படை முகாம்', NULL, NULL, NULL, '11440', '7.18282930', '79.86773900'),
(519, 7, 'Katunayake(FTZ)', 'කටුනායක නිදහස් වෙළඳ කලාපය', 'கட்டுநாயக்க FTZ', NULL, NULL, NULL, '11420', '7.17366030', '79.88688610'),
(520, 7, 'Katuwellegama', 'කටුවෙල්ලගම', 'கட்டுவெல்லேகம', NULL, NULL, NULL, '11526', '7.19971330', '79.94976680'),
(521, 7, 'Kelaniya', 'කැළණිය', 'களனி', NULL, NULL, NULL, '11600', '6.97821370', '79.91155220'),
(522, 7, 'Kimbulapitiya', 'කිඹුලාපිටිය', 'கிம்புலாபிட்டிய', NULL, NULL, NULL, '11522', '7.20424070', '79.89408060'),
(523, 7, 'Kirindiwela', 'කිරිඳිවෙල', 'கிரிந்திவெல', NULL, NULL, NULL, '11730', '7.04118250', '80.12893240'),
(524, 7, 'Kitalawalana', 'කිතලවලාන', 'கிடலவலன', NULL, NULL, NULL, '11206', '7.29093330', '80.11424340'),
(525, 7, 'Kochchikade', 'කොච්චිකඩේ', 'கொச்சிக்கடை', NULL, NULL, NULL, '11540', '7.26570630', '79.85912350'),
(526, 7, 'Kotadeniyawa', 'කොටදෙණියාව', 'கொட்டதெனியாவ', NULL, NULL, NULL, '11232', '7.28388130', '80.06606500'),
(527, 7, 'Kotugoda', 'කොටුගොඩ', 'கொட்டுகொட', NULL, NULL, NULL, '11390', '7.12319100', '79.92416730'),
(528, 7, 'Kumbaloluwa', 'කුඹල්ඔළුව', 'கும்பலோலுவ', NULL, NULL, NULL, '11105', '7.17710570', '80.11214930'),
(529, 7, 'Loluwagoda', 'ලොළුවගොඩ', 'லொலுவாகொட', NULL, NULL, NULL, '11204', '7.29210060', '80.13503500'),
(530, 7, 'Mabodale', 'මබෝදලේ', 'மபோடலே', NULL, NULL, NULL, '11114', '7.20243690', '80.01872130'),
(531, 7, 'Madelgamuwa', 'මැදැල්ගමුව', 'மடல்கமுவ', NULL, NULL, NULL, '11033', '7.10846130', '79.95986960'),
(532, 7, 'Makewita', 'මාකවිට', 'மகேவிதா', NULL, NULL, NULL, '11358', '7.10095000', '79.96332620'),
(533, 7, 'Makola', 'මාකොල', 'மாகொல', NULL, NULL, NULL, '11640', '6.97189890', '79.94663980'),
(534, 7, 'Malwana', 'මල්වාන', 'மல்வான', NULL, NULL, NULL, '11670', '6.95078440', '80.01574490'),
(535, 7, 'Mandawala', 'මන්දාවල', 'மண்டவாலா', NULL, NULL, NULL, '11061', '7.00011780', '80.09399780'),
(536, 7, 'Marandagahamula', 'මරඳගහමුල', 'மரந்தகஹமுல', NULL, NULL, NULL, '11260', '7.22898140', '79.99060150'),
(537, 7, 'Mellawagedara', 'මෙල්ලවගෙදර', 'மெல்லவகெதர', NULL, NULL, NULL, '11234', '7.28568090', '80.02694400'),
(538, 7, 'Minuwangoda', 'මිනුවන්ගොඩ', 'மினுவன்கொட', NULL, NULL, NULL, '11550', '7.18420760', '79.95004770'),
(539, 7, 'Mirigama', 'මීරිගම', 'மீரிகம', NULL, NULL, NULL, '11200', '7.22711090', '80.15676640'),
(540, 7, 'Miriswatta', 'මිරිස්වත්ත', 'மிரிஸ்வத்த', NULL, NULL, NULL, '80508', '7.07273940', '80.01576330'),
(541, 7, 'Mithirigala', 'මිතිරිගල', 'மிதிரிகல', NULL, NULL, NULL, '11742', '6.99622360', '80.16099950'),
(542, 7, 'Muddaragama', 'මුද්දරගම', 'முத்தாரகம', NULL, NULL, NULL, '11112', '7.20859950', '80.05500330'),
(543, 7, 'Mudungoda', 'මුදුන්ගොඩ', 'முடுங்கோடா', NULL, NULL, NULL, '11056', '7.06669220', '80.01226900'),
(544, 7, 'Mulleriyawa New Town', 'මුල්ලේරියාව නව නගරය', 'முல்லேரியா புதிய நகரம்', NULL, NULL, NULL, '10620', '7.08404840', '80.00983140'),
(545, 7, 'Naranwala', 'නාරංවල', 'நாரங்வல', NULL, NULL, NULL, '11063', '7.01189570', '80.02414890'),
(546, 7, 'Nawana', 'නාවන', 'நவானா', NULL, NULL, NULL, '11222', '7.08404840', '80.00983140'),
(547, 7, 'Nedungamuwa', 'නැදුන්ගමුව', 'நெதுன்கமுவ', NULL, NULL, NULL, '11066', '7.04897410', '80.02135380'),
(548, 7, 'Negombo', 'මීගමුව', 'நீர்கொழும்பு', NULL, NULL, NULL, '11500', '7.19554740', '79.85733840'),
(549, 7, 'Nikadalupotha', 'නිකදළුපොත', 'நிகடலுபோத', NULL, NULL, NULL, '60580', '7.65409650', '80.37560810'),
(550, 7, 'Nikahetikanda', 'නිකහැටිකන්ද', 'நிகஹெதிகந்த', NULL, NULL, NULL, '11128', '7.09880240', '80.17913680'),
(551, 7, 'Nittambuwa', 'නිට්ටඹුව', 'நிட்டம்புவ', NULL, NULL, NULL, '11880', '7.14236390', '80.10377210'),
(552, 7, 'Niwandama', 'නිවන්දම', 'நிவந்தமா', NULL, NULL, NULL, '11354', '7.07345330', '79.92777630'),
(553, 7, 'Opatha', 'ඕපාත', 'ஓப்பாத்த', NULL, NULL, NULL, '80142', '7.13205760', '79.92634270'),
(554, 7, 'Pamunugama', 'පමුණුගම', 'பமுனுகம', NULL, NULL, NULL, '11370', '7.08649860', '79.85488230'),
(555, 7, 'Pamunuwatta', 'පමුණුවත්ත', 'பமுனுவத்த', NULL, NULL, NULL, '11214', '7.21631230', '80.14146270'),
(556, 7, 'Panawala', 'පනාවල', 'பனாவல', NULL, NULL, NULL, '70612', '7.16740680', '80.09399780'),
(557, 7, 'Pasyala', 'පස්යාල', 'பஸ்யால', NULL, NULL, NULL, '11890', '7.16671030', '80.12331750'),
(558, 7, 'Peliyagoda', 'පෑලියගොඩ', 'பேலியகொட', NULL, NULL, NULL, '11830', '6.95849150', '79.90558190'),
(559, 7, 'Pepiliyawala', 'පැපිලියාවල', 'பெபிலியவல', NULL, NULL, NULL, '11741', '7.00218000', '80.12890100'),
(560, 7, 'Pethiyagoda', 'පෙතියාගොඩ', 'பெத்தியகொட', NULL, NULL, NULL, '11043', '7.13806170', '79.99510440'),
(561, 7, 'Polpithimukulana', 'පොල්පිතිමූකලාන', 'பொல்பிதிமுகுலான', NULL, NULL, NULL, '11324', '7.08404840', '80.00983140'),
(562, 7, 'Puwakpitiya', 'පුවක්පිටිය', 'புவக்பிட்டிய', NULL, NULL, NULL, '10712', '7.03801870', '80.06746190'),
(563, 7, 'Radawadunna', 'රදාවඩුන්න', 'ராதவடுன்னா', NULL, NULL, NULL, '11892', '7.18438730', '80.14146270'),
(564, 7, 'Radawana', 'රදාවාන', 'ராதாவானா', NULL, NULL, NULL, '11725', '7.03194950', '80.09399780'),
(565, 7, 'Raddolugama', 'රද්දොළුගම', 'இரத்தொளுகம', NULL, NULL, NULL, '11400', '7.14063340', '79.90136030'),
(566, 7, 'Ragama', 'රාගම', 'ராகம', NULL, NULL, NULL, '11010', '7.02317680', '79.90777230'),
(567, 7, 'Ruggahawila', 'රුග්ගහවිල', 'ருக்கஹாவில', NULL, NULL, NULL, '11142', '7.11003790', '80.11424340'),
(568, 7, 'Seeduwa', 'සීදුව', 'சீதுவை', NULL, NULL, NULL, '11410', '7.14067840', '79.88697320'),
(569, 7, 'Siyambalape', 'සියඹලාපේ', 'சியம்பலாபே', NULL, NULL, NULL, '11607', '6.96741120', '79.98920340'),
(570, 7, 'Talahena', 'තලාහේන', 'தலஹேன', NULL, NULL, NULL, '11504', '7.08404840', '80.00983140'),
(571, 7, 'Thambagalla', 'තඹගල්ල', 'தம்பகல்ல', NULL, NULL, NULL, '60584', '7.08404840', '80.00983140'),
(572, 7, 'Thimbirigaskatuwa', 'තිඹිරිගස්කටුව', 'திம்பிரிகஸ்கடுவ', NULL, NULL, NULL, '11532', '7.13542420', '79.88851020'),
(573, 7, 'Tittapattara', 'තිත්තපත්තර', 'திட்டபட்டரா', NULL, NULL, NULL, '10664', '6.91356150', '80.05972130'),
(574, 7, 'Udathuthiripitiya', 'උඩතුත්තිරිපිටිය', 'உடதுதிரிபிட்டிய', NULL, NULL, NULL, '11054', '7.08404840', '80.00983140'),
(575, 7, 'Udugampola', 'උඩුගම්පල', 'உடுகம்பளை', NULL, NULL, NULL, '11030', '7.12635740', '79.97801780'),
(576, 7, 'Uggalboda', 'උග්ගල්බොඩ', 'உக்கல்போடா', NULL, NULL, NULL, '11034', '7.13248020', '79.95424380'),
(577, 7, 'Urapola', 'ඌරාපොල', 'ஊரபோல', NULL, NULL, NULL, '11126', '7.09804240', '80.14499060'),
(578, 7, 'Uswetakeiyawa', 'උස්වැටකෙයියාව', 'உஸ்வெட்டிகேயவா', NULL, NULL, NULL, '11328', '7.03899110', '79.86608360'),
(579, 7, 'Veyangoda', 'වෙයන්ගොඩ', 'வேயங்கொடை', NULL, NULL, NULL, '11100', '7.16621390', '80.05586950'),
(580, 7, 'Walgammulla', 'වල්ගම්මුල්ල', 'வலகம்முல்ல', NULL, NULL, NULL, '11146', '7.07093920', '80.11773350'),
(581, 7, 'Walpita', 'වල්පිට', 'வல்பிட', NULL, NULL, NULL, '11226', '7.26126670', '80.04591300'),
(582, 7, 'Walpola (WP)', 'වල්පොල', 'வல்பொல (WP)', NULL, NULL, NULL, '11012', '7.19434870', '79.92766510'),
(583, 7, 'Wathurugama', 'වතුරුගම', 'வத்துருகம', NULL, NULL, NULL, '11724', '7.05465480', '80.10097960'),
(584, 7, 'Watinapaha', 'වටිනාපහ', 'வட்டினபஹா', NULL, NULL, NULL, '11104', '7.18531180', '80.00038750'),
(585, 7, 'Wattala', 'වත්තල', 'வத்தளை', NULL, NULL, NULL, '11104', '6.99066770', '79.89317090'),
(586, 7, 'Weboda', 'වෙිබොඩ', 'வெபோடா', NULL, NULL, NULL, '11858', '7.02511750', '79.99130050'),
(587, 7, 'Wegowwa', 'වෑගොව්ව', 'வேகவ்வா', NULL, NULL, NULL, '11562', '7.17160320', '79.97462990'),
(588, 7, 'Weweldeniya', 'වේවැල්දෙණිය', 'வெவெல்தெனிய', NULL, NULL, NULL, '11894', '7.19792850', '80.15262710'),
(589, 7, 'Yakkala', 'යක්කල', 'யக்கல', NULL, NULL, NULL, '11870', '7.08641530', '80.03351070'),
(590, 7, 'Yatiyana', 'යටියන', 'யதியான', NULL, NULL, NULL, '11566', '7.18677080', '79.92605480'),
(591, 8, 'Ambalantota', 'අම්බලන්තොට', 'அம்பலாந்தோட்டை', NULL, NULL, NULL, '82100', '6.12259990', '81.02375940'),
(592, 8, 'Angunakolapelessa', 'අඟුණකොළපැලැස්ස', 'அங்குனுகொலபெலஸ்ஸ', NULL, NULL, NULL, '82220', '6.16556890', '80.90311720'),
(593, 8, 'Angunakolawewa', 'අඟුණකොලවැව', 'அங்குனகொலவெவ', NULL, NULL, NULL, '91302', '6.41154880', '81.08592350'),
(594, 8, 'Bandagiriya Colony', 'බන්ඩගිරිය කොලොනි', 'பண்டகிரிய காலனி', NULL, NULL, NULL, '82005', '6.24086040', '81.14484790'),
(595, 8, 'Barawakumbuka', 'බරවකුඹුර', 'பரவகும்புகா', NULL, NULL, NULL, '82110', '6.22578540', '80.92906850'),
(596, 8, 'Beliatta', 'බෙලිඅත්ත', 'பெலியத்த', NULL, NULL, NULL, '82400', '6.04815730', '80.73391440'),
(597, 8, 'Beragama', 'බෙරගම', 'பெரகம', NULL, NULL, NULL, '82102', '6.14212550', '81.03181690'),
(598, 8, 'Beralihela', 'බෙරලිහෙල', 'பெரலிஹெல', NULL, NULL, NULL, '82618', '6.32158700', '81.29816730'),
(599, 8, 'Bundala', 'බූන්දල', 'பண்டாலா', NULL, NULL, NULL, '82002', '6.19424870', '81.18731410'),
(600, 8, 'Ellagala', 'ඇල්ලගල', 'எல்லகல', NULL, NULL, NULL, '82619', '6.33333300', '81.25000000'),
(601, 8, 'Gangulandeniya', 'ගඟුලදෙණිය', 'கங்குலந்தெனிய', NULL, NULL, NULL, '82586', '6.29562990', '80.71866970'),
(602, 8, 'Getamanna', 'ගැටමාන්න', 'கெட்டமன்னா', NULL, NULL, NULL, '82420', '6.03954990', '80.68955830'),
(603, 8, 'Goda Koggalla', 'ගොඩ කොග්ගල්ල', 'கொட கொக்கல்ல', NULL, NULL, NULL, '82401', '6.18333300', '81.01666700'),
(604, 8, 'Gonagamuwa Uduwila', 'ගොනාගමුව උඩුවිල', 'கோனகமுவ உடுவில', NULL, NULL, NULL, '82602', '6.24723940', '81.26564900'),
(605, 8, 'Gonnoruwa', 'ගොන්නොරුව', 'கொன்னொருவா', NULL, NULL, NULL, '82006', '6.23333300', '81.10000000'),
(606, 8, 'Hakuruwela', 'හකුරුවෙල', 'ஹகுருவெல', NULL, NULL, NULL, '82248', '6.14933330', '80.83085870'),
(607, 8, 'Hambantota', 'හම්බන්තොට', 'ஹம்பாந்தோட்டை', NULL, NULL, NULL, '82000', '6.14288290', '81.12123080'),
(608, 8, 'Handugala', 'හඳගුල', 'ஹண்டுகல', NULL, NULL, NULL, '81326', '6.19032110', '80.62575390'),
(609, 8, 'Hungama', 'හුංගම', 'ஹங்காமா', NULL, NULL, NULL, '82120', '6.11562600', '80.92906850'),
(610, 8, 'Ihala Beligalla', 'ඉහල බෙලිගල්ල', 'இஹல பெலிகல்ல', NULL, NULL, NULL, '82412', '6.15358160', '81.12714900'),
(611, 8, 'Iththa Demaliya', 'ඉත්ත දෙමලිය', 'இத்தா தெமாலியா', NULL, NULL, NULL, '82462', '6.16784630', '80.74593370'),
(612, 8, 'Julampitiya', 'ජුලම්පිටිය', 'ஜுலம்பிட்டிய', NULL, NULL, NULL, '82252', '6.23552320', '80.73543110'),
(613, 8, 'Kahandamodara', 'කහඳමෝදර', 'கஹந்தமோதர', NULL, NULL, NULL, '82126', '6.06988240', '80.89151100'),
(614, 8, 'Kariyamaditta', 'කරියමදිත්ත', 'காரியமடித்தா', NULL, NULL, NULL, '82274', '6.25527330', '80.81286360'),
(615, 8, 'Katuwana', 'කටුවන', 'கடுவன', NULL, NULL, NULL, '82500', '6.26362380', '80.69094480'),
(616, 8, 'Kawantissapura', 'කාවන්තිස්සපුර', 'கவுந்திஸ்ஸபுர', NULL, NULL, NULL, '82622', '6.35187120', '81.31297950'),
(617, 8, 'Kirama', 'කිරම', 'கிரம', NULL, NULL, NULL, '82550', '6.20669210', '80.66182340'),
(618, 8, 'Kirinda', 'කිරින්ද', 'கிரிந்த', NULL, NULL, NULL, '82614', '6.23523600', '81.33444080'),
(619, 8, 'Lunama', 'ලුනම', 'லுனாமா', NULL, NULL, NULL, '82108', '6.09531670', '80.96776580'),
(620, 8, 'Lunugamwehera', 'ලුණුගම්වෙහෙර', 'லுணுகம் வெஹர', NULL, NULL, NULL, '82634', '6.33835150', '81.14420930'),
(621, 8, 'Magama', 'මාගම', 'மகம', NULL, NULL, NULL, '82608', '6.20583660', '81.30418000'),
(622, 8, 'Mahagalwewa', 'මහගල්වැව', 'மகாகல்வெவ', NULL, NULL, NULL, '82016', '6.38543820', '81.03958210'),
(623, 8, 'Mamadala', 'මාමඩල', 'மாமடல', NULL, NULL, NULL, '82109', '6.15965390', '80.97467400'),
(624, 8, 'Medamulana', 'මැදමුලන', 'மெதமுலன', NULL, NULL, NULL, '82254', '6.18102790', '80.76855080'),
(625, 8, 'Middeniya', 'මිද්දෙණිය', 'மித்தெனிய', NULL, NULL, NULL, '82270', '6.25135790', '80.76416530'),
(626, 8, 'Meegahajandura', 'මිගහජන්දුරැ', 'மீகஹஜந்துர', NULL, NULL, NULL, '82014', '6.15928530', '81.12730130'),
(627, 8, 'Modarawana', 'මොදරවාන', 'மோதரவன', NULL, NULL, NULL, '82416', '6.11736090', '80.72421360'),
(628, 8, 'Mulkirigala', 'මුල්කිරිගල', 'முல்கிரிகல', NULL, NULL, NULL, '82242', '6.10879180', '80.75885410'),
(629, 8, 'Nakulugamuwa', 'නාකුළුගමුව', 'நகுலுகமுவ', NULL, NULL, NULL, '82300', '5.99543090', '80.70896710'),
(630, 8, 'Netolpitiya', 'නෙටොල්පිටිය', 'நெடோல்பிட்டிய', NULL, NULL, NULL, '82135', '6.06565060', '80.83916280'),
(631, 8, 'Nihiluwa', 'නිහිලුව', 'நிஹிலுவா', NULL, NULL, NULL, '82414', '6.07135770', '80.70629330'),
(632, 8, 'Padawkema', 'පදව්කෙම', 'படவ்கேமா', NULL, NULL, NULL, '82636', '6.14288290', '81.12123080'),
(633, 8, 'Pahala Andarawewa', 'පහල අන්දරවැව', 'பஹல அந்தரவெவ', NULL, NULL, NULL, '82008', '6.29958800', '81.08563270'),
(634, 8, 'Rammalawarapitiya', 'රම්මලවරපිටිය', 'ரம்மலவரபிட்டிய', NULL, NULL, NULL, '82554', '6.22198710', '80.63685390'),
(635, 8, 'Ranakeliya', 'රණකෙලිය', 'ரணகெலிய', NULL, NULL, NULL, '82612', '6.14288290', '81.12123080'),
(636, 8, 'Ranmuduwewa', 'රන්මුඩුවැව', 'ரன்முதுவெவ', NULL, NULL, NULL, '82018', '6.34629420', '81.05890600'),
(637, 8, 'Ranna', 'රන්න', 'ரன்னா', NULL, NULL, NULL, '82125', '6.09354290', '80.86268640'),
(638, 8, 'Ratmalwala', 'රත්මල්වල', 'ரத்மல்வல', NULL, NULL, NULL, '82276', '6.14288290', '81.12123080'),
(639, 8, 'Ruhunu Ridiyagama', 'රුහුණු රිදියගම', 'ருஹுனு ரிதியகம', NULL, NULL, NULL, '82106', '6.24684360', '80.98246490'),
(640, 8, 'Sooriyawewa Town', 'සූරියවැව නගරය', 'சூரியவெவ நகரம்', NULL, NULL, NULL, '82010', '6.31100250', '80.99539520'),
(641, 8, 'Tangalla', 'තංගල්ල', 'தங்காலை', NULL, NULL, NULL, '82200', '6.02433830', '80.79407260'),
(642, 8, 'Tissamaharama', 'තිස්සමහාරාම', 'திஸ்ஸமஹராமை', NULL, NULL, NULL, '82600', '6.27915380', '81.28766910'),
(643, 8, 'Uda Gomadiya', 'උඩ ගෝමදිය', 'உட கோமதியா', NULL, NULL, NULL, '82504', '6.29561590', '80.66933750'),
(644, 8, 'Udamattala', 'උඩමත්තල', 'உடமத்தல', NULL, NULL, NULL, '82638', '6.29139060', '81.12135710'),
(645, 8, 'Uswewa', 'උස්වැව', 'உஸ்வேவா', NULL, NULL, NULL, '82278', '6.24206220', '80.88343670'),
(646, 8, 'Vitharandeniya', 'විතාරන්දෙණිය', 'விதாரந்தெனிய', NULL, NULL, NULL, '82232', '6.02433830', '80.79407260'),
(647, 8, 'Walasmulla', 'වළස්මුල්ල', 'வலஸ்முல்ல', NULL, NULL, NULL, '82450', '6.15088880', '80.69371770'),
(648, 8, 'Weeraketiya', 'වීරකැටිය', 'வீரகெட்டிய', NULL, NULL, NULL, '82240', '6.14760810', '80.76337430'),
(649, 8, 'Weerawila', 'වීරවිල', 'வீரவில', NULL, NULL, NULL, '82632', '6.24214940', '81.22920900'),
(650, 8, 'Weerawila NewTown', 'වීරවිල නව නගරය', 'வீரவில நியூடவுன்', NULL, NULL, NULL, '82615', '6.24214940', '81.22920900'),
(651, 8, 'Wekandawela', 'වෑකඳවෙල', 'வெகந்தவெல', NULL, NULL, NULL, '82246', '6.14288290', '81.12123080'),
(652, 8, 'Weligatta', 'වැලිගත්ත', 'வெலிகட்டா', NULL, NULL, NULL, '82004', '6.23857610', '81.21883550'),
(653, 8, 'Yatigala', 'යටිගල', 'யடிகல', NULL, NULL, NULL, '82418', '6.11341960', '80.69473650'),
(654, 9, 'Jaffna', 'යාපනය', 'யாழ்ப்பாணம்', NULL, NULL, NULL, '40000', '9.66901300', '80.02695280'),
(655, 10, 'Agalawatta', 'අගලවත්ත', 'அகலவத்தை', NULL, NULL, NULL, '12200', '6.54227940', '80.15750400'),
(656, 10, 'Alubomulla', 'අලුබෝමුල්ල', 'அலுபோமுல்லா', NULL, NULL, NULL, '12524', '6.71130910', '79.94585140'),
(657, 10, 'Anguruwatota', 'අංගුරුවතොට', 'அங்குறுவதோட்ட', NULL, NULL, NULL, '12320', '6.64469710', '80.07459540'),
(658, 10, 'Atale', 'අටලේ', 'ஒரு கதை', NULL, NULL, NULL, '71363', '6.45000000', '80.26666700'),
(659, 10, 'Baduraliya', 'බදුරලීය', 'பதுரலியா', NULL, NULL, NULL, '12230', '6.51712210', '80.23118010'),
(660, 10, 'Bandaragama', 'බණ්ඩාරගම', 'பண்டாரகம', NULL, NULL, NULL, '12530', '6.71440730', '79.98906040'),
(661, 10, 'Batugampola', 'බටුගම්පොල', 'படுகம்பொல', NULL, NULL, NULL, '10526', '6.77398170', '80.13967210'),
(662, 10, 'Bellana', 'බෙල්ලන', 'பெல்லானா', NULL, NULL, NULL, '12224', '6.52213600', '80.17355650'),
(663, 10, 'Beruwala', 'බේරුවල', 'பேருவளை', NULL, NULL, NULL, '12070', '6.46320380', '79.97471240'),
(664, 10, 'Bolossagama', 'බොලොස්සගම', 'பொலொஸ்ஸகம', NULL, NULL, NULL, '12008', '6.62305890', '80.01576330'),
(665, 10, 'Bombuwala', 'බොඹුවල', 'போம்புவல', NULL, NULL, NULL, '12024', '6.57540720', '80.01428050'),
(666, 10, 'Boralugoda', 'බොරළුගොඩ', 'பொரலுகொட', NULL, NULL, NULL, '12142', '6.43471850', '80.27951950'),
(667, 10, 'Bulathsinhala', 'බුලත්සිංහල', 'புலத்சிங்கள', NULL, NULL, NULL, '12300', '6.64874710', '80.17913680'),
(668, 10, 'Danawala Thiniyawala', 'දනවල තිනියවල', 'தனவல தினியாவல', NULL, NULL, NULL, '12148', '6.41510400', '80.32862730'),
(669, 10, 'Delmella', 'දෙල්මෙල්ල', 'டெல்மெல்லா', NULL, NULL, NULL, '12304', '6.67962190', '80.20563820'),
(670, 10, 'Dharga Town', 'දර්ගා නගරය', 'தர்கா நகரம்', NULL, NULL, NULL, '12090', '6.44474520', '80.01686020'),
(671, 10, 'Diwalakada', 'දිවාලකද', 'திவலகட', NULL, NULL, NULL, '12308', '6.57111530', '80.06087530'),
(672, 10, 'Dodangoda', 'දොඩන්ගොඩ', 'தொடங்கொட', NULL, NULL, NULL, '12020', '6.55286750', '80.02329230'),
(673, 10, 'Dombagoda', 'දොඹගොඩ', 'தொம்பகொட', NULL, NULL, NULL, '12416', '6.64617370', '80.05069810'),
(674, 10, 'Ethkandura', 'ඇත්කඳුර', 'எத்கந்துரா', NULL, NULL, NULL, '80458', '6.23289180', '80.15681340'),
(675, 10, 'Galpatha', 'ගල්පාත', 'கல்பதா', NULL, NULL, NULL, '12005', '6.62914500', '80.02345020'),
(676, 10, 'Gamagoda', 'ගමගොඩ', 'கமகொட', NULL, NULL, NULL, '12016', '6.58394120', '79.99535970'),
(677, 10, 'Gonagalpura', 'ගොනාගල්පුර', 'கோனகல்புரா', NULL, NULL, NULL, '80502', '6.58539480', '79.96074000'),
(678, 10, 'Gonapola Junction', 'ගෝනපොල හංදිය', 'கோனபொலை சந்தி', NULL, NULL, NULL, '12410', '6.75634030', '80.01716090'),
(679, 10, 'Govinna', 'ගෝවින්න', 'கோவின்ன', NULL, NULL, NULL, '12310', '6.67523890', '80.11834880'),
(680, 10, 'Gurulubadda', 'ගුරුලුබැද්ද', 'குருலுபத்தா', NULL, NULL, NULL, '12236', '6.04826920', '80.19603960'),
(681, 10, 'Halkandawila', 'හල්කන්දවිල', 'ஹல்கண்டவில', NULL, NULL, NULL, '12055', '6.50000000', '80.01666670'),
(682, 10, 'Haltota', 'හල්තොට', 'ஹல்தொட', NULL, NULL, NULL, '12538', '6.69425550', '80.03086100'),
(683, 10, 'Halvitigala Colony', 'හල්විටගල ජනපදය', 'ஹல்விட்டிகல காலனி', NULL, NULL, NULL, '80146', '6.31172200', '80.36510350'),
(684, 10, 'Halwala', 'හල්වල', 'ஹல்வாலா', NULL, NULL, NULL, '12118', '6.42087690', '80.10656460'),
(685, 10, 'Halwatura', 'හල්වතුර', 'ஹல்வதுரா', NULL, NULL, NULL, '12306', '6.71759930', '80.19029630'),
(686, 10, 'Handapangoda', 'හඳපාන්ගොඩ', 'ஹண்டபாங்கொட', NULL, NULL, NULL, '10524', '6.79056920', '80.14006710'),
(687, 10, 'Hedigalla Colony', 'හැඩිගල්ල ජනපදය', 'ஹெடிகல்ல காலனி', NULL, NULL, NULL, '12234', '6.46639100', '80.28509290'),
(688, 10, 'Henegama', 'හේනෙගම', 'ஹெனேகம', NULL, NULL, NULL, '11715', '6.48387220', '80.10097960'),
(689, 10, 'Hettimulla', 'හෙට්ටිමුල්ල', 'ஹெட்டிமுல்ல', NULL, NULL, NULL, '71210', '6.45807660', '79.99080060'),
(690, 10, 'Horana', 'හොරණ', 'ஹொரன', NULL, NULL, NULL, '12400', '6.72465340', '80.03994640'),
(691, 10, 'Ittapana', 'ඉත්තෑපාන', 'இட்டபன', NULL, NULL, NULL, '12116', '6.43664840', '80.09552300'),
(692, 10, 'Kahawala', 'කහවල', 'கஹவாலா', NULL, NULL, NULL, '10508', '6.77942550', '80.11214930'),
(693, 10, 'Kalawila Kiranthidiya', 'කලවිල කිරන්තිඩිය', 'கலாவில கிரந்திடியா', NULL, NULL, NULL, '12078', '6.45456930', '80.01038610'),
(694, 10, 'Kalutara', 'කළුතර', 'களுத்துறை', NULL, NULL, NULL, '12000', '6.58539480', '79.96074000'),
(695, 10, 'Kananwila', 'කනන්විල', 'கானன்வில', NULL, NULL, NULL, '12418', '6.75423780', '80.06228150'),
(696, 10, 'Kandanagama', 'කඳනාගම', 'கந்தனாகம', NULL, NULL, NULL, '12428', '6.71440730', '79.98906040'),
(697, 10, 'Kelinkanda', 'කෙලින්කන්ද', 'கெலிங்கந்த', NULL, NULL, NULL, '12218', '6.57452540', '80.29345220'),
(698, 10, 'Kitulgoda', 'කිතුල්ගොඩ', 'கித்துல்கொட', NULL, NULL, NULL, '12222', '6.50645020', '80.17913680'),
(699, 10, 'Koholana', 'කොහොලාන', 'கொஹோலனா', NULL, NULL, NULL, '12007', '6.61727960', '79.99060150'),
(700, 10, 'Kuda Uduwa', 'කුඩා උඩුව', 'குடா உடுவா', NULL, NULL, NULL, '12426', '6.76620850', '80.07789310'),
(701, 10, 'Labbala', 'ලබ්බල', 'லப்பலா', NULL, NULL, NULL, '60162', '7.33960770', '80.07846130'),
(702, 10, 'Ihalahewessa', 'ඉහළහේවැස්ස', 'இஹலஹெவெஸ்ஸ', NULL, NULL, NULL, '80432', '6.58539480', '79.96074000'),
(703, 10, 'Induruwa', 'ඉඳුරුව', 'இந்துருவா', NULL, NULL, NULL, '80510', '6.37585110', '80.00931050'),
(704, 10, 'Ingiriya', 'ඉංගිරිය', 'இங்கிரிய', NULL, NULL, NULL, '12440', '6.74037690', '80.16245430'),
(705, 10, 'Maggona', 'මග්ගොන', 'மக்கொன', NULL, NULL, NULL, '12060', '6.50957990', '79.99571700'),
(706, 10, 'Mahagama', 'මහගම', 'மஹகம', NULL, NULL, NULL, '12210', '6.60352860', '80.15960410'),
(707, 10, 'Mahakalupahana', 'මහාකළුපහන', 'மஹாகலுபஹானா', NULL, NULL, NULL, '12126', '6.58539480', '79.96074000'),
(708, 10, 'Maharangalla', 'මහරංගල්ල', 'மகரங்கல்ல', NULL, NULL, NULL, '71211', '6.60155280', '79.97532410'),
(709, 10, 'Malgalla Talangalla', 'මල්ගල්ල තලංගල්ල', 'மல்கல்லா தலங்கல்ல', NULL, NULL, NULL, '80144', '6.30741480', '80.36607150'),
(710, 10, 'Matugama', 'මතුගම', 'மத்துகம', NULL, NULL, NULL, '12100', '6.52194320', '80.11368520'),
(711, 10, 'Meegahatenna', 'මීගහතැන්න', 'மீகஹதென்ன', NULL, NULL, NULL, '12130', '6.43311600', '80.19587550'),
(712, 10, 'Meegama', 'මීගම', 'மீகம', NULL, NULL, NULL, '12094', '6.42134980', '80.06327130'),
(713, 10, 'Meegoda', 'මීගොඩ', 'மீகொட', NULL, NULL, NULL, '10504', '6.58936130', '79.96366730'),
(714, 10, 'Millaniya', 'මිල්ලණිය', 'மில்லானியா', NULL, NULL, NULL, '12412', '6.68051510', '80.02065500'),
(715, 10, 'Millewa', 'මිල්ලෑව', 'மில்லேவா', NULL, NULL, NULL, '12422', '6.78121050', '80.07025550'),
(716, 10, 'Miwanapalana', 'මිවනපලාන', 'மிவனபாலன', NULL, NULL, NULL, '12424', '6.74338480', '80.09399780'),
(717, 10, 'Molkawa', 'මෝල්කාව', 'மோல்காவா', NULL, NULL, NULL, '12216', '6.60507010', '80.23770780'),
(718, 10, 'Morapitiya', 'මොරපිටිය', 'மொரப்பிட்டிய', NULL, NULL, NULL, '12232', '6.53052660', '80.27365140'),
(719, 10, 'Morontuduwa', 'මොරොන්තුඩුව', 'மொரோந்துடுவ', NULL, NULL, NULL, '12564', '6.66234510', '79.97032690'),
(720, 10, 'Nawattuduwa', 'නවත්තුඩුව', 'நவத்துடுவ', NULL, NULL, NULL, '12106', '6.48495100', '80.06382200'),
(721, 10, 'Neboda', 'නෑබොඩ', 'நேபொட', NULL, NULL, NULL, '12030', '6.59165510', '80.09260140'),
(722, 10, 'Padagoda', 'පාදාගොඩ', 'படகோடா', NULL, NULL, NULL, '12074', '6.56576860', '79.98361080'),
(723, 10, 'Pahalahewessa', 'පහළහේවැස්ස', 'பஹலஹெவெஸ்ஸ', NULL, NULL, NULL, '12144', '6.58539480', '79.96074000'),
(724, 10, 'Paiyagala', 'පයාගල', 'பையகல', NULL, NULL, NULL, '12050', '6.51861030', '79.99479560'),
(725, 10, 'Panadura', 'පානදුර', 'பாணந்துறை', NULL, NULL, NULL, '12500', '6.75279940', '79.89493090'),
(726, 10, 'Pannala', 'පන්නල', 'பன்னல', NULL, NULL, NULL, '60160', '6.56600740', '79.96254190'),
(727, 10, 'Paragastota', 'පරගස්තොට', 'பரகஸ்தோட்டா', NULL, NULL, NULL, '12414', '6.67287650', '80.00178540'),
(728, 10, 'Paragoda', 'පරගොඩ', 'பரகோடா', NULL, NULL, NULL, '12302', '6.61220740', '80.22668470'),
(729, 10, 'Paraigama', 'පරයිගම', 'பரைகம', NULL, NULL, NULL, '12122', '6.58539480', '79.96074000'),
(730, 10, 'Pelanda', 'පෙලන්ඩ', 'பெலண்டா', NULL, NULL, NULL, '12214', '6.58539480', '79.96074000'),
(731, 10, 'Pelawatta', 'පැලවත්ත', 'பெலவத்த', NULL, NULL, NULL, '12138', '6.40053000', '80.21206180'),
(732, 10, 'Pimbura', 'පිඹුර', 'பிம்புரா', NULL, NULL, NULL, '70472', '6.55867620', '80.15681340'),
(733, 10, 'Pitagaldeniya', 'පිටගල්දෙණිය', 'பிடகல்தெனிய', NULL, NULL, NULL, '71360', '7.19266780', '80.30015810'),
(734, 10, 'Pokunuwita', 'පොකුණුවිට', 'பொக்குனுவிட்ட', NULL, NULL, NULL, '12404', '6.72886860', '80.02973890'),
(735, 10, 'Poruwedanda', 'පෝරුවදණ්ඩ', 'பொருவேதண்டா', NULL, NULL, NULL, '12432', '6.73631930', '80.13355590'),
(736, 10, 'Ratmale', 'රත්මලේ', 'ரத்மலே', NULL, NULL, NULL, '81030', '6.46117810', '80.19808440'),
(737, 10, 'Remunagoda', 'රෙමුණගොඩ', 'ரெமுனகொட', NULL, NULL, NULL, '12009', '6.60790790', '80.02527190'),
(738, 10, 'Talgaswela', 'තල්ගස්වෙල', 'தல்கஸ்வெல', NULL, NULL, NULL, '80470', '6.24410260', '80.27089570'),
(739, 10, 'Tebuwana', 'තෙඹුවන', 'தெபுவானா', NULL, NULL, NULL, '12025', '6.59227590', '80.05768340'),
(740, 10, 'Uduwara', 'උඩුවර', 'உடுவார', NULL, NULL, NULL, '12322', '6.62301950', '80.06724360'),
(741, 10, 'Utumgama', 'උතුම්ගම', 'உதும்கம', NULL, NULL, NULL, '12127', '6.42699770', '80.15123170'),
(742, 10, 'Veyangalla', 'වේයන්ගල්ල', 'வெயங்கல்ல', NULL, NULL, NULL, '12204', '6.58235810', '80.14736130'),
(743, 10, 'Wadduwa', 'වාද්දුව', 'வாதுவை', NULL, NULL, NULL, '12560', '6.63628230', '79.95284510'),
(744, 10, 'Walagedara', 'වලගෙදර', 'வலகெதர', NULL, NULL, NULL, '12112', '6.44991840', '80.07933420'),
(745, 10, 'Walallawita', 'වළල්ලාවිට', 'வலல்லாவிட்ட', NULL, NULL, NULL, '12134', '6.38055500', '80.19587550'),
(746, 10, 'Waskaduwa', 'වස්කඩුව', 'வஸ்கடுவ', NULL, NULL, NULL, '12580', '6.62685800', '79.94305370'),
(747, 10, 'Welipenna', 'වැලිපැන්න', 'வெலிப்பன', NULL, NULL, NULL, '12108', '6.46819940', '80.10656460'),
(748, 10, 'Weliveriya', 'වැලිවේරිය', 'வெலிவேரிய', NULL, NULL, NULL, '11710', '7.03134070', '80.02875140'),
(749, 10, 'Welmilla Junction', 'වැල්මිල්ල හංදිය', 'வல்மில்ல சந்தி', NULL, NULL, NULL, '12534', '6.74843260', '79.97148470'),
(750, 10, 'Weragala', 'වේරගල', 'வெரகல', NULL, NULL, NULL, '71622', '6.52935950', '80.00597900'),
(751, 10, 'Yagirala', 'යගිරාල', 'யகிரல', NULL, NULL, NULL, '12124', '6.36940910', '80.16239480'),
(752, 10, 'Yatadolawatta', 'යටදොලවත්ත', 'யதடோலவத்த', NULL, NULL, NULL, '12104', '6.52016150', '80.07304910'),
(753, 10, 'Yatawara Junction', 'යටවර හන්දිය', 'யாதவார சந்திப்பு', NULL, NULL, NULL, '12006', '6.60032430', '80.03684880'),
(754, 11, 'Aludeniya', 'අලුදෙණිය', 'அலுதெனிய', NULL, NULL, NULL, '20062', '7.33069300', '80.56884280'),
(755, 11, 'Ambagahapelessa', 'අඹගහපැලැස්ස', 'அம்பகஹாபெலஸ்ஸ', NULL, NULL, NULL, '20986', '7.24356700', '81.00644420'),
(756, 11, 'Ambagamuwa Udabulathgama', 'අඹගමුව උඩබුලත්ගම', 'அம்பகமுவ உடபுலத்கம', NULL, NULL, NULL, '20678', '7.11324900', '80.61881560'),
(757, 11, 'Ambatenna', 'අඹතැන්න', 'அம்பத்தன்ன', NULL, NULL, NULL, '20136', '7.35297890', '80.61326460'),
(758, 11, 'Ampitiya', 'අම්පිටිය', 'அம்பிட்டிய', NULL, NULL, NULL, '20160', '7.26863590', '80.66321030'),
(759, 11, 'Ankumbura', 'අංකුඹුර', 'அங்கும்புரா', NULL, NULL, NULL, '20150', '7.43751890', '80.56884280'),
(760, 11, 'Atabage', 'අටබාගෙ', 'அட்டாபேஜ்', NULL, NULL, NULL, '20574', '7.13773260', '80.61106310'),
(761, 11, 'Balana', 'බලන', 'பாலனா', NULL, NULL, NULL, '20308', '7.27224530', '80.48822660'),
(762, 11, 'Bambaragahaela', 'බඹරගහඇල', 'பம்பரகஹேல', NULL, NULL, NULL, '20644', '7.28914610', '80.76075890'),
(763, 11, 'Batagolladeniya', 'බටගොල්ලදෙණිය', 'படகொல்லதெனிய', NULL, NULL, NULL, '20154', '7.41501070', '80.57856210'),
(764, 11, 'Batugoda', 'බටුගොඩ', 'படுகொட', NULL, NULL, NULL, '20132', '7.36568320', '80.60543550'),
(765, 11, 'Batumulla', 'බටුමුල්ල', 'பத்துமுல்லா', NULL, NULL, NULL, '20966', '7.26447420', '80.98434460'),
(766, 11, 'Bawlana', 'බව්ලන', 'பவுலானா', NULL, NULL, NULL, '20218', '7.20982270', '80.72005570'),
(767, 11, 'Bopana', 'බෝපන', 'போபனா', NULL, NULL, NULL, '20932', '7.30682480', '80.90003310'),
(768, 11, 'Danture', 'දංතුරේ', 'டான்ச்சர்', NULL, NULL, NULL, '20465', '7.28209570', '80.54106700'),
(769, 11, 'Dedunupitiya', 'දේදුනුපිටිය', 'தெதுனுபிட்டிய', NULL, NULL, NULL, '20068', '7.32662400', '80.43960600'),
(770, 11, 'Dekinda', 'දෙකිඳ', 'தேகிந்தா', NULL, NULL, NULL, '20658', '7.01611380', '80.51667090'),
(771, 11, 'Deltota', 'දෙල්තොට', 'தெல்தொட்ட', NULL, NULL, NULL, '20430', '7.17267450', '80.70157100'),
(772, 11, 'Divulankadawala', 'දිවුලන්කදවල', 'திவுலன்கடவெல', NULL, NULL, NULL, '51428', '8.11175760', '80.92906850'),
(773, 11, 'Dolapihilla', 'දොලපිහිල්ල', 'டோலாபிஹில்லா', NULL, NULL, NULL, '20126', '7.39500360', '80.57995050'),
(774, 11, 'Dolosbage', 'දොලොස්බාගෙ', 'டோலோஸ்பேஜ்', NULL, NULL, NULL, '20510', '7.08608120', '80.46046430'),
(775, 11, 'Dunuwila', 'දුනුවිල', 'துனுவில', NULL, NULL, NULL, '20824', '7.37907490', '80.64795240'),
(776, 11, 'Etulgama', 'ඇතුල්ගම', 'எதுல்கம', NULL, NULL, NULL, '20202', '7.25143540', '80.66452750'),
(777, 11, 'Galaboda', 'ගලබොඩ', 'கலபோடா', NULL, NULL, NULL, '20664', '6.98119520', '80.52717560'),
(778, 11, 'Galagedara', 'ගලගෙදර', 'கலகெதர', NULL, NULL, NULL, '20100', '7.36996830', '80.53273240'),
(779, 11, 'Galaha', 'ගලහ', 'கலஹா', NULL, NULL, NULL, '20420', '7.19684440', '80.67153170'),
(780, 11, 'Galhinna', 'ගල්හින්න', 'கல்ஹின்னா', NULL, NULL, NULL, '20152', '7.41602200', '80.56328840'),
(781, 11, 'Gampola', 'ගම්පොල', 'கம்பளை', NULL, NULL, NULL, '20500', '7.12677700', '80.56467700'),
(782, 11, 'Gelioya', 'ගෙලිඔය', 'கெலி ஓய', NULL, NULL, NULL, '20620', '7.21531510', '80.59799730'),
(783, 11, 'Godamunna', 'ගොඩමුන්න', 'கொடமுன்னா', NULL, NULL, NULL, '20214', '7.22808190', '80.70064960'),
(784, 11, 'Gomagoda', 'ගොමගොඩ', 'கோமகொட', NULL, NULL, NULL, '20184', '7.30505700', '80.61881560'),
(785, 11, 'Gonagantenna', 'ගොනාගන්තැන්න', 'கோனகந்தென்ன', NULL, NULL, NULL, '20712', '7.29057150', '80.63372620'),
(786, 11, 'Gonawalapatana', 'ගෝනවලපතන', 'கோணவலபதன', NULL, NULL, NULL, '20656', '7.29057150', '80.63372620'),
(787, 11, 'Gunnepana', 'ගුන්නෑපාන', 'குன்னெபன', NULL, NULL, NULL, '20270', '7.32286100', '80.65913260'),
(788, 11, 'Gurudeniya', 'ගුරුදෙණිය', 'குருதெனிய', NULL, NULL, NULL, '20189', '7.26311390', '80.71816510'),
(789, 11, 'Hakmana', 'හක්මන', 'ஹக்மன', NULL, NULL, NULL, '81300', '7.31433950', '80.80416350'),
(790, 11, 'Handaganawa', 'හඳගනාව', 'ஹண்டகனாவா', NULL, NULL, NULL, '20984', '7.26730780', '80.99263270'),
(791, 11, 'Handawalapitiya', 'හඳවලපිටිය', 'ஹண்டவலப்பிட்டிய', NULL, NULL, NULL, '20438', '7.04470080', '80.51606080'),
(792, 11, 'Handessa', 'හඳැස්ස', 'ஹதெச', NULL, NULL, NULL, '20480', '7.23030520', '80.58203300'),
(793, 20, 'Hanguranketha', 'හඟුරන්කෙත', 'ஹங்குரன்கெத', NULL, NULL, NULL, '20710', '7.29057150', '80.63372620'),
(794, 11, 'Harangalagama', 'හරංගලගම', 'ஹரங்களகம', NULL, NULL, NULL, '20669', '7.29057150', '80.63372620'),
(795, 11, 'Hataraliyadda', 'හතරලියද්ද', 'ஹதரலியத்த', NULL, NULL, NULL, '20060', '7.33688600', '80.47181430'),
(796, 11, 'Hindagala', 'හිඳගල', 'ஹிந்தகல', NULL, NULL, NULL, '20414', '7.23674630', '80.60354940'),
(797, 11, 'Hondiyadeniya', 'හොඳයාදෙණිය', 'ஹொண்டியதெனிய', NULL, NULL, NULL, '20524', '7.32102140', '80.61584050'),
(798, 11, 'Hunnasgiriya', 'හුන්නස්ගිරිය', 'ஹு ன்னஸ்கிரிய', NULL, NULL, NULL, '20948', '7.29917070', '80.85161730'),
(799, 11, 'Inguruwatta', 'ඉඟුරුවත්ත', 'இங்குருவத்த', NULL, NULL, NULL, '60064', '7.17678210', '80.60216140'),
(800, 11, 'Jambugahapitiya', 'ජම්බුගහපිටිය', 'ஜம்புகஹபிட்டிய', NULL, NULL, NULL, '20822', '7.35952440', '80.63893500'),
(801, 11, 'Kadugannawa', 'කඩුගන්නාව', 'கடுகண்ணாவ', NULL, NULL, NULL, '20300', '7.25497250', '80.51883960'),
(802, 11, 'Kahataliyadda', 'කහටලියද්ද', 'கஹடலியத்த', NULL, NULL, NULL, '20924', '7.33577980', '80.47115370'),
(803, 11, 'Kalugala', 'කළුගල', 'கலுகல', NULL, NULL, NULL, '20926', '7.38690830', '80.89726730'),
(804, 11, 'Kandy', 'මහනුවර', 'கண்டி', NULL, NULL, NULL, '20000', '7.27974620', '80.62020330'),
(805, 11, 'Kapuliyadde', 'කපුලියද්ද', 'கபுலியத்தே', NULL, NULL, NULL, '20206', '7.23911780', '80.71072330'),
(806, 11, 'Katugastota', 'කටුගස්තොට', 'கடுகஸ்தோட்டை', NULL, NULL, NULL, '20800', '7.33599030', '80.62140050'),
(807, 11, 'Katukitula', 'කටුකිතුල', 'கடுகிடுல', NULL, NULL, NULL, '20588', '7.08155280', '80.66794850'),
(808, 11, 'Kelanigama', 'කැළණිගම', 'களனிகம', NULL, NULL, NULL, '20688', '6.97648370', '80.48151140'),
(809, 11, 'Kengalla', 'කෙන්ගල්ල', 'கெங்கல்லா', NULL, NULL, NULL, '20186', '7.29253660', '80.72282770'),
(810, 11, 'Ketaboola', 'කැටබූල', 'கேட்டபூலா', NULL, NULL, NULL, '20660', '7.01016490', '80.58962260'),
(811, 11, 'Ketakumbura', 'කැටකුඹුර', 'கேடகும்புரா', NULL, NULL, NULL, '20306', '7.28327560', '80.66182340'),
(812, 11, 'Kobonila', 'කොබෝනීල', 'கோபோனிலா', NULL, NULL, NULL, '20928', '7.29057150', '80.63372620'),
(813, 11, 'Kolabissa', 'කොළඹිස්ස', 'கோலாபிஸ்ஸா', NULL, NULL, NULL, '20212', '7.16928430', '80.73246460'),
(814, 11, 'Kolongoda', 'කොලොන්ගොඩ', 'கொலோங்கோடா', NULL, NULL, NULL, '20971', '7.47215410', '80.94565530'),
(815, 11, 'Kulugammana', 'කුළුගම්මන', 'குலுகம்மன', NULL, NULL, NULL, '20048', '7.31827420', '80.59585190'),
(816, 11, 'Kumbukkandura', 'කුඹුක්කඳුර', 'கும்புக்கந்துர', NULL, NULL, NULL, '20902', '7.30459410', '80.74214100'),
(817, 11, 'Kumburegama', 'කුඹුරේගම', 'கும்புரேகம', NULL, NULL, NULL, '20086', '7.35091190', '80.54776870'),
(818, 11, 'Kundasale', 'කුණ්ඩසාලෙ', 'குண்டசாலை', NULL, NULL, NULL, '20168', '7.28219950', '80.69427580'),
(819, 11, 'Leemagahakotuwa', 'ලීමගහකොටුව', 'லீமகஹகொடுவ', NULL, NULL, NULL, '20482', '7.21536260', '80.57105550'),
(820, 11, 'Ihala Kobbekaduwa', 'ඉහල කොබ්බෑකඩුව', 'இஹல கொப்பேகடுவ', NULL, NULL, NULL, '20042', '7.31288880', '80.56027950'),
(821, 11, 'Lunugama', 'ලුණුගම', 'லுனுகம', NULL, NULL, NULL, '11062', '7.19830890', '80.58064470'),
(822, 11, 'Lunuketiya Maditta', 'ලුණුකැටිය මඩිත්ත', 'லுனுகெட்டிய மடிட்டா', NULL, NULL, NULL, '20172', '7.29057150', '80.63372620'),
(823, 11, 'Madawala Bazaar', 'මඩවල බසාර්', 'மடவளை பஜார்', NULL, NULL, NULL, '20260', '7.32755930', '80.67430530'),
(824, 11, 'Madawalalanda', 'මඩවලලන්ද', 'மடவலலந்த', NULL, NULL, NULL, '32016', '7.18419030', '81.67472950'),
(825, 11, 'Madugalla', 'මඩුගල්ල', 'மதுகல்ல', NULL, NULL, NULL, '20938', '7.25845310', '80.88343670'),
(826, 11, 'Madulkele', 'මඩුල්කැලේ', 'மதுல்கெலே', NULL, NULL, NULL, '20840', '7.39292340', '80.72389960'),
(827, 11, 'Mahadoraliyadda', 'මහදොරලියද්ද', 'மஹதோரலியத்தா', NULL, NULL, NULL, '20945', '7.33577980', '80.47115370'),
(828, 11, 'Mahamedagama', 'මහමැදගම', 'மஹாமேதகம', NULL, NULL, NULL, '20216', '7.22160320', '80.71412800'),
(829, 11, 'Mahanagapura', 'මහානාගපුර', 'மகாநாகபுரா', NULL, NULL, NULL, '32018', '6.32520790', '81.21057130'),
(830, 11, 'Mailapitiya', 'මයිලපිටිය', 'மைலபிட்டிய', NULL, NULL, NULL, '20702', '7.22779430', '80.75192720'),
(831, 11, 'Makkanigama', 'මක්කානිගම', 'மக்கனிகம', NULL, NULL, NULL, '20828', '7.34551600', '80.70342220'),
(832, 11, 'Makuldeniya', 'මකුල්දෙණිය', 'மகுல்தெனிய', NULL, NULL, NULL, '20921', '7.34041540', '80.77963130'),
(833, 11, 'Mangalagama', 'මංගලගම', 'மங்களகம', NULL, NULL, NULL, '32069', '7.29214700', '80.63451000'),
(834, 11, 'Mapakanda', 'මාපාකන්ද', 'மாபகண்டா', NULL, NULL, NULL, '20662', '7.23017010', '80.60771320'),
(835, 11, 'Marassana', 'මාරස්සන', 'மாரஸ்சன', NULL, NULL, NULL, '20210', '7.20636030', '80.74638520'),
(836, 20, 'Marymount Colony', 'මේරිමවුන්ට් ජනපදය', 'மேரிமவுண்ட் காலனி', NULL, NULL, NULL, '20714', '7.29057150', '80.63372620'),
(837, 11, 'Mawatura', 'මාවතුර', 'மாவடுரா', NULL, NULL, NULL, '20564', '7.08809270', '80.57328790'),
(838, 11, 'Medamahanuwara', 'මැදමහනුවර', 'மேதமஹனுவர', NULL, NULL, NULL, '20940', '7.28645840', '80.81701670'),
(839, 11, 'Medawala Harispattuwa', 'මැදවල හාරිස්පත්තුව', 'மெடவல ஹாரிஸ்பத்துவ', NULL, NULL, NULL, '20120', '7.35750070', '80.57439690'),
(840, 11, 'Meetalawa', 'මීතලාව', 'மீதலாவா', NULL, NULL, NULL, '20512', '7.13712680', '80.52600060'),
(841, 11, 'Megoda Kalugamuwa', 'මෙගොඩ කළුගමුව', 'மெகொட களுகமுவ', NULL, NULL, NULL, '20409', '7.20719150', '80.60907330'),
(842, 11, 'Menikdiwela', 'මැණික්දිවෙල', 'மெனிக்திவெல', NULL, NULL, NULL, '20470', '7.14489710', '80.53838360'),
(843, 11, 'Menikhinna', 'මැණික්හින්න', 'மெனிகின்ன', NULL, NULL, NULL, '20170', '7.31745810', '80.70203590'),
(844, 11, 'Mimure', 'මීමුරේ', 'மிமுரே', NULL, NULL, NULL, '20923', '7.43264530', '80.84608220'),
(845, 11, 'Minigamuwa', 'මිණිගමුව', 'மினிகமுவ', NULL, NULL, NULL, '20109', '7.34132310', '80.50355480'),
(846, 11, 'Minipe', 'මිණිපේ', 'மினிபே', NULL, NULL, NULL, '20983', '7.22745230', '81.00091990'),
(847, 11, 'Moragahapallama', 'මොරගහපල්ලම', 'மொரகஹபல்லம', NULL, NULL, NULL, '32012', '7.30269050', '80.62927990'),
(848, 11, 'Murutalawa', 'මුරුතලාව', 'முருதலாவ', NULL, NULL, NULL, '20232', '7.29867830', '80.56884280'),
(849, 11, 'Muruthagahamulla', 'මුරුතගහමුල්ල', 'முறுதகஹாமுல்ல', NULL, NULL, NULL, '20526', '7.20709420', '80.58689210'),
(850, 11, 'Nanuoya', 'නානුඔය', 'நானுஓயா', NULL, NULL, NULL, '22150', '6.94031580', '80.74084290'),
(851, 11, 'Naranpanawa', 'නාරම්පනාව', 'நாரன்பானவ', NULL, NULL, NULL, '20176', '7.34413090', '80.73322160'),
(852, 11, 'Narawelpita', 'නරවැල්පිට', 'நரவெல்பிட்ட', NULL, NULL, NULL, '81302', '7.29057150', '80.63372620'),
(853, 11, 'Nawalapitiya', 'නාවලපිටිය', 'நாவலப்பிட்டி', NULL, NULL, NULL, '20650', '7.04470080', '80.51606080'),
(854, 11, 'Nawathispane', 'නවතිස්පනේ', 'நவதிஸ்பனே', NULL, NULL, NULL, '20670', '7.03981720', '80.60385780'),
(855, 11, 'Nillambe', 'නිල්ලඹ', 'நிலாம்பே', NULL, NULL, NULL, '20418', '7.19950170', '80.61300540'),
(856, 11, 'Nugaliyadda', 'නුගලියද්ද', 'நுகலியத்தா', NULL, NULL, NULL, '20204', '7.23754640', '80.69561280'),
(857, 11, 'Ovilikanda', 'ඕවිලිකන්ද', 'ஓவிலிகண்டா', NULL, NULL, NULL, '21020', '7.45254660', '80.58411550'),
(858, 11, 'Pallekotuwa', 'පල්ලෙකොටුව', 'பல்லேகொடுவ', NULL, NULL, NULL, '20084', '6.02501430', '80.21804080'),
(859, 11, 'Panwilatenna', 'පන්විලතැන්න', 'பன்விலதென்ன', NULL, NULL, NULL, '20544', '7.15582330', '80.63193290'),
(860, 11, 'Paradeka', 'පරදෙකා', 'பரதேகா', NULL, NULL, NULL, '20578', '7.12389050', '80.61881560'),
(861, 11, 'Pasbage', 'පස්බාගේ', 'பாஸ்பேஜ்', NULL, NULL, NULL, '20654', '7.00785470', '80.53273240'),
(862, 11, 'Pattitalawa', 'පට්ටිතලාව', 'பட்டித்தலாவ', NULL, NULL, NULL, '20511', '7.11224550', '80.47228170'),
(863, 11, 'Peradeniya', 'පේරාදෙණිය', 'பேராதனை', NULL, NULL, NULL, '20400', '7.26986530', '80.59383300'),
(864, 11, 'Pilimatalawa', 'පිළිමතලාව', 'பிலிமத்தலாவை', NULL, NULL, NULL, '20450', '7.25884400', '80.54025890'),
(865, 11, 'Poholiyadda', 'පොහොලියද්ද', 'பொஹோலியத்தா', NULL, NULL, NULL, '20106', '7.24902840', '80.65061490'),
(866, 11, 'Pubbiliya', 'පුබ්බිලිය', 'பப்பிலியா', NULL, NULL, NULL, '21502', '7.38628780', '80.48409740'),
(867, 11, 'Pupuressa', 'පුපුරැස්ස', 'புபுரெஸ்ஸா', NULL, NULL, NULL, '20546', '7.14358860', '80.67153170'),
(868, 11, 'Pussellawa', 'පුස්සැල්ලාව', 'புசல்லாவை', NULL, NULL, NULL, '20580', '7.11098270', '80.63824130'),
(869, 11, 'Putuhapuwa', 'පුටුහපුව', 'புதுஹபுவா', NULL, NULL, NULL, '20906', '7.33592530', '80.75608340'),
(870, 11, 'Rajawella', 'රජවැල්ල', 'ராஜவெல்ல', NULL, NULL, NULL, '20180', '7.29635490', '80.73010350'),
(871, 11, 'Rambukpitiya', 'රඹුක්පිටිය', 'ரம்புக்பிட்டிய', NULL, NULL, NULL, '20676', '8.56611110', '80.22638890'),
(872, 11, 'Rambukwella', 'රඹුක්වැල්ල', 'ரம்புக்வெல்ல', NULL, NULL, NULL, '20128', '7.29100470', '80.77824630'),
(873, 11, 'Rangala', 'රංගල', 'ரங்கலா', NULL, NULL, NULL, '20922', '7.32297530', '80.77547630'),
(874, 11, 'Rantembe', 'රන්ටැඹේ', 'ராண்டெம்பே', NULL, NULL, NULL, '20990', '7.19960590', '80.94962880'),
(875, 11, 'Sangarajapura', 'සංඝරාජපුර', 'சங்கராஜபுரம்', NULL, NULL, NULL, '20044', '7.32172700', '80.51825350'),
(876, 11, 'Senarathwela', 'සෙනරත්වෙල', 'செனரத்வெல', NULL, NULL, NULL, '20904', '7.28271720', '80.76439520'),
(877, 11, 'Talatuoya', 'තලාතුඔය', 'தலதுஓயா', NULL, NULL, NULL, '20200', '7.24776190', '80.68539860'),
(878, 11, 'Teldeniya', 'තෙල්දෙණිය', 'தெல்தெனிய', NULL, NULL, NULL, '20900', '7.31538190', '80.74493090'),
(879, 11, 'Tennekumbura', 'තැන්නෙකුඹුර', 'தென்னகும்புரா', NULL, NULL, NULL, '20166', '7.28327560', '80.66182340'),
(880, 11, 'Uda Peradeniya', 'උඩ පේරාදෙණිය', 'உடா பேராதனை', NULL, NULL, NULL, '20404', '7.26399420', '80.60384950'),
(881, 11, 'Udahentenna', 'උඩහතැන්න', 'உடஹென்தென்ன', NULL, NULL, NULL, '20506', '7.09592590', '80.52279280'),
(882, 11, 'Udatalawinna', 'උඩුතලවින්න', 'உடதலவின்ன', NULL, NULL, NULL, '20802', '7.34174960', '80.65072680'),
(883, 11, 'Udispattuwa', 'උඩිස්පත්තුව', 'உடிஸ்பத்துவ', NULL, NULL, NULL, '20916', '7.31415770', '80.78482470'),
(884, 11, 'Ududumbara', 'උඩුදුම්බර', 'உடதும்பறை', NULL, NULL, NULL, '20950', '7.31438630', '80.87790380'),
(885, 11, 'Uduwahinna', 'උඩුවාහින්න', 'உடுவஹின்ன', NULL, NULL, NULL, '20934', '7.29057150', '80.63372620'),
(886, 11, 'Uduwela', 'උඩුවෙල', 'உடுவெல', NULL, NULL, NULL, '20164', '7.26257160', '80.63300950'),
(887, 11, 'Ulapane', 'උලපනේ', 'உலப்பனே', NULL, NULL, NULL, '20562', '7.09876450', '80.56051110'),
(888, 11, 'Unuwinna', 'උනුවින්න', 'உனுவின்னா', NULL, NULL, NULL, '20708', '7.20522760', '80.76879140'),
(889, 11, 'Velamboda', 'වෙලම්බොඩ', 'வெலம்பொட', NULL, NULL, NULL, '20640', '7.20096370', '80.54801180'),
(890, 11, 'Watagoda', 'වටගොඩ', 'வடகொட', NULL, NULL, NULL, '22110', '7.39523860', '80.59105670'),
(891, 11, 'Watagoda Harispattuwa', 'වටගොඩ හාරිස්පත්තුව', 'வடகொட ஹாரிஸ்பத்துவ', NULL, NULL, NULL, '20134', '7.39523860', '80.59105670'),
(892, 11, 'Wattappola', 'වට්ටප්පොල', 'வட்டப்பொல', NULL, NULL, NULL, '20454', '7.23411760', '80.54106700'),
(893, 11, 'Weligampola', 'වැලිගම්පොළ', 'வெலிகம்பொல', NULL, NULL, NULL, '20666', '7.04210070', '80.51883960'),
(894, 11, 'Wendaruwa', 'වෙන්ඩරුව', 'வெந்தருவ', NULL, NULL, NULL, '20914', '7.26511460', '80.81701670'),
(895, 11, 'Weragantota', 'වේරගංතොට', 'வெரகந்தோட்டை', NULL, NULL, NULL, '20982', '7.32991440', '80.98572600'),
(896, 11, 'Werapitya', 'වේරපිට්‍ය', 'வெரபித்யா', NULL, NULL, NULL, '20908', '7.36454780', '80.75138200'),
(897, 11, 'Werellagama', 'වැරැල්ලගම', 'வெரல்லகம', NULL, NULL, NULL, '20080', '7.31577890', '80.57950500'),
(898, 11, 'Wettawa', 'වෑත්තෑව', 'வெட்டவா', NULL, NULL, NULL, '20108', '7.36437410', '80.51160780'),
(899, 11, 'Yahalatenna', 'යහලතැන්න', 'யஹலதென்ன', NULL, NULL, NULL, '20234', '7.31478000', '80.57109060'),
(900, 11, 'Yatihalagala', 'යටිහලගල', 'யதிஹலகல', NULL, NULL, NULL, '20034', '7.29440420', '80.59672060'),
(901, 12, 'Alawala', 'අලවල', 'அலவாலா', NULL, NULL, NULL, '11122', '7.19813610', '80.28648620'),
(902, 12, 'Alawatura', 'අලවතුර', 'அலவத்துரா', NULL, NULL, NULL, '71204', '7.13333300', '80.33333300'),
(903, 12, 'Alawwa', 'අලව්ව', 'அலவ்வ', NULL, NULL, NULL, '60280', '7.29543020', '80.23662610'),
(904, 12, 'Algama', 'අල්ගම', 'அல்காமா', NULL, NULL, NULL, '71607', '7.15632470', '80.16588300'),
(905, 12, 'Alutnuwara', 'අළුත්නුවර', 'அளுத்நுவர', NULL, NULL, NULL, '71508', '6.68614570', '80.74638520'),
(906, 12, 'Ambalakanda', 'අම්බලකන්ද', 'அம்பலகண்டா', NULL, NULL, NULL, '71546', '7.13767300', '80.44795000'),
(907, 12, 'Ambulugala', 'අම්බුළුගල', 'அம்புலுகல', NULL, NULL, NULL, '71503', '7.23676530', '80.41317800'),
(908, 12, 'Amitirigala', 'අමිතිරිගල', 'அமிதிரிகல', NULL, NULL, NULL, '71320', '7.02988480', '80.18471670'),
(909, 12, 'Ampagala', 'අම්පාගල', 'அம்பகல', NULL, NULL, NULL, '71232', '7.07990050', '80.29066590'),
(910, 12, 'Anhandiya', 'අංහන්දිය', 'அன்ஹந்தியா', NULL, NULL, NULL, '60074', '7.46171720', '80.48201240'),
(911, 12, 'Anhettigama', 'අංහෙට්ටිගම', 'அன்ஹெட்டிகம', NULL, NULL, NULL, '71403', '6.92425410', '80.37703340'),
(912, 12, 'Aranayaka', 'අරනායක', 'அரநாயக', NULL, NULL, NULL, '71540', '7.14966510', '80.46498290'),
(913, 12, 'Aruggammana', 'අරුග්ගම්මන', 'அருகம்மனா', NULL, NULL, NULL, '71041', '7.11624740', '80.30955840'),
(914, 12, 'Batuwita', 'බටුවිට', 'படுவிட்ட', NULL, NULL, NULL, '71321', '6.74623400', '80.03952050'),
(915, 12, 'Beligala(Sab)', 'බෙලිගල', 'பெலிகல(சப்)', NULL, NULL, NULL, '71044', '7.27845860', '80.29096310'),
(916, 12, 'Belihuloya', 'බෙලිහුල්ඔය', 'பெலிஹுலோயா', NULL, NULL, NULL, '70140', '6.71459120', '80.78721850'),
(917, 12, 'Berannawa', 'බෙරන්නව', 'பெரன்னாவா', NULL, NULL, NULL, '71706', '7.06627550', '80.40204800'),
(918, 12, 'Bopitiya', 'බෝපිටිය', 'போபிட்டிய', NULL, NULL, NULL, '60155', '7.32012270', '80.07863590'),
(919, 12, 'Bopitiya (SAB)', 'බෝපිටිය (සබර)', 'போபிட்டிய (எஸ்ஏபி)', NULL, NULL, NULL, '71612', '7.16826830', '80.19587550'),
(920, 12, 'Boralankada', 'බොරලන්කද', 'போரலங்காட', NULL, NULL, NULL, '71418', '6.97734990', '80.33802130'),
(921, 12, 'Bossella', 'බොස්සැල්ල', 'போசெல்லா', NULL, NULL, NULL, '71208', '7.14727070', '80.39787380'),
(922, 12, 'Bulathkohupitiya', 'බුලත්කොහුපිටිය', 'புளத்கொஹுபிட்டிய', NULL, NULL, NULL, '71230', '7.10452810', '80.33604700'),
(923, 12, 'Damunupola', 'දමුනුපොල', 'தமுனுபொல', NULL, NULL, NULL, '71034', '7.19251700', '80.33523640'),
(924, 12, 'Debathgama', 'දෙබත්ගම', 'தேபத்கம', NULL, NULL, NULL, '71037', '7.17830540', '80.41874250'),
(925, 12, 'Dedugala', 'දේදුගල', 'டெடுகல', NULL, NULL, NULL, '71237', '7.09556450', '80.40483060'),
(926, 12, 'Deewala Pallegama', 'දීවල පල්ලෙගම', 'தீவல பல்லேகம', NULL, NULL, NULL, '71022', '7.17292530', '80.36220460'),
(927, 12, 'Dehiowita', 'දෙහිඕවිට', 'தெஹிஓவிட', NULL, NULL, NULL, '71400', '6.96389480', '80.26419100'),
(928, 12, 'Deldeniya', 'දෙල්දෙණිය', 'டெல்தெனியா', NULL, NULL, NULL, '71009', '7.28230050', '80.36168900'),
(929, 12, 'Deloluwa', 'දෙලෝලුව', 'டெலோலுவா', NULL, NULL, NULL, '71401', '7.25133170', '80.34637540'),
(930, 12, 'Deraniyagala', 'දැරණියගල', 'தெரணியகல', NULL, NULL, NULL, '71430', '6.93491980', '80.33802130'),
(931, 12, 'Dewalegama', 'දේවාලේගම', 'தேவாலகம', NULL, NULL, NULL, '71050', '7.27737960', '80.31852520'),
(932, 12, 'Dewanagala', 'දෙවනගල', 'தெவனகல', NULL, NULL, NULL, '71527', '7.21804520', '80.47297680'),
(933, 12, 'Dombemada', 'දොඹේමද', 'தொம்பேமடா', NULL, NULL, NULL, '71115', '7.38409630', '80.35124820'),
(934, 12, 'Dorawaka', 'දොරවක', 'தொரவாக்கா', NULL, NULL, NULL, '71601', '7.18910810', '80.22426240'),
(935, 12, 'Dunumala', 'දුනුමල', 'துனுமாலா', NULL, NULL, NULL, '71605', '7.14735240', '80.21261090'),
(936, 12, 'Galapitamada', 'ගලපිටමඩ', 'கலாபிடமடா', NULL, NULL, NULL, '71603', '7.13934840', '80.23474530'),
(937, 12, 'Galatara', 'ගලතර', 'கலாட்டாரா', NULL, NULL, NULL, '71505', '7.25133170', '80.34637540'),
(938, 12, 'Galigamuwa Town', 'ගලිගමුව නගරය', 'கலிகமுவ நகரம்', NULL, NULL, NULL, '71350', '7.23594070', '80.31156120'),
(939, 12, 'Gallella', 'ගල්ලෑල්ල', 'கல்லேல்ல', NULL, NULL, NULL, '70062', '6.70779850', '80.49660620'),
(940, 12, 'Galpatha(Sab)', 'ගල්පාත (සබරගමුව)', 'கல்பதா(சப்)', NULL, NULL, NULL, '71312', '7.05310740', '80.27951950'),
(941, 12, 'Gantuna', 'ගන්තුන', 'கன்டுனா', NULL, NULL, NULL, '71222', '7.12746820', '80.40483060'),
(942, 12, 'Getahetta', 'ගැටහැත්ත', 'கெட்டஹெட்டா', NULL, NULL, NULL, '70620', '6.90584960', '80.22663120'),
(943, 12, 'Godagampola', 'ගොඩගම්පොල', 'கொடகம்பொல', NULL, NULL, NULL, '70556', '6.88097930', '80.31729520'),
(944, 12, 'Gonagala', 'ගෝනාගල', 'கோனகல', NULL, NULL, NULL, '71318', '7.01811020', '80.20935370'),
(945, 12, 'Hakahinna', 'හකහින්න', 'ஹகாஹின்னா', NULL, NULL, NULL, '71352', '7.20704970', '80.30170420'),
(946, 12, 'Hakbellawaka', 'හක්බෙල්ලවක', 'ஹக்பெல்லாவகா', NULL, NULL, NULL, '71715', '6.99455040', '80.32443620'),
(947, 12, 'Halloluwa', 'හල්ලෝලුව', 'ஹல்லோலுவா', NULL, NULL, NULL, '20032', '7.30186820', '80.59383300'),
(948, 12, 'Hedunuwewa', 'හැදුනුවැව', 'ஹெதுனுவெவ', NULL, NULL, NULL, '22024', '7.05677800', '80.65350110'),
(949, 12, 'Hemmatagama', 'හෙම්මාතගම', 'ஹெம்மாதகம', NULL, NULL, NULL, '71530', '7.17336010', '80.50077550'),
(950, 12, 'Hewadiwela', 'හේවාදිවෙල', 'ஹெவடிவெல', NULL, NULL, NULL, '71108', '7.37067080', '80.37839160'),
(951, 12, 'Hingula', 'හිඟුල', 'ஹிங்குலா', NULL, NULL, NULL, '71520', '7.24791280', '80.46811100'),
(952, 12, 'Hinguralakanda', 'හිඟුරලකන්ද', 'ஹிங்குரலகண்டா', NULL, NULL, NULL, '71417', '6.91323470', '80.27830300'),
(953, 12, 'Hingurana', 'හිඟුරාන', 'ஹிங்குரானா', NULL, NULL, NULL, '32010', '7.22691760', '81.67472950'),
(954, 12, 'Hiriwadunna', 'හිරිවඩුන්න', 'ஹிரிவடுன்னா', NULL, NULL, NULL, '71014', '7.28745490', '80.38465420'),
(955, 12, 'Ihala Walpola', 'ඉහල වල්පොල', 'இஹல வல்பொல', NULL, NULL, NULL, '80134', '7.34849750', '80.40204800'),
(956, 12, 'Ihalagama', 'ඉහළගම', 'இஹலகம', NULL, NULL, NULL, '70144', '7.22236400', '80.27724350');
INSERT INTO `cities` (`id`, `district_id`, `name_en`, `name_si`, `name_ta`, `sub_name_en`, `sub_name_si`, `sub_name_ta`, `postcode`, `latitude`, `longitude`) VALUES
(957, 12, 'Imbulana', 'ඉඹුලාන', 'இம்புலானா', NULL, NULL, NULL, '71313', '7.07241270', '80.25025350'),
(958, 12, 'Imbulgasdeniya', 'ඉඹුල්ගස්දෙණිය', 'இம்புல்கஸ்தெனிய', NULL, NULL, NULL, '71055', '7.30986000', '80.31835110'),
(959, 12, 'Kabagamuwa', 'කබගමුව', 'கபாகமுவ', NULL, NULL, NULL, '71202', '7.13641300', '80.33976180'),
(960, 12, 'Kahapathwala', 'කහපත්වල', 'கஹபத்வாலா', NULL, NULL, NULL, '60062', '7.39388200', '80.46463530'),
(961, 12, 'Kandaketya', 'කන්දකැටිය', 'கந்தகெட்டிய', NULL, NULL, NULL, '90020', '7.25081670', '80.37145700'),
(962, 12, 'Kannattota', 'කන්නත්තොට', 'கண்னத்தோட்ட', NULL, NULL, NULL, '71372', '7.09472260', '80.28228110'),
(963, 12, 'Karagahinna', 'කරගහහින්න', 'கரகஹின்ன', NULL, NULL, NULL, '21014', '7.20704970', '80.30170420'),
(964, 12, 'Kegalle', 'කෑගල්ල', 'கேகாலை', NULL, NULL, NULL, '71000', '7.25133170', '80.34637540'),
(965, 12, 'Kehelpannala', 'කෙහෙල්පන්නල', 'கெஹெல்பன்னல', NULL, NULL, NULL, '71533', '7.16660300', '80.51924500'),
(966, 12, 'Ketawala Leula', 'කැටවල ලෙව්ල', 'கேடவாலா லியூலா', NULL, NULL, NULL, '20198', '7.26166000', '80.68054550'),
(967, 12, 'Kitulgala', 'කිතුල්ගල', 'கிதுல்கல', NULL, NULL, NULL, '71720', '6.98978450', '80.42708850'),
(968, 12, 'Kondeniya', 'කොන්ඩෙනිය', 'கொண்டெனிய', NULL, NULL, NULL, '71501', '7.27205560', '80.38117510'),
(969, 12, 'Kotiyakumbura', 'කොටියාකුඹුර', 'கோடியாகும்புர', NULL, NULL, NULL, '71370', '7.12434010', '80.28718280'),
(970, 12, 'Lewangama', 'ලෙවන්ගම', 'லெவங்கம', NULL, NULL, NULL, '71315', '7.10743580', '80.24216720'),
(971, 12, 'Mahabage', 'මහබාගේ', 'மஹாபாகே', NULL, NULL, NULL, '71722', '7.02209340', '80.44934050'),
(972, 12, 'Makehelwala', 'මාකෙහෙල්වල', 'மகேல்வல', NULL, NULL, NULL, '71507', '7.28193860', '80.47019640'),
(973, 12, 'Malalpola', 'මලල්පොල', 'மலல்பொல', NULL, NULL, NULL, '71704', '7.05166920', '80.33802130'),
(974, 12, 'Maldeniya', 'මල්දෙණිය', 'மல்தெனிய', NULL, NULL, NULL, '22021', '6.93595660', '80.27603180'),
(975, 12, 'Maliboda', 'මාලිබොඩ', 'மலிபோடா', NULL, NULL, NULL, '71411', '6.89059220', '80.43960600'),
(976, 12, 'Maliyadda', 'මාලියද්ද', 'மாலியத்த', NULL, NULL, NULL, '90022', '6.90051230', '79.86842270'),
(977, 12, 'Malmaduwa', 'මල්මඩුව', 'மல்மதுவ', NULL, NULL, NULL, '71325', '7.13677730', '80.27812620'),
(978, 12, 'Marapana', 'මාරපන', 'மரபனா', NULL, NULL, NULL, '70041', '6.65895580', '80.42987040'),
(979, 12, 'Mawanella', 'මාවනැල්ල', 'மாவனெல்ல', NULL, NULL, NULL, '71500', '7.23103050', '80.47767140'),
(980, 12, 'Meetanwala', 'මීටන්වල', 'மீதன்வாலா', NULL, NULL, NULL, '60066', '7.25133170', '80.34637540'),
(981, 12, 'Migastenna Sabara', 'මිගස්තැන්න සබර', 'மிகஸ்தென்னா சபரா', NULL, NULL, NULL, '71716', '7.25227040', '80.33963850'),
(982, 12, 'Miyanawita', 'මියනවිට', 'மியானாவிட்ட', NULL, NULL, NULL, '71432', '6.88613020', '80.36178500'),
(983, 12, 'Molagoda', 'මොලගොඩ', 'மொலகொட', NULL, NULL, NULL, '71016', '7.25979540', '80.39884800'),
(984, 12, 'Morontota', 'මොරොන්තොට', 'மொறொன்தொட', NULL, NULL, NULL, '71220', '7.17571880', '80.35890490'),
(985, 12, 'Narangala', 'නාරංගල', 'நாரங்கலா', NULL, NULL, NULL, '90064', '7.17394400', '80.43436400'),
(986, 12, 'Narangoda', 'නාරංගොඩ', 'நாரங்கொட', NULL, NULL, NULL, '60152', '7.19701280', '80.29623850'),
(987, 12, 'Nattarampotha', 'නට්ටාරම්පොත', 'நாட்டரம்பொத', NULL, NULL, NULL, '20194', '7.28083760', '80.67291850'),
(988, 12, 'Nelundeniya', 'නෙලුන්දෙනිය', 'நெலுந்தெனிய', NULL, NULL, NULL, '71060', '7.23084430', '80.26001000'),
(989, 12, 'Niyadurupola', 'නියදුරුපොළ', 'நியதுருபொல', NULL, NULL, NULL, '71602', '7.16751890', '80.21840250'),
(990, 12, 'Noori', 'නූරි', 'நூரி', NULL, NULL, NULL, '71407', '6.94485410', '80.40274360'),
(991, 12, 'Pannila', 'පන්නිල', 'பன்னிலா', NULL, NULL, NULL, '12114', '6.86839660', '80.32409600'),
(992, 12, 'Pattampitiya', 'පට්ටම්පිටිය', 'பட்டம்பிட்டிய', NULL, NULL, NULL, '71130', '7.31182390', '80.43534990'),
(993, 12, 'Pilawala', 'පිලවල', 'பிலாவல', NULL, NULL, NULL, '20196', '7.30149520', '80.38674170'),
(994, 12, 'Pothukoladeniya', 'පොතුකොලදෙණිය', 'பொதுகொலதெனிய', NULL, NULL, NULL, '71039', '7.16747710', '80.31504330'),
(995, 12, 'Puswelitenna', 'පුස්වැලිතැන්න', 'புஸ்வெலிதென்ன', NULL, NULL, NULL, '60072', '7.25081670', '80.37145700'),
(996, 12, 'Rambukkana', 'රඹුක්කන', 'ரம்புக்கன', NULL, NULL, NULL, '71100', '7.27922720', '80.38338030'),
(997, 12, 'Rilpola', 'රිල්පොල', 'ரில்பொல', NULL, NULL, NULL, '90026', '6.95461930', '81.06456800'),
(998, 12, 'Rukmale', 'රුක්මලේ', 'ருக்மலே', NULL, NULL, NULL, '11129', '6.85246830', '79.98034150'),
(999, 12, 'Ruwanwella', 'රුවන්වැල්ල', 'ருவன்வெல்ல', NULL, NULL, NULL, '71300', '7.04587350', '80.25370630'),
(1000, 12, 'Samanalawewa', 'සමනලවැව', 'சமனலவெவ', NULL, NULL, NULL, '70142', '6.67500500', '80.78655580'),
(1001, 12, 'Seaforth Colony', 'සීෆෝර්ත් ජනපදය', 'சீஃபோர்த் காலனி', NULL, NULL, NULL, '71708', '7.25133170', '80.34637540'),
(1002, 5, 'Colombo 2', 'කොළඹ 2', 'கொழும்பு 2', 'Slave Island', 'කොම්පඤ්ඤ වීදිය', 'கொம்பனித்தெரு', '00200', '6.91993310', '79.85402740'),
(1003, 12, 'Spring Valley', 'වසන්ත නිම්නය', 'வசந்த பள்ளத்தாக்கு', NULL, NULL, NULL, '90028', '7.25133170', '80.34637540'),
(1004, 12, 'Talgaspitiya', 'තල්ගස්පිටිය', 'தல்கஸ்பிட்டிய', NULL, NULL, NULL, '71541', '7.17379560', '80.47655430'),
(1005, 12, 'Teligama', 'තෙලිගම', 'தெலிகம', NULL, NULL, NULL, '71724', '7.25133170', '80.34637540'),
(1006, 12, 'Tholangamuwa', 'තෝලංගමුව', 'தோலங்கமுவா', NULL, NULL, NULL, '71619', '7.23781070', '80.23554680'),
(1007, 12, 'Thotawella', 'තොටවැල්ල', 'தொட்டவெல்ல', NULL, NULL, NULL, '71106', '7.23639400', '80.31495500'),
(1008, 12, 'Udaha Hawupe', 'උඩහ හවුපේ', 'உடஹா ஹவுபே', NULL, NULL, NULL, '70154', '7.25133170', '80.34637540'),
(1009, 12, 'Udapotha', 'උඩපොත', 'உடபோத', NULL, NULL, NULL, '71236', '7.09758690', '80.37421630'),
(1010, 12, 'Uduwa', 'උඩුව', 'உடுவா', NULL, NULL, NULL, '20052', '7.10856680', '80.39091640'),
(1011, 12, 'Undugoda', 'උඳුගොඩ', 'உண்டுகொட', NULL, NULL, NULL, '71200', '7.13977700', '80.35751280'),
(1012, 12, 'Ussapitiya', 'උස්සපිටිය', 'உஸ்ஸபிட்டிய', NULL, NULL, NULL, '71510', '7.21616020', '80.44655940'),
(1013, 12, 'Wahakula', 'වහකුල', 'வஹாகுல', NULL, NULL, NULL, '71303', '7.06751980', '80.20703280'),
(1014, 12, 'Waharaka', 'වහරක', 'வஹரக', NULL, NULL, NULL, '71304', '7.07946370', '80.19883930'),
(1015, 12, 'Wanaluwewa', 'වනළුවැව', 'வானலுவெவ', NULL, NULL, NULL, '11068', '7.25133170', '80.34637540'),
(1016, 12, 'Warakapola', 'වරකාපොල', 'வரகாபொல', NULL, NULL, NULL, '71600', '7.22680330', '80.19587550'),
(1017, 12, 'Watura', 'වතුර', 'வடுரா', NULL, NULL, NULL, '71035', '7.25133170', '80.34637540'),
(1018, 12, 'Weeoya', 'වී ඔය', 'வீோய', NULL, NULL, NULL, '71702', '7.06322130', '80.33571390'),
(1019, 12, 'Wegalla', 'වෑගල්ල', 'வேகல்லா', NULL, NULL, NULL, '71234', '7.25133170', '80.34637540'),
(1020, 12, 'Weligalla', 'වැලිගල්ල', 'வெலிகல்ல', NULL, NULL, NULL, '20610', '7.18887650', '80.59140380'),
(1021, 12, 'Welihelatenna', 'වැලිහෙලතැන්න', 'வெலிஹெலதென்ன', NULL, NULL, NULL, '71712', '7.28311710', '80.38454330'),
(1022, 12, 'Wewelwatta', 'වේවැල්වත්ත', 'வேவெல்வத்த', NULL, NULL, NULL, '70066', '6.70526590', '80.47610540'),
(1023, 12, 'Yatagama', 'යටගම', 'யதகம', NULL, NULL, NULL, '71116', '7.33010560', '80.35784920'),
(1024, 12, 'Yatapana', 'යටපාන', 'யதபன', NULL, NULL, NULL, '71326', '7.13158740', '80.30756390'),
(1025, 12, 'Yatiyantota', 'යටියන්තොට', 'யாட்டியாந்தோட்டை', NULL, NULL, NULL, '71700', '7.02888240', '80.29554190'),
(1026, 12, 'Yattogoda', 'යට්ටෝගොඩ', 'யட்டோகொட', NULL, NULL, NULL, '71029', '7.24433740', '80.26837180'),
(1027, 13, 'Kandavalai', 'කණ්ඩාවලයි', 'கண்டாவளை', NULL, NULL, NULL, '42508', '9.40909980', '80.52186610'),
(1028, 13, 'Karachchi', 'කරච්චි', 'கராச்சி', NULL, NULL, NULL, NULL, '9.38352270', '80.40840650'),
(1029, 13, 'Kilinochchi', 'කිළිනොච්චි', 'கிளிநொச்சி', NULL, NULL, NULL, '42400', '9.38028860', '80.37699990'),
(1030, 13, 'Pachchilaipalli', 'පච්චිලෙයිපල්ලි', 'பச்சிலைப்பள்ளி', NULL, NULL, NULL, '42550', '9.56732280', '80.38813330'),
(1031, 13, 'Poonakary', 'පූනකරි', 'பூநகரி', NULL, NULL, NULL, '42600', '9.50331090', '80.21121640'),
(1032, 11, 'Akurana', 'අකුරණ', 'அக்குரணை', NULL, NULL, NULL, '20850', '7.36889590', '80.61312250'),
(1033, 14, 'Alahengama', 'අලහෙන්ගම', 'அலஹெங்கம', NULL, NULL, NULL, '60416', '7.48176950', '80.36088760'),
(1034, 14, 'Alahitiyawa', 'අලහිටියාව', 'அலஹிதியாவ', NULL, NULL, NULL, '60182', '7.46205090', '80.04371230'),
(1035, 14, 'Ambakote', 'අඹකොටේ', 'அம்பாகோட்', NULL, NULL, NULL, '60036', '7.49394280', '80.45768350'),
(1036, 14, 'Ambanpola', 'අඹන්පොල', 'அம்பன்பொல', NULL, NULL, NULL, '60650', '7.91811440', '80.24049590'),
(1037, 14, 'Andiyagala', 'ආඬියාගල', 'ஆண்டியகல', NULL, NULL, NULL, '50112', '7.46666710', '80.13333290'),
(1038, 14, 'Anukkane', 'අනුක්කනේ', 'அனுக்கனே', NULL, NULL, NULL, '60214', '7.50258040', '80.12331750'),
(1039, 14, 'Aragoda', 'අරංගොඩ', 'அரகோடா', NULL, NULL, NULL, '60308', '7.36467220', '80.34776760'),
(1040, 14, 'Ataragalla', 'අටරගල්ල', 'அதரகல்ல', NULL, NULL, NULL, '60706', '7.91804160', '80.29484530'),
(1041, 14, 'Awulegama', 'අවුලේගම', 'அவுலேகம', NULL, NULL, NULL, '60462', '7.48176950', '80.36088760'),
(1042, 14, 'Balalla', 'බලල්ල', 'பலல்லா', NULL, NULL, NULL, '60604', '7.80709260', '80.25426980'),
(1043, 14, 'Bamunukotuwa', 'බමුණකොටුව', 'பமுனாகொடுவ', NULL, NULL, NULL, '60347', '7.57088740', '80.24746570'),
(1044, 14, 'Bandara Koswatta', 'බන්ඩාර කොස්වත්ත', 'பண்டார கொஸ்வத்த', NULL, NULL, NULL, '60424', '7.61207120', '80.17495160'),
(1045, 14, 'Bingiriya', 'බින්ගිරිය', 'பிங்கிரிய', NULL, NULL, NULL, '60450', '7.59822340', '79.93721900'),
(1046, 14, 'Bogamulla', 'බෝගමුල්ල', 'போகமுல்ல', NULL, NULL, NULL, '60107', '7.45722470', '80.16797990'),
(1047, 14, 'Boraluwewa', 'බොරළුවැව', 'பொரலுவெவ', NULL, NULL, NULL, '60437', '7.68506230', '80.04476020'),
(1048, 14, 'Boyagane', 'බෝයගානෙ', 'போயாகனே', NULL, NULL, NULL, '60027', '7.44999300', '80.34219840'),
(1049, 14, 'Bujjomuwa', 'බුජ්ජෝමුව', 'புஜ்ஜோமுவா', NULL, NULL, NULL, '60291', '7.27361380', '80.20563820'),
(1050, 14, 'Buluwala', 'බුලුවල', 'புலுவலா', NULL, NULL, NULL, '60076', '7.48041800', '80.47330290'),
(1051, 14, 'Dadayamtalawa', 'දඩයම්තලාව', 'ததயம்தலவ', NULL, NULL, NULL, '32046', '7.48176950', '80.36088760'),
(1052, 14, 'Dambadeniya', 'දඹදෙණිය', 'தம்பதெனிய', NULL, NULL, NULL, '60130', '7.36971470', '80.15123170'),
(1053, 14, 'Daraluwa', 'දරලුව', 'தரலுவ', NULL, NULL, NULL, '60174', '7.35531880', '79.98361080'),
(1054, 14, 'Deegalla', 'දීගල්ල', 'டீகல்லா', NULL, NULL, NULL, '60228', '7.51124380', '80.03393120'),
(1055, 14, 'Demataluwa', 'දෙමටලුව', 'தெமதலுவ', NULL, NULL, NULL, '60024', '7.51786650', '80.28797560'),
(1056, 14, 'Demuwatha', 'දෙමුවත', 'தேமுவாத', NULL, NULL, NULL, '70332', '7.48684730', '80.36514920'),
(1057, 14, 'Diddeniya', 'දෙණියාය', 'தித்தெனிய', NULL, NULL, NULL, '60544', '7.69904850', '80.46050360'),
(1058, 14, 'Digannewa', 'දිගන්නෑව', 'திகன்னேவா', NULL, NULL, NULL, '60485', '7.89331550', '80.10097960'),
(1059, 14, 'Divullegoda', 'දිවුලේගොඩ', 'திவுல்லேகொட', NULL, NULL, NULL, '60472', '7.76266490', '80.20163350'),
(1060, 14, 'Diyasenpura', 'දියසෙන්පුර', 'தியசென்புர', NULL, NULL, NULL, '51504', '8.13236550', '81.02059850'),
(1061, 14, 'Dodangaslanda', 'දොඩන්ගස්ලන්ද', 'தொடங்கஸ்லாண்டா', NULL, NULL, NULL, '60530', '7.57567740', '80.52439700'),
(1062, 14, 'Doluwa', 'දොළුව', 'டோலுவா', NULL, NULL, NULL, '20532', '7.62156470', '80.41874250'),
(1063, 14, 'Doragamuwa', 'දොරගමුව', 'தொரகமுவா', NULL, NULL, NULL, '20816', '7.36589550', '80.65627530'),
(1064, 14, 'Doratiyawa', 'දොරටියාව', 'தொரட்டியவா', NULL, NULL, NULL, '60013', '7.45346260', '80.39404730'),
(1065, 14, 'Dunumadalawa', 'දුනුමඩවල', 'துனுமடலாவ', NULL, NULL, NULL, '50214', '7.28090960', '80.64222390'),
(1066, 14, 'Dunuwilapitiya', 'දුනුවිලපිටිය', 'துனுவிலப்பிட்டிய', NULL, NULL, NULL, '21538', '7.48176950', '80.36088760'),
(1067, 14, 'Ehetuwewa', 'ඇහැටුවැව', 'எஹடுவெவ', NULL, NULL, NULL, '60716', '7.93567610', '80.34618760'),
(1068, 14, 'Elibichchiya', 'ඇලිබිච්චිය', 'எலிபிச்சியா', NULL, NULL, NULL, '60156', '7.31429910', '80.05628640'),
(1069, 14, 'Embogama', 'එම්බෝගම', 'எம்போகம', NULL, NULL, NULL, '60718', '7.82330090', '80.32409600'),
(1070, 14, 'Etungahakotuwa', 'ඇතුන්ගහකොටුව', 'எதுங்கஹகொடுவ', NULL, NULL, NULL, '60266', '7.51223530', '79.96770490'),
(1071, 14, 'Galadivulwewa', 'ගලදිවුල්වැව', 'கலாடிவுல்வெவ', NULL, NULL, NULL, '50210', '7.48176950', '80.36088760'),
(1072, 14, 'Galgamuwa', 'ගල්ගමුව', 'கல்கமுவ', NULL, NULL, NULL, '60700', '7.98649440', '80.28787940'),
(1073, 14, 'Gallellagama', 'ගල්ලෑල්ලගම', 'கல்லெல்லாகம', NULL, NULL, NULL, '20095', '7.48176950', '80.36088760'),
(1074, 14, 'Gallewa', 'ගල්ලෑව', 'கல்லேவா', NULL, NULL, NULL, '60712', '7.88701170', '80.06187430'),
(1075, 14, 'Ganegoda', 'ගණේගොඩ', 'கணேகொட', NULL, NULL, NULL, '80440', '7.63326800', '80.46324500'),
(1076, 14, 'Girathalana', 'ගිරාතලන', 'கிராதலான', NULL, NULL, NULL, '60752', '8.03476110', '80.41037760'),
(1077, 14, 'Gokaralla', 'ගොකරුල්ල', 'கோகரல்லா', NULL, NULL, NULL, '60522', '7.59886850', '80.48270740'),
(1078, 14, 'Gonawila', 'ගොනාවිල', 'கோனாவில', NULL, NULL, NULL, '60170', '7.39880630', '80.20005960'),
(1079, 14, 'Halmillawewa', 'හල්මිල්ලවැව', 'ஹல்மில்லவெவ', NULL, NULL, NULL, '60441', '7.77075630', '80.49382670'),
(1080, 14, 'Handungamuwa', 'හඳුන්ගමුව', 'ஹந்துங்கமுவ', NULL, NULL, NULL, '21536', '7.48176950', '80.36088760'),
(1081, 14, 'Harankahawa', 'හරන්කහව', 'ஹரன்காவா', NULL, NULL, NULL, '20092', '7.48176950', '80.36088760'),
(1082, 14, 'Helamada', 'හෙළමඩය', 'ஹெலமடா', NULL, NULL, NULL, '71046', '7.48176950', '80.36088760'),
(1083, 14, 'Hengamuwa', 'හේන්ගමුව', 'ஹெங்கமுவ', NULL, NULL, NULL, '60414', '7.70035780', '80.11214930'),
(1084, 14, 'Hettipola', 'හෙට්ටිපොල', 'ஹெட்டிபொல', NULL, NULL, NULL, '60430', '7.53311240', '80.91524340'),
(1085, 14, 'Hewainna', 'හේවායින්න', 'ஹெவைன்னா', NULL, NULL, NULL, '10714', '6.89755820', '80.19587550'),
(1086, 14, 'Hilogama', 'හිලෝගම', 'ஹிலோகமா', NULL, NULL, NULL, '60486', '7.48176950', '80.36088760'),
(1087, 14, 'Hindagolla', 'හිඳගොල්ල', 'ஹிந்தகொல்ல', NULL, NULL, NULL, '60034', '7.48667050', '80.41607830'),
(1088, 14, 'Hiriyala Lenawa', 'හිරියාල ලේනාව', 'ஹிரியால லெனாவா', NULL, NULL, NULL, '60546', '7.63887370', '80.47436690'),
(1089, 14, 'Hiruwalpola', 'හිරුවල්පොල', 'ஹிருவல்பொல', NULL, NULL, NULL, '60458', '7.54778030', '79.93745820'),
(1090, 14, 'Horambawa', 'හොරඹාව', 'ஹொரம்பாவா', NULL, NULL, NULL, '60181', '7.45722470', '80.16797990'),
(1091, 14, 'Hulogedara', 'හුලොගෙදර', 'ஹுலோகெதர', NULL, NULL, NULL, '60474', '7.78954430', '80.19081820'),
(1092, 14, 'Hulugalla', 'හුළුගල්ල', 'ஹுலுகல்ல', NULL, NULL, NULL, '60477', '7.59243750', '80.57995310'),
(1093, 14, 'Ihala Gomugomuwa', 'ඉහළ ගොමුගොමුව', 'இஹல கோமுகோமுவ', NULL, NULL, NULL, '60211', '7.47038950', '80.04532310'),
(1094, 14, 'Ihala Katugampala', 'ඉහළ කටුගම්පල', 'இஹல கடுகம்பலா', NULL, NULL, NULL, '60135', '7.39470370', '80.09875050'),
(1095, 14, 'Indulgodakanda', 'ඉඳුල්ගොඩකන්ද', 'இந்துல்கொடகந்த', NULL, NULL, NULL, '60016', '7.42336680', '80.40761320'),
(1096, 14, 'Ithanawatta', 'ඉතනවත්ත', 'இதனவத்த', NULL, NULL, NULL, '60025', '7.48176950', '80.36088760'),
(1097, 14, 'Kadigawa', 'කඩිගාව', 'கடிகாவா', NULL, NULL, NULL, '60492', '7.71919830', '80.00071420'),
(1098, 14, 'Kalankuttiya', 'කලංකුට්ටිය', 'கலங்குட்டிய', NULL, NULL, NULL, '50174', '7.48684730', '80.36514920'),
(1099, 14, 'Kalatuwawa', 'කලටුවාව', 'கலதுவாவ', NULL, NULL, NULL, '10718', '6.85000000', '80.20000000'),
(1100, 14, 'Kalugamuwa', 'කළුගමුව', 'களுகமுவ', NULL, NULL, NULL, '60096', '7.39215900', '80.44655940'),
(1101, 14, 'Kanadeniyawala', 'කනදෙණියවල', 'கனதெனியாவல', NULL, NULL, NULL, '60054', '7.43813990', '80.53393440'),
(1102, 14, 'Kanattewewa', 'කනත්තවැව', 'கனத்தவெவ', NULL, NULL, NULL, '60422', '7.61852160', '80.20703290'),
(1103, 14, 'Kandegedara', 'කන්දේගෙදර', 'கண்டேகெதர', NULL, NULL, NULL, '90070', '7.35295450', '80.20773000'),
(1104, 14, 'Karagahagedara', 'කරගහගෙදර', 'கரகஹகெதர', NULL, NULL, NULL, '60106', '7.47785930', '80.21261090'),
(1105, 14, 'Karambe', 'කරඹේ', 'கரம்பே', NULL, NULL, NULL, '60602', '7.80756910', '80.34080610'),
(1106, 14, 'Katiyawa', 'කටියාව', 'கடியாவா', NULL, NULL, NULL, '50261', '7.62687380', '80.55012180'),
(1107, 14, 'Katupota', 'කටුපොත', 'கடுப்போட', NULL, NULL, NULL, '60350', '7.55053450', '80.19086420'),
(1108, 14, 'Kawudulla', 'කවුඩුල්ල', 'கவுடுல்லா', NULL, NULL, NULL, '51414', '8.16101810', '80.91386260'),
(1109, 14, 'Kawuduluwewa Stagell', 'කවුඩුළුවැව ස්ටැගල්', 'கவுடுலுவெவ ஸ்டேகல்', NULL, NULL, NULL, '51514', '7.48176950', '80.36088760'),
(1110, 14, 'Kekunagolla', 'කැකුනගොල්ල', 'கெகுனகொல்ல', NULL, NULL, NULL, '60183', '7.49836470', '80.17355650'),
(1111, 14, 'Keppitiwalana', 'කැප්පෙටිවලාන', 'கெப்பிட்டிவலனா', NULL, NULL, NULL, '60288', '7.32257710', '80.19029630'),
(1112, 14, 'Kimbulwanaoya', 'කිඹුල්වානඔය', 'கிம்புல்வானாஓயா', NULL, NULL, NULL, '60548', '7.48176950', '80.36088760'),
(1113, 14, 'Kirimetiyawa', 'කිරිමැටියාව', 'கிரிமெத்தியாவ', NULL, NULL, NULL, '60184', '7.51234310', '80.14146270'),
(1114, 14, 'Kirindawa', 'කිරින්දෑව', 'கிரிந்தாவா', NULL, NULL, NULL, '60212', '7.49673230', '80.10097960'),
(1115, 14, 'Kirindigalla', 'කිරිඳිගොල්ල', 'கிரிண்டிகல்ல', NULL, NULL, NULL, '60502', '7.55328810', '80.47992730'),
(1116, 14, 'Kithalawa', 'කිතලෑව', 'கிதலாவ', NULL, NULL, NULL, '60188', '7.45933590', '80.10097960'),
(1117, 14, 'Kitulwala', 'කිතුල්වල', 'கித்துல்வல', NULL, NULL, NULL, '11242', '7.50632780', '80.53551070'),
(1118, 14, 'Kobeigane', 'කොබෙයිගනේ', 'கொபெய்கனே', NULL, NULL, NULL, '60410', '7.66057680', '80.12661590'),
(1119, 14, 'Kohilagedara', 'කොහිලගෙදර', 'கோஹிலகெதர', NULL, NULL, NULL, '60028', '7.40586090', '80.33853900'),
(1120, 14, 'Konwewa', 'කොන්වැව', 'கான்வேவா', NULL, NULL, NULL, '60630', '7.98498420', '80.28091290'),
(1121, 14, 'Kosdeniya', 'කොස්දෙනිය', 'கொஸ்தெனிய', NULL, NULL, NULL, '60356', '7.57260270', '80.14564960'),
(1122, 14, 'Kosgolla', 'කොස්ගල', 'கொஸ்கொல்ல', NULL, NULL, NULL, '60029', '7.40101800', '80.39300370'),
(1123, 14, 'Kotagala', 'කොටගල', 'கொட்டகலை', NULL, NULL, NULL, '22080', '6.92968060', '80.60493740'),
(1124, 5, 'Colombo 13', 'කොළඹ 13', 'கொழும்பு 13', 'Kotahena', 'කොටහේන', 'கொட்டாஞ்சேனை', '01300', '6.94876640', '79.86048310'),
(1125, 14, 'Kotawehera', 'කොටවෙහෙර', 'கொடவெஹர', NULL, NULL, NULL, '60483', '7.80900070', '80.07797730'),
(1126, 14, 'Kudagalgamuwa', 'කුඩාගල්ගමුව', 'குடகல்கமுவ', NULL, NULL, NULL, '60003', '7.55700800', '80.34498310'),
(1127, 14, 'Kudakatnoruwa', 'කුඩාකට්නෝරුව', 'குடகத்னொறுவ', NULL, NULL, NULL, '60754', '7.48176950', '80.36088760'),
(1128, 14, 'Kuliyapitiya', 'කුලියාපිටිය', 'குளியபிட்டிய', NULL, NULL, NULL, '60200', '7.47212300', '80.04462210'),
(1129, 14, 'Kumaragama', 'කුමාරගම', 'குமாரகம', NULL, NULL, NULL, '51412', '7.48176950', '80.36088760'),
(1130, 14, 'Kumbukgeta', 'කුඹුක්ගැට', 'கும்பக்கேடா', NULL, NULL, NULL, '60508', '7.67242180', '80.41596030'),
(1131, 14, 'Kumbukwewa', 'කුඹුක්වැව', 'கும்பக்வெவ', NULL, NULL, NULL, '60506', '7.64050560', '80.42708850'),
(1132, 14, 'Kuratihena', 'කුරටිහේන', 'குறடிஹேன', NULL, NULL, NULL, '60438', '7.48176950', '80.36088760'),
(1133, 14, 'Kurunegala', 'කුරුණෑගල', 'குருநாகல்', NULL, NULL, NULL, '60000', '7.49483690', '80.37838420'),
(1134, 14, 'Ibbagamuwa', 'ඉබ්බාගමුව', 'இப்பாகமுவ', NULL, NULL, NULL, '60500', '7.55541010', '80.45644300'),
(1135, 14, 'Ihala Kadigamuwa', 'ඉහළ කඩිගමුව', 'இஹல கடிகமுவ', NULL, NULL, NULL, '60238', '7.44155470', '80.02275140'),
(1136, 14, 'Lihiriyagama', 'ලිහිරියාගම', 'லிஹிரியாகம', NULL, NULL, NULL, '61138', '7.34755590', '79.93466030'),
(1137, 14, 'Illagolla', 'ඉල්ලගොල්ල', 'இல்லகொல்ல', NULL, NULL, NULL, '20724', '7.16736970', '80.81733640'),
(1138, 14, 'Ilukhena', 'ඉලුක්හේන', 'இலுகென', NULL, NULL, NULL, '60232', '7.53042710', '80.00225670'),
(1139, 14, 'Lonahettiya', 'ලෝනහෙට්ටිය', 'லோனஹெட்டிய', NULL, NULL, NULL, '60108', '7.51154710', '80.22516030'),
(1140, 14, 'Madahapola', 'මඩහපොල', 'மதஹபொல', NULL, NULL, NULL, '60552', '7.45051990', '80.19433970'),
(1141, 14, 'Madakumburumulla', 'මඩකුඹුරුමුල්ල', 'மடகும்புருமுல்ல', NULL, NULL, NULL, '60209', '7.44626040', '79.99479560'),
(1142, 14, 'Madalagama', 'මඩලගම', 'மதலகம', NULL, NULL, NULL, '70158', '7.34316800', '80.30947190'),
(1143, 14, 'Madawala Ulpotha', 'මඩවල උල්පොත', 'மடவல உல்பொத', NULL, NULL, NULL, '21074', '7.61559830', '80.63546650'),
(1144, 14, 'Maduragoda', 'මදුරගොඩ', 'மதுரகோட', NULL, NULL, NULL, '60532', '7.57638020', '80.54930710'),
(1145, 14, 'Maeliya', 'මාඑලිය', 'மாலியா', NULL, NULL, NULL, '60512', '7.74752840', '80.41596030'),
(1146, 14, 'Magulagama', 'මගුලාගම', 'மகுலகம', NULL, NULL, NULL, '60221', '7.67063750', '80.21818860'),
(1147, 14, 'Maha Ambagaswewa', 'මහ අඹගස්වැව', 'மஹா அம்பகஸ்வெவ', NULL, NULL, NULL, '51518', '8.20978530', '81.03532020'),
(1148, 14, 'Mahagalkadawala', 'මහගල්කඩවල', 'மஹகல்கடவல', NULL, NULL, NULL, '60731', '8.05639110', '80.28230630'),
(1149, 14, 'Mahagirilla', 'මහගිරිල්ල', 'மஹாகிரில்லா', NULL, NULL, NULL, '60479', '7.82923540', '80.13752990'),
(1150, 14, 'Mahamukalanyaya', 'මහාමුකලන්යාය', 'மஹாமுகாலந்யாய', NULL, NULL, NULL, '60516', '7.56265260', '80.41874250'),
(1151, 14, 'Mahananneriya', 'මහනන්නේරිය', 'மகாநன்னெரியா', NULL, NULL, NULL, '60724', '8.00158110', '80.18611160'),
(1152, 14, 'Mahapallegama', 'මහපල්ලේගම', 'மஹாபல்லேகம', NULL, NULL, NULL, '71063', '7.09995240', '80.20777840'),
(1153, 14, 'Maharachchimulla', 'මහරච්චිමුල්ල', 'மஹராச்சிமுல்ல', NULL, NULL, NULL, '60286', '7.34960560', '80.20703280'),
(1154, 14, 'Mahatalakolawewa', 'මහතලාකොළවැව', 'மஹாதலகொலவெவ', NULL, NULL, NULL, '51506', '7.48176950', '80.36088760'),
(1155, 14, 'Mahawewa', 'මහවැව', 'மஹவெவ', NULL, NULL, NULL, '61220', '7.45980540', '79.82631690'),
(1156, 14, 'Maho', 'මහව', 'மாகோ', NULL, NULL, NULL, '60600', '7.81939470', '80.27115880'),
(1157, 14, 'Makulewa', 'මකුලෑව', 'மகுலேவா', NULL, NULL, NULL, '60714', '7.99594590', '80.34637540'),
(1158, 14, 'Makulpotha', 'මකුල්පොත', 'மகுல்பொத', NULL, NULL, NULL, '60514', '7.74416030', '80.44516870'),
(1159, 14, 'Makulwewa', 'මකුල්වැව', 'மகுல்வெவா', NULL, NULL, NULL, '60578', '7.60961260', '80.36308100'),
(1160, 14, 'Malagane', 'මලගනේ', 'மலகனே', NULL, NULL, NULL, '60404', '7.59398170', '80.07130310'),
(1161, 14, 'Mandapola', 'මණ්ඩපොල', 'மண்டபொல', NULL, NULL, NULL, '60434', '7.63594130', '80.10656460'),
(1162, 14, 'Maspotha', 'මාස්පොත', 'மாஸ்பொத', NULL, NULL, NULL, '60344', '7.48176950', '80.36088760'),
(1163, 14, 'Mawathagama', 'මාවතගම', 'மாவத்தகம', NULL, NULL, NULL, '60060', '7.43690130', '80.45378280'),
(1164, 14, 'Medirigiriya', 'මැදිරිගිරිය', 'மெதிரிகிரிய', NULL, NULL, NULL, '51500', '8.13963740', '80.96776580'),
(1165, 14, 'Medivawa', 'මැදිවාව', 'மெடிவாவா', NULL, NULL, NULL, '60612', '7.48176950', '80.36088760'),
(1166, 14, 'Meegalawa', 'මීගලෑව', 'மீகலாவ', NULL, NULL, NULL, '60750', '8.05271540', '80.35472860'),
(1167, 14, 'Meegaswewa', 'මීගස්වැව', 'மீகஸ்வெவ', NULL, NULL, NULL, '51508', '7.80296150', '80.37421630'),
(1168, 14, 'Meewellawa', 'මීවැල්ලව', 'மீவெல்லவ', NULL, NULL, NULL, '60484', '7.75060980', '80.11601730'),
(1169, 14, 'Melsiripura', 'මැල්සිරිපුර', 'மெல்சிரிபுர', NULL, NULL, NULL, '60540', '7.64497060', '80.50772370'),
(1170, 14, 'Metikumbura', 'මැටිකුඹුර', 'மெட்டிகும்புரா', NULL, NULL, NULL, '60304', '7.48176950', '80.36088760'),
(1171, 14, 'Metiyagane', 'මැටියගනේ', 'மெத்தியகனே', NULL, NULL, NULL, '60121', '7.39476490', '80.19034420'),
(1172, 14, 'Minhettiya', 'මින්හෙට්ටිය', 'மின்ஹெட்டிய', NULL, NULL, NULL, '60004', '7.58897270', '80.30807900'),
(1173, 14, 'Minuwangete', 'මිනුවන්ගැටේ', 'மினுவாங்கேட்', NULL, NULL, NULL, '60406', '7.50721880', '80.34290880'),
(1174, 14, 'Mirihanagama', 'මිරිහානගම', 'மிரிஹானகம', NULL, NULL, NULL, '60408', '7.65329280', '80.17981590'),
(1175, 14, 'Monnekulama', 'මොන්නේකුලම', 'மொன்னேகுலம', NULL, NULL, NULL, '60495', '7.82255920', '80.06187430'),
(1176, 14, 'Moragane', 'මොරගනේ ය', 'மொரகனே', NULL, NULL, NULL, '60354', '7.54678230', '80.12750520'),
(1177, 14, 'Moragollagama', 'මොරගොල්ලාගම', 'மொரகொல்லாகம', NULL, NULL, NULL, '60640', '7.90662950', '80.44099670'),
(1178, 14, 'Morathiha', 'මොරටිහ', 'மொராதிஹா', NULL, NULL, NULL, '60038', '7.51071560', '80.49104700'),
(1179, 14, 'Munamaldeniya', 'මුණමල්දෙණිය', 'முனமல்தெனிய', NULL, NULL, NULL, '60218', '7.54786830', '80.05768340'),
(1180, 14, 'Muruthenge', 'මුරුතැන්ගේ', 'முருத்தேங்கே', NULL, NULL, NULL, '60122', '7.43761610', '80.14435980'),
(1181, 14, 'Mutugala', 'මුතුගල', 'முதுகல', NULL, NULL, NULL, '51064', '7.48818930', '80.35037220'),
(1182, 14, 'Nabadewa', 'නබදේව', 'நபதேவா', NULL, NULL, NULL, '60482', '7.78161690', '80.10423790'),
(1183, 14, 'Nagollagama', 'නාගොල්ලාගම', 'நாகொல்லாகம', NULL, NULL, NULL, '60590', '7.75351680', '80.31467200'),
(1184, 14, 'Nagollagoda', 'නාගොල්ලාගොඩ', 'நாகொல்லாகொட', NULL, NULL, NULL, '60226', '7.56352800', '80.04091780'),
(1185, 14, 'Nakkawatta', 'නක්කාවත්ත', 'நக்கவத்த', NULL, NULL, NULL, '60186', '7.44431430', '80.14564960'),
(1186, 14, 'Narammala', 'නාරම්මල', 'நாரம்மல', NULL, NULL, NULL, '60100', '7.43251330', '80.21539980'),
(1187, 14, 'Nawasenapura', 'නවසේනපුර', 'நவசேனபுர', NULL, NULL, NULL, '51066', '7.48176950', '80.36088760'),
(1188, 14, 'Nawatalwatta', 'නවතල්වත්ත', 'நவத்தல்வத்த', NULL, NULL, NULL, '60292', '7.28334030', '80.19236990'),
(1189, 14, 'Nelliya', 'නෙල්ලිය', 'நெல்லியா', NULL, NULL, NULL, '60549', '7.69224710', '80.46324500'),
(1190, 14, 'Nikaweratiya', 'නිකවැරටිය', 'நிக்கவெரட்டிய', NULL, NULL, NULL, '60470', '7.75544500', '80.11914020'),
(1191, 14, 'Nugagolla', 'නුගගොල්ල', 'நுககொல்ல', NULL, NULL, NULL, '21534', '7.48176950', '80.36088760'),
(1192, 14, 'Nugawela', 'නුගවෙල', 'நுகவெல', NULL, NULL, NULL, '20072', '7.33397190', '80.22376600'),
(1193, 14, 'Padeniya', 'පාදෙණිය', 'பதெனிய', NULL, NULL, NULL, '60461', '7.65562250', '80.22062870'),
(1194, 14, 'Padiwela', 'පඩිවෙල', 'படிவெல', NULL, NULL, NULL, '60236', '7.54229040', '79.98920340'),
(1195, 14, 'Pahalagiribawa', 'පහළගිරිබාව', 'பஹலகிரிபாவா', NULL, NULL, NULL, '60735', '8.11756490', '80.19169110'),
(1196, 14, 'Pahamune', 'පහමුනේ', 'பஹமுனே', NULL, NULL, NULL, '60112', '7.48098480', '80.41225080'),
(1197, 14, 'Palagala', 'පලාගල', 'பலகல', NULL, NULL, NULL, '50111', '7.94746600', '80.52022900'),
(1198, 14, 'Palapathwela', 'පලාපත්වල', 'பலபத்வெல', NULL, NULL, NULL, '21070', '7.53773830', '80.62714150'),
(1199, 14, 'Palaviya', 'පලවිය', 'பாலவியா', NULL, NULL, NULL, '61280', '7.98124320', '79.84648040'),
(1200, 14, 'Pallewela', 'පල්ලෙවෙල', 'பல்லேவெல', NULL, NULL, NULL, '11150', '7.47829810', '79.99479560'),
(1201, 14, 'Palukadawala', 'පලුකඩවල', 'பலுகடவல', NULL, NULL, NULL, '60704', '7.95708350', '80.29623850'),
(1202, 14, 'Panadaragama', 'පානදරගම', 'பனதரகம', NULL, NULL, NULL, '60348', '7.54304430', '80.22864590'),
(1203, 14, 'Panagamuwa', 'පනාගමුව', 'பனகமுவ', NULL, NULL, NULL, '60052', '7.48991870', '80.51883960'),
(1204, 14, 'Panaliya', 'පැනලිය', 'பனாலியா', NULL, NULL, NULL, '60312', '7.33093560', '80.32966640'),
(1205, 14, 'Panapitiya', 'පනාපිටිය', 'பனாபிட்டிய', NULL, NULL, NULL, '70152', '7.48176950', '80.36088760'),
(1206, 14, 'Panliyadda', 'පන්ලියද්ද', 'பன்லியத்தா', NULL, NULL, NULL, '60558', '7.67263930', '80.54662290'),
(1207, 14, 'Pansiyagama', 'පන්සියගම', 'பன்சியாகம', NULL, NULL, NULL, '60554', '7.73521190', '80.49686610'),
(1208, 14, 'Parape', 'පරපේ', 'பராபே', NULL, NULL, NULL, '71105', '7.37257910', '80.41493250'),
(1209, 14, 'Pathanewatta', 'පතනේවත්ත', 'பதனேவத்த', NULL, NULL, NULL, '90071', '7.48176950', '80.36088760'),
(1210, 14, 'Pattiya Watta', 'පට්ටිය වත්ත', 'பட்டியா வட்டா', NULL, NULL, NULL, '20118', '7.48176950', '80.36088760'),
(1211, 14, 'Perakanatta', 'පෙරකනත්ත', 'பெரகனாட்டா', NULL, NULL, NULL, '21532', '7.48176950', '80.36088760'),
(1212, 14, 'Periyakadneluwa', 'පෙරියකඩ්නෙළුව', 'பெரியகத்நெலுவா', NULL, NULL, NULL, '60518', '7.48176950', '80.36088760'),
(1213, 14, 'Pihimbiya Ratmale', 'පිහිඹිය රත්මලේ', 'பிஹிம்பிய ரத்மலே', NULL, NULL, NULL, '60439', '7.57682140', '80.03313450'),
(1214, 14, 'Pihimbuwa', 'පිහිඹුව', 'பிஹிம்புவா', NULL, NULL, NULL, '60053', '7.45907940', '80.51467130'),
(1215, 14, 'Pilessa', 'පිලැස්ස', 'பிலேசா', NULL, NULL, NULL, '60058', '7.46154690', '80.41248240'),
(1216, 14, 'Polgahawela', 'පොල්ගහවෙල', 'பொல்காவெல', NULL, NULL, NULL, '60300', '7.32748660', '80.29345220'),
(1217, 14, 'Polgolla', 'පොල්ගොල්ල', 'பொல்கொல்ல', NULL, NULL, NULL, '20250', '7.31642280', '80.65211390'),
(1218, 14, 'Polpithigama', 'පොල්පිතිගම', 'பொல்பிதிகம', NULL, NULL, NULL, '60620', '7.82115110', '80.40622190'),
(1219, 14, 'Pothuhera', 'පොතුහැර', 'பொதுஹெர', NULL, NULL, NULL, '60330', '7.42167240', '80.32966640'),
(1220, 14, 'Pothupitiya', 'පොතුපිටිය', 'பொதுப்பிட்டிய', NULL, NULL, NULL, '70338', '7.35420460', '80.17355650'),
(1221, 14, 'Pujapitiya', 'පූජාපිටිය', 'பூஜாபிட்டிய', NULL, NULL, NULL, '20112', '7.49813340', '80.38431860'),
(1222, 14, 'Rakwana', 'රක්වාන', 'ரக்வானா', NULL, NULL, NULL, '70300', '6.46472370', '80.61604020'),
(1223, 14, 'Ranorawa', 'රනෝරාව', 'ரனோரவ', NULL, NULL, NULL, '50212', '7.60087940', '80.21261090'),
(1224, 14, 'Rathukohodigala', 'රතුකොහොඩිගල', 'ரதுகொஹொடிகல', NULL, NULL, NULL, '20818', '7.48176950', '80.36088760'),
(1225, 14, 'Ridibendiella', 'රිදිබැඳිඇල්ල', 'ரிடிபென்டீல்லா', NULL, NULL, NULL, '60606', '7.48176950', '80.36088760'),
(1226, 14, 'Ridigama', 'රිදීගම', 'ரிதிகம', NULL, NULL, NULL, '60040', '7.54963470', '80.49137540'),
(1227, 14, 'Saliya Asokapura', 'සාලිය අසෝකපුර', 'சாலிய அசோகபுர', NULL, NULL, NULL, '60736', '8.13469970', '80.18879360'),
(1228, 14, 'Sandalankawa', 'සඳලංකාව', 'சண்டலங்காவா', NULL, NULL, NULL, '60176', '7.31510150', '79.95957180'),
(1229, 14, 'Sevanapitiya', 'සෙවණපිටිය', 'செவனப்பிட்டிய', NULL, NULL, NULL, '51062', '7.48176950', '80.36088760'),
(1230, 14, 'Sirambiadiya', 'සිරම්බිඅඩිය', 'சீரம்பியாடியா', NULL, NULL, NULL, '61312', '8.05712610', '79.86888370'),
(1231, 14, 'Sirisetagama', 'සිරිසෙතගම', 'சிரிசெதகம', NULL, NULL, NULL, '60478', '7.48176950', '80.36088760'),
(1232, 14, 'Siyambalangamuwa', 'සියඹලන්ගමුව', 'சியம்பலங்காமுவ', NULL, NULL, NULL, '60646', '7.52948050', '80.34285300'),
(1233, 14, 'Siyambalawewa', 'සියඹලාවැව', 'சியம்பலாவெவ', NULL, NULL, NULL, '32048', '7.80422750', '80.42987040'),
(1234, 14, 'Solepura', 'සෝලේපුර', 'சோலேபுரா', NULL, NULL, NULL, '60737', '8.15312720', '80.15681340'),
(1235, 14, 'Solewewa', 'සෝලේවැව', 'சோலேவெவ', NULL, NULL, NULL, '60738', '8.14705210', '80.12890100'),
(1236, 14, 'Sunandapura', 'සුනන්දපුර', 'சுனந்தபுர', NULL, NULL, NULL, '60436', '7.63659560', '80.07235920'),
(1237, 14, 'Talawattegedara', 'තලවත්තේගෙදර', 'தலவத்தேகெதர', NULL, NULL, NULL, '60306', '7.48176950', '80.36088760'),
(1238, 14, 'Tambutta', 'තඹුට්ටා', 'தம்புட்டா', NULL, NULL, NULL, '60734', '8.08740100', '80.22655450'),
(1239, 14, 'Tennepanguwa', 'තැන්නේපංගුව', 'தென்னபங்குவா', NULL, NULL, NULL, '90072', '7.48176950', '80.36088760'),
(1240, 14, 'Thalahitimulla', 'තලහිටිමුල්ල', 'தலஹிதிமுல்லா', NULL, NULL, NULL, '60208', '7.43050010', '80.00597900'),
(1241, 14, 'Thalakolawewa', 'තලකොළවැව', 'தலகொலவெவ', NULL, NULL, NULL, '60624', '7.79492120', '80.43404290'),
(1242, 14, 'Thalwita', 'තල්විට', 'தல்விதா', NULL, NULL, NULL, '60572', '7.58221730', '80.33523640'),
(1243, 14, 'Tharana Udawela', 'තරණ උඩවෙල', 'தரன உடவெல', NULL, NULL, NULL, '60227', '7.56001430', '79.99410510'),
(1244, 14, 'Thimbiriyawa', 'තිඹිරියාව', 'திம்பிரியாவ', NULL, NULL, NULL, '60476', '7.74926250', '80.14006710'),
(1245, 14, 'Tisogama', 'තිසෝගම', 'திசோகம', NULL, NULL, NULL, '60453', '7.59055980', '79.83209660'),
(1246, 14, 'Thorayaya', 'තෝරයාය', 'தோராயய', NULL, NULL, NULL, '60499', '7.50874930', '80.40684690'),
(1247, 14, 'Tulhiriya', 'තුල්හිරිය', 'துல்ஹிரியா', NULL, NULL, NULL, '71610', '7.27533840', '80.22376600'),
(1248, 14, 'Tuntota', 'තුන්තොට', 'துந்தோட்டா', NULL, NULL, NULL, '71062', '7.19318910', '80.26506200'),
(1249, 14, 'Tuttiripitigama', 'තුත්තිරිපිටිගම', 'துத்திரிபிடிகம', NULL, NULL, NULL, '60426', '7.48176950', '80.36088760'),
(1250, 14, 'Udagaldeniya', 'උඩගල්දෙණිය', 'உடகல்தெனிய', NULL, NULL, NULL, '71113', '7.41747560', '80.47506200'),
(1251, 14, 'Udahingulwala', 'උඩහිඟුල්වල', 'உடஹிங்குல்வாலா', NULL, NULL, NULL, '20094', '7.48176950', '80.36088760'),
(1252, 14, 'Udawatta', 'උඩවත්ත', 'உடவத்த', NULL, NULL, NULL, '20722', '7.48949470', '80.36093070'),
(1253, 14, 'Udubaddawa', 'උඩුබද්දාව', 'உடுபத்தாவா', NULL, NULL, NULL, '60250', '7.48529250', '79.96753660'),
(1254, 14, 'Udumulla', 'උඩුමුල්ල', 'உடுமுல்லை', NULL, NULL, NULL, '71521', '7.46531670', '80.42056820'),
(1255, 14, 'Uhumiya', 'උහුමිය', 'உஹுமியா', NULL, NULL, NULL, '60094', '7.46392420', '80.29853450'),
(1256, 14, 'Ulpotha Pallekele', 'උල්පොත පල්ලෙකැලේ', 'உல்பொத பல்லேகல', NULL, NULL, NULL, '60622', '7.82652290', '80.43722130'),
(1257, 14, 'Ulpothagama', 'උල්පොතාගම', 'உல்போதகம', NULL, NULL, NULL, '20965', '7.48176950', '80.36088760'),
(1258, 14, 'Usgala Siyabmalangamuwa', 'උස්ගල සියබ්මලන්ගමුව', 'உஸ்கல சியப்மலங்கமுவ', NULL, NULL, NULL, '60732', '8.09826450', '80.29486960'),
(1259, 14, 'Vijithapura', 'විජිතපුර', 'விஜிதபுர', NULL, NULL, NULL, '50110', '7.48176950', '80.36088760'),
(1260, 14, 'Wadakada', 'වදාකඩ', 'வடகட', NULL, NULL, NULL, '60318', '7.39754080', '80.26873400'),
(1261, 14, 'Wadumunnegedara', 'වඩුමුන්නේගෙදර', 'வடுமுன்னேகெதர', NULL, NULL, NULL, '60204', '7.39810800', '79.97739810'),
(1262, 14, 'Walakumburumulla', 'වලකුඹුරුමුල්ල', 'வலகும்புருமுல்ல', NULL, NULL, NULL, '60198', '7.42540260', '80.01558170'),
(1263, 14, 'Wannigama', 'වන්නිගම', 'வன்னிகம', NULL, NULL, NULL, '60465', '7.70780050', '80.14425400'),
(1264, 14, 'Wannikudawewa', 'වන්නිකුඩාවැව', 'வன்னிகுடாவெவ', NULL, NULL, NULL, '60721', '8.03396870', '80.21749140'),
(1265, 14, 'Wannilhalagama', 'වන්නිල්හලගම', 'வன்னிழலகம', NULL, NULL, NULL, '60722', '7.48176950', '80.36088760'),
(1266, 14, 'Wannirasnayakapura', 'වන්නිරස්නායකපුර', 'வன்னிராஸ்நாயக்கபுர', NULL, NULL, NULL, '60490', '7.48176950', '80.36088760'),
(1267, 14, 'Warawewa', 'වරාවැව', 'வரவெவ', NULL, NULL, NULL, '60739', '8.12049370', '80.14564960'),
(1268, 14, 'Wariyapola', 'වාරියපොළ', 'வாரியபொல', NULL, NULL, NULL, '60400', '7.62391440', '80.24331450'),
(1269, 14, 'Watareka', 'වටරැක', 'வடரேகா', NULL, NULL, NULL, '10511', '7.39726030', '80.43543370'),
(1270, 14, 'Wattegama', 'වත්තේගම', 'வத்தேகம', NULL, NULL, NULL, '20810', '7.35033130', '80.68124680'),
(1271, 14, 'Watuwatta', 'වටුවත්ත', 'வடுவத்த', NULL, NULL, NULL, '60262', '7.50830680', '79.91728030'),
(1272, 14, 'Weerapokuna', 'වීරපොකුණ', 'வீரபொகுன', NULL, NULL, NULL, '60454', '7.65135010', '79.98890560'),
(1273, 14, 'Welawa Juncton', 'වැලව හන්දිය', 'வெலவ ஜங்டன்', NULL, NULL, NULL, '60464', '7.69012190', '80.17453550'),
(1274, 14, 'Welipennagahamulla', 'වැලිපැන්නගහමුල්ල', 'வெலிபென்னாகஹமுல்ல', NULL, NULL, NULL, '60240', '7.43131540', '79.92757560'),
(1275, 14, 'Wellagala', 'වැල්ලගල', 'வெல்லகல', NULL, NULL, NULL, '60402', '7.62222220', '80.27666670'),
(1276, 14, 'Wellarawa', 'වැල්ලරාව', 'வெல்லராவ', NULL, NULL, NULL, '60456', '7.55692210', '80.36918790'),
(1277, 14, 'Wellawa', 'වැල්ලව', 'வெல்லவ', NULL, NULL, NULL, '60570', '7.56154660', '80.36864880'),
(1278, 14, 'Welpalla', 'වැල්පල්ල', 'வெல்பல்ல', NULL, NULL, NULL, '60206', '7.36547860', '79.96123680'),
(1279, 14, 'Wennoruwa', 'වෙන්නෝරුව', 'வென்னொருவை', NULL, NULL, NULL, '60284', '7.38049560', '80.21679420'),
(1280, 14, 'Weuda', 'වෑඋඩ', 'வீடா', NULL, NULL, NULL, '60080', '7.40652540', '80.49382670'),
(1281, 14, 'Wewagama', 'වැවගම', 'வெவகம', NULL, NULL, NULL, '60195', '7.42332590', '80.10237590'),
(1282, 14, 'Wilgamuwa', 'විල්ගමුව', 'வில்கமுவ', NULL, NULL, NULL, '21530', '7.36099280', '80.20536390'),
(1283, 14, 'Yakwila', 'යක්විල', 'யக்வில', NULL, NULL, NULL, '60202', '7.38186900', '80.03812320'),
(1284, 14, 'Yatigaloluwa', 'යටිගල්ඔළුව', 'யடிகலொலுவ', NULL, NULL, NULL, '60314', '7.32973050', '80.27394580'),
(1285, 15, 'Mannar', 'මන්නාරම', 'மன்னார்', NULL, NULL, NULL, '41000', '8.98097430', '79.90441490'),
(1286, 15, 'Puthukudiyiruppu', 'පුදුකුඩිඉරිප්පු', 'புதுக்குடியிருப்பு', NULL, NULL, NULL, '30158', '9.06038940', '79.84730910'),
(1287, 16, 'Akuramboda', 'අකුරම්බොඩ', 'அகுரம்பொட', NULL, NULL, NULL, '21142', '7.65000000', '80.60000000'),
(1288, 16, 'Alawatuwala', 'අලවතුවල', 'அலவத்துவல', NULL, NULL, NULL, '60047', '7.45765490', '80.62425990'),
(1289, 16, 'Alwatta', 'අල්වත්ත', 'அல்வத்தா', NULL, NULL, NULL, '21004', '7.44890800', '80.66459730'),
(1290, 16, 'Ambana', 'අම්බාන', 'அம்பானா', NULL, NULL, NULL, '21504', '7.64766030', '80.69233120'),
(1291, 16, 'Aralaganwila', 'අරලගන්විල', 'அரலகன்வில', NULL, NULL, NULL, '51100', '7.78278190', '81.18454260'),
(1292, 16, 'Ataragallewa', 'අටරගල්ලෑව', 'அதரகல்லேவ', NULL, NULL, NULL, '21512', '7.46746500', '80.62341610'),
(1293, 16, 'Bambaragaswewa', 'බඹරගස්වැව', 'பம்பரகஸ்வெவ', NULL, NULL, NULL, '21212', '7.78609140', '80.53291660'),
(1294, 16, 'Barawardhana Oya', 'බරවර්ධන ඔය', 'பரவர்தன ஓயா', NULL, NULL, NULL, '20967', '7.46746500', '80.62341610'),
(1295, 16, 'Beligamuwa', 'බෙලිගමුව', 'பெலிகமுவ', NULL, NULL, NULL, '21214', '7.72737210', '80.54974800'),
(1296, 16, 'Damana', 'දමන', 'தமண', NULL, NULL, NULL, '32014', '7.46746500', '80.62341610'),
(1297, 16, 'Dambulla', 'දඹුල්ල', 'தம்புள்ள', NULL, NULL, NULL, '21100', '7.87421700', '80.65112870'),
(1298, 16, 'Damminna', 'දම්මින්න', 'டம்மின்னா', NULL, NULL, NULL, '51106', '7.75023710', '81.21673770'),
(1299, 16, 'Dankanda', 'දංකන්ද', 'தங்கந்தா', NULL, NULL, NULL, '21032', '7.53472880', '80.70109270'),
(1300, 16, 'Delwite', 'දෙල්විටේ', 'டெல்வைட்', NULL, NULL, NULL, '60044', '7.47097150', '80.62306210'),
(1301, 16, 'Devagiriya', 'දේවගිරිය', 'தேவகிரிய', NULL, NULL, NULL, '21552', '7.46746500', '80.62341610'),
(1302, 16, 'Dewahuwa', 'දේවහුව', 'தேவாஹுவ', NULL, NULL, NULL, '21206', '7.84386120', '80.57856210'),
(1303, 16, 'Divuldamana', 'දිවුල්දමන', 'திவுல்டமான', NULL, NULL, NULL, '51104', '7.46746500', '80.62341610'),
(1304, 16, 'Dullewa', 'දුල්වල', 'துல்லேவா', NULL, NULL, NULL, '21054', '7.51442180', '80.60077340'),
(1305, 16, 'Dunkolawatta', 'දුන්කොලවත්ත', 'டன்கொலவத்த', NULL, NULL, NULL, '21046', '7.46746500', '80.62341610'),
(1306, 16, 'Elkaduwa', 'ඇල්කඩුව', 'எல்கடுவ', NULL, NULL, NULL, '21012', '7.41723760', '80.68401210'),
(1307, 16, 'Erawula Junction', 'එරවුල හන්දිය', 'எராவுலா சந்தி', NULL, NULL, NULL, '21108', '7.46746500', '80.62341610'),
(1308, 16, 'Etanawala', 'එතනවල', 'எடனாவல', NULL, NULL, NULL, '21402', '7.46746500', '80.62341610'),
(1309, 16, 'Galewela', 'ගලේවෙල', 'கலேவெல', NULL, NULL, NULL, '21200', '7.75650450', '80.57717370'),
(1310, 16, 'Galoya Junction', 'ගල්ඔය හන්දිය', 'கலோயா சந்தி', NULL, NULL, NULL, '51375', '7.46746500', '80.62341610'),
(1311, 16, 'Gammaduwa', 'ගම්මඩුව', 'கம்மதுவ', NULL, NULL, NULL, '21068', '7.57022620', '80.69709690'),
(1312, 16, 'Gangala Puwakpitiya', 'ගන්ගල පුවක්පිටිය', 'கங்கலா புவக்பிட்டிய', NULL, NULL, NULL, '21404', '7.58824670', '80.75496740'),
(1313, 16, 'Hasalaka', 'හසලක', 'ஹசலக', NULL, NULL, NULL, '20960', '7.46802280', '80.62482660'),
(1314, 16, 'Hattota Amuna', 'හත්තොට අමුණ', 'ஹத்தோட்ட அமுன', NULL, NULL, NULL, '21514', '7.61224780', '80.82755060'),
(1315, 16, 'Imbulgolla', 'ඉඹුල්ගොල්ල', 'இம்புல்கொல்ல', NULL, NULL, NULL, '21064', '7.56681210', '80.66692110'),
(1316, 16, 'Inamaluwa', 'ඉනාමලුව', 'இனாமாலுவ', NULL, NULL, NULL, '21124', '7.92424990', '80.68401210'),
(1317, 16, 'Iriyagolla', 'ඊරියගොල්ල', 'இரியகொல்ல', NULL, NULL, NULL, '60045', '7.46746500', '80.62341610'),
(1318, 16, 'Kaikawala', 'කයිකාවල', 'கைகாவாலா', NULL, NULL, NULL, '21066', '7.50769890', '80.66182340'),
(1319, 16, 'Kalundawa', 'කලන්දූව', 'கலுந்தவா', NULL, NULL, NULL, '21112', '7.80335460', '80.66960340'),
(1320, 16, 'Kandalama', 'කන්ඩලම', 'கண்டலமா', NULL, NULL, NULL, '21106', '7.88849850', '80.71035320'),
(1321, 16, 'Kavudupelella', 'කවුඩුපැලැල්ල', 'கவுடுபெலல்ல', NULL, NULL, NULL, '21072', '7.58020770', '80.62658080'),
(1322, 16, 'Kibissa', 'කිඹිස්ස', 'கிபிஸ்ஸா', NULL, NULL, NULL, '21122', '7.93732850', '80.72698540'),
(1323, 16, 'Kiwula', 'කිවුල', 'கிவுலா', NULL, NULL, NULL, '21042', '7.46347490', '80.62644770'),
(1324, 16, 'Kongahawela', 'කෝන්ගහවෙල', 'கொன்கஹவெல', NULL, NULL, NULL, '21500', '7.68975230', '80.71589770'),
(1325, 16, 'Laggala Pallegama', 'ලග්ගල පල්ලේගම', 'லக்கல பல்லேகம', NULL, NULL, NULL, '21520', '7.59653370', '80.83678340'),
(1326, 16, 'Leliambe', 'ලෑලිඅඹේ', 'லீலியாம்பே', NULL, NULL, NULL, '21008', '7.42250790', '80.65710080'),
(1327, 16, 'Lenadora', 'ලෙනදොර', 'லெனடோரா', NULL, NULL, NULL, '21094', '7.75551730', '80.66165000'),
(1328, 16, 'Ihala Halmillewa', 'ඉහළ හල්මිල්ලෑව', 'இஹல ஹல்மில்லேவா', NULL, NULL, NULL, '50262', '8.13637740', '80.35751280'),
(1329, 16, 'Illukkumbura', 'ඉලුක්කුඹුර', 'இல்லுக்கும்புற', NULL, NULL, NULL, '21406', '7.54413100', '80.80178770'),
(1330, 16, 'Madipola', 'මාදිපොල', 'மடிபோல', NULL, NULL, NULL, '51108', '7.67611540', '80.58272720'),
(1332, 16, 'Mahawela', 'මහවෙල', 'மஹவெல', NULL, NULL, NULL, '21140', '7.58014170', '80.61138060'),
(1333, 16, 'Mananwatta', 'මානවත්ත', 'மனன்வத்த', NULL, NULL, NULL, '21144', '7.68458910', '80.60216140'),
(1334, 16, 'Maraka', 'මාරක', 'மரக்கா', NULL, NULL, NULL, '21554', '7.58553720', '80.96561810'),
(1335, 16, 'Matale', 'මාතලේ', 'மாத்தளை', NULL, NULL, NULL, '21000', '7.46746500', '80.62341610'),
(1336, 16, 'Melipitiya', 'මේලිපිටිය', 'மெலிபிட்டிய', NULL, NULL, NULL, '21055', '7.46746500', '80.62341610'),
(1337, 16, 'Metihakka', 'මැටිහක්ක', 'மெதிஹாக்கா', NULL, NULL, NULL, '21062', '7.54009730', '80.65322010'),
(1338, 16, 'Millawana', 'මිල්ලවාන', 'மில்லவானா', NULL, NULL, NULL, '21154', '7.64991060', '80.57546640'),
(1339, 16, 'Muwandeniya', 'මුවන්දෙණිය', 'முவன்தெனிய', NULL, NULL, NULL, '21044', '7.45476490', '80.64097640'),
(1340, 16, 'Nalanda', 'නාලන්ද', 'நாளந்தா', NULL, NULL, NULL, '21082', '7.66974860', '80.64585600'),
(1341, 16, 'Naula', 'නාඋල', 'நாவுலா', NULL, NULL, NULL, '21090', '7.70714930', '80.65211390'),
(1342, 16, 'Opalgala', 'ඕපල්ගල', 'ஓபல்கல', NULL, NULL, NULL, '21076', '7.62489860', '80.69371770'),
(1343, 16, 'Pallepola', 'පල්ලේපො', 'பல்லேபொல', NULL, NULL, NULL, '21152', '7.62297620', '80.60493740'),
(1344, 16, 'Pimburattewa', 'පිඹුරත්තෑව', 'பிம்புரத்தேவா', NULL, NULL, NULL, '51102', '7.71855030', '81.18852930'),
(1345, 16, 'Pulastigama', 'පුලතිසිගම', 'புலஸ்திகம', NULL, NULL, NULL, '51050', '8.04219630', '81.08098480'),
(1346, 16, 'Ranamuregama', 'රණමුරේගම', 'ரணமுரேகம', NULL, NULL, NULL, '21524', '7.50290940', '80.83303400'),
(1347, 16, 'Rattota', 'රත්තොට', 'ரத்தோட்ட', NULL, NULL, NULL, '21400', '7.51727300', '80.67153170'),
(1348, 16, 'Selagama', 'සැලගම', 'செலாகம', NULL, NULL, NULL, '21058', '7.59204690', '80.59404970'),
(1349, 16, 'Sigiriya', 'සීගිරිය', 'சிகிரியா', NULL, NULL, NULL, '21120', '7.95410850', '80.75469800'),
(1350, 16, 'Sinhagama', 'සිංහගම', 'சிங்ககம', NULL, NULL, NULL, '51378', '7.46746500', '80.62341610'),
(1351, 16, 'Sungavila', 'සුංගාවිග', 'சுங்கவிளை', NULL, NULL, NULL, '51052', '8.07483740', '81.09202180'),
(1352, 16, 'Talagoda Junction', 'තලගොඩ හන්දිය', 'தலகொட சந்தி', NULL, NULL, NULL, '21506', '7.70144770', '80.76023940'),
(1353, 16, 'Talakiriyagama', 'තලකිරියාගම', 'தலகிரியாகம', NULL, NULL, NULL, '21116', '7.82531670', '80.62089720'),
(1354, 16, 'Tamankaduwa', 'තමන්කඩුව', 'தமன்கடுவ', NULL, NULL, NULL, '51089', '7.46746500', '80.62341610'),
(1355, 16, 'Udasgiriya', 'උඩස්ගිරිය', 'உதஸ்கிரிய', NULL, NULL, NULL, '21051', '7.53517470', '80.57023140'),
(1356, 16, 'Udatenna', 'උඩතැන්න', 'உடதென்ன', NULL, NULL, NULL, '21006', '7.42874250', '80.64754180'),
(1357, 16, 'Ukuwela', 'උකුවෙල', 'உகுவெல', NULL, NULL, NULL, '21300', '7.42346230', '80.63061030'),
(1358, 16, 'Wahacotte', 'වහකෝට්ටේ', 'வஹாகோட்டே', NULL, NULL, NULL, '21160', '7.71904370', '80.58272720'),
(1359, 16, 'Walawela', 'වලවෙල', 'வலவெல', NULL, NULL, NULL, '21048', '7.51971430', '80.59799730'),
(1360, 16, 'Wehigala', 'වැහිගල', 'வெஹிகல', NULL, NULL, NULL, '21009', '7.43822650', '80.61406850'),
(1361, 16, 'Welangahawatte', 'වෙලංගහවත්ත', 'வெலங்கஹவத்த', NULL, NULL, NULL, '21408', '7.54980700', '80.75424470'),
(1362, 16, 'Wewalawewa', 'වේවැලවැව', 'வெவலவெவ', NULL, NULL, NULL, '21114', '7.46746500', '80.62341610'),
(1363, 16, 'Yatawatta', 'යටවත්ත', 'யாதவத்த', NULL, NULL, NULL, '21056', '7.56348260', '80.58767940'),
(1364, 17, 'Akuressa', 'අකුරැස්ස', 'அக்குரஸ்ஸை', NULL, NULL, NULL, '81400', '6.10013880', '80.47595670'),
(1365, 17, 'Alapaladeniya', 'අලපලදෙණිය', 'அலபலதெனிய', NULL, NULL, NULL, '81475', '6.28333300', '80.45000000'),
(1366, 17, 'Aparekka', 'අපරැක්ක', 'அபரேக்கா', NULL, NULL, NULL, '81032', '5.99253730', '80.61604020'),
(1367, 17, 'Athuraliya', 'අතුරලීය', 'அத்துரலிய', NULL, NULL, NULL, '81402', '6.06607070', '80.50227640'),
(1368, 17, 'Bengamuwa', 'බෙන්ගමුව', 'பெங்கமுவா', NULL, NULL, NULL, '81614', '6.27861390', '80.60426390'),
(1369, 17, 'Bopagoda', 'බෝපගොඩ', 'போபகொட', NULL, NULL, NULL, '81412', '6.15866160', '80.49953120'),
(1370, 17, 'Dampahala', 'දම්පහල', 'தம்பஹாலா', NULL, NULL, NULL, '81612', '6.27152470', '80.64010980'),
(1371, 17, 'Deegala Lenama', 'දීගල ලෙනම', 'டீகல லேனமா', NULL, NULL, NULL, '81452', '6.16598040', '80.46164750'),
(1372, 17, 'Deiyandara', 'දෙයියන්දර', 'தெய்வந்தாரா', NULL, NULL, NULL, '81320', '6.15256980', '80.60285540'),
(1373, 17, 'Denagama', 'දෙනගම', 'தெனகம', NULL, NULL, NULL, '81314', '6.11421070', '80.66164450'),
(1374, 17, 'Denipitiya', 'දෙණිපිටිය', 'தெனிபிட்டிய', NULL, NULL, NULL, '81730', '5.98287730', '80.45180530'),
(1375, 17, 'Deniyaya', 'දෙණියාය', 'தெனியாய', NULL, NULL, NULL, '81500', '6.34248470', '80.55965820'),
(1376, 17, 'Derangala', 'දෙරණගල', 'தேரங்கலா', NULL, NULL, NULL, '81454', '6.21891180', '80.45004250'),
(1377, 17, 'Devinuwara (Dondra)', 'දෙවිනුවර (දෙවුන්දර)', 'தெவிநுவர', NULL, NULL, NULL, '81160', '5.93125530', '80.59143310'),
(1378, 17, 'Dikwella', 'දික්වැල්ල', 'திக்வெல்ல', NULL, NULL, NULL, '81200', '5.97167620', '80.69510410'),
(1379, 17, 'Diyagaha', 'දියගහ', 'தியாகஹா', NULL, NULL, NULL, '81038', '5.98551850', '80.57856010'),
(1380, 17, 'Diyalape', 'දියලපේ', 'தியாலாபே', NULL, NULL, NULL, '81422', '6.12295420', '80.44655940'),
(1381, 17, 'Gandara', 'ගන්දර', 'காந்தார', NULL, NULL, NULL, '81170', '5.93764030', '80.61326460'),
(1382, 17, 'Godapitiya', 'ගොඩපිටිය', 'கோதாபிட்டிய', NULL, NULL, NULL, '81408', '6.08866040', '80.47908660'),
(1383, 17, 'Gomilamawarala', 'ගොමිලමවරල', 'கோமிலமவரல', NULL, NULL, NULL, '81072', '6.21009260', '80.59228810'),
(1384, 17, 'Hawpe', 'හව්පෙ', 'ஹவ்பே', NULL, NULL, NULL, '80132', '6.13288520', '80.48965710'),
(1385, 17, 'Horapawita', 'හොරපාවිට', 'ஹொரபவிட்ட', NULL, NULL, NULL, '81108', '6.10703990', '80.58272720'),
(1386, 17, 'Kalubowitiyana', 'කළුබෝවිටියාන', 'களுபோவிட்டியன', NULL, NULL, NULL, '81478', '6.31165380', '80.39371820'),
(1387, 17, 'Kamburugamuwa', 'කඹුරුගමුව', 'கம்புருகமுவ', NULL, NULL, NULL, '81750', '5.94458700', '80.49383440'),
(1388, 17, 'Kamburupitiya', 'කඹුරුපිටිය', 'கம்புருபிட்டிய', NULL, NULL, NULL, '81100', '6.07791070', '80.56328840'),
(1389, 17, 'Karagoda Uyangoda', 'කරන්ගොඩ උයන්ගොඩ', 'கரகொட உயங்கொட', NULL, NULL, NULL, '81082', '6.05200090', '80.52825870'),
(1390, 17, 'Karaputugala', 'කරපුටුල', 'கரபுடுகல', NULL, NULL, NULL, '81106', '6.08452960', '80.60134030'),
(1391, 17, 'Karatota', 'කරාතොට', 'கரதொட்ட', NULL, NULL, NULL, '81318', '6.06412720', '80.66600920'),
(1392, 17, 'Kekanadura', 'කෙකනදුර', 'கேகனதுர', NULL, NULL, NULL, '81020', '5.96375280', '80.61326460'),
(1393, 17, 'Kiriweldola', 'කිරිවැල්ගොඩ', 'கிரிவெல்டோலா', NULL, NULL, NULL, '81514', '6.37115050', '80.53551070'),
(1394, 17, 'Kiriwelkele', 'කිරිවැල්කැලේ', 'கிரிவெல்கெலே', NULL, NULL, NULL, '81456', '6.24224840', '80.45073110'),
(1395, 17, 'Kolawenigama', 'කොලවෙනිගම', 'கொலவெனிகம', NULL, NULL, NULL, '81522', '6.32323980', '80.50216520'),
(1396, 17, 'Kotapola', 'කොටපොල', 'கொட்டபொல', NULL, NULL, NULL, '81480', '6.27797250', '80.53967800'),
(1397, 17, 'Lankagama', 'ලංකාගම', 'லங்காகம', NULL, NULL, NULL, '81526', '6.36713720', '80.46046430'),
(1398, 17, 'Makandura', 'මාකඳුර', 'மாகந்துரை', NULL, NULL, NULL, '81070', '6.14192480', '80.55634490'),
(1399, 17, 'Maliduwa', 'මැලිදූව', 'மலிதுவா', NULL, NULL, NULL, '81424', '6.13543390', '80.41047430'),
(1400, 17, 'Maramba', 'මාරඹ', 'மரம்பா', NULL, NULL, NULL, '81416', '6.14552080', '80.48235990'),
(1401, 17, 'Matara', 'මාතර', 'மாத்தறை', NULL, NULL, NULL, '81000', '5.94953080', '80.53039310'),
(1402, 17, 'Mediripitiya', 'මැදිරිපිටිය', 'மெதிரிபிட்டிய', NULL, NULL, NULL, '81524', '6.35070950', '80.49309040'),
(1403, 17, 'Miella', 'මීඇල්ල', 'மியெல்லா', NULL, NULL, NULL, '81312', '6.11791320', '80.67161110'),
(1404, 17, 'Mirissa', 'මිරිස්ස', 'மிரிஸ்ஸா', NULL, NULL, NULL, '81740', '5.94826200', '80.47158660'),
(1405, 17, 'Morawaka', 'මොරවක', 'மொரவக', NULL, NULL, NULL, '81470', '6.26528020', '80.49104700'),
(1406, 17, 'Mulatiyana Junction', 'මුලටියාන හන්දිය', 'முலட்டியான சந்தி', NULL, NULL, NULL, '81071', '6.16208860', '80.58550380'),
(1407, 17, 'Nadugala', 'නඩුගල', 'நடுகல', NULL, NULL, NULL, '81092', '5.98136590', '80.54971010'),
(1408, 17, 'Naimana', 'නයිමන', 'நைமனா', NULL, NULL, NULL, '81017', '5.96344580', '80.56584960'),
(1409, 17, 'Palatuwa', 'පලාතුව', 'பலத்துவ', NULL, NULL, NULL, '81050', '5.97631240', '80.51844180'),
(1410, 17, 'Parapamulla', 'පරපමුල්ල', 'பரபமுல்லா', NULL, NULL, NULL, '81322', '6.15162590', '80.62186660'),
(1411, 17, 'Pasgoda', 'පස්ගොඩ', 'பஸ்கொடா', NULL, NULL, NULL, '81615', '6.24639160', '80.60771320'),
(1412, 17, 'Penetiyana', 'පෙනතියන', 'பெண்டியான', NULL, NULL, NULL, '81722', '6.04772800', '80.44994740'),
(1413, 17, 'Pitabeddara', 'පිටබැද්දර', 'பிட்டபெத்தர', NULL, NULL, NULL, '81450', '6.20707730', '80.46324500'),
(1414, 17, 'Puhulwella', 'පුහුවැල්ල', 'புஹுல்வெல்ல', NULL, NULL, NULL, '81290', '6.05152880', '80.62575390'),
(1415, 17, 'Radawela', 'රඳාවෙල', 'ரடவெல', NULL, NULL, NULL, '81316', '7.67275800', '80.70937300'),
(1416, 17, 'Ransegoda', 'රන්සෑගොඩ', 'ரன்சேகொட', NULL, NULL, NULL, '81064', '6.11862980', '80.56415070'),
(1417, 17, 'Rotumba', 'රොටුඹ', 'ரோடும்பா', NULL, NULL, NULL, '81074', '6.22578800', '80.57597720'),
(1418, 17, 'Sultanagoda', 'සුල්තානාගොඩ', 'சுல்தானகொடா', NULL, NULL, NULL, '81051', '5.97724210', '80.51099480'),
(1419, 17, 'Telijjawila', 'තෙලිජ්ජවෙල', 'தெலிஜ்ஜாவில', NULL, NULL, NULL, '81060', '6.02508460', '80.49591140'),
(1420, 17, 'Thihagoda', 'තිහාගොඩ', 'திஹகொட', NULL, NULL, NULL, '81280', '6.01333870', '80.56600410'),
(1421, 17, 'Urubokka', 'ඌරුබොක්ක', 'ஊர்பொக்க', NULL, NULL, NULL, '81600', '6.30652970', '80.63061030'),
(1422, 17, 'Urugamuwa', 'ඌරුගමුව', 'உருகமுவ', NULL, NULL, NULL, '81230', '6.01007300', '80.64795240'),
(1423, 17, 'Urumutta', 'උරුමුත්ත', 'உருமுட்டா', NULL, NULL, NULL, '81414', '6.16195980', '80.51692520'),
(1424, 17, 'Viharahena', 'විහාරහේන', 'விஹாரஹேன', NULL, NULL, NULL, '81508', '6.38276970', '80.60202340'),
(1425, 17, 'Walakanda', 'වලකන්ද', 'வாலகண்டா', NULL, NULL, NULL, '81294', '6.02305050', '80.65586580'),
(1426, 17, 'Walasgala', 'වලස්ගල', 'வலஸ்கல', NULL, NULL, NULL, '81220', '5.98284010', '80.69857010'),
(1427, 17, 'Waralla', 'වැරැල්ල', 'வாரல்லா', NULL, NULL, NULL, '81479', '6.27638310', '80.52439700'),
(1428, 17, 'Weligama', 'වැලිගම', 'வெலிகம', NULL, NULL, NULL, '81700', '5.97303210', '80.42280410'),
(1429, 17, 'Wilpita', 'විල්පිට', 'வில்பிட', NULL, NULL, NULL, '81404', '5.94603270', '80.55772880');
INSERT INTO `cities` (`id`, `district_id`, `name_en`, `name_si`, `name_ta`, `sub_name_en`, `sub_name_si`, `sub_name_ta`, `postcode`, `latitude`, `longitude`) VALUES
(1430, 17, 'Yatiyana', 'යටියාන', 'யதியான', NULL, NULL, NULL, '81034', '6.03027130', '80.60632530'),
(1431, 18, 'Ayiwela', 'අයිවෙල', 'ஆயிவேல', NULL, NULL, NULL, '91516', '7.10702560', '81.25048550'),
(1432, 18, 'Badalkumbura', 'බඩල්කුඹුර', 'படல்கும்புர', NULL, NULL, NULL, '91070', '6.89559920', '81.23635890'),
(1433, 18, 'Baduluwela', 'බදුලුවෙල', 'பதுலுவெல', NULL, NULL, NULL, '91058', '6.99340090', '81.05498150'),
(1434, 18, 'Bakinigahawela', 'බකිණිගහවෙල', 'பகினிகஹவெல', NULL, NULL, NULL, '91554', '6.99824690', '81.28508070'),
(1435, 18, 'Balaharuwa', 'බලහරුව', 'பலஹருவா', NULL, NULL, NULL, '91295', '6.53084900', '81.06442630'),
(1436, 18, 'Bibile', 'බිබිලේ', 'பிபிலை', NULL, NULL, NULL, '91500', '6.86086240', '81.35025410'),
(1437, 18, 'Buddama', 'බුද්ධගම', 'புத்தமா', NULL, NULL, NULL, '91038', '7.04054500', '81.48880660'),
(1438, 18, 'Buttala', 'බුත්තල', 'புத்தளை', NULL, NULL, NULL, '91100', '6.75892330', '81.24912980'),
(1439, 18, 'Dambagalla', 'දඹගල්ල', 'டம்பகல்ல', NULL, NULL, NULL, '91050', '6.94999990', '81.36666710'),
(1440, 18, 'Diyakobala', 'දියකොබල', 'தியாகோபாலா', NULL, NULL, NULL, '91514', '7.15884730', '81.19934040'),
(1441, 18, 'Dombagahawela', 'දොඹගහවෙල', 'தொம்பகஹவெல', NULL, NULL, NULL, '91010', '6.90764870', '81.50941940'),
(1442, 18, 'Ethimalewewa', 'ඇතිමලේවැව', 'எதிமலேவெவ', NULL, NULL, NULL, '91020', '6.81115120', '81.50203280'),
(1443, 18, 'Ettiliwewa', 'ඇත්තිලිවැව', 'எட்டிலிவெவ', NULL, NULL, NULL, '91250', '6.89064540', '81.34544170'),
(1444, 18, 'Galabedda', 'ගලබැද්ද', 'கலபெத்தா', NULL, NULL, NULL, '91008', '6.91911390', '81.38509100'),
(1445, 18, 'Gamewela', 'ගමේවැල', 'கேம்வேலா', NULL, NULL, NULL, '90512', '6.92464050', '81.20533240'),
(1446, 18, 'Hambegamuwa', 'හම්බෙගමුව', 'ஹம்பேகமுவ', NULL, NULL, NULL, '91308', '6.53863360', '80.96301560'),
(1447, 18, 'Hingurukaduwa', 'හිඟුරකඩුව', 'ஹிங்குருகடுவ', NULL, NULL, NULL, '90508', '6.82574560', '81.16298410'),
(1448, 18, 'Hulandawa', 'හුලන්දාව', 'ஹுலந்தவா', NULL, NULL, NULL, '91004', '6.85467910', '81.33856630'),
(1449, 18, 'Inginiyagala', 'ඉඟිනියාගල', 'இங்கினியாகல', NULL, NULL, NULL, '91040', '7.21381560', '81.54318720'),
(1450, 18, 'Kandaudapanguwa', 'කන්දඋඩපංගුව', 'கந்தவுடபங்குவா', NULL, NULL, NULL, '91032', '6.98034640', '81.54148000'),
(1451, 18, 'Kandawinna', 'කන්දවින්න', 'கண்டவின்னா', NULL, NULL, NULL, '91552', '6.89064540', '81.34544170'),
(1452, 18, 'Kataragama', 'කතරගම', 'கதிர்காமம்', NULL, NULL, NULL, '91400', '6.41354630', '81.33256790'),
(1453, 18, 'Kotagama', 'කොටගම', 'கொட்டகம', NULL, NULL, NULL, '91512', '7.11098880', '81.18026190'),
(1454, 18, 'Kotamuduna', 'කොටමුදුන', 'கொடமுதுனா', NULL, NULL, NULL, '90506', '6.89022610', '81.17750590'),
(1455, 18, 'Kotawehera Mankada', 'කොටවෙහෙර මංකඩ', 'கொட்டவெஹெர மங்கட', NULL, NULL, NULL, '91312', '6.64690700', '80.90847550'),
(1456, 18, 'Kudawewa', 'කුඩාවැව', 'குடவெவ', NULL, NULL, NULL, '61226', '8.56222220', '80.69388890'),
(1457, 18, 'Kumbukkana', 'කුඹුක්කන', 'கும்புக்கனா', NULL, NULL, NULL, '91098', '6.81059500', '81.30066680'),
(1458, 18, 'Marawa', 'මරාවා', 'மரவா', NULL, NULL, NULL, '91006', '6.80900980', '81.38118390'),
(1459, 18, 'Mariarawa', 'මාරියරාව', 'மரியராவா', NULL, NULL, NULL, '91052', '6.96837810', '81.47620430'),
(1460, 18, 'Medagana', 'මැදගාන', 'மெதகம', NULL, NULL, NULL, '91550', '7.03447320', '81.27600400'),
(1461, 18, 'Medawelagama', 'මැදවෙලගම', 'மெதவெலகம', NULL, NULL, NULL, '90518', '7.03447320', '81.27600400'),
(1462, 18, 'Miyanakandura', 'මියනකඳුර', 'மியானகந்துர', NULL, NULL, NULL, '90584', '6.89064540', '81.34544170'),
(1463, 18, 'Monaragala', 'මොණරාගල', 'மொனராகலை', NULL, NULL, NULL, '91000', '6.89064540', '81.34544170'),
(1464, 18, 'Moretuwegama', 'මොරටුවේගම', 'மொரேதுவேகம', NULL, NULL, NULL, '91108', '6.89064540', '81.34544170'),
(1465, 18, 'Nakkala', 'නක්කල', 'நக்கலா', NULL, NULL, NULL, '91003', '6.88999620', '81.29843090'),
(1466, 18, 'Namunukula', 'නමුණුකුල', 'நமுனுகுல', NULL, NULL, NULL, '90580', '6.87447870', '81.11547030'),
(1467, 18, 'Nannapurawa', 'නන්නපුරව', 'நன்னபுரவா', NULL, NULL, NULL, '91519', '7.08537010', '81.25931330'),
(1468, 18, 'Nelliyadda', 'නෙල්ලියද්ද', 'நெல்லியத்தா', NULL, NULL, NULL, '91042', '7.38785580', '81.41690930'),
(1469, 18, 'Nilgala', 'නිල්ගල', 'நீலகலா', NULL, NULL, NULL, '91508', '7.19333790', '81.39639010'),
(1470, 18, 'Obbegoda', 'ඔබ්බේගොඩ', 'ஒபேகொட', NULL, NULL, NULL, '91007', '6.92507090', '81.35408600'),
(1471, 18, 'Okkampitiya', 'ඔක්කම්පිටිය', 'ஒக்கம்பிடிய', NULL, NULL, NULL, '91060', '6.75003500', '81.30761930'),
(1472, 18, 'Pangura', 'පංගුරා', 'பங்குரா', NULL, NULL, NULL, '91002', '6.97668660', '81.32008930'),
(1473, 18, 'Pitakumbura', 'පිටකුඹුර', 'பிடகும்புரா', NULL, NULL, NULL, '91505', '7.17869360', '81.29312200'),
(1474, 18, 'Randeniya', 'රන්දෙණිය', 'ரண்டெனிய', NULL, NULL, NULL, '91204', '6.80151990', '81.11409120'),
(1475, 18, 'Ruwalwela', 'රුවල්වෙල', 'ருவல்வெல', NULL, NULL, NULL, '91056', '6.86108030', '81.33918040'),
(1476, 18, 'Sella Kataragama', 'සෙල්ල කතරගම', 'செல்ல கதிர்காமம்', NULL, NULL, NULL, '91405', '6.43732850', '81.29867670'),
(1477, 18, 'Siyambalagune', 'සියඹලාගුණේ', 'சியாம்பலாகுனே', NULL, NULL, NULL, '91202', '6.89064540', '81.34544170'),
(1478, 18, 'Siyambalanduwa', 'සියඹලාණ්ඩුව', 'சியம்பலாண்டுவ', NULL, NULL, NULL, '91030', '6.90646360', '81.56101380'),
(1479, 18, 'Suriara', 'සූරියරා', 'சூரியரா', NULL, NULL, NULL, '91306', '6.89064540', '81.34544170'),
(1480, 18, 'Thanamalwila', 'තණමල්විල', 'தனமல்விலை', NULL, NULL, NULL, '91300', '6.43975480', '81.13339680'),
(1481, 18, 'Uva Gangodagama', 'ඌව ගංගොඩගම', 'ஊவா கங்கோடாகம', NULL, NULL, NULL, '91054', '7.01985990', '81.43339230'),
(1482, 18, 'Uva Kudaoya', 'ඌව කුඩාඔය', 'ஊவா குடாஓயா', NULL, NULL, NULL, '91298', '6.53279710', '81.17474980'),
(1483, 18, 'Uva Pelwatta', 'ඌව පැල්වත්ත', 'ஊவா பெல்வத்த', NULL, NULL, NULL, '91112', '6.74473370', '81.19679580'),
(1484, 18, 'Warunagama', 'වරුණගම', 'வருணகம', NULL, NULL, NULL, '91198', '6.73234260', '81.13408620'),
(1485, 18, 'Wedikumbura', 'වෙඩිකුඹුර', 'வெடிகும்புர', NULL, NULL, NULL, '91005', '6.89559920', '81.23635890'),
(1486, 18, 'Weherayaya Handapanagala', 'වෙහෙරයාය හඳපානාගල', 'வெஹெரயாய ஹந்தபானகல', NULL, NULL, NULL, '91206', '6.64359030', '81.11825900'),
(1487, 18, 'Wellawaya', 'වැල්ලවාය', 'வெல்லவாய', NULL, NULL, NULL, '91200', '6.73773560', '81.10305730'),
(1488, 18, 'Wilaoya', 'විලාඔය', 'விலாஓய', NULL, NULL, NULL, '91022', '6.76778200', '81.69721660'),
(1489, 18, 'Yudaganawa', 'යුදගනාව', 'யுதகனவா', NULL, NULL, NULL, '51424', '6.77425080', '81.23511310'),
(1490, 19, 'Mullativu', 'මුලතිව්', 'முல்லைத்தீவு', NULL, NULL, NULL, '42000', '9.26709110', '80.81424800'),
(1491, 20, 'Agarapathana', 'ආගරපතන', 'அக்கரப்பத்தனை', NULL, NULL, NULL, '22094', '6.86724310', '80.71217540'),
(1492, 20, 'Ambatalawa', 'අඹතලාව', 'அம்பதலாவ', NULL, NULL, NULL, '20686', '7.05000000', '80.66666690'),
(1493, 20, 'Ambewela', 'අඹේවෙල', 'அம்பேவெல', NULL, NULL, NULL, '22216', '6.87871950', '80.81355580'),
(1494, 20, 'Bogawantalawa', 'බොගවන්තලාව', 'பொகவந்தலாவ', NULL, NULL, NULL, '22060', '6.79723370', '80.67569200'),
(1495, 20, 'Bopattalawa', 'බෝපත්තලාව', 'போபத்தலாவ', NULL, NULL, NULL, '22095', '6.80901900', '80.69590130'),
(1496, 20, 'Dagampitiya', 'දාගම්පිටිය', 'தகம்பிட்டிய', NULL, NULL, NULL, '20684', '6.97747550', '80.47436690'),
(1497, 20, 'Dayagama Bazaar', 'ඩයගම බසාර්', 'டயகம பஜார்', NULL, NULL, NULL, '22096', '6.85612990', '80.74742610'),
(1498, 20, 'Dikoya', 'දික්ඔය', 'டிக்கோயா', NULL, NULL, NULL, '22050', '6.87513130', '80.60067720'),
(1499, 20, 'Doragala', 'දොරගල', 'தொரகல', NULL, NULL, NULL, '20567', '6.95627300', '80.78471800'),
(1500, 20, 'Dunukedeniya', 'දුනුකෙදෙණිය', 'துனுகெதெனிய', NULL, NULL, NULL, '22002', '6.99002820', '80.63685390'),
(1501, 20, 'Egodawela', 'එගොඩවෙල', 'எகொடவெல', NULL, NULL, NULL, '90013', '6.96448360', '80.76335990'),
(1502, 20, 'Ekiriya', 'ඇකිරිය', 'எகிரியா', NULL, NULL, NULL, '20732', '7.14825510', '80.75435170'),
(1503, 20, 'Elamulla', 'ඇලමුල්ල', 'எலமுல்லா', NULL, NULL, NULL, '20742', '7.05668610', '80.76843740'),
(1504, 20, 'Ginigathena', 'ගිනිගතැන', 'கினிகத்தனை', NULL, NULL, NULL, '20680', '6.98931710', '80.49269330'),
(1505, 20, 'Gonakele', 'ගෝනකැලේ', 'கோனகேலை', NULL, NULL, NULL, '22226', '6.98379580', '80.75815850'),
(1506, 20, 'Haggala', 'හග්ගල', 'ஹக்கலா', NULL, NULL, NULL, '22208', '6.91868170', '80.83103180'),
(1507, 20, 'Halgranoya', 'හාල්ගරනඔය', 'ஹல்கிரானோயா', NULL, NULL, NULL, '22240', '7.00678340', '80.86520380'),
(1508, 20, 'Hangarapitiya', 'හඟරාපිටිය', 'ஹங்கராபிட்டிய', NULL, NULL, NULL, '22044', '6.92040700', '80.47255650'),
(1509, 20, 'Hapugasthalawa', 'හපුගස්තලාව', 'ஹப்புகஸ்தலாவை', NULL, NULL, NULL, '20668', '7.05781340', '80.57300840'),
(1510, 20, 'Harasbedda', 'හරස්බැද්ද', 'ஹரஸ்பெத்தா', NULL, NULL, NULL, '22262', '7.06263870', '80.88205350'),
(1511, 20, 'Hatton', 'හැටන්', 'ஹட்டன்', NULL, NULL, NULL, '22000', '6.89221530', '80.59857650'),
(1512, 20, 'Hewaheta', 'හේවාහැට', 'ஹெவாஹெட்டா', NULL, NULL, NULL, '20440', '7.11183660', '80.76335630'),
(1513, 20, 'Hitigegama', 'හිටිගේගම', 'ஹிட்டிகேகம', NULL, NULL, NULL, '22046', '6.95060760', '80.45768350'),
(1514, 20, 'Jangulla', 'ජංගුල්ල', 'ஜங்குல்லா', NULL, NULL, NULL, '90063', '6.94971660', '80.78910680'),
(1515, 20, 'Kalaganwatta', 'කලගන්වත්ත', 'கலகன்வத்த', NULL, NULL, NULL, '22282', '7.10063900', '80.89945790'),
(1516, 20, 'Kandapola', 'කඳපොල', 'கந்தபொல', NULL, NULL, NULL, '22220', '7.00025120', '80.81840100'),
(1517, 20, 'Karandagolla', 'කරඳගොල්ල', 'கரந்தகொல்ல', NULL, NULL, NULL, '20738', '7.05701940', '80.90072450'),
(1518, 20, 'Keerthi Bandarapura', 'කීර්තිබණ්ඩාරපුර', 'கீர்த்தி பண்டாரபுர', NULL, NULL, NULL, '22274', '7.14589980', '80.85300100'),
(1519, 20, 'Kiribathkumbura', 'කිරිබත්කුඹුර', 'கிரிபத்கும்புரா', NULL, NULL, NULL, '20442', '7.26962890', '80.57571610'),
(1520, 20, 'Kotiyagala', 'කොටියාගල', 'கொட்டியாகலை', NULL, NULL, NULL, '91024', '6.78550740', '80.68539860'),
(1521, 20, 'Kotmale', 'කොත්මලේ', 'கொத்மலை', NULL, NULL, NULL, '20560', '7.02230890', '80.59105670'),
(1522, 20, 'Kottellena', 'කොට්ටැල්ලෙන', 'கொட்டெல்லெனா', NULL, NULL, NULL, '22040', '6.89316840', '80.50216520'),
(1523, 20, 'Kumbalgamuwa', 'කුඹල්ගමුව', 'கும்பல்கமுவ', NULL, NULL, NULL, '22272', '7.11248390', '80.84608220'),
(1524, 20, 'Kumbukwela', 'කුඹුක්වෙල', 'கும்பக்வேலா', NULL, NULL, NULL, '22246', '7.05346520', '80.88896920'),
(1525, 20, 'Kurupanawela', 'කුරුපනාවෙල', 'குருபனவெல', NULL, NULL, NULL, '22252', '7.01672620', '80.91386080'),
(1526, 20, 'Labukele', 'ලබුකැලේ', 'லபுகெல', NULL, NULL, NULL, '20592', '7.02431540', '80.71909510'),
(1527, 20, 'Laxapana', 'ලක්ෂපාන', 'லக்ஷ்பான', NULL, NULL, NULL, '22034', '6.92475840', '80.49104700'),
(1528, 20, 'Lindula', 'ලිඳුල', 'லிந்துல', NULL, NULL, NULL, '22090', '6.90189800', '80.67165240'),
(1529, 20, 'Madulla', 'මඩුල්ල', 'மதுல்லா', NULL, NULL, NULL, '22256', '7.01944190', '80.92130100'),
(1530, 20, 'Mandaram Nuwara', 'මන්දාරම් නුවර', 'மந்தாரம் நுவர', NULL, NULL, NULL, '20744', '7.04201080', '80.77963130'),
(1531, 20, 'Maskeliya', 'මස්කෙළිය', 'மஸ்கெலியா', NULL, NULL, NULL, '22070', '6.83292940', '80.57092560'),
(1532, 20, 'Maswela', 'මස්වෙල', 'மஸ்வெலா', NULL, NULL, NULL, '20566', '7.06397370', '80.63304790'),
(1533, 20, 'Maturata', 'මතුරට', 'மதுரதா', NULL, NULL, NULL, '20748', '6.99108740', '80.83380120'),
(1534, 20, 'Mipanawa', 'මීපනාව', 'மிபனாவா', NULL, NULL, NULL, '22254', '6.97314000', '80.76664000'),
(1535, 20, 'Mipilimana', 'මීපිලිමාන', 'மிபிலிமன', NULL, NULL, NULL, '22214', '6.93045680', '80.77963130'),
(1536, 20, 'Morahenagama', 'මොරහේනගම', 'மொரஹேனகம', NULL, NULL, NULL, '22036', '6.94575120', '80.47992730'),
(1537, 20, 'Munwatta', 'මුන්වත්ත', 'முன்வத்த', NULL, NULL, NULL, '20752', '7.11578960', '80.81147920'),
(1538, 20, 'Nayapana Janapadaya', 'නයපාන ජනපදය', 'நயபன ஜநபதய', NULL, NULL, NULL, '20568', '7.06653840', '80.60653300'),
(1539, 20, 'Nildandahinna', 'නිල්දණ්ඩාහින්න', 'நில்தண்டாஹின்ன', NULL, NULL, NULL, '22280', '7.08011970', '80.89173530'),
(1540, 20, 'Nissanka Uyana', 'නිශ්ශංක උයන', 'நிஸ்ஸங்க உயன', NULL, NULL, NULL, '22075', '6.94971660', '80.78910680'),
(1541, 20, 'Norwood', 'නෝවුඩ්', 'நோர்வூட்', NULL, NULL, NULL, '22058', '6.83842070', '80.61465240'),
(1542, 20, 'Nuwara Eliya', 'නුවරඑළිය', 'நுவரெலியா', NULL, NULL, NULL, '22200', '6.94795810', '80.78851030'),
(1543, 20, 'Padiyapelella', 'පදියපැලැල්ල', 'பதியபெலல்ல', NULL, NULL, NULL, '20750', '7.09357490', '80.79832620'),
(1544, 20, 'Pallebowala', 'පල්ලෙබෝවල', 'பல்லேபோவல', NULL, NULL, NULL, '20734', '7.15150470', '80.73391440'),
(1545, 20, 'Panvila', 'පන්විල', 'பன்வில', NULL, NULL, NULL, '20830', '7.40042080', '80.73290790'),
(1546, 20, 'Pitawala', 'පිටවල', 'பிடவாலா', NULL, NULL, NULL, '20682', '6.99836950', '80.45768350'),
(1547, 20, 'Pundaluoya', 'පුණ්ඩළුඔය', 'பூண்டுலோயா', NULL, NULL, NULL, '22120', '7.01312780', '80.66321030'),
(1548, 20, 'Ramboda', 'රම්බොඩ', 'ரம்பொடை', NULL, NULL, NULL, '20590', '7.05654680', '80.69384740'),
(1549, 20, 'Rikillagaskada', 'රිකිල්ලගස්කඩ', 'ரிகில்லகஸ்கட', NULL, NULL, NULL, '20730', '7.14865160', '80.79071030'),
(1550, 20, 'Rozella', 'රොසැල්ල', 'ரொசெல்ல', NULL, NULL, NULL, '22008', '6.92768270', '80.55854600'),
(1551, 20, 'Rupaha', 'රූපහ', 'ரூபாஹா', NULL, NULL, NULL, '22245', '7.03225930', '80.90432340'),
(1552, 20, 'Ruwaneliya', 'රුවන්එළිය', 'ருவனெலியா', NULL, NULL, NULL, '22212', '6.94208920', '80.77681290'),
(1553, 20, 'Santhipura', 'ශාන්තිපුර', 'சாந்திபுரா', NULL, NULL, NULL, '22202', '6.97894530', '80.74777080'),
(1554, 20, 'Talawakele', 'තලවකැලේ', 'தலவாக்கலை', NULL, NULL, NULL, '22100', '6.93879140', '80.66321030'),
(1555, 20, 'Tawalantenna', 'තවලන්තැන්න', 'தவலந்தென்ன', NULL, NULL, NULL, '20838', '7.07068220', '80.68401210'),
(1556, 20, 'Teripeha', 'තෙරිපේහා', 'தெரிபெஹா', NULL, NULL, NULL, '22287', '7.11404420', '80.91442850'),
(1557, 20, 'Udamadura', 'උඩමාදුර', 'உடமதுர', NULL, NULL, NULL, '22285', '7.09657370', '80.91662600'),
(1558, 20, 'Udapussallawa', 'උඩපුස්සල්ලාව', 'உடபுஸ்ஸல்லாவ', NULL, NULL, NULL, '22250', '7.01271230', '80.91247810'),
(1559, 20, 'Uva Deegalla', 'ඌව දීගල්ල', 'ஊவா டீகல்ல', NULL, NULL, NULL, '90062', '6.94971660', '80.78910680'),
(1560, 20, 'Uva Uduwara', 'ඌව උඩුවර', 'ஊவா உடுவார', NULL, NULL, NULL, '90061', '6.93044210', '81.05614580'),
(1561, 20, 'Uvaparanagama', 'ඌව-පරණගම', 'ஊவா பரணகம', NULL, NULL, NULL, '90230', '6.94971660', '80.78910680'),
(1562, 20, 'Walapane', 'වලපනේ', 'வலப்பனை', NULL, NULL, NULL, '22270', '7.10216630', '80.86268640'),
(1563, 20, 'Watawala', 'වටවල', 'வட்டவளை', NULL, NULL, NULL, '22010', '6.94494680', '80.53898340'),
(1564, 20, 'Widulipura', 'විදුලිපුර', 'விதுலிபுரா', NULL, NULL, NULL, '22032', '6.90940570', '80.51883960'),
(1565, 20, 'Wijebahukanda', 'විජේබාහුකන්ද', 'விஜேபாகுகந்த', NULL, NULL, NULL, '22018', '6.94971660', '80.78910680'),
(1566, 21, 'Attanakadawala', 'අත්තනගඩවල', 'அத்தனகடவல', NULL, NULL, NULL, '51235', '7.93309540', '80.87029550'),
(1567, 21, 'Bakamuna', 'බකමූණ', 'பகமுனா', NULL, NULL, NULL, '51250', '7.78060200', '80.81840100'),
(1568, 21, 'Diyabeduma', 'දියබෙදුම', 'தியபெடும', NULL, NULL, NULL, '51225', '7.92974320', '80.87098720'),
(1569, 21, 'Elahera', 'ඇලහැර', 'எலஹெரா', NULL, NULL, NULL, '51258', '7.73438700', '80.79347980'),
(1570, 21, 'Giritale', 'ගිරිතලේ', 'கிரிதலே', NULL, NULL, NULL, '51026', '8.00235640', '80.92492120'),
(1571, 21, 'Hingurakdamana', 'හිඟුරක්දමන', 'ஹிங்குரக்டமன', NULL, NULL, NULL, '51408', '8.04158880', '80.95323590'),
(1572, 21, 'Hingurakgoda', 'හිඟුරක්ගොඩ', 'இங்குராகொடை', NULL, NULL, NULL, '51400', '8.04158880', '80.95323590'),
(1573, 21, 'Jayanthipura', 'ජයන්තිපුර', 'ஜெயந்திபுரா', NULL, NULL, NULL, '51024', '7.94831560', '81.00178270'),
(1574, 21, 'Kalingaela', 'කාලිංගඇල', 'கலிங்கேலா', NULL, NULL, NULL, '51002', '7.94033840', '81.01879840'),
(1575, 21, 'Lakshauyana', 'ලක්ෂඋයන', 'லக்ஷௌயன', NULL, NULL, NULL, '51006', '7.99050680', '80.99953870'),
(1576, 21, 'Mankemi', 'මන්කෙමි', 'மான்கெமி', NULL, NULL, NULL, '30442', '7.94033840', '81.01879840'),
(1577, 21, 'Minneriya', 'මින්නේරිය', 'மின்னேரியா', NULL, NULL, NULL, '51410', '8.03867090', '80.90639220'),
(1578, 21, 'Onegama', 'ඕනගම', 'ஒன்கம', NULL, NULL, NULL, '51004', '7.97767770', '81.09202180'),
(1579, 21, 'Orubendi Siyambalawa', 'ඔරුබැඳි සියඹලාව', 'ஒருபெண்டி சியம்பலாவா', NULL, NULL, NULL, '51256', '7.75360980', '80.81286360'),
(1580, 21, 'Palugasdamana', 'පලුගස්දමන', 'பலுகஸ்தமன', NULL, NULL, NULL, '51046', '7.96545990', '81.02577630'),
(1581, 21, 'Panichankemi', 'පනිචංකෙමි', 'பனிசங்கேமி', NULL, NULL, NULL, '30444', '7.94033840', '81.01879840'),
(1582, 21, 'Polonnaruwa', 'පොළොන්නරුව', 'பொலநறுவை', NULL, NULL, NULL, '51000', '7.96191410', '80.99523530'),
(1583, 21, 'Talpotha', 'තල්පොත', 'தல்போத', NULL, NULL, NULL, '51044', '8.03145710', '81.03401510'),
(1584, 21, 'Tambala', 'තඹල', 'தம்பாலா', NULL, NULL, NULL, '51049', '8.00939770', '81.06970530'),
(1585, 21, 'Unagalavehera', 'උණගලවෙහෙර', 'உனகலவெஹர', NULL, NULL, NULL, '51008', '8.01190430', '80.99125140'),
(1586, 21, 'Wijayabapura', 'විජයබාපුර', 'விஜயபாபுரா', NULL, NULL, NULL, '51042', '7.82271190', '81.18569940'),
(1587, 22, 'Adippala', 'අඩිප්පල', 'அடிப்பாலா', NULL, NULL, NULL, '61012', '7.67343660', '79.87728340'),
(1588, 22, 'Alutgama', 'අළුත්ගම', 'அளுத்கம', NULL, NULL, NULL, '12080', '7.56666700', '79.90000000'),
(1589, 22, 'Alutwewa', 'අළුත්වැව', 'அலுத்வேவா', NULL, NULL, NULL, '51014', '7.98333300', '80.40000000'),
(1590, 22, 'Ambakandawila', 'අඹකඳවිල', 'அம்பகண்டவில', NULL, NULL, NULL, '61024', '7.52756270', '79.79363220'),
(1591, 22, 'Anamaduwa', 'ආනමඩුව', 'ஆனைமடு', NULL, NULL, NULL, '61500', '7.87777030', '80.01111560'),
(1592, 22, 'Andigama', 'අඬිගම', 'ஆண்டிகம', NULL, NULL, NULL, '61508', '7.77828890', '79.94864890'),
(1593, 22, 'Angunawila', 'අඟුණවිල', 'அங்குனாவில', NULL, NULL, NULL, '61264', '7.75339880', '79.86048310'),
(1594, 22, 'Attawilluwa', 'අත්තවිල්ලුව', 'அட்டவில்லுவா', NULL, NULL, NULL, '61328', '7.96055990', '79.88008320'),
(1595, 22, 'Bangadeniya', 'බංගදෙණිය', 'பங்கதெனிய', NULL, NULL, NULL, '61238', '7.62805620', '79.82547220'),
(1596, 22, 'Baranankattuwa', 'බරණන්කට්ටුව', 'பரனங்கட்டுவ', NULL, NULL, NULL, '61262', '7.80192840', '79.87168370'),
(1597, 22, 'Battuluoya', 'බත්තුලුඔය', 'பட்டுலுஓயா', NULL, NULL, NULL, '61246', '7.73377000', '79.82407150'),
(1598, 22, 'Bujjampola', 'බුජ්ජම්පොල', 'புஜ்ஜம்போல', NULL, NULL, NULL, '61136', '7.32716380', '79.91647170'),
(1599, 22, 'Chilaw', 'හලාවත', 'சிலாபம்', NULL, NULL, NULL, '61000', '7.56198940', '79.80165690'),
(1600, 22, 'Dalukana', 'දලුකන', 'டலுகானா', NULL, NULL, NULL, '51092', '8.04079130', '79.83938600'),
(1601, 22, 'Dankotuwa', 'දංකොටුව', 'தங்கொட்டுவ', NULL, NULL, NULL, '61130', '7.29746350', '79.88218810'),
(1602, 22, 'Dewagala', 'දේවගල', 'தேவகல', NULL, NULL, NULL, '51094', '8.04079130', '79.83938600'),
(1603, 22, 'Dummalasuriya', 'දුම්මලසූරිය', 'தும்மலசூரிய', NULL, NULL, NULL, '60260', '7.49240010', '79.91087440'),
(1604, 22, 'Dunkannawa', 'දුන්කන්නාව', 'டங்கன்னாவா', NULL, NULL, NULL, '61192', '7.41867940', '79.91003190'),
(1605, 22, 'Eluwankulama', 'එළුවන්කුලම', 'எழுவன்குளம', NULL, NULL, NULL, '61308', '8.27308210', '79.88008320'),
(1606, 22, 'Ettale', 'ඇත්තලේ', 'எட்டாலே', NULL, NULL, NULL, '61343', '8.04079130', '79.83938600'),
(1607, 22, 'Galamuna', 'ගලමුන', 'கலமுனா', NULL, NULL, NULL, '51416', '7.46616800', '79.87308370'),
(1608, 22, 'Galmuruwa', 'ගල්මුරුව', 'கல்முருவா', NULL, NULL, NULL, '61233', '7.50282450', '79.89967890'),
(1609, 22, 'Hansayapalama', 'හංසයාපාලම', 'ஹன்சயபாலம', NULL, NULL, NULL, '51098', '8.04079130', '79.83938600'),
(1610, 22, 'Ihala Kottaramulla', 'ඉහළ කොට්ටාරමුල්ල', 'இஹல கொட்டாரமுல்ல', NULL, NULL, NULL, '61154', '7.37820890', '79.87588350'),
(1611, 22, 'Ilippadeniya', 'ඉලිප්පදෙණිය', 'இலிப்பதெனிய', NULL, NULL, NULL, '61018', '7.57059860', '79.82687290'),
(1612, 22, 'Inginimitiya', 'ඉඟිනිමිටිය', 'இங்கினிமிட்டிய', NULL, NULL, NULL, '61514', '7.98668480', '79.95908080'),
(1613, 22, 'Ismailpuram', 'ඉස්මයිල්පුරම්', 'இஸ்மாயில்புரம்', NULL, NULL, NULL, '61302', '8.04079130', '79.83938600'),
(1614, 22, 'Jayasiripura', 'ජයසිරිපුර', 'ஜெயஸ்ரீபுர', NULL, NULL, NULL, '51246', '7.57565870', '80.04510950'),
(1615, 22, 'Kakkapalliya', 'කාක්කපල්ලිය', 'காக்கப்பள்ளியா', NULL, NULL, NULL, '61236', '7.52771560', '79.82127000'),
(1616, 22, 'Kalkudah', 'කල්කුඩා', 'கல்குடா', NULL, NULL, NULL, '30410', '8.11736840', '79.71523340'),
(1617, 22, 'Kalladiya', 'කල්අඩිය', 'கல்லடியா', NULL, NULL, NULL, '61534', '7.99048070', '79.89408060'),
(1618, 22, 'Kandakuliya', 'කන්දකුලිය', 'கந்தகுளியா', NULL, NULL, NULL, '61358', '8.20374730', '79.70072110'),
(1619, 22, 'Karathivu', 'කරතිව්', 'காரைதீவு', NULL, NULL, NULL, '61307', '8.04079130', '79.83938600'),
(1620, 22, 'Karawitagara', 'කරවිටාගාර', 'கரவிட்டகர', NULL, NULL, NULL, '61022', '7.56708100', '79.84788080'),
(1621, 22, 'Karuwalagaswewa', 'කරුවලගස්වැව', 'கருவலகஸ்வெவ', NULL, NULL, NULL, '61314', '8.05657590', '79.95564240'),
(1622, 22, 'Katuneriya', 'කටුනේරිය', 'கட்டுனேரியா', NULL, NULL, NULL, '61180', '7.37062070', '79.83527670'),
(1623, 22, 'Koswatta', 'කොස්වත්ත', 'கொஸ்வத்த', NULL, NULL, NULL, '61158', '7.39206080', '79.90126710'),
(1624, 22, 'Kottantivu', 'කොට්ටන්තිව්', 'கொட்டன்தீவு', NULL, NULL, NULL, '61252', '7.86167050', '79.79044750'),
(1625, 22, 'Kottapitiya', 'කෝට්ටපිටිය', 'கொட்டபிட்டிய', NULL, NULL, NULL, '51244', '7.63588320', '79.81706750'),
(1626, 22, 'Kottukachchiya', 'කොට්ටුකච්චිය', 'கொட்டுகச்சியா', NULL, NULL, NULL, '61532', '7.94069150', '79.94725020'),
(1627, 22, 'Kumarakattuwa', 'කුමාරකට්ටුව', 'குமாரகட்டுவ', NULL, NULL, NULL, '61032', '7.63411080', '79.87432630'),
(1628, 22, 'Kurinjanpitiya', 'කුරින්ජන්පිටිය', 'குறிஞ்சன்பிட்டிய', NULL, NULL, NULL, '61356', '8.04079130', '79.83938600'),
(1629, 22, 'Kuruketiyawa', 'කුරුකැටියාව', 'குருகெட்டியாவ', NULL, NULL, NULL, '61516', '8.02027780', '80.05361110'),
(1630, 22, 'Lunuwila', 'ලුණුවිල', 'லுனுவில', NULL, NULL, NULL, '61150', '7.35587820', '79.87265240'),
(1631, 22, 'Madampe', 'මාදම්පේ', 'மாதம்பை', NULL, NULL, NULL, '61230', '7.49723360', '79.84133190'),
(1632, 22, 'Madurankuliya', 'මදුරන්කුලිය', 'மதுரங்குளிய', NULL, NULL, NULL, '61270', '7.90806630', '79.82127000'),
(1633, 22, 'Mahakumbukkadawala', 'මහකුඹුක්කඩවල', 'மஹகும்புக்கடவல', NULL, NULL, NULL, '61272', '7.84787790', '79.88568240'),
(1634, 22, 'Mahauswewa', 'මහඋස්වැව', 'மஹௌஸ்வேவா', NULL, NULL, NULL, '61512', '7.92412600', '80.09679060'),
(1635, 22, 'Mampitiya', 'මාම්පිටිය', 'மம்பிட்டிய', NULL, NULL, NULL, '51090', '8.04079130', '79.83938600'),
(1636, 22, 'Mampuri', 'මාම්පුරි', 'மாம்புரி', NULL, NULL, NULL, '61341', '8.00353730', '79.74072560'),
(1637, 22, 'Mangalaeliya', 'මංගලඑළිය', 'மங்கலேலியா', NULL, NULL, NULL, '61266', '7.85990910', '79.82046190'),
(1638, 22, 'Marawila', 'මාරවිල', 'மாரவில', NULL, NULL, NULL, '61210', '7.42394280', '79.83527670'),
(1639, 22, 'Mudalakkuliya', 'මුදලක්කුලිය', 'முதலக்குளிய', NULL, NULL, NULL, '61506', '7.90806630', '79.82127000'),
(1640, 22, 'Mugunuwatawana', 'මුගුණුවටවන', 'முகனுவடவன', NULL, NULL, NULL, '61014', '7.58338240', '79.85908300'),
(1641, 22, 'Mukkutoduwawa', 'මුක්කුතොඩුවාව', 'முக்குதொடுவாவ', NULL, NULL, NULL, '61274', '7.91833330', '79.76027780'),
(1642, 22, 'Mundel', 'මුන්ඩෙල්', 'முந்தல்', NULL, NULL, NULL, '61250', '7.79755870', '79.80165690'),
(1643, 22, 'Muttibendiwila', 'මුට්ටිබැඳිවිල', 'முட்டிபெந்திவில', NULL, NULL, NULL, '61195', '8.04079130', '79.83938600'),
(1644, 22, 'Nainamadama', 'නයිනමඩම', 'நைனமடம', NULL, NULL, NULL, '61120', '7.31486810', '79.84367960'),
(1645, 22, 'Nalladarankattuwa', 'නල්ලදරන්කට්ටුව', 'நல்லதரன்கட்டுவ', NULL, NULL, NULL, '61244', '7.66371710', '79.83930340'),
(1646, 22, 'Nattandiya', 'නාත්තණ්ඩිය', 'நாத்தாண்டி', NULL, NULL, NULL, '61190', '7.41248700', '79.85908300'),
(1647, 22, 'Nawagattegama', 'නවගත්තේගම', 'நவகத்தேகம', NULL, NULL, NULL, '61520', '8.00129060', '80.10379000'),
(1648, 22, 'Nelumwewa', 'නෙළුම්වැව', 'நெலும்வெவ', NULL, NULL, NULL, '51096', '8.01349020', '79.87002700'),
(1649, 22, 'Norachcholai', 'නොරච්චෝලේ', 'நுரைச்சோலை', NULL, NULL, NULL, '61342', '8.01316760', '79.72423930'),
(1650, 22, 'Pallama', 'පල්ලම', 'பல்லமா', NULL, NULL, NULL, '61040', '7.68439390', '79.92579690'),
(1651, 22, 'Palliwasalturai', 'පල්ලිවාසල්තුරෙයි', 'பள்ளிவாசல்துறை', NULL, NULL, NULL, '61354', '8.04079130', '79.83938600'),
(1652, 22, 'Panirendawa', 'පනිරෙන්දව', 'பனிரெண்டாவா', NULL, NULL, NULL, '61234', '7.49188440', '79.88848190'),
(1653, 22, 'Parakramasamudraya', 'පරාක්‍රමසමුද්‍රය', 'பராக்ரமஸமுদ்ராய', NULL, NULL, NULL, '51016', '7.89959000', '80.97052920'),
(1654, 22, 'Pothuwatawana', 'පොතුවටවන', 'பொதுவடவன', NULL, NULL, NULL, '61162', '7.35854110', '79.91647120'),
(1655, 22, 'Puttalam', 'පුත්තලම', 'புத்தளம்', NULL, NULL, NULL, '61300', '8.04079130', '79.83938600'),
(1656, 22, 'Puttalam Cement Factory', 'පුත්තලම සිමෙන්ති කම්හල', 'புத்தளம் சீமெந்து தொழிற்ச்சலை', NULL, NULL, NULL, '61326', '7.98782750', '79.86818370'),
(1657, 22, 'Rajakadaluwa', 'රජකදළුව', 'ராஜகடலுவ', NULL, NULL, NULL, '61242', '7.65644900', '79.83807780'),
(1658, 22, 'Saliyawewa Junction', 'සාලියවැව හන්දිය', 'சாலியவெவ சந்தி', NULL, NULL, NULL, '61324', '8.19340770', '80.09399780'),
(1659, 22, 'Serukele', 'සේරුකැලේ', 'செருகேலே', NULL, NULL, NULL, '61042', '7.72661490', '79.91813320'),
(1660, 22, 'Siyambalagashene', 'සියඹලාගස්හේනේ', 'சியம்பலாகாஷேனே', NULL, NULL, NULL, '61504', '8.04079130', '79.83938600'),
(1661, 22, 'Tabbowa', 'තබ්බෝව', 'தப்போவா', NULL, NULL, NULL, '61322', '8.08612210', '79.92635980'),
(1662, 22, 'Talawila Church', 'තලවිල පල්ලිය', 'தலவில தேவாலயம்', NULL, NULL, NULL, '61344', '8.11254360', '79.70345860'),
(1663, 22, 'Toduwawa', 'තොඩුවාව', 'தொடுவாவ', NULL, NULL, NULL, '61224', '7.48590270', '79.80305800'),
(1664, 22, 'Udappuwa', 'උඩප්පුව', 'உடப்புவ', NULL, NULL, NULL, '61004', '7.73584470', '79.79885470'),
(1665, 22, 'Uridyawa', 'උරිද්යාව', 'உரித்யாவா', NULL, NULL, NULL, '61502', '8.04079130', '79.83938600'),
(1666, 22, 'Vanathawilluwa', 'වනාතවිල්ලුව', 'வனத்தவில்லுவா', NULL, NULL, NULL, '61306', '8.18693150', '79.86118320'),
(1667, 22, 'Waikkal', 'වයික්කාල', 'வைக்காலை', NULL, NULL, NULL, '61110', '7.28379190', '79.85776340'),
(1668, 22, 'Watugahamulla', 'වතුගහමුල්ල', 'வடுகஹமுல்ல', NULL, NULL, NULL, '61198', '8.04079130', '79.83938600'),
(1669, 22, 'Wennappuwa', 'වෙන්නප්පුව', 'வென்னப்புவ', NULL, NULL, NULL, '61170', '7.34930370', '79.83527670'),
(1670, 22, 'Wijeyakatupotha', 'විජයකටුපොත', 'விஜேயகதுபொத', NULL, NULL, NULL, '61006', '7.72412290', '79.86888370'),
(1671, 22, 'Wilpotha', 'විල්පොත', 'வில்பொத', NULL, NULL, NULL, '61008', '7.74582630', '79.88008320'),
(1672, 22, 'Yodaela', 'යෝඩඇල', 'யோடேலா', NULL, NULL, NULL, '51422', '7.56666670', '79.86666670'),
(1673, 22, 'Yogiyana', 'යෝගියානා', 'யோக்கியனா', NULL, NULL, NULL, '61144', '7.28876750', '79.92626600'),
(1674, 23, 'Akarella', 'අකරැල්ල', 'அகரெல்லா', NULL, NULL, NULL, '70082', '6.59053290', '80.64795240'),
(1675, 23, 'Amunumulla', 'අමුනුමුල්ල', 'அமுனுமுல்ல', NULL, NULL, NULL, '90204', '6.71459120', '80.78721850'),
(1676, 23, 'Atakalanpanna', 'අටකලන්පන්න', 'அடகலன்பண்ண', NULL, NULL, NULL, '70294', '6.54066950', '80.59105670'),
(1677, 23, 'Ayagama', 'අයගම', 'அயகம', NULL, NULL, NULL, '70024', '6.63772660', '80.31255370'),
(1678, 23, 'Balangoda', 'බලන්ගොඩ', 'பலாங்கொடை', NULL, NULL, NULL, '70100', '6.64252200', '80.68873330'),
(1679, 23, 'Batatota', 'බටතොට', 'படடோட்டா', NULL, NULL, NULL, '70504', '6.70557420', '80.38473450'),
(1680, 23, 'Beralapanathara', 'බෙරලපනතර', 'பேரலபநாதரா', NULL, NULL, NULL, '81541', '6.70557420', '80.38473450'),
(1681, 23, 'Bogahakumbura', 'බෝගහකුඹුර', 'போகஹகும்புர', NULL, NULL, NULL, '90354', '6.86329850', '80.87375390'),
(1682, 23, 'Bolthumbe', 'බොල්තුඹෙ', 'போல்தும்பே', NULL, NULL, NULL, '70131', '6.74284770', '80.66875800'),
(1683, 23, 'Bomluwageaina', 'බොම්ලුවගෙයින', 'பொம்லுவாகைன', NULL, NULL, NULL, '70344', '6.70557420', '80.38473450'),
(1684, 23, 'Bowalagama', 'බෝවලගම', 'போவலகம', NULL, NULL, NULL, '82458', '6.67928120', '80.40647070'),
(1685, 23, 'Bulutota', 'බුලුතොට', 'புலுதோட்டா', NULL, NULL, NULL, '70346', '6.47066510', '80.61208900'),
(1686, 23, 'Dambuluwana', 'දඹුලුවාන', 'தம்புலுவான', NULL, NULL, NULL, '70019', '6.70183190', '80.32688120'),
(1687, 23, 'Daugala', 'දවුගල', 'டௌகலா', NULL, NULL, NULL, '70455', '6.70557420', '80.38473450'),
(1688, 23, 'Dela', 'දෙල', 'டெலா', NULL, NULL, NULL, '70042', '6.62049340', '80.45420740'),
(1689, 23, 'Delwala', 'දෙල්වල', 'டெல்வாலா', NULL, NULL, NULL, '70046', '6.51666700', '80.46666700'),
(1690, 23, 'Dodampe', 'දොඩම්පෙ', 'தொடம்பே', NULL, NULL, NULL, '70017', '6.74794090', '80.31465020'),
(1691, 23, 'Doloswalakanda', 'දොලොස්වලකන්ද', 'டோலோஸ்வலகந்த', NULL, NULL, NULL, '70404', '6.57442010', '80.45060660'),
(1692, 23, 'Dumbara Manana', 'දුම්බර මනන', 'தும்பரா மனனா', NULL, NULL, NULL, '70495', '6.68239770', '80.24271850'),
(1693, 23, 'Eheliyagoda', 'ඇහැළියගොඩ', 'எஹலியகொட', NULL, NULL, NULL, '70600', '6.84856380', '80.26001000'),
(1694, 23, 'Ekamutugama', 'එකමුතුගම', 'ஏகமுதுகம', NULL, NULL, NULL, '70254', '6.67008500', '80.39535200'),
(1695, 23, 'Elapatha', 'ඇලපාත', 'எலபத', NULL, NULL, NULL, '70032', '6.65911030', '80.37004070'),
(1696, 23, 'Ellagawa', 'ඇල්ලගාව', 'எல்லகவா', NULL, NULL, NULL, '70492', '6.73322300', '80.21481700'),
(1697, 23, 'Ellaulla', 'ඇල්ලඋල', 'எல்லாவுல்லா', NULL, NULL, NULL, '70552', '6.70557420', '80.38473450'),
(1698, 23, 'Ellawala', 'ඇල්ලවල', 'எல்லாவல', NULL, NULL, NULL, '70606', '6.80892830', '80.26279730'),
(1699, 23, 'Embilipitiya', 'ඇඹිලිපිටිය', 'எம்பிலிபிட்டிய', NULL, NULL, NULL, '70200', '6.31623240', '80.84331450'),
(1700, 23, 'Eratna', 'එරත්න', 'எரத்னா', NULL, NULL, NULL, '70506', '6.83500650', '80.40830880'),
(1701, 23, 'Erepola', 'එරෙපොල', 'எரெபோல', NULL, NULL, NULL, '70602', '6.80329990', '80.24607180'),
(1702, 23, 'Gabbela', 'ගබ්බෙල', 'கபேலா', NULL, NULL, NULL, '70156', '6.51347930', '80.54662290'),
(1703, 23, 'Gangeyaya', 'ගන්ගෙයාය', 'கங்கேயாய', NULL, NULL, NULL, '70195', '6.37398870', '80.83777890'),
(1704, 23, 'Gawaragiriya', 'ගවරගිරිය', 'கவரகிரிய', NULL, NULL, NULL, '70026', '6.65040560', '80.26279730'),
(1705, 23, 'Gillimale', 'ගිලීමලේ', 'கில்லிமலே', NULL, NULL, NULL, '70002', '6.75193930', '80.42670370'),
(1706, 23, 'Godakawela', 'ගොඩකවැල', 'கொடகவெல', NULL, NULL, NULL, '70160', '6.50490600', '80.65211390'),
(1707, 23, 'Gurubewilagama', 'ගුරුබෙවිලගම', 'குருபேவிலகம', NULL, NULL, NULL, '70136', '7.87305400', '80.77179700'),
(1708, 23, 'Halwinna', 'හල්වින්න', 'ஹல்வின்னா', NULL, NULL, NULL, '70171', '6.70557420', '80.38473450'),
(1709, 23, 'Handagiriya', 'හඳගිරිය', 'ஹந்தகிரிய', NULL, NULL, NULL, '70106', '6.55213540', '80.78240120'),
(1710, 23, 'Hatangala', 'හටංගල', 'ஹடங்கலா', NULL, NULL, NULL, '70105', '6.54269300', '80.74005370'),
(1711, 23, 'Hatarabage', 'තරබාගේ', 'ஹடராபாகே', NULL, NULL, NULL, '70108', '6.65824100', '80.74914430'),
(1712, 23, 'Hewanakumbura', 'හේවානකුඹුර', 'ஹெவனகும்புரா', NULL, NULL, NULL, '90358', '7.30570880', '80.67377420'),
(1713, 23, 'Hidellana', 'හිදැල්ලන', 'ஹிடெல்லானா', NULL, NULL, NULL, '70012', '6.71422580', '80.38604590'),
(1714, 23, 'Hiramadagama', 'හිරමඩගම', 'ஹிரமடகம', NULL, NULL, NULL, '70296', '6.53431270', '80.60354940'),
(1715, 23, 'Horewelagoda', 'හොරේවෙලගොඩ', 'ஹொரேவெலகொட', NULL, NULL, NULL, '82456', '6.72834120', '80.39381100'),
(1716, 23, 'Ittakanda', 'ඉත්තකන්ද', 'இட்டகண்டா', NULL, NULL, NULL, '70342', '6.40196150', '80.63824130'),
(1717, 23, 'Kahangama', 'කහන්ගම', 'கஹங்கம', NULL, NULL, NULL, '70016', '6.71312360', '80.35647920'),
(1718, 23, 'Kahawatta', 'කහවත්ත', 'கஹவத்தை', NULL, NULL, NULL, '70150', '6.57553120', '80.57457300'),
(1719, 23, 'Kalawana', 'කලවාන', 'களவான', NULL, NULL, NULL, '70450', '6.53171360', '80.39648240'),
(1720, 23, 'Kaltota', 'කල්තොට', 'கல்தோட்டை', NULL, NULL, NULL, '70122', '6.65939600', '80.87098720'),
(1721, 23, 'Kalubululanda', 'කළුබුළුලන්ද', 'கலுபுலுலண்டா', NULL, NULL, NULL, '90352', '6.72834120', '80.39381100'),
(1722, 23, 'Kananke Bazaar', 'කනන්කේ බසාර්', 'கனங்கே பஜார்', NULL, NULL, NULL, '80136', '6.01876550', '80.44209920'),
(1723, 23, 'Kandepuhulpola', 'කන්දෙපුහුල්පොල', 'கந்தேபுஹுல்பொல', NULL, NULL, NULL, '90356', '6.83668260', '80.86822030'),
(1724, 23, 'Karandana', 'කරඳන', 'கரந்தன', NULL, NULL, NULL, '70488', '6.78270350', '80.21839510'),
(1725, 23, 'Karangoda', 'කරංගොඩ', 'கரங்கொட', NULL, NULL, NULL, '70018', '6.67757110', '80.39578850'),
(1726, 23, 'Kella Junction', 'කෑල්ල හන්දිය', 'கெல்ல சந்திப்பு', NULL, NULL, NULL, '70352', '6.36110440', '80.69191190'),
(1727, 23, 'Keppetipola', 'කැප්පෙටිපොළ', 'கெப்பெட்டிபொல', NULL, NULL, NULL, '90350', '7.16325170', '80.57053960'),
(1728, 23, 'Kiriella', 'කිරිඇල්ල', 'கிரியெல்ல', NULL, NULL, NULL, '70480', '6.72950380', '80.27046020'),
(1729, 23, 'Kiriibbanwewa', 'කිරිඉබ්බන්වැව', 'கிரிப்பன்வெவ', NULL, NULL, NULL, '70252', '6.37767420', '80.97191080'),
(1730, 23, 'Kolambage Ara', 'කොළඹගේ ආර', 'கொலம்பகே ஆரா', NULL, NULL, NULL, '70180', '6.41835640', '80.78032380'),
(1731, 23, 'Kolombugama', 'කොළඹගම', 'கொலம்புகம', NULL, NULL, NULL, '70403', '6.56783560', '80.49382670'),
(1732, 23, 'Kolonna', 'කොළොන්න', 'கொலொன்னா', NULL, NULL, NULL, '70350', '6.40528450', '80.68522530'),
(1733, 23, 'Kudawa', 'කුඩාව', 'குடவா', NULL, NULL, NULL, '70005', '6.44335460', '80.41705720'),
(1734, 23, 'Kuruwita', 'කුරුවිට', 'குருவிட்டை', NULL, NULL, NULL, '70500', '6.82184030', '80.36150790'),
(1735, 23, 'Lellopitiya', 'ලෙල්ලොපිටිය', 'லெல்லோபிட்டிய', NULL, NULL, NULL, '70056', '6.66396700', '80.48409740'),
(1736, 23, 'Imaduwa', 'ඉමදූව', 'இமதுவ', NULL, NULL, NULL, '80130', '6.03598780', '80.39039020'),
(1737, 23, 'Imbulpe', 'ඉඹුල්පේ', 'இம்புல்பே', NULL, NULL, NULL, '70134', '6.70081730', '80.75331260'),
(1738, 23, 'Mahagama Colony', 'මහගම ජනපදය', 'மகாகம காலனி', NULL, NULL, NULL, '70256', '7.37879790', '80.38395840'),
(1739, 23, 'Mahawalatenna', 'මහාවලතැන්න', 'மஹாவலதென்ன', NULL, NULL, NULL, '70112', '6.58708770', '80.74860620'),
(1740, 23, 'Makandura', 'මාකඳුර', 'மகந்துர', NULL, NULL, NULL, '70298', '6.55328880', '80.63130410'),
(1741, 23, 'Malwala Junction', 'මල්වල හන්දිය', 'மல்வல சந்தி', NULL, NULL, NULL, '70001', '6.68217430', '80.40973490'),
(1742, 23, 'Malwatta', 'මල්වත්ත', 'மல்வத்தை', NULL, NULL, NULL, '32198', '6.50997090', '80.64101600'),
(1743, 23, 'Matuwagalagama', 'මතුවාගලගම', 'மட்டுவாகலகம', NULL, NULL, NULL, '70482', '6.70557420', '80.38473450'),
(1744, 23, 'Medagalature', 'මැදගලතුරේ', 'மெடகலச்சூர்', NULL, NULL, NULL, '70021', '6.67757110', '80.39578850'),
(1745, 23, 'Meddekanda', 'මැද්දෙකන්ද', 'மெடேகண்டா', NULL, NULL, NULL, '70127', '6.67524330', '80.65904940'),
(1746, 23, 'Minipura Dumbara', 'මිණිපුර දුම්බර', 'மினிபுரா தும்பரா', NULL, NULL, NULL, '70494', '6.71593270', '80.21391730'),
(1747, 23, 'Mitipola', 'මිටිපොල', 'மிட்டிபோல', NULL, NULL, NULL, '70604', '6.83459390', '80.22376600'),
(1748, 23, 'Moragala Kirillapone', 'මොරගල කිරිල්ලපොන', 'மொரகல கிரில்லபொன்', NULL, NULL, NULL, '81532', '6.85774360', '80.25582880'),
(1749, 23, 'Morahela', 'මොරහැල', 'மொரஹெலா', NULL, NULL, NULL, '70129', '6.68509810', '80.69094480'),
(1750, 23, 'Mulendiyawala', 'මුල්ඇඩියාවල', 'முலேந்தியாவல', NULL, NULL, NULL, '70212', '6.28868400', '80.77132100'),
(1751, 23, 'Mulgama', 'මුල්ගම', 'முல்கம', NULL, NULL, NULL, '70117', '6.66605170', '80.81765100'),
(1752, 23, 'Nawalakanda', 'නාවලකන්ද', 'நாவலகந்த', NULL, NULL, NULL, '70469', '6.24460700', '80.14345730'),
(1753, 23, 'Nawinnapinnakanda', 'නාවින්නපින්නකන්ඳ', 'நாவின்னாபின்னகந்த', NULL, NULL, NULL, '70165', '6.70557420', '80.38473450'),
(1754, 23, 'Niralagama', 'නිරලගම', 'நிரலாகம', NULL, NULL, NULL, '70038', '6.70557420', '80.38473450'),
(1755, 23, 'Nivitigala', 'නිවිතිගල', 'நிவிதிகலை', NULL, NULL, NULL, '70400', '6.59588500', '80.45776700'),
(1756, 23, 'Omalpe', 'ඕමල්පේ', 'ஓமல்பே', NULL, NULL, NULL, '70215', '6.32676260', '80.69649050'),
(1757, 23, 'Opanayaka', 'ඕපනායක', 'ஓப்பனாயாக', NULL, NULL, NULL, '70080', '6.62375960', '80.68743720'),
(1758, 23, 'Padalangala', 'පදලංගල', 'படலங்கல', NULL, NULL, NULL, '70230', '6.24917790', '80.91524340'),
(1759, 23, 'Pallebedda', 'පල්ලෙබැද්ද', 'பல்லேபெத்தா', NULL, NULL, NULL, '70170', '6.48273980', '80.70644890'),
(1760, 23, 'Pallekanda', 'පල්ලෙකන්ද', 'பல்லேகந்த', NULL, NULL, NULL, '82454', '6.63603730', '80.68123880'),
(1761, 23, 'Pambagolla', 'පඹගොල්ල', 'பம்பகொல்ல', NULL, NULL, NULL, '70133', '6.69048710', '80.37989330'),
(1762, 23, 'Panamura', 'පණාමුර', 'பனமுரா', NULL, NULL, NULL, '70218', '6.34352750', '80.77319320'),
(1763, 23, 'Panapola', 'පනාපොළ', 'பனாபொல', NULL, NULL, NULL, '70461', '6.43003730', '80.44934050'),
(1764, 23, 'Paragala', 'පරගල', 'பரகல', NULL, NULL, NULL, '81474', '6.59648320', '80.33802130'),
(1765, 23, 'Parakaduwa', 'පරකඩුව', 'பரகடுவ', NULL, NULL, NULL, '70550', '6.82570290', '80.30738260'),
(1766, 23, 'Pebotuwa', 'පෙබොටුව', 'பெபொடுவ', NULL, NULL, NULL, '70045', '6.52792350', '80.45381770'),
(1767, 23, 'Pelmadulla', 'පැල්මඩුල්ල', 'பெல்மடுல்லை', NULL, NULL, NULL, '70070', '6.63448470', '80.52995410'),
(1768, 23, 'Pinnawala', 'පින්නවල', 'பின்னவலை', NULL, NULL, NULL, '70130', '7.30097050', '80.38715630'),
(1769, 23, 'Pothdeniya', 'පොත්දෙණිය', 'பொத்தெனிய', NULL, NULL, NULL, '81538', '6.70824960', '80.38266440'),
(1770, 23, 'Rajawaka', 'රජවක', 'ராஜவக', NULL, NULL, NULL, '70116', '6.60274090', '80.80732590'),
(1771, 23, 'Ranwala', 'රන්වල', 'ரன்வாலா', NULL, NULL, NULL, '70162', '6.54729140', '80.66321030'),
(1772, 23, 'Rassagala', 'රාස්සගල', 'ராஸ்ஸகல', NULL, NULL, NULL, '70135', '6.69234870', '80.63789450'),
(1773, 23, 'Rathgama', 'රත්ගම', 'ரத்கம', NULL, NULL, NULL, '80260', '6.71516980', '80.46888050'),
(1774, 23, 'Ratna Hangamuwa', 'රත්න හංගමුව', 'ரத்ன ஹங்கமுவ', NULL, NULL, NULL, '70036', '6.64236010', '80.39091640'),
(1775, 23, 'Ratnapura', 'රත්නපුර', 'இரத்தினபுரி', NULL, NULL, NULL, '70000', '6.69514540', '80.37274290'),
(1776, 23, 'Sewanagala', 'සෙවණගල', 'செவனகல', NULL, NULL, NULL, '70250', '6.35989160', '80.91956050'),
(1777, 23, 'Sri Palabaddala', 'ශ්‍රී පලාබද්දල', 'ஸ்ரீ பாலபத்தலா', NULL, NULL, NULL, '70004', '6.78906410', '80.46046430'),
(1778, 23, 'Sudagala', 'සුදාගල', 'சுதாகலா', NULL, NULL, NULL, '70502', '6.80890880', '80.39369940'),
(1779, 23, 'Thalakolahinna', 'තලකොළහින්න', 'தலகொலஹின்ன', NULL, NULL, NULL, '70101', '6.70557420', '80.38473450'),
(1780, 23, 'Thanjantenna', 'තන්ජන්තැන්න', 'தஞ்சந்தென்ன', NULL, NULL, NULL, '70118', '6.63349430', '80.84573630'),
(1781, 23, 'Theppanawa', 'තෙප්පනාව', 'தெப்பனாவ', NULL, NULL, NULL, '70512', '6.74944380', '80.34602730'),
(1782, 23, 'Thunkama', 'තුංකම', 'தூங்காம', NULL, NULL, NULL, '70205', '6.27825950', '80.88827770'),
(1783, 23, 'Udakarawita', 'උඩකරවිට', 'உடகரவிட்ட', NULL, NULL, NULL, '70044', '6.59280220', '80.45945050'),
(1784, 23, 'Udaniriella', 'උඩනිරිඇල්ල', 'உதநிரியெல்லா', NULL, NULL, NULL, '70034', '6.72950380', '80.27046020'),
(1785, 23, 'Udawalawe', 'උඩවලවේ', 'உடவலவே', NULL, NULL, NULL, '70190', '6.40556190', '80.80205430'),
(1786, 23, 'Ullinduwawa', 'උල්ලිඳුවාව', 'உள்ளிந்துவாவ', NULL, NULL, NULL, '70345', '6.37019760', '80.62714150'),
(1787, 23, 'Veddagala', 'වැද්දාගල', 'வெத்தகல', NULL, NULL, NULL, '70459', '6.46458460', '80.43202860'),
(1788, 23, 'Vijeriya', 'විජේරිය', 'விஜேரியா', NULL, NULL, NULL, '70348', '6.41732680', '80.65359580'),
(1789, 23, 'Waleboda', 'වලේබොඩ', 'வாலேபோடா', NULL, NULL, NULL, '70138', '6.72651570', '80.66400360'),
(1790, 23, 'Watapotha', 'වටාපොත', 'வடபோத', NULL, NULL, NULL, '70408', '6.72834120', '80.39381100'),
(1791, 23, 'Waturawa', 'වටුරාව', 'வடுரவ', NULL, NULL, NULL, '70456', '6.49853270', '80.44456110'),
(1792, 23, 'Weligepola', 'වැලිගෙපොල', 'வெலிகேபொல', NULL, NULL, NULL, '70104', '6.57180590', '80.70480840'),
(1793, 23, 'Welipathayaya', 'වැලිපතයාය', 'வெலிபதாயாய', NULL, NULL, NULL, '70124', '6.61981170', '80.87375390'),
(1794, 23, 'Wikiliya', 'විකිලිය', 'விக்கிலியா', NULL, NULL, NULL, '70114', '6.62149100', '80.75054170'),
(1795, 24, 'Agbopura', 'අග්බෝපුර', 'அக்போபுரா', NULL, NULL, NULL, '31304', '8.33139520', '80.97648920'),
(1796, 24, 'Buckmigama', 'බක්මීගම', 'பக்மிகம', NULL, NULL, NULL, '31028', '8.58736380', '81.21521210'),
(1797, 24, 'China Bay', 'චීන වරාය', 'சீன குடா', NULL, NULL, NULL, '31050', '8.56292020', '81.19900940'),
(1798, 24, 'Dehiwatte', 'දෙහිවත්ත', 'தெஹிவத்தை', NULL, NULL, NULL, '31226', '8.58736380', '81.21521210'),
(1799, 24, 'Echchilampattai', 'එච්චිලම්පට්ටෙයි', 'எச்சிலம்பட்டை', NULL, NULL, NULL, '31236', '8.58736380', '81.21521210'),
(1800, 24, 'Galmetiyawa', 'ගල්මැටියාව', 'கல்மெட்டியாவ', NULL, NULL, NULL, '31318', '8.58736380', '81.21521210'),
(1801, 24, 'Gomarankadawala', 'ගෝමරන්කඩවල', 'கோமரன்கடவல', NULL, NULL, NULL, '31026', '8.67503840', '80.96324230'),
(1802, 24, 'Kaddaiparichchan', 'කඩ්ඩයිපරිච්චන්', 'கட்டைபறிச்சான்', NULL, NULL, NULL, '31212', '8.45435440', '81.29179710'),
(1803, 24, 'Kallar', 'කල්ලාර්', 'கள்ளாறு', NULL, NULL, NULL, '30250', '8.58736380', '81.21521210'),
(1804, 24, 'Kanniya', 'කන්නියා', 'கிண்ணியா', NULL, NULL, NULL, '31032', '8.59878050', '81.18715150'),
(1805, 24, 'Kantalai', 'කන්තලේ', 'கந்தளாய்', NULL, NULL, NULL, '31300', '8.35126340', '81.00699280'),
(1806, 24, 'Kantalai Sugar Factory', 'කන්තලේ සීනි කර්මාන්ත ශාලාව', 'கந்தளாய் சீனி தொழிற்சாலை', NULL, NULL, NULL, '31306', '8.31672220', '81.04672190'),
(1807, 24, 'Kiliveddy', 'කිලිවෙද්දී', 'கிளிவெட்டி', NULL, NULL, NULL, '31220', '8.36183610', '81.28427020'),
(1808, 24, 'Kinniya', 'කින්නියා', 'கிண்ணியா', NULL, NULL, NULL, '31100', '8.50254730', '81.18038320'),
(1809, 24, 'Kuchchaveli', 'කුච්චවේලි', 'குச்சவெளி', NULL, NULL, NULL, '31014', '8.82138500', '81.09478080'),
(1810, 24, 'Kumburupiddy', 'කුඹුරුපිද්දී', 'கும்புறுப்பிட்டி', NULL, NULL, NULL, '31012', '8.73568790', '81.16096790'),
(1811, 24, 'Kurinchakerny', 'කුරින්චකෙමි', 'குறிஞ்சகெர்னி', NULL, NULL, NULL, '31112', '8.50191580', '81.17199360'),
(1812, 24, 'Lankapatuna', 'ලංකාපටුන', 'லங்காபடுன', NULL, NULL, NULL, '31234', '8.35736110', '81.38962220'),
(1813, 24, 'Mahadivulwewa', 'මහදිවුල්වැව', 'மஹதிவுல்வெவ', NULL, NULL, NULL, '31036', '8.61738580', '80.96427730'),
(1814, 24, 'Maharugiramam', 'මහරුගිරමං', 'மஹருகிராமம்', NULL, NULL, NULL, '31106', '8.58736380', '81.21521210'),
(1815, 24, 'Mallikativu', 'මල්ලිකතිව්', 'மல்லிகதீவு', NULL, NULL, NULL, '31224', '8.58736380', '81.21521210'),
(1816, 24, 'Mawadichenai', 'මාවඩ්චේන', 'மாவடிச்சேனை', NULL, NULL, NULL, '31238', '8.60944630', '81.21638370'),
(1817, 24, 'Mullipothana', 'මුල්ලිපොතන', 'முள்ளிப்பொத்தானை', NULL, NULL, NULL, '31312', '8.42867990', '81.05614580'),
(1818, 24, 'Mutur', 'මුතුර්', 'மூதூர்', NULL, NULL, NULL, '31200', '8.45790650', '81.26840190'),
(1819, 24, 'Neelapola', 'නීලපොල', 'நீலபொல', NULL, NULL, NULL, '31228', '8.37006770', '81.22434440'),
(1820, 24, 'Nilaveli', 'නිලාවැලි', 'நிலாவெளி', NULL, NULL, NULL, '31010', '8.69273310', '81.18852930'),
(1821, 24, 'Pankulam', 'පන්කුලම්', 'பன்குளம்', NULL, NULL, NULL, '31034', '8.62513020', '81.03267950'),
(1822, 24, 'Pulmoddai', 'පුල්මුඩේ', 'புல்மோட்டை', NULL, NULL, NULL, '50567', '8.94455220', '80.98267180'),
(1823, 24, 'Rottawewa', 'රොට්ටවැව', 'ரொட்டவெவ', NULL, NULL, NULL, '31038', '8.59950020', '80.92170210'),
(1824, 24, 'Sampaltivu', 'සම්පල්ටිවූ', 'சாம்பல் தீவு', NULL, NULL, NULL, '31006', '8.63659760', '81.22304850'),
(1825, 24, 'Sampoor', 'සාම්පූර්', 'சம்பூர்', NULL, NULL, NULL, '31216', '8.48224360', '81.28937930'),
(1826, 24, 'Serunuwara', 'සේනුවර', 'சேருநுவர', NULL, NULL, NULL, '31232', '8.32497340', '81.30074050'),
(1827, 24, 'Seruwila', 'සේරුවිල', 'சேருவில', NULL, NULL, NULL, '31260', '8.37057000', '81.31991360'),
(1828, 24, 'Sirajnagar', 'සිරජ්නගර්', 'சிறாஜ்நகர்', NULL, NULL, NULL, '31314', '8.58736380', '81.21521210'),
(1829, 24, 'Somapura', 'සෝමපුර', 'சோமபுரா', NULL, NULL, NULL, '31222', '8.29801560', '81.27665980'),
(1830, 24, 'Tampalakamam', 'තම්පලකාමම්', 'தம்பலகாமம்', NULL, NULL, NULL, '31046', '8.49737520', '81.09202180'),
(1831, 24, 'Thuraineelavanai', 'තුරෛනීලාවනයි', 'துறைநீலாவணை', NULL, NULL, NULL, '30254', '7.44730640', '81.79920570'),
(1832, 24, 'Tiriyayi', 'තිරියයි', 'திரியாயி', NULL, NULL, NULL, '31016', '6.94064680', '79.86132860'),
(1833, 24, 'Toppur', 'තොප්පුර්', 'தோப்பூர்', NULL, NULL, NULL, '31250', '8.40458120', '81.31243410'),
(1834, 24, 'Trincomalee', 'තිරිකුණාමලය', 'திருகோணமலை', NULL, NULL, NULL, '31000', '8.58736380', '81.21521210'),
(1835, 24, 'Wanela', 'වනෙල', 'வனேலா', NULL, NULL, NULL, '31308', '8.38173830', '81.07960500'),
(1836, 25, 'Vavuniya', 'වව්නියාව', 'வவுனியா', NULL, NULL, NULL, '43000', '8.75420290', '80.49824020'),
(1837, 5, 'Colombo 1', 'කොළඹ 1', 'கொழும்பு 1', 'Fort', 'කොටුව', 'கோட்டை', '00100', '6.87587000', '79.86067390'),
(1838, 5, 'Colombo 3', 'කොළඹ 3', 'கொழும்பு 3', 'Colpetty', 'කොල්ලුපිටිය', 'கொள்ளுபிட்டி', '00300', '6.89893440', '79.85376720'),
(1839, 5, 'Colombo 4', 'කොළඹ 4', 'கொழும்பு 4', 'Bambalapitiya', 'බම්බලපිටිය', 'பம்பலப்பிட்டி', '00400', '6.89613350', '79.85714750'),
(1840, 5, 'Colombo 5', 'කොළඹ 5', 'கொழும்பு 5', 'Havelock Town', 'තිඹිරිගස්යාය', 'ஹெவ்லொக் நகரம்', '00500', '6.88879470', '79.86630240'),
(1841, 5, 'Colombo 7', 'කොළඹ 7', 'கொழும்பு 7', 'Cinnamon Gardens', 'කුරුඳු වත්ත', 'கறுவாத் தோட்டம்', '00700', '6.91166520', '79.86456780'),
(1842, 5, 'Colombo 9', 'කොළඹ 9', 'கொழும்பு 9', 'Dematagoda', 'දෙමටගොඩ', 'தெமட்டகொடை', '00900', '6.93677080', '79.86078060'),
(1843, 5, 'Colombo 10', 'කොළඹ 10', 'கொழும்பு 10', 'Maradana', 'මරදාන', 'மருதானை', '01000', '6.92770380', '79.86608360'),
(1844, 5, 'Colombo 11', 'කොළඹ 11', 'கொழும்பு 11', 'Pettah', 'පිට කොටුව', 'புறக் கோட்டை', '01100', '6.93904180', '79.85331900'),
(1845, 5, 'Colombo 12', 'කොළඹ 12', 'கொழும்பு 12', 'Hulftsdorp', 'අලුත් කඩේ', 'புதுக்கடை', '01200', '6.93863620', '79.86091740'),
(1846, 5, 'Colombo 14', 'කොළඹ 14', 'கொழும்பு 14', 'Grandpass', 'ග්‍රන්ඩ්පාස්', 'பாலத்துறை', '01400', '6.94476020', '79.86802080'),
(1847, 5, 'Colombo Secretariant', 'කොළඹ ලේකම්', 'கொழும்பு செயலர்', NULL, NULL, NULL, '00110', '6.93883020', '79.85597300'),
(1848, 5, 'Melle Street', 'මෙල්ල වීදිය', 'மெல்லே தெரு', NULL, NULL, NULL, '00276', '6.92707860', '79.86124300'),
(1849, 5, 'Rifel Street', 'රයිෆල් වීදිය', 'ரைபிள் தெரு', NULL, NULL, NULL, '00279', '6.92381440', '79.85049130'),
(1850, 5, 'Gem & Jewelry', 'මැණික් සහ ස්වර්ණාභරණ', 'ரத்தினம் &amp; நகைகள்', NULL, NULL, NULL, '00370', '6.93265290', '79.84416100'),
(1851, 5, 'Torington Square', 'ටොරින්ටන් චතුරශ්‍රය', 'டோரிங்டன் சதுக்கம்', NULL, NULL, NULL, '00376', '6.90353830', '79.86810980'),
(1852, 5, 'National Museum of Colombo', 'කොළඹ ජාතික කෞතුකාගාරය', 'கொழும்பு தேசிய அருங்காட்சியகம்', NULL, NULL, NULL, '00377', '6.91045550', '79.86099250'),
(1853, 5, 'Colombo Labour Sec', 'කොළඹ කම්කරු අංශය', 'கொழும்பு தொழிலாளர் பிரிவு', NULL, NULL, NULL, '00510', '6.89200690', '79.87642540'),
(1854, 5, 'Polhengoda', 'පොල්හේන්ගොඩ', 'பொல்ஹெங்கொட', NULL, NULL, NULL, '00576', '6.88105880', '79.88013350'),
(1855, 5, 'Anderson Plats', 'ඇන්ඩර්සන් ප්ලැට්ස්', 'ஆண்டர்சன் பிளாட்ஸ்', NULL, NULL, NULL, '00577', '6.89017040', '79.87296210'),
(1856, 5, 'Keppetipola Mawatha', 'කැප්පෙටිපොළ මාවත', 'கெப்பெட்டிபொல மாவத்தை', NULL, NULL, NULL, '00579', '6.92800620', '79.88757070'),
(1857, 5, 'Narahenpita', 'නාරාහේන්පිට', 'நாரஹேன்பிட்டி', NULL, NULL, NULL, '00582', '6.89759340', '79.88148300'),
(1858, 5, 'Kirulapana', 'කිරුළපන', 'கிருலப்பனை', NULL, NULL, NULL, '00677', '6.88147170', '79.87634760'),
(1859, 5, 'University of Colombo', 'කොළඹ විශ්වවිද්‍යාලය', 'கொழும்பு பல்கலைக்கழகம்', NULL, NULL, NULL, '00710', '6.90001490', '79.85879380'),
(1860, 5, 'Colombo General Hospital', 'කොළඹ මහ රෝහල', 'கொழும்பு பொது வைத்தியசாலை', NULL, NULL, NULL, '00779', '6.91874290', '79.86899200'),
(1861, 5, 'Gothami Road', 'ගෝතමී පාර', 'கோதமி சாலை', NULL, NULL, NULL, '00876', '6.91453560', '79.88735650'),
(1862, 5, 'Wanathamulla', 'වනාතමුල්ල', 'வனத்தமுல்ல', NULL, NULL, NULL, '00877', '6.92670930', '79.88148300'),
(1863, 5, 'Baseline Road', 'බේස්ලයින් පාර', 'பேஸ்லைன் சாலை', NULL, NULL, NULL, '00878', '6.93279660', '79.87817750'),
(1864, 5, 'Kopiyawatta', 'කෝපියාවත්ත', 'கோபியாவத்தை', NULL, NULL, NULL, '00879', '6.93369020', '79.87874170'),
(1865, 5, 'Maligawatta', 'මාලිගාවත්ත', 'மாளிகாவத்தை', NULL, NULL, NULL, '01070', '6.93727160', '79.87175120'),
(1866, 5, 'Panchikawatte', 'පංචිකාවත්ත', 'பஞ்சிகாவத்தை', NULL, NULL, NULL, '01078', '6.93096820', '79.86398350'),
(1867, 5, 'Sarasavipaya', 'සරසවිපාය', 'சரஸவிபாய', NULL, NULL, NULL, '01079', '6.90804600', '79.87598160'),
(1868, 5, 'Maligakanda', 'මාලිගාකන්ද', 'மாலிகாகந்த', NULL, NULL, NULL, '01081', '6.92841060', '79.86818370'),
(1869, 5, 'Wolfendal Street', 'වුල්ෆෙන්ඩල් වීදිය', 'உல்ஃபெண்டல் தெரு', NULL, NULL, NULL, '01178', '6.93963520', '79.85430140'),
(1870, 5, 'Pettah Bus Stand', 'පිටකොටුව බස් නැවතුම', 'பேட்டை பேருந்து நிலையம்', NULL, NULL, NULL, '01179', '6.93500540', '79.85456970'),
(1871, 5, 'Colombo Kachcheri', 'කොළඹ කච්චේරිය', 'கொழும்பு கச்சேரி', NULL, NULL, NULL, '01181', '6.93840050', '79.85555210'),
(1872, 5, 'Armour Street', 'ආමර් වීදිය', 'ஆர்மர் தெரு', NULL, NULL, NULL, '01182', '6.94242220', '79.86376180'),
(1873, 5, 'St. Anthony\'s', 'ශාන්ත අන්තෝනි', 'புனித அந்தோணியார்', NULL, NULL, NULL, '01183', '6.93171040', '79.87376180'),
(1874, 5, 'Miraniya Street', 'මිරානියා වීදිය', 'மிரானியா தெரு', NULL, NULL, NULL, '01276', '6.93696440', '79.86364710'),
(1875, 5, 'Wasala Road', 'වාසල පාර', 'வாசாலா சாலை', NULL, NULL, NULL, '01377', '6.95118770', '79.86498570'),
(1876, 5, 'Nagalagam Street', 'නාගලගම් වීදිය', 'நாகலகம் தெரு', NULL, NULL, NULL, '01476', '6.95527300', '79.87651510'),
(1877, 5, 'Aluth Mawatha Road', 'අලුත් මාවත පාර', 'அளுத் மாவத்தை வீதி', NULL, NULL, NULL, '01478', '6.96952880', '79.87322490'),
(1878, 5, 'Mutwal South', 'මුට්වාල් දකුණ', 'முட்வால் தெற்கு', NULL, NULL, NULL, '01479', '6.96692470', '79.87115330'),
(1879, 5, 'Beddagana', 'බැද්දගාන', 'பெத்தகானா', NULL, NULL, NULL, '10101', '6.89149910', '79.90908710'),
(1880, 5, 'Madiwela', 'මාදිවෙල', 'மடிவேலா', NULL, NULL, NULL, '10102', '6.87731530', '79.92346780'),
(1881, 5, 'Sri Perakumpura', 'ශ්‍රී පැරකුම්පුර', 'ஸ்ரீ பேரகும்புரா', NULL, NULL, NULL, '10103', '8.15285510', '80.14564960'),
(1882, 5, 'Mirihana North', 'මිරිහාන උතුර', 'மிரிஹான வடக்கு', NULL, NULL, NULL, '10104', '6.87966520', '79.90947510'),
(1883, 5, 'Nawala-Koswatte', 'නාවල-කොස්වත්ත', 'நாவல - கொஸ்வத்தை', NULL, NULL, NULL, '10105', '6.90053750', '79.89548020'),
(1884, 5, 'Nawala', 'නාවල', 'நாவல', NULL, NULL, NULL, '10106', '6.89641910', '79.88848190'),
(1885, 5, 'Rajagiriya', 'රාජගිරිය', 'ராஜகிரிய', NULL, NULL, NULL, '10107', '6.90941080', '79.89425380'),
(1886, 5, 'Parliament of Sri Lanka', 'ශ්‍රී ලංකා පාර්ලිමේන්තුව', 'இலங்கை பாராளுமன்றம்', NULL, NULL, NULL, '10110', '6.93110950', '79.84302960'),
(1887, 5, 'Obeysekarapura', 'ඔබේසේකරපුර', 'ஒபேசேகரபுர', NULL, NULL, NULL, '10111', '6.91330980', '79.89026360'),
(1888, 5, 'Kalapaluwawa', 'කලපලුවාව', 'கலபலுவாவ', NULL, NULL, NULL, '10112', '6.91655310', '79.92083240'),
(1889, 5, 'Talangama North', 'තලංගම උතුර', 'தலங்கம வடக்கு', NULL, NULL, NULL, '10113', '6.91687820', '79.93173020'),
(1890, 5, 'Talangama South', 'තලංගම දකුණ', 'தலங்கம தெற்கு', NULL, NULL, NULL, '10114', '6.88675520', '79.94759990'),
(1891, 5, 'Jayawardhenegama', 'ජයවර්ධනගම', 'ஜெயவர்தனேகம', NULL, NULL, NULL, '10117', '6.92707860', '79.86124300');
INSERT INTO `cities` (`id`, `district_id`, `name_en`, `name_si`, `name_ta`, `sub_name_en`, `sub_name_si`, `sub_name_ta`, `postcode`, `latitude`, `longitude`) VALUES
(1892, 5, 'Isurupaya', 'ඉසුරුපාය', 'இசுருபாய', NULL, NULL, NULL, '10130', '6.92918770', '79.86394890'),
(1893, 5, 'Sethsiripaya', 'සෙත්සිරිපාය', 'சேத்சிரிபாய', NULL, NULL, NULL, '10140', '6.90327690', '79.91542220'),
(1894, 5, 'Malabe', 'මාලබේ', 'மாலபே', NULL, NULL, NULL, '10155', '6.90607870', '79.96962770'),
(1895, 5, 'Oruwala', 'ඔරුවල', 'ஒருவள', NULL, NULL, NULL, '10201', '6.88290380', '80.00038750'),
(1896, 5, 'Panagoda Army Camp', 'පනාගොඩ යුද හමුදා කඳවුර', 'பனாகொட இராணுவ முகாம்', NULL, NULL, NULL, '10203', '6.86561170', '80.02764270'),
(1897, 5, 'Magammana-Dolekade', 'මාගම්මන-දොලේකඩේ', 'மகம்மன-டோலேகடே', NULL, NULL, NULL, '10207', '6.82178770', '79.99838110'),
(1898, 5, 'Homagama Town', 'හෝමාගම නගරය', 'ஹோமாகம நகரம்', NULL, NULL, NULL, '10209', '6.84327620', '80.00318330'),
(1899, 5, 'Godagama Junction', 'ගොඩගම හන්දිය', 'கொடகம சந்தி', NULL, NULL, NULL, '10211', '6.85167240', '80.03273340'),
(1900, 5, 'Panagoda', 'පනාගොඩ', 'பனாகொட', NULL, NULL, NULL, '10213', '6.86561170', '80.02764270'),
(1901, 5, 'Galawilawaththa', 'ගලවිලවත්ත', 'கலாவிலவத்த', NULL, NULL, NULL, '10217', '6.83646020', '79.99339760'),
(1902, 5, 'Kottawa', 'කොට්ටාව', 'கொட்டாவ', NULL, NULL, NULL, '10220', '6.84116520', '79.96543240'),
(1903, 5, 'Pelenwatta', 'පැලැන්වත්ත', 'பெலன்வத்த', NULL, NULL, NULL, '10231', '6.82353930', '79.94445260'),
(1904, 5, 'Arawwala West', 'බටහිර ඇරැව්වල', 'அரவ்வல மேற்கு', NULL, NULL, NULL, '10233', '6.83824460', '79.94407100'),
(1905, 5, 'Kottawa North', 'කොට්ටාව උතුර', 'கொட்டாவ வடக்கு', NULL, NULL, NULL, '10235', '6.86147310', '79.95634170'),
(1906, 5, 'Rukmale-Pannipitiya', 'රුක්මලේ-පන්නිපිටිය', 'ருக்மலே-பன்னிபிட்டிய', NULL, NULL, NULL, '10237', '6.85597580', '79.97801780'),
(1907, 5, 'Malapalla', 'මලපල්ල', 'மலபல்லா', NULL, NULL, NULL, '10239', '6.84680570', '79.98221260'),
(1908, 5, 'Mattegoda', 'මත්තේගොඩ', 'மத்தேகொட', NULL, NULL, NULL, '10240', '6.81354880', '79.97242450'),
(1909, 5, 'Mirihana', 'මිරිහාන', 'மிரிஹானா', NULL, NULL, NULL, '10251', '6.86896470', '79.90387740'),
(1910, 5, 'Udahamulla', 'උඩහමුල්ල', 'உடஹமுல்ல', NULL, NULL, NULL, '10252', '6.86655590', '79.91507240'),
(1911, 5, 'Kohuwala', 'කොහුවල', 'கொஹுவாலா', NULL, NULL, NULL, '10255', '6.86248420', '79.88549830'),
(1912, 5, 'Pamunuwa-Patiragoda', 'පමුණුව - පතිරගොඩ', 'பமுனுவ-பதிரகொட', NULL, NULL, NULL, '10281', '6.86166890', '79.92892900'),
(1913, 5, 'Sudanapura', 'සුදනපුර', 'சுதனபுர', NULL, NULL, NULL, '10282', '6.87830600', '80.24325360'),
(1914, 5, 'Nawinna', 'නාවින්න', 'நாவின்ன', NULL, NULL, NULL, '10283', '6.85333090', '79.91507240'),
(1915, 5, 'Vidyodaya University', 'විද්‍යෝදය විශ්වවිද්‍යාලය', 'வித்யோதயா பல்கலைக்கழகம்', NULL, NULL, NULL, '10284', '6.90522350', '79.85125590'),
(1916, 5, 'Pepiliyana', 'පැපිලියාන', 'பெப்பிலியானா', NULL, NULL, NULL, '10291', '6.85381660', '79.88508760'),
(1917, 5, 'Katuwawala', 'කටුවාවල', 'கடுவாவல', NULL, NULL, NULL, '10292', '6.83211780', '79.91227380'),
(1918, 5, 'Suwarapola', 'සුවරාපොල', 'சுவர்பொல', NULL, NULL, NULL, '10301', '6.79787420', '79.91787090'),
(1919, 5, 'Gorakapitiya', 'ගොරකපිටිය', 'கோரகபிட்டிய', NULL, NULL, NULL, '10303', '6.81437460', '79.94864890'),
(1920, 5, 'Makandana', 'මාකන්දන', 'மகாண்டனா', NULL, NULL, NULL, '10305', '6.77693190', '79.95111430'),
(1921, 5, 'Kesbewa', 'කැස්බෑව', 'கெஸ்பேவா', NULL, NULL, NULL, '10307', '6.77867010', '79.94725020'),
(1922, 5, 'Bokundara', 'බෝකුන්දර', 'போகுந்தரா', NULL, NULL, NULL, '10309', '6.81643270', '79.92066940'),
(1923, 5, 'Kahathuduwa', 'කහතුඩුව', 'கஹதுடுவ', NULL, NULL, NULL, '10321', '6.78229800', '79.99479560'),
(1924, 5, 'Ratmalana North', 'රත්මලාන උතුර', 'இரத்மலானை வடக்கு', NULL, NULL, NULL, '10372', '6.82138560', '79.89012960'),
(1925, 5, 'Sirimal Uyana', 'සිරිමල් උයන', 'சிறிமல் உயன', NULL, NULL, NULL, '10373', '6.82677000', '79.87798340'),
(1926, 5, 'Ratmalana', 'රත්මලාන', 'இரத்மலானை', NULL, NULL, NULL, '10390', '6.81879540', '79.87101950'),
(1927, 5, 'Koralawella', 'කොරලවැල්ල', 'கோரலவெல்ல', NULL, NULL, NULL, '10401', '6.75779280', '79.88737000'),
(1928, 5, 'Egodauyana North', 'එගොඩඋයන උතුර', 'எகொடௌயன வடக்கு', NULL, NULL, NULL, '10402', '6.72094140', '79.90107840'),
(1929, 5, 'Egodauyana South', 'එගොඩඋයන දකුණ', 'எகொடௌயன தெற்கு', NULL, NULL, NULL, '10403', '6.72094140', '79.90107840'),
(1930, 5, 'Indibedda', 'ඉඳිබැද්ද', 'இந்திபெட்டா', NULL, NULL, NULL, '10404', '6.77380480', '79.90387740'),
(1931, 5, 'Moratumulla', 'මොරටුමුල්ල', 'மொரட்டுமுல்ல', NULL, NULL, NULL, '10405', '6.78084970', '79.89338070'),
(1932, 5, 'Rawathawatta', 'රාවතාවත්ත', 'ராவதவத்த', NULL, NULL, NULL, '10406', '6.79188690', '79.88428260'),
(1933, 5, 'Willorawatta', 'විල්ලෝරවත්ත', 'வில்லோரவத்த', NULL, NULL, NULL, '10407', '6.78687850', '79.90098840'),
(1934, 5, 'Lunawa', 'ලුනාව', 'லுனாவா', NULL, NULL, NULL, '10408', '6.78648590', '79.87868330'),
(1935, 5, 'Laksapatiya', 'ලක්ෂපතිය', 'லக்சபதியா', NULL, NULL, NULL, '10409', '6.92707860', '79.86124300'),
(1936, 5, 'Angulana', 'අඟුලාන', 'அங்குலானா', NULL, NULL, NULL, '10411', '6.79761140', '79.87378360'),
(1937, 5, 'Kaldemulla', 'කල්දෙමුල්ල', 'கல்தெமுல்ல', NULL, NULL, NULL, '10413', '6.80562650', '79.87798340'),
(1938, 5, 'Katubedda', 'කටුබැද්ද', 'கடுபெட்டா', NULL, NULL, NULL, '10414', '6.80145720', '79.89967890'),
(1939, 5, 'Liyanwala', 'ලියනවල', 'லியான்வல', NULL, NULL, NULL, '10501', '6.83690770', '80.07863590'),
(1940, 5, 'Poregedara', 'පෝරේගෙදර', 'போரேகெதர', NULL, NULL, NULL, '10503', '6.82250470', '80.08561890'),
(1941, 5, 'Dampe', 'දම්පේ', 'டாம்பே', NULL, NULL, NULL, '10505', '6.77178680', '79.91591810'),
(1942, 5, 'Malagala', 'මලගල', 'மலகல', NULL, NULL, NULL, '10507', '6.79517150', '80.10656460'),
(1943, 5, 'Meepe Junction', 'මීපේ හන්දිය', 'மீப்பே சந்தி', NULL, NULL, NULL, '10509', '6.76749490', '80.84717490'),
(1944, 5, 'Pinnawala-Waga', 'පින්නවල-වග', 'பின்னவல-வாகா', NULL, NULL, NULL, '10515', '6.86720730', '80.12094220'),
(1945, 5, 'Angampitiya', 'අංගම්පිටිය', 'அங்கம்பிட்டிய', NULL, NULL, NULL, '10517', '6.84700310', '80.11912960'),
(1946, 5, 'Arukwathupura', 'අරුක්වතුපුර', 'அருக்வத்துபுர', NULL, NULL, NULL, '10519', '6.87102580', '79.93885710'),
(1947, 5, 'Kandanapitiya', 'කඳානපිටිය', 'கந்தனாபிட்டிய', NULL, NULL, NULL, '10523', '6.81523830', '80.15173220'),
(1948, 5, 'Gurulana', 'ගුරුලනා', 'குருலானா', NULL, NULL, NULL, '10527', '6.83457760', '80.15820880'),
(1949, 5, 'Udugamkanda', 'උඩුගම්කන්ද', 'உடுகம்கந்த', NULL, NULL, NULL, '10529', '7.13764480', '80.09289820'),
(1951, 7, 'Wattala', 'වත්තල', 'வத்தளை', NULL, NULL, NULL, '11300', '6.98601320', '79.90701560'),
(1952, 2, 'Bulnewa', 'බුල්නෑව', 'புல்னேவா', NULL, NULL, NULL, '50172', '8.04139230', '80.44655940'),
(1953, 2, 'Kebithigollewa', 'කැබිතිගොල්ලෑව', 'கெபிதிகொல்லேவ', NULL, NULL, NULL, '50550', '8.64089160', '80.66968160'),
(1974, 16, 'Madipola', 'මාඩිපොල', 'மடிபோல', NULL, NULL, NULL, '21156', '7.67611540', '80.58272720'),
(1975, 17, 'Karatota', 'කරතොට', 'கரதொட்ட', NULL, NULL, NULL, '81308', '6.06412720', '80.66600920'),
(1976, 8, 'Gangulandeniya', 'ගඟුලන්දෙනිය', 'கங்குலந்தெனிய', NULL, NULL, NULL, '82506', '6.29562990', '80.71866970'),
(1977, 3, 'Idalgashinna', 'ඉදල්ගස්හින්න', 'இடல்கஷின்னா', NULL, NULL, NULL, '90167', '6.78296900', '80.90003310'),
(1978, 9, 'Allaipiddi', 'අල්ලයිපිඩ්ඩි', 'அல்லைப்பிட்டி', NULL, NULL, NULL, '40048', '9.61988780', '79.96543240'),
(1979, 9, 'Allaveddi', 'අල්ලවෙඩ්ඩි', 'அல்லவெட்டி', NULL, NULL, NULL, '40120', '9.66149810', '80.02554650'),
(1980, 9, 'Alvai', 'අල්වායි', 'அல்வாய்', NULL, NULL, NULL, '40635', '9.82086330', '80.20424360'),
(1981, 9, 'Anaikoddai', 'ආනයිකොඩ්ඩෙයි', 'ஆனைக்கோட்டை', NULL, NULL, NULL, '40198', '9.69635430', '79.99479560'),
(1982, 9, 'Analaitivu', 'අනලතිව්', 'அனலைதீவு', NULL, NULL, NULL, '40280', '9.66790030', '79.77643370'),
(1983, 9, 'Araly', 'අරලි', 'அரளி', NULL, NULL, NULL, '40221', '9.70620780', '79.95564240'),
(1984, 9, 'Atchuveli', 'අච්චුවේලි', 'அச்சுவேலி', NULL, NULL, NULL, '40150', '9.77863970', '80.11606510'),
(1985, 9, 'Chankanai', 'චංකානයි', 'சங்கானை', NULL, NULL, NULL, '40212', '9.74522360', '79.97242450'),
(1986, 9, 'Chavakachcheri', 'චාවකච්චේරි', 'சாவகச்சேரி', NULL, NULL, NULL, '40500', '9.66646000', '80.13209180'),
(1987, 9, 'Chullipuram', 'චුල්ලිපුරම්', 'சுள்ளிபுரம்', NULL, NULL, NULL, '40230', '9.76592620', '79.94623750'),
(1988, 9, 'Chundikuli', 'චුන්ඩිකුලි', 'சுண்டிக்குளி', NULL, NULL, NULL, '40020', '9.65349270', '80.03393120'),
(1989, 9, 'Chunnakam', 'චුන්නාකම්', 'சுன்னாகம்', NULL, NULL, NULL, '40075', '9.73756340', '80.02450490'),
(1990, 9, 'Delft West', 'ඩෙල්ෆ්ට් බටහිර', 'டெல்ஃப்ட் மேற்கு', NULL, NULL, NULL, '40378', '9.52769110', '79.69985740'),
(1991, 9, 'Delft', 'ඩෙල්ෆ්ට්', 'டெல்ஃப்ட்', NULL, NULL, NULL, '40370', '9.52769110', '79.69985740'),
(1992, 9, 'Eluvaitivu', 'එළුවතිව්', 'எழுவைதீவு', NULL, NULL, NULL, '40275', '9.69231050', '79.81146400'),
(1993, 9, 'Erialai', 'ඊරියාලයි', 'எரியாலை', NULL, NULL, NULL, '40080', '9.63829020', '80.07863590'),
(1994, 9, 'Ilavalai', 'ඉලවාලෙයි', 'இளவாலை', NULL, NULL, NULL, '40108', '9.79527530', '79.98920340'),
(1995, 9, 'Kankesanthurai', 'කන්කසන්තුරේ', 'காங்கேசன்துறை', NULL, NULL, NULL, '40190', '9.81611050', '80.04478780'),
(1996, 9, 'Karainagar', 'කරෙයිනගර්', 'காரைநகர்', NULL, NULL, NULL, '40250', '9.74807380', '79.88288280'),
(1997, 9, 'Karaveddi', 'කරවෙඩ්ඩි', 'கரவெட்டி', NULL, NULL, NULL, '40520', '9.80006730', '80.19941820'),
(1998, 9, 'Kayts', 'කයිට්ස්', 'ஊர்காவற்துறை', NULL, NULL, NULL, '40270', '9.69789370', '79.86048310'),
(1999, 9, 'Kodikamam', 'කොඩිකාමම්', 'கொடிகாமம்', NULL, NULL, NULL, '40700', '9.68449040', '80.22201770'),
(2000, 9, 'Kokuvil', 'කොකුවිල්', 'கொக்குவில்', NULL, NULL, NULL, '40060', '9.69082400', '80.02114300'),
(2001, 9, 'Kondavil', 'කොන්ඩාවිල්', 'கோண்டாவில்', NULL, NULL, NULL, '40062', '9.70300070', '80.03393120'),
(2002, 9, 'Kopay', 'කෝපායි', 'கோப்பாய்', NULL, NULL, NULL, '40170', '9.70430280', '80.07863590'),
(2003, 9, 'Kudatanai', 'කුඩාතනයි', 'குடத்தனை', NULL, NULL, NULL, '40620', '9.66149810', '80.02554650'),
(2004, 9, 'Mallakam', 'මල්ලාකම්', 'மல்லாகம்', NULL, NULL, NULL, '40142', '9.76188640', '80.02414890'),
(2005, 9, 'Mandaitivu', 'මණ්ඩතිව්', 'மண்டைதீவு', NULL, NULL, NULL, '40045', '9.61653910', '79.99199950'),
(2006, 9, 'Manipay', 'මනිපායි', 'மானிப்பாய்', NULL, NULL, NULL, '40200', '9.72910620', '79.99254460'),
(2007, 9, 'Mathagal', 'මාතගල්', 'மாதகல்', NULL, NULL, NULL, '40110', '9.78601780', '79.96613080'),
(2008, 9, 'Meesalai', 'මීසාලෙයි', 'மீசாலை', NULL, NULL, NULL, '40510', '9.67466610', '80.19587550'),
(2009, 9, 'Mahiyampathy', 'මහියම්පති', 'மஹியம்பதி', NULL, NULL, NULL, NULL, '9.66207980', '80.01189260'),
(2010, 9, 'Mirusuvil', 'මිරුසුවිල්', 'மிருசுவில்', NULL, NULL, NULL, '40750', '9.66770280', '80.23401800'),
(2011, 9, 'Nagarkovil', 'නාගර්කෝවිල්', 'நாகர்கோவில்', NULL, NULL, NULL, '40630', '9.70309500', '80.31371060'),
(2012, 9, 'Nagendramadam', 'නාගේන්ද්‍රමඩම්', 'நாகேந்திரமடம்', NULL, NULL, NULL, '40223', '9.66149810', '80.02554650'),
(2013, 9, 'Nainathivu', 'නයිනතිව්', 'நயினாதீவு', NULL, NULL, NULL, '40360', '9.61901230', '79.77487620'),
(2014, 9, 'Neervely', 'නොරිස්සුම් සහගතයි', 'பதற்றத்துடன்', NULL, NULL, NULL, '40165', '9.72106990', '80.08469440'),
(2015, 9, 'Pandaterippu', 'පණ්ඩතෙරිප්පු', 'பண்டதெரிப்பு', NULL, NULL, NULL, '40100', '9.77825690', '79.97242450'),
(2016, 9, 'Point Pedro', 'පේදුරුතුඩුව', 'பருத்தித்துறை', NULL, NULL, NULL, '40600', '9.79378850', '80.22097730'),
(2017, 9, 'Puloly', 'පුලෝලි', 'புலோலி', NULL, NULL, NULL, '40615', '9.81728290', '80.23526810'),
(2018, 9, 'Pungudutivu', 'පුංගුඩුතිව්', 'புங்குடுதீவு', NULL, NULL, NULL, '40330', '9.58964650', '79.82407150'),
(2019, 9, 'Puttur', 'පුත්තූර්', 'புத்தூர்', NULL, NULL, NULL, '40158', '9.73308980', '80.10003760'),
(2020, 9, 'Sandilipay', 'සන්දිලිපායි', 'சண்டிலிப்பாய்', NULL, NULL, NULL, '40098', '9.74933600', '79.98738320'),
(2021, 9, 'Sangarathai', 'සංගරති', 'சங்கரத்தை', NULL, NULL, NULL, '40225', '9.72854720', '79.96683080'),
(2022, 9, 'Sithankerny', 'සිතන්කර්නි', 'சித்தன்கெர்னி', NULL, NULL, NULL, '40229', '9.75365500', '79.96177550'),
(2023, 9, 'Sivankovilady', 'සිවන්කෝවිලඩි', 'சிவன்கோவிலடி', NULL, NULL, NULL, '40227', '9.67130510', '80.01155680'),
(2024, 9, 'Thellippallai', 'තෙල්ලිප්පල්ලයි', 'தெல்லிப்பளை', NULL, NULL, NULL, '40130', '9.79108750', '80.03393120'),
(2025, 9, 'Thondamanaru', 'තොණ්ඩමනාරු', 'தொண்டமானாறு', NULL, NULL, NULL, '40545', '9.81840780', '80.13696540'),
(2026, 9, 'Urumpirai', 'උරුම්පිරායි', 'உரும்பிராய்', NULL, NULL, NULL, '40180', '9.72031900', '80.04304180'),
(2027, 9, 'Vaddukoddai', 'වඩ්ඩුකොඩ්ඩෙයි', 'வட்டுக்கோட்டை', NULL, NULL, NULL, '40220', '9.72238430', '79.94445260'),
(2028, 9, 'Valvettithurai', 'වැල්වැටිතුරෙයි', 'வல்வெட்டித்துறை', NULL, NULL, NULL, '40540', '9.81493700', '80.16608040'),
(2029, 9, 'Varany', 'වරනි', 'வரணி', NULL, NULL, NULL, '40640', '9.66649990', '80.01096540'),
(2030, 9, 'Vasavilan', 'වාසවිලාන්', 'வசாவிளான்', NULL, NULL, NULL, '40145', '9.78830650', '80.07007120'),
(2031, 9, 'Velanai', 'වේලනයි', 'வேலணை', NULL, NULL, NULL, '40300', '9.63724050', '79.90107840'),
(2032, 9, 'Gurunagar', 'ගුරුනගර්', 'குருநகர்', NULL, NULL, NULL, NULL, '9.65355890', '80.01695030'),
(2033, 9, 'Kaitadi', 'කයිතඩි', 'கைதடி', NULL, NULL, NULL, NULL, '9.67146140', '80.09644150'),
(2034, 9, 'Nallur', 'නල්ලුර්', 'நல்லூர்', NULL, NULL, NULL, NULL, '9.67015470', '80.03952050'),
(2035, 9, 'Thirunelvely', 'තිරුනෙල්වේලි', 'திருநெல்வேலி', NULL, NULL, NULL, NULL, '9.68257550', '80.03699480'),
(2036, 9, 'Vannarponnai', 'වන්නර්පොන්නයි', 'வண்ணார்பொன்னை', NULL, NULL, NULL, NULL, '9.68384070', '80.01366670'),
(2037, 13, 'Akkarayankulam', 'අක්කරායන්කුලම්', 'அக்கராயன்குளம்', NULL, NULL, NULL, '42640', '9.32614520', '80.30181070'),
(2038, 13, 'Aliyawalai', 'අලියාවලයි', 'அலியாவளை', NULL, NULL, NULL, '42565', '9.58818920', '80.44655940'),
(2039, 13, 'Chempiyanpattu', 'චෙම්පියන්පත්තුව', 'செம்பியன்பட்டு', NULL, NULL, NULL, '42560', '9.38028860', '80.37699990'),
(2040, 13, 'Elephant Pass', 'අලිමංකඩ', 'ஆனையிறவு', NULL, NULL, NULL, '42510', '9.52566550', '80.40622650'),
(2041, 13, 'Eluthumadduval', 'එළුතුමද්දුවල්', 'எழுதுமட்டுவல்', NULL, NULL, NULL, '42580', '9.65623000', '80.28316680'),
(2042, 13, 'Iranaitiv', 'ඉරණතිව්', 'இரணைதீவு', NULL, NULL, NULL, '42630', '9.28993290', '79.98361080'),
(2043, 13, 'Iyyakachchi', 'අයියකච්චි', 'இயக்கச்சி', NULL, NULL, NULL, '42520', '9.57152350', '80.41619680'),
(2044, 13, 'Kavutharimunai', 'කවුතාරිමුනේ', 'கவுதாரிமுனை', NULL, NULL, NULL, '42608', '9.56666700', '80.11666700'),
(2045, 13, 'Konavil', 'කොනාවිල්', 'கோணவில்', NULL, NULL, NULL, '42645', '9.35149910', '80.32688120'),
(2046, 13, 'Mulliyan', 'මුල්ලියන්', 'முள்ளியன்', NULL, NULL, NULL, '42570', '9.55313190', '80.47158660'),
(2047, 13, 'Murasumoddai', 'මුරසුමෝඩයි', 'முரசுமோட்டை', NULL, NULL, NULL, '42505', '9.43792020', '80.45281690'),
(2048, 13, 'Pallavarayankaddu', 'පල්ලවරායන්කඩ්ඩු', 'பல்லவராயன்கட்டு', NULL, NULL, NULL, '42615', '9.31432200', '80.17076620'),
(2049, 13, 'Paranthan', 'පරන්තන්', 'பரந்தன்', NULL, NULL, NULL, '42500', '9.44141520', '80.40483060'),
(2050, 13, 'Puliyampokkanai', 'පුලියම්පොක්කනයි', 'புளியம்பொக்கனை', NULL, NULL, NULL, '42509', '9.44104490', '80.53125230'),
(2051, 13, 'Punakari-Nallur', 'පුනකාරි-නල්ලූර්', 'புனகரி-நல்லூர்', NULL, NULL, NULL, '42606', '9.45027570', '80.27812620'),
(2052, 13, 'Ramanathapuram', 'රාමනාතපුරම්', 'ராமநாதபுரம்', NULL, NULL, NULL, '42408', '9.36699420', '80.49382670'),
(2053, 13, 'Sivapuram', 'සිවපුරම්', 'சிவபுரம்', NULL, NULL, NULL, '42618', '9.44587530', '80.41735140'),
(2054, 13, 'Skanthapuram', 'ස්කන්තපුරම්', 'ஸ்கந்தபுரம்', NULL, NULL, NULL, '42638', '9.33710780', '80.30181070'),
(2055, 13, 'Thalaiyadi', 'තලෙයියඩි', 'தாளையடி', NULL, NULL, NULL, '42563', '9.63045850', '80.40285230'),
(2056, 13, 'Tharmapuram', 'තර්මපුරම්', 'தர்மபுரம்', NULL, NULL, NULL, '42512', '9.41065240', '80.52336360'),
(2057, 13, 'Uruthirapuram', 'උරුතිරපුරම්', 'உருத்திரபுரம்', NULL, NULL, NULL, '42502', '9.39865250', '80.34637540'),
(2058, 13, 'Vaddakachchi', 'වඩ්ඩකච්චි', 'வட்டக்கச்சி', NULL, NULL, NULL, '42405', '9.36139060', '80.46667320'),
(2059, 13, 'Vannerikkulam', 'වන්නෙරික්කුලම්', 'வன்னேரிக்குளம்', NULL, NULL, NULL, '42635', '9.38028860', '80.37699990'),
(2060, 13, 'Veravil', 'වෙරාවිල්', 'வெராவில்', NULL, NULL, NULL, '42620', '9.35284760', '80.07863590'),
(2061, 13, 'Vinayagapuram', 'විනයාගපුරම්', 'விநாயகபுரம்', NULL, NULL, NULL, '42625', '9.11384010', '80.24328390'),
(2063, 13, 'Ambalnagar', 'අම්බල්නගර්', 'அம்பாள்நகர்', NULL, NULL, NULL, NULL, '9.34577150', '80.41874250'),
(2064, 13, 'Cheddiyakurichchi', 'චෙඩ්ඩියාකුරිච්චි', 'செட்டியக்குறிச்சி', NULL, NULL, NULL, NULL, '9.37272850', '80.41178570'),
(2065, 13, 'Chundikulam', 'චුන්ඩිකුලම්', 'சுண்டிக்குளம்', NULL, NULL, NULL, NULL, '9.51416670', '80.53222220'),
(2066, 13, 'Kalmadunagar', 'කල්මඩුනගර්', 'கல்மடுநகர்', NULL, NULL, NULL, NULL, '9.37856530', '80.51606080'),
(2067, 13, 'Karadipokku', 'කරඩිපොක්කු', 'கரடிபோக்கு', NULL, NULL, NULL, NULL, '9.40863720', '80.40644470'),
(2068, 13, 'Kilay', 'කිලේ', 'கிலே', NULL, NULL, NULL, NULL, '9.38975610', '80.40650010'),
(2069, 13, 'Kunchuparanthan', 'කුංචුපරන්තන්', 'குஞ்சுபரந்தன்', NULL, NULL, NULL, NULL, '9.41087790', '80.33826070'),
(2070, 13, 'Muhamalai', 'මුහමාලේ', 'முகமாலை', NULL, NULL, NULL, NULL, '9.64717690', '80.29345220'),
(2071, 13, 'Pallai', 'පලෙයි', 'பாளை', NULL, NULL, NULL, '42550', '9.56732280', '80.38813330'),
(2072, 13, 'Sivanagar', 'සිවනගර්', 'சிவநகர்', NULL, NULL, NULL, NULL, '9.38893750', '80.34219840'),
(2073, 13, 'Soranpattu', 'සෝරන්පත්තුව', 'சோரன்பட்டு', NULL, NULL, NULL, NULL, '9.59702640', '80.36864880'),
(2074, 13, 'Thirunagar', 'තිරුනගර්', 'திருநகர்', NULL, NULL, NULL, NULL, '9.39438340', '80.39091640'),
(2075, 13, 'Thiruvaiaru', 'තිරුවයිආරු', 'திருவையாறு', NULL, NULL, NULL, NULL, '9.37616450', '80.42708850'),
(2076, 19, 'Alampil', 'අලම්පිල්', 'அலம்பில்', NULL, NULL, NULL, '42005', '9.18157970', '80.84608220'),
(2077, 19, 'Karuppaddamurippu', 'කරුප්පද්දමුරිප්පු', 'கருப்பட்டமுறிப்பு', NULL, NULL, NULL, '42220', '9.15264030', '80.52022900'),
(2078, 19, 'Mankulam', 'මාන්කුලම්', 'மாங்குளம்', NULL, NULL, NULL, '42300', '9.13698850', '80.44516870'),
(2079, 19, 'Mullivaikkal', 'මුල්ලිවයික්කාල්', 'முள்ளிவாய்க்கால்', NULL, NULL, NULL, '42540', '9.31196020', '80.78659060'),
(2080, 19, 'Mulliyawalai', 'මුල්ලියාවලයි', 'முள்ளியவளை', NULL, NULL, NULL, '42100', '9.21921510', '80.76439520'),
(2081, 19, 'Muththaiyankaddukulam', 'මුත්තයියන්කඩ්ඩුකුලම්', 'முத்தையான்கட்டுக்குளம்', NULL, NULL, NULL, '42210', '9.26709110', '80.81424800'),
(2082, 19, 'Naddankandal', 'නද්දන්කන්ඩාල්', 'நட்டான்கண்டல்', NULL, NULL, NULL, '42308', '9.00401300', '80.22097730'),
(2083, 19, 'Oddusudan', 'ඔඩ්ඩුසුඩාන්', 'ஒட்டுசுடான்', NULL, NULL, NULL, '42200', '9.15386780', '80.64973120'),
(2084, 19, 'Puthukkudiyiruppu', 'පුදුක්කුඩිඉරිප්පු', 'புதுக்குடியிருப்பு', NULL, NULL, NULL, '42530', '9.31579980', '80.69262120'),
(2085, 19, 'Puthuvedduvan', 'පුත්තුවෙද්දුවන්', 'புதுவெட்டுவான்', NULL, NULL, NULL, '42330', '9.24754080', '80.33245140'),
(2086, 19, 'Thunukkai', 'තුනුක්කායි', 'துணுக்காய்', NULL, NULL, NULL, '42320', '9.13404860', '80.28626360'),
(2087, 19, 'Udayarkaddu', 'උදයාර්කඩ්ඩු', 'உடையார்கட்டு', NULL, NULL, NULL, '42518', '9.31318210', '80.58411550'),
(2088, 19, 'Vavunakkulam', 'වව්නක්කුලම්', 'வவுணக்குளம்', NULL, NULL, NULL, '42305', '9.26709110', '80.81424800'),
(2089, 19, 'Visvamadukulam', 'විශ්වමඩුකුලම්', 'விஸ்வமடுகுளம்', NULL, NULL, NULL, '42515', '9.37603700', '80.55024560'),
(2090, 19, 'Yogapuram', 'යෝගපුරම්', 'யோகபுரம்', NULL, NULL, NULL, '42315', '9.13041700', '80.30720850'),
(2091, 19, 'Ampalavanpokkanai', 'අම්පලවන්පොක්කනයි', 'அம்பலவன்பொக்கனை', NULL, NULL, NULL, NULL, '9.37419060', '80.68717670'),
(2092, 19, 'Ananthapuram', 'අනන්තපුරම්', 'அனந்தபுரம்', NULL, NULL, NULL, NULL, '9.32541350', '80.72895090'),
(2093, 19, 'Ethawetunuwewa', 'ඇතාවැටුණුවැව', 'எதவெதுனுவெவ', NULL, NULL, NULL, '50584', '8.97525670', '80.74499970'),
(2094, 19, 'Kokkilai', 'කොක්කිලායි', 'கொக்கிளாய்', NULL, NULL, NULL, NULL, '9.00040660', '80.94914480'),
(2095, 19, 'Kokkuthuoduvai', 'කොක්කුතුඔඩුවායි', 'கொக்குதூதுவாய்', NULL, NULL, NULL, NULL, '9.49361110', '80.57388890'),
(2096, 19, 'Kumulamunai', 'කුමුලමුනෙයි', 'குமுளமுனை', NULL, NULL, NULL, NULL, '9.15250960', '80.82384490'),
(2097, 19, 'Mullathivu', 'මුලතිව්', 'முல்லைத்தீவு', NULL, NULL, NULL, '42000', '9.26709110', '80.81424800'),
(2098, 19, 'Murukandy', 'මුරුකන්ඩි', 'முருகண்டி', NULL, NULL, NULL, NULL, '9.26295870', '80.39648240'),
(2099, 19, 'Welioya', 'වැලිඔය', 'வெலிஓயா', NULL, NULL, NULL, '50586', '8.96404140', '80.78794070'),
(2116, 25, 'Nedunkerny', 'නෙඩුන්කේනි', 'நெடுங்கேணி', NULL, NULL, NULL, '42250', '9.05371870', '80.66043640'),
(2117, 25, 'Neriyakulam', 'නෙරියකුලම්', 'நேரியகுளம்', NULL, NULL, NULL, '43300', '8.61546220', '80.35472860'),
(2135, 25, 'Alagalla', 'අලගල්ල', 'அலகல்லா', NULL, NULL, NULL, NULL, '8.67901160', '80.50494450'),
(2136, 25, 'Andiyapuliyankulam', 'ආණ්ඩියපුලියන්කුලම්', 'ஆண்டியபுளியங்குளம்', NULL, NULL, NULL, NULL, '8.72189240', '80.26558460'),
(2137, 25, 'Asikulam', 'ආසිකුලම්', 'ஆசிகுளம்', NULL, NULL, NULL, NULL, '8.68181450', '80.53659490'),
(2138, 25, 'Cheddikulam', 'චෙඩ්ඩිකුලම්', 'செட்டிகுளம்', NULL, NULL, NULL, NULL, '8.66559560', '80.29623850'),
(2139, 25, 'Chemamadukulam', 'චෙමාමඩුකුලම්', 'செம்மாமடுக்குளம்', NULL, NULL, NULL, NULL, '8.88222220', '80.58194440'),
(2140, 25, 'Iranai lluppaikulam', 'ඉරණයි ලුප්පයිකුලම්', 'இரணை லுப்பைக்குளம்', NULL, NULL, NULL, NULL, '8.85239540', '80.36128980'),
(2141, 25, 'Kalmadhu', 'කල්මඩු', 'கல்மது', NULL, NULL, NULL, NULL, '8.83949310', '80.39369940'),
(2142, 25, 'Iratta Periyakulama', 'ඉරට්ට පෙරියකුලම', 'இரட்டை பெரியகுளம', NULL, NULL, NULL, NULL, '8.70711060', '80.48207360'),
(2143, 25, 'Kanagarayankulam', 'කනගරායන්කුලම්', 'கனகராயன்குளம்', NULL, NULL, NULL, NULL, '8.75365450', '80.49574890'),
(2144, 25, 'Kannaddi', 'කන්නඩ්ඩි', 'கன்னடி', NULL, NULL, NULL, NULL, '8.78602010', '80.22097730'),
(2145, 25, 'Kela Bogaswewa', 'කැල බෝගස්වැව', 'கெல போகஸ்வெவ', NULL, NULL, NULL, NULL, '8.87897430', '80.66043640'),
(2146, 25, 'Kovilkulam', 'කෝවිල්කුලම්', 'கோவில்குளம்', NULL, NULL, NULL, NULL, '8.73753070', '80.50633410'),
(2147, 25, 'Madukanda', 'මඩුකන්ද', 'மதுகந்தா', NULL, NULL, NULL, NULL, '8.75658000', '80.56051110'),
(2148, 25, 'Mahakachchakodiya', 'මහාකච්චකොඩිය', 'மகாகச்சகோடியா', NULL, NULL, NULL, NULL, '8.78555240', '80.57578530'),
(2149, 25, 'Mamaduwa', 'මාමඩුව', 'மாமதுவா', NULL, NULL, NULL, NULL, '8.81635400', '80.55495610'),
(2150, 25, 'Maradammaduwa', 'මරදම්මඩුව', 'மரதம்மதுவ', NULL, NULL, NULL, NULL, '8.57829580', '80.36856430'),
(2151, 25, 'Maraiyadithakulam', 'මරයඩිතකුලම්', 'மறையடித்தகுளம்', NULL, NULL, NULL, NULL, '8.75032420', '80.49704350'),
(2152, 25, 'Maruthodai', 'මරුතෝඩෙයි', 'மருதோடை', NULL, NULL, NULL, NULL, '8.86861110', '80.51722220'),
(2153, 25, 'Mathavuvaithakulam', 'මතවුවයිතකුලම්', 'மாதவுவைத்தகுளம்', NULL, NULL, NULL, NULL, '8.75032420', '80.49704350'),
(2154, 25, 'Nainamadu', 'නයිනමඩු', 'நைனாமடு', NULL, NULL, NULL, NULL, '9.04079380', '80.58272720'),
(2155, 25, 'Nelukkulam', 'නෙලුක්කුලම්', 'நெளுக்குளம்', NULL, NULL, NULL, NULL, '8.76466930', '80.44934050'),
(2156, 25, 'Nochchimoddai', 'නොච්චිමොඩෙයි', 'நொச்சிமோட்டை', NULL, NULL, NULL, NULL, '8.83143640', '80.50494450'),
(2157, 25, 'Omanthai', 'ඕමන්තයි', 'ஓமந்தை', NULL, NULL, NULL, NULL, '8.87238700', '80.50772370'),
(2158, 25, 'Palamoddai', 'පලාමොඩෙයි', 'பாலமோட்டை', NULL, NULL, NULL, NULL, '8.94322430', '80.39926520'),
(2159, 25, 'Pampaimadu', 'පම්පයිමඩු', 'பம்பைமடு', NULL, NULL, NULL, NULL, '8.78559790', '80.41596030'),
(2160, 25, 'Pavakkulama Unit 1', 'පාවක්කුලම ඒකකය 1', 'பாவக்குளம அலகு 1', NULL, NULL, NULL, NULL, '8.75420290', '80.49824020'),
(2161, 25, 'Pavakkulama Unit 2', 'පාවක්කුලම ඒකකය 2', 'பாவக்குளம அலகு 2', NULL, NULL, NULL, NULL, '8.70633850', '80.40204800'),
(2162, 25, 'Periyathambanai', 'පෙරියතම්බානෙයි', 'பெரியதம்பனை', NULL, NULL, NULL, NULL, '8.79231630', '80.46602560'),
(2163, 25, 'Periya Ulukkulama', 'පෙරිය උළුක්කුලම', 'பெரிய உலக்குலமா', NULL, NULL, NULL, NULL, '8.67678120', '80.41596030'),
(2164, 25, 'Poovarasankulam', 'පූවරසන්කුලම්', 'பூவரசங்குளம்', NULL, NULL, NULL, NULL, '8.78417510', '80.36029700'),
(2165, 25, 'Puliyankulam', 'පුලියන්කුලම', 'புளியங்குளம்', NULL, NULL, NULL, NULL, '8.97381780', '80.52717560'),
(2166, 25, 'Sathirikulankulam', 'සතිරිකුලන්කුලම්', 'சத்திரிக்குளங்குளம்', NULL, NULL, NULL, NULL, '8.77833450', '80.48489570'),
(2167, 25, 'Sinnasippikulam', 'සින්නසිප්පිකුලම්', 'சின்னசிப்பிக்குளம்', NULL, NULL, NULL, NULL, '8.57146260', '80.33245140'),
(2168, 25, 'Thandikulam', 'තාණ්ඩිකුලම්', 'தாண்டிக்குளம்', NULL, NULL, NULL, NULL, '8.78729320', '80.48270740'),
(2169, 25, 'Vaarikkuttiyoor', 'වාරික්කුට්ටියූර්', 'வரிக்குட்டியூர்', NULL, NULL, NULL, NULL, '8.73854240', '80.50937380'),
(2172, 15, 'Aandankulam', 'ආන්දන්කුලම්', 'ஆண்டங்குளம்', NULL, NULL, NULL, NULL, '8.94142900', '80.02275140'),
(2173, 15, 'Adampan', 'අඩම්පන්', 'அடம்பன்', NULL, NULL, NULL, NULL, '8.93257410', '79.99759160'),
(2174, 15, 'Arippu', 'අරිප්පු', 'அரிப்பு', NULL, NULL, NULL, NULL, '8.79255710', '79.92965370'),
(2175, 15, 'Athimottai', 'ඇතිමොට්ටෙයි', 'அத்திமோட்டை', NULL, NULL, NULL, NULL, '8.97773900', '79.91629000'),
(2176, 15, 'Chilavathurai', 'චිලාවතුරෙයි', 'சிலாவத்துறை', NULL, NULL, NULL, NULL, '8.74500740', '79.95424380'),
(2177, 15, 'Erukkalampiddy', 'එරුක්කලම්පිඩ්ඩි', 'எருக்கலம்பிட்டி', NULL, NULL, NULL, NULL, '9.03435060', '79.88148300'),
(2178, 15, 'Illuppaikadavai', 'ඉලුප්පයිකඩවයි', 'இலுப்பைக்கடவை', NULL, NULL, NULL, NULL, '9.09252860', '80.08055630'),
(2179, 15, 'Karisal', 'කරිසල්', 'கரிசல்', NULL, NULL, NULL, NULL, '9.06674680', '79.84128420'),
(2180, 15, 'Kokkupadayan', 'කොක්කුපාදයන්', 'கொக்குபடயன்', NULL, NULL, NULL, NULL, '8.73311300', '79.96683080'),
(2181, 15, 'Madhu Church', 'මඩු පල්ලිය', 'மடு தேவாலயம்', NULL, NULL, NULL, NULL, '8.85502020', '80.20284200'),
(2182, 15, 'Madhu Road', 'මඩු පාර', 'மது சாலை', NULL, NULL, NULL, NULL, '8.81419660', '80.17639490'),
(2183, 15, 'Marichchikaddi', 'මරිච්චිකඩ්ඩි', 'மரிச்சிக்கட்டி', NULL, NULL, NULL, NULL, '8.96486110', '79.91827770'),
(2184, 15, 'Mullikulam', 'මුල්ලිකුලම්', 'முள்ளிக்குளம்', NULL, NULL, NULL, NULL, '8.72547360', '79.96053750'),
(2185, 15, 'Murunkan', 'මුරුන්කන්', 'முருங்கன்', NULL, NULL, NULL, NULL, '8.83279700', '80.03393120'),
(2186, 15, 'Nanattan', 'නානත්තන්', 'நானாட்டான்', NULL, NULL, NULL, NULL, '8.83709930', '79.96910980'),
(2187, 15, 'Palampiddy', 'පාලම්පිඩ්ඩි', 'பாலம்பிட்டி', NULL, NULL, NULL, NULL, '8.92204610', '80.21539980'),
(2188, 15, 'Pallimunai', 'පල්ලිමුනෙයි', 'பள்ளிமுனை', NULL, NULL, NULL, NULL, '8.98009400', '79.92160730'),
(2189, 15, 'Pandaraveli', 'පණ්ඩරවැලි', 'பாண்டாரவெளி', NULL, NULL, NULL, NULL, '8.78159340', '79.95004770'),
(2190, 15, 'Pappamoddai', 'පප්පමෝඩයි', 'பாப்பாமோட்டை', NULL, NULL, NULL, NULL, '8.99299680', '80.01436560'),
(2191, 15, 'Parappankandal', 'පරප්පන්කන්දල්', 'பரப்பன்கண்டல்', NULL, NULL, NULL, NULL, '8.87400300', '80.04790390'),
(2192, 15, 'Parappukadanthan', 'පරප්පුකදන්තන්', 'பரப்புகடந்தான்', NULL, NULL, NULL, NULL, '8.91554570', '80.06530170'),
(2193, 15, 'Periyakunchikulam', 'පෙරියකුංචිකුලම්', 'பெரியகுஞ்சிகுளம்', NULL, NULL, NULL, NULL, '8.97585590', '79.91699640'),
(2194, 15, 'Periyamadhu', 'පෙරියමඩු', 'பெரியமது', NULL, NULL, NULL, NULL, '8.98099710', '80.17634670'),
(2195, 15, 'Periyapandivirichchan', 'පෙරියපණ්ඩිවිරිච්චන්', 'பெரியபாண்டிவிரிச்சான்', NULL, NULL, NULL, NULL, '8.96486110', '79.91827770'),
(2196, 15, 'Pesalai', 'පේසාලෙයි', 'பேசாலை', NULL, NULL, NULL, NULL, '9.08283040', '79.81006300'),
(2197, 15, 'Potkerny', 'පොට්කර්නි', 'பொட்கெர்னி', NULL, NULL, NULL, NULL, '8.77931380', '79.96917970'),
(2198, 15, 'Puthuveli', 'පුතුවේලි', 'புதுவேலி', NULL, NULL, NULL, NULL, '8.76976940', '79.96543240'),
(2199, 15, 'Sooriyakaddaikadhu', 'සූරියකඩ්ඩයිකාඩු', 'சூரியகட்டைக்காடு', NULL, NULL, NULL, NULL, '8.98167070', '79.92319020'),
(2200, 15, 'Thalaimannar', 'තලෙයිමන්නාරම', 'தலைமன்னார்', NULL, NULL, NULL, NULL, '9.08343000', '79.73437910'),
(2201, 15, 'Thalaimannar Pier', 'තලෙයිමන්නාරම පියර්', 'தலைமன்னார் பையர்', NULL, NULL, NULL, NULL, '9.10229100', '79.72596580'),
(2202, 15, 'Thalaimannar West', 'තලෙයිමන්නාරම බටහිර', 'தலைமன்னார் மேற்கு', NULL, NULL, NULL, NULL, '9.08343000', '79.73437910'),
(2203, 15, 'Thalvupadu', 'තල්වුපාඩු', 'தாழ்வுபாடு', NULL, NULL, NULL, NULL, '8.99092580', '79.88880120'),
(2204, 15, 'Tharapuram', 'තාරාපුරම්', 'தாராபுரம்', NULL, NULL, NULL, NULL, '9.01237950', '79.87588350'),
(2205, 15, 'Thiruketheeswaram', 'තිරුකේතීස්වරම්', 'திருக்கேதீஸ்வரம்', NULL, NULL, NULL, NULL, '8.94443570', '79.95774040'),
(2206, 15, 'Uyilankulam', 'උයිලන්කුලම්', 'உயிலங்குளம்', NULL, NULL, NULL, NULL, '8.88589160', '79.98361080'),
(2207, 15, 'Uyirtharasankulam', 'උයිර්තරසංකුලම්', 'உயிர்தரசங்குளம்', NULL, NULL, NULL, NULL, '8.98632760', '79.90891460'),
(2208, 15, 'Vaddakandal', 'වඩ්ඩකන්ඩාල්', 'வட்டக்கண்டல்', NULL, NULL, NULL, NULL, '8.90771000', '80.03532850'),
(2209, 15, 'Vankalai', 'වංකලයි', 'வாங்கலை', NULL, NULL, NULL, NULL, '8.89409850', '79.93466030'),
(2210, 15, 'Vellankulam', 'වෙල්ලන්කුලම්', 'வெள்ளாங்குளம்', NULL, NULL, NULL, NULL, '9.18608900', '80.12648090'),
(2211, 15, 'Veppankulam', 'වෙප්පන්කුලම්', 'வேப்பங்குளம்', NULL, NULL, NULL, NULL, '8.78602730', '80.01436560'),
(2212, 15, 'Vidataltivu', 'විඩතලතිව්', 'விடத்தல்தீவு', NULL, NULL, NULL, NULL, '9.02154990', '80.05086310'),
(2213, 7, 'Mabola', 'මාබෝල', 'மாபோலா', NULL, NULL, NULL, '11104', '7.00628330', '79.89248280');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(10) NOT NULL,
  `UserImage` varchar(255) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `NIC` varchar(12) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `HouseNo` varchar(10) NOT NULL,
  `Lane` varchar(50) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `Province` int(11) NOT NULL,
  `District` int(11) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Dob` date DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `ContactNo` int(10) NOT NULL,
  `AddUser` int(11) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Title`, `UserImage`, `Email`, `Password`, `NIC`, `FirstName`, `LastName`, `HouseNo`, `Lane`, `Street`, `Province`, `District`, `City`, `Gender`, `Dob`, `Status`, `ContactNo`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, '', '', 'rajindratharindu@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '982130140V', 'B.A.W.A.Rajindra', 'Tharindu', '136', 'Horahena Road', 'Rukmale', 1, 0, '367', '1', NULL, 1, 701436889, NULL, NULL, NULL, NULL),
(2, 'Mr.', '981143426V64ca53bab550c7.33126273.png', 'pasan1@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '981143426V', 'Pasan', 'Manahara', '1343', 'Piliyandala', '', 1, 5, '367', '1', '1998-04-23', 1, 729140130, NULL, '2023-08-02', NULL, NULL),
(3, 'Mr.', '973311166V64cbc99fb34182.83839205.jpeg', 'avishkamadhushanka@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '973311166V', 'Avishka', 'Madhushanka', '136', 'Horahena Road', 'Rukmale', 1, 5, '1906', '1', '1997-11-26', 1, 703966282, NULL, '2023-08-03', NULL, NULL),
(12, 'Mr.', '982130150V64cd0c978a5671.74475381.jpg', 'jayanharshana@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '982130150V', 'Jayan', 'Harshana', '133', 'Ambalangoda', 'Hokandara East', 1, 5, '330', '1', '1998-07-31', 1, 779200480, NULL, '2023-08-04', NULL, NULL),
(13, 'Mr.', '19982130015064cd25166ac259.67308634.jpg', 'stepan@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '199821300150', 'Stepan', 'Kumara', '135', 'Grama Sanwaradana Lane', 'Kottawa Road', 1, 5, '331', '1', '1998-07-31', 1, 719280779, NULL, '2023-08-04', NULL, NULL),
(14, 'Mr.', '982130426V64cd7fac234086.84751402.jpeg', 'kamalperera@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '982130426V', 'Kamal', 'Perera', '305/D/3', 'Horahena Road', 'Kaluaggala', 1, 5, '330', '1', '1998-07-31', 1, 729140130, NULL, '2023-08-04', NULL, NULL),
(15, 'Mr.', '982130101V65d4ea54050fa2.19380350.png', 'rajindratharindueb@gmail.com', '39b947de5b295a150eaed0b1af60a2316e17a687', '982130101V', 'B.A.W.A.Rajindra', 'Tharindu', '305/D/3', 'Gonamadiththa Road', 'Kesbawa', 1, 5, '1921', '1', '1998-07-31', 1, 713966282, NULL, '2024-02-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customervehicles`
--

DROP TABLE IF EXISTS `customervehicles`;
CREATE TABLE IF NOT EXISTS `customervehicles` (
  `vehicleId` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `VehicleType` int(11) NOT NULL,
  `VehicleBrand` int(11) DEFAULT NULL,
  `VehicleModel` int(11) NOT NULL,
  `VehicleImage` varchar(255) NOT NULL,
  `registerLetter` varchar(20) NOT NULL,
  `RegistrationNo` varchar(255) NOT NULL,
  `Millege` int(11) NOT NULL,
  PRIMARY KEY (`vehicleId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customervehicles`
--

INSERT INTO `customervehicles` (`vehicleId`, `CustomerID`, `VehicleType`, `VehicleBrand`, `VehicleModel`, `VehicleImage`, `registerLetter`, `RegistrationNo`, `Millege`) VALUES
(1, 1, 1, 2, 36, '64bf7c9dd35e44.18750254.jpg', 'CCA', '9999', 695),
(2, 1, 1, 2, 36, '64bf7c9dd35e44.18750254.jpg', 'CCA', '1467', 59098),
(3, 2, 2, 1, 37, '64ca5f13248c53.26633714.jpeg', 'PF', '6970', 75000),
(4, 2, 2, 1, 38, '64ca622e8b53f4.26484275.jpg', 'PH', '0138', 75000),
(5, 3, 2, 1, 37, '64cbcaccb98f50.89392640.jpg', 'PF', '7684', 124576),
(6, 12, 1, 2, 25, '64cd1a314b9d57.94761343.jpg', 'CCA', '9898', 16578),
(7, 13, 1, 2, 7, '64cd7ee0abf0e2.41666064.jpeg', 'KX', '7676', 150009),
(8, 14, 2, 1, 37, '64cd800b1ef278.60418968.jpeg', 'PF', '1456', 1234567),
(9, 14, 1, 2, 26, '64cd802c8dbd98.85798047.jpg', 'CCA', '6578', 123695),
(10, 1, 1, 2, 11, '64ce08d773ebb3.21413510.jpg', 'CCA', '6790', 78594);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_mobile`
--

INSERT INTO `customer_mobile` (`customberMobileId`, `customerID`, `MobileNo`, `countryCode`) VALUES
(1, 1, 703966282, 94);

-- --------------------------------------------------------

--
-- Table structure for table `damageitems`
--

DROP TABLE IF EXISTS `damageitems`;
CREATE TABLE IF NOT EXISTS `damageitems` (
  `damgeItemId` int(11) NOT NULL AUTO_INCREMENT,
  `stockId` int(11) NOT NULL,
  `CategoryName` int(11) NOT NULL,
  `ProductName` int(11) NOT NULL,
  `serialNo` varchar(255) NOT NULL,
  `batchNo` int(11) DEFAULT NULL,
  `poNo` int(11) DEFAULT NULL,
  `SupplierId` int(11) NOT NULL,
  `Cost` float(11,2) NOT NULL,
  `SalePrice` float(11,2) NOT NULL,
  `Status` int(1) NOT NULL,
  `empId` int(11) DEFAULT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`damgeItemId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `damageitems`
--

INSERT INTO `damageitems` (`damgeItemId`, `stockId`, `CategoryName`, `ProductName`, `serialNo`, `batchNo`, `poNo`, `SupplierId`, `Cost`, `SalePrice`, `Status`, `empId`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 6, 1, 1, 'TMOSP10W301L005', 6, 1, 1, 16500.00, 20500.00, 4, NULL, 6, '2023-08-01', NULL, NULL),
(2, 7, 1, 1, 'TMOSP10W301L006', 6, 1, 1, 18000.00, 22500.00, 5, NULL, 6, '2023-08-01', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desgination`
--

INSERT INTO `desgination` (`DesId`, `UserRole`, `Status`) VALUES
(1, 'admin', 1),
(2, 'manager', 1),
(3, 'inspectionOfficer', 1),
(4, 'supervisor', 1),
(5, 'technician', 1),
(6, 'stockKeeper', 1),
(7, 'Cashier', 1),
(8, 'Proprietor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province_id` int(11) NOT NULL,
  `DistrictName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provinces_id` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `province_id`, `DistrictName`) VALUES
(1, 6, 'Ampara'),
(2, 8, 'Anuradhapura'),
(3, 7, 'Badulla'),
(4, 6, 'Batticaloa'),
(5, 1, 'Colombo'),
(6, 3, 'Galle'),
(7, 1, 'Gampaha'),
(8, 3, 'Hambantota'),
(9, 9, 'Jaffna'),
(10, 1, 'Kalutara'),
(11, 2, 'Kandy'),
(12, 5, 'Kegalle'),
(13, 9, 'Kilinochchi'),
(14, 4, 'Kurunegala'),
(15, 9, 'Mannar'),
(16, 2, 'Matale'),
(17, 3, 'Matara'),
(18, 7, 'Monaragala'),
(19, 9, 'Mullaitivu'),
(20, 2, 'Nuwara Eliya'),
(21, 8, 'Polonnaruwa'),
(22, 4, 'Puttalam'),
(23, 5, 'Ratnapura'),
(24, 6, 'Trincomalee'),
(25, 9, 'Vavuniya');

-- --------------------------------------------------------

--
-- Table structure for table `empabsent`
--

DROP TABLE IF EXISTS `empabsent`;
CREATE TABLE IF NOT EXISTS `empabsent` (
  `empAbsentId` int(11) NOT NULL AUTO_INCREMENT,
  `empId` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`empAbsentId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empabsent`
--

INSERT INTO `empabsent` (`empAbsentId`, `empId`, `Date`) VALUES
(1, 2, '2023-07-22'),
(2, 8, '2023-07-23'),
(3, 5, '2023-08-03'),
(4, 7, '2023-08-04'),
(5, 8, '2023-08-04'),
(6, 6, '2023-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `empattendance`
--

DROP TABLE IF EXISTS `empattendance`;
CREATE TABLE IF NOT EXISTS `empattendance` (
  `EmpAttendanceId` int(11) NOT NULL AUTO_INCREMENT,
  `EmpId` int(11) NOT NULL,
  `CheckingTime` time NOT NULL,
  `CheckOutTime` time DEFAULT NULL,
  `OpenTime` time NOT NULL DEFAULT '08:00:00',
  `ClosedTime` time NOT NULL DEFAULT '18:00:00',
  `Date` date NOT NULL,
  PRIMARY KEY (`EmpAttendanceId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empattendance`
--

INSERT INTO `empattendance` (`EmpAttendanceId`, `EmpId`, `CheckingTime`, `CheckOutTime`, `OpenTime`, `ClosedTime`, `Date`) VALUES
(1, 17, '12:50:48', '23:42:35', '08:00:00', '18:00:00', '2023-07-22'),
(2, 17, '03:05:56', NULL, '08:00:00', '18:00:00', '2023-07-23'),
(3, 17, '00:33:05', NULL, '08:00:00', '18:00:00', '2023-07-24'),
(4, 8, '14:14:34', NULL, '08:00:00', '18:00:00', '2023-07-25'),
(5, 17, '19:57:44', NULL, '08:00:00', '18:00:00', '2023-07-30'),
(6, 3, '19:59:17', '18:00:00', '08:00:00', '18:00:00', '2023-07-30'),
(7, 7, '22:01:48', '18:00:00', '08:00:00', '18:00:00', '2023-07-30'),
(8, 8, '16:39:10', NULL, '08:00:00', '18:00:00', '2023-07-31'),
(9, 2, '19:26:21', '18:00:00', '08:00:00', '18:00:00', '2023-08-01'),
(10, 3, '19:26:33', '18:00:00', '08:00:00', '18:00:00', '2023-08-01'),
(11, 4, '19:26:39', '18:00:00', '08:00:00', '18:00:00', '2023-08-01'),
(12, 7, '19:26:47', '18:00:00', '08:00:00', '18:00:00', '2023-08-01'),
(13, 8, '19:26:55', NULL, '08:00:00', '18:00:00', '2023-08-01'),
(14, 2, '19:37:12', '18:00:00', '08:00:00', '18:00:00', '2023-08-02'),
(15, 3, '19:37:23', '18:00:00', '08:00:00', '18:00:00', '2023-08-02'),
(16, 4, '19:37:33', '18:00:00', '08:00:00', '18:00:00', '2023-08-02'),
(17, 7, '19:37:44', '18:00:00', '08:00:00', '18:00:00', '2023-08-02'),
(18, 8, '19:37:53', '19:40:44', '08:00:00', '18:00:00', '2023-08-02'),
(19, 6, '19:42:11', '18:00:00', '08:00:00', '18:00:00', '2023-08-02'),
(20, 9, '19:45:25', '18:00:00', '08:00:00', '18:00:00', '2023-08-02'),
(21, 2, '21:22:00', NULL, '08:00:00', '18:00:00', '2023-08-03'),
(22, 3, '21:22:46', NULL, '08:00:00', '18:00:00', '2023-08-03'),
(23, 4, '21:23:06', NULL, '08:00:00', '18:00:00', '2023-08-03'),
(24, 7, '21:23:20', NULL, '08:00:00', '18:00:00', '2023-08-03'),
(25, 8, '21:23:48', NULL, '08:00:00', '18:00:00', '2023-08-03'),
(26, 2, '21:08:07', NULL, '08:00:00', '18:00:00', '2023-08-04'),
(27, 3, '21:08:21', NULL, '08:00:00', '18:00:00', '2023-08-04'),
(28, 4, '21:08:30', NULL, '08:00:00', '18:00:00', '2023-08-04'),
(29, 7, '03:51:39', NULL, '08:00:00', '18:00:00', '2023-08-05'),
(30, 2, '09:30:44', NULL, '08:00:00', '18:00:00', '2023-08-05'),
(31, 8, '09:32:33', NULL, '08:00:00', '18:00:00', '2023-08-05'),
(32, 3, '14:13:58', NULL, '08:00:00', '18:00:00', '2023-08-05');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estimate`
--

INSERT INTO `estimate` (`EstimateID`, `EstimateNo`, `InspectionId`, `EstimateStatus`, `AddUser`, `AddDate`, `UpdateCustomer`, `UpdateCusDate`) VALUES
(3, 'EST202307255763', 6, 1, 5, '2023-07-25', NULL, NULL),
(4, 'EST202308019488', 8, 1, 5, '2023-08-01', NULL, NULL),
(5, 'EST202308027087', 6, 1, 5, '2023-08-02', NULL, NULL),
(6, 'EST202308046956', 9, 1, 5, '2023-08-04', NULL, NULL),
(7, 'EST202308056982', 11, 1, 5, '2023-08-05', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estimateitems`
--

INSERT INTO `estimateitems` (`estimateItemID`, `estimateID`, `ProdcutId`, `RepairId`, `Qty`, `Amount`) VALUES
(1, 1, 1, NULL, 2, '1690.00'),
(2, 1, 2, NULL, 2, '1590.00'),
(3, 1, NULL, 1, 1, '1500'),
(4, 2, 1, NULL, 5, '1690.00'),
(5, 2, NULL, 1, 1, '4500'),
(6, 3, 3, NULL, 5, ''),
(7, 4, 1, NULL, 3, '1690.00'),
(8, 4, NULL, 1, 1, '5000.00'),
(9, 5, 3, NULL, 0, ''),
(10, 6, 1, NULL, 0, '1690.00'),
(11, 6, NULL, 1, 1, '5000.00'),
(12, 7, 2, NULL, 6, '1590.00'),
(13, 7, NULL, 1, 1, '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `expireitems`
--

DROP TABLE IF EXISTS `expireitems`;
CREATE TABLE IF NOT EXISTS `expireitems` (
  `expireItemId` int(11) NOT NULL AUTO_INCREMENT,
  `stockId` int(11) NOT NULL,
  `CategoryName` int(11) NOT NULL,
  `ProductName` int(11) NOT NULL,
  `serialNo` varchar(255) NOT NULL,
  `batchNo` int(11) DEFAULT NULL,
  `poNo` int(11) DEFAULT NULL,
  `SupplierId` int(11) NOT NULL,
  `ExpireDate` date NOT NULL,
  `Cost` float(11,2) NOT NULL,
  `SalePrice` float(11,2) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`expireItemId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expireitems`
--

INSERT INTO `expireitems` (`expireItemId`, `stockId`, `CategoryName`, `ProductName`, `serialNo`, `batchNo`, `poNo`, `SupplierId`, `ExpireDate`, `Cost`, `SalePrice`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 1, 1, 4, '12345666666', 5, 4, 1, '2023-07-29', 15000.00, 20000.00, 1, 6, '2023-08-01', NULL, NULL),
(2, 2, 1, 1, 'TMOSP10W301L001', 6, 1, 1, '2023-08-01', 16500.00, 20500.00, 1, 6, '2023-08-01', NULL, NULL),
(3, 27, 1, 1, 'TMOSP10W301L9006', 6, 14, 1, '2023-08-05', 5690.00, 7900.00, 1, 6, '2023-08-05', NULL, NULL),
(4, 28, 1, 2, 'TMOSP10W304L9000', 10, 2, 1, '2023-08-05', 11300.00, 14500.00, 1, 6, '2023-08-05', NULL, NULL),
(5, 8, 2, 20, 'TMOAUTMOL001', 8, 11, 1, '2023-11-11', 12500.00, 13500.00, 1, 6, '2024-01-13', NULL, NULL),
(6, 10, 2, 21, 'TMOAUTMOL003', 9, 12, 1, '2023-10-31', 18750.00, 22600.00, 1, 6, '2024-01-13', NULL, NULL),
(7, 18, 1, 1, 'TMOSP10W301L402', 6, 1, 1, '2023-11-30', 16500.00, 17000.00, 1, 6, '2024-01-13', NULL, NULL),
(8, 23, 1, 1, 'TMOSP10W301L9001', 6, 1, 1, '2023-11-10', 3500.00, 5000.00, 1, 6, '2024-01-13', NULL, NULL),
(9, 24, 1, 1, 'TMOSP10W301L90067', 6, 1, 1, '2023-11-18', 4390.00, 6890.00, 1, 6, '2024-01-13', NULL, NULL),
(10, 25, 1, 1, 'TMOSP10W301L900678', 6, 14, 1, '2023-11-30', 6789.00, 9870.00, 1, 6, '2024-01-13', NULL, NULL),
(11, 26, 1, 1, 'TMOSP10W301L90097', 6, 1, 1, '2023-11-10', 2340.00, 6789.00, 1, 6, '2024-01-13', NULL, NULL),
(12, 30, 1, 2, 'TMOSP10W304L90583', 11, 6, 1, '2023-12-01', 14500.00, 18500.00, 1, 6, '2024-01-13', NULL, NULL),
(13, 31, 1, 2, 'TMOSP10W304L9789', 10, 2, 1, '2023-11-30', 14300.00, 16700.00, 1, 6, '2024-01-13', NULL, NULL),
(14, 32, 1, 2, 'TMOSP10W304L7899', 10, 2, 1, '2023-11-25', 12560.00, 17890.00, 1, 6, '2024-01-13', NULL, NULL),
(15, 33, 1, 2, 'TMOSP10W304L8790', 10, 2, 1, '2023-11-17', 14390.00, 16590.00, 1, 6, '2024-01-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `frequentasked`
--

DROP TABLE IF EXISTS `frequentasked`;
CREATE TABLE IF NOT EXISTS `frequentasked` (
  `questionid` int(10) NOT NULL AUTO_INCREMENT,
  `questionname` varchar(1000) NOT NULL,
  `questionanswer` varchar(1000) NOT NULL,
  `status` int(10) NOT NULL,
  `adduser` int(10) NOT NULL,
  `adddate` date NOT NULL,
  `updateuser` int(10) DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `frequenttimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`questionid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frequentasked`
--

INSERT INTO `frequentasked` (`questionid`, `questionname`, `questionanswer`, `status`, `adduser`, `adddate`, `updateuser`, `updatedate`, `frequenttimestamp`) VALUES
(1, 'what services does replica service offer??', 'replica service offers a wide range of vehicle services, including routine maintenance, oil changes, brake repairs, engine diagnostics, tire rotations, and more. we aim to be your one-stop-shop for all your vehicle needs..', 1, 62, '2023-05-01', 0, '0000-00-00', '2023-08-04 20:31:52'),
(2, 'how often should i service my vehicle at replica service?', 'regular maintenance is essential to keep your vehicle in top condition. for most vehicles, we recommend servicing every 6,000 to 10,000 miles or every 6 to 12 months, depending on your driving habits.', 1, 62, '2023-05-01', NULL, NULL, '2023-08-03 13:30:44'),
(3, 'are your technicians certified and experienced?', 'absolutely! our technicians are highly skilled, certified, and experienced professionals with a passion for providing excellent service. they undergo regular training to stay up-to-date with the latest automotive technologies.', 1, 62, '2023-05-01', NULL, NULL, '2023-08-03 13:31:14'),
(4, 'how long does a typical service appointment take?', 'the duration of a service appointment varies based on the type of service required and your vehicles condition. in most cases, our efficient team strives to complete routine services within a few hours', 1, 62, '2023-05-01', NULL, NULL, '2023-08-03 13:36:04'),
(5, ' can i bring my car to replica service even if its not a replica vehicle?', ' of course! while our name is replica service, we proudly serve all makes and models of vehicles. whether its a replica, classic car, luxury vehicle, or everyday commuter, we have the expertise to handle it.', 1, 62, '2023-05-01', NULL, NULL, '2023-08-03 13:34:16'),
(6, 'do we use genuine parts for vehicle repairs?', 'at replica service, we prioritize quality and reliability. whenever possible, we use genuine oem (original equipment manufacturer) parts. however, we also offer high-quality aftermarket options to fit your preferences and budget.', 1, 62, '2023-05-01', NULL, NULL, '2023-08-03 13:36:50'),
(7, 'is it necessary to service my vehicle at regular intervals if its running smoothly?', 'yes, regular maintenance is essential even if your vehicle seems to be running fine. routine service helps prevent potential issues and extends the lifespan of your vehicle, saving you from costly repairs later on.', 0, 58, '2023-07-17', NULL, NULL, '2023-08-04 20:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `fueltype`
--

DROP TABLE IF EXISTS `fueltype`;
CREATE TABLE IF NOT EXISTS `fueltype` (
  `FuelTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `FuelType` varchar(100) NOT NULL,
  PRIMARY KEY (`FuelTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fueltype`
--

INSERT INTO `fueltype` (`FuelTypeId`, `FuelType`) VALUES
(1, 'Petrol'),
(2, 'Diesel'),
(3, 'Gasoline'),
(4, 'Electric');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`HolidayId`, `HolidayName`, `HolidayDate`, `HolidayTime`, `HolidayStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Cloed', '2023-07-10', '10:59:00', 0, 1, '2023-04-10', NULL, NULL),
(2, 'Poya Day', '2023-08-01', '08:00:00', 1, 1, '2023-07-29', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

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
(12, 4, 4, '2023-07-11', 5, 1),
(13, 3, 1, '2023-07-16', 5, 1),
(14, 3, 3, '2023-07-16', 5, 1),
(15, 5, 2, '2023-07-17', 5, 1),
(16, 5, 3, '2023-07-17', 5, 1),
(17, 5, 4, '2023-07-17', 5, 1),
(22, 7, 2, '2023-08-01', 5, 1),
(23, 7, 3, '2023-08-01', 5, 1),
(24, 7, 4, '2023-08-01', 5, 1),
(25, 8, 3, '2023-08-01', 5, 1),
(26, 8, 4, '2023-08-01', 5, 1),
(27, 6, 2, '2023-08-02', 5, 1),
(28, 6, 4, '2023-08-02', 5, 1),
(29, 9, 3, '2023-08-04', 5, 1),
(30, 9, 3, '2023-08-04', 5, 1),
(31, 9, 4, '2023-08-04', 5, 1),
(32, 9, 4, '2023-08-04', 5, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

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
(16, 4, 4, 3),
(17, 5, 1, 1),
(18, 5, 2, 2),
(19, 5, 3, 2),
(20, 5, 4, 3),
(21, 6, 1, 1),
(22, 6, 2, 2),
(23, 6, 3, 2),
(24, 6, 4, 3),
(25, 7, 1, 1),
(26, 7, 3, 2),
(27, 7, 4, 3),
(28, 8, 1, 1),
(29, 8, 2, 2),
(30, 8, 3, 2),
(31, 8, 4, 3),
(32, 9, 1, 1),
(33, 9, 2, 3),
(34, 9, 3, 2),
(35, 9, 4, 1),
(36, 9, 1, 1),
(37, 9, 2, 2),
(38, 9, 3, 2),
(39, 9, 4, 3),
(40, 9, 1, 1),
(41, 9, 2, 2),
(42, 9, 3, 2),
(43, 9, 4, 3),
(44, 10, 1, 3),
(45, 10, 2, 1),
(46, 11, 1, 3),
(47, 11, 2, 3),
(48, 11, 3, 3),
(49, 11, 4, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`InspectionId`, `InspectionNo`, `VehicleNo`, `CustomerName`, `Millege`, `FuelType`, `inspectionNotes`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(6, 'INS202307256075', '1', '1', '123456KM', NULL, 'Engine Sound is very high', 1, 5, '2023-07-25', NULL, NULL),
(7, 'INS202308014091', '2', '1', '123456KM', NULL, '', 1, 5, '2023-08-01', NULL, NULL),
(8, 'INS202308014805', '2', '1', '123456KM', NULL, 'Engine Sound High', 3, 5, '2023-08-01', NULL, NULL),
(9, 'INS202308046252', '5', '3', '85000', NULL, 'Unusual Sound hearing From the Engine Bay', 6, 5, '2023-08-04', 4, '2023-08-04'),
(10, 'INS202308053329', '1', '1', '456890', NULL, '', 1, 5, '2023-08-05', NULL, NULL),
(11, 'INS202308057936', '3', '2', '234578', NULL, 'Test', 4, 5, '2023-08-05', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectionsestimateitems`
--

INSERT INTO `inspectionsestimateitems` (`estimateitemid`, `estimateinspectionid`, `addedproductid`, `Qty`, `addeduser`, `addeddate`, `estimatedtimestamp`) VALUES
(4, 2, 1, 1, 5, '2023-07-09', '2023-07-08 22:52:12'),
(6, 3, 4, 1, 5, '2023-07-11', '2023-07-10 18:35:53'),
(18, 4, 2, 1, 5, '2023-07-12', '2023-07-12 17:50:26'),
(19, 5, 1, 1, 5, '2023-07-17', '2023-07-17 15:23:22'),
(20, 6, 3, 1, 5, '2023-07-25', '2023-07-25 09:15:43'),
(21, 8, 1, 1, 5, '2023-08-01', '2023-08-01 17:27:10'),
(29, 9, 1, 1, 5, '2023-08-04', '2023-08-04 06:25:20'),
(31, 11, 2, 1, 5, '2023-08-05', '2023-08-05 08:39:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectionsestimateitemsrepair`
--

INSERT INTO `inspectionsestimateitemsrepair` (`insEstimatedRepairId`, `insEstimatedInspectionId`, `addedrepairid`, `Qty`, `AddDate`, `estimatedtimestamp`, `AddUser`) VALUES
(1, 3, 1, 1, '2023-07-11', '2023-07-10 18:36:09', 5),
(2, 5, 1, 1, '2023-07-17', '2023-07-17 15:23:28', 5),
(3, 8, 1, 1, '2023-08-01', '2023-08-01 17:27:15', 5),
(9, 9, 1, 1, '2023-08-04', '2023-08-04 06:21:22', 5),
(10, 11, 1, 1, '2023-08-05', '2023-08-05 08:40:30', 5);

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
-- Table structure for table `jobcardalerts`
--

DROP TABLE IF EXISTS `jobcardalerts`;
CREATE TABLE IF NOT EXISTS `jobcardalerts` (
  `JobCardAlertId` int(11) NOT NULL AUTO_INCREMENT,
  `JObCardId` int(11) NOT NULL,
  `AppointmentId` int(11) DEFAULT NULL,
  `InspectionId` int(11) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddTime` time NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateTime` time DEFAULT NULL,
  PRIMARY KEY (`JobCardAlertId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobcardalerts`
--

INSERT INTO `jobcardalerts` (`JobCardAlertId`, `JObCardId`, `AppointmentId`, `InspectionId`, `Status`, `AddUser`, `AddDate`, `AddTime`, `UpdateUser`, `UpdateDate`, `UpdateTime`) VALUES
(1, 12, 16, NULL, 1, 3, '2023-08-03', '01:20:00', NULL, NULL, NULL),
(2, 13, 18, NULL, 1, 3, '2023-08-03', '21:47:00', NULL, NULL, NULL),
(3, 14, NULL, 9, 1, 7, '2023-08-04', '15:37:00', NULL, NULL, NULL),
(4, 16, 19, NULL, 1, 3, '2023-08-04', '21:20:00', NULL, NULL, NULL),
(5, 18, 17, NULL, 1, 8, '2023-08-05', '09:47:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobcardtempitemsrepair`
--

DROP TABLE IF EXISTS `jobcardtempitemsrepair`;
CREATE TABLE IF NOT EXISTS `jobcardtempitemsrepair` (
  `JbtmpRId` int(11) NOT NULL AUTO_INCREMENT,
  `JobCardId` int(11) NOT NULL,
  `ReleaseSubId` int(11) NOT NULL,
  `ReleaseItemId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `StockId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`JbtmpRId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobcardtempitemsrepair`
--

INSERT INTO `jobcardtempitemsrepair` (`JbtmpRId`, `JobCardId`, `ReleaseSubId`, `ReleaseItemId`, `OrderId`, `ProductId`, `StockId`, `Qty`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`, `Status`) VALUES
(1, 3, 3, 0, 2, 1, 2, 1, 6, '2023-07-18', NULL, NULL, 1),
(2, 3, 3, 2, 2, 1, 2, 1, 6, '2023-07-18', NULL, NULL, 1),
(3, 3, 4, 3, 2, 1, 2, 1, 6, '2023-07-18', NULL, NULL, 1),
(4, 3, 5, 4, 2, 1, 2, 1, 6, '2023-07-18', NULL, NULL, 1),
(5, 3, 6, 5, 2, 1, 2, 1, 6, '2023-07-18', NULL, NULL, 1),
(6, 1, 1, 1, 1, 1, 1, 1, 6, '2023-07-17', NULL, NULL, 1),
(7, 1, 7, 1, 1, 6, 7, 1, 6, '2023-07-18', NULL, NULL, 0),
(8, 9, 9, 1, 1, 1, 3, 1, 6, '2023-08-01', NULL, NULL, 1),
(9, 10, 10, 2, 2, 1, 11, 1, 6, '2023-08-01', NULL, NULL, 1),
(10, 10, 11, 2, 2, 2, 15, 1, 6, '2023-08-01', NULL, NULL, 1),
(11, 11, 12, 3, 3, 1, 12, 1, 6, '2023-08-02', NULL, NULL, 1),
(12, 12, 13, 4, 4, 1, 13, 1, 6, '2023-08-02', NULL, NULL, 1),
(13, 12, 14, 4, 4, 21, 9, 1, 6, '2023-08-02', NULL, NULL, 1),
(14, 13, 15, 5, 5, 1, 14, 1, 6, '2023-08-03', NULL, NULL, 1),
(15, 14, 16, 6, 6, 1, 16, 1, 6, '2023-08-04', NULL, NULL, 0),
(16, 14, 17, 6, 6, 2, 17, 1, 6, '2023-08-04', NULL, NULL, 1),
(17, 16, 18, 7, 8, 1, 20, 1, 6, '2023-08-04', NULL, NULL, 1),
(18, 18, 19, 8, 10, 1, 22, 1, 6, '2023-08-05', NULL, NULL, 1),
(19, 11, 20, 9, 7, 1, 12, 1, 6, '2023-08-05', NULL, NULL, 1),
(20, 11, 21, 9, 7, 1, 19, 1, 6, '2023-08-05', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_carditems`
--

DROP TABLE IF EXISTS `job_carditems`;
CREATE TABLE IF NOT EXISTS `job_carditems` (
  `jobcardItemsId` int(11) NOT NULL AUTO_INCREMENT,
  `JobCardId` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `StockId` int(11) DEFAULT NULL,
  `SerialNo` varchar(255) DEFAULT NULL,
  `ProductQty` int(11) DEFAULT NULL,
  `ProductCost` float(11,2) DEFAULT NULL,
  `ProductAmount` float(11,2) DEFAULT NULL,
  `RepairId` int(11) DEFAULT NULL,
  `RepairCost` float(11,2) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `Amount` float(11,2) DEFAULT NULL,
  `AddDate` date NOT NULL,
  `AddUser` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`jobcardItemsId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_carditems`
--

INSERT INTO `job_carditems` (`jobcardItemsId`, `JobCardId`, `ProductId`, `StockId`, `SerialNo`, `ProductQty`, `ProductCost`, `ProductAmount`, `RepairId`, `RepairCost`, `Qty`, `Amount`, `AddDate`, `AddUser`, `Status`) VALUES
(1, 12, 1, 13, 'TMO12345670456', 1, 17500.00, 18900.00, NULL, NULL, NULL, NULL, '2023-08-03', 4, 1),
(2, 12, 21, 9, 'TMOAUTMOL002', 1, 20500.00, 22500.00, NULL, NULL, NULL, NULL, '2023-08-03', 4, 1),
(3, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1000.00, 1, 5000.00, '2023-08-03', 4, 1),
(4, 12, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1500.00, 1, 3500.00, '2023-08-03', 4, 1),
(5, 13, 1, 14, 'TMO12345670375', 1, 13500.00, 16500.00, NULL, NULL, NULL, NULL, '2023-08-03', 4, 1),
(6, 13, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1000.00, 1, 5000.00, '2023-08-03', 4, 1),
(7, 14, 2, 17, 'TMO12345672002', 1, 18500.00, 19500.00, NULL, NULL, NULL, NULL, '2023-08-04', 4, 1),
(8, 14, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1000.00, 1, 5000.00, '2023-08-04', 4, 1),
(9, 16, 1, 20, 'TMOSP10W301L6802', 1, 2480.00, 5480.00, NULL, NULL, NULL, NULL, '2023-08-04', 4, 1),
(10, 16, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1000.00, 1, 5000.00, '2023-08-04', 4, 1),
(11, 18, 1, 22, 'TMOSP10W301L9000', 1, 4500.00, 6000.00, NULL, NULL, NULL, NULL, '2023-08-05', 4, 1),
(12, 18, NULL, NULL, NULL, NULL, NULL, NULL, 7, 5500.00, 1, 7500.00, '2023-08-05', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_cards`
--

DROP TABLE IF EXISTS `job_cards`;
CREATE TABLE IF NOT EXISTS `job_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `JobCardNo` text NOT NULL,
  `JobCardType` int(1) NOT NULL,
  `AppointmentId` int(11) DEFAULT NULL,
  `Inspectionid` int(11) DEFAULT NULL,
  `empId` int(11) NOT NULL,
  `AppDate` date DEFAULT NULL,
  `AppointmentNo` varchar(255) DEFAULT NULL,
  `InspectionNo` varchar(255) DEFAULT NULL,
  `CustomerId` int(11) NOT NULL,
  `VehicleNo` varchar(50) NOT NULL,
  `CustomerNo` int(11) NOT NULL,
  `timeslotidappointment` int(11) DEFAULT NULL,
  `JobCardCost` float(10,2) NOT NULL DEFAULT '0.00',
  `JobCardPrice` float(10,2) NOT NULL DEFAULT '0.00',
  `TotalProductsCost` float(11,2) NOT NULL DEFAULT '0.00',
  `TotalProductAmount` float(11,2) NOT NULL DEFAULT '0.00',
  `TotalRepairCost` float(11,2) NOT NULL DEFAULT '0.00',
  `TotalRepairProfit` float(11,2) NOT NULL DEFAULT '0.00',
  `Status` int(1) NOT NULL,
  `JobCardAlertUpdate` int(1) DEFAULT '0',
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddTime` time NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateTime` time DEFAULT NULL,
  `NextServiceDate` date DEFAULT NULL,
  `NextServiceMillege` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_cards`
--

INSERT INTO `job_cards` (`id`, `JobCardNo`, `JobCardType`, `AppointmentId`, `Inspectionid`, `empId`, `AppDate`, `AppointmentNo`, `InspectionNo`, `CustomerId`, `VehicleNo`, `CustomerNo`, `timeslotidappointment`, `JobCardCost`, `JobCardPrice`, `TotalProductsCost`, `TotalProductAmount`, `TotalRepairCost`, `TotalRepairProfit`, `Status`, `JobCardAlertUpdate`, `AddUser`, `AddDate`, `AddTime`, `UpdateUser`, `UpdateDate`, `UpdateTime`, `NextServiceDate`, `NextServiceMillege`) VALUES
(1, 'JCS202307258886', 1, 4, NULL, 8, '2023-07-25', 'APP202307253253', NULL, 1, '1', 703966282, 13, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 2, '2023-07-25', '19:37:00', 8, '2023-07-25', '23:23:00', NULL, NULL),
(3, 'JCS202307259214', 1, 6, NULL, 8, '2023-07-27', 'APP202307257667', NULL, 1, '1', 703966282, 26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 2, '2023-07-25', '23:30:00', 8, '2023-07-25', '23:32:00', NULL, NULL),
(4, '11', 2, NULL, 1, 8, '2023-07-26', NULL, 'INS...', 1, '1', 1, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 5, '2023-07-26', '15:22:00', NULL, NULL, NULL, NULL, NULL),
(5, 'JCS202307275975', 1, 8, NULL, 8, '2023-07-28', 'APP202307275634', NULL, 1, '1', 703966282, 31, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 2, '2023-07-27', '22:22:00', 8, '2023-07-27', '22:23:00', NULL, NULL),
(6, 'JCS202307291106', 1, 10, NULL, 8, '2023-08-01', 'APP202307271873', NULL, 1, '1', 703966282, 14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 2, '2023-07-29', '03:47:00', 8, '2023-07-30', '23:29:00', NULL, NULL),
(7, 'JCS202307309807', 1, 12, NULL, 8, '2023-08-04', 'APP202307309520', NULL, 1, '1', 703966282, 32, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 2, '2023-07-30', '20:02:00', 8, '2023-07-30', '20:02:00', NULL, NULL),
(8, 'JCS202307301082', 1, 14, NULL, 8, '2023-08-03', 'APP202307307709', NULL, 1, '1', 703966282, 27, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 2, '2023-07-30', '23:27:00', 8, '2023-08-01', '10:09:00', NULL, NULL),
(9, 'JCS202307315376', 1, 13, NULL, 8, '2023-08-03', 'APP202307306751', NULL, 1, '1', 703966282, 25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 2, '2023-07-31', '16:39:00', 8, '2023-07-31', '16:41:00', NULL, NULL),
(10, 'JCS202308016596', 1, 15, NULL, 3, '2023-08-01', 'APP202307316945', NULL, 1, '1', 703966282, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 2, '2023-08-01', '19:38:00', 3, '2023-08-01', '19:38:00', NULL, NULL),
(11, 'JCR202308025372', 2, NULL, 8, 7, NULL, NULL, 'INS202308014805', 1, '2', 703966282, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 4, '2023-08-02', '11:50:00', 7, '2023-08-02', '12:53:00', NULL, NULL),
(12, 'JCS202308021411', 1, 16, NULL, 3, '2023-08-02', 'APP202307319376', NULL, 1, '1', 703966282, 19, 40500.00, 49900.00, 38000.00, 41400.00, 2500.00, 8500.00, 6, 2, 2, '2023-08-02', '20:10:00', 3, '2023-08-02', '20:12:00', NULL, NULL),
(13, 'JCS202308033124', 1, 18, NULL, 3, '2023-08-03', 'APP202308024043', NULL, 2, '4', 0, 26, 14500.00, 21500.00, 13500.00, 16500.00, 1000.00, 5000.00, 6, 2, 2, '2023-08-03', '21:34:00', 3, '2023-08-03', '21:35:00', NULL, NULL),
(14, 'JCR202308047954', 2, NULL, 9, 7, NULL, NULL, 'INS202308046252', 3, '5', 0, NULL, 19500.00, 24500.00, 18500.00, 19500.00, 1000.00, 5000.00, 6, 2, 4, '2023-08-04', '12:45:00', 7, '2023-08-04', '13:57:00', NULL, NULL),
(15, 'JCS202308044491', 1, 20, NULL, 3, '2023-08-04', 'APP202308037587', NULL, 3, '5', 0, 31, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 2, '2023-08-04', '19:46:00', NULL, NULL, NULL, NULL, NULL),
(16, 'JCS202308049409', 1, 19, NULL, 3, '2023-08-04', 'APP202308024550', NULL, 2, '4', 0, 17, 3480.00, 10480.00, 2480.00, 5480.00, 1000.00, 5000.00, 6, 2, 2, '2023-08-04', '21:13:00', 3, '2023-08-04', '21:14:00', NULL, NULL),
(17, 'JCS202308042448', 1, 21, NULL, 3, '2023-08-04', 'APP202308042072', NULL, 12, '6', 0, 12, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7, 0, 2, '2023-08-04', '21:51:00', 3, '2023-08-04', '21:52:00', NULL, NULL),
(18, 'JCS202308055429', 1, 17, NULL, 8, '2023-08-05', 'APP202308013749', NULL, 1, '1', 703966282, 39, 10000.00, 13500.00, 4500.00, 6000.00, 5500.00, 7500.00, 7, 2, 2, '2023-08-05', '09:33:00', 8, '2023-08-05', '09:34:00', '2023-11-03', '4567895'),
(19, 'JCR202308056464', 2, NULL, 11, 7, NULL, NULL, 'INS202308057936', 2, '3', 0, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2, 0, 4, '2023-08-05', '14:17:00', 7, '2023-08-05', '14:18:00', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

DROP TABLE IF EXISTS `logindetails`;
CREATE TABLE IF NOT EXISTS `logindetails` (
  `AttId` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `LoggedTime` varchar(11) NOT NULL,
  `LoggedDate` date NOT NULL,
  `LogoutTime` varchar(11) DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`AttId`)
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`AttId`, `User_Id`, `LoggedTime`, `LoggedDate`, `LogoutTime`, `LogoutDate`, `Status`) VALUES
(1, 2, '21:35', '2023-07-22', NULL, NULL, 1),
(2, 2, '09:58', '2023-07-23', NULL, NULL, 1),
(3, 1, '18:34', '2023-07-23', NULL, NULL, 1),
(4, 2, '18:35', '2023-07-23', NULL, NULL, 1),
(5, 1, '00:47', '2023-07-24', NULL, NULL, 1),
(6, 1, '00:52', '2023-07-24', NULL, NULL, 1),
(7, 2, '00:55', '2023-07-24', NULL, NULL, 1),
(8, 4, '00:56', '2023-07-24', NULL, NULL, 1),
(9, 7, '00:57', '2023-07-24', NULL, NULL, 1),
(10, 6, '00:58', '2023-07-24', NULL, NULL, 1),
(11, 2, '13:51', '2023-07-24', NULL, NULL, 1),
(12, 1, '19:34', '2023-07-24', NULL, NULL, 1),
(13, 1, '20:16', '2023-07-24', NULL, NULL, 1),
(14, 2, '21:35', '2023-07-24', NULL, NULL, 1),
(15, 1, '22:36', '2023-07-24', NULL, NULL, 1),
(16, 2, '22:37', '2023-07-24', NULL, NULL, 1),
(17, 2, '10:35', '2023-07-25', NULL, NULL, 1),
(18, 2, '13:13', '2023-07-25', NULL, NULL, 1),
(19, 1, '14:13', '2023-07-25', NULL, NULL, 1),
(20, 2, '14:14', '2023-07-25', NULL, NULL, 1),
(21, 8, '14:20', '2023-07-25', NULL, NULL, 1),
(22, 2, '14:27', '2023-07-25', NULL, NULL, 1),
(23, 4, '14:30', '2023-07-25', NULL, NULL, 1),
(24, 6, '14:34', '2023-07-25', NULL, NULL, 1),
(25, 7, '14:36', '2023-07-25', NULL, NULL, 1),
(26, 5, '14:39', '2023-07-25', NULL, NULL, 1),
(27, 4, '14:48', '2023-07-25', NULL, NULL, 1),
(28, 2, '17:18', '2023-07-25', NULL, NULL, 1),
(29, 8, '20:13', '2023-07-25', NULL, NULL, 1),
(30, 7, '21:03', '2023-07-25', NULL, NULL, 1),
(31, 2, '21:18', '2023-07-25', NULL, NULL, 1),
(32, 5, '21:18', '2023-07-25', NULL, NULL, 1),
(33, 2, '23:28', '2023-07-25', NULL, NULL, 1),
(34, 8, '23:31', '2023-07-25', NULL, NULL, 1),
(35, 7, '23:37', '2023-07-25', NULL, NULL, 1),
(36, 8, '23:37', '2023-07-25', NULL, NULL, 1),
(37, 2, '11:20', '2023-07-26', NULL, NULL, 1),
(38, 2, '12:56', '2023-07-26', NULL, NULL, 1),
(39, 8, '12:57', '2023-07-26', NULL, NULL, 1),
(40, 8, '19:35', '2023-07-26', NULL, NULL, 1),
(41, 2, '19:49', '2023-07-26', NULL, NULL, 1),
(42, 8, '19:51', '2023-07-26', NULL, NULL, 1),
(43, 8, '02:29', '2023-07-27', NULL, NULL, 1),
(44, 8, '08:34', '2023-07-27', NULL, NULL, 1),
(45, 8, '18:35', '2023-07-27', NULL, NULL, 1),
(46, 6, '19:11', '2023-07-27', NULL, NULL, 1),
(47, 2, '19:11', '2023-07-27', NULL, NULL, 1),
(48, 1, '19:19', '2023-07-27', NULL, NULL, 1),
(49, 2, '21:02', '2023-07-27', NULL, NULL, 1),
(50, 6, '21:16', '2023-07-27', NULL, NULL, 1),
(51, 2, '21:23', '2023-07-27', NULL, NULL, 1),
(52, 2, '21:36', '2023-07-27', NULL, NULL, 1),
(53, 6, '22:03', '2023-07-27', NULL, NULL, 1),
(54, 2, '22:21', '2023-07-27', NULL, NULL, 1),
(55, 8, '22:22', '2023-07-27', NULL, NULL, 1),
(56, 2, '01:55', '2023-07-28', NULL, NULL, 1),
(57, 2, '12:59', '2023-07-28', NULL, NULL, 1),
(58, 1, '17:59', '2023-07-28', NULL, NULL, 1),
(59, 2, '17:59', '2023-07-28', NULL, NULL, 1),
(60, 1, '19:25', '2023-07-28', NULL, NULL, 1),
(61, 2, '19:27', '2023-07-28', NULL, NULL, 1),
(62, 1, '19:36', '2023-07-28', NULL, NULL, 1),
(63, 2, '11:27', '2023-07-29', NULL, NULL, 1),
(64, 2, '11:28', '2023-07-29', NULL, NULL, 1),
(65, 8, '12:03', '2023-07-29', NULL, NULL, 1),
(66, 6, '18:01', '2023-07-29', NULL, NULL, 1),
(67, 8, '18:10', '2023-07-29', NULL, NULL, 1),
(68, 8, '18:19', '2023-07-29', NULL, NULL, 1),
(69, 6, '00:33', '2023-07-30', NULL, NULL, 1),
(70, 8, '00:35', '2023-07-30', NULL, NULL, 1),
(71, 7, '01:03', '2023-07-30', NULL, NULL, 1),
(72, 8, '01:03', '2023-07-30', NULL, NULL, 1),
(73, 7, '01:07', '2023-07-30', NULL, NULL, 1),
(74, 8, '01:08', '2023-07-30', NULL, NULL, 1),
(75, 7, '01:09', '2023-07-30', NULL, NULL, 1),
(76, 6, '01:13', '2023-07-30', NULL, NULL, 1),
(77, 2, '01:16', '2023-07-30', NULL, NULL, 1),
(78, 8, '01:26', '2023-07-30', NULL, NULL, 1),
(79, 6, '01:27', '2023-07-30', NULL, NULL, 1),
(80, 8, '01:28', '2023-07-30', NULL, NULL, 1),
(81, 2, '01:38', '2023-07-30', NULL, NULL, 1),
(82, 8, '02:33', '2023-07-30', NULL, NULL, 1),
(83, 2, '12:01', '2023-07-30', NULL, NULL, 1),
(84, 8, '12:03', '2023-07-30', NULL, NULL, 1),
(85, 6, '12:03', '2023-07-30', NULL, NULL, 1),
(86, 8, '13:48', '2023-07-30', NULL, NULL, 1),
(87, 2, '17:49', '2023-07-30', NULL, NULL, 1),
(88, 1, '19:56', '2023-07-30', NULL, NULL, 1),
(89, 2, '19:56', '2023-07-30', NULL, NULL, 1),
(90, 1, '19:58', '2023-07-30', NULL, NULL, 1),
(91, 2, '19:59', '2023-07-30', NULL, NULL, 1),
(92, 8, '20:02', '2023-07-30', NULL, NULL, 1),
(93, 6, '20:05', '2023-07-30', NULL, NULL, 1),
(94, 8, '20:06', '2023-07-30', NULL, NULL, 1),
(95, 4, '20:07', '2023-07-30', NULL, NULL, 1),
(96, 2, '20:15', '2023-07-30', NULL, NULL, 1),
(97, 2, '20:18', '2023-07-30', NULL, NULL, 1),
(98, 7, '21:57', '2023-07-30', NULL, NULL, 1),
(99, 1, '21:59', '2023-07-30', NULL, NULL, 1),
(100, 2, '22:01', '2023-07-30', NULL, NULL, 1),
(101, 2, '23:23', '2023-07-30', NULL, NULL, 1),
(102, 8, '23:29', '2023-07-30', NULL, NULL, 1),
(103, 8, '23:30', '2023-07-30', NULL, NULL, 1),
(104, 6, '23:41', '2023-07-30', NULL, NULL, 1),
(105, 1, '00:17', '2023-07-31', NULL, NULL, 1),
(106, 1, '00:19', '2023-07-31', NULL, NULL, 1),
(107, 18, '01:13', '2023-07-31', NULL, NULL, 1),
(108, 1, '01:56', '2023-07-31', NULL, NULL, 1),
(109, 2, '02:05', '2023-07-31', NULL, NULL, 1),
(110, 1, '07:26', '2023-07-31', NULL, NULL, 1),
(111, 2, '14:15', '2023-07-31', NULL, NULL, 1),
(112, 6, '15:17', '2023-07-31', NULL, NULL, 1),
(113, 2, '15:57', '2023-07-31', NULL, NULL, 1),
(114, 2, '16:13', '2023-07-31', NULL, NULL, 1),
(115, 8, '16:40', '2023-07-31', NULL, NULL, 1),
(116, 6, '16:45', '2023-07-31', NULL, NULL, 1),
(117, 8, '17:57', '2023-07-31', NULL, NULL, 1),
(118, 6, '17:57', '2023-07-31', NULL, NULL, 1),
(119, 8, '09:57', '2023-08-01', NULL, NULL, 1),
(120, 6, '13:51', '2023-08-01', NULL, NULL, 1),
(121, 6, '14:23', '2023-08-01', NULL, NULL, 1),
(122, 6, '14:24', '2023-08-01', NULL, NULL, 1),
(123, 8, '15:37', '2023-08-01', NULL, NULL, 1),
(124, 8, '15:41', '2023-08-01', NULL, NULL, 1),
(125, 6, '15:44', '2023-08-01', NULL, NULL, 1),
(126, 8, '17:13', '2023-08-01', NULL, NULL, 1),
(127, 6, '19:02', '2023-08-01', NULL, NULL, 1),
(128, 2, '19:21', '2023-08-01', NULL, NULL, 1),
(129, 1, '19:21', '2023-08-01', NULL, NULL, 1),
(130, 2, '19:25', '2023-08-01', NULL, NULL, 1),
(131, 2, '19:37', '2023-08-01', NULL, NULL, 1),
(132, 3, '19:38', '2023-08-01', NULL, NULL, 1),
(133, 6, '19:41', '2023-08-01', NULL, NULL, 1),
(134, 4, '20:08', '2023-08-01', NULL, NULL, 1),
(135, 1, '20:27', '2023-08-01', NULL, NULL, 1),
(136, 9, '20:32', '2023-08-01', NULL, NULL, 1),
(137, 5, '22:40', '2023-08-01', NULL, NULL, 1),
(138, 5, '22:50', '2023-08-01', NULL, NULL, 1),
(139, 4, '22:58', '2023-08-01', NULL, NULL, 1),
(140, 6, '22:59', '2023-08-01', NULL, NULL, 1),
(141, 2, '00:59', '2023-08-02', NULL, NULL, 1),
(142, 5, '09:33', '2023-08-02', NULL, NULL, 1),
(143, 4, '09:54', '2023-08-02', NULL, NULL, 1),
(144, 2, '10:01', '2023-08-02', NULL, NULL, 1),
(145, 4, '10:01', '2023-08-02', NULL, NULL, 1),
(146, 7, '11:52', '2023-08-02', NULL, NULL, 1),
(147, 8, '13:46', '2023-08-02', NULL, NULL, 1),
(148, 7, '13:50', '2023-08-02', NULL, NULL, 1),
(149, 8, '14:25', '2023-08-02', NULL, NULL, 1),
(150, 6, '15:33', '2023-08-02', NULL, NULL, 1),
(151, 8, '15:43', '2023-08-02', NULL, NULL, 1),
(152, 6, '15:48', '2023-08-02', NULL, NULL, 1),
(153, 7, '16:34', '2023-08-02', NULL, NULL, 1),
(154, 2, '18:39', '2023-08-02', NULL, NULL, 1),
(155, 2, '18:54', '2023-08-02', NULL, NULL, 1),
(156, 2, '19:36', '2023-08-02', NULL, NULL, 1),
(157, 1, '19:41', '2023-08-02', NULL, NULL, 1),
(158, 2, '20:00', '2023-08-02', NULL, NULL, 1),
(159, 3, '20:11', '2023-08-02', NULL, NULL, 1),
(160, 6, '20:15', '2023-08-02', NULL, NULL, 1),
(161, 3, '21:12', '2023-08-02', NULL, NULL, 1),
(162, 3, '21:13', '2023-08-02', NULL, NULL, 1),
(163, 4, '21:16', '2023-08-02', NULL, NULL, 1),
(164, 3, '21:17', '2023-08-02', NULL, NULL, 1),
(165, 2, '21:19', '2023-08-02', NULL, NULL, 1),
(166, 4, '21:19', '2023-08-02', NULL, NULL, 1),
(167, 2, '21:22', '2023-08-02', NULL, NULL, 1),
(168, 4, '21:24', '2023-08-02', NULL, NULL, 1),
(169, 3, '21:55', '2023-08-02', NULL, NULL, 1),
(170, 2, '22:12', '2023-08-02', NULL, NULL, 1),
(171, 2, '22:40', '2023-08-02', NULL, NULL, 1),
(172, 3, '22:41', '2023-08-02', NULL, NULL, 1),
(173, 7, '22:42', '2023-08-02', NULL, NULL, 1),
(174, 8, '22:42', '2023-08-02', NULL, NULL, 1),
(175, 6, '22:52', '2023-08-02', NULL, NULL, 1),
(176, 8, '22:55', '2023-08-02', NULL, NULL, 1),
(177, 6, '22:55', '2023-08-02', NULL, NULL, 1),
(178, 7, '23:05', '2023-08-02', NULL, NULL, 1),
(179, 8, '23:06', '2023-08-02', NULL, NULL, 1),
(180, 3, '23:06', '2023-08-02', NULL, NULL, 1),
(181, 4, '23:07', '2023-08-02', NULL, NULL, 1),
(182, 3, '00:51', '2023-08-03', NULL, NULL, 1),
(183, 4, '01:25', '2023-08-03', NULL, NULL, 1),
(184, 2, '03:05', '2023-08-03', NULL, NULL, 1),
(185, 2, '14:02', '2023-08-03', NULL, NULL, 1),
(186, 8, '14:02', '2023-08-03', NULL, NULL, 1),
(187, 4, '15:54', '2023-08-03', NULL, NULL, 1),
(188, 8, '16:11', '2023-08-03', NULL, NULL, 1),
(189, 7, '16:12', '2023-08-03', NULL, NULL, 1),
(190, 2, '18:14', '2023-08-03', NULL, NULL, 1),
(191, 8, '18:18', '2023-08-03', NULL, NULL, 1),
(192, 4, '18:23', '2023-08-03', NULL, NULL, 1),
(193, 9, '20:21', '2023-08-03', NULL, NULL, 1),
(194, 2, '21:19', '2023-08-03', NULL, NULL, 1),
(195, 3, '21:34', '2023-08-03', NULL, NULL, 1),
(196, 6, '21:40', '2023-08-03', NULL, NULL, 1),
(197, 8, '21:45', '2023-08-03', NULL, NULL, 1),
(198, 3, '21:46', '2023-08-03', NULL, NULL, 1),
(199, 4, '21:47', '2023-08-03', NULL, NULL, 1),
(200, 9, '21:48', '2023-08-03', NULL, NULL, 1),
(201, 2, '09:54', '2023-08-04', NULL, NULL, 1),
(202, 4, '10:14', '2023-08-04', NULL, NULL, 1),
(203, 5, '10:16', '2023-08-04', NULL, NULL, 1),
(204, 4, '10:19', '2023-08-04', NULL, NULL, 1),
(205, 5, '10:51', '2023-08-04', NULL, NULL, 1),
(206, 5, '11:05', '2023-08-04', NULL, NULL, 1),
(207, 4, '12:23', '2023-08-04', NULL, NULL, 1),
(208, 7, '12:46', '2023-08-04', NULL, NULL, 1),
(209, 6, '14:01', '2023-08-04', NULL, NULL, 1),
(210, 7, '14:54', '2023-08-04', NULL, NULL, 1),
(211, 4, '15:37', '2023-08-04', NULL, NULL, 1),
(212, 9, '16:46', '2023-08-04', NULL, NULL, 1),
(213, 2, '19:45', '2023-08-04', NULL, NULL, 1),
(214, 7, '20:05', '2023-08-04', NULL, NULL, 1),
(215, 6, '20:06', '2023-08-04', NULL, NULL, 1),
(216, 7, '20:07', '2023-08-04', NULL, NULL, 1),
(217, 6, '20:07', '2023-08-04', NULL, NULL, 1),
(218, 7, '20:08', '2023-08-04', NULL, NULL, 1),
(219, 6, '20:09', '2023-08-04', NULL, NULL, 1),
(220, 6, '20:18', '2023-08-04', NULL, NULL, 1),
(221, 2, '20:44', '2023-08-04', NULL, NULL, 1),
(222, 2, '21:07', '2023-08-04', NULL, NULL, 1),
(223, 3, '21:13', '2023-08-04', NULL, NULL, 1),
(224, 6, '21:16', '2023-08-04', NULL, NULL, 1),
(225, 3, '21:19', '2023-08-04', NULL, NULL, 1),
(226, 4, '21:20', '2023-08-04', NULL, NULL, 1),
(227, 9, '21:23', '2023-08-04', NULL, NULL, 1),
(228, 6, '21:50', '2023-08-04', NULL, NULL, 1),
(229, 2, '21:51', '2023-08-04', NULL, NULL, 1),
(230, 3, '21:51', '2023-08-04', NULL, NULL, 1),
(231, 6, '21:52', '2023-08-04', NULL, NULL, 1),
(232, 6, '21:53', '2023-08-04', NULL, NULL, 1),
(233, 9, '22:00', '2023-08-04', NULL, NULL, 1),
(234, 2, '23:12', '2023-08-04', NULL, NULL, 1),
(235, 2, '02:00', '2023-08-05', NULL, NULL, 1),
(236, 6, '03:25', '2023-08-05', NULL, NULL, 1),
(237, 6, '03:32', '2023-08-05', NULL, NULL, 1),
(238, 5, '03:42', '2023-08-05', NULL, NULL, 1),
(239, 4, '03:47', '2023-08-05', NULL, NULL, 1),
(240, 2, '03:49', '2023-08-05', NULL, NULL, 1),
(241, 5, '03:55', '2023-08-05', NULL, NULL, 1),
(242, 2, '03:56', '2023-08-05', NULL, NULL, 1),
(243, 2, '04:23', '2023-08-05', NULL, NULL, 1),
(244, 2, '04:54', '2023-08-05', NULL, NULL, 1),
(245, 6, '05:10', '2023-08-05', NULL, NULL, 1),
(246, 2, '05:54', '2023-08-05', NULL, NULL, 1),
(247, 2, '05:55', '2023-08-05', NULL, NULL, 1),
(248, 4, '05:56', '2023-08-05', NULL, NULL, 1),
(249, 2, '05:56', '2023-08-05', NULL, NULL, 1),
(250, 2, '09:18', '2023-08-05', NULL, NULL, 1),
(251, 2, '09:23', '2023-08-05', NULL, NULL, 1),
(252, 1, '09:23', '2023-08-05', NULL, NULL, 1),
(253, 2, '09:29', '2023-08-05', NULL, NULL, 1),
(254, 8, '09:34', '2023-08-05', NULL, NULL, 1),
(255, 6, '09:37', '2023-08-05', NULL, NULL, 1),
(256, 8, '09:46', '2023-08-05', NULL, NULL, 1),
(257, 4, '09:47', '2023-08-05', NULL, NULL, 1),
(258, 9, '10:06', '2023-08-05', NULL, NULL, 1),
(259, 6, '12:20', '2023-08-05', NULL, NULL, 1),
(260, 1, '12:24', '2023-08-05', NULL, NULL, 1),
(261, 1, '12:36', '2023-08-05', NULL, NULL, 1),
(262, 2, '13:27', '2023-08-05', NULL, NULL, 1),
(263, 2, '13:29', '2023-08-05', NULL, NULL, 1),
(264, 9, '13:36', '2023-08-05', NULL, NULL, 1),
(265, 5, '14:04', '2023-08-05', NULL, NULL, 1),
(266, 4, '14:12', '2023-08-05', NULL, NULL, 1),
(267, 2, '14:13', '2023-08-05', NULL, NULL, 1),
(268, 4, '14:17', '2023-08-05', NULL, NULL, 1),
(269, 7, '14:17', '2023-08-05', NULL, NULL, 1),
(270, 6, '14:20', '2023-08-05', NULL, NULL, 1),
(271, 8, '14:22', '2023-08-05', NULL, NULL, 1),
(272, 2, '14:24', '2023-08-05', NULL, NULL, 1),
(273, 2, '14:52', '2023-08-05', NULL, NULL, 1),
(274, 1, '10:15', '2023-10-20', NULL, NULL, 1),
(275, 2, '10:15', '2023-10-20', NULL, NULL, 1),
(276, 2, '11:28', '2024-01-13', NULL, NULL, 1),
(277, 7, '11:30', '2024-01-13', NULL, NULL, 1),
(278, 6, '11:31', '2024-01-13', NULL, NULL, 1),
(279, 1, '23:33', '2024-02-20', NULL, NULL, 1);

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
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE IF NOT EXISTS `orderitems` (
  `OrderItemsId` int(11) NOT NULL AUTO_INCREMENT,
  `OrderId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `Status` int(1) DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`OrderItemsId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderItemsId`, `OrderId`, `ProductId`, `Qty`, `AddUser`, `AddDate`, `Status`, `UpdateUser`, `UpdateDate`) VALUES
(1, 1, 1, 1, 8, '2023-08-01', 2, 6, '2023-08-01'),
(2, 2, 1, 1, 3, '2023-08-01', 2, 6, '2023-08-01'),
(3, 2, 2, 1, 3, '2023-08-01', 2, 6, '2023-08-01'),
(4, 0, 1, 1, 7, '2023-08-02', NULL, NULL, NULL),
(5, 0, 1, 1, 7, '2023-08-02', NULL, NULL, NULL),
(6, 0, 1, 1, 7, '2023-08-02', NULL, NULL, NULL),
(7, 0, 20, 1, 8, '2023-08-02', NULL, NULL, NULL),
(8, 0, 1, 1, 7, '2023-08-02', NULL, NULL, NULL),
(9, 3, 1, 1, 7, '2023-08-02', 2, 6, '2023-08-02'),
(10, 4, 1, 1, 3, '2023-08-02', 2, 6, '2023-08-02'),
(11, 4, 20, 1, 3, '2023-08-02', NULL, NULL, NULL),
(12, 5, 1, 1, 3, '2023-08-03', 2, 6, '2023-08-03'),
(13, 6, 1, 1, 7, '2023-08-04', 2, 6, '2023-08-04'),
(14, 6, 2, 1, 7, '2023-08-04', 2, 6, '2023-08-04'),
(15, 7, 1, 1, 7, '2023-08-04', 2, 6, '2023-08-05'),
(16, 8, 1, 1, 3, '2023-08-04', 2, 6, '2023-08-04'),
(17, 9, 1, 1, 3, '2023-08-04', NULL, NULL, NULL),
(18, 10, 1, 1, 8, '2023-08-05', 2, 6, '2023-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `orderreleaseitem`
--

DROP TABLE IF EXISTS `orderreleaseitem`;
CREATE TABLE IF NOT EXISTS `orderreleaseitem` (
  `orderReleaseId` int(11) NOT NULL AUTO_INCREMENT,
  `JobCard` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `StockId` int(11) DEFAULT NULL,
  `Qty` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  PRIMARY KEY (`orderReleaseId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderreleaseitem`
--

INSERT INTO `orderreleaseitem` (`orderReleaseId`, `JobCard`, `ProductId`, `StockId`, `Qty`, `AddUser`, `AddDate`) VALUES
(1, 5, 1, 2, 1, 6, '2023-07-31'),
(8, 9, 1, 3, 1, 6, '2023-08-01'),
(9, 10, 1, 11, 1, 6, '2023-08-01'),
(10, 10, 2, 15, 1, 6, '2023-08-01'),
(14, 11, 1, 12, 1, 6, '2023-08-02'),
(15, 12, 1, 13, 1, 6, '2023-08-02'),
(16, 12, 21, 9, 1, 6, '2023-08-02'),
(17, 13, 1, 14, 1, 6, '2023-08-03'),
(21, 14, 1, 16, 1, 6, '2023-08-04'),
(22, 14, 2, 17, 1, 6, '2023-08-04'),
(24, 11, 1, 19, 1, 6, '2023-08-04'),
(25, 16, 1, 20, 1, 6, '2023-08-04'),
(27, 10, 1, 21, 1, 6, '2023-08-04'),
(28, 18, 1, 22, 1, 6, '2023-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `orderreqrepairs`
--

DROP TABLE IF EXISTS `orderreqrepairs`;
CREATE TABLE IF NOT EXISTS `orderreqrepairs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `JobCard_No` int(11) NOT NULL,
  `ReqRepairId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `addTimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AddUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderreqrepairs`
--

INSERT INTO `orderreqrepairs` (`id`, `JobCard_No`, `ReqRepairId`, `Qty`, `AddDate`, `addTimeStamp`, `AddUser`) VALUES
(13, 1, 4, 1, '2023-07-27', '2023-07-27 03:45:50', 8),
(15, 10, 1, 1, '2023-08-01', '2023-08-01 14:09:08', 3),
(28, 11, 1, 1, '2023-08-02', '2023-08-02 10:02:40', 7),
(29, 12, 1, 1, '2023-08-02', '2023-08-02 14:42:46', 3),
(30, 12, 2, 1, '2023-08-02', '2023-08-02 14:44:12', 3),
(38, 13, 1, 1, '2023-08-03', '2023-08-03 16:06:23', 3),
(39, 14, 1, 1, '2023-08-04', '2023-08-04 10:02:26', 7),
(40, 16, 1, 1, '2023-08-04', '2023-08-04 15:44:57', 3),
(42, 18, 7, 1, '2023-08-05', '2023-08-05 04:05:52', 8),
(43, 19, 1, 1, '2023-08-05', '2023-08-05 08:49:08', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orderrequestitems`
--

DROP TABLE IF EXISTS `orderrequestitems`;
CREATE TABLE IF NOT EXISTS `orderrequestitems` (
  `orderReqItemId` int(11) NOT NULL AUTO_INCREMENT,
  `JobCardId` int(11) NOT NULL,
  `ReqProductId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  PRIMARY KEY (`orderReqItemId`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderrequestitems`
--

INSERT INTO `orderrequestitems` (`orderReqItemId`, `JobCardId`, `ReqProductId`, `Qty`, `AddUser`, `AddDate`) VALUES
(6, 1, 1, 1, 7, '2023-07-16'),
(7, 1, 6, 1, 7, '2023-07-16'),
(12, 4, 1, 1, 8, '2023-07-29'),
(33, 5, 1, 1, 8, '2023-07-29'),
(34, 7, 1, 1, 8, '2023-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) NOT NULL,
  `JobCardNo` int(11) NOT NULL,
  `CustomerName` int(11) NOT NULL,
  `VehicleNo` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddUser` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderNo`, `JobCardNo`, `CustomerName`, `VehicleNo`, `AddDate`, `AddUser`, `Status`) VALUES
(1, 'ODR202308019981', 9, 1, 1, '2023-08-01', 8, 2),
(2, 'ODR202308015495', 10, 1, 1, '2023-08-01', 3, 2),
(3, 'ODR202308023731', 11, 1, 2, '2023-08-02', 7, 2),
(4, 'ODR202308025341', 12, 1, 1, '2023-08-02', 3, 2),
(5, 'ODR202308031877', 13, 2, 4, '2023-08-03', 3, 2),
(6, 'ODR202308042966', 14, 3, 5, '2023-08-04', 7, 2),
(7, 'ODR202308048746', 11, 1, 2, '2023-08-04', 7, 2),
(8, 'ODR202308049147', 16, 2, 4, '2023-08-04', 3, 2),
(9, 'ODR202308048438', 10, 1, 1, '2023-08-04', 3, 1),
(10, 'ODR202308052289', 18, 1, 1, '2023-08-05', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ProductId` int(11) NOT NULL AUTO_INCREMENT,
  `ProductImage` varchar(255) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductCatergory` int(11) NOT NULL,
  `SupplierName` int(11) NOT NULL,
  `ProductDescription` text NOT NULL,
  `Qty` int(11) DEFAULT '0',
  `IssuedQty` int(11) DEFAULT '0',
  `ReorderLevel` int(11) NOT NULL,
  `IssueLastDate` date DEFAULT NULL,
  `DamageQty` int(11) DEFAULT '0',
  `ExpiredQty` int(11) DEFAULT '0',
  `ProductStatus` int(1) NOT NULL,
  `OrderStatus` int(11) DEFAULT '0',
  `AddUser` int(11) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `ProductImage`, `ProductName`, `ProductCatergory`, `SupplierName`, `ProductDescription`, `Qty`, `IssuedQty`, `ReorderLevel`, `IssueLastDate`, `DamageQty`, `ExpiredQty`, `ProductStatus`, `OrderStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, '64c3a5d6c4bc94.19703110Toyota Motor Oil SP 10W-30 1L.jpg', 'Toyota Motor Oil SP 10W-30 1L', 1, 1, 'Made in Singapore.\nApproved by Toyota for Petrol engines', 7, 8, 6, '2023-08-05', 0, 0, 1, 1, 2, '2023-07-27', 6, '2023-08-05'),
(2, '64c3aef0c9d224.20270680Toyota Motor Oil SP 10W-30 4L.jpg', 'Toyota Motor Oil SP 10W-30 4L', 1, 1, 'Made in Singapore.\r\nApproved by Toyota for Petrol engines', 6, 2, 5, '2023-08-04', 0, 0, 1, 1, 2, '2023-07-28', 6, '2023-08-04'),
(3, '64c3af1f4780d2.24624184Toyota Motor Oil SP 5W-30.jpg', 'Toyota Motor Oil SP 5W-30 1L', 1, 1, 'Approved by Toyota for Petrol engines\r\nSuperior lubricating performance under extreme condition.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(4, '64c3af37e02e14.16297152Toyota Motor Oil SP 5W-30 4L.jpg', 'Toyota Motor Oil SP 5W-30 4L', 1, 1, 'Approved by Toyota for Petrol engines\r\nSuperior lubricating performance under extreme condition.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(5, '64c3b0dca69db3.34543009Toyota Motor Oil SP 15W-40 1L.jpg', 'Toyota Motor Oil SP 15W-40 1L', 1, 1, 'Made in Thailand.\r\nApproved by Toyota for Petrol engines.\r\nSuperior lubricating performance under extreme conditions.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(6, '64c3b160527d10.72973844Toyota Motor Oil SP 15W-40 4L.jpg', 'Toyota Motor Oil SP 15W-40 4L', 1, 1, 'Made in Thailand.\r\nApproved by Toyota for Petrol engines.\r\nSuperior lubricating performance under extreme conditions.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(7, '64c3b1926c4518.32538607Toyota Motor Oil 15W-40 CI-4 1L.jpg', 'Toyota Motor Oil 15W-40 CI-4 1L', 1, 1, 'Made in Thailand.\r\nApproved by Toyota for Diesel engines.\r\nSuperior lubricating performance under extreme conditions.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(8, '64c3b1b6eb4373.29251098Toyota Motor Oil 15W-40 CI-4 4L.jpg', 'Toyota Motor Oil 15W-40 CI-4 4L', 1, 1, 'Made in Thailand.\r\nApproved by Toyota for Diesel engines.\r\nSuperior lubricating performance under extreme conditions.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(9, '64c3b2091d0749.21169029Toyota Motor Oil SN 0W-20 4L.jpg', 'Toyota Motor Oil SN 0W-20 4L', 1, 1, 'Standard                 : SP/GF6A 0W-20, API-SP &amp; ILSAC-GF6A\r\nMade In Japan\r\nApproved by Toyota for Petrol engines.\r\nHigh fuel efficiency and reduced CO2 Emission\r\nSuperior starting performance due to low resistance\r\nBackward compatibility with older engines/older grades.\r\nProvide protection against low-speed pre-ignition.\r\nTiming chain wear protection.\r\nImproved high temperature deposit protection for pistons &amp; turbocharges.\r\nOnly Japanese made lubricant in the market.\r\nFurther strengthening Toyota DNA.\r\nLabel Include API registered mark.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(10, '64c3b24357c595.95933846Toyota Motor Oil CI-4 10W-30 1L.jpg', 'Toyota Motor Oil CI-4 10W-30 1L', 1, 1, 'Made in Thailand.\r\nApproved by Toyota for Diesel engines.\r\nSuperior lubricating performance under extreme conditions.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(11, '64c3b2676a9190.72628228Toyota Motor Oil CI-4 10W-30 5L.jpg', 'Toyota Motor Oil CI-4 10W-30 5L', 1, 1, 'Made in Thailand.\r\nApproved by Toyota for Diesel engines.\r\nSuperior lubricating performance under extreme conditions.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(12, '64c3b29a0dd628.64978532Toyota Fully Synthetic Motor Oil SP 5W-40 1L.jpg', 'Toyota Fully Synthetic Motor Oil SP 5W-40 1L', 1, 1, 'Made in Singapore\r\n100% Synthetic Motor Oil\r\nApproved by Toyota for both Diesel and Petrol engines\r\nMeasurably better low-and high-temperature viscosity performance at service temperature extremes\r\nExtended drain intervals', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(13, '64c3b2b4ee2251.41702415Toyota Fully Synthetic Motor Oil SP 5W-40 4L.jpg', 'Toyota Fully Synthetic Motor Oil SP 5W-40 4L', 1, 1, 'Made in Singapore\r\n100% Synthetic Motor Oil\r\nApproved by Toyota for both Diesel and Petrol engines\r\nMeasurably better low-and high-temperature viscosity performance at service temperature extremes\r\nExtended drain intervals', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(14, '64c3b4d9966351.50751715toyota limited slip differential gear oil (lsd) 1l.jpg', 'toyota limited slip differential gear oil (lsd) 1l', 25, 1, 'Made in Japan\r\nMaximize the function of Toyota limited slip differential gear\r\nA clutch is built into axle, so oil with high coefficient of dynamic friction and a low coefficient of static friction is required to prevent noise and water.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(15, '64c3b5121a9f16.35339149toyota limited slip differential gear oil (lsd) 4l.jpg', 'toyota limited slip differential gear oil (lsd) 4l', 25, 1, 'Made in Japan\r\nMaximize the function of Toyota limited slip differential gear\r\nA clutch is built into axle, so oil with high coefficient of dynamic friction and a low coefficient of static friction is required to prevent noise and water.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(16, '64c3b679946ab5.59873849toyota manual transmission gear oil 1l.jpg', 'toyota manual transmission gear oil 1l', 2, 1, 'Standard                 : SAE-75W-90, API-GL-4\r\nMade in Japan\r\nMaintains excellent shift feel\r\nOil with optimum coefficient of dynamic friction and static friction to provide better gear shifting.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(17, '64c3b6a3113f39.13311529toyota manual transmission gear oil 4l.jpg', 'toyota manual transmission gear oil 4l', 2, 1, 'Standard                 : SAE-75W-90, API-GL-4\r\n\r\nMade in Japan\r\nMaintains excellent shift feel\r\nOil with optimum coefficient of dynamic friction and static friction to provide better gear shifting.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(18, '64c3bbb7a05e32.10212372toyota auto transmission fluid (d-ii) 1l.jpg', 'toyota auto transmission fluid (d-ii) 1l', 2, 1, 'Made in Japan Tested and approved by Toyota Global standard Quality Smooth shifting in extreme temperature Also recommended as a D-II power steering fluid', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(19, '64c3bbf6dfb713.79701898toyota auto transmission fluid (d-ii) 4l.jpg', 'toyota auto transmission fluid (d-ii) 4l', 2, 1, 'Made in Japan\r\nTested and approved by Toyota\r\nGlobal standard Quality\r\nSmooth shifting in extreme temperature\r\nAlso recommended as a D-II power steering fluid', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(20, '64c3bc1e455f27.68532475toyota auto transmission fluid (t-iv) 1l.jpg', 'toyota auto transmission fluid (t-iv) 1l', 2, 1, 'Made in Japan\r\nTested and approved by Toyota\r\nPrecise friction coefficient help to prevent the transmission shudder\r\nSpecial additives to protect against corrosion and excessive wear and tear\r\nChemically balanced to be compatible with rubber seals and metal finishes inside tour Toyota transmission.\r\nSmooth shifting in extreme temperature', 1, 0, 5, NULL, 0, 0, 1, 1, 2, '2023-07-28', NULL, NULL),
(21, '64c3bc897ee2a1.50181278toyota auto transmission fluid (t-iv) 4l.jpg', 'toyota auto transmission fluid (t-iv) 4l', 2, 1, 'Made in Japan\r\nTested and approved by Toyota\r\nPrecise friction coefficient help to prevent the transmission shudder\r\nSpecial additives to protect against corrosion and excessive wear and tear\r\nChemically balanced to be compatible with rubber seals and metal finishes inside tour Toyota transmission.\r\nSmooth shifting in extreme temperature', 1, 1, 5, '2023-08-02', 0, 0, 1, 1, 2, '2023-07-28', 6, '2023-08-02'),
(22, '64c3bcbef22f20.31864882toyota auto transmission fluid (cvt-tc) 4l.jpg', 'toyota auto transmission fluid (cvt-tc) 4l', 2, 1, 'Made in Japan\r\nFocus on optimum vehicle compatibility\r\nNew generation transmission type\r\nFluid for use exclusively with metal belt CVTs.\r\nIt offer both superior judder presentation and a high metal friction coefficient, due to optimizing the composition of the additives and base oil', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(23, '64c3bcf3c23385.28270051toyota auto transmission fluid (cvt-fe) 4l.jpg', 'toyota auto transmission fluid (cvt-fe) 4l', 2, 1, 'Made in Japan\r\nFocus on High fuel efficiency and durability\r\nSpecially formulated to provide swift transmission operation\r\nFluid for use exclusively with metal belt CVTs.\r\nIt offer both high fuel efficiency and durability, due to reducing even further the viscosity.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(24, '64c3bd2d2a1282.26842792toyota auto transmission fluid (ws) 1l.jpg', 'toyota auto transmission fluid (ws) 1l', 2, 1, 'Made in Japan\r\nNew generation transmission type\r\nIncluding friction modifier, oxidation inhibitors, viscosity index improve, corrosion inhibitors\r\nSlip control automatic transmission fluid with a viscosity lower than even Toyota genuine ATF type T-IV.it offers superior fuel efficiency.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(25, '64c3bd48172c95.85021749toyota auto transmission fluid (ws) 4l.jpg', 'toyota auto transmission fluid (ws) 4l', 2, 1, 'Made in Japan\r\nNew generation transmission type\r\nIncluding friction modifier, oxidation inhibitors, viscosity index improve, corrosion inhibitors\r\nSlip control automatic transmission fluid with a viscosity lower than even Toyota genuine ATF type T-IV.it offers superior fuel efficiency.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(26, '64c3bddef2e145.06913916toyota cvt tc 4l.jpg', 'toyota cvt tc 4l', 2, 1, 'Made in Japan\r\nSpecially formulated and tested by Toyota', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', 2, '2023-07-28'),
(27, '64c3be299372c8.11031107toyota long life coolant-(red) 1l.jpg', 'toyota long life coolant-(red) 1l', 13, 1, 'Made in Japan\r\nFactory filled red fluid specially formulated for Toyota vehicles.\r\nNew generation ethylene-glycol based premium engine antifreeze/coolant.\r\nProvides excellent corrosion protection.\r\n100% or 50/50 dilatable.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(28, '64c3be45e68a21.29979104toyota long life coolant-(red) 2l.jpg', 'toyota long life coolant-(red) 2l', 13, 1, 'Made in Japan\r\nFactory filled red fluid specially formulated for Toyota vehicles.\r\nNew generation ethylene-glycol based premium engine antifreeze/coolant.\r\nProvides excellent corrosion protection.\r\n100% or 50/50 dilatable.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(29, '64c3be60d2a5a4.87028559toyota long life coolant-(red) 4l.jpg', 'toyota long life coolant-(red) 4l', 13, 1, 'Made in Japan\r\nFactory filled red fluid specially formulated for Toyota vehicles.\r\nNew generation ethylene-glycol based premium engine antifreeze/coolant.\r\nProvides excellent corrosion protection.\r\n100% or 50/50 dilatable.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(30, '64c3be87d31ec3.05069244toyota super long life coolant-(pink) 2l.jpg', 'toyota super long life coolant-(pink) 2l', 13, 1, 'Made in Japan\r\nFactory filled red fluid specially formulated for Toyota vehicles\r\nAnti-freeze performance and Anti-corrosion performance\r\nHassle free maintenance. longer life\r\nExtends life of water pump seals and other non-metallic parts\r\n50/50 pre-diluted formula does not require addition of water. Environmentally friendly', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(31, '64c3bebbeb70b1.11630476toyota super long life coolant-(pink) 4l.jpg', 'toyota super long life coolant-(pink) 4l', 9, 1, 'Made in Japan\r\nFactory filled red fluid specially formulated for Toyota vehicles\r\nAnti-freeze performance and Anti-corrosion performance\r\nHassle free maintenance. longer life\r\nExtends life of water pump seals and other non-metallic parts\r\n50/50 pre-diluted formula does not require addition of water. Environmentally friendly', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(32, '64c3bf01db9d77.84876175genuine toyota brake fluid-(dot-3) 354ml.jpg', 'genuine toyota brake fluid-(dot-3) 354ml', 3, 1, 'Made in USA\r\nSuperior anti-corrosion\r\nSuper heavy duty high temperature brake fluid\r\nSpecially designed by Toyota engineers to give superior performance for all Toyota brake system\r\nEvenly transmits the force applied to the brake paddle and in turn to the all brakes.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(33, '64c3c2fd2369d8.95149873toyota oil sealer camshaft.jpeg', 'toyota oil sealer camshaft', 7, 1, 'Camshaft Oil Sealer', 0, 0, 10, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(34, '64c3c3416bb642.20636162toyota oil sealer rear wheel.jpeg', 'toyota oil sealer rear wheel', 7, 1, 'Oil Sealer Rear Wheel', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(35, '64c3c384dfc837.85528164toyota oil sealer crank shaft rear.jpeg', 'toyota oil sealer crank shaft rear', 7, 1, 'Oil Sealer Crank shaft rear', 0, 0, 10, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(36, '64c3c43c3fb2b6.47788582toyota engine overhaul rebuild kit for 4efe glanza.jpg', 'toyota engine overhaul rebuild kit for 4efe glanza', 8, 1, 'Toyota Engine Overhaul Rebuild Kit for 4EFe Glanza', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(37, '64c3c7cdd63318.50641417toyota turbo ep 71 ep 81 ep 91 glanza.jpeg', 'toyota turbo ep 71 ep 81 ep 91 glanza', 17, 1, 'Toyota Turbo for Ep71 Ep81 Ep91 Glanza', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(38, '64c3c876b21653.89900959toyota glanza ep91 ep82 engine turbo full kit.jpg', 'toyota glanza ep91 ep82 engine turbo full kit', 23, 1, 'Toyota Glanza EP91 EP82 Engine Turbo Full KIT With Wire Harness', 0, 0, 2, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(39, '64c3c97841f3f6.37765214valvoline vr 1 racing 15w40.png', 'valvoline vr 1 racing 15w40 4L', 1, 2, 'Specially designed for ultimate performance in turbo and non-turbo charged petrol engines, the VR1 10W60 contains special additives that ensure optimal power output and maximum wear resistance. Additionally, the enhanced anti-foaming formulation in the oil ensures superior protection of the engine at higher rpm. A strong oil film provides high resistance against extreme pressure and high operating temperatures.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(40, '64c3c9e5dddac1.37950521valvoline maxlife atf 4 - 4l.png', 'valvoline maxlife atf 4 - 4l', 1, 2, 'Specially designed for ultimate performance in turbo and non-turbo charged petrol engines, the VR1 10W60 contains special additives that ensure optimal power output and maximum wear resistance. Additionally, the enhanced anti-foaming formulation in the oil ensures superior protection of the engine at higher rpm. A strong oil film provides high resistance against extreme pressure and high operating temperatures.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(41, '64c3ca35d41385.69643180valvoline synpower 0w-20 3l.png', 'valvoline synpower 0w-20 3l', 1, 2, 'Formulated to provide enhanced engine protection, Valvolineâ€™s SynPower 0W20 reduces engine wear at high temperatures and also provides a faster oil flow at start-up with superior cold-temperature protection. Formulated with antiwear additives that stay in your oil longer, the SynPower 0W20 safeguards your engine against friction and wear, and provides excellent engine cleanliness through superior sludge and varnish protection.', 0, 0, 5, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(42, '64c3ca7eab22f4.89765602mitsubishi evolution i engine 2.0l.jpeg', 'mitsubishi evolution i engine 2.0l', 23, 2, 'Mitsubishi Evolution I Engine 2.0L', 0, 0, 2, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(43, '64c3cabbb975f0.23552098mitsubishi evolution vi engine 2.0l.jpg', 'mitsubishi evolution vi engine 2.0l', 1, 2, 'Mitsubishi Evolution VI Engine 2.0L', 0, 0, 1, NULL, 0, 0, 1, 1, 2, '2023-07-28', NULL, NULL),
(44, '64c3cb03ef8073.30921553mitsubishi evolution vi ecu.jpeg', 'mitsubishi evolution vi ecu', 20, 2, 'Mitsubishi Evolution VI ECU', 0, 0, 2, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(45, '64c3cbc36ca452.14726700mitusbishi evolution vi intercooler (plazmaman).jpg', 'mitusbishi evolution vi intercooler (plazmaman)', 18, 2, 'Mitusbishi Evolution VI Intercooler  (Brand - Plazmaman)', 0, 0, 2, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL),
(46, '64c3cc5e06a130.28847976mitsubishi evolution x gear box.jpg', 'mitsubishi evolution x gear box', 24, 2, 'Mitsubishi Evolution X Gear Box', 0, 0, 2, NULL, 0, 0, 1, 0, 2, '2023-07-28', NULL, NULL);

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
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ProvinceName` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `ProvinceName`) VALUES
(1, 'Western'),
(2, 'Central'),
(3, 'Southern'),
(4, 'North Western'),
(5, 'Sabaragamuwa'),
(6, 'Eastern'),
(7, 'Uva'),
(8, 'North Central'),
(9, 'Northern');

-- --------------------------------------------------------

--
-- Table structure for table `purchasingorders`
--

DROP TABLE IF EXISTS `purchasingorders`;
CREATE TABLE IF NOT EXISTS `purchasingorders` (
  `PoId` int(11) NOT NULL AUTO_INCREMENT,
  `PoNo` varchar(255) DEFAULT NULL,
  `Product_Name` int(11) NOT NULL,
  `Supplier_Name` int(11) NOT NULL,
  `PoQty` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`PoId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchasingorders`
--

INSERT INTO `purchasingorders` (`PoId`, `PoNo`, `Product_Name`, `Supplier_Name`, `PoQty`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'PO230714S1P10001\n', 1, 1, 5, 1, 6, '2023-07-14', NULL, NULL),
(2, 'PO230714S1P20002\n', 2, 1, 5, 1, 6, '2023-07-14', NULL, NULL),
(3, 'PO230714S1P30003\n', 3, 1, 6, 1, 6, '2023-07-14', NULL, NULL),
(4, 'PO230714S1P40004\n', 4, 1, 6, 1, 6, '2023-07-14', NULL, NULL),
(5, 'PO230714S1P50005\n', 5, 1, 10, 1, 6, '2023-07-14', NULL, NULL),
(6, 'PO230716S1P20006\n', 2, 1, 10, 1, 6, '2023-07-16', NULL, NULL),
(7, 'PO230717S2P60007\n', 6, 2, 10, 1, 6, '2023-07-17', NULL, NULL),
(8, 'PO230731S1P10008\n', 1, 1, 5, 1, 6, '2023-07-31', NULL, NULL),
(9, 'PO230731S1P20009\n', 2, 1, 10, 1, 6, '2023-07-31', NULL, NULL),
(10, 'PO230731S1P10010\n', 1, 1, 10, 1, 6, '2023-07-31', NULL, NULL),
(11, 'PO230731S1P200011\n', 20, 1, 5, 1, 6, '2023-07-31', NULL, NULL),
(12, 'PO230731S1P210012\n', 21, 1, 5, 1, 6, '2023-07-31', NULL, NULL),
(13, 'PO230731S2P430013\n', 43, 2, 1, 1, 6, '2023-07-31', NULL, NULL),
(14, 'PO230801S1P10014\n', 1, 1, 10, 1, 6, '2023-08-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relaeseitems`
--

DROP TABLE IF EXISTS `relaeseitems`;
CREATE TABLE IF NOT EXISTS `relaeseitems` (
  `ReleaseItemId` int(11) NOT NULL AUTO_INCREMENT,
  `ReleaseNo` varchar(255) NOT NULL,
  `EmpId` int(11) NOT NULL,
  `AppointmentId` int(11) DEFAULT NULL,
  `InpsectionId` int(11) DEFAULT NULL,
  `OrderId` int(11) NOT NULL,
  `JobCardId` int(11) NOT NULL,
  `CustomerName` int(11) NOT NULL,
  `VehicleNo` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddUser` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`ReleaseItemId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relaeseitems`
--

INSERT INTO `relaeseitems` (`ReleaseItemId`, `ReleaseNo`, `EmpId`, `AppointmentId`, `InpsectionId`, `OrderId`, `JobCardId`, `CustomerName`, `VehicleNo`, `AddDate`, `AddUser`, `Status`) VALUES
(1, 'REL202308014654', 8, 13, NULL, 1, 9, 1, 1, '2023-08-01', 6, 1),
(2, 'REL202308015329', 3, 15, NULL, 2, 10, 1, 1, '2023-08-01', 6, 1),
(3, 'REL202308024128', 7, NULL, 8, 3, 11, 1, 2, '2023-08-02', 6, 1),
(4, 'REL202308026997', 3, 16, NULL, 4, 12, 1, 1, '2023-08-02', 6, 1),
(5, 'REL202308032962', 3, 18, NULL, 5, 13, 2, 4, '2023-08-03', 6, 1),
(6, 'REL202308049697', 7, NULL, 9, 6, 14, 3, 5, '2023-08-04', 6, 1),
(7, 'REL202308044370', 3, 19, NULL, 8, 16, 2, 4, '2023-08-04', 6, 1),
(8, 'REL202308055989', 8, 17, NULL, 10, 18, 1, 1, '2023-08-05', 6, 1),
(9, 'REL202308059881', 7, NULL, 8, 7, 11, 1, 2, '2023-08-05', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `relasesubitems`
--

DROP TABLE IF EXISTS `relasesubitems`;
CREATE TABLE IF NOT EXISTS `relasesubitems` (
  `RelaseSubItemsId` int(11) NOT NULL AUTO_INCREMENT,
  `ReleaseItemId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `StockId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  PRIMARY KEY (`RelaseSubItemsId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relasesubitems`
--

INSERT INTO `relasesubitems` (`RelaseSubItemsId`, `ReleaseItemId`, `OrderId`, `ProductId`, `StockId`, `Qty`, `AddUser`, `AddDate`) VALUES
(7, 1, 1, 6, 7, 1, 6, '2023-07-18'),
(9, 1, 1, 1, 3, 1, 6, '2023-08-01'),
(10, 2, 2, 1, 11, 1, 6, '2023-08-01'),
(11, 2, 2, 2, 15, 1, 6, '2023-08-01'),
(12, 3, 3, 1, 12, 1, 6, '2023-08-02'),
(13, 4, 4, 1, 13, 1, 6, '2023-08-02'),
(14, 4, 4, 21, 9, 1, 6, '2023-08-02'),
(15, 5, 5, 1, 14, 1, 6, '2023-08-03'),
(16, 6, 6, 1, 16, 1, 6, '2023-08-04'),
(17, 6, 6, 2, 17, 1, 6, '2023-08-04'),
(18, 7, 8, 1, 20, 1, 6, '2023-08-04'),
(19, 8, 10, 1, 22, 1, 6, '2023-08-05'),
(20, 9, 7, 1, 12, 1, 6, '2023-08-05'),
(21, 9, 7, 1, 19, 1, 6, '2023-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `repaircatergory`
--

DROP TABLE IF EXISTS `repaircatergory`;
CREATE TABLE IF NOT EXISTS `repaircatergory` (
  `RepairId` int(11) NOT NULL AUTO_INCREMENT,
  `RepairName` varchar(255) NOT NULL,
  `RepairPrice` double(11,2) NOT NULL,
  `RepairCost` double(11,2) NOT NULL,
  `WarrantyType` varchar(255) DEFAULT NULL,
  `RepairStatus` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`RepairId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repaircatergory`
--

INSERT INTO `repaircatergory` (`RepairId`, `RepairName`, `RepairPrice`, `RepairCost`, `WarrantyType`, `RepairStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Enginee Gasket Repair', 5000.00, 1000.00, '1', 1, 1, '2023-04-17', 2, '2023-07-29'),
(2, 'Enginee Mount Repair', 3500.00, 1500.00, '1', 1, 1, '2023-04-17', NULL, NULL),
(3, 'Turbo Repair', 8500.00, 3000.00, '1', 1, 1, '2023-04-17', NULL, NULL),
(4, 'Gear Box Repair', 15000.00, 12000.00, '1', 1, 1, '2023-04-20', NULL, NULL),
(5, 'intercooler repair', 500.00, 100.00, '1', 1, 1, '2023-07-28', NULL, NULL),
(6, 'full service car', 6700.00, 4500.00, 'NoWarranty', 1, 1, '2023-08-05', 2, '2023-08-05'),
(7, 'full service van', 7500.00, 5500.00, 'NoWarranty', 1, 1, '2023-08-05', 2, '2023-08-05'),
(8, 'body wash car', 1500.00, 900.00, 'NoWarranty', 1, 1, '2023-08-05', NULL, NULL),
(9, 'body wash van', 1500.00, 1200.00, 'NoWarranty', 1, 1, '2023-08-05', NULL, NULL),
(10, 'clutch repair', 5600.00, 4500.00, '1', 1, 1, '2023-08-05', NULL, NULL),
(11, 'head light repair', 800.00, 500.00, 'NoWarranty', 1, 1, '2023-08-05', NULL, NULL),
(12, 'engine swap car', 126000.00, 100000.00, '1', 1, 1, '2023-08-05', NULL, NULL);

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
-- Table structure for table `retunitemstock`
--

DROP TABLE IF EXISTS `retunitemstock`;
CREATE TABLE IF NOT EXISTS `retunitemstock` (
  `ReturnId` int(11) NOT NULL AUTO_INCREMENT,
  `JobCardId` int(11) NOT NULL,
  `StockIid` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`ReturnId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `retunitemstock`
--

INSERT INTO `retunitemstock` (`ReturnId`, `JobCardId`, `StockIid`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`, `Status`) VALUES
(1, 1, 7, 7, '2023-07-18', NULL, NULL, 1),
(2, 14, 16, 7, '2023-08-04', NULL, NULL, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ServiceId`, `ServiceName`, `CatergoryName`, `ServiceCost`, `ServicePrice`, `ServiceStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Full Service', '1', 16500, 22500, 1, 1, '2023-06-13', NULL, NULL),
(2, 'Oil Change', '1', 4500, 6500, 1, 1, '2023-06-13', 2, '2023-07-31'),
(3, 'Full Service Van', '2', 4500, 6500, 1, 1, '2023-08-02', NULL, NULL);

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
  PRIMARY KEY (`ServiceTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servicetypes`
--

INSERT INTO `servicetypes` (`ServiceTypeId`, `Service_Id`, `VCatergory_Id`, `Product_Id`) VALUES
(8, 1, 1, 1),
(14, 2, 1, 1),
(15, 3, 2, 1);

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
  `PoNo` int(11) NOT NULL,
  `SerialNo` varchar(255) NOT NULL,
  `Cost` float(11,2) NOT NULL,
  `SalePrice` float(11,2) NOT NULL,
  `MfgDate` date NOT NULL,
  `ExpDate` date NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`StockId`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockitems`
--

INSERT INTO `stockitems` (`StockId`, `SupplierName`, `CatergoryName`, `ProductName`, `BatchNo`, `PoNo`, `SerialNo`, `Cost`, `SalePrice`, `MfgDate`, `ExpDate`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 1, 1, 4, 5, 4, '12345666666', 15000.00, 20000.00, '2023-07-27', '2023-07-29', 3, 6, '2023-07-27', 6, '2023-08-01'),
(2, 1, 1, 1, 6, 1, 'TMOSP10W301L001', 16500.00, 20500.00, '2023-07-31', '2023-08-01', 3, 6, '2023-07-31', 6, '2023-08-01'),
(6, 1, 1, 1, 6, 1, 'TMOSP10W301L005', 16500.00, 20500.00, '2023-07-20', '2023-11-01', 4, 6, '2023-07-31', 6, '2023-08-01'),
(7, 1, 1, 1, 6, 1, 'TMOSP10W301L006', 18000.00, 22500.00, '2023-07-31', '2023-10-29', 5, 6, '2023-07-31', 6, '2023-08-01'),
(8, 1, 2, 20, 8, 11, 'TMOAUTMOL001', 12500.00, 13500.00, '2023-08-01', '2023-11-11', 3, 6, '2023-08-01', 6, '2024-01-13'),
(9, 1, 2, 21, 9, 12, 'TMOAUTMOL002', 20500.00, 22500.00, '2023-08-01', '2024-02-29', 0, 6, '2023-08-01', 6, '2023-08-02'),
(10, 1, 2, 21, 9, 12, 'TMOAUTMOL003', 18750.00, 22600.00, '2023-08-01', '2023-10-31', 3, 6, '2023-08-01', 6, '2024-01-13'),
(11, 1, 1, 1, 6, 14, 'TMO12345670001', 16500.00, 17500.00, '2023-07-31', '2024-04-30', 0, 6, '2023-08-01', 6, '2023-08-01'),
(12, 1, 1, 1, 6, 14, 'TMO123456700045', 16500.00, 17600.00, '2023-08-01', '2023-11-10', 0, 6, '2023-08-01', 6, '2023-08-02'),
(13, 1, 1, 1, 6, 14, 'TMO12345670456', 17500.00, 18900.00, '2023-08-01', '2023-10-30', 0, 6, '2023-08-01', 6, '2023-08-02'),
(14, 1, 1, 1, 6, 14, 'TMO12345670375', 13500.00, 16500.00, '2023-08-01', '2023-10-31', 0, 6, '2023-08-01', 6, '2023-08-03'),
(15, 1, 1, 2, 11, 9, 'TMO12345677657', 18600.00, 20650.00, '2023-08-01', '2023-10-30', 0, 6, '2023-08-01', 6, '2023-08-01'),
(16, 1, 1, 1, 6, 1, 'TMO12345672001', 16500.00, 20500.00, '2023-08-04', '2023-11-05', 0, 6, '2023-08-04', 6, '2023-08-04'),
(17, 1, 1, 2, 10, 2, 'TMO12345672002', 18500.00, 19500.00, '2023-08-04', '2023-12-01', 0, 6, '2023-08-04', 6, '2023-08-04'),
(18, 1, 1, 1, 6, 1, 'TMOSP10W301L402', 16500.00, 17000.00, '2023-08-04', '2023-11-30', 3, 6, '2023-08-04', 6, '2024-01-13'),
(19, 1, 1, 1, 6, 1, 'TMOSP10W301L4441', 18700.00, 18750.00, '2023-08-04', '2023-11-02', 0, 6, '2023-08-04', 6, '2023-08-04'),
(20, 1, 1, 1, 6, 1, 'TMOSP10W301L6802', 2480.00, 5480.00, '2023-08-04', '2023-11-30', 0, 6, '2023-08-04', 6, '2023-08-04'),
(21, 1, 1, 1, 6, 1, 'TMOSP10W301Lf002', 6789.00, 9876.00, '2023-08-04', '2023-11-03', 0, 6, '2023-08-04', 6, '2023-08-04'),
(22, 1, 1, 1, 6, 1, 'TMOSP10W301L9000', 4500.00, 6000.00, '2023-08-05', '2023-11-30', 0, 6, '2023-08-05', 6, '2023-08-05'),
(23, 1, 1, 1, 6, 1, 'TMOSP10W301L9001', 3500.00, 5000.00, '2023-08-05', '2023-11-10', 3, 6, '2023-08-05', 6, '2024-01-13'),
(24, 1, 1, 1, 6, 1, 'TMOSP10W301L90067', 4390.00, 6890.00, '2023-08-04', '2023-11-18', 3, 6, '2023-08-05', 6, '2024-01-13'),
(25, 1, 1, 1, 6, 14, 'TMOSP10W301L900678', 6789.00, 9870.00, '2023-08-01', '2023-11-30', 3, 6, '2023-08-05', 6, '2024-01-13'),
(26, 1, 1, 1, 6, 1, 'TMOSP10W301L90097', 2340.00, 6789.00, '2023-08-05', '2023-11-10', 3, 6, '2023-08-05', 6, '2024-01-13'),
(27, 1, 1, 1, 6, 14, 'TMOSP10W301L9006', 5690.00, 7900.00, '2023-08-05', '2023-08-05', 3, 6, '2023-08-05', 6, '2023-08-05'),
(28, 1, 1, 2, 10, 2, 'TMOSP10W304L9000', 11300.00, 14500.00, '2023-08-05', '2023-08-05', 3, 6, '2023-08-05', 6, '2023-08-05'),
(29, 1, 1, 2, 11, 9, 'TMOSP10W304L9056', 11300.00, 15600.00, '2023-08-05', '2024-03-07', 1, 6, '2023-08-05', NULL, NULL),
(30, 1, 1, 2, 11, 6, 'TMOSP10W304L90583', 14500.00, 18500.00, '2023-08-05', '2023-12-01', 3, 6, '2023-08-05', 6, '2024-01-13'),
(31, 1, 1, 2, 10, 2, 'TMOSP10W304L9789', 14300.00, 16700.00, '2023-08-05', '2023-11-30', 3, 6, '2023-08-05', 6, '2024-01-13'),
(32, 1, 1, 2, 10, 2, 'TMOSP10W304L7899', 12560.00, 17890.00, '2023-08-05', '2023-11-25', 3, 6, '2023-08-05', 6, '2024-01-13'),
(33, 1, 1, 2, 10, 2, 'TMOSP10W304L8790', 14390.00, 16590.00, '2023-08-05', '2023-11-17', 3, 6, '2023-08-05', 6, '2024-01-13');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierId`, `SupplierName`, `ContactNo`, `email`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'toyota lanka', '0703966282', 'toyotaLanka@gmail.com', 1, 1, '2023-07-27', NULL, NULL),
(2, 'united motors', '0778299480', 'unitedmotorstest@gmail.com', 1, 1, '2023-07-28', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliercatergories`
--

INSERT INTO `suppliercatergories` (`SupCatId`, `SupplierId`, `CatergoryId`) VALUES
(42, 1, 1),
(43, 1, 2),
(44, 1, 3),
(45, 1, 7),
(46, 1, 8),
(47, 1, 9),
(48, 1, 10),
(49, 1, 11),
(50, 1, 12),
(51, 1, 13),
(52, 1, 14),
(53, 1, 15),
(54, 1, 16),
(55, 1, 17),
(56, 1, 18),
(57, 1, 20),
(58, 1, 21),
(59, 1, 23),
(60, 1, 25),
(72, 2, 1),
(73, 2, 13),
(74, 2, 17),
(75, 2, 18),
(76, 2, 20),
(77, 2, 23),
(78, 2, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `TaskId` int(11) NOT NULL AUTO_INCREMENT,
  `Appointment_id` int(11) DEFAULT NULL,
  `Job_cardId` int(11) NOT NULL,
  `Job_cardNo` varchar(255) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `InspectionId` int(11) DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  `AppDate` date DEFAULT NULL,
  `TimeSlotId` int(11) DEFAULT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `AddTime` varchar(255) NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateTime` time DEFAULT NULL,
  `FinishedDate` date DEFAULT NULL,
  `FinishedTime` time DEFAULT NULL,
  `FinishedUser` int(11) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`TaskId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskId`, `Appointment_id`, `Job_cardId`, `Job_cardNo`, `vehicleId`, `InspectionId`, `emp_id`, `AppDate`, `TimeSlotId`, `AddUser`, `AddDate`, `AddTime`, `UpdateUser`, `UpdateDate`, `UpdateTime`, `FinishedDate`, `FinishedTime`, `FinishedUser`, `Status`) VALUES
(1, 4, 1, 'JCS202307258886', 1, NULL, 8, '2023-07-25', 2, 13, '2023-07-25', '19:37', 8, '2023-07-25', '23:23:00', NULL, NULL, NULL, 2),
(2, 10, 6, 'JCS202307291106', 1, NULL, 8, '2023-08-01', 14, 2, '2023-07-29', '03:47', 8, '2023-07-30', '23:29:00', NULL, NULL, NULL, 2),
(3, 12, 7, 'JCS202307309807', 1, NULL, 8, '2023-08-04', 32, 2, '2023-07-30', '20:02', 8, '2023-07-30', '20:02:00', NULL, NULL, NULL, 2),
(4, 14, 8, 'JCS202307301082', 1, NULL, 8, '2023-08-03', 27, 2, '2023-07-30', '23:27', 8, '2023-08-01', '10:09:00', NULL, NULL, NULL, 2),
(5, 13, 9, 'JCS202307315376', 1, NULL, 8, '2023-08-03', 25, 2, '2023-07-31', '16:39', 8, '2023-07-31', '16:41:00', NULL, NULL, NULL, 2),
(6, 15, 10, 'JCS202308016596', 1, NULL, 3, '2023-08-01', 1, 2, '2023-08-01', '19:38', 3, '2023-08-01', '19:38:00', NULL, NULL, NULL, 2),
(9, 16, 12, 'JCS202308021411', 1, NULL, 3, '2023-08-02', 19, 2, '2023-08-02', '20:10', 3, '2023-08-02', '20:12:00', '2023-08-03', '20:19:00', 4, 3),
(10, 18, 13, 'JCS202308033124', 4, NULL, 3, '2023-08-03', 26, 2, '2023-08-03', '21:34', 3, '2023-08-03', '21:35:00', '2023-08-03', '21:48:00', 4, 3),
(11, NULL, 14, 'JCR202308047954', 5, 9, 7, NULL, NULL, 4, '2023-08-04', '12:45', 7, '2023-08-04', '13:57:00', '2023-08-04', '16:45:00', 4, 3),
(12, 20, 15, 'JCS202308044491', 5, NULL, 3, '2023-08-04', 31, 2, '2023-08-04', '19:46', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(13, 19, 16, 'JCS202308049409', 4, NULL, 3, '2023-08-04', 17, 2, '2023-08-04', '21:13', 3, '2023-08-04', '21:14:00', '2023-08-04', '21:21:00', 4, 3),
(14, 21, 17, 'JCS202308042448', 6, NULL, 3, '2023-08-04', 12, 2, '2023-08-04', '21:51', 3, '2023-08-04', '21:52:00', NULL, NULL, NULL, 2),
(15, 17, 18, 'JCS202308055429', 1, NULL, 8, '2023-08-05', 39, 2, '2023-08-05', '09:33', 8, '2023-08-05', '09:34:00', '2023-08-05', '10:04:00', 4, 3),
(16, NULL, 19, 'JCR202308056464', 3, 11, 7, NULL, NULL, 4, '2023-08-05', '14:17', 7, '2023-08-05', '14:18:00', NULL, NULL, NULL, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasksrepair`
--

INSERT INTO `tasksrepair` (`TaskRepairId`, `Inspection_id`, `User_id`, `AddUser`, `AddDate`, `AddTime`, `UpdateUser`, `UpdateDate`, `UpdateTime`, `Status`) VALUES
(1, 4, 7, 4, '2023-07-12', '02:01', NULL, NULL, NULL, 1),
(2, 3, 7, 4, '2023-07-17', '20:48', NULL, NULL, NULL, 1),
(3, 5, 7, 4, '2023-07-17', '20:54', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

DROP TABLE IF EXISTS `tblcontactus`;
CREATE TABLE IF NOT EXISTS `tblcontactus` (
  `contactid` int(10) NOT NULL AUTO_INCREMENT,
  `customername` varchar(100) NOT NULL,
  `customeremail` varchar(100) NOT NULL,
  `customernumber` int(10) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `customermatter` varchar(1000) NOT NULL,
  `response` varchar(1000) DEFAULT NULL,
  `responsedate` date DEFAULT NULL,
  `adddate` date NOT NULL,
  `status` int(20) NOT NULL,
  PRIMARY KEY (`contactid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`contactid`, `customername`, `customeremail`, `customernumber`, `subject`, `customermatter`, `response`, `responsedate`, `adddate`, `status`) VALUES
(1, 'pasan', 'pasan@gmail.com', 785954493, 'testing', 'testing', 'testing sending reply to customer', '2023-08-03', '2023-04-25', 1),
(2, 'Sakuni Hegoda', 'sakuni@gmail.com', 779856632, 'Regarding the return policy', 'i have some issues regarding the return policy of your compnay. ill mentioned them below please be kind enough to clarify things for me', 'Yes we are happy to clarify things to our customers always', '2023-07-17', '2023-07-06', 1),
(3, 'Charana', 'Charanamj@gmail.com', 778459620, 'get to lower PRice', 'Can you guys sell  less expensive products', 'will contact u later', '2023-07-06', '2023-07-06', 1),
(4, 'rajindra', 'reji@gmail.com', 785954493, 'Regarding policies', 'description', '', NULL, '2023-07-20', 0),
(5, 'hima', 'hima@gmail.com', 784758963, 'regarding the working hours', 'what are the working time for weekends?', 'we are working except sunday 8.00am to 5.00pm', '2023-08-03', '2023-08-03', 1),
(6, 'qwer', 'qwe@gmail.com', 1234567890, 'asdasdasdas', 'sadasasdasdasd', 'dsfgsdfgbfxghfgbasefserhdbfh', '2023-08-04', '2023-08-04', 1),
(7, 'Rajindra', 'rajindrathrindu@mail.com', 721890543, 'Regarding System', 'Hi TEst', NULL, NULL, '2023-08-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) NOT NULL,
  `categoryimage` varchar(255) NOT NULL,
  `CategoryDescription` text NOT NULL,
  `categoryStatus` int(10) NOT NULL,
  `imielength` int(11) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`categoryid`, `CategoryName`, `categoryimage`, `CategoryDescription`, `categoryStatus`, `imielength`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(20, 'Oil change', '64cc1a629d2f04.14272627Oil change.jpg', 'Regularly changing the engine oil is essential for maintaining the health and longevity of the engine.', 1, 15, 0, '2023-08-04', NULL, NULL),
(21, 'Brake Inspection and Repair', '64cc1c22ade3d2.57259442Brake Inspection and Repair.jpg', 'Ensuring the brakes are in proper working condition is critical for vehicle safety.', 1, 15, 2, '2023-08-04', NULL, NULL),
(24, 'Battery Testing and Replacement', '64cc1d3d925321.01884299Battery Testing and Replacement.jpeg', 'Testing the batterys health and replacing it when necessary to avoid unexpected breakdowns.', 1, 15, 2, '2023-08-04', NULL, NULL),
(25, 'Engine Tune-Up', '64cc1d745e1af7.70803609Engine Tune-Up.jpg', 'An engine tune-up involves checking and adjusting various components to improve performance and fuel efficiency.', 1, 15, 2, '2023-08-04', NULL, NULL),
(26, 'Tire Rotation and Balancing', '64cc1f4a291a69.07588434Tire Rotation and Balancing.jpg', 'Regularly rotating and balancing tires help extend their lifespan and provide even wear.', 1, 15, 2, '2023-08-04', NULL, NULL),
(27, 'Wheel Alignment', '64cc1f659895a6.77323157Wheel Alignment.jpg', 'Proper wheel alignment ensures the vehicle drives straight and prevents uneven tire wear.', 1, 15, 2, '2023-08-04', NULL, NULL),
(28, 'Air Conditioning Service', '64cc1fd93b7ac6.53652926Air Conditioning Service.jpg', 'Ensuring the air conditioning system is in good condition for comfortable driving, especially during hot weather.', 0, 15, 2, '2023-08-04', NULL, NULL);

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
  `Street` varchar(100) DEFAULT NULL,
  `Province` int(11) NOT NULL,
  `District` int(11) NOT NULL,
  `City` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `NIC` varchar(12) NOT NULL,
  `Dob` date DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `ContactNo` int(10) NOT NULL,
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

INSERT INTO `users` (`UserId`, `Title`, `UserImage`, `FirstName`, `LastName`, `Email`, `Password`, `UserRole`, `depId`, `HouseNo`, `Lane`, `Street`, `Province`, `District`, `City`, `Gender`, `NIC`, `Dob`, `Status`, `ContactNo`, `passwordreset`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Mr.', '', 'Rajindra', 'Tharindu', 'rajindratharindu@gmail.com', '39b947de5b295a150eaed0b1af60a2316e17a687', 'admin', 0, '136/1,', 'Horahena Road, ', 'Rukmale,', 1, 5, 998, '1', '982130145V', '1998-07-31', 1, 779200481, '64be8e61c21c6', 1, '2023-03-17', 1, '2023-07-24'),
(2, 'Mr.', '64be9bbb2f58b3.09455901.jpg', 'Tharindu', 'Kumara', 'tharindu@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'manager', 1, '136', 'Munamalle watta', 'Munamalle watta', 1, 5, 364, '1', '982130148V', '1998-07-31', 1, 779200482, '648610eeb46c4', 1, '2023-03-20', 1, '2023-07-24'),
(3, 'Mr.', '199821300140649c3fb3742d65.85581620.png', 'Kumara', 'Perera', 'kumara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', 2, '136', 'Munamalle watta', 'Munamalle watta', 1, 5, 364, '1', '982130156V', '1998-07-31', 1, 779200483, '', 1, '2023-03-20', NULL, NULL),
(4, 'Mr.', '', 'Thiwanka', 'Madushan', 'thiwanka@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'supervisor', 1, '146', 'Munamalle watta', 'Kaluaggala', 1, 5, 349, '1', '982130980V', '1998-07-31', 1, 779200484, '', 1, '2023-06-10', NULL, NULL),
(5, 'Mr.', '', 'Tharindu', 'Saumya', 'saumya@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'inspectionOfficer', 3, '1', 'Hokandara East', 'Hokandara', 1, 5, 345, '1', '982130240V', '1998-07-31', 1, 779200485, '', 1, '2023-06-10', NULL, NULL),
(6, 'Mr.', '', 'Chulochana', 'Sandeepa', 'chulochana@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'stockKeeper', 5, '25', 'Amuatamulla Road', 'Kottawa', 1, 5, 364, '1', '199821300140', '1998-07-31', 1, 779200486, '', 1, '2023-06-10', NULL, NULL),
(7, 'Mr.', '199821300140649c3fb3742d65.85581620.png', 'Athukorala', 'Perera', 'athukorala@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', 3, '132', 'Horahena Road', 'Rukmale', 1, 5, 364, '1', '70667716V', '1970-06-15', 1, 779200487, NULL, 1, '2023-06-10', NULL, NULL),
(8, 'Mr.', '199821300140649c3fb3742d65.85581620.png', 'Pasan', 'Manahara', 'pasan@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'technician', 2, '23/43', 'Ambalangoda', 'Polgasowita', 1, 5, 367, '1', '199821300140', '1998-07-31', 1, 779200488, NULL, 1, '2023-06-10', NULL, NULL),
(9, 'Miss.', '987841150V64c91e5f396e37.31825804.jpeg', 'Kavindya', 'Nirmani', 'kavindyanirmaniTest@gmail.com', '94ba69fdd6ac7c1576e4b079514aa04004822824', 'Cashier', 4, '146', 'Gonamadiththa Road', 'Kesbawa', 1, 5, 1921, '2', '987841150V', '1998-10-10', 1, 729140130, '64cd1eb69b2fe', 1, '2023-08-01', NULL, '2023-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `vehiclebrand`
--

DROP TABLE IF EXISTS `vehiclebrand`;
CREATE TABLE IF NOT EXISTS `vehiclebrand` (
  `VehicleBrandId` int(11) NOT NULL AUTO_INCREMENT,
  `VehicleBrandName` varchar(100) NOT NULL,
  `BrandLogo` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(1) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`VehicleBrandId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehiclebrand`
--

INSERT INTO `vehiclebrand` (`VehicleBrandId`, `VehicleBrandName`, `BrandLogo`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'toyota', '64bd43cb2a83b3.95882372toyota.png', 1, 2, '2023-07-23', NULL, NULL),
(2, 'mitsubishi', '64bd78818cde09.75639260mitsubishi.png', 1, 2, '2023-07-24', NULL, NULL),
(3, 'subaru', '64bd7946314bb7.59356052subaru.png', 1, 2, '2023-07-24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehiclemodels`
--

DROP TABLE IF EXISTS `vehiclemodels`;
CREATE TABLE IF NOT EXISTS `vehiclemodels` (
  `VehicleModelsId` int(11) NOT NULL AUTO_INCREMENT,
  `BrandImage` varchar(255) NOT NULL,
  `ModelName` varchar(100) NOT NULL,
  `VCatergoryName` int(11) NOT NULL,
  `VBrand` int(11) NOT NULL,
  `VFuelType` int(11) NOT NULL,
  `MfgStart` date NOT NULL,
  `MfgEnd` date NOT NULL,
  `EngineCC` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  PRIMARY KEY (`VehicleModelsId`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehiclemodels`
--

INSERT INTO `vehiclemodels` (`VehicleModelsId`, `BrandImage`, `ModelName`, `VCatergoryName`, `VBrand`, `VFuelType`, `MfgStart`, `MfgEnd`, `EngineCC`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, '64be607554ffb6.24957217toyota glanza ep71.jpg', 'toyota glanza ep71', 1, 1, 1, '1984-10-01', '1989-12-01', 1331, 1, 2, '2023-07-24', NULL, NULL),
(2, '64be61e7d68f14.53797838toyota glanza ep81.jpg', 'toyota glanza ep81', 1, 1, 1, '1989-12-01', '1995-12-01', 1331, 1, 2, '2023-07-24', NULL, NULL),
(3, '64be62ff51d153.38956042toyota glanza ep91.jpg', 'toyota glanza ep91', 1, 1, 1, '1996-01-01', '1999-07-01', 1331, 1, 2, '2023-07-24', NULL, NULL),
(4, '64be63e1dc5a31.08708835toyota startlet gt turbo.jpg', 'toyota startlet gt turbo', 1, 1, 1, '1994-10-01', '1995-12-01', 1331, 1, 2, '2023-07-24', NULL, NULL),
(5, '64be6989dd9918.27623680mitsubishi evolution i.jpg', 'mitsubishi evolution i', 1, 2, 1, '1992-10-01', '1994-10-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(6, '64be69fb117395.53650110mitsubishi evolution ii.jpg', 'mitsubishi evolution ii', 1, 2, 1, '1994-01-01', '1995-02-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(7, '64be6a3e7cc054.13357129mitsubishi evolution iii.jpg', 'mitsubishi evolution iii', 1, 2, 1, '1995-02-01', '1996-08-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(8, '64be6a8d825311.29135913mitsubishi evolution iv.jpg', 'mitsubishi evolution iv', 1, 1, 1, '1996-08-01', '1998-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(9, '64be6ad7ec03e7.58792768mitsubishi evolution iv rs.jpg', 'mitsubishi evolution iv rs', 1, 1, 1, '1996-08-01', '1998-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(10, '64be6b0ad63716.43176904mitsubishi evolution iv gsr.jpg', 'mitsubishi evolution iv gsr', 1, 2, 1, '1996-08-01', '1998-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(11, '64be6b44a3c918.60409328mitsubishi evolution v.jpg', 'mitsubishi evolution v', 1, 2, 1, '1998-01-01', '1999-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(12, '64be6b6952d151.40875798mitsubishi evolution v rs.jpg', 'mitsubishi evolution v rs', 1, 2, 1, '1998-01-01', '1999-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(13, '64be6bbf4a08c5.21826773mitsubishi evolution v gsr.jpg', 'mitsubishi evolution v gsr', 1, 1, 1, '1998-01-01', '1999-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(14, '64be6bff417213.90483102mitsubishi evolution vi.jpg', 'mitsubishi evolution vi', 1, 2, 1, '1999-01-01', '2000-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(15, '64be6c1f92b322.65031324mitsubishi evolution vi rs.jpg', 'mitsubishi evolution vi rs', 1, 2, 1, '1999-01-01', '2000-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(16, '64be6c60424435.42120175mitsubishi evolution vi gsr.jpg', 'mitsubishi evolution vi gsr', 1, 2, 1, '1999-01-01', '2000-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(17, '64be6d08c81782.59032623mitsubishi evolution vi tommi makinen rs.jpg', 'mitsubishi evolution vi tommi makinen rs', 1, 2, 1, '1999-12-01', '2000-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(18, '64be6d27b52ec8.96568263mitsubishi evolution vi tommi makinen gsr.jpg', 'mitsubishi evolution vi tommi makinen gsr', 1, 2, 1, '1999-12-01', '2000-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(19, '64be6d6e21e073.55565559mitsubishi evolution vii.jpg', 'mitsubishi evolution vii', 1, 2, 1, '2001-08-01', '2003-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(20, '64be6dabec6cd1.38043814mitsubishi evolution vii rs.jpg', 'mitsubishi evolution vii rs', 1, 2, 1, '2001-08-01', '2003-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(21, '64be6dcbc4ad08.47200268mitsubishi evolution vii gsr.jpg', 'mitsubishi evolution vii gsr', 1, 2, 1, '2001-08-01', '2003-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(22, '64be6e65660be6.41296400mitsubishi evolution vii gt-a.jpg', 'mitsubishi evolution vii gt-a', 1, 2, 1, '2001-08-01', '2003-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(23, '64be6ebd1096c8.87883271mitsubishi evolution viii.jpg', 'mitsubishi evolution viii', 1, 2, 1, '2003-01-01', '2005-03-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(24, '64be6f115bd3e8.03950111mitsubishi evolution viii rs - 5.jpg', 'mitsubishi evolution viii rs - 5', 1, 2, 1, '2003-01-01', '2005-03-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(25, '64be6f2c443fb3.72169061mitsubishi evolution viii rs - 6.jpg', 'mitsubishi evolution viii rs - 6', 1, 2, 1, '2003-01-01', '2005-03-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(26, '64be6f5da5ca19.90579555mitsubishi evolution viii gsr.jpg', 'mitsubishi evolution viii gsr', 1, 2, 1, '2003-01-01', '2005-03-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(27, '64be6f93f28b38.66914773mitsubishi evolution viii mr rs -5.jpg', 'mitsubishi evolution viii mr rs - 5', 1, 2, 1, '2003-01-01', '2005-03-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(28, '64be6fbca731c6.42349289mitsubishi evolution viii mr rs -6.jpg', 'mitsubishi evolution viii mr rs - 6', 1, 1, 1, '2003-01-01', '2005-03-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(29, '64be70e565b060.00236121mitsubishi evolution viii mr gsr.jpg', 'mitsubishi evolution viii mr gsr', 1, 2, 1, '2003-01-01', '2005-03-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(30, '64be713b737d93.48614630mitsubishi evolution ix.jpg', 'mitsubishi evolution ix', 1, 1, 2, '2005-03-01', '2007-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(31, '64be724c91b8e1.42303910mitsubishi evolution ix gt.jpg', 'mitsubishi evolution ix gt', 1, 2, 1, '2005-03-01', '2007-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(32, '64be72958f0096.36067943mitsubishi evolution ix gsr.jpg', 'mitsubishi evolution ix gsr', 1, 2, 1, '2005-03-01', '2007-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(33, '64be72edd1f993.41313951mitsubishi evolution ix mr gsr.jpg', 'mitsubishi evolution ix mr gsr', 1, 2, 1, '2005-03-01', '2007-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(34, '64be73229ee008.69475964mitsubishi evolution ix mr rs.jpg', 'mitsubishi evolution ix mr rs', 1, 2, 1, '2005-03-01', '2007-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(35, '64be734fafb509.61238236mitsubishi evolution ix mr tuned by ralliart.jpg', 'mitsubishi evolution ix mr tuned by ralliart', 1, 2, 1, '2005-03-01', '2007-01-01', 2000, 1, 2, '2023-07-24', NULL, NULL),
(36, '64be739ac5ad87.18741212mitsubishi evolution x.jpg', 'mitsubishi evolution x', 1, 2, 1, '2007-08-01', '2016-06-01', 1998, 1, 2, '2023-07-24', NULL, NULL),
(37, '64ca568b278772.58225516toyta hiace lh 172.jpeg', 'toyta hiace lh 172', 2, 1, 2, '1999-07-01', '2004-02-01', 2998, 1, 2, '2023-08-02', NULL, NULL),
(38, '64ca56d706a379.83360120toyta kdh 201 super gl.jpg', 'toyta kdh 201 super gl', 2, 1, 2, '2010-03-01', '2023-06-01', 2998, 1, 2, '2023-08-02', NULL, NULL),
(39, '64ca56fb358021.88114535toyta noah cr 42.jpeg', 'toyta noah cr 42', 2, 1, 2, '1998-05-01', '2004-06-01', 2998, 1, 2, '2023-08-02', NULL, NULL),
(40, '64ca57f947c295.47782802subaru forester.jpeg', 'subaru forester', 3, 3, 1, '2021-01-01', '2021-09-01', 2980, 1, 2, '2023-08-02', NULL, NULL),
(41, '64ca588dacf563.12609002toyota suv higlander.jpg', 'toyota suv higlander', 3, 1, 1, '2022-01-01', '2023-02-01', 2998, 1, 2, '2023-08-02', NULL, NULL);

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
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk_cities_districts1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `customer_mobile`
--
ALTER TABLE `customer_mobile`
  ADD CONSTRAINT `customer_mobile_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`CustomerID`) ON UPDATE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `fk_districts_provinces1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

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