-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 29, 2023 at 02:34 PM
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
(7, 'admin', '$2y$10$uJ1qEIazjYEc4vCkHn2ENOjVar60RzuuSWzzTkR.gJi6EGb.AbKl.', 'admin11@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `arsip_nilai`
--

CREATE TABLE `arsip_nilai` (
  `id_arsip` int(11) NOT NULL,
  `id_mk` varchar(20) DEFAULT NULL,
  `nama_mk` varchar(100) DEFAULT NULL,
  `nilai_mk` int(11) DEFAULT NULL,
  `nama_mahasiswa` varchar(400) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsip_nilai`
--

INSERT INTO `arsip_nilai` (`id_arsip`, `id_mk`, `nama_mk`, `nilai_mk`, `nama_mahasiswa`, `id_kelas`) VALUES
(26, NULL, 'Perancangan dan Implementasi Perangkat Lunak', 91, 'mahasiswa2', 38),
(27, NULL, 'Perancangan dan Implementasi Perangkat Lunak', 90, 'mahasiswa1', 38),
(28, NULL, 'Sistem Terdistribusi', 86, 'mahasiswa1', 39),
(29, NULL, 'Sistem Terdistribusi', 92, 'mahasiswa2', 39),
(30, NULL, 'Perancangan dan Implementasi Perangkat Lunak', 95, 'mahasiswa3', 38),
(31, NULL, 'Perancangan dan Implementasi Perangkat Lunak', 96, 'mahasiswa4', 38),
(32, NULL, 'Metode Numerik', 96, 'mahasiswa1', 44),
(33, NULL, 'Metode Numerik', 77, 'mahasiswa3', 44),
(34, NULL, 'Metode Numerik', 95, 'mahasiswa2', 44),
(35, NULL, 'Pemrograman Web', 99, 'mahasiswa1', 45),
(36, NULL, 'Pemrograman Web', 94, 'mahasiswa4', 45);

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
  `prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `username`, `password`, `nama`, `jenis_kelamin`, `email`, `prodi`) VALUES
(8, '123123', 'dosen2', '$2y$10$X1Vw/D9BqVtNHol9TaIGquLuVY4VFmG.y5QM2/QonVSgumVA90DSS', 'dosen2', 'perempuan', 'dosen2@gmail.com', 'Teknik Informatika'),
(9, '1231231000', 'dosen1', '$2y$10$27h0I01ApAo859rJ22l.uubXH09L/51CY6CFIlLw7B62bY9W2tMo.', 'dosen1', 'laki-laki', 'dosen111@gmail.com', 'Teknik Informatika'),
(10, '11111', 'dosen3', '$2y$10$dr.msLNGo8YAaWt7uMZVDuhkZ03eMJbbSBpucDVosH24BnVqhZPYy', 'dosen3', 'laki-laki', 'dosen3@gmail.com', 'Teknik Informatika');

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
(38, 'Perancangan dan Implementasi Perangkat Lunak', 44, 'dosen1', 'Perancangan dan Implementasi Perangkat Lunak'),
(39, 'Sistem Terdistribusi', 49, 'dosen2', 'Sistem Terdistribusi'),
(44, 'Metode Numerik', 31, 'dosen3', 'Metode Numerik'),
(45, 'Pemrograman Web', 44, 'dosen1', 'Pemrograman Web');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `nama_kelompok` varchar(255) NOT NULL,
  `jumlah_anggota` int(11) DEFAULT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`nama_kelompok`, `jumlah_anggota`, `id_kelompok`, `id_kelas`) VALUES
('Kelompok 1', 1, 126, 38),
('Kelompok 1', 1, 127, 38),
('Kelompok 1', 2, 128, 39),
('Kelompok 2', 2, 130, 38),
('Kelompok 1', 2, 132, 44),
('Kelompok 1', 1, 133, 44),
('Kelompok 1', 2, 134, 45);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_mahasiswa`
--

CREATE TABLE `kelompok_mahasiswa` (
  `id_kelompok` int(11) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelompok_mahasiswa`
