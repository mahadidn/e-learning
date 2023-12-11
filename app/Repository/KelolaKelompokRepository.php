<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Kelompok;

class KelolaKelompokRepository {

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }


    public function SimpanKelompok(Kelompok $kelompok){
       $statement = $this->connection->prepare("INSERT INTO kelompok (nama_kelompok, jumlah_anggota) VALUES (?, ?)");
       $statement->execute([$kelompok->nama_kelompok, $kelompok->jumlah_anggota]);
        
       $statement2 = $this->connection->prepare("SELECT * FROM kelompok WHERE nama_kelompok = ?");
       $statement2->execute([$kelompok->nama_kelompok]);
       $row = $statement2->fetchAll();
    
       return $row;
    }

    public function simpanKelompokMahasiswa(array $anggota, int $id_kelompok){

        for ($i = 0; $i <= count($anggota); $i++) {

            $statement = $this->connection->prepare("INSERT INTO kelompok_mahasiswa(id_kelompok, nama_anggota) VALUES (?, ?)");
            $statement->execute([$id_kelompok, $anggota[0][$i]]);
        }

    }

    public function hapusKelompok($hapusKelas, $id_kelompok){
        $statement = $this->connection->prepare("DELETE FROM kelompok_mahasiswa WHERE id = ?");
        $statement->execute([$hapusKelas]);

        $statement = $this->connection->prepare("SELECT * FROM kelompok WHERE id_kelompok = ?");
        $statement->execute([$id_kelompok]);
        $row = $statement->fetchAll();

        $jumlah_anggota = (int)$row[0]['jumlah_anggota'] - 1;

        if ($jumlah_anggota == 0){
            $statement = $this->connection->prepare("DELETE FROM kelompok WHERE id_kelompok = ?");
            $statement->execute([$id_kelompok]);
        }else {
            $statement = $this->connection->prepare("UPDATE kelompok SET jumlah_anggota = ? WHERE id_kelompok = ?");
            $statement->execute([$jumlah_anggota, $id_kelompok]);
        }


    }

    public function tampilkanSemuaKelompok(){
        $statement = $this->connection->prepare("select nama_kelompok, jumlah_anggota, nama_anggota, kelompok_mahasiswa.id ,kelompok_mahasiswa.id_kelompok from kelompok JOIN kelompok_mahasiswa ON (kelompok.id_kelompok = kelompok_mahasiswa.id_kelompok) ORDER BY nama_kelompok ASC");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;
    }


}
