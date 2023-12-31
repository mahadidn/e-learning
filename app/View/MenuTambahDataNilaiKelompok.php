<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Form Nilai Kelompok</h1>
            <h1 class="h5 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputDosen">Nama</label>
                        <select class="form-control" id="opsiDosen">
                            <option value=""><?= $model['kelompok']['nama_mahasiswa'] ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputNilaikelompok">Nilai Kelompok</label>
                        <input required type="number" name="nilaiKelompok" class="form-control" id="inputNilaiKelompok" placeholder="Skala 0 -100" value="">
                        <input type="text" hidden name="nama" value="<?= $model['kelompok']['nama_mahasiswa'] ?>">
                        <input type="text" hidden name="matakuliah" value="<?= $model['matakuliah'] ?>">
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>/nilaikelompok">
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
                    window.location.href = "/kelas/dosen/detail/nilaikelompok";
                } else if (action === 'edit') {
                    // Handle edit action
                    window.location.href = `http://localhost:8081/kelas/dosen/detail/12/nilaikelompok/edit/34`;
                }
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>