<?php 
	session_start();
	include_once '../config/koneksi.php';
	require_once '../diagnosa/class.diagnosa.php';
	$diag = new diagnosa($pdo);
	if(!empty($_POST['id_diagnosa'])){
		$id_diagnosa = $_POST['id_diagnosa'];
		$nama_diagnosa 	= $_POST['nama_diagnosa'];
		$updated_by	= $_SESSION['s_user'];
		if($diag->update($id_diagnosa,$nama_diagnosa,$updated_by)){
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
		<legend>Edit Penyakit</legend>
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
		if(isset($_GET['id_diagnosa']))
		{
			$id = $_GET['id_diagnosa'];
			extract($diag->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div class="control-group">
				<label class="control-label" for="id_diagnosa" >ID</label>
				<div class="controls">
				<input type="text" id="id_diagnosa" name="id_diagnosa" value="<?php echo $id_diagnosa; ?>" readonly="readonly">
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="diagnosa" >Penyakit</label>
				<div class="controls">
				<input type="text" id="nama_diagnosa" name="nama_diagnosa" value="<?php echo $nama_diagnosa ?>" autocomplete="off">
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