<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\KelolaDataPribadiRepository;
use Klp1\ELearning\Repository\KelolaMataKuliahRepository;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\KelolaDataPribadiService;
use Klp1\ELearning\Service\KelolaMataKuliahService;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class DosenController {

    private RegisterService $registerService;
    private LoginService $loginService;
    private KelolaDataPribadiService $kelolaDataPribadiService;
    private KelolaMataKuliahService $kelolaMatakuliahService;

    public function __construct(){
        $connection = Database::getConnection();
        // repo
        $registerRepository = new RegisterRepository($connection);
        $loginRepository = new LoginRepository($connection);
        $kelolaDataPribadiRepository = new KelolaDataPribadiRepository($connection);
        $kelolaMatakuliahRepository = new KelolaMataKuliahRepository($connection);
        
        // service
        $this->registerService = new RegisterService($registerRepository);
        $this->loginService = new LoginService($loginRepository);
        $this->kelolaDataPribadiService = new KelolaDataPribadiService($kelolaDataPribadiRepository, $loginRepository, $this->loginService);
        $this->kelolaMatakuliahService = new KelolaMataKuliahService($kelolaMatakuliahRepository);
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

    // kelola data pribadi
    public function kelolaDataPribadi(){
        $dosen = $this->loginService->current();
        View::render('data-pribadi', [
            "title" => "Data Pribadi Dosen",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
        ]);
    }

    public function postKelolaDataPribadi(){
        $request = new Dosen();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->name = $_POST['nama'];
        $request->email = $_POST['email'];
        $request->jurusan = $_POST['prodi'];
        $request->jenisKelamin = $_POST['jenis_kelamin'];
        $request->nidn = $_POST['nidn'];

        try {
            $this->kelolaDataPribadiService->ubahDataDosen($request);
            View::redirect('/data/dosen');
        }catch (\Exception $e){
            $dosen = $this->loginService->current();
            View::render('keloladata-pribadi', [
                "title" => "Data Pribadi Dosen",
                'usertype' => $dosen->userType,
                'username' => $dosen->username,
                'nidn' => $dosen->nidn,
                'nama' => $dosen->name,
                'jenis_kelamin' => $dosen->jenisKelamin,
                'email' => $dosen->email,
                'prodi' => $dosen->jurusan,
                'error' => $e->getMessage()
            ]);
        }

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
            'prodi' => $dosen->jurusan,
            'password' => $dosen->password
        ]);
    }

    // kelas dosen
    public function kelasDosen(){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelas($dosen->name);

        View::render('dosen-kelas', [
            "title" => "Kelas Dosen",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'matakuliah' => $row,
        ]);
    }

    // kelas dosen detail
    public function kelasDosenDetail($id_kelas){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelasIDKelas($id_kelas);
        $mahasiswa = $this->kelolaMatakuliahService->tampilkanMahasiswa($id_kelas);
        
        View::render('dosen-data-kelas', [
            "title" => "Kelas Dosen Detail",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'matakuliah' => $row,
            'mahasiswa' => $mahasiswa,
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

    // kriteria nilai kinerja
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

    // kriteria nilai mata kuliah
    public function kriteriaNilaiMK(){
        $dosen = $this->loginService->current();
        View::render('form-kriteria-penilaianmk', [
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
