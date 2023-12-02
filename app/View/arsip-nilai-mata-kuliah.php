<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Data Arsip Nilai</h1>
            <h1 class="h5 text-gray-800 mb-4">Mata Kuliah</h1>
        </div>
        <div class="d-sm-flex align-items-center justify-content-start">
            <a href="/matakuliah" class="btn btn-warning ml-2 py-0"><i class="fa fa-reply-all text-light" style="font-size: 15px"></i><a>
            <div class="dropdown show p-2">
                 <a class="btn btn-base btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Semester Ganji 2023/2024</a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
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
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
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
                                    <a class="btn btn-orange btn-sm mr-2" href="/matakuliah/arsip/edit">Edit</a>
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