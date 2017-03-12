-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2017 at 09:11 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tryout`
--

-- --------------------------------------------------------

--
-- Table structure for table `matpel`
--

CREATE TABLE `matpel` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `matpel` (`id`, `nama`) VALUES
(1, 'Bahasa Indonesia'),
(2, 'Matematika'),
(3, 'Bahasa Inggris'),
(4, 'IPA');


-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `nama` text NOT NULL,
  `tipe_soal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `id` int(11) NOT NULL,
  `nama_pilihan` varchar(1) NOT NULL,
  `nama_jawaban` varchar(100) NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `tipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_soal`
--

CREATE TABLE `tipe_soal` (
  `id` int(11) NOT NULL,
  `judul` varchar(20) NOT NULL,
  `matpel_id` int(11) NOT NULL,
  `jenjang` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Stand-in structure for view `view_jawaban_benar`
-- (See below for the actual view)
--
CREATE TABLE `view_jawaban_benar` (
`id` int(11)
,`judul` varchar(20)
,`matpel_id` int(11)
,`jenjang` varchar(3)
,`nama_jawaban` varchar(20)
,`no` int(11)
,`nama_pertanyaan` text
,`pilihan_jawaban` varchar(1)
,`jawaban` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pertanyaan`
-- (See below for the actual view)
--
CREATE TABLE `view_pertanyaan` (
`id` int(11)
,`judul` varchar(20)
,`matpel_id` int(11)
,`jenjang` varchar(3)
,`nama_matpel` varchar(20)
,`no` int(11)
,`nama_pertanyaan` text
,`pilihan_jawaban` varchar(1)
,`jawaban` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `view_jawaban_benar`
--
DROP TABLE IF EXISTS `view_jawaban_benar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jawaban_benar`  AS  select `tipe_soal`.`id` AS `id`,`tipe_soal`.`judul` AS `judul`,`tipe_soal`.`matpel_id` AS `matpel_id`,`tipe_soal`.`jenjang` AS `jenjang`,`matpel`.`nama` AS `nama_jawaban`,`pertanyaan`.`no` AS `no`,`pertanyaan`.`nama` AS `nama_pertanyaan`,`pilihan`.`nama_pilihan` AS `pilihan_jawaban`,`pilihan`.`nama_jawaban` AS `jawaban` from (((`tipe_soal` join `matpel` on((`tipe_soal`.`matpel_id` = `matpel`.`id`))) join `pertanyaan` on((`pertanyaan`.`tipe_soal_id` = `tipe_soal`.`id`))) join `pilihan` on(((`pilihan`.`pertanyaan_id` = `pertanyaan`.`id`) and (`pilihan`.`tipe` = 1)))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_pertanyaan`
--
DROP TABLE IF EXISTS `view_pertanyaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pertanyaan`  AS  select `tipe_soal`.`id` AS `id`,`tipe_soal`.`judul` AS `judul`,`tipe_soal`.`matpel_id` AS `matpel_id`,`tipe_soal`.`jenjang` AS `jenjang`,`matpel`.`nama` AS `nama_matpel`,`pertanyaan`.`no` AS `no`,`pertanyaan`.`nama` AS `nama_pertanyaan`,`pilihan`.`nama_pilihan` AS `pilihan_jawaban`,`pilihan`.`nama_jawaban` AS `jawaban` from (((`tipe_soal` join `matpel` on((`tipe_soal`.`matpel_id` = `matpel`.`id`))) join `pertanyaan` on((`pertanyaan`.`tipe_soal_id` = `tipe_soal`.`id`))) join `pilihan` on((`pilihan`.`pertanyaan_id` = `pertanyaan`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matpel`
--
ALTER TABLE `matpel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipe_soal_fk` (`tipe_soal_id`);

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pertanyaan_fk` (`pertanyaan_id`);

--
-- Indexes for table `tipe_soal`
--
ALTER TABLE `tipe_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matpel_fk` (`matpel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matpel`
--
ALTER TABLE `matpel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tipe_soal`
--
ALTER TABLE `tipe_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `tipe_soal_fk` FOREIGN KEY (`tipe_soal_id`) REFERENCES `tipe_soal` (`id`);

--
-- Constraints for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD CONSTRAINT `pertanyaan_fk` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`);

--
-- Constraints for table `tipe_soal`
--
ALTER TABLE `tipe_soal`
  ADD CONSTRAINT `matpel_fk` FOREIGN KEY (`matpel_id`) REFERENCES `matpel` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
