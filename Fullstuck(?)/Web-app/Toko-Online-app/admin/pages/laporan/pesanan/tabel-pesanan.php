
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tabel">
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nomor</th>
        <th>Pelanggan</th>
        <th>Kota Tujuan</th>
        <th>Jasa Pengiriman</th>
        <th>Biaya Produk</th>
        <th>Ongkir</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
        <?php
            //Koneksi database
            include '../../../../config/database.php';
        
            $kondisi="";
            if (!empty($_POST["dari_tanggal"]) && empty($_POST["sampai_tanggal"])) $kondisi= "where date(p.tanggal)='".$_POST['dari_tanggal']."' ";
            if (!empty($_POST["dari_tanggal"]) && !empty($_POST["sampai_tanggal"])) $kondisi= "where date(p.tanggal) between '".$_POST['dari_tanggal']."' and '".$_POST['sampai_tanggal']."'";
           
            if ($_POST['status']!='' && $_POST['status_pembayaran']!='') {

                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
                from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
                $kondisi and p.status='".$_POST['status']."' and p.status_pembayaran='".$_POST['status_pembayaran']."'
                order by id_pesanan desc";
    
            } else if ($_POST['status']!=''){
    
                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
                from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
                $kondisi and p.status='".$_POST['status']."'
                order by id_pesanan desc";
    
            } else if ($_POST['status_pembayaran']!=''){
    
                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
                from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
                $kondisi and p.status_pembayaran='".$_POST['status_pembayaran']."'
                order by id_pesanan desc";
    
            } else {
        
                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
                from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
                $kondisi
                order by id_pesanan desc";
            }

           
            $hasil=mysqli_query($kon,$sql);
            $jum = mysqli_num_rows($hasil);
            $no=0;
            $jum_produk=0;
            $total_bayar=0;
            $status="";
        
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
                $no++;
                $nomor_pesanan=$data['nomor_pesanan'];
                $result=mysqli_query($kon,"select distinct nomor_pesanan, sum(qty) as jum, sum(harga*qty) as total_harga from pesanan_detail where nomor_pesanan='$nomor_pesanan' group by nomor_pesanan");
                
                while ($row = mysqli_fetch_array($result)):
                
                    $tanggal=date("Y-m-d",strtotime($data["tanggal"]));

                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo tanggal($tanggal); ?> </td>
                
                        <td><?php echo $data['nomor_pesanan']; ?></td>
                        <td><?php echo $data['nama_pelanggan']; ?></td>
                        <td><?php echo $data['kabupaten']; ?>, <?php echo $data['provinsi']; ?></td>
                        <td><?php echo strtoupper($data['kurir']); ?> - <small><?php echo $data['jenis_layanan']; ?></small></td>
                        <td>Rp. <?php echo number_format(($row['total_harga'])-$data['potongan'],0,',','.'); ?></td>
                        <td>Rp. <?php echo number_format($data['tarif'],0,',','.'); ?></td>
                        <td>Rp. <?php echo number_format(($row['total_harga']+$data['tarif'])-$data['potongan'],0,',','.'); ?></td>
                    </tr>
                <?php
                endwhile;
            endwhile;
        ?>
        </tbody>
    </table>
</div>
<a href="pages/laporan/pesanan/cetak-pdf.php?status=<?php echo $_POST['status'];?>&status_pembayaran=<?php echo $_POST['status_pembayaran'];?>&dari_tanggal=<?php if (!empty($_POST["dari_tanggal"])) echo $_POST["dari_tanggal"]; ?>&sampai_tanggal=<?php if (!empty($_POST["sampai_tanggal"])) echo $_POST["sampai_tanggal"]; ?>" target='blank' class="btn btn-danger btn-icon-pdf"><span class="text"><i class="fas fa-file-pdf fa-sm"></i> Export PDF</span></a>
<a href="pages/laporan/pesanan/cetak-excel.php?status=<?php echo $_POST['status'];?>&status_pembayaran=<?php echo $_POST['status_pembayaran'];?>&dari_tanggal=<?php if (!empty($_POST["dari_tanggal"])) echo $_POST["dari_tanggal"]; ?>&sampai_tanggal=<?php if (!empty($_POST["sampai_tanggal"])) echo $_POST["sampai_tanggal"]; ?>" target='blank' class="btn btn-success btn-icon-pdf"><span class="text"><i class="fas fa-file-excel fa-sm"></i> Export Excel</span></a>

<?php
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