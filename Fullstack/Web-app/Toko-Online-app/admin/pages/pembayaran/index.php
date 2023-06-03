<script>
$('title').text('METODE PEMBAYARAN');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Metode Pembayaran
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Metode Pembayaran</li>
    </ol>
</section>

<!-- Main content -->   
<section class="content">

<?php
    //Validasi untuk menampilkan pesan pemberitahuan saat user menambah pembayaran
    if (isset($_GET['add'])) {
        if ($_GET['add']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Metode pembayaran telah ditambahkan!</div>";
        }else if ($_GET['add']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Metode pembayaran gagal ditambahkan!</div>";
        }    
    }

  
   //Validasi untuk menampilkan pesan pemberitahuan saat user mengubah pembayaran
    if (isset($_GET['edit'])) {
      if ($_GET['edit']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> Metode pembayaran telah diupdate!</div>";
      }else if ($_GET['edit']=='gagal'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> Metode pembayaran gagal diupdate!</div>";
      }    
    }
     //Validasi untuk menampilkan pesan pemberitahuan saat user hapus pembayaran
    if (isset($_GET['hapus'])) {
      if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> Metode pembayaran telah dihapus!</div>";
      }else if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> Metode pembayaran gagal dihapus!</div>";
      }    
    }
?>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- pembayaran -->
            <div class="box box-success">
            <div class="box-header with-border">
                <button type="button" class="btn btn-primary" id="tambah">Tambah</button>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
        
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel_pembayaran" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Nama Rekening</th>
                    <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Koneksi database
                        include '../config/database.php';
                        //perintah sql untuk menampilkan daftar pembayaran
                        $sql="select * from pembayaran order by id_pembayaran desc";
                        $hasil=mysqli_query($kon,$sql);
                        $no=0;
                        //Menampilkan data dengan perulangan while
                        while ($data = mysqli_fetch_array($hasil)):
                        $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['nama_bank']; ?></td>
                        <td><?php echo $data['nama_rekening']; ?></td>
                        <td><?php echo $data['nomor_rekening']; ?></td>
                        <td>
                            <button class="tombol_edit btn btn-warning btn-circle" id_pembayaran="<?php echo $data['id_pembayaran']; ?>" data-toggle="tooltip" title="Edit pembayaran" data-placement="top"><i class="fa fa-edit"></i></button>
                            <a href="pages/pembayaran/hapus.php?id_pembayaran=<?php echo $data['id_pembayaran']; ?>&logo=<?php echo $data['logo'];?>" class="tombol_hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
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
        $('#tabel_pembayaran').DataTable( {
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
    // Tambah pembayaran
    $('#tambah').on('click',function(){
        $.ajax({
            url: 'pages/pembayaran/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Pembayaran';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Edit pembayaran
    $('.tombol_edit').on('click',function(){
        var id_pembayaran = $(this).attr("id_pembayaran");
        $.ajax({
            url: 'pages/pembayaran/edit.php',
            method: 'post',
            data: {id_pembayaran:id_pembayaran},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Pembayaran';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
   // fungsi hapus 
   $('.tombol_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus pembayaran ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>


