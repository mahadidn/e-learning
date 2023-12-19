<?php

namespace Klp1\ELearning\Repository;

class KelolaNilaiKelompokRepository {

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpanTambah($nilai, $id_kinerja_kelompok): void {
        $statement = $this->connection->prepare("UPDATE kinerja_kelompok SET nilai_dosen = ? WHERE id_kinerja_kelompok = ?");
        $statement->execute([$nilai, $id_kinerja_kelompok]);

    }

    public function simpanEdit($nilai, $id_kelompok): void {
        $statement = $this->connection->prepare("UPDATE kinerja_kelompok SET nilai_dosen = ? WHERE id_kelompok = ?");
        $statement->execute([$nilai, $id_kelompok]);
    }

    public function tampilkanDataNilaiKelompok($id_kelas){
        $statement = $this->connection->prepare("SELECT * FROM kinerja_kelompok WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);
        $row = $statement->fetchAll();

        return $row;
    }

    public function simpanHapus($id_kelompok): void {
        $statement = $this->connection->prepare("UPDATE kinerja_kelompok SET nilai_dosen = 0 WHERE id_kelompok = ?");
        $statement->execute([$id_kelompok]);
    }


    //
    public function tampilkanSatuDataNilaiKelompok($id_kelas, $id_kinerja_kelompok){
        $statement = $this->connection->prepare("SELECT * FROM kinerja_kelompok WHERE id_kelas = ? and id_kinerja_kelompok = ?");
        $statement->execute([$id_kelas, $id_kinerja_kelompok]);

        $row = $statement->fetch();
        return $row;
    }


}

