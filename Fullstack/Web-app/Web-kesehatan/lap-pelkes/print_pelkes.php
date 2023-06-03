<?php
  session_start();
  include_once '../config/koneksi.php';
  include '../config/fungsi_indotgl.php';
  include_once 'class.lap-pelkes.php';
    /* 
  -- --------------------------------------------------------
  -- --------------------------------------------------------
  -- Nama File : cetak-laporan.php  
  -- Author    : AKSINDOTAMA 
  -- Email     : aksindotamagroup@gmail.com
  -- Website   : www.aksindotama.com 
  -- Copyright [c] 2016 AKSINDOTAMA 
  -- --------------------------------------------------------
  */
   header("Content-Type: application/force-download");
   header("Cache-Control: no-cache, must-revalidate");
   header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
   header("content-disposition: attachment;filename=laporan_pelayanan_kesehatan".date('dmY').".xls");
   
?>

<table width="100%" border="0">
  <tr>
    <td><div align="center"><strong>HASIL REKAP LAPORAN HARIAN </strong></div></td>
  </tr>
  <tr>
    <td><div align="center"><strong>2016</strong></div></td>
  </tr>
  <tr>
    <td><div align="center"><strong>PELAYANAN KESEHATAN </strong></div></td>
  </tr>
  <tr>
    <td><div align="center"><strong>DALAM RANGKA PENGAMANAN ARUS MUDIK DAN BALIK </strong></div></td>
  </tr>
  <tr>
    <td><div align="center"><strong>LEBARAN TAHUN 2016 </strong></div></td>
  </tr>
</table>
<p>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
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
        $pelkes->VLap();
      ?>
  </tbody>
</p>
</table>