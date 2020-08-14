-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2020 at 09:22 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myrt`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `link` text NOT NULL,
  `display` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `path`, `link`, `display`) VALUES
(1, '私の', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_umum`
--

CREATE TABLE `gambar_umum` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `gum_code` varchar(40) NOT NULL,
  `user_code` varchar(40) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar_umum`
--

INSERT INTO `gambar_umum` (`id`, `path`, `gum_code`, `user_code`, `upload_date`) VALUES
(1, '/07410420200744281000000pcMzEye2AFIfu4xtgjTRiUuTe/16052020042520000000/addtext_com_MTUxODU1OTM4NA.jpg', '20052020162504000000', '07410420200744281000000pcMzEye2AFIfu4xtg', '2020-05-16 09:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id` int(11) NOT NULL,
  `id_grup` varchar(40) NOT NULL,
  `jalan` text NOT NULL,
  `rt` varchar(2) NOT NULL,
  `rw` varchar(2) NOT NULL,
  `kelurahan` varchar(40) NOT NULL,
  `kecamatan` varchar(40) NOT NULL,
  `kota` varchar(40) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `grup_code` varchar(40) NOT NULL,
  `access_code` varchar(225) NOT NULL,
  `type` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id`, `id_grup`, `jalan`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kota`, `kabupaten`, `grup_code`, `access_code`, `type`) VALUES
