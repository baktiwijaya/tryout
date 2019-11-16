
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
$hidden_form = array('id' => $id);
echo form_open_multipart('admin/tryout/update', $form_attribute, $hidden_form);
?>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Nama Paket</label>
            <input type="text" name="nama_tryout" class="form-control"value="<?php echo $detail->nama_tryout ?>">
        </div>

        <div class="form-group">
            <label>Harga Koin</label>
            <input type="number" name="harga_koin" class="form-control"value="<?php echo $detail->harga_koin ?>" min="0">
        </div>

        <div class="form-group">
            <label>Harga Poin</label>
            <input type="number" name="harga_poin" class="form-control"value="<?php echo $detail->harga_poin ?>" min="0">
        </div>

        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="text" name="start_date" class="form-control datepicker" id="start_date" value="<?php echo $detail->start_date ?>"/>
        </div>

        <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="text" name="end_date" class="form-control datepicker" id="end_date" value="<?php echo $detail->end_date ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
    <label></label>
    <input type="button" value="Batal" class="btn btn-danger" onclick="load();">
    <input type="submit" name="save" value="Ubah" class="btn btn-primary">
</div>
<?= form_close(); ?>
<script type="text/javascript">

    $('.select2').select2();

    $('#start_date').on('click', function (e) {
        $('#start_date').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
    });

    $('#end_date').on('click', function (e) {
        $('#end_date').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
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