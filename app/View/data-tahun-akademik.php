<?php
  include 'includes/header.php';
  include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Tahun Akademik</h1>
            <p class="mb-4">Berikut merupakan data tahun akademik yang telah terdaftar pada sistem.</p>
            <a type="button" class="btn btn-base" href="/tahunakademik/tambah">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model['tahunAkademik'] as $key => $value) { ?>
                        <tr>
                            <td><?= $value['tahun'] ?></td>
                            <td><?= $value['nama_semester'] ?></td>
                            <td><?= $value['status'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-orange btn-sm mr-2" href="/tahunakademik/edit/semester/<?= $value['id_semester'] ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="/tahunakademik/hapus/semester/<?= $value['id_semester'] ?>">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- SweetAlert -->
<script src="/assets/js/sweetalert.min.js"></script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>