<?php
	/* 
	-- --------------------------------------------------------
	-- --------------------------------------------------------
	-- Nama File : cetak-laporan.php  
	-- Author    : AKSINDOTAMA 
	-- Email     : aksindotamagroup@gmail.com
	-- Website   : www.aksindotama.com 
	-- Copyright [c] 2016 AKSINDOTAMA 
	*/

	session_start();
	include_once '../config/koneksi.php';
	include '../config/fungsi_indotgl.php';
	include_once 'class.lap-pelkes.php';

	// Define relative path from this script to mPDF
	$nama_dokumen='laporan Laporan Pelayanan Kesehatan'; //Beri nama file PDF hasil.
	define('../assets/MPDF57/');
	include("../assets/MPDF57/mpdf.php");
	$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document

	//Beginning Buffer to save PHP variables and HTML tags
	ob_start(); 
?>
<style type="text/css">
	table{	 
		border-collapse:collapse;	 
	}	 
	table,th, td	 
	{	 
	border: 0px solid black;
	}
	td	 
	{	 
	padding:10px;	 
	}
</style>


<p align="center"><strong><align="center">HASIL REKAP LAPORAN HARIAN<br />
2016<br />
DALAM RANGKA PENGAMANAN ARUS MUDIK DAN BALIK <br />
PELAYANAN KESEHATAN <br />
LEBARAN TAHUN 2016 </strong></p>
 
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
<?php
	$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
	ob_end_clean();
	//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;
?>