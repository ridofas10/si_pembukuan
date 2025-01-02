<?php
// Mulai sesi
session_start();

// Memasukkan koneksi ke database
require 'assets/conn/koneksi.php'; // Pastikan path file koneksi benar

// Cek jika form login dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Amankan data dari input form
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = $_POST['password']; // Password tidak perlu di-sanitasi karena tidak diproses langsung dalam SQL

    // Cek username dari tbl_user
    $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah username ditemukan di tbl_user
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan sesi pengguna
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            
            header("Location: index.php");
        } else {
            // Jika password salah
            echo "
            <script>alert('password salah')
            </script>";
        }
    } 
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Login SI Pembukuan</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-image: url('assets/img/bg1.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>

    <link href="assets/css/floating-labels.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LeKH7IkAAAAAHehEYcO9Gr3KwbdZDgo28q6Rv3S"></script>
</head>

<body>

    <form class="form-signin" method="post" action="">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/img/user.png" width="150" height="150">
            <h1 class="h3 mb-3 font-weight-normal">Sistem Pembukuan</h1>
        </div>

        <div class="form-label-group">
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required
                autofocus>
            <label for="username">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            <label for="password">Password</label>
        </div>

        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; Ridofas Tri Sandi Fantiantoro <?= date('Y') ?></p>
    </form>
    <script src="assets/sweetalert2/dist/sweetalert2.all.min.js"></script>

</body>

</html>