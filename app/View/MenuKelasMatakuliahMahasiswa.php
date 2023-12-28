<?php
  include 'includes/header.php';
  include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kelas yang Tersedia</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- ketika mahasiswa sudah gabung ke kelas mata kuliah, maka button gabung pada kelas tersebut berubah menjadi masuk -->
    <?php $i = 0 ?>
    <?php foreach ($model['kelas'] as $key => $value) { ?>
        <?php if($value['id_kelas'] == $model['kelas_mahasiswa'][$i]['id_kelas']){ ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow" style="max-width: 20rem;">
                    <img class="card-img-top" src="/assets/img/background.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="text-dark font-weight-bold"><?= $value['matakuliah'] ?></h5>
                        <p class="text-dark">Kapasitas: <?= $value['kapasitas'] ?></p>
                        <p class="text-dark"><?= $value['nama_kelas'] ?></p>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="/kelas/mahasiswa/<?= $value['id_kelas'] ?>" class="btn btn-warning">Masuk</a> 
                    </div>
                </div>
            </div>
            <?php $i++; ?>
        <?php }else { ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow" style="max-width: 20rem;">
                    <img class="card-img-top" src="/assets/img/background.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="text-dark font-weight-bold"><?= $value['matakuliah'] ?></h5>
                        <p class="text-dark">Kapasitas: <?= $value['kapasitas'] ?></p>
                        <p class="text-dark"><?= $value['nama_kelas'] ?></p>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-warning" onclick="konfirmasi(<?= $value['id_kelas'] ?>)">Gabung</button> 
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

  </div>
</div>
</div>

<script>
    function konfirmasi(id_kelas) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin gabung ke kelas ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#f6c23e',
            cancelButtonColor: '#e74a3b',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Gabung'
        }).then((result) => {
            if (result.isConfirmed) {
                //disini logika agar pilihan kelas mahasiswa disimpan di db

                window.location.href = `/kelas/mahasiswa/gabung/${id_kelas}`;
            }
        });
    }
</script>

<?php
  include 'includes/scripts.php';
  include 'includes/footer.php';
?>