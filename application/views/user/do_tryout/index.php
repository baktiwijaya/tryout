<?php
$user_id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
    </div>
    
    <div class="panel-body">
        <div id="content"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        load();
    })
    function load() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>user/do_tryout/load_table',
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
                $('#content').html(data);
            }
        })
    }
    function add() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>user/beli_tryout/add',
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
                $('#content').html(data);
            }
        })
    }
</script>