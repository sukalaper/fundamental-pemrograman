<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['id'])) {
            include '../../../config/database.php';
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $id=addslashes(trim($_GET['id']));
            $nomor_pesanan=addslashes(trim($_GET['nomor_pesanan']));
            $status=addslashes(trim($_GET['status']));

            $hapus_status=mysqli_query($kon,"delete from status where id_status='$id'");


            //Update pada tabel pesanan status kurangi satu
            $a=$status-1;
            $sql="update pesanan set status='$a' where nomor_pesanan='$nomor_pesanan'";
            $update=mysqli_query($kon,$sql);

            
            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hapus_status and $update) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=detail-pesanan&nomor_pesanan=$nomor_pesanan&hapus=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=detail-pesanan&nomor_pesanan=$nomor_pesanan&hapus=gagal");

            }
        }
    }   
    
?>