-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2017 at 02:15 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testo`
--

-- --------------------------------------------------------

--
-- Table structure for table `molecole`
--

CREATE TABLE `molecole` (
  `indice` int(20) UNSIGNED NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `atomo0` varchar(3) DEFAULT NULL,
  `atomo1` varchar(3) DEFAULT NULL,
  `atomo2` varchar(3) DEFAULT NULL,
  `atomo3` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `molecole`
--

INSERT INTO `molecole` (`indice`, `nome`, `atomo0`, `atomo1`, `atomo2`, `atomo3`) VALUES
(0, 'Monossido di carbonio', 'C', 'O', NULL, NULL),
(1, 'Ossido ferroso', 'Fe', 'O', NULL, NULL),
(2, 'Idrogeno molecolare', 'H', NULL, NULL, NULL),
(3, 'Cianogeno', 'C', 'N', NULL, NULL),
(4, 'Radicale etilene', 'C', 'H', NULL, NULL),
(5, 'Ossido di diidrogeno', 'H', 'O', NULL, NULL),
(6, 'Acido cianidrico', 'H', 'N', 'C', NULL),
(7, 'Cianuro di potassio', 'K', 'C', 'N', NULL),
(8, 'Diossido di zolfo', 'S', 'O', NULL, NULL),
(9, 'Acetilene', 'C', 'H', NULL, NULL),
(10, 'Ammoniaca', 'N', 'H', NULL, NULL),
(11, 'Metano', 'C', 'H', NULL, NULL),
(12, 'Carburo di silicio', 'Si', 'C', NULL, NULL),
(13, 'Solfuro di azoto', 'N', 'S', NULL, NULL),
(14, 'Cloruro di idrogeno', 'H', 'Cl', NULL, NULL),
(15, 'Monosolfuro di carbonio', 'C', 'S', NULL, NULL),
(16, 'Monossido di alluminio', 'Al', 'O', NULL, NULL),
(17, 'Idrossido di alluminio', 'Al', 'O', 'H', NULL),
(18, 'Cianuro ferroso', 'Fe', 'C', 'N', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `molecole`
--
ALTER TABLE `molecole`
  ADD PRIMARY KEY (`indice`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
