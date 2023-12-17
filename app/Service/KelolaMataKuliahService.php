<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Matakuliah;
use Klp1\ELearning\Repository\KelolaMataKuliahRepository;

class KelolaMataKuliahService {

    private KelolaMataKuliahRepository $kelolaMataKuliahRepository;
    public function __construct(KelolaMataKuliahRepository $kelolaMataKuliahRepository){

        $this->kelolaMataKuliahRepository = $kelolaMataKuliahRepository;
    }

    // admin
    public function tambahDataMatakuliah(Matakuliah $matakuliah){
        $this->kelolaMataKuliahRepository->simpanTambah($matakuliah);
    }

    public function editDataMatakuliah(Matakuliah $matakuliah, $id_mk){
        $this->kelolaMataKuliahRepository->simpanEdit($matakuliah, $id_mk);
    }

    public function tampilkanDataMatakuliah(){
        return $this->kelolaMataKuliahRepository->tampilkanDataMatakuliah();
    }

    
    public function hapusDataMatakuliah($id_mk){
        $this->kelolaMataKuliahRepository->hapusData($id_mk);
    }

    // dosen
    public function tampilkanMatakuliahDanKelas($nama_dosen){
        return $this->kelolaMataKuliahRepository->tampilkanMatakuliahDanKelas($nama_dosen);
    }


    public function tampilkanMatakuliahDanKelasIDKelas($id_kelas){
        return $this->kelolaMataKuliahRepository->tampilkanMatakuliahDanKelasIDKelas($id_kelas);
    }

    // 
    public function tampilkanMatakuliahSatu($id_mk){
        return $this->kelolaMataKuliahRepository->tampilkanMatakuliahSatu($id_mk);
    }

    public function tampilkanMahasiswa($id_kelas){
        return $this->kelolaMataKuliahRepository->tampilkanMahasiswa($id_kelas);
    }

}

