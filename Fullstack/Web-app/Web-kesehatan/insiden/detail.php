<?php

	require_once '../config/koneksi.php';	
	include_once '../config/fungsi_indotgl.php';
	require_once 'class.insiden.php';
	$insiden = new insiden($pdo);
	if(isset($_GET['id_insiden']))
	{
		$id = $_GET['id_insiden'];
		extract($insiden->getID($id));	
	} 
?>

<h3 class="header smaller lighter blue">Detail Insiden</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="15%">Jenis Insiden</td>
      <td width="2%" align="center">:</td>
      <td width="83%"><?php echo $jenis_kecelakaan; ?></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td align="center">:</td>
      <td><?php echo tgl_indo($tgl_insiden); ?></td>
    </tr>
    <tr>
      <td>Jam</td>
      <td align="center">:</td>
      <td><?php echo $jam; ?></td>
    </tr>
    <tr>
      <td>Alamat </td>
      <td align="center">:</td>
      <td><?php echo $alamat_insiden; ?></td>
    </tr>
  </tbody>
</table>
<hr />

<h4 class="header smaller lighter blue">Daftar Korban</h3>
<!--
<div class="table-header">
	<a href="javascript:void(0)" onclick="tambahkorban('<?php echo $id_insiden; ?>')" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a>
</div>
-->
<table id="tabeldata" class="table table-striped table-bordered table-hover">
	<thead>
		<tr align="center">
			<th>Nama</th>
			<th>Alamat</th>
			<th>jenis kelamin</th>
			<th>Umur</th>
			<th>Kondisi</th>
			<th>Rujuk Ke</th>
			<th>Tindakan</th>
			<th width="100px">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$insiden = new insiden($pdo);		
		$query = "  SELECT
					insiden.tgl_insiden,
					kecelakaan.jenis_kecelakaan,
					insiden.jam,
					insiden.alamat_insiden,
					insiden.id_insiden,
					detail_insiden.id_detail_insiden,
					detail_insiden.nama_korban,
					detail_insiden.alamat_korban,
					detail_insiden.jenis_kelamin,
					detail_insiden.umur,
					detail_insiden.kondisi,
					detail_insiden.tindakan,
					rujuk.nama_rujuk
					FROM
					insiden
					INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan
					INNER JOIN detail_insiden ON detail_insiden.id_insiden = insiden.id_insiden
					INNER JOIN rujuk ON detail_insiden.id_rujuk = rujuk.id_rujuk 
					WHERE insiden.id_insiden=$id ";		
		$insiden->viewDetail($query);
		?>
	</tbody>
</table>
<div class="table-header">
	<a href="javascript:void(0)" onclick="swapContent('insiden/insiden')" class="btn btn-primary" ><i class="icon-close icon-white"></i>Tutup</a>
</div>