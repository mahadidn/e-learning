<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Form Kelompok</h1>
            <h1 class="h5 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKelompok">Nama Kelompok</label>
                        <input required type="text" name="namaKelompok" class="form-control" id="inputKelas" placeholder="Kelompok 1" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputMahasiswa">Anggota</label>
                        <select class="form-control" id="opsiMahasiswa">
                            <option value="">Mahasiswa A</option>
                            <option value="">Mahasiswa B</option>
                            <option value="">Mahasiswa C</option>
                        </select>
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-base" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="dosen-data-kelompok.php">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- container-fluid -->

<!-- SweetAlert -->
<script src="js/sweetalert.min.js"></script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>