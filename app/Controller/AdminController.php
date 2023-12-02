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


}

