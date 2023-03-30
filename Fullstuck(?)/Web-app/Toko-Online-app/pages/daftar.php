<?php
 if (isset($_POST['daftar'])) {
    session_start();
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include '../config/database.php';
    mysqli_query($kon,"START TRANSACTION");

    $query = mysqli_query($kon, "SELECT max(id_pelanggan) as max_id FROM pelanggan");
    $get = mysqli_fetch_array($query);
    $id_pelanggan = $get['max_id'];
    $id_pelanggan++;
    $tahun=date('y');
    $kode_depan = $tahun.'01';
    $kode_pelanggan = $kode_depan . sprintf("%03s", $id_pelanggan);

    

    $nama_pelanggan=input($_POST["nama_pelanggan"]);
    $email=input($_POST["email"]);
    $telp=input($_POST["telp"]);
    $alamat=input($_POST["alamat"]);
    $username=input($_POST["username"]);
    $password=input(md5($_POST["password"]));

    $buat_akun=mysqli_query($kon,"insert into pelanggan (kode_pelanggan,nama_pelanggan,email,telp,alamat,username,password) values ('$kode_pelanggan','$nama_pelanggan','$email','$telp','$alamat','$username','$password')");

    if ($buat_akun) {
        //Jika semua query berhasil, lakukan commit
        mysqli_query($kon,"COMMIT");
        header("Location:../index.php?page=login&aut=pendaftaran_berhasil");
    }
    else {
        //Jika ada query yang gagal, lakukan rollback
        mysqli_query($kon,"ROLLBACK");
        header("Location:../index.php?page=daftar&aut=pendaftaran_gagal");
    }
}
?>

<div class="women-product">
    <div class=" w_content">
        <div class="women">
            <h3>Daftar</h3>
            <div class="clearfix"> </div>	
        </div>
    </div>
    <div class="grid-product">
    <?php
        if (isset($_GET['aut'])) {
            if ($_GET['aut']=='pendaftaran_gagal'){
                echo"<div class='alert alert-danger'>Pendaftaran gagal, coba sekali lagi atau hubungi admin!</div>";
            } 
        }
    ?>

    <form method="post" action="pages/daftar.php">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" name="nama_pelanggan" class="form-control" required>  
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Telp:</label>
                    <input type="number" name="telp" class="form-control">  
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" name="email" class="form-control" required>  
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Alamat:</label>
                    <textarea name="alamat" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" id="username" onkeypress="return event.charCode != 32" class="form-control" required>
                    <span id="info"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" required>  
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" id="daftar" class="btn btn-success" name="daftar" >Daftar</button>
        </div>

        <p>Sudah memiliki akun? <a href="index.php?page=login" >Login sekarang</a></p>
        <script>
            $('#username').bind('keyup', function () {
                var username=$("#username").val();
                $.ajax({
                url: 'pages/cek-username.php',
                method: 'POST',
                data:{username:username},
                success:function(data){
                    $("#info").html(data);
                }
                }); 
            });
        </script>
    </form>

        <div class="clearfix"> </div>
    </div> 
</div>

<?php include 'kategori.php';?>