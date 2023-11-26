<?php

namespace Klp1\ELearning\Controller;

use Exception;
use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\RegisterService;

class HomeController {

    
    public function index(): void {
        
        View::render('login', [
            "title" => "login"
        ]);
    }
    
}

