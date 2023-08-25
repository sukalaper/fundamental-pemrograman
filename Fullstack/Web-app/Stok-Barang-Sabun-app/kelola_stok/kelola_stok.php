<?php 
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Barang Keluar</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../assets/css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="../index.php">Toko Sukalaper</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading"> Kelola Barang </div>
            <hr>
            <a class="nav-link" href="../index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-boxes-alt"></i></div>
              Stok Barang 
            </a>
            <a class="nav-link" href="barang-masuk.php">
              <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
              Barang Masuk
            </a>
            <a class="nav-link" href="barang-keluar.php">
              <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
              Barang Keluar
            </a>
            <a class="nav-link" href="kelola_stok.php">
              <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
              Rekap Penjualan 
            </a>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          Administrator
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <div class="text-left mt-4">
            <h1 class="animated-text">Rekapitulasi Penjualan</h1>
          </div> 
          <div class="card mb-4">
            <div class="card-header">
              <a href="export-kelola-stok.php" class="btn btn-primary" style="float: right;">
                <span class="fas fa-plus"></span> Export Data
              </a>
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Modal</th>
                    <th>Harga Jual</th>
                    <th>Jumlah Barang Terjual</th>
                    <th>Total Pendapatan Bersih</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result_ambil_semua_data_stok = mysqli_query($conn,"SELECT * FROM keluar K, stok S WHERE S.idbarang = K.idbarang");
                  while($data=mysqli_fetch_array($result_ambil_semua_data_stok)){
                    $tanggal = $data['tanggal'];
                    $idbarang = $data['idbarang'];
                    $namabarang = $data['namabarang'];
                    $hargamodal = $data['hargamodal'];
                    $hargajual = $data['hargajual'];
                    $qty = $data['qty'];
                    $laba = ($hargajual - $hargamodal) * $qty;
                    ?>
                    <tr>
                      <td><?php echo $tanggal ;?></td>
                      <td><?php echo $idbarang; ?></td>
                      <td><?php echo $namabarang ;?></td>
                      <td><?php echo $hargamodal ;?></td>
                      <td><?php echo $hargajual ;?></td>
                      <td><?php echo $qty ;?></td>
                      <td><?php echo number_format($laba, 3, '.', '');?></td>
                    </tr>
                    <?php }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Sukalaper 2022</div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="./../assets/js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="./../assets/demo/chart-area-demo.js"></script>
  <script src="./../assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="./../assets/js/datatables-simple-demo.js"></script>
</body>
</html>
