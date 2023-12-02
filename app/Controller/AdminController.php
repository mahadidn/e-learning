<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class AdminController {

    private RegisterService $registerService;
    private LoginService $loginService;

    public function __construct(){
        $connection = Database::getConnection();
        $registerRepository = new RegisterRepository($connection);
        $this->registerService = new RegisterService($registerRepository);
        $loginRepository = new LoginRepository($connection);
        $this->loginService = new LoginService($loginRepository);
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
    public function dataPribadi(){
        $admin = $this->loginService->current();
        View::render('data-pribadi', [
            "title" => "Data Pribadi Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
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
        View::render('data-tahun-akademik', [
            "title" => "Tahun Akademik",
            'usertype' => "admin"
        ]);
    }

    // tambah tahun akademik
    public function tambahTahunAkademik(){
        View::render('form-tahun-akademik', [
            "title" => "Tambah Tahun Akademik",
            'usertype' => "admin"
        ]);
    }

    // data prodi
    public function dataProdi(){
        View::render('data-prodi', [
            'title' => 'Data Prodi',
            'usertype' => 'admin'
        ]);
    }

    // tambah data prodi
    public function tambahDataProdi(){
        View::render('form-prodi', [
            'title' => 'Tambah Data Prodi',
            'usertype' => 'admin'
        ]);
    }

    // matakuliah
    public function matakuliah(){
        View::render('data-mata-kuliah', [
            'title' => 'Matakuliah',
            'usertype' => 'admin'
        ]);
    }

    public function tambahMatakuliah(){
        View::render('form-mata-kuliah', [
            'title' => 'Tambah Matakuliah',
            'usertype' => 'admin'
        ]);
    }

    // kelas
    public function kelasAdmin(){
        View::render('data-kelas', [
            'title' => 'Kelola Kelas',
            'usertype' => 'admin'
        ]);
    }

    // tambah kelas admin
    public function tambahKelasAdmin(){
        View::render('form-kelas', [
            'title' => 'Kelola Kelas',
            'usertype' => 'admin'
        ]);
    }

    // arsip mata kuliah
    public function arsipMataKuliah(){
        View::render('arsip-nilai-mata-kuliah', [
            'title' => 'Arsip Nilai Matakuliah',
            'usertype' => 'admin'
        ]);
    }

    // edit arsip mata kuliah
    public function editArsipMataKuliah(){
        View::render('form-arsip-nilai', [
            'title' => 'Edit Arsip Nilai Matakuliah',
            'usertype' => 'admin'
        ]);
    }

}

