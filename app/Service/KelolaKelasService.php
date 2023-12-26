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

    // admin
    // tambah data kelas
    public function tambahDataKelas(Kelas $kelas){
        $this->kelolaKelasRepository->simpanTambah($kelas);
    }

    // tampilkan data kelas
    public function tampilkanDataKelas(){
        return $this->kelolaKelasRepository->tampilkanDataKelas();
    }

    // edit kelas
    public function editDataKelas(Kelas $kelas, $id_kelas){
        $this->kelolaKelasRepository->simpanEdit($kelas, $id_kelas);
    }

    // hapus kelas
    public function hapusDataKelas($id_kelas){
        $this->kelolaKelasRepository->hapusData($id_kelas);
    }

    // mahasiswa
    // lihat nilai akhir
    public function ambilDataNilai($id_kelas, $nama_mhs){
        return $this->kelolaKelasRepository->ambilDataNilai($id_kelas, $nama_mhs);
    }


    
    // 
    // tampilkan satu kelas
    public function tampilkanSatuKelas($id_kelas){
        return $this->kelolaKelasRepository->tampilkanSatuKelas($id_kelas);
    }

    public function tampilkanSemuaDosen(){
        $dosen = $this->kelolaKelasRepository->tampilkanDosen();

        return $dosen;
    }

}

