-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2023 at 04:39 AM
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
-- Database: `elearning`
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
(1, 'admin1', '$2y$10$sjyEF08v11kPs5s1bEUFQ.VnJoz268k9lxKz4jY5tABZUfjRacQN.', 'admin1@gmail.com');

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
  `nilai_mk` int(11) NOT NULL,
  `nama_mahasiswa` varchar(400) DEFAULT NULL
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
(2, '123123', 'dosen21', '$2y$10$i6ZQhKi4vFrRamysJB4xdOVxwyIVlF2QPUnTabcdnfEASJvb6kvca', 'dosen21', 'perempuan', 'dosen21@gmail.com', 'Teknik Informatika', NULL, NULL),
(3, '12312312', 'dosen1', '$2y$10$TC1IAETd3Jrw/TMJfUq02.o.LTKJdidyJNj8Rt7WtNLI5Vj1Zx28u', 'dosen1', 'laki-laki', 'dosen1@gmail.com', 'Teknik Informatika', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `nama_dosen` varchar(500) NOT NULL,
  `matakuliah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kapasitas`, `nama_dosen`, `matakuliah`) VALUES
(12, 'Ruang 1', 38, 'dosen21', 'Statistika'),
(13, 'Ruang 2', 44, 'dosen1', 'Perancangan dan Implementasi Perangkat Lunak'),
(14, 'Ruang 2', 36, 'dosen1', 'Metode Numerik'),
(15, 'Ruang 2', 38, 'dosen21', 'Pemrograman Web');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `nama_kelompok` varchar(255) NOT NULL,
  `jumlah_anggota` int(11) DEFAULT NULL,
  `id_kelompok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`nama_kelompok`, `jumlah_anggota`, `id_kelompok`) VALUES
('Kelompok 1', 2, 50),
('Kelompok 2', 1, 56);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_mahasiswa`
--

