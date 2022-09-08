-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Apr 2019 pada 12.02
-- Versi Server: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sewa_mobil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE IF NOT EXISTS `mobil` (
  `kd_mobil` varchar(10) NOT NULL,
  `nama_mobil` varchar(10) NOT NULL,
  `bahan_bakar` varchar(10) NOT NULL,
  `tipe_transmisi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`kd_mobil`, `nama_mobil`, `bahan_bakar`, `tipe_transmisi`) VALUES
('001', 'Avanza', 'Pertamax', 'Manual'),
('002', 'Kijang', 'Pertalite', 'Manual'),
('003', 'Honda Bria', 'Pertamax', 'Matic');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `ktp` varchar(20) NOT NULL,
  `sim` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(70) NOT NULL,
  `no_telp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`ktp`, `sim`, `nama`, `alamat`, `no_telp`) VALUES
('1212123434341212', '0909989887872112', 'tyty', 'haha', '082112232121'),
('1212123434344545', '1212123434344545', 'sulung', 'jalanin aja', '021344543454'),
('3175092609920002', '0909989887872114', 'repi', 'jl.pejaten', '021344543454'),
('3175092609920003', '0909989887872112', 'tyty', 'hhhaha', '082112232121');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sewa`
--

CREATE TABLE IF NOT EXISTS `sewa` (
  `kd_mobil` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `hargaj` int(11) NOT NULL,
  `jangka_sewa` tinyint(4) NOT NULL,
  `tgl_sewa` date NOT NULL,
  `jam_sewa` time NOT NULL,
  `ktp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sewa`
--

INSERT INTO `sewa` (`kd_mobil`, `harga`, `hargaj`, `jangka_sewa`, `tgl_sewa`, `jam_sewa`, `ktp`) VALUES
('', 250000, 0, 2, '2019-04-15', '16:32:41', '3175092609920003'),
('', 270000, 0, 2, '2019-04-15', '21:35:05', '1010101012121212'),
('', 270000, 0, 2, '2019-04-15', '21:41:03', '3175092609920002'),
('', 250000, 0, 1, '2019-04-16', '12:25:03', '1212121212121212'),
('', 250000, 0, 1, '2019-04-16', '16:31:47', '3175092609922203'),
('', 250000, 0, 2, '2019-04-24', '10:17:33', '6576566565676567'),
('', 250000, 0, 3, '2019-04-24', '16:58:45', '1212123434344545');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'rahasia'),
('amin', '123'),
('asli', 'mari'),
('caruy', '12'),
('catur', '1212'),
('excel', '121212'),
('qwqw', 'qwqw'),
('rede', '1212'),
('solo', '123123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
 ADD PRIMARY KEY (`kd_mobil`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
 ADD PRIMARY KEY (`ktp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
