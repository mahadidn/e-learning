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
Router::add('GET', '/', HomeController::class, 'menuLogin', []);
Router::add('POST', '/', HomeController::class, 'postLogin', []);

// Mahasiswa Controller
Router::add('GET', '/register/mahasiswa', MahasiswaController::class, 'menuRegistrasiMahasiswa', []);
Router::add('POST', '/register/mahasiswa', MahasiswaController::class, 'postRegisterMahasiswa', []);
Router::add('GET', '/dashboard/mahasiswa', MahasiswaController::class, 'beranda', [MustLoginMahasiswaMiddleware::class]); 
Router::add('POST', '/mahasiswa/logout', MahasiswaController::class, 'menuLogout', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/data/mahasiswa', MahasiswaController::class, 'menuDataPribadi', [MustLoginMahasiswaMiddleware::class]);
Router::add('POST', '/data/mahasiswa', MahasiswaController::class, 'postMenuDataPribadi', [MustLoginMahasiswaMiddleware::class]);
Router::add('POST', '/data/mahasiswa', MahasiswaController::class, 'postKelolaDataPribadi', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/data/editmahasiswa', MahasiswaController::class, 'editProfil', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa', MahasiswaController::class, 'menuKelasMatakuliah', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/([0-9]*)', MahasiswaController::class, 'detailKelasMahasiswa', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/gabung/([0-9]*)', MahasiswaController::class, 'gabungKelas', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail/nilaiakhir/([0-9]*)', MahasiswaController::class, 'menuNilaiAkhirMatakuliah', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail/formpenilaian/([0-9]*)/tambah/([0-9]*)', MahasiswaController::class, 'menuPilihAnggota', [MustLoginMahasiswaMiddleware::class]);
Router::add('POST', '/kelas/mahasiswa/detail/formpenilaian/([0-9]*)/tambah/([0-9]*)', MahasiswaController::class, 'postFormPenilaian', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail/datapenilaian/([0-9]*)', MahasiswaController::class, 'menuPenilaian', [MustLoginMahasiswaMiddleware::class]);


// Dosen Controller
Router::add('GET', '/register/dosen', DosenController::class, 'menuRegistrasiDosen', []);
Router::add('POST', '/register/dosen', DosenController::class, 'postRegisterDosen', []);
Router::add('GET', '/dashboard/dosen', DosenController::class, 'beranda', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/dosen/logout', DosenController::class, 'menuLogout', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/data/dosen', DosenController::class, 'menuDataPribadi', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/data/dosen', DosenController::class, 'postMenuDataPribadi', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/data/editdosen', DosenController::class, 'editProfil', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen', DosenController::class, 'menuMatakuliah', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)', DosenController::class, 'dataKelas', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/kelompok', DosenController::class, 'menuDataKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/kelompokdetail', DosenController::class, 'menuTambahDataKelompok', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/kelompokdetail', DosenController::class, 'postTambahDosenKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/kelompokdetail/hapus/([0-9]*)/idkelompok/([0-9]*)/id_mhs/([0-9]*)', DosenController::class, 'menuHapusDataKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk', DosenController::class, 'menuNilaiMatakuliah', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok', DosenController::class, 'nilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/edit/([0-9]*)/([0-9]*)/([0-9]*)', DosenController::class, 'menuEditDataNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/tambah/([0-9]*)/([0-9]*)/([0-9]*)', DosenController::class, 'menuTambahDataNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/edit/([0-9]*)/([0-9]*)/([0-9]*)', DosenController::class, 'postEditNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/tambah/([0-9]*)/([0-9]*)/([0-9]*)', DosenController::class, 'postTambahNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/tambah', DosenController::class, 'tambahNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/hapus/([0-9]*)', DosenController::class, 'menuHapusDataNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/tambah', DosenController::class, 'menuTambahDataNilaiMatakuliah', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/tambah', DosenController::class, 'postTambahmk', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/edit', DosenController::class, 'menuEditDataNilaiMatakuliah', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/edit', DosenController::class, 'postEditmk', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/hapus', DosenController::class, 'menuHapusDataNilaiMatakuliah', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/edit', DosenController::class, 'editmk', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaiakhir', DosenController::class, 'menuNilaiAkhirMatakuliah', [MustLoginDosenMiddleware::class]);



// Admin Controller
Router::add('GET', '/register/admin', AdminController::class, 'menuRegistrasiAdmin', []);
Router::add('POST', '/register/admin', AdminController::class, 'postRegisterAdmin', []);
Router::add('GET', '/dashboard/admin', AdminController::class, 'beranda', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/admin/logout', AdminController::class, 'menuLogout', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/data/admin', AdminController::class, 'menuDataPribadi', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/data/admin', AdminController::class, 'postMenuDataPribadi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/data/editadmin', AdminController::class, 'editProfil', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik', AdminController::class, 'menuTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik/tambah', AdminController::class, 'menuTambahDataTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/tahunakademik/tambah', AdminController::class, 'postTambahTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik/edit/semester/([0-9]*)'  , AdminController::class, 'menuEditDataTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/tahunakademik/edit/semester/([0-9]*)' , AdminController::class, 'postTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik/hapus/semester/([0-9]*)' , AdminController::class, 'menuHapusDataTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi', AdminController::class, 'menuProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi/tambah', AdminController::class, 'menuTambahDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/dataprodi/tambah', AdminController::class, 'postTambahDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi/edit/([0-9]*)', AdminController::class, 'menuEditDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/dataprodi/edit/([0-9]*)', AdminController::class, 'postEditProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi/hapus/([0-9]*)', AdminController::class, 'menuHapusDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah', AdminController::class, 'menuMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/tambah', AdminController::class, 'menuTambahDataMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/matakuliah/tambah', AdminController::class, 'postTambahMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/edit/([0-9]*)', AdminController::class, 'menuEditDataMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/matakuliah/edit/([0-9]*)', AdminController::class, 'postEditMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/hapus/([0-9]*)', AdminController::class, 'menuHapusDataMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin', AdminController::class, 'menuKelasMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin/tambah', AdminController::class, 'menuTambahDataKelas', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/kelas/admin/tambah', AdminController::class, 'postTambahKelasAdmin', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin/edit/([0-9]*)', AdminController::class, 'menuEditDataKelas', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/kelas/admin/edit/([0-9]*)', AdminController::class, 'postEditKelasAdmin', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin/hapus/([0-9]*)', AdminController::class, 'menuHapusDataKelas', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/arsip/([0-9a-zA-Z]*)', AdminController::class, 'menuArsipNilai', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/arsip/edit', AdminController::class, 'editArsipMataKuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/arsip/hapus/([0-9]*)/([0-9]*)', AdminController::class, 'hapusArsip', [MustLoginAdminMiddleware::class]);
Router::run();
