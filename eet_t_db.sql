-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 03:12 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eet&t_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `Booking_ID` varchar(15) NOT NULL,
  `Booking_Date` varchar(15) NOT NULL,
  `Package_Name` varchar(30) NOT NULL,
  `Schedule_ID` varchar(15) NOT NULL,
  `Start_Date` varchar(15) NOT NULL,
  `End_Date` varchar(15) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Customer_ID` varchar(15) NOT NULL,
  `E_Mail` varchar(40) NOT NULL,
  `Phone_Number` varchar(30) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `SubTotal` int(11) NOT NULL,
  `Tax` decimal(10,2) NOT NULL,
  `Total_Cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`Booking_ID`, `Booking_Date`, `Package_Name`, `Schedule_ID`, `Start_Date`, `End_Date`, `Price`, `Quantity`, `Customer_ID`, `E_Mail`, `Phone_Number`, `Status`, `SubTotal`, `Tax`, `Total_Cost`) VALUES
('Bk-000001', '07-10-2020', 'Beauty Of Inle', 'Sc-000003', '21-Nov-2020', '29-Nov-2020', 1480, 2, 'Cu-000003', 'lsteve@gmail.com', '+95-9489-469-1266', 'Paid', 2960, '148.00', '3108.00'),
('Bk-000002', '08-10-2020', 'Magnificent Bagan', 'Sc-000001', '01-Nov-2020', '11-Nov-2020', 1650, 4, 'Cu-000002', 'kjone@gmail.com', '+95-9123-136-8666', 'Confirmed', 6600, '330.00', '6930.00'),
('Bk-000003', '08-10-2020', 'Mysterious Golden Rock', 'Sc-000002', '15-Nov-2020', '20-Nov-2020', 950, 1, 'Cu-000002', 'kjone@gmail.com', '+95-9123-136-8666', 'Denied', 950, '47.50', '997.50'),
('Bk-000004', '08-10-2020', 'Beauty Of Inle', 'Sc-000003', '21-Nov-2020', '29-Nov-2020', 1480, 3, 'Cu-000001', 'jcage@gmail.com', '+95-9123-123-1266', 'Paid', 4440, '222.00', '4662.00'),
('Bk-000005', '08-10-2020', 'Mysterious Golden Rock', 'Sc-000002', '15-Nov-2020', '20-Nov-2020', 950, 1, 'Cu-000001', 'jcage@gmail.com', '+95-9123-123-1266', 'Pending', 950, '47.50', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Customer_ID` varchar(10) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `EMail` varchar(50) NOT NULL,
  `PhoneNumber` varchar(25) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_ID`, `FirstName`, `LastName`, `Password`, `EMail`, `PhoneNumber`, `Nationality`, `Address`, `Image`) VALUES
('Cu-000001', 'Jonny', 'Cage', '123456789', 'jcage@gmail.com', '+95-9123-123-1266', 'United State', 'Yangon', 'Image/Customer_Images/_te1.jpg'),
('Cu-000002', 'Kelvin', 'Jone', '123456789', 'kjone@gmail.com', '+95-9123-136-8666', 'England', 'Yangon', 'Image/Customer_Images/_te6.jpg'),
('Cu-000003', 'Leo', 'Steve', '123456789', 'lsteve@gmail.com', '+95-9489-469-1266', 'Italy', 'Yangon', 'Image/Customer_Images/_te3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `Hotel_ID` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `ServiceLevel` varchar(10) NOT NULL,
  `Image1` text NOT NULL,
  `Image2` text NOT NULL,
  `Image3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`Hotel_ID`, `Name`, `Location`, `ServiceLevel`, `Image1`, `Image2`, `Image3`) VALUES
('Ho-000001', 'Montain Top ', 'Mandalay', '5 Stars', 'Image/Hotel_Images/_Capture 9.PNG', 'Image/Hotel_Images/_Capture 11.PNG', 'Image/Hotel_Images/_Capture 5.PNG'),
('Ho-000002', 'Golden Rock', 'Mon State', '4 Stars', 'Image/Hotel_Images/_Capture 8.PNG', 'Image/Hotel_Images/_Capture 4.PNG', 'Image/Hotel_Images/_Capture 7.PNG'),
('Ho-000003', 'The Regency', 'Bagan', '5 Stars', 'Image/Hotel_Images/_Capture 13.PNG', 'Image/Hotel_Images/_Capture 12.PNG', 'Image/Hotel_Images/_Capture 6.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `Package_ID` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Duration` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Route_ID` varchar(30) NOT NULL,
  `Staff_ID` varchar(30) NOT NULL,
  `Image1` text NOT NULL,
  `Image2` text NOT NULL,
  `Image3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`Package_ID`, `Name`, `Type`, `Duration`, `Price`, `Image`, `Route_ID`, `Staff_ID`, `Image1`, `Image2`, `Image3`) VALUES
