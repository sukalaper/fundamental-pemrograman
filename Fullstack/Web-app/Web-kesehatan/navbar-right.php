<?php
//session_start();
//require_once '../config/koneksi.php';
//require_once '../user/class.user.php';
?>

<!-- ==================================================================================================== -->
				<ul class="nav nav-list">
					<li>
						<a href="javascript:void(0)" onclick="swapContent('home')">
							<i class="icon-home"></i>
							<span class="menu-text"> Home </span>
						</a>
					</li>			
<!-- ==================================================================================================== -->
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-tasks"></i>
							<span class="menu-text"> Master </span>

							<b class="arrow icon-angle-down"></b>
						</a>
<!-- ==================================================================================================== -->
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('user/user')">
									<i class="icon-double-angle-right"></i>
									User
								</a>
							</li>
<!-- ==================================================================================================== -->
							<?php if ($_SESSION['s_level'] == 'administrator'){ //|| $_SESSION['s_level'] == 'admin' ) { ?>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('poskotis/poskotis')">
									<i class="icon-double-angle-right"></i>
									Poskotis
								</a>
							</li>
<!-- ==================================================================================================== -->
							<li>
								<a href="javascript:void(0)" onclick="swapContent('rujuk/rujuk')">
									<i class="icon-double-angle-right"></i>
									RS/Puskesmas
								</a>
							</li>
<!-- ==================================================================================================== -->
							<li>
								<a href="javascript:void(0)" onclick="swapContent('diagnosa/diagnosa')">
									<i class="icon-double-angle-right"></i>
									Penyakit
								</a>
							</li>
<!-- ==================================================================================================== -->
							<li>
								<a href="javascript:void(0)" onclick="swapContent('kecelakaan/kecelakaan')">
									<i class="icon-double-angle-right"></i>
									Jenis Kecelakaan
								</a>
							</li>
						<?php } ?>
<!-- ==================================================================================================== 	
							<li>
								<a href="javascript:void(0)" onclick="swapContent('golongan/golongan')">
									<i class="icon-double-angle-right"></i>
									Golongan
								</a>
							</li>
<!-- ==================================================================================================== 	
							<li>
								<a href="javascript:void(0)" onclick="swapContent('eselon/eselon')">
									<i class="icon-double-angle-right"></i>
									Eselon
								</a>
							</li>
<!-- ==================================================================================================== 	
							<li>
								<a href="javascript:void(0)" onclick="swapContent('jabatan/jabatan')">
									<i class="icon-double-angle-right"></i>
									Jabatan
								</a>
							</li>
<!-- ==================================================================================================== -->					
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text"> Transaksi </span>
							<b class="arrow icon-angle-down"></b>
						</a>
<!-- ==================================================================================================== -->
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('insiden/insiden')">
									<i class="icon-double-angle-right"></i>
									Daftar Insiden
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('pelkes/pelkes')">
									<i class="icon-double-angle-right"></i>
									Daftar Pelayanan Kesehatan
								</a>
							</li>
						</ul>
					</li>				
<!-- ==================================================================================================== -->				
					
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-list-alt"></i>
							<span class="menu-text"> Laporan </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						
<!-- ==================================================================================================== -->
						
						<ul class="submenu">
							<li>
								<a href="javascript:void(0)" onclick="swapContent('lap-insiden/lap-insiden')">
									<i class="icon-double-angle-right"></i>
									Insiden
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="swapContent('lap-pelkes/lap-pelkes')">
									<i class="icon-double-angle-right"></i>
									Pelayanan Kesehatan
								</a>
							</li>
						</ul>
					</li>
					
<!-- ==================================================================================================== -->					
					
<!-- ==================================================================================================== -->					
					<li>
						<a href="logout.php">
							<i class="icon-lock"></i>
							<span class="menu-text"> Logout </span>
						</a>
					</li>
				</ul><!--/.nav-list-->
<!-- ==================================================================================================== -->				