<?php 
	session_start();
	include_once '../config/koneksi.php';
	require_once '../rujuk/class.rujuk.php';
	$rujuk = new rujuk($pdo);
	if(!empty($_POST['id_rujuk'])){
		$id_rujuk		= $_POST['id_rujuk'];
		$nama_rujuk		= $_POST['nama_rujuk'];
		$alamat_rujuk	= $_POST['alamat_rujuk'];
		$updated_by		= $_SESSION['s_user'];
		if($rujuk->update($id_rujuk,$nama_rujuk,$alamat_rujuk,$updated_by)){
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
		<legend>Edit RS / Puskesmas</legend>
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
		if(isset($_GET['id_rujuk']))
		{
			$id = $_GET['id_rujuk'];
			extract($rujuk->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div class="control-group">
				<label class="control-label" for="id_rujuk" >ID rujuk</label>
					<div class="controls">
					<input type="text" id="id_rujuk" name="id_rujuk" value="<?php echo $id_rujuk; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="nama_rujuk" >Nama RS/Puskesmas</label>
					<div class="controls">
					<input type="text" id="nama_rujuk" name="nama_rujuk" value="<?php echo $nama_rujuk; ?>" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="alamat_rujuk" >Alamat</label>
					<div class="controls">
					<textarea class="span12" id="alamat_rujuk" name="alamat_rujuk" value="<?php echo $alamat_rujuk; ?>" required><?php echo $alamat_rujuk; ?></textarea>
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