-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 04:50 PM
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
-- Database: `chapsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` varchar(10) NOT NULL,
  `custName` varchar(80) NOT NULL,
  `custPhone` varchar(14) NOT NULL,
  `custAddress` varchar(100) NOT NULL,
  `custPostcode` varchar(8) NOT NULL,
  `custState` varchar(40) NOT NULL,
  `custEmail` varchar(40) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `custName`, `custPhone`, `custAddress`, `custPostcode`, `custState`, `custEmail`, `password`) VALUES
('111', 'Dato Seri Maznah Binti Halim', '01151871016', 'PNB118 Megah Holdings', '57000', 'Kuala Lumpur', 'akhmal@gmail.com', '698d51a19d8a121ce581499d7b701668'),
('aniq', 'Aniq Amrin Bin Mashuf', '01151561016', 'No.1,Bandar Semenyih Jaya', '43500', 'Selangor', 'amrinAmran@gmail.com', '0a113ef6b61820daa5611c870ed8d5ee'),
('azmahadi', 'Ahmad Amadi Bin Azmahadi', '01441125698', 'Lot23,Banglo Residensi', '93000', 'Sarawak', 'a.amadi@gmail.com', 'f1c1592588411002af340cbaedd6fc33'),
('balqis', 'Balqis Adriana Binti Sulaiman', '01911345420', 'R13-B,Aset Kayamas', '50000', 'Kuala Lumpur', 'balqis01m@gmail.com', 'b706835de79a2b4e80506f582af3676a'),
('idris', 'Idris Shahmi Bin Razak', '01112654311', 'No.13,Bandar Shah Teguh', '02000', 'Perlis', 'idshahm@gmail.com', 'bcbe3365e6ac95ea2c0343a2395834dd'),
('mamal', 'Muhammad Akhmal Bin Mohamad Hussin', '01122789856', 'No.70,Apartment Seri Megah', '25000', 'Pahang', 'akhmal@gmail.com', '310dcbbf4cce62f762a2aaa148d556bd'),
('mimi', 'Mimi Maisarah Binti Idris', '01331567732', 'Lot 2,Perumahan Diraja Kelantan', '15150', 'Kelantan', 'immai@gmail.com', 'c6f057b86584942e415435ffb1fa93d4'),
('muza', 'Muzaffar Kamal Bin Nuh', '01123456211', 'No.56,Residensi Agung,Jalan Selamat', '26070', 'Pahang', 'muzkam@gmail.com', '698d51a19d8a121ce581499d7b701668'),
('nabil', 'Rizaliff Nabil Bin Zakif', '01661315687', 'Lot 3-A,Seri Aset Utama', '26400', 'Pahang', 'riznabil@gmail.com', '15de21c670ae7c3f6f3f1f37029303c9'),
('syafiq', 'Muhammad Syafiq Bin Harith', '0133345467', 'Blok 39-1-2,Perumahan Awan Seri Midah', '41000', 'Selangor', 'syafiq@gmail.com', '550a141f12de6341fba65b0ad0433500'),
('yusuf', 'Nik Yusuf Bin Ali', '01987569922', 'Blok 12,Seri Kos Rendah Awam', '30000', 'Perak', 'nyusuf@gmail.com', 'fae0b27c451c728867a567e8c1bb4e53');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` varchar(10) NOT NULL,
  `empName` varchar(80) NOT NULL,
  `empIC` varchar(20) NOT NULL,
  `empPhone` varchar(14) DEFAULT NULL,
  `empEmail` varchar(40) NOT NULL,
  `empAddress` varchar(100) NOT NULL,
  `empState` varchar(40) NOT NULL,
  `empHireDate` date NOT NULL,
  `empPic` varchar(30) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `empName`, `empIC`, `empPhone`, `empEmail`, `empAddress`, `empState`, `empHireDate`, `empPic`, `password`) VALUES
('admin', 'Muhammad Akhmal Bin Mohamad Hussin', '0404021124383', '01151871016', 'akhmal@gmail.com', 'Penthouse Megah Holdings', 'Kuala Lumpur', '2021-12-22', '', '698d51a19d8a121ce581499d7b701668'),
('damia', 'Damia Aliya Binti Zainon', '970612109882', '01912398228', 'damia@gmail.com', 'No.70,BalailungSeri Hartamas', 'Perlis', '2023-06-12', '', '9cb2597c531f434ae69fa9cd24664e2b'),
('hariz', 'Hariz Hamdan Bin Hashim', '04082214028', '01123456211', 'harham@gmail.com', 'Lot 2,Jalan 12/6 Kampung Baru', 'Pahang', '2022-01-10', '', '65b66a5c953d38b1b9b19ac34d823506'),
('haziq', 'Haziq Hashim Bin Zulkifli', '980808072343', '01323798532', 'haziqhashim@gmail.com', 'No.5 Sime Darby Town', 'Selangor', '2024-08-12', '', '5aa6ef08f83149b888321d22f28cc353'),
('irfan', 'Irfah Haziq Bin Razak', '020201140221', '01112654331', 'irfanHaziq@gmail.com', 'Blok 6,Pangsapuri kos Rendah', 'Pahang', '2022-08-12', '', '2e8453ac7a633ec30539b27983fe4678'),
('nabil', 'Nabil Aminah Binti Ketuw', '030303110277', '01151871016', 'nabilAm@gmail.com', '13-A-1,Perumahan Sera Indah', 'Sabah', '2024-07-07', '', '8e5a4c3ffbf085613b7dcf6f3cbd7ca6');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payID` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `bankName` varchar(30) NOT NULL,
  `accNum` varchar(20) NOT NULL,
  `payDate` date DEFAULT NULL,
  `purID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payID`, `amount`, `bankName`, `accNum`, `payDate`, `purID`) VALUES
