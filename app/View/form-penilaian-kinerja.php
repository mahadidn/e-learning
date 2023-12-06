<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Penilaian Kinerja Anggota Kelompok</h1>
            <p>Anda adalah Kelompok 1</p>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- nama anggota akan tampil dari yang pertama, ketika tombol selanjutnya ditekan maka yang tampil adalah nama anggota kedua. begitu seterusnya, hingga anggota habis. -->
                        <label for="inputAnggota">Anggota 1</label>
                        <input required type="text" disabled name="anggota" class="form-control" id="inputAnggota" placeholder="John Doe" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputNilaiK1">Nilai Kriteria 1</label>
                        <input required type="number" name="nilaiK1" class="form-control" id="inputNilaiK1" placeholder="Skala 0-100" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputNilaiK2">Nilai Kriteria 2</label>
                        <input required type="number" name="nilaiK2" class="form-control" id="inputNilaiK2" placeholder="Skala 0-100" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Komentar</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                    <div class="card-header py-3"> 
                        <!-- ketika tiba di penilaian anggota terakhir, tombol berubah menjadi simpan -->
                        <button type="submit" class="btn btn-green mr-1" name="" value="">
                           Selanjutnya
                        </button>
                        <!-- <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi()" name="" value="">
                           Simpan
                        </button> -->
                        <a type="button" class="btn btn-danger" href="/kelas/mahasiswa/detail/datapenilaian">
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
    function konfirmasi() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyimpan data?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0c974a',
            cancelButtonColor: '#e74a3b',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Simpan'
        }).then((result) => {
            if (result.isConfirmed) {
            
                window.location.href = "/kelas/mahasiswa/detail/datapenilaian";
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>