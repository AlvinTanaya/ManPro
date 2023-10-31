-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 02:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manpro2`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `isiGudang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`isiGudang`)),
  `waktuOperasiGudang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`waktuOperasiGudang`)),
  `waktuAntriTruk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`waktuAntriTruk`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `namaSimul`, `isiGudang`, `waktuOperasiGudang`, `waktuAntriTruk`) VALUES
(1, 'Simul1', '[[1, 3, 5, 8], [2, 4], [6], [7, 9, 10]]', '[12, 6, 3, 9]', '[0, 0, 1, 0, 0, 0, 2, 1, 0, 0]'),
(2, 'Simul2', '[[1, 7, 9], [2], [5, 6], [3, 4, 8, 10]]', '[9, 3, 6, 12]', '[3, 0, 0, 1, 2, 0, 0, 0, 1, 0]');

-- --------------------------------------------------------

--
-- Table structure for table `rawdata`
--

CREATE TABLE `rawdata` (
  `id` int(11) NOT NULL,
  `rawDataName` varchar(300) NOT NULL,
  `jumlahArea` int(11) NOT NULL,
  `rangeJarak` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`rangeJarak`)),
  `totalTruk` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `persentaseTruk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`persentaseTruk`)),
  `detailTruk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`detailTruk`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rawdata`
--

INSERT INTO `rawdata` (`id`, `rawDataName`, `jumlahArea`, `rangeJarak`, `totalTruk`, `durasi`, `persentaseTruk`, `detailTruk`) VALUES
(1, 'Data1', 4, '[5,10,15,20]', 10, 50, '[3, 2, 3, 2]', '[0, 4.2, 3, \"07:11:53\", \"11:35:32\", \"01:23:39\"]'),
(2, 'Data2', 4, '', 10, 30, '[3, 3, 2, 2]', '[1, 9.6, 4, \"12:12:51\", \"15:16:19\", \"00:03:28\"]');

-- --------------------------------------------------------

--
-- Table structure for table `simulasi`
--

CREATE TABLE `simulasi` (
  `id` int(11) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `jumlahGudang` int(11) NOT NULL,
  `spekGudang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`spekGudang`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simulasi`
--

INSERT INTO `simulasi` (`id`, `namaSimul`, `jumlahGudang`, `spekGudang`) VALUES
(1, 'Simul1', 4, '[[1, 0, 0, 0], [0, 1, 0, 0], [0, 0, 1, 0], [0, 0, 0, 1]]'),
(2, 'Simul2', 4, '[[1, 1, 1, 1], [1, 1, 0, 0], [0, 0, 1, 1], [0, 0, 1, 1]]'),
(3, 'Simul3', 3, '[[1, 1, 0], [1, 0, 0], [0, 0, 1]]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rawdata`
--
ALTER TABLE `rawdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simulasi`
--
ALTER TABLE `simulasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rawdata`
--
ALTER TABLE `rawdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `simulasi`
--
ALTER TABLE `simulasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
