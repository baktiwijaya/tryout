<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<div class="table-responsive">
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th style="text-align: center;width: 5%;">#</th>
                <th style="width: 15%;text-align: center;">Paket Koin</th>
                <th style="width: 15%;text-align: center;">Jumlah Koin</th>
                <th style="width: 15%;text-align: center;">Harga Koin</th>
                <th style="width: 20%;text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($list as $key) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td style="text-align: center"><?php echo $key['nama_paketcoin'] ?></td>
                    <td style="text-align: center"><?php echo number_format($key['jumlah_paketcoin']); ?></td>
                    <td style="text-align: center"><?php echo number_format($key['harga_paketcoin'],2,'.',','); ?></td>
                    <td style="text-align: center;">
                        <a href="#" class="btn btn-default" onclick="edit('<?= $key['id_paketcoin'] ?>')"><i class="icon-pencil" data-popup="tooltip" title="Edit paketcoin" data-original-title="Edit paketcoin" data-placement="bottom"></i></a>
                        <a href="#" class="btn btn-default" onclick="hapus('<?= $key['id_paketcoin'] ?>')" data-popup="tooltip" title="Hapus paketcoin" data-original-title="Hapus paketcoin" data-placement="bottom"><i class="icon-trash"></i></a>
                    </td> 
                </tr>
                <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
</div> 
<?= form_close(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            bSort: false,
            bLengthChange: false,
            "oLanguage": {
                "sSearch": ""
            }
        })
    })

    function hapus(id) {
        swalInit({
            title: 'Konfirmasi !',
            text: 'Apakah anda yakin ingin menghapus data ?',
            type: 'warning',
            confirmButtonText: 'Ya !',
            showCancelButton: true,
            cancelButtonText: 'Tidak !',
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url() ?>admin/paketcoin/delete",
                    type: "POST",
                    data: {
                        id: id
                    },
                    error: function (data) {
                    },
                    success: function (data) {
                        var obj = JSON.parse(data);
                        if (obj[0]) {
                            swalInit({
                                type: 'success',
                                text: obj[2]
                            }).then(function (con) {
                                if (con.value) {
                                    load()
                                }
                            })
                        } else {
                            swalInit({
                                type: 'warning',
                                text: obj[2]
                            })
                        }
                    }
                });
            }
        });

    }

    function edit(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/paketcoin/edit",
            type: "POST",
            data: {
                id: id
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
                $('#content').html(data);
            }
        });
    }

    function load_paket(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/paketcoin/index_paket",
            type: "POST",
            data: {
                id: id
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
                $('#content').html(data);
            }
        });
    }
</script>