<?php
session_start();
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered" id="tabel_laporan">
    <tr>
        <th>No</th>
        <th>No Pesanan</th>
        <th>Tanggal</th>
        <th>Kategori</th>
        <th>Nama Produk</th>
        <th>QTY</th>
        <th>Harga</th>
        <th>Sub Total</th>
    </tr>
    <?php
        // include database
        include '../../../../config/database.php';

        $kondisi="";
        if (!empty($_POST["dari_tanggal"]) && empty($_POST["sampai_tanggal"])) $kondisi= "where date(p.tanggal)='".$_POST['dari_tanggal']."' ";
        if (!empty($_POST["dari_tanggal"]) && !empty($_POST["sampai_tanggal"])) $kondisi= "where date(p.tanggal) between '".$_POST['dari_tanggal']."' and '".$_POST['sampai_tanggal']."'";
       
        if ($_POST['status']!='' && $_POST['status_pembayaran']!='') {

            $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
            from pesanan p
            inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
            inner join produk k on k.kode_produk=d.kode_produk
            inner join kategori t on t.id_kategori=k.kategori
            $kondisi and p.status='".$_POST['status']."' and p.status_pembayaran='".$_POST['status_pembayaran']."'
            order by p.tanggal desc";

        } else if ($_POST['status']!=''){

            $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
            from pesanan p
            inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
            inner join produk k on k.kode_produk=d.kode_produk
            inner join kategori t on t.id_kategori=k.kategori
            $kondisi and p.status='".$_POST['status']."'
            order by p.tanggal desc";

        } else if ($_POST['status_pembayaran']!=''){

            $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
            from pesanan p
            inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
            inner join produk k on k.kode_produk=d.kode_produk
            inner join kategori t on t.id_kategori=k.kategori
            $kondisi and p.status_pembayaran='".$_POST['status_pembayaran']."'
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
        $status="";
        //Menampilkan data dengan perulangan while
        while ($data = mysqli_fetch_array($hasil)):
        $no++;

    ?>
    <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data['nomor_pesanan']; ?> </td>
    <td><?php echo tanggal(date('Y-m-d', strtotime($data['tanggal']))); ?></td>
    <td><?php echo $data['nama_kategori']; ?> </td>
    <td><?php echo $data['nama_produk']; ?> </td>
    <td><?php echo $data['qty']; ?></td>
    <td>Rp. <?php echo number_format($data['harga'],0,',','.'); ?> </td>
    <td>Rp. <?php echo number_format($data['harga']*$data['qty'],0,',','.'); ?> </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>
<a href="pages/laporan/produk/cetak-pdf.php?status=<?php echo $_POST['status'];?>&status_pembayaran=<?php echo $_POST['status_pembayaran'];?>&dari_tanggal=<?php if (!empty($_POST["dari_tanggal"])) echo $_POST["dari_tanggal"]; ?>&sampai_tanggal=<?php if (!empty($_POST["sampai_tanggal"])) echo $_POST["sampai_tanggal"]; ?>" target='blank' class="btn btn-danger btn-icon-pdf"><span class="text"><i class="fas fa-file-pdf fa-sm"></i> Export PDF</span></a>
<a href="pages/laporan/produk/cetak-excel.php?status=<?php echo $_POST['status'];?>&status_pembayaran=<?php echo $_POST['status_pembayaran'];?>&dari_tanggal=<?php if (!empty($_POST["dari_tanggal"])) echo $_POST["dari_tanggal"]; ?>&sampai_tanggal=<?php if (!empty($_POST["sampai_tanggal"])) echo $_POST["sampai_tanggal"]; ?>" target='blank' class="btn btn-success btn-icon-pdf"><span class="text"><i class="fas fa-file-excel fa-sm"></i> Export Excel</span></a>

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