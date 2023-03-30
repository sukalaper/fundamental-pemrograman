<?php
session_start();
    if (isset($_POST['update_produk'])) {
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
        $id_produk=input($_POST["id_produk"]);
        $kode_produk=input($_POST["kode_produk"]);
        $nama_produk=ucwords(input($_POST["nama_produk"]));
        $kategori=input($_POST["kategori"]);
        $sub_kategori=input($_POST["sub_kategori"]);
        $berat=input($_POST["berat"]);
        $stok=input($_POST["stok"]);
        $harga=input($_POST["harga"]);
        $keterangan=input($_POST["keterangan"]);
        $tanggal=date("Y-m-d");
        $gambar_saat_ini=$_POST['gambar_saat_ini'];
        $gambar_baru = $_FILES['gambar_baru']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
        $x = explode('.', $gambar_baru);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['gambar_baru']['size'];
        $file_tmp = $_FILES['gambar_baru']['tmp_name'];


        //Cek apakah user mengunggah gambar baru
        if (!empty($gambar_baru)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                //Mengupload gambar baru
                move_uploaded_file($file_tmp, 'gambar/'.$gambar_baru);

                //Menghapus gambar lama, gambar yang dihapus selain gambar default
                if ($gambar_saat_ini!='gambar_default.png'){
                    unlink("gambar/".$gambar_saat_ini);
                }
                
                $sql="update produk set
                nama_produk='$nama_produk',
                kategori='$kategori',
                sub_kategori='$sub_kategori',
                berat='$berat',
                stok='$stok',
                harga='$harga',
                keterangan='$keterangan',
                tanggal='$tanggal',
                gambar='$gambar_baru'
                where id_produk='$id_produk'";
            }
        }else {
            $sql="update produk set
            nama_produk='$nama_produk',
            kategori='$kategori',
            sub_kategori='$sub_kategori',
            berat='$berat',
            stok='$stok',
            harga='$harga',
            keterangan='$keterangan',
            tanggal='$tanggal'
            where id_produk='$id_produk'";
        }

        //Mengeksekusi atau menjalankan query 
        $edit_produk=mysqli_query($kon,$sql);
        
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($edit_produk) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=produk&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=produk&edit=gagal");

        }
        
    }
?>

<?php
    //Mengambil data produk
    $id_produk=$_POST["id_produk"];
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM produk where id_produk=$id_produk");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/produk/edit.php" method="post" enctype="multipart/form-data">

    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input name="id_produk" value="<?php echo $data['id_produk']; ?>" type="hidden" class="form-control">
                <input name="kode_produk" value="<?php echo $kodeProduk; ?>" type="hidden" class="form-control">
            </div>
        </div>
    </div>

    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Produk:</label>
                <input name="nama_produk" type="text" value="<?php echo $data['nama_produk'];?>" class="form-control" placeholder="Masukan nama" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Berat (gram):</label>
                <input name="berat" type="number" step="any" class="form-control" value="<?php echo $data['berat'];?>" placeholder="Masukan berat (gram)" required>
                <p class="text-info">Berat produk mempengaruhi biaya ongkir</p>
            </div>
        </div>
    </div>

    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori" id="kategori" class="form-control">
                <!-- Menampilkan daftar kategori produk di dalam select list -->
                <?php
                    
                    $sql="select * from kategori order by id_kategori asc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($ambil = mysqli_fetch_array($hasil)):
                ?>
                    <option  <?php if ($data['kategori']==$ambil['id_kategori']) echo "selected"; ?> value="<?php echo $ambil['id_kategori']; ?>"><?php echo $ambil['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">

            <div class="form-group">
                <label>Sub Kategori:</label>
                <select name="sub_kategori" id="sub_kategori" class="form-control">
                <!-- Menampilkan daftar kategori produk di dalam select list -->
                <?php
                    
                    $sql="select * from sub_kategori where id_kategori='".$data['kategori']."' order by id_sub_kategori asc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($ambil = mysqli_fetch_array($hasil)):
                ?>
                    <option value="<?php echo $ambil['id_sub_kategori']; ?>" <?php if ($ambil['id_sub_kategori']==$data['sub_kategori']) echo "selected";?> ><?php echo $ambil['nama_sub_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>
    <!-- rows -->                 
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Harga:</label>
                <input name="harga" type="number" value="<?php echo $data['harga'];?>" class="form-control" placeholder="Masukan harga" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Stok:</label>
                <input name="stok" type="number" value="<?php echo $data['stok'];?>" class="form-control" placeholder="Masukan stok" required>
            </div>
        </div>
    </div>

    <!-- rows -->   
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div id="msg"></div>
                <label>Ganti gambar:</label>
                <input type="file" name="gambar_baru" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                        <div class="input-group-append">
                                <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih</button>
                        </div>
                    </div>
                <img src="pages/produk/gambar/<?php echo $data['gambar'];?>" id="preview" class="img-thumbnail">
                <input type="hidden" name="gambar_saat_ini" value="<?php echo $data["gambar"];?>">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Keterangan:</label>
                <textarea name="keterangan" class="form-control" rows="8" ><?php echo $data['keterangan'];?></textarea>
            </div>  
        </div>
    </div>

        <button type="submit" name="update_produk" class="btn btn-warning">Update</button>
</form>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>
<script>
    $(document).on("click", "#pilih_gambar", function() {
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


<script>
    $("#kategori").change(function() {
        // Mengambil id kategori dari select boz kategori
        var id_kategori = $("#kategori").val();

        // Menggunakan ajax untuk mengirim dan dan menerima data dari server
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/produk/ambil-sub-kategori.php',
            data: "id_kategori=" + id_kategori,
            success: function(data) {
                $("#sub_kategori").html(data);
            }
        });
    });
</script>