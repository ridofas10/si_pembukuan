<?php 
include 'header.php';

if (isset($_GET['id']))  {
    $id = $_GET['id'];
    if (hapusBarang($id)>0) {
        header('Location : data_barang.php');
        exit;
    }
}

?>