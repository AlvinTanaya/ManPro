-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 04:40 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `namaGudang`, `namaSimul`, `khusus`, `isiGudang`) VALUES
(1, 'gudang1', 'Coba1', '0', '11'),
(2, 'gudang1', '2', '1', '11'),
(3, 'gudang1', '3', '1', '11');

-- --------------------------------------------------------

--
-- Table structure for table `jarak`
--

CREATE TABLE `jarak` (
  `id` int(11) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `jarakAwal` varchar(300) NOT NULL,
  `jarakAkhir` varchar(300) NOT NULL,
  `namaTruck` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jarak`
--

INSERT INTO `jarak` (`id`, `namaSimul`, `jarakAwal`, `jarakAkhir`, `namaTruck`) VALUES
(1, 'Coba1', '', '', ''),
(2, '2', '', '', ''),
(3, '3', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `simul`
--

CREATE TABLE `simul` (
  `id` int(11) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `waktuLoading` int(11) NOT NULL,
  `durasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simul`
--

INSERT INTO `simul` (`id`, `nama`, `waktuLoading`, `durasi`) VALUES
(1, 'Coba1', 1, 2),
(2, '2', 1, 1),
(3, '3', 1, 1);


-- --------------------------------------------------------

--
-- Table structure for table `random`
--

CREATE TABLE `random` (
  `id` int(11) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `jumlahTruk` int(11) NOT NULL,
  `infoTruk` JSON NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `random`
--

INSERT INTO `random` (`id`, `namaSimul`, `jumlahTruk`, `infoTruk`) VALUES
(1, 'Coba1', 10, JSON_ARRAY(1, '20:00:00', 0)),
(2, 'Coba2', 15, JSON_ARRAY(2, '21:00:00', 1)),
(3, 'Coba3', 20, JSON_ARRAY(3, '22:00:00', 2));


-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `delay` int(11) NOT NULL,
  `jumlahTerima` int(11) NOT NULL,
  `jumlahTolak` int(11) NOT NULL,
  `jumlahGudang` int(11) NOT NULL,
  `khusus` JSON NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `namaSimul`, `delay`, `jumlahTerima`, `jumlahTolak`, `jumlahGudang`, `khusus`) VALUES
(1, 'Coba1', 5, 10, 0, 4, JSON_ARRAY(1, 0)),
(2, 'Coba2', 6, 10, 1, 4, JSON_ARRAY(2, 1)),
(3, 'Coba3', 7, 10, 2, 4, JSON_ARRAY(3, 2));


-- --------------------------------------------------------

--
-- Table structure for table `range`
--

CREATE TABLE `range` (
  `id` int(11) NOT NULL,
  `namaSimul` varchar(300) NOT NULL,
  `range_jarak` JSON NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `range`
--

INSERT INTO `range` (`id`, `namaSimul`, `range_jarak`) VALUES
(1, 'Coba1', JSON_ARRAY(0, 5)),
(2, 'Coba1', JSON_ARRAY(6, 10)),
(3, 'Coba1', JSON_ARRAY(11, 15));

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
-- Indexes for table `random`
--
ALTER TABLE `random`
  ADD PRIMARY KEY (`id`);


--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);


--
-- Indexes for table `range`
--
ALTER TABLE `range`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jarak`
--
ALTER TABLE `jarak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `simul`
--
ALTER TABLE `simul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `random`
--
ALTER TABLE `random`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


--
-- AUTO_INCREMENT for table `range`
--
ALTER TABLE `range`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
