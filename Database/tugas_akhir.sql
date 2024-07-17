-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2024 pada 15.25
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `brgkode` char(10) NOT NULL,
  `brgnama` varchar(100) NOT NULL,
  `brgkatid` int(10) UNSIGNED NOT NULL,
  `brgsatid` int(10) UNSIGNED NOT NULL,
  `brgharga` double NOT NULL,
  `brggambar` varchar(200) NOT NULL,
  `brgstok` int(11) NOT NULL,
  `brgsupid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`brgkode`, `brgnama`, `brgkatid`, `brgsatid`, `brgharga`, `brggambar`, `brgstok`, `brgsupid`) VALUES
('1', 'Minyak bimoli', 35, 14, 14000, '', 111, 4),
('2', 'Aqua', 26, 8, 32000, '', 1, 4),
('G-1', 'Gas Elpiji 3kg', 42, 1, 14000, '', 10, 4),
('M-1', 'Kacang kulit', 25, 4, 30000, '', 20, 4),
('PM-1', 'Sabun Lifebuoy', 33, 1, 14000, '', 12, 6),
('PM-2', 'Sunlight 250ml', 33, 8, 400000, '', 18, 6),
('S-1', 'Beras', 35, 11, 560000, '', 30, 4),
('S-2', 'Gula Putih', 35, 12, 400000, '', 26, 4),
('S-3', 'Telur', 35, 4, 31000, '', 60, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `faktur` char(20) NOT NULL,
  `tglfaktur` date DEFAULT NULL,
  `idpel` int(11) NOT NULL,
  `totalharga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barangkeluar`
--

INSERT INTO `barangkeluar` (`faktur`, `tglfaktur`, `idpel`, `totalharga`) VALUES
('1306240001', '2024-05-24', 1, 432000),
('1606240001', '2024-05-16', 3, 554000),
('1706240001', '2024-05-17', 2, 1388000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `faktur` char(20) NOT NULL,
  `tglfaktur` date NOT NULL,
  `totalharga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barangmasuk`
--

INSERT INTO `barangmasuk` (`faktur`, `tglfaktur`, `totalharga`) VALUES
('f-1', '2024-05-21', 5500000),
('f-2', '2024-05-26', 7000000),
('f-3', '2024-05-24', 280000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_barangkeluar`
--

CREATE TABLE `detail_barangkeluar` (
  `id` bigint(20) NOT NULL,
  `detfaktur` char(20) DEFAULT NULL,
  `detbrgkode` char(10) DEFAULT NULL,
  `dethargajual` double DEFAULT NULL,
  `detjml` int(11) DEFAULT NULL,
  `detsubtotal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_barangkeluar`
--

INSERT INTO `detail_barangkeluar` (`id`, `detfaktur`, `detbrgkode`, `dethargajual`, `detjml`, `detsubtotal`) VALUES
(75, '1306240001', '2', 32000, 1, 32000),
(76, '1306240001', 'PM-2', 400000, 1, 400000),
(78, '1706240001', '2', 32000, 39, 1248000),
(79, '1706240001', '1', 14000, 10, 140000),
(80, '1606240001', 'G-1', 14000, 11, 154000),
(81, '1606240001', 'PM-2', 400000, 1, 400000);

--
-- Trigger `detail_barangkeluar`
--
DELIMITER $$
CREATE TRIGGER `tri_delete_detailBarangKeluar` AFTER DELETE ON `detail_barangkeluar` FOR EACH ROW BEGIN
    UPDATE barang SET brgstok = brgstok + old.detjml WHERE brgkode = old.detbrgkode;
	END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tri_insert_detailBarangKeluar` AFTER INSERT ON `detail_barangkeluar` FOR EACH ROW BEGIN
    UPDATE barang SET brgstok = brgstok - new.detjml WHERE brgkode = new.detbrgkode;
	END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tri_update_detailBarangKeluar` AFTER UPDATE ON `detail_barangkeluar` FOR EACH ROW BEGIN
    UPDATE barang SET brgstok = (brgstok + old.detjml) - new.detjml WHERE brgkode = new.detbrgkode;
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_barangmasuk`
--

CREATE TABLE `detail_barangmasuk` (
  `iddetail` bigint(20) NOT NULL,
  `detfaktur` char(20) NOT NULL,
  `detbrgkode` char(10) NOT NULL,
  `dethargamasuk` double NOT NULL,
  `dethargajual` double NOT NULL,
  `detjml` int(11) NOT NULL,
  `detsubtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_barangmasuk`
--

INSERT INTO `detail_barangmasuk` (`iddetail`, `detfaktur`, `detbrgkode`, `dethargamasuk`, `dethargajual`, `detjml`, `detsubtotal`) VALUES
(22, 'f-1', '1', 7000, 10000, 100, 700000),
(30, 'f-2', 'S-2', 350000, 400000, 20, 7000000),
(31, 'f-3', 'S-3', 28000, 31000, 10, 280000),
(32, 'f-1', 'S-1', 400000, 560000, 12, 4800000);

--
-- Trigger `detail_barangmasuk`
--
DELIMITER $$
CREATE TRIGGER `tri_kurangi_stok_barang` AFTER DELETE ON `detail_barangmasuk` FOR EACH ROW BEGIN
	UPDATE barang SET brgstok = brgstok - old.detjml WHERE  brgkode = old.detbrgkode;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tri_tambah_stok_barang` AFTER INSERT ON `detail_barangmasuk` FOR EACH ROW BEGIN
	UPDATE barang 
		SET barang.`brgstok` = barang.`brgstok` + new.detjml WHERE barang.`brgkode`=new.detbrgkode;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tri_update_stok_barang` AFTER UPDATE ON `detail_barangmasuk` FOR EACH ROW BEGIN
	UPDATE barang SET brgstok = (brgstok - old.detjml) + new.detjml
	WHERE brgkode = new.detbrgkode;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `katid` int(10) UNSIGNED NOT NULL,
  `katnama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`katid`, `katnama`) VALUES
