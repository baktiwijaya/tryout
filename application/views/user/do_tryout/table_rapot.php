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
            <th style="width: 20%;text-align: center;">Jawaban Benar</th>
            <th style="width: 20%;text-align: center;">Jawaban Salah</th>
            <th style="width: 20%;text-align: center;">Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($list as $key) : ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $this->Global_m->getvalue('nama_paket','master_paket','id_paket',$key['id_paket']); ?></td>
                <td style="text-align: center;"><?php echo $key['jawaban_benar'] ?></td>
                <td style="text-align: center;"><?php echo $key['jawaban_salah'] ?></td>
                <td style="text-align: center;"><?php echo number_format($key['nilai'],2) * 3 ?></td>
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
    
</script>