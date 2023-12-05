<?php
    include 'includes/header.php'; 
    include 'includes/navbar.php';   
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
    
        <div class="card-header py-3">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Form Kriteria Penilaian Kinerja Anggota</h1>
            <h1 class="h5 mb-4 text-gray-800">Kelas Mata Kuliah</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-base mb-4" data-toggle="modal" data-target="#addCriteriaModal">
                    Tambah Kriteria
                </button>

                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKriteria1">Kriteria</label>
                            <input required type="text" name="kriteria1" class="form-control" id="inputKriteria" placeholder="Nilai Kriteria 1" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPresentase">Persentase</label>
                            <input required type="text" name="Persentase" class="form-control" id="inputPersentase" placeholder="50%" value="">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKriteria1">Kriteria</label>
                            <input required type="text" name="kriteria1" class="form-control" id="inputKriteria" placeholder="Nilai Kriteria 2" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPersentase">Persentase</label>
                            <input required type="text" name="Persentase" class="form-control" id="inputPersentase" placeholder="50%" value="">
                        </div>
                    </div>
  
                    <div class="card-header py-3 anchor"> 
                        <button type="submit" class="btn btn-green mr-1" name="" value="">
                            Simpan
                        </button>
                        <a type="button" class="btn btn-danger" href="/kelas/dosen/detail/nilaikelompok">
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

<!-- SweetAlert -->
<script src="/assets/js/sweetalert.min.js"></script>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>