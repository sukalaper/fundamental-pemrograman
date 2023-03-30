<?php
    session_start();
    if (isset($_SESSION["id_pelanggan"])){
        $id_pelanggan=$_SESSION["id_pelanggan"];
    }else {
        $id_pelanggan=0;
    }
    

    $kode_voucher=$_POST["kode_voucher"];
    $total=$_POST["total"];
    $tanggal_sekarang=date('Y-m-d');

    include '../config/database.php';

    $sql="select * from voucher where kode_voucher='".$kode_voucher."'limit 1";
    $hasil = mysqli_query($kon,$sql);
    $cek = mysqli_num_rows($hasil);


    if ($cek>=1){

        $row = mysqli_fetch_array($hasil);

        if (isset($row['berlaku'])){
            $berlaku=date("Y-m-d",strtotime($row['berlaku']));
        }else {
            $berlaku="";
        }
    
    
        if ($tanggal_sekarang>$berlaku){
            echo "<div class='alert alert-danger'>Voucher tidak berlaku</div>";
            echo "<h3>Total Rp.".number_format($total,0,',','.')." </h3>";
        }else {
            $potongan=0;
            include '../config/database.php';
            $query = mysqli_query($kon, "SELECT * FROM penerima_voucher p inner join voucher v on p.kode_voucher=v.kode_voucher where p.kode_voucher='$kode_voucher' and id_pelanggan='$id_pelanggan'");
            $data = mysqli_fetch_array($query);
            $jum = mysqli_num_rows($query);
    
            if ($jum<1){
                echo "<div class='alert alert-warning'>Voucher tidak tersedia</div>";
                echo "<h3>Total Rp.".number_format($total,0,',','.')." </h3>";
            }else {
            
                if ($data['tipe']==1){
                    $potongan=(($total*$data['nominal']/100));
                    
                }else if ($data['tipe']==2){
                    $potongan=$data['nominal'];
                }
                $total_bayar=$total-$potongan;
                echo "<div class='alert alert-info'>Voucher berhasil diterapkan</div>";
                echo "<h3>Total Rp.".number_format($total_bayar,0,',','.')." <small>#Potongan Rp.".number_format($potongan,0,',','.')."</small> </h3>";
                $_SESSION["potongan"]=$potongan;
                $_SESSION["kode_voucher"]=$kode_voucher;
                
            } 
        }
    }else {  
        echo "<div class='alert alert-warning'>Voucher tidak tersedia</div>";
        echo "<h3>Total Rp.".number_format($total,0,',','.')." </h3>";
    }



?>