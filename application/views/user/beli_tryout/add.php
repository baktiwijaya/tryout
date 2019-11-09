
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
echo form_open_multipart('user/beli_tryout/save', $form_attribute);
?>
<?php $id_user = $this->session->userdata('id'); ?>
<div class="col-md-12">
    <div class="form-row">
        <?php foreach($tryout as $key) : ?>

           <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body text-center">
                    <i class="icon-poins icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="card-title"><?php echo $key['nama_tryout'] ?></h5>
                        <p class="mb-3"><b>Koin</b> : <?php echo number_format($key['harga_koin']); ?></p>
                        <p class="mb-3"><b>Poin</b> : <?php echo $key['harga_poin']; ?></p>
                        <?php $exist = $this->Global_m->isExists2Key('id_user',$id_user,'id_tryout',$key['id_tryout'],'library_tryout'); ?>
                        <?php if(!$exist) { ?>
                            <a href="#" class="btn bg-info-400" onclick="save_koin('<?php echo $key['id_tryout'] ?>')">Koin</a>
                            <a href="#" class="btn bg-success-400" onclick="save_poin('<?php echo $key['id_tryout'] ?>')">Poin</a>
                        <?php } else { ?>
                            <p class="mb-3"><b>Tryout tidak dapat dibeli !</b></p>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<br>
<div class="col-md-12">
    <div class="form-group">
        <label></label>
        <input type="button" value="Batal" class="btn btn-danger" onclick="load();">
    </div>
</div>

<?= form_close(); ?>
<script type="text/javascript">
    $('.form-input-styled').uniform({
        fileButtonClass: 'action btn bg-blue'
    });
    var elems = Array.prototype.slice.call(document.querySelectorAll('.form-input-switchery'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html);
    });
    
    function save_koin(id) {
        swal({
            title: "Anda Yakin?",
            text: "Apakan anda ingin membeli tryout menggunakan koin ?",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-success btn-md waves-effect',
            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya!'

        }, function (isConfirm) {
            if (!isConfirm) return;
                var datana = 'id='+id;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>user/beli_tryout/save_koin',
                    data: {
                        id_tryout: id
                    },
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
                    
    function save_poin(id) {
        swal({
            title: "Anda Yakin?",
            text: "Apakan anda ingin membeli tryout menggunakan poin ?",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-success btn-md waves-effect',
            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya!'

        }, function (isConfirm) {
            if (!isConfirm) return;
                var datana = 'id='+id;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>user/beli_tryout/save_poin',
                    data: {
                        id_tryout: id
                    },
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
                            swal(obj[1],obj[2],'success');
                            load();
                        } else {
                            swal(obj[1],obj[2],'warning');
                        }
                    }
                })
        });
    }
</script>