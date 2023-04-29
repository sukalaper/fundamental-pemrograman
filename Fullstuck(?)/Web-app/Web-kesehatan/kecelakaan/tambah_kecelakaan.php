<?php
session_start();
require_once '../config/koneksi.php';
require_once 'class.kecelakaan.php';
require_once '../config/fungsi_sqltgl.php';
$kecelakaan = new kecelakaan($pdo);
if(!empty($_POST['jenis_kecelakaan'])){
	$jenis_kecelakaan	= $_POST['jenis_kecelakaan'];
	$keterangan 		= $_POST['keterangan'];
	$created_by 		= $_SESSION['s_user'];
	if($kecelakaan->create($jenis_kecelakaan,$keterangan,$created_by)){
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
		<legend>Tambah Data </legend>
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
				<label class="control-label" for="jenis_kecelakaan" >Jenis Kecelakaan</label>
					<div class="controls">
					<input type="text" id="jenis_kecelakaan" name="jenis_kecelakaan" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="keterangan" >Keterangan</label>
					<div class="controls">
					<textarea class="span12" id="keterangan" name="keterangan" required></textarea>
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