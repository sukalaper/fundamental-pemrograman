<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tabel">
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nomor</th>
        <th>Pelanggan</th>
        <th>Kota Tujuan</th>
        <th>Jasa Pengiriman</th>
        <th>Biaya Produk</th>
        <th>Ongkir</th>
        <th>Total</th>
        <th>Status</th>
        <th>Pembayaran</th>
        <th>Detail</th>
        <th>Hapus</th>
    </tr>
    </thead>
    <tbody>
        <?php
            //Koneksi database
            include '../../../config/database.php';
            
            if (isset($_POST['bulan'])){
                $bulan=$_POST['bulan'];
                $tahun=$_POST['tahun'];
                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan where  month(p.tanggal)='".$bulan."' and year(p.tanggal)='".$tahun."' order by id_pesanan desc";
            }else {
                $sql="select p.*,p.status as status_pesanan, n.nama_pelanggan from pesanan p inner join pelanggan n on p.kode_pelanggan=n.kode_pelanggan order by id_pesanan desc";
            }
            $jum=0;
           
            $hasil=mysqli_query($kon,$sql);
            $jum = mysqli_num_rows($hasil);
            $no=0;
            $jum_produk=0;
            $total_bayar=0;
            $status="";
            $status_pembayaran="";
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
                $no++;
                $nomor_pesanan=$data['nomor_pesanan'];
                $result=mysqli_query($kon,"select distinct nomor_pesanan, sum(qty) as jum, sum(harga*qty) as total_harga from pesanan_detail where nomor_pesanan='$nomor_pesanan' group by nomor_pesanan");
                
                while ($row = mysqli_fetch_array($result)):
                
                    $tanggal=date("Y-m-d",strtotime($data["tanggal"]));

                    switch ($data['status_pesanan']){
                        case '0' : $status="<span class='label label-default'>Ditahan</span>";break;
                        case '1' : $status="<span class='label label-warning'>Pembayaran tertunda</span>";break;
                        case '2' : $status="<span class='label label-info'>Sedang diproses</span>";break;
                        case '3' : $status="<span class='label label-primary'>Dikirim</span>";break;
                        case '4' : $status="<span class='label label-success'>Selesai</span>";break;
                        case '5' : $status="<span class='label label-danger'>Dibatalkan</span>";break;
                        default :  $status='-';

                    }

                    switch ($data['status_pembayaran']){
                        case '0' : $status_pembayaran="<span class='label label-default'>Belum Dibayar</span>";break;
                        case '1' : $status_pembayaran="<span class='label label-success'>Telah Dibayar</span>";break;
                        default :  $status_pembayaran='-';

                    }

                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo tanggal($tanggal); ?> </td>
                
                        <td><?php echo $data['nomor_pesanan']; ?></td>
                        <td><?php echo $data['nama_pelanggan']; ?></td>
                        <td><?php echo $data['kabupaten']; ?>, <?php echo $data['provinsi']; ?></td>
                        <td><?php echo strtoupper($data['kurir']); ?> - <small><?php echo $data['jenis_layanan']; ?></small></td>
                        <td>Rp. <?php echo number_format(($row['total_harga'])-$data['potongan'],0,',','.'); ?></td>
                        <td>Rp. <?php echo number_format($data['tarif'],0,',','.'); ?></td>
                        <td>Rp. <?php echo number_format(($row['total_harga']+$data['tarif'])-$data['potongan'],0,',','.'); ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $status_pembayaran; ?></td>
                        <td>
                            <a href="index.php?page=detail-pesanan&nomor_pesanan=<?php echo $data['nomor_pesanan']; ?>" class="btn btn-primary btn-circle" ><i class="fa fa-mouse-pointer"></i></a>
                        </td>
                        <td>  
                        <button nomor_pesanan="<?php echo $data['nomor_pesanan'];?>" status_pembayaran="<?php echo $data['status_pembayaran'];?>" class="tombol_hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php
                endwhile;
            endwhile;
        ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tabel').DataTable( {
            "searching": true,
            "paging":   true,
            "ordering": true,
            "info":     true,
            dom: 'Bfrtip',
            buttons: ['excel','copy']
        });
    });
</script>

<script>
   // fungsi hapus
   $('.tombol_hapus').on('click',function(){
        var nomor_pesanan = $(this).attr("nomor_pesanan");
        var status_pembayaran = $(this).attr("status_pembayaran");

        if (status_pembayaran==1){
            var agree=confirm("Adakah Anda yakin ingin menghapus pesanan #"+nomor_pesanan+"? Stok produk akan di kembalikan!");
        }else {
            var agree=confirm("Adakah Anda yakin ingin menghapus pesanan #"+nomor_pesanan+"?");
        }
       
        if (!agree){
            return false;
        } else {
            var nomor_pesanan = $(this).attr("nomor_pesanan");
            var status_pembayaran = $(this).attr("status_pembayaran");
            $.ajax({
                url: 'pages/pesanan/hapus.php',
                method: 'post',
                data: {nomor_pesanan:nomor_pesanan,status_pembayaran:status_pembayaran},
                success:function(data){
                    data_pesanan();
                    $('#pemberitahuan').show(500);
                    $('#pemberitahuan').html("<div class='alert alert-success'>Pesanan #<strong>"+nomor_pesanan+"</strong> telah dihapus!</div>");  
                    setTimeout(function(){
                        $('#pemberitahuan').hide(500);
                    },2000);  
                }
            });
        }
    });
</script>

<?php 
    //Membuat format tanggal
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