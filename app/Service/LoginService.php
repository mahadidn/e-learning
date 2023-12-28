<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Mahasiswa;
use Klp1\ELearning\Model\Domain\SessionAdmin;
use Klp1\ELearning\Model\Domain\SessionDosen;
use Klp1\ELearning\Model\Domain\SessionMahasiswa;
use Klp1\ELearning\Model\Login;
use Klp1\ELearning\Repository\LoginRepository;

class LoginService {

    public static string $COOKIE_NAME = 'ELearning-Session-Id';
    private LoginRepository $loginRepository;

    public function __construct(LoginRepository $loginRepository){
        $this->loginRepository = $loginRepository;
    }

    // login
    public function loginVerify(Login $loginRequest): Dosen|Mahasiswa|Admin|null{
        $this->validasi($loginRequest);
        $user = $this->loginRepository->validasi($loginRequest->username);
        if ($user == null){
            throw new \Exception("Username atau Password salah!");
        }
        if(password_verify($loginRequest->password, $user->password)){
            if($user->userType == "dosen"){
                $loginResponse = $user;
                $loginResponse->userType = $user->userType;
                $loginResponse->nama = $user->name;
                $loginResponse->id = $user->id;
                return $loginResponse;
            }else if ($user->userType == "mahasiswa"){
                $loginResponse = $user;
                $loginResponse->userType = $user->userType;
                $loginResponse->nama = $user->nama;
                $loginResponse->id = $user->id;
                return $loginResponse;
            }else if ($user->userType == "admin"){
                $loginResponse = $user;
                $loginResponse->userType = $user->userType;
                $loginResponse->username = $user->username;
                $loginResponse->id = $user->id;
                return $loginResponse;
            }
        }else {
            throw new \Exception("Username atau Password salah!");
        }

    }

    public function validasi(Login $loginRequest){
        if ($loginRequest->username == null || $loginRequest->password == null || trim($loginRequest->username) == "" || trim($loginRequest->password) == ""){
            throw new \Exception("Username atau password tidak boleh kosong!");
        }
    }

    // create session
    public function createSession(int $id, string $usernameSession): SessionAdmin|SessionDosen|SessionMahasiswa {
        $user = $this->loginRepository->validasi($usernameSession);

        if ($user->userType == "admin"){
            $session = new SessionAdmin();
            $session->id = $id;
            $session->userId = uniqid();
            $session->usernameSession = $usernameSession;

            $this->loginRepository->createSession($session);
            setcookie(self::$COOKIE_NAME, $session->userId, time() + (30*30*12*20), "/");

            return $session;
        }else if ($user->userType == "dosen"){
            $session = new SessionDosen();
            $session->id = $id;
            $session->userId = uniqid();
            $session->usernameSession = $usernameSession;

            $this->loginRepository->createSession($session);
            setcookie(self::$COOKIE_NAME, $session->userId, time() + (30*30*12*20), "/");

            return $session;
        }else if($user->userType == "mahasiswa"){
            $session = new SessionMahasiswa();
            $session->id = $id;
            $session->userId = uniqid();
            $session->usernameSession = $usernameSession;

            $this->loginRepository->createSession($session);
            setcookie(self::$COOKIE_NAME, $session->userId, time() + (30*30*12*20), "/");
        
            return $session;
        }

    }

    public function destroy(){
        $sessionUserId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $this->loginRepository->deleteByUserId($sessionUserId);

        setcookie(self::$COOKIE_NAME, '', 1, '/');
    }

    public function current(): Admin|Mahasiswa|Dosen|null {
        $sessionUserId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $session = $this->loginRepository->findByUserId($sessionUserId);
        if ($session == null){
            return null;
        }
        return $this->loginRepository->findBySession($session->userType, $session->id);

    }

}

