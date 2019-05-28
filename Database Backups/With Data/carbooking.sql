-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2019 at 03:12 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `carbookings`
--

CREATE TABLE `carbookings` (
  `ID` int(11) NOT NULL,
  `CarID` varchar(25) NOT NULL,
  `UserID` varchar(25) NOT NULL,
  `FirstDay` date NOT NULL,
  `LastDay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carinfo`
--

CREATE TABLE `carinfo` (
  `ID` int(11) NOT NULL,
  `CarID` varchar(25) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Color` varchar(25) NOT NULL,
  `YearsOld` varchar(25) NOT NULL,
  `LicensePlate` varchar(25) NOT NULL,
  `Seats` varchar(25) NOT NULL,
  `Doors` varchar(25) NOT NULL,
  `GearType` varchar(25) NOT NULL,
  `FuelType` varchar(25) NOT NULL,
  `PhotoURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carinfo`
--

INSERT INTO `carinfo` (`ID`, `CarID`, `Name`, `Color`, `YearsOld`, `LicensePlate`, `Seats`, `Doors`, `GearType`, `FuelType`, `PhotoURL`) VALUES
(2, '1', 'BMW', 'Blue', '2', 'PAPL8S8', '5', '5', 'Automatic', 'Diesel', './Images/bmw.jpeg'),
(22, '2', 'Ford Focus 2012', 'Grey', '7', 'PCG1445', '5', '5', 'Automatic', 'Diesel', './Images/ford.jpeg'),
(23, '3', 'BMW 3 Series Coupe', 'White', '2', '14959PG', '4', '2', 'Semi Automatic', 'Diesel', './Images/bmw-3-series.jpeg'),
(24, '4', 'Audi A7', 'Blue', '1', '4479PJO', '5', '5', 'Automatic', 'Diesel', './Images/audi-a7.jpeg'),
(25, '5', 'Audi A6 Allroad', 'Blue', '2', '9879PHK', '5', '5', 'Automatic', 'Diesel', './Images/audi-a6-allroad.jpeg'),
(26, '6', 'Mercedes A Class Hatchbac', 'Dark Blue', '1', '78J29HO', '5', '5', 'Manual', 'Diesel', './Images/mercedes-a-class-hatchback.jpeg'),
(27, '7', 'Mercedes Benz Deportivo', 'Grey', '1', '78H2IHOI', '2', '2', 'Automatic', 'Diesel', './Images/mercedes-amg.jpeg'),
(28, '8', 'Land Rover Range Rover Ev', 'White', '1', '88H29KHI', '2', '2', 'Automatic', 'Diesel', './Images/land-rover-range-rover-evoque.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `ID` int(11) NOT NULL,
  `CarID` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`ID`, `CarID`) VALUES
(1, 1),
(30, 2),
(31, 3),
(32, 4),
(33, 5),
(34, 6),
(35, 7),
(36, 8);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(25) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `PhoneNumber` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`ID`, `UserID`, `FirstName`, `LastName`, `PhoneNumber`) VALUES
(1, '0', 'John', 'Doe', '55555555'),
(2, '1', 'Doris', 'Grey', '55555555'),
(3, '2', 'Vincent', 'Lab', '55555555');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `UserID` int(25) NOT NULL,
  `UserName` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `UserType` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserID`, `UserName`, `Password`, `UserType`) VALUES
(1, 0, 'admin', '1234', 'admin'),
(2, 1, 'doris', '1234', 'user'),
(3, 2, 'vincentlab', '1234', 'company');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carbookings`
--
ALTER TABLE `carbookings`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `carinfo`
--
ALTER TABLE `carinfo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carbookings`
--
ALTER TABLE `carbookings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `carinfo`
--
ALTER TABLE `carinfo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
