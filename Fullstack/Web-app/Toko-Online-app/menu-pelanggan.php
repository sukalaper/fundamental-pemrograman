<div class="sub-cate">
    <div class=" top-nav rsidebar span_1_of_left">
        <h3 class="cate">MENU</h3>
        <ul class="menu">
		<ul class="kid-menu ">
            <li><a href="index.php?page=pesanan-saya">Pesanan Saya</a></li>
            <li><a href="index.php?page=voucher-saya">Voucher Saya</a></li>
        </ul>
		<li class="item1"><a href="#">Pengaturan Akun<img class="arrow-img" src="images/arrow1.png" alt=""/> </a>
			<ul class="cute">
				<li class="subitem1"><a href="index.php?page=profil">Profil </a></li>
				<li class="subitem2"><a href="index.php?page=username-password">Atur Username & Password </a></li>
			</ul>
		</li>
		
	</ul>
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