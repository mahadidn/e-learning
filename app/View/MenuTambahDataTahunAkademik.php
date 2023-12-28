<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Data Tahun Akademik</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="/tahunakademik/tambah" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputSemester">Semester</label>
                        <select class="form-control" id="opsiSemester" name="nama_semester">
                            <option value="Ganjil">Semester Ganjil</option>
                            <option value="Genap">Semester Genap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputTahun">Tahun</label>
                        <input required type="text" name="tahun" class="form-control" id="inputTahun" placeholder="2023/2024" >
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select class="form-control" id="opsiStatus" name="status">
                            <option value="Aktif">Aktif</option>
                            <option value="Perbaikan">Perbaikan</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('tambah')" name="" value="">
                            Simpan
                        </button>
                        <!-- <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('edit')" name="" value="">
                            Simpan
                        </button> -->
                        <a type="button" class="btn btn-danger" href="/tahunakademik">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- container-fluid -->

<script>

    function konfirmasi(action) {
        let text, confirmButtonText;

        if (action === 'tambah') {
            text = 'Apakah Anda yakin ingin tambah data?';
            confirmButtonText = 'Tambah';
        } else if(action === 'edit') {
            text = 'Apakah Anda yakin ingin edit data?';
            confirmButtonText = 'Edit';
        }

        Swal.fire({
            title: 'Konfirmasi',
            text: text,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0c974a',
            cancelButtonColor: '#e74a3b',
            cancelButtonText: 'Batal',
            confirmButtonText: action
        }).then((result) => {
            if (result.isConfirmed) {
                if (action === 'tambah') {
                    // Handle tambah action
                    window.location.href = "/tahunakademik";
                } else if (action === 'edit') {
                    // Handle edit action
                    window.location.href = "/tahunakademik";
                }
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>