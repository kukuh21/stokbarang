-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 05:51 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `barang_id` int(11) NOT NULL,
  `barang_nama` text NOT NULL,
  `barang_stock` int(11) NOT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`barang_id`, `barang_nama`, `barang_stock`, `satuan_id`, `created_at`, `updated_at`) VALUES
(1, 'Kertas', 6, 1, '2022-04-12 19:13:13', '2022-04-20 19:46:42'),
(3, 'Pulpen', 4, NULL, '2022-04-12 19:17:12', '2022-04-15 04:38:40'),
(4, 'Gunting', 2, NULL, '2022-04-12 19:17:58', '2022-04-17 20:26:19'),
(5, 'Lakban', 5, NULL, '2022-04-12 19:20:03', '2022-04-17 21:03:26'),
(6, 'PC', 80, NULL, '2022-04-12 19:20:11', '2022-04-15 12:24:48'),
(7, 'Takah', 0, NULL, '2022-04-12 19:55:01', '2022-04-15 07:59:14'),
(8, 'Keyboard ', 16, NULL, '2022-04-12 19:55:01', '2022-04-17 21:04:20'),
(9, 'tes', 12, NULL, '2022-04-17 21:03:09', '2022-04-17 21:03:09'),
(10, 'va', 2, 1, '2022-04-20 19:04:49', '2022-04-20 19:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barangmasuk`
--

CREATE TABLE `tb_barangmasuk` (
  `barangmasuk_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `barangmasuk_stock` int(11) NOT NULL,
  `barangmasuk_tgl` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barangmasuk`
--

INSERT INTO `tb_barangmasuk` (`barangmasuk_id`, `barang_id`, `barangmasuk_stock`, `barangmasuk_tgl`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '2022-04-14', '2022-04-13 17:30:42', '2022-04-13 17:30:42'),
(5, 4, 2, '2022-04-18', '2022-04-17 20:26:19', '2022-04-17 20:26:19'),
(6, 5, 2, '2022-04-18', '2022-04-17 21:03:26', '2022-04-17 21:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidang`
--

CREATE TABLE `tb_bidang` (
  `bidang_id` int(11) NOT NULL,
  `bidang_nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bidang`
--

INSERT INTO `tb_bidang` (`bidang_id`, `bidang_nama`, `created_at`, `updated_at`) VALUES
(1, 'Sekretariat', '2022-04-12 18:59:12', '2022-04-12 18:59:22'),
(2, 'Bidang Pengadaan, Pemberhentian dan Peningkatan Kapasitas ASN (P3KA)', '2022-04-12 19:00:44', '2022-04-12 19:00:44'),
(3, 'Bidang Mutasi dan Penilaian Kinerja Aparatur (MPKA)', '2022-04-12 19:01:12', '2022-04-12 19:01:12'),
(4, 'Bidang Pengembangan SDM (PSDM)', '2022-04-12 19:01:34', '2022-04-12 19:01:34'),
(6, 'tes', '2022-04-17 21:03:02', '2022-04-17 21:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `user_id`, `invoice`, `total`, `no_urut`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 4, 'INV1-04-2022', 16, 1, '2022-04-15', '2022-04-15 03:43:00', '2022-04-15 08:49:35'),
(2, 5, 'INV2-04-2022', 1, 2, '2022-04-15', '2022-04-15 05:07:52', '2022-04-15 05:07:55'),
(3, 9, 'INV3-04-2022', 2, 3, '2022-04-15', '2022-04-15 12:24:24', '2022-04-15 12:24:48'),
(5, 5, 'INV4-04-2022', 2, 4, '2022-04-18', '2022-04-17 21:03:30', '2022-04-17 21:03:38'),
(6, 10, 'INV5-04-2022', 1, 5, '2022-04-18', '2022-04-17 21:04:17', '2022-04-17 21:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_orderdetail`
--

CREATE TABLE `tb_orderdetail` (
  `orderdetail_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('buka','kunci') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_orderdetail`
--

INSERT INTO `tb_orderdetail` (`orderdetail_id`, `barang_id`, `order_id`, `jumlah`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, '2022-04-15', 'kunci', '2022-04-15 03:43:07', '2022-04-15 05:06:24'),
(2, 1, 1, 1, '2022-04-15', 'kunci', '2022-04-15 03:44:13', '2022-04-15 05:06:24'),
(3, 8, 1, 0, '2022-04-15', 'kunci', '2022-04-15 03:44:25', '2022-04-15 05:06:24'),
(5, 6, 1, 5, '2022-04-15', 'kunci', '2022-04-15 05:07:20', '2022-04-15 05:07:35'),
(6, 6, 2, 1, '2022-04-15', 'kunci', '2022-04-15 05:07:55', '2022-04-15 05:08:11'),
(7, 6, 1, 1, '2022-04-15', 'kunci', '2022-04-15 05:13:48', '2022-04-15 07:59:18'),
(8, 5, 1, 1, '2022-04-15', 'kunci', '2022-04-15 05:14:08', '2022-04-15 07:59:18'),
(9, 7, 1, 2, '2022-04-15', 'kunci', '2022-04-15 07:49:39', '2022-04-15 07:59:18'),
(10, 6, 1, 1, '2022-04-15', 'buka', '2022-04-15 08:41:40', '2022-04-15 08:49:35'),
(11, 6, 3, 2, '2022-04-15', 'kunci', '2022-04-15 12:24:32', '2022-04-15 12:24:55'),
(12, 8, 5, 2, '2022-04-18', 'kunci', '2022-04-17 21:03:34', '2022-04-17 21:03:41'),
(13, 8, 6, 1, '2022-04-18', 'kunci', '2022-04-17 21:04:20', '2022-04-17 21:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`satuan_id`, `satuan_nama`, `created_at`, `updated_at`) VALUES
(1, 'Rim', '2022-04-20 19:46:34', '2022-04-20 19:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipe` enum('Admin','User') NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nohp` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `bidang_id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`, `tipe`, `nama`, `nohp`, `alamat`, `bidang_id`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$fCiSLKekxp33LHvNpS60eOxFiSywxYRh62m.HLHsOhxszTlEjVz/K', 'Admin', 'Admin', '085248036099', 'Tanjung', 1, 'admin-avatar.png', 'fR7SGfnspcTAuoXz7PpXlv6yQ5Ex5BendJUBnRfWM9T0ujW7m2diFFmLO6ML', '2022-03-22 11:27:39', '2022-04-15 08:05:56'),
(4, 'kukuh', '$2y$10$Pb1VFQx860KyWfYVj.bOyuEpfXPpRBTZgRB9OdoZxos7EuE4xQwjS', 'User', 'Kukuh Aprianto', '085248036099', 'Tanjung', 2, NULL, 'Cgdx0wUiJ4LLERjm1ON5FT5y11uKicMnG6QdUMe0f7kVbsF65etHRONjxI4X', '2022-03-25 03:50:49', '2022-04-04 16:36:39'),
(5, 'sari', '$2y$10$LOc5wC7DMcnhJV9ePckeQOza7aiTiustlSbF8.wYxw.ZKcu6enpzu', 'User', 'Sari', NULL, NULL, 3, NULL, NULL, '2022-03-25 03:58:40', '2022-03-25 03:58:40'),
(9, 'aulia', '$2y$10$GS7RALxa7O1oDN58H0fXb.pg3cQC0Vca.eqMpuonDcxHDmX1u873m', 'User', 'Aulia', '085248728499', 'Tanjung', 3, NULL, 'L9U5vs4wxvupCDlie2BCZ9maBfbDCAk39ZHcmIqD06LoLAwHjDT1bjS9InE8', '2022-04-15 08:51:16', '2022-04-15 08:51:16'),
(10, 'mutia', '$2y$10$NEUK5/KTYFpEYk/8X0qdiOY7ZUjSkRzwaumzU0cLxRpQcHPUeFEf2', 'User', 'mutia', '08524982398123', '2', 1, NULL, NULL, '2022-04-17 21:03:59', '2022-04-17 21:03:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `tb_barangmasuk`
--
ALTER TABLE `tb_barangmasuk`
  ADD PRIMARY KEY (`barangmasuk_id`);

--
-- Indexes for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`bidang_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_orderdetail`
--
ALTER TABLE `tb_orderdetail`
  ADD PRIMARY KEY (`orderdetail_id`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_barangmasuk`
--
ALTER TABLE `tb_barangmasuk`
  MODIFY `barangmasuk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  MODIFY `bidang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_orderdetail`
--
ALTER TABLE `tb_orderdetail`
  MODIFY `orderdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
