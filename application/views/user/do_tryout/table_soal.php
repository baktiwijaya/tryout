<?php echo $this->Global_m->getvalue('nama_soal','master_soal','id_soal',$list->id_soal); ?>

<?php $jawaban = $this->Crud_m->all_data('master_jawaban','*',"id_soal=$list->id_soal"); ?>
<?php
	$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
	echo form_open_multipart('user/do_tryout/save', $form_attribute);
?>
<?php $no = 1;foreach($jawaban as $key) : ?>
	<input type="radio" name="id_jawaban" value="<?php echo $key['is_true'] ?>">&nbsp;<?php echo $key['label']; ?>.&nbsp;<?php echo $key['nama_jawaban']; ?>
	<hr>
<?php $no++;endforeach; ?>
<br>
<button type="button" class="btn btn-danger">Kembali</button>
<button type="submit" class="btn btn-primary">Lanjutkan</button>

<?php echo form_close(); ?>
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
	            text: "Apakan anda ingin membeli tryout menggunakan koin ?",
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
	                            if(obj[0] == true) {
	                            	var nomor = '<?php echo $this->session->userdata('nomor_soal') ?>';
	                            	var id_paket = '<?php echo $this->session->userdata('id_paket') ?>';
	                            	var total_soal = '<?php echo $this->session->userdata('total_soal') ?>';
	                            	if(nomor == total_soal) {
	                            		load()
	                            	} else {
	                            		do_test(id_paket);
	                            	} 
	                            }
	                            
	                        });
	                        
	                    }
	                })
	        });
        }
    });
                    
</script>

