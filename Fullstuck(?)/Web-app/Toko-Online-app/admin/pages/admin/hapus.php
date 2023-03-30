<?php
 
    include '../../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_admin=$_GET['id_admin'];
    $foto=$_GET['foto'];

    //Menghapus data admin
    $hapus_admin=mysqli_query($kon,"delete from admin where id_admin='$id_admin'");

    //Menghapus foto
    if ($foto!='foto_default.png'){
        unlink("foto/".$foto_saat_ini);
    }

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_admin) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=admin&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=admin&hapus=gagal");

    }
        
    
?>