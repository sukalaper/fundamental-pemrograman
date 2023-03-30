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
    header("Content-Disposition: attachment; filename=LAPORAN PENJUALAN ".strtoupper($row['nama_aplikasi'])." ".$tanggal.".xls");
?>  
<h2><center>LAPORAN <?php echo strtoupper($row['nama_aplikasi']);?></center></h2>
<h4>Tanggal : <?php echo $tanggal; ?></h4>

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


<table border='1'>
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Produk</th>
            <th>QTY</th>
            <th>Harga</th>
            <th>Sub Total</th>
        </tr>
    </thead>

    <tbody>
    <?php
        $kondisi="";

        if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"])) $kondisi= "where date(p.tanggal)='".$_GET['dari_tanggal']."' ";
        if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"])) $kondisi= "where date(p.tanggal) between '".$_GET['dari_tanggal']."' and '".$_GET['sampai_tanggal']."'";
     
        if ($_GET['status']!='' && $_GET['status_pembayaran']!='') {

            $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
            from pesanan p
            inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
            inner join produk k on k.kode_produk=d.kode_produk
            inner join kategori t on t.id_kategori=k.kategori
            $kondisi and p.status='".$_GET['status']."' and p.status_pembayaran='".$_GET['status_pembayaran']."'
            order by p.tanggal desc";
    
        } else if ($_GET['status']!=''){
    
            $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
            from pesanan p
            inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
            inner join produk k on k.kode_produk=d.kode_produk
            inner join kategori t on t.id_kategori=k.kategori
            $kondisi and p.status='".$_GET['status']."'
            order by p.tanggal desc";
    
        } else if ($_GET['status_pembayaran']!=''){
    
            $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
            from pesanan p
            inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
            inner join produk k on k.kode_produk=d.kode_produk
            inner join kategori t on t.id_kategori=k.kategori
            $kondisi and p.status_pembayaran='".$_GET['status_pembayaran']."'
            order by p.tanggal desc";
    
        } else {
    
            $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
            from pesanan p
            inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
            inner join produk k on k.kode_produk=d.kode_produk
            inner join kategori t on t.id_kategori=k.kategori
            $kondisi
            order by p.tanggal desc";
        }
    
        
        $hasil=mysqli_query($kon,$sql);
        $no=0;
        $total=0;
        $total_pemasukan=0;
        $total_pengeluaran=0;
        //Menampilkan data dengan perulangan while
        while ($data = mysqli_fetch_array($hasil)):
        $no++;

    ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $data['nomor_pesanan']; ?> </td>
        <td><?php echo tanggal($data['tanggal']); ?></td>
        <td><?php echo $data['nama_kategori']; ?> </td>
        <td><?php echo $data['nama_produk']; ?> </td>
        <td><?php echo $data['qty']; ?></td>
        <td>Rp. <?php echo number_format($data['harga'],0,',','.'); ?> </td>
        <td>Rp. <?php echo number_format($data['harga']*$data['qty'],0,',','.'); ?> </td>

    </tr>
    <!-- bagian akhir (penutup) while -->
    <?php endwhile; ?>
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

