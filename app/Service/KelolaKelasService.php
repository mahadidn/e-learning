<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Kelas;
use Klp1\ELearning\Repository\KelolaKelasRepository;

class KelolaKelasService {

    private KelolaKelasRepository $kelolaKelasRepository;
    public function __construct(KelolaKelasRepository $kelolaKelasRepository){
        $this->kelolaKelasRepository = $kelolaKelasRepository;
    }

    public function getAllDosen(){
        $dosen = $this->kelolaKelasRepository->tampilkanDosen();

        return $dosen;
    }

    public function tambahDataKelas(Kelas $kelas){
        $this->kelolaKelasRepository->simpan($kelas);
    }

    // edit kelas
    public function editKelas(Kelas $kelas, $id_kelas){
        $this->kelolaKelasRepository->editKelas($kelas, $id_kelas);
    }

    // hapus kelas
    public function hapusKelas($id_kelas){
        $this->kelolaKelasRepository->hapus($id_kelas);
    }


    // get data kelas
    public function getDataKelas(){
        return $this->kelolaKelasRepository->getDataKelas();
    }

    // get satu kelas
    public function getSatuKelas($id_kelas){
        return $this->kelolaKelasRepository->getSatuKelas($id_kelas);
    }

}

