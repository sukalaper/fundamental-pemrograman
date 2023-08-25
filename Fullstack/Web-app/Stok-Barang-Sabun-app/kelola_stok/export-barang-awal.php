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
  <title>Rekap Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>
<div class="container">
  <center style="margin-top: 2em;">
    <h2 style="margin-bottom: 1em;">Toko Sabun Sukalaper</h2>
  </center>
  <table id="mauexport" class="data-tables datatable-dark" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Satuan Berat (g) (mL)</th>
        <th>Harga Modal</th>
        <th>Harga Jual</th>
        <th>Jumlah Barang</th>
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
      </tr>
      <?php
        }; 
      ?>
    </tbody>
  </table>
</div>
<script>
$(document).ready(function() {
  $('#mauexport').DataTable( {
    dom: 'Bfrtip',
    buttons: [
      'copy','csv','excel', 'pdf', 'print'
    ]
  });
});
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>
</html>
