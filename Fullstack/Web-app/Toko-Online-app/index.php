<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();

include 'config/database.php';
$sql="select * from profil_aplikasi limit 1";
$hasil = mysqli_query($kon,$sql);
$row = mysqli_fetch_array($hasil)

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $row['nama_aplikasi'];?></title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--//fonts-->
<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/etalage.css" type="text/css" media="all" />
<script src="js/jquery.etalage.min.js"></script>
<script>
	jQuery(document).ready(function($){

		$('#etalage').etalage({
			thumb_image_width: 300,
			thumb_image_height: 400,
			source_image_width: 900,
			source_image_height: 1200,
			show_hint: true,
			click_callback: function(image_anchor, instance_id){
				alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
			}
		});

	});
</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--script-->

<style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
  </style>

  <script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
  </script>

  
</head>
<body>
	
<div class="preloader">
  <div class="loading">
    <img src="images/animasi_loading.gif">
  </div>
</div>



	<!--header-->
	<div class="header">
		<div class="bottom-header">
			<div class="container">
			<div class="header-bottom-left">
					<div class="logo">
						<a href="index.php"><img src="admin/pages/pengaturan-aplikasi/logo/<?php echo $row['logo']; ?>" alt=" " /></a>
					</div>
	
					<div class="clearfix"> </div>
				</div>
				<div class="header-bottom-right">					
						<div class="account"><a href="index.php?page=profil"><span> </span>AKUN SAYA</a></div>
						<?php if (isset($_SESSION["id_pelanggan"])): ?>
							<ul class="login">
								<li><a href="index.php?page=logout"><span> </span>KELUAR</a></li>
							</ul>
						<?php endif; ?>

						<?php if (!isset($_SESSION["id_pelanggan"])): ?>
							<ul class="login">
								<li><a href="index.php?page=login"><span> </span>LOGIN</a></li>
							</ul>
						<?php endif; ?>

						<div class="cart"><a href="index.php?page=keranjang-belanja"><span> </span>CART</a></div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>	
			</div>
		</div>
	</div>
	<!---->
	<!-- start content -->
	<div class="container">
	<?php 
      if(isset($_GET['page'])){
        $page = $_GET['page'];
    
        switch ($page) {
            case 'produk':
                include "pages/produk.php";
                break;
			case 'detail':
				include "pages/detail.php";
				break;
			case 'keranjang-belanja':
				include "pages/keranjang-belanja.php";
				break;
			case 'checkout':
				include "pages/checkout.php";
				break;
			case 'pembayaran':
				include "pages/pembayaran.php";
				break;
			case 'login':
				include "pages/login.php";
				break;
			case 'daftar':
				include "pages/daftar.php";
				break;
			case 'pesanan-saya':
				include "pages/menu-pelanggan/pesanan-saya.php";
				break;
			case 'detail-pesanan':
				include "pages/menu-pelanggan/detail-pesanan.php";
				break;
			case 'voucher-saya':
				include "pages/menu-pelanggan/voucher-saya.php";
				break;
			case 'profil':
				include "pages/menu-pelanggan/profil.php";
				break;
			case 'username-password':
				include "pages/menu-pelanggan/username-password.php";
				break;
			case 'logout':
				include "pages/logout.php";
				break;
          default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
      }else {
		include "pages/beranda.php";
	}
  	?>

	<div id='ajax-wait'>
	<img src="images/animasi_loading.gif">
	</div>
	<script>

	$(document).ready( function () {
		loading();
	});

	//Fungsi untuk efek loading
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

	<style>
		#ajax-wait {
		display: none;
		position: fixed;
		z-index: 1999
		}
	</style>


	</div>
	<!---->
	<div class="footer">
		<div class="footer-top">
			<div class="container">
				<div class="latter">
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-cate">
					<h6>KATEGORI</h6>
					<ul>
					<?php
                        //Koneksi database
                        include 'config/database.php';
                        $sql="select * from kategori order by id_kategori desc limit 7";
                        $hasil=mysqli_query($kon,$sql);
                        $no=0;
                        while ($data = mysqli_fetch_array($hasil)):
                        $no++;
                    ?>
						<li><a href="index.php?page=produk&kategori=<?php echo $data['id_kategori'];?>"><?php echo $data['nama_kategori']; ?></a></li>
					<?php endwhile; ?>
					</ul>
				</div>
				<div class="footer-bottom-cate bottom-grid-cat">
				<h6>SUB KATEGORI</h6>
					<ul>
					<?php
            
                        $sql="select * from sub_kategori order by id_sub_kategori desc limit 7";
                        $hasil=mysqli_query($kon,$sql);
                        $no=0;
                        while ($data = mysqli_fetch_array($hasil)):
                        $no++;
                    ?>
						<li><a href="index.php?page=produk&kategori=<?php echo $data['id_kategori'];?>&sub_kategori=<?php echo $data['id_sub_kategori'];?>"><?php echo $data['nama_sub_kategori']; ?></a></li>
						<?php endwhile; ?>
					</ul>
				</div>
				<div class="footer-bottom-cate">
				<?php 
					include 'config/database.php';
					$sql="select * from profil_aplikasi limit 1";
					$hasil = mysqli_query($kon,$sql);
					$row = mysqli_fetch_array($hasil)
				?>
					<h6>BANTUAN</h6>
					<ul>
						<li>Hubungi Kami melalui email : angelaaprr9@gmail.com </li>
						<li>Telp : 085772218410</li>
					</ul>
					
				</div>
				<div class="footer-bottom-cate cate-bottom">

					<h6>COPYRIGHT</h6>
					<ul>
						<li>&copy; Angela Aprillia <?php echo date('Y');?></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</body>
</html>