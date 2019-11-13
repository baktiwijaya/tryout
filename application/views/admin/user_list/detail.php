<?php
$user_id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">User Profile<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
    </div>
    
    <div class="panel-body">
        <div class="row">
            <!-- Kolom Pertama -->
            <div class="col-md-6">

                <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->email ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">No HP</label>
                    <input type="number" name="topic" class="form-control" value="<?php echo $detail->no_hp ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <input type="password" name="topic" class="form-control" value="<?php echo $detail->password ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nama Lengkap</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->nama_lengkap ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nama Panggilan</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->nama_panggilan ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Jenis Kelamin</label>
                    <?php $jenis_kelamin = ($detail->jenis_kelamin == 1) ? "Pria" : "Wanita"; ?>
                    <input type="text" class="form-control" value="<?php echo $jenis_kelamin ?>" disabled>
                </div>

            </div>


            <!-- Kolom kedua -->
            <div class="col-md-6">


                <div class="form-group">
                    <label class="col-form-label">Kampus Impian</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->kampus_impian ?>" disabled disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nomor ID</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->verification_id_no ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tipe ID</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->verification_type ?>" disabled>
                </div>

                 <div class="form-group">
                    <label class="col-form-label">Tempat Lahir</label>
                    <input type="text" name="topic" class="form-control" value="<?php echo $detail->tempat_lahir ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tanggal Lahir</label>
                    <input type="text" name="topic" id="datepicker" class="form-control" value="<?php echo $detail->tanggal_lahir ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Photo</label>
                    <input type="file" name="topic" class="form-control" value="<?php echo $detail->photo ?>" disabled>
                </div>

            </div>


        </div>
        
        
        <div class="form-group">
            <label></label>
            <button type="button" class="btn btn-outline-danger" onclick="load()">Kembali</button>
        </div>
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




