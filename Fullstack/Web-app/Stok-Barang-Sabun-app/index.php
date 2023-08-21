<?php 
require 'kelola_stok/function.php';
require 'kelola_stok/cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Administrator</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="assets/css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.php">Inventory Sederhana</a>
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
          <li><a class="dropdown-item" href="pages/auth/logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading"><i class="fa-solid fa-circle"></i> Kelola Barang</div>
            <a class="nav-link" href="index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-boxes-alt"></i></div>
              Stok Awal Barang
            </a>
            <a class="nav-link" href="kelola_stok/barang-masuk.php">
              <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
              Stok Barang Masuk
            </a>
            <a class="nav-link" href="kelola_stok/barang-keluar.php">
              <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
              Stok Barang Keluar
            </a>
            <div class="sb-sidenav-menu-heading"><i class="fa-solid fa-circle"></i> Rekapitulasi</div>
            <a class="nav-link" href="pages/charts.html">
              <div class="sb-nav-link-icon"><i class="fas fa-barcode"><</i></div>
              Laporan Penjualan
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion"></div>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          Sukalaper
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <div class="text-left mt-4">
            <h1 class="animated-text">Toko Sabun Sukalaper</h1>
          </div>
          <div class="card mb-4">
            <div class="card-header">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right;">
                <span class="fas fa-plus"></span> Tambah Barang Baru
              </button>
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Satuan Berat (g) (mL)</th>
                    <th>Harga Modal</th>
                    <th>Harga Jual</th>
                    <th>Jumlah Barang</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $result_ambil_semua_data_stok = mysqli_query($conn,"SELECT * FROM stok");
                    $i = 1;
                    while($data=mysqli_fetch_array($result_ambil_semua_data_stok)){
                      $namabarang = $data['namabarang'];
                      $satuanberat = $data['satuanberat'];
                      $hargamodal = $data['hargamodal'];
                      $hargajual = $data['hargajual'];
                      $jumlahbarang = $data['jumlahbarang'];
                      $idbarang = $data['idbarang'];
                  ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?=$namabarang;?></td>
                    <td><?=$satuanberat;?></td>
                    <td><?=$hargamodal;?></td>
                    <td><?=$hargajual;?></td>
                    <td><?=$jumlahbarang;?></td>
                    <td>
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idbarang;?>">
                        <i class="fas fa-edit"></i>
                      </button>
                      <input type="hidden" name="barangdihapus" value="<?=$idbarang;?>"> 
                      <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#delete<?=$idbarang;?>">
                        <i class="fas fa-trash"></i> 
                      </button> 
                    </td>  
                  </tr>
                  <div class="modal fade" id="edit<?=$idbarang;?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Barang</h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="post">
                          <div class="modal-body">
                            <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                            <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control mb-3" required>
                            <input type="number" name="hargamodal" step="0.001" pattern="\d+(\.\d{2})?" placeholder="Harga Modal (Rp)" class="form-control mb-0" required>
                            <p style="font-size: 1px; color: red;">*Jika harga barang adalah Rp1.000 isi kolom dengan angka 1</p>
                            <input type="number" name="satuanberat" placeholder="Satuan Berat" class="form-control mb-0" required>
                            <p style="font-size: 1px; color: red;">*Secara matematis satuan <em>Gram</em> dan <em>Mili</em> adalah ukuran yang sama</p>
                            <input type="number" name="hargajual" step="0.001" pattern="\d+(\.\d{2})?" placeholder="Harga Jual (Rp)" class="form-control mb-3" required>
                            <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
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
                            <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                            Apakah Anda Yakin Ingin Menghapus <?=$namabarang;?> <?=$satuanberat;?>g/mL?
                            <button type="submit" class="btn btn-danger col-12 mt-3" name="hapusbarang">Hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php
                    }; 
                  ?>
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
  <script src="assets/js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="assets/js/datatables-simple-demo.js"></script>
</body>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang Baru</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="post">
        <div class="modal-body">
          <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control mb-3" required>
          <input type="number" name="hargamodal" step="0.001" pattern="\d+(\.\d{2})?" placeholder="Harga Modal (Rp)" class="form-control mb-0" required>
          <p style="font-size: 1px; color: red;">*Jika harga barang adalah Rp1.000 isi kolom dengan angka 1</p>
          <input type="number" name="satuanberat" placeholder="Satuan Berat" class="form-control mb-0" required>
          <p style="font-size: 1px; color: red;">*Secara matematis, satuan <em>Gram</em> dan <em>Mili</em> adalah ukuran yang sama</p>
          <input type="number" name="jumlahbarang" placeholder="Jumlah Barang" class="form-control mb-3" required>
          <input type="number" name="hargajual" step="0.001" pattern="\d+(\.\d{2})?" placeholder="Harga Jual (Rp)" class="form-control mb-3" required>
          <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
</html>
