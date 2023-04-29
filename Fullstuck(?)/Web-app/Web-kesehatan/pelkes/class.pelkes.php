<?php

class pelkes
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($nama_korban,$tgl_pemeriksaan,$alamat_korban,$jenis_kelamin,$umur,$id_rujuk,$id_diagnosa,$tindakan,$created_by,$id_poskotis,$kondisi)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO pelkes(nama_korban,tgl_pemeriksaan,alamat_korban,jenis_kelamin,umur,id_rujuk,id_diagnosa,tindakan,created_by,id_poskotis,kondisi) VALUES (:nama_korban, :tgl_pemeriksaan, :alamat_korban, :jenis_kelamin, :umur, :id_rujuk, :id_diagnosa, :tindakan, :created_by, :id_poskotis, :kondisi)");
			$query -> bindparam(":nama_korban",$nama_korban);			
			$query -> bindparam(":tgl_pemeriksaan",$tgl_pemeriksaan);
			$query -> bindparam(":alamat_korban",$alamat_korban);
			$query -> bindparam(":jenis_kelamin",$jenis_kelamin);
			$query -> bindparam(":umur",$umur);
			$query -> bindparam(":id_rujuk",$id_rujuk);
			$query -> bindparam(":id_diagnosa",$id_diagnosa);
			$query -> bindparam(":tindakan",$tindakan);
			$query -> bindparam(":created_by",$created_by);
			$query -> bindparam(":id_poskotis",$id_poskotis);			
			$query -> bindparam(":kondisi",$kondisi);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}	
	
	public function getID($id)
	{
		$query = $this->db->prepare("   SELECT
										pelkes.id_pelkes,
										pelkes.nama_korban,
										pelkes.tgl_pemeriksaan,
										pelkes.alamat_korban,
										pelkes.jenis_kelamin,
										pelkes.umur,
										pelkes.id_rujuk,
										pelkes.id_diagnosa,
										pelkes.tindakan,
										pelkes.created_by,
										pelkes.created_at,
										pelkes.updated_by,
										pelkes.updated_at,
										pelkes.id_poskotis,
										pelkes.kondisi,
										diagnosa.nama_diagnosa,
										rujuk.nama_rujuk
										FROM
										pelkes
										INNER JOIN diagnosa ON pelkes.id_diagnosa = diagnosa.id_diagnosa
										INNER JOIN rujuk ON pelkes.id_rujuk = rujuk.id_rujuk 
										WHERE pelkes.id_pelkes=:id_pelkes");
		$query->execute(array(":id_pelkes"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function grafik($query)
	{		
		$query = $this->db->prepare($query);
		$query->execute();		
		while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
                        $data   =$row['nama_diagnosa'];
                        $jumlah =$row['COUNT(pelkes.id_diagnosa)'];

                ?>
                 {
                    name:  '<?php echo $data; ?>',
                    data: [<?php echo $jumlah; ?>]

                 },
               <?php
          } 
	}
	
	public function update($id_pelkes,$nama_korban,$tgl_pemeriksaan,$alamat_korban,$jenis_kelamin,$umur,$id_rujuk,$id_diagnosa,$tindakan,$updated_by,$id_poskotis,$kondisi)
	{
		try
		{
			$query=$this->db->prepare("UPDATE pelkes SET 	nama_korban 		= :nama_korban,
															tgl_pemeriksaan 	= :tgl_pemeriksaan,
															alamat_korban  		= :alamat_korban,
															jenis_kelamin 		= :jenis_kelamin,
															umur 				= :umur,
															id_rujuk 			= :id_rujuk,
															id_diagnosa 		= :id_diagnosa,
															tindakan 			= :tindakan,
													 		updated_by 			= :updated_by,
													 		id_poskotis 		= :id_poskotis,
													 		kondisi 			= :kondisi
													WHERE 	id_pelkes			= :id_pelkes ");
			$query -> bindparam(":nama_korban",$nama_korban);			
			$query -> bindparam(":tgl_pemeriksaan",$tgl_pemeriksaan);
			$query -> bindparam(":alamat_korban",$alamat_korban);
			$query -> bindparam(":jenis_kelamin",$jenis_kelamin);
			$query -> bindparam(":umur",$umur);
			$query -> bindparam(":id_rujuk",$id_rujuk);
			$query -> bindparam(":id_diagnosa",$id_diagnosa);
			$query -> bindparam(":tindakan",$tindakan);
			$query -> bindparam(":updated_by",$updated_by);
			$query -> bindparam(":id_pelkes",$id_pelkes);
			$query -> bindparam(":id_poskotis",$id_poskotis);			
			$query -> bindparam(":kondisi",$kondisi);
			$query -> execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM pelkes WHERE id_pelkes=:id_pelkes");
		$query->bindparam(":id_pelkes",$id);
		$query->execute();
		return true;
	}

	public function selectKecelakaan($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_kecelakaan]'>$row[jenis_kecelakaan]</option>";
		}
		
	}

	public function selectRujuk($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_rujuk]'>$row[id_rujuk] - $row[nama_rujuk]</option>";
		}
		
	}

	public function selectDiagnosa($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_diagnosa]'>$row[nama_diagnosa]</option>";
		}
		
	}

	public function view($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print(tgl_indo($row['tgl_pemeriksaan'])); ?></td>
                <td><?php print($row['nama_korban']); ?></td>
                <td><?php print($row['alamat_korban']); ?></td>
                <td><?php print($row['umur']); ?></td>
                <td><?php print($row['jenis_kelamin']); ?></td>
                <td><?php print($row['nama_diagnosa']); ?></td>
                <td><?php print($row['tindakan']); ?></td>
                <td><?php print($row['nama_rujuk']); ?></td>
                <td><div align="center">
                <?php echo "           
                <a href='javascript:void(0)' onclick=\"editData('$row[id_pelkes]')\" ><i class='icon-pencil bigger-130'></i></a> 
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_pelkes]','$row[nama_korban]')\" ><i class='icon-trash icon-red bigger-130'></i></a>
                ";?>
                </div>
                </td>
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable( {
						"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
						"sPaginationType": "bootstrap",
						"oLanguage":{
							"sProcessing": "Sedang Memproses",
							"sLengthMenu": "Tampilkan _MENU_ entri",
							"sZeroRecords": "Tidak ditemukan data yang sesuai",
							"sInfo": "_START_ sampai _END_ dari _TOTAL_ entri",
							"sInfoEmpty": "0 sampai 0 dari 0 entri",
							"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
							"sInfoPostFix": "",
							"sSearch": "Cari",
							"sUrl": "",							
						}
					});
				});
				
			</script><?php 
		}
		else
		{
			?>
            <tr>
            	<td><strong>Tidak ada data...!!</strong></td>
           		<td></td>
           		<td></td>
           		<td></td>
           		<td></td>
           		<td></td>
           		<td></td>
            </tr>
            <?php
		}		
	}
} 