<?php
    include '../../../../config/database.php';
    $nomor_pesanan=$_GET['nomor_pesanan'];
    $hasil=mysqli_query($kon,"select * from pesanan n left join pesanan_detail d  on n.nomor_pesanan=d.nomor_pesanan where n.nomor_pesanan='$nomor_pesanan' ");
    $row = mysqli_fetch_array($hasil);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
  <div class="col-xs-12">
      <h2 class="page-header">
      <i class="fa fa-globe"></i> Invoice #<?php echo $row['nomor_pesanan'];?>
      <small class="pull-right">Tanggal :<?php if (isset($row['tanggal'])) echo tanggal(date("Y-m-d",strtotime($row["tanggal"])));?></small>
      </h2>
  </div>
  <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
  <div class="col-sm-4 invoice-col">
      <b>Penerima</b>
      <br>
      <b>Nama:</b> <?php echo $row['nama']; ?><br>
      <b>No Telp:</b><?php echo $row['nomor_hp']; ?><br>

  </div>
  <!-- /.col -->
  <div class="col-sm-4 invoice-col">
      <b>Alamat</b>
      <address>
      <?php echo $row['alamat']; ?><br>
      <?php echo $row['kabupaten']; ?>, <?php echo $row['provinsi']; ?><br>
      </address>
  </div>
  <!-- /.col -->
  <div class="col-sm-4 invoice-col">
      <b>Pengiriman</b>
      <br>
      <b>Kurir:</b> <?php echo strtoupper($row['kurir']); ?> (<?php echo $row['jenis_layanan']; ?>)<br>
      <b>Estimasi Waktu:</b> <?php echo $row['estimasi_waktu']; ?> hari
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
  <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
      <thead>
      <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Subtotal</th>
      </tr>
      </thead>
      <tbody>
          <?php
              //perintah sql untuk menampilkan daftar pembayaran
              $sub_total=0;
              $no=0;
              $total=0;
              $nomor_pesanan=$_GET['nomor_pesanan'];
              $result=mysqli_query($kon,"select * from pesanan_detail d inner join produk p on p.kode_produk=d.kode_produk left join pesanan n on n.nomor_pesanan=d.nomor_pesanan where n.nomor_pesanan='$nomor_pesanan' ");
              while ($data = mysqli_fetch_array($result)):
                  $no++;
                  $sub_total=$data['harga']*$data['qty'];
                  $total+=$sub_total;
                  $potongan=$data['potongan'];
                  ?>
                  <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data['nama_produk']; ?></td>
                      <td><?php echo $data['qty']; ?></td>
                      <td>Rp. <?php echo number_format($data['harga'],0,',','.'); ?></td>
                      <td>Rp. <?php echo number_format($sub_total,0,',','.'); ?></td>
                  </tr>
              <?php
              endwhile;
          ?>
      </tbody>
      </table>
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
  <!-- accepted payments column -->
  <div class="col-xs-8">
      <p class="lead">Status:</p>
      <div class="table-responsive">
      <table class="table table-striped">
      <thead>
      <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Status</th>
          <th>Keterangan</th>
      </tr>
      </thead>
      <tbody>
          <?php
      
              //perintah sql untuk menampilkan daftar pembayaran
              $status="";
              $no=0;
              $nomor_pesanan=$_GET['nomor_pesanan'];
              $result=mysqli_query($kon,"select * from status where nomor_pesanan='$nomor_pesanan' order by id_status desc ");
              while ($data = mysqli_fetch_array($result)):
                  $no++;
                  $tanggal=date("d-m-Y",strtotime($data["tanggal"]));
                  $jam=date("H:i",strtotime($data["tanggal"]));

                  switch ($data['status']){
                      case '0' : $status='Ditahan';break;
                      case '1' : $status='Pembayaran tertunda';break;
                      case '2' : $status='Sedang diproses';break;
                      case '3' : $status='Selesai';break;
                      case '4' : $status='Dibatalkan';break;
                      case '5' : $status='Dana dikembalikan';break;
                      default :  $status='-';

                  }
                  ?>
                  <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $tanggal; ?></td>
                      <td><?php echo $jam; ?> WIB</td>
                      <td><?php echo $status; ?></td>
                      <td><?php echo $data['keterangan']; ?></td>
                  </tr>
              <?php
              endwhile;
          ?>
      </tbody>
      </table>
  </div>
  </div>
  <!-- /.col -->
  <div class="col-xs-4">
      <p class="lead">Rincian:</p>

      <div class="table-responsive">
      <table class="table">
          <tr>
          <th style="width:50%">Subtotal:</th>
          <td>Rp. <?php echo number_format($total,0,',','.'); ?> </td>
          </tr>
          <tr>
            <th style="width:50%">Potongan:</th>
            <td>Rp. <?php echo number_format($potongan,0,',','.'); ?> </td>
            </tr>
          <tr>
          <th>Biaya Pengiriman:</th>
          <td>Rp. <?php echo number_format($row['tarif'],0,',','.'); ?> </td>
          </tr>
          <tr>
          <th>Total:</th>
          <td>Rp. <?php echo number_format(($row['tarif']+$total)-$potongan,0,',','.'); ?> </td>
          </tr>
      </table>
      </div>
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->


</section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>


<?php 
    //Membuat format tanggal
    function tanggal($tanggal)
    {
        $bulan = array (1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }

?>

