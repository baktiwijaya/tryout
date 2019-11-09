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
                <div id="content_soal" class="table-responsive">
        
                </div>
                
            </div>
        </div>        
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <h6 class="panel-title">Jumlah Soal</h6>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php $no = 1;foreach($list as $key) : ?>
                        <?php if($key['is_done'] == 0) {
                            $color = '';
                        } else if($key['is_done'] == 1) {
                            $color = 'bg-success';
                        } else if($key['is_done'] == 2) {
                            $color = 'bg-warning';
                        } ?>
                        <div class="col-md-3">
                            <div class="panel <?php echo $color ?>">
                                <div class="panel-body">
                                    <a href="#" onclick="ganti_soal('<?php echo $key['nomor'] ?>')">
                                        <?php echo $no; ?> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php $no++;endforeach; ?>
                </div>
                
            </div>
        </div>    
    </div>
</div>

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

        if('<?php $this->session->userdata('nomor_soal')?>' == '') {
            ganti_soal(1);
        } 
        
    })

    function ganti_soal(id) {
        $.ajax({
            url: "<?= base_url() ?>user/do_tryout/ganti_soal",
            type: "POST",
            data: {
                nomor: id
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
                $('#content_soal').html(data);
            }
        });
    }
   
    
</script>