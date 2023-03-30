
<?php
    if (!isset($_SESSION["id_pelanggan"])){
        echo"<script> window.location.href = 'index.php?page=login&aut=login'; </script>";
        exit;
    }else {
        $nama_pelanggan=$_SESSION["nama_pelanggan"];
    }
?>

<br>

<p>Halo <?php echo $nama_pelanggan; ?> Terima kasih atas pesanan Anda. Status masih tertahan sampai kami mengonfirmasi bahwa pembayaran telah diterima. Sementara itu, berikut adalah pengingat untuk pesanan Anda:</p>

<h3>Detail Pesanan</h3>
<div class="table-responsive">
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Sub Total</th>
    </tr>
    </thead>
    <tbody>
        <?php
            //Koneksi database
            include 'config/database.php';
            $no=0;
            $total=0;
            $sub_total=0;
            $tarif=0;
            $potongan=0;
            $nomor_pesanan=addslashes(trim($_GET['nomor_pesanan']));
            $sql="select * from pesanan p inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan inner join produk k on k.kode_produk=d.kode_produk where p.nomor_pesanan='$nomor_pesanan'";
            $hasil=mysqli_query($kon,$sql);
  
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            $no++;

            $sub_total=$data["harga"]*$data["qty"];
            $total+=$sub_total;
            $tarif=$data['tarif'];
            $potongan=$data['potongan'];
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data["nama_produk"]; ?></td>
            <td>Rp. <?php echo number_format($data["harga"],0,',','.');?> </td>
            <td><?php echo $data["qty"]; ?></td>
            <td>Rp. <?php echo number_format($sub_total,0,',','.');?> </td>
        </tr>
    <?php 
        endwhile;
 
    ?>
    <tr><td colspan="4">Potongan</td><td>Rp. <?php echo number_format($potongan,0,',','.');?> </td>
    </tr>
    <tr><td colspan="4">Ongkos Kirim</td><td>Rp. <?php echo number_format($tarif,0,',','.');?> </td>
    </tr>
    <tr><th colspan="4">Total Bayar</th><th>Rp. <?php echo number_format((($total+$tarif)-$potongan),0,',','.'); ?> </th>
    </tr>
    </tbody>
</table>
</div>

<h3>Metode Pembayaran</h3>
<p>Lakukan pembayaran langsung lewat beberapa pilihan metode pembayaran dibawah ini. Silahkan transfer sesuai dengan nominal sampai ke akhir digit supaya pesanan Anda segera kami proses.</p>
<div class="row">
    <div class="col-sm-7">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>No</th>
                <th>Logo</th>
                <th>Bank</th>
                <th>Nama Rekening</th>
                <th>Nomor Rekening</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    //Koneksi database
                    include 'config/database.php';
                    //perintah sql untuk menampilkan daftar pembayaran
                    $sql="select * from pembayaran order by id_pembayaran desc";
                    $hasil=mysqli_query($kon,$sql);
                    $no=0;
                    //Menampilkan data dengan perulangan while
                    while ($data = mysqli_fetch_array($hasil)):
                    $no++;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><img src="admin/pages/pembayaran/logo/<?php echo $data['logo']; ?>" width="65px"/> </td>
                    <td><?php echo $data['nama_bank']; ?></td>
                    <td><?php echo $data['nama_rekening']; ?></td>
                    <td><?php echo $data['nomor_rekening']; ?></td>
                </tr>
            <?php 
                endwhile;
            ?>
            </tbody>
        </table>
    </div>
</div>


<div class="clearfix"> </div>
