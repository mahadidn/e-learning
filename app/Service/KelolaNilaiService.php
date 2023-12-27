<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Repository\KelolaNilaiRepository;

class KelolaNilaiService {

    private KelolaNilaiRepository $kelolaNilaiRepository;
    public function __construct(KelolaNilaiRepository $kelolaNilaiRepository){
        $this->kelolaNilaiRepository = $kelolaNilaiRepository;
    }

    public function hapusNilai($id_arsip){
        $this->kelolaNilaiRepository->perbaruiNilai($id_arsip);
    }

    public function tampilkanArsipNilaiMatakuliah($nama_mk){
        return $this->kelolaNilaiRepository->tampilkanArsipNilaiMatakuliah($nama_mk);
    }

    // 
    public function tampilkanMatakuliah($id_mk){
        $matakuliah = $this->kelolaNilaiRepository->tampilkanMatakuliah($id_mk)[0];
        return $matakuliah;
    }

    public function updateNilai($nilai_mk, $nama_mhs, $id_kelas){
        $this->kelolaNilaiRepository->updateNilai($nilai_mk, $nama_mhs, $id_kelas);
    }


}
