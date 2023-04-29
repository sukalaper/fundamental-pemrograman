<?php
session_start();
require_once '../config/koneksi.php';
require_once '../user/class.user.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator'){ //|| $_SESSION['s_level'] == 'admin' ) { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar User</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a> <?php } ?>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th>Username</th>
			<th>Nama Lengkap</th>
			<th>Email</th>
			<th>No.Telp.</th>
			<th>Poskitis</th>
			<th>Level</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$user = new user($pdo);
		if ($_SESSION['s_level'] == 'administrator'){
			$query = "SELECT * FROM users INNER JOIN poskotis ON users.id_poskotis = poskotis.id_poskotis";	
		}else{			
			$query = "SELECT * FROM users INNER JOIN poskotis ON users.id_poskotis = poskotis.id_poskotis WHERE username ='$_SESSION[s_user]'";	
		}		
		$user->view($query);
	?>
	</tbody>
</table>

