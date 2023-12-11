<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Prodi;
use Klp1\ELearning\Repository\KelolaDataProdiRepository;

class KelolaDataProdiService {

    private KelolaDataProdiRepository $kelolaDataProdiRepository;
    public function __construct(KelolaDataProdiRepository $kelolaDataProdiRepository){
        $this->kelolaDataProdiRepository = $kelolaDataProdiRepository;
    }

    public function tambahData(Prodi $prodi){
        $this->kelolaDataProdiRepository->tambahData($prodi);
    }

    public function editProdi(Prodi $prodi, $id_prodi){
        $this->kelolaDataProdiRepository->editProdi($prodi, $id_prodi);
    }

    // hapus prodi
    public function hapusProdi($id_prodi){
        $this->kelolaDataProdiRepository->hapusProdi($id_prodi);
    }


    // get all prodi
    public function getAllProdi(){
        return $this->kelolaDataProdiRepository->getAllProdi();
    }

    // get satu prodi
    public function getSatuProdi($id_prodi){
        return $this->kelolaDataProdiRepository->getSatuProdi($id_prodi);
    }

}

