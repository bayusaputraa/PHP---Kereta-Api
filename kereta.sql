-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 12:50 PM
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
-- Database: `kereta`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `Kode_Jadwal` int(11) NOT NULL,
  `Kode_Kereta` int(11) NOT NULL,
  `Kode_Rute` int(11) NOT NULL,
  `Waktu_Keberangkatan` datetime NOT NULL,
  `Waktu_Tiba` datetime NOT NULL,
  `Harga_Tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`Kode_Jadwal`, `Kode_Kereta`, `Kode_Rute`, `Waktu_Keberangkatan`, `Waktu_Tiba`, `Harga_Tiket`) VALUES
(1, 1, 1, '2024-01-02 17:11:00', '2024-01-02 17:17:00', 8000),
(2, 0, 1, '2024-01-02 17:50:00', '2024-01-02 18:11:00', 8000),
(3, 0, 3, '2024-01-02 17:52:00', '2024-01-02 17:58:00', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `kereta`
--

CREATE TABLE `kereta` (
  `Kode_Kereta` int(11) NOT NULL,
  `Nama_Kereta` varchar(255) NOT NULL,
  `Jenis_Kereta` varchar(255) NOT NULL,
  `Kapasitas_Kereta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kereta`
--

INSERT INTO `kereta` (`Kode_Kereta`, `Nama_Kereta`, `Jenis_Kereta`, `Kapasitas_Kereta`) VALUES
(0, 'Tegal Bahari', 'Bussines Suit', 200),
(1, 'Argo Cheribon', 'Economi Suit', 400),
(2, 'Argo Lawu', 'Bussines Suit', 400),
(3, 'Argo Bromo Angrek', 'Economi Suit', 100),
(4, 'Argo Parahiangan', 'Economi Suit', 100);

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `Kode_Rute` int(11) NOT NULL,
  `Kode_Stasiun_Asal` int(11) NOT NULL,
  `Kode_Stasiun_Tujuan` int(11) NOT NULL,
  `Jarak_KM` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`Kode_Rute`, `Kode_Stasiun_Asal`, `Kode_Stasiun_Tujuan`, `Jarak_KM`) VALUES
(1, 0, 2, 11),
(2, 3, 0, 17),
(3, 0, 1, 3),
(4, 0, 5, 132),
(5, 7, 0, 22),
(6, 0, 6, 25);

-- --------------------------------------------------------

--
-- Table structure for table `stasiun`
--

CREATE TABLE `stasiun` (
  `Kode_Stasiun` int(11) NOT NULL,
  `Nama_Stasiun` varchar(255) NOT NULL,
  `Lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stasiun`
--

INSERT INTO `stasiun` (`Kode_Stasiun`, `Nama_Stasiun`, `Lokasi`) VALUES
(0, 'ST.Bekasi', 'Kota Bekasi'),
(1, 'ST.Bekasi Timur', 'Kabupaten Bekasi'),
(2, 'ST.Cibitung', 'Kabupaten Bekasi'),
(3, 'ST.Cikarang', 'Kabupaten Bekasi'),
(4, 'ST.Telaga Murni', 'Kabupaten Bekasi'),
(5, 'ST.Bandung', 'Kota Bandung'),
(6, 'ST.Jayakarta', 'Jakarta Pusat'),
(7, 'ST.Manggarai', 'Jakarta Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Nama_User` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Nama_User`, `Password`, `Role`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Karyawan', '36e764683d2f839a237c1cb50b108d22', 'karyawan'),
(3, 'User', 'ee11cbb19052e40b07aac0ca060c23ee', 'user'),
(4, 'Bayu', 'a430e06de5ce438d499c2e4063d60fd6', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`Kode_Jadwal`),
  ADD KEY `Kode_Kereta` (`Kode_Kereta`),
  ADD KEY `Kode_Rute` (`Kode_Rute`);

--
-- Indexes for table `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`Kode_Kereta`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`Kode_Rute`),
  ADD KEY `Kode_Stasiun_Asal` (`Kode_Stasiun_Asal`),
  ADD KEY `Kode_Stasiun_Tujuan` (`Kode_Stasiun_Tujuan`);

--
-- Indexes for table `stasiun`
--
ALTER TABLE `stasiun`
  ADD PRIMARY KEY (`Kode_Stasiun`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`Kode_Kereta`) REFERENCES `kereta` (`Kode_Kereta`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`Kode_Rute`) REFERENCES `rute` (`Kode_Rute`);

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `rute_ibfk_1` FOREIGN KEY (`Kode_Stasiun_Asal`) REFERENCES `stasiun` (`Kode_Stasiun`),
  ADD CONSTRAINT `rute_ibfk_2` FOREIGN KEY (`Kode_Stasiun_Tujuan`) REFERENCES `stasiun` (`Kode_Stasiun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
