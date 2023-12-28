<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Kelas;
use Klp1\ELearning\Model\Domain\Matakuliah;
use Klp1\ELearning\Model\Domain\Prodi;
use Klp1\ELearning\Model\Domain\TahunAkademik;
use Klp1\ELearning\Repository\KelolaDataPribadiRepository;
use Klp1\ELearning\Repository\KelolaDataProdiRepository;
use Klp1\ELearning\Repository\KelolaKelasRepository;
use Klp1\ELearning\Repository\KelolaMataKuliahRepository;
use Klp1\ELearning\Repository\KelolaNilaiRepository;
use Klp1\ELearning\Repository\KelolaTahunAkademikRepository;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\KelolaDataPribadiService;
use Klp1\ELearning\Service\KelolaDataProdiService;
use Klp1\ELearning\Service\KelolaKelasService;
use Klp1\ELearning\Service\KelolaMataKuliahService;
use Klp1\ELearning\Service\KelolaNilaiService;
use Klp1\ELearning\Service\KelolaTahunAkademikService;
use Klp1\ELearning\Service\LoginService;
use Klp1\ELearning\Service\RegisterService;

class AdminController {

    private RegisterService $registerService;
    private LoginService $loginService;
    private KelolaDataPribadiService $kelolaDataPribadiService;
    private KelolaTahunAkademikService $kelolaTahunAkademikService;
    private KelolaMataKuliahService $kelolaMatakuliahService;
    private KelolaKelasService $kelolaKelasService;
    private KelolaDataProdiService $kelolaDataProdiService;
    private KelolaNilaiService $kelolaNilaiService;

    public function __construct(){
        $connection = Database::getConnection();

        // repo
        $registerRepository = new RegisterRepository($connection);
        $loginRepository = new LoginRepository($connection);
        $kelolaDataPribadiRepository = new KelolaDataPribadiRepository($connection);
        $kontrolTahunAkademikRepository = new KelolaTahunAkademikRepository($connection);
        $kelolaMatakuliahRepository = new KelolaMataKuliahRepository($connection);
        $kelolaKelasRepository = new KelolaKelasRepository($connection);
        $kelolaDataProdiRepository = new KelolaDataProdiRepository($connection);
        $kelolaNilaiRepository = new KelolaNilaiRepository($connection);

        // service
        $this->registerService = new RegisterService($registerRepository);
        $this->loginService = new LoginService($loginRepository);
        $this->kelolaDataPribadiService = new KelolaDataPribadiService($kelolaDataPribadiRepository, $loginRepository, $this->loginService);
        $this->kelolaTahunAkademikService = new KelolaTahunAkademikService($kontrolTahunAkademikRepository);
        $this->kelolaMatakuliahService = new KelolaMataKuliahService($kelolaMatakuliahRepository);
        $this->kelolaKelasService = new KelolaKelasService($kelolaKelasRepository);
        $this->kelolaDataProdiService = new KelolaDataProdiService($kelolaDataProdiRepository);
        $this->kelolaNilaiService = new KelolaNilaiService($kelolaNilaiRepository);
    }
    
