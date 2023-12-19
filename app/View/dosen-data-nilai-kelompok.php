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
            <a href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>" class="btn btn-warning mr-2"><i class="fa fa-reply-all text-light" style="font-size: 20px"></i></a>
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
                            <th>Nilai Kelompok (dinilai dosen)</th>
                            <th>Total Nilai Kinerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?= $i = 1; ?>
                    <?php foreach ($model['kelompok'] as $key => $value) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['nama_mahasiswa'] ?></td>
                            <td><?= $value['nilai_kriteria1'] ?? '0' ?></td>
                            <td><?= $value['nilai_kriteria2'] ?? '0' ?></td>
                            <td><?= $value['nilai_dosen'] ?? '0' ?></td>
                            <?php
                                if ($value['nilai_kriteria1' != null]){
                                    $total = ((int)$value['nilai_kriteria1']+(int)$value['nilai_kriteria2']+(int)$value['nilai_dosen'])/3;
                                }else {
                                    $total = 0;
                                }
                            
                            ?>
                            <td><?= $total ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-green btn-sm mr-2" href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>/nilaikelompok/tambah/<?= $value['id_kelompok'] ?>/<?= $value['id_kinerja_kelompok'] ?>">Tambah</a>
                                    <a class="btn btn-orange btn-sm mr-2" href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>/nilaikelompok/edit/<?= $value['id_kelompok'] ?>/<?= $value['id_kinerja_kelompok'] ?>">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="konfirmasi(<?= $value['id_kinerja_kelompok'] ?>)">Hapus</button>
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
    function konfirmasi(id_kinerja_kelompok) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus nilai?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0c974a',
            cancelButtonColor: '#e74a3b',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
            
                window.location.href = `/kelas/dosen/detail/<?= $model['id_kelas'] ?>/nilaikelompok/hapus/${id_kinerja_kelompok}`;
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>