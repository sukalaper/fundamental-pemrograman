<div class=" single_top">
	<?php 
	include 'config/database.php';
	$id_produk=addslashes(trim($_GET['id']));
	$hasil=mysqli_query($kon,"select * from produk where id_produk='$id_produk' limit 1");
	$cek = mysqli_num_rows($hasil);

	if ($cek<=0){
		echo "<center><h3>Maaf. Produk yang dicari tidak tersedia!</h3></center>";
		exit;
	}


	$data = mysqli_fetch_array($hasil);

?>
	<div class="single_grid">
		<div class="grid images_3_of_2">
				<ul id="etalage">
					<li>
						<a href="optionallink.html">
							<img class="etalage_thumb_image" src="admin/pages/produk/gambar/<?php echo $data['gambar'];?>" class="img-responsive" />
							<img class="etalage_source_image" src="admin/pages/produk/gambar/<?php echo $data['gambar'];?>" class="img-responsive" title="" />
						</a>
					</li>
				</ul>
					<div class="clearfix"> </div>		
			</div> 
		<div class="desc1 span_3_of_2">
			<form method="get" action="">
				<h4><?php echo $data['nama_produk'];?></h4>
				<div class="cart-b">
					<div class="left-n ">Rp. <?php echo number_format($data['harga'],0,',','.'); ?></div>
					<input type="submit" id="masukan_keranjang" class="btn btn-danger now-get get-cart-in" value="MASUKAN KERANJANG">
					<div class="clearfix"></div>
				</div>
				<div class="alert alert-danger" id="notifikasi">Jumlah beli tidak boleh melebihi stok produk.</div>
				<div class="input-group">
					<span class="input-group-addon">Jumlah</span>
					<input  type="text" name="jumlah" id="jumlah" onkeypress="return event.charCode != 32" class="form-control"   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Masukan jumlah beli" required>
				</div>
				<div class="input-group">
					<input type="hidden" name="page" value="keranjang-belanja" />
					<input type="hidden" name="kode_produk" value="<?php echo $data['kode_produk'];?>"/>
					<input type="hidden" name="aksi" value="tambah_produk"/>
				</div>
				<br>
				<span class="badge badge-pill badge-success"><?php echo $data['stok'];?> Stok Tersedia</span>

				<input type="hidden" id="stok" value="<?php echo $data['stok'];?>"/>
		
				<p><br><?php echo $data['keterangan'];?></p>
			
			
			</form>
		</div>
		<div class="clearfix"> </div>
		</div>
	</div>
	
	<!---->
	<?php include 'kategori.php';?>

<div class="clearfix"> </div>

<script>
    $(document).ready(function(){
		$('#notifikasi').hide();
    });
</script>

<script>
    $('#jumlah').bind('keyup', function () {
		validasi();
    }); 

	$('#jumlah').bind('change', function () {
		validasi();
    });


	function validasi(){
		var jumlah = parseInt($("#jumlah").val());
		var stok = parseInt($("#stok").val());

		if (jumlah>stok){
			$('#notifikasi').show(400);
			document.getElementById("masukan_keranjang").disabled = true;
		}else {
			$('#notifikasi').hide(400);
			document.getElementById("masukan_keranjang").disabled = false;
		}
	}
</script>