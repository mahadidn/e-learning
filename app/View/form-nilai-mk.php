<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Nilai Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKelompok">Kelompok</label>
                        <select class="form-control" id="opsiKelompok">
                            <option value="">Kelompok 1</option>
                            <option value="">Kelompok 2</option>
                            <option value="">Kelompok 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputTugas">Tugas</label>
                        <input required type="text" name="tugas" class="form-control" id="inputTugas" placeholder="Skala 0 -100" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputUTS">UTS</label>
                        <input required type="text" name="uts" class="form-control" id="inputUTS" placeholder="Skala 0 -100" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputUAS">UAS</label>
                        <input required type="text" name="uas" class="form-control" id="inputUAS" placeholder="Skala 0 -100" value="">
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="/kelas/dosen/detail/nilaimk">
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
<script src="/assets/js/sweetalert.min.js"></script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>