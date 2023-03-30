<?php

if (isset($_POST['submit'])) {
    //Koneksi database
    include '../../config/database.php';
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");

        $nomor_pesanan=input($_POST["nomor_pesanan"]);
        $tanggal_transfer=input($_POST["tanggal_transfer"]);
        $id_pembayaran=input($_POST["id_pembayaran"]);
        $bank_asal=input($_POST["bank_asal"]);
        $nama_rekening=input($_POST["nama_rekening"]);
        $jumlah_uang=input($_POST["jumlah_uang"]);
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
        $gambar = $_FILES['gambar']['name'];
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];

        //Validasi jika gambar produk tidak diinput oleh user
        if (!empty($gambar)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                //Mengupload gambar
                move_uploaded_file($file_tmp, 'gambar/'.$gambar);

                $sql="insert into konfirmasi (nomor_pesanan,tanggal_transfer,id_pembayaran,bank_asal,nama_rekening,jumlah_uang,gambar) values
                ('$nomor_pesanan','$tanggal_transfer','$id_pembayaran','$bank_asal','$nama_rekening','$jumlah_uang','$gambar')";
 
            }
        }else {
            $sql="insert into konfirmasi (nomor_pesanan,tanggal_transfer,id_pembayaran,bank_asal,nama_rekening,jumlah_uang) values
            ('$nomor_pesanan','$tanggal_transfer','$id_pembayaran','$bank_asal','$nama_rekening','$jumlah_uang')";

        }

        //Mengeksekusi query 
        $simpan=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($simpan) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=detail-pesanan&nomor_pesanan=$nomor_pesanan&konfirmasi=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=detail-pesanan&nomor_pesanan=$nomor_pesanan&konfirmasi=gagal");
        }

    }

}

?>