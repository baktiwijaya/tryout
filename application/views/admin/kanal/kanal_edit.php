<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
$hidden_form = array('id' => $id);
echo form_open_multipart('admin/kanal/update', $form_attribute, $hidden_form);
?>
<div class="form-group">
    <label>Kanal</label>
    <?php $kanal = array('name' => 'nama_kanal', 'maxlength' => '75', 'size' => '80', 'class' => 'form-control col-md-6', 'value' => $detail->nama_kanal); ?>
    <?= form_input($kanal); ?>
</div>
<div class="form-group">
    <label>Meta Title</label>
    <?php $title = array('name' => 'meta_title', 'class' => 'form-control col-md-6', 'value' => $detail->meta_title); ?>
    <?= form_input($title); ?>
</div>
<div class="form-group">
    <label>Meta Description</label>
    <?php $meta_desc = array('name' => 'meta_description', 'class' => 'form-control col-md-6', 'rows' => 3); ?>
    <?= form_textarea($meta_desc, $detail->meta_description); ?>
</div>
<div class="form-group">
    <label>Meta Keyword</label>
    <?php $meta_key = array('name' => 'meta_keyword', 'class' => 'form-control col-md-6', 'rows' => 3); ?>
    <?= form_textarea($meta_key, $detail->meta_keyword); ?>
</div>
<img src="<?php echo base_url() . 'uploads/cat-ico/' . $detail->icon ?>" style="width: 50px; height: 50px"><br>
* Icon yang terpasang

<div class="form-group">
    <div class="col-md-6">
        <label class="col-form-label">Icon Kanal</label>
        <input type="file" name="file_select_machin" id="file_select_machin" accept="image/*" class="form-input-styled">
        <input type="hidden" name="gambar" value="<?php echo $detail->icon ?>">
    </div>
</div>
<div class="form-group">
    <label></label>
    <input type="button" value="Batal" class="btn btn-danger" onclick="load();">
    <input type="submit" name="save" value="Ubah" class="btn btn-primary">
</div>
<?= form_close(); ?>
<script type="text/javascript">
    $('.form-input-styled').uniform({
        fileButtonClass: 'action btn bg-blue'
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