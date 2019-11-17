
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
$hidden_form = array('id' => $id);
echo form_open_multipart('admin/paketpoin/update', $form_attribute, $hidden_form);
?>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Paket Poin</label>
            <input type="text" name="nama_paketpoin" class="form-control" required value="<?php echo $detail->nama_paketpoin ?>">
        </div>

        <div class="form-group">
            <label>Jumlah Poin</label>
            <input type="number" name="jumlah_paketpoin" class="form-control" value="<?php echo $detail->jumlah_paketpoin ?>" min="0">
        </div>

        <div class="form-group">
            <label>Nama Sosmed</label>
            <select name="id_sosmed" class="form-control col-md-6">
                <option value="">-- Pilih Kategori Pelajaran --</option>
                <?php 
                    foreach ($sosmed as $kat) {
                        if ($detail->id_sosmed == $kat['id_sosmed']) {
                            echo "<option value='". $kat['id_sosmed']."' selected='selected'>". $kat['nama_sosmed']."</option>";
                        }else{
                            echo "<option value='". $kat['id_sosmed']."'>". $kat['nama_sosmed']."</option>";
                        }
                        
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Instruksi Poin</label>
            <input type="text" name="instruksi_paketpoin" class="form-control" required value="<?php echo $detail->instruksi_paketpoin ?>">
        </div>

        <div class="form-group">
            <label>Expired</label>
            <input type="text" name="end_date" id="end_date" class="form-control" autocomplete="off" value="<?php echo $detail->end_date ?>">
        </div>

        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
            <input type="hidden" name="gambar_edit" class="form-control" value="<?php echo $detail->gambar ?>">
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

    var today = $('#end_date').val();
    $('input[name="end_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minDate: today,
        locale: {
            format: 'YYYY-MM-DD'
        }
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