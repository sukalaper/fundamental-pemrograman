<div id='ajax-wait'>
        <img alt='loading...' src='../admin/dist/img/loading.gif' />
</div>
<div class="form-group">
    <label>
        <input type="checkbox" class="minimal" onClick="toggle(this)" type="checkbox" value="">
        Centang Semua
    </label>
</div>
<form method="post" id="form_pelanggan">
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Voucher</th>
        <th width="12%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            //Koneksi database
            include '../../../config/database.php';
            $kode_voucher=$_GET['kode_voucher'];
            $sql="select p.*,v.kode_voucher,v.aktif from pelanggan p left join penerima_voucher v on v.id_pelanggan=p.id_pelanggan where kode_voucher='$kode_voucher' order by p.id_pelanggan desc";
            $hasil=mysqli_query($kon,$sql);
            $no=0;
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            $no++;

            
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['kode_pelanggan']; ?></td>
            <td><?php echo $data['nama_pelanggan']; ?></td>
            <td><?php if ($data['aktif']==1) echo "<span class='label label-success'>Ya</span>"; ?> <?php if ($data['aktif']==0) echo "<span class='label label-danger'>Tidak</span>"; ?> </td>
            <td>
                <label>
                  <input type="checkbox" name="pilih[]" class="minimal" value="<?php echo $data['id_pelanggan'];?>" <?php if ($data['aktif']==1) echo "checked"; ?> >
                </label>
    
            </td>
        </tr>
        <!-- bagian akhir (penutup) while -->
        <?php endwhile; ?>
    </tbody>
    </table>
</div>
<div class="form-group">
    <input type="hidden" name="kode_voucher" value="<?php echo $_GET['kode_voucher']; ?>" class="form-control">
</div>
<button type="button" id="simpan"  class="btn btn-primary">Simpan</button>
</form>



<style>
    #ajax-wait {
        display: none;
        position: fixed;
        z-index: 1000;
    }
</style>


<script> 
    function toggle(pilih) { 
        checkboxes = document.getElementsByName('pilih[]');
        for(var i=0, n=checkboxes.length;i<n;i++){
            checkboxes[i].checked = pilih.checked;
        }
    } 
</script>

<script>
    $('#simpan').on('click',function(){
        loading();
        var data = $('#form_pelanggan').serialize();
        $.ajax({
            url: 'pages/voucher/update-penerima.php',
            method: 'post',
            data: data,
            cache	: false,
            success:function(data){
                $('#tabel-pelanggan').load("pages/voucher/tabel-pelanggan.php?kode_voucher=<?php echo $_GET['kode_voucher'];?>");
            }
        });
    });
</script>

<script>

function loading(){

    $( document ).ajaxStart(function() {
    $( "#ajax-wait" ).css({
        left: ( $( window ).width() - 32 ) / 2 + "px", // 32 = lebar gambar
        top: ( $( window ).height() - 32 ) / 2 + "px", // 32 = tinggi gambar
        display: "block"
    })
    })
    .ajaxComplete( function() {
        $( "#ajax-wait" ).fadeOut();
    });

 }
</script>
