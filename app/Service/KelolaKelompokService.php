<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Kelompok;
use Klp1\ELearning\Repository\KelolaKelompokRepository;

class KelolaKelompokService {

    private KelolaKelompokRepository $kelolaKelompokRepository;

    public function __construct(KelolaKelompokRepository $kelolaKelompokRepository){
        $this->kelolaKelompokRepository = $kelolaKelompokRepository;
    }
    
    public function tambahKelompok(Kelompok $kelompok, $anggota){

        $row = $this->kelolaKelompokRepository->SimpanKelompok($kelompok);
        $id_kelompok = (int)$row[0]['id_kelompok'];


        $this->kelolaKelompokRepository->simpanKelompokMahasiswa($anggota, $id_kelompok);

    }

    public function tampilkanSemuaKelompok(){
        return $this->kelolaKelompokRepository->tampilkanSemuaKelompok();
    }

    public function hapusKelompok($hapusKelas, $id_kelompok){
        $this->kelolaKelompokRepository->hapusKelompok($hapusKelas, $id_kelompok);
    }

}
