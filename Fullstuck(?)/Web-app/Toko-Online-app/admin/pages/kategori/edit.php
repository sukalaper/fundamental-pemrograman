<?php

    //Include file koneksi, untuk koneksikan ke database
    include '../../config/database.php';
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST['edit_pemasukan'])) {
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $pemasukan=input($_POST["pemasukan"]);
            $id_kategori=input($_POST["id_kategori"]);
           
 
            $sql="update kategori set
            nama='$pemasukan'
            where id_kategori=$id_kategori";

            $edit_jenis_pemasukan=mysqli_query($kon,$sql);

            if ($edit_jenis_pemasukan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=kategori&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=kategori&edit=gagal");
            }
        }
    }

    if (isset($_POST['edit_pengeluaran'])) {
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $pengeluaran=input($_POST["pengeluaran"]);
            $id_kategori=input($_POST["id_kategori"]);
 
            $sql="update kategori set
            nama='$pengeluaran'
            where id_kategori=$id_kategori";

            $edit_jenis_pengeluaran=mysqli_query($kon,$sql);

            if ($edit_jenis_pengeluaran) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=kategori&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=kategori&edit=gagal");
            }
        }
    }
?>