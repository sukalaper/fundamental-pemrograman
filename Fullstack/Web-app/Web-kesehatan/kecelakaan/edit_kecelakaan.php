<?php 
	session_start();
	include_once '../config/koneksi.php';
	require_once '../kecelakaan/class.kecelakaan.php';
	$kecelakaan = new kecelakaan($pdo);
	if(!empty($_POST['id_kecelakaan'])){
		$id_kecelakaan		= $_POST['id_kecelakaan'];
		$jenis_kecelakaan	= $_POST['jenis_kecelakaan'];
		$keterangan 		= $_POST['keterangan'];
		$updated_by			= $_SESSION['s_user'];
		if($kecelakaan->update($id_kecelakaan,$jenis_kecelakaan,$keterangan,$updated_by)){
			$sg   = "ok";
			$msg1 = "Data Berhasil Di Update";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "Data Gagal Di Update";
			$alert='alert-error';
		}
	}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<legend>Edit Data</legend>
		<span>
		<?php
		if(isset($sg) and $sg=='ok'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg1
			</div>";
        	?>
        <div class="form-actions">
			<div class="controls">
				<button type="button" id="close" class="btn btn-primary" >Tutup</button>
			</div>
		</div>
		<?php }elseif(isset($sg) and $sg=='err')
		{
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg2
			</div>"; 
		}
		else
		{
		if(isset($_GET['id_kecelakaan']))
		{
			$id = $_GET['id_kecelakaan'];
			extract($kecelakaan->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div class="control-group">
				<label class="control-label" for="id_kecelakaan" >ID kecelakaan</label>
					<div class="controls">
					<input type="text" id="id_kecelakaan" name="id_kecelakaan" value="<?php echo $id_kecelakaan; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="nama_kecelakaan" >Jenis Kecelakaan</label>
					<div class="controls">
					<input type="text" id="jenis_kecelakaan" name="jenis_kecelakaan" value="<?php echo $jenis_kecelakaan; ?>" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="keterangan" >Keterangan</label>
					<div class="controls">
					<textarea class="span12" id="keterangan" name="keterangan" value="<?php echo $keterangan; ?>" required><?php echo $keterangan; ?></textarea>
					</div>
				</div>
			</div>				
			</div>						
		</div>
		<div class="form-actions">
			<div class="span6">
				<div class="controls-group">
				<button type="submit" class="btn btn-primary">Edit</button>
				<button type="button" id="close" class="btn btn-primary" >Tutup</button>
				</div>
			</div>
			<div class="span6">
			<div class="control-group">
				<label class="control">Data Input :<?php echo "$created_by"; echo " - "; echo "$created_at"; ?> </label>
				<label class="control">Data Update :<?php echo "$updated_by"; echo " - "; echo "$updated_at"; ?> </label>
			</div>
		</div>
		<?php 
		}
		?>		
	</fieldset>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#close").click(function(){
			$("#form-nest").hide("slow");
		});
	});	
</script>