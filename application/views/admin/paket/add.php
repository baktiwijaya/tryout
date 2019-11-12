
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
echo form_open_multipart('admin/paket/save', $form_attribute);
?>
<div class="form-group">
    <label class="col-form-label">Nama Paket</label>
    <input type="text" name="nama_paket" class="form-control" required>
</div>
<div class="form-group">
    <label>Kategori Pelajaran</label>
    <select name="id_kategori" class="form-control col-md-6">
        <option value="">-- Pilih Kategori Pelajaran --</option>
        <?php foreach($kategori as $data) : ?>
            <option value="<?php echo $data['id_kategori'] ?>"><?php echo $data['nama_kategori'] ?></option>
        <?php endforeach; ?>
    </select>
</div>

<label class="col-form-label">Waktu Pengerjaan</label>
<div class="input-group">
    <input type="number" class="form-control col-md-5" name="waktu_pengerjaan" placeholder="Input Waktu Pengerjaan..">
    <span class="input-group-append">
        <span class="input-group-text">Menit</span>
    </span>
</div>

<div class="form-group">
    <label class="col-form-label">Petunjuk Pengerjaan</label>
    <textarea class="form-control" name="petunjuk_pengerjaan" id="editor1"></textarea>
</div>
<br>
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

    var editor = CKEDITOR.replace('editor1', {
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