<?php
 
    include '../../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_produk=$_GET['id_produk'];
    $gambar=$_GET['gambar'];

    //Menghapus data produk
    $hapus_produk=mysqli_query($kon,"delete from produk where id_produk='$id_produk'");

    //Menghapus gambar
    if ($gambar!='gambar_default.png'){
        unlink("gambar/".$gambar);
    }

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_produk) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=produk&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=produk&hapus=gagal");

    }
        
    
?>