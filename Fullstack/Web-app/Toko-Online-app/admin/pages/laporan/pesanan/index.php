<script>
$('#keterangan').text('Berdasarkan Pesanan');
</script>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header">
            <div id="filter_laporan" class="collapse show">
                <!-- form -->
                <form method="post" id="form">
                    <div class="form-row">
                        <div class="col-sm-2">
                            <input type="date" class="form-control" name="dari_tanggal" required>
                        </div>
                        <div class="col-sm-2">
                            <input type="date" class="form-control"  name="sampai_tanggal" required>
                        </div>
                        <div class="col-sm-2">
                            <select name="status" id="status" class="form-control">
                                <option value="" >Pilih Status</option>
                                <option value="0" >Ditahan</option>
                                <option value="1" >Pembayaran tertunda</option>
                                <option value="2" >Sedang diproses</option>
                                <option value="3" >Dikirim</option>
                                <option value="4" >Selesai</option>
                                <option value="5" >Dibatalkan</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                                <option value="" >Status Pembayaran</option>
                                <option value="0" >Belum Bayar</option>
                                <option value="1" >Telah Dibayar</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                        <button  type="button" id="btn-tampil"  class="btn btn-primary"><span class="text"> Tampilkan</span></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <!-- Tampil Laporan -->
            <div id="tampil_laporan">
    
            </div>

        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    </div>


<script>
    $('#btn-tampil').on('click',function(){
        var data = $('#form').serialize();
        $.ajax({
            type	: 'POST',
            url: 'pages/laporan/pesanan/tabel-pesanan.php',
            data: data,
            cache	: false,
            success	: function(data){
                $("#tampil_laporan").html(data);

            }
        });
    });
</script>
