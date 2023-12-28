<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Nilai Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputKelompok">Nama</label>
                        <select class="form-control" id="opsiKelompok">
                            <option value=""><?= $model['nilai_mhs']['nama_mhs'] ?></option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputTugas">Tugas</label>
                            <input required type="text" name="tugas" class="form-control" id="inputTugas" placeholder="Skala 0 -100" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPresentase">Persentase</label>
                            <input required disabled type="text" name="Persentase" class="form-control" id="inputPersentase" placeholder="30%" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputUTS">UTS</label>
                            <input required type="text" name="uts" class="form-control" id="inputUTS" placeholder="Skala 0 -100" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPresentase">Persentase</label>
                            <input required disabled type="text" name="Persentase" class="form-control" id="inputPersentase" placeholder="30%" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputUAS">UAS</label>
                            <input required type="text" name="uas" class="form-control" id="inputUAS" placeholder="Skala 0 -100" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPresentase">Persentase</label>
                            <input required disabled type="text" name="Persentase" class="form-control" id="inputPersentase" placeholder="40%" value="">
                        </div>
                    </div>
                    <div class="card-header py-3"> 
                        <button type="submit" class="btn btn-green mr-1" name="" value="">
                            Simpan
                        </button>
                        <!-- <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi('edit')" name="" value="">
                            Simpan
                        </button> -->
                        <a type="button" class="btn btn-danger" href="/kelas/dosen/detail/<?= $model['id_kelas'] ?>/nilaimk">
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
                    window.location.href = "/kelas/dosen/detail/nilaimk";
                } else if (action === 'edit') {
                    // Handle edit action
                    window.location.href = "/kelas/dosen/detail/nilaimk";
                }
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>