CREATE TABLE `kelompok_mahasiswa` (
  `id_kelompok` int(11) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelompok_mahasiswa`
--

INSERT INTO `kelompok_mahasiswa` (`id_kelompok`, `nama_anggota`, `id`) VALUES
(50, 'Mahadi Dwi Nugraha', 7),
(50, 'Mahasiswa 2', 8),
(56, 'Mahadi Dwi Nugraha', 17);

-- --------------------------------------------------------

--
-- Table structure for table `kinerja_kelompok`
--

CREATE TABLE `kinerja_kelompok` (
  `id_kinerja_kelompok` int(11) NOT NULL,
  `nama_kelompok` varchar(255) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `nilai_kriteria1` int(11) NOT NULL,
  `nilai_kriteria2` int(11) NOT NULL
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
(1, '2101020065', 'mahadi_dn', '$2y$10$TGBiPCRvdKWYeLp5V71VCO2Agx4R2HpK2Lfs3DGpS5FhFYUSXcG3W', 'Mahadi Dwi Nugraha', 'mahadidwinugraha@gmail.com', 'Teknik Informatika', 'laki-laki', NULL, NULL),
(2, '2101020066', 'mahasiswa2', '$2y$10$cTTw1//UuGTrxOYvOvaUue3tFZ4Yi6HEY13H4SUQRtZMu0Yarl6HG', 'Mahasiswa 2', 'mahasiswa2@gmail.com', 'Teknik Informatika', 'perempuan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_kelas`
--

CREATE TABLE `mahasiswa_kelas` (
  `id_mahasiswa_kelas` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa_kelas`
--

INSERT INTO `mahasiswa_kelas` (`id_mahasiswa_kelas`, `id_kelas`, `id_mahasiswa`) VALUES
(3, 12, 1),
(4, 12, 2),
(5, 13, 2),
(6, 14, 2),
(8, 13, 1),
(9, 14, 1),
(10, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `nama_mk` varchar(100) NOT NULL,
  `id_mk` int(11) NOT NULL,
  `jadwal_mk` varchar(100) DEFAULT NULL,
  `sks` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`nama_mk`, `id_mk`, `jadwal_mk`, `sks`, `id_dosen`) VALUES
('Sistem Terdistribusi', 8, '2023-12-13', 3, NULL),
('Metode Numerik', 9, '2023-12-10', 3, NULL),
('Statistika', 10, '2023-12-13', 3, NULL),
('Perancangan dan Implementasi Perangkat Lunak', 11, '2023-12-14', 3, NULL),
('Pemrograman Web', 12, '2023-12-15', 4, NULL),
('Masyarakat Cerdas', 13, '2023-12-12', 3, NULL);

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

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `jumlah_mhs`) VALUES
(27, 'Teknik Elektro', 205),
(31, 'Teknik Perkapalan', 184),
(32, 'Teknik Informatika', 117);

-- --------------------------------------------------------

--
-- Table structure for table `session_admin`
--

CREATE TABLE `session_admin` (
  `username_session` varchar(50) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_admin`
--

INSERT INTO `session_admin` (`username_session`, `user_id`, `id`) VALUES
('admin15', '656f47b2b99b2', 1),
('admin1', '6570b264d0269', 1),
('admin1', '65773d32588c3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `session_dosen`
--

CREATE TABLE `session_dosen` (
  `username_session` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_dosen`
--

INSERT INTO `session_dosen` (`username_session`, `user_id`, `id`) VALUES
('dosen21', '65773d6bedbf6', 2),
('dosen1', '65773ee9c72e4', 3),
('dosen21', '6577810b2a95d', 2);

-- --------------------------------------------------------

--
-- Table structure for table `session_mahasiswa`
--

CREATE TABLE `session_mahasiswa` (
  `id` int(11) NOT NULL,
  `username_session` varchar(50) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_mahasiswa`
--

INSERT INTO `session_mahasiswa` (`id`, `username_session`, `user_id`) VALUES
(1, 'mahadi_dn', '656f116c81439');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id_semester` int(11) NOT NULL,
  `nama_semester` varchar(100) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`id_semester`, `nama_semester`, `tahun`, `status`) VALUES
(40, 'Ganjil', '2023', 'Aktif'),
(41, 'Genap', '2024', 'Aktif');

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
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `kelompok_mahasiswa`
--
ALTER TABLE `kelompok_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kelompokMahasiswa_kelompok` (`id_kelompok`);

--
-- Indexes for table `kinerja_kelompok`
--
ALTER TABLE `kinerja_kelompok`
  ADD PRIMARY KEY (`id_kinerja_kelompok`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mahasiswa_kelompok` (`id_kelompok`),
  ADD KEY `fk_mahasiswa_matakuliah` (`id_matakuliah`);

--
-- Indexes for table `mahasiswa_kelas`
--
ALTER TABLE `mahasiswa_kelas`
  ADD PRIMARY KEY (`id_mahasiswa_kelas`),
  ADD KEY `fk_mahasiswaKelas_kelas` (`id_kelas`),
  ADD KEY `fk_mahasiswaMhs_Mhs` (`id_mahasiswa`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id_mk`),
  ADD KEY `fk_matakuliah_dosen` (`id_dosen`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `kelompok_mahasiswa`
--
ALTER TABLE `kelompok_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kinerja_kelompok`
--
ALTER TABLE `kinerja_kelompok`
  MODIFY `id_kinerja_kelompok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswa_kelas`
--
ALTER TABLE `mahasiswa_kelas`
  MODIFY `id_mahasiswa_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
-- Constraints for table `kelompok_mahasiswa`
--
ALTER TABLE `kelompok_mahasiswa`
  ADD CONSTRAINT `fk_kelompokMahasiswa_kelompok` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_mahasiswa_kelompok` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`),
  ADD CONSTRAINT `fk_mahasiswa_matakuliah` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_mk`);

--
-- Constraints for table `mahasiswa_kelas`
--
ALTER TABLE `mahasiswa_kelas`
  ADD CONSTRAINT `fk_mahasiswaKelas_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `fk_mahasiswaMhs_Mhs` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `fk_matakuliah_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
