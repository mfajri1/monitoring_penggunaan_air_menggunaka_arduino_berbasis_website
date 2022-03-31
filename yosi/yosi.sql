-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 02:37 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yosi`
--
CREATE DATABASE IF NOT EXISTS `yosi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `yosi`;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `mode` int(11) NOT NULL,
  PRIMARY KEY (`mode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`mode`) VALUES
(4);

-- --------------------------------------------------------

--
-- Table structure for table `tmprfid`
--

DROP TABLE IF EXISTS `tmprfid`;
CREATE TABLE IF NOT EXISTS `tmprfid` (
  `nokartu` varchar(20) NOT NULL,
  PRIMARY KEY (`nokartu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_konsumen`
--

DROP TABLE IF EXISTS `t_konsumen`;
CREATE TABLE IF NOT EXISTS `t_konsumen` (
  `id_konsumen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_konsumen` varchar(200) NOT NULL,
  PRIMARY KEY (`id_konsumen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_konsumen`
--

INSERT INTO `t_konsumen` (`id_konsumen`, `nama_konsumen`) VALUES
(1, 'padang'),
(2, 'solok');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengguna`
--

DROP TABLE IF EXISTS `t_pengguna`;
CREATE TABLE IF NOT EXISTS `t_pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `pengguna` varchar(100) NOT NULL,
  `daerah1` int(11) NOT NULL,
  `daerah2` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pengguna`
--

INSERT INTO `t_pengguna` (`id_pengguna`, `pengguna`, `daerah1`, `daerah2`, `tanggal`) VALUES
(10, 'pengguna', 584, 240, '2022-01-26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
