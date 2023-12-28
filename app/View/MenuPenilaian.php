<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Penilaian Kinerja</h1>
            <p class="mb-4">Anda adalah <?= $model['kelompok'][0]['nama_kelompok'] ?></p>
            <a href="/kelas/mahasiswa/<?= $model['id_kelas'] ?>" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Nilai Kriteria 1</th>
                            <th>Nilai Kriteria 2</th>
                            <th>Nilai rata-rata</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php $i = 1 ?>
                    <?php foreach ($model['kinerja_kelompok'] as $key => $value) {?>

                        
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['nim'] ?></td>
                            <?php if($value['nama'] != $model['nama']){?>
                            <td><?= $value['nilai_kriteria1'] ?? '0' ?></td>
                            <td><?= $value['nilai_kriteria2'] ?? '0' ?></td>
                            <?php
                                if ($value['nilai_kriteria1'] != null){
                                    $total = ((int)$value['nilai_kriteria1'] + (int)$value['nilai_kriteria2'])/2;
                                }else {
                                    $total = "0";
                                }
                            
                            ?>

                            <td><?= $total ?></td>
                            <?php }else { ?>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php } ?>

                            <?php if($value['nama'] != $model['nama']){?>
                            
                                <td><a href="/kelas/mahasiswa/detail/formpenilaian/<?= $model['id_kelas'] ?>/tambah/<?= $value['id_kinerja_kelompok'] ?>" class="btn btn-base">Penilaian</a></td>
                            <?php }else { ?>
                                <td></td>
                            <?php } ?>
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