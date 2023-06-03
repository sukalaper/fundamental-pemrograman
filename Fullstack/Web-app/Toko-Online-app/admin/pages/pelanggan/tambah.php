<?php
session_start();
    if (isset($_POST['tambah_pelanggan'])) {
        
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

            $kode_pelanggan=input($_POST["kode_pelanggan"]);
            $nama_pelanggan=input($_POST["nama_pelanggan"]);
            $email=input($_POST["email"]);
            $telp=input($_POST["telp"]);
            $jk=input($_POST["jk"]);
            $alamat=input($_POST["alamat"]);
            $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
            $foto = $_FILES['foto']['name'];
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $ukuran	= $_FILES['foto']['size'];
            $file_tmp = $_FILES['foto']['tmp_name'];	

            if (!empty($foto)){
                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                    //Mengupload gambar
                    move_uploaded_file($file_tmp, 'foto/'.$foto);
                    //Sql jika menggunakan foto
                    $sql="insert into pelanggan (kode_pelanggan,nama_pelanggan,email,telp,jk,alamat,foto) values
                        ('$kode_pelanggan','$nama_pelanggan','$email','$telp','$jk','$alamat','$foto')";
                }
            }else {
                //Sql jika tidak menggunakan foto, maka akan memakai foto foto_default.png
                $sql="insert into pelanggan (kode_pelanggan,nama_pelanggan,email,telp,jk,alamat) values
                ('$kode_pelanggan','$nama_pelanggan','$email','$telp','$jk','$alamat')";
            }

            //Mengeksekusi query 
            $simpan_pelanggan=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($simpan_pelanggan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=pelanggan&add=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=pelanggan&add=gagal");
            }
        }
    }
?>

<?php
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT max(id_pelanggan) as max_id FROM pelanggan");
    $get = mysqli_fetch_array($query);
    $id_pelanggan = $get['max_id'];
    $id_pelanggan++;
    $tahun=date('y');
    $kode_depan = $tahun.'01';
    $kode_pelanggan = $kode_depan . sprintf("%03s", $id_pelanggan);

?>
<form action="pages/pelanggan/tambah.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukan nama" required>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
            <label>Kode:</label>
                <input type="text"  class="form-control"  value="<?php echo $kode_pelanggan; ?>" disabled required>
                <input type="hidden" name="kode_pelanggan" class="form-control"  value="<?php echo $kode_pelanggan; ?>"  >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Masukan email" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Telp:</label>
                <input type="number" name="telp" class="form-control" placeholder="Masukan nomor telp" required>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jk" value="1" required>Laki-laki
                    </label>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jk" value="2" required>Perempuan
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label>Alamat:</label>
                <textarea class="form-control" name="alamat" rows="4" id="alamat"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                <div id="msg"></div>
                <label>Foto:</label>
                <input type="file" name="foto" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload foto" id="file">
                        <div class="input-group-append">
                                <button type="button" id="pilih_foto" class="browse btn btn-dark">Pilih Foto</button>
                        </div>
                    </div>
                <img src="dist/img/img80.png" id="preview" class="img-thumbnail">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" id="Submit" name="tambah_pelanggan" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
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

