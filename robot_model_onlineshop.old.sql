-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 02:47 PM
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
-- Database: `robot_model_onlineshop`
--
CREATE DATABASE IF NOT EXISTS `robot_model_onlineshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `robot_model_onlineshop`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `StaffID` bigint(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`StaffID`, `Name`, `Email`, `Password`, `PhoneNumber`) VALUES
(1, 'Nontawat Thanundonsuk', 'nontawat@gmail.com', 'non123', '0830333534'),
(2, 'Asipan Ketphet', 'asipan@gmail.com', 'knot123', '0800168999'),
(3, 'Nanmanas Linphrachaya', 'nanmanas@gmail.com', 'mond123', '0819233500');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `CustomerID` bigint(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `CardNumber` varchar(20) NOT NULL,
  `CardHolderName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `Address`, `Email`, `Password`, `PhoneNumber`, `CardNumber`, `CardHolderName`) VALUES
(1, 'Achara Sutasanachinda', '642/21 Chakrawad Rd., Samphanthawong, Samphanthawong', 'Achara@gmail.com', 'achara123', '0825378718', '4716957604699569', 'Achara Sutasanachinda'),
(2, 'Nui Suttirat', 'Petchburi Rd., Thanon Phaya Thai, Rajthevee', 'nui@gmail.com', 'nui123', '0829310956', '5305126355993555', 'Nui Suttirat'),
(3, 'Chatrsuda  Sirishumsaeng', '78 Pan Road Silom', 'chatrsuda@gmail.com', 'chat123', '0822360138', '123412341234', 'Chatrsuda  Sirishumsaeng');

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

DROP TABLE IF EXISTS `customerorder`;
CREATE TABLE `customerorder` (
  `OrderID` bigint(10) NOT NULL,
  `CartID` bigint(10) NOT NULL,
  `CustomerID` bigint(10) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `TotalAmount` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerorder`
--

INSERT INTO `customerorder` (`OrderID`, `CartID`, `CustomerID`, `PurchaseDate`, `TotalAmount`) VALUES
(1, 1, 1, '2021-11-24', 3820),
(2, 2, 2, '2021-11-24', 1283);

-- --------------------------------------------------------

--
-- Table structure for table `incart`
--

DROP TABLE IF EXISTS `incart`;
CREATE TABLE `incart` (
  `CartID` bigint(10) NOT NULL,
  `ProductID` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incart`
--

INSERT INTO `incart` (`CartID`, `ProductID`) VALUES
(2, 3),
(2, 2),
(1, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `inwishlist`
--

DROP TABLE IF EXISTS `inwishlist`;
CREATE TABLE `inwishlist` (
  `WishlistID` bigint(10) NOT NULL,
  `ProductID` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inwishlist`
--

INSERT INTO `inwishlist` (`WishlistID`, `ProductID`) VALUES
(1, 6),
(1, 9),
(5, 7),
(5, 10),
(2, 3),
(2, 8);

--
-- Triggers `inwishlist`
--
DROP TRIGGER IF EXISTS `checkwishlist`;
DELIMITER $$
CREATE TRIGGER `checkwishlist` BEFORE INSERT ON `inwishlist` FOR EACH ROW BEGIN
	IF NEW.ProductID in (SELECT ProductID FROM inwishlist WHERE WishlistID = NEW.WishlistID) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Product is already exist';
   	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `ProductID` bigint(10) NOT NULL,
  `ProductBrand` varchar(20) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `ProductDescription` varchar(20) NOT NULL,
  `StaffID` bigint(10) NOT NULL,
  `Price` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductBrand`, `ProductName`, `Image`, `ProductDescription`, `StaffID`, `Price`) VALUES
(2, 'ฺBandai', 'HG Gundam Deathscyth', 'Images/HG Gundam Deathscyth.jpg', '', 1, 499),
(3, 'Bandai', 'HG Gundam OO Sky', 'Images/HG Gundam OO Sky.jpg', '', 1, 784),
(4, 'Bandai', 'HG Wing Gundam', 'Images/HG Wing Gundam.jpg', '', 1, 530),
(5, 'Bandai', 'GBN-Base Gundam', 'Images/HG GBN-Base Gundam.jpg', '', 1, 569),
(6, 'ฺBandai', 'MG Wing Gundam Zero ', 'Images/MG Wing Gundam Zero.jpg ', '', 2, 2200),
(7, 'Bandai', 'MG Gundam Astray Red Frame', 'Images/MG Gundam Astray Red Frame.jpg', '', 2, 1764),
(8, 'Bandai', 'MG Eclipse Gundam', 'Images/MG Eclipse Gundam.jpg', '', 2, 2450),
(9, 'Bandai', 'MG Force Impulse Gun', 'Images/MG Force Impulse Gundam.jpg', '', 2, 1620),
(10, 'Bandai', 'MG Freedom Gundam Ve 2.0', 'Images/MG Freedom Gundam Ve 2.0.jpg', '', 2, 1620),
(11, 'ฺBandai', 'SD Sangoku Soketsude', 'Images/SD Sangoku Soketsude.jpg', '', 3, 260),
(12, 'Bandai', 'SD RX-Zeromaru', 'Images/SD RX-Zeromaru.jpg', '', 3, 637),
(13, 'Bandai', 'HG Gundam Heavyarms', 'Images/HG Gundam Heavyarms.jpg', '', 1, 500),
(14, 'Bandai', 'SD EX Valkylander', 'Images/SD EX Valkylander.jpg', '', 1, 300);

-- --------------------------------------------------------

--
-- Table structure for table `purchasehistory`
--

DROP TABLE IF EXISTS `purchasehistory`;
CREATE TABLE `purchasehistory` (
  `PurchaseID` bigint(10) NOT NULL,
  `CustomerID` bigint(10) NOT NULL,
  `OrderID` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart` (
  `CartID` bigint(10) NOT NULL,
  `CustomerID` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`CartID`, `CustomerID`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `WishlistID` bigint(10) NOT NULL,
  `CustomerID` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`WishlistID`, `CustomerID`) VALUES
(1, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CartID` (`CartID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `incart`
--
ALTER TABLE `incart`
  ADD KEY `CartID` (`CartID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `inwishlist`
--
ALTER TABLE `inwishlist`
  ADD KEY `WishlistID` (`WishlistID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `StaffID` (`StaffID`);

--
-- Indexes for table `purchasehistory`
--
ALTER TABLE `purchasehistory`
  ADD PRIMARY KEY (`PurchaseID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`WishlistID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `StaffID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `OrderID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `purchasehistory`
--
ALTER TABLE `purchasehistory`
  MODIFY `PurchaseID` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `CartID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `WishlistID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD CONSTRAINT `customerorder_ibfk_3` FOREIGN KEY (`CartID`) REFERENCES `shoppingcart` (`CartID`),
  ADD CONSTRAINT `customerorder_ibfk_4` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `incart`
--
ALTER TABLE `incart`
  ADD CONSTRAINT `incart_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `shoppingcart` (`CartID`),
  ADD CONSTRAINT `incart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `inwishlist`
--
ALTER TABLE `inwishlist`
  ADD CONSTRAINT `inwishlist_ibfk_1` FOREIGN KEY (`WishlistID`) REFERENCES `wishlist` (`WishlistID`),
  ADD CONSTRAINT `inwishlist_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `admin` (`StaffID`);

--
-- Constraints for table `purchasehistory`
--
ALTER TABLE `purchasehistory`
  ADD CONSTRAINT `purchasehistory_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_ibfk_3` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
