<?php 
if (isset($_POST['buat_pesanan'])) {
    session_start();
    include '../config/database.php';
        
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Membuat nomor pesanan
    $query = mysqli_query($kon, "SELECT max(id_pesanan) as max_id FROM pesanan");
    $get = mysqli_fetch_array($query);
    $id_pesanan = $get['max_id'];
    $id_pesanan++;
    $tahun = date('y');
    $bulan = date('m');
    $nomor_pesanan = $tahun.$bulan.sprintf("%04s", $id_pesanan);

    mysqli_query($kon,"START TRANSACTION");

    $tanggal=date("Y-m-d H:i:s");
    $kode_pelanggan=$_SESSION["kode_pelanggan"];
    $nama=input($_POST["nama"]);
    $nomor_hp=input($_POST["nomor_hp"]);
    $alamat=input($_POST["alamat"]);
    $provinsi=input($_POST["prov"]);
    $kabupaten=input($_POST["kab"]);
    $kurir=input($_POST["kurir"]);
    $tarif=input($_POST["tarif"]);
    $jenis_layanan=input($_POST["jenis_layanan"]);
    $estimasi_waktu=input($_POST["estimasi_waktu"]);
    $potongan=input($_POST["potongan"]);
    
    $sql="insert into pesanan (nomor_pesanan,kode_pelanggan,tanggal,nama,nomor_hp,alamat,provinsi,kabupaten,kurir,jenis_layanan,estimasi_waktu,tarif,potongan) values
    ('$nomor_pesanan','$kode_pelanggan','$tanggal','$nama','$nomor_hp','$alamat','$provinsi','$kabupaten','$kurir','$jenis_layanan','$estimasi_waktu','$tarif','$potongan')";

    $simpan_pesanan=mysqli_query($kon,$sql);

    //Simpan detail transaksi
    if(!empty($_SESSION["keranjang_belanja"])):
        foreach ($_SESSION["keranjang_belanja"] as $item):
            $kode_produk=$item["kode_produk"];
            $qty=$item["jumlah"];
            $harga=$item["harga"];
            $simpan_detail = mysqli_query($kon,"insert into pesanan_detail (nomor_pesanan,kode_produk,harga,qty) values ('$nomor_pesanan','$kode_produk','$harga','$qty')");
        endforeach;
    endif;

    $status=0; // set status ditahan
    $keterangan="Pesanan anda sedang ditahan & menunggu pembayaran";
    $simpan_status = mysqli_query($kon,"insert into status (tanggal,nomor_pesanan,status,keterangan) values ('$tanggal','$nomor_pesanan','$status','$keterangan')");
    

    //Hapus voucher yang sudah digunakan
    $kode_voucher=$_SESSION["kode_voucher"];
    $id_pelanggan=$_SESSION["id_pelanggan"];
    $hapus_voucher = mysqli_query($kon,"delete from penerima_voucher where id_pelanggan='$id_pelanggan' and kode_voucher='$kode_voucher'");


    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($simpan_pesanan and $simpan_detail and $simpan_status and $hapus_voucher) {
        mysqli_query($kon,"COMMIT");
        unset($_SESSION["keranjang_belanja"]);
        unset($_SESSION["potongan"]);
        unset($_SESSION["total_berat"]);
        unset($_SESSION["kode_voucher"]);
        header("Location:../index.php?page=pembayaran&nomor_pesanan=$nomor_pesanan");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../index.php?page=checkout&ut=gagal");
    }
}

?>
<br>


<?php
if (!isset($_SESSION["id_pelanggan"])){
    echo"<script> window.location.href = 'index.php?page=login&aut=login'; </script>";
    exit;
}

if (!isset($_SESSION["keranjang_belanja"])){
    echo "<div class='alert alert-danger'>Belum ada produk yang dipilih</div>";
    echo "<a href='index.php?page=keranjang-belanja' class='btn btn-danger' role='button'>Kembali</a>";
    exit;
}

