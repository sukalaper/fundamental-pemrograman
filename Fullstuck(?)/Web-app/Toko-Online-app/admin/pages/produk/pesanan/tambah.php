<?php
session_start();
    if (isset($_POST['tambah_pembayaran'])) {
        
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

            $nama_bank=input($_POST["nama_bank"]);
            $nomor_rekening=input($_POST["nomor_rekening"]);
            $nama_rekening=input($_POST["nama_rekening"]);
            $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
            $logo = $_FILES['logo']['name'];
            $x = explode('.', $logo);
            $ekstensi = strtolower(end($x));
            $ukuran	= $_FILES['logo']['size'];
            $file_tmp = $_FILES['logo']['tmp_name'];	

            if (!empty($logo)){
                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                    //Mengupload gambar
                    move_uploaded_file($file_tmp, 'logo/'.$logo);
                    //Sql jika menggunakan logo
                    $sql="insert into pembayaran (nama_bank,nomor_rekening,nama_rekening,logo) values
                        ('$nama_bank','$nomor_rekening','$nama_rekening','$logo')";
                }
            }else {
                //Sql jika tidak menggunakan logo, maka akan memakai logo logo_default.png
                $sql="insert into pembayaran (nama_bank,nomor_rekening,nama_rekening,logo) values
                ('$nama_bank','$nomor_rekening','$nama_rekening','logo_default.png')";
            }

            //Mengeksekusi query 
            $simpan=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=pembayaran&add=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=pembayaran&add=gagal");
            }
        }
    }
?>

<form action="pages/pembayaran/tambah.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nama Bank:</label>
                <input type="text" name="nama_bank" class="form-control" placeholder="Masukan Nama Bank" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nomor Rekening:</label>
                <input type="number" name="nomor_rekening" class="form-control" placeholder="Masukan Nomor Rekening" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nama Rekening:</label>
                <input type="text" name="nama_rekening" class="form-control" placeholder="Masukan Nama Rekening" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div id="msg"></div>
                <label>Logo:</label>
                <input type="file" name="logo" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload logo" id="file">
                        <div class="input-group-append">
                                <button type="button" id="pilih_logo" class="browse btn btn-dark">Pilih Logo</button>
                        </div>
                    </div>
                <img src="dist/img/img80.png" id="preview" class="img-thumbnail">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="tambah_pembayaran" id="Submit" class="btn btn-primary">Tambah</button>
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

    $(document).on("click", "#pilih_logo", function() {
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

