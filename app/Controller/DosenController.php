<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Kelompok;
use Klp1\ELearning\Model\Register;
use Klp1\ELearning\Repository\KelolaDataPribadiRepository;
use Klp1\ELearning\Repository\KelolaKelasRepository;
use Klp1\ELearning\Repository\KelolaKelompokRepository;
use Klp1\ELearning\Repository\KelolaMataKuliahRepository;
use Klp1\ELearning\Repository\KelolaNilaiKelompokRepository;
use Klp1\ELearning\Repository\KelolaNilaiMatakuliahRepository;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\KelolaDataPribadiService;
use Klp1\ELearning\Service\KelolaKelasService;
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
    private KelolaKelasService $kelolaKelasService;

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
        $kelolaKelasRepository = new KelolaKelasRepository($connection);

        // service
        $this->registerService = new RegisterService($registerRepository);
        $this->loginService = new LoginService($loginRepository);
        $this->kelolaDataPribadiService = new KelolaDataPribadiService($kelolaDataPribadiRepository, $loginRepository, $this->loginService);
        $this->kelolaMatakuliahService = new KelolaMataKuliahService($kelolaMatakuliahRepository);
        $this->kelolaKelompokService = new KelolaKelompokService($kelolaKelompokRepository);
        $this->kelolaNilaiKelompokService = new KelolaNilaiKelompokService($kelolaNilaiKelompokRepository);
        $this->kelolaNilaiMatakuliahService = new KelolaNilaiMatakuliahService($kelolaNilaiMatakuliahRepository);
        $this->kelolaKelasService = new KelolaKelasService($kelolaKelasRepository);
    }

    public function beranda(): void{
        $dosen = $this->loginService->current();
        View::render('Beranda', [
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

    // registrasi dosen
    public function tampilkanFormRegistrasi(): void {
        View::render('MenuRegistrasiDosen', [
            "title" => "Daftar Akun Dosen"
        ]);
    }

    public function register(){
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

    // Mengelola data pribadi
    public function tampilkanMenuDataPribadi(){
        $dosen = $this->loginService->current();
        View::render('MenuDataPribadi', [
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

    public function ubahData(){
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

    // melihat daftar mata kuliah
    public function tampilkanDaftarMatakuliah(){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelas($dosen->name);

        View::render('MenuMatakuliahDosen', [
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

    public function tampilkanDataKelas($id_kelas){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelasIDKelas($id_kelas);
        $mahasiswa = $this->kelolaMatakuliahService->tampilkanMahasiswa($id_kelas);
        
        View::render('DataKelas', [
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

    // Mengelola Data kelompok
    public function pilihMenuTambahDataKelompok($id_kelas){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelasIDKelas($id_kelas);
        $kelompok = $this->kelolaKelompokService->tampilkanDataKelompok($id_kelas);

        View::render('MenuDataKelompok', [
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

    public function menampilkanFormDataKelompokTambah($id_kelas){
        $dosen = $this->loginService->current();
        $mahasiswa = $this->kelolaMatakuliahService->tampilkanMahasiswa($id_kelas);
        View::render('MenuTambahDataKelompok', [
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

    public function tambahDataKelompok($id_kelas){

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

    public function menampilkanFormDataKelompokHapus($id_kelas, $hapusKelas, $id_kelompok, $id_mhs){

        $mahasiswa = $this->kelolaKelompokService->cariMahasiswa($id_mhs)[0];

        $this->kelolaKelompokService->hapusDataKelompok($id_kelas, $hapusKelas, $id_kelompok, $mahasiswa);
        
        
        View::redirect("/kelas/dosen/detail/$id_kelas/kelompok");
    }

    // mengelola data nilai mata kuliah
    public function pilihMenuTambahDataNilai($id_kelas){
        $dosen = $this->loginService->current();
        $nilai_mhs = $this->kelolaNilaiMatakuliahService->tampilkanDataNilaiMatakuliah($id_kelas);

        View::render('MenuNilaiMatakuliahDosen', [
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

    public function menampilkanFormDataNilaiTambah($id_kelas, $id_nilai){
        $dosen = $this->loginService->current();
        $nilai_mhs = $this->kelolaNilaiMatakuliahService->tampilkanSatuDataMatakuliah($id_kelas, $id_nilai);

        View::render('MenuTambahDataNilaiMatakuliah', [
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

    public function tambahDataNilai($id_kelas, $id_nilai){

        $nilai_tugas = $_POST['tugas'];
        $nilai_uts = $_POST['uts'];
        $nilai_uas = $_POST['uas'];

        $this->kelolaNilaiMatakuliahService->tambahDataNilai($nilai_tugas, $nilai_uts, $nilai_uas, $id_kelas, $id_nilai);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaimk");
    }

    public function menampilkanFormDataNilaiEdit($id_kelas, $id_nilai){
        $dosen = $this->loginService->current();
        $nilai_mhs = $this->kelolaNilaiMatakuliahService->tampilkanSatuDataMatakuliah($id_kelas, $id_nilai);

        View::render('MenuEditDataNilaiMatakuliah', [
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


    public function editDataNilai($id_kelas, $id_nilai){

        $nilai_tugas = $_POST['tugas'];
        $nilai_uts = $_POST['uts'];
        $nilai_uas = $_POST['uas'];

        $this->kelolaNilaiMatakuliahService->tambahDataNilai($nilai_tugas, $nilai_uts, $nilai_uas, $id_kelas, $id_nilai);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaimk");
    }

    public function hapusDataNilai($id_kelas, $id_nilai){
        $this->kelolaNilaiMatakuliahService->hapusDataNilai($id_nilai); 
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaimk");
    }

    

    // mengelola data nilai kelompok
    public function pilihMenuTambahDataNilaiKelompok($id_kelas){
        $dosen = $this->loginService->current();
        // $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelas($dosen->name);
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelasIDKelas($id_kelas);
        $mk = $row[0]['nama_mk'];
        $kelompok = $this->kelolaNilaiKelompokService->tampilkanDataNilaiKelompok($id_kelas);
       
        View::render('MenuNilaiMatakuliah', [
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

    public function menampilkanFormDataNilaiTambahKelompok($id_kelas, $id_kelompok ,$id_kinerja_kelompok){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelas($dosen->name);
        $mk = $row[0]['nama_mk'];
        
        $kelompok = $this->kelolaNilaiKelompokService->tampilkanSatuDataNilaiKelompok($id_kelas, $id_kinerja_kelompok);
        View::render('MenuTambahDataNilaiKelompok', [
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

    public function menampilkanFormDataNilaiEditKelompok($id_kelas, $id_kelompok, $id_kinerja_kelompok){
        $dosen = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanMatakuliahDanKelas($dosen->name);
        $mk = $row[0]['nama_mk'];
        $kelompok = $this->kelolaNilaiKelompokService->tampilkanSatuDataNilaiKelompok($id_kelas, $id_kinerja_kelompok);
        
        View::render('MenuEditDataNilaiKelompok', [
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

    public function editDataNilaiKelompok($id_kelas, $id_kelompok, $id_kinerja_kelompok, $nilaikriteria){
        $nilai = (int)$_POST['nilaiKelompok'];

        $this->kelolaNilaiKelompokService->editDataNilai($nilai, $id_kelompok);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaikelompok");
    }

    public function tambahDataNilaiKelompok($id_kelas, $id_kelompok, $id_kinerja_kelompok, $nilaikriteria){
        $nilai = (int)$_POST['nilaiKelompok'];
        $nama = $_POST['nama'];
        $matakuliah = $_POST['matakuliah'];

        $nilaiAkhir = ((int)$nilaikriteria + $nilai)/2;

        $this->kelolaNilaiKelompokService->tambahDataNilai($nilai, $id_kelompok);
        $this->kelolaNilaiKelompokService->tambahNilaiAkhir($nilaiAkhir, $nama, $matakuliah);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaikelompok");
    }

    public function hapusDataNilaiKelompok($id_kelas, $id_kelompok){
        $this->kelolaNilaiKelompokService->hapusDataNilai($id_kelompok);
        View::redirect("/kelas/dosen/detail/$id_kelas/nilaikelompok");
    }

    // Melihat nilai akhir matakuliah
    public function memilihNilaiAkhirMatakuliah($id_kelas){
        $dosen = $this->loginService->current();
        $row = $this->kelolaKelasService->ambilDataNilaiSemua($id_kelas);
        View::render('MenuNilaiAkhirMatakuliahDosen', [
            "title" => "Kelas Dosen Nilai Akhir",
            'usertype' => $dosen->userType,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'nama' => $dosen->name,
            'jenis_kelamin' => $dosen->jenisKelamin,
            'email' => $dosen->email,
            'prodi' => $dosen->jurusan,
            'id_kelas' => $id_kelas,
            'nilai_akhir' => $row
        ]);
    }

    // logout
    public function prosesLogout(){
        $this->loginService->destroy();
        View::redirect("/");
    }

}
