<?php
    //Koneksi database
    include '../../../config/database.php';
    //Mengambil kode voucher
    $kode_voucher=$_POST['kode_voucher'];

    //Kondisi jika kosong
    if (empty($kode_voucher)){
        echo "<p class='text-warning'>Kode voucher tidak boleh kosong</p>";
        echo "<script>   document.getElementById('Submit').disabled = true; </script>";
        echo "<script>   document.getElementById('update').disabled = true; </script>";
    
    } else {
        $query = mysqli_query($kon, "SELECT kode_voucher FROM voucher where kode_voucher='$kode_voucher'");
        $jumlah = mysqli_num_rows($query);
        //Kondisi jika kode voucher sudah digunakan
        if ($jumlah>0){
            echo "<p class='text-danger'>Kode voucher sudah digunakan</p>";
            echo "<script>   document.getElementById('Submit').disabled = true; </script>";
            echo "<script>   document.getElementById('update').disabled = true; </script>";
      
            
        }else {
            //Kondisi jika tersedia
            echo "<p class='text-success'>Kode voucher tersedia</p>";
            echo "<script>   document.getElementById('Submit').disabled = false; </script>";
            echo "<script>   document.getElementById('update').disabled = false; </script>";
      
        }
    }
    

?>
