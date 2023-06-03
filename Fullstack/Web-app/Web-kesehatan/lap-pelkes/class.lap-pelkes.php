<?php

class lap_pelkes
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function VLap(){
		$query = $this->db->prepare("SELECT * FROM diagnosa");
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				$a = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($a>0){ $a; }else{ $a=""; } ;
				$b = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($b>0){ $b; }else{ $b=""; } ;
				$c = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($c>0){ $c; }else{ $c=""; } ;
				$d = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($d>0){ $d; }else{ $d=""; } ;
				$e = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' ")->fetchColumn(); if ($e>0){ $e; }else{ $e=""; } ;
				$f = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and kondisi='Meninggal' ")->fetchColumn(); if ($f>0){ $f; }else{ $f=""; } ;
				$g = $this->db->query("select count(pelkes.id_rujuk) FROM pelkes INNER JOIN rujuk ON pelkes.id_rujuk = rujuk.id_rujuk WHERE id_diagnosa='$row[id_diagnosa]' and rujuk.inisial='a' GROUP BY pelkes.id_rujuk  ")->fetchColumn(); if ($g>0){ $g; }else{ $g=""; } ;
				$h = $this->db->query("select count(pelkes.id_rujuk) FROM pelkes INNER JOIN rujuk ON pelkes.id_rujuk = rujuk.id_rujuk WHERE id_diagnosa='$row[id_diagnosa]' and rujuk.inisial='b' GROUP BY pelkes.id_rujuk ")->fetchColumn(); if ($h>0){ $h; }else{ $h=""; } ;
				$i = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and kondisi='Rawat Jalan' ")->fetchColumn(); if ($i>0){ $i; }else{ $i=""; } ;
				?>
                <tr>
                <td><div align="center"><?php print($no); ?></div></td>
                <td><?php print($row['nama_diagnosa']); ?></td>
                <td><div align="center"><?php print($a); ?></div></td>
                <td><div align="center"><?php print($b); ?></div></td>
                <td><div align="center"><?php print($c); ?></div></td>
                <td><div align="center"><?php print($d); ?></div></td>
                <td><div align="center"><?php print($e); ?></div></td>
                <td><div align="center"><?php print($f); ?></div></td>
                <td><div align="center"><?php print($g); ?></div></td>
                <td><div align="center"><?php print($h); ?></div></td>
                <td><div align="center"><?php print($i); ?></div></td>
             	<?php $no++;
            }
        }
	}
	public function VLap1(){
		$query = $this->db->prepare("SELECT * FROM diagnosa");
		$query->execute();
		$no = 1;
		$ses=$_SESSION['id_poskotis'];
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				$a = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and jenis_kelamin='L' and umur<5 and id_poskotis=$ses ")->fetchColumn(); if ($a>0){ $a; }else{ $a=""; } ;
				$b = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and jenis_kelamin='P' and umur<5 and id_poskotis='$ses' ")->fetchColumn(); if ($b>0){ $b; }else{ $b=""; } ;
				$c = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and jenis_kelamin='L' and umur>=5 and id_poskotis='$ses' ")->fetchColumn(); if ($c>0){ $c; }else{ $c=""; } ;
				$d = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and jenis_kelamin='P' and umur>=5 and id_poskotis='$ses' ")->fetchColumn(); if ($d>0){ $d; }else{ $d=""; } ;
				$e = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and id_poskotis='$ses' ")->fetchColumn(); if ($e>0){ $e; }else{ $e=""; } ;
				$f = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and kondisi='Meninggal' and id_poskotis='$ses' ")->fetchColumn(); if ($f>0){ $f; }else{ $f=""; } ;
				$g = $this->db->query("select count(pelkes.id_rujuk) FROM pelkes INNER JOIN rujuk ON pelkes.id_rujuk = rujuk.id_rujuk WHERE id_diagnosa='$row[id_diagnosa]' and rujuk.inisial='a' and id_poskotis='$ses' GROUP BY pelkes.id_rujuk  ")->fetchColumn(); if ($g>0){ $g; }else{ $g=""; } ;
				$h = $this->db->query("select count(pelkes.id_rujuk) FROM pelkes INNER JOIN rujuk ON pelkes.id_rujuk = rujuk.id_rujuk WHERE id_diagnosa='$row[id_diagnosa]' and rujuk.inisial='b' and id_poskotis='$ses' GROUP BY pelkes.id_rujuk ")->fetchColumn(); if ($h>0){ $h; }else{ $h=""; } ;
				$i = $this->db->query("select count(*) from pelkes WHERE id_diagnosa='$row[id_diagnosa]' and kondisi='Rawat Jalan' and id_poskotis='$ses' ")->fetchColumn(); if ($i>0){ $i; }else{ $i=""; } ;
				?>
                <tr>
                <td><div align="center"><?php print($no); ?></div></td>
                <td><?php print($row['nama_diagnosa']); ?></td>
                <td><div align="center"><?php print($a); ?></div></td>
                <td><div align="center"><?php print($b); ?></div></td>
                <td><div align="center"><?php print($c); ?></div></td>
                <td><div align="center"><?php print($d); ?></div></td>
                <td><div align="center"><?php print($e); ?></div></td>
                <td><div align="center"><?php print($f); ?></div></td>
                <td><div align="center"><?php print($g); ?></div></td>
                <td><div align="center"><?php print($h); ?></div></td>
                <td><div align="center"><?php print($i); ?></div></td>
             	<?php $no++;
            }
        }
	}
} 