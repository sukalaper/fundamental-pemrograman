<script>
$('title').text('DAFTAR VOUCHER');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Voucher
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Voucher</li>
    </ol>
</section>

<!-- Main content -->   
<section class="content">

<?php
    //Validasi untuk menampilkan pesan pemberitahuan saat user menambah voucher
    if (isset($_GET['add'])) {
        if ($_GET['add']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> voucher telah ditambahkan!</div>";
        }else if ($_GET['add']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong>voucher gagal ditambahkan!</div>";
        }    
    }

  
   //Validasi untuk menampilkan pesan pemberitahuan saat user mengubah voucher
    if (isset($_GET['edit'])) {
      if ($_GET['edit']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong>voucher telah diupdate!</div>";
      }else if ($_GET['edit']=='gagal'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong>voucher gagal diupdate!</div>";
      }    
    }
     //Validasi untuk menampilkan pesan pemberitahuan saat user hapus voucher
    if (isset($_GET['hapus'])) {
      if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong>voucher telah dihapus!</div>";
      }else if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong>voucher gagal dihapus!</div>";
      }    
    }
?>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- voucher -->
            <div class="box box-success">
            <div class="box-header with-border">
                <button type="button" class="btn btn-primary" id="tambah">Tambah</button>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
        
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel_voucher" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kode Voucher</th>
                    <th>Tipe</th>
                    <th>Nominal</th>
                    <th>Berlaku</th>
                    <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Koneksi database
                        include '../config/database.php';
                        //perintah sql untuk menampilkan daftar voucher
                        $sql="select * from voucher order by id_voucher desc";
                        $hasil=mysqli_query($kon,$sql);
                        $no=0;
                        //Menampilkan data dengan perulangan while
                        while ($data = mysqli_fetch_array($hasil)):
                        $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['nama_voucher']; ?></td>
                        <td><?php echo $data['kode_voucher']; ?></td>
                        <td><?php echo $data['tipe'] == 1 ? 'Persentase' : 'Potongan Tetap'; ?></td>
                        <td>
                        <?php 
                            if ($data['tipe']==1){
                                echo $data['nominal']." %";
                            }else if($data['tipe']==2){
                                echo "Rp. ".number_format($data['nominal'],2,',','.'); 
                            }
                        
                        ?>
                        </td>
                        <td><?php echo date('d-m-Y', strtotime($data["berlaku"])); ?></td>
                        <td>
                            <button class="tombol_pilih_pelanggan btn btn-info btn-circle" kode_voucher="<?php echo $data['kode_voucher']; ?>"  ><i class="fa fa-mouse-pointer"></i></button>
                            <button class="tombol_edit btn btn-warning btn-circle" id_voucher="<?php echo $data['id_voucher']; ?>" data-toggle="tooltip" title="Edit voucher" data-placement="top"><i class="fa fa-edit"></i></button>
                            <a href="pages/voucher/hapus.php?kode_voucher=<?php echo $data['kode_voucher']; ?>" class="tombol_hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <!-- bagian akhir (penutup) while -->
                    <?php endwhile; ?>
                </tbody>
                </table>
            </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- jQuery 3 -->




<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <div id="tampil_data">
                 <!-- Data akan di load menggunakan AJAX -->                   
            </div>  
        </div>
  
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tabel_voucher').DataTable( {
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
    // Tambah voucher
    $('#tambah').on('click',function(){
        $.ajax({
            url: 'pages/voucher/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Voucher';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Edit voucher
    $('.tombol_pilih_pelanggan').on('click',function(){
        var kode_voucher = $(this).attr("kode_voucher");
        $.ajax({
            url: 'pages/voucher/pilih-pelanggan.php',
            method: 'post',
            data: {kode_voucher:kode_voucher},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Pilih Pelanggan';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Edit voucher
    $('.tombol_edit').on('click',function(){
        var id_voucher = $(this).attr("id_voucher");
        $.ajax({
            url: 'pages/voucher/edit.php',
            method: 'post',
            data: {id_voucher:id_voucher},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Voucher';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
   // fungsi hapus 
   $('.tombol_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus voucher ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>


