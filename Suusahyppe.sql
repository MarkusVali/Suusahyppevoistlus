-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: d125332.mysql.zonevs.eu
-- Loomise aeg: Jaan 23, 2024 kell 03:21 PL
-- Serveri versioon: 10.4.32-MariaDB-log
-- PHP versioon: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `d125332_suusahypp`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `suusahyppajad`
--

CREATE TABLE `suusahyppajad` (
  `id` int(11) NOT NULL,
  `eesnimi` varchar(30) DEFAULT NULL,
  `perekonnanimi` varchar(30) DEFAULT NULL,
  `alustanud` tinyint(1) DEFAULT -1,
  `lopetanud` tinyint(1) DEFAULT -1,
  `kaugus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `suusahyppajad`
--
ALTER TABLE `suusahyppajad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `suusahyppajad`
--
ALTER TABLE `suusahyppajad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
