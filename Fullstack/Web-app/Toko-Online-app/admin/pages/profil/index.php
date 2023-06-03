<script>
$('title').text('PROFIL');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Profil
    <small>Menampilkan Daftar profil</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Profil</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<?php 
    if (isset($_GET['edit'])) {
        
        if ($_GET['edit']=='berhasil'){
            echo"<div class='alert alert-success'>Profil admin telah berhasil diubah</div>";
        }else if ($_GET['edit']=='gagal'){
            echo"<div class='alert alert-danger'>Profil admin gagal diubah</div>";
        }    
    }

?>


    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header">


            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body table-responsive no-padding">
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
                <?php 
                    //Mengambil data admin di database
                    include '../config/database.php';
                    $id_admin=$_SESSION["id_admin"];
                    $sql="select * from admin where id_admin='$id_admin' limit 1";
                    $hasil=mysqli_query($kon,$sql);
                    $data = mysqli_fetch_array($hasil); 
                ?>
               
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2"> <img class="card-img-top" src="pages/admin/foto/<?php echo $data['foto'];?>" width="100px" alt="Card image"></td>
                        </tr>
                        <tr>
                            <td>Kode</td>
                            <td width="80%">: <?php echo $data['kode_admin'];?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td width="80%">: <?php echo $data['nama_admin'];?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td width="80%">: <?php echo $data['username'];?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td width="80%">: <?php echo $data['email'];?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td width="80%">: <?php echo $data['status'] == 1 ? 'Aktif' : 'Tidak Aktif';?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button type="button" class="btn btn-success"  data-toggle="modal" data-target="#ubah_profil" >Update</button></td>
                        </tr>
                    </tbody>
                </table>

        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    </div>
</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="ubah_profil">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
        <form action="pages/profil/update-profil.php" method="post" enctype="multipart/form-data">
            
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   
                </div>
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kode:</label>
                                <input name="kode" value="<?php echo $data['kode_admin']?>" type="text" class="form-control" placeholder="Masukan kode" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama:</label>
                                <input name="nama" value="<?php echo $data['nama_admin']?>" type="text" class="form-control" placeholder="Masukan nama" required>
                            </div>
                        </div>
                    </div>

                    <!-- rows -->                 
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="msg"></div>
                            <label>Foto Baru:</label>
                            <input type="file" name="foto_baru" class="file" >
                                <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                                    <div class="input-group-append">
                                            <button type="button" id="pilih_foto" class="browse btn btn-dark">Pilih Foto</button>
                                    </div>
                                </div>
                            <img src="pages/admin/foto/<?php echo $data['foto'];?>" id="preview" class="img-thumbnail">
                            <input type="hidden" name="foto_saat_ini" value="<?php echo $data['foto'];?>" class="form-control" />
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <input name="email" id="email" value="<?php echo $data['email']?>" type="email" class="form-control" placeholder="Masukan email" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <br>
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username:</label>
                                <input name="username_baru" id="username_baru" value="<?php echo $data['username']?>" type="text" class="form-control" placeholder="Masukan username" required>
                                <input name="username_lama" id="username_lama" value="<?php echo $data['username']?>" type="hidden" class="form-control">
                                <!-- Informasi ketersediaan username akan ditampilkan disini -->
                                <div id="info_username"> </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password:</label>
                                <input name="password" value="<?php echo $data['password']?>" type="password" class="form-control" placeholder="Masukan nama" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id_admin" value="<?php echo $data['id_admin']?>"/>
            <button type="submit" name="simpan_profil"  id="simpan_profil" class="btn btn-success" >Simpan Profil</button>
        </form> 
        </div>
  
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>

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

<script>
    $("#username_baru").bind('keyup', function () {
        var username_baru = $('#username_baru').val();
        var username_lama = $('#username_lama').val();

        if (username_baru!=username_lama){
            $.ajax({
                    url: 'pages/profil/cek-username.php',
                    method: 'POST',
                    data:{username_baru:username_baru},
                    success:function(data){
                        $('#info_username').show();
                        $('#info_username').html(data);
                    }
                }); 
        } else {
            document.getElementById("username_baru").value=username_baru;
            $('#info_username').hide();
        }
                
    });
</script>

<script>
    // Tambah transaksi
    $('#update').on('click',function(){
        $.ajax({
            url: 'pages/transaksi/update-profil.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Update Profil';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>

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
    
</script>



