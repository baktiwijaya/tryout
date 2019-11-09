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
                <th style="width: 25%;text-align: center;">Nama Paket</th>
                <th style="width: 20%;text-align: center;">Kategori Pelajaran</th>
                <th style="width: 10%;text-align: center;">Jumlah Soal</th>
                <th style="width: 10%;text-align: center;">Waktu Pengerjaan</th>
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
                    
                    <td><?= $key['nama_paket'] ?></td>
                    <td style="text-align: left"><?= $this->Global_m->getvalue('nama_kategori','master_kategori','id_kategori',$key['id_kategori']) ?></td>
                    <td style="text-align: center"><?= $this->Global_m->count_where($key['id_paket'],'master_isipaket') ?> Soal</td>
                    <td style="text-align: center"><?= $key['waktu_pengerjaan'] ?> Menit</td>
                    <td style="text-align: center;">
                        <a href="#" class="btn btn-default" onclick="load_soal('<?= $key['id_paket'] ?>')"><i class="fa fa-plus" data-popup="tooltip" title="Tambah Soal" data-original-title="Tambah Soal" data-placement="bottom"></i></a>
                        <a href="#" class="btn btn-default" onclick="edit('<?= $key['id_paket'] ?>')"><i class="icon-pencil" data-popup="tooltip" title="Edit Paket" data-original-title="Edit Paket" data-placement="bottom"></i></a>
                        <a href="#" class="btn btn-default" onclick="hapus('<?= $key['id_paket'] ?>')" data-popup="tooltip" title="Hapus Paket" data-original-title="Hapus Paket" data-placement="bottom"><i class="icon-trash"></i></a>
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
                    url: "<?= base_url() ?>admin/paket/delete",
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
            url: "<?= base_url() ?>admin/paket/edit",
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

    function load_soal(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/paket/index_soal",
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