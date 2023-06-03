<?php
 
    include '../../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_pelanggan=$_GET['id_pelanggan'];
    $foto=$_GET['foto'];

    //Menghapus data pelanggan
    $hapus_pelanggan=mysqli_query($kon,"delete from pelanggan where id_pelanggan='$id_pelanggan'");

    //Menghapus foto
    if ($foto!='foto_default.png'){
        unlink("foto/".$foto_saat_ini);
    }

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_pelanggan) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=pelanggan&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=pelanggan&hapus=gagal");

    }
        
    
?>