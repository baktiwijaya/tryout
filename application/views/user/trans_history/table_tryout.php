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
                <th style="text-align: center;">Tryout</th>
                <th style="text-align: center;">Pembelian<br>Menggunakan</th>
                <th style="text-align: center;">Jumlah<br>Pengeluaran</th>
                <th style="text-align: center;">Tanggal Beli</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;foreach ($list as $key) : ?>
                <tr>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td style="text-align: left;">
                        <?= $this->Global_m->getvalue('nama_tryout','master_tryout','id_tryout',$key['id_tryout']); ?>
                    </td>
                    <td style="text-align: center;">
                        <?= ($key['tipe_beli'] == 1) ? 'Koin' : 'Poin'; ?>
                    </td>
                    <td style="text-align: right;">
                        <?= number_format($key['jumlah_pengurangan'],2); ?>
                    </td>
                    <td style="text-align: center"><?= $key['tanggal_beli'] ?></td>                    
                </tr>
                <?php $no++; endforeach;?>
        </tbody>
    </table> 
</div>

<?= form_close(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            bSort: false,
            searching: false,
            bLengthChange: false,
            bInfo: false,
            "oLanguage": {
                "sSearch": ""
            }
        })
    })
</script>