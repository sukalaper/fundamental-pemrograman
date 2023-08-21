<?php
require '../../kelola_stok/function.php';

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $checkdatabase = mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");
  $hitung = mysqli_num_rows($checkdatabase);
  if($hitung > 0){
    $_SESSION['log'] = 'true';
    header('location:../../index.php'); 
  } else {
    header('location:../../pages/peringatan-kesalahan-login.php');  
  }
}

if(!isset($_SESSION['log'])){
} else {
  header('location:../../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Halaman Login</title>
  <link href="../../assets/css/styles.css" rel="stylesheet">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
          <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
              <div class="card-header bg-white">
                <h3 class="text-center font-weight-light my-4">Have an account?</h3>
              </div>
              <div class="card-body">
                <form method="post">
                  <div class="mb-3">
                    <label for="inputEmail" class="form-label">Alamat email</label>
                    <input class="form-control" name="email" id="inputEmail" type="email" placeholder="sukalaper@space.com" required>
                  </div>
                  <div class="mb-3">
                    <label for="inputPassword" class="form-label">Kata sandi</label>
                    <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Kata sandi anda" required>
                  </div>
                  <button class="btn btn-primary w-100" name="login">Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="assets/js/scripts.js"></script>
</body>
</html>
