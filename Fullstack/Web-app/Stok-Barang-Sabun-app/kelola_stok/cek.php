<?php
  if(isset($_SESSION['log'])){
  } else {
    #echo "Anda belum login, Anda akan dialihkan kembali ke halaman login dalam 3 detik.";
    #echo "<script>setTimeout(function(){window.location.href='login.php'},5000);</script>";
    header('location:./../pages/auth/login.php');
  }
?>
