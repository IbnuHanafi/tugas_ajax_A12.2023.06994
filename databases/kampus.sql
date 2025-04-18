-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 04:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `jurusan`) VALUES
(1, '23001', 'Budi Santoso', 'Teknik Informatika'),
(2, '23002', 'Dewi Anggraini', 'Sistem Informasi'),
(3, '23003', 'Adi Wijaya', 'Ilmu Komunikasi'),
(4, '23004', 'Putri Lestari', 'Manajemen'),
(5, '23005', 'Rizky Hidayat', 'Sistem Informasi'),
(6, '23006', 'Siti Rahayu', 'Teknik Elektro'),
(7, '23007', 'Ahmad Fauzi', 'Desain Komunikasi Visual'),
(8, '23008', 'Lina Mulyani', 'Akuntansi'),
(9, '23009', 'Dani Setiawan', 'Manajemen'),
(10, '23010', 'Nova Wijaya', 'Akuntansi'),
(11, '23011', 'Reza Mahendra', 'Sistem Informasi'),
(12, '23012', 'Dina Fitriani', 'Kesehatan Masyarakat'),
(13, '23013', 'Eko Prasetyo', 'Teknik Informatika'),
(14, '23014', 'Rina Anggraeni', 'Manajemen'),
(15, '23015', 'Rhaegar Targaryen', 'Kedokteran'),
(16, '23016', 'Joko Anwar', 'Kesehatan Masyarakat'),
(17, '23017', 'Theon Greyjoy', 'Ilmu Komunikasi'),
(18, '06994', 'Ibnu Hanafi Assalam', 'Sistem Informasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
