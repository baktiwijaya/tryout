<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>

<table class="table" id="datatable">
    <thead>
        <tr>
            <th style="text-align: center;width: 5%;">#</th>
            <th style="width: 20%;text-align: center;">Nama Soal</th>
            <th style="width: 5%;text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>           
        <?php
        $no = 1;
        foreach ($list as $key) {
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $this->Global_m->getvalue('nama_soal','master_soal','id_soal',$key['id_soal']); ?></td>                
                <td style="text-align: center;">
                    <a href="#" class="btn btn-default" onclick="hapus_soal('<?= $key['id_isipaket'] ?>')"><i class="icon-trash"></i></a>
                </td> 
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table> 

<button type="button" class="btn btn-danger" onclick="load()">Kembali</button>

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

    function hapus_soal(id) {
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
                    url: "<?= base_url() ?>admin/paket/delete_soal",
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
                                    load_soal()
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

    function edit_soal(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/paket/edit_soal",
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
                $('#content_soal').html(data);
            }
        });
    }

    
</script>