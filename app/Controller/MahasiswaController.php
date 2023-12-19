<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Mahasiswa;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\KelolaDataPribadiRepository;
use Klp1\ELearning\Repository\KelolaKelasRepository;
use Klp1\ELearning\Repository\KelolaMataKuliahRepository;
use Klp1\ELearning\Repository\KelolaPenilaianRepository;
use Klp1\ELearning\Repository\KelolaPilihKelasMatakuliahRepository;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\KelolaDataPribadiService;
use Klp1\ELearning\Service\KelolaKelasService;
use Klp1\ELearning\Service\KelolaPenilaianService;
use Klp1\ELearning\Service\KelolaPilihKelasMatakuliahService;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class MahasiswaController {

    private RegisterService $registerService;
    private LoginService $loginService;
    private KelolaDataPribadiService $kelolaDataPribadiService;
    private KelolaPilihKelasMatakuliahService $kelolaPilihKelasMatakuliahService;
    private KelolaPenilaianService $kelolaPenilaianService;
    private KelolaKelasService $kelolaKelasService;

    public function __construct(){
        $connection = Database::getConnection();
        // repo
        $registerRepository = new RegisterRepository($connection);
        $loginRepository = new LoginRepository($connection);
        $kelolaDataPribadiRepository = new KelolaDataPribadiRepository($connection);
        $kelolaPilihKelasMatakuliahRepository = new KelolaPilihKelasMatakuliahRepository($connection);
        $kelolaPenilaianRepository = new KelolaPenilaianRepository($connection);
        $kelolaKelasRepository = new KelolaKelasRepository($connection);

        // service
        $this->registerService = new RegisterService($registerRepository);
        $this->loginService = new LoginService($loginRepository);
        $this->kelolaDataPribadiService = new KelolaDataPribadiService($kelolaDataPribadiRepository, $loginRepository, $this->loginService);
        $this->kelolaPilihKelasMatakuliahService = new KelolaPilihKelasMatakuliahService($kelolaPilihKelasMatakuliahRepository);
        $this->kelolaPenilaianService = new KelolaPenilaianService($kelolaPenilaianRepository);
        $this->kelolaKelasService = new KelolaKelasService($kelolaKelasRepository);
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
        $kelas = $this->kelolaPilihKelasMatakuliahService->tampilkanDataKelas();
        $kelas_mahasiswa = $this->kelolaPilihKelasMatakuliahService->tampilkanKelasMahasiswa($mahasiswa->id);
        

        View::render('mahasiswa-kelas', [
            "title" => "Kelas Mahasiswa",
            'usertype' => $mahasiswa->userType,
            'id_mhs' => $mahasiswa->id,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin,
            'kelas' => $kelas,
            'kelas_mahasiswa' => $kelas_mahasiswa
        ]);
    }

    // pilihKelas
    public function gabungKelas($id_kelas){
        $mahasiswa = $this->loginService->current(); 
        $this->kelolaPilihKelasMatakuliahService->pilihKelas($id_kelas, $mahasiswa->id, $mahasiswa->nama);
        View::redirect('/kelas/mahasiswa/' . $id_kelas);
    }

    // detail kelas mahasiswa
    public function detailKelasMahasiswa($id_kelas){
        $mahasiswa = $this->loginService->current();
        $kelas = $this->kelolaPilihKelasMatakuliahService->tampilkanKelasId($id_kelas);
        $nama_mk = $kelas[0]['matakuliah'];
        $this->kelolaPilihKelasMatakuliahService->updateNilai($nama_mk, $id_kelas);

        View::render('mahasiswa-data-kelas', [
            "title" => "Detail Kelas Mahasiswa",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin,
            'kelas' => $kelas,
            'id_kelas' => $id_kelas
        ]);
    }

    // lihat nilai akhir
    public function nilaiAkhir($id_kelas){
        $mahasiswa = $this->loginService->current();
        $row = $this->kelolaKelasService->ambilDataNilai($id_kelas, $mahasiswa->nama);
        View::render('mahasiswa-nilai-akhir', [
            "title" => "Kelas Mahasiswa Nilai Akhir",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin,
            'id_kelas' => $id_kelas,
            'nilaiakhir' => $row
        ]);
    }

    // penilaian
    public function formPenilaian($id_kelas, $id_kinerja_kelompok){
        $mahasiswa = $this->loginService->current();
        $kinerjaMhs = $this->kelolaPenilaianService->tampilkanEditKinerja($id_kinerja_kelompok, $id_kelas);

        View::render('form-penilaian-kinerja', [
            "title" => "Kelas Mahasiswa Penilaian",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin,
            'id_kelas' => $id_kelas,
            'kinerjaMhs' => $kinerjaMhs,
            'id_kinerja_kelompok' => $id_kinerja_kelompok,
        ]);
    }

    public function postFormPenilaian($id_kelas, $id_kinerja_kelompok){
        
        $this->kelolaPenilaianService->isiFormPenilaian($_POST['nilaiK1'], $_POST['nilaiK2'], $id_kinerja_kelompok, $id_kelas);
    
        View::redirect("/kelas/mahasiswa/detail/datapenilaian/$id_kelas");
    }

    //hasil penilaian
    public function dataPenilaian($id_kelas){
        $mahasiswa = $this->loginService->current();
        $id_kelompok = $this->kelolaPenilaianService->kelompokMhs($mahasiswa->nama, $id_kelas);
        $kelompok = $this->kelolaPenilaianService->tampilkanPenilaianTersimpan($id_kelompok, $id_kelas);
        var_dump($id_kelompok);
        $kelompokKinerja = $this->kelolaPenilaianService->tampilkanPenilaianKinerja($id_kelompok, $id_kelas);

        View::render('mahasiswa-penilaian-kinerja', [
            "title" => "Data Penilaian Kinerja",
            'usertype' => $mahasiswa->userType,
            'username' => $mahasiswa->username,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'prodi' => $mahasiswa->prodi,
            'jenis_kelamin' => $mahasiswa->jenisKelamin,
            'kelompok' => $kelompok,
            'id_kelas' => $id_kelas,
            'kinerja_kelompok' => $kelompokKinerja,
        ]);
    }

    public function logout(){
        $this->loginService->destroy();
        View::redirect("/");
    }



}

