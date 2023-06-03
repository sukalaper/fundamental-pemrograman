<?php
session_start();
    if (isset($_POST['update_pembayaran'])) {
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
        $id_pembayaran=input($_POST["id_pembayaran"]);
        $nama_bank=input($_POST["nama_bank"]);
        $nomor_rekening=input($_POST["nomor_rekening"]);
        $nama_rekening=input($_POST["nama_rekening"]);
        $logo_saat_ini=$_POST['logo_saat_ini'];
        $logo_baru = $_FILES['logo_baru']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
        $x = explode('.', $logo_baru);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['logo_baru']['size'];
        $file_tmp = $_FILES['logo_baru']['tmp_name'];


        //Cek apakah user mengunggah logo baru
        if (!empty($logo_baru)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                //Mengupload logo baru
                move_uploaded_file($file_tmp, 'logo/'.$logo_baru);

                //Menghapus logo lama, logo yang dihapus selain logo default
                if ($logo_saat_ini!='logo_default.png'){
                    unlink("logo/".$logo_saat_ini);
                }
                
                $sql="update pembayaran set
                nama_bank='$nama_bank',
                nomor_rekening='$nomor_rekening',
                nama_rekening='$nama_rekening',
                logo='$logo_baru'
                where id_pembayaran='$id_pembayaran'";
            }
        }else {
            $sql="update pembayaran set
            nama_bank='$nama_bank',
            nomor_rekening='$nomor_rekening',
            nama_rekening='$nama_rekening'
            where id_pembayaran='$id_pembayaran'";
        }

        //Mengeksekusi atau menjalankan query 
        $edit_pembayaran=mysqli_query($kon,$sql);
        
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($edit_pembayaran) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=pembayaran&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=pembayaran&edit=gagal");

        }
        
    }
?>

<?php
    //Mengambil data pembayaran
    $id_pembayaran=$_POST["id_pembayaran"];
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM pembayaran where id_pembayaran=$id_pembayaran");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/pembayaran/edit.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="hidden" name="id_pembayaran" value="<?php echo $data['id_pembayaran']; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nama Bank:</label>
                <input type="text" name="nama_bank" value="<?php echo $data['nama_bank']; ?>" class="form-control" placeholder="Masukan Nama Bank" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nomor Rekening:</label>
                <input type="number" name="nomor_rekening" value="<?php echo $data['nomor_rekening']; ?>" class="form-control" placeholder="Masukan Nomor Rekening" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nama Rekening:</label>
                <input type="text" name="nama_rekening" value="<?php echo $data['nama_rekening']; ?>" class="form-control" placeholder="Masukan Nama Rekening" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="hidden" name="logo_saat_ini" value="<?php echo $data['logo']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <div id="msg"></div>
                <label>Logo:</label>
                <input type="file" name="logo_baru" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload logo" id="file">
                        <div class="input-group-append">
                                <button type="button" id="pilih_logo" class="browse btn btn-dark">Pilih Logo</button>
                        </div>
                    </div>
                <img src="pages/pembayaran/logo/<?php echo $data['logo']; ?>" id="preview" class="img-thumbnail" width="30%">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="update_pembayaran" class="btn btn-warning">Update</button>
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
