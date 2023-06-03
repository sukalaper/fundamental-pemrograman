<?php
session_start();
require_once '../config/koneksi.php';
require_once '../config/fungsi_sqltgl.php';
require_once 'class.pelkes.php';
$pelkes = new pelkes($pdo);
if(!empty($_POST['nama_korban'])){
	$nama_korban	= $_POST['nama_korban'];
	$tgl_pemeriksaan= tgl_sql($_POST['tgl_pemeriksaan']);
	$alamat_korban 	= $_POST['alamat_korban'];
	$jenis_kelamin	= $_POST['jenis_kelamin'];
	$umur 	 	 	= $_POST['umur'];
	$id_rujuk 	 	= $_POST['id_rujuk'];
	$id_diagnosa 	= $_POST['id_diagnosa'];
	$tindakan 	 	= $_POST['tindakan'];
	$created_by 	= $_SESSION['s_user'];
	$id_poskotis 	= $_SESSION['id_poskotis'];
	$kondisi 	 	= $_POST['kondisi'];
	if($pelkes->create($nama_korban,$tgl_pemeriksaan,$alamat_korban,$jenis_kelamin,$umur,$id_rujuk,$id_diagnosa,$tindakan,$created_by,$id_poskotis,$kondisi)){
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
		<legend>Tambah Data Pasien</legend>
		<span>
		<?php
		if(isset($sg) and $sg=='ok'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg1
			</div>";
        }elseif(isset($sg) and $sg=='err')
		{
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg2
			</div>"; 
		}
		?>
		</span>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
				<label class="control-label" for="tgl_pemeriksaan">Tanggal Pemeriksaan</label>
				<div class="controls">
				<div class="row-fluid input-append">
					<input class="span5 date-picker" required id="tgl_pemeriksaan" name="tgl_pemeriksaan" type="text" autocomplete="off" data-date-format="dd-mm-yyyy" />
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="nama_korban" >Nama Pasien</label>
					<div class="controls">
					<input type="text" id="nama_korban" name="nama_korban" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="alamat_korban" >Alamat Pasien</label>
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
				<label class="control-label" for="id_diagnosa" > Penyakit</label>
				<div class="controls">
				<select name="id_diagnosa" id="id_diagnosa" class="chzn-select" data-placeholder="Pilih Penyakit............." >
					<option value="" />
					<?php
							
						$query = "SELECT * FROM diagnosa";		
						$pelkes->selectDiagnosa($query);
					?>
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
				<label class="control-label" for="kondisi" >Kondisi</label>
				<div class="controls">
				<select name="kondisi" id="kondisi" class="chzn-select" data-placeholder="Pilih Kondisi............." required>
					<option value=""></option>
					<option value="Rawat Jalan">Rawat Jalan</option>
					<option value="Meninggal">Meninggal</option>
				</select>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="id_rujuk" > Rujuk Ke</label>
				<div class="controls">
				<select name="id_rujuk" id="id_rujuk" class="chzn-select" data-placeholder="Pilih RS/Puskesmas............." >
					<option value="" />
					<?php
							
						$query = "SELECT * FROM rujuk";		
						$pelkes->selectRujuk($query);
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