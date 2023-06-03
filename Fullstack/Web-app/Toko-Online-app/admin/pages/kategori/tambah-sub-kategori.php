<?php

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST['submit'])) {

        include '../../../config/database.php';
        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");

        $sub_kategori=input($_POST["sub_kategori"]);
        $id_kategori=input($_POST["id_kategori"]);

        $sql="insert into sub_kategori (nama_sub_kategori,id_kategori) values
        ('$sub_kategori','$id_kategori')";

        $simpan=mysqli_query($kon,$sql);

        if ($simpan) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=kategori&id_kategori=$id_kategori&tambah=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=kategori&id_kategori=$id_kategori&tambah=gagal");
        }
        
    }
?>

<?php 
    include '../../../config/database.php';
    $id_kategori=$_POST["id_kategori"];
    $hasil=mysqli_query($kon,"select * from kategori where id_kategori='$id_kategori' limit 1");
    $data = mysqli_fetch_array($hasil); 
?>
<form action="pages/kategori/tambah-sub-kategori.php" method="post">

    <div class="form-group">
        <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori'];?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="usr">Kategori:</label>
        <input type="text" name="kategori" value="<?php echo $data['nama_kategori'];?>" class="form-control" placeholder="Masukan Kategori" disabled>
    </div>

    <div class="form-group">
        <label for="usr">Sub Kategori:</label>
        <input type="text" name="sub_kategori" class="form-control" placeholder="Masukan Sub Kategori">
    </div>

    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary" >Submit</button>
    </div>
</form>