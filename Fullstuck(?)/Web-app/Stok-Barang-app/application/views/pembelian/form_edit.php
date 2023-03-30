<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-share"></i> Edit Data Pembelian Barang</h4>
    </div>
</div>
<hr class="mt-0" />
<div id="message">
    <?php if ($this->session->flashdata('alert')) : ?>
        <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('alert'); ?></div>
    <?php endif; ?>
</div>
<?= form_open(); ?>
<input type="hidden" name="idP" value="<?= $fdata->id_pembelian; ?>">
<div class="col-md-12">
    <div class="form-group row">
        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm <?= (form_error('tanggal')) ? 'is-invalid' : ''; ?>" name="tanggal" id="date-picker" value="<?= (set_value('tanggal')) ? set_value('tanggal') : date('d/m/Y', strtotime($fdata->tgl_pembelian)); ?>">
            <div class="invalid-feedback">
                <?= form_error('tanggal', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
        <div class="col-sm-6">
            <select class="custom-select custom-select-sm supplier <?= (form_error('supplier')) ? 'is-invalid' : ''; ?>" id="supplier" name="supplier">
                <option value="" disabled selected>Pilih Supplier</option>
                <?php
                foreach ($supplier->result() as $s) :
                    $sup = (set_value('supplier')) ? set_value('supplier') : $fdata->id_supplier;

                    $pilih = ($sup == $s->id_supplier) ? 'selected' : '';

                    echo '<option value="' . $s->id_supplier . '" ' . $pilih . '>
                        ' . $s->nama_supplier . '
                    </option>';
                endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= form_error('supplier', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="barangx" class="col-sm-2 col-form-label">Barang</label>
        <div class="col-sm-6">
            <select class="custom-select custom-select-sm barang-select" id="barangx">
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
        <label for="jumlahx" class="col-sm-2 col-form-label">Jumlah</label>
        <div class="col-sm-2">
            <input type="number" class="form-control form-control-sm" id="jumlahx" placeholder="Jumlah Beli">
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-sm-2 col-form-label">Harga Satuan</label>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm uang" id="harga" placeholder="Harga Satuan">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3 offset-sm-2">
            <div id="rowid-field"></div>
            <div id="btn-act">
                <button type="button" class="btn btn-success btn-sm" onclick="tambah_cart()">Tambah Barang</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col" class="text-center">Jumlah</th>
                    <th scope="col" class="text-right">Harga</th>
                    <th scope="col" class="text-right">Total</th>
                    <th scope="col" class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody id="daftar-beli">
                <?= $table; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-4 offset-sm-8">
        <button type="submit" name="submit" class="btn btn-primary btn-sm" value="Update">
            <i class="fa fa-save"></i> Simpan Perubahan Data
        </button>
        <button type="button" onclick="window.location.replace('<?= site_url('data_pembelian'); ?>')" class="btn btn-light btn-sm">
            Kembali
        </button>
    </div>
</div>
<?= form_close(); ?>