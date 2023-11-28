<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi - E-learning</title>
    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet" />

  </head>
  <body class="bg-basecolor">
    <div class="container">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-10 ">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-lg-flex justify-content-lg-center">
                    <img src="/assets/img/background.jpg" class="img-fluid" alt="background">
                </div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Registrasi Dosen</h1>
                      <?php if(isset($model['error'])){ ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                <?= $model['error'] ?>
                            </div>
                        </div>
                      <?php } ?>
                    </div>
                    <form method="POST" action="/register/dosen" class="user">
                      <div class="form-group">
                        <input required type="text" name="nama" autocomplete="off" class="form-control form-control-lg " style="border-radius: 20px; font-size: 13px;" id="inputNama" placeholder="Nama Lengkap" />
                      </div>
                      <div class="form-group">
                        <select class="form-control form-control-lg" name="jenisKelamin" id="jenisKelamin" style="border-radius: 20px; font-size: 13px;"> 
                          <option value="" disabled selected class="">Jenis Kelamin</option>
                          <option value="laki-laki">Laki-Laki</option>
                          <option value="perempuan">Perempuan</option>
                        </select>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <input required type="text" name="username" class="form-control form-control-lg" style="border-radius: 20px; font-size: 13px;" id="inputUsername" placeholder="Username" />
                        </div>
                        <div class="form-group col-md-6">
                        <input required type="number" name="nidn" class="form-control form-control-lg" style="border-radius: 20px; font-size: 13px;" id="inputNidn" placeholder="Nidn" />
                      </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <input required type="email" name="email" class="form-control form-control-lg" style="border-radius: 20px; font-size: 13px;" id="inputEmail" placeholder="Email" />
                        </div>
                        <div class="form-group col-md-6">
                          <select class="form-control form-control-lg" name="jurusan" style="border-radius: 20px; font-size: 13px;" id="jurusan">
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Teknik Perkapalan">Teknik Perkapalan</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <input required type="password" name="password" class="form-control form-control-lg" style="border-radius: 20px; font-size: 13px;" id="inputPassword" placeholder="Password" />
                        </div>
                        <div class="form-group col-md-6">
                          <input required type="password" name="konfirmasiPassword" class="form-control form-control-lg" style="border-radius: 20px; font-size: 13px;" id="inputKonfirmasiPassword" placeholder="Konfirmasi Password" />
                        </div>
                      </div>
                      <button class="btn btn-base btn-user btn-block" type="submit">Register</button>
                      <hr/>
                    </form>
                    <div class="text-center">
                      <p class="small"><a class="font-weight-bold" href="/register/mahasiswa">Daftar sebagai Mahasiswa</a></p>
                      <p class="small">Sudah mempunyai Akun? <a class="font-weight-bold" href="/">Login</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
