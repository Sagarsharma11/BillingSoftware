-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2021 at 12:48 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BillingSoftware`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` double NOT NULL,
  `metal` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `UID` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `makingcharge` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `item`, `quantity`, `weight`, `metal`, `total`, `UID`, `date`, `makingcharge`) VALUES
(71, 'NECKLET', 1, 1.5, 'gold (22C)', 10000, '2VXh^', '2021-08-11', 10),
(72, 'NECKLET', 1, 1, 'gold (24C)', 10000, 'E2Il0', '2021-08-11', 10),
(73, 'RING', 1, 1, 'gold (22C)', 10000, 'E2Il0', '2021-08-11', 10),
(74, 'NOSE RING', 1, 1, 'silver', 10000, 'E2Il0', '2021-08-11', 156);

-- --------------------------------------------------------

--
-- Table structure for table `custmor`
--

CREATE TABLE `custmor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `UID` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `payment` varchar(255) NOT NULL,
  `gst` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custmor`
--

INSERT INTO `custmor` (`id`, `name`, `address`, `phone`, `UID`, `date`, `payment`, `gst`) VALUES
(106, 'Abhishek Sharma', 'Ratna Plaza, Near Mai Asthan, Muzaffarpur', '9931668053', '2VXh^', '2021-08-11', 'Creadit Card', 'no'),
(107, 'Raj Kumar', 'Ratna Plaza, Near Mai Asthan, Muzaffarpur', '9931668053', 'E2Il0', '2021-08-11', 'Debit Card', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `checked` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item`, `category`, `checked`) VALUES
(4, 'Necklet', 'wellary', 'yes'),
(5, 'Ring', 'Jwellary', 'yes'),
(6, 'NOSE RING', 'Jwellary', 'yes'),
(7, 'Gold Braclet', 'Jwellary', 'no'),
(8, 'Baala', 'Jwellary', 'no'),
(10, 'mnew item', 'jwellary', 'no'),
(11, 'bhvhg', 'Jwellary', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `metal`
--

CREATE TABLE `metal` (
  `id` int(11) NOT NULL,
  `metal` varchar(255) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metal`
--

INSERT INTO `metal` (`id`, `metal`, `price`) VALUES
(9, 'gold (24C)', 4781),
(10, 'gold (18C)', 3000),
(11, 'gold (22C)', 4200),
(12, 'silver', 63.6),
(13, 'platinum', 2345.21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custmor`
--
ALTER TABLE `custmor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal`
--
ALTER TABLE `metal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `custmor`
--
ALTER TABLE `custmor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `metal`
--
ALTER TABLE `metal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
