-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2018 at 05:56 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asp`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `image_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `image_text`) VALUES
(30, 'natural-disasters.jpg', 'A flood is an overflow of an expanse of water that submerges land, a deluge. It is usually due to the volume of water within a body of water, such as a river or lake, exceeding the total capacity of the body, and as a result some of the water flows or sits outside of the normal perimeter of the body. It can also occur in rivers, when the strength of the river is so high it flows right out of the river channel , usually at corners or meanders'),
(31, 'Ondoy_Urban.jpg', '2014.02.31  Rohingya refugees balance on bamboo as they try to cross a stream in Kutupalong, Cox\'s Bazar, Bangladesh on September 17, 2017.Paula Bronstein/Getty\r\nMany criticized the Indian government for not focusing more on preventative efforts to help with the annual flooding. \r\n\r\nThe monsoon rains also crippled people fleeing religious persecution in nearby Myanmar. The extra water made travel perilous for the nearly 400,000 Muslim Rohingya refugees who fled into Bangladesh. The United Nations calls the ongoing situation in Myanmar a \'textbook example\' of ethnic cleansing. \r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `markers_db`
--

CREATE TABLE `markers_db` (
  `id` int(11) NOT NULL,
  `Location` varchar(100) DEFAULT '',
  `Description` varchar(100) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL,
  `ThreatLevel` varchar(15) NOT NULL,
  `Submit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markers_db`
--

INSERT INTO `markers_db` (`id`, `Location`, `Description`, `lat`, `lng`, `type`, `ThreatLevel`, `Submit`) VALUES
(110, 'kottawa', 'car accident', 6.875983, 80.009651, 'Road Side Accidents', 'Medium', 1),
(127, 'frgreg', 'ggg', 6.928699, 79.875755, 'Fires', 'High', 1),
(130, 'dumbaaaa', 'dumba', 6.829352, 79.885025, 'Electrical Breakdown Leakages', 'High', 1);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `Occupation` varchar(30) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `ContactNumber` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`ID`, `Name`, `Department`, `Occupation`, `UserName`, `Password`, `Email`, `ContactNumber`) VALUES
(32, 'aa', 'grama nildari', 'ss', '1222', '1222', '1@1.com', '1234444'),
(42, 'admin', 'admin', 'admin', 'admin', '555', 'admin@admin.com', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markers_db`
--
ALTER TABLE `markers_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `markers_db`
--
ALTER TABLE `markers_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
