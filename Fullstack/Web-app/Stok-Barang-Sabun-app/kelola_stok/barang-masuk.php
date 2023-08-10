<?php 
require './../kelola_stok/function.php';
require './../kelola_stok/cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Barang Masuk</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="./../assets/css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="./../index.php">Sukalaper</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div>
    </form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#!">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Administrator Page</div>
            <a class="nav-link" href="./../index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Stok Barang
            </a>
            <a class="nav-link" href="./../kelola_stok/barang-masuk.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Barang Masuk
            </a>
            <a class="nav-link" href="./../kelola_stok/barang-keluar.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Barang Keluar
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                  Authentication
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="./../pages/auth/logout.php">Login</a>
                    <a class="nav-link" href="./../pages/auth/register.html">Register</a>
                    <a class="nav-link" href="./../pages/auth/password.html">Forgot Password</a>
                  </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                  Error
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="./../pages/auth/401.html">401 Page</a>
                    <a class="nav-link" href="./../pages/auth/404.html">404 Page</a>
                    <a class="nav-link" href="./../pages/auth/500.html">500 Page</a>
                  </nav>
                </div>
              </nav>
            </div>
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
            <h1 class="animated-text">Kelola Barang Masuk</h1>
          </div> 
          <div class="card mb-4">
            <div class="card-header">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right;">
                <span class="fas fa-plus"></span> Tambah Barang Masuk
              </button>
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>Tanggal Masuk</th>
                    <th>Nama Barang Masuk</th>
                    <th>Satuan Berat (g) (mL)</th>
                    <th>Jumlah Barang Masuk</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result_ambil_semua_data_stok = mysqli_query($conn, "SELECT * FROM masuk M, stok S WHERE S.idbarang = M.idbarang");
                  while ($data = mysqli_fetch_array($result_ambil_semua_data_stok)) {
                    $idbarang = $data['idbarang'];
                    $idmasuk = $data['idmasuk'];
                    $namabarang = $data['namabarang'];
                    $satuanberat = $data['satuanberat'];
                    $tanggal = $data['tanggal'];
                    $qty = $data['qty'];
                    ?>
                    <tr>
                      <td><?php echo $tanggal; ?></td>
                      <td><?php echo $namabarang; ?></td>
                      <td><?php echo $satuanberat; ?></td>
                      <td><?php echo $qty; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idbarang; ?>">
                          <i class="fas fa-edit"></i>
                        </button>
                        <input type="hidden" name="barangdihapus" value="<?=$idbarang;?>">
                        <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#delete<?= $idbarang; ?>">
                          <i class="fas fa-trash"></i>
                        </button>
                      </td>  
                    </tr>
                  <?php } ?>
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
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
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
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang Masuk</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="post">
        <div class="modal-body">
          <select name="barangnya" class="form-control mb-3">
            <?php 
            $ambildata = mysqli_query($conn, "SELECT * FROM stok");
            while ($fetcharray = mysqli_fetch_array($ambildata)) {
              $barangnya = $fetcharray['namabarang'];
              $idbarangnya = $fetcharray['idbarang'];
              $satuanberat = $fetcharray['satuanberat'];
              ?>
              <option value="<?php echo $idbarangnya; ?>"> <?php echo $barangnya; ?> <?php echo $satuanberat; ?></option>
            <?php } ?>
          </select>
          <input type="number" name="qty" placeholder="Jumlah Barang" class="form-control mb-3" required>
          <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
$result_ambil_semua_data_stok = mysqli_query($conn, "SELECT * FROM masuk M, stok S WHERE S.idbarang = M.idbarang");
while ($data = mysqli_fetch_array($result_ambil_semua_data_stok)) {
  $idbarang = $data['idbarang'];
  $idmasuk = $data['idmasuk'];
  $namabarang = $data['namabarang'];
  $satuanberat = $data['satuanberat'];
  $tanggal = $data['tanggal'];
  $qty = $data['qty'];
  ?>
  <div class="modal fade" id="edit<?=$idbarang;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Barang</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form method="post">
          <div class="modal-body">
            <input type="hidden" name="idbarang" value="<?php echo $idbarang; ?>">
            <input type="text" name="namabarang" value="<?php echo $namabarang; ?>" class="form-control mb-3" readonly>
            <input type="number" name="satuanberat" value="<?php echo $satuanberat; ?>" class="form-control mb-3" readonly>
            <input type="number" name="qty" value="<?php echo $qty; ?>" placeholder="Jumlah Barang" class="form-control mb-3" required>
            <input type="hidden" name="idmasuk" value="<?php echo $idmasuk; ?>">
            <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="delete<?=$idbarang;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Barang?</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form method="post">
          <div class="modal-body">
            <input type="hidden" name="idmasuk" value="<?php echo $idmasuk; ?>">
            <input type="hidden" name="idbarang" value="<?php echo $idbarang; ?>">
            Apakah Anda Yakin Ingin Menghapus <?=$namabarang;?> <?=$satuanberat;?>?
            <input type="hidden" name="kty" value="<?php echo $qty; ?>">
            <button type="submit" class="btn btn-danger col-12 mt-3" name="hapusbarangmasuk">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php 
  }
?>
</html>
