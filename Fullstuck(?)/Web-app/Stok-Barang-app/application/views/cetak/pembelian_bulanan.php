<?php
defined('BASEPATH') or exit('No direct script access allowed');

function tanggal_indo($tgl)
{
    $bulan  = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $exp    = explode('-', date('d-m-Y', strtotime($tgl)));

    return $exp[0] . ' ' . $bulan[(int) $exp[1]] . ' ' . $exp[2];
}
?>
<img src="<?= base_url('assets/img/logo.jpg'); ?>" class="logo" />
<h6 class="display-5 text-center mt-2 mb-0">Laporan Bulanan Pembelian Barang</h6>
<p class="text-center display-6 mt-0"><?= 'Bulan ' . ucwords($bulan) . ' Tahun ' . $tahun; ?></p>
<hr class="mt-0" />
<table class="table table-sm table-bordered mt-3">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">ID Pembelian</th>
            <th scope="col">Nama Supplier</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Brand</th>
            <th scope="col" class="text-center">Qty</th>
            <th scope="col" class="text-center">Harga</th>
            <th scope="col" class="text-center">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $row_pembelian = 1;
        $row_tanggal = 1;

        if ($data->num_rows() > 0) {
            $total = 0;

            foreach ($data->result() as $dt) {
                echo '<tr>';
                if ($row_tanggal == 1) :
                    echo '<td rowspan="' . $dt->row_tanggal . '">' . $i++ . '</td>';
                    echo '<td rowspan="' . $dt->row_tanggal . '">' . tanggal_indo($dt->tgl_pembelian) . '</td>';
                endif;
                if ($row_pembelian == 1) :

                    echo '<td rowspan="' . $dt->row_pembelian . '">' . $dt->id_pembelian . '</td>';
                    echo '<td rowspan="' . $dt->row_pembelian . '">' . $dt->nama_supplier . '</td>';
                endif;
                echo '<td>' . $dt->nama_barang . '</td>';
                echo '<td>' . $dt->brand . '</td>';
                echo '<td>' . $dt->qty . '</td>';
                echo '<td><span class="float-left">Rp.</span><span class="float-right">' . number_format($dt->harga, 0, ',', '.') . '</span></td>';
                echo '<td><span class="float-left">Rp.</span><span class="float-right">' . number_format(($dt->harga * $dt->qty), 0, ',', '.') . '</span></td>';
                echo '</tr>';
                if ($row_pembelian != $dt->row_pembelian) {
                    $row_pembelian++;
                } else {
                    $row_pembelian = 1;
                }

                if ($row_tanggal != $dt->row_tanggal) {
                    $row_tanggal++;
                } else {
                    $row_tanggal = 1;
                }

                $total += ($dt->harga * $dt->qty);
            }

            echo '<tr>';
            echo '<td colspan="8" class="text-center"><b>Total Biaya</b></td>';
            echo '<td><b><span class="float-left">Rp.</span><span class="float-right">' . number_format($total, 0, ',', '.') . '</span></b></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td colspan="9" class="text-center">Data tidak ditemukan</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>