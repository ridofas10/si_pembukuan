<?php 
include 'header.php';

if (isset($_GET['id']))  {
    $id = $_GET['id'];
    if (hapusStok($id)>0) {
        header('Location : pembukuan.php');
        exit;
    }
}

?>