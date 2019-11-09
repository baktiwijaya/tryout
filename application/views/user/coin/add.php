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
        swalInit({
            title: 'Konfirmasi !',
            text: 'Apakah anda yakin ingin membeli paket coin ini ?',
            type: 'warning',
            confirmButtonText: 'Ya !',
            showCancelButton: true,
            cancelButtonText: 'Tidak !',
        }).then(function (result) {
            if (result.value) {
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
                        if (obj[0]) {
                            swalInit({
                                type: 'success',
                                text: obj[2]
                            }).then(function (con) {
                                if (con.value) {
                                    load();
                                }
                            })
                        } else {
                            swalInit({
                                type: 'warning',
                                text: obj[2]
                            })
                        }
                    }
                })
            }
        });
    }

</script>