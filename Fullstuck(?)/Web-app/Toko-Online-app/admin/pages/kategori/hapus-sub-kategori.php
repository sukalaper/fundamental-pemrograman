<?php
 
    include '../../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_sub_kategori=$_GET['id_sub_kategori'];
    $id_kategori=$_GET['id_kategori'];
    
    //Menghapus data sub_kategori 
    $hapus_sub_kategori=mysqli_query($kon,"delete from sub_kategori where id_sub_kategori='$id_sub_kategori'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_sub_kategori) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=kategori&id_kategori=$id_kategori&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=kategori&id_kategori=$id_kategori&hapus=gagal");

    }
        
    
?>