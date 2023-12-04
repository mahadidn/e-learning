<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Mahasiswa;

class KelolaDataPribadiRepository {

    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpanDataDosen(Dosen $dosen, $username): Dosen {
        
        $statement = $this->connection->prepare("UPDATE dosen SET username = ?, nidn = ?, password = ?, nama = ?, jenis_kelamin = ?, email = ?, prodi = ? WHERE username = ?");
        $statement->execute([$dosen->username, $dosen->nidn, $dosen->password, $dosen->name, $dosen->jenisKelamin, $dosen->email, $dosen->jurusan, $username]);

        return $dosen;
    }

    public function simpanDataMahasiswa(Mahasiswa $mahasiswa, $username): Mahasiswa {
        $statement = $this->connection->prepare("UPDATE mahasiswa SET username = ?, nim = ?, password = ?, nama = ?, email = ?, prodi = ?, jenis_kelamin = ? WHERE username = ?");
        $statement->execute([$mahasiswa->username, $mahasiswa->nim, $mahasiswa->password, $mahasiswa->nama, $mahasiswa->email, $mahasiswa->prodi, $mahasiswa->jenisKelamin, $username]);
    
        return $mahasiswa;
    }

    public function simpanDataAdmin(Admin $admin, $username): Admin {
        $statement = $this->connection->prepare("UPDATE admin SET username = ?, password = ?, email = ? WHERE username = ?");
        $statement->execute([$admin->username, $admin->password, $admin->email, $username]);

        return $admin;
    }


}