(100, '18299.59', 'RHB', '7761000129', '2024-01-14', 'ABX100'),
(101, '71.20', 'BANK ISLAM', '1298561990', '2024-01-01', 'ABC988'),
(102, '23.70', 'CIMB', '6711983356', '2023-12-05', 'ASD102'),
(103, '4300.19', 'CIMB', '6711983356', '2023-12-30', 'QZR298'),
(104, '4619.30', 'RHB', '7761000129', '2023-08-09', 'HBB984'),
(105, '53.40', 'CIMB', '1414877700', '2023-02-27', 'TTE436'),
(106, '1200.00', 'AFFIN BANK', '9810002334', '2023-07-14', 'SED888'),
(107, '6615.80', 'MAYBANK', '1560020018', '2023-06-25', 'KES970'),
(108, '412.60', 'MAYBANK', '1560020018', '2023-09-26', 'BBC765'),
(109, '468.24', 'HSBC', '9113498810', '2022-05-23', 'ARM239'),
(110, '5790.10', 'BANK ISLAM', '1290765523', '2022-09-01', 'QRM639'),
(111, '6999.70', 'BANK ISLAM', '1190772212', '2024-10-04', 'ASM499'),
(112, '598.20', 'HSBC', '0019887311', '2024-11-09', 'LLP119'),
(113, '870.30', 'BANK MUAMALAT', '0019892217', '2024-12-07', 'MRM269'),
(114, '133445.22', 'Maybank', '15601234512', '2024-06-23', 'DRM295'),
(115, '23.70', 'RHB', '15601234512', '2024-06-23', 'IDK827');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodID` varchar(10) NOT NULL,
  `prodName` varchar(50) NOT NULL,
  `prodBrand` varchar(50) DEFAULT NULL,
  `prodPrice` decimal(10,2) NOT NULL,
  `prodCat` varchar(20) DEFAULT NULL,
  `prodPic` varchar(30) NOT NULL,
  `supID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodID`, `prodName`, `prodBrand`, `prodPrice`, `prodCat`, `prodPic`, `supID`) VALUES
('A100', 'GeForce RTX 4070', 'NVIDIA', '6999.70', 'Graphic Card', 'image/a100.jpg', 'S100'),
('A101', 'Intel Core I9', 'INTEL', '4300.19', 'Processor', 'image/a101.jpg', 'S100'),
('A102', 'GeForce RTX 3010', 'NVIDIA', '5500.00', 'Graphic Card', 'image/a102.jpg', 'S102'),
('A103', 'Pendrive Thunder Match', 'SANDISK', '17.80', 'Pendrive', 'image/a103.jpg', 'S103'),
('A104', 'Mouse G1032', 'LOGITECH', '23.70', 'Mouse', 'image/a104.jpg', 'S104'),
('A105', 'Monitor 4K HDR', 'ASUS', '234.12', 'Monitor', 'image/a105.jpg', 'S101'),
('A106', 'Furry 12 GB RAM', 'KINGSTON', '300.00', 'Ram', 'image/a106.jpg', 'S103'),
('A107', 'Intel® Arc™ A770M Graphics', 'INTEL', '4500.80', 'Graphic Card', 'image/a107.jpg', 'S105'),
('A108', 'AMD Ryzen 9 5980HX', 'AMD RYZEN', '3307.90', 'Processor', 'image/a108.jpg', 'S105'),
('A109', 'External Hard Disk 1TB (HDD)', 'SAMSUNG', '290.10', 'Storage', 'image/a109.jpg', 'S106'),
('A110', 'HP Backlight Keyboard', 'HP', '244.90', 'Keyboard', 'image/a110.jpg', 'S101'),
('A111', 'Asus TUF Monterboard Gaming B760', 'ASUS', '844.29', 'Motherboard', 'image/a110.jpg', 'S104');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purID` varchar(10) NOT NULL,
  `purOrderDate` date NOT NULL,
  `purShipDate` date NOT NULL,
  `purStatus` varchar(20) NOT NULL,
  `custID` varchar(10) DEFAULT NULL,
  `empID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purID`, `purOrderDate`, `purShipDate`, `purStatus`, `custID`, `empID`) VALUES
