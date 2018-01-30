-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2018 at 12:02 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sayuronline`
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
(2, 'penjual', 'Penjual', 'aku@penjual.com', '$2y$12$ILm9c9gspjh5xeiabciSAukplwgqH.9DXEsFLoYCGKmBxo9pljWcW', '0123456789', 'penjual'),
(3, 'pembeli', 'pembeli', 'aku@pembeli.com', '$2y$12$ILm9c9gspjh5xeiabciSAukplwgqH.9DXEsFLoYCGKmBxo9pljWcW', '0123456789', 'pembeli');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;