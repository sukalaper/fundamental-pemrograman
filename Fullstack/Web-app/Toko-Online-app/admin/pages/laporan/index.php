<script>
$('title').text('LAPORAN PESANAN');
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Laporan
    <small><span id="keterangan"></span></small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Laporan</a></li>
    <li class="active">Pesanan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<?php 
    if(isset($_GET['sub-menu'])){
        $sub_menu = $_GET['sub-menu'];
    
        switch ($sub_menu) {
            case 'produk':
                include "produk/index.php";
                break;
            case 'pesanan':
                include "pesanan/index.php";
                break;
        default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }
?>
</section>
<!-- /.content -->

