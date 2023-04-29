<?php

class insiden
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($id_kecelakaan,$tgl_insiden,$jam,$alamat_insiden,$created_by,$id_poskotis)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO insiden(id_kecelakaan,tgl_insiden,jam,alamat_insiden,created_by,id_poskotis) VALUES (:id_kecelakaan, :tgl_insiden, :jam, :alamat_insiden, :created_by, :id_poskotis)");
			$query -> bindparam(":id_kecelakaan",$id_kecelakaan);
			$query -> bindparam(":tgl_insiden",$tgl_insiden);			
			$query -> bindparam(":jam",$jam);
			$query -> bindparam(":alamat_insiden",$alamat_insiden);
			$query -> bindparam(":created_by",$created_by);
			$query -> bindparam(":id_poskotis",$id_poskotis);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function createdetail($id_insiden,$nama_korban,$alamat_korban,$jenis_kelamin,$umur,$kondisi,$id_rujuk,$tindakan,$rawat,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO detail_insiden(id_insiden,nama_korban,alamat_korban,jenis_kelamin,umur,kondisi,id_rujuk,tindakan,rawat,created_by) VALUES (:id_insiden, :nama_korban, :alamat_korban, :jenis_kelamin, :umur, :kondisi, :id_rujuk, :tindakan, :rawat, :created_by)");
			$query -> bindparam(":id_insiden",$id_insiden);
			$query -> bindparam(":nama_korban",$nama_korban);			
			$query -> bindparam(":alamat_korban",$alamat_korban);
			$query -> bindparam(":jenis_kelamin",$jenis_kelamin);
			$query -> bindparam(":umur",$umur);
			$query -> bindparam(":kondisi",$kondisi);
			$query -> bindparam(":id_rujuk",$id_rujuk);
			$query -> bindparam(":tindakan",$tindakan);
			$query -> bindparam(":rawat",$rawat);
			$query -> bindparam(":created_by",$created_by);
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
										insiden.id_insiden,
										insiden.tgl_insiden,
										kecelakaan.jenis_kecelakaan,
										insiden.jam,
										insiden.alamat_insiden,
										insiden.created_by,
										insiden.updated_by,
										insiden.created_at,
										insiden.updated_at
										FROM
										insiden
										INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_insiden=:id_insiden");
		$query->execute(array(":id_insiden"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function grafik($query)
	{		
		$query = $this->db->prepare($query);
		$query->execute();		
		while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
                        $data   =$row['jenis_kecelakaan'];
                        $jumlah =$row['COUNT(insiden.id_kecelakaan)'];

                ?>
                 {
                    name:  '<?php echo $data; ?>',
                    data: [<?php echo $jumlah; ?>]

                 },
               <?php
          } 
	}
	
	public function update($id_insiden,$id_kecelakaan,$tgl_insiden,$jam,$alamat_insiden,$updated_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE insiden SET 	id_kecelakaan 		= :id_kecelakaan,
															tgl_insiden 		= :tgl_insiden,
															jam  				= :jam,
															alamat_insiden 		= :alamat_insiden,
													 		updated_by 			= :updated_by
													WHERE 	id_insiden			= :id_insiden ");
			$query -> bindparam(":id_kecelakaan",$id_kecelakaan);
			$query -> bindparam(":tgl_insiden",$tgl_insiden);
			$query -> bindparam(":jam",$jam);
			$query -> bindparam(":alamat_insiden",$alamat_insiden);
			$query -> bindparam(":updated_by",$updated_by);
			$query -> bindparam(":id_insiden",$id_insiden);
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
		$query = $this->db->prepare("DELETE FROM insiden WHERE id_insiden=:id_insiden");
		$query->bindparam(":id_insiden",$id);
		$query->execute();
		return true;
	}

	public function deleteDetail($id)
	{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM detail_insiden WHERE id_detail_insiden=:id_detail_insiden");
		$query->bindparam(":id_detail_insiden",$id);
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
                <td><?php print(tgl_indo($row['tgl_insiden'])); ?></td>
                <td><?php print($row['jenis_kecelakaan']); ?></td>
                <td><?php print($row['jam']); ?></td>
                <td><?php print($row['alamat_insiden']); ?></td>
                <td><div align="center">
                <?php echo "
                <a href='javascript:void(0)' onclick=\"tambahkorban('$row[id_insiden]')\" ><i class='icon-plus bigger-130'></i></a>
                <a href='javascript:void(0)' onclick=\"detail('$row[id_insiden]')\" ><i class='icon-search bigger-130'></i></a>            
                <a href='javascript:void(0)' onclick=\"editData('$row[id_insiden]')\" ><i class='icon-pencil bigger-130'></i></a> 
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_insiden]','$row[jenis_kecelakaan]')\" ><i class='icon-trash icon-red bigger-130'></i></a>
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

	public function viewDetail($query)
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
                <td><?php print($row['nama_korban']); ?></td>
                <td><?php print($row['alamat_korban']); ?></td>
                <td><?php print($row['jenis_kelamin']); ?></td>
                <td><?php print($row['umur']); ?></td>
                <td><?php print($row['kondisi']); ?></td>
                <td><?php print($row['nama_rujuk']); ?></td>
                <td><?php print($row['tindakan']); ?></td>
                <td><div align="center">
                <?php echo "           
                
                <a href='javascript:void(0)' onclick=\"deleteDetail('$row[id_detail_insiden]','$row[nama_korban]')\" ><i class='icon-trash icon-red bigger-130'></i></a>
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