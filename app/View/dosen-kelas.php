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


    <?php foreach ($model['matakuliah'] as $key => $value) { ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow" style="max-width: 20rem;">
            <img class="card-img-top" src="/assets/img/background.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="text-dark font-weight-bold"><?= $value['nama_mk'] ?></h5>
                <p class="text-dark">Kapasitas: <?= $value['kapasitas'] ?></p>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="/kelas/dosen/detail/<?= $value['id_kelas'] ?>" class="btn btn-warning">Masuk</a>
            </div>
        </div>
    </div>
    <?php } ?>

  </div>
</div>
</div>

<?php
  include 'includes/scripts.php';
  include 'includes/footer.php';
?>