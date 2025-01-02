<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Mulai Disini -->
        <form method="POST" action="">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="bulan">Pilih Bulan</label>
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="">--Pilih Bulan--</option>
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
        <div class="card-header py-3">
            <a href="cetak.php?bulan=<?= $bulan_filter ?>" class="btn btn-success"><i
                    class="fa-solid fa-print"></i>&nbsp;Cetak Barang</a>
        </div>


    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php'; ?>