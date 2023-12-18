<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Repository\KelolaPenilaianRepository;

class KelolaPenilaianService {

    private KelolaPenilaianRepository $kelolaPenilaianRepository;
    public function __construct(KelolaPenilaianRepository $kelolaPenilaianRepository){
        $this->kelolaPenilaianRepository = $kelolaPenilaianRepository;
    }

    public function isiFormPenilaian($nilai_kriteria1, $nilai_kriteria2, $id_kinerja_kelompok, $id_kelas): void {
        // $this->validasi();
        $this->kelolaPenilaianRepository->simpanData($nilai_kriteria1, $nilai_kriteria2, $id_kinerja_kelompok, $id_kelas);

    }
    
    // private function validasi(): void {
        
    // }

    public function tampilkanPenilaianTersimpan($id_kelompok, $id_kelas){
        return $this->kelolaPenilaianRepository->tampilkanPenilaianTersimpan($id_kelompok, $id_kelas);
    }



    // 
    public function kelompokMhs($nama_mhs, $id_kelas){
        $statement = $this->kelolaPenilaianRepository->kelompokMhs($nama_mhs, $id_kelas);
        return $statement['id_kelompok'];
    }

    public function tampilkanPenilaianKinerja($id_kelompok, $id_kelas){
        return $this->kelolaPenilaianRepository->tampilkanPenilaianKinerja($id_kelompok, $id_kelas);
    }

    public function tampilkanEditKinerja($id_kinerja_kelompok, $id_kelas){
        return $this->kelolaPenilaianRepository->tampilkanEditKinerja($id_kinerja_kelompok, $id_kelas) ;
    }

}

