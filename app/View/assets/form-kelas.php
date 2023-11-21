<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Kelas Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKodeKelas">Kode Kelas</label>
                        <input required type="text" name="kodeKelas" class="form-control" id="inputKodeKelas" placeholder="INF12001" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputNamaKelas">Nama Kelas</label>
                        <input required type="text" name="namaKelas" class="form-control" id="inputKelas" placeholder="Perancangan dan Implementasi Perangkat Lunak" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputKapasitas">Kapasitas</label>
                        <input required type="text" name="kapasitas" class="form-control" id="inputKapasitas" placeholder="40" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputDosen">Dosen Pengampu</label>
                        <select class="form-control" id="opsiDosen">
                            <option value="">Dosen A</option>
                            <option value="">Dosen B</option>
                            <option value="">Dosen C</option>
                        </select>
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-base" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="data-kelas.php">
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