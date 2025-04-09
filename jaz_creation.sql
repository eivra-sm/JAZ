-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 07:04 PM
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Status_Archive` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `Email` varchar(30) NOT NULL,
  `User_lvl` int(11) DEFAULT 0,
  `Birthday` date DEFAULT NULL,
  `Billing_Address` varchar(255) DEFAULT NULL,
  `Pword` varchar(255) DEFAULT NULL,
  `Profile_Photo` varchar(255) DEFAULT NULL,
  `Archived_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Status_Archive`, `Account_ID`, `Fullname`, `Email`, `User_lvl`, `Birthday`, `Billing_Address`, `Pword`, `Profile_Photo`, `Archived_At`) VALUES
(0, 23, 'zhongli', 'email@email.com', 0, '2025-04-09', 'awdawd', 'morax', 'awda', '2025-04-09 16:11:53'),
(1, 34, 'raiden', 'email@email.com', 0, '2025-04-04', 'wadawfa', 'beelzebul', 'wdawd', '2025-04-09 16:11:53'),
(0, 45, 'nahida', 'email@email.com', 0, '2025-04-07', 'awdawda', 'buer', 'awdawd', '2025-04-09 16:11:53'),
(1, 123, 'venti', 'email@email.com', 0, '2025-04-09', 'fthrdg', 'barbatos', 'tgtg', '2025-04-09 16:11:53');

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
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Archive_Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_lists`
--

INSERT INTO `product_lists` (`Product_ID`, `Product_Name`, `Descrip`, `Price`, `Stock`, `Category`, `Images`, `Created_At`, `Archive_Status`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-09 16:38:46', 1),
(2, 'ftjf', 'fjtf', 6.00, 5, 'tyj', 'egegr', '2025-04-09 16:38:46', 0),
(3, 'awda', 'awd', 3.00, 2, 'awdaw', 'awda', '2025-04-09 16:38:46', 0),
(4, 'awdaw', 'awdwa', 9.00, 23, 'wdawda', 'awda', '2025-04-09 16:38:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Review` text DEFAULT NULL,
  `Date_Posted` datetime DEFAULT current_timestamp(),
  `Archive_Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Review_ID`, `Account_ID`, `Review`, `Date_Posted`, `Archive_Status`) VALUES
(1, 123, NULL, '2025-04-10 00:56:21', 0),
(2, 23, NULL, '2025-04-10 00:56:21', 1),
(3, 123, NULL, '2025-04-10 00:56:21', 0),
(4, 34, NULL, '2025-04-10 00:56:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_summary`
--

CREATE TABLE `sales_summary` (
  `Sale_ID` int(11) NOT NULL,
  `Order_ID` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Total_Amount` decimal(10,2) DEFAULT NULL,
  `Payment_Status` varchar(50) DEFAULT NULL,
  `Order_Status` varchar(50) DEFAULT NULL,
  `Order_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Account_ID`);

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
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `Account_ID` (`Account_ID`);

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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `customers_info`
--
ALTER TABLE `customers_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_lists`
--
ALTER TABLE `order_lists`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_lists`
--
ALTER TABLE `product_lists`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_summary`
--
ALTER TABLE `sales_summary`
  MODIFY `Sale_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22222223;

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
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `accounts` (`Account_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_summary`
--
ALTER TABLE `sales_summary`
  ADD CONSTRAINT `sales_summary_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `order_lists` (`Order_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
