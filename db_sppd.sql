-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2019 at 03:35 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_spd1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `level`) VALUES
(1, 'admin', 'a.bp3ap2kb@yahoo.com', 'admin5', 'operator'),
(2, 'kabag', 'kabagbp3ap2kb@gmail.com', 'kabag2', 'kabag');

-- --------------------------------------------------------

--
-- Table structure for table `biaya`
--

CREATE TABLE IF NOT EXISTS `biaya` (
  `id_biaya` int(5) NOT NULL AUTO_INCREMENT,
  `id_tujuan` int(5) NOT NULL,
  `harian` double NOT NULL,
  `penginapan` double NOT NULL,
  `transportasi` double NOT NULL,
  `lumpsum` double NOT NULL,
  `id_jabatan` int(5) NOT NULL,
  `id_pangkat` int(5) NOT NULL,
  PRIMARY KEY (`id_biaya`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `biaya`
--

INSERT INTO `biaya` (`id_biaya`, `id_tujuan`, `harian`, `penginapan`, `transportasi`, `lumpsum`, `id_jabatan`, `id_pangkat`) VALUES
(95, 20, 700000, 575000, 2518000, 500000, 28, 10),
(96, 20, 600000, 575000, 2518000, 500000, 72, 10),
(97, 20, 600000, 575000, 2518000, 500000, 59, 10),
(98, 18, 300000, 0, 0, 0, 70, 10),
(99, 18, 350000, 0, 0, 0, 93, 9),
(100, 18, 300000, 0, 0, 0, 94, 20),
(101, 17, 700000, 450000, 3286000, 500000, 35, 9),
(102, 19, 700000, 625000, 880000, 500000, 29, 8),
(103, 19, 600000, 625000, 880000, 500000, 70, 10),
(104, 17, 400000, 400000, 400000, 300000, 94, 20),
(105, 17, 5000000, 4000000, 4000000, 4000000, 28, 10);

-- --------------------------------------------------------

--
-- Table structure for table `detail_nppt`
--

CREATE TABLE IF NOT EXISTS `detail_nppt` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_nppt` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `status_perintah` enum('Perintah','Pengikut') NOT NULL DEFAULT 'Pengikut',
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=191 ;

--
-- Dumping data for table `detail_nppt`
--

INSERT INTO `detail_nppt` (`id_detail`, `id_nppt`, `id_pegawai`, `status_perintah`) VALUES
(106, 153, 90, 'Pengikut'),
(171, 156, 83, 'Perintah'),
(172, 156, 120, 'Pengikut'),
(173, 156, 135, 'Pengikut'),
(180, 165, 128, 'Pengikut'),
(181, 165, 132, 'Perintah'),
(182, 165, 170, 'Pengikut'),
(183, 166, 83, 'Perintah'),
(184, 166, 170, 'Pengikut'),
(185, 167, 83, 'Perintah'),
(186, 167, 170, 'Pengikut'),
(189, 169, 83, 'Pengikut'),
(190, 169, 170, 'Perintah');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE IF NOT EXISTS `golongan` (
  `id_golongan` int(10) NOT NULL AUTO_INCREMENT,
  `golongan` varchar(200) NOT NULL,
  PRIMARY KEY (`id_golongan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `golongan`) VALUES
(4, 'Golongan IV'),
(5, 'Golongan III'),
(6, 'Golongan II'),
(7, 'Golongan I ');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(5) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(200) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(26, 'Kepala Dinas Pemberdayaan Perempuan Perlindungan Anak, Pengendalian Penduduk dan KB'),
(27, 'Sekretaris Dinas Pemberdayaan Perempuan Perlindungan Anak, Pengendalian Penduduk dan KB'),
(28, 'Kepala Bidang Pengendalian Penduduk, Penyuluhan dan Penggerakan'),
(29, 'Kepala Bidang Keluarga Berencana, Ketahanan dan Kesejahteraan Keluarga'),
(30, 'Pengelola Kegiatan'),
(31, 'Pengadministrasi Umum'),
(32, 'Ka.UPT DP3AP2KB Kec. Kuranji'),
(33, 'Penyuluh KB Ahli Pada UPT DP3AP2KB Kecamatan Padang Utara'),
(34, 'Kasi Pembinaan Kesertaan Ber Keluarga Berencana'),
(35, 'Kepala Bidang Kualitas Hidup Perempuan, Kualitas Keluarga, Data dan Informasi'),
(36, 'Kepala Seksi Pelembagaan PUG & PP Bid. Kualitas Keluarga, Data & Informasi'),
(37, 'Kepala Bidang Pemenuhan Hak Anak DP3AP2KB'),
(38, 'Penyuluh KB Ahli UPT DP3AP2KB Kecamatan Padang Timur'),
(39, 'Kepala Bidang Perlindungan Hak Perempuan dan Perlindungan Khusus Anak'),
(40, 'Kasi Advokasi dan Pergerakan'),
(41, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Lubuk Begalung'),
(42, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Padang Utara'),
(43, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Pauh'),
(44, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Padang Selatan'),
(45, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Koto Tangah'),
(46, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Padang Barat'),
(47, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Padang Timur'),
(48, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Lubuk Kilangan'),
(49, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Kuranji'),
(50, 'KTU UPT DP3AP2KB Kecamatan Koto Tangah'),
(51, 'Kasi Pelembagaan PUG & PP Bid. Sosial, Politik & Hukum'),
(52, 'Kasubag Umum'),
(53, 'Ka.UPT DP3AP2KB Kec. Koto Tangah'),
(54, 'Ka.UPT DP3AP2KB Kec. Padang Selatan'),
(55, 'Ka.UPT DP3AP2KB Kec. Padang Timur'),
(56, 'Ka.UPT DP3AP2KB Kec. Padang Utara'),
(57, 'Ka.UPT DP3AP2KB Kec. Lubuk Begalung'),
(58, 'Ka.UPT DP3AP2KB Kec. Bungus'),
(59, 'Kasi Penyuluhan dan Pendayagunaan PLKB'),
(60, 'Kepala Seksi Pelembagaan PUG & PP Bid. Ekonomi'),
(61, 'Kasi Hak Sipil, Informasi dan Partisipasi'),
(62, 'Kasi Ketahanan dan Kesejahteraan Keluarga'),
(63, 'Ka.UPT DP3AP2KB Kec. Padang Barat'),
(64, 'Ka.UPT DP3AP2KB Kec. Nanggalo'),
(65, 'Ka.UPT DP3AP2KB Kec. Pauh'),
(66, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Nanggalo'),
(67, 'Kasubag TU UPT DP3AP2KB Kecamatan Kuranji'),
(68, 'Kasubag TU UPT DP3AP2KB Kecamatan Nanggalo'),
(69, 'Kasubag TU UPT DP3AP2KB Kecamatan Padang Timur'),
(70, 'Kasi Layanan Berkeluarga Berencana'),
(71, 'Kasi Kesehatan Dasar dan Kesejahteraan'),
(72, 'Kasi Pengendalian Penduduk dan Informasi Keluarga'),
(73, 'Pengelola Gaji'),
(74, 'Kasubag TU UPT DP3AP2KB Kecamatan Padang Selatan'),
(75, 'Kasubag TU UPT DP3AP2KB Kecamatan Lubuk Begalung'),
(76, 'Kasubag TU UPT DP3AP2KB Kecamatan Padang Utara'),
(77, 'Kasubag TU UPT DP3AP2KB Kecamatan Pauh'),
(78, 'Kasi Lingkungan Keluarga & Pengasuhan Alternatif & Pemanfaatan Waktu Luang Kegiatan Kebudayaan'),
(79, 'Kasi Data Kekerasan Perempuan dan Anak'),
(80, 'Pengelola Kepegawaian'),
(81, 'Kasi Perlindungan Perempuan'),
(82, 'Penata Laporan Keuangan'),
(83, 'Kasubag Keuangan'),
(84, 'Pengadministrasi Keuangan'),
(85, 'Pengadministrasi Kegiatan'),
(86, 'Kasubag Program'),
(87, 'Penyuluh KB Madya UPT DP3AP2KB Kecamatan Bungus'),
(88, 'Penyuluh KB Pratama DP3AP2KB Kecamatan Padang Timur'),
(89, 'Bendahara'),
(90, 'Pengelola Pemanfaatan Barang Milik Daerah'),
(92, 'Kasi Perlindungan Khusus Anak'),
(93, 'Staf Kabid KB/K3'),
(94, 'Sopir');

-- --------------------------------------------------------

--
-- Table structure for table `kwitansi`
--

CREATE TABLE IF NOT EXISTS `kwitansi` (
  `id_kwitansi` int(50) NOT NULL AUTO_INCREMENT,
  `id_sppd` varchar(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `dari` text NOT NULL,
  `untuk` text NOT NULL,
  `lama` double NOT NULL,
  `lumpsum` double NOT NULL,
  `harian` double NOT NULL,
  `penginapan` double NOT NULL,
  `transportasi` double NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kwitansi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `kwitansi`
--

INSERT INTO `kwitansi` (`id_kwitansi`, `id_sppd`, `id_pegawai`, `dari`, `untuk`, `lama`, `lumpsum`, `harian`, `penginapan`, `transportasi`, `tujuan`) VALUES
(42, '54', '90', 'BENDAHARA PENGELUARAN DP3AP2KB KOTA PADANG', 'Pembayaran Biaya Perjalanan Dinas Luar Daerah Luar Provinsi mengikuti kunjungan kerja dalam rangka Persiapan Pelaksanaan peringatan Hari Kesatuan Gerak PKK (HKG-PKK) Tingkat Nasional ke 47 Tahun 2019 ke Provinsi Jawa Timur, Pada Tanggal 17 s/d 19 September 2018', 3, 500000, 2100000, 900000, 3286000, 'Surabaya'),
(51, '62', '128', 'BENDAHARA PENGELUARAN DP3AP2KB KOTA PADANG', 'Pembayaran Belanja Perjalanan Dinas Luar Daerah Dalam Provinsi, pada acara Menghadiri Pencanangan Bhakti Sosial TNI KB Kes Provinsi Sumatera Barat Tahun 2018 di Bukittinggi', 1, 0, 950000, 0, 0, 'Bukittinggi'),
(52, '63', '83', 'BENDAHARA PENGELUARAN DP3AP2KB KOTA PADANG', 'Pembayaran Belanja Dinas Luar Daerah Luar Provinsi Mengikuti Jambore Ajang Kreatifitas (JAK) Genre Tingkat Nasional Tahun 2018, tanggal 14 s/d 17 Desember 2018', 4, 1500000, 7600000, 5175000, 7554000, 'Bandung'),
(53, '64', '90', 'BENDAHARA PENGELUARAN DP3AP2KB KOTA PADANG', 'Pembayaran Biaya Perjalanan Dinas Luar Daerah Luar Provinsi mengikuti kunjungan kerja dalam rangka Persiapan Pelaksanaan peringatan Hari Kesatuan Gerak PKK (HKG-PKK) Tingkat Nasional ke 47 Tahun 2019 ke Provinsi Jawa Timur, Pada Tanggal 17 s/d 19 September 2018', 3, 500000, 2100000, 900000, 3286000, 'Surabaya'),
(54, '65', '83', 'BENDAHARA PENGELUARAN DP3AP2KB KOTA PADANG', 'Pembayara Peerjalanan Dinas', 2, 4300000, 10800000, 4400000, 4400000, 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `lpd`
--

CREATE TABLE IF NOT EXISTS `lpd` (
  `id_lpd` int(5) NOT NULL AUTO_INCREMENT,
  `id_spt` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `id_pangkat` int(50) NOT NULL,
  `id_jabatan` int(50) NOT NULL,
  `hasil` text NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_lpd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lpd`
--

INSERT INTO `lpd` (`id_lpd`, `id_spt`, `id_pegawai`, `id_pangkat`, `id_jabatan`, `hasil`, `kepada`, `hari`, `tanggal`) VALUES
(1, 23, 90, 0, 0, '		  Adapun hasil perjalanan dinas tersebut adalah sebagai berikut : \r\nI. Dasar Hukum:\r\n1. Surat Kepala Dinas Pemberdayaan Masyarakat dan Desa Provinsi Sumatera Barat No.411.2/663/DPMD-2018 tanggal 12 September 2018.\r\n2. Telaahan Staf Kepala DP3AP2KB tanggal 12 September 2018.\r\n3. Surat Perintah Tugas Sekretariat Daerah Kota Padang Nomor 312/DP3AP2KB-SPT/X/2018.\r\n\r\nII. Tujuan dan Sasaran: Tujuan Pelaksanaan Kunjungan Kerja adalah Untuk mengetahui kiat-kiat yang dilakukan oleh daerah provinsi Jawa Timur dalam menggerakkan pelaksanaan program pkk di daerah Jawa Timur dan untuk melihat/mempelajari bagaimana persiapan yang dilakukan oleh pemerintah kota Jawa Timur sebagai tuan rumah Penyelenggaraan Peringatan Hari Kesatuan Gerak PKK Tingkat Nasional pada tahun 2015 yang lalu, sehingga Jawa Timur telah sukses sebagai pelaksana penyelenggaraan peringatan hari kesatuan gerak PKK Tingkat Nasional tahun 2015.\r\n\r\nIII. Waktu dan Tempat:\r\nKunjungan Kerja ini dilaksanakan tanggal 17, 18, 19 September 2018 ke Provinsi Jawa Timur.\r\n\r\nIV. Peserta:\r\nPeserta Kunjungan kerja ini terdiri dari \r\n1. Ketua Tim Penggerak Provinsi Sumatera Barat.\r\n2. Sekretaris PKK Provinsi Sumbar.\r\n3. Kepala Dinas Pemberdayaan Masyarakat Provinsi Sumbar.\r\n4. Kabid Pada Dinas Pemberdayaan Masyarakat Provinsi Sumbar.\r\n5. Kasi Pada Dinas Pemberdayaan Masyarakat Provinsi Sumbar.\r\n6. Kabid Kualitas Hidup Perempuan Kualitas Keluarga pada DP3AP2KB Kota Padang.', '', 'Sabtu', '2019-03-02'),
(2, 24, 128, 0, 0, '		  Adapun hasil perjalanan dinas tersebut adalah sebagai berikut : \r\nPrioritas Penggarapan Program KKBPK pada Bhaksos TNI Manunggal KB Kes (TMKK) Kota Padang Tahun 2018: 1. UUD No. 3 Tahun 2002 tentang Pertahanan Negara. \r\n2. UUD No. 34 Tahun 2004 Tentang Tentara Nasional Indonesia.\r\n3. UUD No. 36 Tahun 2009 Tentang Kesehatan.\r\n4. UUD No. 52 Tahun 2009 tentang Perkembangan Kependudukan dan Pembangunan Keluarga.\r\n5. UU No. 23 Tahun 2014 tentang Pemerintah Daerah.\r\n6. PP No. 38 Tahun 2014 tentang Pembagian Urusan Pemerintah Pemda Provinsi dan Pemda Kab Kota.\r\n7. PP No. 41 Tahun 2007 tentang Organisasi Perangkat Daerah.\r\n8. PP No 87 Tahun 2014 tentang Perkembangan Kependudukan dan Pembangunan Keluarga Berencana dan SIGA.\r\n9. PP No 2 tahun 2015 tentang RPJMN 2015-2019.\r\n10. Perpes No 3 Tahun 2013 tentang Perubahan ketujuh Kepres 103 tahun 2001 Tupoksi LN Non Kementrian.\r\n11. Nota Kesepakatan antara BKKBN dengan TNI No 246/KSM/62/2014 dan Nomor/KERMA/32/1X/2014 dan KERMA/33/1V/2014 tentang Penguatan Percepatan Pencapaian Sasaran Program KKBPK.\r\n12. Kesepakatan Bersama antara BKKBN dengan Kemen Kesehatan RI tentang Program Keluarga Berencana, Pasca Persalinan dalam Jaminan Persalinan No.HK.06.01/B.4021/2011 dan No. 260/KSM/E1/2011.', '', 'Kamis', '2019-02-21'),
(4, 26, 83, 0, 0, '		  Adapun hasil perjalanan dinas tersebut adalah sebagai berikut : \r\n		  		  Adapun hasil perjalanan dinas tersebut adalah sebagai berikut : \r\nPrioritas Penggarapan Program KKBPK pada Bhaksos TNI Manunggal KB Kes (TMKK) Kota Padang Tahun 2018: 1. UUD No. 3 Tahun 2002 tentang Pertahanan Negara. \r\n2. UUD No. 34 Tahun 2004 Tentang Tentara Nasional Indonesia.\r\n3. UUD No. 36 Tahun 2009 Tentang Kesehatan.\r\n4. UUD No. 52 Tahun 2009 tentang Perkembangan Kependudukan dan Pembangunan Keluarga.\r\n5. UU No. 23 Tahun 2014 tentang Pemerintah Daerah.\r\n6. PP No. 38 Tahun 2014 tentang Pembagian Urusan Pemerintah Pemda Provinsi dan Pemda Kab Kota.\r\n7. PP No. 41 Tahun 2007 tentang Organisasi Perangkat Daerah.\r\n8. PP No 87 Tahun 2014 tentang Perkembangan Kependudukan dan Pembangunan Keluarga Berencana dan SIGA.\r\n9. PP No 2 tahun 2015 tentang RPJMN 2015-2019.\r\n10. Perpes No 3 Tahun 2013 tentang Perubahan ketujuh Kepres 103 tahun 2001 Tupoksi LN Non Kementrian.\r\n11. Nota Kesepakatan antara BKKBN dengan TNI No 246/KSM/62/2014 dan Nomor/KERMA/32/1X/2014 dan KERMA/33/1V/2014 tentang Penguatan Percepatan Pencapaian Sasaran Program KKBPK.\r\n12. Kesepakatan Bersama antara BKKBN dengan Kemen Kesehatan RI tentang Program Keluarga Berencana, Pasca Persalinan dalam Jaminan Persalinan No.HK.06.01/B.4021/2011 dan No. 260/KSM/E1/2011.\r\n', '', 'Sabtu', '2019-03-02'),
(5, 27, 83, 0, 0, '		  Adapun hasil perjalanan dinas tersebut adalah sebagai berikut : \r\n		  Pada Acara Kali Ini jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '', 'Sabtu', '2019-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `nppt`
--

CREATE TABLE IF NOT EXISTS `nppt` (
  `id_nppt` int(50) NOT NULL AUTO_INCREMENT,
  `id_pegawai` varchar(50) NOT NULL,
  `id_tujuan` varchar(50) NOT NULL,
  `maksud` text NOT NULL,
  `id_transportasi` varchar(50) NOT NULL,
  `lama` varchar(20) NOT NULL,
  `tgl_pergi` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_pegawai_perintah` int(11) NOT NULL,
  PRIMARY KEY (`id_nppt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=170 ;

--
-- Dumping data for table `nppt`
--

INSERT INTO `nppt` (`id_nppt`, `id_pegawai`, `id_tujuan`, `maksud`, `id_transportasi`, `lama`, `tgl_pergi`, `tgl_kembali`, `tgl_dibuat`, `status`, `id_pegawai_perintah`) VALUES
(153, '90', '17', 'Mengikuti Kunjungan Kerja Dalam Rangka Mempersiapkan Pelaksanaan Peringatan Hari Kesatuan Gerak PKK (HKG-PKK) Tingkat Nasional ke 47', '5', '3', '2018-09-17', '2018-09-19', '2018-09-17', 'Y', 0),
(156, '83-120-135', '20', 'Melaksanakan Kegiatan Jambore Ajang Kreativitas (JAK) Remaja Genre Tingkat Nasional di Hotel Mason Pine Kota Baru Parahiyangan Bandung, Jawa Barat Jl. Raya Parahiyangan KM 1,8 Cipendeui Padalarang tanggal 13 s/d 17 Desember 2018', '5', '4', '2018-12-14', '2018-12-17', '2018-12-13', 'Y', 83),
(165, '128-132-170', '18', 'Menghadiri Undangan Pencanangan Bhakti Sosial TNI KB Kesehatan Tingkat Provinsi Sumatera Barat Tahun 2018 tanggal 28 Juni 2018', '7', '1', '2018-06-28', '2018-06-28', '2018-06-26', 'Y', 132),
(166, '83-170', '17', 'Meengikuti Perjalanan Dinas', '5', '2', '2019-03-01', '2019-03-02', '2019-02-26', 'Y', 83),
(167, '83-170', '17', 'Mengikuti Kegiatan Rapat KB', '5', '4', '2019-02-28', '2019-03-03', '2019-02-27', 'Y', 83),
(169, '83-170', '17', 'fr', '5', '2', '2019-02-25', '2019-02-26', '2019-02-25', 'N', 170);

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE IF NOT EXISTS `pangkat` (
  `id_pangkat` int(5) NOT NULL AUTO_INCREMENT,
  `pangkat` varchar(200) NOT NULL,
  PRIMARY KEY (`id_pangkat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id_pangkat`, `pangkat`) VALUES
(7, 'Pembina Utama Muda/(IVc)'),
(8, 'Pembina Tk.I/(IV/b)'),
(9, 'Pembina/(IV/a)'),
(10, 'Penata Tk.I/(III/d)'),
(11, 'Penata/(III/c)'),
(12, 'Penata Muda Tk.I/(III/b)'),
(13, 'Penata Muda Tk.I/(III/a)'),
(14, 'Penata Muda/(III/a)'),
(15, 'Pengatur Tk.I(II/d)'),
(16, 'Pengatur Muda Tk.I(II/b)'),
(17, 'Pengatur /(II/c)'),
(18, 'Pengatur Muda Tk.I /(II/b)'),
(20, 'Penata Muda Tk.I /(III/d)');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(5) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_pangkat` int(5) NOT NULL,
  `id_jabatan` int(5) NOT NULL,
  `unitkerja` varchar(500) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nip`, `nama`, `id_pangkat`, `id_jabatan`, `unitkerja`, `username`, `password`, `foto`) VALUES
(81, '19600421 199003 1 005', 'Ir. Heryanto Rustam, MM', 7, 26, 'DP3AP2KB Kota Padang', '19600421 199003 1 005', '19600421 199003 1 005', ''),
(82, '19630310 198903 2 006', 'Drs. Mardanis', 8, 27, 'DP3AP2KB Kota Padang', '19630310 198903 2 006', '19630310 198903 2 006', ''),
(83, '19657406 221401 1 016', 'Wirdanis, S.Sos', 10, 28, 'DP3AP2KB Kota Padang', '19600304 199103 1 002', '19600304 199103 1 002', ''),
(84, '19700624 199003 1 001', 'Drs. Elfian Putra Ifadi, M.SI', 8, 29, 'DP3AP2KB Kota Padang', '19700624 199003 1 001', '19700624 199003 1 001', ''),
(85, '19660509 196602 2 001', 'Ns. Detti Yendra, S.Kep', 8, 30, 'DP3AP2KB Kota Padang', '19660509 196602 2 001', '19660509 196602 2 001', ''),
(86, '19610510 196210 1 002', 'Drs. Fabian', 9, 31, 'DP3AP2KB Kota Padang', '19610510 196210 1 002', '19610510 196210 1 002', ''),
(87, '19630705 198503 2 003', 'Neng Sumarni', 9, 32, 'DP3AP2KB Kota Padang', '19630705 198503 2 003', '19630705 198503 2 003', ''),
(88, '19651010 199302 2 001', 'Drs. Reno Fujiani', 9, 33, 'DP3AP2KB Kota Padang', '19651010 199302 2 001', '19651010 199302 2 001', ''),
(89, '19621201 199203 2 004', 'Misnawati, SE', 9, 34, 'DP3AP2KB Kota Padang', '19621201 199203 2 004', '19621201 199203 2 004', ''),
(90, '19670727 199308 2 001', 'Eva Mustika Roza, SE, MM', 9, 35, 'DP3AP2KB Kota Padang', '19670727 199308 2 001', '19670727 199308 2 001', ''),
(91, '19650619 199308 2 001', 'Ir. Dianti Sharlina, MP', 9, 35, 'DP3AP2KB Kota Padang', '19650619 199308 2 001', '19650619 199308 2 001', ''),
(92, '19651231 199403 1 061', 'Hanurawan, SE, MM', 9, 37, 'DP3AP2KB Kota Padang', '19651231 199403 1 061', '19651231 199403 1 061', ''),
(93, '19680313 199312 2 002', 'Diani Novita, SH', 9, 47, 'DP3AP2KB Kota Padang', '19680313 199312 2 002', '19680313 199312 2 002', ''),
(94, '19610715 198703 2 002     ', 'Ermiati, SH', 9, 39, 'DP3AP2KB Kota Padang', '19610715 198703 2 002     ', '19610715 198703 2 002     ', ''),
(95, '19690417 200212 2 004', 'Hj. Zulnimar, S.Pd, MM', 9, 40, 'DP3AP2KB Kota Padang', '19690417 200212 2 004', '19690417 200212 2 004', ''),
(96, '19601112 198312 2 002', 'Irmawati, SH', 9, 41, 'DP3AP2KB Kota Padang', '19601112 198312 2 002', '19601112 198312 2 002', ''),
(97, '19611218 198401 2 001', 'Armidar, SH', 9, 42, 'DP3AP2KB Kota Padang', '19611218 198401 2 001', '19611218 198401 2 001', ''),
(98, '19601231 198903 1 068', 'Tasman, SH', 9, 43, 'DP3AP2KB Kota Padang', '19601231 198903 1 068', '19601231 198903 1 068', ''),
(99, '19620423 198903 2 004 ', 'Sasmiati, SH', 9, 44, 'DP3AP2KB Kota Padang', '19620423 198903 2 004 ', '19620423 198903 2 004 ', ''),
(100, '19601231 198703 2 001', 'Aisyiah, SH', 9, 45, 'DP3AP2KB Kota Padang', '19601231 198703 2 001', '19601231 198703 2 001', ''),
(101, '19630817 198903 1 010', 'Efrizal, SH', 9, 43, 'DP3AP2KB Kota Padang', '19630817 198903 1 010', '19630817 198903 1 010', ''),
(102, '19630825 198903 2 003', 'Gusmiwati, SH', 9, 46, 'DP3AP2KB Kota Padang', '19630825 198903 2 003', '19630825 198903 2 003', ''),
(103, '19660420 199003 2 002', 'Aryetti, SH', 9, 45, 'DP3AP2KB Kota Padang', '19660420 199003 2 002', '19660420 199003 2 002', ''),
(104, '19620414 198603 2 004', 'Yusni, SH', 9, 47, 'DP3AP2KB Kota Padang', '19620414 198603 2 004', '19620414 198603 2 004', ''),
(105, '19620912 198603 2 003', 'Susberti, SH', 9, 45, 'DP3AP2KB Kota Padang', '19620912 198603 2 003', '19620912 198603 2 003', ''),
(106, '19591014 198603 2 004', 'Nasni, SH', 9, 48, 'DP3AP2KB Kota Padang', '19591014 198603 2 004', '19591014 198603 2 004', ''),
(107, '19631201 199303 2 003', 'Endi Ermawati, SH', 9, 49, 'DP3AP2KB Kota Padang', '19631201 199303 2 003', '19631201 199303 2 003', ''),
(108, '19641017 198903 1 009', 'Drs. Risnaldi', 10, 50, 'DP3AP2KB Kota Padang', '19641017 198903 1 009', '19641017 198903 1 009', ''),
(109, '19620701 199203 2 001              ', 'Elfi Yendri, SH', 10, 92, 'DP3AP2KB Kota Padang', '19620701 199203 2 001              ', '19620701 199203 2 001              ', ''),
(110, '19630808 198609 1 001', 'Sutan Ridwan, SH', 10, 63, 'DP3AP2KB Kota Padang', '19630808 198609 1 001', '19630808 198609 1 001', ''),
(111, '19600410 198101 1 001', 'Drs. Mukhlis', 10, 51, 'DP3AP2KB Kota Padang', '19600410 198101 1 001', '19600410 198101 1 001', ''),
(112, '19640202 199203 1 010', 'Ir. Jupri', 10, 52, 'DP3AP2KB Kota Padang', '19640202 199203 1 010', '19640202 199203 1 010', ''),
(113, '19660418 199203 2 005', 'Dra. Elfiana', 10, 53, 'DP3AP2KB Kota Padang', '19660418 199203 2 005', '19660418 199203 2 005', ''),
(114, '19700525 199312 2 001', 'Nurmei Dewina, SH', 10, 54, 'DP3AP2KB Kota Padang', '19700525 199312 2 001', '19700525 199312 2 001', ''),
(115, '19650523 198601 2 001', 'Dra. Adria', 10, 55, 'DP3AP2KB Kota Padang', '19650523 198601 2 001', '19650523 198601 2 001', ''),
(116, '19641020 199402 1 001', 'Drs. Yosep Oktabaren', 10, 56, 'DP3AP2KB Kota Padang', '19641020 199402 1 001', '19641020 199402 1 001', ''),
(117, '19630110 198401 2 001', 'Yuhelda, Amd', 10, 57, 'DP3AP2KB Kota Padang', '19630110 198401 2 001', '19630110 198401 2 001', ''),
(118, '19601229 198803 2 007', 'Nurhamaiyar', 10, 46, 'DP3AP2KB Kota Padang', '19601229 198803 2 007', '19601229 198803 2 007', ''),
(119, '19630908 198603 1 007', 'Hendrianto', 10, 58, 'DP3AP2KB Kota Padang', '19630908 198603 1 007', '19630908 198603 1 007', ''),
(120, '19640227 198503 2 006', 'Efridawati, S.Sos', 10, 59, 'DP3AP2KB Kota Padang', '19640227 198503 2 006', '19640227 198503 2 006', ''),
(121, '19650601 199403 2 004     ', 'Dra. Wedya', 10, 60, 'DP3AP2KB Kota Padang', '19650601 199403 2 004     ', '19650601 199403 2 004     ', ''),
(122, '19600617 198303 2 005     ', 'Yurnes Nelly, SH', 10, 61, 'DP3AP2KB Kota Padang', '19600617 198303 2 005     ', '19600617 198303 2 005     ', ''),
(123, '19620628 198903 1 004', 'Muswardi, S.Sos', 10, 62, 'DP3AP2KB Kota Padang', '19620628 198903 1 004', '19620628 198903 1 004', ''),
(124, '19661013 199203 2 002', 'Ade Yulda. S, SE', 10, 63, 'DP3AP2KB Kota Padang', '19661013 199203 2 002', '19661013 199203 2 002', ''),
(125, '19620806 198903 1 005', 'Arwan, S.Sos', 10, 64, 'DP3AP2KB Kota Padang', '19620806 198903 1 005', '19620806 198903 1 005', ''),
(126, '19620725 198312 2 001', 'Hj. Yuliarni', 10, 65, 'DP3AP2KB Kota Padang', '19620725 198312 2 001', '19620725 198312 2 001', ''),
(127, '19601211 198401 2 002', 'M. Endriyati', 10, 66, 'DP3AP2KB Kota Padang', '19601211 198401 2 002', '19601211 198401 2 002', ''),
(128, '19630215 199103 1 005', 'Gusnta Taspa, S.Sos', 9, 93, 'DP3AP2KB Kota Padang', '19630215 199103 1 005', '19630215 199103 1 005', ''),
(129, '19670817 198903 2 008', 'Lili Andriati', 10, 68, 'DP3AP2KB Kota Padang', '19670817 198903 2 008', '19670817 198903 2 008', ''),
(130, '19610202 198103 2 005', 'Dra. Nurhayati', 10, 69, 'DP3AP2KB Kota Padang', '19610202 198103 2 005', '19610202 198103 2 005', ''),
(131, '19611125 198708 1 004', 'Herwin, S.Sos', 10, 31, 'DP3AP2KB Kota Padang', '19611125 198708 1 004', '19611125 198708 1 004', ''),
(132, '19651215 199203 2 004', 'Dra. Endang Krushastani', 10, 70, 'DP3AP2KB Kota Padang', '19651215 199203 2 004', '19651215 199203 2 004', ''),
(133, '19650626 198702 2 001     ', 'Yulwasmi, S.Sos', 10, 71, 'DP3AP2KB Kota Padang', '19650626 198702 2 001     ', '19650626 198702 2 001     ', ''),
(134, '19650807 198803 1 004', 'Afansyah, S.Sos', 10, 57, 'DP3AP2KB Kota Padang', '19650807 198803 1 004', '19650807 198803 1 004', ''),
(135, '19670225 199001 2 002', 'Murnetti, SH, MM', 10, 72, 'DP3AP2KB Kota Padang', '19670225 199001 2 002', '19670225 199001 2 002', ''),
(136, '19701019 199003 2 002', 'Refni Elita, SH', 10, 73, 'DP3AP2KB Kota Padang', '19701019 199003 2 002', '19701019 199003 2 002', ''),
(137, '19630928 198303 1 002', 'Irham', 11, 74, 'DP3AP2KB Kota Padang', '19630928 198303 1 002', '19630928 198303 1 002', ''),
(138, '19611231 198202 1 019', 'Syafri, A.Ma.Pd', 11, 75, 'DP3AP2KB Kota Padang', '19611231 198202 1 019', '19611231 198202 1 019', ''),
(139, '19801103 200604 2 010', 'Sorraya, ST', 11, 76, 'DP3AP2KB Kota Padang', '19801103 200604 2 010', '19801103 200604 2 010', ''),
(140, '19730122 200604 2 001 ', 'Fitra Ain, SH', 11, 77, 'DP3AP2KB Kota Padang', '19730122 200604 2 001 ', '19730122 200604 2 001 ', ''),
(141, '19640812 198603 1 011', 'Asri, S.Sos', 19, 94, 'DP3AP2KB Kota Padang', '19640812 198603 1 011', '19640812 198603 1 011', ''),
(142, '19681018 199308 2 001                ', 'Mardhatillah, B.Sc', 11, 30, 'DP3AP2KB Kota Padang', '19681018 199308 2 001                ', '19681018 199308 2 001                ', ''),
(143, '19830504 200112 2 002', 'Emilza, S.STP, M.I.Kom', 11, 78, 'DP3AP2KB Kota Padang', '19830504 200112 2 002', '19830504 200112 2 002', ''),
(144, '19640325 200901 1 002', 'Muzni, ST', 11, 79, 'DP3AP2KB Kota Padang', '19640325 200901 1 002', '19640325 200901 1 002', ''),
(145, '19790728 200701 2 004', 'Dina Juita. SY, SH', 11, 80, 'DP3AP2KB Kota Padang', '19790728 200701 2 004', '19790728 200701 2 004', ''),
(146, '19740414 200312 2 002', 'Syuryani, S.Kom, MM', 12, 81, 'DP3AP2KB Kota Padang', '19740414 200312 2 002', '19740414 200312 2 002', ''),
(147, '19630301 198403 2 002     ', 'Murniati', 12, 31, 'DP3AP2KB Kota Padang', '19630301 198403 2 002     ', '19630301 198403 2 002     ', ''),
(148, '19610404 198312 2 001', 'Tisnawati', 12, 82, 'DP3AP2KB Kota Padang', '19610404 198312 2 001', '19610404 198312 2 001', ''),
(149, '19610429 198703 1 006', 'Murdif', 12, 30, 'DP3AP2KB Kota Padang', '19610429 198703 1 006', '19610429 198703 1 006', ''),
(150, '19810916 200901 2 003     ', 'Elvi, SE.Akt, M.Si, CA', 12, 83, 'DP3AP2KB Kota Padang', '19810916 200901 2 003     ', '19810916 200901 2 003     ', ''),
(151, '19710312 199303 2 006     ', 'Afriyanti', 12, 30, 'DP3AP2KB Kota Padang', '19710312 199303 2 006     ', '19710312 199303 2 006     ', ''),
(152, '19640402 198603 2 007     ', 'Afrida', 12, 84, 'DP3AP2KB Kota Padang', '19640402 198603 2 007     ', '19640402 198603 2 007     ', ''),
(153, '19610624 199403 1 002', 'Antonius', 12, 85, 'DP3AP2KB Kota Padang', '19610624 199403 1 002', '19610624 199403 1 002', ''),
(154, '19760829 201001 2 006      ', 'Gusri Rahmadhatul, SE', 12, 86, 'DP3AP2KB Kota Padang', '19760829 201001 2 006      ', '19760829 201001 2 006      ', ''),
(155, '19700616 201001 2 001     ', 'Erni Viyanti A, S.Kom', 12, 30, 'DP3AP2KB Kota Padang', '19700616 201001 2 001     ', '19700616 201001 2 001     ', ''),
(156, '19641111 198903 1 008', 'Mukhlis', 12, 87, 'DP3AP2KB Kota Padang', '19641111 198903 1 008', '19641111 198903 1 008', ''),
(157, '19680525 200701 2 005    ', 'Yusnelli', 13, 31, 'DP3AP2KB Kota Padang', '19680525 200701 2 005    ', '19680525 200701 2 005    ', ''),
(158, '19920810 201502 2 005', 'Yesi Agusti, SKM', 14, 47, 'DP3AP2KB Kota Padang', '19920810 201502 2 005', '19920810 201502 2 005', ''),
(159, '19861127 200901 2 002      ', 'Rama Sari Novia, Amd', 15, 30, 'DP3AP2KB Kota Padang', '19861127 200901 2 002      ', '19861127 200901 2 002      ', ''),
(160, '19860731 201001 2 008', 'Devita Helena, Amd', 15, 89, 'DP3AP2KB Kota Padang', '19860731 201001 2 008', '19860731 201001 2 008', ''),
(161, '19700613 200701 1 007                 ', 'Junaidi J.', 16, 31, 'DP3AP2KB Kota Padang', '19700613 200701 1 007                 ', '19700613 200701 1 007                 ', ''),
(162, '19790610 200801 1 004                        ', 'Zulkarnaen', 17, 31, 'DP3AP2KB Kota Padang', '19790610 200801 1 004                        ', '19790610 200801 1 004                        ', ''),
(163, '19810101 201001 1 007', 'Antoro', 18, 90, 'DP3AP2KB Kota Padang', '19810101 201001 1 007', '19810101 201001 1 007', ''),
(164, '19850406 201001 1 015', 'Afrianto Z.', 18, 85, 'DP3AP2KB Kota Padang', '19850406 201001 1 015', '19850406 201001 1 015', ''),
(170, '19640812 198603 1 011', 'Asri, S.Sos', 20, 94, 'DP3AP2KB Kota Padang', '19640812 198603 1 011', '19640812 198603 1 011', ''),
(169, 'a', 'a', 8, 36, 'DP3AP2KB Kota Padang', 'a', 'a', ''),
(171, '1234', 'Satria', 7, 28, 'DP3AP2KB Kota Padang', '1234', '1234', '');

-- --------------------------------------------------------

--
-- Table structure for table `sppd`
--

CREATE TABLE IF NOT EXISTS `sppd` (
  `id_sppd` int(50) NOT NULL AUTO_INCREMENT,
  `id_pegawai` varchar(50) NOT NULL,
  `id_nppt` varchar(50) NOT NULL,
  `no_sppd` varchar(50) NOT NULL,
  `pemberi_perintah` varchar(100) NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `mata_anggaran` text NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_sppd` date NOT NULL,
  PRIMARY KEY (`id_sppd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `sppd`
--

INSERT INTO `sppd` (`id_sppd`, `id_pegawai`, `id_nppt`, `no_sppd`, `pemberi_perintah`, `instansi`, `mata_anggaran`, `keterangan`, `tgl_sppd`) VALUES
(62, '128-132-170', '165', '/Sekrt/DP3AP2KB-SPT/VI/2018', 'Sekretaris Daerah Kota Padang', 'DP3AP2KB Kota Padang', 'DP3AP2KB Kota Padang 2.02.2.02.01.01.18.5.2.2.15.02', '', '0000-00-00'),
(63, '83-120-135', '156', '/DP3AP2KB-SPT/XII/2018', 'Sekretaris Daerah Kota Padang', 'DP3AP2KB Kota Padang', 'DP3AP2KB Kota Padang 2.02.2.02.01.01.18.5.2.2.15.02', '', '0000-00-00'),
(64, '90', '153', '/DP3AP2KB-SPT/X/2018', 'Sekretaris Daerah Kota Padang', 'DP3AP2KB Kota Padang', 'DPA DP3AP2KB Kota Padang No. Rekening 1.12.01.01.18.5.2.215.002', '', '0000-00-00'),
(65, '83-170', '166', '/DP3AP2KB-SPPD/VII/2018', 'Sekretaris Daerah Kota Padang', 'DP3AP2KB Kota Padang', 'DP3AP2KB Kota Padang 2.02.2.02.01.01.18.5.2.2.15.02', '', '0000-00-00'),
(66, '83-170', '167', '/DP3AP2KB-SPT/X/2018', 'Sekretaris Daerah Kota Padang', 'DP3AP2KB Kota Padang', 'DP3AP2KB Kota Padang 2.02.2.02.01.01.18.5.2.2.15.02', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `spt`
--

CREATE TABLE IF NOT EXISTS `spt` (
  `id_spt` int(50) NOT NULL AUTO_INCREMENT,
  `no_spt` varchar(50) NOT NULL,
  `id_nppt` varchar(50) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `pejabat_perintah` varchar(100) NOT NULL,
  `tugas` text NOT NULL,
  `tgl_spt` date NOT NULL,
  `dasar_hukum` text NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `pembebanan_anggaran` text NOT NULL,
  PRIMARY KEY (`id_spt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `spt`
--

INSERT INTO `spt` (`id_spt`, `no_spt`, `id_nppt`, `id_pegawai`, `pejabat_perintah`, `tugas`, `tgl_spt`, `dasar_hukum`, `tempat`, `pembebanan_anggaran`) VALUES
(23, '/DP3AP2KB-SPT/X/2018', '153', '90', 'Sekretariat Daerah Kota Padang', 'Mengikuti Kunjungan Kerja Dalam Rangka Mempersiapkan Pelaksanaan Peringatan Hari Kesatuan Gerak PKK (HKG-PKK) Tingkat Nasional ke 47', '0000-00-00', 'Surat Kepala Dinas Pemberdayaan Masyarakat dan Desa Provinsi Sumatera Barat Nomor : 411.21.663/DPMD-2018 tanggal 12 September 2018 Perihal Kunjungan Kerja ke Provinsi Jawa Timur', 'Surabaya', 'DPA DP3AP2KB Kota Padang\r\nNo. Rekening 1.12.01.01.18.5.2.215.002'),
(25, '/Sekrt/DP3AP2KB-SPT/VI/2018', '165', '128-132-170', 'Sekretariat Daerah Kota Padang', 'Menghadiri Undangan Pencanangan Bhakti Sosial TNI KB Kesehatan Tingkat Provinsi Sumatera Barat Tahun 2018 tanggal 28 Juni 2018', '0000-00-00', '1. Surat BKKBN Provinsi Sumatera Barat No.5527/HL.101/J.5/2018 tanggal 21 Juni 2018 perihal Undangan Pencanangan Bhakti Sosial TNI KB Kesehatan Prov. Sumbar Tahun 2018', 'Bukittinggi', 'DP3AP2KB Kota Padang\r\n2.02.2.02.01.01.18.5.2.2.15.02'),
(26, '/DP3AP2KB-SPT/XII/2018', '156', '83-120-135', 'Sekretariat Daerah Kota Padang', 'Melaksanakan Kegiatan Jambore Ajang Kreativitas (JAK) Remaja Genre Tingkat Nasional di Hotel Mason Pine Kota Baru Parahiyangan Bandung, Jawa Barat Jl. Raya Parahiyangan KM 1,8 Cipendeui Padalarang tanggal 13 s/d 17 Desember 2018', '0000-00-00', 'Surat BKKBN Pusat Nomor: 1686/PK.0202/F2/2018 tanggal 13 November 2018 tentang kegiatan Jambore Ajang Kreatifitas (JAK) Remaja Genre Tingkat Nasional Tahun 2018', 'Bandung', 'DP3AP2KB Kota Padang\r\n2.02.2.02.01.01.18.5.2.2.15.02'),
(27, '/DP3AP2KB-SPT/VII/2018', '166', '83-170', 'Sekretariat Daerah Kota Padang', 'Meengikuti Perjalanan Dinas', '0000-00-00', 'dasar hukum bpo', 'Surabaya', '12445'),
(28, '/DP3AP2KB-SPT/X/2018', '167', '83-170', 'Sekretariat Daerah Kota Padang', 'Mengikuti Kegiatan Rapat KB', '0000-00-00', 'dfbd', 'Surabaya', 'fdv');

-- --------------------------------------------------------

--
-- Table structure for table `transportasi`
--

CREATE TABLE IF NOT EXISTS `transportasi` (
  `id_transportasi` int(5) NOT NULL AUTO_INCREMENT,
  `transportasi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_transportasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `transportasi`
--

INSERT INTO `transportasi` (`id_transportasi`, `transportasi`) VALUES
(5, 'Pesawat'),
(6, 'Bus'),
(7, 'Mobil Dinas');

-- --------------------------------------------------------

--
-- Table structure for table `ttdkwitansi`
--

CREATE TABLE IF NOT EXISTS `ttdkwitansi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kabag` varchar(100) NOT NULL,
  `nip_kabag` varchar(100) NOT NULL,
  `bendahara` varchar(100) NOT NULL,
  `nip_bendahara` varchar(100) NOT NULL,
  `pptk` varchar(100) NOT NULL,
  `nip_pptk` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ttdkwitansi`
--

INSERT INTO `ttdkwitansi` (`id`, `kabag`, `nip_kabag`, `bendahara`, `nip_bendahara`, `pptk`, `nip_pptk`) VALUES
(1, 'Ir. Heryanto Rustam, MM', '19600421 199003 1 005', 'Devita Helena, A.Md', '19860731 201001 2 008', 'Ir. Jupri', '19640202 199203 1 010');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE IF NOT EXISTS `tujuan` (
  `id_tujuan` int(5) NOT NULL AUTO_INCREMENT,
  `tujuan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tujuan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tujuan`
--

INSERT INTO `tujuan` (`id_tujuan`, `tujuan`) VALUES
(17, 'Surabaya'),
(18, 'Bukittinggi'),
(19, 'Batam'),
(20, 'Bandung'),
(21, 'Jakarta');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
