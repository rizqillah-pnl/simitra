-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2022 pada 10.34
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `auth`
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
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`Kode_petugas`, `Username`, `Email`, `Password`, `Old_password`, `Last_login`, `Created_at`, `Updated_at`) VALUES
(1, 'ila', 'rahmaini@gmail.com', 'aafe26449a364e5d6b5db7dc565a9b6a', 'aafe26449a364e5d6b5db7dc565a9b6a', '2022-08-01 13:54:02', '2022-07-08 07:55:50', '2022-07-27 15:44:10'),
(2, 'rizqillah', 'rizqillah531@gmail.com', 'aafe26449a364e5d6b5db7dc565a9b6a', NULL, '2022-07-30 16:51:04', '2022-07-08 07:55:50', '2022-07-30 14:50:32'),
(23, 'admin', 'admin@geobase.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '2022-08-01 14:18:18', '2022-07-19 07:41:01', '2022-07-28 08:37:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `Id_jabatan` int(11) NOT NULL,
  `Jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`Id_jabatan`, `Jabatan`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
--

CREATE TABLE `lowongan` (
  `id` int(11) NOT NULL,
  `jenis_lowongan` varchar(200) NOT NULL,
  `tanggal` varchar(200) NOT NULL,
  `persyaratan` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`id`, `jenis_lowongan`, `tanggal`, `persyaratan`, `deskripsi`) VALUES
(1, 'Survei Ekonomi', '21 Agustus - 8 September 2022', 'adas', 'asdasdas'),
(2, 'Survei Pertanian', '15 Januari - 28 Maret 2023', 'asdsad', 'assdasads'),
(3, 'Sensus penduduk', '15 Maret - 20 Juni 2022', 'asdasd', 'asdsa'),
(4, 'Survei Pekerjaan', '20 Juli - 1 September 2022', 'dsadsad', 'asdasd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
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
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`Kode_petugas`, `NIK`, `Nama`, `Foto`, `Jabatan`, `Tempat_lahir`, `Tanggal_lahir`, `Alamat`, `NoHP`, `Jkel`) VALUES
(1, NULL, 'Rahmaini', NULL, 2, NULL, NULL, NULL, NULL, 'P'),
(23, NULL, 'Admin', NULL, 1, NULL, NULL, NULL, NULL, 'L');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`Kode_petugas`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`Id_jabatan`);

--
-- Indeks untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`Kode_petugas`),
  ADD KEY `Jabatan` (`Jabatan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `Kode_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `Id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `Auth` FOREIGN KEY (`Kode_petugas`) REFERENCES `auth` (`Kode_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Jabatan` FOREIGN KEY (`Jabatan`) REFERENCES `jabatan` (`Id_jabatan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
