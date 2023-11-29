<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <!-- Page Heading -->
        <div class="card-header py-3">
            <h1 class="h3 mb-2 text-gray-800">Data Mata Kuliah</h1>
            <p class="mb-4">Berikut merupakan data mata kuliah yang telah terdaftar pada sistem.</p>
            <a type="button" class="btn btn-base" href="form-mata-kuliah.php">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Beban SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-dark btn-sm mr-2" href="arsip-nilai-mata-kuliah.php">Arsip</a>
                                    <a class="btn btn-orange btn-sm mr-2" href="form-mata-kuliah.php?">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="proses.php?">Hapus</a>
                                </div>
                            </td>
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