<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Mahasiswa;
use PHPUnit\Framework\TestCase;

class KelolaDataPribadiRepositoryTest extends TestCase {

    private KelolaDataPribadiRepository $kelolaDataPribadiRepository;
    private LoginRepository $loginRepository;

    protected function setUp(): void{
        $this->kelolaDataPribadiRepository = new KelolaDataPribadiRepository(Database::getConnection());
        $this->loginRepository = new LoginRepository(Database::getConnection());
    }

    public function testUpdateMahasiswa(){
        $mahasiswa = new Mahasiswa();
        $username = "mahadi_dn";
        $mahasiswa->username = "mahadi_dn";
        $mahasiswa->nama = "MDN";
        $mahasiswa->nim = "99112334";
        $mahasiswa->email = "hadi@gmail.com";
        $mahasiswa->prodi = "Teknik Elektro";
        $mahasiswa->jenisKelamin = "laki-laki";
        $mahasiswa->password = "helloWorld123";

        $this->kelolaDataPribadiRepository->ubahDataMahasiswa($mahasiswa, $username);

        $result = $this->loginRepository->findByUsername($mahasiswa->username);
        self::assertEquals($mahasiswa->username, $result->username);
        self::assertEquals($mahasiswa->email, $result->email);
        self::assertEquals($mahasiswa->nama, $result->nama);
    }



}

