<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\TahunAkademik;

class KontrolTahunAkademikRepository {

    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpanTahunAkademik(TahunAkademik $tahunAkademik){
        $statement = $this->connection->prepare("INSERT INTO tahun_akademik(nama_semester, tahun, status) VALUES (?, ?, ?)");
        $statement->execute([$tahunAkademik->nama_semester, $tahunAkademik->tahun, $tahunAkademik->status]);
    
        return $tahunAkademik;
    }


    public function updateTahunAkademik(TahunAkademik $tahunAkademik, string $id_semester){
        $statement = $this->connection->prepare("UPDATE tahun_akademik SET nama_semester = ?, tahun = ?, status = ? WHERE id_semester = ?");
        $statement->execute([$tahunAkademik->nama_semester, $tahunAkademik->tahun, $tahunAkademik->status, $id_semester]);
    }

    public function findIdSemester(string $nama_semester, string $tahun ): TahunAkademik {
        $statement = $this->connection->prepare("select * from tahun_akademik where nama_semester = ? and tahun = ?");
        $statement->execute([$nama_semester, $tahun]);

        try {
            $row = $statement->fetch();
            $tahunAkademik = new TahunAkademik();
            $tahunAkademik->id_semester = $row['id_semester'];
            $tahunAkademik->nama_semester = $row['nama_semester'];
            $tahunAkademik->tahun = $row['tahun'];
            $tahunAkademik->status = $row['status'];

        }finally {
            $statement->closeCursor();
        }

        return $tahunAkademik;
    }

    public function getTahunById(int $id_semester): TahunAkademik{
        $statement = $this->connection->prepare("SELECT * FROM tahun_akademik WHERE id_semester = ?");
        $statement->execute([$id_semester]);
        $row = $statement->fetch();

        $tahunAkademik = new TahunAkademik;
        $tahunAkademik->id_semester = $row['id_semester'];
        $tahunAkademik->nama_semester = $row['nama_semester'];
        $tahunAkademik->tahun = $row['tahun'];
        $tahunAkademik->status = $row['status'];

        return $tahunAkademik;
    }

    public function getTahunAkademik(){
        $statement = $this->connection->prepare("SELECT id_semester, nama_semester, tahun, status FROM tahun_akademik");
        $statement->execute();

        $rowTahunAkademik = $statement->fetchAll();
        
        return $rowTahunAkademik;

    }

    public function hapusData(int $id_semester) {
        $statement = $this->connection->prepare("DELETE FROM tahun_akademik WHERE id_semester = ?");
        $statement->execute([$id_semester]);
    }

}
