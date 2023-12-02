<!-- Sidebar -->
<ul class="navbar-nav bg-basecolor sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
        <i class="fas fa-laptop-code text-warning" style="font-size: 20px;"></i>
    </div>
    <div class="sidebar-brand-text mx-3 text-warning font-weight-bold">E-Learning</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Beranda -->
  <!-- Role: Admin, Dosen, Mahasiswa -->
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Beranda</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  
  <!-- Data Pribadi -->
  <!-- Role: Admin, Dosen, Mahasiswa -->
  <li class="nav-item">
    <a class="nav-link" href="data-pribadi.php">
      <i class="fas fa-address-card"></i>
      <span>Data Pribadi</span></a>
  </li>

  <!-- Data Tahun Akademik -->
  <!-- Role: Admin -->
  <li class="nav-item">
    <a class="nav-link" href="data-tahun-akademik.php">
      <i class="fas fa-book"></i>
      <span>Tahun Akademik</span></a>
  </li>

  <!-- Data Prodi-->
  <!-- Role: Admin -->
  <li class="nav-item">
    <a class="nav-link" href="data-prodi.php">
      <i class="fas fa-users"></i>
      <span>Prodi</span></a>
  </li>

  <!-- Data Mata Kuliah -->
  <!-- Role: Admin -->
  <li class="nav-item">
    <a class="nav-link" href="data-mata-kuliah.php">
      <i class="fas fa-book"></i>
      <span>Mata Kuliah</span></a>
  </li>

  <!-- Data Kelas Mata Kuliah -->
  <!-- Role: Admin, Dosen, Mahasiswa -->
  <li class="nav-item">
    <a class="nav-link" href="data-kelas.php">
      <!-- untuk role dosen menuju ke file dosen-kelas.php -->
      <!-- untuk role mahasiswa menuju ke file mahasiswa-kelas.php -->
      <i class="fas fa-school"></i>
      <span>Kelas Mata Kuliah</span></a>
  </li>

  <!-- Tambahan Fitur Kelas -->
  <!-- Role: Dosen dan Mahasiswa -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-school"></i>
        <span>Kelas Anda</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="buttons.html">Kelas Mata Kuliah A</a>
        <a class="collapse-item" href="cards.html">Kelas Mata Kuliah B</a>
        </div>
      </div>
  </li> -->
  
  <!-- Logout-->
  <!-- Role: Admin, Dosen, Mahasiswa -->
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-door-open"></i>
      <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars text-base"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">username</span>
                <img class="img-profile rounded-circle" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik Keluar untuk mengakhiri sesi ini</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <form action="./login.php" method="POST">
            <button type="submit" name="logout_btn" class="btn btn-base">Keluar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
