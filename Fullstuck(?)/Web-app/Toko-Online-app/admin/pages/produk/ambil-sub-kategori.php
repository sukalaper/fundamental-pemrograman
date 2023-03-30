<?php

    include '../../../config/database.php';

    $id_kategori = $_POST["id_kategori"];
                    
    $sql="select * from sub_kategori where id_kategori='$id_kategori'";
    $hasil=mysqli_query($kon,$sql);
    while ($data = mysqli_fetch_array($hasil)):
?>
    <option value="<?php echo $data['id_sub_kategori']; ?>"><?php echo $data['nama_sub_kategori']; ?></option>
<?php endwhile; ?>