--

INSERT INTO `kelompok_mahasiswa` (`id_kelompok`, `nama_anggota`, `id`, `id_kelas`) VALUES
(126, 'mahasiswa1', 100, 38),
(126, 'mahasiswa2', 102, 38),
(128, 'mahasiswa1', 103, 39),
(128, 'mahasiswa2', 104, 39),
(130, 'mahasiswa3', 106, 38),
(130, 'mahasiswa4', 107, 38),
(132, 'mahasiswa1', 109, 44),
(132, 'mahasiswa3', 110, 44),
(132, 'mahasiswa2', 111, 44),
(134, 'mahasiswa1', 112, 45),
(134, 'mahasiswa4', 113, 45);

-- --------------------------------------------------------

--
-- Table structure for table `kinerja_kelompok`
--

CREATE TABLE `kinerja_kelompok` (
  `id_kinerja_kelompok` int(11) NOT NULL,
  `nilai_kriteria1` int(11) DEFAULT NULL,
  `nilai_kriteria2` int(11) DEFAULT NULL,
  `nilai_dosen` int(11) DEFAULT NULL,
  `id_kelompok` int(11) DEFAULT NULL,
  `nama_mahasiswa` varchar(255) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kinerja_kelompok`
--

INSERT INTO `kinerja_kelompok` (`id_kinerja_kelompok`, `nilai_kriteria1`, `nilai_kriteria2`, `nilai_dosen`, `id_kelompok`, `nama_mahasiswa`, `id_kelas`) VALUES
(65, 88, 23, 88, 126, 'mahasiswa1', 38),
(67, 99, 92, 88, 126, 'mahasiswa2', 38),
(68, 78, 88, 88, 128, 'mahasiswa1', 39),
(69, 87, 90, 88, 128, 'mahasiswa2', 39),
(71, 85, 92, 99, 130, 'mahasiswa3', 38),
(72, 92, 99, 99, 130, 'mahasiswa4', 38),
(74, 92, 99, 90, 132, 'mahasiswa1', 44),
(75, 48, 51, 90, 132, 'mahasiswa3', 44),
(76, 88, 89, 90, 132, 'mahasiswa2', 44),
(77, 92, 99, 100, 134, 'mahasiswa1', 45),
(78, 82, 99, 100, 134, 'mahasiswa4', 45);

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
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `username`, `password`, `nama`, `email`, `prodi`, `jenis_kelamin`) VALUES
(7, '21010200655', 'mahasiswa1', '$2y$10$DqtGIF8SJwzpb2VVv.DAou2w6zFjjZi3R/9kHGoVF2kxHp7VsmvT2', 'mahasiswa1', 'mahasiswa11@gmail.com', 'Teknik Informatika', 'laki-laki'),
(8, '21012312', 'mahasiswa2', '$2y$10$r2/NpRI54dqXjDOqI.28DekJI1MI4ksaAfEfaG7yUms7upte5BmoO', 'mahasiswa2', 'mahasiswa222@gmail.com', 'Teknik Informatika', 'perempuan'),
(10, '2191919', 'mahasiswa3', '$2y$10$lqkFNbGgYJ49/9cz98YD.OIjTizT7t9Lw9i7M5t3zrCf7L/4zVnq.', 'mahasiswa3', 'mahasiswa3@gmail.com', 'Teknik Informatika', 'laki-laki'),
(11, '123123', 'mahasiswa4', '$2y$10$x4GHiBgTKlqPuOT4oXDkP.HyrcXFA1aIXEZUr8H4H6bggP5aH.mEm', 'mahasiswa4', 'mahasiswa4@gmail.com', 'Teknik Informatika', 'laki-laki');

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
(63, 38, 8),
(64, 38, 7),
(65, 39, 7),
(66, 39, 8),
(67, 38, 10),
(68, 38, 11),
(69, 44, 7),
(70, 44, 10),
(71, 44, 8),
(72, 45, 7),
(73, 45, 11);

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
('Perancangan dan Implementasi Perangkat Lunak', 32, '2023-12-29', 3, NULL),
('Sistem Terdistribusi', 33, '2023-12-30', 4, NULL),
('Metode Numerik', 38, '2023-12-30', 3, NULL),
('Pemrograman Web', 40, '2023-12-30', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `nama_mhs` varchar(255) NOT NULL,
  `nama_mk` varchar(100) DEFAULT NULL,
  `id_nilai` int(11) NOT NULL,
  `id_mk` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `nilai_tugas` int(11) DEFAULT NULL,
  `nilai_uts` int(11) DEFAULT NULL,
  `nilai_uas` int(11) DEFAULT NULL,
  `nilai_kelompok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`nama_mhs`, `nama_mk`, `id_nilai`, `id_mk`, `id_kelas`, `nilai_tugas`, `nilai_uts`, `nilai_uas`, `nilai_kelompok`) VALUES
