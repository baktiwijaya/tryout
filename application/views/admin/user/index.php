<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= $title ?></h6>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload" onclick="load()"></a>
            </div>
        </div>
    </div>
    <?php
    $attributes = array('class' => 'myform', 'name' => '', 'id' => 'myform');
    echo form_open_multipart('admin/User/save', $attributes);
    ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Nama Pena</label>
                    <input type="text" name="pen_name" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="text" name="email" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Katasandi</label>
                    <input type="password" name="password" class="form-control" required="">
                </div>               
                <div class="form-group">
                    <label>No. HP</label>
                    <input type="text" name="mobile" class="form-control" required="">
                </div>   
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="photo" class="form-control" required="">
                </div>   
                <div class="form-group">
                    <label>Sebagai</label>
                    <select name="type" class="form-control" id="type">
                        <option value="">-- Pilih User Role --</option>
                        <?php foreach ($user_role as $key) : ?>
                            <option value="<?= $key['id'] ?>"><?= $key['user_type'] ?></option>   
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kanal Management</label>
                    <select name="kanal_management" class="form-control select2" id="kanal_management" required>
                        <option value="">-- Pilih Kanal --</option>
                        <?php foreach ($kanal as $key) : ?>
                            <option value="<?= $key['id_kanal'] ?>"><?= $key['nama_kanal'] ?></option>   
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div> 
            </div>    
        </div>
    </div>
    <?= form_close(); ?>
</div>
<script type="text/javascript">
    $('.select2').select2();
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
                title: 'Konfirmasi!',
                text: 'Apakah anda sudah yakin ini ingin menyimpan data?',
                type: 'warning',
                confirmButtonText: 'Ya!',
                showCancelButton: true,
                cancelButtonText: 'Tidak!',
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
                                        $('#myform')[0].reset;
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
