<?php
    //Memanggil plugin FPDF
    require('../../../assets/plugin/fpdf/fpdf.php');
    $pdf = new FPDF('P', 'mm','Letter');

    //Koneksi database
    include '../../../config/database.php';
    

    //Mengambil data profil aplikasi
    $query = mysqli_query($kon, "select * from profil_aplikasi order by nama_aplikasi desc limit 1");    
    $row = mysqli_fetch_array($query);

    //Membuat Header page
    $pdf->AddPage();
    $pdf->Image('../../../page/aplikasi/logo/'.$row['logo'],15,5,30,30);
    $pdf->SetFont('Arial','B',21);
    $pdf->Cell(0,7,strtoupper($row['nama_aplikasi']),0,1,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,7,$row['alamat'].', Telp '.$row['no_telp'],0,1,'C');
    $pdf->Cell(0,7,$row['website'],0,1,'C');
    $pdf->Cell(15,7,'',0,1);

    $level=$_GET['level'];

    //Membuat garis (line)
    $pdf->SetLineWidth(1);
    $pdf->Line(10,38,206,38);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,39,206,39);
    
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,5,'',0,1,'C');
    $pdf->Cell(0,7,'DAFTAR '.strtoupper($level),0,1,'C');
 

    $pdf->Cell(10,3,'',0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(8,6,'No',1,0,'C');
    $pdf->Cell(15,6,'Kode',1,0,'C');
    $pdf->Cell(60,6,'Nama',1,0,'C');
    $pdf->Cell(40,6,'Email',1,0,'C');
    $pdf->Cell(28,6,'No Telp',1,0,'C');
    $pdf->Cell(25,6,'Level',1,0,'C');
    $pdf->Cell(22,6,'Status',1,1,'C');
    
    $pdf->SetFont('Arial','',10);

    $no=1;
    $status="";
    $level=$_GET['level'];

    //Perintah SQL
    $hasil = mysqli_query($kon, "select * from pengguna where level='$level' order by id_pengguna desc");
    while ($data = mysqli_fetch_array($hasil)){

        if ($data['status']==1){
            $status="Aktif";
        }else {
            $status="Tidak Aktif";
        }
        $pdf->Cell(8,6,$no,1,0);
        $pdf->Cell(15,6,$data['kode_pengguna'],1,0);
        $pdf->Cell(60,6, substr($data['nama_pengguna'], 0, 33),1,0);
        $pdf->Cell(40,6,$data['email'],1,0,'C');
        $pdf->Cell(28,6,$data['no_telp'],1,0);
        $pdf->Cell(25,6,$data['level'],1,0);
        $pdf->Cell(22,6,$status,1,1);
        $no++;
    }

    $pdf->Output();
?>