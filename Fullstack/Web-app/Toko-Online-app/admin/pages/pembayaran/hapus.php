<?php
 
    include '../../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_pembayaran=$_GET['id_pembayaran'];
    $logo=$_GET['logo'];

    //Menghapus data pembayaran
    $hapus_pembayaran=mysqli_query($kon,"delete from pembayaran where id_pembayaran='$id_pembayaran'");

    //Menghapus logo
    if ($logo!='logo_default.png'){
        unlink("logo/".$logo);
    }

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_pembayaran) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=pembayaran&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=pembayaran&hapus=gagal");

    }
        
    
?>