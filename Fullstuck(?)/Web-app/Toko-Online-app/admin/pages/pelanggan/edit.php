<?php
session_start();
    if (isset($_POST['update_pelanggan'])) {
        //Include file koneksi, untuk koneksikan ke database
        include '../../../config/database.php';

        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Mengambil nilai kiriman form
        $id_pelanggan=input($_POST["id_pelanggan"]);
        $kode_pelanggan=input($_POST["kode_pelanggan"]);
        $nama_pelanggan=input($_POST["nama_pelanggan"]);
        $email=input($_POST["email"]);
        $telp=input($_POST["telp"]);
        $jk=input($_POST["jk"]);
        $alamat=input($_POST["alamat"]);
        $foto_saat_ini=$_POST['foto_saat_ini'];
        $foto_baru = $_FILES['foto_baru']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
        $x = explode('.', $foto_baru);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['foto_baru']['size'];
        $file_tmp = $_FILES['foto_baru']['tmp_name'];


        //Cek apakah user mengunggah foto baru
        if (!empty($foto_baru)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                //Mengupload foto baru
                move_uploaded_file($file_tmp, 'foto/'.$foto_baru);

                //Menghapus foto lama, foto yang dihapus selain foto default
                if ($foto_saat_ini!='foto_default.png'){
                    unlink("foto/".$foto_saat_ini);
                }
                
                $sql="update pelanggan set
                nama_pelanggan='$nama_pelanggan',
                email='$email',
                telp='$telp',
                alamat='$alamat',
                jk='$jk',
                foto='$foto_baru'
                where id_pelanggan='$id_pelanggan'";
            }
        }else {
            $sql="update pelanggan set
            nama_pelanggan='$nama_pelanggan',
            email='$email',
            telp='$telp',
            alamat='$alamat',
            jk='$jk'
            where id_pelanggan='$id_pelanggan'";
        }

        //Mengeksekusi atau menjalankan query 
        $edit_pelanggan=mysqli_query($kon,$sql);
        
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($edit_pelanggan) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=pelanggan&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=pelanggan&edit=gagal");

        }
        
    }
?>

<?php
    //Mengambil data pelanggan
    $id_pelanggan=$_POST["id_pelanggan"];
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM pelanggan where id_pelanggan=$id_pelanggan");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/pelanggan/edit.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama_pelanggan" value="<?php echo $data['nama_pelanggan'];?>" class="form-control" placeholder="Masukan nama" required>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
            <label>Kode:</label>
                <input type="text" name="kode_pelanggan" class="form-control" value="<?php echo $data['kode_pelanggan'];?>" disabled required>
                <input type="hidden" name="id_pelanggan" class="form-control" value="<?php echo $data['id_pelanggan'];?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $data['email'];?>" class="form-control" placeholder="Masukan email" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Telp:</label>
                <input type="number" name="telp" value="<?php echo $data['telp'];?>" class="form-control" placeholder="Masukan nomor telp" required>
            </div>
        </div>
        <div class="col-sm-5">
        <div class="form-group">
                <label>Jenis Kelamin:</label>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jk" <?php if (isset($data['jk']) && $data['jk']==1) echo "checked"; ?> value="1" required>Laki-laki
                    </label>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jk" <?php if (isset($data['jk']) && $data['jk']==2) echo "checked"; ?> value="2" required>Perempuan
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label>Alamat:</label>
                <textarea class="form-control" name="alamat" rows="4" id="alamat"><?php echo $data['alamat'];?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <div id="msg"></div>
                <label>Foto Saat ini:</label><br>
                <img src="pages/pelanggan/foto/<?php echo $data['foto'];?>" id="preview" width="70%" class="rounded" alt="Cinque Terre">
                <input type="hidden" name="foto_saat_ini" value="<?php echo $data['foto'];?>" class="form-control" />
            </div>
        </div>
        <div class="col-sm-5">
            <input type="file" name="foto_baru" class="file" >
            <div class="input-group my-3">
                <label>Upload Foto Baru:</label>
                <input type="text" class="form-control" disabled placeholder="Upload foto" id="file">
                <div class="input-group-append">
                        <button type="button" id="pilih_foto" class="browse btn btn-dark">Pilih</button>
                </div>
            </div>
      
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="update_pelanggan" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>

<script>

    $(document).on("click", "#pilih_foto", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });

    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });

</script>
