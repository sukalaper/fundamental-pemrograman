<?php
	session_start();
	include '../../config/database.php';
	$hasil=mysqli_query($kon,"select kabupaten from profil_aplikasi limit 1");
	$data = mysqli_fetch_array($hasil);

	$asal = $data['kabupaten'];
	$id_kabupaten = $_POST['kab_id'];
	$kurir = $_POST['kurir'];
	$berat = $_SESSION["total_berat"];

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$id_kabupaten."&weight=".$berat."&courier=".$kurir."",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key:81d4424e2b099f8b8ea33708087f4b8c"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  $data = json_decode($response, true);
	}
	?>
	<?php
	 for ($k=0; $k < count($data['rajaongkir']['results']); $k++) {
	?>
		 <div title="<?php echo strtoupper($data['rajaongkir']['results'][$k]['name']);?>" style="padding:10px">
			 <table class="table table-striped table-bordered">
				 <tr>
					 <th>No.</th>
					 <th>Jenis Layanan</th>
					 <th>ETD</th>
					 <th>Tarif</th>
					 <th>Pilih</th>
				 </tr>
				 <?php
	
				 for ($l=0; $l < count($data['rajaongkir']['results'][$k]['costs']); $l++) {
				 ?>
				 <tr>
					 <td><?php echo $l+1;?></td>
					 <td>
						 <div style="font:bold 16px Arial"><?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['service'];?></div>
						 <div style="font:normal 11px Arial"><?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['description'];?></div>
					 </td>
					 <td align="center">&nbsp;<?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['etd'];?> hari</td>
					 <td align="right"><?php echo number_format($data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']);?></td>
					 <td>
					
						 <div class="radio">
  							<label><input type="radio" provinsi="<?php echo $data['rajaongkir']['destination_details']['province'];?>" kab="<?php echo $data['rajaongkir']['destination_details']['city_name'];?>" tarif="<?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']; ?>" jenis_layanan="<?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['description'];?>" estimasi_waktu="<?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['etd'];?>" name="pilih_ongkir" class="pilih_ongkir" ></label>
						</div>
					</td>
				 </tr>
				 <?php
				 }
				 ?>
			 </table>
		 </div>
	 <?php
	}
	?>
    <?php 
		if(!empty($_SESSION["potongan"])){
			$potongan=$_SESSION["potongan"];
		}else {
			$potongan=0;
		}
    ?>
<input type="hidden" id="potongan" value="<?php echo $potongan; ?>" />

<script type="text/javascript">
	$('.pilih_ongkir').on('click',function(){
		var jenis_layanan = $(this).attr("jenis_layanan");
		var estimasi_waktu = $(this).attr("estimasi_waktu");
		var provinsi = $(this).attr("provinsi");
		var kab = $(this).attr("kab");
		var tarif = parseInt($(this).attr("tarif"));
		var total_harga_produk=parseInt($("#total_harga_produk").val());
		var potongan=parseInt($("#potongan").val());
		var total_bayar = ((total_harga_produk+tarif)-potongan);
	
		$('#get_tarif').val(tarif);
		$('#get_jenis_layanan').val(jenis_layanan);
		$('#get_estimasi_waktu').val(estimasi_waktu);
		$('#get_provinsi').val(provinsi);
		$('#get_kab').val(kab);
		$('#get_potongan').val(potongan);
		$('#tampil_potongan').text('Rp. '+format_rupiah(potongan));
		$('#tampil_ongkir').text('Rp. '+format_rupiah(tarif));
		$('#tampil_total_bayar').text('Rp. '+format_rupiah(total_bayar));


		
		if (total_bayar!=0){
			$("#buat_pesanan").prop('disabled', false);
		}
	});

	function format_rupiah(nominal){
        var  reverse = nominal.toString().split('').reverse().join(''),
             ribuan = reverse.match(/\d{1,3}/g);
         return ribuan	= ribuan.join('.').split('').reverse().join('');
    }
</script>

