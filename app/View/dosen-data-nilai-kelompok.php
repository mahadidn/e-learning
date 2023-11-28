<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Data Nilai Kelompok</h1>
            <h1 class="h5 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
            <a href="dosen-data-kelas.php" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
            <a href="form-nilai-kelompok.php" class="btn btn-base">Tambah Data</a>
            <a href="form-kriteria-penilaian.php" class="btn btn-info">Kelola Kriteria Penilaian</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nilai Kriteria 1</th>
                            <th>Nilai Kriteria 2</th>
                            <th>Nilai Kinerja</th>
                            <th>Nilai Kelompok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-success btn-sm mr-2" href="edit-data-nilai-kelompok.php?">Edit</a>
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