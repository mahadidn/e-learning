<?php

namespace Klp1\ELearning\Repository;


class KelolaPilihKelasMatakuliahRepository{

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpanPilihan($id_kelas, $id_mahasiswa, $nama_mhs): void {
        
        $statement = $this->connection->prepare("INSERT INTO mahasiswa_kelas(id_kelas, id_mahasiswa) VALUES (?, ?)");
        $statement->execute([$id_kelas, $id_mahasiswa]);

        $statement2 = $this->connection->prepare("INSERT INTO nilai (nama_mhs, id_kelas) VALUES (?, ?)");
        $statement2->execute([$nama_mhs, $id_kelas]);

        $statement3 = $this->connection->prepare("INSERT INTO arsip_nilai(nama_mahasiswa, id_kelas) VALUES (?, ?)");
        $statement3->execute([$nama_mhs, $id_kelas]);

    }
 
    public function tampilkanDataKelas(){
        $statement = $this->connection->prepare("SELECT * FROM kelas");
        $statement->execute();
        $kelas = $statement->fetchAll();
        return $kelas;
    }


    // 
    public function tampilkanKelasMahasiswa($id_mahasiswa){
        $statement = $this->connection->prepare("SELECT * from kelas inner join mahasiswa_kelas on (kelas.id_kelas = mahasiswa_kelas.id_kelas) where id_mahasiswa = ?");
        $statement->execute([$id_mahasiswa]);

        $kelas = $statement->fetchAll();
        return $kelas;
    }

    public function tampilkanKelasId($id_kelas){
        $statement = $this->connection->prepare("SELECT * from mahasiswa_kelas join kelas on (kelas.id_kelas = mahasiswa_kelas.id_kelas) join mahasiswa on (mahasiswa_kelas.id_mahasiswa = mahasiswa.id) where kelas.id_kelas = ?");
        $statement->execute([$id_kelas]);

        $kelas = $statement->fetchAll();
        return $kelas;
    }

    public function updateNilai($nama_mk, $id_kelas){
        var_dump($id_kelas);
        $statement = $this->connection->prepare("UPDATE nilai SET nama_mk = ? WHERE id_kelas = ?");
        $statement->execute([$nama_mk, $id_kelas]);
        
        $statement2 = $this->connection->prepare("UPDATE arsip_nilai SET nama_mk = ? WHERE id_kelas = ?");
        $statement2->execute([$nama_mk, $id_kelas]);

    }


}

