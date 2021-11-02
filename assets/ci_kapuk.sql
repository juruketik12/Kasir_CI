-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 11:02 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_kapuk`
--
CREATE DATABASE IF NOT EXISTS `ci_kapuk` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ci_kapuk`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

DROP TABLE IF EXISTS `tb_barang`;
CREATE TABLE IF NOT EXISTS `tb_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `satuan` int(2) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `kode`, `nama`, `satuan`, `harga_beli`, `harga_jual`, `image`, `status`, `tanggal`) VALUES
(1, 'KD1', 'Allegra Roy', 2, 9667, 5460, 'images.png', 1, '2021-10-23 16:37:13'),
(2, 'KD2', 'Ryder Anthony', 2, 7431, 5309, 'images.png', 1, '2021-10-23 16:37:13'),
(3, 'KD3', 'Freya Berger', 3, 8152, 8939, 'images.png', 1, '2021-10-23 16:37:13'),
(4, 'KD4', 'Nevada Santos', 2, 8474, 7358, 'images.png', 1, '2021-10-23 16:37:13'),
(5, 'KD5', 'Hiram Mccarty', 3, 9224, 9946, 'images.png', 1, '2021-10-23 16:37:13'),
(6, 'KD6', 'Quemby Grimes', 3, 5394, 7667, 'images.png', 1, '2021-10-23 16:37:13'),
(7, 'KD7', 'Ainsley Lester', 2, 6088, 7539, 'images.png', 1, '2021-10-23 16:37:13'),
(8, 'KD8', 'Kennan Espinoza', 3, 5722, 9087, 'images.png', 1, '2021-10-23 16:37:13'),
(9, 'KD9', 'Martena Mckenzie', 1, 5868, 5867, 'images.png', 1, '2021-10-23 16:37:13'),
(10, 'KD10', 'Laurel Lewis', 1, 5726, 7966, 'images.png', 1, '2021-10-23 16:37:13'),
(11, 'KD11', 'Marvin Fernandez', 1, 6513, 7864, 'images.png', 1, '2021-10-23 16:37:13'),
(12, 'KD12', 'Dominic Villarreal', 2, 7205, 7299, 'images.png', 1, '2021-10-23 16:37:13'),
(13, 'KD13', 'Avram Small', 1, 7125, 7889, 'images.png', 1, '2021-10-23 16:37:13'),
(14, 'KD14', 'Margaret Aguilar', 1, 5409, 6587, 'images.png', 1, '2021-10-23 16:37:13'),
(15, 'KD15', 'Alisa Curtis', 2, 5940, 6917, 'images.png', 1, '2021-10-23 16:37:13'),
(16, 'KD16', 'Gretchen Hernandez', 1, 5084, 5518, 'images.png', 1, '2021-10-23 16:37:13'),
(17, 'KD17', 'Ruby Marks', 2, 9684, 7891, 'images.png', 1, '2021-10-23 16:37:13'),
(18, 'KD18', 'Graiden Hartman', 1, 6513, 9809, 'images.png', 1, '2021-10-23 16:37:13'),
(19, 'KD19', 'Elliott Sweeney', 2, 6117, 7899, 'images.png', 1, '2021-10-23 16:37:13'),
(20, 'KD20', 'Gavin Simmons', 2, 6246, 5288, 'images.png', 1, '2021-10-23 16:37:13'),
(21, 'KD21', 'Hammett Mack', 2, 8820, 6353, 'images.png', 1, '2021-10-23 16:37:13'),
(22, 'KD22', 'Briar Waters', 3, 9053, 6897, 'images.png', 1, '2021-10-23 16:37:13'),
(23, 'KD23', 'Joshua Mcfadden', 2, 7281, 8109, 'images.png', 1, '2021-10-23 16:37:13'),
(24, 'KD24', 'Adele Gibbs', 3, 8187, 5252, 'images.png', 1, '2021-10-23 16:37:13'),
(25, 'KD25', 'Quemby Bolton', 1, 7458, 6170, 'images.png', 1, '2021-10-23 16:37:13'),
(26, 'KD26', 'Geoffrey Mason', 3, 8528, 7110, 'images.png', 1, '2021-10-23 16:37:13'),
(27, 'KD27', 'Wyoming Sosa', 2, 8053, 6538, 'images.png', 1, '2021-10-23 16:37:13'),
(28, 'KD28', 'Daryl Townsend', 3, 6340, 7635, 'images.png', 1, '2021-10-23 16:37:13'),
(29, 'KD29', 'Sophia Hoover', 2, 7356, 8827, 'images.png', 1, '2021-10-23 16:37:13'),
(30, 'KD30', 'Lionel Talley', 1, 5489, 8755, 'images.png', 1, '2021-10-23 16:37:13'),
(31, 'KD31', 'Magee O\'neill', 1, 5934, 9816, 'images.png', 1, '2021-10-23 16:37:13'),
(32, 'KD32', 'Thor Bishop', 1, 7032, 5319, 'images.png', 1, '2021-10-23 16:37:13'),
(33, 'KD33', 'Clark Parrish', 1, 7039, 7258, 'images.png', 1, '2021-10-23 16:37:13'),
(34, 'KD34', 'Joel Frost', 3, 5103, 6347, 'images.png', 1, '2021-10-23 16:37:13'),
(35, 'KD35', 'Barrett Rogers', 2, 6960, 6342, 'images.png', 1, '2021-10-23 16:37:13'),
(36, 'KD36', 'Devin Sandoval', 1, 5509, 5623, 'images.png', 1, '2021-10-23 16:37:13'),
(37, 'KD37', 'Bryar Mccarty', 3, 5859, 9662, 'images.png', 1, '2021-10-23 16:37:13'),
(38, 'KD38', 'Angela Santana', 2, 8638, 6766, 'images.png', 1, '2021-10-23 16:37:13'),
(39, 'KD39', 'Maxwell Cleveland', 2, 5641, 7000, 'images.png', 1, '2021-10-23 16:37:13'),
(40, 'KD40', 'Eagan Lindsey', 2, 9951, 5252, 'images.png', 1, '2021-10-23 16:37:13'),
(41, 'KD41', 'Jagung', 1, 2000, 3000, 'images.png', 1, '2021-10-23 16:37:13'),
(42, 'KD42', 'Batu', 1, 2000, 3000, 'docs-home1.png', 1, '2021-11-02 07:31:20'),
(43, 'KD43', 'Batu Ge', 1, 20000, 22000, 'docs-home2.png', 1, '2021-11-02 08:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kasir`
--

