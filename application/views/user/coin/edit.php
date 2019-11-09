
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
$hidden_form = array('id' => $id);
echo form_open_multipart('user/coin/update', $form_attribute, $hidden_form);
?>
<div class="form-group">
    <label>Upload Bukti Pembayaran</label>
    <input type="file" class="form-control col-md-6" name="gambar">
</div>

<div class="form-group">
    <label>Catatan</label>
    <input type="text" class="form-control col-md-6" name="note">
</div>
<hr>
<br>
<div class="form-group">
    <label></label>
    <input type="button" value="Batal" class="btn btn-danger" onclick="load();">
    <input type="submit" name="save" value="Upload" class="btn btn-primary">
</div>
<?= form_close(); ?>
<script type="text/javascript">
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
                text: "Apakan anda mengupload bukti transaksi ?",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-success btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Ya!'

            }, function (isConfirm) {
                if (!isConfirm) return;
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
                            swal({
                                title: obj[1],
                                text: obj[2],
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                                confirmButtonText: 'Ya!'
                            }, function (isConfirm) {
                                if (!isConfirm) return;
                                load();
                            });
                        }
                    })
               });
        }
    });
</script>