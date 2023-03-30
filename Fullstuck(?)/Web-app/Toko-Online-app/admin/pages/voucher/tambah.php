<?php

    if (isset($_POST['tambah_voucher'])) {
        
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

            $nama_voucher=input($_POST["nama_voucher"]);
            $kode_voucher=input($_POST["kode_voucher"]);
            $tipe=input($_POST["tipe"]);
            $nominal=input($_POST["nominal"]);
            $berlaku=input($_POST["berlaku"]);

            $sql="insert into voucher (nama_voucher,kode_voucher,tipe,nominal,berlaku) values
            ('$nama_voucher','$kode_voucher','$tipe','$nominal','$berlaku')";
            $simpan_voucher=mysqli_query($kon,$sql);


            $sql="select * from pelanggan order by id_pelanggan desc";
            $hasil=mysqli_query($kon,$sql);

            while ($data = mysqli_fetch_array($hasil)){

                $id_pelanggan=$data['id_pelanggan'];
               
                $sql="insert into penerima_voucher (id_pelanggan,kode_voucher) values
                ('$id_pelanggan','$kode_voucher')";

                $simpan_penerima=mysqli_query($kon,$sql);

            }

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($simpan_voucher and $simpan_penerima) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=voucher&add=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=voucher&add=gagal");
            }
        }
    }
?>

<form action="pages/voucher/tambah.php" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nama Voucher:</label>
                <input type="text" name="nama_voucher" class="form-control" placeholder="Masukan Nama Voucher" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kode Voucher:</label>
                <input type="text" name="kode_voucher" id="kode_voucher" class="form-control" placeholder="Masukan Kode Voucher" required>
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
                  <option value="1">Persentase</option>
                  <option value="2">Potongan Harga Tetap</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Nominal:</label>
                <input type="number" name="nominal"  min="0" id="nominal" class="form-control" placeholder="" required>
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
                <input type="date" name="berlaku" id="berlaku" class="form-control"  required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="tambah_voucher" id="Submit" class="btn btn-primary">Tambah</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
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
