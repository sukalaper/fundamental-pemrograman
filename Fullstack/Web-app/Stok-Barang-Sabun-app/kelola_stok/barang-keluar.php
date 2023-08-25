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
            <h1 class="animated-text">Kelola Barang Keluar</h1>
          </div> 
          <div class="card mb-4">
            <div class="card-header">
              <a href="export-barang-keluar.php" class="btn btn-primary" style="float: right;">
                <span class="fas fa-plus"></span> Export Data
              </a>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 8px;">
                <span class="fas fa-plus"></span> Tambah Barang Keluar
              </button> 
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>ID Barang</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result_ambil_semua_data_stok = mysqli_query($conn,"SELECT * FROM keluar K, stok S WHERE S.idbarang = K.idbarang");
                  while($data=mysqli_fetch_array($result_ambil_semua_data_stok)){
                    $idbarang = $data['idbarang'];
                    $tanggal = $data['tanggal'];
                    $namabarang = $data['namabarang'];
                    $qty = $data['qty'];
                    ?>
                    <tr>
                      <td><?php echo $idbarang; ?></td>
                      <td><?php echo $tanggal ;?></td>
                      <td><?php echo $namabarang ;?></td>
                      <td><?php echo $qty ;?></td>
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
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Keluar</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form method="post">
          <div class="modal-body">
            <select name="barangnya" class="form-control mb-3">
              <?php 
              $ambildata = mysqli_query($conn,"select * from stok");
              while($fetcharray = mysqli_fetch_array($ambildata)){
                $barangnya = $fetcharray['namabarang'];
                $idbarangnya = $fetcharray['idbarang'];
                $satuanberat = $fetcharray['satuanberat'];
                ?>
                  <option value="<?php echo $idbarangnya ;?>"> <?php echo $barangnya ;?> <?php echo $satuanberat; ?></option>
                <?php } ?>
            </select>
            <input type="number" name="qty" placeholder="Jumlah Barang" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
$result_ambil_semua_data_stok = mysqli_query($conn, "SELECT * FROM keluar M, stok S WHERE S.idbarang = M.idbarang");
while ($data = mysqli_fetch_array($result_ambil_semua_data_stok)) {
  $idbarang = $data['idbarang'];
  $idkeluar = $data['idkeluar'];
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
           <input type="hidden" name="idkeluar" value="<?php echo $idkeluar; ?>">
           <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
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
          <input type="hidden" name="idkeluar" value="<?php echo $idkeluar; ?>">
          <input type="hidden" name="idbarang" value="<?php echo $idbarang; ?>">
          Apakah Anda Yakin Ingin Menghapus <?=$namabarang;?> <?=$satuanberat;?>?
          <input type="hidden" name="kty" value="<?php echo $qty; ?>">
          <button type="submit" class="btn btn-danger col-12 mt-3" name="hapusbarangkeluar">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php 
  }
?>
</html>
