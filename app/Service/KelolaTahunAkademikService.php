<?php

namespace Klp1\ELearning\Service;

use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\TahunAkademik;
use Klp1\ELearning\Repository\KelolaTahunAkademikRepository;

class KelolaTahunAkademikService {

    private KelolaTahunAkademikRepository $kontrolTahunAkademikRepository;
    
    public function __construct(KelolaTahunAkademikRepository $kontrolTahunAkademikRepository){
        $this->kontrolTahunAkademikRepository = $kontrolTahunAkademikRepository;
    }

    public function tambahTahunAkademik(TahunAkademik $tahunAkademik){
        try {
            Database::beginTransaction();
            
            $tambahTahunAkademik = new TahunAkademik();
            $tambahTahunAkademik->nama_semester = $tahunAkademik->nama_semester;
            $tambahTahunAkademik->tahun = $tahunAkademik->tahun;
            $tambahTahunAkademik->status = $tahunAkademik->status;

            $this->kontrolTahunAkademikRepository->simpanTambah($tambahTahunAkademik);
            Database::commitTransaction();
        }catch (\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    public function editDataTahunAkademik(TahunAkademik $tahunAkademik, int $id_semester){
        try {
            Database::beginTransaction();

            $editTahunAkademik = new TahunAkademik;
            $editTahunAkademik->nama_semester = $tahunAkademik->nama_semester;
            $editTahunAkademik->tahun = $tahunAkademik->tahun;
            $editTahunAkademik->status = $tahunAkademik->status;

            $this->kontrolTahunAkademikRepository->simpanEdit($editTahunAkademik, $id_semester);
            Database::commitTransaction();
        }catch (\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    public function tampilkanTahunAkademik(){

        $tahunAkademik = $this->kontrolTahunAkademikRepository->getTahunAkademik();

        return $tahunAkademik;
    }

    public function getIdSemester(string $nama_semester, string $tahun){
        $tahunAkademik = new TahunAkademik();
        var_dump($nama_semester, $tahun);
        $tahunAkademik = $this->kontrolTahunAkademikRepository->findIdSemester($nama_semester, $tahun);
        
        return $tahunAkademik;
    }

    public function getSemesterById($id_semester){
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik = $this->kontrolTahunAkademikRepository->getTahunById($id_semester);

        return $tahunAkademik;
    }

    public function hapusDataTahunAkademik($id_semester){

        $this->kontrolTahunAkademikRepository->hapusData($id_semester);
    }


}

