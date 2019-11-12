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
                <th style="text-align: center;width: 15%;">Gambar</th>
                <th style="width: 10%;text-align: center;">Paket Poin</th>
                <th style="width: 10%;text-align: center;">Jumlah Poin</th>
                <th style="width: 15%;text-align: center;">Nama Sosmed</th>
                <th style="width: 15%;text-align: center;">Instruksi Poin</th>
                <th style="width: 15%;text-align: center;">Expired</th>
                <th style="width: 15%;text-align: center;">Status</th>
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
                    <td style="text-align: center">
                        <?php 
                            $filename = 'uploads/sosmed/'.$key['gambar'];
                                if (file_exists($filename)) {
                                    $gambar = $filename;
                                } else {
                                    $gambar = ''; 
                                }
                            ?>
                        <img src="<?php echo base_url().$gambar ?>" width="100" height="100"> 
                    </td>
                    <td style="text-align: center"><?php echo $key['nama_paketpoin'] ?></td>
                    <td style="text-align: center"><?php echo number_format($key['jumlah_paketpoin']) ?></td>
                    <td style="text-align: center"><?php echo $this->Global_m->getvalue('nama_sosmed','master_sosmed','id_sosmed',$key['id_sosmed']) ?></td>
                    <td style="text-align: center"><?php echo $key['instruksi_paketpoin'] ?></td>
                    <td style="text-align: center"><?php echo $key['end_date']; ?></td>
                    <td style="text-align: center"><?php 
                    if($key['end_date'] <= date('Y-m-d H:i:s')) {
                        echo "Tidak Aktif";
                    } else {
                        echo "Aktif";
                    }?>
                        
                    </td>
                    <td style="text-align: center;">
                        <a href="#" class="btn btn-default" onclick="edit('<?= $key['id_paketpoin'] ?>')"><i class="icon-pencil" data-popup="tooltip" title="Edit paketpoin" data-original-title="Edit paketpoin" data-placement="bottom"></i></a>
                        <a href="#" class="btn btn-default" onclick="hapus('<?= $key['id_paketpoin'] ?>')" data-popup="tooltip" title="Hapus paketpoin" data-original-title="Hapus paketpoin" data-placement="bottom"><i class="icon-trash"></i></a>
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
                    url: "<?= base_url() ?>admin/paketpoin/delete",
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
            url: "<?= base_url() ?>admin/paketpoin/edit",
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
            url: "<?= base_url() ?>admin/paketpoin/index_paket",
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