<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Matakuliah;
use Klp1\ELearning\Repository\KelolaMataKuliahRepository;

class KelolaMataKuliahService {

    private KelolaMataKuliahRepository $kelolaMataKuliahRepository;
    public function __construct(KelolaMataKuliahRepository $kelolaMataKuliahRepository){

        $this->kelolaMataKuliahRepository = $kelolaMataKuliahRepository;
    }

    public function tambahDataMatakuliah(Matakuliah $matakuliah){
        $this->kelolaMataKuliahRepository->simpan($matakuliah);
    }

    public function editDataMatakuliah(Matakuliah $matakuliah, $id_mk){
        $this->kelolaMataKuliahRepository->editSimpan($matakuliah, $id_mk);
    }

    public function tampilkanMatakuliah(){
        return $this->kelolaMataKuliahRepository->tampilkanMatakuliah();
    }

    public function tampilkanMatakuliahSatu($id_mk){
        return $this->kelolaMataKuliahRepository->tampilkanMatakuliahSatu($id_mk);
    }

    public function hapusMatakuliah($id_mk){
        $this->kelolaMataKuliahRepository->hapus($id_mk);
    }

    public function tampilkanArsipNilai(){
        return $this->kelolaMataKuliahRepository->arsipMataKuliah();
    }

    public function tampilkanMatakuliahDanKelas($nama_dosen){
        return $this->kelolaMataKuliahRepository->tampilkanMatakuliahDanKelas($nama_dosen);
    }

}