('Pk-000001', 'Magnificent Bagan', 'Historical', '10', 1650, 'Package_Images/_bagan-wedding-photographer-myanmar-10.jpg', 'Ro-000003', 'St-000002', 'Package_Images/_3817bcc04473e0893053fffda3e5895c.jpg', 'Package_Images/_Bagan-Sunset.jpg.optimal.jpg', 'Package_Images/_big-c755f88b42ea1e5df2d67e8034481bf2.jpg'),
('Pk-000002', 'Mysterious Golden Rock', 'Environmental', '5', 950, 'Package_Images/_169808_Viator_Shutterstock_126003.jpg', 'Ro-000004', 'St-000002', 'Package_Images/_Depositphotos_55166423_l-2015.jpg', 'Package_Images/_Capture 14.PNG', 'Package_Images/_image_processing20181012-4-8jw10j.jpg'),
('Pk-000003', 'Beauty Of Inle', 'Environmental', '8', 1480, 'Package_Images/_Inle-Lake-Shan-State-Myanmar-001-neyaf1f82lbr7d7noethxz0a75pdilmj6e7hazkhym.jpg', 'Ro-000001', 'St-000002', 'Package_Images/_Inle Lake Myanmar.jpg', 'Package_Images/_Sofitel-Unveils-Immersive-Journey-Into-Wellness-at-Inle-Lake-Myanmar-TRAVELINDEX.jpg', 'Package_Images/_image_processing20181012-4-8jw10j.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_ID` varchar(15) NOT NULL,
  `Payment_Date` varchar(15) NOT NULL,
  `Booking_ID` varchar(15) NOT NULL,
  `Customer_ID` varchar(15) NOT NULL,
  `Total_Cost` decimal(10,2) NOT NULL,
  `Payment_Type` varchar(30) NOT NULL,
  `CardNO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Payment_ID`, `Payment_Date`, `Booking_ID`, `Customer_ID`, `Total_Cost`, `Payment_Type`, `CardNO`) VALUES
('Pm-000001', '07-10-2020', 'Bk-000001', 'Cu-000003', '3108.00', 'VISA', '9975-9843-7952-6986'),
('Pm-000002', '08-10-2020', 'Bk-000004', 'Cu-000001', '4662.00', 'KBZPay', '');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `Route_ID` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`Route_ID`, `Name`, `Detail`) VALUES
('Ro-000001', 'East', 'Aaa-Bbb-Ccc-Ddd-Eee'),
('Ro-000002', 'Wast', '111-222-333-444-555-666'),
('Ro-000003', 'North', 'zzz-yyy-xxx-www-vvv'),
('Ro-000004', 'South', 'jjj-kkk-lll-mmm-nnn');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `Schedule_ID` varchar(10) NOT NULL,
  `Coverage` varchar(255) NOT NULL,
  `Start_Date` varchar(12) NOT NULL,
  `End_Date` varchar(12) NOT NULL,
  `Vehicle_ID` varchar(10) NOT NULL,
  `Hotel_ID` varchar(10) NOT NULL,
  `Package_ID` varchar(10) NOT NULL,
  `Description1` varchar(255) NOT NULL,
  `Description2` varchar(255) NOT NULL,
  `Description3` varchar(255) NOT NULL,
  `Description4` varchar(255) NOT NULL,
  `Description5` varchar(255) NOT NULL,
  `Description6` varchar(255) NOT NULL,
  `Description7` varchar(255) NOT NULL,
  `Description8` varchar(255) NOT NULL,
  `Description9` varchar(255) NOT NULL,
  `Description10` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`Schedule_ID`, `Coverage`, `Start_Date`, `End_Date`, `Vehicle_ID`, `Hotel_ID`, `Package_ID`, `Description1`, `Description2`, `Description3`, `Description4`, `Description5`, `Description6`, `Description7`, `Description8`, `Description9`, `Description10`) VALUES
