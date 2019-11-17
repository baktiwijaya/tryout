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
                <th style="width: 15%;text-align: center;">Nama Paket Coin</th>
                <th style="width: 15%;text-align: center;">Jumlah Bayar</th>
                <th style="width: 15%;text-align: center;">User Pembeli</th>
                <th style="width: 20%;text-align: center;">Tanggal Pembelian</th>
                <th style="width: 20%;text-align: center;">Status</th>
                <th style="width: 20%;text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($list as $key) {
                ?>
                <tr>
                    <td style="text-align: center"><?= $no ?></td>
                    <td style="text-align: center"><?= $this->Global_m->getvalue('nama_paketcoin','master_paketcoin','id_paketcoin',$key['id_paketcoin']); ?></td>
                    <td style="text-align: center"><?= number_format($this->Global_m->getvalue('harga_paketcoin','master_paketcoin','id_paketcoin',$key['id_paketcoin']),'2',',','.'); ?></td>
                    <td style="text-align: center"><?php echo $this->Global_m->getvalue('nama_lengkap','user_info','id',$key['id_user']) ?></td>
                    <td style="text-align: center;"><?php echo ($key['tanggal_pembelian'] != '') ? $key['tanggal_pembelian'] : '-' ?></td>
                    <td style="text-align: center;">
                        <?php 
                            if($key['status'] == 0) {
                                echo "Belum diproses";
                            } else if($key['status'] == 1) {
                                echo "Sedang Review";
                            } else if($key['status'] == 3){
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
                            <a href="#" class="btn btn-default" onclick="hapus('<?= $key['id_transaksi'] ?>','<?php echo base_url() ?>uploads/bukti_pembayaran/<?php echo $key['gambar'] ?>','<?php echo $key['note'] ?>')"><i class="icon-check"></i></a>
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
            bLengthChange: false,
            "oLanguage": {
                "sSearch": ""
            }
        })
    })
    function edit(id,gambar,note) {
        $.ajax({
            url: "<?= base_url() ?>admin/transaksicoin/edit",
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

    function hapus(id,gambar,note) {
        swalInit({
            title: 'Bukti Pembayaran',
            text: 'Verifikasi transaksi ini ?',
            imageUrl: gambar,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            confirmButtonText: 'Verifikasi',
            showCancelButton: true,
            cancelButtonText: 'Kembali',
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url() ?>admin/transaksicoin/update",
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