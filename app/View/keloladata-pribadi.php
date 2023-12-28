<?php
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Edit Data Pribadi</h1>
      <?php if(isset($model['error'])){ ?>
        <div class="row">
            <div class="alert alert-danger" role="alert">
                <?= $model['error'] ?>
            </div>
        </div>
      <?php } ?>
      <p class="mb-4">Berikut merupakan data pribadi Anda.</p>
    </div>

    <div class="row">
      <!-- User Information Form -->
      <div class="col-xl-8 col-lg-7">
        <div class="card mb-4">
          <!-- Card Body -->
          <div class="card-body">
            <?php if($model['usertype'] == 'mahasiswa'){ ?>
              <form method="POST" action="/data/mahasiswa" enctype="multipart/form-data">
            <?php } ?> 
            <?php if($model['usertype'] == 'admin'){ ?>
              <form method="POST" action="/data/admin" enctype="multipart/form-data">
            <?php } ?> 
            <?php if($model['usertype'] == 'dosen'){ ?>
              <form method="POST" action="/data/dosen" enctype="multipart/form-data">
            <?php } ?>
            <?php if($model['usertype'] == 'dosen' || $model['usertype'] == 'mahasiswa'){ ?>
              <div class="form-group">
                <label for="inputNama">Nama Lengkap</label>
                <input disabled type="text" name="nama" class="form-control" id="inputNama" value="<?= $model['nama'] ?>" />
              </div>
              <div class="form-group">
                <label for="inputJenisKelamin">Jenis Kelamin</label>
                <select class="form-control" id="opsiJenisKelamin" name="jenis_kelamin">
                  <option value="laki-laki">Laki-Laki</option>
                  <option value="perempuan">Perempuan</option>
                </select>
              </div>
            <?php } ?>


              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputUsername">Username</label>
                  <input required type="text" name="username" disabled class="form-control" id="inputUsername" value="<?= $model['username'] ?>" />
                </div>
                <div class="form-group col-md-6">

              <?php if($model['usertype'] == 'mahasiswa'){ ?>
                <label for="inputNim">Nim</label>
                <input required type="number" name="nim" class="form-control" id="inputNim" value="<?= $model['nim'] ?>" />
              <?php }?>
              <?php if($model['usertype'] == 'dosen'){ ?>
                <label for="inputNim">Nidn</label>
                <input required type="number" name="nidn" class="form-control" id="inputNim" value="<?= $model['nidn'] ?>" />
              <?php }?>
              
              </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail">Email</label>
                  <input required type="email" name="email" class="form-control" id="inputEmail" value="<?= $model['email'] ?>" />
                </div>

                <?php if($model['usertype'] == 'dosen' || $model['usertype'] == 'mahasiswa'){ ?>
                  <div class="form-group col-md-6">
                    <label for="inputProdi">Prodi</label>
                    <select class="form-control" id="opsiProdi" name="prodi">
                      <option value="Teknik Informatika">Teknik Informatika</option>
                      <option value="Teknik Elektro">Teknik Elektro</option>
                      <option value="Teknik Perkapalan">Teknik Perkapalan</option>
                    </select>
                  </div>
                <?php } ?>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPassword">Password Baru</label>
                  <input required type="password" name="password" class="form-control" id="inputPassword" placeholder="" />
                </div>
                <div class="form-group col-md-6">
                  <label for="inputKonfirmasiPassword">Konfirmasi Password Baru</label>
                  <input required type="password" name="konfirmasiPassword" class="form-control" id="inputKonfirmasiPassword" placeholder="" />
                </div>
              </div>
              <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi()" name="aksi" value="">Simpan</button>
            </form>
          </div>
          <div class="card-header py-0">
            <!-- <a type="button" class="btn btn-danger" href="index.php">Kembali</a> -->
            <?php if($model['usertype'] == "mahasiswa"){ ?>
              <a type="button" class="btn btn-danger" href="/data/mahasiswa">Batal Ubah</a>
            <?php } ?>
            <?php if($model['usertype'] == "dosen"){ ?>
              <a type="button" class="btn btn-danger" href="/data/dosen">Batal Ubah</a>
            <?php } ?>
            <?php if($model['usertype'] == "admin"){ ?>
              <a type="button" class="btn btn-danger" href="/data/admin">Batal Ubah</a>
            <?php } ?>
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

<script>
    function konfirmasi() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin mengedit data?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0c974a',
            cancelButtonColor: '#e74a3b',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Simpan'
        }).then((result) => {
            if (result.isConfirmed) {
            
                window.location.href = "/data/dosen";
                // window.location.href = "/data/mahasiswa";
                // window.location.href = "/data/administrator";
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>