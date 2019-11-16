
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
echo form_open_multipart('admin/paketpoin/save', $form_attribute);
?>
<div class="form-row">
    <div class="col-md-6">

        <div class="form-group">
            <label>Paket Poin</label>
            <input type="text" name="nama_paketpoin" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jumlah Poin</label>
            <input type="number" name="jumlah_paketpoin" class="form-control" min="0">
        </div>

        <div class="form-group">
            <label>Nama Sosmed</label>
            <select class="form-control select2" name="id_sosmed">
                <option value="">-- Pilih Nama Sosmed --</option>
                <?php foreach ($sosmed as $key) : ?>
                    <option value="<?php echo $key['id_sosmed'] ?>"><?php echo $key['nama_sosmed'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Instruksi Poin</label>
            <input type="text" name="instruksi_paketpoin" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Expired</label>
            <input type="text" name="end_date" id="end_date" class="form-control" autocomplete="off">
        </div>

        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
    </div>
</div>

<div class="form-group">
    <label></label>
    <input type="button" value="Batal" class="btn btn-danger" onclick="load();">
    <input type="submit" name="save" value="Simpan" class="btn btn-primary">
</div>
<?= form_close(); ?>
<script type="text/javascript">

    $('.select2').select2();


    $('#end_date').on('click', function (e) {
        $('#end_date').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
    });

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