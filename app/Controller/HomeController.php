<?php

namespace Klp1\ELearning\Controller;

use Exception;
use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Login;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Service\LoginService;

class HomeController {

    private LoginService $loginService;

    public function __construct(){
        $connection = Database::getConnection();
        $loginRepository = new LoginRepository($connection);
        $this->loginService = new LoginService($loginRepository);
    }

    
    public function index(): void {
        
        View::render('login', [
            "title" => "login"
        ]);
    }

    public function postLogin(){
        $loginRequest = new Login();
        $loginRequest->username = $_POST['username'];
        $loginRequest->password = $_POST['password'];

        try{
            $loginResponse = $this->loginService->login($loginRequest);
            if ($loginResponse->userType == "dosen"){
                View::redirect('/dashboard/dosen');
            }else if ($loginResponse->userType == "mahasiswa"){
                View::redirect('/dashboard/mahasiswa');
            }else if ($loginResponse->userType == "admin"){
                View::redirect('/dashboard/admin');
            }
        }catch (\Exception $exception){
            View::render('login', [
                "title" => 'Login',
                'error' => $exception->getMessage()
            ]);
        }

    }
    
}

