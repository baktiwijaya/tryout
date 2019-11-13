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
                <th style="text-align: center;">Paket Koin</th>
                <th style="text-align: center;">Jumlah Koin</th>
                <th style="text-align: center;">Tanggal Beli</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;foreach ($list as $key) : ?>
                <tr>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td style="text-align: left;">
                        <?= $this->Global_m->getvalue('nama_paketcoin','master_paketcoin','id_paketcoin',$key['id_paketcoin']); ?>
                    </td>
                    <td style="text-align: right;">
                        <?php $jumlah = $this->Global_m->getvalue('jumlah_paketcoin','master_paketcoin','id_paketcoin',$key['id_paketcoin']); ?>
                        <?= number_format($jumlah,2) ?>
                    </td>
                    <td style="text-align: center"><?= $key['tanggal_pembelian'] ?></td>                    
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