<?php
$user_id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
?>
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= $title ?></h6>
        <div class="header-elements">
            <div class="list-icons">
                <a href="#" class="btn btn-success btn-sm" onclick="add()" title="Tambah">Tambah</a>
                <a href="#" class="btn btn-primary btn-sm" onclick="load()" title="Reload">Reload</a></a>
            </div>
        </div>
    </div>
    <div class="card-body">
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
            url: '<?= base_url() ?>admin/kuantitatif/load_table',
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
            url: '<?= base_url() ?>admin/kuantitatif/add',
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