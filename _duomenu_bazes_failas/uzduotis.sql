-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 04:09 PM
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
-- Database: `uzduotis`
--

-- --------------------------------------------------------

--
-- Table structure for table `parduotuve`
--

CREATE TABLE `parduotuve` (
  `id` int(11) NOT NULL,
  `prekes_kategorija` varchar(255) NOT NULL,
  `modelis` varchar(255) NOT NULL,
  `gamintojas` varchar(255) NOT NULL,
  `sandelis` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parduotuve`
--

INSERT INTO `parduotuve` (`id`, `prekes_kategorija`, `modelis`, `gamintojas`, `sandelis`) VALUES
(1, 'Fotoaparatai', 'Canon sf 123', 'Canon', 'ne'),
(2, 'Fotoaparatai', 'Sony ss 123', 'Sony', 'taip'),
(3, 'Kompiuteriai', 'Asus 123', 'Asus', 'taip'),
(4, 'Kompiuteriai', 'HP 123', 'HP', 'ne'),
(5, 'Telefonai', 'Samsung GSII', 'Samsung', 'ne'),
(6, 'Telefonai', 'Iphone 5', 'Apple', 'taip');

-- --------------------------------------------------------

--
-- Table structure for table `vartotojai`
--

CREATE TABLE `vartotojai` (
  `id` int(11) NOT NULL,
  `vardas` varchar(100) NOT NULL,
  `el_pastas` varchar(100) NOT NULL,
  `slaptazodis` varchar(255) NOT NULL,
  `sukurtas_irasas` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vartotojai`
--

INSERT INTO `vartotojai` (`id`, `vardas`, `el_pastas`, `slaptazodis`, `sukurtas_irasas`) VALUES
(1, 'Mindaugas', 'minde@gmail.com', '$2y$10$z4GIXUNemVIPjTvMc7ghVuF104KqTorWcJ5H9tOqwisDd5UrHuMge', '2023-10-05 12:22:37'),
(2, 'Admin', 'admin@gmail.com', '$2y$10$Sf84PRBAOCC8M3Iy9ZDlauwtvOnalBHFFoqWSh6UpT8a/Z7BZ2G0S', '2023-10-05 12:22:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parduotuve`
--
ALTER TABLE `parduotuve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vartotojai`
--
ALTER TABLE `vartotojai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parduotuve`
--
ALTER TABLE `parduotuve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vartotojai`
--
ALTER TABLE `vartotojai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
