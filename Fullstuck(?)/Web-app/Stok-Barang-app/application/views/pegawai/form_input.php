<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-users"></i> Tambah Data Pegawai</h4>
    </div>
</div>
<hr class="mt-0" />
<?= form_open_multipart(); ?>
<div class="col-md-8">

    <div class="form-group row">
        <label for="username" class="col-sm-3 col-form-label">Username</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm <?= (form_error('username')) ? 'is-invalid' : ''; ?>" id="username" required autofocus name="username" placeholder="Username" value="<?= set_value('username'); ?>">
            <div class="invalid-feedback">
                <?= form_error('username', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="fullname" class="col-sm-3 col-form-label">Fullname</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm <?= (form_error('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" placeholder="Fullname" value="<?= set_value('fullname'); ?>">
            <div class="invalid-feedback">
                <?= form_error('fullname', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control form-control-sm <?= (form_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
            <div class="invalid-feedback">
                <?= form_error('password', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="hp" class="col-sm-3 col-form-label">Nomor HP</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm hp <?= (form_error('hp')) ? 'is-invalid' : ''; ?>" id="hp" name="hp" placeholder="Nomor HP" value="<?= set_value('hp'); ?>">
            <div class="invalid-feedback">
                <?= form_error('hp', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
        <div class="col-sm-9">
            <textarea class="form-control form-control-sm <?= (form_error('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" rows="2" name="alamat" placeholder="Alamat Pegawai"><?= set_value('alamat'); ?></textarea>
            <div class="invalid-feedback">
                <?= form_error('alamat', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="foto" class="col-sm-3 col-form-label">Foto</label>
        <div class="col-sm-2">
            <img src="<?= base_url('assets/foto/default.jpg'); ?>" class="img-thumbnail img-preview" />
        </div>
        <div class="col-sm-7">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="imgPreview()">
                <label class="custom-file-label" id="FileNameShow" for="foto">Pilih Foto...</label>
            </div>
            <div class="invalid-feedback">
                <?= form_error('foto', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-9 offset-md-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Tambah Data</button>
            <button type="button" class="btn btn-light btn-sm" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
<?= form_close(); ?>