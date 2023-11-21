<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Penilaian Kinerja Anggota Kelompok</h1>
            <p>Anda adalah Kelompok 1</p>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputAnggota">Pilih Anggota</label>
                        <select class="form-control" id="opsiDosen">
                            <option value="">Anggota 1</option>
                            <option value="">Anggota 2</option>
                            <option value="">Anggota 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputNilaiK1">Nilai Kriteria 1</label>
                        <input required type="number" name="nilaiK1" class="form-control" id="inputNilaiK1" placeholder="Skala 0-100" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputNilaiK2">Nilai Kriteria 2</label>
                        <input required type="number" name="nilaiK2" class="form-control" id="inputNilaiK2" placeholder="Skala 0-100" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Komentar</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-base" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="index.php">
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