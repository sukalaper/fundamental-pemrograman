<?php
	require_once 'config/koneksi.php';	
	include_once 'config/fungsi_indotgl.php';
	require_once 'insiden/class.insiden.php';
  require_once 'pelkes/class.pelkes.php'; 
  $ses=$_SESSION['id_poskotis'];
?>

<div class="alert alert-block alert-success">
	<button type="button" class="close" data-dismiss="alert">
		<i class="icon-remove"></i>
	</button>
		<i class="icon-ok green"></i>
			<?php echo "Selamat datang <strong>". $_SESSION['s_nama']."</strong> anda login sebagai <strong>". $_SESSION['s_level']."</strong>"; ?> <br />
				Untuk mengelola data silahkan pilih menu diatas, atau menu sanping pada halaman Home
</div>
<table width="100%" border="0">
  <tr>
    <td width="50%"><div id="graph"></div></td>
    <td width="50%"><div id="graph1"></div></td>
  </tr>
</table>
<script type="text/javascript">
var chart1;
var chart2;
 // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'graph',
            type: 'column'
         },   
         title: {
            text: 'Grafik Insiden '
         },
          subtitle: {
                text: 'Mudik Lebaran Tahun 2016',
               
            },
         xAxis: {
            categories: ['Insiden']
         },
         yAxis: {
            title: {
               text: 'Jumlah insiden'
            }
         },
              series:             
            [
                 //data yang diambil dari database dimasukan ke variable nama dan data
                <?php 
                    $insiden    = new insiden($pdo);
                    if ($_SESSION['s_level']=="administrator"){
                        $query      = " SELECT COUNT(insiden.id_kecelakaan),kecelakaan.jenis_kecelakaan
                                        FROM
                                        insiden
                                        INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan
                                        GROUP BY 
                                        insiden.id_kecelakaan "; 
                    }else{
                        $query      = " SELECT COUNT(insiden.id_kecelakaan),kecelakaan.jenis_kecelakaan
                                        FROM
                                        insiden
                                        INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan
                                        INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis
                                        WHERE
                                        insiden.id_poskotis = '$ses'
                                        GROUP BY 
                                        insiden.id_kecelakaan "; 
                    }
                    $insiden->grafik($query);
                ?>
            ]
      });

      chart2 = new Highcharts.Chart({
         chart: {
            renderTo: 'graph1',
            type: 'column'
         },   
         title: {
            text: 'Grafik Pelayanan Kesehatan '
         },
          subtitle: {
                text: 'Mudik Lebaran Tahun 2016',
               
            },
         xAxis: {
            categories: ['Penyakit']
         },
         yAxis: {
            title: {
               text: 'Jumlah Pasien'
            }
         },
              series:             
            [
                 //data yang diambil dari database dimasukan ke variable nama dan data
                <?php 
                    $pelkes    = new pelkes($pdo);
                    if ($_SESSION['s_level']=="administrator"){
                        $query      = " SELECT COUNT(pelkes.id_diagnosa),diagnosa.nama_diagnosa
                                        FROM
                                        pelkes
                                        INNER JOIN diagnosa ON pelkes.id_diagnosa = diagnosa.id_diagnosa
                                        GROUP BY
                                        pelkes.id_diagnosa"; 
                    }else{
                        $query      = " SELECT COUNT(pelkes.id_diagnosa),diagnosa.nama_diagnosa
                                        FROM
                                        pelkes
                                        INNER JOIN diagnosa ON pelkes.id_diagnosa = diagnosa.id_diagnosa
                                        INNER JOIN poskotis ON pelkes.id_poskotis = poskotis.id_poskotis
                                        WHERE
                                        pelkes.id_poskotis = '$ses'
                                        GROUP BY
                                        pelkes.id_diagnosa ";
                    }
                    $pelkes->grafik($query);
                ?>
            ]
      });

   });  
</script>