(25, 'makanan'),
(26, 'minuman'),
(32, 'Mie Instan'),
(33, 'Peralatan mandi dan cuci'),
(34, 'rokok'),
(35, 'Sembako'),
(37, 'obat-obatan'),
(38, 'bumbu dapur'),
(39, 'Alat Tulis'),
(40, 'perlengkapan bayi'),
(41, 'Perlengkapan rumah tangga'),
(42, 'Gas Elpiji'),
(43, 'Lain-Lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `levelid` int(11) NOT NULL,
  `levelnama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`levelid`, `levelnama`) VALUES
(1, 'Admin'),
(2, 'Pemilik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-05-13-023949', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1715613841, 1),
(2, '2024-05-13-024007', 'App\\Database\\Migrations\\Satuan', 'default', 'App', 1715613841, 1),
(3, '2024-05-13-024016', 'App\\Database\\Migrations\\Barang', 'default', 'App', 1715613841, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelid` int(11) NOT NULL,
  `pelnama` varchar(100) NOT NULL,
  `peltelp` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`pelid`, `pelnama`, `peltelp`) VALUES
(1, 'rifqi', '0895710818600'),
(2, 'iqbal', '08957108826'),
(3, 'farhan', '0865141861');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `satid` int(10) UNSIGNED NOT NULL,
  `satnama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`satid`, `satnama`) VALUES
(1, 'unit'),
(4, 'kg'),
(5, '1/4kg'),
(6, '1/2kg'),
(7, 'Pcs'),
(8, 'Dus'),
(9, 'Bal'),
(10, 'Lusin'),
(11, '1kuintal'),
(12, '1/2kuintal'),
(13, '1/4kuintal'),
(14, 'Liter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `supid` int(11) NOT NULL,
  `supnama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`supid`, `supnama`) VALUES
(4, '-'),
(5, 'Mayora'),
(6, 'Unilever');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_barangkeluar`
--

CREATE TABLE `temp_barangkeluar` (
  `id` bigint(20) NOT NULL,
  `detfaktur` char(20) DEFAULT NULL,
  `detbrgkode` char(10) DEFAULT NULL,
  `dethargajual` double DEFAULT NULL,
  `detjml` int(11) DEFAULT NULL,
  `detsubtotal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `temp_barangkeluar`
--