$connected = @fsockopen("www.google.com", 80); 
if (!$connected){
    echo "<div class='alert alert-warning'>Aplikasi membutuhkan koneksi internet untuk menghubungkan dengan API (Application Programming Interface) dari rajaongkir.com </div>";
    echo "<a href='index.php?page=keranjang-belanja' class='btn btn-danger' role='button'>Kembali</a>";
    exit;
}
?>

<div class="row">
    <form method="post" action="pages/checkout.php">
    <div class="col-sm-5">
        <div class="form-group">
            <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="gunakan_data_saya">
            <label class="custom-control-label" for="gunakan_data_saya">Gunakan data saya</label>
            </div>
            <div id="data_pelanggan"></div>
        </div>
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nomor HP:</label>
            <input type="text"name="nomor_hp"  id="nomor_hp" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat Lengkap:</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="5" required ></textarea>
        </div>
        <?php 

        //Get Data Provinsi
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "key:81d4424e2b099f8b8ea33708087f4b8c"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            echo "
            <div class= \"form-group\">
                <label for=\"provinsi\">Provinsi</label>
                <select class=\"form-control\" name='provinsi' id='provinsi' required>";
                    echo "<option value=''>Pilih Provinsi</option>";
                    $data = json_decode($response, true);
                    for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                        echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
                    }
                    echo "</select>
                </div>";
                //Get Data Provinsi
        ?>
            
        <div class="form-group">
            <label for="kabupaten">Kota/Kabupaten</label><br>
            <select class="form-control" id="kabupaten" name="kabupaten" required>
                <option>Pilih Kabupaten</option>
            </select>
        </div>

        <div class="form-group">
            <label for="kurir">Kurir</label><br>
            <select class="form-control" id="kurir" name="kurir" required>
                <option value="">Pilih Kurir</option>
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">POS INDONESIA</option>
            </select>
        </div>

        <div id="ongkir"></div>

    </div>

    <?php 
    if(!empty($_SESSION["potongan"])){
        $potongan=$_SESSION["potongan"];
    }else {
        $potongan=0;
    }
    ?>
    <div class="col-sm-7">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $no=0;
                $sub_total=0;
                $total=0;
                if(!empty($_SESSION["keranjang_belanja"])):
                foreach ($_SESSION["keranjang_belanja"] as $item):
                    $no++;

                    $sub_total = $item["jumlah"]*$item['harga'];
                    $total+=$sub_total;
            ?>
                <input type="hidden" name="kode_produk[]" class="kode_produk" value="<?php echo $item["kode_produk"]; ?>"/>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $item["nama_produk"]; ?></td>
                    <td>Rp. <?php echo number_format($item["harga"],0,',','.');?> </td>
                    <td><?php echo $item["jumlah"]; ?></td>
                    <td>Rp. <?php echo number_format($sub_total,0,',','.');?> </td>
                </tr>
            <?php 
                endforeach;
                endif;
            ?>
            <tr><td colspan="4">Potongan</td><td> Rp. <?php echo number_format($potongan,0,',','.');?> </td></tr>
            <tr><td colspan="4">Ongkos Kirim</td><td><span id="tampil_ongkir"></span></td></tr>
            <tr><td colspan="4">Total Bayar</td><td><span id="tampil_total_bayar"></span></td></tr>
            </tbody>
        </table>
    </div>
        <input type="hidden" value="<?php echo $total; ?>" id="total_harga_produk" />
        <input type="hidden"  name="potongan" value="<?php echo $potongan; ?>" />

         <!-- Data-data ini di load dengan ajax pada direktori rajaongkir/cek_ongkir.php-->
        <input type="hidden" value="" name="tarif" id="get_tarif" />
        <input type="hidden" value="" name="jenis_layanan" id="get_jenis_layanan" />
        <input type="hidden" value="" name="estimasi_waktu" id="get_estimasi_waktu" />
        <input type="hidden" value="" name="prov" id="get_provinsi" />
        <input type="hidden" value="" name="kab" id="get_kab" />
   
        <!------------------------------------------------------------------------------->
      
        <input type="submit" class="btn btn-danger" style="float:right" name="buat_pesanan" id="buat_pesanan" value="BUAT PESANAN">
    </div>

    </form>