('mahasiswa2', 'Perancangan dan Implementasi Perangkat Lunak', 44, NULL, 38, 90, 100, 95, 89),
('mahasiswa1', 'Perancangan dan Implementasi Perangkat Lunak', 45, NULL, 38, 99, 98, 97, 50),
('mahasiswa1', 'Sistem Terdistribusi', 46, NULL, 39, 92, 88, 90, 84),
('mahasiswa2', 'Sistem Terdistribusi', 47, NULL, 39, 48, 67, 72, 88),
('mahasiswa3', 'Perancangan dan Implementasi Perangkat Lunak', 48, NULL, 38, 82, 99, 90, 92),
('mahasiswa4', 'Perancangan dan Implementasi Perangkat Lunak', 49, NULL, 38, 99, 98, 89, 96),
('mahasiswa1', 'Metode Numerik', 50, NULL, 44, 92, 99, 100, 93),
('mahasiswa3', 'Metode Numerik', 51, NULL, 44, 84, 87, 72, 63),
('mahasiswa2', 'Metode Numerik', 52, NULL, 44, 99, 90, 100, 89),
('mahasiswa1', 'Pemrograman Web', 53, NULL, 45, 99, 100, 100, 97),
('mahasiswa4', 'Pemrograman Web', 54, NULL, 45, 92, 100, 92, 93);

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
(41, 'Teknik Informatika', 127),
(44, 'Teknik Elektro', 222);

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

--
-- Dumping data for table `session_dosen`
--

INSERT INTO `session_dosen` (`username_session`, `user_id`, `id`) VALUES
('dosen2', '658c55b251733', 8);

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
(8, 'mahasiswa2', '658c5d87b9298'),
(7, 'mahasiswa1', '658d125737ddd');

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
(51, 'Genap', '2023', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arsip_nilai`
--
ALTER TABLE `arsip_nilai`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id_kinerja_kelompok`),
  ADD KEY `fk_kinerjaKelompok_kelompok` (`id_kelompok`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `arsip_nilai`
--
ALTER TABLE `arsip_nilai`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `kelompok_mahasiswa`
--
ALTER TABLE `kelompok_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `kinerja_kelompok`
--
ALTER TABLE `kinerja_kelompok`
  MODIFY `id_kinerja_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mahasiswa_kelas`
--
ALTER TABLE `mahasiswa_kelas`
  MODIFY `id_mahasiswa_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelompok_mahasiswa`
--
ALTER TABLE `kelompok_mahasiswa`
  ADD CONSTRAINT `fk_kelompokMahasiswa_kelompok` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`);

--
-- Constraints for table `kinerja_kelompok`
--
ALTER TABLE `kinerja_kelompok`
  ADD CONSTRAINT `fk_kinerjaKelompok_kelompok` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE;

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
