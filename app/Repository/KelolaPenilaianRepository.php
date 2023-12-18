<?php

namespace Klp1\ELearning\Repository;

class KelolaPenilaianRepository {

    private \PDO $connection;
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    public function simpanData($nilai_kriteria1, $nilai_kriteria2, $id_kinerja_kelompok, $id_kelas): void {
        $statament = $this->connection->prepare("UPDATE kinerja_kelompok SET nilai_kriteria1 = ?, nilai_kriteria2 = ? WHERE id_kinerja_kelompok = ? and id_kelas = ?");
        $statament->execute([$nilai_kriteria1, $nilai_kriteria2, $id_kinerja_kelompok, $id_kelas]);

    }

    public function tampilkanPenilaianTersimpan($id_kelompok, $id_kelas) {
        $statament = $this->connection->prepare("SELECT * from kelompok join kelompok_mahasiswa on (kelompok.id_kelompok = kelompok_mahasiswa.id_kelompok) where kelompok.id_kelompok = ? and kelompok.id_kelas = ?");
        $statament->execute([$id_kelompok, $id_kelas]);

        $row = $statament->fetchAll();
        return $row;
    }

    
    
    // 
    public function kelompokMhs($nama_mahasiswa, $id_kelas){
        $statament = $this->connection->prepare("SELECT kelompok_mahasiswa.id_kelompok from kelompok_mahasiswa join mahasiswa on (kelompok_mahasiswa.nama_anggota = mahasiswa.nama) where kelompok_mahasiswa.nama_anggota = ? and kelompok_mahasiswa.id_kelas = ?");
        $statament->execute([$nama_mahasiswa, $id_kelas]);
        
        $row = $statament->fetch();
        return $row;
    }
    
    public function tampilkanPenilaianKinerja($id_kelompok, $id_kelas){
        $statament = $this->connection->prepare("select id_kinerja_kelompok, kinerja_kelompok.id_kelompok, kinerja_kelompok.nama_mahasiswa as nama, mahasiswa.nim as nim, nilai_kriteria1, nilai_kriteria2 from kinerja_kelompok join mahasiswa on (kinerja_kelompok.nama_mahasiswa = mahasiswa.nama) where kinerja_kelompok.id_kelompok = ? and kinerja_kelompok.id_kelas = ?");
        $statament->execute([$id_kelompok, $id_kelas]);
        // $statament->execute();

        $row = $statament->fetchAll();
        return $row;
    }

    public function tampilkanEditKinerja($id_kinerja_kelompok, $id_kelas){
        $statament = $this->connection->prepare("SELECT * from kinerja_kelompok WHERE id_kinerja_kelompok = ? and id_kelas = ?");
        $statament->execute([$id_kinerja_kelompok, $id_kelas]);
        $row = $statament->fetch();

        return $row; 
    }

}
