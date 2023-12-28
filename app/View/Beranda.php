<?php
  include 'includes/header.php';
  include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="btn-group">
      <button class="btn btn-base btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Semester Ganjil 2023/2024
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Semester Ganjil 2023/2024</a>
        <a class="dropdown-item" href="#">Semester Genap 2023/2024</a>
        <a class="dropdown-item" href="#">Semester Ganjil 2022/2023</a>
        <a class="dropdown-item" href="#">Semester Genap 2022/2023</a>
      </div>
    </div>
  </div>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">

  <?php if($model['usertype'] == "admin"){ ?>
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Beranda <?= $model['username'] ?></h1>
  <?php }?>
  <?php if($model['usertype'] != "admin"){ ?>
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Beranda <?= $model['nama'] ?></h1>
  <?php }?>

  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <?php if($model['usertype'] == "admin"){ ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pengguna Terdaftar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  10
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-address-card fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Mata Kuliah Semester ini</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  10
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-book fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Kelas Semester ini</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  10
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-address-card fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php
  include 'includes/scripts.php';
  include 'includes/footer.php';
?>