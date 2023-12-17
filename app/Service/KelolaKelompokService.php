<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Kelompok;
use Klp1\ELearning\Repository\KelolaKelompokRepository;

class KelolaKelompokService {

    private KelolaKelompokRepository $kelolaKelompokRepository;

    public function __construct(KelolaKelompokRepository $kelolaKelompokRepository){
        $this->kelolaKelompokRepository = $kelolaKelompokRepository;
    }
    
    public function tambahDataKelompok(Kelompok $kelompok, $anggota){

        $row = $this->kelolaKelompokRepository->simpanTambah($kelompok);
        $id_kelompok = (int)$row[0]['id_kelompok'];


        $this->kelolaKelompokRepository->simpanKelompokMahasiswa($anggota, $id_kelompok);

    }

    public function tampilkanDataKelompok(){
        return $this->kelolaKelompokRepository->tampilkanDataKelompok();
    }

    public function hapusDataKelompok($hapusKelas, $id_kelompok){
        $this->kelolaKelompokRepository->simpanHapus($hapusKelas, $id_kelompok);
    }

}
