<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Login;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use PHPUnit\Framework\TestCase;

class LoginServiceTest extends TestCase{
    private RegisterRepository $registerRepository;
    private RegisterService $registerService;
    private LoginService $loginService;
    private LoginRepository $loginRepository;

    protected function setUp(): void{
        $connection = Database::getConnection();
        $this->loginRepository = new LoginRepository($connection);
        $this->loginService = new LoginService($this->loginRepository);
        $this->registerRepository = new RegisterRepository($connection);
        $this->registerService = new RegisterService($this->registerRepository);
    
        // $this->registerRepository->deleteAll();
    }

    // daftar
    // public function testSave(){
    //     $register = new Register();
    //     $register->nim = "2101020065";
    //     $register->username = "mahadidn";
    //     $register->namaLengkap = "Mahadi Dwi Nugraha";
    //     $register->password = "mahadi123";
    //     $register->email = "mahadi@gmail.com";
    //     $register->jurusan = "Teknik Informatika";
    //     $register->jenisKelamin = "laki-laki";
        
    //     $this->registerService->registerMahasiswa($register);

    //     $result = $this->registerRepository->findByUsername("mahadidn");

    //     self::assertEquals($register->username, $result->username);
    //     self::assertEquals($register->namaLengkap, $result->namaLengkap);
    //     self::assertTrue(password_verify($register->password, $result->password));

    // }


    // test login mahasiswa
    public function testLoginMahasiswaSuccess(){
        $loginRequest = new Login();
        $loginRequest->username = "mahadidn";
        $loginRequest->password = "hadi123";
        $result = $this->loginService->login($loginRequest);

        self::assertEquals($loginRequest->username, $result->username);
        self::assertTrue(password_verify($loginRequest->password, $result->password));
        self::assertEquals("mahasiswa", $result->userType);
    }

    
}
