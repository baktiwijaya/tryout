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
                <th style="text-align: center;">Username</th>
                <th style="text-align: center;">Nama Lengkap</th>
                <th style="text-align: center;">No HP</th>
                <th style="text-align: center;">Poin</th>
                <th style="text-align: center;">Coin</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($list as $key) {  ?>
                <?php $koin = $this->Global_m->getvalue('total_koin','transaksi_koinpoin','id_user',$key['id']); ?>
                <?php $poin = $this->Global_m->getvalue('total_poin','transaksi_koinpoin','id_user',$key['id']); ?>
                <tr>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td style="text-align: center;"><?= $key['email'] ?></td>
                    <td style="text-align: center;"><?= $key['nama_lengkap'] ?></td>
                    <td style="text-align: center;"><?= $key['no_hp'] ?></td>
                    <td style="text-align: center">
                        <?php echo ($poin =='') ? 0 : number_format($poin,2); ?> 
                    </td>
                    <td style="text-align: center">
                        <?php echo ($koin =='') ? 0 : number_format($koin,2); ?> 
                    </td>
                    <td style="text-align: center;"><button type="button" class="btn btn-primary" onclick="get_data('<?php echo $key['id'] ?>');"><i class="fa fa-eye"></i></button></td>
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
            autoWidth:true,
            "oLanguage": {
                "sSearch": ""
            }
        })
    })

    function get_data(id_user) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>admin/user_list/load_user',
            data : {
                id: id_user
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
        })
    }
   
</script>