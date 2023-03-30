<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-reply"></i> Edit Data Penjualan Barang</h4>
    </div>
</div>
<hr class="mt-0" />
<div id="message">
    <?php if ($this->session->flashdata('alert')) : ?>
        <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('alert'); ?></div>
    <?php endif; ?>
</div>
<?= form_open(); ?>
<input type="hidden" name="idP" value="<?= $fdata->id_penjualan; ?>">
<div class="col-md-12">
    <div class="form-group row">
        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Penjualan</label>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm <?= (form_error('tanggal')) ? 'is-invalid' : ''; ?>" name="tanggal" id="date-picker" value="<?= (set_value('tanggal')) ? set_value('tanggal') : date('d/m/Y', strtotime($fdata->tgl_penjualan)); ?>">
            <div class="invalid-feedback">
                <?= form_error('tanggal', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="pembeli" class="col-sm-2 col-form-label">Nama Pembeli</label>
        <div class="col-sm-6">
            <input type="text" name="pembeli" id="pembeli" class="form-control form-control-sm <?= (form_error('pembeli')) ? 'is-invalid' : ''; ?>" placeholder="Nama Pembeli" value="<?= (set_value('pembeli')) ? set_value('pembeli') : $fdata->nama_pembeli; ?>">
            <div class="invalid-feedback">
                <?= form_error('pembeli', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="barang-penjualan" class="col-sm-2 col-form-label">Barang</label>
        <div class="col-sm-6">
            <select class="barang-select custom-select custom-select-sm pilih-barang" id="barang-penjualan">
                <option value="" disabled selected>Pilih Barang</option>
                <?php foreach ($data->result() as $d) : ?>
                    <option value="<?= $d->kode_barang; ?>">
                        <?= $d->nama_barang . ' ( ' . $d->brand . ' )'; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-2">
            <input type="text" class="form-control form-control-sm qty" id="sisa" placeholder="Stok Barang" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="jumlahx" class="col-sm-2 col-form-label">Jumlah Beli</label>
        <div class="col-sm-2">
            <input type="text" class="form-control form-control-sm qty" id="jumlahx" placeholder="Jumlah Beli">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3 offset-sm-2">
            <div id="rowid-field"></div>
            <div id="btn-act">
                <button type="button" class="btn btn-success btn-sm tambah-penjualan" onclick="tambah_pembelian()">
                    Tambah Barang
                </button>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Qty</th>
                <th scope="col">Harga</th>
                <th scope="col">Harga Total</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody id="daftar-jual">
            <?= $table; ?>
        </tbody>
    </table>
    <div class="col-sm-4 offset-sm-8">
        <button type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit">
            <i class="fa fa-save"></i> Update Data Penjualan
        </button>
        <button type="button" onclick="window.history.back()" class="btn btn-light btn-sm">
            Kembali
        </button>
    </div>
</div>
<?= form_close(); ?>