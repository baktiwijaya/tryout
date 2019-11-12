<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>

<table class="table" id="datatable">
    <thead>
        <tr>
            <th style="text-align: center;width: 5%;">#</th>
            <th style="width: 20%;text-align: center;">Tryout</th>
            <th style="width: 20%;text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id_user = $this->session->userdata('id');
        $no = 1; foreach ($list as $key) : ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $this->Global_m->getvalue('nama_tryout','master_tryout','id_tryout',$key['id_tryout']); ?></td>
                <td style="text-align: center;">
                    
                    <?php $exist = $this->Crud_m->countWhereValue('library_pakettryout','id_tryout='.$key['id_tryout'],'test_status = 1'); ?>
                    <?php $exist2 = $this->Crud_m->countWhere('library_pakettryout','id_tryout='.$key['id_tryout']); ?>

                    <?php if($exist2 == $exist) { ?>
                        <button type="button" class="btn btn-warning" onclick="rapot('<?php echo $key['id_library'] ?>')">Lihat Rapot</button>
                    <?php } else{ ?>
                        <button type="button" class="btn btn-success" onclick="edit('<?php echo $key['id_library'] ?>')">Kerjakan Tryout</button>
                    <?php } ?>
                    
                    
                </td>
            </tr>
            <?php $no++; endforeach; ?>
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
            url: "<?= base_url() ?>user/do_tryout/take_test",
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

   
    function rapot(id) {
        $.ajax({
            url: "<?= base_url() ?>user/do_tryout/rapot",
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