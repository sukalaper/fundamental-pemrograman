<script>
$('title').text('DASHBOARD');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
    <div class="col-lg-3 col-xs-6">
    <?php
        include '../config/database.php';
        //Mengambil total pendapatan berdasarkan pesanan yang telah dibayar dikurangi dengan jumlah potongan
        $hasil=mysqli_query($kon,"select sum(harga*qty) as total, sum(potongan) as total_potongan from pesanan_detail d inner join pesanan p on p.nomor_pesanan=d.nomor_pesanan where p.status_pembayaran='1'");
        $data = mysqli_fetch_array($hasil);
    ?>
        <!-- small box -->
        <div class="small-box bg-aqua">
        <div class="inner">
            <h3>Rp. <?php echo number_format($data['total']-$data['total_potongan'],0,',','.'); ?></h3>
            <p>Total Pendapatan</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
    <?php
        $hasil=mysqli_query($kon,"select sum(qty) as terjual from pesanan_detail");
        $data = mysqli_fetch_array($hasil);
    ?>
        <!-- small box -->
        <div class="small-box bg-green">
        <div class="inner">
            <h3><?php if(isset($data['terjual'])){
                echo $data['terjual'];
                }else {
                    echo "0";
                }?> 
            </h3>

            <p>Total Produk Terjual</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="index.php?page=pesanan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
    <?php
        $hasil=mysqli_query($kon,"select id_pelanggan from pelanggan");
        $jumlah = mysqli_num_rows($hasil);
    ?>
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php if(isset($jumlah)){
                echo $jumlah;
                }else {
                    echo "0";
                }?> 
            </h3>
            <p>Total Pelanggan</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="index.php?page=pelanggan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
    <?php
        $hasil=mysqli_query($kon,"select id_pesanan from pesanan where status='3'");
        if ($hasil){
            $selesai = mysqli_num_rows($hasil);
        }
       

        $hasil=mysqli_query($kon,"select id_pesanan from pesanan");
        
        if ($hasil){
            $semua = mysqli_num_rows($hasil);
        }
    ?>
        <!-- small box -->
        <div class="small-box bg-red">
        <div class="inner">
        <h3>
        <?php 
            if ($semua!=0 and $selesai!=0){
                echo number_format($selesai/$semua*100,2);
                echo "<sup style='font-size: 20px'>%</sup>";
            }else {
                echo "0";
            }
                    
        ?> 
        </h3>
            <p>Persentase Pesanan yang selesai</p>

        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="index.php?page=pesanan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">

    <!-- Left col -->
    <section class="col-lg-8 connectedSortable">
    <?php 
    if (isset($semua)) {
        if ($semua==0){
            echo"<div class='alert alert-warning'>Tidak ada pesanan</div>";  
        }
    }
    ?>


          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Penjualan <small>dengan status pembayaran sudah diabayar </small></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="chart_penjualan" ></canvas>
                </div>
                <span class='badge bg-blue'>Total pesanan</span>
                <span class='badge bg-green'>Total Produk </span>
                
            </div>
            <!-- /.box-body -->
          </div>

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Pendapatan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="chart_pendapatan" ></canvas>
                </div>
            </div>
            <!-- /.box-body -->
          </div>

     
    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-4 connectedSortable">

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Status Pesanan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Status</th>
                  <th>Jumlah</th>
                  <th style="width: 40px">Persentase</th>
                </tr>
                <?php
                    $no=0;
                    $status="";
                    $label="";
                
                    $semua_pesanan=mysqli_query($kon,"select status FROM pesanan");
                    $jum_semua_pesanan=mysqli_num_rows($semua_pesanan);
                    $sql="select status, count(*) as total FROM pesanan group by status order by total desc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)):
                    $no++;

                    switch ($data['status']){
                        case '0' : $status='Ditahan'; $label="gray"; break;
                        case '1' : $status='Pembayaran tertunda';  $label="black";break;
                        case '2' : $status='Sedang diproses';  $label="blue"; break;
                        case '3' : $status='Selesai';  $label="green"; break;
                        case '4' : $status='Dibatalkan';  $label="red"; break;
                        case '5' : $status='Dana dikembalikan'; $label="gray"; break;
                        default :  $status='-';

                    }
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $status; ?></td>
                  <td><?php echo $data['total']; ?></td>
                  <td>
                  <?php
                    if ($jum_semua_pesanan!=0){
                        $persentase=number_format($data['total']/$jum_semua_pesanan*100,2);
                        echo "<span class='badge bg-".$label."'>".$persentase." %</span>";
                    }else {
                        echo "0";
                    }
                  ?>
                  </td>
                </tr>
                <?php endwhile; ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Status Pembayaran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Status</th>
                  <th>Jumlah</th>
                  <th style="width: 40px">Persentase</th>
                </tr>
                <?php
                    $no=0;
                    $status="";
                    $label="";
                
                    $semua_pesanan=mysqli_query($kon,"select status_pembayaran FROM pesanan");
                    $jum_semua_pesanan=mysqli_num_rows($semua_pesanan);
                    $pesanan=mysqli_query($kon,"select status_pembayaran, count(*) as total FROM pesanan group by status_pembayaran order by total desc");
                    while ($data = mysqli_fetch_array($pesanan)):
                    $no++;

                    switch ($data['status_pembayaran']){
                        case '0' : $status='Belum bayar';
                                    $label="red"; break;
                        case '1' : $status='Sudah bayar';
                                    $label="green";
                                    break;
                        default :  $status='-';

                    }

       
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $status; ?></td>
                  <td><?php echo $data['total']; ?></td>
                  <td>
                  <?php
                    if ($jum_semua_pesanan!=0){
                        $persentase=number_format($data['total']/$jum_semua_pesanan*100,2);
                        echo "<span class='badge bg-".$label."'>".$persentase." %</span>";
                    }else {
                        echo "0";
                    }
                  ?>
                  </td>
                </tr>
                <?php endwhile; ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>




          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Jumlah Produk Terjual</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Produk</th>
                  <th>Jumlah</th>
                </tr>
                <?php
                    $no=0;
                    $status="";
                    $label="";
                
                    $semua_pesanan=mysqli_query($kon,"select status_pembayaran FROM pesanan");
                    $jum_semua_pesanan=mysqli_num_rows($semua_pesanan);
                    $hasil=mysqli_query($kon,"select p.nama_produk, sum(qty) as total from pesanan_detail d inner join produk p on p.kode_produk=d.kode_produk inner join pesanan n on n.nomor_pesanan=d.nomor_pesanan where status_pembayaran='1' group by p.nama_produk order by total desc");
                    while ($data = mysqli_fetch_array($hasil)):
                    $no++;
       
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['nama_produk']; ?></td>
                  <td><?php echo $data['total']; ?></td>
                  <td>
   
                  
                  </td>
                </tr>
                <?php endwhile; ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>


        <!-- /.box -->

    </section>
    <!-- right col -->
    </div>
    <!-- /.row (main row) -->

