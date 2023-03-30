<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-users"></i> Detail Pegawai</h4>
    </div>
</div>
<hr class="mt-0" />
<div class="card border-light mb-1">
    <div class="row no-gutters">
        <div class="col-md-3 pt-2">
            <img src="<?= base_url('assets/foto/' . $data->foto); ?>" class="card-img img-thumbnail" alt="<?= $data->foto; ?>" style="max-height: 480px">
        </div>
        <div class="col-md-8 offset-md-1">
            <div class="card-body pt-1">
                <h5 class="card-title mb-0"><?= $data->fullname; ?></h5>
                <p class="card-text text-muted mb-2"><?= '@' . $data->username; ?></p>
                <p class="card-text mb-0"><b>Nomor HP :</b></p>
                <p class="card-text text-mute"><?= ($data->hp != '') ? $data->hp : '-'; ?></p>
                <p class="card-text mb-0"><b>Alamat :</b></p>
                <p class="card-text text-muted"><?= ($data->alamat != '') ? $data->alamat : '-'; ?></p>
                <p class="card-text mb-0"><b>Status Pegawai :</b></p>
                <p class="card-text text-muted"><?= ($data->active == 'Y') ? 'Pegawai Aktif' : 'Pegawai Tidak Aktif'; ?></p>
                <p class="card-text mb-0"><b>Terakhir Login :</b></p>
                <p class="card-text text-muted mb-0">
                    <?= ($data->last_login != '') ? date('d/m/Y - H:i:s', strtotime($data->last_login)) : '-'; ?>
                </p>
                <hr />
                <button type="button" class="btn btn-secondary btn-sm" onclick="window.history.back()">Kembali</button>
                <a href="<?= site_url('edit_pegawai/' . $data->username); ?>" class="btn btn-warning btn-sm text-white">Edit Data</a>
            </div>
        </div>
    </div>
</div>