</div>


<div class="clearfix"> </div>

<script type="text/javascript">

	$(document).ready(function(){
        //Tombol buat pesanan secara default akan disabled sampai pengguna memilih jenis layanan pengiriman. lihat pada file rajaongkir/cek_ongkir.php  baris 90
        $("#buat_pesanan").prop('disabled', true);
        $("#kabupaten").prop('disabled', true);
        $("#kurir").prop('disabled', true);
	});


    $('#provinsi').change(function(){

        if ($("#provinsi").val().length == 0){
            $("#kabupaten").prop('disabled', true);
            $("#kurir").prop('disabled', true);
            $("#kabupaten").val('');
            $("#kurir").val('');
            return false; 
        } else {

            get_kabupaten();
            $("#kurir").prop('disabled', false);
            $("#kurir").val('');
            $('#ongkir').hide();
            $(".pilih_ongkir").prop('checked', false);
            $('#tampil_ongkir').text('Rp. '+0);
            $('#tampil_total_bayar').text('Rp. '+0);
            $("#buat_pesanan").prop('disabled', true);
        }

    });

        $('#kabupaten').change(function(){
            $("#kurir").prop('disabled', false);

            if ($("#kurir").val().length != 0){
                get_ongkir();
            }
     
        });

        $('#kurir').change(function(){
            $("#kurir").prop('disabled', false);
            if ($("#kurir").val().length == 0){
                $(".pilih_ongkir").prop('checked', false);
                $('#tampil_ongkir').text('Rp. '+0);
                $('#tampil_total_bayar').text('Rp. '+0);
                $("#buat_pesanan").prop('disabled', true);
                $('#ongkir').hide();
                return false;
            }else {
             
                get_ongkir();
            }
         
        });


    function get_kabupaten(){
        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
        var prov = $('#provinsi').val();

        $.ajax({
            type : 'GET',
            url : 'pages/rajaongkir/cek_kabupaten.php',
            data :  'prov_id=' + prov,
                success: function (data) {
                $("#kabupaten").prop('disabled', false);
                //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                $("#kabupaten").html(data);

            }
        });
    }


    function get_ongkir(){
        var kab = $('#kabupaten').val();
        var kurir = $('#kurir').val();
        var berat = $('#berat').val();

        $.ajax({
            type : 'POST',
            url : 'pages/rajaongkir/cek_ongkir.php',
            data :  {'kab_id' : kab, 'kurir' : kurir, 'berat' : berat},
                success: function (data) {
                $('#ongkir').show();
                //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
                $("#ongkir").html(data);
            }
        });

        $('#tampil_ongkir').text('Rp. '+0);
        $('#tampil_total_bayar').text('Rp. '+0);
        $("#buat_pesanan").prop('disabled', true);
    }
    

    $("#gunakan_data_saya").change(function() {

        if($(this).prop('checked')) {
            ambil_data_pelanggan ();
        } else {
            $('#nama').val('');
            $('#nomor_hp').val('');
            $('#alamat').val('');
        }
    });


    function ambil_data_pelanggan (){
      $.ajax({
        method: 'POST',
        url: 'pages/ambil-data-pelanggan.php',
        data: {},
        success	: function(data){
            $('#data_pelanggan').html(data);
            var nama=$("#sesi_nama").val();
            var telp=$("#sesi_telp").val();
            var alamat=$("#sesi_alamat").val();
            $('#nama').val(nama);
            $('#nomor_hp').val(telp);
            $('#alamat').val(alamat);
        }
      });
    }
</script>



