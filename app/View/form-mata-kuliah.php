<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Data Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKodeMK">Kode Mata Kuliah</label>
                        <input required type="text" name="kodeMK" class="form-control" id="inputKodeMK" placeholder="INF12001" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputNamaMK">Nama Mata Kuliah</label>
                        <input required type="text" name="namaMK" class="form-control" id="inputNamaMK" placeholder="Perancangan dan Implementasi Perangkat Lunak" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputSKS">Beban SKS</label>
                        <input required type="text" name="jumlahSKS" class="form-control" id="inputJumlahSKS" placeholder="3" value="">
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="/matakuliah">
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