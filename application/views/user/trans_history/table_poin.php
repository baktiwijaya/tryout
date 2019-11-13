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
                <th style="text-align: center;">Paket Poin</th>
                <th style="text-align: center;">Jumlah Poin</th>
                <th style="text-align: center;">Tanggal Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;foreach ($list as $key) : ?>
                <tr>
                    <td style="text-align: center"><?= $no ?></td>
                    <td style="text-align: left">
                        <?= $this->Global_m->getvalue('nama_paketpoin','master_paketpoin','id_paketpoin',$key['id_paketpoin']); ?>
                    </td>
                    <td style="text-align: right;">
                        <?php $jumlah = $this->Global_m->getvalue('jumlah_paketpoin','master_paketpoin','id_paketpoin',$key['id_paketpoin']); ?>
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
            autoWidth: true,
            bLengthChange: false,
            bInfo: false,
            "oLanguage": {
                "sSearch": ""
            }
        })
    })
</script>