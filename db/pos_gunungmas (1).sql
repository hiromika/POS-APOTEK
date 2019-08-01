-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2019 at 12:17 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_gunungmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `id_supp` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `kode_barang`, `id_supp`, `nama_barang`, `keterangan`, `harga_modal`, `harga_jual`, `jenis`, `satuan`, `stock`, `last_update`, `foto`) VALUES
(1, 'EP213', 1, 'canon ir 4570', ' ', 20000000, 22000000, 2, 'Unit', 5, '2019-07-07 23:31:50', 'r5.jpg'),
(3, 'ER670', 1, 'canon ir 6570', '', 10000000, 11000000, 1, 'Unit', 8, '2019-07-09 18:28:59', 'Canon-ir-6570-01.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang_stok`
--

CREATE TABLE `tb_barang_stok` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_brg_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang_stok`
--

INSERT INTO `tb_barang_stok` (`id`, `id_barang`, `tgl_masuk`, `tgl_brg_masuk`) VALUES
(41, 1, '2019-07-07 23:21:36', '2019-07-08'),
(42, 1, '2019-07-07 23:21:36', '2019-07-08'),
(43, 1, '2019-07-07 23:21:36', '2019-07-08'),
(44, 1, '2019-07-07 23:21:36', '2019-07-08'),
(45, 1, '2019-07-07 23:21:36', '2019-07-08'),
(49, 3, '2019-07-09 18:28:59', '2019-07-10'),
(50, 3, '2019-07-09 18:28:59', '2019-07-10'),
(51, 3, '2019-07-09 18:28:59', '2019-07-10'),
(52, 3, '2019-07-09 18:28:59', '2019-07-10'),
(53, 3, '2019-07-09 18:28:59', '2019-07-10'),
(54, 3, '2019-07-09 18:28:59', '2019-07-10'),
(55, 3, '2019-07-09 18:28:59', '2019-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id`, `nama_jenis`) VALUES
(1, 'Cetak Offset'),
(2, 'Cetak Plotter'),
(3, 'Cetak Digital Printing');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan`
--

CREATE TABLE `tb_permintaan` (
  `id_per` int(11) NOT NULL,
  `id_supp` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_permintaan`
--

INSERT INTO `tb_permintaan` (`id_per`, `id_supp`, `jumlah`, `tgl`) VALUES
(1, 1, 2, '2019-07-08 00:00:00'),
(2, 1, 10, '2019-07-08 00:00:00'),
(3, 1, 1, '2019-07-09 00:00:00'),
(4, 1, 1, '2019-07-09 00:00:00'),
(5, 1, 2, '2019-07-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan_list`
--

CREATE TABLE `tb_permintaan_list` (
  `id_list` int(11) NOT NULL,
  `id_per` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_permintaan_list`
--

INSERT INTO `tb_permintaan_list` (`id_list`, `id_per`, `id_barang`, `jumlah`) VALUES
(1, 1, 1, 2),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supp` varchar(50) NOT NULL,
  `alamat_supp` text NOT NULL,
  `tlp_supp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama_supp`, `alamat_supp`, `tlp_supp`) VALUES
(1, 'Cannon', 'bekasi', '0213456788');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `nama_konsumen` varchar(200) NOT NULL,
  `jumlah_menu` int(11) NOT NULL,
  `total_harga` int(12) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `nama_konsumen`, `jumlah_menu`, `total_harga`, `bayar`, `kembali`, `tgl_transaksi`) VALUES
(1, 'Budi', 1, 11000000, 11000000, 0, '2019-07-09 19:44:42'),
(2, 'Toto', 1, 44000000, 45000000, 1000000, '2019-07-09 19:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_list`
--

CREATE TABLE `tb_transaksi_list` (
  `id` int(11) NOT NULL,
  `id_trans` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_total` int(12) NOT NULL,
  `laba` int(12) NOT NULL,
  `tgl_trans` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_list`
--

INSERT INTO `tb_transaksi_list` (`id`, `id_trans`, `id_menu`, `jumlah`, `harga_total`, `laba`, `tgl_trans`) VALUES
(1, 1, 3, 1, 11000000, 1000000, '2019-07-09 19:44:31'),
(2, 2, 1, 2, 44000000, 4000000, '2019-07-09 19:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'gudang', '202446dd1d6028084426867365b0c7a1', 1),
(3, 'kasir', 'c7911af3adbd12a035b289556d96470a', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_barang_stok`
--
ALTER TABLE `tb_barang_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_permintaan`
--
ALTER TABLE `tb_permintaan`
  ADD PRIMARY KEY (`id_per`);

--
-- Indexes for table `tb_permintaan_list`
--
ALTER TABLE `tb_permintaan_list`
  ADD PRIMARY KEY (`id_list`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi_list`
--
ALTER TABLE `tb_transaksi_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_barang_stok`
--
ALTER TABLE `tb_barang_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_permintaan`
--
ALTER TABLE `tb_permintaan`
  MODIFY `id_per` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_permintaan_list`
--
ALTER TABLE `tb_permintaan_list`
  MODIFY `id_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_transaksi_list`
--
ALTER TABLE `tb_transaksi_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