DROP TABLE IF EXISTS `tb_kasir`;
CREATE TABLE IF NOT EXISTS `tb_kasir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kasir`
--

INSERT INTO `tb_kasir` (`id`, `pelanggan_id`, `create_date`) VALUES
(2, 2, '2021-11-02 08:52:52'),
(3, 1, '2021-11-02 09:12:04'),
(4, 2, '2021-11-02 09:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kasir_detail`
--

DROP TABLE IF EXISTS `tb_kasir_detail`;
CREATE TABLE IF NOT EXISTS `tb_kasir_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasir_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kasir` (`kasir_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kasir_detail`
--

INSERT INTO `tb_kasir_detail` (`id`, `kasir_id`, `barang_id`, `qty`, `harga`, `total`, `diskon`) VALUES
(5, 2, 41, 5, 3000, 15000, 0),
(6, 2, 43, 1, 22000, 22000, 0),
(7, 3, 39, 3, 7000, 21000, 0),
(8, 4, 42, 1, 3000, 3000, 0),
(9, 4, 39, 1, 7000, 7000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

DROP TABLE IF EXISTS `tb_pelanggan`;
CREATE TABLE IF NOT EXISTS `tb_pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nomor` varchar(13) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id`, `nama`, `alamat`, `nomor`, `create_date`) VALUES
(1, 'Umum', '-', '-', '2021-11-02 08:02:02'),
(2, 'Semok', 'Prigen', '085785500', '2021-11-02 08:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

DROP TABLE IF EXISTS `tb_satuan`;
CREATE TABLE IF NOT EXISTS `tb_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `nama`, `tanggal`) VALUES
(1, 'Kg', '2021-10-23 14:45:39'),
(2, 'Pcs', '2021-10-23 14:45:39'),
(3, 'Liter', '2021-10-23 14:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

DROP TABLE IF EXISTS `tb_stok`;
CREATE TABLE IF NOT EXISTS `tb_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL,
  `stok_tambah` int(11) NOT NULL DEFAULT 0,
  `stok_kurang` int(11) NOT NULL DEFAULT 0,
  `keterangan` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stok`
--

INSERT INTO `tb_stok` (`id`, `barang_id`, `stok_tambah`, `stok_kurang`, `keterangan`, `status`, `tanggal`) VALUES
(2, 41, 40, 0, NULL, 1, '2021-10-23 17:55:51'),
(4, 41, 0, 10, 'Kadaluarsa', 1, '2021-11-02 09:17:30'),
(5, 42, 20, 0, '', 1, '2021-10-23 19:16:56'),
(6, 42, 20, 0, '', 1, '2021-11-02 07:31:09');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kasir_detail`
--
ALTER TABLE `tb_kasir_detail`
  ADD CONSTRAINT `kasir` FOREIGN KEY (`kasir_id`) REFERENCES `tb_barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
