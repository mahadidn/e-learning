<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Data Nilai Mata Kuliah</h1>
            <a href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nilai Tugas</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Nilai Kelompok</th>
                            <th>Total Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($model['nilai'] as $key => $value) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['nama_mhs'] ?></td>
                            <td><?= $value['nilai_tugas'] ?? '0' ?></td>
                            <td><?= $value['nilai_uts'] ?? '0' ?></td>
                            <td><?= $value['nilai_uas'] ?? '0' ?></td>
                            <td><?= $value['nilai_kelompok'] ?? '0' ?></td>

                            <?php

                                if(isset($value['nilai_uts'])){
                                    $total = ((int)$value['nilai_tugas'] + (int)$value['nilai_uts'] + (int)$value['nilai_uas'] + (int)$value['nilai_kelompok'])/4;
                                }else {
                                    $total = 0;
                                }
                            
                            ?>
                            
                            <td><?= $total ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-success btn-sm mr-2" href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>/nilaimk/<?= $value['id_nilai'] ?>/tambah">Tambah</a>
                                    <a class="btn btn-orange btn-sm mr-2" href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>/nilaimk/<?= $value['id_nilai'] ?>/edit">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="konfirmasi(<?= $value['id_nilai'] ?>)">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    function konfirmasi(id_nilai) {
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
            
                window.location.href = `/kelas/dosen/detail/<?= $model['id_kelas'] ?>/nilaimk/${id_nilai}/hapus`;
            }
        });
    }
</script>


<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>