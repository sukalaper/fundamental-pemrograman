<?php
session_start(); 
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
echo 
  "<script>
    Swal.fire({
      icon: 'success',
      title: 'Logout Berhasil',
      text: 'Anda telah berhasil logout!',
      showConfirmButton: false,
      timer: 1800 
    }).then(function() {
      window.location.href = '../../pages/auth/login.php'; 
    });
  </script>";
?>
</body>
</html>
