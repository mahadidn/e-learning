<?php
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Data Pribadi</h1>
      <p class="mb-4">Berikut merupakan data pribadi Anda.</p>
    </div>

    <div class="row">
      <!-- User Information Form -->
      <div class="col-xl-8 col-lg-7">
        <div class="card mb-4">
          <!-- Card Body -->
          <div class="card-body">
            <?php if($model['usertype'] == 'mahasiswa' || $model['usertype'] == 'dosen'){ ?>
              <div class="form-group">
                <label for="inputNama">Nama Lengkap</label>
                <input type="text" name="nama_mhs" class="form-control" id="inputNama" disabled value="<?= $model['nama'] ?>" />
              </div>
              <div class="form-group">
                <label for="inputJenisKelamin">Jenis Kelamin</label>
                <input type="text" name="nama_mhs" class="form-control" id="inputNama" disabled value="<?= $model['jenis_kelamin'] ?>" />
              </div>
            <?php } ?>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputUsername">Username</label>
                  <input type="text" name="nama_mhs" class="form-control" id="inputNama" disabled value="<?= $model['username'] ?>" />
                </div>
                <div class="form-group col-md-6">
                <?php if($model['usertype'] == 'mahasiswa'){ ?>
                  <label for="inputNim">Nim</label>
                  <input type="text" name="nama_mhs" class="form-control" id="inputNama" disabled value="<?= $model['nim'] ?>" />
                <?php }?>
                <?php if($model['usertype'] == 'dosen'){ ?>
                  <label for="inputNim">nidn</label>
                  <input type="text" name="nama_mhs" class="form-control" id="inputNama" disabled value="<?= $model['nidn'] ?>" />
                <?php }?>
              </div>

              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail">Email</label>
                  <input type="text" name="nama_mhs" class="form-control" id="inputNama" disabled value="<?= $model['email'] ?>" />
                </div>
                <?php if($model['usertype'] == 'mahasiswa' || $model['usertype'] == 'dosen'){ ?>
                <div class="form-group col-md-6">
                  <label for="inputProdi">Prodi</label>
                  <input type="text" name="nama_mhs" class="form-control" id="inputNama" disabled value="<?= $model['prodi'] ?>" />
                </div>
                <?php } ?>
              </div>
              
          </div>
          <div class="card-header py-3">
            <?php if ($model['usertype'] == "mahasiswa"){ ?>
            <a type="submit" class="btn btn-green mr-1" href="/data/editmahasiswa">Edit Profil</a>
            <?php } ?>
            <?php if ($model['usertype'] == "dosen"){ ?>
            <a type="submit" class="btn btn-green mr-1" href="/data/editdosen">Edit Profil</a>
            <?php } ?>
            <?php if ($model['usertype'] == "admin"){ ?>
            <a type="submit" class="btn btn-green mr-1" href="/data/editadmin">Edit Profil</a>
            <?php } ?>
            <a type="button" class="btn btn-danger" href="/">Kembali</a>
          </div>
        </div>
      </div>
      <!-- User Profil Pitcure -->
      <div class="col-xl-4 col-lg-5">
        <div class="card mb-4">
          <!-- Card Body -->
          <div class="card-body">
            <img class="card-img-top img-fluid p-xl-3" src="/assets/img/user.png" alt="Card image cap" />
            <div class="card-body">
              <div class="form-group">
                <input type="file" name="foto" class="form-control-file mb-1" id="foto" accept="image/*" />
                <p class="small">*Ukuran maksimal foto adalah 500 kb</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<!-- SweetAlert -->
<script src="/assets/js/sweetalert.min.js"></script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>