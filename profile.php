<?php include 'header.php'; 

// Jika tidak ada session login, arahkan ke halaman login
if (!isset($_SESSION['login'])) {
    header("Location: login.php"); // Redirect ke halaman login
    exit;
}

if (!isset($_SESSION['id'])) { // Ganti 'id_user' dengan nama kolom yang benar
    die("Anda harus login untuk mengakses halaman ini.");
}

$id_user = $_SESSION['id']; // Ganti 'id_user' dengan nama kolom yang benar

// Ambil data pengguna yang sedang login
$query = "SELECT * FROM user WHERE id = '$id_user' LIMIT 1"; // Pastikan kolom NPM ada di database
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$useredit = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
   editProfile($_POST);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">

        <!-- Mulai Disini -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">

                <div class="container">
                    <h1>Edit Profile</h1>
                    <hr>
                    <form class="form-horizontal" method="POST" action="">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Username:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="username" type="text"
                                    value="<?= htmlspecialchars($useredit['username'])?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nama:</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nama" type="text"
                                    value="<?= htmlspecialchars($useredit['nama']) ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Password:</label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input class="form-control" name="password1" type="password" id="password1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle-password1">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Konfirmasi Password:</label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <input class="form-control" name="password2" type="password" id="password2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle-password2">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Menambahkan Font Awesome untuk Ikon -->
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                        <script>
                        // Menambahkan event listener untuk toggle password visibility
                        document.getElementById('toggle-password1').addEventListener('click', function() {
                            const passwordField = document.getElementById('password1');
                            const icon = this.querySelector('i');

                            // Jika tipe input adalah password, ubah ke text untuk menunjukkan password
                            if (passwordField.type === 'password') {
                                passwordField.type = 'text';
                                icon.classList.remove('fa-eye');
                                icon.classList.add('fa-eye-slash');
                            } else {
                                passwordField.type = 'password';
                                icon.classList.remove('fa-eye-slash');
                                icon.classList.add('fa-eye');
                            }
                        });

                        document.getElementById('toggle-password2').addEventListener('click', function() {
                            const passwordField = document.getElementById('password2');
                            const icon = this.querySelector('i');

                            if (passwordField.type === 'password') {
                                passwordField.type = 'text';
                                icon.classList.remove('fa-eye');
                                icon.classList.add('fa-eye-slash');
                            } else {
                                passwordField.type = 'password';
                                icon.classList.remove('fa-eye-slash');
                                icon.classList.add('fa-eye');
                            }
                        });
                        </script>

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