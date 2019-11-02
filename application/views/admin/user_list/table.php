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
                <th style="text-align: left;">Username</th>
                <th style="text-align: center;">Nama Lengkap</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($list as $key) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $key['email'] ?></td>
                    <td><?= $key['nama_lengkap'] ?></td>
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
   
</script>