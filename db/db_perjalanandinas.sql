-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 12, 2024 at 02:38 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perjalanandinas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota_dewan`
--

CREATE TABLE `tb_anggota_dewan` (
  `id` int NOT NULL,
  `asal` varchar(50) NOT NULL,
  `id_anggota_dewan` varchar(50) NOT NULL,
  `jenis_kelamin_id` varchar(30) NOT NULL,
  `nama_anggota_dewan` varchar(50) NOT NULL,
  `nama_jabatan_id` int NOT NULL,
  `nip` varchar(50) NOT NULL,
  `no_anggota_dewan` varchar(50) NOT NULL,
  `ttl` date NOT NULL,
  `umur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_anggota_dewan`
--

INSERT INTO `tb_anggota_dewan` (`id`, `asal`, `id_anggota_dewan`, `jenis_kelamin_id`, `nama_anggota_dewan`, `nama_jabatan_id`, `nip`, `no_anggota_dewan`, `ttl`, `umur`) VALUES
(1, 'Banjarmasin', '21312322', 'Pria', 'Akhmad Ersa Nugraha', 1, '231312', '213131', '2024-01-27', '21'),
(2, 'Amuntai', '3312', 'Pria', 'Andi', 2, '231313', '0823612312', '2024-01-09', '55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fakta_integritas`
--

CREATE TABLE `tb_fakta_integritas` (
  `id` int NOT NULL,
  `alamat` char(100) NOT NULL,
  `hari` date NOT NULL,
  `nomor_telepon` char(50) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tanggal_pulang` date NOT NULL,
  `tempat_tujuan` char(50) NOT NULL,
  `fileupload` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_fakta_integritas`
--

INSERT INTO `tb_fakta_integritas` (`id`, `alamat`, `hari`, `nomor_telepon`, `tanggal_berangkat`, `tanggal_pulang`, `tempat_tujuan`, `fileupload`) VALUES
(15, '12sadas', '2024-02-24', '1231231', '2024-02-24', '2024-02-23', 'Banjarbaru', '65c83a370128d_UTS Aqidah Akhlak_Muhammad Rozan Fadhilla_2010010572_7G.pdf'),
(16, 'Jl. Kayu Balau No.34', '2024-03-01', '12312', '2024-02-16', '2024-02-16', 'Kota Baru', '65c98488706ab_UTS Aqidah Akhlak_Muhammad Rozan Fadhilla_2010010572_7G.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id` int NOT NULL,
  `nama_jabatan` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggung_jawab` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id`, `nama_jabatan`, `tanggung_jawab`, `deskripsi`) VALUES
(1, 'Sekretariat DPRD', '--', '-'),
(2, 'Kepala Bagian Keuangan', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kwitansi`
--

CREATE TABLE `tb_kwitansi` (
  `id` int NOT NULL,
  `jumlah_kwitansi` char(50) NOT NULL,
  `kode_kwitansi` char(50) NOT NULL,
  `nomor_kwitansi` char(50) NOT NULL,
  `tanggal_kwitansi` char(50) NOT NULL,
  `total_kwitansi` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kwitansi`
--

INSERT INTO `tb_kwitansi` (`id`, `jumlah_kwitansi`, `kode_kwitansi`, `nomor_kwitansi`, `tanggal_kwitansi`, `total_kwitansi`) VALUES
(3, '33', '2312321312', '123213712831', '2024-01-25', '3.000.000'),
(4, '2', '2', '2', '2024-01-23', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sppd`
--

CREATE TABLE `tb_sppd` (
  `id` int NOT NULL,
  `nama_anggota_dewan_id` int NOT NULL,
  `jangka_waktu` varchar(50) NOT NULL,
  `jenis_transportasi` varchar(50) NOT NULL,
  `judul_kegiatan` varchar(50) NOT NULL,
  `jumlah_anggaran` varchar(50) NOT NULL,
  `nomor_lampiran` varchar(50) NOT NULL,
  `nomor_rekening` varchar(50) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tanggal_pulang` date NOT NULL,
  `tempat_berangkat` varchar(50) NOT NULL,
  `tempat_tujuan` varchar(50) NOT NULL,
  `total_relisasi_anggaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_sppd`
--

INSERT INTO `tb_sppd` (`id`, `nama_anggota_dewan_id`, `jangka_waktu`, `jenis_transportasi`, `judul_kegiatan`, `jumlah_anggaran`, `nomor_lampiran`, `nomor_rekening`, `tanggal_berangkat`, `tanggal_pulang`, `tempat_berangkat`, `tempat_tujuan`, `total_relisasi_anggaran`) VALUES
(1, 1, '5 Hari', 'Mobil Pribadi', 'sdas', '123', 'adasdas312', '1234', '2024-02-21', '2024-02-23', 'sadadad', 'Banjarbaru', '1234'),
(2, 2, '3 Hari', 'Mobil Dinas', 'sdass', '123', '21312', '1231', '2024-02-29', '2024-02-23', 'sdasdasdsa', 'Banjarbaru', '123');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Akhmad Ersa Nugraha', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'ersaa23', 'ersaa', 'bc5b57a07b21a136f56eced9cc255f65', 'user'),
(3, 'ersaaa', 'ersa1', '1ec0fbb75952d4b0a9b0c6b6d119704a', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggota_dewan`
--
ALTER TABLE `tb_anggota_dewan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_fakta_integritas`
--
ALTER TABLE `tb_fakta_integritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kwitansi`
--
ALTER TABLE `tb_kwitansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sppd`
--
ALTER TABLE `tb_sppd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_anggota_dewan`
--
ALTER TABLE `tb_anggota_dewan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_fakta_integritas`
--
ALTER TABLE `tb_fakta_integritas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kwitansi`
--
ALTER TABLE `tb_kwitansi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_sppd`
--
ALTER TABLE `tb_sppd`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
