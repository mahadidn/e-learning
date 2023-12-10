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

    public function tambahTahun(TahunAkademik $tahunAkademik): TahunAkademik{
        try {
            Database::beginTransaction();
            
            $tambahTahunAkademik = new TahunAkademik();
            $tambahTahunAkademik->nama_semester = $tahunAkademik->nama_semester;
            $tambahTahunAkademik->tahun = $tahunAkademik->tahun;
            $tambahTahunAkademik->status = $tahunAkademik->status;

            $this->kontrolTahunAkademikRepository->simpanTahunAkademik($tambahTahunAkademik);
            Database::commitTransaction();
            return $tambahTahunAkademik;
        }catch (\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    public function editTahun(TahunAkademik $tahunAkademik, int $id_semester): TahunAkademik {
        try {
            Database::beginTransaction();

            $editTahunAkademik = new TahunAkademik;
            $editTahunAkademik->nama_semester = $tahunAkademik->nama_semester;
            $editTahunAkademik->tahun = $tahunAkademik->tahun;
            $editTahunAkademik->status = $tahunAkademik->status;

            $this->kontrolTahunAkademikRepository->updateTahunAkademik($editTahunAkademik, $id_semester);
            Database::commitTransaction();
            return $editTahunAkademik;
        }catch (\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    public function getTahunAkademik(){

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

    public function hapusSemester($id_semester){

        $this->kontrolTahunAkademikRepository->hapusData($id_semester);
    }


}

