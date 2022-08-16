-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2022 pada 06.04
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `Kode_petugas` int(10) NOT NULL,
  `Id_jabatan` int(11) NOT NULL,
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

INSERT INTO `auth` (`Kode_petugas`, `Id_jabatan`, `Username`, `Email`, `Password`, `Old_password`, `Last_login`, `Created_at`, `Updated_at`) VALUES
(1, 1, 'ila', 'rahmaini@gmail.com', 'aafe26449a364e5d6b5db7dc565a9b6a', 'aafe26449a364e5d6b5db7dc565a9b6a', '2022-08-15 10:54:45', '2022-07-08 07:55:50', '2022-07-27 15:44:10'),
(23, 0, 'admin', 'admin@geobase.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '2022-08-15 21:39:12', '2022-07-19 07:41:01', '2022-08-02 09:44:26'),
(57, 0, 'rizqillah', NULL, 'aafe26449a364e5d6b5db7dc565a9b6a', NULL, '2022-08-02 09:18:43', '2022-08-02 08:16:07', NULL),
(62, 0, 'sqxa', NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, '2022-08-13 20:32:16', '2022-08-13 20:32:16', NULL),
(63, 0, 'srs', NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, '2022-08-13 20:39:14', '2022-08-13 20:39:14', NULL),
(64, 0, 'survei', NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, '2022-08-13 20:43:56', '2022-08-13 20:43:56', NULL),
(65, 0, 'er', NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, '2022-08-13 20:44:29', '2022-08-13 20:44:29', NULL),
(66, 0, 'asa', NULL, '457391c9c82bfdcbb4947278c0401e41', NULL, '2022-08-14 20:19:04', '2022-08-14 20:19:04', NULL),
(67, 0, 'rizka', 'rizkarahmadini13@gmail.com', 'aef2c231d5e776c0e0656eaf68767848', NULL, '2022-08-16 11:02:41', '2022-08-15 11:00:45', '2022-08-15 21:42:35');

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
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kec` varchar(6) NOT NULL,
  `nama_kec` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kec`, `nama_kec`) VALUES
('010', 'SAWANG'),
('020', 'NISAM'),
('021', 'NISAM ANTARA'),
('022', 'BANDA BARO'),
('030', 'KUTAMAKMUR'),
('031', 'SIMPANG KEURAMAT'),
('040', 'SYAMTALIRA BAYU'),
('041', 'GEUREUDONG PASE'),
('050', 'MEURAH MULIA'),
('060', 'MATANGKULI'),
('061', 'PAYABAKONG'),
('062', 'PIRAK TIMU'),
('070', 'COT GIREK'),
('080', 'TANAH JAMBO AYE'),
('081', 'LANGKAHAN'),
('090', 'SEUNUDDON'),
('100', 'BAKTIYA'),
('101', 'BAKTIYA BARAT'),
('110', 'LHOKSUKON'),
('120', 'TANAH LUAS'),
('121', 'NIBONG'),
('130', 'SAMUDERA'),
('140', 'SYAMTALIRA ARON'),
('150', 'TANAH PASIR'),
('151', 'LAPANG'),
('160', 'MUARA SATU'),
('170', 'DEWANTARA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
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
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`id`, `jenis_lowongan`, `tanggal_mulai`, `tanggal_akhir`, `persyaratan`, `deskripsi`, `gambar`) VALUES
(1, 'Survei Ekonomi', '2022-01-11', '2022-01-26', 'adas', 'asdasdas', '4.png'),
(3, 'Sensus penduduk', '2022-08-03', '2022-08-12', 'asdasd', 'asdsa', '5.png'),
(4, 'Survei Pekerjaan', '2022-08-01', '2022-09-10', 'dsadsad', 'asdasd', '27.png'),
(5, 'Survei SBH', '2022-08-01', '2022-09-01', 'sdaasdasd', 'sadsadasd', '103.png');

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
(23, '2132132132', 'Admin', NULL, 1, '', '0000-00-00', '', '', 'L'),
(57, NULL, 'rizqillah', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(67, '1408105309010001', 'Rizka', '2022-08-15 21-42-35line_1045775003259953-min.jpg', 2, '', '2022-08-17', '', '081364011325', 'L');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lowongan_user`
--

CREATE TABLE `tb_lowongan_user` (
  `id` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `id_petugas` int(12) NOT NULL,
  `id_kec` varchar(6) CHARACTER SET latin1 NOT NULL,
  `tanggal_daftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_lowongan_user`
--

INSERT INTO `tb_lowongan_user` (`id`, `id_lowongan`, `id_petugas`, `id_kec`, `tanggal_daftar`) VALUES
(1, 3, 57, '010', '2022-08-16 05:17:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`Kode_petugas`),
  ADD KEY `Id_jabatan` (`Id_jabatan`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`Id_jabatan`),
  ADD KEY `Id_jabatan` (`Id_jabatan`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kec`) USING BTREE;

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
-- Indeks untuk tabel `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lowongan` (`id_lowongan`),
  ADD KEY `petugas_lowongan` (`id_petugas`),
  ADD KEY `id_kec` (`id_kec`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `Kode_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `Id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `Auth` FOREIGN KEY (`Kode_petugas`) REFERENCES `auth` (`Kode_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Jabatan` FOREIGN KEY (`Jabatan`) REFERENCES `jabatan` (`Id_jabatan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  ADD CONSTRAINT `lowongan` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_lowongan` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`Kode_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_lowongan_user_ibfk_1` FOREIGN KEY (`id_kec`) REFERENCES `kecamatan` (`id_kec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_lowongan_user_ibfk_2` FOREIGN KEY (`id_kec`) REFERENCES `kecamatan` (`id_kec`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
