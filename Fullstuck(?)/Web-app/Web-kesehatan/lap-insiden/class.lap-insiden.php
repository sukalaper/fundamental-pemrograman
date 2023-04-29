<?php

class lap_insiden
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function VLap1(){
		$query = $this->db->prepare("SELECT * FROM  kecelakaan");
		$query->execute();
		$no = 1;
		$ses=$_SESSION['id_poskotis'];
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				$a = $this->db->query("SELECT COUNT(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.jenis_kelamin = 'L' AND detail_insiden.umur < 5 AND insiden.id_poskotis ='$ses'")->fetchColumn(); if ($a>0){ $a; }else{ $a=""; } ;
				$b = $this->db->query("SELECT COUNT(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.jenis_kelamin = 'P' AND detail_insiden.umur < 5 and insiden.id_poskotis ='$ses'")->fetchColumn(); if ($b>0){ $b; }else{ $b=""; } ;
				$c = $this->db->query("SELECT COUNT(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.jenis_kelamin = 'L' AND detail_insiden.umur >= 5 and insiden.id_poskotis ='$ses'")->fetchColumn(); if ($c>0){ $c; }else{ $c=""; } ;
				$d = $this->db->query("SELECT COUNT(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.jenis_kelamin = 'P' AND detail_insiden.umur >= 5 and insiden.id_poskotis ='$ses'")->fetchColumn(); if ($d>0){ $d; }else{ $d=""; } ;
				$e = $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND insiden.id_poskotis='$ses' ")->fetchColumn(); if ($e>0){ $e; }else{ $e=""; } ;
				
				$f = $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Luka Ringan' AND insiden.id_poskotis='$ses'")->fetchColumn(); if ($f>0){ $f; }else{ $f=""; } ;
				$f1= $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Luka Sedang' AND insiden.id_poskotis='$ses'")->fetchColumn(); if ($f1>0){ $f1; }else{ $f1=""; } ;
				$f2= $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Luka Berat' AND insiden.id_poskotis='$ses'")->fetchColumn(); if ($f2>0){ $f2; }else{ $f2=""; } ;
				$f3= $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Meninggal' AND insiden.id_poskotis='$ses'")->fetchColumn(); if ($f3>0){ $f3; }else{ $f3=""; } ;

				$g = $this->db->query("SELECT count(detail_insiden.id_rujuk) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN rujuk ON detail_insiden.id_rujuk = rujuk.id_rujuk INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan= '$row[id_kecelakaan]' AND rujuk.inisial='a' AND insiden.id_poskotis='$ses' GROUP BY detail_insiden.id_rujuk")->fetchColumn(); if ($g>0){ $g; }else{ $g=""; } ;
				$h = $this->db->query("SELECT count(detail_insiden.id_rujuk) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN rujuk ON detail_insiden.id_rujuk = rujuk.id_rujuk INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan= '$row[id_kecelakaan]' AND rujuk.inisial='b' AND insiden.id_poskotis='$ses' GROUP BY detail_insiden.id_rujuk")->fetchColumn(); if ($h>0){ $h; }else{ $h=""; } ;
				$i = $this->db->query("SELECT count(*) from detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan INNER JOIN poskotis ON insiden.id_poskotis = poskotis.id_poskotis WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Rawat Jalan' AND insiden.id_poskotis='$ses'")->fetchColumn(); if ($i>0){ $i; }else{ $i=""; } ;
				?>
                <tr>
                <td><div align="center"><?php print($no); ?></div></td>
                <td> <?php print($row['jenis_kecelakaan']); ?> </td>
                <td><div align="center"><?php print($a); ?></div></td>
                <td><div align="center"><?php print($b); ?></div></td>
                <td><div align="center"><?php print($c); ?></div></td>
                <td><div align="center"><?php print($d); ?></div></td>
                <td><div align="center"><?php print($e); ?></div></td>
                <td><div align="center"><?php print($f); ?></div></td>
                <td><div align="center"><?php print($f1); ?></div></td>
                <td><div align="center"><?php print($f2); ?></div></td>
                <td><div align="center"><?php print($f3); ?></div></td>
                <td><div align="center"><?php print($g); ?></div></td>
                <td><div align="center"><?php print($h); ?></div></td>
                <td><div align="center"><?php print($i); ?></div></td>
             	<?php $no++;
            }
        }
	}

	public function VLap2(){
		$query = $this->db->prepare("SELECT * FROM  kecelakaan");
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				$a = $this->db->query("SELECT COUNT(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.jenis_kelamin = 'L' AND detail_insiden.umur < 5 ")->fetchColumn(); if ($a>0){ $a; }else{ $a=""; } ;
				$b = $this->db->query("SELECT COUNT(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.jenis_kelamin = 'P' AND detail_insiden.umur < 5 ")->fetchColumn(); if ($b>0){ $b; }else{ $b=""; } ;
				$c = $this->db->query("SELECT COUNT(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.jenis_kelamin = 'L' AND detail_insiden.umur >= 5 ")->fetchColumn(); if ($c>0){ $c; }else{ $c=""; } ;
				$d = $this->db->query("SELECT COUNT(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.jenis_kelamin = 'P' AND detail_insiden.umur >= 5 ")->fetchColumn(); if ($d>0){ $d; }else{ $d=""; } ;
				$e = $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' ")->fetchColumn(); if ($e>0){ $e; }else{ $e=""; } ;
				
				$f = $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Luka Ringan' ")->fetchColumn(); if ($f>0){ $f; }else{ $f=""; } ;
				$f1= $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Luka Sedang' ")->fetchColumn(); if ($f1>0){ $f1; }else{ $f1=""; } ;
				$f2= $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Luka Berat' ")->fetchColumn(); if ($f2>0){ $f2; }else{ $f2=""; } ;
				$f3= $this->db->query("SELECT count(*) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.kondisi='Meninggal' ")->fetchColumn(); if ($f3>0){ $f3; }else{ $f3=""; } ;

				$g = $this->db->query("SELECT count(detail_insiden.id_rujuk) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN rujuk ON detail_insiden.id_rujuk = rujuk.id_rujuk INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan= '$row[id_kecelakaan]' AND rujuk.inisial='a' GROUP BY detail_insiden.id_rujuk")->fetchColumn(); if ($g>0){ $g; }else{ $g=""; } ;
				$h = $this->db->query("SELECT count(detail_insiden.id_rujuk) FROM detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN rujuk ON detail_insiden.id_rujuk = rujuk.id_rujuk INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan= '$row[id_kecelakaan]' AND rujuk.inisial='b' GROUP BY detail_insiden.id_rujuk")->fetchColumn(); if ($h>0){ $h; }else{ $h=""; } ;
				$i = $this->db->query("SELECT count(*) from detail_insiden INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan WHERE insiden.id_kecelakaan = '$row[id_kecelakaan]' AND detail_insiden.rawat='Y' ")->fetchColumn(); if ($i>0){ $i; }else{ $i=""; } ;
				?>
                <tr>
                <td><div align="center"><?php print($no); ?></div></td>
                <td> <?php print($row['jenis_kecelakaan']); ?> </td>
                <td><div align="center"><?php print($a); ?></div></td>
                <td><div align="center"><?php print($b); ?></div></td>
                <td><div align="center"><?php print($c); ?></div></td>
                <td><div align="center"><?php print($d); ?></div></td>
                <td><div align="center"><?php print($e); ?></div></td>
                <td><div align="center"><?php print($f); ?></div></td>
                <td><div align="center"><?php print($f1); ?></div></td>
                <td><div align="center"><?php print($f2); ?></div></td>
                <td><div align="center"><?php print($f3); ?></div></td>
                <td><div align="center"><?php print($g); ?></div></td>
                <td><div align="center"><?php print($h); ?></div></td>
                <td><div align="center"><?php print($i); ?></div></td>
             	<?php $no++;
            }
        }
	}
	

	/*

	public function VLap(){
		$query = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=1"); 
		$query->execute();
		$query2 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=2"); 
		$query2->execute(); 
		$query3 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=3"); 
		$query3->execute();
		$query4 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=4"); 
		$query4->execute();
		$query5 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=5"); 
		$query5->execute();
		$query6 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=6"); 
		$query6->execute();
		$query7 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=7"); 
		$query7->execute();
		$query8 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=8"); 
		$query8->execute();
		$query9 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=9"); 
		$query9->execute(); 
		$query10 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=10"); 
		$query10->execute();
		$query11 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=11"); 
		$query11->execute();
		$query12 = $this->db->prepare("SELECT * FROM v_jumlah_kecelakaan WHERE id_kecelakaan=12"); 
		$query12->execute();
		$q1 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=1"); 
		$q1->execute();
		$q2 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=2"); 
		$q2->execute();
		$q3 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=3"); 
		$q3->execute();
		$q4 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=4"); 
		$q4->execute();
		$q5 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=5"); 
		$q5->execute();
		$q6 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=6"); 
		$q6->execute();
		$q7 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=7"); 
		$q7->execute();
		$q8 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=8"); 
		$q8->execute();
		$q9 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=9"); 
		$q9->execute();
		$q10 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=10"); 
		$q10->execute();
		$q11 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=11"); 
		$q11->execute();
		$q12 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=12");
		$q12->execute();
		$l1 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=1"); 
		$l1->execute();
		$l2 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=2"); 
		$l2->execute();
		$l3 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=3"); 
		$l3->execute();
		$l4 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=4"); 
		$l4->execute();
		$l5 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=5"); 
		$l5->execute();
		$l6 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=6"); 
		$l6->execute();
		$l7 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=7"); 
		$l7->execute();
		$l8 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=8"); 
		$l8->execute();
		$l9 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=9"); 
		$l9->execute();
		$l10 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=10"); 
		$l10->execute();
		$l11 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=11"); 
		$l11->execute();	
		$l12 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=12"); 
		$l12->execute();
		$o1 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=1"); 
		$o1->execute();
		$o2 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=2"); 
		$o2->execute();
		$o3 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=3"); 
		$o3->execute();
		$o4 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=4"); 
		$o4->execute();
		$o5 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=5"); 
		$o5->execute();
		$o6 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=6"); 
		$o6->execute();
		$o7 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=7"); 
		$o7->execute();
		$o8 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=8"); 
		$o8->execute();
		$o9 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=9"); 
		$o9->execute();
		$o10 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=10"); 
		$o10->execute();
		$o11 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=11"); 
		$o11->execute();
		$o12 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=12"); 
		$o12->execute();
		$ii1 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=1"); 
		$ii1->execute();
		$ii2 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=2"); 
		$ii2->execute();
		$ii3 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=3"); 
		$ii3->execute();
		$ii4 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=4"); 
		$ii4->execute();
		$ii5 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=5"); 
		$ii5->execute();
		$ii6 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=6"); 
		$ii6->execute();
		$ii7 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=7"); 
		$ii7->execute();
		$ii8 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=8"); 
		$ii8->execute();
		$ii9 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=9"); 
		$ii9->execute();
		$ii10 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=10"); 
		$ii10->execute();
		$ii11 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=11"); 
		$ii11->execute();
		$ii12 = $this->db->prepare("SELECT * FROM v_kondisi WHERE id_kecelakaan=12"); 
		$ii12->execute();
		$oo1 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=1"); 
		$oo1->execute();
		$oo2 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=2"); 
		$oo2->execute();
		$oo3 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=3"); 
		$oo3->execute();
		$oo4 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=4"); 
		$oo4->execute();
		$oo5 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=5"); 
		$oo5->execute();
		$oo6 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=6"); 
		$oo6->execute();
		$oo7 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=7"); 
		$oo7->execute();
		$oo8 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=8"); 
		$oo8->execute();
		$oo9 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=9"); 
		$oo9->execute();
		$oo10 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=10"); 
		$oo10->execute();
		$oo11 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=11"); 
		$oo11->execute();
		$oo12 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=12"); 
		$oo12->execute();
		$nn1 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=1"); 
		$nn1->execute();
		$nn2 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=2"); 
		$nn2->execute();
		$nn3 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=3"); 
		$nn3->execute();
		$nn4 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=4"); 
		$nn4->execute();
		$nn5 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=5"); 
		$nn5->execute();
		$nn6 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=6"); 
		$nn6->execute();
		$nn7 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=7"); 
		$nn7->execute();
		$nn8 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=8"); 
		$nn8->execute();
		$nn9 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=9"); 
		$nn9->execute();
		$nn10 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=10"); 
		$nn10->execute();
		$nn11 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=11"); 
		$nn11->execute();
		$nn12 = $this->db->prepare("SELECT * FROM v_rujuk WHERE id_kecelakaan=12"); 
		$nn12->execute();
		$ra1 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=1"); 
		$ra1->execute();
		$ra2 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=2"); 
		$ra2->execute();
		$ra3 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=3"); 
		$ra3->execute();
		$ra4 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=4"); 
		$ra4->execute();
		$ra5 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=5"); 
		$ra5->execute();
		$ra6 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=6"); 
		$ra6->execute();
		$ra7 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=7"); 
		$ra7->execute();
		$ra8 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=8"); 
		$ra8->execute();
		$ra9 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=9"); 
		$ra9->execute();
		$ra10 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=10"); 
		$ra10->execute();
		$ra11 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=11"); 
		$ra11->execute();
		$ra12 = $this->db->prepare("SELECT * FROM v_rawat WHERE id_kecelakaan=12"); 
		$ra12->execute();
		$j = $this->db->prepare("SELECT * FROM v_jenis_umur WHERE id_kecelakaan=4"); 
		$j->execute();

		?>
		<tr>
	       <td align="center">1</td>
	       <td align="center">R4 VS R4</td>
	       <td align="center"><?php $nume1 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=1 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume1>0){ echo $nume1; }else{ echo $nume1=""; } ?></td>
	       <td align="center"><?php $nume = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=1 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume>0){ echo $nume; }else{ echo $nume=""; } ?></td>
	       <td align="center"><?php $nume2 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=1 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume2>0){ echo $nume2; }else{ echo $nume2=""; } ?></td>
	       <td align="center"><?php $nume3 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=1 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume3>0){ echo $nume3; }else{ echo $nume3=""; } ?></td>
	       <td align="center"><?php while($row=$query->fetch(PDO::FETCH_ASSOC)){ if ($row['Count(insiden.id_kecelakaan)']){ $p=$row['Count(insiden.id_kecelakaan)']; }else{ $p="-"; } echo $p; } ?></td>
	       <td align="center"><?php while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ if ($r1['kondisi']=="Luka Ringan"){ $p1=count($r1['kondisi']); }else{ $p1=""; } echo $p1; } ?></td>
	       <td align="center"><?php while($t1=$l1->fetch(PDO::FETCH_ASSOC)){ if ($t1['kondisi']=="Luka Sedang"){ $w1=count($t1['kondisi']); }else{ $w1=""; } echo $w1; } ?></td>
	       <td align="center"><?php while($e1=$o1->fetch(PDO::FETCH_ASSOC)){ if ($e1['kondisi']=="Luka Berat"){ $x1=count($e1['kondisi']); }else{ $x1=""; } echo $x1; } ?></td>
	       <td align="center"><?php while($ee1=$ii1->fetch(PDO::FETCH_ASSOC)){ if ($ee1['kondisi']=="Meninggal"){ $xx1=count($ee1['kondisi']); }else{ $xx1=""; } echo $xx1; } ?></td>
	       <td align="center"><?php while($ne1=$nn1->fetch(PDO::FETCH_ASSOC)){ if ($ne1['id_rujuk']==9 or $ne1['id_rujuk']==10 or $ne1['id_rujuk']==11 or $ne1['id_rujuk']==12 or $ne1['id_rujuk']==13 or $ne1['id_rujuk']==14 or $ne1['id_rujuk']==15 or $ne1['id_rujuk']==16 or $ne1['id_rujuk']==17 or $ne1['id_rujuk']==18 or $ne1['id_rujuk']==19 or $ne1['id_rujuk']==20 ){ $n1=count($ne1['COUNT(detail_insiden.id_rujuk)']); }else{ $n1=""; } echo $n1; } ?></td>
	       <td align="center"><?php while($eee1=$oo1->fetch(PDO::FETCH_ASSOC)){ if ($eee1['id_rujuk']==1 or $eee1['id_rujuk']==2 or $eee1['id_rujuk']==3 or $eee1['id_rujuk']==4 or $eee1['id_rujuk']==5 or $eee1['id_rujuk']==6 or $eee1['id_rujuk']==7 or $eee1['id_rujuk']==8 ){ $xxx1=count($eee1['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx1=""; } echo $xxx1; } ?></td>
	       <td align="center"><?php $nu1 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=1 and rawat='Y' ")->fetchColumn(); if ($nu1>0){ echo $nu1; }else{ echo $nu1=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">2</td>
	       <td align="center">R4 VS R2</td>
	       <td align="center"><?php $nume4 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=2 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume4>0){ echo $nume4; }else{ echo $nume4=""; } ?></td>
	       <td align="center"><?php $nume5 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=2 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume5>0){ echo $nume5; }else{ echo $nume5=""; } ?></td>
	       <td align="center"><?php $nume6 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=2 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume6>0){ echo $nume6; }else{ echo $nume6=""; } ?></td>
	       <td align="center"><?php $nume7 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=2 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume7>0){ echo $nume7; }else{ echo $nume7=""; } ?></td>
	       <td align="center"><?php while($row2=$query2->fetch(PDO::FETCH_ASSOC)){ if ($row2['Count(insiden.id_kecelakaan)']){ $p2=$row2['Count(insiden.id_kecelakaan)']; }else{ $p2="-"; } echo $p2; } ?></td>
	       <td align="center"><?php while($r2=$q2->fetch(PDO::FETCH_ASSOC)){ if ($r2['kondisi']=="Luka Ringan"){ $p2=count($r2['kondisi']); }else{ $p2=""; } echo $p2; } ?></td>
	       <td align="center"><?php while($t2=$l2->fetch(PDO::FETCH_ASSOC)){ if ($t2['kondisi']=="Luka Sedang"){ $w2=count($t2['kondisi']); }else{ $w2=""; } echo $w2; } ?></td>
	       <td align="center"><?php while($e2=$o2->fetch(PDO::FETCH_ASSOC)){ if ($e2['kondisi']=="Luka Berat"){ $x2=count($e2['kondisi']); }else{ $x2=""; } echo $x2; } ?></td>
	       <td align="center"><?php while($ee2=$ii2->fetch(PDO::FETCH_ASSOC)){ if ($ee2['kondisi']=="Meninggal"){ $xx2=count($ee2['kondisi']); }else{ $xx2=""; } echo $xx2; } ?></td>
	       <td align="center"><?php while($ne2=$nn2->fetch(PDO::FETCH_ASSOC)){ if ($ne2['id_rujuk']==9 or $ne2['id_rujuk']==10 or $ne2['id_rujuk']==11 or $ne2['id_rujuk']==12 or $ne2['id_rujuk']==13 or $ne2['id_rujuk']==14 or $ne2['id_rujuk']==15 or $ne2['id_rujuk']==16 or $ne2['id_rujuk']==17 or $ne2['id_rujuk']==18 or $ne2['id_rujuk']==19 or $ne2['id_rujuk']==20 ){ $n2=count($ne2['COUNT(detail_insiden.id_rujuk)']); }else{ $n2=""; } echo $n2; } ?></td>
	       <td align="center"><?php while($eee2=$oo2->fetch(PDO::FETCH_ASSOC)){ if ($eee2['id_rujuk']==1 or $eee2['id_rujuk']==2 or $eee2['id_rujuk']==3 or $eee2['id_rujuk']==4 or $eee2['id_rujuk']==5 or $eee2['id_rujuk']==6 or $eee2['id_rujuk']==7 or $eee2['id_rujuk']==8 ){ $xxx2=count($eee2['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx2=""; } echo $xxx2; } ?></td>
	       <td align="center"><?php $nu = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=2 and rawat='Y' ")->fetchColumn(); if ($nu>0){ echo $nu; }else{ echo $nu=""; } ?></td> 
	    </tr>
	    <tr>
	       <td align="center">3</td>
	       <td align="center">R2 VS R2</td>
	       <td align="center"><?php $nume8 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=3 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume8>0){ echo $nume8; }else{ echo $nume8=""; } ?></td>
	       <td align="center"><?php $nume9 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=3 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume9>0){ echo $nume9; }else{ echo $nume9=""; } ?></td>
	       <td align="center"><?php $nume10 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=3 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume10>0){ echo $nume10; }else{ echo $nume10=""; } ?></td>
	       <td align="center"><?php $nume11 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=3 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume11>0){ echo $nume11; }else{ echo $nume11=""; } ?></td>
	       <td align="center"><?php while($row3=$query3->fetch(PDO::FETCH_ASSOC)){ if ($row3['Count(insiden.id_kecelakaan)']){ $p3=$row3['Count(insiden.id_kecelakaan)']; }else{ $p3="-"; } echo $p3; } ?></td>
	       <td align="center"><?php while($r3=$q3->fetch(PDO::FETCH_ASSOC)){ if ($r3['kondisi']=="Luka Ringan"){ $p3=count($r3['kondisi']); }else{ $p3=""; } echo $p3; } ?></td>
	       <td align="center"><?php while($t3=$l3->fetch(PDO::FETCH_ASSOC)){ if ($t3['kondisi']=="Luka Sedang"){ $w3=count($t3['kondisi']); }else{ $w3=""; } echo $w3; } ?></td>
	       <td align="center"><?php while($e3=$o3->fetch(PDO::FETCH_ASSOC)){ if ($e3['kondisi']=="Luka Berat"){ $x3=count($e3['kondisi']); }else{ $x3=""; } echo $x3; } ?></td>
	       <td align="center"><?php while($ee3=$ii3->fetch(PDO::FETCH_ASSOC)){ if ($ee3['kondisi']=="Meninggal"){ $xx3=count($ee3['kondisi']); }else{ $xx3=""; } echo $xx3; } ?></td>
	       <td align="center"><?php while($ne3=$nn3->fetch(PDO::FETCH_ASSOC)){ if ($ne3['id_rujuk']==9 or $ne3['id_rujuk']==10 or $ne3['id_rujuk']==11 or $ne3['id_rujuk']==12 or $ne3['id_rujuk']==13 or $ne3['id_rujuk']==14 or $ne3['id_rujuk']==15 or $ne3['id_rujuk']==16 or $ne3['id_rujuk']==17 or $ne3['id_rujuk']==18 or $ne3['id_rujuk']==19 or $ne3['id_rujuk']==20 ){ $n3=count($ne3['COUNT(detail_insiden.id_rujuk)']); }else{ $n3=""; } echo $n3; } ?></td>
	       <td align="center"><?php while($eee3=$oo3->fetch(PDO::FETCH_ASSOC)){ if ($eee3['id_rujuk']==1 or $eee3['id_rujuk']==2 or $eee3['id_rujuk']==3 or $eee3['id_rujuk']==4 or $eee3['id_rujuk']==5 or $eee3['id_rujuk']==6 or $eee3['id_rujuk']==7 or $eee3['id_rujuk']==8 ){ $xxx3=count($eee3['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx3=""; } echo $xxx3; } ?></td>
	       <td align="center"><?php $nu2 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=3 and rawat='Y' ")->fetchColumn(); if ($nu2>0){ echo $nu2; }else{ echo $nu2=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">4</td>
	       <td align="center">R4 VS Pejalan Kaki</td>
	       <td align="center"><?php $nume12 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=4 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume12>0){ echo $nume12; }else{ echo $nume12=""; } ?></td>
	       <td align="center"><?php $nume13 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=4 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume13>0){ echo $nume13; }else{ echo $nume13=""; } ?></td>
	       <td align="center"><?php $nume14 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=4 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume14>0){ echo $nume14; }else{ echo $nume14=""; } ?></td>
	       <td align="center"><?php $nume15 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=4 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume15>0){ echo $nume15; }else{ echo $nume15=""; }; ?></td>
	       <td align="center"><?php while($row4=$query4->fetch(PDO::FETCH_ASSOC)){ if ($row4['Count(insiden.id_kecelakaan)']){ $p4=$row4['Count(insiden.id_kecelakaan)']; }else{ $p4=""; } echo $p4; } ?></td>
	       <td align="center"><?php while($r4=$q4->fetch(PDO::FETCH_ASSOC)){ if ($r4['kondisi']=="Luka Ringan"){ $p4=count($r4['kondisi']); }else{ $p4=""; } echo $p4; } ?></td>
	       <td align="center"><?php while($t4=$l4->fetch(PDO::FETCH_ASSOC)){ if ($t4['kondisi']=="Luka Sedang"){ $w4=count($t4['kondisi']); }else{ $w4=""; } echo $w4; } ?></td>
	       <td align="center"><?php while($e4=$o4->fetch(PDO::FETCH_ASSOC)){ if ($e4['kondisi']=="Luka Berat"){ $x4=count($e4['kondisi']); }else{ $x4=""; } echo $x4; } ?></td>
	       <td align="center"><?php while($ee4=$ii4->fetch(PDO::FETCH_ASSOC)){ if ($ee4['kondisi']=="Meninggal"){ $xx4=count($ee4['kondisi']); }else{ $xx4=""; } echo $xx4; } ?></td>
	       <td align="center"><?php while($ne4=$nn4->fetch(PDO::FETCH_ASSOC)){ if ($ne4['id_rujuk']==9 or $ne4['id_rujuk']==10 or $ne4['id_rujuk']==11 or $ne4['id_rujuk']==12 or $ne4['id_rujuk']==13 or $ne4['id_rujuk']==14 or $ne4['id_rujuk']==15 or $ne4['id_rujuk']==16 or $ne4['id_rujuk']==17 or $ne4['id_rujuk']==18 or $ne4['id_rujuk']==19 or $ne4['id_rujuk']==20 ){ $n4=count($ne1['COUNT(detail_insiden.id_rujuk)']); }else{ $n4=""; } echo $n4; } ?></td>
	       <td align="center"><?php while($eee4=$oo4->fetch(PDO::FETCH_ASSOC)){ if ($eee4['id_rujuk']==1 or $eee4['id_rujuk']==2 or $eee4['id_rujuk']==3 or $eee4['id_rujuk']==4 or $eee4['id_rujuk']==5 or $eee4['id_rujuk']==6 or $eee4['id_rujuk']==7 or $eee4['id_rujuk']==8 ){ $xxx4=$eee4['COUNT(detail_insiden.id_rujuk)']; }else{ $xxx4=""; } echo $xxx4; } ?></td>
	       <td align="center"><?php $nu4 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=4 and rawat='Y' ")->fetchColumn(); if ($nu4>0){ echo $nu4; }else{ echo $nu4=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">5</td>
	       <td align="center">R2 VS Pejalan Kaki</td>
	       <td align="center"><?php $nume16 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=5 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume16>0){ echo $nume16; }else{ echo $nume16=""; } ?></td>
	       <td align="center"><?php $nume17 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=5 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume17>0){ echo $nume17; }else{ echo $nume17=""; } ?></td>
	       <td align="center"><?php $nume18 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=5 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume18>0){ echo $nume18; }else{ echo $nume18=""; } ?></td>
	       <td align="center"><?php $nume19 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=5 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume19>0){ echo $nume19; }else{ echo $nume19=""; } ?></td>
	       <td align="center"><?php while($row5=$query5->fetch(PDO::FETCH_ASSOC)){ if ($row5['Count(insiden.id_kecelakaan)']){ $p5=$row5['Count(insiden.id_kecelakaan)']; }else{ $p5="-"; } echo $p5; } ?></td>
	       <td align="center"><?php while($r5=$q5->fetch(PDO::FETCH_ASSOC)){ if ($r5['kondisi']=="Luka Ringan"){ $p5=count($r5['kondisi']); }else{ $p5=""; } echo $p5; } ?></td>
	       <td align="center"><?php while($t5=$l5->fetch(PDO::FETCH_ASSOC)){ if ($t5['kondisi']=="Luka Sedang"){ $w5=count($t5['kondisi']); }else{ $w5=""; } echo $w5; } ?></td>
	       <td align="center"><?php while($e5=$o5->fetch(PDO::FETCH_ASSOC)){ if ($e5['kondisi']=="Luka Berat"){ $x5=count($e5['kondisi']); }else{ $x5=""; } echo $x5; } ?></td>
	       <td align="center"><?php while($ee5=$ii5->fetch(PDO::FETCH_ASSOC)){ if ($ee5['kondisi']=="Meninggal"){ $xx5=count($ee5['kondisi']); }else{ $xx5=""; } echo $xx5; } ?></td>
	       <td align="center"><?php while($ne5=$nn5->fetch(PDO::FETCH_ASSOC)){ if ($ne5['id_rujuk']==9 or $ne5['id_rujuk']==10 or $ne5['id_rujuk']==11 or $ne5['id_rujuk']==12 or $ne5['id_rujuk']==13 or $ne5['id_rujuk']==14 or $ne5['id_rujuk']==15 or $ne5['id_rujuk']==16 or $ne5['id_rujuk']==17 or $ne5['id_rujuk']==18 or $ne5['id_rujuk']==19 or $ne5['id_rujuk']==20 ){ $n5=count($ne5['COUNT(detail_insiden.id_rujuk)']); }else{ $n5=""; } echo $n5; } ?></td>
	       <td align="center"><?php while($eee5=$oo5->fetch(PDO::FETCH_ASSOC)){ if ($eee5['id_rujuk']==1 or $eee5['id_rujuk']==2 or $eee5['id_rujuk']==3 or $eee5['id_rujuk']==4 or $eee5['id_rujuk']==5 or $eee5['id_rujuk']==6 or $eee5['id_rujuk']==7 or $eee5['id_rujuk']==8 ){ $xxx5=count($eee5['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx5=""; } echo $xxx5; } ?></td>
	       <td align="center"><?php $nu5 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=5 and rawat='Y' ")->fetchColumn(); if ($nu5>0){ echo $nu5; }else{ echo $nu5=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">6</td>
	       <td align="center">R4 Tunggal</td>
	       <td align="center"><?php $nume20 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=6 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume20>0){ echo $nume20; }else{ echo $nume20=""; } ?></td>
	       <td align="center"><?php $nume21 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=6 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume21>0){ echo $nume21; }else{ echo $nume21=""; } ?></td>
	       <td align="center"><?php $nume22 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=6 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume22>0){ echo $nume22; }else{ echo $nume22=""; } ?></td>
	       <td align="center"><?php $nume23 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=6 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume23>0){ echo $nume23; }else{ echo $nume23=""; } ?></td>
	       <td align="center"><?php while($row6=$query6->fetch(PDO::FETCH_ASSOC)){ if ($row6['Count(insiden.id_kecelakaan)']){ $p6=$row6['Count(insiden.id_kecelakaan)']; }else{ $p6="-"; } echo $p6; } ?></td>
	       <td align="center"><?php while($r6=$q6->fetch(PDO::FETCH_ASSOC)){ if ($r6['kondisi']=="Luka Ringan"){ $p6=count($r6['kondisi']); }else{ $p6=""; } echo $p6; } ?></td>
	       <td align="center"><?php while($t6=$l6->fetch(PDO::FETCH_ASSOC)){ if ($t6['kondisi']=="Luka Sedang"){ $w6=count($t6['kondisi']); }else{ $w6=""; } echo $w6; } ?></td>
	       <td align="center"><?php while($e6=$o6->fetch(PDO::FETCH_ASSOC)){ if ($e6['kondisi']=="Luka Berat"){ $x6=count($e6['kondisi']); }else{ $x6=""; } echo $x6; } ?></td>
	       <td align="center"><?php while($ee6=$ii6->fetch(PDO::FETCH_ASSOC)){ if ($ee6['kondisi']=="Meninggal"){ $xx6=count($ee6['kondisi']); }else{ $xx6=""; } echo $xx6; } ?></td>
	       <td align="center"><?php while($ne6=$nn6->fetch(PDO::FETCH_ASSOC)){ if ($ne6['id_rujuk']==9 or $ne6['id_rujuk']==10 or $ne6['id_rujuk']==11 or $ne6['id_rujuk']==12 or $ne6['id_rujuk']==13 or $ne6['id_rujuk']==14 or $ne6['id_rujuk']==15 or $ne6['id_rujuk']==16 or $ne6['id_rujuk']==17 or $ne6['id_rujuk']==18 or $ne6['id_rujuk']==19 or $ne6['id_rujuk']==20 ){ $n6=count($ne6['COUNT(detail_insiden.id_rujuk)']); }else{ $n6=""; } echo $n6; } ?></td>
	       <td align="center"><?php while($eee6=$oo6->fetch(PDO::FETCH_ASSOC)){ if ($eee6['id_rujuk']==1 or $eee6['id_rujuk']==2 or $eee6['id_rujuk']==3 or $eee6['id_rujuk']==4 or $eee6['id_rujuk']==5 or $eee6['id_rujuk']==6 or $eee6['id_rujuk']==7 or $eee6['id_rujuk']==8 ){ $xxx6=count($eee6['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx6=""; } echo $xxx6; } ?></td>
	       <td align="center"><?php $nu6 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=6 and rawat='Y' ")->fetchColumn(); if ($nu6>0){ echo $nu6; }else{ echo $nu6=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">7</td>
	       <td align="center">R2 Tunggal</td>
	       <td align="center"><?php $nume24 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=7 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume24>0){ echo $nume24; }else{ echo $nume24=""; } ?></td>
	       <td align="center"><?php $nume25 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=7 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume25>0){ echo $nume25; }else{ echo $nume25=""; } ?></td>
	       <td align="center"><?php $nume26 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=7 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume26>0){ echo $nume26; }else{ echo $nume26=""; } ?></td>
	       <td align="center"><?php $nume27 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=7 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume27>0){ echo $nume27; }else{ echo $nume27=""; } ?></td>
	       <td align="center"><?php while($row7=$query7->fetch(PDO::FETCH_ASSOC)){ if ($row7['Count(insiden.id_kecelakaan)']){ $p7=$row7['Count(insiden.id_kecelakaan)']; }else{ $p7="-"; } echo $p7; } ?></td>
	       <td align="center"><?php while($r7=$q7->fetch(PDO::FETCH_ASSOC)){ if ($r7['kondisi']=="Luka Ringan"){ $p7=count($r7['kondisi']); }else{ $p7=""; } echo $p7; } ?></td>
	       <td align="center"><?php while($t7=$l7->fetch(PDO::FETCH_ASSOC)){ if ($t7['kondisi']=="Luka Sedang"){ $w7=count($t7['kondisi']); }else{ $w7=""; } echo $w7; } ?></td>
	       <td align="center"><?php while($e7=$o7->fetch(PDO::FETCH_ASSOC)){ if ($e7['kondisi']=="Luka Berat"){ $x7=count($e7['kondisi']); }else{ $x7=""; } echo $x7; } ?></td>
	       <td align="center"><?php while($ee7=$ii7->fetch(PDO::FETCH_ASSOC)){ if ($ee7['kondisi']=="Meninggal"){ $xx7=count($ee7['kondisi']); }else{ $xx7=""; } echo $xx7; } ?></td>
	       <td align="center"><?php while($ne7=$nn7->fetch(PDO::FETCH_ASSOC)){ if ($ne7['id_rujuk']==9 or $ne7['id_rujuk']==10 or $ne7['id_rujuk']==11 or $ne7['id_rujuk']==12 or $ne7['id_rujuk']==13 or $ne7['id_rujuk']==14 or $ne7['id_rujuk']==15 or $ne7['id_rujuk']==16 or $ne7['id_rujuk']==17 or $ne7['id_rujuk']==18 or $ne7['id_rujuk']==19 or $ne7['id_rujuk']==20 ){ $n7=count($ne7['COUNT(detail_insiden.id_rujuk)']); }else{ $n7=""; } echo $n7; } ?></td>
	       <td align="center"><?php while($eee7=$oo7->fetch(PDO::FETCH_ASSOC)){ if ($eee7['id_rujuk']==1 or $eee7['id_rujuk']==2 or $eee7['id_rujuk']==3 or $eee7['id_rujuk']==4 or $eee7['id_rujuk']==5 or $eee7['id_rujuk']==6 or $eee7['id_rujuk']==7 or $eee7['id_rujuk']==8 ){ $xxx7=count($eee7['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx7=""; } echo $xxx7; } ?></td>
	       <td align="center"><?php $nu7 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=7 and rawat='Y' ")->fetchColumn(); if ($nu7>0){ echo $nu7; }else{ echo $nu7=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">8</td>
	       <td align="center">R4 VS Bus</td>
	       <td align="center"><?php $nume28 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=8 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume28>0){ echo $nume28; }else{ echo $nume28=""; } ?></td>
	       <td align="center"><?php $nume29 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=8 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume29>0){ echo $nume29; }else{ echo $nume29=""; } ?></td>
	       <td align="center"><?php $nume30 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=8 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume30>0){ echo $nume30; }else{ echo $nume30=""; } ?></td>
	       <td align="center"><?php $nume31 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=8 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume31>0){ echo $nume31; }else{ echo $nume31=""; } ?></td>
	       <td align="center"><?php while($row8=$query8->fetch(PDO::FETCH_ASSOC)){ if ($row8['Count(insiden.id_kecelakaan)']){ $p8=$row8['Count(insiden.id_kecelakaan)']; }else{ $p8="-"; } echo $p8; } ?></td>
	       <td align="center"><?php while($r8=$q8->fetch(PDO::FETCH_ASSOC)){ if ($r8['kondisi']=="Luka Ringan"){ $p8=count($r8['kondisi']); }else{ $p8=""; } echo $p8; } ?></td>
	       <td align="center"><?php while($t8=$l8->fetch(PDO::FETCH_ASSOC)){ if ($t8['kondisi']=="Luka Sedang"){ $w8=count($t8['kondisi']); }else{ $w8=""; } echo $w8; } ?></td>
	       <td align="center"><?php while($e8=$o8->fetch(PDO::FETCH_ASSOC)){ if ($e8['kondisi']=="Luka Berat"){ $x8=count($e8['kondisi']); }else{ $x8=""; } echo $x8; } ?></td>
	       <td align="center"><?php while($ee8=$ii8->fetch(PDO::FETCH_ASSOC)){ if ($ee8['kondisi']=="Meninggal"){ $xx8=count($ee8['kondisi']); }else{ $xx8=""; } echo $xx8; } ?></td>
	       <td align="center"><?php while($ne8=$nn8->fetch(PDO::FETCH_ASSOC)){ if ($ne8['id_rujuk']==9 or $ne8['id_rujuk']==10 or $ne1['id_rujuk']==11 or $ne8['id_rujuk']==12 or $ne8['id_rujuk']==13 or $ne8['id_rujuk']==14 or $ne8['id_rujuk']==15 or $ne8['id_rujuk']==16 or $ne8['id_rujuk']==17 or $ne8['id_rujuk']==18 or $ne8['id_rujuk']==19 or $ne8['id_rujuk']==20 ){ $n8=count($ne8['COUNT(detail_insiden.id_rujuk)']); }else{ $n8=""; } echo $n8; } ?></td>
	       <td align="center"><?php while($eee8=$oo8->fetch(PDO::FETCH_ASSOC)){ if ($eee8['id_rujuk']==1 or $eee8['id_rujuk']==2 or $eee8['id_rujuk']==3 or $eee8['id_rujuk']==4 or $eee8['id_rujuk']==5 or $eee8['id_rujuk']==6 or $eee8['id_rujuk']==7 or $eee8['id_rujuk']==8 ){ $xxx8=count($eee8['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx8=""; } echo $xxx8; } ?></td>
	       <td align="center"><?php $nu8 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=8 and rawat='Y' ")->fetchColumn(); if ($nu8>0){ echo $nu8; }else{ echo $nu8=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">9</td>
	       <td align="center">R2 VS Bus</td>
	       <td align="center"><?php $nume32 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=9 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume32>0){ echo $nume32; }else{ echo $nume32=""; } ?></td>
	       <td align="center"><?php $nume33 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=9 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume33>0){ echo $nume33; }else{ echo $nume33=""; } ?></td>
	       <td align="center"><?php $nume34 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=9 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume34>0){ echo $nume34; }else{ echo $nume34=""; } ?></td>
	       <td align="center"><?php $nume35 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=9 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume35>0){ echo $nume35; }else{ echo $nume35=""; } ?></td>
	       <td align="center"><?php while($row9=$query9->fetch(PDO::FETCH_ASSOC)){ if ($row9['Count(insiden.id_kecelakaan)']){ $p9=$row9['Count(insiden.id_kecelakaan)']; }else{ $p9="-"; } echo $p9; } ?></td>
	       <td align="center"><?php while($r9=$q9->fetch(PDO::FETCH_ASSOC)){ if ($r9['kondisi']=="Luka Ringan"){ $p9=count($r9['kondisi']); }else{ $p9=""; } echo $p9; } ?></td>
	       <td align="center"><?php while($t9=$l9->fetch(PDO::FETCH_ASSOC)){ if ($t9['kondisi']=="Luka Sedang"){ $w9=count($t9['kondisi']); }else{ $w9=""; } echo $w9; } ?></td>
	       <td align="center"><?php while($e9=$o9->fetch(PDO::FETCH_ASSOC)){ if ($e9['kondisi']=="Luka Berat"){ $x9=count($e9['kondisi']); }else{ $x9=""; } echo $x9; } ?></td>
	       <td align="center"><?php while($ee9=$ii9->fetch(PDO::FETCH_ASSOC)){ if ($ee9['kondisi']=="Meninggal"){ $xx9=count($ee9['kondisi']); }else{ $xx9=""; } echo $xx9; } ?></td>
	       <td align="center"><?php while($ne9=$nn9->fetch(PDO::FETCH_ASSOC)){ if ($ne9['id_rujuk']==9 or $ne9['id_rujuk']==10 or $ne9['id_rujuk']==11 or $ne9['id_rujuk']==12 or $ne9['id_rujuk']==13 or $ne9['id_rujuk']==14 or $ne9['id_rujuk']==15 or $ne9['id_rujuk']==16 or $ne9['id_rujuk']==17 or $ne9['id_rujuk']==18 or $ne9['id_rujuk']==19 or $ne9['id_rujuk']==20 ){ $n9=count($ne9['COUNT(detail_insiden.id_rujuk)']); }else{ $n9=""; } echo $n9; } ?></td>
	       <td align="center"><?php while($eee9=$oo9->fetch(PDO::FETCH_ASSOC)){ if ($eee9['id_rujuk']==1 or $eee9['id_rujuk']==2 or $eee9['id_rujuk']==3 or $eee9['id_rujuk']==4 or $eee9['id_rujuk']==5 or $eee9['id_rujuk']==6 or $eee9['id_rujuk']==7 or $eee9['id_rujuk']==8 ){ $xxx9=count($eee9['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx9=""; } echo $xxx9; } ?></td>
	       <td align="center"><?php $nu9 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=9 and rawat='Y' ")->fetchColumn(); if ($nu9>0){ echo $nu9; }else{ echo $nu9=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">10</td>
	       <td align="center">Bus Tunggal</td>
	       <td align="center"><?php $nume36 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=10 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume36>0){ echo $nume36; }else{ echo $nume36=""; } ?></td>
	       <td align="center"><?php $nume37 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=10 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume37>0){ echo $nume37; }else{ echo $nume37=""; } ?></td>
	       <td align="center"><?php $nume38 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=10 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume38>0){ echo $nume38; }else{ echo $nume38=""; } ?></td>
	       <td align="center"><?php $nume39 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=10 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume39>0){ echo $nume39; }else{ echo $nume39=""; } ?></td>
	       <td align="center"><?php while($row10=$query10->fetch(PDO::FETCH_ASSOC)){ if ($row10['Count(insiden.id_kecelakaan)']){ $p10=$row10['Count(insiden.id_kecelakaan)']; }else{ $p10="-"; } echo $p10; } ?></td>
	       <td align="center"><?php while($r10=$q10->fetch(PDO::FETCH_ASSOC)){ if ($r10['kondisi']=="Luka Ringan"){ $p10=count($r10['kondisi']); }else{ $p10=""; } echo $p10; } ?></td>
	       <td align="center"><?php while($t10=$l10->fetch(PDO::FETCH_ASSOC)){ if ($t10['kondisi']=="Luka Sedang"){ $w10=count($t10['kondisi']); }else{ $w10=""; } echo $w10; } ?></td>
	       <td align="center"><?php while($e10=$o10->fetch(PDO::FETCH_ASSOC)){ if ($e10['kondisi']=="Luka Berat"){ $x10=count($e10['kondisi']); }else{ $x10=""; } echo $x10; } ?></td>
	       <td align="center"><?php while($ee10=$ii10->fetch(PDO::FETCH_ASSOC)){ if ($ee10['kondisi']=="Meninggal"){ $xx10=count($ee10['kondisi']); }else{ $xx10=""; } echo $xx10; } ?></td>
	       <td align="center"><?php while($ne10=$nn10->fetch(PDO::FETCH_ASSOC)){ if ($ne10['id_rujuk']==9 or $ne10['id_rujuk']==10 or $ne10['id_rujuk']==11 or $ne10['id_rujuk']==12 or $ne10['id_rujuk']==13 or $ne10['id_rujuk']==14 or $ne10['id_rujuk']==15 or $ne10['id_rujuk']==16 or $ne10['id_rujuk']==17 or $ne10['id_rujuk']==18 or $ne10['id_rujuk']==19 or $ne10['id_rujuk']==20 ){ $n10=count($ne10['COUNT(detail_insiden.id_rujuk)']); }else{ $n10=""; } echo $n10; } ?></td>
	       <td align="center"><?php while($eee10=$oo10->fetch(PDO::FETCH_ASSOC)){ if ($eee10['id_rujuk']==1 or $eee10['id_rujuk']==2 or $eee10['id_rujuk']==3 or $eee10['id_rujuk']==4 or $eee10['id_rujuk']==5 or $eee10['id_rujuk']==6 or $eee10['id_rujuk']==7 or $eee10['id_rujuk']==8 ){ $xxx10=count($eee10['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx10=""; } echo $xxx10; } ?></td>
	       <td align="center"><?php $nu10 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=10 and rawat='Y' ")->fetchColumn(); if ($nu10>0){ echo $nu10; }else{ echo $nu10=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">11</td>
	       <td align="center">Bus VS Pejalan Kaki</td>
	       <td align="center"><?php $nume40 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=11 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume40>0){ echo $nume40; }else{ echo $nume40=""; } ?></td>
	       <td align="center"><?php $nume41 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=11 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume41>0){ echo $nume41; }else{ echo $nume41=""; } ?></td>
	       <td align="center"><?php $nume42 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=11 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume42>0){ echo $nume42; }else{ echo $nume42=""; } ?></td>
	       <td align="center"><?php $nume43 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=11 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume43>0){ echo $nume43; }else{ echo $nume43=""; } ?></td>
	       <td align="center"><?php while($row11=$query11->fetch(PDO::FETCH_ASSOC)){ if ($row11['Count(insiden.id_kecelakaan)']){ $p11=$row11['Count(insiden.id_kecelakaan)']; }else{ $p11="-"; } echo $p11; } ?></td>
	       <td align="center"><?php while($r11=$q11->fetch(PDO::FETCH_ASSOC)){ if ($r11['kondisi']=="Luka Ringan"){ $p11=count($r11['kondisi']); }else{ $p11=""; } echo $p11; } ?></td>
	       <td align="center"><?php while($t11=$l11->fetch(PDO::FETCH_ASSOC)){ if ($t11['kondisi']=="Luka Sedang"){ $w11=count($t11['kondisi']); }else{ $w11=""; } echo $w11; } ?></td>
	       <td align="center"><?php while($e11=$o11->fetch(PDO::FETCH_ASSOC)){ if ($e11['kondisi']=="Luka Berat"){ $x11=count($e11['kondisi']); }else{ $x11=""; } echo $x11; } ?></td>
	       <td align="center"><?php while($ee11=$ii11->fetch(PDO::FETCH_ASSOC)){ if ($ee11['kondisi']=="Meninggal"){ $xx11=count($ee11['kondisi']); }else{ $xx11=""; } echo $xx11; } ?></td>
	       <td align="center"><?php while($ne11=$nn11->fetch(PDO::FETCH_ASSOC)){ if ($ne11['id_rujuk']==9 or $ne11['id_rujuk']==10 or $ne11['id_rujuk']==11 or $ne11['id_rujuk']==12 or $ne11['id_rujuk']==13 or $ne11['id_rujuk']==14 or $ne11['id_rujuk']==15 or $ne11['id_rujuk']==16 or $ne11['id_rujuk']==17 or $ne1['id_rujuk']==18 or $ne11['id_rujuk']==19 or $ne11['id_rujuk']==20 ){ $n11=count($ne11['COUNT(detail_insiden.id_rujuk)']); }else{ $n11=""; } echo $n11; } ?></td>
	       <td align="center"><?php while($eee11=$oo11->fetch(PDO::FETCH_ASSOC)){ if ($eee11['id_rujuk']==1 or $eee11['id_rujuk']==2 or $eee11['id_rujuk']==3 or $eee11['id_rujuk']==4 or $eee11['id_rujuk']==5 or $eee11['id_rujuk']==6 or $eee11['id_rujuk']==7 or $eee11['id_rujuk']==8 ){ $xxx11=count($eee11['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx11=""; } echo $xxx11; } ?></td>
	       <td align="center"><?php $nu11 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=11 and rawat='Y' ")->fetchColumn(); if ($nu11>0){ echo $nu11; }else{ echo $nu11=""; } ?></td>
	    </tr>
	    <tr>
	       <td align="center">12</td>
	       <td align="center">Pejalan Kaki Tunggal</td>
	       <td align="center"><?php $nume44 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=12 and jenis_kelamin='L' and umur<5")->fetchColumn(); if ($nume44>0){ echo $nume44; }else{ echo $nume44=""; } ?></td>
	       <td align="center"><?php $nume45 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=12 and jenis_kelamin='P' and umur<5")->fetchColumn(); if ($nume45>0){ echo $nume45; }else{ echo $nume45=""; } ?></td>
	       <td align="center"><?php $nume46 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=12 and jenis_kelamin='L' and umur>5")->fetchColumn(); if ($nume46>0){ echo $nume46; }else{ echo $nume46=""; } ?></td>
	       <td align="center"><?php $nume47 = $this->db->query("select count(*) from v_jenis_umur WHERE id_kecelakaan=12 and jenis_kelamin='P' and umur>5")->fetchColumn(); if ($nume47>0){ echo $nume47; }else{ echo $nume47=""; } ?></td>
	       <td align="center"><?php while($row12=$query12->fetch(PDO::FETCH_ASSOC)){ if ($row12['Count(insiden.id_kecelakaan)']){ $p12=$row12['Count(insiden.id_kecelakaan)']; }else{ $p12="-"; } echo $p12; } ?></td>
	       <td align="center"><?php while($r12=$q12->fetch(PDO::FETCH_ASSOC)){ if ($r12['kondisi']=="Luka Ringan"){ $p12=count($r12['kondisi']); }else{ $p12=""; } echo $p12; } ?></td>
	       <td align="center"><?php while($t12=$l12->fetch(PDO::FETCH_ASSOC)){ if ($t12['kondisi']=="Luka Sedang"){ $w12=count($t12['kondisi']); }else{ $w12=""; } echo $w12; } ?></td>
	       <td align="center"><?php while($e12=$o12->fetch(PDO::FETCH_ASSOC)){ if ($e12['kondisi']=="Luka Berat"){ $x12=count($e12['kondisi']); }else{ $x12=""; } echo $x12; } ?></td>
	       <td align="center"><?php while($ee12=$ii12->fetch(PDO::FETCH_ASSOC)){ if ($ee12['kondisi']=="Meninggal"){ $xx12=count($ee12['kondisi']); }else{ $xx12=""; } echo $xx12; } ?></td>
	       <td align="center"><?php while($ne12=$nn12->fetch(PDO::FETCH_ASSOC)){ if ($ne12['id_rujuk']==9 or $ne12['id_rujuk']==10 or $ne12['id_rujuk']==11 or $ne12['id_rujuk']==12 or $ne12['id_rujuk']==13 or $ne12['id_rujuk']==14 or $ne12['id_rujuk']==15 or $ne12['id_rujuk']==16 or $ne12['id_rujuk']==17 or $ne12['id_rujuk']==18 or $ne12['id_rujuk']==19 or $ne12['id_rujuk']==20 ){ $n12=count($ne12['COUNT(detail_insiden.id_rujuk)']); }else{ $n12=""; } echo $n12; } ?></td>
	       <td align="center"><?php while($eee12=$oo12->fetch(PDO::FETCH_ASSOC)){ if ($eee12['id_rujuk']==1 or $eee12['id_rujuk']==2 or $eee12['id_rujuk']==3 or $eee12['id_rujuk']==4 or $eee12['id_rujuk']==5 or $eee12['id_rujuk']==6 or $eee12['id_rujuk']==7 or $eee12['id_rujuk']==8 ){ $xxx12=count($eee12['COUNT(detail_insiden.id_rujuk)']); }else{ $xxx12=""; } echo $xxx12; } ?></td>
	       <td align="center"><?php $nu12 = $this->db->query("select count(*) from v_rawat WHERE id_kecelakaan=12 and rawat='Y' ")->fetchColumn(); if ($nu12>0){ echo $nu12; }else{ echo $nu12=""; } ?></td>
	    </tr>
		<?php
	}

	*/

	

} 