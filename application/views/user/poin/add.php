<div class="row">
    <?php foreach ($poin as $key) : ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                <i class="icon-poins icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="card-title"><?php echo $key['nama_paketpoin'] ?></h5>
                    <p class="mb-3"><b>Jumlah Poin</b> : <?php echo number_format($key['jumlah_paketpoin']); ?></p>
                    <p class="mb-3"><b>Instruksi</b> : <?php echo $key['instruksi_paketpoin']; ?></p>
                    <a href="#" class="btn bg-success-400" onclick="save('<?php echo $key['id_paketpoin'] ?>')">Beli</a>
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
            text: 'Apakah anda yakin ingin membeli paket poin ini ?',
            type: 'warning',
            confirmButtonText: 'Ya !',
            showCancelButton: true,
            cancelButtonText: 'Tidak !',
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>user/poin/save',
                    data: {
                        id_paketpoin : id,
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