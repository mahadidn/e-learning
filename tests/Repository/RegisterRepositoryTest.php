<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Register;
use PHPUnit\Framework\TestCase;

class RegisterRepositoryTest extends TestCase {

    private RegisterRepository $registerRepository;

    protected function setUp(): void{
        $this->registerRepository = new RegisterRepository(Database::getConnection());
        $this->registerRepository->deleteAll();
    }

    public function testSave(){
        $register = new Register();
        $register->nim = "2101020065";
        $register->username = "mahadidn";
        $register->namaLengkap = "Mahadi Dwi Nugraha";
        $register->password = "mahadi123";
        $register->email = "mahadi@gmail.com";
        $register->jurusan = "Teknik Informatika";
        $register->jenisKelamin = "laki-laki";
        
        $this->registerRepository->saveMahasiswa($register);

        $result = $this->registerRepository->findByUsername("mahadidn");

        self::assertEquals($register->username, $result->username);
        self::assertEquals($register->namaLengkap, $result->namaLengkap);
        self::assertEquals($register->password, $result->password);

    }

    public function testRegisterDosenSuccess(){
        $register = new Register();
        $register->username = "dosen1";
        $register->password = "dosen1123";
        $register->nidn = "123123123";
        $register->namaLengkap = "dosen1";
        $register->email = "dosen1@gmail.com";
        $register->jurusan = "teknik informatika";
        $register->jenisKelamin = "laki-laki";

        $this->registerRepository->saveDosen($register);

        $response = $this->registerRepository->findByUsername("dosen1");

        self::assertEquals($register->username, $response->username);
        self::assertEquals($register->nidn, $response->nidn);
        self::assertEquals($register->namaLengkap, $response->namaLengkap);


    }

}

