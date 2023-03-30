<?php

if (isset($_POST['login'])) {
    session_start();
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

  
    include '../config/database.php';

    //Mengambil uername dan password
    $username = input($_POST["username"]);
    $password = input(md5($_POST["password"]));

    $cek_pelanggan = mysqli_query ($kon, "select * from pelanggan where username='".$username."' and password='".$password."' limit 1");
    $pelanggan = mysqli_num_rows($cek_pelanggan);
    $name="";
    if ($pelanggan>0){
        $row = mysqli_fetch_assoc($cek_pelanggan);

        if ($row['status']==1){
            $_SESSION["id_pelanggan"]=$row["id_pelanggan"];
            $_SESSION["kode_pelanggan"]=$row["kode_pelanggan"];
            $_SESSION["nama_pelanggan"]=$row["nama_pelanggan"];
            $_SESSION["foto"]=$row["foto"];
    
            $nama_pelanggan=$row["nama_pelanggan"];
            header("Location:../index.php?page=pesanan-saya");

        }else {
            header("Location:../index.php?page=login&aut=tidak_aktif");
        }
    
    }else {
        header("Location:../index.php?page=login&aut=login_gagal");
    }
}
?>

<div class="women-product">
    <div class=" w_content">
        <div class="women">
            <h3>Login</h3>
            <div class="clearfix"> </div>	
        </div>
    </div>
    <div class="grid-product">
    <?php
    if (isset($_GET['aut'])) {
            if ($_GET['aut']=='pendaftaran_berhasil'){
                echo"<div class='alert alert-success'>Pendaftaran berhasil, login sekarang!</div>";
            } 
        }

        if (isset($_GET['aut'])) {
            if ($_GET['aut']=='login'){
                echo"<div class='alert alert-warning'>Harus login terlebih dahulu</div>";
            } 
        }

        if (isset($_GET['aut'])) {
            if ($_GET['aut']=='login_gagal'){
                echo"<div class='alert alert-danger'>Username dan password tidak valid!</div>";
            } 
        }
        if (isset($_GET['aut'])) {
            if ($_GET['aut']=='tidak_aktif'){
                echo"<div class='alert alert-warning'>Mohon maaf status anda telah dinonaktifkan.</div>";
            } 
        }
    ?>
    <form method="post" action="pages/login.php">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>  
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>  
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="login" >Login</button>
        </div>

        <p>Belum punya akun? <a href="index.php?page=daftar" >Daftar sekarang</a></p>

    </form>

        <div class="clearfix"> </div>
    </div> 
</div>

<?php include 'kategori.php';?>