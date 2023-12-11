<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Matakuliah;

class KelolaMataKuliahRepository {

    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpan(Matakuliah $matakuliah){
        $statement = $this->connection->prepare("INSERT INTO matakuliah(nama_mk, jadwal_mk, sks) VALUES (?, ?, ?)");
        $statement->execute([$matakuliah->nama_mk, $matakuliah->jadwal_mk, $matakuliah->sks]);
        
    }

    public function editSimpan(Matakuliah $matakuliah, $id_mk){
        $statement = $this->connection->prepare("UPDATE matakuliah SET nama_mk = ?, jadwal_mk = ?, nama_dosen = ?, sks = ? WHERE id_mk = ?");
        $statement->execute([$matakuliah->nama_mk, $matakuliah->jadwal_mk, $matakuliah->nama_dosen, $matakuliah->sks, $id_mk]);
    }


    public function hapus($id_mk){
        $statement = $this->connection->prepare("DELETE from matakuliah WHERE id_mk = ?");
        $statement->execute([$id_mk]);
    }

    public function tampilkanMatakuliah(){
        $statement = $this->connection->prepare("SELECT * FROM matakuliah");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;
    }

    public function tampilkanMatakuliahSatu($id_mk){
        $statement = $this->connection->prepare("SELECT * FROM matakuliah WHERE id_mk = ?");
        $statement->execute([$id_mk]);

        $row = $statement->fetch();
        return $row;
    }

    public function tampilkanMatakuliahDanKelas($nama_dosen){
        $statement = $this->connection->prepare("select * from matakuliah JOIN kelas ON (matakuliah.nama_mk = kelas.matakuliah) WHERE nama_dosen = ?");
        $statement->execute([$nama_dosen]);

        $row = $statement->fetchAll();
        return $row;
    }

    public function arsipMataKuliah(){
        $statement = $this->connection->prepare("SELECT * FROM arsip_nilai");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;
    }

}

