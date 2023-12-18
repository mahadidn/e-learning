<?php

namespace Klp1\ELearning\Repository;


class KelolaPilihKelasMatakuliahRepository{

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpanPilihan($id_kelas, $id_mahasiswa): void {
        
        $statement = $this->connection->prepare("INSERT INTO mahasiswa_kelas(id_kelas, id_mahasiswa) VALUES (?, ?)");
        $statement->execute([$id_kelas, $id_mahasiswa]);

    }
 
    public function tampilkanDataKelas(){
        $statement = $this->connection->prepare("SELECT * FROM kelas");
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }


    // 
    public function tampilkanKelasMahasiswa($id_mahasiswa){
        $statement = $this->connection->prepare("SELECT * from kelas inner join mahasiswa_kelas on (kelas.id_kelas = mahasiswa_kelas.id_kelas) where id_mahasiswa = ?");
        $statement->execute([$id_mahasiswa]);

        $row = $statement->fetchAll();
        return $row;
    }

    public function tampilkanKelasId($id_kelas){
        $statement = $this->connection->prepare("SELECT * from mahasiswa_kelas join kelas on (kelas.id_kelas = mahasiswa_kelas.id_kelas) join mahasiswa on (mahasiswa_kelas.id_mahasiswa = mahasiswa.id) where kelas.id_kelas = ?");
        $statement->execute([$id_kelas]);

        $row = $statement->fetchAll();
        return $row;
    }


}

