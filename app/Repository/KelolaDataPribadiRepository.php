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

    public function simpanEditDosen(Dosen $dosen, $username): void {
        
        $statement = $this->connection->prepare("UPDATE dosen SET nidn = ?, password = ?, jenis_kelamin = ?, email = ?, prodi = ? WHERE username = ?");
        $statement->execute([$dosen->nidn, $dosen->password, $dosen->jenisKelamin, $dosen->email, $dosen->jurusan, $username]);

    }

    public function simpanEditMahasiswa(Mahasiswa $mahasiswa, $username): void {
        $statement = $this->connection->prepare("UPDATE mahasiswa SET nim = ?, password = ?, email = ?, prodi = ?, jenis_kelamin = ? WHERE username = ?");
        $statement->execute([$mahasiswa->nim, $mahasiswa->password, $mahasiswa->email, $mahasiswa->prodi, $mahasiswa->jenisKelamin, $username]);
    
    }

    public function simpanEditAdmin(Admin $admin, $username): void {
        $statement = $this->connection->prepare("UPDATE admin SET password = ?, email = ? WHERE username = ?");
        $statement->execute([$admin->password, $admin->email, $username]);

    }

    public function tampilkanDataDosen($id): Dosen {
        $statement = $this->connection->prepare("SELECT * FROM dosen WHERE id = ?");
        $statement->execute($id);

        $row = $statement->fetch();

        $dosen = new Dosen();
        $dosen->id = $row['id'];
        $dosen->nidn = $row['nidn'];
        $dosen->username = $row['username'];
        $dosen->name = $row['nama'];
        $dosen->jenisKelamin = $row['jenis_kelamin'];
        $dosen->email = $row['email'];
        $dosen->jurusan = $row['prodi'];

        return $dosen;
    }

    public function tampilkanDataMahasiswa($id): Mahasiswa {
        $statement = $this->connection->prepare("SELECT * FROM mahasiswa WHERE id = ?");
        $statement->execute([$id]);

        $row = $statement->fetch();

        $mahasiswa = new Mahasiswa();
        $mahasiswa->id = $row['id'];
        $mahasiswa->nim = $row['nim'];
        $mahasiswa->username = $row['username'];
        $mahasiswa->nama = $row['nama'];
        $mahasiswa->jenisKelamin = $row['jenis_kelamin'];
        $mahasiswa->email = $row['email'];
        $mahasiswa->prodi = $row['prodi'];

        return $mahasiswa;
    }

    public function tampilkanDataAdmin($id): Admin {
        $statement = $this->connection->prepare("SELECT * FROM admin WHERE id = ?");
        $statement->execute([$id]);

        $row = $statement->fetch();
        $admin = new Admin();
        $admin->id = $row['id'];
        $admin->username = $row['username'];
        $admin->password = $row['password'];
        $admin->email = $row['email'];

        return $admin;
    }

}

