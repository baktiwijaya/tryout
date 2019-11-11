<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<div class="table-responsive">
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Nama Paket Coin</th>
                <th style="text-align: center;">Jumlah Bayar</th>
                <th style="text-align: center;">Diverifikasi oleh</th>
                <th style="text-align: center;">Tanggal Verifikasi</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($list as $key) {
                ?>
                <tr>
                    <td style="text-align: center"><?= $no ?></td>
                    <td style="text-align: left"><?= $this->Global_m->getvalue('nama_paketcoin','master_paketcoin','id_paketcoin',$key['id_paketcoin']); ?></td>
                    <td style="text-align: center"><?= number_format($this->Global_m->getvalue('harga_paketcoin','master_paketcoin','id_paketcoin',$key['id_paketcoin']),'2',',','.'); ?></td>
                    
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
            autoWidth: true,
            bLengthChange: false,
            "oLanguage": {
                "sSearch": ""
            }
        })
    })
    function edit(id) {
        $.ajax({
            url: "<?= base_url() ?>user/coin/edit",
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

    function hapus(id_transaksi) {
        swal({
            title: "Anda Yakin?",
            text: "Apakan anda ingin membatalkan pembelian ?",
            type: "error",
            showCancelButton: true,
            cancelButtonClass: 'btn-success btn-md waves-effect',
            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya!'

        }, function (isConfirm) {
            if (!isConfirm) return;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>user/coin/delete',
                    data: {
                        id : id_transaksi,
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
                        } else {
                            swal(obj[1],obj[2],'warning');
                        }
                    }
                })
        });
    }
</script>