<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class MahasiswaController {

    private RegisterService $registerService;
    private LoginService $loginService;

    public function __construct(){
        $connection = Database::getConnection();
        $registerRepository = new RegisterRepository($connection);
        $this->registerService = new RegisterService($registerRepository);
        $loginRepository = new LoginRepository($connection);
        $this->loginService = new LoginService($loginRepository);
    }

    public function dashboard(): void{
        $mahasiswa = $this->loginService->current();
        View::render('index', [
            "title" => "Dashboard Mahasiswa",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin

        ]);
    }

    public function registerMahasiswa(): void {
        View::render('registrasiMahasiswa', [
            "title" => "Daftar Akun Mahasiswa"
        ]);
    }

    public function postRegisterMahasiswa(){
        $request = new Register();
        $request->username = $_POST['username'];
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        $request->jenisKelamin = $_POST['jenisKelamin'];
        $request->nim = $_POST['nim'];
        $request->jurusan = $_POST['jurusan'];
        $request->namaLengkap = $_POST['nama'];

        try {
            $this->registerService->registerMahasiswa($request);
            View::redirect('/');
        }catch(\Exception $exception){
            View::render('registrasiMahasiswa', [
                "titile" => "Daftar Akun",
                "error" => $exception->getMessage()
            ]);
        }

    }

    public function logout(){
        $this->loginService->destroy();
        View::redirect("/");
    }



}

