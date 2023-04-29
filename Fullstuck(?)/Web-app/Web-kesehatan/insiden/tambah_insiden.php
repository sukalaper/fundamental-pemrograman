<?php
session_start();
require_once '../config/koneksi.php';
require_once '../config/fungsi_sqltgl.php';
require_once 'class.insiden.php';
$insiden = new insiden($pdo);
if(!empty($_POST['id_kecelakaan'])){
	$id_kecelakaan 	= $_POST['id_kecelakaan'];
	$tgl_insiden	= tgl_sql($_POST['tgl_insiden']);
	$jam 		 	= $_POST['jam'];
	$alamat_insiden	= $_POST['alamat_insiden'];
	$created_by 	= $_SESSION['s_user'];
	$id_poskotis 	= $_SESSION['id_poskotis'];
	if($insiden->create($id_kecelakaan,$tgl_insiden,$jam,$alamat_insiden,$created_by,$id_poskotis)){
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
		<legend>Tambah Data</legend>
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
				<label class="control-label" for="id_kecelakaan" > Jenis Kecelakaan</label>
				<div class="controls">
				<select name="id_kecelakaan" id="id_kecelakaan" class="chzn-select" data-placeholder="Pilih jenis kecelakaan............." required>
					<option value="" />
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
					<input class="span5 date-picker" required id="tgl_insiden" name="tgl_insiden" type="text" autocomplete="off" data-date-format="dd-mm-yyyy" />
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="jam" >Jam</label>
					<div class="controls">
					<input type="text" class="span3" id="jam" name="jam" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="alamat_insiden" >Lokasi Kejadian</label>
					<div class="controls">
					<textarea class="span12" id="alamat_insiden" name="alamat_insiden" required></textarea>
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
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	$(".chzn-select").chosen(); 
</script>