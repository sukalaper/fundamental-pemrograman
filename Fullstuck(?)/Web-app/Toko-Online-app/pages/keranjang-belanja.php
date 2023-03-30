<br>
<?php

if (isset($_GET['kode_produk']) && isset($_GET['jumlah'])) {

    $kode_produk=addslashes(trim($_GET['kode_produk']));
    $jumlah=addslashes(trim($_GET['jumlah']));

    include 'config/database.php';

    $sql= "select * from produk p 
    left join kategori k on k.id_kategori=p.kategori 
    left join sub_kategori s on s.id_sub_kategori=p.sub_kategori 
    where p.kode_produk='$kode_produk'";

    $query = mysqli_query($kon,$sql);
    $cek = mysqli_num_rows($query);

    if ($cek<=0){
        echo "<div class='alert alert-danger'>Data tidak valid!</div>";
        exit;
    }

    $data = mysqli_fetch_array($query);
    $kode_produk=$data['kode_produk'];
    $nama_kategori=$data['nama_kategori'];
    $nama_sub_kategori=$data['nama_sub_kategori'];
    $nama_produk=$data['nama_produk'];
    $kategori=$data['kategori'];
    $sub_kategori=$data['sub_kategori'];
    $harga=$data['harga'];
    $berat=$data['berat'];
    $stok=$data['stok'];

    //Set kembali nilai potongan dan kode voucher dalam session
    if(!empty($_SESSION["potongan"])){     
        unset($_SESSION["potongan"]);
        unset($_SESSION["kode_voucher"]);
    }

}else {
    $kode_produk="";
    $jumlah=0;
}

if (isset($_GET['aksi'])) {
    $aksi=addslashes(trim($_GET['aksi']));
}else {
    $aksi="";
}

if (isset($_GET['kode_produk']) and isset($_GET['jumlah'])){
    if ($jumlah>$stok){
        echo "<div class='alert alert-danger'>Jumlah beli tidak boleh melebihi stok produk!</div>";
        exit;
    }
}



switch($aksi){	
    //Fungsi untuk menambah penyewaan kedalam cart
    case "tambah_produk":
    $itemArray = array($kode_produk=>array('kode_produk'=>$kode_produk,'nama_produk'=>$nama_produk,'nama_kategori'=>$nama_kategori,'nama_sub_kategori'=>$nama_sub_kategori,'jumlah'=>$jumlah,'harga'=>$harga,'berat'=>$berat,'stok'=>$stok));
    if(!empty($_SESSION["keranjang_belanja"])) {
        if(in_array($data['kode_produk'],array_keys($_SESSION["keranjang_belanja"]))) {
            foreach($_SESSION["keranjang_belanja"] as $k => $v) {
                if($data['kode_produk'] == $k) {
                    $_SESSION["keranjang_belanja"] = array_merge($_SESSION["keranjang_belanja"],$itemArray);
                }
            }
        } else {
            $_SESSION["keranjang_belanja"] = array_merge($_SESSION["keranjang_belanja"],$itemArray);
        }
    } else {
        $_SESSION["keranjang_belanja"] = $itemArray;
    }
    break;
    //Fungsi untuk menghapus item dalam cart
    case "hapus":

        if(!empty($_SESSION["keranjang_belanja"])) {
            foreach($_SESSION["keranjang_belanja"] as $k => $v) {
                    if($_GET["kode_produk"] == $k)
                        unset($_SESSION["keranjang_belanja"][$k]);
                    if(empty($_SESSION["keranjang_belanja"]))
                        unset($_SESSION["keranjang_belanja"]);
            }
        }
    break;

    case "update":
        $itemArray = array($kode_produk=>array('kode_produk'=>$kode_produk,'nama_produk'=>$nama_produk,'nama_kategori'=>$nama_kategori,'nama_sub_kategori'=>$nama_sub_kategori,'jumlah'=>$jumlah,'harga'=>$harga,'berat'=>$berat,'stok'=>$stok));
        if(!empty($_SESSION["keranjang_belanja"])) {
            foreach($_SESSION["keranjang_belanja"] as $k => $v) {
                if($_GET["kode_produk"] == $k)
                $_SESSION["keranjang_belanja"] = array_merge($_SESSION["keranjang_belanja"],$itemArray);
            }
        }
    break;
}
?>

