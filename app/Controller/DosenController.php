<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class DosenController {

    private RegisterService $registerService;
    private LoginService $loginService;

    public function __construct(){
        $connection = Database::getConnection();
        $registerRepository = new RegisterRepository($connection);
        $this->registerService = new RegisterService($registerRepository);
        $loginRepository = new LoginRepository($connection);
        $this->loginService = new LoginService($loginRepository);
    }

    public function dashboard(): void{
        $dosen = $this->loginService->current();
        View::render('index', [
            "title" => "Dashboard Dosen",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            
        ]);
    }

    public function registerDosen(): void {
        View::render('registrasiDosen', [
            "title" => "Daftar Akun Dosen"
        ]);
    }

    public function postRegisterDosen(){
        $request = new Register();
        $request->username = $_POST['username'];
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        $request->jenisKelamin = $_POST['jenisKelamin'];
        $request->nidn = $_POST['nidn'];
        $request->jurusan = $_POST['jurusan'];
        $request->namaLengkap = $_POST['nama'];

        try {
            $this->registerService->registerDosen($request);
            View::redirect('/');
        }catch(\Exception $exception){
            View::render('registrasiDosen', [
                "titile" => "Daftar Akun",
                "error" => $exception->getMessage()
            ]);
        }

    }

    public function dataPribadi(){
        $dosen = $this->loginService->current();
        View::render('data-pribadi', [
            "title" => "Data Pribadi Dosen",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    public function editProfil(){
        $dosen = $this->loginService->current();
        View::render('keloladata-pribadi', [
            "title" => "Data Pribadi Dosen",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // kelas dosen
    public function kelasDosen(){
        $dosen = $this->loginService->current();
        View::render('dosen-kelas', [
            "title" => "Kelas Dosen",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // kelas dosen detail
    public function kelasDosenDetail(){
        $dosen = $this->loginService->current();
        View::render('dosen-data-kelas', [
            "title" => "Kelas Dosen Detail",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // kelas dosen kelompok
    public function kelasDosenKelompok(){
        $dosen = $this->loginService->current();
        View::render('dosen-data-kelompok', [
            "title" => "Kelas Dosen Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // tambah dosen kelompok
    public function tambahDosenKelompok(){
        $dosen = $this->loginService->current();
        View::render('form-kelompok', [
            "title" => "Kelas Dosen Tambah Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // nilai mk
    public function nilaimk(){
        $dosen = $this->loginService->current();
        View::render('dosen-data-nilai-mk', [
            "title" => "Kelas Dosen Nilai Matakuliah",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // tambah nilai mk
    public function tambahNilaimk(){
        $dosen = $this->loginService->current();
        View::render('form-nilai-mk', [
            "title" => "Kelas Dosen Tambah Nilai Matakuliah",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // nilai kelompok
    public function nilaiKelompok(){
        $dosen = $this->loginService->current();
        View::render('dosen-data-nilai-kelompok', [
            "title" => "Kelas Dosen Nilai Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // tambah nilai kelompok
    public function tambahNilaiKelompok(){
        $dosen = $this->loginService->current();
        View::render('form-nilai-kelompok', [
            "title" => "Kelas Dosen Nilai Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    // kriteria nilai
    public function kriteriaNilai(){
        $dosen = $this->loginService->current();
        View::render('form-kriteria-penilaian', [
            "title" => "Kelas Dosen Kriteria Penilaian",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }

    public function nilaiAkhir(){
        $dosen = $this->loginService->current();
        View::render('dosen-nilai-akhir', [
            "title" => "Kelas Dosen Nilai Akhir",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan
        ]);
    }


    public function logout(){
        $this->loginService->destroy();
        View::redirect("/");
    }

}
