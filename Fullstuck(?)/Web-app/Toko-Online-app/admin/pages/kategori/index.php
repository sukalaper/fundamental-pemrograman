<script>
$('title').text('DAFTAR KATEGORI');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Kategori
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kategori</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<?php
    if (isset($_GET['tambah'])) {
        if ($_GET['tambah']=='berhasil'){
            echo"<div class='alert alert-success'>Kategori telah ditambah</div>";
        } 
    }
?>

    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- Kategori -->
            <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Kategori</h3>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
                <button type="button" class="btn btn-primary" id="tambah_kategori">Tambah</button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
            
                            <tbody>
                            <?php
                                // include database
                                include '../config/database.php';
                            
                                $sql="select * from kategori";
                                $hasil=mysqli_query($kon,$sql);
                                $no=0;
                                //Menampilkan data dengan perulangan while
                                while ($data = mysqli_fetch_array($hasil)):
                                $no++;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td> <a href="index.php?page=kategori&id_kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></a> </td>
                                <td>
                                    <button id_kategori="<?php echo $data['id_kategori'];?>" class="edit_kategori btn btn-warning btn-circle" ><i class="fa fa-pencil-square-o"></i></button>
                                    <a href="pages/kategori/hapus-kategori.php?id_kategori=<?php echo $data['id_kategori']; ?>" class="hapus_kategori btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <!-- bagian akhir (penutup) while -->
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <p>Info : Klik salah satu kategori untuk dapat melihat sub kategorinya.</p>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <!-- Kategori -->
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Sub Kategori</h3>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
                

                <?php if (isset($_GET['id_kategori'])): ?>
                    <button type="button" class="btn btn-primary" id_kategori="<?php echo $_GET['id_kategori']; ?>" id="tambah_sub_kategori">Tambah</button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sub Kategori</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
            
                            <tbody>
                            <?php
                                // include database
                                include '../config/database.php';
                                $id_kategori=$_GET['id_kategori'];
                                $sql="select * from sub_kategori where id_kategori='$id_kategori'";
                                $hasil=mysqli_query($kon,$sql);
                                $no=0;
                                //Menampilkan data dengan perulangan while
                                while ($data = mysqli_fetch_array($hasil)):
                                $no++;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama_sub_kategori']; ?> </td>
                                <td>
                                    <button id_sub_kategori="<?php echo $data['id_sub_kategori'];?>" class="edit_sub_kategori btn btn-warning btn-circle" ><i class="fa fa-pencil-square-o"></i></button>
                                    <a href="pages/kategori/hapus-sub-kategori.php?id_sub_kategori=<?php echo $data['id_sub_kategori']; ?>&id_kategori=<?php echo $data['id_kategori']; ?>" class="hapus_sub_kategori btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <!-- bagian akhir (penutup) while -->
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
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
    // Tambah kategori
    $('#tambah_kategori').on('click',function(){
        $.ajax({
            url: 'pages/kategori/tambah-kategori.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Kategori';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Tambah sub kategori
    $('#tambah_sub_kategori').on('click',function(){
        var id_kategori = $(this).attr("id_kategori");
        $.ajax({
            url: 'pages/kategori/tambah-sub-kategori.php',
            method: 'post',
            data: {id_kategori:id_kategori},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Sub Kategori';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Edit pemasukan
    $('.edit_kategori').on('click',function(){
        var id_kategori = $(this).attr("id_kategori");
        $.ajax({
            url: 'pages/kategori/edit-kategori.php',
            method: 'post',
            data: {id_kategori:id_kategori},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Kategori';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Edit pengeluaran
    $('.edit_sub_kategori').on('click',function(){
        var id_sub_kategori = $(this).attr("id_sub_kategori");
        $.ajax({
            url: 'pages/kategori/edit-sub-kategori.php',
            method: 'post',
            data: {id_sub_kategori:id_sub_kategori},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Sub Kategori';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
   // Konfirmasi hapus kategori
   $('.hapus_kategori').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus kategori ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>

<script>
   // fungsi hapus pengeluaran
   $('.hapus_sub_kategori').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus sub kategori ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>


