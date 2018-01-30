-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2018 at 07:06 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sayuronline`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `id_user`, `alamat`) VALUES
(1, 1, 'Bandung');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `no_detail_transaksi` int(11) NOT NULL,
  `no_produk` int(11) NOT NULL,
  `no_transaksi` varchar(25) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`no_detail_transaksi`, `no_produk`, `no_transaksi`, `harga`, `jumlah`, `subtotal`) VALUES
(1, 2, 'testest', '10', 1, '150'),
(2, 3, 'testest', '12', 1, '12'),
(3, 1, 'testest', '12500', 1, '12500');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `no_kategori` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`no_kategori`, `nama`, `slug`) VALUES
(1, 'Buah', 'buah');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_transaksi` varchar(25) NOT NULL,
  `bank_tujuan` enum('BNI','BCA','BRI','Mandiri') NOT NULL,
  `bank_asal` varchar(15) NOT NULL,
  `atas_nama` varchar(30) NOT NULL,
  `no_rekening` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(12,0) NOT NULL,
  `bukti_pembayaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no_transaksi`, `bank_tujuan`, `bank_asal`, `atas_nama`, `no_rekening`, `tanggal`, `jumlah`, `bukti_pembayaran`) VALUES
('testest', 'BCA', 'Bankbon', 'Budi Baper', '0123', '2018-01-31', '10000', 'testest.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_kurir`
--

CREATE TABLE `petugas_kurir` (
  `id_petugas` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petugas_kurir`
--

INSERT INTO `petugas_kurir` (`id_petugas`, `nama`, `no_hp`) VALUES
(1, 'Agus', '08123456789'),
(2, 'Budi', '0'),
(3, 'Susanto', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `no_produk` int(11) NOT NULL,
  `no_kategori` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`no_produk`, `no_kategori`, `nama`, `deskripsi`, `harga`, `foto`, `slug`) VALUES
(1, 1, 'test3', 'testestest', '10000', 'test3-1.png', 'test3-3'),
(2, 1, 'hehe', 'testtest', '12', 'test3.jpg', 'hehe'),
(3, 1, 'test3', 'testestest', '12123', 'test3-2.png', 'test3-2');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` varchar(25) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_kuantiti` int(5) NOT NULL,
  `total_harga` decimal(12,0) NOT NULL,
  `status` enum('Sedang Diproses','Sedang Dikirim','Berhasil','Gagal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `id_petugas`, `id_alamat`, `id_user`, `tanggal`, `jumlah_kuantiti`, `total_harga`, `status`) VALUES
('', NULL, 1, 1, '2018-01-29', 23, '23', 'Sedang Diproses'),
('testest', 1, 1, 1, '2018-01-29', 1, '12', 'Sedang Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tipe_user` enum('admin','pembeli','penjual') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `email`, `password`, `no_hp`, `tipe_user`) VALUES
(1, 'admin', 'Administrator', 'irsyadfau27@gmail.com', '$2y$12$9k9D35jXdNXBKbPvVWVACebYxQAevyLFyP9TCRi.jqFItL5pfbbee', '08123456789', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`no_detail_transaksi`),
  ADD KEY `no_produk` (`no_produk`),
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`no_kategori`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `petugas_kurir`
--
ALTER TABLE `petugas_kurir`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`no_produk`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `no_kategori` (`no_kategori`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_alamat` (`id_alamat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `no_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `no_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `petugas_kurir`
--
ALTER TABLE `petugas_kurir`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `no_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`no_produk`) REFERENCES `produk` (`no_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`no_kategori`) REFERENCES `kategori_produk` (`no_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas_kurir` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_alamat`) REFERENCES `alamat` (`id_alamat`) ON DELETE CASCADE ON UPDATE CASCADE;
