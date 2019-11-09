<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<div class="row">
    <div class="col-md-8">
        <div class="panel">
            <div class="panel-heading">
                <h6 class="panel-title">Soal<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            </div>
            <div class="panel-body">
                <div id="content_soal" class="table-responsive"></div>
            </div>
        </div>        
    </div>
    <div class="col-md-4">
       <div class="panel">
            <div class="panel-heading">
                <h6 class="panel-title">Jumlah Soal<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            </div>
            <div class="panel-body">
                <div id="jumlah_soal" class="table-responsive"></div>
            </div>
        </div>  
    </div>
</div>

<?php
    $form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
    echo form_open_multipart('user/do_tryout/save', $form_attribute);
?>
<input type="hidden" name="id_jawaban" id="id_jawaban">
<?= form_close(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            bSort: false,
            bLengthChange: false,
            "oLanguage": {
                "sSearch": ""
            }
        })
        ganti_soal(1);
        jumlah_soal();
        
    })

    function save() {

        $('#myform').submit();
        $('#id_jawaban').val('');
    }

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
            var data = new FormData(form);
            $.ajax({
                type: 'POST',
                url: $("#myform").attr('action'),
                data: data,
                contentType: false,
                processData: false,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if(obj[0] == true) {
                        var nomor = '<?php echo $this->session->userdata('nomor_soal') ?>';
                        var id_paket = '<?php echo $this->session->userdata('id_paket') ?>';
                        var total_soal = '<?php echo $this->session->userdata('total_soal') ?>';
                        
                    }
                    
                }
            })
        }
    });
                
    function ganti_soal(id) {
        $.ajax({
            url: "<?= base_url() ?>user/do_tryout/ganti_soal",
            type: "POST",
            data: {
                nomor: id
            },
            success: function (data) {
                $('#content_soal').html(data);
            }
        });
    }

    function jumlah_soal(id) {
        $.ajax({
            url: "<?= base_url() ?>user/do_tryout/jumlah_soal",
            type: "POST",
            data: '',
            success: function (data) {
                $.unblockUI();
                $('#jumlah_soal').html(data);
            }
        });
    }
   
    
</script>