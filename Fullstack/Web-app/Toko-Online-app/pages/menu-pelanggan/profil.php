<?php

    if (isset($_POST['nama_pelanggan'])) {
        
        //Include file koneksi, untuk koneksikan ke database
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

            $id_pelanggan=input($_POST["id_pelanggan"]);
            $nama_pelanggan=input($_POST["nama_pelanggan"]);
            $jk=input($_POST["jk"]);
            $email=input($_POST["email"]);
            $telp=input($_POST["telp"]);
            $alamat=input($_POST["alamat"]);

            $sql="update pelanggan set
            nama_pelanggan='$nama_pelanggan',
            jk='$jk',
            email='$email',
            telp='$telp',
            alamat='$alamat'
            where id_pelanggan='$id_pelanggan'";
            

            //Mengeksekusi query 
            $edit_customer=mysqli_query($kon,$sql);

            if ($edit_customer) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=profil&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=profil&edit=gagal");
            }
        }
    }
?>

<?php
    if (!isset($_SESSION["id_pelanggan"])){
        echo"<script> window.location.href = 'index.php?page=login&aut=login'; </script>";
        exit;
    }
?>


<?php 
    include 'config/database.php';
    $id_pelanggan=$_SESSION["id_pelanggan"];
    $sql="select * from pelanggan where id_pelanggan=$id_pelanggan limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
?>

<?php
    if (!isset($_SESSION["id_pelanggan"])){
        echo"<script> window.location.href = 'index.php?page=login&aut=login'; </script>";
        exit;
    }
?>

<div class="women-product">
    <div class=" w_content">
        <div class="women">
            <h3>Profil Saya</h3>
     
            <div class="clearfix"> </div>	
        </div>
    </div>
    <!-- grids_of_4 -->

    <div class="grid-product">
    <?php
        if (isset($_GET['edit'])) {
            if ($_GET['edit']=='berhasil'){
                echo"<div class='alert alert-success'>Profil berhasil diupdate</div>";
            }
            if ($_GET['edit']=='gagal'){
                echo"<div class='alert alert-danger'>Profil gagal diupdate</div>";
            } 
        }

        if ($data['telp']==null or $data['email']==null or $data['jk']==null or $data['alamat']==null){
            echo "<div class='alert alert-info'><strong>Perhatian!</strong> Profil kamu belum lengkap. Mohon untuk dilengkapi.</div>";
        }
    ?>
    <div class="table-responsive">
    <table class="table">
                <tbody>
                <tr>
                    <td>Kode</td>
                    <td width="70%"><?php echo $data['kode_pelanggan']; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><?php echo $data['nama_pelanggan']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>
                        <?php if ($data['jk']==1){
                            echo "Laki-laki";
                        }else if ($data['jk']==2){
                            echo "Perempuan";
                        }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Telp</td>
                    <td><?php echo $data['telp']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $data['email']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?php echo $data['alamat']; ?></td>
                </tr>
                </tbody>
            </table>
            </div>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Edit</button>

	<div class="clearfix"> </div>
    </div> 
</div>




<?php include 'menu-pelanggan.php';?>
<div class="clearfix"> </div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Profil</h4>
      </div>
      <div class="modal-body">
        <form action="pages/menu-pelanggan/profil.php" method="post">

            <div class="form-group">
                <input type="hidden" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>" class="form-control" id="usr">
            </div> 

            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama_pelanggan" value="<?php echo $data['nama_pelanggan']; ?>" class="form-control" id="usr">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <label class="radio-inline">
                    <input type="radio" value="1" name="jk" <?php if ($data['jk']==1) echo "checked"; ?> >Laki-laki
                </label>
                <label class="radio-inline">
                    <input type="radio" value="2" name="jk" <?php if ($data['jk']==2) echo "checked"; ?> >Perempuan
                </label>
            </div>
            <div class="form-group">
                <label>Telp:</label>
                <input type="text" name="telp" value="<?php echo $data['telp']; ?>" class="form-control" id="usr">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" value="<?php echo $data['email']; ?>" class="form-control" id="usr">
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea class="form-control" name="alamat" rows="5"><?php echo $data['alamat']; ?></textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


