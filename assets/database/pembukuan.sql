-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2025 pada 15.05
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembukuan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `kode_barang`, `nama_barang`) VALUES
(3, '12345', 'adss'),
(4, '12345', 'adaa'),
(5, '321', 'bebas2'),
(29, 'kabc', 'bebas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembukuan`
--

CREATE TABLE `tbl_pembukuan` (
  `id` int(11) NOT NULL,
  `periode` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `soh` varchar(255) NOT NULL,
  `fisik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pembukuan`
--

INSERT INTO `tbl_pembukuan` (`id`, `periode`, `bulan`, `kode_barang`, `nama_barang`, `soh`, `fisik`) VALUES
(6, 'minggu ke 2', 'Desember-2025', '321', 'sadada', '7', '4'),
(7, 'minggu ke 1', 'januari-2025', '12345', 'adss', '3', '5'),
(8, 'minggu ke 2', 'desember-2024', '12345', 'adss', '5', '3'),
(9, 'minggu ke 1', 'desember-2024', 'fffb', 'hvnv', '6', '3'),
(10, 'minggu ke 2', 'desember-2024', '12345', 'adss', '45', '4'),
(13, 'minggu ke 1', 'Januari-2025', 'kabc', 'bebas', '17', '17'),
(14, 'minggu ke 1', 'Januari-2025', '321', 'bebas2', '15', '14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`) VALUES
(1, 'kajol', '$2y$10$U6TPBhC.OhLoNoM8KN0G0u82dxi1wqDzzTLOgNii7hmxh.bjBCB9a', 'Riani'),
(2, 'admin', '$2y$10$egB.1lrLf6xp.TsbKum9F.VPNJLXN3A59cBz7CQhxXqAE2M77ZS0e', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pembukuan`
--
ALTER TABLE `tbl_pembukuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembukuan`
--
ALTER TABLE `tbl_pembukuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
