<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-file-text"></i> Laporan Stok Bulanan</h4>
    </div>
</div>
<hr class="mt-0" />
<?php
if ($this->session->flashdata('alert')) {
    echo '<div class="alert alert-danger" role="alert">
    ' . $this->session->flashdata('alert') . '
  </div>';
}
?>
<div class="row">
    <div class="col-md-10 col-sm-12">
        <?= form_open('', ['class' => "form-inline"]); ?>
        <div class="form-group mx-sm-2 mb-2">
            <label for="bulan" class="sr-only">Bulan</label>
            <select name="bulan" id="bulan" class="form-control form-control-sm" style="min-width:150px">
                <option value="januari" <?= (strtolower($bulan) == 'januari') ? 'selected' : ''; ?>>Januari</option>
                <option value="februari" <?= (strtolower($bulan) == 'februari') ? 'selected' : ''; ?>>Februari</option>
                <option value="maret" <?= (strtolower($bulan) == 'maret') ? 'selected' : ''; ?>>Maret</option>
                <option value="april" <?= (strtolower($bulan) == 'april') ? 'selected' : ''; ?>>April</option>
                <option value="mei" <?= (strtolower($bulan) == 'mei') ? 'selected' : ''; ?>>Mei</option>
                <option value="juni" <?= (strtolower($bulan) == 'juni') ? 'selected' : ''; ?>>Juni</option>
                <option value="juli" <?= (strtolower($bulan) == 'juli') ? 'selected' : ''; ?>>Juli</option>
                <option value="agustus" <?= (strtolower($bulan) == 'agustus') ? 'selected' : ''; ?>>Agustus</option>
                <option value="september" <?= (strtolower($bulan) == 'september') ? 'selected' : ''; ?>>September</option>
                <option value="oktober" <?= (strtolower($bulan) == 'oktober') ? 'selected' : ''; ?>>Oktober</option>
                <option value="november" <?= (strtolower($bulan) == 'november') ? 'selected' : ''; ?>>November</option>
                <option value="desember" <?= (strtolower($bulan) == 'desember') ? 'selected' : ''; ?>>Desember</option>
            </select>
        </div>
        <div class="form-group mx-sm-2 mb-2">
            <label for="tahun" class="sr-only">Tahun</label>
            <select name="tahun" id="tahun" class="form-control form-control-sm" style="min-width:130px">
                <?php
                for ($i = 2020; $i  < 2040; $i++) {
                    $selected = ($i == $tahun) ? 'selected' : '';

                    echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2 btn-sm" name="cari" value="Search">
            Cari Data
        </button>
        <?= form_close(); ?>
    </div>
    <div class="col-md-2 col-sm-12">
        <a href="<?= site_url('stok_bulanan/' . $bulan . '-' . $tahun); ?>" class="btn btn-success btn-block btn-sm" target="_blank">
            <i class="fa fa-print"></i> Cetak Laporan
        </a>
    </div>
</div>
<table class="table table-sm table-bordered table-striped mt-3">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kode Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Brand</th>
            <th scope="col" class="text-center">Stok Barang</th>
            <th scope="col" class="text-center">Qty Penjualan</th>
            <th scope="col" class="text-center">Qty Pembelian</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $dt) {
                $penjualan = ($dt->qty_penjualan_new != '') ? $dt->qty_penjualan_new : 0;
                $pembelian = ($dt->qty_pembelian_new != '') ? $dt->qty_pembelian_new : 0;

                echo '<tr>';
                echo '<td>' . $i++ . '</td>';
                echo '<td>' . $dt->kode_barang . '</td>';
                echo '<td>' . $dt->nama_barang . '</td>';
                echo '<td>' . $dt->brand . '</td>';
                echo '<td class="text-center">' . (($dt->stok + $penjualan) - $pembelian) . '</td>';
                echo '<td class="text-center">' . (($dt->qty_penjualan != '') ? $dt->qty_penjualan : 0) . '</td>';
                echo '<td class="text-center">' . (($dt->qty_pembelian != '') ? $dt->qty_pembelian : 0) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="7" class="text-center">Data tidak ditemukan</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>