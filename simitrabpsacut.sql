-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2022 at 09:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simitrabpsacut`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `Kode_petugas` int(10) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(50) NOT NULL,
  `Old_password` varchar(50) DEFAULT NULL,
  `Last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `Created_at` datetime NOT NULL,
  `Updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`Kode_petugas`, `Username`, `Email`, `Password`, `Old_password`, `Last_login`, `Created_at`, `Updated_at`) VALUES
(1, 'ila', 'rahmaini@gmail.com', 'aafe26449a364e5d6b5db7dc565a9b6a', 'aafe26449a364e5d6b5db7dc565a9b6a', '2022-08-01 13:54:02', '2022-07-08 07:55:50', '2022-07-27 15:44:10'),
(23, 'admin', 'admin@geobase.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '2022-08-01 14:18:18', '2022-07-19 07:41:01', '2022-07-28 08:37:36'),
(57, 'rizqillah', NULL, 'aafe26449a364e5d6b5db7dc565a9b6a', NULL, '2022-08-02 09:15:44', '2022-08-02 08:16:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `Id_jabatan` int(11) NOT NULL,
  `Jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`Id_jabatan`, `Jabatan`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id` int(11) NOT NULL,
  `jenis_lowongan` varchar(200) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `persyaratan` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id`, `jenis_lowongan`, `tanggal_mulai`, `tanggal_akhir`, `persyaratan`, `deskripsi`) VALUES
(1, 'Survei Ekonomi', '2022-01-11', '2022-01-26', 'adas', 'asdasdas'),
(2, 'Survei Pertanian', '2022-01-02', '2022-08-24', 'asdsad', 'assdasads'),
(3, 'Sensus penduduk', '2022-08-03', '2022-08-12', 'asdasd', 'asdsa'),
(4, 'Survei Pekerjaan', '2022-08-01', '2022-09-10', 'dsadsad', 'asdasd'),
(5, 'Survei SBH', '2022-08-01', '2022-09-01', 'sdaasdasd', 'sadsadasd');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `Kode_petugas` int(12) NOT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `Nama` varchar(50) NOT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Jabatan` int(5) NOT NULL,
  `Tempat_lahir` varchar(150) DEFAULT NULL,
  `Tanggal_lahir` date DEFAULT NULL,
  `Alamat` varchar(150) DEFAULT NULL,
  `NoHP` varchar(15) DEFAULT NULL,
  `Jkel` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`Kode_petugas`, `NIK`, `Nama`, `Foto`, `Jabatan`, `Tempat_lahir`, `Tanggal_lahir`, `Alamat`, `NoHP`, `Jkel`) VALUES
(1, NULL, 'Rahmaini', NULL, 2, NULL, NULL, NULL, NULL, 'P'),
(23, NULL, 'Admin', NULL, 1, NULL, NULL, NULL, NULL, 'L'),
(57, NULL, 'rizqillah', NULL, 2, NULL, NULL, NULL, NULL, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lowongan_user`
--

CREATE TABLE `tb_lowongan_user` (
  `id` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `id_petugas` int(12) NOT NULL,
  `tanggal_daftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_lowongan_user`
--

INSERT INTO `tb_lowongan_user` (`id`, `id_lowongan`, `id_petugas`, `tanggal_daftar`) VALUES
(1, 1, 57, '2022-08-02 09:10:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`Kode_petugas`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`Id_jabatan`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`Kode_petugas`),
  ADD KEY `Jabatan` (`Jabatan`);

--
-- Indexes for table `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lowongan` (`id_lowongan`),
  ADD KEY `petugas_lowongan` (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `Kode_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `Id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `Auth` FOREIGN KEY (`Kode_petugas`) REFERENCES `auth` (`Kode_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Jabatan` FOREIGN KEY (`Jabatan`) REFERENCES `jabatan` (`Id_jabatan`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  ADD CONSTRAINT `lowongan` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_lowongan` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`Kode_petugas`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
