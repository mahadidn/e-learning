<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Edit Data Tahun Akademik</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <?php $path = $_SERVER['PATH_INFO'];
                    $semester = explode("/", $path);
                ?>
                <form method="POST" action="/tahunakademik/edit/semester/<?= $semester[4] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputSemester">Semester</label>
                        <select class="form-control" id="opsiSemester" name="nama_semester">
                            <option selected>Pilih Semester</option>
                            <option value="Ganjil">Semester Ganjil</option>
                            <option value="Genap">Semester Genap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputTahun">Tahun</label>
                        <input required type="text" name="tahun" class="form-control" id="inputTahun" value="<?= $model['tahun'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select class="form-control" id="opsiStatus" name="status">
                            <option selected>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Perbaikan">Perbaikan</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="/tahunakademik">
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