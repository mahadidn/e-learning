<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Matakuliah;

class KelolaMataKuliahRepository {

    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    // kelola matakuliah controller ini digunakan oleh admin dan dosen seperti sequencenya

    // role admin
    public function simpanTambah(Matakuliah $matakuliah){
        $statement = $this->connection->prepare("INSERT INTO matakuliah(nama_mk, jadwal_mk, sks) VALUES (?, ?, ?)");
        $statement->execute([$matakuliah->nama_mk, $matakuliah->jadwal_mk, $matakuliah->sks]);
        
    }

    public function simpanEdit(Matakuliah $matakuliah, $id_mk){
        $statement = $this->connection->prepare("UPDATE matakuliah SET nama_mk = ?, jadwal_mk = ?, sks = ? WHERE id_mk = ?");
        $statement->execute([$matakuliah->nama_mk, $matakuliah->jadwal_mk, $matakuliah->sks, $id_mk]);
    }


    public function hapusData($id_mk){
        $statement = $this->connection->prepare("DELETE from matakuliah WHERE id_mk = ?");
        $statement->execute([$id_mk]);
    }

    public function tampilkanDataMatakuliah(){
        $statement = $this->connection->prepare("SELECT * FROM matakuliah");
        $statement->execute();

        $matakuliah = $statement->fetchAll();
        return $matakuliah;
    }

    // role dosen
    public function tampilkanMatakuliahDanKelas($nama_dosen){
        $statement = $this->connection->prepare("select * from matakuliah JOIN kelas ON (matakuliah.nama_mk = kelas.matakuliah) WHERE nama_dosen = ?");
        $statement->execute([$nama_dosen]);

        $matakuliah = $statement->fetchAll();
        return $matakuliah;
    }

    

    public function tampilkanMatakuliahDanKelasIDKelas($id_kelas){
        $statement = $this->connection->prepare("select * from matakuliah JOIN kelas ON (matakuliah.nama_mk = kelas.matakuliah) WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);

        $matakuliah = $statement->fetchAll();
        return $matakuliah;
    }

    // 
    public function tampilkanMatakuliahSatu($id_mk){
        $statement = $this->connection->prepare("SELECT * FROM matakuliah WHERE id_mk = ?");
        $statement->execute([$id_mk]);

        $matakuliah = $statement->fetch();
        return $matakuliah;
    }


    public function tampilkanMahasiswa($id_kelas){
        $statement = $this->connection->prepare("select mahasiswa.nama, mahasiswa.nim from mahasiswa_kelas JOIN kelas ON (mahasiswa_kelas.id_kelas = kelas.id_kelas) Join mahasiswa ON (mahasiswa_kelas.id_mahasiswa = mahasiswa.id) where kelas.id_kelas = ?");
        $statement->execute([$id_kelas]);

        $mahasiswa = $statement->fetchAll();
        return $mahasiswa;
    }

}

