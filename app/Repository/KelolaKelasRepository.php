<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Kelas;

class KelolaKelasRepository {

    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }


    // simpan kelas
    public function simpanTambah(Kelas $kelas){
        $statement = $this->connection->prepare("INSERT INTO kelas (nama_kelas, kapasitas, nama_dosen, matakuliah) VALUES (?, ?, ?, ?)");
        $statement->execute([$kelas->nama_kelas, $kelas->kapasitas, $kelas->nama_dosen, $kelas->matakuliah]);
    }

    // ubah kelas
    public function simpanEdit(Kelas $kelas, $id_kelas){
        $statement = $this->connection->prepare("UPDATE kelas SET nama_kelas = ?, kapasitas = ?, nama_dosen = ?, matakuliah = ? WHERE id_kelas = ?");
        $statement->execute([$kelas->nama_kelas, $kelas->kapasitas, $kelas->nama_dosen, $kelas->matakuliah, $id_kelas]);
    }

    // hapus data
    public function hapusData($id_kelas){

        $statement = $this->connection->prepare("DELETE FROM mahasiswa_kelas WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);

        $statement = $this->connection->prepare("DELETE FROM kelas WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);
    }

    // tampilkan semua data kelas
    public function tampilkanDataKelas(){
        $statement = $this->connection->prepare("SELECT * FROM kelas");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;

    }

    // lihat nilai akir
    public function ambilDataNilai($id_kelas, $nama_mhs){
        $statement = $this->connection->prepare("SELECT * FROM nilai WHERE id_kelas = ? and nama_mhs = ?");
        $statement->execute([$id_kelas, $nama_mhs]);

        $row = $statement->fetchAll();
        return $row;
    }

    // 
    // tampilkan satu kelas
    public function tampilkanSatuKelas($id_kelas){
        $statement = $this->connection->prepare("SELECT * FROM kelas WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);

        $row = $statement->fetch();
        return $row;
    }

    public function tampilkanDosen(){
        $statement = $this->connection->prepare("SELECT * FROM dosen");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;
    }


}

