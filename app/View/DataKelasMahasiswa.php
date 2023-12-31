<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Kelas <?= $model['kelas'][0]['matakuliah'] ?></h1>
            <p class="mb-4">Dosen Pengampu : <?= $model['kelas'][0]['nama_dosen'] ?></p>
            <a href="/kelas/mahasiswa" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
            <a href="/kelas/mahasiswa/detail/nilaiakhir/<?= $model['id_kelas'] ?>" class="btn btn-base mr-1">Lihat Nilai Akhir</a>
            <a href="/kelas/mahasiswa/detail/datapenilaian/<?= $model['id_kelas'] ?>" class="btn btn-dark">Data Penilaian Kinerja</a>
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
                    <?php $i = 1; ?>
                    <?php foreach ($model['kelas'] as $key => $value) {?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['nim'] ?></td>
                        </tr>
                    <?php $i++;} ?>
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