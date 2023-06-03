<?php
session_start();
require_once '../config/koneksi.php';
require_once '../config/fungsi_sqltgl.php';
require_once 'class.insiden.php';
$insiden = new insiden($pdo);
if(!empty($_POST['id_insiden'])){
	$id_insiden 	= $_POST['id_insiden'];
	$nama_korban	= $_POST['nama_korban'];
	$alamat_korban 	= $_POST['alamat_korban'];
	$jenis_kelamin	= $_POST['jenis_kelamin'];
	$umur 	 	 	= $_POST['umur'];
	$kondisi 	 	= $_POST['kondisi'];
	$id_rujuk 	 	= $_POST['id_rujuk'];
	$rawat 		 	= $_POST['rawat'];	
	$tindakan 	 	= $_POST['tindakan'];
	$created_by 	= $_SESSION['s_user'];
	if($insiden->createdetail($id_insiden,$nama_korban,$alamat_korban,$jenis_kelamin,$umur,$kondisi,$id_rujuk,$tindakan,$rawat,$created_by)){
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
		<legend>Tambah Data Korban</legend>
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
			<div class="span5">
				<div class="control-group">
				<label class="control-label" for="id_insiden" >ID</label>
					<div class="controls">
					<input type="text" id="id_insiden" name="id_insiden" value="<?php echo $id_insiden; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="nama_korban" >Nama Korban</label>
					<div class="controls">
					<input type="text" id="nama_korban" name="nama_korban" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="alamat_korban" >Alamat Korban</label>
					<div class="controls">
					<textarea class="span12" id="alamat_korban" name="alamat_korban" required></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="jenis_kelamin" > Jenis Kelamin</label>
				<div class="controls">
				<select name="jenis_kelamin" id="jenis_kelamin" class="chzn-select" data-placeholder="Pilih jenis Kelamin............." required>
					<option value=""></option>
					<option value="L">Laki - Laki</option>
					<option value="P">Perempuan</option>
				</select>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="umur" >Umur</label>
					<div class="controls">
					<input type="text" class="span3" id="umur" name="umur" required>
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
				<label class="control-label" for="kondisi" >Kondisi</label>
				<div class="controls">
				<select name="kondisi" id="kondisi" class="chzn-select" data-placeholder="Pilih Kondisi............." required>
					<option value=""></option>
					<option value="Luka Ringan">Luka Ringan</option>
					<option value="Luka Sedang">Luka Sedang</option>
					<option value="Luka Berat">Luka Berat</option>
					<option value="Meninggal">Meninggal</option>
				</select>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="tindakan" >Tindakan</label>
					<div class="controls">
					<input type="text" id="tindakan" name="tindakan">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="rawat" >Rawat Jalan</label>
				<div class="controls">
				<select name="rawat" id="rawat" class="chzn-select" data-placeholder="Pilih Rawat Jalan............." required>
					<option value=""></option>
					<option value="Y">Y</option>
					<option value="T">T</option>
				</select>
				</div>
				</div>
				<!--
				<div class="control-group">
				<label class="control-label" for="id_diagnosa" > Penyakit</label>
				<div class="controls">
				<select name="id_diagnosa" id="id_diagnosa" class="chzn-select" data-placeholder="Pilih Penyakit............." >
					<option value="" />
					<?php
							
						$query = "SELECT * FROM diagnosa";		
						$insiden->selectDiagnosa($query);
					?>
				</select>
				</div>
				</div>
				-->
				<div class="control-group">
				<label class="control-label" for="id_rujuk" > Rujuk Ke</label>
				<div class="controls">
				<select name="id_rujuk" id="id_rujuk" class="chzn-select" data-placeholder="Pilih RS/Puskesmas............." >
					<option value="" />
					<?php
							
						$query = "SELECT * FROM rujuk";		
						$insiden->selectRujuk($query);
					?>
				</select>
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
		<?php } ?>
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