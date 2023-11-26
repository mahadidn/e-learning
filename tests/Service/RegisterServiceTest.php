<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\RegisterRepository;
use PHPUnit\Framework\TestCase;

class RegisterServiceTest extends TestCase {
    private RegisterRepository $registerRepository;
    private RegisterService $registerService;

    protected function setUp(): void{
        $connection = Database::getConnection();
        $this->registerRepository = new RegisterRepository($connection);
        $this->registerService = new RegisterService($this->registerRepository);

        $this->registerRepository->deleteAll();
    }

    public function testRegisterMahasiswaSuccess(){
        $register = new Register();
        $register->username = "mahadidn";
        $register->password = "hadi123";
        $register->nim = "2101020065";
        $register->namaLengkap = "Mahadi Dwi Nugraha";
        $register->email = "mahadi@gmail.com";
        $register->jurusan = "Teknik Informatika";
        $register->jenisKelamin = "laki-laki";

        $response = $this->registerService->registerMahasiswa($register);

        self::assertEquals($register->username, $response->username);
        self::assertEquals($register->namaLengkap, $response->namaLengkap);

        self::assertTrue(password_verify($register->password, $response->password));

    }

    public function testRegisterDosenSuccess(){
        $register = new Register();
        $register->username = "dosen2";
        $register->password = "dosen2123";
        $register->nidn = "12312343";
        $register->namaLengkap = "dosen2";
        $register->email = "dosen2@gmail.com";
        $register->jurusan = "Teknik Informatika";
        $register->jenisKelamin = "perempuan";

        $response = $this->registerService->registerDosen($register);

        self::assertEquals($register->username, $response->username);
        self::assertEquals($register->namaLengkap, $response->namaLengkap);

        self::assertTrue(password_verify($register->password, $response->password));

    }

    

}
