<?php

namespace Klp1\ELearning\Middleware;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Service\LoginService;

class MustLoginMiddleware implements Middleware {

    private LoginService $loginService;

    public function __construct(){
        $loginRepository = new LoginRepository(Database::getConnection());
        $this->loginService = new LoginService($loginRepository);
    }

    function before(): void{
        $user = $this->loginService->current();
        if ($user == null){
            View::redirect('/');
        }
    }

}
