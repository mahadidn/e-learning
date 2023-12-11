<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Kelas <?= $model['matakuliah'][0]['nama_mk'] ?></h1>
            <a href="/kelas/dosen" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
            <a href="/kelas/dosen/detail/kelompok" class="btn btn-base mr-1">Data Kelompok</a>
            <a href="/kelas/dosen/detail/nilaimk" class="btn btn-dark mr-1">Nilai Mata Kuliah</a>
            <a href="/kelas/dosen/detail/nilaikelompok" class="btn btn-dark mr-1">Nilai Kelompok</a>
            <a href="/kelas/dosen/detail/nilaiakhir" class="btn btn-secondary mr-1">Nilai Akhir</a>
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
                    <?php foreach ($model['mahasiswa'] as $key => $value) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['nim'] ?></td>
                        </tr>
                    <?php $i++; } ?>
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