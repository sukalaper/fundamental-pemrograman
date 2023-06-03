<?php
    include '../config/database.php';
    $nomor_pesanan=addslashes(trim($_GET['nomor_pesanan']));
    $hasil=mysqli_query($kon,"select * from pesanan n inner join pesanan_detail d  on n.nomor_pesanan=d.nomor_pesanan where n.nomor_pesanan='$nomor_pesanan' ");
    $jumlah = mysqli_num_rows($hasil);

    //Validasi jika nomor pesanan tidak sesuai
    if ($jumlah<=0){
        echo "<script> window.location.href = 'index.php?page=pesanan'; </script>";
        exit;
    }
    
    $row = mysqli_fetch_array($hasil);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Invoice
    <small>#<?php echo $row['nomor_pesanan'];?> </small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Invoice</li>
    </ol>
</section>
<!-- Main content -->
<section class="invoice">
<?php if ($row['status_pembayaran']==0):?>
<div class="alert alert-info">
  <strong>Info!</strong> Stok produk akan di kurangi setelah status pembayaran menjadi <strong>Telah Dibayar</strong>
</div>
<?php endif; ?>

    <!-- title row -->
    <div class="row">
    <div class="col-xs-12">
        <h2 class="page-header">
        <i class="fa fa-globe"></i> Pesanan <?php echo $row['status_pembayaran'] == 1 ? "<span class='label label-success'>Telah Dibayar</span>" : "<span class='label label-default'>Belum Dibayar</span>"; ?> 
        <small class="pull-right">Tanggal : <?php if (isset($row['tanggal'])) echo tanggal(date("Y-m-d",strtotime($row["tanggal"])));?></small>
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
                    //Koneksi database
                    include '../config/database.php';
                    //perintah sql untuk menampilkan daftar pembayaran
                    $sub_total=0;
                    $no=0;
                    $total=0;
                    $nomor_pesanan=addslashes(trim($_GET['nomor_pesanan']));
                    $result=mysqli_query($kon,"select * from pesanan_detail d inner join produk p on p.kode_produk=d.kode_produk left join pesanan n on n.nomor_pesanan=d.nomor_pesanan where n.nomor_pesanan='$nomor_pesanan' ");
                    $jum = mysqli_num_rows($result);
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
            <?php 
                if ($jum<1){
                    echo"<div class='alert alert-danger'>Produk telah dihapus.</div>"; 
                }
            ?>
        </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-8">
        <p class="lead">Status:</p>

        <?php
            if (isset($_GET['tambah'])) {
                if ($_GET['tambah']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Status baru telah ditambah!</div>";
                }else if ($_GET['tambah']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Status baru gagal ditambah!</div>";
                }    
            }
            if (isset($_GET['hapus'])) {
                if ($_GET['hapus']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Status telah dihapus!</div>";
                }else if ($_GET['hapus']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Status gagal dihapus!</div>";
                }    
            }
        ?>


        <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <?php
                //Koneksi database
                include '../config/database.php';
                //perintah sql untuk menampilkan daftar pembayaran
                $status="";
                $no=0;
                $nomor_pesanan=addslashes(trim($_GET['nomor_pesanan']));
                $result=mysqli_query($kon,"select * from status where nomor_pesanan='$nomor_pesanan' order by id_status desc ");
                while ($data = mysqli_fetch_array($result)):
                    $no++;
                    $tanggal=date("d-m-Y",strtotime($data["tanggal"]));
                    $jam=date("H:i",strtotime($data["tanggal"]));

                    switch ($data['status']){
                        case '0' : $status="<span class='label label-default'>Ditahan</span>";break;
                        case '1' : $status="<span class='label label-warning'>Pembayaran tertunda</span>";break;
                        case '2' : $status="<span class='label label-info'>Sedang diproses</span>";break;
                        case '3' : $status="<span class='label label-primary'>Dikirim</span>";break;
                        case '4' : $status="<span class='label label-success'>Selesai</span>";break;
                        case '5' : $status="<span class='label label-danger'>Dibatalkan</span>";break;
                        default :  $status='-';

                    }
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo $jam; ?> WIB</td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $data['keterangan']; ?></td>
                        <td>
                        <a href="pages/pesanan/hapus-status.php?id=<?php echo $data['id_status']; ?>&status=<?php echo $data['status']; ?>&nomor_pesanan=<?php echo $nomor_pesanan; ?>" class="tombol_hapus btn btn-danger btn-circle btn-sm" ><i class="fa fa-trash"></i></a>
                        </td>
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

    <!-- this row will not appear when printing -->
    <div class="row no-print">
    <div class="col-xs-12">
        <button type="button" id="update_status" class="btn btn-primary" style="margin-right: 5px;" nomor_pesanan="<?php echo addslashes(trim($_GET['nomor_pesanan']));?>">
        <i class="fa fa-download"></i> Update Status
        </button>
        <button type="button" id="konfirmasi_pembayaran" nomor_pesanan="<?php echo addslashes(trim($_GET['nomor_pesanan']));?>" class="btn btn-success"><i class="fa fa-credit-card"></i> Konfirmasi Pembayaran
        </button>
        <a href="pages/pesanan/cetak/invoice-print.php?nomor_pesanan=<?php echo addslashes(trim($_GET['nomor_pesanan'])); ?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>

    </div>
    </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>

<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <div id="tampil_data">
                 <!-- Data akan di load menggunakan AJAX -->                   
            </div>  
        </div>
  
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>


<script>
    // Tambah pembayaran
    $('#update_status').on('click',function(){

        var nomor_pesanan = $(this).attr("nomor_pesanan");

        $.ajax({
            url: 'pages/pesanan/update-status.php',
            method: 'post',
            data: {nomor_pesanan:nomor_pesanan},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Update Status';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Tambah pembayaran
    $('#konfirmasi_pembayaran').on('click',function(){

        var nomor_pesanan = $(this).attr("nomor_pesanan");

        $.ajax({
            url: 'pages/pesanan/konfirmasi-pembayaran.php',
            method: 'post',
            data: {nomor_pesanan:nomor_pesanan},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Konfirmasi Pembayaran #'+nomor_pesanan;
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
   // fungsi hapus 
   $('.tombol_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus status pesanan ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>



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
