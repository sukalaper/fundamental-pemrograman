<div class="shoes-grid">
    <?php 
        include 'config/database.php';
        $hasil=mysqli_query($kon,"select * from kategori");
        while ($row = mysqli_fetch_array($hasil)):
    ?>
        <div class="products">
        <h5 class="latest-product"><?php echo $row['nama_kategori'];?></h5>	
            <a class="view-all" href="index.php?page=produk&kategori=<?php echo $row['id_kategori']; ?>">Lihat Semua<span> </span></a> 		     
        </div>
        <div class="product-left">
        <?php 
            $no=0;
            include 'config/database.php';
            $tes=mysqli_query($kon,"select * from produk where kategori='".$row['id_kategori']."' and stok >0 limit 3");
            while ($data = mysqli_fetch_array($tes)):
            $no++;
        ?>
        <div class="col-md-4 chain-grid  <?php if ($no==3) echo 'grid-top-chain';?>">
            <a href="index.php?page=detail&id=<?php echo $data['id_produk']; ?>"><img class="img-responsive chain" src="admin/pages/produk/gambar/<?php echo $data['gambar'];?>" alt=" " /></a>
            <span class="star"> </span>
            <div class="grid-chain-bottom">
                <h6><a href="index.php?page=detail&id=<?php echo $data['id_produk']; ?>"><?php echo $data['nama_produk'];?></a></h6>
                <div class="star-price">
                    <div class="dolor-grid"> 
                        <span class="actual">Rp. <?php echo number_format($data['harga'],0,',','.'); ?></span>
                            <span class="rating">
                                <input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1">
                                <label for="rating-input-1-5" class="rating-star1"> </label>
                                <input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1">
                                <label for="rating-input-1-4" class="rating-star1"> </label>
                                <input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1">
                                <label for="rating-input-1-3" class="rating-star"> </label>
                                <input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1">
                                <label for="rating-input-1-2" class="rating-star"> </label>
                                <input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1">
                                <label for="rating-input-1-1" class="rating-star"> </label>
                            </span>
                    </div>
                    <a class="now-get get-cart" href="index.php?page=keranjang-belanja&kode_produk=<?php echo $data['kode_produk']; ?>&aksi=tambah_produk&jumlah=1">ADD TO CART</a> 
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
            <div class="clearfix"> </div>
        </div>
    <?php endwhile; ?>
    <div class="clearfix"> </div>
    </div>   
    <?php include 'kategori.php';?>
<div class="clearfix"> </div>  