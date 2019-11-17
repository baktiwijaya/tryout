<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
       
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

        <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <?php 
                        $query = $this->db->query('SELECT COUNT(*) AS TOTAL FROM transaksi_coin WHERE status = 1')->row();
                        $query1 = $this->db->query('SELECT COUNT(*) AS TOTAL FROM transaksi_poin WHERE status = 1')->row();
                        $total_koin = $query->TOTAL;
                        $total_poin = $query1->TOTAL;
                        $total = ($total_poin + $total_koin);
                    ?>
                    <?php if($total == 0) {
                        $icon = 'icon-bell2';
                    } else{
                        $icon = 'icon-bell3';
                    }?>
                    <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false">
                        <i class="<?php echo $icon ?>"></i>
                        <span class="d-md-none ml-2">Notifikasi</span>
                        <?php if($total != 0) { ?>
                            <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"><?php echo $total?></span>
                        <?php } ?>

                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                        <div class="dropdown-content-header">
                            <span class="font-weight-semibold">Notifikasi</span>
                        </div>
                        
                        <div class="dropdown-content-body">
                            <ul class="media-list">
                                <?php if($total_koin != 0) { ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="media-title">
                                                <a href="<?php echo base_url() ?>admin/transaksicoin">
                                                    <span class="font-weight-semibold">Koin</span>
                                                </a>
                                            </div>
                                            <span class="text-muted">Anda Memiliki <?php echo $total_koin ?> Transaksi Koin untuk diverifikasi !</span>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if($total_poin != 0) { ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="media-title">
                                                <a href="<?php echo base_url() ?>admin/transaksipoin">
                                                    <span class="font-weight-semibold">Poin</span>
                                                </a>
                                            </div>
                                            <span class="text-muted">Anda Memiliki <?php echo $total_poin ?> Transaksi Poin untuk diverifikasi !</span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url() ?>uploads/foto_admin/<?php echo $this->Global_m->getvalue('photo','user_info','id',$this->session->userdata('id'));?>" class="rounded-circle mr-2" height="34" alt="">
                        <span><?php echo $this->Global_m->getvalue('nama_lengkap','user_info','id',$this->session->userdata('id'));?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?php echo base_url()?>admin/admin_profile" class="dropdown-item"><i class="icon-user-plus"></i> Profil Saya</a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url() ?>authentication/keluar" class="dropdown-item"><i class="icon-switch2"></i> Keluar</a>
                    </div>
                </li>
            </ul>
    </div>
</div>