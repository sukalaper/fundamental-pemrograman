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
	include_once 'class.lap-insiden.php';

	// Define relative path from this script to mPDF
	$nama_dokumen='laporan Insiden'; //Beri nama file PDF hasil.
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
KORBAN KEJADIAN/INSIDEN/KECELAKAAN <br />
LEBARAN TAHUN 2016 </strong></p>
 
<p>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <td rowspan="3" align="center"><b>NO</b></td>
      <td rowspan="3" align="center"><b>JENIS KEJADIAN /<br> KECELAKAAN</b></td>
      <td colspan="5" align="center"><b>KORBAN</b></td>
      <td colspan="6" align="center"><b>KONDISI KORBAN</b></td>
      <td rowspan="3" align="center"><b>RAWAT <br>JALAN</b></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><b>< 5TH </b></td>
      <td colspan="2" align="center"><b>> 5TH</b></td>
      <td rowspan="2" align="center"><b>JUMLAH</b></td>
      <td colspan="3" align="center"><b>LUKA</b></td>
      <td rowspan="2" align="center"><b>MENINGGAL</b></td>
      <td colspan="2" align="center"><b>RUJUK KE</b></td>      
    </tr>
    <tr>
      <td align="center"><b>L</b></td>
      <td align="center"><b>P</b></td>
      <td align="center"><b>L</b></td>
      <td align="center"><b>P</b></td>
      <td align="center"><b>RINGAN</b></td>
      <td align="center"><b>SEDANG</b></td>
      <td align="center"><b>BERAT</b></td>
      <td align="center"><b>PUSKESMAS</b></td>
      <td align="center"><b>RS</b></td>
    </tr>
    </thead>
    <tbody>
      <?php
        $insiden = new lap_insiden($pdo);         
        $insiden->VLap();
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