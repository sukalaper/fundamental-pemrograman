<?php
session_start();
include_once '../config/koneksi.php';
include '../config/fungsi_indotgl.php';
include_once 'class.insiden.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'admin' ) { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Insiden</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a> <?php } ?>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover">
	<thead>
		<tr align="center">
			<th>Tanggal Insiden</th>
			<th>Jenis Kecelakaan</th>
			<th>Jam</th>
			<th>Alamat Terjadi Insiden</th>
			<th width="100px">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$insiden = new insiden($pdo);		
		$query = "	SELECT
					insiden.id_insiden,
					insiden.tgl_insiden,
					kecelakaan.jenis_kecelakaan,
					insiden.jam,
					insiden.alamat_insiden
					FROM
					insiden
					INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan ";		
		$insiden->view($query);
		?>
	</tbody>
</table>

