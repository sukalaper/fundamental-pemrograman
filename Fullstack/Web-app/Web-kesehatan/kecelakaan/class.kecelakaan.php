<?php

class kecelakaan
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($jenis_kecelakaan,$keterangan,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO kecelakaan(jenis_kecelakaan,keterangan,created_by) VALUES (:jenis_kecelakaan, :keterangan, :created_by)");
			$query -> bindparam(":jenis_kecelakaan",$jenis_kecelakaan);
			$query -> bindparam(":keterangan",$keterangan);
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
		$query = $this->db->prepare("SELECT * FROM kecelakaan WHERE id_kecelakaan=:id_kecelakaan");
		$query->execute(array(":id_kecelakaan"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id_kecelakaan,$jenis_kecelakaan,$keterangan,$updated_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE kecelakaan SET jenis_kecelakaan 	= :jenis_kecelakaan,
															 keterangan 		= :keterangan,
													   		 updated_by 		= :updated_by
													WHERE id_kecelakaan	= :id_kecelakaan ");
			$query -> bindparam(":jenis_kecelakaan",$jenis_kecelakaan);
			$query -> bindparam(":keterangan",$keterangan);
			$query -> bindparam(":updated_by",$updated_by);
			$query -> bindparam(":id_kecelakaan",$id_kecelakaan);
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
		$query = $this->db->prepare("DELETE FROM kecelakaan WHERE id_kecelakaan=:id_kecelakaan");
		$query->bindparam(":id_kecelakaan",$id);
		$query->execute();
		return true;
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
                <td><?php print($row['jenis_kecelakaan']); ?></td>
                <td><?php print($row['keterangan']); ?></td>
                <td><div align="center">
                <?php echo "                
                <a href='javascript:void(0)' onclick=\"editData('$row[id_kecelakaan]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i>Edit </a>
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_kecelakaan]','$row[jenis_kecelakaan]')\" ><i class='icon-trash icon-red bigger-130'></i></i>Hapus </a>
                ";?>
                </div>
                </td>
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript">
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
					} );
				} );
			</script><?php 
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}
	
	
	
}
