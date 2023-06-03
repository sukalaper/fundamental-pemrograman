<?php
session_start();
    if (isset($_POST['update_voucher'])) {
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
        $id_voucher=input($_POST["id_voucher"]);
        $nama_voucher=input($_POST["nama_voucher"]);
        $kode_voucher=input($_POST["kode_voucher"]);
        $kode_voucher_sebelumnya=input($_POST["kode_voucher_sebelumnya"]);
        $tipe=input($_POST["tipe"]);
        $nominal=input($_POST["nominal"]);
        $berlaku=input($_POST["berlaku"]);

        $sql="update voucher set
        nama_voucher='$nama_voucher',
        kode_voucher='$kode_voucher',
        tipe='$tipe',
        nominal='$nominal',
        berlaku='$berlaku'
        where id_voucher='$id_voucher'";
    
        //Mengeksekusi atau menjalankan query 
        $edit_voucher=mysqli_query($kon,$sql);

        $sql="update penerima_voucher set
        kode_voucher='$kode_voucher'
        where kode_voucher='$kode_voucher_sebelumnya'";
    
        //Mengeksekusi atau menjalankan query 
        $edit_penerima_voucher=mysqli_query($kon,$sql);

        
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($edit_voucher and  $edit_penerima_voucher) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=voucher&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=voucher&edit=gagal");
        }
    }
?>

<?php
    //Mengambil data voucher
    $id_voucher=$_POST["id_voucher"];
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM voucher where id_voucher=$id_voucher");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/voucher/edit.php" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="hidden" name="id_voucher" value="<?php echo $data['id_voucher']; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nama Voucher:</label>
                <input type="text" name="nama_voucher" value="<?php echo $data['nama_voucher']; ?>" class="form-control" placeholder="Masukan Voucher" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kode Voucher:</label>
                <input type="text" name="kode_voucher" id="kode_voucher" value="<?php echo $data['kode_voucher']; ?>" class="form-control" placeholder="Masukan Kode Voucher" required>
                <input type="hidden" name="kode_voucher_sebelumnya" value="<?php echo $data['kode_voucher']; ?>" class="form-control" >
                <div class="form-group">
                    <label id="info_kode_voucher"> </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Tipe:</label>
                <select class="form-control" name="tipe" id="tipe" data-placeholder="Select a State" style="width: 100%;">
                  <option value="1" <?php if ($data['tipe']==1) echo 'selected';?> >Persentase</option>
                  <option value="2" <?php if ($data['tipe']==2) echo 'selected';?> >Potongan Harga Tetap</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nominal:</label>
                <input type="number" name="nominal"  min="0" id="nominal" value="<?php echo $data['nominal']; ?>" class="form-control" placeholder="" required>
            </div>
            <div class="form-group">
                <label id="info_nominal"> </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Berlaku:</label>
                <input type="date" name="berlaku" id="berlaku" value="<?php echo $data['berlaku']; ?>" class="form-control"  required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="update_voucher" id="update" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
<script>

    $(document).ready(function(){

        var tipe = $("#tipe").val();
        if (tipe==1){
            $("#nominal").attr("placeholder", "Masukan nominal persentase");
        }else if (tipe==2){
            $("#nominal").attr("placeholder", "Masukan nominal potongan harga tetap");
        }
    });

    $("#tipe").change(function() {
  
        var tipe = $("#tipe").val();
        if (tipe==1){
            $("#nominal").attr("placeholder", "Masukan nominal persentase");
        }else if (tipe==2){
            $("#nominal").attr("placeholder", "Masukan nominal potongan harga tetap");
        }

        $("#nominal").val('');
        $("#info_nominal").text('');
     
    });
</script>

<script>
    
    function format_rupiah(nominal){
        var  reverse = nominal.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
         return ribuan	= ribuan.join('.').split('').reverse().join('');
    }

    $('#nominal').bind('keyup', function () {
        var nominal=$("#nominal").val();
        var tipe = $("#tipe").val();

        if (tipe==1){
            $("#info_nominal").text('Potongan '+nominal+' %');
        }else if (tipe==2){
            $("#info_nominal").text('Potongan Rp.'+format_rupiah(nominal));
        }
            
    }); 

</script>

<script>

    $("#kode_voucher").bind('keyup', function () {

        var kode_voucher = $('#kode_voucher').val();
        $.ajax({
            url: 'pages/voucher/cek.php',
            method: 'POST',
            data:{kode_voucher:kode_voucher},
            success:function(data){
                $('#info_kode_voucher').show();
                $('#info_kode_voucher').html(data);
            }
        }); 

    });
</script>
