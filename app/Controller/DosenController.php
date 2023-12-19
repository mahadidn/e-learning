<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Kelompok;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\KelolaDataPribadiRepository;
use Klp1\ELearning\Repository\KelolaKelompokRepository;
use Klp1\ELearning\Repository\KelolaMataKuliahRepository;
use Klp1\ELearning\Repository\KelolaNilaiKelompokRepository;
use Klp1\ELearning\Repository\KelolaNilaiMatakuliahRepository;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\KelolaDataPribadiService;
use Klp1\ELearning\Service\KelolaKelompokService;
use Klp1\ELearning\Service\KelolaMataKuliahService;
use Klp1\ELearning\Service\KelolaNilaiKelompokService;
use Klp1\ELearning\Service\KelolaNilaiMatakuliahService;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class DosenController {

    private RegisterService $registerService;
    private LoginService $loginService;
    private KelolaDataPribadiService $kelolaDataPribadiService;
    private KelolaMataKuliahService $kelolaMatakuliahService;
    private KelolaKelompokService $kelolaKelompokService;
    private KelolaNilaiKelompokService $kelolaNilaiKelompokService;
    private KelolaNilaiMatakuliahService $kelolaNilaiMatakuliahService;

    public function __construct(){
        $connection = Database::getConnection();
        // repo
        $registerRepository = new RegisterRepository($connection);
        $loginRepository = new LoginRepository($connection);
        $kelolaDataPribadiRepository = new KelolaDataPribadiRepository($connection);
        $kelolaMatakuliahRepository = new KelolaMataKuliahRepository($connection);
        $kelolaKelompokRepository = new KelolaKelompokRepository($connection);
        $kelolaNilaiKelompokRepository = new KelolaNilaiKelompokRepository($connection);
        $kelolaNilaiMatakuliahRepository = new KelolaNilaiMatakuliahRepository($connection);

        // service
        $this->registerService = new RegisterService($registerRepository);
        $this->loginService = new LoginService($loginRepository);
        $this->kelolaDataPribadiService = new KelolaDataPribadiService($kelolaDataPribadiRepository, $loginRepository, $this->loginService);
        $this->kelolaMatakuliahService = new KelolaMataKuliahService($kelolaMatakuliahRepository);
        $this->kelolaKelompokService = new KelolaKelompokService($kelolaKelompokRepository);
        $this->kelolaNilaiKelompokService = new KelolaNilaiKelompokService($kelolaNilaiKelompokRepository);
        $this->kelolaNilaiMatakuliahService = new KelolaNilaiMatakuliahService($kelolaNilaiMatakuliahRepository);
    }

    public function beranda(): void{
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
    public function menuDataPribadi(){
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

    public function postMenuDataPribadi(){
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
    public function tampilkanDaftarMatakuliah(){
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
            'id_kelas' => $id_kelas
        ]);
    }

    // kelas dosen kelompok
    public function kelasDosenKelompok($id_kelas){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelasIDKelas($id_kelas);
        $kelompok = $this->kelolaKelompokService->tampilkanDataKelompok($id_kelas);

        View::render('dosen-data-kelompok', [
            "title" => "Kelas Dosen Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'matakuliah' => $row,
            'id_kelas' => $id_kelas,
            'kelompok' => $kelompok
        ]);
    }

    // tambah dosen kelompok
    public function tambahDosenKelompok($id_kelas){
        $dosen = $this->loginService->current();
        $mahasiswa = $this->kelolaMatakuliahService->tampilkanMahasiswa($id_kelas);
        View::render('form-kelompok', [
            "title" => "Kelas Dosen Tambah Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas,
            'mahasiswa' => $mahasiswa
        ]);
    }

    // post tambah dosen kelompok
    public function postTambahDosenKelompok($id_kelas){

        $kelompok = new Kelompok();
        $kelompok->nama_kelompok = $_POST['namaKelompok'];
        $kelompok->jumlah_anggota = count($_POST['Anggota']);
        $anggota[] = $_POST['Anggota'];
        $kelas = $id_kelas;
        
        try {

            $this->kelolaKelompokService->tambahDataKelompok($kelompok, $anggota, $id_kelas);
        }catch(\Exception $e){

        }
        
        View::redirect("/kelas/dosen/detail/$kelas/kelompok");
    }

    // hapus dosen kelompok
    public function hapusDosenKelompok($id_kelas, $hapusKelas, $id_kelompok){
        
        $this->kelolaKelompokService->hapusDataKelompok($id_kelas, $hapusKelas, $id_kelompok);
        View::redirect("/kelas/dosen/detail/$id_kelas/kelompok");
    }

    // nilai mk
    public function nilaimk($id_kelas){
        $dosen = $this->loginService->current();
        $nilai_mhs = $this->kelolaNilaiMatakuliahService->tampilkanDataNilaiMatakuliah($id_kelas);

        View::render('dosen-data-nilai-mk', [
            "title" => "Kelas Dosen Nilai Matakuliah",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas,
            'nilai' => $nilai_mhs,
        ]);
    }

    public function tambahmk($id_kelas, $id_nilai){
        $dosen = $this->loginService->current();
        $nilai_mhs = $this->kelolaNilaiMatakuliahService->tampilkanSatuDataMatakuliah($id_kelas, $id_nilai);

        View::render('form-nilai-mk', [
            "title" => "Kelas Dosen Nilai Matakuliah",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas,
            'nilai_mhs' => $nilai_mhs
        ]);
    }

    public function editmk($id_kelas, $id_nilai){
        $dosen = $this->loginService->current();
        $nilai_mhs = $this->kelolaNilaiMatakuliahService->tampilkanSatuDataMatakuliah($id_kelas, $id_nilai);

        View::render('form-nilai-mk', [
            "title" => "Kelas Dosen Nilai Matakuliah",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas,
            'nilai_mhs' => $nilai_mhs
        ]);
    }

    public function postTambahmk($id_kelas, $id_nilai){

        $nilai_tugas = $_POST['tugas'];
        $nilai_uts = $_POST['uts'];
        $nilai_uas = $_POST['uas'];

        $this->kelolaNilaiMatakuliahService->tambahDataNilai($nilai_tugas, $nilai_uts, $nilai_uas, $id_kelas, $id_nilai);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaimk");
    }

    public function postEditmk($id_kelas, $id_nilai){

        $nilai_tugas = $_POST['tugas'];
        $nilai_uts = $_POST['uts'];
        $nilai_uas = $_POST['uas'];

        $this->kelolaNilaiMatakuliahService->tambahDataNilai($nilai_tugas, $nilai_uts, $nilai_uas, $id_kelas, $id_nilai);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaimk");
    }

    // hapus mk
    public function hapusmk($id_kelas, $id_nilai){
        $this->kelolaNilaiMatakuliahService->hapusDataNilai($id_nilai); 
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaimk");
    }

    

    // nilai kelompok
    public function nilaiKelompok($id_kelas){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelas($dosen->name);
        $mk = $row[0]['nama_mk'];
        $kelompok = $this->kelolaNilaiKelompokService->tampilkanDataNilaiKelompok($id_kelas);
       
        View::render('dosen-data-nilai-kelompok', [
            "title" => "Kelas Dosen Nilai Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas,
            'kelompok' => $kelompok,
            'matakuliah' => $mk
        ]);
    }

    // tambah nilai kelompok
    public function tambahNilaiKelompok($id_kelas, $id_kelompok ,$id_kinerja_kelompok){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelas($dosen->name);
        $mk = $row[0]['nama_mk'];
        
        $kelompok = $this->kelolaNilaiKelompokService->tampilkanSatuDataNilaiKelompok($id_kelas, $id_kinerja_kelompok);
        View::render('form-nilai-kelompok', [
            "title" => "Edit Dosen Nilai Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas,
            'kelompok' => $kelompok,
            'matakuliah' => $mk,
        ]);
    }

    // edit nilai kelompok
    public function editNilaiKelompok($id_kelas, $id_kelompok, $id_kinerja_kelompok){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelas($dosen->name);
        $mk = $row[0]['nama_mk'];
        $kelompok = $this->kelolaNilaiKelompokService->tampilkanSatuDataNilaiKelompok($id_kelas, $id_kinerja_kelompok);
        
        View::render('form-nilai-kelompok', [
            "title" => "Edit Dosen Nilai Kelompok",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas,
            'kelompok' => $kelompok,
            'matakuliah' => $mk,
        ]);
    }

    // postEdit
    public function postEditNilaiKelompok($id_kelas, $id_kelompok, $id_kinerja_kelompok, $nilaikriteria){
        $nilai = (int)$_POST['nilaiKelompok'];

        $this->kelolaNilaiKelompokService->editDataNilai($nilai, $id_kelompok);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaikelompok");
    }

    // postTambah
    public function postTambahNilaiKelompok($id_kelas, $id_kelompok, $id_kinerja_kelompok, $nilaikriteria){
        $nilai = (int)$_POST['nilaiKelompok'];
        $nama = $_POST['nama'];
        $matakuliah = $_POST['matakuliah'];

        $nilaiAkhir = ((int)$nilaikriteria + $nilai)/2;

        $this->kelolaNilaiKelompokService->tambahDataNilai($nilai, $id_kelompok);
        $this->kelolaNilaiKelompokService->tambahNilaiAkhir($nilaiAkhir, $nama, $matakuliah);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaikelompok");
    }

    // hapus nilai kelompok
    public function hapusNilaiKelompok($id_kelas, $id_kelompok){
        $this->kelolaNilaiKelompokService->hapusDataNilai($id_kelompok);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaikelompok");
    }

    public function nilaiAkhir($id_kelas){
        $dosen = $this->loginService->current();
        View::render('dosen-nilai-akhir', [
            "title" => "Kelas Dosen Nilai Akhir",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas
        ]);
    }


    public function logout(){
        $this->loginService->destroy();
        View::redirect("/");
    }

}
