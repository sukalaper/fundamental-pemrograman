<?php
    session_start();
    include '../config/database.php';
    $id_pelanggan=$_SESSION['id_pelanggan'];
    $query = mysqli_query($kon, "SELECT * FROM pelanggan where id_pelanggan='$id_pelanggan'");
    $data = mysqli_fetch_array($query);
?>
<input type="hidden" id="sesi_nama" value="<?php echo $data["nama_pelanggan"];?>">
<input type="hidden" id="sesi_telp" value="<?php echo $data["telp"];?>">
<input type="hidden" id="sesi_alamat" value="<?php echo $data["alamat"];?>">
