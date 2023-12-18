<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Kelompok;

class KelolaKelompokRepository {

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }


    public function simpanTambah(Kelompok $kelompok, $id_kelas){
       $statement = $this->connection->prepare("INSERT INTO kelompok (nama_kelompok, jumlah_anggota, id_kelas) VALUES (?, ?, ?)");
       $statement->execute([$kelompok->nama_kelompok, $kelompok->jumlah_anggota, $id_kelas]);
       
       $statement2 = $this->connection->prepare("SELECT * FROM kelompok WHERE nama_kelompok = ? and id_kelas = ?");
       $statement2->execute([$kelompok->nama_kelompok, $id_kelas]);
       $row = $statement2->fetchAll();
       
       $statement3 = $this->connection->prepare("SELECT nama_anggota, kelompok.id_kelompok as id_kelompok, kelompok.nama_kelompok as nama_kelompok, kelompok.jumlah_anggota as jumlah_kelompok FROM kelompok join kelompok_mahasiswa on (kelompok.id_kelompok = kelompok_mahasiswa.id_kelompok) WHERE kelompok.nama_kelompok = ? and kelompok.id_kelas = ?");
       $statement3->execute([$kelompok->nama_kelompok, $id_kelas]);
       $row3 = $statement3->fetchAll();


       
       return $row;
    }

    public function tampilkanDataKelompok($id_kelas){
        $statement = $this->connection->prepare("SELECT nama_kelompok, jumlah_anggota, nama_anggota, kelompok_mahasiswa.id ,kelompok_mahasiswa.id_kelompok from kelompok JOIN kelompok_mahasiswa ON (kelompok.id_kelompok = kelompok_mahasiswa.id_kelompok) WHERE kelompok.id_kelas = ?");
        $statement->execute([$id_kelas]);

        $row = $statement->fetchAll();
        return $row;
    }
    
    public function simpanHapus($id_kelompok, $hapusKelas, $id_kelas){
        $statement = $this->connection->prepare("DELETE FROM kelompok_mahasiswa WHERE id = ? and id_kelas = ?");
        $statement->execute([$hapusKelas, $id_kelas]);

        
        $statement = $this->connection->prepare("SELECT * FROM kelompok WHERE id_kelompok = ? and id_kelas = ?");
        $statement->execute([$id_kelompok, $id_kelas]);
        $row = $statement->fetchAll();
        
        $jumlah_anggota = (int)$row[0]['jumlah_anggota'] - 1;
        
        if ($jumlah_anggota == 0){
            $statement = $this->connection->prepare("DELETE FROM kelompok WHERE id_kelompok = ? and id_kelas = ?");
            $statement->execute([$id_kelompok, $id_kelas]);
            
            $statementKinerja = $this->connection->prepare("DELETE FROM kinerja_kelompok WHERE id_kelompok = ? and id_kelas = ?");
            $statementKinerja->execute([$id_kelompok, $id_kelas]);
        }else {
            $statement = $this->connection->prepare("UPDATE kelompok SET jumlah_anggota = ? WHERE id_kelompok = ? and id_kelas = ?");
            $statement->execute([$jumlah_anggota, $id_kelompok, $id_kelas]);
        }

    }

    // 
    public function simpanKelompokMahasiswa(array $anggota, int $id_kelompok, $id_kelas){

        for ($i = 0; $i <= count($anggota); $i++) {

            $statement = $this->connection->prepare("INSERT INTO kelompok_mahasiswa(id_kelompok, nama_anggota, id_kelas) VALUES (?, ?, ?)");
            $statement->execute([$id_kelompok, $anggota[0][$i], $id_kelas]);

            $statementKinerja = $this->connection->prepare("INSERT INTO kinerja_kelompok (id_kelompok, nama_mahasiswa, id_kelas) VALUES(?, ?, ?)");
            $statementKinerja->execute([$id_kelompok, $anggota[0][$i], $id_kelas]);

        }

    }


    


}
