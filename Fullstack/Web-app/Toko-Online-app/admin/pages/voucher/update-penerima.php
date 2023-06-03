<?php

    include '../../../config/database.php';
    $kode_voucher=$_POST["kode_voucher"];

    mysqli_query($kon, "update penerima_voucher set aktif='0' where kode_voucher='$kode_voucher'");

    if (isset($_POST['pilih'])) {

        $pilih=$_POST['pilih'];

        for ($i=0; $i < count($pilih) ; $i++){
          
            mysqli_query($kon, "update penerima_voucher set aktif='1' where id_pelanggan='$pilih[$i]' and kode_voucher='$kode_voucher'");
           
        }
    }
?>