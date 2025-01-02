<?php 
include 'header.php'; 
//ambil data
$query = "SELECT * FROM tbl_barang";
$result = mysqli_query($koneksi, $query);
//jika gagal
if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}
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
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Mulai Disini -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="tambah_data.php" class="btn btn-success"><i class="fa-solid fa-plus"></i>&nbsp;Tambah
                        Barang</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
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
                                    <td><?= $data['kode_barang']; ?></td>
                                    <td><?= $data['nama_barang']; ?></td>
                                    <td>
                                        <a href="tambah_stok.php?id=<?= $data['id'] ?>" class="btn btn-primary mb-1"><i
                                                class="fa-solid fa-cart-shopping"></i>&nbsp;Tambah</a>
                                        <a href="edit_data.php?id=<?= $data['id'] ?>" class="btn btn-success mb-1"><i
                                                class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</a>
                                        <a href="hapus_data.php?id=<?= $data['id'] ?>" class="btn btn-danger mb-1"><i
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