    public function beranda(){
        $admin = $this->loginService->current();
        View::render('index', [
            "title" => "Dashboard Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // logout
    public function prosesLogout(){
        $this->loginService->destroy();
        View::redirect("/");
    }

    // registrasi
    public function tampilkanFormRegistrasi(){
        View::render('MenuRegistrasiAdmin', [
            "title" => "Register Admin"
        ]);
    }

    public function register(){
        $registerAdmin = new Admin();
        $registerAdmin->username = $_POST['username'];
        $registerAdmin->email = $_POST['email'];
        $registerAdmin->password = $_POST['password'];

        try {
            $this->registerService->registerAdmin($registerAdmin);
            View::redirect('/');
        }catch(\Exception $exception){
            View::render('registrasiAdmin', [
                "title" => "Daftar Akun",
                "error" => $exception->getMessage()
            ]);
        }

    }

    // mengelola data pribadi
    public function tampilkanMenuDataPribadi(){
        $admin = $this->loginService->current();
        View::render('MenuDataPribadi', [
            "title" => "Data Pribadi Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    public function editProfil(){
        $admin = $this->loginService->current();
        View::render('keloladata-pribadi', [
            "title" => "Data Pribadi Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    public function ubahData(){
        $request = new Admin();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->email = $_POST['email'];

        try {
            $this->kelolaDataPribadiService->ubahDataAdmin($request);
            View::redirect('/data/admin');
        }catch (\Exception $e){
            $admin = $this->loginService->current();
            View::render('keloladata-pribadi', [
                "title" => "Data Pribadi Admin",
                'usertype' => $admin->userType,
                'username' => $admin->username,
                'email' => $admin->email,
                'error' => $e->getMessage()
            ]);
        }

    }


    // mengelola data tahun akademik
    public function tampilkanTahunAkademik(){
        $admin = $this->loginService->current();
        $tahunAkademik = $this->kelolaTahunAkademikService->tampilkanTahunAkademik();
        View::render('MenuTahunAkademik', [
            "title" => "Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'tahunAkademik' => $tahunAkademik
        ]);
    }

    public function tampilkanFormTambahDataTahunAkademik(){
        $admin = $this->loginService->current();
        View::render('MenuTambahDataTahunAkademik', [
            "title" => "Tambah Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }
    
    public function tambahDataTahunAkademik(){  
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik->nama_semester = $_POST['nama_semester'];
        $tahunAkademik->tahun = $_POST['tahun'];
        $tahunAkademik->status = $_POST['status'];

        $this->kelolaTahunAkademikService->tambahTahunAkademik($tahunAkademik);
        View::redirect('/tahunakademik');
    }

    public function pilihDataTahunAkademikEdit($id_semester){
        $admin = $this->loginService->current();
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik = $this->kelolaTahunAkademikService->getSemesterById($id_semester);
        View::render('MenuEditDataTahunAkademik', [
            "title" => "Edit Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'tahun' => $tahunAkademik->tahun,
        ]);
    }

    public function editDataTahunAkademik(){
        $path = $_SERVER['PATH_INFO'];
        $semester = explode("/", $path);
        $id_semester = $semester[4];
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik->nama_semester = $_POST['nama_semester'];
        $tahunAkademik->tahun = $_POST['tahun'];
        $tahunAkademik->status = $_POST['status'];
        $this->kelolaTahunAkademikService->editDataTahunAkademik($tahunAkademik, $id_semester);
        View::redirect('/tahunakademik');
    }

    public function hapusDataTahunAkademik(){
        $path = $_SERVER['PATH_INFO'];
        $semester = explode("/", $path);
        $id_semester = $semester[4];
        $this->kelolaTahunAkademikService->hapusDataTahunAkademik($id_semester);
        View::redirect('/tahunakademik');
    }

    // Mengelola data prodi
    public function tampilkanMenuProdi(){
        $admin = $this->loginService->current();
        $row = $this->kelolaDataProdiService->tampilkanDataProdi();
        View::render('MenuProdi', [
            'title' => 'Data Prodi',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'prodi' => $row,
        ]);
    }

    public function tampilkanFormTambahDataProdi(){
        $admin = $this->loginService->current();
        View::render('MenuTambahDataProdi', [
            'title' => 'Tambah Data Prodi',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    public function tambahDataProdi(){
        $prodi = new Prodi();
        $prodi->nama_prodi = $_POST['namaProdi'];
        $prodi->jumlah_mhs = $_POST['jumlahMhs'];

        $this->kelolaDataProdiService->tambahDataProdi($prodi);
        View::redirect('/dataprodi');
    }

    public function pilihDataProdiEdit($id_prodi){
        $admin = $this->loginService->current();
        $row = $this->kelolaDataProdiService->tampilkanSatuProdi($id_prodi);
        View::render('MenuEditDataProdi', [
            'title' => 'Edit Data Prodi',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'prodi' => $row,
        ]);
    }

    public function editDataProdi($id_prodi){

        $prodi = new Prodi();
        $prodi->nama_prodi = $_POST['namaProdi'];
        $prodi->jumlah_mhs = $_POST['jumlahMhs'];

        $this->kelolaDataProdiService->editDataProdi($prodi, $id_prodi);
        View::redirect('/dataprodi');
    }

    public function hapusDataProdi($id_prodi){
        $this->kelolaDataProdiService->hapusDataProdi($id_prodi);
        View::redirect('/dataprodi');
    }

    // Mengelola data mata kuliah
    public function tampilkanMenuMatakuliah(){
        $admin = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanDataMatakuliah();
        View::render('MenuMatakuliah', [
            'title' => 'Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'matakuliah' => $row
        ]);
    }

    public function tampilkanFormTambahDataMatakuliah(){
        $admin = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanDataMatakuliah();
        

        View::render('MenuTambahDataMatakuliah', [
            'title' => 'Tambah Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'dosen' => $row,
        ]);
    }

    public function tambahDataMatakuliah(){

        $matakuliah = new Matakuliah();
        $matakuliah->nama_mk = $_POST['namaMK'];
        $matakuliah->jadwal_mk = (string)$_POST['jadwal'];
        $matakuliah->sks = (int)$_POST['jumlahSKS'];

        $this->kelolaMatakuliahService->tambahDataMatakuliah($matakuliah);

        View::redirect('/matakuliah');

    }

    public function pilihDataMatakuliahEdit($id_mk){
        $admin = $this->loginService->current();
        $matakuliah = $this->kelolaMatakuliahService->tampilkanMatakuliahSatu($id_mk);

        View::render("MenuEditDataMatakuliah", [
            'title' => 'Edit Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'matakuliah' => $matakuliah
        ]);

    }

    public function editDataMatakuliah($id_mk){
        $matakuliah = new Matakuliah();
        $matakuliah->jadwal_mk = $_POST['jadwal'];
        $matakuliah->nama_mk = (string)$_POST['namaMK'];
        $matakuliah->sks = (int)$_POST['jumlahSKS'];

        $this->kelolaMatakuliahService->editDataMatakuliah($matakuliah, $id_mk);
        View::redirect('/matakuliah');
    }

    public function hapusDataMatakuliah($id_mk){
        $this->kelolaMatakuliahService->hapusDataMatakuliah($id_mk);
        View::redirect('/matakuliah');
    }

    // Mengelola Data Kelas
    public function tampilkanMenuKelasMatakuliah(){
        $admin = $this->loginService->current();
        $row = $this->kelolaKelasService->tampilkanDataKelas();

        View::render('MenuKelasMatakuliah', [
            'title' => 'Kelola Kelas',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'kelas' => $row,
        ]);
    }

    public function tampilkanFormTambahDataKelas(){
        $admin = $this->loginService->current();
        $dosen = $this->kelolaKelasService->tampilkanSemuaDosen();
        $getMK = $this->kelolaMatakuliahService->tampilkanDataMatakuliah();
        View::render('MenuTambahDataKelas', [
            'title' => 'Kelola Kelas',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'dosen' => $dosen,
            'matakuliah' => $getMK,
        ]);
    }

    public function tambahDataKelas(){

        $kelas = new Kelas();
        $kelas->nama_kelas = $_POST['namaKelas'];
        $kelas->kapasitas = $_POST['kapasitas'];
        $kelas->nama_dosen = $_POST['nama_dosen'];
        $kelas->matakuliah = $_POST['nama_mk'];

        $this->kelolaKelasService->tambahDataKelas($kelas);
        View::redirect('/kelas/admin');
    }

    public function pilihDataKelasEdit($id_kelas){
        $admin = $this->loginService->current();
        $dosen = $this->kelolaKelasService->tampilkanSemuaDosen();
        $kelas = $this->kelolaKelasService->tampilkanSatuKelas($id_kelas);
        $getMK = $this->kelolaMatakuliahService->tampilkanDataMatakuliah();
        View::render('MenuEditDataKelas', [
            'title' => 'Edit Kelola Kelas',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'dosen' => $dosen,
            'kelas' => $kelas,
            'matakuliah' => $getMK,
        ]);
    }

    public function editDataKelas($id_kelas){
        $kelas = new Kelas();
        $kelas->nama_kelas = $_POST['namaKelas'];
        $kelas->kapasitas = $_POST['kapasitas'];
        $kelas->nama_dosen = $_POST['nama_dosen'];
        $kelas->matakuliah = $_POST['nama_mk'];

        $this->kelolaKelasService->editDataKelas($kelas, $id_kelas);
        View::redirect('/kelas/admin');
    }

    public function hapusDataKelas($id_kelas){
        $this->kelolaKelasService->hapusDataKelas($id_kelas);
        View::redirect('/kelas/admin');
    }

    // Mengelola arsip nilai mata kuliah
    public function pilihMenuArsipNilai($id_mk){
        $admin = $this->loginService->current();

        $matakuliah = $this->kelolaNilaiService->tampilkanMatakuliah($id_mk);
        $row = $this->kelolaNilaiService->tampilkanArsipNilaiMatakuliah($matakuliah);
        View::render('MenuArsipNilai', [
            'title' => 'Arsip Nilai Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'arsip_nilai' => $row,
            'id_mk' => $id_mk
        ]);
    }

    // hapus arsip
    public function hapusArsipNilai($id_arsip, $id_mk){
        $this->kelolaNilaiService->hapusNilai($id_arsip);
        View::redirect("/matakuliah/arsip/$id_mk");
    }
   

}


