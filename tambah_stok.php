<?php 
include 'header.php'; 

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
        window.location.href = 'data_barang.php'; // Redirect jika data tidak ditemukan
    </script>";
    exit;
}

$barang = mysqli_fetch_assoc($result);

if (isset($_POST['tambah'])) {
    if(tambahStok($_POST) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Data Stok Berhasil Ditambahkan!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'pembukuan.php'; // Ubah ke halaman tujuan
                }
            });
        </script>";
    } else {
        echo "<script>
    Swal.fire({
        title: 'Tambah Stok Gagal!',
        text: 'ada kesalahan saat menambahkan stok.',
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>";
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nama Barang : <?php echo $barang['nama_barang']; ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Mulai Disini -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">

                <div class="container">
                    <h1>Tambah Stok Barang</h1>
                    <hr>
                    <form class="form-horizontal" method="POST" action="">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Periode:</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="periode" required>
                                    <option value="">Pilih Periode</option>
                                    <option value="minggu ke 1">Minggu Ke-1</option>
                                    <option value="minggu ke 2">Minggu Ke-2</option>
                                    <option value="minggu ke 3">Minggu Ke-3</option>
                                    <option value="minggu ke 4">Minggu Ke-4</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Bulan-Tahun:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="bulan" type="text" required>
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
                                <input class="form-control" name="soh" type="number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Fisik:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="fisik" type="number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" name="tambah" class="btn btn-primary" value="Simpan">
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