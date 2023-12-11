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
            <a type="button" class="btn btn-base" href="/matakuliah/tambah">Tambah Data</a>
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
                    <?php $i = 1; ?>
                    <?php $hapus = []; ?>
                    <?php foreach ($model['matakuliah'] as $key => $value) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['id_mk'] ?></td>
                            <td><?= $value['nama_mk'] ?></td>
                            <td><?= $value['sks'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-dark btn-sm mr-2" href="/matakuliah/arsip">Arsip</a>
                                    <a class="btn btn-orange btn-sm mr-2" href="/matakuliah/edit/<?= $value['id_mk'] ?>">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="konfirmasi(<?= (int)$value['id_mk'] ?>)">Hapus</button>
                                </div>
                                <?php $i++; $hapus[] = $value['id_mk']; } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    function konfirmasi(number) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus data?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0c974a',
            cancelButtonColor: '#e74a3b',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                                        
                window.location.href = `/matakuliah/hapus/${number}`;
            }
        });
    }
</script>


<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>