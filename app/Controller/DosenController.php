<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class DosenController {

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
        $dosen = $this->loginService->current();
        View::render('index', [
            "title" => "Dashboard Dosen",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            
        ]);
    }

    public function registerDosen(): void {
        View::render('registrasiDosen', [
            "title" => "Daftar Akun Dosen"
        ]);
    }

    public function postRegisterDosen(){
        $request = new Register();
        $request->username = $_POST['username'];
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        $request->jenisKelamin = $_POST['jenisKelamin'];
        $request->nidn = $_POST['nidn'];
        $request->jurusan = $_POST['jurusan'];
        $request->namaLengkap = $_POST['nama'];

        try {
            $this->registerService->registerDosen($request);
            View::redirect('/');
        }catch(\Exception $exception){
            View::render('registrasiDosen', [
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
