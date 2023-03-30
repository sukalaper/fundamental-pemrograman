<?php
    if (!isset($_SESSION["id_pelanggan"])){
        echo"<script> window.location.href = 'index.php?page=login&aut=login'; </script>";
        exit;
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
    <?php 
    if (isset($_GET['aut'])) {
        if ($_GET['aut']=='tidak_tersedia'){
            echo"<div class='alert alert-danger'>Pesanan tidak tersedia.</div>";
        } 
    }
    ?>
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nomor Pesanan</th>
                <th>Qty</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    //Koneksi database
                    include 'config/database.php';
                    
                    $batas   = 10;
                    $halaman = @$_GET['halaman'];
                    if(empty($halaman)){
                        $posisi  = 0;
                        $halaman = 1;
                    }
                    else{
                        $posisi  = ($halaman-1) * $batas;
                    }

                    $kode_pelanggan=$_SESSION["kode_pelanggan"];
                    $sql="select * from pesanan where kode_pelanggan='$kode_pelanggan' order by id_pesanan desc limit $posisi,$batas";
                    $hasil=mysqli_query($kon,$sql);
                    $no=$posisi+1;
                    $jum_produk=0;
                    $total_bayar=0;
                    $status="";
                    $jum=0;
                    //Menampilkan data dengan perulangan while
                    while ($data = mysqli_fetch_array($hasil)):
                     
                        $nomor_pesanan=$data['nomor_pesanan'];
                        $result=mysqli_query($kon,"select distinct nomor_pesanan, sum(qty) as jum, sum(harga*qty) as total_harga from pesanan_detail where nomor_pesanan='$nomor_pesanan' group by nomor_pesanan");
                        $jum = mysqli_num_rows($result);
                        while ($row = mysqli_fetch_array($result)):
                        
                            $tanggal=date("Y-m-d",strtotime($data["tanggal"]));

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
                                <td><?php echo tanggal($tanggal); ?> </td>
                                <td><?php echo $data['nomor_pesanan']; ?></td>
                                <td><?php echo $row['jum']; ?></td>
                                <td>Rp. <?php echo number_format(($data['tarif']+$row['total_harga'])-$data['potongan'],0,',','.'); ?></td>
                                <td><?php echo $status; ?>  </td>
                                <td> <a href="index.php?page=detail-pesanan&nomor_pesanan=<?php echo $data['nomor_pesanan']; ?>">Lihat</a></td>
                            </tr>
                        <?php

                        endwhile;
                        $no++;
                    endwhile;
                    ?>
                </tbody>
            </table>
    </div>

    <?php
    $query2 = mysqli_query($kon, "select * from pesanan where kode_pelanggan='$kode_pelanggan'");        
    $jmldata    = mysqli_num_rows($query2);
    $jmlhalaman = ceil($jmldata/$batas);
    ?>
    <div class="text-center">
        <ul class="pagination">
            <?php
            for($i=1;$i<=$jmlhalaman;$i++) {
                if ($i != $halaman) {
                    echo "<li class='page-item'><a class='page-link' href='index.php?page=pesanan-saya&halaman=$i'>$i</a></li>";
                } else {
                    echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                }
            }
            ?>
        </ul>
    </div>

    <?php 
    if ($jum<1){
        echo"<div class='alert alert-warning'>Anda belum melakukan pemesanan</div>";
    } 
    ?>
	<div class="clearfix"> </div>
    </div> 
</div>




<?php include 'menu-pelanggan.php';?>
<div class="clearfix"> </div>

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