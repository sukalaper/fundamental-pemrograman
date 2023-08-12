<?php
  if(isset($_SESSION['log'])){
  } else {
    header('location:../../stok-barang/pages/auth/login.php');
  }
?>
