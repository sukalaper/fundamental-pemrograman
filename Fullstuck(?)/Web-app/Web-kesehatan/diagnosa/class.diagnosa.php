<?php

class diagnosa
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($nama_diagnosa,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO diagnosa(nama_diagnosa,created_by) VALUES (:nama_diagnosa, :created_by)");
			$query -> bindparam(":nama_diagnosa",$nama_diagnosa);
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
		$query = $this->db->prepare("SELECT * FROM diagnosa WHERE id_diagnosa=:id_diagnosa");
		$query->execute(array(":id_diagnosa"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id_diagnosa,$nama_diagnosa,$updated_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE diagnosa SET nama_diagnosa 		= :nama_diagnosa,
													   	updated_by 		= :updated_by
													WHERE id_diagnosa	= :id_diagnosa ");
			$query -> bindparam(":nama_diagnosa",$nama_diagnosa);
			$query -> bindparam(":updated_by",$updated_by);
			$query -> bindparam(":id_diagnosa",$id_diagnosa);
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
		$query = $this->db->prepare("DELETE FROM diagnosa WHERE id_diagnosa=:id_diagnosa");
		$query->bindparam(":id_diagnosa",$id);
		$query->execute();
		return true;
	}

	public function select($query){
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
                <td><?php print($row['nama_diagnosa']); ?></td>
                <td><div align="center">
                <?php echo "                
                <a href='javascript:void(0)' onclick=\"editData('$row[id_diagnosa]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i>Edit </a>
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_diagnosa]','$row[nama_diagnosa]')\" ><i class='icon-trash icon-red bigger-130'></i></i>Hapus </a>
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
					} );
				} );
			</script><?php 
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
           		<td></td>
            </tr>
            <?php
		}		
	}
	
	
	
}
