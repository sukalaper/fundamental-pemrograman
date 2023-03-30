<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-cubes"></i> Edit Data Barang</h4>
    </div>
</div>
<hr class="mt-0" />
<?= form_open(); ?>
<div class="col-md-8">

    <div class="form-group row">
        <label for="KodeBarang" class="col-sm-3 col-form-label">Kode Barang</label>
        <div class="col-sm-9 col-md-6">
            <input type="text" class="form-control form-control-sm <?= (form_error('kode')) ? 'is-invalid' : ''; ?>" id="KodeBarang" required name="kode" placeholder="Kode Barang" value="<?= $barang->kode_barang; ?>" readonly>
            <input type="hidden" name="ID" value="<?= $barang->kode_barang; ?>" />
            <div class="invalid-feedback">
                <?= form_error('kode', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm <?= (form_error('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="<?= (set_value('nama_barang')) ? set_value('nama_barang') : $barang->nama_barang; ?>">
            <div class="invalid-feedback">
                <?= form_error('nama_barang', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="brand" class="col-sm-3 col-form-label">Tipe</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm <?= (form_error('brand')) ? 'is-invalid' : ''; ?>" id="brand" name="brand" placeholder="Nama Tipe" value="<?= (set_value('brand')) ? set_value('brand') : $barang->brand; ?>">
            <div class="invalid-feedback">
                <?= form_error('brand', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="stok" class="col-sm-3 col-form-label">Stok</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm <?= (form_error('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" placeholder="Stok Barang" value="<?= (set_value('stok')) ? set_value('stok') : $barang->stok; ?>">
            <div class="invalid-feedback">
                <?= form_error('stok', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="harga" class="col-sm-3 col-form-label">Harga Jual</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm uang <?= (form_error('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" placeholder="Harga Jual" value="<?= (set_value('harga')) ? set_value('harga') : number_format($barang->harga, 0, ',', '.'); ?>">
            <div class="invalid-feedback">
                <?= form_error('harga', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="status" class="col-sm-3 col-form-label">Status</label>
        <?php
        $status = (set_value('status')) ? set_value('status') : $barang->active;
        ?>
        <div class="col-sm-6">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input <?= (form_error('status')) ? 'is-invalid' : ''; ?>" id="Aktif" name="status" value="Y" <?= (ucwords($status) == 'Y') ? 'checked' : ''; ?>>
                <label class="custom-control-label" for="Aktif">Aktif</label>
            </div>
            <div class="custom-control custom-radio mb-3">
                <input type="radio" class="custom-control-input <?= (form_error('status')) ? 'is-invalid' : ''; ?>" id="Tidak" name="status" value="N" <?= (ucwords($status) == 'N') ? 'checked' : ''; ?>>
                <label class="custom-control-label" for="Tidak">Tidak Aktif</label>
                <div class="invalid-feedback">
                    <?= form_error('status', '<p class="error-message">', '</p>'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-9 offset-md-3">
            <button type="submit" name="update" value="Update" class="btn btn-primary btn-sm">Update Data</button>
            <button type="button" class="btn btn-light btn-sm" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
<?= form_close(); ?>