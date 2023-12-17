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
use Klp1\ELearning\Repository\KelolaTahunAkademikRepository;
use Klp1\ELearning\Repository\LoginRepository;
use Klp1\ELearning\Repository\RegisterRepository;
use Klp1\ELearning\Service\KelolaDataPribadiService;
use Klp1\ELearning\Service\KelolaDataProdiService;
use Klp1\ELearning\Service\KelolaKelasService;
use Klp1\ELearning\Service\KelolaMataKuliahService;
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

        // service
        $this->registerService = new RegisterService($registerRepository);
        $this->loginService = new LoginService($loginRepository);
        $this->kelolaDataPribadiService = new KelolaDataPribadiService($kelolaDataPribadiRepository, $loginRepository, $this->loginService);
        $this->kelolaTahunAkademikService = new KelolaTahunAkademikService($kontrolTahunAkademikRepository);
        $this->kelolaMatakuliahService = new KelolaMataKuliahService($kelolaMatakuliahRepository);
        $this->kelolaKelasService = new KelolaKelasService($kelolaKelasRepository);
        $this->kelolaDataProdiService = new KelolaDataProdiService($kelolaDataProdiRepository);
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

    public function logout(){
        $this->loginService->destroy();
        View::redirect("/");
    }

    public function registerAdmin(){
        View::render('registrasiAdmin', [
            "title" => "Register Admin"
        ]);
    }

    public function postRegisterAdmin(){
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

    // data pribadi
    public function menuDataPribadi(){
        $admin = $this->loginService->current();
        View::render('data-pribadi', [
            "title" => "Data Pribadi Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    public function postMenuDataPribadi(){
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

    // edit profil
    public function editProfil(){
        $admin = $this->loginService->current();
        View::render('keloladata-pribadi', [
            "title" => "Data Pribadi Admin",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // tahun akademik
    public function tahunAkademik(){
        $admin = $this->loginService->current();
        $tahunAkademik = $this->kelolaTahunAkademikService->tampilkanTahunAkademik();
        View::render('data-tahun-akademik', [
            "title" => "Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'tahunAkademik' => $tahunAkademik
        ]);
    }

    // tambah tahun akademik
    public function tambahTahunAkademik(){
        $admin = $this->loginService->current();
        View::render('form-tahun-akademik', [
            "title" => "Tambah Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }
    

    public function postTambahTahunAkademik(){  
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik->nama_semester = $_POST['nama_semester'];
        $tahunAkademik->tahun = $_POST['tahun'];
        $tahunAkademik->status = $_POST['status'];

        $this->kelolaTahunAkademikService->tambahTahunAkademik($tahunAkademik);
        View::redirect('/tahunakademik');
    }

    // edit tahun akademik
    public function editTahunAkademik($id_semester){
        $admin = $this->loginService->current();
        $tahunAkademik = new TahunAkademik();
        $tahunAkademik = $this->kelolaTahunAkademikService->getSemesterById($id_semester);
        View::render('form-edit-tahun-akademik ', [
            "title" => "Tambah Tahun Akademik",
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'tahun' => $tahunAkademik->tahun,
        ]);
    }

    public function postTahunAkademik(){
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

    public function hapusTahunAkademik(){
        $path = $_SERVER['PATH_INFO'];
        $semester = explode("/", $path);
        $id_semester = $semester[4];
        $this->kelolaTahunAkademikService->hapusDataTahunAkademik($id_semester);
        View::redirect('/tahunakademik');
    }

    // data prodi
    public function dataProdi(){
        $admin = $this->loginService->current();
        $row = $this->kelolaDataProdiService->tampilkanDataProdi();
        View::render('data-prodi', [
            'title' => 'Data Prodi',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'prodi' => $row,
        ]);
    }

    // tambah data prodi
    public function tambahDataProdi(){
        $admin = $this->loginService->current();
        View::render('form-prodi', [
            'title' => 'Tambah Data Prodi',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email
        ]);
    }

    // post tambah prodi
    public function postTambahDataProdi(){
        $prodi = new Prodi();
        $prodi->nama_prodi = $_POST['namaProdi'];
        $prodi->jumlah_mhs = $_POST['jumlahMhs'];

        $this->kelolaDataProdiService->tambahDataProdi($prodi);
        View::redirect('/dataprodi');
    }

    // edit prodi
    public function editProdi($id_prodi){
        $admin = $this->loginService->current();
        $row = $this->kelolaDataProdiService->tampilkanSatuProdi($id_prodi);
        View::render('form-prodi', [
            'title' => 'Edit Data Prodi',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'prodi' => $row,
        ]);
    }

    // post edit prodi
    public function postEditProdi($id_prodi){

        $prodi = new Prodi();
        $prodi->nama_prodi = $_POST['namaProdi'];
        $prodi->jumlah_mhs = $_POST['jumlahMhs'];

        $this->kelolaDataProdiService->editDataProdi($prodi, $id_prodi);
        View::redirect('/dataprodi');
    }

    // hapus prodi
    public function hapusProdi($id_prodi){
        $this->kelolaDataProdiService->hapusDataProdi($id_prodi);
        View::redirect('/dataprodi');
    }

    // matakuliah
    public function matakuliah(){
        $admin = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanDataMatakuliah();
        View::render('data-mata-kuliah', [
            'title' => 'Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'matakuliah' => $row
        ]);
    }

    public function tambahMatakuliah(){
        $admin = $this->loginService->current();
        $row = $this->kelolaMatakuliahService->tampilkanDataMatakuliah();
        

        View::render('form-mata-kuliah', [
            'title' => 'Tambah Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'dosen' => $row,
        ]);
    }

    // post tambah matakuliah admin
    public function postTambahMatakuliah(){

        $matakuliah = new Matakuliah();
        $matakuliah->nama_mk = $_POST['namaMK'];
        $matakuliah->jadwal_mk = (string)$_POST['jadwal'];
        $matakuliah->sks = (int)$_POST['jumlahSKS'];

        $this->kelolaMatakuliahService->tambahDataMatakuliah($matakuliah);

        View::redirect('/matakuliah');

    }

    // edit
    public function editMatakuliah($id_mk){
        $admin = $this->loginService->current();
        $matakuliah = $this->kelolaMatakuliahService->tampilkanMatakuliahSatu($id_mk);

        View::render("form-mata-kuliah", [
            'title' => 'Edit Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'matakuliah' => $matakuliah
        ]);

    }

    public function postEditMatakuliah($id_mk){
        $matakuliah = new Matakuliah();
        $matakuliah->jadwal_mk = $_POST['jadwal'];
        $matakuliah->nama_mk = (string)$_POST['namaMK'];
        $matakuliah->sks = (int)$_POST['jumlahSKS'];

        $this->kelolaMatakuliahService->editDataMatakuliah($matakuliah, $id_mk);
        View::redirect('/matakuliah');
    }

    // hapus
    public function hapusMatakuliah($id_mk){
        $this->kelolaMatakuliahService->hapusDataMatakuliah($id_mk);
        View::redirect('/matakuliah');
    }

    // kelas
    public function kelasAdmin(){
        $admin = $this->loginService->current();
        $row = $this->kelolaKelasService->tampilkanDataKelas();

        View::render('data-kelas', [
            'title' => 'Kelola Kelas',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'kelas' => $row,
        ]);
    }

    // tambah kelas admin
    public function tambahKelasAdmin(){
        $admin = $this->loginService->current();
        $dosen = $this->kelolaKelasService->tampilkanSemuaDosen();
        $getMK = $this->kelolaMatakuliahService->tampilkanDataMatakuliah();
        View::render('form-kelas', [
            'title' => 'Kelola Kelas',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'dosen' => $dosen,
            'matakuliah' => $getMK,
        ]);
    }

    // edit kelas admin
    public function editKelasAdmin($id_kelas){
        $admin = $this->loginService->current();
        $dosen = $this->kelolaKelasService->tampilkanSemuaDosen();
        $kelas = $this->kelolaKelasService->tampilkanSatuKelas($id_kelas);
        $getMK = $this->kelolaMatakuliahService->tampilkanDataMatakuliah();
        View::render('form-kelas', [
            'title' => 'Edit Kelola Kelas',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            'dosen' => $dosen,
            'kelas' => $kelas,
            'matakuliah' => $getMK,
        ]);
    }

    // post tambah kelas
    public function postTambahKelasAdmin(){

        $kelas = new Kelas();
        $kelas->nama_kelas = $_POST['namaKelas'];
        $kelas->kapasitas = $_POST['kapasitas'];
        $kelas->nama_dosen = $_POST['nama_dosen'];
        $kelas->matakuliah = $_POST['nama_mk'];

        $this->kelolaKelasService->tambahDataKelas($kelas);
        View::redirect('/kelas/admin');
    }

    // post edit kelas
    public function postEditKelasAdmin($id_kelas){
        $kelas = new Kelas();
        $kelas->nama_kelas = $_POST['namaKelas'];
        $kelas->kapasitas = $_POST['kapasitas'];
        $kelas->nama_dosen = $_POST['nama_dosen'];
        $kelas->matakuliah = $_POST['nama_mk'];

        $this->kelolaKelasService->editDataKelas($kelas, $id_kelas);
        View::redirect('/kelas/admin');
    }

    // hapus kelas
    public function hapusKelas($id_kelas){
        $this->kelolaKelasService->hapusDataKelas($id_kelas);
        View::redirect('/kelas/admin');
    }

    // arsip mata kuliah
    public function arsipMataKuliah(){
        $admin = $this->loginService->current();
        // bikin arsip baru lagi nanti
        // $row = $this->kelolaMatakuliahService->tampilkanArsipNilai();
        
        View::render('arsip-nilai-mata-kuliah', [
            'title' => 'Arsip Nilai Matakuliah',
            'usertype' => $admin->userType,
            'username' => $admin->username,
            'email' => $admin->email,
            // 'arsip_nilai' => $row,
        ]);
    }

    // 
   

}


