<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\RegisterService;

class DosenController {

    private RegisterService $registerService;

    public function __construct(){
        $connection = Database::getConnection();
        $registerRepository = new RegisterRepository($connection);
        $this->registerService = new RegisterService($registerRepository);
    }

    public function dashboard(): void{
        View::render('index', [
            "title" => "Dashboard Dosen"
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
        View::redirect("/");
    }

}
