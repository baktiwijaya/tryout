<?php
$user_id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
    </div>
    
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="d-md-flex">
                    <ul class="nav nav-tabs nav-tabs-bottom border-bottom-0 nav-justified">
                        <li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link active" data-toggle="tab" id="tab1" onclick="get_koin();">Pembelian Koin</a></li>
                        <li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab" id="tab2" onclick="get_poin();">Pendapatan Poin</a></li>
                        <li class="nav-item"><a href="#highlighted-justified-tab3" class="nav-link" data-toggle="tab" id="tab3" onclick="get_tryout();">Pembelian Tryout</a></li>
                    </ul>
                </div>
                <div id="content"></div>
            </div>
            <div class="col-md-2 pull-right">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Jumlah Koin & Poin<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    </div>
                    <div class="panel-body">
                        <?php $jumlah_koin = $this->Global_m->getvalue('total_koin','transaksi_koinpoin','id_user',$id); ?>
                        Jumlah Koin : <?php echo ($jumlah_koin == '') ? 0 : number_format($jumlah_koin) ?>
                        <br>
                        <?php $jumlah_poin = $this->Global_m->getvalue('total_poin','transaksi_koinpoin','id_user',$id); ?>
                        Jumlah Poin : <?php echo ($jumlah_poin == '') ? 0 : number_format($jumlah_poin) ?>
                    </div>
                </div>
            </div>    
        </div>
        
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tab1').trigger('click');
    })
    
    function get_koin() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>user/trans_history/get_koin',
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

    function get_poin() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>user/trans_history/get_poin',
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

    function get_tryout() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>user/trans_history/get_tryout',
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