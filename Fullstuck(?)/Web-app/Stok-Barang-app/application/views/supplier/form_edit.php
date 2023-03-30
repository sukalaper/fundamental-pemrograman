<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-truck"></i> Edit Data Supplier</h4>
    </div>
</div>
<hr class="mt-0" />
<?= form_open(); ?>
<input type="hidden" name="idSupplier" value="<?= $data->id_supplier; ?>" />
<div class="col-md-8">
    <div class="form-group row">
        <label for="nama_supplier" class="col-sm-3 col-form-label">Nama Supplier</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm <?= (form_error('nama_supplier')) ? 'is-invalid' : ''; ?>" id="nama_supplier" required autofocus name="nama_supplier" placeholder="Nama Supplier" value="<?= (set_value('nama_supplier')) ? set_value('nama_supplier') : $data->nama_supplier; ?>">
            <div class="invalid-feedback">
                <?= form_error('nama_supplier', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
        <div class="col-sm-9">
            <textarea class="form-control form-control-sm <?= (form_error('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" rows="2" name="alamat" placeholder="Alamat Supplier"><?= (set_value('alamat')) ? set_value('alamat') : $data->alamat; ?></textarea>
            <div class="invalid-feedback">
                <?= form_error('alamat', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="hp" class="col-sm-3 col-form-label">Nomor Telp.</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm hp <?= (form_error('hp')) ? 'is-invalid' : ''; ?>" id="hp" name="hp" placeholder="Nomor Telephone" value="<?= (set_value('hp')) ? set_value('hp') : $data->telp; ?>">
            <div class="invalid-feedback">
                <?= form_error('hp', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-9 offset-md-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Update Data</button>
            <button type="button" class="btn btn-light btn-sm" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
<?= form_close(); ?>