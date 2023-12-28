<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Kelas</h1>
            <p class="mb-4">Berikut merupakan data kelas yang telah terdaftar pada semester ini.</p>
            <a type="button" class="btn btn-base" href="/kelas/admin/tambah">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Kapasitas</th>
                            <th>Dosen Pengampu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($model['kelas'] as $key => $value) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['id_kelas'] ?></td>
                            <td><?= $value['nama_kelas'] ?></td>
                            <td><?= $value['kapasitas'] ?></td>
                            <td><?= $value['nama_dosen'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-orange btn-sm mr-2" href="/kelas/admin/edit/<?= $value['id_kelas'] ?>">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="konfirmasi(<?= (int)$value['id_kelas'] ?>)">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    <?php $i++; } ?>
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
            
                window.location.href = `/kelas/admin/hapus/${number}`;
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>