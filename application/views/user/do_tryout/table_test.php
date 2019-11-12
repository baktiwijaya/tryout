<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<table class="table" id="datatable">
    <thead>
        <tr>
            <th style="text-align: center;width: 5%;">#</th>
            <th style="width: 20%;text-align: center;">Nama Paket</th>
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
                <td><?= $this->Global_m->getvalue('nama_paket','master_paket','id_paket',$key['id_paket']); ?></td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-success" onclick="petunjuk('<?php echo $key['id_paket'] ?>')">Petunjuk Pengerjaan</button>
                    <?php if($key['test_status'] == 1) { ?>
                        <button type="button" class="btn btn-info">Sudah Dikerjakan</button>
                    <?php } else{ ?>
                        <button type="button" class="btn btn-danger" onclick="do_test('<?php echo $key['id_librarytryout'] ?>','<?php echo $key['id_paket'] ?>')">Kerjakan Tryout</button>
                    <?php } ?>
                    
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table> 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Petunjuk Pengerjaan</h4>
      </div>
      <div class="modal-body">
       <div id="modal_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
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
    function do_test(id_lt,id) {
        $.ajax({
            url: "<?= base_url() ?>user/do_tryout/do_test",
            type: "POST",
            data: {
                id_paket: id,
                id_librarytryout: id_lt
            },
            success: function (data) {
                $('#content').html(data);
            }
        });
    }

     function petunjuk(id) {
        $.ajax({
            url: "<?= base_url() ?>user/do_tryout/petunjuk",
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
                $('#myModal').modal('show');
                $('#modal_content').html(data);
            }
        });
    }


    
</script>