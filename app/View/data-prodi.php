<?php
    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Prodi</h1>
            <p class="mb-4">Berikut merupakan data prodi yang telah terdaftar pada sistem.</p>
            <a type="button" class="btn btn-base" href="/dataprodi/tambah">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Prodi</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;?>
                    <?php foreach ($model['prodi'] as $key => $value) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $value['nama_prodi'] ?></td>
                            <td><?= $value['jumlah_mhs'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-orange btn-sm mr-2" href="/dataprodi/edit/<?= $value['id_prodi'] ?>">Edit</a>
                                    <a href="/dataprodi/hapus/<?= $value['id_prodi'] ?>" class="linkhapus" style="display:none;"></a>
                                    <button class="btn btn-danger btn-sm" onclick="konfirmasi(<?= (int)$value['id_prodi'] ?>)">Hapus</button>
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
                                
                window.location.href = `/dataprodi/hapus/${number}`;
                                
            }
        });
    }
</script>


<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>