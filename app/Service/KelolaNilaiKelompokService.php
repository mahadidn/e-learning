<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Repository\KelolaNilaiKelompokRepository;

class KelolaNilaiKelompokService {

    private KelolaNilaiKelompokRepository $kelolaNilaiKelompokRepository;
    public function __construct(KelolaNilaiKelompokRepository $kelolaNilaiKelompokRepository){
        $this->kelolaNilaiKelompokRepository = $kelolaNilaiKelompokRepository;
    }

    public function tambahDataNilai($nilai, $id_kelompok): void {
        $this->kelolaNilaiKelompokRepository->simpanTambah($nilai, $id_kelompok);
    }

    public function editDataNilai($nilai, $id_kelompok): void {     
        $this->kelolaNilaiKelompokRepository->simpanEdit($nilai, $id_kelompok);
    }

    public function tampilkanDataNilaiKelompok($id_kelas) {
        return $this->kelolaNilaiKelompokRepository->tampilkanDataNilaiKelompok($id_kelas);

    }

    public function hapusDataNilai($id_kelompok){
        $this->kelolaNilaiKelompokRepository->simpanHapus($id_kelompok);
    }
    
    // 
    public function tampilkanSatuDataNilaiKelompok($id_kelas, $id_kinerja_kelompok){

        return $this->kelolaNilaiKelompokRepository->tampilkanSatuDataNilaiKelompok($id_kelas, $id_kinerja_kelompok);
    }

    public function tambahNilaiAkhir($nilai_kelompok, $nama_mhs, $nama_mk){
        $this->kelolaNilaiKelompokRepository->simpanNilaiAkhir($nilai_kelompok, $nama_mhs, $nama_mk);
    }

}

