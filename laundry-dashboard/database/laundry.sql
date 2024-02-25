-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 11:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `harga_paket` int(11) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_paket`, `qty`, `keterangan`, `harga_paket`, `total_harga`) VALUES
(33, 42, 3, 1, '', 0, 0),
(35, 44, 3, 1, '', 0, 0),
(36, 45, 3, 1, '', 0, 0),
(37, 46, 3, 1, '', 0, 0),
(38, 46, 3, 1, '', 0, 0),
(39, 47, 3, 1, '', 0, 0),
(40, 48, 3, 1, '', 0, 0),
(41, 49, 8, 1, '', 0, 0),
(42, 51, 8, 1, '', 0, 0),
(43, 52, 10, 1, '', 20000, 20000),
(44, 52, 3, 1, '', 25000, 25000),
(45, 52, 10, 2, '', 20000, 40000),
(46, 53, 3, 1, '', 25000, 25000),
(47, 50, 11, 1, '', 0, 0),
(50, 55, 3, 1, '', 0, 0),
(51, 54, 4, 1, 'Di setrika', 0, 0),
(53, 58, 7, 1, '', 0, 0),
(54, 59, 5, 1, '', 0, 0),
(55, 60, 4, 1, '', 0, 0),
(56, 61, 3, 1, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(1, '  nadine', 'Jln. Semangka', 'P', '086575583923');

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id_outlet` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id_outlet`, `nama`, `alamat`, `tlp`) VALUES
(1, 'PT.Teknologi Canggih', 'Jalan', '09382356474475'),
(4, 'pt laundry', 'jalan nusakambangan', '08765456789');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
(3, 1, 'kiloan', 'Cuci Kering Lipat (CKL) 3KG', 25000),
(4, 1, 'kiloan', 'Cuci Kering Lipat (CKL) 6KG', 35000),
(5, 1, 'kiloan', 'Cuci Kering Setrika (CKS) 3KG', 35000),
(6, 1, 'kiloan', 'Cuci Kering Setrika (CKS) 6KG', 50000),
(7, 1, 'bed_cover', 'BedCover S (UK. 120 x 200 CM)', 25000),
(8, 1, 'bed_cover', 'BedCover S (UK. 160 x 200 CM)', 35000),
(9, 1, 'bed_cover', 'BedCover S (UK. 180 x 200 CM)', 45000),
(10, 1, 'selimut', 'Selimut S (Kecil)', 20000),
(11, 1, 'selimut', 'Selimut M (Sedang-Besar)', 25000),
(12, 1, 'lain', 'Sprei 2 PCS CKS', 35000),
(13, 1, 'kiloan', 'Cuci Kering Lipat (CKL) 3KG', 25000),
(14, 4, 'kiloan', 'cuci cepat', 30000),
(15, 4, 'kiloan', 'cuci express', 18000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `kode_invoice` varchar(100) NOT NULL,
  `id_member` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `biaya_tambahan` int(11) NOT NULL,
  `diskon` double NOT NULL,
  `pajak` double NOT NULL,
  `status` enum('baru','proses','selesai','diambil') NOT NULL,
  `dibayar` enum('dibayar','belum_dibayar') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `dibayar`, `id_user`) VALUES
(58, 1, 'INV/2024/02/23/1', 1, '2024-02-23 09:03:57', '2024-02-26 09:03:57', '2024-02-23 09:04:21', 0, 0, 0.0075, 'diambil', 'dibayar', 8),
(59, 1, 'INV/2024/02/23/2', 1, '2024-02-23 09:06:02', '2024-02-26 09:06:02', '2024-02-23 09:06:29', 0, 0, 0.0075, 'selesai', 'dibayar', 8),
(60, 1, 'INV/2024/02/23/3', 1, '2024-02-23 09:11:10', '2024-02-26 09:11:10', '2024-02-23 09:11:23', 0, 0, 0.0075, 'diambil', 'dibayar', 8),
(61, 1, 'INV/2024/02/24/4', 1, '2024-02-24 10:09:58', '2024-02-27 10:09:58', '2024-02-24 10:11:44', 0, 10, 0.0075, 'selesai', 'dibayar', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `role` enum('admin','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `id_outlet`, `role`) VALUES
(5, 'Kasir', 'Kasir', '$2y$10$lrhXQGqJsSfV1Fh/89LG.Om2lsiWLcGJQzT63UR.ZyHHs1rd4mjMa', 1, 'kasir'),
(6, 'Owner', 'Owner', '$2y$10$W3/HcgVBbJhvyJQvkEeH5O7FbCiEBbPdmNTxDWFaQC8agPI/NNakO', 1, 'owner'),
(7, 'User', 'Admin', '$2y$10$oskUEo95UTiOP.1xnggML.bp.InU7quGpK/jIFpVf89F9ai/Mgt0O', 1, 'admin'),
(8, 'a', 'a', '$2y$10$eME1Efs67otkiOpc4DuVDuqbJPjGOZH/m8dwVJGevGrP48Omhcs96', 1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `FK_TRANSAKSI` (`id_transaksi`),
  ADD KEY `FK_PAKET` (`id_paket`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `FK_OUTLET2` (`id_outlet`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `FK_OUTLET3` (`id_outlet`),
  ADD KEY `FK_MEMBER` (`id_member`),
  ADD KEY `FK_USER` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_OUTLET1` (`id_outlet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `FK_PAKET` FOREIGN KEY (`id_paket`) REFERENCES `tb_paket` (`id_paket`),
  ADD CONSTRAINT `FK_TRANSAKSI` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`);

--
-- Constraints for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD CONSTRAINT `FK_OUTLET2` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `FK_MEMBER` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id_member`),
  ADD CONSTRAINT `FK_OUTLET3` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`),
  ADD CONSTRAINT `FK_USER` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `FK_OUTLET1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
