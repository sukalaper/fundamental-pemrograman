<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.ico'); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- Bootstrap DataTable CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css'); ?>">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/sweetalert.css'); ?>">
    <!-- DatePicker CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-datetimepicker.min.css'); ?>">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/select2.min.css'); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <style>
        body {
            font-family: Roboto;
            color: #4d4d4d;
            background: #fff;
            overflow-x: hidden;
        }

        h4 {
            color: #4d4d4d;
        }

        .display-5 {
            font-size: 1rem;
            font-weight: 300;
            line-height: 1.2;
        }

        .error-message {
            font-size: 13px;
        }

        .invalid-feedback>p {
            margin-bottom: 0px;
        }

        #modal-password {
            top: 20%;
        }

        .custom-select>option {
            font-family: Roboto;
        }

        .table>tbody>tr>td {
            vertical-align: middle;
        }

        #tables {
            width: 100% !important;
        }

        .btn-light {
            background-color: #f6f6f6;
            border-color: #f1f1f2;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: calc(1.5em + 0.5rem + 2px);
            padding-bottom: 0.25rem;
            padding-left: 0.25rem;
            font-size: 0.875rem;
            user-select: none;
            -webkit-user-select: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057;
            line-height: 28px;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?= $navbar; ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 0px 10px;">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto mr-5">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?= base_url('assets/foto/thumb/' . $this->session->userdata('foto')); ?>" class="img-thumbnail" style="width:40px;height:40px;border-radius:50px"> <?= $this->session->userdata('User'); ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <?php if ($this->session->userdata('level') == 'admin') { ?>
                                        <a class="dropdown-item" href="<?= site_url('admin'); ?>">
                                            Profil
                                        </a>
                                    <?php } else { ?>
                                        <a class="dropdown-item" href="<?= site_url('profil'); ?>">
                                            Profil
                                        </a>
                                    <?php } ?>
                                    <a class="dropdown-item" href="<?= site_url('password'); ?>">
                                        Ganti Password
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="return swal({ 
 title: 'Apakah anda yakin akan keluar ?', type: 'warning' , showCancelButton: true, confirmButtonColor: '#DD6B55' , confirmButtonText: 'Ya, Sign Out!', closeOnConfirm: false }, function(){ window.location.href = '<?= site_url('sign_out'); ?>'; });">Sign Out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?= $content; ?>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/popper.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>
    <script src="<?= base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/select2.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/jquery.mask.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/moment.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-datetimepicker.js'); ?>"></script>
    <script src="<?= base_url('assets/js/js-cookie.js'); ?>"></script>
    <!-- Custom Javascript -->
    <?php
    $arr_uri = array('stok_barang', 'barang', 'pegawai', 'supplier', 'data_pembelian', 'data_penjualan');

    if (in_array(strtolower($this->uri->segment(1)), $arr_uri) && !$this->uri->segment(2)) :
        switch ($this->uri->segment(1)) {
            case 'stok_barang':
                $file = 'ajax_stok_barang';
                break;
            case 'barang':
                $file = 'ajax_barang';
                break;
            case 'pegawai':
                $file = 'ajax_pegawai';
                break;
            case 'supplier':
                $file = 'ajax_supplier';
                break;
            case 'data_pembelian':
                $file = 'ajax_pembelian';
                break;
            case 'data_penjualan':
                $file = 'ajax_penjualan';
                break;
        }
    ?>
        <script>
            $(document).ready(function() {
                $('#tables').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    "responsive": true,
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?= site_url($file) ?>",
                        "type": "POST",
                        "data": function(data) {
                            data.csrf_token = Cookies.get('csrf_cookie');
                        }
                    },

                    //Set column definition initialisation properties.
                    columnDefs: [{
                        "targets": [0], //first column / numbering column
                        "orderable": false, //set not orderable
                    }, ],
                });
            });
        </script>

    <?php endif; ?>

    <script>
        $(document).ready(function() {

            $('.uang').mask('000.000.000.000', {
                reverse: true
            });

            $('.hp').mask('000000000000000', {
                reverse: true
            });

            $('.qty').mask('000000', {
                reverse: true
            });

            $('#stok').mask('000000', {
                reverse: true
            });

            $('#date-picker').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('.barang-select').select2({
                allowClear: true
            });

            $('.supplier').select2();
        });

        function imgPreview() {
            const foto = document.querySelector('#foto');
            const fotoLabel = document.querySelector('#FileNameShow');
            const imgPreview = document.querySelector('.img-preview');

            fotoLabel.textContent = foto.files[0].name;

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);

            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        function GantiPW(a) {
            $('#IdU').val(a);
            $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));
        }

        function tambah_cart() {
            var barangx = $('#barangx').val();
            var jumlah = $('#jumlahx').val();
            var harga = $('#harga').val();
            var csrf_token = Cookies.get('csrf_cookie');

            $.ajax({
                url: "<?= site_url('tambah_cart'); ?>",
                method: "POST",
                data: {
                    barangx: barangx,
                    jumlah: jumlah,
                    harga: harga,
                    csrf_token: csrf_token
                },
                success: function(obj) {
                    var x = $.parseJSON(obj);

                    $('#daftar-beli').html(x.table);
                    $('#message').html(x.alert);
                    $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                    if (x.status == 'success') {
                        $('.barang-select').val(null).trigger('change');
                        $('#jumlahx').val('');
                        $('#harga').val('');
                    }
                }
            });
        }

        function get_item(a) {
            var csrf_token = Cookies.get('csrf_cookie');

            $.ajax({
                url: "<?= site_url('get_item'); ?>",
                method: "POST",
                data: {
                    rowid: a,
                    csrf_token: csrf_token
                },
                success: function(obj) {
                    var x = $.parseJSON(obj);

                    $('#daftar-beli').html(x.table);
                    $('.barang-select').val(x.barang).trigger('change');
                    $('#jumlahx').val(x.qty);
                    $('#harga').val(x.harga);
                    $('#rowid-field').html(x.rowid);
                    $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                    if (x.status == 'true') {
                        $('#barangx').attr('disabled', true);
                        $('#jumlahx').focus();
                        $('#btn-act').html('<button type="button" class="btn btn-success btn-sm" onclick="update_cart()">Update Barang</button>');
                    }
                }
            });
        }

        function update_cart() {
            var jumlah = $('#jumlahx').val();
            var harga = $('#harga').val();
            var rowid = $('#rowid').val();
            var csrf_token = Cookies.get('csrf_cookie');

            $.ajax({
                url: "<?= site_url('update_cart'); ?>",
                method: "POST",
                data: {
                    jumlah: jumlah,
                    harga: harga,
                    rowid: rowid,
                    csrf_token: csrf_token
                },
                success: function(obj) {
                    var x = $.parseJSON(obj);

                    $('#daftar-beli').html(x.table);
                    $('#message').html(x.alert);
                    $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                    if (x.status == 'success') {
                        $('.barang-select').val(null).trigger('change');
                        $('#barangx').removeAttr('disabled');
                        $('#jumlahx').val('');
                        $('#harga').val('');
                        $('#rowid-field').html('');
                        $('#btn-act').html('<button type="button" class="btn btn-success btn-sm" onclick="tambah_cart()">Tambah Barang</button>');
                    } else {
                        $('#jumlahx').focus();
                    }
                }
            });
        }

        function remove_item(rowid) {
            swal({
                title: 'Apakah anda yakin akan menghapus item ini ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya, Hapus!',
                closeOnConfirm: false
            }, function() {
                var csrf_token = Cookies.get('csrf_cookie');

                $.ajax({
                    url: "<?= site_url('remove_item'); ?>",
                    method: "POST",
                    data: {
                        rowid: rowid,
                        csrf_token: csrf_token
                    },
                    success: function(obj) {
                        var x = $.parseJSON(obj);

                        $('#daftar-beli').html(x.table);
                        $('#message').html(x.alert);
                        $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                        if (x.message == 'success') {
                            swal({
                                title: "Success!",
                                text: "Data barang berhasil dihapus",
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: "Data barang gagal dihapus",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();
                            });
                        }
                    }
                });
            });
        }

        function hapus_pembelian(id) {
            swal({
                title: 'Apakah anda yakin akan menghapus data ini ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya, Hapus!',
                closeOnConfirm: false
            }, function() {
                var csrf_token = Cookies.get('csrf_cookie');
                var tabel = $('#tables').DataTable();

                $.ajax({
                    url: "<?= site_url('hapus_pembelian'); ?>",
                    method: "POST",
                    data: {
                        id: id,
                        csrf_token: csrf_token
                    },
                    success: function(obj) {

                        var a = $.parseJSON(obj);

                        if (a.message == 'success') {
                            swal({
                                title: "Success!",
                                text: "Data barang berhasil dihapus",
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();

                                $('#tables').each(function() {
                                    dt = $(this).DataTable();
                                    dt.ajax.reload();
                                });
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: "Data barang gagal dihapus",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();
                            });
                        }

                    }
                });
            });
        }

        $(document).keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);

            if (keycode == '13') {
                var tombol = document.getElementsByClassName('tambah-penjualan');

                if (tombol.length > 0) {
                    $('.tambah-penjualan').click();
                } else {
                    $('.update-penjualan').click();
                }
                return false;
            }
        });

        $('.pilih-barang').change(function() {
            var id = $('.pilih-barang').val();
            var csrf_token = Cookies.get('csrf_cookie');

            if (id == null || id == '') {
                return false;
            }

            $.ajax({
                url: "<?= site_url('cari_barang_penjualan'); ?>",
                method: "POST",
                data: {
                    id: id,
                    csrf_token: csrf_token
                },
                success: function(data) {
                    var a = $.parseJSON(data);

                    $('#daftar-jual').html(a.table);
                    $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                    if (a.status == 'success') {
                        $('#sisa').val(a.sisa);
                        $('#jumlahx').focus();
                    } else {
                        $('#message').html(a.alert);
                    }
                }
            });
        });

        function tambah_pembelian() {
            var id = $('#barang-penjualan').val();
            var sisa = parseInt($('#sisa').val());
            var qty = parseInt($('#jumlahx').val());
            var csrf_token = Cookies.get('csrf_cookie');
            $('#barang-penjualan').addClass('pilih-barang');

            if (qty > sisa) {
                swal({
                    title: "Error!",
                    text: "Jumlah beli melebihi stok",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 2000
                }, function() {
                    swal.close();
                });

                return false;
            }

            $.ajax({
                url: "<?= site_url('tambah_cart_penjualan'); ?>",
                method: "POST",
                data: {
                    id: id,
                    qty: qty,
                    csrf_token: csrf_token
                },
                success: function(data) {
                    var a = $.parseJSON(data);

                    $('#daftar-jual').html(a.table);
                    $('#message').html(a.alert);
                    $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                    if (a.status == 'success') {
                        $('.barang-select').val(null).trigger('change');
                        $('#sisa').val('');
                        $('#jumlahx').val('');
                    }
                }
            });
        }

        function hapus_item_penjualan(rowid) {
            $('#barang-penjualan').addClass('pilih-barang')
                .removeAttr('disabled');

            swal({
                title: 'Apakah anda yakin akan menghapus item ini ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya, Hapus!',
                closeOnConfirm: false
            }, function() {
                var csrf_token = Cookies.get('csrf_cookie');

                $.ajax({
                    url: "<?= site_url('hapus_item_penjualan'); ?>",
                    method: "POST",
                    data: {
                        rowid: rowid,
                        csrf_token: csrf_token
                    },
                    success: function(obj) {
                        var x = $.parseJSON(obj);

                        $('#daftar-jual').html(x.table);
                        $('#message').html(x.alert);
                        $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                        if (x.message == 'success') {
                            swal({
                                title: "Success!",
                                text: "Data barang berhasil dihapus",
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                $('#barang-penjualan').addClass('pilih-barang')
                                    .removeAttr('disabled');
                                $('.barang-select').val(null).trigger('change');
                                $('#sisa').val('');
                                $('#jumlahx').val('');
                                $('#btn-act').html('<button type="button" class="btn btn-success btn-sm tambah-penjualan" onclick="tambah_pembelian()">Tambah Barang</button>');

                                swal.close();
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: "Data barang gagal dihapus",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();
                            });
                        }
                    }
                });
            });
        }

        function get_item_penjualan(rowid) {
            $('#barang-penjualan').removeClass('pilih-barang');
            var csrf_token = Cookies.get('csrf_cookie');

            $.ajax({
                url: "<?= site_url('get_item_penjualan/' . $this->uri->segment(1)); ?>",
                method: 'POST',
                data: {
                    rowid: rowid,
                    csrf_token: csrf_token
                },
                success: function(data) {
                    var x = $.parseJSON(data);

                    $('#daftar-jual').html(x.table);
                    $('.barang-select').val(x.barang).trigger('change');
                    $('#jumlahx').val(x.qty);
                    $('#sisa').val(x.stok);
                    $('#rowid-field').html(x.rowid);
                    $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                    if (x.status == 'true') {
                        $('.barang-select').attr('disabled', true);
                        $('#jumlahx').focus();
                        $('#btn-act').html('<button type="button" class="btn btn-success btn-sm update-penjualan" onclick="update_cart_penjualan()">Update Barang</button>');
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }

        function update_cart_penjualan() {
            var qty = parseInt($('#jumlahx').val());
            var sisa = parseInt($('#lastQty').val());
            var rowid = $('#rowid').val();
            var id = $('#barang-penjualan').val();

            var csrf_token = Cookies.get('csrf_cookie');

            if (qty > sisa) {
                swal({
                    title: "Error!",
                    text: "Jumlah beli melebihi stok",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 2000
                }, function() {
                    swal.close();
                });

                return false;
            }

            $.ajax({
                url: "<?= site_url('update_cart_penjualan'); ?>",
                method: "POST",
                data: {
                    id: id,
                    jumlah: qty,
                    rowid: rowid,
                    csrf_token: csrf_token
                },
                success: function(obj) {
                    var x = $.parseJSON(obj);

                    $('#daftar-jual').html(x.table);
                    $('#message').html(x.alert);
                    $('[name="csrf_token"]').val(Cookies.get('csrf_cookie'));

                    if (x.status == 'success') {
                        $('.barang-select').val(null).trigger('change');
                        $('.barang-select').attr('disabled', false);
                        $('#barangx').removeAttr('disabled');
                        $('#jumlahx').val('');
                        $('#sisa').val('');
                        $('#rowid-field').html('');
                        $('#btn-act').html('<button type="button" class="btn btn-success btn-sm tambah-penjualan" onclick="tambah_pembelian()">Tambah Barang</button>');
                        $('#barang-penjualan').addClass('pilih-barang');

                    } else {
                        $('#jumlahx').focus();
                    }
                }
            });
        }

        function hapus_penjualan(id) {
            swal({
                title: 'Apakah anda yakin akan menghapus data ini ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya, Hapus!',
                closeOnConfirm: false
            }, function() {
                var csrf_token = Cookies.get('csrf_cookie');
                var tabel = $('#tables').DataTable();

                $.ajax({
                    url: "<?= site_url('hapus_penjualan'); ?>",
                    method: "POST",
                    data: {
                        id: id,
                        csrf_token: csrf_token
                    },
                    success: function(obj) {

                        var a = $.parseJSON(obj);

                        if (a.message == 'success') {
                            swal({
                                title: "Success!",
                                text: "Data barang berhasil dihapus",
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();

                                $('#tables').each(function() {
                                    dt = $(this).DataTable();
                                    dt.ajax.reload();
                                });
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: "Data barang gagal dihapus",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();
                            });
                        }

                    }
                });
            });
        }

        function hapus_supplier(id) {
            swal({
                title: 'Apakah anda yakin akan menghapus data ini ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya, Hapus!',
                closeOnConfirm: false
            }, function() {
                var csrf_token = Cookies.get('csrf_cookie');
                var tabel = $('#tables').DataTable();

                $.ajax({
                    url: "<?= site_url('hapus_supplier'); ?>",
                    method: "POST",
                    data: {
                        id: id,
                        csrf_token: csrf_token
                    },
                    success: function(obj) {

                        var a = $.parseJSON(obj);

                        if (a.message == 'success') {
                            swal({
                                title: "Success!",
                                text: "Data supplier berhasil dihapus",
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();

                                $('#tables').each(function() {
                                    dt = $(this).DataTable();
                                    dt.ajax.reload();
                                });
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: "Data supplier gagal dihapus",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000
                            }, function() {
                                swal.close();
                            });
                        }

                    }
                });
            });
        }
    </script>
</body>

</html>