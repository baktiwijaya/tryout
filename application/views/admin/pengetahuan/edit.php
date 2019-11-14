
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
$hidden_form = array('id' => $id);
echo form_open_multipart('admin/pengetahuan/update', $form_attribute, $hidden_form);
?>
<div class="form-group">
    <label>Topic</label>
    <?php $topic = array('name' => 'topic', 'maxlength' => '50', 'size' => '80', 'class' => 'form-control col-md-6', 'value' => $detail->topic); ?>
    <?= form_input($topic); ?>
</div>

<div class="form-group">
    <label class="col-form-label">Nama Soal</label>
    <textarea id="editor1" name="nama_soal" required><?php echo $detail->nama_soal ?></textarea>
</div>

<div class="form-group">
    <label class="col-form-label">Pembahasan Jawaban</label>
    <textarea name="pembahasan" id="editor2" required><?php echo $detail->pembahasan ?></textarea>
</div>
<div class="form-group">
    <label></label>
    <input type="button" value="Batal" class="btn btn-danger" onclick="load();">
    <input type="submit" name="save" value="Ubah" class="btn btn-primary">
</div>
<?= form_close(); ?>
<script type="text/javascript">

    var editor = CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: '<?= base_url(); ?>assets/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?= base_url(); ?>assets/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '<?= base_url(); ?>assets/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '<?= base_url(); ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?= base_url(); ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?= base_url(); ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        height: '200px'
    });

    var editor2 = CKEDITOR.replace('editor2', {
        filebrowserBrowseUrl: '<?= base_url(); ?>assets/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?= base_url(); ?>assets/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '<?= base_url(); ?>assets/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '<?= base_url(); ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?= base_url(); ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?= base_url(); ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        height: '200px'
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
                text: 'Apakah anda yakin ingin mengubah data ?',
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
                                        load();
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