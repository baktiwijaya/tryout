<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Soal</h6>
            </div>
            <div class="card-body">
                <div id="content_soal" class="table-responsive">
        
                </div>
                
            </div>
        </div>        
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Jumlah Soal</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php $no = 1;foreach($list as $key) : ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <a href="#" onclick="ganti_soal('<?php echo $key['id_soal'] ?>')">
                                            <?php echo $no; ?> 
                                        </a>
                                    </center>
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


    })
   
    function ganti_soal(id) {
        $.ajax({
            url: "<?= base_url() ?>user/do_tryout/ganti_soal",
            type: "POST",
            data: {
                id_soal: id
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