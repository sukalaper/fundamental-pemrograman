<?php
session_start();
    require('../../../plugins/fpdf/fpdf.php');
    $pdf = new FPDF('L', 'mm','Letter');

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


    $pdf->SetLineWidth(1);
    $pdf->Line(10,31,270,31);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,32,270,32);
 

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
        $pdf->Cell(30,6,": Semua",0,1);
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
    $pdf->Cell(16,6,'Tanggal',1,0,'C');
    $pdf->Cell(15,6,'Nomor',1,0,'C');
    $pdf->Cell(35,6,'Pelanggan',1,0,'C');
    $pdf->Cell(75,6,'Kota Tujuan',1,0,'C');
    $pdf->Cell(40,6,'Jasa Pengiriman',1,0,'C');
    $pdf->Cell(25,6,'Biaya Produk',1,0,'C');
    $pdf->Cell(25,6,'Ongkir',1,0,'C');
    $pdf->Cell(25,6,'Total',1,1,'C');
    $no=1;
    $sub_total=0;
    $total=0;
    $status='';
    $kondisi="";

    if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"])) $kondisi= "where date(p.tanggal)='".$_GET['dari_tanggal']."' ";
    if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"])) $kondisi= "where date(p.tanggal) between '".$_GET['dari_tanggal']."' and '".$_GET['sampai_tanggal']."'";
   
          
    if ($_GET['status']!='' && $_GET['status_pembayaran']!='') {

        $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
        from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
        $kondisi and p.status='".$_GET['status']."' and p.status_pembayaran='".$_GET['status_pembayaran']."'
        order by id_pesanan desc";

    } else if ($_GET['status']!=''){

        $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
        from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
        $kondisi and p.status='".$_GET['status']."'
        order by id_pesanan desc";

    } else if ($_GET['status_pembayaran']!=''){

        $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
        from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
        $kondisi and p.status_pembayaran='".$_GET['status_pembayaran']."'
        order by id_pesanan desc";

    } else {

        $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan 
        from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan
        $kondisi
        order by id_pesanan desc";
    }
 

    
    $hasil=mysqli_query($kon,$sql);
    $no=1;

    $pdf->SetFont('Arial','',8);
    //Menampilkan data dengan perulangan while
    while ($data = mysqli_fetch_array($hasil)):

        $nomor_pesanan=$data['nomor_pesanan'];
        $result=mysqli_query($kon,"select distinct nomor_pesanan, sum(qty) as jum, sum(harga*qty) as total_harga from pesanan_detail where nomor_pesanan='$nomor_pesanan' group by nomor_pesanan");
        
        while ($row = mysqli_fetch_array($result)):
    

            $pdf->Cell(8,6,$no,1,0);
            $pdf->Cell(16,6,date('d-m-Y', strtotime($data["tanggal"])),1,0);
            $pdf->Cell(15,6,$data['nomor_pesanan'],1,0);
            $pdf->Cell(35,6,$data['nama_pelanggan'],1,0);
            $pdf->Cell(75,6,$data['kabupaten']." ".$data['provinsi'],1,0);
            $pdf->Cell(40,6,strtoupper($data['kurir'])." ".$data['jenis_layanan'],1,0);
            $pdf->Cell(25,6,'Rp. '.number_format(($row['total_harga'])-$data['potongan'],0,',','.'),1,0,'C');
            $pdf->Cell(25,6,'Rp. '.number_format($data['tarif'],0,',','.'),1,0);
            $pdf->Cell(25,6,'Rp. '.number_format(($row['total_harga']+$data['tarif'])-$data['potongan'],0,',','.'),1,1);
            $no++;
        endwhile;
    endwhile;

    //$pdf->Cell(124,6,'Total',1,0);
    //$pdf->Cell(10,6,$total_qty,1,0,'C');
    //$pdf->Cell(30,6,'Rp. '.number_format($total_harga,0,',','.'),1,0);
    //$pdf->Cell(32,6,'Rp. '.number_format($total_sub_total,0,',','.'),1,1);

    
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
    $pdf->Cell(485,15,'',0,1,'C');
    $pdf->Cell(485,12,$daftar_hari[$namahari].','.tanggal($tanggal),0,1,'C');
    $pdf->Cell(485,0,'Mengetahui',0,1,'C');
    $pdf->Cell(485,7,'',0,1,'C');

    $pdf->Cell(485,50,'......................................................',0,1,'C');

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