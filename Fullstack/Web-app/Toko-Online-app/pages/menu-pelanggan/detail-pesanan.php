
<?php
if (!isset($_SESSION["id_pelanggan"])){
    echo"<script> window.location.href = 'index.php?page=login&aut=login'; </script>";
    exit;
}

?>

<?php
    include 'config/database.php';
    $nomor_pesanan=addslashes(trim($_GET['nomor_pesanan']));
    $hasil=mysqli_query($kon,"select * from pesanan n inner join pesanan_detail d  on n.nomor_pesanan=d.nomor_pesanan  where n.nomor_pesanan='$nomor_pesanan' ");
    $jum = mysqli_num_rows($hasil);
    $row = mysqli_fetch_array($hasil);

    if ($jum<1){
        echo"<script> window.location.href = 'index.php?page=pesanan-saya&aut=tidak_tersedia'; </script>";
    }
    

?>
<div class="women-product">
    <div class=" w_content">
        <div class="women">
            <h3>Pesanan Saya</h3>
     
            <div class="clearfix"> </div>	
        </div>
    </div>
    <!-- grids_of_4 -->

    <div class="grid-product">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#detail_pesanan">PESANAN & PENGIRIMAN</a></li>
        <li><a data-toggle="tab" href="#biaya">PRODUK & BIAYA</a></li>
        <li><a data-toggle="tab" href="#status">STATUS</a></li>
        <li><a data-toggle="tab" href="#pembayaran">KONFIRMASI PEMBAYARAN</a></li>
    </ul>

    <div class="tab-content">
        <div id="detail_pesanan" class="tab-pane fade <?php if (!isset($_GET['konfirmasi'])) echo 'in active'?>">
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Tanggal</td>
                            <td>: <?php echo tanggal(date('Y-m-d', strtotime($row["tanggal"]))); ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Pesanan</td>
                            <td>: <?php echo $row['nomor_pesanan']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: <?php echo $row['nama']; ?></td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>: <?php echo $row['nomor_hp']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: <?php echo $row['alamat']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Provinsi</td>
                                <td>: <?php echo $row['provinsi']; ?></td>
                            </tr>
                            <tr>
                                <td>Kota/Kabupaten</td>
                                <td>: <?php echo $row['kabupaten']; ?></td>
                            </tr>
                            <tr>
                                <td>Jasa Pengiriman</td>
                                <td>: <?php echo  strtoupper($row['kurir']); ?></td>
                            </tr>
                            <tr>
                                <td>Layanan</td>
                                <td>: <?php echo $row['jenis_layanan']; ?></td>
                            </tr>
                            <tr>
                                <td>Estimasi Waktu</td>
                                <td>: <?php echo $row['estimasi_waktu']; ?> Hari</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div id="biaya" class="tab-pane fade">
            <br>
            <div class="table-responsive">
            <table class="table table-striped table-bordered">
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
                        include 'config/database.php';
                        //perintah sql untuk menampilkan daftar pembayaran
                        $sub_total=0;
                        $no=0;
                        $total=0;
                        $nomor_pesanan=$_GET['nomor_pesanan'];
                        $result=mysqli_query($kon,"select * from pesanan_detail d inner join produk p on p.kode_produk=d.kode_produk where nomor_pesanan='$nomor_pesanan' ");
                        while ($data = mysqli_fetch_array($result)):
                            $no++;
                            $sub_total=$data['harga']*$data['qty'];
                            $total+=$sub_total;
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
            <h4><small>Ongkir : Rp. <?php echo number_format($row['tarif'],0,',','.'); ?> </small><small>| Potongan : Rp. <?php echo number_format($row['potongan'],0,',','.'); ?> </small> </h4>

            <h4><strong>Total Bayar Rp. <?php echo number_format((($total+$row['tarif'])-$row['potongan']),0,',','.'); ?></strong></h4>
           
        </div>
        <div id="status" class="tab-pane fade">
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
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
                        //Koneksi database
                        include 'config/database.php';
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
                            </tr>
                        <?php
                        endwhile;
                    ?>
                </tbody>
                </table>
            </div>
        </div>
        <div id="pembayaran" class="tab-pane fade <?php if (isset($_GET['konfirmasi'])) echo 'in active'?>">
            <br>

            <?php
                if (isset($_GET['konfirmasi'])) {
                    if ($_GET['konfirmasi']=='berhasil'){
                        echo"<div class='alert alert-info'>Terimakasih telah melakukan konfirmasi pembayaran. Admin kami akan segera mengecek pembayaran anda.</div>";
                    } else if ($_GET['konfirmasi']=='gagal')  {
                        echo"<div class='alert alert-danger'>Konfirmasi pembayaran gagal.</div>";
                    } 
                }else {
                    if ($row['status_pembayaran']==1){
                        echo "<div class='alert alert-success'><strong>Info!</strong> Pembayaran telah kami terima.</div>";
                    }else {
                        echo "<div class='alert alert-info'><strong>Info!</strong> Pembayaran belum kami terima.</div>";
                    }
                }
            ?>
            <h4><?php echo $row['status_pembayaran'] == 1 ? "<span class='label label-success'>Telah Dibayar</span>" : "<span class='label label-default'>Belum Dibayar</span>"; ?> </h4>
            <?php if ($row['status_pembayaran']!=1):?>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Konfirmasi Pembayaran</button>
            <?php endif; ?>
        </div>
        
    </div>

	<div class="clearfix"> </div>
    </div> 
