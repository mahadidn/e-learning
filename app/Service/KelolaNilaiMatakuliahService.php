<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Repository\KelolaNilaiMatakuliahRepository;

class KelolaNilaiMatakuliahService {

    private KelolaNilaiMatakuliahRepository $kelolaNilaiMatakuliahRepository;
    public function __construct(KelolaNilaiMatakuliahRepository $kelolaNilaiMatakuliahRepository){
        $this->kelolaNilaiMatakuliahRepository = $kelolaNilaiMatakuliahRepository;
    }

    public function tambahDataNilai($nilai_tugas, $nilai_uts, $nilai_uas, $id_kelas, $id_nilai): void {
        $this->kelolaNilaiMatakuliahRepository->simpanTambah($nilai_tugas, $nilai_uts, $nilai_uas, $id_kelas, $id_nilai);
    }

    public function tampilkanDataNilaiMatakuliah($id_kelas){
        return $this->kelolaNilaiMatakuliahRepository->tampilkanDataNilaiMatakuliah($id_kelas);
    }

    public function editDataNilai($nilai_tugas, $nilai_uts, $nilai_uas, $id_kelas, $id_nilai): void {
        $this->kelolaNilaiMatakuliahRepository->simpanEdit($nilai_tugas, $nilai_uts, $nilai_uas, $id_kelas, $id_nilai);
    }

    public function hapusDataNilai($id_nilai): void {
        $this->kelolaNilaiMatakuliahRepository->simpanHapus($id_nilai);
    }


    // 
    public function tampilkanSatuDataMatakuliah($id_kelas, $id_nilai){
        return $this->kelolaNilaiMatakuliahRepository->tampilkanSatuDataMatakuliah($id_kelas, $id_nilai);
    }
}

