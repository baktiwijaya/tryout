<?php

	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=LAPORAN_JUMLAH_USER.xls');

?>
<style>

	table.tdetail {
	    border-collapse: collapse;
	    width:100%;
	    font-size: 10px;
	    font-family:arial;
	}
	table.tdetail, table.tdetail td, table.tdetail th {
	    border: 1px solid black;
	}
	table.tdetail thead {background-color: #CED8F6}

</style>

<table border="0" style="width:100%;">
    <tr>
        <td style="width:10%;text-align:left"><img src="<?php echo base_url() ?>assets/image/logo/aoishocca.png" height="90" width="100"></td>
        <td style="width:10%;text-align:center"></td>
    </tr>
    <tr>
    	<td style="width:80%;text-align:center" colspan="4"><div class="box-kop">LAPORAN JUMLAH USER</div></td>
    	<td style="width:10%;text-align:center"></td>
    </tr>
</table>
<br>
<br>
<table class="tdetail">
    <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Username</th>
            <th style="text-align: center;">Nama Lengkap</th>
            <th style="text-align: center;">No HP</th>
            <th style="text-align: center;">Poin</th>
            <th style="text-align: center;">Coin</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($list as $key) {  ?>
            <?php $koin = $this->Global_m->getvalue('total_koin','transaksi_koinpoin','id_user',$key['id']); ?>
            <?php $poin = $this->Global_m->getvalue('total_poin','transaksi_koinpoin','id_user',$key['id']); ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td style="text-align: center;"><?= $key['email'] ?></td>
                <td style="text-align: center;"><?= $key['nama_lengkap'] ?></td>
                <td style="text-align: center;"><?= $key['no_hp'] ?></td>
                <td style="text-align: center">
                    <?php echo ($poin =='') ? 0 : number_format($poin,2); ?> 
                </td>
                <td style="text-align: center">
                    <?php echo ($koin =='') ? 0 : number_format($koin,2); ?> 
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>
<table border="0" style="width:100%;">
    <tr><td></td></tr>
    <tr><td style="text-align:left;font-size: 10px;"><?php echo date('d F Y '); ?></td></tr>
</table>