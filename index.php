<?php include 'header.php'; 

$sql = mysqli_query($koneksi, "SELECT * FROM tbl_barang");
$sql2 = mysqli_query($koneksi, "SELECT * FROM tbl_pembukuan");
$hasil1 = mysqli_num_rows($sql);
$hasil2 = mysqli_num_rows($sql2);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Jumlah data barang : <?= $hasil1; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-table fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pembukuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Jumlah Data Stok : <?= $hasil2; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hallo
                    <?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin'; ?></h6>
            </div>
            <div class="card-body">
                <p>Selamat datang di aplikasi pembukuan yang dirancang untuk memudahkan Anda dalam mencatat, mengelola,
                    dan menganalisis data barang secara efisien.</p>
                <p class="mb-0">Sebelum mulai menggunakan aplikasi ini, pastikan Anda memahami fitur-fitur utamanya dan
                    cara kerjanya. Aplikasi ini juga didukung oleh kerangka kerja Bootstrap, yang memberikan
                    fleksibilitas dan kemudahan dalam penyesuaian tampilan. Jika ada pertanyaan, tim kami siap membantu
                    Anda kapan saja.</p>

            </div>
        </div>
        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Silahkan Hitung
                    <?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin'; ?></h6>
            </div>
            <div class="card-body">
                <?php

// Query untuk mendapatkan daftar bulan
$querydrop = mysqli_query($koneksi, "SELECT DISTINCT bulan FROM tbl_pembukuan");
if (!$querydrop) {
    echo "<p style='color: red;'>Data pembukuan belum ada!</p>";
    exit;
}

// Inisialisasi total
$total_soh = 0;
$total_fisik = 0;

// Jika form disubmit
if (isset($_POST['filter_bulan'])) {
    $bulan = $_POST['bulan'];
    $query_total = mysqli_query($koneksi, "SELECT SUM(soh) AS total_soh, SUM(fisik) AS total_fisik FROM tbl_pembukuan WHERE bulan = '$bulan'");
    
    if ($query_total) {
        $result = mysqli_fetch_assoc($query_total);
        $total_soh = $result['total_soh'] ?? 0;
        $total_fisik = $result['total_fisik'] ?? 0;
    }
}
?>
                <div class="container">
                    <!-- Dropdown -->
                    <form method="POST" action="">
                        <div class="dropdown mb-4">
                            <label for="bulan" class="form-label">Pilih Bulan:</label>
                            <select name="bulan" id="bulan" class="form-select">
                                <option value="">-- Pilih Bulan --</option>
                                <?php while ($drop = mysqli_fetch_assoc($querydrop)) : ?>
                                <option value="<?= htmlspecialchars($drop['bulan']); ?>">
                                    <?= htmlspecialchars($drop['bulan']); ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" name="filter_bulan" class="btn btn-primary">Hitung</button>
                    </form>

                    <!-- Hasil Total -->
                    <?php if (isset($_POST['filter_bulan'])) : ?>
                    <div class="mt-4">
                        <h5>Total Data untuk Bulan: <strong><?= htmlspecialchars($bulan); ?></strong></h5>
                        <p><strong>Total SOH:</strong> <?= htmlspecialchars($total_soh); ?></p>
                        <p><strong>Total Fisik:</strong> <?= htmlspecialchars($total_fisik); ?></p>
                    </div>
                    <?php endif; ?>
                </div>


            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php'; ?>