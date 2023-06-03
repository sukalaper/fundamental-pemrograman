	<?php
session_start();
include_once '../config/koneksi.php';
include_once 'class.diagnosa.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'admin' ) { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Penyakit</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a> <?php } ?>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover">
	<thead>
		<tr align="center">
			<th>Nama Penyakit</th>
			<th width="100px">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$diag = new diagnosa($pdo);		
			$query = "SELECT * FROM diagnosa";		
			$diag->view($query);
		?>
	</tbody>
</table>


