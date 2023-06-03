<?php
session_start();
    if (isset($_POST['submit_pengaturan'])) {
        
        //Include file koneksi, untuk koneksikan ke database
        include '../../../config/database.php';
        
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

            $kode_admin=input($_POST["kode_admin"]);
            $username=input($_POST["username"]);
            $status=input($_POST["status"]);

            //Mengambil password
            $ambil_password=mysqli_query($kon,"select password from admin where kode_admin='$kode_admin' limit 1");
            $data = mysqli_fetch_array($ambil_password);

            //Membandingkan password
            if ($data['password']==$_POST["password"]){
                $password=input($_POST["password"]);
            }else {
                $password=md5(input($_POST["password"]));
            }

            $sql="update admin set
            username='$username',
            password='$password',
            status='$status'
            where kode_admin='$kode_admin'";

            //Menyimpan ke tabel pengguna
            $setting_pengguna=mysqli_query($kon,$sql);

            if ($setting_pengguna) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=admin&pengaturan-pengguna=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=admin&pengaturan-pengguna=gagal");
            }
        }  
    }
?>

<form action="pages/admin/pengaturan-pengguna.php" method="post">
<?php
    include '../../../config/database.php';
    $kode_admin=$_POST['kode_admin'];
    $query = mysqli_query($kon, "SELECT * FROM admin where kode_admin='$kode_admin'");
    $data = mysqli_fetch_array($query);
    $username=$data['username'];
    $password=$data['password'];
    $status=$data['status'];
?>
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <input name="kode_admin" type="hidden" id="kode_admin" class="form-control" value="<?php echo $_POST['kode_admin'];?>"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Username:</label>
                <input name="username" type="text" id="username" class="form-control" value="<?php echo $username; ?>" placeholder="Buat username" required>
                <div id="info_username"> </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Password:</label>
                <input name="password" type="password" class="form-control" value="<?php echo $password; ?>" placeholder="Buat password" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
        <label>Status:</label>
            <div class="form-group">
                <select class="form-control" name="status" id="status" required>
                <?php
                    $ket="";
                    $status = array("0", "1");
                    $jum=count($status)-1;
                    for ($i=0;$i<=$jum;$i++):

                        if ($status[$i]=="1"){
                            $ket="Aktif";
                        }else {
                            $ket="Tidak Aktif";
                        }
                    ?>
                    <option <?php if ($status[$i]==$data['status']) echo "selected"; ?> value="<?php echo $status[$i];?>"><?php echo $ket;?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="submit_pengaturan" id="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

<script>
    //Event pada field username, untuk mengecek ketersediaan username
    $("#username").bind('keyup', function () {

        var username = $('#username').val();

        $.ajax({
            url: 'pages/admin/cek-username.php',
            method: 'POST',
            data:{username:username},
            success:function(data){
                $('#info_username').show();
                $('#info_username').html(data);
            }
        }); 
    });
</script>

