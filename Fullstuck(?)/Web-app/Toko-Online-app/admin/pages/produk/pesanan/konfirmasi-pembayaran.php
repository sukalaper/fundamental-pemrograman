
<?php
    //Mengambil data pembayaran
    $nomor_pesanan=$_POST["nomor_pesanan"];
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM konfirmasi k inner join pembayaran p on p.id_pembayaran=k.id_pembayaran where nomor_pesanan='$nomor_pesanan'");
    $data = mysqli_fetch_array($query);
    $jum = mysqli_num_rows($query);

    if ($jum<1){
        echo"<div class='alert alert-info'>Pelanggan belum melakukan konfirmasi pembayaran.</div>";
      
    }
?>
    <?php if ($jum>=1):?>
    <div id="tabel_konfirmasi">
        <?php if (isset($data['gambar'])):?>
        <img src="../pages/menu-pelanggan/gambar/<?php echo $data['gambar'];?>" id="preview" class="img-thumbnail">
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th style="width:30%">Nomor Pesanan:</th>
                    <td>#<?php if (isset($nomor_pesanan)) echo $nomor_pesanan?></td>
                </tr>
                <tr>
                    <th>Tanggal Transfer:</th>
                    <td><?php if (isset($data['tanggal_transfer'])) echo tanggal($data['tanggal_transfer']);?></td>
                </tr>
                <tr>
                    <th>Ditransfer Ke:</th>
                    <td><?php if (isset($data['nama_bank'])) echo $data['nama_bank']." - ".$data['nomor_rekening']." - ".$data['nama_rekening']; ?></td>
                </tr>
                <tr>
                    <th>Bank Asal:</th>
                    <td><?php if (isset($data['bank_asal'])) echo $data['bank_asal'];?></td>
                </tr>
                <tr>
                    <th>Nama Rekening:</th>
                    <td><?php if (isset($data['nama_rekening'])) echo $data['nama_rekening'];?></td>
                </tr>
                <tr>
                    <th>Jumlah Uang:</th>
                    <td>Rp. <?php if (isset($data['jumlah_uang'])) echo number_format($data['jumlah_uang'],0,',','.'); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <div id="status_bayar">
        <form action="pages/pesanan/update-status-pembayaran.php" method="post">
        <?php
            //Mengambil data pembayaran
            $nomor_pesanan=$_POST["nomor_pesanan"];
            include '../../../config/database.php';
            $query = mysqli_query($kon, "SELECT status_pembayaran from pesanan where nomor_pesanan='$nomor_pesanan'");
            $data = mysqli_fetch_array($query);
    
        ?>
            <div class="form-group">
                <label>Status Pembayaran:</label>
                <select class="form-control" name="status_pembayaran">
                    <option value="0" <?php if ($data['status_pembayaran']=='0') echo "selected"?> >Belum Bayar</option>
                    <option value="1" <?php if ($data['status_pembayaran']=='1') echo "selected"?> >Telah Bayar</option>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="nomor_pesanan" class="form-control" value="<?php echo $nomor_pesanan; ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="Update" id="update" class="btn btn-success">Update</button>
                <button type="button" name="kembali" id="kembali" class="btn btn-default">Kembali</button>
            </div>
        </form>
    </div>
    <div class="form-group">
        <button type="button" name="konfirmasi" id="konfirmasi" class="btn btn-primary">Konfirmasi Langsung</button>
    </div>


<script>

    $('#status_bayar').hide();


    $('#konfirmasi').on('click',function(){
        $('#status_bayar').show();
        $('#tabel_konfirmasi').hide();
        $('#konfirmasi').hide();
    });

    $('#kembali').on('click',function(){
        $('#status_bayar').hide();
        $('#tabel_konfirmasi').show();
        $('#konfirmasi').show();
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

<script>
   $('#update').on('click',function(){
        konfirmasi=confirm("Anda yakin ingin mengubah status pembayaran? Stok produk akan di kurangi sesuai qty produk pada pesanan ini!")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>

