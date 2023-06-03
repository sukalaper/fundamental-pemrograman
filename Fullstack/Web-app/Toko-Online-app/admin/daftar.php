<?php
 if (isset($_POST['daftar'])) {
    session_start();
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include 'config/database.php';
    mysqli_query($kon,"START TRANSACTION");

    $query = mysqli_query($kon, "SELECT max(id_pengguna) as kodeTerbesar FROM pengguna");
    $data = mysqli_fetch_array($query);
    $id_pengguna = $data['kodeTerbesar'];
    $id_pengguna++;
    $huruf = "U";
    $kode_pengguna = $huruf . sprintf("%03s", $id_pengguna);

    
    $nama=input($_POST["nama"]);
    $email=input($_POST["email"]);
    $username=input($_POST["username"]);
    $password=md5(input($_POST["password"]));

    $create_account=mysqli_query($kon,"insert into pengguna (kode_pengguna,nama_pengguna,email,username,password) values ('$kode_pengguna','$nama','$email','$username','$password')");

    if ($create_account) {
        //Jika semua query berhasil, lakukan commit
        mysqli_query($kon,"COMMIT");
        header("Location:login.php?daftar=berhasil");
    }
    else {
        //Jika ada query yang gagal, lakukan rollback
        mysqli_query($kon,"ROLLBACK");
        header("Location:login.php?daftar=gagal");
    }
}
?>
<?php 
  include 'config/database.php';
  $hasil=mysqli_query($kon,"select * from profil_aplikasi order by nama_aplikasi desc limit 1");
  $aplikasi = mysqli_fetch_array($hasil); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $aplikasi['nama_aplikasi'];?> | Daftar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Daftar</b>
  </div>

  <div class="register-box-body">
  <?php
    if (isset($_GET['daftar'])) {
        if ($_GET['daftar']=='gagal'){
            echo"<div class='alert alert-danger'>Pendaftaran gagal</div>";
        } 
    }
  ?>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="nama" class="form-control" placeholder="Nama">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <div id="info_username"> </div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" name="daftar" id="daftar" class="btn btn-success btn-block btn-flat">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    Sudah mempunyai akun? <a href="login.php" class="text-center">Login sekarang</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>

    $("#username").bind('keyup', function () {

      var username = $('#username').val();

      $.ajax({
          url: 'pages/pengguna/cek-username.php',
          method: 'POST',
          data:{username:username},
          success:function(data){
              $('#info_username').show();
              $('#info_username').html(data);
          }
      }); 
    });
</script>
</body>
</html>
