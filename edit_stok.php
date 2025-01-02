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
$query = "SELECT * FROM tbl_pembukuan WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "
    <script>
        alert('Data stok tidak ditemukan!');
        window.location.href = 'pembukuan.php'; // Redirect jika data tidak ditemukan
    </script>";
    exit;
}

$barang = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    editStok($_POST);
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
                    <h1>Edit Data Stok</h1>
                    <hr>
                    <form class="form-horizontal" method="POST" action="">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Periode:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="periode" type="text"
                                    value="<?= htmlspecialchars($barang['periode'])?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Bulan-Tahun:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="bulan" type="text"
                                    value="<?= htmlspecialchars($barang['bulan'])?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kode Barang:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="kode_barang" type="text"
                                    value="<?= htmlspecialchars($barang['kode_barang'])?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nama Barang:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nama_barang" type="text"
                                    value="<?= htmlspecialchars($barang['nama_barang']) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">SOH:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="soh" type="number"
                                    value="<?= htmlspecialchars($barang['soh'])?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Fisik:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="fisik" type="number"
                                    value="<?= htmlspecialchars($barang['fisik'])?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" name="update" class="btn btn-primary" value="Simpan">
                                <span></span>
                                <a href="pembukuan.php" class="btn btn-default">Batal</a>
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