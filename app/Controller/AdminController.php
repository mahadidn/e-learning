<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Model\Domain\TahunAkademik;
use Klp1\ELearning\Repository\KelolaDataPribadiRepository;
use Klp1\ELearning\Repository\KontrolTahunAkademikRepository;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\KelolaDataPribadiService;
use Klp1\ELearning\Service\KontrolTahunAkademikService;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class AdminController {

    private RegisterService $registerService;
    private LoginService $loginService;
    private KelolaDataPribadiService $kelolaDataPribadiService;
    private KontrolTahunAkademikService $kontrolTahunAkademikService;

    public function __construct(){
        $connection = Database::getConnection();

        // repo
        $registerRepository = new RegisterRepository($connection);
        $loginRepository = new LoginRepository($connection);
        $kelolaDataPribadiRepository = new KelolaDataPribadiRepository($connection);
        $kontrolTahunAkademikRepository = new KontrolTahunAkademikRepository($connection);

        // service
        $this->registerService = new RegisterService($registerRepository);
        $this->loginService = new LoginService($loginRepository);
        $this->kelolaDataPribadiService = new KelolaDataPribadiService($kelolaDataPribadiRepository, $loginRepository, $this->loginService);
        $this->kontrolTahunAkademikService = new KontrolTahunAkademikService($kontrolTahunAkademikRepository);
    }
    
    public function dashboard(){
        $admin = $this->loginService->current();
        View::render('index', [
            "title" => "Dashboard Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    public function logout(){
        $this->loginService->destroy();
        View::redirect("/");
    }

    public function registerAdmin(){
        View::render('registrasiAdmin', [
            "title" => "Register Admin"
        ]);
    }

    public function postRegisterAdmin(){
        $registerAdmin = new Admin();
        $registerAdmin->username = $_POST['username'];
        $registerAdmin->email = $_POST['email'];
        $registerAdmin->password = $_POST['password'];

        try {
            $this->registerService->registerAdmin($registerAdmin);
            View::redirect('/');
        }catch(\Exception $exception){
            View::render('registrasiAdmin', [
                "title" => "Daftar Akun",
                "error" => $exception->getMessage()
            ]);
        }

    }

    // data pribadi
    public function kelolaDataPribadi(){
        $admin = $this->loginService->current();
        View::render('data-pribadi', [
            "title" => "Data Pribadi Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    public function postKelolaDataPribadi(){
        $request = new Admin();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->email = $_POST['email'];

        try {
            $this->kelolaDataPribadiService->ubahDataAdmin($request);
            View::redirect('/data/admin');
        }catch (\Exception $e){
            $admin = $this->loginService->current();
            View::render('keloladata-pribadi', [
                "title" => "Data Pribadi Admin",
                'usertype' => $admin->userType,
                'username' => $admin->username,
                'email' => $admin->email,
                'error' => $e->getMessage()
            ]);
        }

    }

    // edit profil
    public function editProfil(){
        $admin = $this->loginService->current();
        View::render('keloladata-pribadi', [
            "title" => "Data Pribadi Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // tahun akademik
    public function tahunAkademik(){
        $admin = $this->loginService->current();
        $tahunAkademik = $this->kontrolTahunAkademikService->getTahunAkademik();
        View::render('data-tahun-akademik', [
            "title" => "Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'tahunAkademik' => $tahunAkademik
        ]);
    }

    // tambah tahun akademik
    public function tambahTahunAkademik(){
        $admin = $this->loginService->current();
        View::render('form-tahun-akademik', [
            "title" => "Tambah Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }
    

    public function postTambahTahunAkademik(){  
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik->nama_semester = $_POST['nama_semester'];
        $tahunAkademik->tahun = $_POST['tahun'];
        $tahunAkademik->status = $_POST['status'];

        $this->kontrolTahunAkademikService->tambahTahun($tahunAkademik);
        View::redirect('/tahunakademik');
    }

    // edit tahun akademik
    public function editTahunAkademik($id_semester){
        $admin = $this->loginService->current();
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik = $this->kontrolTahunAkademikService->getSemesterById($id_semester);
        View::render('form-edit-tahun-akademik ', [
            "title" => "Tambah Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'tahun' => $tahunAkademik->tahun,
        ]);
    }

    public function postTahunAkademik(){
        $path = $_SERVER['PATH_INFO'];
        $semester = explode("/", $path);
        $id_semester = $semester[4];
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik->nama_semester = $_POST['nama_semester'];
        $tahunAkademik->tahun = $_POST['tahun'];
        $tahunAkademik->status = $_POST['status'];
        $this->kontrolTahunAkademikService->editTahun($tahunAkademik, $id_semester);
        View::redirect('/tahunakademik');
    }

    public function hapusTahunAkademik(){
        $path = $_SERVER['PATH_INFO'];
        $semester = explode("/", $path);
        $id_semester = $semester[4];
        $this->kontrolTahunAkademikService->hapusSemester($id_semester);
        View::redirect('/tahunakademik');
    }

    // data prodi
    public function dataProdi(){
        $admin = $this->loginService->current();
        View::render('data-prodi', [
            'title' => 'Data Prodi',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // tambah data prodi
    public function tambahDataProdi(){
        $admin = $this->loginService->current();
        View::render('form-prodi', [
            'title' => 'Tambah Data Prodi',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // matakuliah
    public function matakuliah(){
        $admin = $this->loginService->current();
        View::render('data-mata-kuliah', [
            'title' => 'Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    public function tambahMatakuliah(){
        $admin = $this->loginService->current();
        View::render('form-mata-kuliah', [
            'title' => 'Tambah Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // kelas
    public function kelasAdmin(){
        $admin = $this->loginService->current();
        View::render('data-kelas', [
            'title' => 'Kelola Kelas',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // tambah kelas admin
    public function tambahKelasAdmin(){
        $admin = $this->loginService->current();
        View::render('form-kelas', [
            'title' => 'Kelola Kelas',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // arsip mata kuliah
    public function arsipMataKuliah(){
        $admin = $this->loginService->current();
        View::render('arsip-nilai-mata-kuliah', [
            'title' => 'Arsip Nilai Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // edit arsip mata kuliah
    public function editArsipMataKuliah(){
        $admin = $this->loginService->current();
        View::render('form-arsip-nilai', [
            'title' => 'Edit Arsip Nilai Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

}

