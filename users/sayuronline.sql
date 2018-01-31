-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 01, 2018 at 06:40 AM
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
(1, 'Sayur', 'Sayur'),
(2, 'Buah', 'Buah');

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
(1, 2, 'Apel', 'Dijual perkilogram.', '27000', 'Apel.png', 'Apel'),
(2, 2, 'Pisang', 'Dijual persisir.', '7000', 'Pisang.png', 'Pisang'),
(3, 2, 'Pepaya', 'Dijual perkilogram.', '5000', 'Pepaya.png', 'Pepaya'),
(4, 2, 'Jeruk', 'Dijual perkilogram.', '17000', 'Jeruk.png', 'Jeruk'),
(5, 2, 'Melon', 'Dijual perkilogram.', '10000', 'Melon.png', 'Melon'),
(6, 2, 'Nanas', 'Dijual perkilogram.', '7000', 'Nanas.png', 'Nanas'),
(7, 2, 'Semangka', 'Dijual perkilogram.', '6000', 'Semangka.png', 'Semangka'),
(8, 2, 'Lemon', 'Dijual perkilogram.', '10000', 'Lemon.png', 'Lemon'),
(9, 1, 'Seledri', 'Dijual perkilogram.', '10000', 'Seledri.png', 'Seledri'),
(10, 1, 'Brokoli', 'Dijual perkilogram.', '11000', 'Brokoli.png', 'Brokoli'),
(11, 1, 'Kentang', 'Dijual perkilogram.', '11000', 'Kentang.png', 'Kentang'),
(12, 1, 'Bawang Putih', 'Dijual perkilogram.', '10000', 'Bawang-Putih.png', 'Bawang-Putih'),
(13, 1, 'Bawang Merah', 'Dijual perkilogram.', '23000', 'Bawang-Merah.png', 'Bawang-Merah'),
(14, 1, 'Bawang Daun', 'Dijual perkilogram.', '13000', 'Bawang-Daun.png', 'Bawang-Daun'),
(15, 1, 'Wortel', 'Dijual perkilogram.', '25000', 'Wortel.png', 'Wortel'),
(16, 1, 'Tomat', 'Dijual perkilogram.', '2000', 'Tomat.png', 'Tomat'),
(17, 1, 'Terong', 'Dijual perkilogram.', '8000', 'Terong.png', 'Terong'),
(18, 1, 'Jamur', 'Dijual perkilogram.', '15000', 'Jamur.png', 'Jamur'),
(19, 1, 'Cabai', 'Dijual perkilogram.', '10000', 'Cabai.png', 'Cabai'),
(20, 1, 'Lobak', 'Dijual perkilogram.', '12000', 'Lobak.png', 'Lobak'),
(21, 1, 'Paprika', 'Dijual perkilogram.', '12000', 'Paprika.png', 'Paprika'),
(22, 1, 'Selada', 'Dijual perkilogram.', '7000', 'Selada.png', 'Selada');

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
  `status` enum('Sedang Diproses','Sedang Dikirim','Berhasil','Gagal','Menunggu Bukti Transfer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

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
(1, 'admin', 'Administrator', 'irsyadfau27@gmail.com', '$2y$12$ILm9c9gspjh5xeiabciSAukplwgqH.9DXEsFLoYCGKmBxo9pljWcW', '08123456789', 'admin'),
(2, 'penjual', 'Penjual hehe', 'aku@penjual.com', '$2y$12$ILm9c9gspjh5xeiabciSAukplwgqH.9DXEsFLoYCGKmBxo9pljWcW', '0123456789', 'penjual'),
(3, 'pembeli', 'pembeli', 'aku@pembeli.com', '$2y$12$ILm9c9gspjh5xeiabciSAukplwgqH.9DXEsFLoYCGKmBxo9pljWcW', '0123456789', 'pembeli');

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
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `no_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `no_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `petugas_kurir`
--
ALTER TABLE `petugas_kurir`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `no_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
