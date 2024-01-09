-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 07 Jan 2024 pada 18.16
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensaciba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id` int(255) NOT NULL,
  `tanggalabsen` varchar(255) NOT NULL,
  `jamabsen` varchar(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `masuk` varchar(255) NOT NULL,
  `keluar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id`, `tanggalabsen`, `jamabsen`, `nis`, `namalengkap`, `kelas`, `jurusan`, `keterangan`, `masuk`, `keluar`) VALUES
(14, '2024-01-07', '18:08:02', '87654321', 'Japzslure Efef Jinan', 'X', 'Desain Permodelan dan Informasi Bangunan', 'H', '1', '0'),
(15, '2024-01-07', '18:15:29', '12345678', 'Josdunt Sukandar Immanuel', 'XII', 'Teknik Komputer dan Jaringan', 'H', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datamurid`
--

CREATE TABLE `datamurid` (
  `id` int(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `fotomurid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `datamurid`
--

INSERT INTO `datamurid` (`id`, `nis`, `namalengkap`, `kelas`, `jurusan`, `fotomurid`) VALUES
(1, '12345678', 'Josdunt Sukandar Immanuel', 'XII', 'Teknik Komputer dan Jaringan', 'jessisayang.jpg'),
(2, '66666666', 'Admin Absen', '', 'Admin', ''),
(3, '44444444', 'Ahmad Yusup S.kom', '', 'Guru', ''),
(4, '87654321', 'Japzslure Efef Jinan', 'X', 'Desain Permodelan dan Informasi Bangunan', 'jessi.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datamurid`
--
ALTER TABLE `datamurid`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `datamurid`
--
ALTER TABLE `datamurid`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
