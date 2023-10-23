-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2023 at 04:19 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `namaGudang` varchar(300) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `khusus` varchar(300) NOT NULL,
  `isiGudang` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `namaGudang`, `namaSimul`, `khusus`, `isiGudang`) VALUES
(1, '0', '2', '0', '11'),
(2, '0', '2', '0', '12'),
(3, '0', '2', '0', '21'),
(4, '0', '2', '0', '22'),
(5, 'gudang1', '121', '0', '11'),
(6, 'gudang1', '121', '1', '12'),
(7, 'gudang2', '121', '0', '21'),
(8, 'gudang2', '121', '1', '22'),
(9, 'gudang1', '12312', '1', '11'),
(10, 'gudang1', '12312', '0', '12'),
(11, 'gudang2', '12312', '1', '21'),
(12, 'gudang2', '12312', '1', '22'),
(13, 'gudang1', '213212515', '1', '11'),
(14, 'gudang2', '213212515', '0', '21'),
(15, 'gudang1', '123132', '1', '11'),
(16, 'gudang1', '123132', '0', '12'),
(17, 'gudang1', '21231', '1', '11'),
(18, 'gudang1', '12313145215', '1', '11');

-- --------------------------------------------------------

--
-- Table structure for table `jarak`
--

CREATE TABLE `jarak` (
  `id` int(11) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `jarakAwal` varchar(300) NOT NULL,
  `jarakAkhir` varchar(300) NOT NULL,
  `isiTruck` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jarak`
--

INSERT INTO `jarak` (`id`, `namaSimul`, `jarakAwal`, `jarakAkhir`, `isiTruck`) VALUES
(1, '121', '2', '2', '2'),
(2, '121', '2', '2', '2'),
(3, '12312', '2', '2', '2'),
(4, '12312', '2', '2', '2'),
(5, '213212515', '2', '3', '3'),
(6, '123132', '2', '2', '2'),
(7, '123132', '2', '2', '2'),
(8, '21231', '1', '1', '1'),
(9, '12313145215', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `simul`
--

CREATE TABLE `simul` (
  `id` int(11) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `waktuLoading` int(11) NOT NULL,
  `durasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simul`
--

INSERT INTO `simul` (`id`, `nama`, `waktuLoading`, `durasi`) VALUES
(3, '', 0, 0),
(4, '2', 2, 2),
(5, '121', 2, 2),
(6, '12312', 2, 2),
(7, '213212515', 1, 2),
(8, '123132', 1, 1),
(9, '21231', 1, 1),
(10, '12313145215', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

CREATE TABLE `truck` (
  `id` int(11) NOT NULL,
  `namaTruck` varchar(300) NOT NULL,
  `namaSimul` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `truck`
--

INSERT INTO `truck` (`id`, `namaTruck`, `namaSimul`) VALUES
(1, 'truck.1', '12312'),
(2, 'truck.2', '12312'),
(3, 'truck1', '213212515'),
(4, 'truck1', '123132'),
(5, 'truck2', '123132'),
(6, 'truck1', '21231'),
(7, 'truck1', '12313145215');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jarak`
--
ALTER TABLE `jarak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simul`
--
ALTER TABLE `simul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truck`
--
ALTER TABLE `truck`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jarak`
--
ALTER TABLE `jarak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `simul`
--
ALTER TABLE `simul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `truck`
--
ALTER TABLE `truck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
