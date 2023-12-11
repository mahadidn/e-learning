<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Mahasiswa;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\KelolaDataPribadiRepository;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\KelolaDataPribadiService;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class MahasiswaController {

    private RegisterService $registerService;
    private LoginService $loginService;
    private KelolaDataPribadiService $kelolaDataPribadiService;

    public function __construct(){
        $connection = Database::getConnection();
        // repo
        $registerRepository = new RegisterRepository($connection);
        $loginRepository = new LoginRepository($connection);
        $kelolaDataPribadiRepository = new KelolaDataPribadiRepository($connection);

        // service
        $this->registerService = new RegisterService($registerRepository);
        $this->loginService = new LoginService($loginRepository);
        $this->kelolaDataPribadiService = new KelolaDataPribadiService($kelolaDataPribadiRepository, $loginRepository, $this->loginService);
    }

    public function beranda(): void{
        $mahasiswa = $this->loginService->current();
        View::render('index', [
            "title" => "Dashboard Mahasiswa",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin

        ]);
    }

    // register
    public function registerMahasiswa(): void {
        View::render('registrasiMahasiswa', [
            "title" => "Daftar Akun Mahasiswa"
        ]);
    }

    public function postRegisterMahasiswa(){
        $request = new Register();
        $request->username = $_POST['username'];
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        $request->jenisKelamin = $_POST['jenisKelamin'];
        $request->nim = $_POST['nim'];
        $request->jurusan = $_POST['jurusan'];
        $request->namaLengkap = $_POST['nama'];

        try {
            $this->registerService->registerMahasiswa($request);
            View::redirect('/');
        }catch(\Exception $exception){
            View::render('registrasiMahasiswa', [
                "titile" => "Daftar Akun",
                "error" => $exception->getMessage()
            ]);
        }

    }

    // kelola data pribadi
    public function menuDataPribadi(){
        $mahasiswa = $this->loginService->current();
        View::render('data-pribadi', [
            "title" => "Data Pribadi Mahasiswa",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin
        ]);
    }

    public function postMenuDataPribadi(){
        $request = new Mahasiswa();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->nama = $_POST['nama'];
        $request->email = $_POST['email'];
        $request->prodi = $_POST['prodi'];
        $request->jenisKelamin = $_POST['jenis_kelamin'];
        $request->nim = $_POST['nim'];

        try {
            $this->kelolaDataPribadiService->ubahDataMahasiswa($request);
            View::redirect('/data/mahasiswa');
        }catch (\Exception $e){
            $mahasiswa = $this->loginService->current();
            View::render('keloladata-pribadi', [
                "title" => "Data Pribadi Mahasiswa",
                'usertype' => $mahasiswa->userType,
                'username' => $mahasiswa->username,
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'email' => $mahasiswa->email,
                'prodi' => $mahasiswa->prodi,
                'jenis_kelamin' => $mahasiswa->jenisKelamin,
                'error' => $e->getMessage()
            ]);
        }

    }

    // edit data pribadi
     public function editProfil(){
        $mahasiswa = $this->loginService->current();
        View::render('keloladata-pribadi', [
            "title" => "Data Pribadi Mahasiswa",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin
        ]);
    }

    // kelas Mahasiswa
    public function kelasMahasiswa(){
        $mahasiswa = $this->loginService->current();
        View::render('mahasiswa-kelas', [
            "title" => "Kelas Mahasiswa",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin
        ]);
    }

    // detail kelas mahasiswa
    public function detailKelasMahasiswa(){
        $mahasiswa = $this->loginService->current();
        View::render('mahasiswa-data-kelas', [
            "title" => "Detail Kelas Mahasiswa",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin
        ]);
    }

    // lihat nilai akhir
    public function nilaiAkhir(){
        $mahasiswa = $this->loginService->current();
        View::render('mahasiswa-nilai-akhir', [
            "title" => "Kelas Mahasiswa Nilai Akhir",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin
        ]);
    }

    // penilaian
    public function formPenilaian(){
        $mahasiswa = $this->loginService->current();
        View::render('form-penilaian-kinerja', [
            "title" => "Kelas Mahasiswa Penilaian",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin
        ]);
    }

    //hasil penilaian
    public function dataPenilaian(){
        $mahasiswa = $this->loginService->current();
        View::render('mahasiswa-penilaian-kinerja', [
            "title" => "Data Penilaian Kinerja",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin
        ]);
    }

    public function logout(){
        $this->loginService->destroy();
        View::redirect("/");
    }



}

