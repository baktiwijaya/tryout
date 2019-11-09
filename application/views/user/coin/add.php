<div class="row">
    <?php foreach ($coin as $key) : ?>
        <div class="col-md-3">
            <div class="panel">
                <div class="panel-body text-center">
                <div class="icon-object border-success text-success"><i class="icon-book"></i></div>
                    <h5 class="panel-title"><?php echo $key['nama_paketcoin'] ?></h5>
                    <p class="mb-3"><b>Jumlah Coin</b> : <?php echo number_format($key['jumlah_paketcoin']); ?></p>
                    <p class="mb-3"><b>Harga Coin</b> : <?php echo number_format($key['harga_paketcoin'],2,',','.'); ?></p>
                    <a href="#" class="btn bg-success-400" onclick="save('<?php echo $key['id_paketcoin'] ?>')">Beli</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= form_close(); ?>
<script type="text/javascript">

    function save(id) {
       swal({
            title: "Anda Yakin?",
            text: "Apakan anda ingin membeli koin ?",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-success btn-md waves-effect',
            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya!'

       }, function (isConfirm) {
            if (!isConfirm) return;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>user/coin/save',
                    data: {
                        id_paketcoin : id,
                    },
                    beforeSend: function (data) {
                        $.blockUI({
                            message: '<i class="icon-spinner4 spinner"></i>',
                            overlayCSS: {
                                backgroundColor: '#1b2024',
                                opacity: 0.8,
                                zIndex: 1200,
                                cursor: 'wait'
                            },
                            css: {
                                border: 0,
                                color: '#fff',
                                zIndex: 1201,
                                padding: 0,
                                backgroundColor: 'transparent'
                            }
                        });
                    },
                    error: function (data) {
                        $.unblockUI();
                        alert('Proses data gagal', 'info')
                    },
                    success: function (data) {
                        $.unblockUI();
                        var obj = JSON.parse(data);
                        swal({
                            title: obj[1],
                            text: obj[2],
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ya!'
                        }, function (isConfirm) {
                            if (!isConfirm) return;
                            load();
                        });
                    }
                })
       });
    }

</script>