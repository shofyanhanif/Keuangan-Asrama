-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 20 Jul 2023 pada 13.26
-- Versi server: 5.7.36
-- Versi PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_asrama`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asrama`
--

DROP TABLE IF EXISTS `asrama`;
CREATE TABLE IF NOT EXISTS `asrama` (
  `ID_ASRAMA` varchar(2) NOT NULL,
  `ASRAMA` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_ASRAMA`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `asrama`
--

INSERT INTO `asrama` (`ID_ASRAMA`, `ASRAMA`) VALUES
('01', 'Asrama Induk Ibnu Sina'),
('02', 'Asrama Induk Al Azhar'),
('03', 'Asrama Induk Ibnu Kholdun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

DROP TABLE IF EXISTS `kamar`;
CREATE TABLE IF NOT EXISTS `kamar` (
  `ID_KAMAR` int(2) NOT NULL AUTO_INCREMENT,
  `ID_ASRAMA` int(2) NOT NULL,
  `NO_KAMAR` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_KAMAR`),
  KEY `FK_MEMILIKI` (`ID_ASRAMA`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`ID_KAMAR`, `ID_ASRAMA`, `NO_KAMAR`) VALUES
(7, 1, 'Kamar 12'),
(8, 1, 'Kamar 13'),
(9, 1, 'Kamar 14'),
(10, 1, 'Kamar 15'),
(11, 2, 'H01'),
(12, 2, 'H02'),
(14, 2, 'H03'),
(15, 2, 'H04'),
(16, 2, 'H05'),
(17, 2, 'H06'),
(18, 2, 'H07'),
(19, 2, 'H08'),
(20, 2, 'H09'),
(22, 3, 'Kamar 1'),
(23, 3, 'Kamar 2'),
(24, 3, 'Kamar 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembaga`
--

DROP TABLE IF EXISTS `lembaga`;
CREATE TABLE IF NOT EXISTS `lembaga` (
  `ID_LEMBAGA` int(2) NOT NULL AUTO_INCREMENT,
  `NAMA_LEMBAGA` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_LEMBAGA`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lembaga`
--

INSERT INTO `lembaga` (`ID_LEMBAGA`, `NAMA_LEMBAGA`) VALUES
(7, 'UNIPDU JOMBANG'),
(8, 'UNDAR JOMBANG'),
(9, 'UNWAHA JOMBANG'),
(10, 'UNHASY JOMBANG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE IF NOT EXISTS `level` (
  `ID_LEVEL` int(11) NOT NULL AUTO_INCREMENT,
  `LEVEL` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_LEVEL`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`ID_LEVEL`, `LEVEL`) VALUES
(1, 'Admin'),
(2, 'Pengasuh'),
(3, 'Pengurus'),
(4, 'Santri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `ID_PEMBAYARAN` varchar(100) NOT NULL,
  `ID_PETUGAS` int(11) DEFAULT NULL,
  `ID_SANTRI` varchar(11) NOT NULL,
  `TGL_BAYAR` date DEFAULT NULL,
  `NOMINAL` varchar(30) DEFAULT NULL,
  `JENIS_BAYAR` enum('Langsung','Online') DEFAULT NULL,
  `BANK` varchar(20) DEFAULT NULL,
  `BUKTI` varchar(100) DEFAULT NULL,
  `STATUS` enum('Menunggu','Valid','Tidak Valid') DEFAULT NULL,
  `KET` text,
  PRIMARY KEY (`ID_PEMBAYARAN`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`ID_PEMBAYARAN`, `ID_PETUGAS`, `ID_SANTRI`, `TGL_BAYAR`, `NOMINAL`, `JENIS_BAYAR`, `BANK`, `BUKTI`, `STATUS`, `KET`) VALUES
('BPOD0230703001003', NULL, '0321001', '2023-07-17', '300000', 'Online', NULL, 'images.png', 'Menunggu', 'lasnjkaksjksna'),
('BPLD6230702002003', 6, '0219002', '2023-07-17', '250000', 'Langsung', NULL, NULL, NULL, NULL),
('BPLD6230702001001', 6, '0219001', '2023-07-14', '500000', 'Langsung', NULL, NULL, NULL, NULL),
('BPOD0230701001002', NULL, '0119001', '2023-07-14', '800000', 'Online', NULL, 'struk-atm-bri.jpg', 'Valid', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `ID_PENGELUARAN` int(11) NOT NULL AUTO_INCREMENT,
  `TANGGAL` date DEFAULT NULL,
  `KETERANGAN` varchar(100) DEFAULT NULL,
  `NOMINAL` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_PENGELUARAN`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`ID_PENGELUARAN`, `TANGGAL`, `KETERANGAN`, `NOMINAL`) VALUES
(10, '2023-07-14', 'Membeli Alat Kebersihan', '200000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

DROP TABLE IF EXISTS `petugas`;
CREATE TABLE IF NOT EXISTS `petugas` (
  `ID_PETUGAS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_LEVEL` int(11) NOT NULL,
  `NAMA_PETUGAS` varchar(50) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(300) NOT NULL,
  `NO_HP` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`ID_PETUGAS`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`ID_PETUGAS`, `ID_LEVEL`, `NAMA_PETUGAS`, `USERNAME`, `PASSWORD`, `NO_HP`) VALUES
(1, 1, 'Shofyan Hanif', 'admin', 'admin', NULL),
(2, 3, 'Zaki', 'pengurus1', 'pengurus1', '081212341234'),
(6, 3, 'Ilham F', 'pengurus2', 'pengurus2', '081243214321');

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

DROP TABLE IF EXISTS `santri`;
CREATE TABLE IF NOT EXISTS `santri` (
  `ID_SANTRI` varchar(7) NOT NULL,
  `ID_ASRAMA` char(3) DEFAULT NULL,
  `ID_KAMAR` varchar(3) DEFAULT NULL,
  `ID_LEMBAGA` int(2) DEFAULT NULL,
  `ID_LEVEL` int(11) DEFAULT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(300) DEFAULT NULL,
  `TEMPAT_LHR` varchar(20) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `JK` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `ALAMAT` varchar(300) DEFAULT NULL,
  `ID_PROVINSI` int(11) DEFAULT NULL,
  `ID_KOTA` int(11) DEFAULT NULL,
  `NO_HP` varchar(13) DEFAULT NULL,
  `THN_MASUK` varchar(10) DEFAULT NULL,
  `STATUS` enum('Aktif','Tidak Aktif') NOT NULL,
  PRIMARY KEY (`ID_SANTRI`),
  KEY `FK_TINGGAL` (`ID_ASRAMA`),
  KEY `ID_KAMAR` (`ID_KAMAR`),
  KEY `ID_LEMBAGA` (`ID_LEMBAGA`),
  KEY `ID_LEVEL` (`ID_LEVEL`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`ID_SANTRI`, `ID_ASRAMA`, `ID_KAMAR`, `ID_LEMBAGA`, `ID_LEVEL`, `NAMA`, `EMAIL`, `PASSWORD`, `TEMPAT_LHR`, `TGL_LAHIR`, `JK`, `ALAMAT`, `ID_PROVINSI`, `ID_KOTA`, `NO_HP`, `THN_MASUK`, `STATUS`) VALUES
('0219001', '02', '19', 7, 4, 'Muhammad Shofyan Hanif', 'emshofyanhanif@gmail.com', 'hanif', 'Purworejo', '2023-06-01', 'Laki-Laki', 'Caren Lor Rt 02 Rw 02 Kaliurip Bener Purworejo Jawa Tengah', 33, 3306, '081228638240', '2023', 'Aktif'),
('0119001', '01', '7', 7, 4, 'Andik Fernando', 'andik@gmail.com', 'andik', 'Madura', '2023-06-01', 'Laki-Laki', 'Tanjung Kiaok, Sumenep, Madura', 35, 3517, '081212341234', '2023', 'Aktif'),
('0121001', '01', '10', 7, 4, 'Tesar Malik', 'tesar@gmail.com', 'tesar', 'Magelang', '2023-06-01', 'Laki-Laki', 'Armada, Secang, Magelang', 33, 3308, '081212341234', '2023', 'Aktif'),
('0219002', '02', '17', 7, 4, 'Rozi Arfin', 'rozi@gmail.com', 'rozi', 'Magelang', '2023-06-01', 'Laki-Laki', 'Tegalrejo, Magelang', 33, 3308, '081212341234', '2023', 'Aktif'),
('0221001', '02', '14', 7, 4, 'Yusril Ibnu', 'yusril@gmail.com', 'yusril', 'Magelang', '2023-07-01', 'Laki-Laki', 'Tegalrejo, Magelang', 33, 3308, '081212341234', '2023', 'Aktif'),
('0321001', '03', '23', 7, 4, 'Ali Mawardi', '', 'mawardi', 'Pekalongan', '2023-06-01', 'Laki-Laki', 'Pekalongan, Jawa Tengah', 33, 3326, '081212341234', '2023', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

DROP TABLE IF EXISTS `spp`;
CREATE TABLE IF NOT EXISTS `spp` (
  `ID_SPP` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ASRAMA` int(2) NOT NULL,
  `TAHUN` varchar(4) DEFAULT NULL,
  `KATEGORI` varchar(30) DEFAULT NULL,
  `NOMINAL` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID_SPP`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`ID_SPP`, `ID_ASRAMA`, `TAHUN`, `KATEGORI`, `NOMINAL`) VALUES
(10, 1, '2023', 'Biaya Makan Bulanan', '300000'),
(11, 2, '2023', 'Biaya Makan Bulanan', '250000'),
(12, 1, '2023', 'Biaya Laundri Seragam', '100000'),
(13, 3, '2023', 'Biaya Makan Per Bulan', '300000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

DROP TABLE IF EXISTS `tagihan`;
CREATE TABLE IF NOT EXISTS `tagihan` (
  `ID_TAGIHAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SANTRI` varchar(7) NOT NULL,
  `TAHUN` varchar(4) NOT NULL,
  `BULAN` varchar(10) NOT NULL,
  `KATEGORI` varchar(30) DEFAULT NULL,
  `NOMINAL` varchar(15) DEFAULT NULL,
  `STATUS` enum('Tunggakan','Lunas') NOT NULL,
  PRIMARY KEY (`ID_TAGIHAN`),
  KEY `ID_MAHASISWA` (`ID_SANTRI`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`ID_TAGIHAN`, `ID_SANTRI`, `TAHUN`, `BULAN`, `KATEGORI`, `NOMINAL`, `STATUS`) VALUES
(40, '0119001', '2023', '6', 'Biaya Makan Bulanan', '300000', 'Lunas'),
(39, '0219001', '2023', '6', 'Biaya Makan Bulanan', '250000', 'Lunas'),
(41, '0119001', '2023', '6', 'Biaya Laundri Seragam', '100000', 'Lunas'),
(42, '0219001', '2023', '7', 'Biaya Makan Bulanan', '250000', 'Lunas'),
(43, '0119001', '2023', '7', 'Biaya Makan Bulanan', '300000', 'Lunas'),
(44, '0119001', '2023', '7', 'Biaya Laundri Seragam', '100000', 'Lunas'),
(47, '0219002', '2023', '7', 'Biaya Makan Bulanan', '250000', 'Lunas'),
(48, '0121001', '2023', '7', 'Biaya Makan Bulanan', '300000', 'Tunggakan'),
(49, '0121001', '2023', '7', 'Biaya Laundri Seragam', '100000', 'Tunggakan'),
(50, '0221001', '2023', '7', 'Biaya Makan Bulanan', '250000', 'Tunggakan'),
(51, '0321001', '2023', '7', 'Biaya Makan Per Bulan', '300000', 'Tunggakan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kabupaten`
--

DROP TABLE IF EXISTS `tbl_kabupaten`;
CREATE TABLE IF NOT EXISTS `tbl_kabupaten` (
  `ID_KAB` char(5) NOT NULL,
  `ID_PROV` char(2) DEFAULT NULL,
  `NAMA_KAB` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`ID_KAB`),
  KEY `FK_RELATIONSHIP_10` (`ID_PROV`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kabupaten`
--

INSERT INTO `tbl_kabupaten` (`ID_KAB`, `ID_PROV`, `NAMA_KAB`) VALUES
('1101', '11', 'KAB. ACEH SELATAN'),
('1102', '11', 'KAB. ACEH TENGGARA'),
('1103', '11', 'KAB. ACEH TIMUR'),
('1104', '11', 'KAB. ACEH TENGAH'),
('1105', '11', 'KAB. ACEH BARAT'),
('1106', '11', 'KAB. ACEH BESAR'),
('1107', '11', 'KAB. PIDIE'),
('1108', '11', 'KAB. ACEH UTARA'),
('1109', '11', 'KAB. SIMEULUE'),
('1110', '11', 'KAB. ACEH SINGKIL'),
('1111', '11', 'KAB. BIREUEN'),
('1112', '11', 'KAB. ACEH BARAT DAYA'),
('1113', '11', 'KAB. GAYO LUES'),
('1114', '11', 'KAB. ACEH JAYA'),
('1115', '11', 'KAB. NAGAN RAYA'),
('1116', '11', 'KAB. ACEH TAMIANG'),
('1117', '11', 'KAB. BENER MERIAH'),
('1118', '11', 'KAB. PIDIE JAYA'),
('1171', '11', 'KOTA BANDA ACEH'),
('1172', '11', 'KOTA SABANG'),
('1173', '11', 'KOTA LHOKSEUMAWE'),
('1174', '11', 'KOTA LANGSA'),
('1175', '11', 'KOTA SUBULUSSALAM'),
('1201', '12', 'KAB. TAPANULI TENGAH'),
('1202', '12', 'KAB. TAPANULI UTARA'),
('1203', '12', 'KAB. TAPANULI SELATAN'),
('1204', '12', 'KAB. NIAS'),
('1205', '12', 'KAB. LANGKAT'),
('1206', '12', 'KAB. KARO'),
('1207', '12', 'KAB. DELI SERDANG'),
('1208', '12', 'KAB. SIMALUNGUN'),
('1209', '12', 'KAB. ASAHAN'),
('1210', '12', 'KAB. LABUHANBATU'),
('1211', '12', 'KAB. DAIRI'),
('1212', '12', 'KAB. TOBA SAMOSIR'),
('1213', '12', 'KAB. MANDAILING NATAL'),
('1214', '12', 'KAB. NIAS SELATAN'),
('1215', '12', 'KAB. PAKPAK BHARAT'),
('1216', '12', 'KAB. HUMBANG HASUNDUTAN'),
('1217', '12', 'KAB. SAMOSIR'),
('1218', '12', 'KAB. SERDANG BEDAGAI'),
('1219', '12', 'KAB. BATU BARA'),
('1220', '12', 'KAB. PADANG LAWAS UTARA'),
('1221', '12', 'KAB. PADANG LAWAS'),
('1222', '12', 'KAB. LABUHANBATU SELATAN'),
('1223', '12', 'KAB. LABUHANBATU UTARA'),
('1224', '12', 'KAB. NIAS UTARA'),
('1225', '12', 'KAB. NIAS BARAT'),
('1271', '12', 'KOTA MEDAN'),
('1272', '12', 'KOTA PEMATANGSIANTAR'),
('1273', '12', 'KOTA SIBOLGA'),
('1274', '12', 'KOTA TANJUNG BALAI'),
('1275', '12', 'KOTA BINJAI'),
('1276', '12', 'KOTA TEBING TINGGI'),
('1277', '12', 'KOTA PADANG SIDEMPUAN'),
('1278', '12', 'KOTA GUNUNGSITOLI'),
('1301', '13', 'KAB. PESISIR SELATAN'),
('1302', '13', 'KAB. SOLOK'),
('1303', '13', 'KAB. SIJUNJUNG'),
('1304', '13', 'KAB. TANAH DATAR'),
('1305', '13', 'KAB. PADANG PARIAMAN'),
('1306', '13', 'KAB. AGAM'),
('1307', '13', 'KAB. LIMA PULUH KOTA'),
('1308', '13', 'KAB. PASAMAN'),
('1309', '13', 'KAB. KEPULAUAN MENTAWAI'),
('1310', '13', 'KAB. DHARMASRAYA'),
('1311', '13', 'KAB. SOLOK SELATAN'),
('1312', '13', 'KAB. PASAMAN BARAT'),
('1371', '13', 'KOTA PADANG'),
('1372', '13', 'KOTA SOLOK'),
('1373', '13', 'KOTA SAWAHLUNTO'),
('1374', '13', 'KOTA PADANG PANJANG'),
('1375', '13', 'KOTA BUKITTINGGI'),
('1376', '13', 'KOTA PAYAKUMBUH'),
('1377', '13', 'KOTA PARIAMAN'),
('1401', '14', 'KAB. KAMPAR'),
('1402', '14', 'KAB. INDRAGIRI HULU'),
('1403', '14', 'KAB. BENGKALIS'),
('1404', '14', 'KAB. INDRAGIRI HILIR'),
('1405', '14', 'KAB. PELALAWAN'),
('1406', '14', 'KAB. ROKAN HULU'),
('1407', '14', 'KAB. ROKAN HILIR'),
('1408', '14', 'KAB. SIAK'),
('1409', '14', 'KAB. KUANTAN SINGINGI'),
('1410', '14', 'KAB. KEPULAUAN MERANTI'),
('1471', '14', 'KOTA PEKANBARU'),
('1472', '14', 'KOTA DUMAI'),
('1501', '15', 'KAB. KERINCI'),
('1502', '15', 'KAB. MERANGIN'),
('1503', '15', 'KAB. SAROLANGUN'),
('1504', '15', 'KAB. BATANGHARI'),
('1505', '15', 'KAB. MUARO JAMBI'),
('1506', '15', 'KAB. TANJUNG JABUNG BARAT'),
('1507', '15', 'KAB. TANJUNG JABUNG TIMUR'),
('1508', '15', 'KAB. BUNGO'),
('1509', '15', 'KAB. TEBO'),
('1571', '15', 'KOTA JAMBI'),
('1572', '15', 'KOTA SUNGAI PENUH'),
('1601', '16', 'KAB. OGAN KOMERING ULU'),
('1602', '16', 'KAB. OGAN KOMERING ILIR'),
('1603', '16', 'KAB. MUARA ENIM'),
('1604', '16', 'KAB. LAHAT'),
('1605', '16', 'KAB. MUSI RAWAS'),
('1606', '16', 'KAB. MUSI BANYUASIN'),
('1607', '16', 'KAB. BANYUASIN'),
('1608', '16', 'KAB. OGAN KOMERING ULU TIMUR'),
('1609', '16', 'KAB. OGAN KOMERING ULU SELATAN'),
('1610', '16', 'KAB. OGAN ILIR'),
('1611', '16', 'KAB. EMPAT LAWANG'),
('1612', '16', 'KAB. PENUKAL ABAB LEMATANG ILIR'),
('1613', '16', 'KAB. MUSI RAWAS UTARA'),
('1671', '16', 'KOTA PALEMBANG'),
('1672', '16', 'KOTA PAGAR ALAM'),
('1673', '16', 'KOTA LUBUK LINGGAU'),
('1674', '16', 'KOTA PRABUMULIH'),
('1701', '17', 'KAB. BENGKULU SELATAN'),
('1702', '17', 'KAB. REJANG LEBONG'),
('1703', '17', 'KAB. BENGKULU UTARA'),
('1704', '17', 'KAB. KAUR'),
('1705', '17', 'KAB. SELUMA'),
('1706', '17', 'KAB. MUKO MUKO'),
('1707', '17', 'KAB. LEBONG'),
('1708', '17', 'KAB. KEPAHIANG'),
('1709', '17', 'KAB. BENGKULU TENGAH'),
('1771', '17', 'KOTA BENGKULU'),
('1801', '18', 'KAB. LAMPUNG SELATAN'),
('1802', '18', 'KAB. LAMPUNG TENGAH'),
('1803', '18', 'KAB. LAMPUNG UTARA'),
('1804', '18', 'KAB. LAMPUNG BARAT'),
('1805', '18', 'KAB. TULANG BAWANG'),
('1806', '18', 'KAB. TANGGAMUS'),
('1807', '18', 'KAB. LAMPUNG TIMUR'),
('1808', '18', 'KAB. WAY KANAN'),
('1809', '18', 'KAB. PESAWARAN'),
('1810', '18', 'KAB. PRINGSEWU'),
('1811', '18', 'KAB. MESUJI'),
('1812', '18', 'KAB. TULANG BAWANG BARAT'),
('1813', '18', 'KAB. PESISIR BARAT'),
('1871', '18', 'KOTA BANDAR LAMPUNG'),
('1872', '18', 'KOTA METRO'),
('1901', '19', 'KAB. BANGKA'),
('1902', '19', 'KAB. BELITUNG'),
('1903', '19', 'KAB. BANGKA SELATAN'),
('1904', '19', 'KAB. BANGKA TENGAH'),
('1905', '19', 'KAB. BANGKA BARAT'),
('1906', '19', 'KAB. BELITUNG TIMUR'),
('1971', '19', 'KOTA PANGKAL PINANG'),
('2101', '21', 'KAB. BINTAN'),
('2102', '21', 'KAB. KARIMUN'),
('2103', '21', 'KAB. NATUNA'),
('2104', '21', 'KAB. LINGGA'),
('2105', '21', 'KAB. KEPULAUAN ANAMBAS'),
('2171', '21', 'KOTA BATAM'),
('2172', '21', 'KOTA TANJUNG PINANG'),
('3101', '31', 'KAB. ADM. KEP. SERIBU'),
('3171', '31', 'KOTA ADM. JAKARTA PUSAT'),
('3172', '31', 'KOTA ADM. JAKARTA UTARA'),
('3173', '31', 'KOTA ADM. JAKARTA BARAT'),
('3174', '31', 'KOTA ADM. JAKARTA SELATAN'),
('3175', '31', 'KOTA ADM. JAKARTA TIMUR'),
('3201', '32', 'KAB. BOGOR'),
('3202', '32', 'KAB. SUKABUMI'),
('3203', '32', 'KAB. CIANJUR'),
('3204', '32', 'KAB. BANDUNG'),
('3205', '32', 'KAB. GARUT'),
('3206', '32', 'KAB. TASIKMALAYA'),
('3207', '32', 'KAB. CIAMIS'),
('3208', '32', 'KAB. KUNINGAN'),
('3209', '32', 'KAB. CIREBON'),
('3210', '32', 'KAB. MAJALENGKA'),
('3211', '32', 'KAB. SUMEDANG'),
('3212', '32', 'KAB. INDRAMAYU'),
('3213', '32', 'KAB. SUBANG'),
('3214', '32', 'KAB. PURWAKARTA'),
('3215', '32', 'KAB. KARAWANG'),
('3216', '32', 'KAB. BEKASI'),
('3217', '32', 'KAB. BANDUNG BARAT'),
('3218', '32', 'KAB. PANGANDARAN'),
('3271', '32', 'KOTA BOGOR'),
('3272', '32', 'KOTA SUKABUMI'),
('3273', '32', 'KOTA BANDUNG'),
('3274', '32', 'KOTA CIREBON'),
('3275', '32', 'KOTA BEKASI'),
('3276', '32', 'KOTA DEPOK'),
('3277', '32', 'KOTA CIMAHI'),
('3278', '32', 'KOTA TASIKMALAYA'),
('3279', '32', 'KOTA BANJAR'),
('3301', '33', 'KAB. CILACAP'),
('3302', '33', 'KAB. BANYUMAS'),
('3303', '33', 'KAB. PURBALINGGA'),
('3304', '33', 'KAB. BANJARNEGARA'),
('3305', '33', 'KAB. KEBUMEN'),
('3306', '33', 'KAB. PURWOREJO'),
('3307', '33', 'KAB. WONOSOBO'),
('3308', '33', 'KAB. MAGELANG'),
('3309', '33', 'KAB. BOYOLALI'),
('3310', '33', 'KAB. KLATEN'),
('3311', '33', 'KAB. SUKOHARJO'),
('3312', '33', 'KAB. WONOGIRI'),
('3313', '33', 'KAB. KARANGANYAR'),
('3314', '33', 'KAB. SRAGEN'),
('3315', '33', 'KAB. GROBOGAN'),
('3316', '33', 'KAB. BLORA'),
('3317', '33', 'KAB. REMBANG'),
('3318', '33', 'KAB. PATI'),
('3319', '33', 'KAB. KUDUS'),
('3320', '33', 'KAB. JEPARA'),
('3321', '33', 'KAB. DEMAK'),
('3322', '33', 'KAB. SEMARANG'),
('3323', '33', 'KAB. TEMANGGUNG'),
('3324', '33', 'KAB. KENDAL'),
('3325', '33', 'KAB. BATANG'),
('3326', '33', 'KAB. PEKALONGAN'),
('3327', '33', 'KAB. PEMALANG'),
('3328', '33', 'KAB. TEGAL'),
('3329', '33', 'KAB. BREBES'),
('3371', '33', 'KOTA MAGELANG'),
('3372', '33', 'KOTA SURAKARTA'),
('3373', '33', 'KOTA SALATIGA'),
('3374', '33', 'KOTA SEMARANG'),
('3375', '33', 'KOTA PEKALONGAN'),
('3376', '33', 'KOTA TEGAL'),
('3401', '34', 'KAB. KULON PROGO'),
('3402', '34', 'KAB. BANTUL'),
('3403', '34', 'KAB. GUNUNGKIDUL'),
('3404', '34', 'KAB. SLEMAN'),
('3471', '34', 'KOTA YOGYAKARTA'),
('3501', '35', 'KAB. PACITAN'),
('3502', '35', 'KAB. PONOROGO'),
('3503', '35', 'KAB. TRENGGALEK'),
('3504', '35', 'KAB. TULUNGAGUNG'),
('3505', '35', 'KAB. BLITAR'),
('3506', '35', 'KAB. KEDIRI'),
('3507', '35', 'KAB. MALANG'),
('3508', '35', 'KAB. LUMAJANG'),
('3509', '35', 'KAB. JEMBER'),
('3510', '35', 'KAB. BANYUWANGI'),
('3511', '35', 'KAB. BONDOWOSO'),
('3512', '35', 'KAB. SITUBONDO'),
('3513', '35', 'KAB. PROBOLINGGO'),
('3514', '35', 'KAB. PASURUAN'),
('3515', '35', 'KAB. SIDOARJO'),
('3516', '35', 'KAB. MOJOKERTO'),
('3517', '35', 'KAB. JOMBANG'),
('3518', '35', 'KAB. NGANJUK'),
('3519', '35', 'KAB. MADIUN'),
('3520', '35', 'KAB. MAGETAN'),
('3521', '35', 'KAB. NGAWI'),
('3522', '35', 'KAB. BOJONEGORO'),
('3523', '35', 'KAB. TUBAN'),
('3524', '35', 'KAB. LAMONGAN'),
('3525', '35', 'KAB. GRESIK'),
('3526', '35', 'KAB. BANGKALAN'),
('3527', '35', 'KAB. SAMPANG'),
('3528', '35', 'KAB. PAMEKASAN'),
('3529', '35', 'KAB. SUMENEP'),
('3571', '35', 'KOTA KEDIRI'),
('3572', '35', 'KOTA BLITAR'),
('3573', '35', 'KOTA MALANG'),
('3574', '35', 'KOTA PROBOLINGGO'),
('3575', '35', 'KOTA PASURUAN'),
('3576', '35', 'KOTA MOJOKERTO'),
('3577', '35', 'KOTA MADIUN'),
('3578', '35', 'KOTA SURABAYA'),
('3579', '35', 'KOTA BATU'),
('3601', '36', 'KAB. PANDEGLANG'),
('3602', '36', 'KAB. LEBAK'),
('3603', '36', 'KAB. TANGERANG'),
('3604', '36', 'KAB. SERANG'),
('3671', '36', 'KOTA TANGERANG'),
('3672', '36', 'KOTA CILEGON'),
('3673', '36', 'KOTA SERANG'),
('3674', '36', 'KOTA TANGERANG SELATAN'),
('5101', '51', 'KAB. JEMBRANA'),
('5102', '51', 'KAB. TABANAN'),
('5103', '51', 'KAB. BADUNG'),
('5104', '51', 'KAB. GIANYAR'),
('5105', '51', 'KAB. KLUNGKUNG'),
('5106', '51', 'KAB. BANGLI'),
('5107', '51', 'KAB. KARANGASEM'),
('5108', '51', 'KAB. BULELENG'),
('5171', '51', 'KOTA DENPASAR'),
('5201', '52', 'KAB. LOMBOK BARAT'),
('5202', '52', 'KAB. LOMBOK TENGAH'),
('5203', '52', 'KAB. LOMBOK TIMUR'),
('5204', '52', 'KAB. SUMBAWA'),
('5205', '52', 'KAB. DOMPU'),
('5206', '52', 'KAB. BIMA'),
('5207', '52', 'KAB. SUMBAWA BARAT'),
('5208', '52', 'KAB. LOMBOK UTARA'),
('5271', '52', 'KOTA MATARAM'),
('5272', '52', 'KOTA BIMA'),
('5301', '53', 'KAB. KUPANG'),
('5302', '53', 'KAB TIMOR TENGAH SELATAN'),
('5303', '53', 'KAB. TIMOR TENGAH UTARA'),
('5304', '53', 'KAB. BELU'),
('5305', '53', 'KAB. ALOR'),
('5306', '53', 'KAB. FLORES TIMUR'),
('5307', '53', 'KAB. SIKKA'),
('5308', '53', 'KAB. ENDE'),
('5309', '53', 'KAB. NGADA'),
('5310', '53', 'KAB. MANGGARAI'),
('5311', '53', 'KAB. SUMBA TIMUR'),
('5312', '53', 'KAB. SUMBA BARAT'),
('5313', '53', 'KAB. LEMBATA'),
('5314', '53', 'KAB. ROTE NDAO'),
('5315', '53', 'KAB. MANGGARAI BARAT'),
('5316', '53', 'KAB. NAGEKEO'),
('5317', '53', 'KAB. SUMBA TENGAH'),
('5318', '53', 'KAB. SUMBA BARAT DAYA'),
('5319', '53', 'KAB. MANGGARAI TIMUR'),
('5320', '53', 'KAB. SABU RAIJUA'),
('5321', '53', 'KAB. MALAKA'),
('5371', '53', 'KOTA KUPANG'),
('6101', '61', 'KAB. SAMBAS'),
('6102', '61', 'KAB. MEMPAWAH'),
('6103', '61', 'KAB. SANGGAU'),
('6104', '61', 'KAB. KETAPANG'),
('6105', '61', 'KAB. SINTANG'),
('6106', '61', 'KAB. KAPUAS HULU'),
('6107', '61', 'KAB. BENGKAYANG'),
('6108', '61', 'KAB. LANDAK'),
('6109', '61', 'KAB. SEKADAU'),
('6110', '61', 'KAB. MELAWI'),
('6111', '61', 'KAB. KAYONG UTARA'),
('6112', '61', 'KAB. KUBU RAYA'),
('6171', '61', 'KOTA PONTIANAK'),
('6172', '61', 'KOTA SINGKAWANG'),
('6201', '62', 'KAB. KOTAWARINGIN BARAT'),
('6202', '62', 'KAB. KOTAWARINGIN TIMUR'),
('6203', '62', 'KAB. KAPUAS'),
('6204', '62', 'KAB. BARITO SELATAN'),
('6205', '62', 'KAB. BARITO UTARA'),
('6206', '62', 'KAB. KATINGAN'),
('6207', '62', 'KAB. SERUYAN'),
('6208', '62', 'KAB. SUKAMARA'),
('6209', '62', 'KAB. LAMANDAU'),
('6210', '62', 'KAB. GUNUNG MAS'),
('6211', '62', 'KAB. PULANG PISAU'),
('6212', '62', 'KAB. MURUNG RAYA'),
('6213', '62', 'KAB. BARITO TIMUR'),
('6271', '62', 'KOTA PALANGKARAYA'),
('6301', '63', 'KAB. TANAH LAUT'),
('6302', '63', 'KAB. KOTABARU'),
('6303', '63', 'KAB. BANJAR'),
('6304', '63', 'KAB. BARITO KUALA'),
('6305', '63', 'KAB. TAPIN'),
('6306', '63', 'KAB. HULU SUNGAI SELATAN'),
('6307', '63', 'KAB. HULU SUNGAI TENGAH'),
('6308', '63', 'KAB. HULU SUNGAI UTARA'),
('6309', '63', 'KAB. TABALONG'),
('6310', '63', 'KAB. TANAH BUMBU'),
('6311', '63', 'KAB. BALANGAN'),
('6371', '63', 'KOTA BANJARMASIN'),
('6372', '63', 'KOTA BANJARBARU'),
('6401', '64', 'KAB. PASER'),
('6402', '64', 'KAB. KUTAI KARTANEGARA'),
('6403', '64', 'KAB. BERAU'),
('6407', '64', 'KAB. KUTAI BARAT'),
('6408', '64', 'KAB. KUTAI TIMUR'),
('6409', '64', 'KAB. PENAJAM PASER UTARA'),
('6411', '64', 'KAB. MAHAKAM ULU'),
('6471', '64', 'KOTA BALIKPAPAN'),
('6472', '64', 'KOTA SAMARINDA'),
('6474', '64', 'KOTA BONTANG'),
('6501', '65', 'KAB. BULUNGAN'),
('6502', '65', 'KAB. MALINAU'),
('6503', '65', 'KAB. NUNUKAN'),
('6504', '65', 'KAB. TANA TIDUNG'),
('6571', '65', 'KOTA TARAKAN'),
('7101', '71', 'KAB. BOLAANG MONGONDOW'),
('7102', '71', 'KAB. MINAHASA'),
('7103', '71', 'KAB. KEPULAUAN SANGIHE'),
('7104', '71', 'KAB. KEPULAUAN TALAUD'),
('7105', '71', 'KAB. MINAHASA SELATAN'),
('7106', '71', 'KAB. MINAHASA UTARA'),
('7107', '71', 'KAB. MINAHASA TENGGARA'),
('7108', '71', 'KAB. BOLAANG MONGONDOW UTARA'),
('7109', '71', 'KAB. KEP. SIAU TAGULANDANG BIARO'),
('7110', '71', 'KAB. BOLAANG MONGONDOW TIMUR'),
('7111', '71', 'KAB. BOLAANG MONGONDOW SELATAN'),
('7171', '71', 'KOTA MANADO'),
('7172', '71', 'KOTA BITUNG'),
('7173', '71', 'KOTA TOMOHON'),
('7174', '71', 'KOTA KOTAMOBAGU'),
('7201', '72', 'KAB. BANGGAI'),
('7202', '72', 'KAB. POSO'),
('7203', '72', 'KAB. DONGGALA'),
('7204', '72', 'KAB. TOLI TOLI'),
('7205', '72', 'KAB. BUOL'),
('7206', '72', 'KAB. MOROWALI'),
('7207', '72', 'KAB. BANGGAI KEPULAUAN'),
('7208', '72', 'KAB. PARIGI MOUTONG'),
('7209', '72', 'KAB. TOJO UNA UNA'),
('7210', '72', 'KAB. SIGI'),
('7211', '72', 'KAB. BANGGAI LAUT'),
('7212', '72', 'KAB. MOROWALI UTARA'),
('7271', '72', 'KOTA PALU'),
('7301', '73', 'KAB. KEPULAUAN SELAYAR'),
('7302', '73', 'KAB. BULUKUMBA'),
('7303', '73', 'KAB. BANTAENG'),
('7304', '73', 'KAB. JENEPONTO'),
('7305', '73', 'KAB. TAKALAR'),
('7306', '73', 'KAB. GOWA'),
('7307', '73', 'KAB. SINJAI'),
('7308', '73', 'KAB. BONE'),
('7309', '73', 'KAB. MAROS'),
('7310', '73', 'KAB. PANGKAJENE KEPULAUAN'),
('7311', '73', 'KAB. BARRU'),
('7312', '73', 'KAB. SOPPENG'),
('7313', '73', 'KAB. WAJO'),
('7314', '73', 'KAB. SIDENRENG RAPPANG'),
('7315', '73', 'KAB. PINRANG'),
('7316', '73', 'KAB. ENREKANG'),
('7317', '73', 'KAB. LUWU'),
('7318', '73', 'KAB. TANA TORAJA'),
('7322', '73', 'KAB. LUWU UTARA'),
('7324', '73', 'KAB. LUWU TIMUR'),
('7326', '73', 'KAB. TORAJA UTARA'),
('7371', '73', 'KOTA MAKASSAR'),
('7372', '73', 'KOTA PARE PARE'),
('7373', '73', 'KOTA PALOPO'),
('7401', '74', 'KAB. KOLAKA'),
('7402', '74', 'KAB. KONAWE'),
('7403', '74', 'KAB. MUNA'),
('7404', '74', 'KAB. BUTON'),
('7405', '74', 'KAB. KONAWE SELATAN'),
('7406', '74', 'KAB. BOMBANA'),
('7407', '74', 'KAB. WAKATOBI'),
('7408', '74', 'KAB. KOLAKA UTARA'),
('7409', '74', 'KAB. KONAWE UTARA'),
('7410', '74', 'KAB. BUTON UTARA'),
('7411', '74', 'KAB. KOLAKA TIMUR'),
('7412', '74', 'KAB. KONAWE KEPULAUAN'),
('7413', '74', 'KAB. MUNA BARAT'),
('7414', '74', 'KAB. BUTON TENGAH'),
('7415', '74', 'KAB. BUTON SELATAN'),
('7471', '74', 'KOTA KENDARI'),
('7472', '74', 'KOTA BAU BAU'),
('7501', '75', 'KAB. GORONTALO'),
('7502', '75', 'KAB. BOALEMO'),
('7503', '75', 'KAB. BONE BOLANGO'),
('7504', '75', 'KAB. PAHUWATO'),
('7505', '75', 'KAB. GORONTALO UTARA'),
('7571', '75', 'KOTA GORONTALO'),
('7601', '76', 'KAB. PASANGKAYU'),
('7602', '76', 'KAB. MAMUJU'),
('7603', '76', 'KAB. MAMASA'),
('7604', '76', 'KAB. POLEWALI MANDAR'),
('7605', '76', 'KAB. MAJENE'),
('7606', '76', 'KAB. MAMUJU TENGAH'),
('8101', '81', 'KAB. MALUKU TENGAH'),
('8102', '81', 'KAB. MALUKU TENGGARA'),
('8103', '81', 'KAB. KEPULAUAN TANIMBAR'),
('8104', '81', 'KAB. BURU'),
('8105', '81', 'KAB. SERAM BAGIAN TIMUR'),
('8106', '81', 'KAB. SERAM BAGIAN BARAT'),
('8107', '81', 'KAB. KEPULAUAN ARU'),
('8108', '81', 'KAB. MALUKU BARAT DAYA'),
('8109', '81', 'KAB. BURU SELATAN'),
('8171', '81', 'KOTA AMBON'),
('8172', '81', 'KOTA TUAL'),
('8201', '82', 'KAB. HALMAHERA BARAT'),
('8202', '82', 'KAB. HALMAHERA TENGAH'),
('8203', '82', 'KAB. HALMAHERA UTARA'),
('8204', '82', 'KAB. HALMAHERA SELATAN'),
('8205', '82', 'KAB. KEPULAUAN SULA'),
('8206', '82', 'KAB. HALMAHERA TIMUR'),
('8207', '82', 'KAB. PULAU MOROTAI'),
('8208', '82', 'KAB. PULAU TALIABU'),
('8271', '82', 'KOTA TERNATE'),
('8272', '82', 'KOTA TIDORE KEPULAUAN'),
('9101', '91', 'KAB. MERAUKE'),
('9102', '91', 'KAB. JAYAWIJAYA'),
('9103', '91', 'KAB. JAYAPURA'),
('9104', '91', 'KAB. NABIRE'),
('9105', '91', 'KAB. KEPULAUAN YAPEN'),
('9106', '91', 'KAB. BIAK NUMFOR'),
('9107', '91', 'KAB. PUNCAK JAYA'),
('9108', '91', 'KAB. PANIAI'),
('9109', '91', 'KAB. MIMIKA'),
('9110', '91', 'KAB. SARMI'),
('9111', '91', 'KAB. KEEROM'),
('9112', '91', 'KAB PEGUNUNGAN BINTANG'),
('9113', '91', 'KAB. YAHUKIMO'),
('9114', '91', 'KAB. TOLIKARA'),
('9115', '91', 'KAB. WAROPEN'),
('9116', '91', 'KAB. BOVEN DIGOEL'),
('9117', '91', 'KAB. MAPPI'),
('9118', '91', 'KAB. ASMAT'),
('9119', '91', 'KAB. SUPIORI'),
('9120', '91', 'KAB. MAMBERAMO RAYA'),
('9121', '91', 'KAB. MAMBERAMO TENGAH'),
('9122', '91', 'KAB. YALIMO'),
('9123', '91', 'KAB. LANNY JAYA'),
('9124', '91', 'KAB. NDUGA'),
('9125', '91', 'KAB. PUNCAK'),
('9126', '91', 'KAB. DOGIYAI'),
('9127', '91', 'KAB. INTAN JAYA'),
('9128', '91', 'KAB. DEIYAI'),
('9171', '91', 'KOTA JAYAPURA'),
('9201', '92', 'KAB. SORONG'),
('9202', '92', 'KAB. MANOKWARI'),
('9203', '92', 'KAB. FAK FAK'),
('9204', '92', 'KAB. SORONG SELATAN'),
('9205', '92', 'KAB. RAJA AMPAT'),
('9206', '92', 'KAB. TELUK BINTUNI'),
('9207', '92', 'KAB. TELUK WONDAMA'),
('9208', '92', 'KAB. KAIMANA'),
('9209', '92', 'KAB. TAMBRAUW'),
('9210', '92', 'KAB. MAYBRAT'),
('9211', '92', 'KAB. MANOKWARI SELATAN'),
('9212', '92', 'KAB. PEGUNUNGAN ARFAK'),
('9271', '92', 'KOTA SORONG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_provinsi`
--

DROP TABLE IF EXISTS `tbl_provinsi`;
CREATE TABLE IF NOT EXISTS `tbl_provinsi` (
  `ID_PROV` char(2) NOT NULL,
  `NAMA_PROV` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`ID_PROV`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_provinsi`
--

INSERT INTO `tbl_provinsi` (`ID_PROV`, `NAMA_PROV`) VALUES
('11', 'ACEH'),
('12', 'SUMATERA UTARA'),
('13', 'SUMATERA BARAT'),
('14', 'RIAU'),
('15', 'JAMBI'),
('16', 'SUMATERA SELATAN'),
('17', 'BENGKULU'),
('18', 'LAMPUNG'),
('19', 'KEPULAUAN BANGKA BELITUNG'),
('21', 'KEPULAUAN RIAU'),
('31', 'DKI JAKARTA'),
('32', 'JAWA BARAT'),
('33', 'JAWA TENGAH'),
('34', 'DAERAH ISTIMEWA YOGYAKARTA'),
('35', 'JAWA TIMUR'),
('36', 'BANTEN'),
('51', 'BALI'),
('52', 'NUSA TENGGARA BARAT'),
('53', 'NUSA TENGGARA TIMUR'),
('61', 'KALIMANTAN BARAT'),
('62', 'KALIMANTAN TENGAH'),
('63', 'KALIMANTAN SELATAN'),
('64', 'KALIMANTAN TIMUR'),
('65', 'KALIMANTAN UTARA'),
('71', 'SULAWESI UTARA'),
('72', 'SULAWESI TENGAH'),
('73', 'SULAWESI SELATAN'),
('74', 'SULAWESI TENGGARA'),
('75', 'GORONTALO'),
('76', 'SULAWESI BARAT'),
('81', 'MALUKU'),
('82', 'MALUKU UTARA'),
('91', 'PAPUA'),
('92', 'PAPUA BARAT');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
