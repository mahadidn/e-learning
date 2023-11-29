<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
            <a href="dosen-kelas.php" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
            <a href="dosen-data-kelompok.php" class="btn btn-base mr-1">Data Kelompok</a>
            <a href="dosen-data-nilai-mk.php" class="btn btn-dark mr-1">Nilai Mata Kuliah</a>
            <a href="dosen-data-nilai-kelompok.php" class="btn btn-dark mr-1">Nilai Kelompok</a>
            <a href="dosen-nilai-akhir.php" class="btn btn-secondary mr-1">Nilai Akhir</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>