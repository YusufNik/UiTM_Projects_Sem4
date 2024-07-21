-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 07:14 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autowash`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookID` varchar(10) NOT NULL,
  `custUsername` varchar(50) NOT NULL,
  `bookDate` date NOT NULL,
  `bookTime` time NOT NULL,
  `bookStatus` enum('Confirmed','Pending','Cancelled') NOT NULL,
  `bookServiceType` enum('Basic','Deluxe','Premium') NOT NULL,
  `bookAmount` decimal(10,2) NOT NULL,
  `carType` enum('Micro','Sedan','Sport','Pickup','SUV') NOT NULL,
  `plateNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookID`, `custUsername`, `bookDate`, `bookTime`, `bookStatus`, `bookServiceType`, `bookAmount`, `carType`, `plateNumber`) VALUES
('b024', 'naqib', '2024-07-19', '14:04:00', 'Pending', 'Basic', '25.00', 'Pickup', 'cba2216'),
('b337', 'AYEPHAZIQ', '2025-03-05', '12:29:00', 'Pending', 'Deluxe', '15.00', 'Micro', 'W1'),
('b514', 'ayephaziq', '2024-07-25', '12:38:00', 'Pending', 'Premium', '30.00', 'Sport', 'WTW271'),
('b521', 'maznah', '2024-07-21', '23:07:00', 'Pending', 'Premium', '20.00', 'Micro', 'sbb dj'),
('b734', 'naqib', '2024-07-11', '23:52:00', 'Pending', 'Premium', '35.00', 'Pickup', 'vvv123'),
('b944', 'maznah', '2024-07-10', '11:06:00', 'Pending', 'Basic', '15.00', 'Sedan', 'hahah');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custUsername` varchar(50) NOT NULL,
  `custName` varchar(255) NOT NULL,
  `custNum` varchar(20) NOT NULL,
  `custPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custUsername`, `custName`, `custNum`, `custPassword`) VALUES
('AYEPHAZIQ', 'MUHAMAD ARIF HAZIQ', '01784695155', 'Ripziq'),
('maznah', 'Siti Maznah Binti Abu', '999', '111'),
('naqib', 'Daniel haikal bin mazlan', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payID` varchar(10) NOT NULL,
  `bookID` varchar(10) NOT NULL,
  `payMethod` enum('Cash','Bank') NOT NULL,
  `payAmount` decimal(10,2) NOT NULL,
  `payBankName` varchar(255) DEFAULT NULL,
  `payAccNum` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payID`, `bookID`, `payMethod`, `payAmount`, `payBankName`, `payAccNum`) VALUES
('p096', 'b521', 'Bank', '20.00', 'RHB', '18371738'),
('p210', 'b337', 'Cash', '15.00', '-', '-'),
('p699', 'b734', 'Bank', '35.00', 'Maybank', '123456789'),
('p743', 'b024', 'Cash', '25.00', '-', '-'),
('p870', 'b944', 'Cash', '15.00', '-', '-'),
('p924', 'b514', 'Bank', '30.00', 'Maybank', '1432056789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookID`),
  ADD KEY `idx_booking_custusername` (`custUsername`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custUsername`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payID`),
  ADD KEY `idx_payment_bookid` (`bookID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`custUsername`) REFERENCES `customer` (`custUsername`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `booking` (`bookID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
