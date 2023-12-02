<?php 

namespace Klp1\ELearning\Service;

use Exception;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\RegisterRepository;

class RegisterService {

    private RegisterRepository $registerRepository;

    public function __construct(RegisterRepository $registerRepository){
        $this->registerRepository = $registerRepository;
    }

    public function registerMahasiswa(Register $register): Register {

        $this->validateRegisterMhsRequest($register);

        try {
            Database::beginTransaction();
            $user = $this->registerRepository->findByUsername($register->username);
            if ($user != null){
                throw new Exception("Username telah digunakan");
            }

            $newRegister = new Register();
            $newRegister->username = $register->username;
            $newRegister->password = password_hash($register->password, PASSWORD_BCRYPT);
            $newRegister->namaLengkap = $register->namaLengkap;
            $newRegister->email = $register->email;
            $newRegister->jurusan = $register->jurusan;
            $newRegister->nim = $register->nim;
            $newRegister->jenisKelamin = $register->jenisKelamin;

            $this->registerRepository->saveMahasiswa($newRegister);

            Database::commitTransaction();
            return $newRegister;
        }catch(\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }

    }

    private function validateRegisterMhsRequest(Register $register){
        if ($register->username == null || $register->password == null || $register->nim == null || $register->email == null || $register->jenisKelamin == null || $register->namaLengkap == null || $register->jurusan == null
            || trim($register->username) == "" || trim($register->password) == "" || trim($register->nim) == "" || trim($register->email) == "" || trim($register->jenisKelamin) == "" || trim($register->namaLengkap) == "" || trim($register->jurusan) == ""
        ){
            throw new Exception("Form registrasi tidak boleh ada yang kosong");
        }
    }

    public function registerDosen(Register $register): Register {

        $this->validateRegisterDosenRequest($register);

        try {
            Database::beginTransaction();
            $user = $this->registerRepository->findByUsername($register->username);
            if ($user != null){
                throw new Exception("Username telah digunakan");
            }

            $newRegister = new Register();
            $newRegister->username = $register->username;
            $newRegister->password = password_hash($register->password, PASSWORD_BCRYPT);
            $newRegister->namaLengkap = $register->namaLengkap;
            $newRegister->email = $register->email;
            $newRegister->jurusan = $register->jurusan;
            $newRegister->nidn = $register->nidn;
            $newRegister->jenisKelamin = $register->jenisKelamin;

            $this->registerRepository->saveDosen($newRegister);

            Database::commitTransaction();
            return $newRegister;
        }catch(\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }

    }

    private function validateRegisterDosenRequest(Register $register){
        if ($register->username == null || $register->password == null || $register->nidn == null || $register->email == null || $register->jenisKelamin == null || $register->namaLengkap == null || $register->jurusan == null
            || trim($register->username) == "" || trim($register->password) == "" || trim($register->nidn) == "" || trim($register->email) == "" || trim($register->jenisKelamin) == "" || trim($register->namaLengkap) == "" || trim($register->jurusan) == ""
        ){
            throw new Exception("Form registrasi tidak boleh ada yang kosong");
        }
    }

    public function registerAdmin(Admin $registerAdmin): Admin {
        $this->validateRegisterAdmin($registerAdmin);

        try {
            Database::beginTransaction();
            $user = $this->registerRepository->findByUsername($registerAdmin->username);
            if($user != null){
                throw new \Exception ("User telah digunakan!");
            }

            $newAdmin = new Admin();
            $newAdmin->username = $registerAdmin->username;
            $newAdmin->email = $registerAdmin->email;
            $newAdmin->password = password_hash($registerAdmin->password, PASSWORD_BCRYPT);

            $this->registerRepository->saveAdmin($newAdmin);

            Database::commitTransaction();  
            return $newAdmin;
        }catch(\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }
    } 


    public function validateRegisterAdmin(Admin $registerAdmin){
        if ($registerAdmin->username == null || $registerAdmin->password == null || $registerAdmin->email == null
            || trim($registerAdmin->username) == "" || trim($registerAdmin->password) == "" || trim($registerAdmin->email) == ""){
                throw new Exception("Form registrasi tidak boleh ada yang kosong");
            }
    }

}
