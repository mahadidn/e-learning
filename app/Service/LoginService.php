<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Login;
use Klp1\ELearning\Repository\LoginRepository;

class LoginService {

    private LoginRepository $loginRepository;

    public function __construct(LoginRepository $loginRepository){
        $this->loginRepository = $loginRepository;
    }

    // login
    public function login(Login $loginRequest){
        $this->validateLoginRequest($loginRequest);
        $user = $this->loginRepository->findByUsername($loginRequest->username);
        if ($user == null){
            throw new \Exception("Username atau Password salah!");
        }
        if(password_verify($loginRequest->password, $user->password)){
            if($user->userType == "dosen"){
                $loginResponse = $user;
                $loginResponse->userType = $user->userType;
                $loginResponse->nama = $user->name;
                return $loginResponse;
            }else if ($user->userType == "mahasiswa"){
                $loginResponse = $user;
                $loginResponse->userType = $user->userType;
                $loginResponse->nama = $user->nama;
                return $loginResponse;
            }else if ($user->userType == "admin"){
                $loginResponse = $user;
                $loginResponse->userType = $user->userType;
                $loginResponse->username = $user->username;
            }
        }else {
            throw new \Exception("Username atau Password salah!");
        }

    }

    public function validateLoginRequest(Login $loginRequest){
        if ($loginRequest->username == null || $loginRequest->password == null || trim($loginRequest->username) == "" || trim($loginRequest->password) == ""){
            throw new \Exception("Username atau password tidak boleh kosong!");
        }
    }

}

