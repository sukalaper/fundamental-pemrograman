<?php
    if (isset($_POST['submit'])) {
        
        //Include file koneksi, untuk koneksikan ke database
        include '../../../config/database.php';
        
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

            $tanggal=date("Y-m-d H:i:s");
            $nomor_pesanan=input($_POST["nomor_pesanan"]);
            $status=input($_POST["status"]);
            $keterangan=input($_POST["keterangan"]);

            $sql="insert into status (tanggal,nomor_pesanan,status,keterangan) values
            ('$tanggal','$nomor_pesanan','$status','$keterangan')";

            //Mengeksekusi query 
            $simpan=mysqli_query($kon,$sql);

            $sql="update pesanan set status='$status' where nomor_pesanan='$nomor_pesanan'";
            $update=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($simpan and $update) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=detail-pesanan&tambah=berhasil&nomor_pesanan=$nomor_pesanan");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=detail-pesanan&tambah=gagal&nomor_pesanan=$nomor_pesanan");
            }
        }
    }
?>

<?php
    $nomor_pesanan=$_POST["nomor_pesanan"];
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT pesanan.status from pesanan where nomor_pesanan='$nomor_pesanan'");
    $data = mysqli_fetch_array($query);
?>

<form action="pages/pesanan/update-status.php" method="post">
    <div class="form-group">
    <input type="hidden" name="nomor_pesanan" value="<?php echo $_POST['nomor_pesanan'];?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Status:</label>
        <select class="form-control" name="status" id="status">
            <option value="0" <?php if ($data['status']==0) echo 'selected';?> >Ditahan</option>
            <option value="1" <?php if ($data['status']==1) echo 'selected';?> >Pembayaran tertunda</option>
            <option value="2" <?php if ($data['status']==2) echo 'selected';?> >Sedang diproses</option>
            <option value="3" <?php if ($data['status']==3) echo 'selected';?> >Dikirim</option>
            <option value="4" <?php if ($data['status']==4) echo 'selected';?> >Selesai</option>
            <option value="5" <?php if ($data['status']==5) echo 'selected';?> >Dibatalkan</option>
        </select>
    </div>

    <div class="form-group">
        <label>Keterangan:</label>
        <textarea class="form-control" rows="5" name="keterangan" id="keterangan"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" name="submit" id="Submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script>
    var status = $("#status").val();

    if (status=='0'){
            $("#keterangan").val('Pesanan anda sedang ditahan & menunggu pembayaran');
        } else if  (status=='1'){
            $("#keterangan").val('Status pembayaran masih tertunda');
        } else if  (status=='2'){
            $("#keterangan").val('Pesanan anda sedang kami proses');
        } else if  (status=='3'){
            $("#keterangan").val('Pesanan anda telah kami kirim');
        } else if  (status=='4'){
            $("#keterangan").val('Pesanan anda telah selesai');
        } else if  (status=='5'){
            $("#keterangan").val('Pesanan anda telah kami batalkan dengan alasan ...');
        }else {
            $("#keterangan").val('');
        }

    $("#status").change(function() {
        // Mengambil id kategori dari select boz kategori
        var status = $("#status").val();
        if (status=='0'){
            $("#keterangan").val('Pesanan anda sedang ditahan & menunggu pembayaran');
        } else if  (status=='1'){
            $("#keterangan").val('Status pembayaran masih tertunda');
        } else if  (status=='2'){
            $("#keterangan").val('Pesanan anda sedang kami proses');
        } else if  (status=='3'){
            $("#keterangan").val('Pesanan anda telah kami kirim');
        } else if  (status=='4'){
            $("#keterangan").val('Pesanan anda telah selesai');
        } else if  (status=='5'){
            $("#keterangan").val('Pesanan anda telah kami batalkan dengan alasan ...');
        } else {
            $("#keterangan").val('');
        }
    });
</script>

<script>

   $('#Submit').on('click',function(){
        konfirmasi=confirm("Yakin ingin mengupdate status pesanan ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>
