<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<table class="table" id="datatable">
    <thead>
        <tr>
            <th style="text-align: center;width: 5%;">#</th>
            <th style="width: 20%;text-align: center;">Gambar</th>
            <th style="width: 15%;text-align: center;">Paket Poin</th>
            <th style="width: 15%;text-align: center;">Jumlah Poin</th>
            <th style="width: 20%;text-align: center;">Nama Sosmed</th>
            <th style="width: 20%;text-align: center;">Instruksi Poin</th>
            <th style="width: 15%;text-align: center;">Expired</th>
            <th style="width: 15%;text-align: center;">Status</th>
            <th style="width: 15%;text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($list as $key) {
            ?>
            <tr>
                <td style="text-align: center"><?= $no ?></td>
                <td style="text-align: center"><?= $no ?></td>
                <td style="text-align: left"><?= $this->Global_m->getvalue('nama_paketpoin','master_paketpoin','id_paketpoin',$key['id_paketpoin']); ?></td>
                <td style="text-align: center"><?= number_format($this->Global_m->getvalue('harga_paketpoin','master_paketpoin','id_paketpoin',$key['id_paketpoin']),'2',',','.'); ?></td>
                
                <td style="text-align: center;"><?php echo ($key['tanggal_verifikasi'] != '') ? $key['tanggal_verifikasi'] : '-' ?></td>
                <td style="text-align: center"><?php echo $this->Global_m->getvalue('nama_lengkap','user_info','id',$key['verified_by']) ?></td>
                <td style="text-align: center;">
                    <?php 
                        if($key['status'] == 0) {
                            echo "Belum diproses";
                        } else if($key['status'] == 1) {
                            echo "Sedang Review";
                        } else if($key['status'] == 2){
                            echo "Sudah diverifikasi";
                        } else {
                            echo "Transaksi Dibatalkan";
                        }
                    ?>    
                </td>
                <td style="text-align: center;">
                    <?php if($key['status'] == 0) { ?>
                        <a href="#" class="btn btn-default" onclick="edit('<?= $key['id_transaksi'] ?>')"><i class="icon-upload"></i></a>
                    <?php } else if($key['status'] == 1) { ?>
                        <a href="#" class="btn btn-default" onclick="hapus('<?= $key['id_transaksi'] ?>')"><i class="icon-trash"></i></a>
                    <?php } ?>
                </td>
                <td>
                    
                </td> 

            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table> 
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
    function edit(id) {
        $.ajax({
            url: "<?= base_url() ?>user/poin/edit",
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

    function hapus(id) {
        swalInit({
            title: 'Konfirmasi !',
            text: 'Apakah anda yakin ingin membatalkan transaksi ini ?',
            type: 'warning',
            confirmButtonText: 'Ya !',
            showCancelButton: true,
            cancelButtonText: 'Tidak !',
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url() ?>user/poin/delete",
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
</script>