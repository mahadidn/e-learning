<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Nilai Akhir</h1>
            <h1 class="h5 text-gray-800 mb-4">Mata Kuliah <?= $model['nilai_akhir'][0]['nama_mk'] ?></h3>
            <a href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiwa</th>
                            <th>NIM</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($model['nilai_akhir'] as $key => $value) { ?>
                    <?php
                        $nilaiakhir = (($value['nilai_tugas']) + $value['nilai_uts'] + $value['nilai_uas'] + $value['nilai_kelompok'])/4;    
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['nama_mhs'] ?></td>
                            <td><?= $value['nim'] ?></td>
                            <td><?= $nilaiakhir ?></td>
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