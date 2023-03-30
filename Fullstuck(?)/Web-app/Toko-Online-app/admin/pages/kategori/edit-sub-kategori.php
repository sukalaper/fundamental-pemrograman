
<?php



//Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['edit_sub_kategori'])) {

    //Include file koneksi, untuk koneksikan ke database
    include '../../../config/database.php';
 
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $sub_kategori=input($_POST["sub_kategori"]);
    $id_sub_kategori=input($_POST["id_sub_kategori"]);
    $id_kategori=input($_POST["id_kategori"]);

    $sql="update sub_kategori set
    nama_sub_kategori='$sub_kategori'
    where id_sub_kategori=$id_sub_kategori";

    $edit_sub_kategori=mysqli_query($kon,$sql);

    if ($edit_sub_kategori) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=kategori&id_kategori=$id_kategori&edit=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=kategori&id_kategori=$id_kategori&edit=gagal");
    }
    
}

?>
<?php 
    include '../../../config/database.php';
    $id_sub_kategori=$_POST["id_sub_kategori"];
    $hasil=mysqli_query($kon,"select * from sub_kategori where id_sub_kategori='$id_sub_kategori' limit 1");
    $data = mysqli_fetch_array($hasil); 
?>

<form action="pages/kategori/edit-sub-kategori.php" method="post">

    <div class="form-group">
        <input type="hidden" name="id_sub_kategori" value="<?php echo $data['id_sub_kategori'];?>" class="form-control">
        <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori'];?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="usr">Sub Kategori:</label>
        <input type="text" name="sub_kategori" value="<?php echo $data['nama_sub_kategori'];?>" class="form-control" placeholder="Masukan sub_kategori">
    </div>

    <div class="form-group">
        <button type="submit" name="edit_sub_kategori" class="btn btn-warning" >Update</button>
    </div>
</form>