<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Register;

class RegisterRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function saveMahasiswa(Register $register): Register{
        $statement = $this->connection->prepare("INSERT INTO mahasiswa(nim, username, password, nama, email, prodi, jenis_kelamin) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $statement->execute([$register->nim, $register->username, $register->password, $register->namaLengkap, $register->email, $register->jurusan, $register->jenisKelamin]);

        return $register;
    }

    public function saveDosen(Register $register): Register{
        $statement = $this->connection->prepare("INSERT INTO dosen(nidn, username, password, nama, email, prodi, jenis_kelamin) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $statement->execute([$register->nidn, $register->username, $register->password, $register->namaLengkap, $register->email, $register->jurusan, $register->jenisKelamin]);

        return $register;
    }

    public function findByUsername(string $username): ?Register{
        $statementMahasiswa = $this->connection->prepare("SELECT nim, username, password, nama, email, prodi, jenis_kelamin FROM mahasiswa WHERE username = ?");
        $statementMahasiswa->execute([$username]);

        $statementDosen = $this->connection->prepare("SELECT nidn, username, password, nama, email, prodi, jenis_kelamin FROM dosen WHERE username = ?");
        $statementDosen->execute([$username]);

        try {
            if ($row = $statementMahasiswa->fetch()){
                $mahasiswa = new Register();
                $mahasiswa->username = $row['username'];
                $mahasiswa->password = $row['password'];
                $mahasiswa->nim = $row['nim'];
                $mahasiswa->namaLengkap = $row['nama'];
                $mahasiswa->email = $row['email'];
                $mahasiswa->jurusan = $row['prodi'];
                $mahasiswa->jenisKelamin = $row['jenis_kelamin'];
                return $mahasiswa;
            }else if($row = $statementDosen->fetch()){
                $dosen = new Register();
                $dosen->username = $row['username'];
                $dosen->password = $row['password'];
                $dosen->nidn = $row['nidn'];
                $dosen->namaLengkap = $row['nama'];
                $dosen->email = $row['email'];
                $dosen->jurusan = $row['prodi'];
                $dosen->jenisKelamin = $row['jenis_kelamin'];
                return $dosen;
            }else {
                return null;
            }
        }finally {
            $statementDosen->closeCursor();
            $statementMahasiswa->closeCursor();
        }

    }

    public function deleteAll(): void {
        $this->connection->exec("DELETE FROM mahasiswa");
        $this->connection->exec("DELETE FROM dosen");
    }

}
