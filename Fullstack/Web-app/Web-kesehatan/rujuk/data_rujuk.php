<?php
session_start();
include_once '../config/koneksi.php';
include_once 'class.rujuk.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'admin' ) { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar RS/Puskesmas</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a> <?php } ?>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>RS/Puskesmas</th>
			<th>Alamat</th>
			<th width="150px">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$rujuk = new rujuk($pdo);		
		$query = "SELECT * FROM rujuk";		
		$rujuk->view($query);
	?>
	</tbody>
</table>


