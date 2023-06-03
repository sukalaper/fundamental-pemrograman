<?php
session_start();
require_once '../config/koneksi.php';
require_once 'class.rujuk.php';
require_once '../config/fungsi_sqltgl.php';
$rujuk = new rujuk($pdo);
if(!empty($_POST['nama_rujuk'])){
	$nama_rujuk		= $_POST['nama_rujuk'];
	$alamat_rujuk		= $_POST['alamat_rujuk'];
	$created_by 		= $_SESSION['s_user'];
	if($rujuk->create($nama_rujuk,$alamat_rujuk,$created_by)){
		$sg   = "ok";
		$msg1 = "Data telah ditambahkan";
		$alert='alert-success';
	}else{
		$g = "err";
		$msg2 = "Data tidak bisa dimasukan";
		$alert='alert-error';
	}
}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<legend>Tambah Data RS / Puskesmas</legend>
		<span>
		 <?php
		if(isset($sg) and $sg=='ok'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg1
			</div>";
		}elseif(isset($sg) and $sg=='err'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg2
			</div>";}
		?>
		</span>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
				<label class="control-label" for="nama_rujuk" >Nama RS/Puskesmas</label>
					<div class="controls">
					<input type="text" id="nama_rujuk" name="nama_rujuk" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="alamat_rujuk" >Alamat</label>
					<div class="controls">
					<textarea class="span12" id="alamat_rujuk" name="alamat_rujuk" required></textarea>
					</div>
				</div>
			</div>						
		</div>
		<div class="form-actions">
			<div class="controls">
			<button type="submit" class="btn btn-primary">Tambah</button>
			<button type="button" id="close" class="btn btn-primary" >Tutup</button>
			</div>
		</div>
		
	</fieldset>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("#close").click(function(){
			$("#form-nest").hide("slow");
		});
	});
</script>