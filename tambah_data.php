<?php include 'header.php';

if (isset($_POST['save'])) {
    if (tambahBarang($_POST) > 0) {
        echo "
        <script>
            Swal.fire({
                title: 'Data Barang Berhasil Ditambahkan!',
                text: 'Barang berhasil ditambahkan ke database.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_barang.php'; // Ubah ke halaman tujuan
                }
            });
        </script>";
    }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Mulai Disini -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">

                <div class="container">
                    <h1>Tambah Data Barang</h1>
                    <hr>
                    <form class="form-horizontal" method="POST" action="">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kode Barang:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="kode_barang" type="text" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nama Barang:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nama_barang" type="text" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" name="save" class="btn btn-primary" value="Simpan">
                                <span></span>
                                <a href="data_barang.php" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php'; ?>