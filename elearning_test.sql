-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2023 at 01:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'mahadi123', '$2y$10$KiJmhBKyqjitizyMUkYxEedcRhhLoN81HrnOSSlABqOyB.TUnYxKO', 'Asdfgh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_kelompok`
--

CREATE TABLE `anggota_kelompok` (
  `id_anggota` int(11) NOT NULL,
  `id_kelompok` int(11) DEFAULT NULL,
  `nama_anggota` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `arsip_nilai`
--

CREATE TABLE `arsip_nilai` (
  `id_arsip` int(11) NOT NULL,
  `id_semester` varchar(20) NOT NULL,
  `id_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `nilai_mk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_matakuliah`
--

CREATE TABLE `daftar_matakuliah` (
  `id_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `email` varchar(255) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `id_nilai_kelompok` int(11) DEFAULT NULL,
  `id_matakuliah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `username`, `password`, `nama`, `jenis_kelamin`, `email`, `prodi`, `id_nilai_kelompok`, `id_matakuliah`) VALUES
(1, '12312343', 'dosen2', '$2y$10$cHc28yiLp1QlsR.88M1kLeUDk7aMhMAaZcvL69tBUS63B3knm0vY.', 'dosen2', 'perempuan', 'dosen2@gmail.com', 'Teknik Informatika', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `id_mk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `nama_kelompok` varchar(255) NOT NULL,
  `jumlah_anggota` int(11) DEFAULT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_nilai_kelompok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_kelompok` int(11) DEFAULT NULL,
  `id_matakuliah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `username`, `password`, `nama`, `email`, `prodi`, `jenis_kelamin`, `id_kelompok`, `id_matakuliah`) VALUES
(4, '2101020065', 'mahadidn', '$2y$10$qEAorl03KcXtEt1Vz0XdTeRR4Eg/Ng5xxyoRrRNTX0rXemJR7.TJ6', 'Mahadi Dwi Nugraha', 'mahadi@gmail.com', 'Teknik Informatika', 'laki-laki', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `nama_mk` varchar(100) NOT NULL,
  `id_mk` int(11) NOT NULL,
  `jadwal_mk` varchar(100) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `nama_mhs` varchar(255) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `nilai_mk` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  `id_mk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kelompok`
--

CREATE TABLE `nilai_kelompok` (
  `nilai_kelompok` int(11) NOT NULL,
  `nama_kelompok` varchar(255) NOT NULL,
  `id_nilai_kelompok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_matakuliah`
--

CREATE TABLE `nilai_matakuliah` (
  `nama_mahasiswa` varchar(255) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `nilai_mk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `jumlah_mhs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session_admin`
--

CREATE TABLE `session_admin` (
  `username_session` varchar(50) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session_dosen`
--

CREATE TABLE `session_dosen` (
  `username_session` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session_mahasiswa`
--

CREATE TABLE `session_mahasiswa` (
  `id` int(11) NOT NULL,
  `username_session` varchar(50) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id_semester` int(11) NOT NULL,
  `nama_semester` varchar(100) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_kelompok` (`id_kelompok`);

--
-- Indexes for table `arsip_nilai`
--
ALTER TABLE `arsip_nilai`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indexes for table `daftar_matakuliah`
--
ALTER TABLE `daftar_matakuliah`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dosen_nilaikelompok` (`id_nilai_kelompok`),
  ADD KEY `fk_dosen_matakuliah` (`id_matakuliah`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `fk_kelas_matakuliah` (`id_mk`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id_kelompok`),
  ADD KEY `fk_kelompok_nilaikelompok` (`id_nilai_kelompok`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mahasiswa_kelompok` (`id_kelompok`),
  ADD KEY `fk_mahasiswa_matakuliah` (`id_matakuliah`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `fk_matakuliah_nilai` (`id_mk`);

--
-- Indexes for table `nilai_kelompok`
--
ALTER TABLE `nilai_kelompok`
  ADD PRIMARY KEY (`id_nilai_kelompok`);

--
-- Indexes for table `nilai_matakuliah`
--
ALTER TABLE `nilai_matakuliah`
  ADD PRIMARY KEY (`nama_mk`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `session_admin`
--
ALTER TABLE `session_admin`
  ADD KEY `username_index` (`username_session`),
  ADD KEY `fk_sessionadmin_admin` (`id`);

--
-- Indexes for table `session_dosen`
--
ALTER TABLE `session_dosen`
  ADD KEY `username_index` (`username_session`),
  ADD KEY `fk_sessiondosen_dosen` (`id`);

--
-- Indexes for table `session_mahasiswa`
--
ALTER TABLE `session_mahasiswa`
  ADD KEY `username_index` (`username_session`),
  ADD KEY `fk_sessionmahasiswa_mahasiswa` (`id`);

--
-- Indexes for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`id_semester`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `arsip_nilai`
--
ALTER TABLE `arsip_nilai`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai_kelompok`
--
ALTER TABLE `nilai_kelompok`
  MODIFY `id_nilai_kelompok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  ADD CONSTRAINT `anggota_kelompok_ibfk_1` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`);

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_dosen_matakuliah` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_mk`),
  ADD CONSTRAINT `fk_dosen_nilaikelompok` FOREIGN KEY (`id_nilai_kelompok`) REFERENCES `nilai_kelompok` (`id_nilai_kelompok`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `fk_kelas_matakuliah` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`);

--
-- Constraints for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD CONSTRAINT `fk_kelompok_nilaikelompok` FOREIGN KEY (`id_nilai_kelompok`) REFERENCES `nilai_kelompok` (`id_nilai_kelompok`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_mahasiswa_kelompok` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`),
  ADD CONSTRAINT `fk_mahasiswa_matakuliah` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_mk`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_matakuliah_nilai` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`);

--
-- Constraints for table `session_admin`
--
ALTER TABLE `session_admin`
  ADD CONSTRAINT `fk_sessionadmin_admin` FOREIGN KEY (`id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_dosen`
--
ALTER TABLE `session_dosen`
  ADD CONSTRAINT `fk_sessiondosen_dosen` FOREIGN KEY (`id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_mahasiswa`
--
ALTER TABLE `session_mahasiswa`
  ADD CONSTRAINT `fk_sessionmahasiswa_mahasiswa` FOREIGN KEY (`id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
