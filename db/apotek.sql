-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Jul 2018 pada 21.23
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenis`
--

INSERT INTO `tb_jenis` (`id`, `nama_jenis`) VALUES
(1, 'Capsul'),
(2, 'Tablet'),
(3, 'Sirup'),
(4, 'Puyer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(20) NOT NULL,
  `id_supp` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
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
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id`, `kode_obat`, `id_supp`, `nama_obat`, `keterangan`, `harga_modal`, `harga_jual`, `jenis`, `satuan`, `stock`, `last_update`, `foto`) VALUES
(1, '2451', 2, 'Laserin', 'asd', 10000, 15000, 3, 'Botol', 0, '2018-07-03 19:37:54', ''),
(2, '3232', 2, 'Panadol', 'zxc', 5000, 6000, 2, 'Strip', 8, '2018-07-03 19:38:44', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat_stok`
--

CREATE TABLE `tb_obat_stok` (
  `id` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `tgl_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_obat_stok`
--

INSERT INTO `tb_obat_stok` (`id`, `id_obat`, `tgl_masuk`, `tgl_expired`) VALUES
(1, 1, '2018-07-03 19:37:54', '2018-07-31'),
(2, 1, '2018-07-03 19:37:54', '2018-07-31'),
(3, 1, '2018-07-03 19:37:54', '2018-07-31'),
(4, 1, '2018-07-03 19:37:54', '2018-07-31'),
(5, 1, '2018-07-03 19:37:54', '2018-07-31'),
(6, 1, '2018-07-03 19:37:54', '2018-07-31'),
(7, 1, '2018-07-03 19:37:54', '2018-07-31'),
(8, 1, '2018-07-03 19:37:54', '2018-07-31'),
(9, 1, '2018-07-03 19:37:54', '2018-07-31'),
(10, 1, '2018-07-03 19:37:54', '2018-07-31'),
(11, 2, '2018-07-03 19:38:44', '2018-07-31'),
(12, 2, '2018-07-03 19:38:44', '2018-07-31'),
(13, 2, '2018-07-03 19:38:44', '2018-07-31'),
(14, 2, '2018-07-03 19:38:44', '2018-07-31'),
(15, 2, '2018-07-03 19:38:44', '2018-07-31'),
(16, 2, '2018-07-03 19:38:44', '2018-07-31'),
(17, 2, '2018-07-03 19:38:44', '2018-07-31'),
(18, 2, '2018-07-03 19:38:44', '2018-07-31'),
(19, 2, '2018-07-03 19:38:44', '2018-07-31'),
(20, 2, '2018-07-03 19:38:44', '2018-07-31'),
(21, 2, '2018-07-03 19:38:44', '2018-07-31'),
(22, 2, '2018-07-03 19:38:44', '2018-07-31'),
(23, 2, '2018-07-03 19:38:44', '2018-07-31'),
(24, 2, '2018-07-03 19:38:44', '2018-07-31'),
(25, 2, '2018-07-03 19:38:44', '2018-07-31'),
(26, 2, '2018-07-03 19:38:44', '2018-07-31'),
(27, 2, '2018-07-03 19:38:44', '2018-07-31'),
(28, 2, '2018-07-03 19:38:44', '2018-07-31'),
(29, 2, '2018-07-03 19:38:44', '2018-07-31'),
(30, 2, '2018-07-03 19:38:44', '2018-07-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_permintaan`
--

CREATE TABLE `tb_permintaan` (
  `id_per` int(11) NOT NULL,
  `id_supp` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_permintaan`
--

INSERT INTO `tb_permintaan` (`id_per`, `id_supp`, `jumlah`, `tgl`) VALUES
(1, 2, 7, '2018-07-05 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_permintaan_list`
--

CREATE TABLE `tb_permintaan_list` (
  `id_list` int(11) NOT NULL,
  `id_per` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_permintaan_list`
--

INSERT INTO `tb_permintaan_list` (`id_list`, `id_per`, `id_obat`, `jumlah`) VALUES
(1, 1, 1, 2),
(2, 1, 1, 3),
(3, 1, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supp` varchar(50) NOT NULL,
  `alamat_supp` text NOT NULL,
  `tlp_supp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama_supp`, `alamat_supp`, `tlp_supp`) VALUES
(2, 'asdasdas', '2112asas', '123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `jumlah_menu` int(11) NOT NULL,
  `total_harga` int(12) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_list`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'gudang', '202446dd1d6028084426867365b0c7a1', 1),
(3, 'kasir', 'c7911af3adbd12a035b289556d96470a', 2),
(4, 'gabut', 'ee6f0d86a1be19716aa5e5b0c45442ea', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_obat_stok`
--
ALTER TABLE `tb_obat_stok`
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
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_obat_stok`
--
ALTER TABLE `tb_obat_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tb_permintaan`
--
ALTER TABLE `tb_permintaan`
  MODIFY `id_per` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_permintaan_list`
--
ALTER TABLE `tb_permintaan_list`
  MODIFY `id_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_transaksi_list`
--
ALTER TABLE `tb_transaksi_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
