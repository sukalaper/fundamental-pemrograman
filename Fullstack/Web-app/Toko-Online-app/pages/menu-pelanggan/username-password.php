<?php

if (isset($_POST['username'])) {
    
    //Include file koneksi, untuk koneksikan ke database
    include '../../config/database.php';
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");

        $id_pelanggan=input($_POST["id_pelanggan"]);
        $username=input($_POST["username"]);
     

        //Mengambil password
        $ambil_password=mysqli_query($kon,"select password from pelanggan where id_pelanggan=$id_pelanggan limit 1");
        $data = mysqli_fetch_array($ambil_password);

        if ($data['password']==$_POST["password"]){
            $password=input($_POST["password"]);
        }else {
            $password=md5(input($_POST["password"]));
        }
   

        $sql="update pelanggan set
        username='$username',
        password='$password'
        where id_pelanggan='$id_pelanggan'";
        

        //Mengeksekusi query 
        $edit_customer=mysqli_query($kon,$sql);

        if ($edit_customer) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=username-password&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=username-password&edit=gagal");
        }
    }
}
?>
<?php 
    include 'config/database.php';
    $id_pelanggan=$_SESSION["id_pelanggan"];
    $sql="select id_pelanggan,username,password from pelanggan where id_pelanggan=$id_pelanggan limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
?>

<div class="women-product">
    <div class=" w_content">
        <div class="women">
            <h3>Username & Password</h3>
     
            <div class="clearfix"> </div>	
        </div>
    </div>
    <!-- grids_of_4 -->

    <div class="grid-product">
    <?php
        if (isset($_GET['edit'])) {
            if ($_GET['edit']=='berhasil'){
                echo"<div class='alert alert-success'>Username & password berhasil diupdate</div>";
            }
            if ($_GET['edit']=='gagal'){
                echo"<div class='alert alert-danger'>Username & password  gagal diupdate</div>";
            } 
        }
    ?>
    <form action="pages/menu-pelanggan/username-password.php" method="post">
        <div class="row">
            <div class="col-sm-10">

                <div class="form-group">
                    <input type="hidden" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>" class="form-control" >
                </div>

                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" id="username" name="username" onkeypress="return event.charCode != 32" value="<?php echo $data['username'];?>" class="form-control" >
                    <span id="info"></span>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" value="<?php echo $data['password'];?>" class="form-control" >
                </div>

                <button type="submit" id="daftar" class="btn btn-info">Simpan</button>
            </div>
        </div>
    </form>

	<div class="clearfix"> </div>
    </div> 
</div>

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

<?php include 'menu-pelanggan.php';?>