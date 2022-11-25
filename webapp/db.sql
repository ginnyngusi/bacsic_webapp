-- phpMyAdmin SQL Dump
-- version 5.1.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2022 at 04:18 PM
-- Server version: 10.6.7-MariaDB-3-log
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `week2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `ID` int(11) NOT NULL,
  `productname` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`ID`, `productname`, `img`, `stock`, `price`) VALUES
(1, 'Marula', 'marula.jpg', 100, 35),
(2, 'Canyon', 'canyon.jpg', 100, 25),
(3, '555', '555.jpg', 100, 75),
(4, 'Captain Black', 'captain.jpg', 100, 50),
(5, 'Forte', 'forte.jpg', 100, 30),
(6, 'Lucky', 'lucky.jpg', 100, 60),
(7, 'Marlboro', 'marlboro.jpg', 100, 50),
(8, 'Mond', 'mond.jpg', 100, 30),
(9, 'Oris', 'oris.jpg', 100, 40),
(10, 'Raison', 'raison.jpg', 100, 120),
(11, 'Sobranie', 'sobranie.jpg', 100, 60),
(12, 'Bật lửa', 'batlua.jpg', 100, 15),
(13, 'qwerq', 'meo.jpg', 444, 22);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `money` int(11) NOT NULL DEFAULT 0,
  `vip` int(1) NOT NULL DEFAULT 0,
  `type` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`userID`, `username`, `fullname`, `password`, `email`, `address`, `phone`, `avatar`, `money`, `vip`, `type`) VALUES
(1, 'admin', NULL, '$2y$10$FcG98VxHb05Rxi6yyP631.vPP9mJTAujs4i2vVyT/zfogyZ/NfiGm', '', '', '', '', 5150, 0, 'admin'),
(2, 'ginny', NULL, '$2y$10$VYEW51TCTxFWN1fDO1sK6ORLLlwND/UGLeHeUI5P0DID13iHy11k.', 'test@test.com', 'qww', '0123456789', '', 0, 0, 'user'),
(3, 'ginnyginny', 'Harry Potterrrrrrr', '$2y$10$0w1UuZiGPLeP/PRWUhp1B.GiNuvdDi0fhWLhOTB.rdM66mzLlgx/O', 'testlancuoi@test.com', 'adfasf', '0123654789', 'meo.jpg', 987586, 1, 'user'),
(4, 'testtest', NULL, '$2y$10$bZpUfbXOw1SdSRGAn0dk1.MmF.lm0uJj76i80kb/Zk8KFLnO572w.', 'test$teset.com', 'adsf', '0987654321', 'default.jpg', 0, 0, 'user'),
(5, 'duyanh', 'Mot con meo', '$2y$10$TnS3c9Y7UH2KmNb/FNDxQe/hC8s3w4gxAW5V73tIWLU14Clnb3NOi', 'test@test.test', 'qerweqr', '0987654321', 'meo.jpg', 400, 1, 'user'),
(6, 'qwerty', 'mothaiba', '$2y$10$X/Bk9qoOkVzFWKZSHw.Ot.IKi/pe.kx0g5TcEiY8Fo2lk93NwQBXC', '123@test.com', 'asd', '0987654321', 'meo.jpg', 550, 0, 'user'),
(7, 'asdfd', 'mohai ba', '$2y$10$JclP/RyVBww9/7qBdHyVt.crKADiNvi5ZQkQ5yAXz7o9heQ8NYBxK', 'asd@etst.com', 'qwe', '0123456789', 'meo.jpg', 316, 1, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `Product` (`ID`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
