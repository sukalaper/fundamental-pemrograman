<?php
    //Memulai session
    session_start();
    //Set session

    $_SESSION['admin_id']='';
    $_SESSION['admin_code']='';
    $_SESSION['name']='';
   
    //Hapus session
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_code']);
    unset($_SESSION['name']);

    session_unset();
    session_destroy();

    header('Location:login.php');

?>