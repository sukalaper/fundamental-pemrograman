<?php
  session_start();
  include_once '../config/koneksi.php';
  include '../config/fungsi_indotgl.php';
  include_once 'class.lap-pelkes.php';
?>

<h3 class="header smaller lighter blue">Laporan pelkes</h3>
<div class="table-header">
  <a href="../sipkes/lap-pelkes/print_pelkes.php" target="_blank" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print xls</a>
  <a href="../sipkes/lap-pelkes/print_pelkes_pdf.php" target="_blank" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print pdf</a>
</div>
<p>
<table width="100%" border="1" cellspacing="0" cellpadding="3">
  <thead>
    <tr>
      <td rowspan="3" align="center"><b>NO</b></td>
      <td rowspan="3" align="center"><b>JENIS PENYAKIT</b></td>
      <td colspan="5" align="center"><b>PENDERITA</b></td>
      <td colspan="3" align="center"><b>KONDISI KORBAN</b></td>
      <td rowspan="3" align="center"><b>RAWAT <br>JALAN</b></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><b>< 5TH </b></td>
      <td colspan="2" align="center"><b>> 5TH</b></td>
      <td rowspan="2" align="center"><b>JUMLAH</b></td>
      <td rowspan="2" align="center"><b>MENINGGAL</b></td>
      <td colspan="2" align="center"><b>RUJUK KE</b></td>      
    </tr>
    <tr>
      <td align="center"><b>L</b></td>
      <td align="center"><b>P</b></td>
      <td align="center"><b>L</b></td>
      <td align="center"><b>P</b></td>
      <td align="center"><b>PUSKESMAS</b></td>
      <td align="center"><b>RS</b></td>
    </tr>
    </thead>
    <tbody>
      <?php
        $pelkes = new lap_pelkes($pdo);
        if ($_SESSION['s_level']=="administrator"){        
          $pelkes->VLap();
        }else{
          $pelkes->VLap1();
        }
      ?>
  </tbody>
</p>
</table>