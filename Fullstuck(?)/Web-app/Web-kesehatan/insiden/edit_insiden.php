<?php 
	session_start();
	include_once '../config/koneksi.php';
	include_once '../config/fungsi_sqltgl.php';
	require_once 'class.insiden.php';
	$insiden = new insiden($pdo);
	if(!empty($_POST['id_insiden'])){
		$id_insiden 	= $_POST['id_insiden'];
		$id_kecelakaan 	= $_POST['id_kecelakaan'];
		$tgl_insiden	= tgl_sql($_POST['tgl_insiden']);
		$jam 		 	= $_POST['jam'];
		$alamat_insiden	= $_POST['alamat_insiden'];
		$updated_by		= $_SESSION['s_user'];
		if($insiden->update($id_insiden,$id_kecelakaan,$tgl_insiden,$jam,$alamat_insiden,$updated_by)){
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
		if(isset($_GET['id_insiden']))
		{
			$id = $_GET['id_insiden'];
			extract($insiden->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div class="control-group">
				<label class="control-label" for="id_insiden" >ID</label>
				<div class="controls">
				<input type="text" id="id_insiden" name="id_insiden" value="<?php echo $id_insiden; ?>" readonly="readonly">
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="id_kecelakaan" > Jenis Kecelakaan</label>
				<div class="controls">
				<select name="id_kecelakaan" id="id_kecelakaan" class="chzn-select" data-placeholder="Pilih jenis kecelakaan............." required>
					<option value="<?php echo $id_kecelakaan; ?>"><?php echo $jenis_kecelakaan; ?></option>
					<?php
						
						$query = "SELECT * FROM kecelakaan";		
						$insiden->selectKecelakaan($query);
					?>
				</select>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="tgl_insiden">Tanggal</label>
				<div class="controls">
				<div class="row-fluid input-append">
					<input class="span5 date-picker" value="<?php echo tgl_sql1($tgl_insiden); ?>" required id="tgl_insiden" name="tgl_insiden" type="text" autocomplete="off" data-date-format="dd-mm-yyyy" />
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="jam" >Jam</label>
					<div class="controls">
					<input type="text" value="<?php echo $jam; ?>" class="span3" id="jam" name="jam" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="alamat_insiden" >Alamat</label>
					<div class="controls">
					<textarea class="span12" id="alamat_insiden" value="<?php echo $alamat_insiden; ?>" name="alamat_insiden" required><?php echo $alamat_insiden; ?></textarea>
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
	$(".chzn-select").chosen(); 
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
</script>