(1, 'LQ8IJ', 'Jalan Liman Mukti Raya 362', '1', '1', 'Pedurungan', 'Pedurungan', 'Semarang', 'Jawa Tengah', 'Ab0IEC4achVNSgyKpDT5eYv-d202022041111290', 'FHO5RBO', '1'),
(2, 'OED32', 'jalan percobaan', '1', '1', 'percobaan', 'percobaan', 'percobaaan', 'percobaan', 'GIlPmWMf3b5L0sQhB-qxSAX2Y202015070401160', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jentik_header`
--

CREATE TABLE `jentik_header` (
  `id` int(11) NOT NULL,
  `isi` varchar(50) NOT NULL,
  `jentik_code` varchar(40) NOT NULL,
  `jentik_code2` varchar(40) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jentik_header_week`
--

CREATE TABLE `jentik_header_week` (
  `id` int(11) NOT NULL,
  `minggu` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `status` varchar(7) NOT NULL,
  `jentik_code` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jentik_inner`
--

CREATE TABLE `jentik_inner` (
  `id` int(11) NOT NULL,
  `isi` varchar(50) NOT NULL,
  `minggu` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `status` varchar(6) NOT NULL,
  `jentik_code` varchar(40) NOT NULL,
  `jentik_code2` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kas_header`
--

CREATE TABLE `kas_header` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kas_code` varchar(40) NOT NULL,
  `grup_code` varchar(40) NOT NULL,
  `validasi` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas_header`
--

INSERT INTO `kas_header` (`id`, `nama`, `kas_code`, `grup_code`, `validasi`, `created_at`) VALUES
(289, 'b', 'K081146Sun20200900000012425C', 'Ab0IEC4achVNSgyKpDT5eYv-d202022041111290', '', '2020-08-09 16:12:46'),
(290, 'd', 'K081149Sun20200900000012425C', 'Ab0IEC4achVNSgyKpDT5eYv-d202022041111290', '', '2020-08-09 16:12:49'),
(291, 'a', 'K081153Sun20200900000012425C', 'Ab0IEC4achVNSgyKpDT5eYv-d202022041111290', '', '2020-08-09 16:12:53'),
(292, 'tralalalalal alalalalalalala', 'K081157Sun20200900000012425C', 'Ab0IEC4achVNSgyKpDT5eYv-d202022041111290', '', '2020-08-09 16:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `kas_inner`
--

CREATE TABLE `kas_inner` (
  `id` int(11) NOT NULL,
  `keperluan` varchar(30) NOT NULL,
  `pemasukan` varchar(50) NOT NULL,
  `pengeluaran` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `kas_code` varchar(30) NOT NULL,
  `kasinner_code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporrt`
--

CREATE TABLE `laporrt` (
  `id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `pengirim` varchar(40) NOT NULL,
  `grup_code` varchar(40) NOT NULL,
  `konfirmasi` varchar(6) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat_header`
--

CREATE TABLE `pengajuan_surat_header` (
  `id` int(11) NOT NULL,
  `isi` varchar(100) NOT NULL,
  `grup_code` varchar(40) NOT NULL,
  `ps_code` varchar(40) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `pengirim` varchar(40) NOT NULL,
  `grup_code` varchar(40) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `umum`
--

CREATE TABLE `umum` (
  `id` int(11) NOT NULL,
  `post` text NOT NULL,
  `share` varchar(40) NOT NULL,
  `um_code` varchar(40) NOT NULL,
  `gum_code` varchar(40) NOT NULL,
  `file_path` text NOT NULL,
  `com_code` varchar(40) NOT NULL,
  `user_code` varchar(40) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `umum`
--

INSERT INTO `umum` (`id`, `post`, `share`, `um_code`, `gum_code`, `file_path`, `com_code`, `user_code`, `upload_date`) VALUES
(1, 'wait', 'all', '59Sat040520201624142um000000', '59052020162404000000', '16052020042459000000', '59Sat040520201624142co000000', '07410420200744281000000pcMzEye2AFIfu4xtg', '2020-05-16 09:24:59'),
(2, '', 'all', '20Sat040520201625142um000000', '20052020162504000000', '16052020042520000000', '20Sat040520201625142co000000', '07410420200744281000000pcMzEye2AFIfu4xtg', '2020-05-16 09:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `used_browser`
--

CREATE TABLE `used_browser` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `version` varchar(30) NOT NULL,
  `security_code` varchar(40) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `used_browser`
--

INSERT INTO `used_browser` (`id`, `email`, `browser`, `version`, `security_code`, `create_date`) VALUES
(150, 'alexanderaugustadevonp@gmail.com', 'Edg/Computer/Windows 10/LAPTOP-0PP6N4HK', '85.0.564.18', 'Ks5ir24JhBSZfcXdHDgq20200814091431', '2020-08-14 09:14:31'),
(151, 'alexanderaugustadevonp@gmail.com', 'Safari/Mobile/Android/android-cef9b55a12733bf2.mshome.net', '537.36', 'BQDIHNRXTC1lp2eYao6c20200806223457', '2020-08-06 22:34:57'),
(152, 'alexanderaugustadevonp@gmail.com', 'Safari/Mobile/Android/android-cef9b55a12733bf2.mshome.net', '537.36', 'Pu2zfZRayO6etkcrUg0D20200806043442', '2020-08-06 04:34:42'),
(153, 'alexanderaugustadevonp@gmail.com', 'Safari/Mobile/Android/android-cef9b55a12733bf2.mshome.net', '537.36', '3OnsNKC0h5tf672rGWmk20200806045549', '2020-08-06 04:55:49'),
(154, 'alexanderaugustadevonp@gmail.com', 'Safari/Mobile/Android/android-cef9b55a12733bf2.mshome.net', '537.36', 'welImcSCxuAO1gH5GtR020200806045731', '2020-08-06 04:57:31'),
(155, 'alexanderaugustadevonp@gmail.com', 'Safari/Mobile/Android/android-cef9b55a12733bf2.mshome.net', '537.36', 'AfHO91pTZXSvG83Bznok20200809044816', '2020-08-09 04:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

CREATE TABLE `users_account` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(110) NOT NULL,
  `password` varchar(225) NOT NULL,
  `no_kk` varchar(55) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `alamat` varchar(110) NOT NULL,
  `rt` varchar(2) NOT NULL,
  `rw` varchar(2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_code` varchar(80) NOT NULL,
  `grup_code` varchar(40) NOT NULL,
  `persetujuan` varchar(6) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jentik_code` varchar(40) DEFAULT NULL,
  `account_picture` text DEFAULT NULL,
  `display_mode` varchar(6) NOT NULL,
  `web_code` varchar(30) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`id`, `nama`, `email`, `password`, `no_kk`, `jenis_kelamin`, `no_tlp`, `alamat`, `rt`, `rw`, `status`, `user_code`, `grup_code`, `persetujuan`, `tempat_lahir`, `tanggal_lahir`, `jentik_code`, `account_picture`, `display_mode`, `web_code`, `create_date`) VALUES
(130, 'alexander augusta devon polontalo', 'alexanderaugustadevonp@gmail.com', '$2y$10$hZX0NpiLe7uaD122pXcazOd4VZJ1uziidhaapFQaqx47CgTwRm5vG', '', 'laki', '098728312231', '', '', '', 'bendahara', '07410420200744281000000pcMzEye2AFIfu4xtgjTRiUuTe', 'Ab0IEC4achVNSgyKpDT5eYv-d202022041111290', 'ya', '', '1930-01-01', 'J00Fri010620202612966000000C', '', 'light', '1vEXGu29xN4ShTnYFHRLCmlKAy6ZjI', '2020-05-02 10:53:23'),
(135, 'Pole', 'poledev@gmail.com', '$2y$10$qy4hv2R/YlTmKX7PWraHBOc6ntYmhnm9ltHbh46i5BaVcGg43XCVu', '', 'laki', '087891923314', '', '', '', 'ketua', '07440420202052286000000pcSlpv28U4fgAoCuG0FajPoMn', 'Ab0IEC4achVNSgyKpDT5eYv-d202022041111290', '', '', '2002-08-30', '', '', 'light', 'a54yz6BYLNHgtpCGwRSVPfnEX8kvFJ', '2020-04-20 12:52:42'),
(136, 'Alexander 2', 'alexanderaugustadevonp2@gmail.com', '$2y$10$Y501qKX42rSV3iqE17h6V..LiXrnvnrMAHhf7YSqPQYb112q3MSNq', '', 'laki', '086491234661', '', '', '', 'warga', '11490520200200417000000pcMyJri8FG92vVdwIoL46jSat', 'Ab0IEC4achVNSgyKpDT5eYv-d202022041111290', '', '', '2002-01-30', '', '', 'light', 'xUMjRBAP15y8XKaZiq4rwvESn7JWYO', '2020-05-02 16:00:49'),
(137, 'Coba', 'coba@gmail.com', '$2y$10$EPYxGKijmAM6fxKyoBrTye50l4XKC4BDAdS7J7K.pfArCK0IiZs.e', '', 'laki', '087894566697', '', '', '', 'ketua', '01240720201500000000000pc60eoSH27QBPi8VO45IXMWde', 'GIlPmWMf3b5L0sQhB-qxSAX2Y202015070401160', 'ya', '', '1930-01-01', '', '', 'light', 'UwsJ9XNrgzcOhlvVoCuGQEMDI6YWmB', '2020-07-15 06:00:17'),
(138, 'admin', 'admin@gmail.com', '$2y$10$XpNAt0kansvsaVpO2IWdJerhoTaAyYDFfGZAg8imyviKmwtgvbi.K', '', 'laki', '08782313131', '', '', '', '', '09010820201415343000000pcXgRysqlNckCeY1rKB5aoiFr', '', '', '', '1930-01-01', '', '', 'light', '', '2020-08-14 14:14:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar_umum`
--
ALTER TABLE `gambar_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jentik_header`
--
ALTER TABLE `jentik_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jentik_header_week`
--
ALTER TABLE `jentik_header_week`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jentik_inner`
--
ALTER TABLE `jentik_inner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas_header`
--
ALTER TABLE `kas_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas_inner`
--
ALTER TABLE `kas_inner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporrt`
--
ALTER TABLE `laporrt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_surat_header`
--
ALTER TABLE `pengajuan_surat_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `umum`
--
ALTER TABLE `umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `used_browser`
--
ALTER TABLE `used_browser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_account`
--
ALTER TABLE `users_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gambar_umum`
--
ALTER TABLE `gambar_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jentik_header`
--
ALTER TABLE `jentik_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jentik_header_week`
--
ALTER TABLE `jentik_header_week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jentik_inner`
--
ALTER TABLE `jentik_inner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kas_header`
--
ALTER TABLE `kas_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `kas_inner`
--
ALTER TABLE `kas_inner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporrt`
--
ALTER TABLE `laporrt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_surat_header`
--
ALTER TABLE `pengajuan_surat_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `umum`
--
ALTER TABLE `umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `used_browser`
--
ALTER TABLE `used_browser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `users_account`
--
ALTER TABLE `users_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
