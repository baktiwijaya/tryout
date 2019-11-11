<?php
$user_id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
    </div>
    
    <div class="panel-body">
        <?php
        $form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
        echo form_open_multipart('user/user_profile/save', $form_attribute);
        ?>
        <div class="row">
            <!-- Kolom Pertama -->
            <div class="col-md-6">

                <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->email ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">No HP</label>
                    <input type="number" name="topic" class="form-control" value="<?php echo $detail->no_hp ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <input type="password" name="topic" class="form-control" value="<?php echo $detail->password ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nama Lengkap</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->nama_lengkap ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nama Lengkap</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->nama_panggilan ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Jenis Kelamin</label>
                    <select class="form-control">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="1">Pria</option>
                        <option value="2">Wanita</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tempat Lahir</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->tempat_lahir ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tanggal Lahir</label>
                    <input type="text" name="topic" id="datepicker" class="form-control" value="<?php echo $detail->tanggal_lahir ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Photo</label>
                    <input type="file" name="topic" class="form-control" value="<?php echo $detail->photo ?>">
                </div>

            </div>


            <!-- Kolom kedua -->
            <div class="col-md-6">


                <div class="form-group">
                    <label class="col-form-label">Kampus Impian</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->kampus_impian ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nomor ID</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->verification_id_no ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tipe ID</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->verification_type ?>">
                </div>

            </div>


        </div>
        
        
        <div class="form-group">
            <label></label>
            <input type="submit" name="save" value="Simpan" class="btn btn-primary">
        </div>
        <?= form_close(); ?>
    </div>
</div>
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