('Sc-000001', 'Yangon â€“ Bagan â€“ Mandalay â€“ Pyin Oo Lwin â€“ Yangon', '01-Nov-2020', '11-Nov-2020', 'Ve-000003', 'Ho-000003', 'Pk-000001', 'This is Day 1.', 'This is Day 2.', 'This is Day 3.', 'This is Day 4.', 'This is Day 5.', 'This is Day 6.', 'This is Day 7.', 'This is Day 8.', 'This is Day 9.', 'This is Day 10.'),
('Sc-000002', 'Yangon â€“ Thanlyin â€“ Kyaikhtiyo â€“ Bago â€“ Yangon', '15-Nov-2020', '20-Nov-2020', 'Ve-000002', 'Ho-000002', 'Pk-000002', 'This DDDDD 1.', 'This DDDDD 2.', 'This DDDDD 3.', 'This DDDDD 4.', 'This DDDDD 5.', '-', '-', '-', '-', '-'),
('Sc-000003', 'Yangon - Mandalay - Bagan - Inle - Yangon', '21-Nov-2020', '29-Nov-2020', 'Ve-000001', 'Ho-000001', 'Pk-000003', 'This is Dayyyyy 1.', 'This is Dayyyyy 2.', 'This is Dayyyyy 3.', 'This is Dayyyyy 4.', 'This is Dayyyyy 5.', 'This is Dayyyyy 6.', 'This is Dayyyyy 7.', 'This is Dayyyyy 8.', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `Staff_ID` varchar(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PositionStatus` varchar(50) NOT NULL,
  `EMail` varchar(50) NOT NULL,
  `PhoneNumber` varchar(25) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Staff_Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`Staff_ID`, `Name`, `Password`, `PositionStatus`, `EMail`, `PhoneNumber`, `Address`, `Staff_Image`) VALUES
('St-000001', 'Linn', '1234567890', 'Website Admin', 'linn@gmail.com', '+95-9123-367-3900', 'Yangon', 'Image/Staff_Images/_te3.jpg'),
('St-000002', 'Zenn', '1234567890', 'Tours Manager', 'zenn@gmail.com', '+95-4775-975-8357', 'Yangon', 'Image/Staff_Images/_t1.jpg'),
('St-000003', 'Cherry', '1234567890', 'Marketing Manager', 'cherry@gmail.com', '+95-9123-123-14699', 'Yangon', 'Image/Staff_Images/_t3.jpg'),
('St-000004', 'May', '1234567890', 'Receptionist', 'may@gmail.com', '+95-9123-764-3657', 'Yangon', 'Image/Staff_Images/_te5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `Vehicle_ID` varchar(10) NOT NULL,
  `DriverName` varchar(50) NOT NULL,
  `VehicleName` varchar(30) NOT NULL,
  `LicenseNumber` varchar(10) NOT NULL,
  `NumberOfSeats` int(2) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`Vehicle_ID`, `DriverName`, `VehicleName`, `LicenseNumber`, `NumberOfSeats`, `Image`) VALUES
('Ve-000001', 'Mr. John', '24 Seaters (12-21 Pax)', 'GH/63903', 24, 'Image/Vehicle_Images/_Capture 1.PNG'),
('Ve-000002', 'Mr. Smith', '33 Seaters (22-30 Pax)', 'KJ/47924', 33, 'Image/Vehicle_Images/_Capture 2.PNG'),
('Ve-000003', 'Mr. John', '45 Seaters (25-28 Pax)', 'VF/35636', 20, 'Image/Vehicle_Images/_Capture 3.PNG');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
