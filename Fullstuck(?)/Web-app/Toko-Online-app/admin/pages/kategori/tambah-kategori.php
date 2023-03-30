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

        $kategori=input($_POST["kategori"]);


        $sql="insert into kategori (nama_kategori) values
        ('$kategori')";

        $simpan=mysqli_query($kon,$sql);

        if ($simpan) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=kategori&tambah=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=kategori&tambah=gagal");
        }
        
    }
?>
<form action="pages/kategori/tambah-kategori.php" method="post">
    <div class="form-group">
        <label for="usr">Kategori:</label>
        <input type="text" name="kategori" class="form-control" placeholder="Masukan Kategori">
    </div>

    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary" >Submit</button>
    </div>
</form>