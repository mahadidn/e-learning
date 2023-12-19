<?php

namespace Klp1\ELearning\Repository;

class KelolaNilaiMatakuliahRepository {

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpanTambah($nilai_tugas = 0, $nilai_uts = 0, $nilai_uas = 0, $id_kelas, $id_nilai): void {
        $statement = $this->connection->prepare("UPDATE nilai SET nilai_tugas = ?, nilai_uts = ?, nilai_uas = ? WHERE id_kelas = ? and id_nilai = ?");
        $statement->execute([$nilai_tugas, $nilai_uts, $nilai_uas ,$id_kelas, $id_nilai]);
    }

    public function simpanEdit($nilai_tugas = 0, $nilai_uts = 0, $nilai_uas = 0, $id_kelas, $id_nilai): void {
        $statement = $this->connection->prepare("UPDATE nilai SET nilai_tugas = ?, nilai_uts = ?, nilai_uas = ? WHERE id_kelas = ? and id_nilai = ?");
        $statement->execute([$nilai_tugas, $nilai_uts, $nilai_uas ,$id_kelas, $id_nilai]);
    }

    public function simpanHapus($id_nilai): void {
        $statement = $this->connection->prepare("UPDATE nilai SET nilai_tugas = 0, nilai_uts = 0, nilai_uas = 0 WHERE id_nilai = ?");
        $statement->execute([$id_nilai]);
    }

    public function tampilkanDataNilaiMatakuliah($id_kelas){
        $statement = $this->connection->prepare("SELECT * FROM nilai WHERE id_kelas = ?");
        $statement->execute([$id_kelas]);

        $row = $statement->fetchAll();
        return $row;
    }

    // 
    public function tampilkanSatuDataMatakuliah($id_kelas, $id_nilai){
        $statement = $this->connection->prepare("SELECT * FROM nilai WHERE id_kelas = ? and id_nilai = ?");
        $statement->execute([$id_kelas, $id_nilai]);

        $row = $statement->fetch();
        return $row;
    }

}

