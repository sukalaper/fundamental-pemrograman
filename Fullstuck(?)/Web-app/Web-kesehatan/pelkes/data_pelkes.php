<?php
session_start();
include_once '../config/koneksi.php';
include '../config/fungsi_indotgl.php';
include_once 'class.pelkes.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'admin' ) { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Pelayanan Kesehatan</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a> <?php } ?>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover">
	<thead>
		<tr align="center">
			<th>Tanggal Pemeriksaan</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Umur</th>
			<th>Jenis Kelamin</th>
			<th>Penyakit</th>
			<th>Tindakan</th>
			<th>Rujuk Ke</th>
			<th width="100px">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$pelkes = new pelkes($pdo);		
		$query = "  SELECT
					pelkes.id_pelkes,
					pelkes.nama_korban,
					pelkes.tgl_pemeriksaan,
					pelkes.alamat_korban,
					pelkes.jenis_kelamin,
					pelkes.umur,
					pelkes.id_rujuk,
					pelkes.id_diagnosa,
					pelkes.tindakan,
					pelkes.created_by,
					pelkes.created_at,
					pelkes.updated_by,
					pelkes.updated_at,
					pelkes.id_poskotis,
					pelkes.kondisi,
					diagnosa.nama_diagnosa,
					rujuk.nama_rujuk
					FROM
					pelkes
					INNER JOIN diagnosa ON pelkes.id_diagnosa = diagnosa.id_diagnosa
					INNER JOIN rujuk ON pelkes.id_rujuk = rujuk.id_rujuk";		
		$pelkes->view($query);
		?>
	</tbody>
</table>

