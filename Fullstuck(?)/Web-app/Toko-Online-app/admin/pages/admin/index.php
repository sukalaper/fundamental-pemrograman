<script>
$('title').text('DAFTAR ADMIN');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Admin
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Admin</li>
    </ol>
</section>

<!-- Main content -->   
<section class="content">

<?php
    //Validasi untuk menampilkan pesan pemberitahuan saat user menambah admin
    if (isset($_GET['add'])) {
        if ($_GET['add']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Admin telah ditambahkan!</div>";
        }else if ($_GET['add']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Admin gagal ditambahkan!</div>";
        }    
    }

    if (isset($_GET['pengaturan-pengguna'])) {
        if ($_GET['pengaturan-pengguna']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Pengaturan Pengguna telah diperbaharui!</div>";
        }else if ($_GET['pengaturan-pengguna']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Pengaturan Pengguna gagal diperbaharui!</div>";
        }    
    }
  
   //Validasi untuk menampilkan pesan pemberitahuan saat user mengubah admin
    if (isset($_GET['edit'])) {
      if ($_GET['edit']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> Admin telah diupdate!</div>";
      }else if ($_GET['edit']=='gagal'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> Admin gagal diupdate!</div>";
      }    
    }
     //Validasi untuk menampilkan pesan pemberitahuan saat user hapus admin
    if (isset($_GET['hapus'])) {
      if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> Admin telah dihapus!</div>";
      }else if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> Admin gagal dihapus!</div>";
      }    
    }
?>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- admin -->
            <div class="box box-success">
            <div class="box-header with-border">
                <button type="button" class="btn btn-primary" id="tambah">Tambah</button>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
        
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel_admin" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Telp</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Koneksi database
                        include '../config/database.php';
                        //perintah sql untuk menampilkan daftar admin
                        $sql="select * from admin order by id_admin desc";
                        $hasil=mysqli_query($kon,$sql);
                        $no=0;
                        //Menampilkan data dengan perulangan while
                        while ($data = mysqli_fetch_array($hasil)):
                        $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['kode_admin']; ?></td>
                        <td><?php echo $data['nama_admin']; ?></td>
                        <td><?php echo $data['telp']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['status'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                        <td>
                            <button kode_admin="<?php echo $data['kode_admin'];?>" class="tombol_pengaturan btn btn-primary btn-circle" ><i class="fa fa-user"></i></button>
                            <button class="tombol_edit btn btn-warning btn-circle" id_admin="<?php echo $data['id_admin']; ?>" kode_admin="<?php echo $data['kode_admin']; ?>" data-toggle="tooltip" title="Edit admin" data-placement="top"><i class="fa fa-edit"></i></button>
                            <a href="pages/admin/hapus.php?id_admin=<?php echo $data['id_admin']; ?>&foto=<?php echo $data['foto'];?>" class="tombol_hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
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
        $('#tabel_admin').DataTable( {
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
    // Tambah admin
    $('#tambah').on('click',function(){
        $.ajax({
            url: 'pages/admin/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Admin';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Setting akun pengguna
    $('.tombol_pengaturan').on('click',function(){
        var kode_admin = $(this).attr("kode_admin");
        $.ajax({
            url: 'pages/admin/pengaturan-pengguna.php',
            method: 'post',
            data: {kode_admin:kode_admin},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Pengaturan Pengguna';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Edit admin
    $('.tombol_edit').on('click',function(){
        var id_admin = $(this).attr("id_admin");
        $.ajax({
            url: 'pages/admin/edit.php',
            method: 'post',
            data: {id_admin:id_admin},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit admin';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
   // fungsi hapus 
   $('.tombol_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus Admin ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>


