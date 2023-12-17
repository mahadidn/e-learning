<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Prodi;
use Klp1\ELearning\Repository\KelolaDataProdiRepository;

class KelolaDataProdiService {

    private KelolaDataProdiRepository $kelolaDataProdiRepository;
    public function __construct(KelolaDataProdiRepository $kelolaDataProdiRepository){
        $this->kelolaDataProdiRepository = $kelolaDataProdiRepository;
    }

    public function tambahDataProdi(Prodi $prodi){
        $this->kelolaDataProdiRepository->simpanTambah($prodi);
    }

    public function editDataProdi(Prodi $prodi, $id_prodi){
        $this->kelolaDataProdiRepository->simpanEdit($prodi, $id_prodi);
    }

    // hapus prodi
    public function hapusDataProdi($id_prodi){
        $this->kelolaDataProdiRepository->hapusDataProdi($id_prodi);
    }


    // get all prodi
    public function tampilkanDataProdi(){
        return $this->kelolaDataProdiRepository->tampilkanDataProdi();
    }

    // get satu prodi
    public function tampilkanSatuProdi($id_prodi){
        return $this->kelolaDataProdiRepository->tampilkanSatuProdi($id_prodi);
    }

}

