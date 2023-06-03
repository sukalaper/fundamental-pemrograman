<div class="sub-cate">
    <div class=" top-nav rsidebar span_1_of_left">
        <h3 class="cate">KATEGORI</h3>
        <?php 
        include 'config/database.php';

        $hasil=mysqli_query($kon,"select distinct k.id_kategori,k.nama_kategori from kategori k inner join sub_kategori s on s.id_kategori=k.id_kategori group by  k.id_kategori,k.nama_kategori");
        $no=0;

        while ($data = mysqli_fetch_array($hasil)):
        $no++;
        ?>
            <ul class="menu">
                <li class="item"><a href="index.php?page=produk&kategori=<?php echo $data['id_kategori'];?>"><?php echo $data['nama_kategori'];?><img  src="images/arrow1.png" alt=""/> </a>
                    <ul class="cute">
                    <?php
                        $id_kategori=$data['id_kategori'];
                        $sub_kategori=mysqli_query($kon,"select * from sub_kategori where id_kategori='$id_kategori'");
                        $no=0;
                        while ($row = mysqli_fetch_array($sub_kategori)):
                        $no++;
                    ?>
                        <li class="subitem"><a href="index.php?page=produk&kategori=<?php echo $data['id_kategori'];?>&sub_kategori=<?php echo $row['id_sub_kategori'];?>"><?php echo $row['nama_sub_kategori'];?> </a></li>
                        <?php endwhile; ?>
                    </ul>
                </li>
            </ul>
            <?php endwhile; ?>
        </div>
        
            <!--initiate accordion-->
    <script type="text/javascript">
        $(function() {
            var menu_ul = $('.menu > li > ul'),
                    menu_a  = $('.menu > li > a');
            menu_ul.hide();
            menu_a.click(function(e) {
                e.preventDefault();
                if(!$(this).hasClass('active')) {
                    menu_a.removeClass('active');
                    menu_ul.filter(':visible').slideUp('normal');
                    $(this).addClass('active').next().stop(true,true).slideDown('normal');
                } else {
                    $(this).removeClass('active');
                    $(this).next().stop(true,true).slideUp('normal');
                }
            });
        
        });
    </script>	
</div>