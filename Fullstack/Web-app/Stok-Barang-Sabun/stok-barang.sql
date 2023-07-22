-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 12 Jul 2023 pada 22.51
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stok-barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `qty`) VALUES
(2, 19, '2023-05-21 17:55:44', 120),
(3, 16, '2023-06-30 14:26:52', 5),
(4, 16, '2023-07-11 15:59:22', 14),
(5, 21, '2023-07-12 19:55:39', 5),
(6, 22, '2023-07-12 19:59:06', 50),
(7, 22, '2023-07-12 19:59:18', 20),
(8, 22, '2023-07-12 19:59:26', 29),
(9, 23, '2023-07-12 20:04:14', 15),
(10, 25, '2023-07-12 20:46:32', 200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'sukalaper@space.com', '123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `qty`) VALUES
(30, 18, '2023-05-21 17:49:06', 4),
(31, 19, '2023-05-21 17:54:29', 100),
(32, 16, '2023-07-11 15:59:05', 10),
(33, 20, '2023-07-12 19:54:29', 100),
(34, 21, '2023-07-12 19:55:29', 12),
(35, 23, '2023-07-12 20:04:07', 10),
(36, 24, '2023-07-12 20:20:32', 100),
(37, 25, '2023-07-12 20:46:23', 500),
(38, 26, '2023-07-12 20:47:23', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(35) DEFAULT NULL,
  `satuanberat` int(11) NOT NULL,
  `jumlahbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`idbarang`, `namabarang`, `satuanberat`, `jumlahbarang`, `tanggal`) VALUES
(26, 'Daia', 700, 2, '2023-07-12 20:47:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
