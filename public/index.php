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
Router::add('GET', '/', HomeController::class, 'masukkanUsernamePassword', []);
Router::add('POST', '/', HomeController::class, 'postLogin', []);

// Mahasiswa Controller
Router::add('GET', '/register/mahasiswa', MahasiswaController::class, 'tampilkanFormRegistrasi', []);
Router::add('POST', '/register/mahasiswa', MahasiswaController::class, 'postRegisterMahasiswa', []);
Router::add('GET', '/dashboard/mahasiswa', MahasiswaController::class, 'beranda', [MustLoginMahasiswaMiddleware::class]); 
Router::add('POST', '/mahasiswa/logout', MahasiswaController::class, 'prosesLogout', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/data/mahasiswa', MahasiswaController::class, 'tampilkanMenuDataPribadi', [MustLoginMahasiswaMiddleware::class]);
Router::add('POST', '/data/mahasiswa', MahasiswaController::class, 'ubahData', [MustLoginMahasiswaMiddleware::class]);
Router::add('POST', '/data/mahasiswa', MahasiswaController::class, 'postKelolaDataPribadi', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/data/editmahasiswa', MahasiswaController::class, 'editProfil', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa', MahasiswaController::class, 'tampilkanDaftarKelas', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/([0-9]*)', MahasiswaController::class, 'detailKelasMahasiswa', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/gabung/([0-9]*)', MahasiswaController::class, 'pilihKelas', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail/nilaiakhir/([0-9]*)', MahasiswaController::class, 'memilihNilaiAkhirMatakuliah', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail/formpenilaian/([0-9]*)/tambah/([0-9]*)', MahasiswaController::class, 'pilihAnggota', [MustLoginMahasiswaMiddleware::class]);
Router::add('POST', '/kelas/mahasiswa/detail/formpenilaian/([0-9]*)/tambah/([0-9]*)', MahasiswaController::class, 'isiFormPenilaian', [MustLoginMahasiswaMiddleware::class]);
Router::add('GET', '/kelas/mahasiswa/detail/datapenilaian/([0-9]*)', MahasiswaController::class, 'tampilkanMenuPenilaian', [MustLoginMahasiswaMiddleware::class]);


// Dosen Controller
Router::add('GET', '/register/dosen', DosenController::class, 'tampilkanFormRegistrasi', []);
Router::add('POST', '/register/dosen', DosenController::class, 'register', []);
Router::add('GET', '/dashboard/dosen', DosenController::class, 'beranda', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/dosen/logout', DosenController::class, 'menuLogout', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/data/dosen', DosenController::class, 'tampilkanMenuDataPribadi', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/data/dosen', DosenController::class, 'ubahData', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/data/editdosen', DosenController::class, 'editProfil', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen', DosenController::class, 'tampilkanDaftarMatakuliah', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)', DosenController::class, 'tampilkanDataKelas', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/kelompok', DosenController::class, 'pilihMenuTambahDataKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/kelompokdetail', DosenController::class, 'menampilkanFormDataKelompokTambah', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/kelompokdetail', DosenController::class, 'tambahDataKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/kelompokdetail/hapus/([0-9]*)/idkelompok/([0-9]*)/id_mhs/([0-9]*)', DosenController::class, 'menampilkanFormDataKelompokHapus', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk', DosenController::class, 'pilihMenuTambahDataNilai', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok', DosenController::class, 'pilihMenuTambahDataNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/edit/([0-9]*)/([0-9]*)/([0-9]*)', DosenController::class, 'menampilkanFormDataNilaiEditKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/tambah/([0-9]*)/([0-9]*)/([0-9]*)', DosenController::class, 'menampilkanFormDataNilaiTambahKelompok', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/edit/([0-9]*)/([0-9]*)/([0-9]*)', DosenController::class, 'editDataNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/tambah/([0-9]*)/([0-9]*)/([0-9]*)', DosenController::class, 'tambahDataNilaiKelompok', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaikelompok/hapus/([0-9]*)', DosenController::class, 'hapusDataNilaiKelompok', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/tambah', DosenController::class, 'menampilkanFormDataNilaiTambah', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/tambah', DosenController::class, 'tambahDataNilai', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/edit', DosenController::class, 'menampilkanFormDataNilaiEdit', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/edit', DosenController::class, 'editDataNilai', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/hapus', DosenController::class, 'hapusDataNilai', [MustLoginDosenMiddleware::class]);

Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaimk/([0-9]*)/edit', DosenController::class, 'editmk', [MustLoginDosenMiddleware::class]);
Router::add('GET', '/kelas/dosen/detail/([0-9]*)/nilaiakhir', DosenController::class, 'memilihNilaiAkhirMatakuliah', [MustLoginDosenMiddleware::class]);



// Admin Controller
Router::add('GET', '/register/admin', AdminController::class, 'tampilkanFormRegistrasi', []);
Router::add('POST', '/register/admin', AdminController::class, 'register', []);
Router::add('GET', '/dashboard/admin', AdminController::class, 'beranda', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/admin/logout', AdminController::class, 'prosesLogout', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/data/admin', AdminController::class, 'tampilkanMenuDataPribadi', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/data/admin', AdminController::class, 'ubahData', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/data/editadmin', AdminController::class, 'editProfil', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik', AdminController::class, 'tampilkanTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik/tambah', AdminController::class, 'tampilkanFormTambahDataTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/tahunakademik/tambah', AdminController::class, 'tambahDataTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik/edit/semester/([0-9]*)'  , AdminController::class, 'pilihDataTahunAkademikEdit', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/tahunakademik/edit/semester/([0-9]*)' , AdminController::class, 'editDataTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/tahunakademik/hapus/semester/([0-9]*)' , AdminController::class, 'hapusDataTahunAkademik', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi', AdminController::class, 'tampilkanMenuProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi/tambah', AdminController::class, 'tampilkanFormTambahDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/dataprodi/tambah', AdminController::class, 'tambahDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi/edit/([0-9]*)', AdminController::class, 'pilihDataProdiEdit', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/dataprodi/edit/([0-9]*)', AdminController::class, 'editDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/dataprodi/hapus/([0-9]*)', AdminController::class, 'hapusDataProdi', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah', AdminController::class, 'tampilkanMenuMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/tambah', AdminController::class, 'tampilkanFormTambahDataMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/matakuliah/tambah', AdminController::class, 'tambahDataMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/edit/([0-9]*)', AdminController::class, 'pilihDataMatakuliahEdit', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/matakuliah/edit/([0-9]*)', AdminController::class, 'editDataMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/hapus/([0-9]*)', AdminController::class, 'hapusDataMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin', AdminController::class, 'tampilkanMenuKelasMatakuliah', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin/tambah', AdminController::class, 'tampilkanFormTambahDataKelas', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/kelas/admin/tambah', AdminController::class, 'tambahDataKelas', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin/edit/([0-9]*)', AdminController::class, 'pilihDataKelasEdit', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/kelas/admin/edit/([0-9]*)', AdminController::class, 'editDataKelas', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/kelas/admin/hapus/([0-9]*)', AdminController::class, 'hapusDataKelas', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/arsip/([0-9a-zA-Z]*)', AdminController::class, 'pilihMenuArsipNilai', [MustLoginAdminMiddleware::class]);
Router::add('GET', '/matakuliah/arsip/hapus/([0-9]*)/([0-9]*)', AdminController::class, 'hapusArsipNilai', [MustLoginAdminMiddleware::class]);
Router::run();
