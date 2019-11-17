<?php
$user_id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
?>
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= $title ?></h6>
        <div class="header-elements">
             <div class="list-icons">
                <button type="button" class="btn btn-outline-primary mr-2" onclick="add_soal()"><b><i class="icon-plus-circle2"></i></b> Tambah</button>
                <button type="button" class="btn btn-outline-primary mr-2" onclick="load_soal()"><a><i class="icon-rotate-cw2"></i></a> Reload </button>
            </div>

        </div>
    </div>
    <div class="card-body">
        <div id="content_soal"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        load_soal();
    })
    function load_soal() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>admin/paket/load_soal',
            data: {
                id: '<?php echo $this->session->userdata('id_soal') ?>'
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
        })
    }
    function add_soal(id) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>admin/paket/add_soal',
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
        })
    }
</script>