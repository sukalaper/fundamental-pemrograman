<!DOCTYPE html>
<html>
<head>
  <title>Peringatan!</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      text-align: center;
    }
    h1 {
      margin-top: 0;
      color: #333;
    }
    button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
  <script>
    function goBack() {
      history.go(-1);
    }
    Swal.fire({
      title: 'Kesalahan di sisi user!',
      html: 'Harga jual tidak boleh lebih rendah dari harga modal',
      icon: 'error',
      confirmButtonText: 'Kembali'
    }).then((result) => {
      if (result.isConfirmed) {
        goBack();
      }
    });
  </script>
</body>
</html>
