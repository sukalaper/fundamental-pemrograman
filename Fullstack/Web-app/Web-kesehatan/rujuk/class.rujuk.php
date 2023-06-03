<?php

class rujuk
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($nama_rujuk,$alamat_rujuk,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO rujuk(nama_rujuk,alamat_rujuk,created_by) VALUES (:nama_rujuk, :alamat_rujuk, :created_by)");
			$query -> bindparam(":nama_rujuk",$nama_rujuk);
			$query -> bindparam(":alamat_rujuk",$alamat_rujuk);
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
		$query = $this->db->prepare("SELECT * FROM rujuk WHERE id_rujuk=:id_rujuk");
		$query->execute(array(":id_rujuk"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id_rujuk,$nama_rujuk,$alamat_rujuk,$updated_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE rujuk SET nama_rujuk 	= :nama_rujuk,
														alamat_rujuk= :alamat_rujuk,
													   	updated_by 	= :updated_by
													WHERE id_rujuk	= :id_rujuk ");
			$query -> bindparam(":nama_rujuk",$nama_rujuk);
			$query -> bindparam(":alamat_rujuk",$alamat_rujuk);
			$query -> bindparam(":updated_by",$updated_by);
			$query -> bindparam(":id_rujuk",$id_rujuk);
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
		$query = $this->db->prepare("DELETE FROM rujuk WHERE id_rujuk=:id_rujuk");
		$query->bindparam(":id_rujuk",$id);
		$query->execute();
		return true;
	}

	public function select($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_rujuk]'>$row[rujuk]</option>";
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
                <td><?php print($row['nama_rujuk']); ?></td>
                <td><?php print($row['alamat_rujuk']); ?></td>
                <td><div align="center">
                <?php echo "                
                <a href='javascript:void(0)' onclick=\"editData('$row[id_rujuk]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i>Edit </a>
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_rujuk]','$row[nama_rujuk]')\" ><i class='icon-trash icon-red bigger-130'></i></i>Hapus </a>
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
