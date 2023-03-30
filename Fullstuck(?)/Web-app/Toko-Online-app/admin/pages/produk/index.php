<script>
$('title').text('DAFTAR PRODUK');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Produk
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Produk</li>
    </ol>
</section>

<!-- Main content -->   
<section class="content">

<?php
    //Validasi untuk menampilkan pesan pemberitahuan saat user menambah produk
    if (isset($_GET['add'])) {
        if ($_GET['add']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> produk telah ditambahkan!</div>";
        }else if ($_GET['add']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> produk gagal ditambahkan!</div>";
        }    
    }

    if (isset($_GET['pengaturan-pengguna'])) {
        if ($_GET['pengaturan-pengguna']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Pengaturan Pengguna telah diperbaharui!</div>";
        }else if ($_GET['pengaturan-pengguna']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Pengaturan Pengguna gagal diperbaharui!</div>";
        }    
    }
  
   //Validasi untuk menampilkan pesan pemberitahuan saat user mengubah produk
    if (isset($_GET['edit'])) {
      if ($_GET['edit']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> produk telah diupdate!</div>";
      }else if ($_GET['edit']=='gagal'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> produk gagal diupdate!</div>";
      }    
    }
     //Validasi untuk menampilkan pesan pemberitahuan saat user hapus produk
    if (isset($_GET['hapus'])) {
      if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> produk telah dihapus!</div>";
      }else if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> produk gagal dihapus!</div>";
      }    
    }
?>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- produk -->
            <div class="box box-success">
            <div class="box-header with-border">
                <button type="button" class="btn btn-primary" id="tambah">Tambah</button>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
        
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tabel_produk" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th width="13%">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // include database
                                    include '../config/database.php';
                                    // perintah sql untuk menampilkan daftar produk yang berelasi dengan tabel kategori produk
                                    $sql="select * from produk p left join kategori k on k.id_kategori=p.kategori left join sub_kategori s on s.id_sub_kategori=p.sub_kategori order by p.id_produk desc";
                                    $hasil=mysqli_query($kon,$sql);
                                    $no=0;
                                    //Menampilkan data dengan perulangan while
                                    while ($data = mysqli_fetch_array($hasil)):
                                    $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data['kode_produk']; ?></td>
                                    <td><?php echo $data['nama_produk']; ?></td>
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td><?php echo $data['nama_sub_kategori']; ?></td>
                                    <td><?php echo $data['stok']; ?></td>
                                    <td>Rp. <?php echo number_format($data['harga'],2,',','.'); ?></td>
                                    <td>
                                        <button class="tombol_edit btn btn-warning btn-circle" id_produk="<?php echo $data['id_produk']; ?>"  kode_produk="<?php echo $data['kode_produk']; ?>"><i class="fa fa-edit"></i></button>
                                        <a href="pages/produk/hapus.php?id_produk=<?php echo $data['id_produk']; ?>&gambar=<?php echo $data['gambar'];?>" class="tombol_hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
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
        $('#tabel_produk').DataTable( {
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
    // Tambah produk
    $('#tambah').on('click',function(){
        $.ajax({
            url: 'pages/produk/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah produk';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Edit produk
    $('.tombol_edit').on('click',function(){
        var id_produk = $(this).attr("id_produk");
        $.ajax({
            url: 'pages/produk/edit.php',
            method: 'post',
            data: {id_produk:id_produk},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Produk';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
   // fungsi hapus 
   $('.tombol_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus produk ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>


