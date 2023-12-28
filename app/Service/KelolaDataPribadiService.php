<?php

namespace Klp1\ELearning\Service;

use Exception;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Mahasiswa;
use Klp1\ELearning\Repository\KelolaDataPribadiRepository;
use Klp1\ELearning\Repository\LoginRepository;

class KelolaDataPribadiService {

    private KelolaDataPribadiRepository $kelolaDataPribadiRepository;
    private LoginRepository $loginRepository;
    private LoginService $loginService;

    public function __construct(KelolaDataPribadiRepository $kelolaDataPribadiRepository, LoginRepository $loginRepository, LoginService $loginService){
        $this->kelolaDataPribadiRepository = $kelolaDataPribadiRepository;
        $this->loginRepository = $loginRepository;
        $this->loginService = $loginService;
    }

    public function ubahDataMahasiswa(Mahasiswa $mahasiswa): Mahasiswa{
        try {
            Database::beginTransaction();

            $mhs = $this->loginService->current();

            $updateMahasiswa = new Mahasiswa();
            $updateMahasiswa->username = $mahasiswa->username;
            $updateMahasiswa->password = password_hash($mahasiswa->password, PASSWORD_BCRYPT);
            $updateMahasiswa->nama = $mahasiswa->nama;
            $updateMahasiswa->email = $mahasiswa->email;
            $updateMahasiswa->prodi = $mahasiswa->prodi;
            $updateMahasiswa->jenisKelamin = $mahasiswa->jenisKelamin;
            $updateMahasiswa->nim = $mahasiswa->nim;

            $this->kelolaDataPribadiRepository->simpanEditMahasiswa($updateMahasiswa, $mhs->username);
            Database::commitTransaction();
            return $updateMahasiswa;
        }catch(\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function ubahDataDosen(Dosen $dosen): Dosen{
        try {
            Database::beginTransaction();

            $dsn = $this->loginService->current();

            $updateDosen = new Dosen();
            $updateDosen->username = $dosen->username;
            $updateDosen->password = password_hash($dosen->password, PASSWORD_BCRYPT);
            $updateDosen->name = $dosen->name;
            $updateDosen->email = $dosen->email;
            $updateDosen->jurusan = $dosen->jurusan;
            $updateDosen->jenisKelamin = $dosen->jenisKelamin;
            $updateDosen->nidn = $dosen->nidn;

            $this->kelolaDataPribadiRepository->simpanEditDosen($updateDosen, $dsn->username);
            Database::commitTransaction();
            return $updateDosen;
        }catch(\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function ubahDataAdmin(Admin $admin): Admin {
        try {
            Database::beginTransaction();

            $admn = $this->loginService->current();

            $updateAdmin = new Admin();
            $updateAdmin->username = $admin->username;
            $updateAdmin->password = password_hash($admin->password, PASSWORD_BCRYPT);
            $updateAdmin->email = $admin->email;

            $this->kelolaDataPribadiRepository->simpanEditAdmin($updateAdmin, $admn->username);
            Database::commitTransaction();
            return $updateAdmin;
        }catch(\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function tampilkanDataAdmin($id): Admin {
        return $this->kelolaDataPribadiRepository->tampilkanDataAdmin($id);
    }

    public function tampilkanDataDosen($id): Dosen {
        return $this->kelolaDataPribadiRepository->tampilkanDataDosen($id);
    }

    public function tampilkanDataMahasiswa($id): Mahasiswa {
        return $this->kelolaDataPribadiRepository->tampilkanDataMahasiswa($id);
    }


}
