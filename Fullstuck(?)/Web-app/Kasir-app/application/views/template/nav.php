<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<nav id="sidebar">
    <div class="p-4 pt-5">
        <a href="<?= site_url(); ?>" class="img logo rounded-circle mb-3" style="background-image: url(<?= base_url('assets/img/lo.png'); ?>);"></a>
        <ul class="list-unstyled components mb-5">

            <li <?= (strtolower($this->uri->segment(1)) == 'dashboard') ? 'class="active"' : ''; ?>>
                <a href="<?= site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <?php
            //tampilkan menu di bawah ini jika yang login admin
            if ($this->session->userdata('level') == 'admin') :
            ?>
                <li <?= (in_array(strtolower($this->uri->segment(1)), ['barang', 'tambah_barang', 'edit_barang'])) ? 'class="active"' : ''; ?>>
                    <a href="<?= site_url('barang'); ?>"><i class="fa fa-cubes"></i> Data Stok Barang</a>
                </li>

                <li <?= (in_array(strtolower($this->uri->segment(1)), ['pegawai', 'tambah_pegawai', 'edit_pegawai'])) ? 'class="active"' : ''; ?>>
                    <a href="<?= site_url('pegawai'); ?>"><i class="fa fa-users"></i> Data Pegawai</a>
                </li>

                <li <?= (in_array(strtolower($this->uri->segment(1)), ['supplier', 'tambah_supplier', 'edit_supplier'])) ? 'class="active"' : ''; ?>>
                    <a href="<?= site_url('supplier'); ?>">
                        <i class="fa fa-truck"></i> Data Supplier
                    </a>
                </li>
            <?php
            endif;
            ?>

            <?php
            //tampilkan menu di bawah ini jika yang login pegawai
            if ($this->session->userdata('level') == 'pegawai') :
            ?>
                <li <?= (in_array(strtolower($this->uri->segment(1)), ['stok_barang'])) ? 'class="active"' : ''; ?>>
                    <a href="<?= site_url('stok_barang'); ?>"><i class="fa fa-cubes"></i> Data Stok Barang</a>
                </li>
            <?php
            endif;
            ?>

            <li <?= (in_array(strtolower($this->uri->segment(1)), ['data_pembelian', 'tambah_pembelian', 'edit_pembelian'])) ? 'class="active"' : ''; ?>>
                <a href="<?= site_url('data_pembelian'); ?>"><i class="fa fa-share"></i> Data Pembelian</a>
            </li>

            <li <?= (in_array(strtolower($this->uri->segment(1)), ['data_penjualan', 'tambah_penjualan', 'edit_penjualan'])) ? 'class="active"' : ''; ?>>
                <a href="<?= site_url('data_penjualan'); ?>"><i class="fa fa-reply"></i> Data Penjualan</a>
            </li>

            <li <?= (in_array(strtolower($this->uri->segment(1)), ['stok_harian', 'stok_bulanan', 'stok_tahunan'])) ? 'class="active"' : ''; ?>>
                <a href="#pageStokBarang" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa fa-file-text-o"></i> Laporan Stok Barang
                </a>

                <ul class="collapse list-unstyled" id="pageStokBarang">
                    <li <?= (strtolower($this->uri->segment(1)) == 'stok_harian') ? 'class="active"' : ''; ?>>
                        <a href="<?= site_url('stok_harian'); ?>">
                            <i class="fa fa-angle-double-right"></i> Harian
                        </a>
                    </li>
                    <li <?= (strtolower($this->uri->segment(1)) == 'stok_bulanan') ? 'class="active"' : ''; ?>>
                        <a href="<?= site_url('stok_bulanan'); ?>">
                            <i class="fa fa-angle-double-right"></i> Bulanan
                        </a>
                    </li>
                    <li <?= (strtolower($this->uri->segment(1)) == 'stok_tahunan') ? 'class="active"' : ''; ?>>
                        <a href="<?= site_url('stok_tahunan'); ?>">
                            <i class="fa fa-angle-double-right"></i> Tahunan
                        </a>
                    </li>
                </ul>
            </li>

            <li <?= (in_array(strtolower($this->uri->segment(1)), ['pembelian_harian', 'pembelian_bulanan', 'pembelian_tahunan'])) ? 'class="active"' : ''; ?>>
                <a href="#pagePembelian" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa fa-file-text-o"></i> Laporan Pembelian Barang
                </a>

                <ul class="collapse list-unstyled" id="pagePembelian">
                    <li <?= (strtolower($this->uri->segment(1)) == 'pembelian_harian') ? 'class="active"' : ''; ?>>
                        <a href="<?= site_url('pembelian_harian'); ?>" <?= (strtolower($this->uri->segment(1)) == 'pembelian_harian') ? 'class="active"' : ''; ?>>
                            <i class="fa fa-angle-double-right"></i> Harian
                        </a>
                    </li>
                    <li <?= (strtolower($this->uri->segment(1)) == 'pembelian_bulanan') ? 'class="active"' : ''; ?>>
                        <a href="<?= site_url('pembelian_bulanan'); ?>" <?= (strtolower($this->uri->segment(1)) == 'pembelian_bulanan') ? 'class="active"' : ''; ?>>
                            <i class="fa fa-angle-double-right"></i> Bulanan
                        </a>
                    </li>
                </ul>
            </li>

            <li <?= (in_array(strtolower($this->uri->segment(1)), ['penjualan_harian', 'penjualan_bulanan'])) ? 'class="active"' : ''; ?>>
                <a href="#pagePenjualan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-file-text-o"></i> Laporan Penjualan Barang</a>
                <ul class="collapse list-unstyled" id="pagePenjualan">
                    <li <?= (strtolower($this->uri->segment(1)) == 'penjualan_harian') ? 'class="active"' : ''; ?>>
                        <a href="<?= site_url('penjualan_harian'); ?>">
                            <i class="fa fa-angle-double-right"></i> Harian
                        </a>
                    </li>
                    <li <?= (strtolower($this->uri->segment(1)) == 'penjualan_bulanan') ? 'class="active"' : ''; ?>>
                        <a href="<?= site_url('penjualan_bulanan'); ?>">
                            <i class="fa fa-angle-double-right"></i> Bulanan
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="footer">
            <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>

    </div>
</nav>