</section>
<!-- /.content -->


<?php
   include '../config/database.php';
    for($bulan = 1;$bulan <= 12;$bulan++)
    {

        $hasil1=mysqli_query($kon,"select count(*) as total_pesanan from pesanan where MONTH(tanggal)='$bulan' and status_pembayaran='1'");
        $data1=mysqli_fetch_array($hasil1);
        $total_pesanan[] = $data1['total_pesanan'];

        $hasil2=mysqli_query($kon,"select sum(qty) as total_terjual from pesanan_detail d inner join pesanan p on p.nomor_pesanan=d.nomor_pesanan  where MONTH(tanggal)='$bulan' and status_pembayaran='1'");
        $data2=mysqli_fetch_array($hasil2);
        $total_terjual[] = $data2['total_terjual'];
    }
?>
<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
		datasets : [
			{
   
				fillColor : "#3366cc",
				strokeColor : "#4775d1",
				highlightFill: "#5c85d6",
				highlightStroke: "#7094db",
				data : <?php echo json_encode($total_pesanan); ?>
			},
            {
    
				fillColor : "#2eb82e",
				strokeColor : "#29a329",
				highlightFill : "#2eb82e",
				highlightStroke : "#33cc33",
				data :<?php echo json_encode($total_terjual); ?>
			}
		]
	}

    //Grafik Pendapatan

    <?php
        include '../config/database.php';
        for($bulan = 1;$bulan <= 12;$bulan++)
        {

            $hasil2=mysqli_query($kon,"select sum(qty*harga) as pendapatan, sum(potongan) as potongan from pesanan_detail d inner join pesanan p on p.nomor_pesanan=d.nomor_pesanan  where MONTH(tanggal)='$bulan' and status_pembayaran='1'");
            $data2=mysqli_fetch_array($hasil2);
            $total_pendapatan[] = $data2['pendapatan']-$data2['potongan'];
        }
    ?>
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var lineChartData = {
        labels : ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
        datasets : [
            {
                label: "My First dataset",
                fillColor : "#527a7a",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(220,220,220,1)",
                data : <?php echo json_encode($total_pendapatan); ?>
            }
        ]

    }

        //Memanggil chart
        window.onload = function(){
  
            var nct = document.getElementById("chart_pendapatan").getContext("2d");
            window.myLine = new Chart(nct).Line(lineChartData, {
                responsive: true
            });

            var bar = document.getElementById("chart_penjualan").getContext("2d");
            window.myBar = new Chart(bar).Bar(barChartData, {
                responsive : true
            });
        };



	</script>
