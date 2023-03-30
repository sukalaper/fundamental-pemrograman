<script>
$('title').text('DAFTAR PESANAN');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Daftar Pesanan
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Daftar Pesanan</li>
    </ol>
</section>

<!-- Main content -->   
<section class="content">

<div class="row">
    <div class="col-sm-12">
        <div id="pemberitahuan"></div>
    </div>
</div>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- pembayaran -->
            <div class="box box-success">
            <div class="box-header with-border">
          
            </div>
            <!-- /.box-header -->
                <div class="box-body">

                <div class="row mt-2">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="jenis" id="jenis">
                                <option value="1">Bulan</option>
                                <option value="2">Semua</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="bulan" id="bulan">
                                <?php
                                $bulan_sekarang=date('m');
                                $nama_bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                                $bulan = ["01","02","03","04","05","06","07","08","09","10","11","12"];
                                for($i = 0;$i <= 11;$i++):
                                ?>
                                <option  <?php if ($bulan_sekarang==$bulan[$i]) echo "selected"; ?> value="<?php echo $bulan[$i]; ?>" ><?php echo $nama_bulan[$i]; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="tahun" id="tahun">
                            <?php
                                include 'config/database.php';
                                $sql="select distinct year(tanggal) as tahun from pesanan group by tahun order by tahun desc";
                                $hasil=mysqli_query($kon,$sql);
                                while ($data = mysqli_fetch_array($hasil)):
                            ?>
                            <option value="<?php echo $data['tahun']; ?>"><?php echo $data['tahun']; ?></option>
                            <?php endwhile; ?>
                            </select> 
                        </div>
                    </div>
                </div>

                <div id="tabel_pesanan">

                </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- jQuery 3 -->


<script>
    $(document).ready( function () {
        data_pesanan();
    });

    
    $("#bulan").change(function() {
        data_pesanan();
    });

    $("#tahun").change(function() {
        data_pesanan();
    });


    $("#jenis").change(function() {
        var jenis = $("#jenis").val();

        if (jenis==1){
            $("#bulan").prop('disabled', false);
            $("#tahun").prop('disabled', false);
        }else {
            $("#bulan").prop('disabled', true);
            $("#tahun").prop('disabled', true);
 
            
        }
        data_pesanan();
     
    });

    function data_pesanan(){

        var jenis = $("#jenis").val();

        if (jenis==1){
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            $.ajax({
                type: "POST",
                data : {bulan:bulan,tahun:tahun},
                dataType: "html",
                async : false,
                url: 'pages/pesanan/tabel-pesanan.php',
                success: function(data) {
                    $("#tabel_pesanan").html(data);
                }
            });
        }else {
            $.ajax({
                type: "POST",
                data : {},
                dataType: "html",
                async : false,
                url: 'pages/pesanan/tabel-pesanan.php',
                success: function(data) {
                    $("#tabel_pesanan").html(data);
                }
            });
        }
    }
</script>





