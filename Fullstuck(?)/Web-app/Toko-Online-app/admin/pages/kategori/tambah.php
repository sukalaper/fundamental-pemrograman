<?php
    session_start();

    //Include file koneksi, untuk koneksikan ke database
    include '../../config/database.php';
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST['pemasukan'])) {
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $pemasukan=input($_POST["pemasukan"]);
            $jenis=1;
            $id_pengguna=$_SESSION["id_pengguna"];
   
            $sql="insert into kategori (nama,jenis,id_pengguna) values
            ('$pemasukan','$jenis','$id_pengguna')";

            $simpan_jenis_pemasukan=mysqli_query($kon,$sql);

            if ($simpan_jenis_pemasukan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=kategori&tambah=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=kategori&tambah=gagal");
            }
        }
    }

    if (isset($_POST['pengeluaran'])) {
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $pengeluaran=input($_POST["pengeluaran"]);
            $jenis=2;
            $id_pengguna=$_SESSION["id_pengguna"];
   
            $sql="insert into kategori (nama,jenis,id_pengguna) values
            ('$pengeluaran','$jenis','$id_pengguna')";

            $simpan_jenis_pengeluaran=mysqli_query($kon,$sql);

            if ($simpan_jenis_pengeluaran) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=kategori&tambah=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=kategori&tambah=gagal");
            }
        }
    }
?>