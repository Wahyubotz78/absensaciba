-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2024 at 01:52 PM
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
-- Database: `absensaciba`
--

-- --------------------------------------------------------

--
-- Table structure for table `datamurid`
--

CREATE TABLE `datamurid` (
  `id` int(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datamurid`
--

INSERT INTO `datamurid` (`id`, `nis`, `namalengkap`, `jurusan`) VALUES
(1, '12345678', 'Josdunt Sukandar Immanuel', 'Teknik Komputer dan Jaringan'),
(2, '66666666', 'Admin Absen', 'Admin'),
(3, '44444444', 'Ahmad Yusup S.kom', 'Guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datamurid`
--
ALTER TABLE `datamurid`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datamurid`
--
ALTER TABLE `datamurid`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
