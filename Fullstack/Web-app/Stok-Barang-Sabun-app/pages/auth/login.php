<?php
require '../../kelola_stok/function.php';

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $checkdatabase = mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");
  $hitung = mysqli_num_rows($checkdatabase);
  if($hitung > 0){
    $_SESSION['log'] = 'True';
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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Administrator - Login</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </head>
  <body class="bg-primary">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Login</h3>
                  </div>
                  <div class="card-body">
                    <form method="post">
                      <div class="form-floating mb-3">
                        <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                        <label for="inputEmail">Email address</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                        <label for="inputPassword">Password</label>
                      </div>
                      <button class="btn btn-primary" name="login">Login</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/scripts.js"></script>
  </body>
</html>
