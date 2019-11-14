<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<table class="table" id="datatable">
    <thead>
        <tr>
            <th style="text-align: center;width: 5%;">#</th>
            <th style="width: 15%;text-align: center;">Nama Paket Coin</th>
            <th style="width: 15%;text-align: center;">Jumlah Bayar</th>
            <th style="width: 15%;text-align: center;">Tanggal Pembelian</th>
            <th style="width: 15%;text-align: center;">User Pembeli</th>
            <th style="width: 15%;text-align: center;">Tanggal Verifikasi</th>
            <th style="width: 15%;text-align: center;">Diverifikasi Oleh</th>
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
                <td style="text-align: center;"><?php echo ($key['tanggal_pembelian'] != '') ? $key['tanggal_pembelian'] : '-' ?></td>
                <td style="text-align: center"><?php echo $this->Global_m->getvalue('nama_lengkap','user_info','id',$key['id_user']) ?></td>
                <td style="text-align: center;"><?php echo ($key['tanggal_verifikasi'] != '') ? $this->fungsi->RegularDateTime($key['tanggal_verifikasi']) : '-' ?></td>
                <td style="text-align: center;">
                   <?php echo $this->Global_m->getvalue('nama_lengkap','user_info','id',$key['verified_by']) ?>
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
    function edit(id,gambar,note) {
        $.ajax({
            url: "<?= base_url() ?>admin/historicoin/edit",
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
                    url: "<?= base_url() ?>admin/historicoin/update",
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