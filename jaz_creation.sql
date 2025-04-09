-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 06:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jaz_creation`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive_admin`
--

CREATE TABLE `archive_admin` (
  `Archive_ID` int(11) NOT NULL,
  `Original_Customer_ID` int(11) DEFAULT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `User_lvl` int(11) DEFAULT 0,
  `Birthday` date DEFAULT NULL,
  `Billing_Address` varchar(255) DEFAULT NULL,
  `Pword` varchar(255) DEFAULT NULL,
  `Profile_Photo` varchar(255) DEFAULT NULL,
  `Archived_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers_info`
--

CREATE TABLE `customers_info` (
  `ID` int(11) NOT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `User_lvl` int(11) DEFAULT 3,
  `Birthday` date DEFAULT NULL,
  `Billing_Address` varchar(255) DEFAULT NULL,
  `Pword` varchar(255) DEFAULT NULL,
  `Profile_Photo` varchar(255) DEFAULT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers_info`
--

INSERT INTO `customers_info` (`ID`, `Fullname`, `Email`, `User_lvl`, `Birthday`, `Billing_Address`, `Pword`, `Profile_Photo`, `Created_At`) VALUES
(1, 'Arvie M. Sinocruz', 'arvie@gmail.com', 2, '2004-09-13', 'Blk 4 Kaingin 1 Brgy. Pansol, Quezon City', 'Wow_magic', 'uploads/1744123236_SINOCRUZ ARVIE - CREATIVE - FEU (3).JPG', '2025-04-08 14:40:36'),
(2, 'Zyann Lynn C. Mayo', 'zyann@gmail.com', 2, '2004-09-20', 'Far Eastern University', 'lynnlang', '', '2025-04-09 09:17:40'),
(3, 'Juliana Rose P. Rogel', 'rose@gmail.com', 2, '2006-04-18', 'Far Eastern University', 'rose_', '', '2025-04-09 09:15:01'),
(4, 'Superadmin', 'superadmin@gmail.com', 1, '2004-09-13', 'Far Eastern University', 'supernova', 'supernova.jpg', '2025-04-09 11:07:03'),
(6, 'Consuelo B. Mercado', 'cielo@gmail.com', 3, '2004-03-11', 'Far Eastern University', 'ensaymada', NULL, '2025-04-09 06:51:22'),
(7, 'Gabriel L. Tagaytay', 'gab@gmail.com', 3, '2025-06-11', 'Far Eastern University', 'marahuyo', NULL, '2025-04-09 07:08:52'),
(8, 'Elisha Mae Borromeo', 'sophia@gmail.com', 3, '2025-03-18', 'Far Eastern University', 'award', NULL, '2025-04-09 07:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_lists`
--

CREATE TABLE `order_lists` (
  `Order_ID` int(11) NOT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `Product_ID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Order_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(50) DEFAULT NULL,
  `Total_Amount` decimal(25,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_lists`
--

INSERT INTO `order_lists` (`Order_ID`, `Customer_ID`, `Product_ID`, `Quantity`, `Order_Date`, `Status`, `Total_Amount`) VALUES
(1, 6, 3, 1, '2025-04-09 07:06:53', 'Processing', 86000),
(2, 8, 1, 1, '2025-04-09 07:10:49', 'Shipped', 75500),
(3, 7, 2, 3, '2025-04-09 07:10:49', 'Delivered', 21000);

-- --------------------------------------------------------

--
-- Table structure for table `product_lists`
--

CREATE TABLE `product_lists` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(100) DEFAULT NULL,
  `Descrip` varchar(300) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Images` varchar(255) DEFAULT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_lists`
--

INSERT INTO `product_lists` (`Product_ID`, `Product_Name`, `Descrip`, `Price`, `Stock`, `Category`, `Images`, `Created_At`) VALUES
(1, 'Farra Console', 'Matting: Sariki Natural\r\nDimensions: 155 x 45 x 84 Hcm', 75500.00, 10, 'Tables', 'Farra_Console.jpg', '2025-04-09 06:58:51'),
(2, 'Alva Dining Chair', 'Dimensions: 48.5 x 55.8 x 82.5 Hcm', 17000.00, 16, 'Seating', 'Alva_Dining_Chair.jpg', '2025-04-09 07:03:05'),
(3, 'Polk Bed', 'Dimension: Double Bed - 149 x 211 x 135 Hcm', 86000.00, 5, 'Beds', 'Polk_Bed.jpg', '2025-04-09 07:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `sales_summary`
--

CREATE TABLE `sales_summary` (
  `Sale_ID` int(11) NOT NULL,
  `Order_ID` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Total_Amount` decimal(10,2) DEFAULT NULL,
  `Payment_Status` varchar(50) DEFAULT NULL,
  `Order_Status` varchar(50) DEFAULT NULL,
  `Order_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_summary`
--

INSERT INTO `sales_summary` (`Sale_ID`, `Order_ID`, `Price`, `Quantity`, `Total_Amount`, `Payment_Status`, `Order_Status`, `Order_Date`) VALUES
(1, 1, 86000.00, 1, 86000.00, 'Downpayment', 'Processing', '2025-04-09 14:59:25'),
(2, 2, 75500.00, 1, 75500.00, 'Paid', 'Shipped', '2025-04-09 14:59:25'),
(3, 3, 17000.00, 3, 21000.00, 'Paid', 'Delivered', '2025-04-09 14:59:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive_admin`
--
ALTER TABLE `archive_admin`
  ADD PRIMARY KEY (`Archive_ID`);

--
-- Indexes for table `customers_info`
--
ALTER TABLE `customers_info`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `order_lists`
--
ALTER TABLE `order_lists`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Product_ID` (`Product_ID`);

--
-- Indexes for table `product_lists`
--
ALTER TABLE `product_lists`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `sales_summary`
--
ALTER TABLE `sales_summary`
  ADD PRIMARY KEY (`Sale_ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive_admin`
--
ALTER TABLE `archive_admin`
  MODIFY `Archive_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers_info`
--
ALTER TABLE `customers_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_lists`
--
ALTER TABLE `order_lists`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_lists`
--
ALTER TABLE `product_lists`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_summary`
--
ALTER TABLE `sales_summary`
  MODIFY `Sale_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_lists`
--
ALTER TABLE `order_lists`
  ADD CONSTRAINT `order_lists_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customers_info` (`ID`),
  ADD CONSTRAINT `order_lists_ibfk_2` FOREIGN KEY (`Product_ID`) REFERENCES `product_lists` (`Product_ID`);

--
-- Constraints for table `sales_summary`
--
ALTER TABLE `sales_summary`
  ADD CONSTRAINT `sales_summary_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `order_lists` (`Order_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
