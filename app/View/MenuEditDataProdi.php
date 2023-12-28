<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Data Prodi</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">

            <?php if(strstr(strtolower($model['title']), "edit")){ ?>

                <form method="POST" action="" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="inputNamaProdi">Nama Prodi</label>
                        <input required type="text" name="namaProdi" class="form-control" id="inputNamaProdi" value="<?= $model['prodi']['nama_prodi'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputJumlahMhs">Jumlah Mahasiswa</label>
                        <input required type="text" name="jumlahMhs" class="form-control" id="inputJumlahMhs" value="<?= $model['prodi']['jumlah_mhs'] ?>">
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('edit')" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="/dataprodi">
                            Kembali
                        </a>
                    </div>
                </form>

            <?php } else { ?>
            
                <form method="POST" action="" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="inputNamaProdi">Nama Prodi</label>
                        <input required type="text" name="namaProdi" class="form-control" id="inputNamaProdi" placeholder="Teknik Informatika" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputJumlahMhs">Jumlah Mahasiswa</label>
                        <input required type="text" name="jumlahMhs" class="form-control" id="inputJumlahMhs" placeholder="100" value="">
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('tambah')" name="" value="">
                            Simpan
                        </button>
                        <!-- <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('edit')" name="" value="">
                            Simpan
                        </button> -->
                        <a type="button" class="btn btn-danger" href="/dataprodi">
                            Kembali
                        </a>
                    </div>
                </form>

            <?php } ?>

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
                    window.location.href = "/prodi";
                } else if (action === 'edit') {
                    // Handle edit action
                    window.location.href = "/dataprodi/edit/<?= $model['prodi']['id_prodi'] ?>";
                }
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>