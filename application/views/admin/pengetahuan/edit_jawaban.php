
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
$hidden_form = array('id' => $id);
echo form_open_multipart('admin/pengetahuan/update_jawaban', $form_attribute,$hidden_form);
?>
<div class="form-group">
    <label>Label</label>
    <?php $label = array('name' => 'label', 'class' => 'form-control col-md-6', 'value' => $detail->label); ?>
    <?= form_input($label); ?>
</div>
<div class="form-group">
    <label>Nama Jawaban</label>
    <?php $nama_jawaban = array('name' => 'nama_jawaban', 'class' => 'form-control col-md-6', 'value' => $detail->nama_jawaban); ?>
    <?= form_input($nama_jawaban); ?>
</div>

<div class="form-group">
    <label>Jawaban</label>
    <select class="form-control col-md-6" name="is_true">
        <?php if($detail->is_true == 1) { ?>
            <option value="1" selected>Benar</option>
            <option value="2">Salah</option>
        <?php } else { ?>
            <option value="1">Benar</option>
            <option value="2" selected>Salah</option>
        <?php } ?>
        
    </select>
</div>

<div class="form-group">
    <label>Gambar</label>
    <input type="file" name="gambar" class="form-control col-md-6">
    <input type="hidden" name="gambar_edit" value="<?php echo $detail->gambar ?>">
    <?php echo $detail->gambar ?>
</div>


<div class="form-group">
    <label></label>
    <input type="button" value="Batal" class="btn btn-danger" onclick="load();">
    <input type="submit" name="save" value="Simpan" class="btn btn-primary">
</div>
<?= form_close(); ?>
<script type="text/javascript">
    $('.form-input-styled').uniform({
        fileButtonClass: 'action btn bg-blue'
    });
    var elems = Array.prototype.slice.call(document.querySelectorAll('.form-input-switchery'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html);
    });
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
            swalInit({
                title: 'Konfirmasi !',
                text: 'Apakah anda yakin ingin menyimpan data ?',
                type: 'warning',
                confirmButtonText: 'Ya !',
                showCancelButton: true,
                cancelButtonText: 'Tidak !',
            }).then(function (result) {
                if (result.value) {
                    var data = new FormData(form);
                    $.ajax({
                        type: 'POST',
                        url: $("#myform").attr('action'),
                        data: data,
                        contentType: false,
                        processData: false,
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
                            if (obj[0]) {
                                swalInit({
                                    type: 'success',
                                    text: obj[2]
                                }).then(function (con) {
                                    if (con.value) {
                                        load_jawaban();
                                    }
                                })
                            } else {
                                swalInit({
                                    type: 'warning',
                                    text: obj[2]
                                })
                            }
                        }
                    })
                }
            });
        }
    });
</script>