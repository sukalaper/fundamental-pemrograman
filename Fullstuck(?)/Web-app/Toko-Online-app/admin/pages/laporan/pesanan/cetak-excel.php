<?php
session_start();
    //Koneksi database
    include '../../../../config/database.php';
    //Mengambil nama aplikasi
    $query = mysqli_query($kon, "select nama_aplikasi from profil_aplikasi order by nama_aplikasi desc limit 1");    
    $row = mysqli_fetch_array($query);
    //Mengambil tanggal
    $tanggal='';
    $tanggal='';
    if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"])) $tanggal=date("d/m/Y",strtotime($_GET["dari_tanggal"]));
    if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"])) $tanggal= "".date("d/m/Y",strtotime($_GET["dari_tanggal"]))." - ".date("d/m/Y",strtotime($_GET["sampai_tanggal"]))."";
    
    //Membuat file format excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=LAPORAN PESANAN ".strtoupper($row['nama_aplikasi'])." ".$tanggal.".xls");
?>  
<h2><center>LAPORAN <?php echo strtoupper($row['nama_aplikasi']);?></center></h2>
<h4>Tanggal           : <?php echo $tanggal; ?></h4>

<?php
    $status="";
    if ($_GET['status']!=''){
        switch ($_GET['status']){
            case '0' : $status="Ditahan"; break;
            case '1' : $status="Pembayaran tertunda"; break;
            case '2' : $status="Sedang diproses"; break;
            case '3' : $status="Dikirim"; break;
            case '4' : $status="Selesai"; break;
            case '5' : $status="Dibatalkan"; break;    
        }
    }else {
        $status="Semua";
    }
?>
<h4>Status Pesanan    : <?php echo $status; ?></h4>

<?php
    $status_pembayaran="";
   if ($_GET['status_pembayaran']!=''){
    switch ($_GET['status_pembayaran']){
        case '0' : $status_pembayaran="Belum Dibayar"; break;
        case '1' : $status_pembayaran="Sudah Dibayar"; break;
    }
}else {
    $status_pembayaran="Semua";
}
?>
<h4>Status Pembayaran : <?php echo $status_pembayaran; ?></h4>
<table border="1">
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
            if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"])) $kondisi= "where date(p.tanggal)='".$_GET['dari_tanggal']."' ";
            if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"])) $kondisi= "where date(p.tanggal) between '".$_GET['dari_tanggal']."' and '".$_GET['sampai_tanggal']."'";
           
            if ($_GET['status']!='' && $_GET['status_pembayaran']!='') {

                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
                from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
                $kondisi and p.status='".$_GET['status']."' and p.status_pembayaran='".$_GET['status_pembayaran']."'
                order by id_pesanan desc";
    
            } else if ($_GET['status']!=''){
    
                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
                from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
                $kondisi and p.status='".$_GET['status']."'
                order by id_pesanan desc";
    
            } else if ($_GET['status_pembayaran']!=''){
    
                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
                from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
                $kondisi and p.status_pembayaran='".$_GET['status_pembayaran']."'
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

