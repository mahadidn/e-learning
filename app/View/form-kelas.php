<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Kelas Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKodeKelas">Kode Kelas</label>
                        <input required type="text" name="kodeKelas" class="form-control" id="inputKodeKelas" placeholder="INF12001" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputNamaKelas">Nama Kelas</label>
                        <input required type="text" name="namaKelas" class="form-control" id="inputKelas" placeholder="Perancangan dan Implementasi Perangkat Lunak" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputKapasitas">Kapasitas</label>
                        <input required type="text" name="kapasitas" class="form-control" id="inputKapasitas" placeholder="40" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputDosen">Dosen Pengampu</label>
                        <select class="form-control" id="opsiDosen">
                            <option value="">Dosen A</option>
                            <option value="">Dosen B</option>
                            <option value="">Dosen C</option>
                        </select>
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('tambah')" name="" value="">
                            Simpan
                        </button>
                        <!-- <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('edit')" name="" value="">
                            Simpan
                        </button> -->
                        <a type="button" class="btn btn-danger" href="/kelas/admin">
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
                    window.location.href = "/kelas/admin";
                } else if (action === 'edit') {
                    // Handle edit action
                    window.location.href = "/kelas/admin";
                }
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>