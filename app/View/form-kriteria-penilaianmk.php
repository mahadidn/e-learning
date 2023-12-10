<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Form Kriteria Nilai Mata Kuliah</h1>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-base mb-4" data-toggle="modal" data-target="#addCriteriaModal">
                    Tambah Kriteria
                </button>

                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKriteria">Kriteria</label>
                            <input required type="text" name="kriteria" class="form-control" id="inputKriteria" placeholder="Skala 0 -100" value="Tugas">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPresentase">Persentase</label>
                            <input required type="text" name="Persentase" class="form-control" id="inputPersentase" placeholder="30%" value="30%">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKriteria">Kriteria</label>
                            <input required type="text" name="kriteria" class="form-control" id="inputKriteria" placeholder="Skala 0 -100" value="UTS">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPresentase">Persentase</label>
                            <input required type="text" name="Persentase" class="form-control" id="inputPersentase" placeholder="30%" value="30%">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKriteria">Kriteria</label>
                            <input required type="text" name="kriteria" class="form-control" id="inputKriteria" placeholder="Skala 0 -100" value="UAS">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPresentase">Persentase</label>
                            <input required type="text" name="Persentase" class="form-control" id="inputPersentase" placeholder="40%" value="40%">
                        </div>
                    </div>
                    <div class="card-header py-3 anchor"> 
                        <button type="submit" class="btn btn-green mr-1" onclick="konfirmasi()" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="/kelas/dosen/detail/nilaimk">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addCriteriaModal" tabindex="-1" role="dialog" aria-labelledby="addCriteriaModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold text-base" id="addCriteriaModalLabel">Tambah Kriteria Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <!-- Input fields for criteria and percentage -->
                            <div class="form-group">
                                <label for="criteria">Kriteria:</label>
                                <input type="text" class="form-control" id="criteria">
                            </div>
                            <div class="form-group">
                                <label for="percentage">Presentase:</label>
                                <input type="number" class="form-control" id="percentage">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-base" onclick="addCriteria()">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                    function addCriteria() {
                        var html = `
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Kriteria</label> 
                                    <input name="kriteria" type="text" class="form-control">
                                </div>  
                                <div class="form-group col-md-6">
                                    <label>Presentase</label>
                                    <input name="presentase" type="text" class="form-control">  
                                </div>
                            </div>`;
                        $('.anchor').before(html);
                    }
            </script>
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
            
                window.location.href = "/kelas/dosen/detail/nilaimk/kriteria";
            }
        });
    }
</script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>