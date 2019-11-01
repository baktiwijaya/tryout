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
                <th style="width: 15%;text-align: center;">Nama Tryout</th>
                <th style="width: 15%;text-align: center;">Harga Koin</th>
                <th style="width: 15%;text-align: center;">Harga Poin</th>
                <th style="width: 15%;text-align: center;">Tanggal Mulai</th>
                <th style="width: 15%;text-align: center;">Tanggal Selesai</th>
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
                    <td style="text-align: center"><?php echo $key['nama_tryout'] ?></td>
                    <td style="text-align: center"><?php echo number_format($key['harga_koin'],2,'.',','); ?></td>
                    <td style="text-align: center"><?php echo number_format($key['harga_poin'],2,'.',','); ?></td>
                    <td style="text-align: center"><?php echo $key['start_date'] ?></td>
                    <td style="text-align: center"><?php echo $key['end_date'] ?></td>
                    <td style="text-align: center;">
                        <a href="#" class="btn btn-default" onclick="load_paket('<?= $key['id_tryout'] ?>')"><i class="icon-eye" data-popup="tooltip" title="View Paket" data-original-title="View Paket" data-placement="bottom"></i></a>
                        <a href="#" class="btn btn-default" onclick="edit('<?= $key['id_tryout'] ?>')"><i class="icon-pencil" data-popup="tooltip" title="Edit tryout" data-original-title="Edit tryout" data-placement="bottom"></i></a>
                        <a href="#" class="btn btn-default" onclick="hapus('<?= $key['id_tryout'] ?>')" data-popup="tooltip" title="Hapus tryout" data-original-title="Hapus tryout" data-placement="bottom"><i class="icon-trash"></i></a>
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
                    url: "<?= base_url() ?>admin/tryout/delete",
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
            url: "<?= base_url() ?>admin/tryout/edit",
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
            url: "<?= base_url() ?>admin/tryout/index_paket",
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