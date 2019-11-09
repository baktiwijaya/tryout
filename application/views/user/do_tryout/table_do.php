<div class="row">
    <div class="col-md-8">
        <?php $no = 1; foreach ($list as $key) : ?>
            <div id="soal_<?php echo $no ?>">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h6>Soal Nomor <?php echo $no ?></span></h6>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo $this->Global_m->getvalue('nama_soal','master_soal','id_soal',$key['id_soal']); ?>
                        <hr>
                        <?php $jawaban = $this->Crud_m->all_data('master_jawaban','*',"id_soal=".$key['id_soal']); ?>

                        <?php $nos = 1;foreach($jawaban as $value) : ?>
                            <input type="radio" name="id_jawaban_<?php echo $key['nomor'] ?>" onclick="jawaban(this.value,'<?php echo $key['nomor'] ?>');check_value('<?php echo $key['nomor'] ?>')" value="<?php echo $value['id_jawaban'] ?>">&nbsp;<?php echo $value['label']; ?>.&nbsp;<?php echo $value['nama_jawaban']; ?>
                            <hr>
                        <?php $nos++;endforeach; ?>
                        <button type="button" class="btn btn-md btn-danger" onclick="javascript:show_prev('<?php echo $no ?>');" id="btnprev_<?php echo $no; ?>" hidden>Kembali</button>
                        <button type="button" class="btn btn-md btn-success" onclick="javascript:show_next('<?php echo $no ?>');" id="btnnext_<?php echo $no; ?>">Lanjut</button>
                    </div>
                </div>
            </div>
        <?php $no++; endforeach; ?>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <h6>Jumlah Soal : <?php echo count($list) ?></h6>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php for($i = 1;$i <= count($list); $i++) { ?>
                        <div class="col-md-3">
                            <div class="panel" id="<?php echo $i ?>" onclick="change('<?php echo $i ?>')">
                                <div class="panel-body">
                                    <?php echo $i ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php for($i = 1;$i <= count($list); $i++) { ?>
    <input type="text" name="jawab_<?php echo $i ?>" id="jawab_<?php echo $i ?>">
<?php } ?>

<input type="hidden" id="posisi">
<script type="text/javascript">
    var total = '<?php echo count($list)?>';

    for(i = 2;i <= total;i++) {
        $('#soal_'+i).hide();
    }

    $('#posisi').val(1);

    function check_value(nomor) {
        
        if($('#jawab_'+nomor).val() == '' || $('#jawab_'+nomor).val() == null) {
            console.log($('#jawab_'+nomor).val());
            $('#'+nomor).addClass('bg-danger');
        } else {
            $('#'+nomor).addClass('bg-green');
        }
    }

    $('#btnnext_'+total).hide();
    $('#btnprev_1').hide();

    function show_next(id) {
        check_value(id);
        var next = parseInt(id) + 1;
        $('#soal_'+id).hide();
        $('#soal_'+next).show();
        $('#posisi').val(next);
    }

    function show_prev(id) {
        check_value(id);
        var prev = parseInt(id) - 1;
        $('#soal_'+id).hide();
        $('#soal_'+prev).show();
        $('#posisi').val(prev);
    }

    function jawaban(id,nomor) {
      $('#jawab_'+nomor).val(id);
    }

    function change(nomor) {

        var posisi = $('#posisi').val();
        check_value(posisi);
        for(i = 1;i <= total;i++) {

            $('#soal_'+i).hide();
        }
        $('#soal_'+nomor).show();
        $('#posisi').val(nomor);
    }


</script>
