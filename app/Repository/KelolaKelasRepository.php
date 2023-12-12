<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Kelas;

class KelolaKelasRepository {

    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function tampilkanDosen(){
        $statement = $this->connection->prepare("SELECT * FROM dosen");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;
    }

    // simpan kelas
    public function simpan(Kelas $kelas){
        $statement = $this->connection->prepare("INSERT INTO kelas (nama_kelas, kapasitas, nama_dosen, matakuliah) VALUES (?, ?, ?, ?)");
        $statement->execute([$kelas->nama_kelas, $kelas->kapasitas, $kelas->nama_dosen, $kelas->matakuliah]);
    }

    // ubah kelas
    public function editKelas(Kelas $kelas, $id_kelas){
        $statement = $this->connection->prepare("UPDATE kelas SET nama_kelas = ?, kapasitas = ?, nama_dosen = ?, matakuliah = ? WHERE id_kelas = ?");
        $statement->execute([$kelas->nama_kelas, $kelas->kapasitas, $kelas->nama_dosen, $kelas->matakuliah, $id_kelas]);
    }

    // hapus data
    public function hapus($id_kelas){

        $statement = $this->connection->prepare("DELETE FROM mahasiswa_kelas WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);

        $statement = $this->connection->prepare("DELETE FROM kelas WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);
    }

    // tampilkan semua data kelas
    public function getDataKelas(){
        $statement = $this->connection->prepare("SELECT * FROM kelas");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;

    }

    // tampilkan satu kelas
    public function getSatuKelas($id_kelas){
        $statement = $this->connection->prepare("SELECT * FROM kelas WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);

        $row = $statement->fetch();
        return $row;
    }

}

