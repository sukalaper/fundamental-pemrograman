<?php
session_start();
if (isset($_POST['tambah_produk'])) {
    //Koneksi database
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

        $kode_produk=input($_POST["kode_produk"]);
        $nama_produk=ucwords(input($_POST["nama_produk"]));
        $kategori=input($_POST["kategori"]);
        $sub_kategori=input($_POST["sub_kategori"]);
        $berat=input($_POST["berat"]);
        $stok=input($_POST["stok"]);
        $harga=input($_POST["harga"]);
        $keterangan=input($_POST["keterangan"]);
        $tanggal=date("Y-m-d");
        
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
        $gambar = $_FILES['gambar']['name'];
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];

        //Validasi jika gambar produk tidak diinput oleh user
        if (!empty($gambar)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                //Mengupload gambar
                move_uploaded_file($file_tmp, 'gambar/'.$gambar);

                $sql="insert into produk (kode_produk,nama_produk,kategori,sub_kategori,berat,stok,harga,keterangan,tanggal,gambar) values
                ('$kode_produk','$nama_produk','$kategori','$sub_kategori','$berat','$stok','$harga','$keterangan','$tanggal','$gambar')";
 
            }
        }else {
            $sql="insert into produk (kode_produk,nama_produk,kategori,sub_kategori,berat,stok,harga,keterangan,tanggal,gambar) values
            ('$kode_produk','$nama_produk','$kategori','$sub_kategori','$berat','$stok','$harga','$keterangan','$tanggal','gambar_default.png')";

        }

        //Mengeksekusi query 
        $simpan=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($simpan) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=produk&add=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=produk&add=gagal");
        }

    }

}


    // mengambil data produk dengan kode paling besar
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT max(id_produk) as kodeTerbesar FROM produk");
    $data = mysqli_fetch_array($query);
    $id_produk = $data['kodeTerbesar'];
    $id_produk++;
    $huruf = "P";
    $kodeProduk = $huruf . sprintf("%04s", $id_produk);

?>
<form action="pages/produk/tambah.php" method="post" enctype="multipart/form-data">
    <input name="kode_produk" value="<?php echo $kodeProduk; ?>" type="hidden" class="form-control">
    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Produk:</label>
                <input name="nama_produk" type="text" class="form-control" placeholder="Masukan nama" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Berat (gram):</label>
                <input name="berat" type="number" step="any" class="form-control" placeholder="Masukan berat (gram)" required>
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
                    while ($data = mysqli_fetch_array($hasil)):
                ?>
                    <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Sub Kategori:</label>
                <select name="sub_kategori"  id="sub_kategori" class="form-control">
                <!-- Menampilkan daftar kategori produk di dalam select list -->

                </select>
            </div>
        </div>
    </div>
    <!-- rows -->                 
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Harga:</label>
                <input name="harga" type="number" id="harga" class="form-control" placeholder="Masukan harga" required>
            </div>
            <div class="form-group">
                <label id="info_harga"> </label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Stok:</label>
                <input name="stok" type="number" class="form-control" placeholder="Masukan stok" required>
            </div>
        </div>
    </div>

    <!-- rows -->   
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div id="msg"></div>
                <label>Gambar Produk:</label>
                <input type="file" name="gambar" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                        <div class="input-group-append">
                                <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih</button>
                        </div>
                    </div>
                <img src="dist/img/img80.png" id="preview" class="img-thumbnail">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Keterangan:</label>
                <textarea name="keterangan" class="form-control" rows="8" ></textarea>
            </div>  
        </div>
    </div>

        <button type="submit" name="tambah_produk" class="btn btn-primary">Tambah</button>
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
    $(document).ready(function(){
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


<script>

    function format_rupiah(nominal){
        var  reverse = nominal.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
         return ribuan	= ribuan.join('.').split('').reverse().join('');
    }


    $('#harga').bind('keyup', function () {
        var harga=$("#harga").val();
        $("#info_harga").text('Rp. '+format_rupiah(harga));   
    }); 
</script>
