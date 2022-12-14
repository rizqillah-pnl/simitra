-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2022 at 02:43 PM
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
(1, 'ila', 'rahmaini@gmail.com', 'aafe26449a364e5d6b5db7dc565a9b6a', 'aafe26449a364e5d6b5db7dc565a9b6a', '2022-08-16 10:59:01', '2022-07-08 07:55:50', '2022-08-16 10:58:52'),
(23, 'admin', 'admin@geobase.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '2022-08-16 10:59:17', '2022-07-19 07:41:01', '2022-08-02 09:44:26'),
(57, 'rizqillah', NULL, 'aafe26449a364e5d6b5db7dc565a9b6a', NULL, '2022-08-02 09:18:43', '2022-08-02 08:16:07', NULL);

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
  `deskripsi` text NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id`, `jenis_lowongan`, `tanggal_mulai`, `tanggal_akhir`, `persyaratan`, `deskripsi`, `gambar`) VALUES
(1, 'Survei Ekonomi', '2022-01-11', '2022-01-26', 'adas', 'asdasdas', '4.png'),
(2, 'Survei Pertanian', '2022-01-02', '2022-08-24', 'asdsad', 'assdasads', '13.png'),
(3, 'Sensus penduduk', '2022-08-03', '2022-08-12', 'asdasd', 'asdsa', '5.png'),
(4, 'Survei Pekerjaan', '2022-08-01', '2022-09-10', 'dsadsad', 'asdasd', '27.png'),
(5, 'Survei SBH', '2022-08-01', '2022-09-01', 'sdaasdasd', 'sadsadasd', '103.png'),
(6, 'asdsa', '2022-08-09', '2022-08-24', 'sadasda', 'asdasdas', '15-08-2022 15-29-04DFD - Project BPS.drawio (4).png');

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
(1, '1108080503010003', 'Rahmaini', '2022-08-16 10-58-52IMG_1029.jpg', 2, '', '0000-00-00', '', '', 'P'),
(23, '2132132132', 'Admin', NULL, 1, '', '0000-00-00', '', '', 'L'),
(57, NULL, 'rizqillah', NULL, 2, NULL, NULL, NULL, NULL, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kecamatan`
--

CREATE TABLE `tb_kecamatan` (
  `id` int(11) NOT NULL,
  `nama_kec` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kecamatan`
--

INSERT INTO `tb_kecamatan` (`id`, `nama_kec`) VALUES
(1111010, 'Sawang'),
(1111020, 'Nisam'),
(1111021, 'Nisam Antara'),
(1111022, 'Banda Baro'),
(1111030, 'Kuta Makmur'),
(1111031, 'Simpang Keramat'),
(1111040, 'Syamtalira Bayu'),
(1111041, 'Geureudong Pase'),
(1111050, 'Meurah Mulia'),
(1111060, 'Matangkuli'),
(1111061, 'Paya Bakong'),
(1111062, 'Pirak Timu'),
(1111070, 'Cot Girek'),
(1111080, 'Tanah Jambo Aye'),
(1111081, 'Langkahan'),
(1111090, 'Seunuddon'),
(1111100, 'Baktiya'),
(1111101, 'Baktiya Barat'),
(1111110, 'Lhoksukon'),
(1111120, 'Tanah Luas'),
(1111121, 'Nibong'),
(1111130, 'Samudera'),
(1111140, 'Syamtalira Aron'),
(1111150, 'Tanah Pasir'),
(1111151, 'Lapang'),
(1111160, 'Muara Batu'),
(1111170, 'Dewantara');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lowongan_user`
--

CREATE TABLE `tb_lowongan_user` (
  `id` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `id_petugas` int(12) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `id_kec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kec_hub` (`id_kec`),
  ADD KEY `lowongan_hub` (`id_lowongan`),
  ADD KEY `petugas_hub` (`id_petugas`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `kec_hub` FOREIGN KEY (`id_kec`) REFERENCES `tb_kecamatan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lowongan_hub` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_hub` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`Kode_petugas`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
