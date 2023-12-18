<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Model\Domain\Kelompok;
use Klp1\ELearning\Repository\KelolaKelompokRepository;

class KelolaKelompokService {

    private KelolaKelompokRepository $kelolaKelompokRepository;

    public function __construct(KelolaKelompokRepository $kelolaKelompokRepository){
        $this->kelolaKelompokRepository = $kelolaKelompokRepository;
    }
    
    public function tambahDataKelompok(Kelompok $kelompok, $anggota, $id_kelas){

        $row = $this->kelolaKelompokRepository->simpanTambah($kelompok, $id_kelas);
        $id_kelompok = (int)$row[0]['id_kelompok'];

        $this->kelolaKelompokRepository->simpanKelompokMahasiswa($anggota, $id_kelompok, $id_kelas);

    }

    public function tampilkanDataKelompok($id_kelas){
        return $this->kelolaKelompokRepository->tampilkanDataKelompok($id_kelas);
    }

    public function hapusDataKelompok($id_kelas, $hapusKelas, $id_kelompok){
        $this->kelolaKelompokRepository->simpanHapus($id_kelompok, $hapusKelas, $id_kelas);
    }

}
