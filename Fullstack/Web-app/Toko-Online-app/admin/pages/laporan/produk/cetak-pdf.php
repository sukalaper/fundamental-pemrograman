<?php
session_start();
    require('../../../plugins/fpdf/fpdf.php');
    $pdf = new FPDF('P', 'mm','Letter');

    //Membuat Koneksi ke database akademik
    include '../../../../config/database.php';

    $query = mysqli_query($kon, "select * from profil_aplikasi order by nama_aplikasi desc limit 1");    
    $row = mysqli_fetch_array($query);
    
    $nama_aplikasi=ucwords($row['nama_aplikasi']);
    $pdf->AddPage();
    //Membuat header
    $pdf->Image('../../../pages/pengaturan-aplikasi/logo/'.$row['logo'],15,5,20,20);
    $pdf->SetFont('Arial','B',21);
    $pdf->Cell(0,7,strtoupper($row['nama_aplikasi']),0,1,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,7,$row['alamat'].', Telp '.$row['no_telp'],0,1,'C');
    $pdf->Cell(0,7,$row['website'],0,1,'C');

    //Membuat garis (line)
    $pdf->SetLineWidth(1);
    $pdf->Line(10,31,206,31);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,32,206,32);
 

    $tanggal='';
    if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"])){
        $tanggal=date("d/m/Y",strtotime($_GET["dari_tanggal"]));
    }
    if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"])){
        $tanggal=date("d/m/Y",strtotime($_GET["dari_tanggal"]))." - ".date("d/m/Y",strtotime($_GET["sampai_tanggal"]));
    }
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,6,'Tanggal',0,0);
    $pdf->Cell(30,6,": ".$tanggal,0,1);

    $pdf->Cell(30,6,'Status Pesanan',0,0);

    if ($_GET['status']!=''){
        switch ($_GET['status']){
            case '0' : $pdf->Cell(30,6,": Ditahan",0,1); break;
            case '1' : $pdf->Cell(30,6,": Pembayaran tertunda",0,1); break;
            case '2' : $pdf->Cell(30,6,": Sedang diproses",0,1); break;
            case '3' : $pdf->Cell(30,6,": Dikirim",0,1); break;
            case '4' : $pdf->Cell(30,6,": Selesai",0,1); break;
            case '5' : $pdf->Cell(30,6,": Dibatalkan",0,1); break; 
        }
    }else {
        $pdf->Cell(30,6,"Semua",0,1);
    }

    $pdf->Cell(30,6,'Status Pembayaran',0,0);

    if ($_GET['status_pembayaran']!=''){
        switch ($_GET['status_pembayaran']){
            case '0' : $pdf->Cell(30,6,": Belum Dibayar",0,1); break;
            case '1' : $pdf->Cell(30,6,": Telah Dibayar",0,1); break;
        }
    }else {
        $pdf->Cell(30,6,": Semua",0,1);
    }

    
    $pdf->Cell(10,3,'',0,1);
    $pdf->Cell(8,6,'No',1,0,'C');
    $pdf->Cell(20,6,'Nomor',1,0,'C');
    $pdf->Cell(21,6,'Tanggal',1,0,'C');
    $pdf->Cell(75,6,'Produk',1,0,'C');
    $pdf->Cell(10,6,'QTY',1,0,'C');
    $pdf->Cell(30,6,'Harga',1,0,'C');
    $pdf->Cell(32,6,'Sub Total',1,1,'C');
    $no=1;
    $sub_total=0;
    $total=0;
    $status='';
    $kondisi="";

    if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"])) $kondisi= "where date(p.tanggal)='".$_GET['dari_tanggal']."' ";
    if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"])) $kondisi= "where date(p.tanggal) between '".$_GET['dari_tanggal']."' and '".$_GET['sampai_tanggal']."'";
   
    if ($_GET['status']!='' && $_GET['status_pembayaran']!='') {

        $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
        from pesanan p
        inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
        inner join produk k on k.kode_produk=d.kode_produk
        inner join kategori t on t.id_kategori=k.kategori
        $kondisi and p.status='".$_GET['status']."' and p.status_pembayaran='".$_GET['status_pembayaran']."'
        order by p.tanggal desc";

    } else if ($_GET['status']!=''){

        $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
        from pesanan p
        inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
        inner join produk k on k.kode_produk=d.kode_produk
        inner join kategori t on t.id_kategori=k.kategori
        $kondisi and p.status='".$_GET['status']."'
        order by p.tanggal desc";

    } else if ($_GET['status_pembayaran']!=''){

        $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
        from pesanan p
        inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
        inner join produk k on k.kode_produk=d.kode_produk
        inner join kategori t on t.id_kategori=k.kategori
        $kondisi and p.status_pembayaran='".$_GET['status_pembayaran']."'
        order by p.tanggal desc";

    } else {

        $sql="select p.*, k.nama_produk,d.*,t.*,p.status as status_pesanan
        from pesanan p
        inner join pesanan_detail d on p.nomor_pesanan=d.nomor_pesanan
        inner join produk k on k.kode_produk=d.kode_produk
        inner join kategori t on t.id_kategori=k.kategori
        $kondisi
        order by p.tanggal desc";
    }

    
    $hasil=mysqli_query($kon,$sql);
    $no=1;
    $status='';
    $total_harga=0;
    $total_sub_total=0;
    $total_qty=0;
    $pdf->SetFont('Arial','',8);
    //Menampilkan data dengan perulangan while
    while ($data = mysqli_fetch_array($hasil)):
        $total_qty+=$data['qty'];
        $total_harga+=$data['harga'];
        $total_sub_total+=$data['harga']*$data['qty'];

        $pdf->Cell(8,6,$no,1,0);
        $pdf->Cell(20,6,$data['nomor_pesanan'],1,0);
        $pdf->Cell(21,6,date('d-m-Y', strtotime($data["tanggal"])),1,0);
        $pdf->Cell(75,6,$data['nama_produk'],1,0);
        $pdf->Cell(10,6,$data['qty'],1,0,'C');
        $pdf->Cell(30,6,'Rp. '.number_format($data['harga'],0,',','.'),1,0);
        $pdf->Cell(32,6,'Rp. '.number_format($data['harga']*$data['qty'],0,',','.'),1,1);
        $no++;
    endwhile;

    $pdf->Cell(124,6,'Total',1,0);
    $pdf->Cell(10,6,$total_qty,1,0,'C');
    $pdf->Cell(30,6,'Rp. '.number_format($total_harga,0,',','.'),1,0);
    $pdf->Cell(32,6,'Rp. '.number_format($total_sub_total,0,',','.'),1,1);

    
    $daftar_hari = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
      );

    $tanggal=date('Y-m-d');

    $namahari = date('l', strtotime($tanggal));


    $pdf->SetFont('Arial','',8);
    $pdf->Cell(340,15,'',0,1,'C');
    $pdf->Cell(340,12,$daftar_hari[$namahari].','.tanggal($tanggal),0,1,'C');
    $pdf->Cell(340,0,'Mengetahui',0,1,'C');
    $pdf->Cell(340,7,'',0,1,'C');

    $pdf->Cell(340,50,'......................................................',0,1,'C');

    
    $pdf->SetTitle('Laporan Penjualan '.$nama_aplikasi);

 
    $pdf->Output();
?>


<?php
    function tanggal($tanggal)
    {
        $bulan = array (1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
        );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }
?>