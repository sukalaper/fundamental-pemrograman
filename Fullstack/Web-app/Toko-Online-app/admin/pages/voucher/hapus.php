<?php
 
    include '../../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $kode_voucher=$_GET['kode_voucher'];
    $logo=$_GET['logo'];

    //Menghapus data voucher
    $hapus_voucher=mysqli_query($kon,"delete from voucher where kode_voucher='$kode_voucher'");

    $hapus_penerima_voucher=mysqli_query($kon,"delete from penerima_voucher where kode_voucher='$kode_voucher'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_voucher and $hapus_penerima_voucher) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=voucher&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=voucher&hapus=gagal");

    }
        
    
?>