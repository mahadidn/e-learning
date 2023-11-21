<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Arsip Nilai</h1>
            <p class="mb-4">Berikut merupakan arsip nilai mata kuliah Perancangan dan Implementasi Perangkat Lunak</p>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="btn-group p-3">
                <button class="btn btn-base btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Semester Ganjil 2023/2024
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Semester Ganjil 2023/2024</a>
                    <a class="dropdown-item" href="#">Semester Genap 2023/2024</a>
                    <a class="dropdown-item" href="#">Semester Ganjil 2022/2023</a>
                    <a class="dropdown-item" href="#">Semester Genap 2022/2023</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-success btn-sm mr-2" href="form-tahun-akademik.php">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="fungsi.php?">Hapus</a>
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

<!-- SweetAlert -->
<script src="js/sweetalert.min.js"></script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>