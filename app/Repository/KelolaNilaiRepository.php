<?php

namespace Klp1\ELearning\Repository;

class KelolaNilaiRepository {

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function perbaruiNilai($id_arsip): void {
        $statement = $this->connection->prepare("DELETE FROM arsip_nilai WHERE id_arsip = ?");
        $statement->execute([$id_arsip]);

    }

    public function tampilkanArsipNilaiMatakuliah($nama_mk) {
        $statement = $this->connection->prepare("SELECT nama_mahasiswa, id_arsip, nim, nilai_mk, nama_mk ,id_kelas from arsip_nilai join mahasiswa where (arsip_nilai.nama_mahasiswa = mahasiswa.nama && arsip_nilai.nama_mk = ?)");
        $statement->execute([$nama_mk]);

        $arsipMatakuliah = $statement->fetchAll();
        return $arsipMatakuliah;
    }

    // 
    public function tampilkanMatakuliah($id_mk){
        $statement = $this->connection->prepare("SELECT nama_mk from matakuliah where id_mk = ?");
        $statement->execute([$id_mk]);

        $matakuliah = $statement->fetch();
        return $matakuliah;
    }

    public function updateNilai($nilai_mk, $nama_mhs, $id_kelas){
        $statement = $this->connection->prepare("UPDATE arsip_nilai set nilai_mk = ? where nama_mahasiswa = ? and id_kelas = ?");
        $statement->execute([$nilai_mk, $nama_mhs, $id_kelas]);
    }

}

