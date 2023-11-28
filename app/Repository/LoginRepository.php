<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Mahasiswa;

class LoginRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function findByUsername(string $username): Admin|Dosen|Mahasiswa|null {

        $statementAdmin = $this->connection->prepare("SELECT username, password, email FROM admin WHERE username = ?");
        $statementAdmin->execute([$username]);

        $statementDosen = $this->connection->prepare("SELECT nidn, username, password, nama, jenis_kelamin, email, prodi  FROM dosen WHERE username = ?");
        $statementDosen->execute([$username]);

        $statementMahasiswa = $this->connection->prepare("SELECT nim, username, password, nama, email, prodi, jenis_kelamin FROM mahasiswa WHERE username = ? ");
        $statementMahasiswa->execute([$username]);

        try {
            if ($row = $statementAdmin->fetch()){
                $admin = new Admin();
                $admin->username = $row['username'];
                $admin->password = $row['password'];
                $admin->email = $row['email'];
                return $admin;
            }else if($row = $statementDosen->fetch()){
                $dosen = new Dosen();
                $dosen->username = $row['username'];
                $dosen->nidn = $row['nidn'];
                $dosen->password = $row['password'];
                $dosen->name = $row['nama'];
                $dosen->email = $row['email'];
                $dosen->jurusan = $row['prodi'];
                $dosen->jenisKelamin = $row['jenis_kelamin'];
                return $dosen;
            }else if ($row = $statementMahasiswa->fetch()){
                $mahasiswa = new Mahasiswa();
                $mahasiswa->username = $row['username'];
                $mahasiswa->nim = $row['nim'];
                $mahasiswa->password = $row['password'];
                $mahasiswa->nama = $row['nama'];
                $mahasiswa->email = $row['email'];
                $mahasiswa->prodi = $row['prodi'];
                $mahasiswa->jenisKelamin = $row['jenis_kelamin'];
                return $mahasiswa;
            }else {
                return null;
            }
        }finally {
            $statementAdmin->closeCursor();
            $statementDosen->closeCursor();
            $statementMahasiswa->closeCursor();
        }

    }

}
