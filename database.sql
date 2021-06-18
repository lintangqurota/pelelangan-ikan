-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Feb 2017 pada 15.28
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_tpi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskusi`
--

CREATE TABLE IF NOT EXISTS `diskusi` (
  `id_diskusi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `komentar` text NOT NULL,
  `status` enum('y','n') NOT NULL DEFAULT 'n',
  `balas` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_diskusi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `diskusi`
--

INSERT INTO `diskusi` (`id_diskusi`, `tanggal`, `nama`, `email`, `komentar`, `status`, `balas`) VALUES
(1, '2016-08-26 02:37:56', 'Tukijan', 'tukijan@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'y', 0),
(2, '2016-08-26 14:01:39', 'Admin', 'admin@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.', 'y', 1),
(3, '2016-08-26 15:32:14', 'Suparman', 'suparman@gmail.com', 'Quae repudiandae fugiat illo cupiditate excepturi esse officiis consectetur', 'y', 0),
(4, '2016-08-26 15:35:15', 'Marijan', 'marijan@gmail.com', 'Ad necessitatibus velit, accusantium expedita debitis impedit rerum totam id', 'n', 0),
(5, '2016-08-26 16:33:57', 'Admin', 'admin@gmail.com', 'Quae repudiandae fugiat illo cupiditate', 'y', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ikan`
--

CREATE TABLE IF NOT EXISTS `ikan` (
  `id_ikan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ikan` varchar(30) NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_ikan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `ikan`
--

INSERT INTO `ikan` (`id_ikan`, `nama_ikan`, `gambar`, `keterangan`) VALUES
(1, 'Kuwe Batu', 'kuwebatu.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod'),
(2, 'Kakap Merah', 'kakapmerah.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur Lorem ipsum dolor sit amet, consectetur adipisicing elit.'),
(3, 'Hiu', 'mackerelspanyol.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur Lorem ipsum dolor sit amet, consectetur adipisicing elit.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ikan_masuk`
--

CREATE TABLE IF NOT EXISTS `ikan_masuk` (
  `id_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_masuk` date NOT NULL,
  `id_ikan` int(11) NOT NULL,
  `id_nelayan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_masuk`),
  KEY `id_ikan` (`id_ikan`,`id_nelayan`),
  KEY `id_nelayan` (`id_nelayan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_lelang` date NOT NULL,
  `waktu_lelang` enum('Lelang Pagi 06:00 WIB','Lelang Sore 15:00 WIB') NOT NULL,
  `id_masuk` int(11) NOT NULL,
  `kisaran_harga` varchar(20) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `ikan` (`id_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nelayan`
--

CREATE TABLE IF NOT EXISTS `nelayan` (
  `id_nelayan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_nelayan` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  PRIMARY KEY (`id_nelayan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `nelayan`
--

INSERT INTO `nelayan` (`id_nelayan`, `nama_nelayan`, `alamat`, `telepon`) VALUES
(1, 'Paijo', 'Bandar Lampung', '085758857775'),
(2, 'Bejo', 'Tanjung Karang Pusat', '081294839399');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE IF NOT EXISTS `pembeli` (
  `id_pembeli` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pembeli` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  PRIMARY KEY (`id_pembeli`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_pembeli`, `alamat`, `telepon`) VALUES
(1, 'Paiman', 'Bandar Lampung', '085789892900'),
(2, 'Tukijan', 'Pringsewu', '081399327282');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang_tpi`
--

CREATE TABLE IF NOT EXISTS `tentang_tpi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tentang_tpi`
--

INSERT INTO `tentang_tpi` (`id`, `isi`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_lelang`
--

CREATE TABLE IF NOT EXISTS `transaksi_lelang` (
  `id_transaksi` varchar(3) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_masuk` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_masuk` (`id_masuk`,`id_pembeli`),
  KEY `id_pembeli` (`id_pembeli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `hak_akses` enum('Admin','Dinas') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `hak_akses`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Joan Pasaribu', 'Admin'),
(2, 'dinas', '202cb962ac59075b964b07152d234b70', 'Dinas Perikanan', 'Dinas');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ikan_masuk`
--
ALTER TABLE `ikan_masuk`
  ADD CONSTRAINT `ikan_masuk_ibfk_1` FOREIGN KEY (`id_ikan`) REFERENCES `ikan` (`id_ikan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ikan_masuk_ibfk_2` FOREIGN KEY (`id_nelayan`) REFERENCES `nelayan` (`id_nelayan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_masuk`) REFERENCES `ikan_masuk` (`id_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_lelang`
--
ALTER TABLE `transaksi_lelang`
  ADD CONSTRAINT `transaksi_lelang_ibfk_1` FOREIGN KEY (`id_masuk`) REFERENCES `ikan_masuk` (`id_masuk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_lelang_ibfk_2` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
