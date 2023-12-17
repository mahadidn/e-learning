<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Prodi;

class KelolaDataProdiRepository {

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpanTambah(Prodi $prodi){
        $statement = $this->connection->prepare("INSERT INTO prodi (nama_prodi, jumlah_mhs) VALUES (?, ?)");
        $statement->execute([$prodi->nama_prodi, $prodi->jumlah_mhs]);
    }

    public function simpanEdit(Prodi $prodi, $id_prodi){
        $statement = $this->connection->prepare("UPDATE prodi SET nama_prodi = ?, jumlah_mhs = ? WHERE id_prodi = ?");
        $statement->execute([$prodi->nama_prodi, $prodi->jumlah_mhs, $id_prodi]);
    }

    // hapus data prodi
    public function hapusDataProdi($id_prodi){
        $statement = $this->connection->prepare("DELETE FROM prodi WHERE id_prodi = ?");
        $statement->execute([$id_prodi]);
    }


    // get all prodi
    public function tampilkanDataProdi(){
        $statement = $this->connection->prepare("SELECT * FROM prodi");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;
    }

    // get satu prodi
    public function tampilkanSatuProdi($id_prodi){
        $statement = $this->connection->prepare("SELECT * FROM prodi WHERE id_prodi = ?");
        $statement->execute([$id_prodi]);

        $row = $statement->fetch();
        return $row;
    }


}

