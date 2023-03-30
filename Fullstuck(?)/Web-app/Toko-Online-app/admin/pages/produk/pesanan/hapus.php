<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include '../../../config/database.php';
        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");

        $nomor_pesanan=addslashes(trim($_POST['nomor_pesanan']));
        $status_pembayaran=addslashes(trim($_POST['status_pembayaran']));

        if ($status_pembayaran==1){
            $sql="select * from pesanan_detail where nomor_pesanan='".$nomor_pesanan."'";
            $hasil=mysqli_query($kon,$sql);
 
            while ($data = mysqli_fetch_array($hasil)){
    
                $kode_produk=$data['kode_produk'];
                $qty=$data['qty'];

                $get=mysqli_query($kon,"select * from produk where kode_produk='".$kode_produk."'");
                $ambil = mysqli_fetch_array($get);
                $stok=$ambil['stok']+$qty;

                $sql1="update produk set
                stok='$stok'
                where kode_produk='".$kode_produk."'";
    
                mysqli_query($kon,$sql1);
    
            }
        }

        //Menghapus data pesanan
        $hapus_pesanan=mysqli_query($kon,"delete from pesanan where nomor_pesanan='$nomor_pesanan'");

        $hapus_detail_pesanan=mysqli_query($kon,"delete from pesanan_detail where nomor_pesanan='$nomor_pesanan'");

        $hapus_status=mysqli_query($kon,"delete from status where nomor_pesanan='$nomor_pesanan'");

        $hapus_konfirmasi=mysqli_query($kon,"delete from konfirmasi where nomor_pesanan='$nomor_pesanan'");


        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hapus_pesanan and $hapus_detail_pesanan and $hapus_status and $hapus_konfirmasi) {
            mysqli_query($kon,"COMMIT");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
        }
        
    }   
    
?>