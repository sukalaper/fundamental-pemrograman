<?php
    //Memulai session
    session_start();
    //Set session
    $_SESSION['id_pelanggan']='';
    $_SESSION['kode_pelanggan']='';
    $_SESSION['nama_pelanggan']='';
    $_SESSION['foto']='';

   
    //Hapus session
    unset($_SESSION['id_pelanggan']);
    unset($_SESSION['kode_pelanggan']);
    unset($_SESSION['nama_pelanggan']);
    unset($_SESSION['foto']);
    session_unset();
    session_destroy();

    header('Location:index.php');

?>