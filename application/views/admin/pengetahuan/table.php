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
                <th style="width: 70%;text-align: center;">Nama Soal</th>
                <th style="width: 15%;text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($list as $key) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $key['nama_soal'] ?></td>
                    <td style="text-align: center;">
                        <a href="#" class="btn btn-default" onclick="load_jawaban('<?= $key['id_soal'] ?>')"><i class="fa fa-plus"></i></a>
                        <a href="#" class="btn btn-default" onclick="edit('<?= $key['id_soal'] ?>')"><i class="icon-pencil"></i></a>
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
    function edit(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/pengetahuan/edit",
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

    function load_jawaban(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/pengetahuan/index_jawaban",
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