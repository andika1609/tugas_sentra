-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 18, 2022 at 04:09 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `input_aspirasi`
--

CREATE TABLE `input_aspirasi` (
  `id_pelaporan` int(11) NOT NULL,
  `id_pelapor` int(11) NOT NULL,
  `jenis_aspirasi` varchar(25) NOT NULL,
  `laporan` text NOT NULL,
  `waktu_laporan` datetime NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `id_pelapor`, `jenis_aspirasi`, `laporan`, `waktu_laporan`, `gambar`) VALUES
(9, 101, '2', 'Test', '2022-09-18 11:34:51', NULL),
(10, 101, '2', 'Testtt', '2022-09-18 11:39:19', NULL),
(11, 103, '2', 'Test_3', '2022-09-18 11:42:56', 'uploads/image-_6326a1d092bc58.42241599.jpg'),
(12, 103, '1', 'Fahmi mencuri', '2022-09-20 07:20:09', 'uploads/image-_6329073947bdc9.80819914.png'),
(13, 101, '2', 'Test_3', '2022-10-04 09:30:14', NULL),
(14, 101, '2', 'Kotor di daerah blabal', '2022-10-04 09:33:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nama_penduduk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nama_penduduk`) VALUES
(101, 'ANDIKANAJMI LEVI MAHESWARA'),
(103, 'BUDI SANTOSO');

-- --------------------------------------------------------

--
-- Table structure for table `status_aspirasi`
--

CREATE TABLE `status_aspirasi` (
  `id_laporan` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT '1',
  `status` varchar(25) NOT NULL DEFAULT 'Dilaporkan',
  `nilai` int(11) DEFAULT NULL,
  `ulasan` text,
  `gambar_bukti` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_aspirasi`
--

INSERT INTO `status_aspirasi` (`id_laporan`, `id_status`, `status`, `nilai`, `ulasan`, `gambar_bukti`) VALUES
(9, 3, 'Selesai', NULL, NULL, NULL),
(10, 1, 'Dilaporkan', NULL, NULL, NULL),
(11, 3, 'Selesai', NULL, NULL, NULL),
(12, 1, 'Dilaporkan', NULL, NULL, NULL),
(13, 1, 'Dilaporkan', NULL, NULL, NULL),
(14, 1, 'Dilaporkan', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passkey` varchar(20) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passkey`, `role`) VALUES
(1, 'admin', 'admin', 0),
(2, 'user', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `id_pelapor` (`id_pelapor`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indexes for table `status_aspirasi`
--
ALTER TABLE `status_aspirasi`
  ADD UNIQUE KEY `id_laporan` (`id_laporan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  MODIFY `id_pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD CONSTRAINT `input_aspirasi_ibfk_1` FOREIGN KEY (`id_pelapor`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `status_aspirasi`
--
ALTER TABLE `status_aspirasi`
  ADD CONSTRAINT `status_aspirasi_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `input_aspirasi` (`id_pelaporan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
