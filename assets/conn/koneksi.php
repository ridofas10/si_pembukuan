<?php 

$koneksi = mysqli_connect("localhost", "root", "", "pembukuan");
if (!$koneksi) { die("Koneksi gagal: " . mysqli_connect_error());}

?>