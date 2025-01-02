<?php 
include 'header.php'; 
// Ambil data bulan yang unik dari tabel tbl_pembukuan untuk filter
$query_bulan = "SELECT DISTINCT bulan FROM tbl_pembukuan";
$result_bulan = mysqli_query($koneksi, $query_bulan);

// Ambil bulan yang dipilih untuk filter (jika ada)
$bulan_filter = isset($_GET['bulan']) ? $_GET['bulan'] : '';

// Query untuk mengambil data berdasarkan bulan yang dipilih
$query = "SELECT * FROM tbl_pembukuan";
if ($bulan_filter) {
    $query .= " WHERE bulan = '$bulan_filter'";
}
$result = mysqli_query($koneksi, $query);

// Jika gagal query
if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}

// Menampilkan pesan jika ada operasi sukses atau error
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == 'sukses') {
        echo "<div class='alert alert-success'>Data barang berhasil dihapus.</div>";
    } elseif ($_GET['pesan'] == 'error') {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menghapus data barang.</div>";
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pembukuan Stok</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Mulai Disini -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Filter Form -->
            <form method="GET" action="">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="bulan">Pilih Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">--Tampilkan Semua--</option>
                            <?php while ($bulan = mysqli_fetch_assoc($result_bulan)): ?>
                            <option value="<?= $bulan['bulan']; ?>"
                                <?= $bulan_filter == $bulan['bulan'] ? 'selected' : ''; ?>>
                                <?= $bulan['bulan']; ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Tampilkan</button>
                    </div>
                </div>
            </form>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="cetak.php?bulan=<?= $bulan_filter ?>" class="btn btn-success"><i
                            class="fa-solid fa-print"></i>&nbsp;Cetak Data Stok</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>Bulan</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>SOH</th>
                                    <th>Fisik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>Bulan</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>SOH</th>
                                    <th>Fisik</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php 
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($result)) :
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['periode']; ?></td>
                                    <td><?= $data['bulan']; ?></td>
                                    <td><?= $data['kode_barang']; ?></td>
                                    <td><?= $data['nama_barang']; ?></td>
                                    <td><?= $data['soh']; ?></td>
                                    <td><?= $data['fisik']; ?></td>
                                    <td>
                                        <a href="edit_stok.php?id=<?= $data['id'] ?>" class="btn btn-success mb-1"><i
                                                class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</a>
                                        <a href="hapus_stok.php?id=<?= $data['id'] ?>" class="btn btn-danger mb-1"><i
                                                class="fa-solid fa-trash"></i>&nbsp;Hapus</a>

                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->



    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php'; ?>