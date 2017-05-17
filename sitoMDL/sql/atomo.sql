-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2017 at 02:14 PM
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
-- Table structure for table `atomo`
--

CREATE TABLE `atomo` (
  `indice` int(20) UNSIGNED NOT NULL,
  `nome` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `simbolo` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `num_atomico` int(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atomo`
--

INSERT INTO `atomo` (`indice`, `nome`, `simbolo`, `num_atomico`) VALUES
(0, 'idrogeno', 'H', 1),
(1, 'azoto', 'N', 7),
(2, 'carbonio', 'C', 6),
(3, 'silicio', 'Si', 14),
(4, 'zolfo', 'S', 16),
(5, 'ossigeno', 'O', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atomo`
--
ALTER TABLE `atomo`
  ADD PRIMARY KEY (`indice`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
