<?php include 'header.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    echo "<script>
        alert('ID barang tidak ditemukan!');
        window.location.href = 'data_barang.php'; // Redirect jika ID tidak valid
    </script>";
}

// ambil data barang
$query = "SELECT * FROM tbl_barang WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "
    <script>
        alert('Data barang tidak ditemukan!');
        window.location.href = 'daftar_dosen.php'; // Redirect jika data tidak ditemukan
    </script>";
    exit;
}

$barang = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    editBarang($_POST);
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
                    <h1>Edit Data Barang</h1>
                    <hr>
                    <form class="form-horizontal" method="POST" action="">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kode Barang:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="kode_barang" type="text"
                                    value="<?= htmlspecialchars($barang['kode_barang'])?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nama Barang:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nama_barang" type="text"
                                    value="<?= htmlspecialchars($barang['nama_barang']) ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" name="update" class="btn btn-primary" value="Simpan">
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