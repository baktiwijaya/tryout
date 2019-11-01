<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<table class="table table-bordered" id="datatable">
    <thead>
        <tr>
            <th style="text-align: center;width: 5%;">#</th>
            <th style="width: 60%;text-align: center;">Role</th>
            <th style="width: 35%;text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($list as $key) {
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $key['user_type'] ?></td> 
                <td style="text-align: center;">
                    <a href="#" class="btn btn-default" onclick="edit('<?= $key['id'] ?>')" title="Edit"><i class="icon-pencil"></i></a>
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
            searching: false,
        })
    })
    function edit(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/role/edit",
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