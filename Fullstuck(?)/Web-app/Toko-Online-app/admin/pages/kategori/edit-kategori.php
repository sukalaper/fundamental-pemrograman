
<?php



//Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['edit_kategori'])) {

    //Include file koneksi, untuk koneksikan ke database
    include '../../../config/database.php';
 
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $kategori=input($_POST["kategori"]);
    $id_kategori=input($_POST["id_kategori"]);
    

    $sql="update kategori set
    nama_kategori='$kategori'
    where id_kategori=$id_kategori";

    $edit_jenis_kategori=mysqli_query($kon,$sql);

    if ($edit_jenis_kategori) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=kategori&edit=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=kategori&edit=gagal");
    }
    
}

?>
<?php 
    include '../../../config/database.php';
    $id_kategori=$_POST["id_kategori"];
    $hasil=mysqli_query($kon,"select * from kategori where id_kategori='$id_kategori' limit 1");
    $data = mysqli_fetch_array($hasil); 
?>

<form action="pages/kategori/edit-kategori.php" method="post">
    <div class="form-group">
        <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori'];?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="usr">Kategori:</label>
        <input type="text" name="kategori" value="<?php echo $data['nama_kategori'];?>" class="form-control" placeholder="Masukan Kategori">
    </div>

    <div class="form-group">
        <button type="submit" name="edit_kategori" class="btn btn-warning" >Update</button>
    </div>
</form>