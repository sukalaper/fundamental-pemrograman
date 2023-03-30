<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Koneksi database
    include '../config/database.php';
    //Mengambil username
    $username=addslashes(trim($_POST['username']));

    //Kondisi jika usrname kosong
    if (empty($username)){
        echo "<p class='text-warning'>Username tidak boleh kosong</p>";
        echo "<script>   document.getElementById('daftar').disabled = true; </script>";
   
    } else {

        //username yang dimasukan akan dicek pada tabel pelanggan
        $query = mysqli_query($kon, "SELECT username FROM pelanggan where username='$username'");
        $cek_pelanggan = mysqli_num_rows($query);
        //Kondisi jika username sudah digunakan
        if ($cek_pelanggan>0){
            echo "<p class='text-danger'>Username sudah digunakan</p>";
            echo "<script>   document.getElementById('daftar').disabled = true; </script>";
         
        }else {
            echo "<p class='text-success'>Username tersedia</p>";
            echo "<script>   document.getElementById('daftar').disabled = false; </script>";
         
        }
            
        
    }
}
?>
