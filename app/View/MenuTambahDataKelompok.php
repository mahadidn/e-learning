<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Form Kelompok</h1>
            <h1 class="h5 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKelompok">Nama Kelompok</label>
                        <input required type="text" name="namaKelompok" class="form-control" id="inputKelas" placeholder="Kelompok 1" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputMahasiswa">Anggota</label>
                        <select id="select-mahasiswa" multiple name="Anggota[]">
                        
                        <?php foreach ($model['mahasiswa'] as $key => $value) { ?>
                            <option value="<?= $value['nama'] ?>"><?= $value['nama'] ?></option>
                        <?php } ?>        
                        </select>
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('tambah')" name="" value="">
                            Simpan
                        </button>
                        <!-- <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('edit')" name="" value="">
                            Simpan
                        </button> -->
                        <a type="button" class="btn btn-danger" href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>/kelompok">
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
    new MultipleSelect('#select-mahasiswa', {
        placeholder: 'Pilih Anggota'
    })

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
                    window.location.href = "/kelas/dosen/detail/<?= $model['id_kelas'] ?>/kelompokdetail";
                } else if (action === 'edit') {
                    // Handle edit action
                    window.location.href = "/kelas/dosen/detail/kelompok";
                }
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>