INSERT INTO `temp_barangkeluar` (`id`, `detfaktur`, `detbrgkode`, `dethargajual`, `detjml`, `detsubtotal`) VALUES
(64, '0506240003', 'S-1', 560000, 1, 560000),
(65, '0506240003', 'S-3', 31000, 1, 31000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_barangmasuk`
--

CREATE TABLE `temp_barangmasuk` (
  `iddetail` bigint(20) NOT NULL,
  `detfaktur` char(20) NOT NULL,
  `detbrgkode` char(10) NOT NULL,
  `dethargamasuk` double NOT NULL,
  `dethargajual` double NOT NULL,
  `detjml` int(11) NOT NULL,
  `detsubtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `temp_barangmasuk`
--

INSERT INTO `temp_barangmasuk` (`iddetail`, `detfaktur`, `detbrgkode`, `dethargamasuk`, `dethargajual`, `detjml`, `detsubtotal`) VALUES
(44, 'f-10', '1', 10000, 14000, 12, 120000),
(45, 'f-4', '2', 20000, 32000, 10, 200000),
(46, 'f-4', '1', 10000, 14000, 20, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userid` char(50) NOT NULL,
  `usernama` varchar(100) DEFAULT NULL,
  `userpassword` varchar(100) DEFAULT NULL,
  `userlevelid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userid`, `usernama`, `userpassword`, `userlevelid`) VALUES
('admin', 'admin', '$2y$10$Wu.WJjib8cxi8AGUfG3Gmu86XLJUb11GS8sD/Vzw3k.8hkObP.qMi', 1),
('pemilik', 'Pemilik Toko', '$2y$10$6DvFJ8faBp2wdl5ucvOb.uXZb7M50IqPhWbkduBdDjKu5dcEhm..K', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`brgkode`),
  ADD KEY `barang_brgkatid_foreign` (`brgkatid`),
  ADD KEY `barang_brgsatid_foreign` (`brgsatid`),
  ADD KEY `brgsupid` (`brgsupid`);

--
-- Indeks untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`faktur`);

--
-- Indeks untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`faktur`);

--
-- Indeks untuk tabel `detail_barangkeluar`
--
ALTER TABLE `detail_barangkeluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detfaktur` (`detfaktur`),
  ADD KEY `detbrgkode` (`detbrgkode`);

--
-- Indeks untuk tabel `detail_barangmasuk`
--
ALTER TABLE `detail_barangmasuk`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `detbrgkode` (`detbrgkode`),
  ADD KEY `detfaktur` (`detfaktur`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD KEY `katid` (`katid`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`levelid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelid`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD KEY `satid` (`satid`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD KEY `supid` (`supid`);

--
-- Indeks untuk tabel `temp_barangkeluar`
--
ALTER TABLE `temp_barangkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp_barangmasuk`
--
ALTER TABLE `temp_barangmasuk`
  ADD PRIMARY KEY (`iddetail`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_barangkeluar`
--
ALTER TABLE `detail_barangkeluar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `detail_barangmasuk`
--
ALTER TABLE `detail_barangmasuk`
  MODIFY `iddetail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `katid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `levelid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `satid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `temp_barangkeluar`
--
ALTER TABLE `temp_barangkeluar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `temp_barangmasuk`
--
ALTER TABLE `temp_barangmasuk`
  MODIFY `iddetail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_brgkatid_foreign` FOREIGN KEY (`brgkatid`) REFERENCES `kategori` (`katid`),
  ADD CONSTRAINT `barang_brgsatid_foreign` FOREIGN KEY (`brgsatid`) REFERENCES `satuan` (`satid`),
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`brgsupid`) REFERENCES `supplier` (`supid`);

--
-- Ketidakleluasaan untuk tabel `detail_barangkeluar`
--
ALTER TABLE `detail_barangkeluar`
  ADD CONSTRAINT `detail_barangkeluar_ibfk_1` FOREIGN KEY (`detfaktur`) REFERENCES `barangkeluar` (`faktur`),
  ADD CONSTRAINT `detail_barangkeluar_ibfk_2` FOREIGN KEY (`detbrgkode`) REFERENCES `barang` (`brgkode`);

--
-- Ketidakleluasaan untuk tabel `detail_barangmasuk`
--
ALTER TABLE `detail_barangmasuk`
  ADD CONSTRAINT `detail_barangmasuk_ibfk_1` FOREIGN KEY (`detbrgkode`) REFERENCES `barang` (`brgkode`),
  ADD CONSTRAINT `detail_barangmasuk_ibfk_2` FOREIGN KEY (`detfaktur`) REFERENCES `barangmasuk` (`faktur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
