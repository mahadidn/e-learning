<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Form Kriteria Penilaian Kinerja Anggota</h1>
            <h1 class="h5 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <!-- ketika ditekan, menambahkan inputan baru di inputan paling bawah form -->
                <button type="submit" class="btn btn-info mb-4" name="" value="">Tambah Kriteria</button>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKriteria1">Kriteria 1</label>
                        <input required type="text" name="kriteria1" class="form-control" id="inputKriteria" placeholder="Skala 0 -100" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputKriteria1">Kriteria 2</label>
                        <input required type="text" name="kriteria1" class="form-control" id="inputKriteria" placeholder="Skala 0 -100" value="">
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-base" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="dosen-data-nilai-kelompok.php">
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