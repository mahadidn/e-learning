<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;

class AdminController {
    
    public function dashboard(){
        View::render('index', [
            "title" => "Dashboard Admin"
        ]);
    }

    public function logout(){
        View::redirect("/");
    }

}

