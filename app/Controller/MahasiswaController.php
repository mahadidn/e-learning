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
        View::render('Beranda', [
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

    // registrasi
    public function tampilkanFormRegistrasi(): void {
        View::render('MenuRegistrasiMahasiswa', [
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

    // mengelola data pribadi
    public function tampilkanMenuDataPribadi(){
        $mahasiswa = $this->loginService->current();
        View::render('MenuDataPribadi', [
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

    public function ubahData(){
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

    // Memilih kelas mata kuliah
    public function tampilkanDaftarKelas(){
        $mahasiswa = $this->loginService->current();
        $kelas = $this->kelolaPilihKelasMatakuliahService->tampilkanDataKelas();
        $kelas_mahasiswa = $this->kelolaPilihKelasMatakuliahService->tampilkanKelasMahasiswa($mahasiswa->id);
        

        View::render('MenuKelasMatakuliahMahasiswa', [
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

    public function pilihKelas($id_kelas){
        $mahasiswa = $this->loginService->current(); 
        $this->kelolaPilihKelasMatakuliahService->pilihKelas($id_kelas, $mahasiswa->id, $mahasiswa->nama);
        View::redirect('/kelas/mahasiswa/' . $id_kelas);
    }

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

    // Melihat Nilai Akhir mata kuliah
    public function memilihNilaiAkhirMatakuliah($id_kelas){
        $mahasiswa = $this->loginService->current();
        $row = $this->kelolaKelasService->ambilDataNilai($id_kelas, $mahasiswa->nama);
        View::render('MenuNilaiAkhirMatakuliahMahasiswa', [
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

    // Mengelola Data Kinerja Kelompok
    public function tampilkanMenuPenilaian($id_kelas){
        $mahasiswa = $this->loginService->current();
        $id_kelompok = $this->kelolaPenilaianService->kelompokMhs($mahasiswa->nama, $id_kelas);
        $kelompok = $this->kelolaPenilaianService->tampilkanPenilaianTersimpan($id_kelompok, $id_kelas);
        $kelompokKinerja = $this->kelolaPenilaianService->tampilkanPenilaianKinerja($id_kelompok, $id_kelas);

        View::render('MenuPenilaian', [
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

    public function pilihAnggota($id_kelas, $id_kinerja_kelompok){
        $mahasiswa = $this->loginService->current();
        $kinerjaMhs = $this->kelolaPenilaianService->tampilkanEditKinerja($id_kinerja_kelompok, $id_kelas);

        View::render('MenuPilihAnggota', [
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

    public function isiFormPenilaian($id_kelas, $id_kinerja_kelompok){
        
        $this->kelolaPenilaianService->isiFormPenilaian($_POST['nilaiK1'], $_POST['nilaiK2'], $id_kinerja_kelompok, $id_kelas);
    
        View::redirect("/kelas/mahasiswa/detail/datapenilaian/$id_kelas");
    }

    // logout
    public function prosesLogout(){
        $this->loginService->destroy();
        View::redirect("/");
    }



}

