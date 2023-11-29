<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Form Nilai Kelompok</h1>
            <h1 class="h5 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputDosen">Kelompok</label>
                        <select class="form-control" id="opsiDosen">
                            <option value="">Kelompok 1</option>
                            <option value="">Kelompok 2</option>
                            <option value="">Kelompok 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputNilaikelompok">Nilai Kelompok</label>
                        <input required type="number" name="nilaiKelompok" class="form-control" id="inputNilaiKelompok" placeholder="Skala 0 -100" value="">
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" name="" value="">
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