('ABC988', '2023-11-20', '2023-11-30', 'Completed', 'idris', 'hariz'),
('ABX100', '2023-12-20', '2023-12-30', 'Completed', 'muza', 'hariz'),
('ARM239', '2024-05-27', '2024-01-17', 'Pending', 'nabil', 'irfan'),
('ASD102', '2024-06-16', '2024-01-10', 'Pending', 'muza', 'damia'),
('ASM499', '2023-10-04', '2023-10-14', 'Completed', 'azmahadi', 'damia'),
('BBC765', '2024-01-01', '2024-01-11', 'Pending', 'syafiq', 'damia'),
('DRM295', '2024-06-23', '2024-07-03', 'Pending', 'muza', 'damia'),
('HBB984', '2023-10-20', '2023-10-30', 'Completed', 'muza', 'haziq'),
('IDK827', '2024-06-23', '2024-07-03', 'Pending', 'muza', 'damia'),
('KES970', '2024-05-30', '2023-11-20', 'Pending', 'mimi', 'haziq'),
('LLP119', '2023-11-09', '2023-11-19', 'Completed', 'aniq', 'nabil'),
('MRM269', '2023-12-07', '2023-12-17', 'Completed', 'yusuf', 'nabil'),
('QRM639', '2023-09-01', '2023-09-11', 'Completed', 'mamal', 'admin'),
('QZR298', '2023-12-30', '2023-12-28', 'Completed', 'mamal', 'admin'),
('SED888', '2024-06-22', '2023-12-29', 'Pending', 'balqis', 'admin'),
('TTE436', '2023-12-04', '2023-12-14', 'Completed', 'aniq', 'irfan');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product`
--

CREATE TABLE `purchase_product` (
  `purID` varchar(10) NOT NULL,
  `prodID` varchar(10) NOT NULL,
  `qty` int(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_product`
--

INSERT INTO `purchase_product` (`purID`, `prodID`, `qty`, `price`) VALUES
('ABC988', 'A103', 4, '71.20'),
('ABX100', 'A100', 2, '13999.40'),
('ABX100', 'A101', 1, '4300.19'),
('ARM239', 'A105', 2, '468.24'),
('ASD102', 'A104', 1, '23.70'),
('ASM499', 'A100', 1, '6999.70'),
('BBC765', 'A103', 1, '17.80'),
('BBC765', 'A104', 4, '94.80'),
('BBC765', 'A106', 1, '300.00'),
('DRM295', 'A100', 5, '6999.70'),
('DRM295', 'A101', 8, '4300.19'),
('DRM295', 'A102', 11, '5500.00'),
('DRM295', 'A103', 12, '17.80'),
('DRM295', 'A104', 1, '23.70'),
('DRM295', 'A108', 1, '3307.90'),
('HBB984', 'A104', 5, '118.50'),
('HBB984', 'A107', 1, '4500.80'),
('IDK827', 'A104', 1, '23.70'),
('KES970', 'A108', 2, '6615.80'),
('LLP119', 'A109', 2, '598.20'),
('MRM269', 'A109', 3, '870.30'),
('QRM639', 'A102', 1, '5500.00'),
('QRM639', 'A109', 1, '290.10'),
('QZR298', 'A101', 1, '4300.19'),
('SED888', 'A106', 4, '1200.00'),
('TTE436', 'A106', 3, '53.40');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supID` varchar(10) NOT NULL,
  `supName` varchar(40) NOT NULL,
  `supAddress` varchar(100) NOT NULL,
  `supState` varchar(40) DEFAULT NULL,
  `supPhone` varchar(14) DEFAULT NULL,
  `supEmail` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supID`, `supName`, `supAddress`, `supState`, `supPhone`, `supEmail`) VALUES
('S100', 'Dunia Computer', 'Lot2,Medan Niaga Utama', 'Perka', '05100671990', 'd.c@gmail.com'),
('S101', 'ABZ Vision Tech', 'No.2 Jalan Teguh Emas', 'Kelantan', '09129884590', 'abxVison@gmail.com'),
('S102', 'Rahman Enterprise', 'Floor 3,Amanjaya Mall', 'Kedah', '0431009876', 'ramanEnt12@gmail.com'),
('S103', 'Startec', 'Menara Lowyat, Sungei Wang', 'Kuala Lumpur', '03905710023', 'stratec.biz@gmail.com'),
('S104', 'Seri Computer', 'Lot3A,Pertama Complex', 'Pahang', '0590012991', 'seri.comp@gmail.com'),
('S105', 'Viwenet Computer', 'Lot3B,Pertama Complex', 'Pahang', '0512907782', 'view.net.p@gmail.com'),
('S106', 'Compu-Zone', 'Lot4C,MyTown Shooping Centre', 'Selangor', '0390671299', 'compuzone@outlook.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payID`),
  ADD KEY `purID` (`purID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purID`),
  ADD KEY `custID` (`custID`),
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD PRIMARY KEY (`purID`,`prodID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`purID`) REFERENCES `purchase` (`purID`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`custID`) REFERENCES `customer` (`custID`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