<?php 
    if(empty($_SESSION["keranjang_belanja"])){
    echo "<div class='alert alert-warning'>Keranjang belanja kosong!</div>";
    }
?>
<div class="table-responsive">
<table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Kategori</th>
            <th>Produk</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Jumlah Beli</th>
            <th>Sub Total</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $no=0;
            $sub_total=0;
            $total=0;
            $total_berat=0;
            if(!empty($_SESSION["keranjang_belanja"])):
            foreach ($_SESSION["keranjang_belanja"] as $item):
                $no++;
                $sub_total = $item["jumlah"]*$item['harga'];
                $total+=$sub_total;
                $total_berat+=$item['berat']*$item["jumlah"];
        ?>
            <input type="hidden" name="kode_produk[]" class="kode_produk" value="<?php echo $item["kode_produk"]; ?>"/>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $item["kode_produk"]; ?></td>
                <td><?php echo $item["nama_kategori"]; ?> (<?php echo $item["nama_sub_kategori"]; ?>)</td>
                <td><?php echo $item["nama_produk"]; ?></td>
                <td><?php echo $item["stok"]; ?></td>
                <td>Rp. <?php echo number_format($item["harga"],0,',','.');?> </td>
                <td>
                <input type="number" min="1" value="<?php echo $item["jumlah"]; ?>" class="form-control" id="jumlah<?php echo $no; ?>" name="jumlah[]" max="<?php echo $item["stok"]; ?>">
                <script>
                    $("#jumlah<?php echo $no; ?>").bind('change', function () {
                        var jumlah<?php echo $no; ?>=$("#jumlah<?php echo $no; ?>").val();
                        $("#jumlaha<?php echo $no; ?>").val(jumlah<?php echo $no; ?>);
                    });
                    $("#jumlah<?php echo $no; ?>").keydown(function(event) { 
                        return false;
                    });
                    
                </script>

                </td>
                <td>Rp. <?php echo number_format($sub_total,0,',','.');?> </td>

                <td>
                    <form method="get">
                        <input type="hidden" name="kode_produk"  value="<?php echo $item['kode_produk']; ?>" class="form-control">
                        <input type="hidden" name="aksi"  value="update" class="form-control">
                        <input type="hidden" name="page"  value="keranjang-belanja" class="form-control">
                        <input type="hidden" name="jumlah" value="<?php echo $item["jumlah"]; ?>" id="jumlaha<?php echo $no; ?>" value="" class="form-control">
                        <input type="submit" class="btn btn-warning btn-xs" value="Update">
                    </form>
                    <br>
                    <a href="index.php?page=keranjang-belanja&kode_produk=<?php echo $item['kode_produk']; ?>&aksi=hapus" class="btn btn-danger btn-xs" role="button">Delete</a>
                </td>
            </tr>
        <?php 
            endforeach;
            endif;
        ?>
        </tbody>
    </table>
</div>

<div id="tampil_data"> 
<h3>Total Rp. <?php echo number_format($total,0,',','.');?></h3>
</div>

<?php $_SESSION["total_berat"]=$total_berat; ?>

<form method="post" id="form_voucher">
    <div class="form-group">
        <input type="hidden" name="total"  value="<?php echo $total; ?>" class="form-control">
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <input type="text" name="kode_voucher" id="kode_voucher" class="form-control" placeholder="Masukan kode voucher">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <button type="button" id="terapkan" class="btn btn-info">Terapkan</button>
            </div>
        </div>
    </div>
</form>



<!--Menyimpan total berat produk ke dalam variabel session -->


<a  class="btn btn-success pull-right" id="checkout" href="index.php?page=checkout">CHECKOUT</a>


<div class="clearfix"> </div>

<?php 
 if(empty($_SESSION["keranjang_belanja"])){
     echo "<script> $('#terapkan').prop('disabled', true); </script>";
     echo "<script> $('#checkout').prop('disabled', true); </script>";
     echo "<script> $('#kode_voucher').prop('disabled', true); </script>";
 }

?>

<script>
    $('#terapkan').on('click',function(){
        loading();
        var data = $('#form_voucher').serialize();
        $.ajax({
            url: 'pages/voucher.php',
            method: 'post',
            data: data,
            cache	: false,
            success:function(data){
                $('#tampil_data').html(data); 
            }
        });
    });
</script>
   

