-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2021 pada 16.32
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `incoming_id` int(6) NOT NULL,
  `outgoing_id` int(6) NOT NULL,
  `pesan` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `message`
--

INSERT INTO `message` (`message_id`, `incoming_id`, `outgoing_id`, `pesan`, `waktu`) VALUES
(1, 210001, 210002, 'test', '2021-04-29 13:09:23'),
(2, 210002, 210001, 'test juga', '2021-04-29 13:10:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `uniqueid` int(6) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `uniqueid`, `username`, `password`, `images`, `status`) VALUES
(1, 210001, 'midna', 'e10adc3949ba59abbe56e057f20f883e', 'icon2.jpg', 'online'),
(2, 210002, 'fey', 'e10adc3949ba59abbe56e057f20f883e', 'icon.jpg', 'online'),
(3, 210003, 'you', 'e10adc3949ba59abbe56e057f20f883e', 'icon3.jpg', 'online'),
(4, 210004, 'akuaja', 'e10adc3949ba59abbe56e057f20f883e', 'icon4.jpg', 'online'),
(5, 210005, 'kamu', 'e10adc3949ba59abbe56e057f20f883e', 'am-chatapps-1619698652icon5.jpg', 'offline'),
(6, 210006, 'test1', 'e10adc3949ba59abbe56e057f20f883e', 'am-chatapps-1619702750Ki-Hadjar-Dewantara-6-960x540.png', 'offline'),
(7, 210007, 'test2', 'e10adc3949ba59abbe56e057f20f883e', 'am-chatapps-1619702766ink texture.jpg', 'offline'),
(8, 210008, 'test3', 'e10adc3949ba59abbe56e057f20f883e', 'am-chatapps-1619702781489052927d9531b641a36094ccf03535.jpg', 'offline'),
(9, 210009, 'test4', 'e10adc3949ba59abbe56e057f20f883e', 'am-chatapps-1619704044KRI-Nanggala-402.jpg', 'offline');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
