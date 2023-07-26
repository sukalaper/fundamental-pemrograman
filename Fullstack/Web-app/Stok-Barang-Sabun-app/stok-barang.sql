-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 26 Jul 2023 pada 21.39
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
(48, 43, '2023-07-25 12:37:18', 1),
(49, 44, '2023-07-25 12:37:25', 200),
(50, 47, '2023-07-25 19:39:52', 2),
(51, 48, '2023-07-25 19:40:05', 2),
(52, 47, '2023-07-25 19:45:00', 12),
(53, 52, '2023-07-26 08:27:50', 22),
(54, 7, '2023-07-26 03:42:12', 12),
(55, 13, '2023-07-26 19:15:09', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `idbarang` int(11) NOT NULL,
  `namabarang` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `hargamodal` decimal(10,3) NOT NULL,
  `satuanberat` int(11) NOT NULL,
  `jumlahbarang` int(11) NOT NULL,
  `hargajual` decimal(10,3) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`idbarang`, `namabarang`, `hargamodal`, `satuanberat`, `jumlahbarang`, `hargajual`, `tanggal`) VALUES
(1, 'Sabun Mandi A', '3.000', 10, 4, '5.000', '2023-07-25 17:00:00'),
(2, 'Shampoo A', '4.000', 11, 5, '6.000', '2023-07-25 17:00:00'),
(3, 'Sabun Mandi B', '5.000', 12, 6, '7.000', '2023-07-25 17:00:00'),
(4, 'Shampoo B', '6.000', 13, 7, '8.000', '2023-07-25 17:00:00'),
(5, 'Sabun Mandi C', '7.000', 14, 8, '9.000', '2023-07-25 17:00:00'),
(6, 'Shampoo C', '8.000', 15, 9, '10.000', '2023-07-25 17:00:00'),
(7, 'Sabun Mandi D', '9.000', 16, 10, '11.000', '2023-07-25 17:00:00'),
(8, 'Shampoo D', '10.000', 17, 11, '12.000', '2023-07-25 17:00:00'),
(9, 'Sabun Mandi E', '11.000', 18, 12, '13.000', '2023-07-25 17:00:00'),
(10, 'Shampoo E', '12.000', 19, 13, '14.000', '2023-07-25 17:00:00'),
(11, 'Sabun Mandi F', '13.000', 20, 14, '15.000', '2023-07-25 17:00:00'),
(12, 'Shampoo F', '14.000', 21, 15, '16.000', '2023-07-25 17:00:00');

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
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
