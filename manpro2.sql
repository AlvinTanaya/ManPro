-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 08:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `waktuAntriTruk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`waktuAntriTruk`)),
  `rawDataName` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `namaSimul`, `isiGudang`, `waktuOperasiGudang`, `waktuAntriTruk`, `rawDataName`) VALUES
(1, 'Simul1', '[[1, 3, 5, 8], [2, 4], [6], [7, 9, 10]]', '[12, 6, 3, 9]', '[0, 0, 1, 0, 0, 0, 2, 1, 0, 0]', 'Data1'),
(2, 'Simul2', '[[1, 7, 9], [2], [5, 6], [3, 4, 8, 10]]', '[9, 3, 6, 12]', '[3, 0, 0, 1, 2, 0, 0, 0, 1, 0]', 'Data1');

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
(1, 'Data1', 4, '{\"1\":\"5\",\"2\":\"10\",\"3\":\"15\",\"4\":\"20\"}', 10, 50, '{\"1\":\"3\",\"2\":\"2\",\"3\":\"3\",\"4\":\"2\"}', '{\"1\":[\"0\",\"3.3\",\"1\",\"14:51:29\",\"3:28:46\",\"18:59:15\"],\"2\":[\"0\",\"3.2\",\"2\",\"5:9:10\",\"3:22:27\",\"9:9:37\"],\"3\":[\"1\",\"10.2\",\"1\",\"3:12:30\",\"2:57:36\",\"8:12:6\"],\"4\":[\"2\",\"10.9\",\"2\",\"1:8:11\",\"3:8:11\",\"6:26:22\"]}'),
(2, 'Data2', 4, '{\"1\":\"4\"}', 10, 30, '{\"1\":\"3\",\"2\":\"3\",\"3\":\"2\",\"4\":\"2\"}', '{\"1\":[\"0\",\"3.3\",\"1\",\"14:51:29\",\"3:28:46\",\"18:59:15\"],\"2\":[\"0\",\"3.2\",\"2\",\"5:9:10\",\"3:22:27\",\"9:9:37\"],\"3\":[\"1\",\"10.2\",\"1\",\"3:12:30\",\"2:57:36\",\"8:12:6\"],\"4\":[\"2\",\"10.9\",\"2\",\"1:8:11\",\"3:8:11\",\"6:26:22\"]}'),
(3, 'Data 3', 3, '{\"1\":\"5\",\"2\":\"10\",\"3\":\"20\"}', 4, 24, '{\"1\":\"2\",\"2\":\"1\",\"3\":\"1\"}', '{\"1\":[\"0\",\"3.3\",\"1\",\"14:51:29\",\"3:28:46\",\"18:59:15\"],\"2\":[\"0\",\"3.2\",\"2\",\"5:9:10\",\"3:22:27\",\"9:9:37\"],\"3\":[\"1\",\"10.2\",\"1\",\"3:12:30\",\"2:57:36\",\"8:12:6\"],\"4\":[\"2\",\"10.9\",\"2\",\"1:8:11\",\"3:8:11\",\"6:26:22\"]}');

-- --------------------------------------------------------

--
-- Table structure for table `simulasi`
--

CREATE TABLE `simulasi` (
  `id` int(11) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `jumlahGudang` int(11) NOT NULL,
  `spekGudang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`spekGudang`)),
  `rawDataName` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simulasi`
--

INSERT INTO `simulasi` (`id`, `namaSimul`, `jumlahGudang`, `spekGudang`, `rawDataName`) VALUES
(1, 'Simul1', 4, '[[1, 0, 0, 0], [0, 1, 0, 0], [0, 0, 1, 0], [0, 0, 0, 1]]', 'Data2'),
(2, 'Simul2', 4, '[[1, 1, 1, 1], [1, 1, 0, 0], [0, 0, 1, 1], [0, 0, 1, 1]]', 'Data1'),
(3, 'Simul3', 3, '[[1, 1, 0], [1, 0, 0], [0, 0, 1]]', 'Data1'),
(4, 'ayam22', 5, '[[1,0,0,0],[1,0,0,0],[1,0,1,0],[0,0,1,0],[0,0,1,0]]', 'Data1'),
(5, 'ayam223', 4, '[[1,0,1,0],[0,0,1,0],[0,0,1,0],[0,0,1,0]]', 'Data2');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `simulasi`
--
ALTER TABLE `simulasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
