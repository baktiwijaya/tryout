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
                <input type="hidden" name="id" value="<?php echo $detail->id ?>">
                <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $detail->email ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">No HP</label>
                    <input type="number" name="no_hp" class="form-control" value="<?php echo $detail->no_hp ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $detail->password ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $detail->nama_lengkap ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nama Panggilan</label>
                    <input type="text" name="nama_panggilan" class="form-control" value="<?php echo $detail->nama_panggilan ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <?php if($detail->jenis_kelamin == 1) { ?>
                            <option value="1" selected>Pria</option>
                            <option value="2">Wanita</option>
                        <?php } else { ?>
                            <option value="1">Pria</option>
                            <option value="2" selected>Wanita</option>
                        <?php } ?>
                       
                    </select>
                </div>

            </div>


            <!-- Kolom kedua -->
            <div class="col-md-6">


                <div class="form-group">
                    <label class="col-form-label">Kampus Impian</label>
                    <input type="text" name="kampus_impian" class="form-control" value="<?php echo $detail->kampus_impian ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nomor ID</label>
                    <input type="text" name="verification_id_no" class="form-control" value="<?php echo $detail->verification_id_no ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tipe ID</label>
                    <input type="text" name="verification_type" class="form-control" value="<?php echo $detail->verification_type ?>">
                </div>

                 <div class="form-group">
                    <label class="col-form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $detail->tempat_lahir ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tanggal Lahir</label>
                    <input type="text" name="tanggal_lahir" class="form-control" value="<?php echo $detail->tanggal_lahir ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Photo</label>
                    <input type="file" name="photo" class="form-control" value="<?php echo $detail->photo ?>">
                </div>

            </div>


        </div>
        
        
        <div class="form-group">
            <label></label>
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<script type="text/javascript">

    $('.form-input-styled').uniform({
        fileButtonClass: 'action btn bg-blue'
    });

    $('input[name="tanggal_lahir"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2000,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
            format: 'YYYY-MM-DD'
        }
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
             swal({
            title: "Anda Yakin?",
            text: "Apakan anda yakin ingin mengubah profil ?",
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
                            type: obj[3],
                            showCancelButton: false,
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ya!'
                        }, function (isConfirm) {
                            if (!isConfirm) return;
                            
                        });
                    }
                })
        });
        }
    });
</script>




