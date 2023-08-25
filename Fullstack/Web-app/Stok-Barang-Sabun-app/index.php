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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
      </symbol>
      <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
      </symbol>
      <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
      </symbol>
    </svg>
  </head>
  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand ps-3" href="index.php">Toko Sukalaper</a>
      <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
      </button>
      <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
          <button class="btn btn-primary" id="btnNavbarSearch" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user fa-fw"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="pages/auth/logout.php">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading"> Kelola Barang </div>
              <hr>
              <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-boxes-alt"></i>
                </div> Stok Barang
              </a>
              <a class="nav-link" href="kelola_stok/barang-masuk.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-dolly"></i>
                </div> Barang Masuk
              </a>
              <a class="nav-link" href="kelola_stok/barang-keluar.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-dolly"></i>
                </div> Barang Keluar
              </a>
              <a class="nav-link" href="kelola_stok/kelola_stok.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-book"></i>
                </div> Rekap Penjualan
              </a>
              <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion"></div>
            </div>
          </div>
          <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div> Sukalaper
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <div class="text-left mt-4">
              <h1 class="animated-text">Kelola Barang</h1>
            </div>
            <div class="card mb-4">
              <div class="card-header">
                <a href="kelola_stok/export-barang-awal.php" class="btn btn-primary" style="float: right;">
                  <span class="fas fa-plus"></span> Export Data </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 8px;">
                  <span class="fas fa-plus"></span> Tambah Barang Baru </button>
              </div>
              <div class="card-body">
                <?php
                  $ambildatastok = mysqli_query($conn,"SELECT * FROM stok WHERE jumlahbarang < 5");
                    while($fetch=mysqli_fetch_array($ambildatastok)){
                      $namabarang = $fetch['namabarang'];
                ?>
                <div class="alert alert-warning alert-dismissible d-flex align-items-center" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                    <use xlink:href="#exclamation-triangle-fill" />
                  </svg>
                  <div>
                    <strong>Perhatian!</strong> Stok barang <?=$namabarang;?> menipis.
                  </div>
                </div>
                <?php 
                  }
                ?>
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
                  <tbody> <?php 
                    $result_ambil_semua_data_stok = mysqli_query($conn,"SELECT * FROM stok");
                    $i = 1;
                    while($data=mysqli_fetch_array($result_ambil_semua_data_stok)){
                      $namabarang = $data['namabarang'];
                      $satuanberat = $data['satuanberat'];
                      $hargamodal = $data['hargamodal'];
                      $hargajual = $data['hargajual'];
                      $jumlahbarang = $data['jumlahbarang'];
                      $idbarang = $data['idbarang'];
                    ?> <tr>
                      <td> <?=$i++;?> </td>
                      <td> <?=$namabarang;?> </td>
                      <td> <?=$satuanberat;?> </td>
                      <td> <?=$hargamodal;?> </td>
                      <td> <?=$hargajual;?> </td>
                      <td> <?=$jumlahbarang;?> </td>
                      <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit
															<?=$idbarang;?>">
                          <i class="fas fa-edit"></i>
                        </button>
                        <input type="hidden" name="barangdihapus" value="
															<?=$idbarang;?>">
                        <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#delete
																<?=$idbarang;?>">
                          <i class="fas fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <div class="modal fade" id="edit
														<?=$idbarang;?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Barang</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <form method="post">
                            <div class="modal-body">
                              <input type="hidden" name="idbarang" value="
																			<?=$idbarang;?>">
                              <input type="text" name="namabarang" value="
																				<?=$namabarang;?>" class="form-control mb-3" required>
                              <input type="number" name="hargamodal" step="0.001" pattern="\d+(\.\d{2})?" placeholder="Harga Modal (Rp)" class="form-control mb-0" required>
                              <p style="font-size: 1px; color: red;">*Jika harga barang adalah Rp1.000 isi kolom dengan angka 1</p>
                              <input type="number" name="satuanberat" placeholder="Satuan Berat" class="form-control mb-0" required>
                              <p style="font-size: 1px; color: red;">*Secara matematis satuan <em>Gram</em> dan <em>Mili</em> adalah ukuran yang sama </p>
                              <input type="number" name="hargajual" step="0.001" pattern="\d+(\.\d{2})?" placeholder="Harga Jual (Rp)" class="form-control mb-3" required>
                              <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="delete
																			<?=$idbarang;?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Hapus Barang?</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <form method="post">
                            <div class="modal-body">
                              <input type="hidden" name="idbarang" value="
																								<?=$idbarang;?>"> Apakah Anda Yakin Ingin Menghapus <?=$namabarang;?> <?=$satuanberat;?>g/mL? <button type="submit" class="btn btn-danger col-12 mt-3" name="hapusbarang">Hapus</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div> <?php
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
              <div>
                <a href="#">Privacy Policy</a> &middot; <a href="#">Terms &amp; Conditions</a>
              </div>
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
            <p style="font-size: 1px; color: red;">*Secara matematis, satuan <em>Gram</em> dan <em>Mili</em> adalah ukuran yang sama </p>
            <input type="number" name="jumlahbarang" placeholder="Jumlah Barang" class="form-control mb-3" required>
            <input type="number" name="hargajual" step="0.001" pattern="\d+(\.\d{2})?" placeholder="Harga Jual (Rp)" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</html>
