<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pembukuan</title>
</head>

<body>
    <script src='assets/sweetalert2/dist/sweetalert2.all.min.js'></script>

</body>

</html>
<?php 
include 'assets/conn/koneksi.php';

function tambahBarang($data) {
    global $koneksi;

    //ambil data dari form
    $kode_barang = trim($data["kode_barang"]);
    $nama_barang = trim($data["nama_barang"]);
    //validasi input
    if (empty($kode_barang) || empty($nama_barang)) {
        echo "<script>alert('Semua wajib di isi!');</script>";
        return 0;
    }

    //cek kode barang
    $result = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE kode_barang = '$kode_barang'");
    if (mysqli_num_rows($result)) {
        echo "
        <script>
    Swal.fire({
        title: 'Kode Barang Sudah Ada!',
        text: 'Silakan masukkan kode barang yang berbeda.',
        icon: 'warning',
        confirmButtonText: 'OK'
    });
</script>";

        return 0;
    }

    //kirim data
    $query = "INSERT INTO tbl_barang (kode_barang, nama_barang) VALUES ('$kode_barang', '$nama_barang')";
    if (mysqli_query($koneksi, $query)) {
       return mysqli_affected_rows($koneksi);
    } else {
        echo "<script>alert('Error : " . mysqli_error($koneksi). "');</script>";
        return 0;
     }
}

function editBarang ($data) { 
    global $koneksi;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if (empty($id)) {
        echo "<script>
            alert('ID barang tidak ditemukan!');
            window.location.href = 'data_barang.php'; // Redirect jika ID tidak valid
        </script>";
    }
    $kode_barang = trim($data["kode_barang"]);
    $nama_barang = trim($data["nama_barang"]);
    
    if (empty($kode_barang) || empty($nama_barang)) {
        echo "<script>alert('Semua wajib di isi!');</script>";
    } else {
        $query = "UPDATE tbl_barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang' WHERE id = '$id'";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>
            Swal.fire({
                title: 'Data Barang Berhasil Di Edit!',
                text: 'Barang berhasil di edit ke database.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_barang.php'; // Ubah ke halaman tujuan
                }
            });
        </script>";
        } else {
            echo "<script>alert('Error : " . mysqli_error($koneksi). "');</script>";
        }
     }

}

function hapusBarang ($id) {
    global $koneksi;
    $query = "DELETE FROM tbl_barang WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "
<script>
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data barang yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna menekan tombol 'Ya, hapus!'
            Swal.fire({
                title: 'Data Barang Berhasil Dihapus!',
                text: 'Barang berhasil dihapus dari database.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'data_barang.php'; // Redirect ke halaman tujuan
            });
        } else {
            // Jika pengguna menekan tombol 'Batal'
            Swal.fire({
                title: 'Dibatalkan',
                text: 'Data barang tidak jadi dihapus.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }
    });
</script>";
        } else {
            echo "<script>alert('Error : " . mysqli_error($koneksi). "');</script>";
            }
}

function tambahStok ($data) {
    global $koneksi;

    $periode = trim($data['periode']);
    $bulan = trim($data['bulan']);
    $kode_barang = trim($data['kode_barang']);
    $nama_barang = trim($data['nama_barang']);
    $soh = trim($data['soh']);
    $fisik = trim($data['fisik']);

    if (empty($periode) || empty($bulan) || empty($kode_barang) || empty($nama_barang) || empty($soh) || empty($fisik)) {
        echo "<script>alert('Semua wajib di isi!');</script>";
        return 0;
    }

    //kirim data
    $query = "INSERT INTO tbl_pembukuan (periode, bulan, kode_barang, nama_barang, soh, fisik) VALUES ('$periode', '$bulan','$kode_barang', '$nama_barang', '$soh', '$fisik')";
    if (mysqli_query($koneksi, $query)) {
       return mysqli_affected_rows($koneksi);
    } else {
        echo "<script>alert('Error : " . mysqli_error($koneksi). "');</script>";
        return 0;
     }
}

