<?php 
    require '../koneksi.php';
    require '../controller/jualController.php';

    $jualController = new transaksiJual();
    $result = $jualController->showBarang();
?>