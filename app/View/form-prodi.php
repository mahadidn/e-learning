<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Data Prodi</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKodeProdi">Kode Prodi</label>
                        <input required type="text" name="kodeProdi" class="form-control" id="inputKodeProdi" placeholder="INF12001" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputNamaProdi">Nama Prodi</label>
                        <input required type="text" name="namaProdi" class="form-control" id="inputNamaProdi" placeholder="Teknik Informatika" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputJumlahMhs">Jumlah Mahasiswa</label>
                        <input required type="text" name="jumlahMhs" class="form-control" id="inputJumlahMhs" placeholder="100" value="">
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-base" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="data-prodi.php">
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