function editStok ($data) {
    global $koneksi;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if (empty($id)) {
        echo "<script>
            alert('ID Stok tidak ditemukan!');
            window.location.href = 'data_barang.php'; // Redirect jika ID tidak valid
        </script>";
    }

    $periode = trim($data['periode']);
    $bulan = trim($data['bulan']);
    $kode_barang = trim($data["kode_barang"]);
    $nama_barang = trim($data["nama_barang"]);
    $soh = trim($data["soh"]);
    $fisik = trim($data["fisik"]);
    
    if (empty($periode) || empty($bulan) || empty($kode_barang) || empty($nama_barang) || empty($soh) || empty($fisik)) {
        echo "<script>alert('Semua wajib di isi!');</script>";
    } else {
        $query = "UPDATE tbl_pembukuan SET periode ='$periode', bulan ='$bulan', kode_barang = '$kode_barang', nama_barang = '$nama_barang', soh = '$soh', fisik = '$fisik' WHERE id = '$id'";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>
            Swal.fire({
                title: 'Data Stok Berhasil Di Edit!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'pembukuan.php'; // Ubah ke halaman tujuan
                }
            });
        </script>";
        } else {
            echo "<script>alert('Error : " . mysqli_error($koneksi). "');</script>";
        }
     }
}

function hapusStok ($id) {
    global $koneksi;
    $query = "DELETE FROM tbl_pembukuan WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "
        <script>
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data stok yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan tombol 'Ya, hapus!'
                    Swal.fire({
                        title: 'Data Stok Berhasil Dihapus!',
                        text: 'Stok berhasil dihapus dari database.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'pembukuan.php'; // Redirect ke halaman tujuan
                    });
                } else {
                    // Jika pengguna menekan tombol 'Batal'
                    Swal.fire({
                        title: 'Dibatalkan',
                        text: 'Data stok tidak jadi dihapus.',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                }
            });
        </script>";
        } else {
            echo "<script>alert('Error : " . mysqli_error($koneksi). "');</script>";
            }
}

function registrasi($data) {
    global $koneksi;

    // Ambil data dari form
    $username = strtolower(trim($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $nama = strtolower(trim($data["nama"]));

    // Cek apakah username sudah ada
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
        return false;
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        return false;
    }

    // Enkripsi password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    $query = "INSERT INTO user (id, username, password, nama) 
              VALUES (NULL, '$username', '$password_hashed', '$nama')";

    if (mysqli_query($koneksi, $query)) {
        return mysqli_affected_rows($koneksi); // Berhasil
    } else {
        echo "Error: " . mysqli_error($koneksi); // Menampilkan error
        return 0; // Gagal
    }
}

function editProfile ($data) {
    global $koneksi;

    $id_user = $_SESSION['id']; // Ganti 'id_user' dengan nama kolom yang benar

    // Ambil data pengguna yang sedang login
    $query = "SELECT * FROM user WHERE id = '$id_user' LIMIT 1"; // Pastikan kolom NPM ada di database
    $result = mysqli_query($koneksi, $query);
    $user_data = mysqli_fetch_assoc($result);

    $username = mysqli_real_escape_string($koneksi, $data["username"]);
    $nama = mysqli_real_escape_string($koneksi, $data["nama"]);
    $password1 = mysqli_real_escape_string($koneksi, $data["password1"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    if(!empty($password1)&&$password1 !== $password2){
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        return false;
        } else {
            $hash = !empty($password1) ? password_hash($password1, PASSWORD_BCRYPT) : $user_data['password'];

            //update
            $query = "UPDATE user SET username = '$username', nama = '$nama', password = '$hash' WHERE id = '$id_user' limit 1";
            $update_result = mysqli_query($koneksi, $query);

            if ($update_result) {
                echo "<script>
            Swal.fire({
                title: 'Data Profile Berhasil Di Edit!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'profile.php'; // Ubah ke halaman tujuan
                }
            });
        </script>";
            } else {
                echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($koneksi) . "</div>";
            }
        }

}



?>