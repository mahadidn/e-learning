<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Data Kelompok</h1>
            <h1 class="h5 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
            <a href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
            <a href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>/kelompokdetail" class="btn btn-base">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kelompok</th>
                            <th>Nama Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php var_dump($model['kelompok'][0]['id_mahasiswa']) ?>
                    <?php foreach ($model['kelompok'] as $key => $value) { ?>

                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['nama_kelompok'] ?></td>
                            <td><?= $value['nama_anggota'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger btn-sm" onclick="konfirmasi(<?= $value['id'] ?>, <?= $value['id_kelompok'] ?>, <?= $value['id_mahasiswa'] ?>)">Hapus</button>
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
    function konfirmasi(number, number_id, id_mahasiswa) {
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
            
                window.location.href = `/kelas/dosen/detail/<?= $model['id_kelas'] ?>/kelompokdetail/hapus/${number}/idkelompok/${number_id}/id_mhs/${id_mahasiswa}`;
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>