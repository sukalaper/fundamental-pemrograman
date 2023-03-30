<?php
defined('BASEPATH') or exit('No direct script access allowed');

//tampilkan pesan success
if ($this->session->flashdata('success')) {
    echo '<div class="alert alert-success" role="alert">
    ' . $this->session->flashdata('success') . '
  </div>';
}

//tampilkan pesan error
if ($this->session->flashdata('error')) {
    echo '<div class="alert alert-danger" role="alert">
    ' . $this->session->flashdata('error') . '
  </div>';
}
?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-lock"></i> Ganti Password</h4>
    </div>
</div>
<hr class="mt-0" />
<?= form_open(); ?>
<div class="col-md-8">
    <div class="form-group row">
        <label for="pw-baru" class="col-sm-3 col-form-label">Password Baru</label>
        <div class="col-sm-9">
            <input type="password" class="form-control form-control-sm <?= (form_error('pwBaru')) ? 'is-invalid' : ''; ?>" id="pw-baru" name="pwBaru" placeholder="Password Baru">
            <div class="invalid-feedback">
                <?= form_error('pwBaru', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="pw-lama" class="col-sm-3 col-form-label">Password Lama</label>
        <div class="col-sm-9">
            <input type="password" class="form-control form-control-sm <?= (form_error('pwLama')) ? 'is-invalid' : ''; ?>" id="pw-lama" name="pwLama" placeholder="Password Lama">
            <div class="invalid-feedback">
                <?= form_error('pwLama', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-9 offset-md-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Ubah Password</button>
            <button type="button" class="btn btn-light btn-sm" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
<?= form_close(); ?>