-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2012 at 09:12 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `nilai_online_smansa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan_prestasi`
--

CREATE TABLE IF NOT EXISTS `catatan_prestasi` (
  `id_catatan` int(11) NOT NULL auto_increment,
  `nis` varchar(20) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `kegiatan` varchar(200) NOT NULL,
  `bukti_sertifikasi` text NOT NULL,
  PRIMARY KEY  (`id_catatan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `catatan_prestasi`
--

INSERT INTO `catatan_prestasi` (`id_catatan`, `nis`, `semester`, `id_kelas`, `tahun_ajaran`, `kegiatan`, `bukti_sertifikasi`) VALUES
(9, '12', 'Ganjil', '1B', '2011', 'Voly', 'Juara 2'),
(8, '11', 'Genap', '1A', '2012', 'Karate', 'Juara 1'),
(15, '11', 'Ganjil', '3S1', '1112', 'fds', 'fdsfdsf');

-- --------------------------------------------------------

--
-- Table structure for table `kepribadian`
--

CREATE TABLE IF NOT EXISTS `kepribadian` (
  `id_kepribadian` int(11) NOT NULL auto_increment,
  `nis` varchar(20) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `Kode_Mp` varchar(10) NOT NULL,
  `kedisiplinan` varchar(100) NOT NULL,
  `kebersihan` varchar(100) NOT NULL,
  `kesehatan` varchar(100) NOT NULL,
  `tanggung_jawab` varchar(100) NOT NULL,
  `sopan_santun` varchar(100) NOT NULL,
  `percaya_diri` varchar(100) NOT NULL,
  `kompetetif` varchar(100) NOT NULL,
  `hubungan_sosial` varchar(100) NOT NULL,
  `kejujuran` varchar(100) NOT NULL,
  `pelaksanaan_ibadah` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_kepribadian`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `kepribadian`
--

INSERT INTO `kepribadian` (`id_kepribadian`, `nis`, `semester`, `id_kelas`, `tahun_ajaran`, `Kode_Mp`, `kedisiplinan`, `kebersihan`, `kesehatan`, `tanggung_jawab`, `sopan_santun`, `percaya_diri`, `kompetetif`, `hubungan_sosial`, `kejujuran`, `pelaksanaan_ibadah`) VALUES
(14, '11', 'Ganjil', '3S1', '1112', '', 'dfdsfds', 'fdsf', 'dsf', 'sdfsd', 'sdfdsf', 'dsfds', 'dsf', 'f', 'fsd', 'dfds'),
(16, '321', 'Ganjil', '3S1', '1112', '', 'fsd', 'sdfsd', 'fsdf', 'fds', 'sdfdsf', 'fsd', 'fsd', 'sfsd', 'sdf', 'fdsfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `ketidakhadiran`
--

CREATE TABLE IF NOT EXISTS `ketidakhadiran` (
  `id_ketidakhadiran` int(11) NOT NULL auto_increment,
  `nis` varchar(20) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `sakit` int(11) NOT NULL,
  `ijin` int(11) NOT NULL,
  `alpha` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_ketidakhadiran`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ketidakhadiran`
--

INSERT INTO `ketidakhadiran` (`id_ketidakhadiran`, `nis`, `semester`, `id_kelas`, `tahun_ajaran`, `sakit`, `ijin`, `alpha`, `keterangan`) VALUES
(8, '12', 'Ganjil', '1B', '2011', 1, 1, 1, ''),
(13, '11', 'Ganjil', '1A', '1112', 2, 2, 2, 'dfgdfgfhgfh'),
(16, '321', 'Ganjil', '3S1', '1112', 2, 2, 2, 'sdf'),
(15, '312', 'Ganjil', '3S1', '1112', 2, 2, 2, 'fsdf'),
(14, '11', 'Ganjil', '3S1', '1112', 2, 2, 2, 'dsfsd'),
(17, '211', 'Ganjil', '2A1', '1112', 1, 1, 1, 'fgd');

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi`
--

CREATE TABLE IF NOT EXISTS `kompetensi` (
  `id_kompetensi` int(11) NOT NULL auto_increment,
  `NIS` varchar(11) default NULL,
  `id_kelas` varchar(11) NOT NULL,
  `Kode_Mp` varchar(6) default NULL,
  `ketercapaian_kompetensi` text,
  `Smester` varchar(20) default NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_kompetensi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`id_kompetensi`, `NIS`, `id_kelas`, `Kode_Mp`, `ketercapaian_kompetensi`, `Smester`, `tahun_ajaran`) VALUES
(53, '12', '1', 'PPKN', 'Sangat Memenuhi KKM', 'Ganjil', '2011'),
(52, '12', '1', 'SJR', 'Memenuhi KKM', 'Ganjil', '2011'),
(80, '11', '1A', 'BIO', 'fczxfcsdfd', 'Ganjil', '1112'),
(92, '321', '3S1', 'BIO', 'werwe', 'Ganjil', '1011'),
(91, '312', '3S1', 'BIO', 'ewrwer', 'Ganjil', '1011'),
(90, '11', '3S1', 'BIO', 'rewr', 'Ganjil', '1011'),
(93, '211', '2A1', 'FIS', 'dsadas', 'Ganjil', '1112');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_harian`
--

CREATE TABLE IF NOT EXISTS `nilai_harian` (
  `id_nilai_harian` int(11) NOT NULL auto_increment,
  `NIS` varchar(11) NOT NULL,
  `id_kelas` varchar(11) NOT NULL,
  `Kode_Mp` varchar(6) NOT NULL,
  `UH1` int(11) NOT NULL,
  `UH2` int(11) NOT NULL,
  `UH3` int(11) NOT NULL,
  `UH4` int(11) NOT NULL,
  `UH5` int(11) NOT NULL,
  `UH6` int(11) NOT NULL,
  `UTS` int(11) NOT NULL,
  `UAS` int(11) NOT NULL,
  `Smester` varchar(20) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_nilai_harian`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `nilai_harian`
--

INSERT INTO `nilai_harian` (`id_nilai_harian`, `NIS`, `id_kelas`, `Kode_Mp`, `UH1`, `UH2`, `UH3`, `UH4`, `UH5`, `UH6`, `UTS`, `UAS`, `Smester`, `tahun_ajaran`) VALUES
(2, '11', '3S1', 'GEO', 11, 11, 11, 11, 11, 11, 11, 11, 'Ganjil', '1112'),
(3, '312', '3S1', 'GEO', 312, 312, 312, 312, 312, 312, 312, 312, 'Ganjil', '1112'),
(4, '321', '3S1', 'GEO', 321, 321, 321, 321, 321, 321, 321, 321, 'Ganjil', '1112'),
(5, '11', '3S1', 'IND', 23, 21, 21, 21, 21, 21, 21, 21, 'Ganjil', '1112'),
(6, '312', '3S1', 'IND', 21, 21, 21, 221, 21, 21, 21, 21, 'Ganjil', '1112'),
(7, '321', '3S1', 'IND', 21, 21, 21, 21, 21, 21, 21, 12, 'Ganjil', '1112'),
(8, '211', '2A1', 'FIS', 211, 211, 211, 211, 211, 211, 211, 211, 'Ganjil', '1112'),
(9, '11', '3S1', 'IND', 211, 11, 11, 11, 11, 21, 11, 21, 'Genap', '1112'),
(10, '312', '3S1', 'IND', 312, 21, 312, 221, 312, 21, 21, 312, 'Genap', '1112'),
(11, '321', '3S1', 'IND', 21, 321, 321, 321, 21, 321, 21, 321, 'Genap', '1112');

-- --------------------------------------------------------

--
-- Table structure for table `pengembangan_diri`
--

CREATE TABLE IF NOT EXISTS `pengembangan_diri` (
  `id_pengembangandiri` int(11) NOT NULL auto_increment,
  `nis` varchar(20) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `jenis_kegiatan` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`id_pengembangandiri`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pengembangan_diri`
--

INSERT INTO `pengembangan_diri` (`id_pengembangandiri`, `nis`, `semester`, `id_kelas`, `tahun_ajaran`, `jenis_kegiatan`, `keterangan`) VALUES
(7, '12', 'Ganjil', '1B', '2011', 'Voly', 'Rajin Sekali'),
(6, '11', 'Genap', '1A', '2011', 'Pramuka', 'Rajin'),
(15, '11', 'Ganjil', '3S1', '1112', 'sadfas', 'dsadsa');

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE IF NOT EXISTS `statistik` (
  `ip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL default '1',
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`ip`, `tanggal`, `hits`, `online`) VALUES
('127.0.0.1', '2012-02-11', 303, '1328979575'),
('127.0.0.1', '2012-02-12', 539, '1329065978'),
('127.0.0.1', '2011-12-01', 1, '1322731794'),
('127.0.0.1', '2012-02-13', 60, '1329152069'),
('127.0.0.1', '2012-02-14', 55, '1329238752'),
('127.0.0.1', '2012-02-15', 227, '1329325086'),
('127.0.0.1', '2012-02-16', 152, '1329404042'),
('127.0.0.1', '2012-02-17', 42, '1329495638'),
('127.0.0.1', '2012-02-18', 223, '1329566086'),
('127.0.0.1', '2012-02-19', 13, '1329652731'),
('127.0.0.1', '2012-02-21', 44, '1329832965');

-- --------------------------------------------------------

--
-- Table structure for table `tguru`
--

CREATE TABLE IF NOT EXISTS `tguru` (
  `id` int(11) NOT NULL auto_increment,
  `NIP` varchar(30) NOT NULL,
  `Nama_Guru` varchar(50) default NULL,
  `alamat` varchar(255) NOT NULL,
  `kodepos` varchar(20) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `Jenis_Kelamin` varchar(10) default NULL,
  `agama` varchar(15) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `No_Telp` varchar(20) default NULL,
  `Pendidikan_Terakhir` varchar(30) default NULL,
  `jabatan` varchar(20) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tguru`
--

INSERT INTO `tguru` (`id`, `NIP`, `Nama_Guru`, `alamat`, `kodepos`, `tempat_lahir`, `tgl_lahir`, `Jenis_Kelamin`, `agama`, `kota`, `email`, `No_Telp`, `Pendidikan_Terakhir`, `jabatan`, `photo`) VALUES
(22, '1980', 'Neneng', 'Perumnas', '52273', 'Brebes', '2011-12-16', 'Wanita', 'Islam', 'Bumiayu', 'neneng@yahoo.com', '08191980', 'D3', '', ''),
(21, '1970', 'Agus', 'Brebes', '52273', 'Brebes', '2011-12-06', 'Pria', 'Islam', 'Bumiayu', 'agus@yahoo.com', '08191970', 'S1', '', ''),
(20, '1961', 'Kudri', 'Perumnas', '52273', 'Brebes', '2011-12-04', 'Pria', 'Islam', 'Bumiayu', 'kudri@yahoo.com', '08191961', 'S1', '', ''),
(19, '1960', 'Kuzeni', 'Langkap', '52273', 'Brebes', '2011-12-07', 'Pria', 'Islam', 'Bumiayu', 'kuzeni@yahoo,com', '08191960', 'S1', '', ''),
(18, '1957', 'Prabowo', 'Kalierang', '52273', 'Brebes', '2011-12-03', 'Pria', 'Islam', 'Bumiayu', 'prabowo@yahoo.com', '08191957', 'S1', '', ''),
(17, '1958', 'Harun', 'Langkap', '52273', 'Brebes', '2011-12-02', 'Pria', 'Islam', 'Bumiayu', 'harun@yahoo.com', '08191958', 'S1', '', ''),
(16, '1956', 'Susilo Wardoyo', 'Kauman', '52273', 'Purworejo', '2011-12-01', 'Pria', 'Islam', 'Bumiayu', 'susilo@yahoo.com', '081919566646', 'S1', 'Kepala Sekolah', 'PaPaH.jpg'),
(23, '1975', 'Nurlaely', 'Kaliwadas', '52273', 'Brebes', '2011-12-10', 'Wanita', 'Islam', 'Bumiayu', 'nurlaely@yahoo.com', '08191975', 'D1', '', ''),
(24, '1971', 'Dofir', 'Kalierang', '52273', 'Brebes', '2011-12-10', 'Pria', 'Islam', 'Bumiayu', 'dofir@yahoo.com', '08191971', 'S1', '', ''),
(25, '1972', 'Imam', 'Laren', '52273', 'Brebes', '2011-12-03', 'Pria', 'Islam', 'Bumiayu', 'imam@yahoo.com', '08191972', 'D3', '', ''),
(30, '1985', 'Novan', 'Dukuhturi', '52273', 'Brebes', '2012-01-04', 'Pria', 'Islam', 'Bumiayu', 'novan@yahoo.com', '08191985', 'S1', 'Guru', '');

-- --------------------------------------------------------

--
-- Table structure for table `tinformasi`
--

CREATE TABLE IF NOT EXISTS `tinformasi` (
  `id` int(11) NOT NULL auto_increment,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `oleh` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tinformasi`
--

INSERT INTO `tinformasi` (`id`, `judul`, `isi`, `oleh`, `created`) VALUES
(24, 'Guru Baru', '<p>Salam Kenal</p>', '1985', '2012-02-12 06:02:42'),
(25, 'Web', '<p>Update Web</p>', 'admin', '2012-02-12 06:03:10'),
(26, 'Nilai Online', '<p>Silahkan Cek Nilai</p>', 'admin', '2012-02-12 06:03:33'),
(27, 'Ulangan', '<p>3-IPS-1 Besok Ulangan Geografi</p>', '1956', '2012-02-12 06:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `tjadwalpelajaran`
--

CREATE TABLE IF NOT EXISTS `tjadwalpelajaran` (
  `ID_Jadwal` int(11) NOT NULL auto_increment,
  `ID_Kelas` varchar(5) default NULL,
  `Kode_Mp` varchar(6) default NULL,
  `NIP` varchar(15) default NULL,
  `Hari` varchar(15) default NULL,
  `Jam_Pelajaran` varchar(50) default NULL,
  `semester` varchar(20) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `urut` tinyint(4) NOT NULL,
  PRIMARY KEY  (`ID_Jadwal`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tjadwalpelajaran`
--

INSERT INTO `tjadwalpelajaran` (`ID_Jadwal`, `ID_Kelas`, `Kode_Mp`, `NIP`, `Hari`, `Jam_Pelajaran`, `semester`, `id_tahun_ajaran`, `urut`) VALUES
(6, '1A', 'EKO', '', 'Senin', '08:30 - 09:15', '', 1011, 1),
(5, '1A', 'BIO', '', 'Senin', '07:00 - 07:45', '', 1011, 0),
(10, '1B', 'SJR', '', 'Selasa', '09:30 - 10:15', '', 1112, 2),
(11, '1B', 'PPKN', '', 'Rabu', '10:15 - 11:00', '', 1112, 3),
(13, '3S1', 'GEO', '', 'Rabu', '09:30 - 10:15', '', 1112, 3),
(14, '1A', 'GEO', '', 'Jumat', '12:00 - 12:45', '', 1112, 5),
(16, '3S1', 'SJR', '', 'Kamis', '08:30 - 09:15', '', 1112, 4),
(18, '3S1', 'IND', '', 'Kamis', '11:00 - 11:45', 'Ganjil', 1112, 4),
(19, '2A1', 'FIS', '', 'Selasa', '07:45 - 08:30', 'Ganjil', 1011, 2),
(20, '1B', 'IND2', '', 'Senin', '10:15 - 11:00', 'Ganjil', 1112, 1),
(21, '3S1', 'BIO', '', 'Kamis', '09:30 - 10:15', 'Ganjil', 1112, 4),
(22, '1A', 'MTK', '', 'Kamis', '07:45 - 08:30', 'Ganjil', 1112, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tkelas`
--

CREATE TABLE IF NOT EXISTS `tkelas` (
  `ID_Kelas` varchar(5) NOT NULL,
  `Nama_Kelas` varchar(10) default NULL,
  `ID_Guru` varchar(15) default NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  PRIMARY KEY  (`ID_Kelas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkelas`
--

INSERT INTO `tkelas` (`ID_Kelas`, `Nama_Kelas`, `ID_Guru`, `id_tahun_ajaran`) VALUES
('2A1', '2-IPA-1', '1971', 1011),
('1B', 'X2', '1980', 1112),
('1A', 'X1', '1972', 1011),
('2A2', '2-IPA-2', '1975', 1112),
('2S1', '2-IPS-1', '1958', 1011),
('2S2', '2-IPS-2', '1960', 1112),
('3A1', '3-IPA-1', '1961', 1011),
('3A2', '3-IPA-2', '1970', 1112),
('3S1', '3-IPS-1', '1956', 1011),
('3S2', '3-IPS-2', '1957', 1112);

-- --------------------------------------------------------

--
-- Table structure for table `tkomentar`
--

CREATE TABLE IF NOT EXISTS `tkomentar` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `tkomentar`
--

INSERT INTO `tkomentar` (`id`, `nama`, `email`, `isi`, `created`) VALUES
(29, 'Riki', 'riki@yahoo.com', 'R', '2012-01-01 18:28:08'),
(28, 'Riki', 'riki@yahoo.com', 'FF', '2012-01-01 18:18:38'),
(27, 'Riki', 'riki@yahoo.com', 'AA', '2012-01-01 18:15:43'),
(26, 'Riki', 'riki@yahoo.com', 'SIP', '2012-01-01 18:14:36'),
(25, 'Riki', 'riki@yahoo.com', 'YES', '2012-01-01 18:13:28'),
(24, 'Riki', 'riki@yahoo.com', 'OK OK', '2012-01-01 18:11:52'),
(23, 'Riki', 'riki@yahoo.com', 'Mantap Abiez', '2012-01-01 15:12:30'),
(22, 'Wahyu', 'jah_satri4@yahoo.com', 'Website Keren', '2011-12-31 16:23:00'),
(21, 'Susilo', 'susilo@yahoo.com', 'Mantap', '2011-12-28 22:06:32'),
(20, 'Riki', 'riki@yahoo.com', 'Bagus Sekali', '2011-12-28 22:00:43'),
(31, 'Riki', 'riki@yahoo.com', 'rrrr', '2012-01-01 19:57:17'),
(32, 'Riki', 'riki@yahoo.com', 'fsdsd', '2012-01-01 19:58:25'),
(33, 'Riki', 'riki@yahoo.com', 'radf', '2012-01-01 20:00:42'),
(34, 'qwewq', 'jah_satri4@yahoo.com', 'fsaf', '2012-01-01 20:01:46'),
(35, 'as', 'jah_satri4@yahoo.com', 'fsa', '2012-01-01 20:02:41'),
(36, 'reqwrq', 'jah_satri4@yahoo.com', 'gsgdsg', '2012-01-01 20:03:42'),
(37, 'safsa', 'jah_satri4@yahoo.com', 'gfdssdg', '2012-01-01 20:04:20'),
(38, 'sfasaf', 'jah_satri4@yahoo.com', 'dsadfs', '2012-01-01 20:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `tmatapelajaran`
--

CREATE TABLE IF NOT EXISTS `tmatapelajaran` (
  `Kode_Mp` varchar(6) NOT NULL,
  `Nama_MP` varchar(50) default NULL,
  `id_guru` varchar(15) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `kkm` int(11) NOT NULL,
  PRIMARY KEY  (`Kode_Mp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmatapelajaran`
--

INSERT INTO `tmatapelajaran` (`Kode_Mp`, `Nama_MP`, `id_guru`, `id_tahun_ajaran`, `kkm`) VALUES
('MTK', 'Matematika', '1961', 1011, 0),
('PPKN', 'PPKN', '1960', 1011, 0),
('IND', 'Bahasa Indonesia', '1970', 1011, 0),
('GEO', 'Geografi', '1956', 1011, 0),
('SJR', 'Sejarah', '1958', 1011, 90),
('EKO', 'Ekonomi', '1957', 1011, 34),
('BIO', 'Biologi', '1975', 1011, 60),
('ING', 'Bahasa Inggris', '1980', 1011, 0),
('KIM', 'Kimia', '1972', 1011, 0),
('FIS', 'Fisika', '1971', 1011, 60),
('IND2', 'Bahasa Indonesia', '1985', 1112, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tnilai`
--

CREATE TABLE IF NOT EXISTS `tnilai` (
  `ID_Nilai` int(11) NOT NULL auto_increment,
  `NIS` varchar(11) default NULL,
  `id_kelas` varchar(11) NOT NULL,
  `Kode_Mp` varchar(6) default NULL,
  `nilai` int(11) default NULL,
  `praktik` tinyint(4) NOT NULL,
  `predikat` varchar(5) NOT NULL,
  `Smester` varchar(20) default NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  PRIMARY KEY  (`ID_Nilai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `tnilai`
--

INSERT INTO `tnilai` (`ID_Nilai`, `NIS`, `id_kelas`, `Kode_Mp`, `nilai`, `praktik`, `predikat`, `Smester`, `tahun_ajaran`, `keterangan`) VALUES
(99, '321', '3S1', 'BIO', 30, 30, 'C', 'Ganjil', '1112', ''),
(98, '312', '3S1', 'BIO', 30, 30, 'B', 'Ganjil', '1112', ''),
(97, '11', '3S1', 'BIO', 30, 30, 'C', 'Ganjil', '1112', ''),
(96, '11', '1A', 'BIO', 10, 10, 'A', 'Ganjil', '1011', ''),
(95, '211', '2A1', 'FIS', 40, 6, 'B', 'Ganjil', '1112', ''),
(100, '11', '3S1', 'IND', 100, 100, 'A', 'Ganjil', '1112', ''),
(101, '312', '3S1', 'IND', 100, 30, 'B', 'Ganjil', '1112', ''),
(102, '321', '3S1', 'IND', 30, 43, 'A', 'Ganjil', '1112', '');

-- --------------------------------------------------------

--
-- Table structure for table `tsiswa`
--

CREATE TABLE IF NOT EXISTS `tsiswa` (
  `nis` varchar(20) NOT NULL,
  `Nama` varchar(50) default NULL,
  `id_kelas` varchar(3) NOT NULL,
  `program` varchar(10) NOT NULL,
  `semester` enum('Genap','Ganjil') NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `panggilan` varchar(50) NOT NULL,
  `Jenis_Kelamin` varchar(10) default NULL,
  `agama` varchar(15) NOT NULL,
  `Tempat_Lahir` varchar(30) default NULL,
  `Tgl_Lahir` date default NULL,
  `anak_ke` tinyint(4) NOT NULL,
  `status_anak` varchar(50) NOT NULL,
  `tinggal` varchar(50) NOT NULL,
  `Alamat` varchar(100) default NULL,
  `ID_KabKota` varchar(100) default NULL,
  `Kode_Pos` varchar(7) default NULL,
  `No_Telp` varchar(20) default NULL,
  `Email` varchar(50) default NULL,
  `photo` varchar(255) NOT NULL,
  `nama_org_tua` varchar(50) NOT NULL,
  `alamat_org_tua` varchar(100) NOT NULL,
  `telepon_org_tua` varchar(20) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `ranking` decimal(4,0) NOT NULL,
  PRIMARY KEY  (`nis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tsiswa`
--

INSERT INTO `tsiswa` (`nis`, `Nama`, `id_kelas`, `program`, `semester`, `tahun_ajaran`, `panggilan`, `Jenis_Kelamin`, `agama`, `Tempat_Lahir`, `Tgl_Lahir`, `anak_ke`, `status_anak`, `tinggal`, `Alamat`, `ID_KabKota`, `Kode_Pos`, `No_Telp`, `Email`, `photo`, `nama_org_tua`, `alamat_org_tua`, `telepon_org_tua`, `pekerjaan`, `ranking`) VALUES
('222', 'Eko', '2S2', 'IPS', 'Genap', '1112', 'Eko', 'Pria', 'Islam', 'Bumiayu', '2011-12-08', 1, 'Anak Yatim', 'Kost', 'Kauman', 'Bumiayu', '52273', '0819222', 'eko@yahoo.com', '', 'Irpan', 'Bumiayu', '0819222', 'Bos', 0),
('221', 'Wahyu', '2S1', 'IPS', 'Ganjil', '1011', 'Wahyu', 'Pria', 'Islam', 'Brebes', '2011-12-01', 1, 'Anak Kandung', 'Kost', 'Kauman', 'Bumiayu', '52273', '0819221', 'jah_satri4@yahoo.com', 'ViNo.jpg', 'Ani', 'Bumiayu', '0819221', 'PNS', 0),
('212', 'Heykal', '2A2', 'IPA', 'Genap', '1112', 'Heykal', 'Pria', 'Islam', 'Bumiayu', '2011-12-14', 1, 'Anak Kandung', 'Kost', 'Dukuhturi', 'Bumiayu', '52273', '0819212', 'heykal@yahoo.com', '', 'Akhmad', 'Bumiayu', '0819212', 'Pegawai', 0),
('211', 'Rafli', '2A1', 'IPA', 'Ganjil', '1011', 'Rafli', 'Pria', 'Islam', 'Brebes', '2011-12-05', 1, 'Anak Kandung', 'Kost', 'Kalierang', 'Bumiayu', '52273', '0819211', 'rafli@yahoo,com', '', 'Prabowo', 'Bumiayu', '0819211', 'PNS', 0),
('12', 'Boby', '1B', '', 'Genap', '1112', 'Boby', 'Pria', 'Islam', 'Bumiayu', '2011-12-03', 1, 'Anak Kandung', 'Asrama', 'Asri', 'Bumiayu', '52273', '081912', 'boby@yahoo.co.id', '', 'Karim', 'Asri', '081912', 'Bos', 0),
('11', 'Riki', '3S1', 'IPS', 'Ganjil', '1011', 'Riki', 'Pria', 'Islam', 'Bumiayu', '2011-12-01', 3, 'Anak Piatu', 'Kost', 'Kauman Bumiayu', 'Bumiayu', '52273', '081911', 'riki@yahoo.com', '', 'AM', 'Bumiayu', '081911', 'Bos', 3),
('311', 'Yasir', '3A1', 'IPA', 'Ganjil', '1011', 'Yasir', 'Pria', 'Islam', 'Bumiayu', '2011-12-10', 1, 'Anak Kandung', 'Asrama', 'Dukuhturi', 'Bumiayu', '52273', '0819311', 'yasir@yahoo.com', '', 'Asmari', 'Bumiayu', '0819311', 'Pegawai', 0),
('312', 'Memet', '3S1', 'IPA', 'Genap', '1112', 'Memet', 'Pria', 'Islam', 'Bumiayu', '2011-12-06', 2, 'Anak Kandung', 'Kost', 'Kauman', 'Bumiayu', '52273', '0819312', 'memet@yahoo.com', '', 'AM', 'Bumiayu', '0819312', 'Bos', 3),
('321', 'Uli', '3S1', 'IPS', 'Ganjil', '1011', 'Uli', 'Pria', 'Islam', 'Bumiayu', '2011-12-10', 3, 'Anak Kandung', 'Orang Tua', 'Kauman', 'Bumiayu', '52273', '0819321', 'uli@yahoo.com', '', 'Muslim', 'Bumiayu', '0819321', 'Karyawan', 3),
('322', 'Budi', '3S2', 'IPS', 'Genap', '1112', 'Budi', 'Pria', 'Islam', 'Bumiayu', '2011-12-12', 5, 'Anak Kandung', 'Orang Tua', 'Kauman', 'Bumiayu', '52273', '0819322', 'budi@yahoo.com', '', 'Asmari', 'Bumiayu', '0819322', 'Wiraswasta', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ttahun_ajaran`
--

CREATE TABLE IF NOT EXISTS `ttahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ttahun_ajaran`
--

INSERT INTO `ttahun_ajaran` (`id`, `tahun`) VALUES
(1112, '2011-2012'),
(1011, '2010-2011');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(11) NOT NULL auto_increment,
  `nama_user` char(20) character set latin1 NOT NULL,
  `kata_kunci` varchar(100) collate latin1_general_ci default NULL,
  `status` varchar(20) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `nama_user`, `kata_kunci`, `status`) VALUES
(1, 'admin', 'admin', 'Admin'),
(19, '1956', '1956', 'Guru'),
(20, '11', '11', 'Siswa'),
(21, '221', '221', 'Siswa'),
(22, '321', '321', 'Siswa'),
(23, '1971', '1971', 'Guru'),
(24, '1985', '1985', 'Guru'),
(25, '1972', '1972', 'Guru');
