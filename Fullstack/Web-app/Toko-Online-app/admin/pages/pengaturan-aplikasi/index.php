<script>
$('title').text('PENGATURAN APLIKASI');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Pengaturan Aplikasi
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"> Pengaturan Aplikasi</li>
    </ol>
</section>

<?php 

    //Koneksi database
    include '../config/database.php';
    //Menjalankan query
    $hasil=mysqli_query($kon,"select * from profil_aplikasi order by nama_aplikasi desc limit 1");
    $data = mysqli_fetch_array($hasil); 
    
?>
<!-- Main content -->
<section class="content">

<?php 
    if (isset($_GET['edit'])) {
        //Menampilkan pesan saat admin mengubah profil aplikasi
        if ($_GET['edit']=='berhasil'){
            echo"<div class='alert alert-success'>Profil aplikasi telah berhasil diubah</div>";
        }else if ($_GET['edit']=='gagal'){
            echo"<div class='alert alert-danger'>Profil aplikasi gagal diubah</div>";
        }    
    }

?>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- Kategori -->
            <div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
                <div class="box-body">
              
                <form action="pages/pengaturan-aplikasi/edit.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="<?php echo $data['id'];?>" name="id">  
                        </div>
                        <div class="form-group">
                            <label>Nama Aplikasi:</label>
                            <input type="text" name="nama_aplikasi" class="form-control" value="<?php echo $data['nama_aplikasi'];?>"  required>  
                        </div>
                        <div class="form-group">
                            <label>Alamat:</label>
                            <textarea name="alamat" class="form-control" rows="5" ><?php echo $data['alamat'];?></textarea>
                        </div>
                        <?php 

                        //Get Data Provinsi
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
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
                        ?>

            
                        <div class= "form-group">
                            <label for="provinsi">Provinsi</label>
                            <select class="form-control" name='provinsi'  id='provinsi' required>";
                                <option>Pilih Provinsi</option>
                                <?php
                                $get = json_decode($response, true);
                                for ($i=0; $i < count($get['rajaongkir']['results']); $i++):
                                ?>
                                    <option <?php if($data['provinsi']==$get['rajaongkir']['results'][$i]['province_id']) echo "selected";?> value="<?php echo $get['rajaongkir']['results'][$i]['province_id']; ?>"  ><?php echo $get['rajaongkir']['results'][$i]['province']; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                               
                        
                        <?php

                            $provinsi_id = $data['provinsi'];

                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$provinsi_id",
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

                            $response1 = curl_exec($curl);
                            $err = curl_error($curl);

                            curl_close($curl);

                            if ($err) {
                            echo "cURL Error #:" . $err;
                            } else {
                            //echo $response;
                            }

                
                        ?>
                        <div class="form-group">
                            <label for="kabupaten">Kota/Kabupaten</label><br>
                            <select class="form-control" id="kabupaten" name="kabupaten" required>
                            <?php
                                $set = json_decode($response1, true);
                                for ($i=0; $i < count($set['rajaongkir']['results']); $i++):
                                ?>
                                <option  value="<?php echo $set['rajaongkir']['results'][$i]['city_id']; ?>"><?php echo $set['rajaongkir']['results'][$i]['city_name']; ?></option>
                            <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No Telp:</label>
                            <input type="text" name="no_telp" class="form-control" value="<?php echo $data['no_telp'];?>"  required>  
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $data['email'];?>"  required>  
                        </div>
                        <div class="form-group">
                            <label>Website:</label>
                            <input type="text" name="website" class="form-control" value="<?php echo $data['website'];?>" required>  
                        </div>
                        <div class="form-group">
                            <div id="msg"></div>
                            <label>Logo:</label>
                            <input type="file" name="logo" class="file" >
                                <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                    <div class="input-group-append">
                                            <button type="button" id="pilih_logo" class="browse btn btn-dark">Pilih Logo</button>
                                    </div>
                                </div>
                            <img src="pages/pengaturan-aplikasi/logo/<?php echo $data['logo'];?>" id="preview" width="185px" class="img-thumbnail">
                            <input type="hidden" name="logo_sebelumnya" value="<?php echo $data['logo'];?>" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"name="ubah_aplikasi" >Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</section>

<div id='ajax-wait'>
    <img alt='loading...' src='dist/img/Rolling-1s-84px.png' />
</div>
<style>
    #ajax-wait {
        display: none;
        position: fixed;
        z-index: 2300
    }
</style>

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

<script>
	$('#provinsi').change(function(){
        loading();
        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
        var prov = $('#provinsi').val();
        var nama_provinsi = $(this).attr("nama_provinsi");
        $.ajax({
            type : 'GET',
            url : '../pages/rajaongkir/cek_kabupaten.php',
            data :  'prov_id=' + prov,
                success: function (data) {

                //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                $("#kabupaten").html(data);
                $("#tampil_provinsi").val(nama_provinsi);

            }
        });
    });
</script>


<script>

    function loading(){
        $( document ).ajaxStart(function() {
        $( "#ajax-wait" ).css({
            left: ( $( window ).width() - 32 ) / 2 + "px", // 32 = lebar gambar
            top: ( $( window ).height() - 32 ) / 2 + "px", // 32 = tinggi gambar
            display: "block"
        })
        })
        .ajaxComplete( function() {
            $( "#ajax-wait" ).fadeOut();
        });
    }

</script>