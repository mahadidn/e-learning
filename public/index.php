<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Klp1\ELearning\App\Router;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Controller\AdminController;
use Klp1\ELearning\Controller\DosenController;
use Klp1\ELearning\Controller\HomeController;
use Klp1\ELearning\Controller\MahasiswaController;
use Klp1\ELearning\Middleware\MustLoginAdminMiddleware;
use Klp1\ELearning\Middleware\MustLoginDosenMiddleware;
use Klp1\ELearning\Middleware\MustLoginMahasiswaMiddleware;

Database::getConnection("prod");

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);
Router::add('POST', '/', HomeController::class, 'postLogin', []);

// Mahasiswa Controller
Router::add('GET', '/register/mahasiswa', MahasiswaController::class, 'registerMahasiswa', []);
Router::add('POST', '/register/mahasiswa', MahasiswaController::class, 'postRegisterMahasiswa', []);
Router::add('GET', '/dashboard/mahasiswa', MahasiswaController::class, 'dashboard', [MustLoginMahasiswaMiddleware::class]); 
Router::add('POST', '/mahasiswa/logout', MahasiswaController::class, 'logout', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/data/mahasiswa', MahasiswaController::class, 'dataPribadi', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/data/editmahasiswa', MahasiswaController::class, 'editProfil', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa', MahasiswaController::class, 'kelasMahasiswa', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail', MahasiswaController::class, 'detailKelasMahasiswa', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail/nilaiakhir', MahasiswaController::class, 'nilaiAkhir', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail/penilaian', MahasiswaController::class, 'penilaian', [MustLoginMahasiswaMiddleware::class]);

// Dosen Controller
Router::add('GET', '/register/dosen', DosenController::class, 'registerDosen', []);
Router::add('POST', '/register/dosen', DosenController::class, 'postRegisterDosen', []);
Router::add('GET', '/dashboard/dosen', DosenController::class, 'dashboard', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/dosen/logout', DosenController::class, 'logout', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/data/dosen', DosenController::class, 'dataPribadi', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/data/editdosen', DosenController::class, 'editProfil', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen', DosenController::class, 'kelasDosen', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail', DosenController::class, 'kelasDosenDetail', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/kelompok', DosenController::class, 'kelasDosenKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/kelompokdetail', DosenController::class, 'tambahDosenKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/nilaimk', DosenController::class, 'nilaimk', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/tambahnilaimk', DosenController::class, 'tambahNilaimk', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/nilaikelompok', DosenController::class, 'nilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/nilaikelompok/tambah', DosenController::class, 'tambahNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/nilaikelompok/kriteria', DosenController::class, 'kriteriaNilai', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/nilaiakhir', DosenController::class, 'nilaiAkhir', [MustLoginDosenMiddleware::class]);

// Admin Controller
Router::add('GET', '/register/admin', AdminController::class, 'registerAdmin', []);
Router::add('POST', '/register/admin', AdminController::class, 'postRegisterAdmin', []);
Router::add('GET', '/dashboard/admin', AdminController::class, 'dashboard', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/admin/logout', AdminController::class, 'logout', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/data/admin', AdminController::class, 'dataPribadi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/data/editadmin', AdminController::class, 'editProfil', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik', AdminController::class, 'tahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik/tambah', AdminController::class, 'tambahTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi', AdminController::class, 'dataProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi/tambah', AdminController::class, 'tambahDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah', AdminController::class, 'matakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/tambah', AdminController::class, 'tambahMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin', AdminController::class, 'kelasAdmin', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin/tambah', AdminController::class, 'tambahKelasAdmin', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/arsip', AdminController::class, 'arsipMataKuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/arsip/edit', AdminController::class, 'editArsipMataKuliah', [MustLoginAdminMiddleware::class]);

Router::run();
