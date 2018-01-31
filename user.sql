-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31 Jan 2018 pada 15.56
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sayuronline`
--

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `email`, `password`, `no_hp`, `tipe_user`) VALUES
(1, 'admin', 'administrator', 'admin@gmail.com', '$2y$12$RaAbxrDGMPvq3ZdU4Ctt8uUG49.yKB.Dj7ihlHgpdwWFk1eVnlsqK', '08131908220', 'admin'),
(2, 'yumavol', 'yuma yusuf', 'yumavol@gmail.com', '$2y$12$RaAbxrDGMPvq3ZdU4Ctt8uUG49.yKB.Dj7ihlHgpdwWFk1eVnlsqK', '0813109080223', 'pembeli'),
(3, 'pedagan sayuran', 'pedagang', 'pedagang@gmail.com', '$2y$12$RaAbxrDGMPvq3ZdU4Ctt8uUG49.yKB.Dj7ihlHgpdwWFk1eVnlsqK', '081319080220', 'penjual');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
