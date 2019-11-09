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
                    <button type="button" class="btn btn-success">Petunjuk Pengerjaan</button>
                    <button type="button" class="btn btn-danger" onclick="do_test('<?php echo $key['id_paket'] ?>')">Kerjakan Tryout</button>
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
    function do_test(id) {
        $.ajax({
            url: "<?= base_url() ?>user/do_tryout/do_test",
            type: "POST",
            data: {
                id: id
            },
            success: function (data) {
                $('#content').html(data);
            }
        });
    }

    
</script>