</div>

<?php include 'menu-pelanggan.php';?>


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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Pembayaran</h4>
      </div>
      <div class="modal-body">
      <form action="pages/menu-pelanggan/konfirmasi-pembayaran.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nomor Pesanan:</label>
            <input type="text" class="form-control" value="<?php echo $_GET['nomor_pesanan'];?>" disabled>
            <input type="hidden" name="nomor_pesanan" class="form-control" value="<?php echo $_GET['nomor_pesanan'];?>">
        </div>
        <div class="form-group">
            <label>Tanggal Transfer:</label>
            <input type="date" class="form-control" name="tanggal_transfer">
        </div>
        <div class="form-group">
        <label>Ditransfer Ke:</label>
        <select class="form-control" name="id_pembayaran">
        <?php
            include 'config/database.php';
            $sql="select * from pembayaran order by id_pembayaran asc";
            $hasil=mysqli_query($kon,$sql);
            while ($row = mysqli_fetch_array($hasil)):
        ?>
            <option value="<?php echo $row['id_pembayaran']; ?>"><?php echo $row['nama_bank']." - ".$row['nomor_rekening']." - ".$row['nama_rekening']; ?></option>
            <?php endwhile; ?>
        </select>
        </div>
        <div class="form-group">
            <label>Bank Asal:</label>
            <input type="text" class="form-control" name="bank_asal" placeholder="Masukan Bank Asal">
        </div>
        <div class="form-group">
            <label>Nama Pemilik Rekening:</label>
            <input type="text" class="form-control" name="nama_rekening" placeholder="Masukan Nama Pemilik Rekening">
        </div>
        <div class="form-group">
            <label>Jumlah Uang :</label>
            <input type="text" class="form-control" name="jumlah_uang" placeholder="Masukan Jumlah Uang">
        </div>
        <div class="form-group">
                <div id="msg"></div>
                <label>Bukti Pembayaran:</label>
                <input type="file" name="gambar" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                        <div class="input-group-append">
                                <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih</button>
                        </div>
                    </div>
                <img src="images/img80.png" id="preview" class="img-thumbnail">
            </div>
        <div class="form-group">
        <input type="submit" name="submit" class="btn btn-info" value="Submit">
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>
</div>


<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>
<script>
    $(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });
</script>