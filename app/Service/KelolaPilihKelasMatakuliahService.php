<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Repository\KelolaPilihKelasMatakuliahRepository;

class KelolaPilihKelasMatakuliahService {

    private KelolaPilihKelasMatakuliahRepository $kelolaPilihKelasMatakuliahRepository;
    public function __construct(KelolaPilihKelasMatakuliahRepository $kelolaPilihKelasMatakuliahRepository){
        $this->kelolaPilihKelasMatakuliahRepository = $kelolaPilihKelasMatakuliahRepository;
    }

    public function pilihKelas($id_kelas, $id_mahasiswa, $nama_mhs): void {
        $this->kelolaPilihKelasMatakuliahRepository->simpanPilihan($id_kelas, $id_mahasiswa, $nama_mhs);
    }

    public function tampilkanDataKelas(){
        return $this->kelolaPilihKelasMatakuliahRepository->tampilkanDataKelas();
    }

    // 
    public function tampilkanKelasMahasiswa($id_mahasiswa){
        return $this->kelolaPilihKelasMatakuliahRepository->tampilkanKelasMahasiswa($id_mahasiswa);
    }

    public function tampilkanKelasId($id_kelas){
        return $this->kelolaPilihKelasMatakuliahRepository->tampilkanKelasId($id_kelas);
    }

    public function updateNilai($nama_mk, $id_kelas){
        $this->kelolaPilihKelasMatakuliahRepository->updateNilai($nama_mk, $id_kelas);
    }

}

