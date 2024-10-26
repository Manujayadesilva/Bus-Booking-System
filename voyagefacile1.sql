-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 07, 2024 at 04:27 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voyagefacile1`
--

-- --------------------------------------------------------

--
-- Table structure for table `highwaybusAdd`
--

CREATE TABLE `highwaybusAdd` (
  `id` int(11) NOT NULL,
  `highway_bus_number` varchar(25) NOT NULL,
  `highway_bus_name` varchar(55) NOT NULL,
  `date` date DEFAULT NULL,
  `departing_time` varchar(20) NOT NULL,
  `arriving_time` varchar(20) NOT NULL,
  `time_duration` varchar(25) NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL,
  `number_of_seats` int(11) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Reservations`
--

CREATE TABLE `Reservations` (
  `R_id` int(11) NOT NULL,
  `Bus_name` varchar(55) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `Number_of_seats` int(11) NOT NULL,
  `Payment` int(11) DEFAULT NULL,
  `U_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tourpackages`
--

CREATE TABLE `tourpackages` (
  `PID` int(11) NOT NULL,
  `PackageNumber` varchar(255) DEFAULT NULL,
  `PackageName` varchar(255) DEFAULT NULL,
  `PackageDestination` varchar(255) DEFAULT NULL,
  `PackagePrice` int(11) DEFAULT NULL,
  `PackageDuration` varchar(255) DEFAULT NULL,
  `Travellers` int(11) DEFAULT NULL,
  `ContactNumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tourpackage_order`
--

CREATE TABLE `tourpackage_order` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `MobileNumber` varchar(20) NOT NULL,
  `Nationality` varchar(100) NOT NULL,
  `PackageName` varchar(255) NOT NULL,
  `TravelDate` date NOT NULL,
  `NumberOfAdults` int(11) NOT NULL,
  `NumberOfChildren` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `mobile_number`, `username`, `email`, `password`) VALUES
(4, 'kamal sahabandu', 'kamal', 'kamal', 'kamal@mail.com', '$2y$10$U59Qbbxg7sN/mruwjD6Cu.fgY9NgozwoDdxsa9OsHYXQfbY0cjkF6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `highwaybusAdd`
--
ALTER TABLE `highwaybusAdd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD PRIMARY KEY (`R_id`),
  ADD KEY `U_id` (`U_id`);

--
-- Indexes for table `tourpackages`
--
ALTER TABLE `tourpackages`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `tourpackage_order`
--
ALTER TABLE `tourpackage_order`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `highwaybusAdd`
--
ALTER TABLE `highwaybusAdd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Reservations`
--
ALTER TABLE `Reservations`
  MODIFY `R_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tourpackages`
--
ALTER TABLE `tourpackages`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tourpackage_order`
--
ALTER TABLE `tourpackage_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`U_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
