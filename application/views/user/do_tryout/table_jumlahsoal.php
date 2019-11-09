
<div class="row">
    <?php $no = 1;foreach($list as $key) : ?>
        <?php if($key['is_done'] == 0) {
            $color = '';
        } else if($key['is_done'] == 1) {
            $color = 'bg-success';
        } else if($key['is_done'] == 2) {
            $color = 'bg-warning';
        } ?>
        <div class="col-md-3">
            <div class="panel <?php echo $color ?>">
                <div class="panel-body">
                    <a href="#" onclick="ganti_soal('<?php echo $key['nomor'] ?>');jumlah_soal();save();">
                        <?php echo $no; ?> 
                    </a>
                </div>
            </div>
        </div>
    <?php $no++;endforeach; ?>
</div>