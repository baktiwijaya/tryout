<div class="col-md-12">
    <div class="pull-right">
        <b style="font-size: 30px" id="time">00:00</b>
    </div>
</div>
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
echo form_open_multipart('user/do_tryout/save', $form_attribute);
?>
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
                        <input type="hidden" name="id_librarytrout[]" value="<?php echo $key['id_librarytrout'] ?>">
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
<input type="hidden" name="total" value="<?php count($list) ?>">
<?php for($i = 1;$i <= count($list); $i++) { ?>
    <input type="hidden" name="id_jawaban[]" id="jawab_<?php echo $i ?>">

<?php } ?>
<button type="submit" class="btn btn-success">Simpan Tryout</button>
<?php echo form_close(); ?>
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

    var validator = $('.myform').validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-invalid-label',
        successClass: 'validation-valid-label',
        validClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function (error, element) {
            if (element.parents().hasClass('form-check')) {
                error.appendTo(element.parents('.form-check').parent());
            } else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            } else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }
            // Other elements
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            swal({
            title: "Anda Yakin?",
            text: "Apakan anda ingin membeli koin ?",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-success btn-md waves-effect',
            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya!'

       }, function (isConfirm) {
            if (!isConfirm) return;
                $.ajax({
                    type: 'POST',
                    url: $("#myform").attr('action'),
                    data: $('#myform').serialize(),
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
                        var obj = JSON.parse(data);
                        swal({
                            title: obj[1],
                            text: obj[2],
                            type: obj[3],
                            showCancelButton: false,
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ya!'
                        }, function (isConfirm) {
                            if (!isConfirm) return;
                                if(obj[0] == true) {
                                    done_tryout();
                                }
                        });
                    }
                })
        });
        }
    });

    function done_tryout() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>user/do_tryout/done',
            data: $('#myform').serialize(),
            error: function (data) {
                alert('Proses data gagal', 'info')
            },
            success: function (data) {
                load();
            }
        })
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


<script type="text/javascript">

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

jQuery(function ($) {
    var fiveMinutes = 60 * '<?php echo $waktu_pengerjaan ?>',
        display = $('#time');
    startTimer(fiveMinutes, display);
});
</script>


