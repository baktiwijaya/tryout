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
                <th style="width: 5%;text-align: center;">Gambar</th>
                 <th style="width: 5%;text-align: center;">Label</th>
                <th style="width: 20%;text-align: center;">Nama Jawaban</th>
                <th style="width: 20%;text-align: center;">Jawaban</th>
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
                    <td style="text-align: center">
                        <?php 
                            $filename = 'uploads/master_jawaban/'.$key['gambar'];
                                if (file_exists($filename)) {
                                    $gambar = $filename;
                                } else {
                                    $gambar = ''; 
                                }
                            ?>
                        <img src="<?php echo base_url().$gambar ?>" width="100" height="100"> 
                    </td>
                    <td><?= $key['label'] ?></td>
                    <td><?= $key['nama_jawaban'] ?></td>
                    <td style="text-align: center">
                        <?php $jawaban = ($key['is_true'] == 1) ? 'Benar' : 'Salah';echo $jawaban ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="#" class="btn btn-default" onclick="edit_jawaban('<?= $key['id_jawaban'] ?>')"><i class="icon-pencil"></i></a>
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
    function edit_jawaban(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/penalaran/edit_jawaban",
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
                $('#content_jawaban').html(data);
            }
        });
    }

    
</script>