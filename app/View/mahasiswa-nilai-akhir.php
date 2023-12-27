<?php
    include 'includes/header.php';
    include 'includes/navbar.php';

    use Klp1\ELearning\Config\Database;
    use Klp1\ELearning\Repository\KelolaNilaiRepository;
    use Klp1\ELearning\Service\KelolaNilaiService;


?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Nilai Akhir <?= $model['nama'] ?></h1>
            <p class="mb-4">Mata Kuliah</p>
            <a href="/kelas/mahasiswa/<?= $model['id_kelas'] ?>" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($model['nilaiakhir'] as $key => $value) {?>

                        <?php
                            // $nilaiakhir = ((int)($value['nilai_tugas']) + (int)$value['nilai_uts'] + (int)$value['nilai_uas'] + (int)$value['nilai_kelompok'])/4;
                            $nilaiakhir = (($value['nilai_tugas']) + $value['nilai_uts'] + $value['nilai_uas'] + $value['nilai_kelompok'])/4;

                            $nilaiRepo = new KelolaNilaiRepository(Database::getConnection());
                            $nilaiService = new KelolaNilaiService($nilaiRepo);

                            $nilaiService->updateNilai($nilaiakhir, $value['nama_mhs'], $value['id_kelas']);

                            ?>

                        <tr>
                            <td>1</td>
                            <td><?= $value['nama_mk'] ?></td>
                            <td><?= $nilaiakhir ?></td>
                        </tr>
                    <?php } ?>
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