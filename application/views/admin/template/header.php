  
<body>
    <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-light">
        <!-- Header with logos -->
        <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
            <div class="navbar-brand navbar-brand-md">
                <a href="<?= base_url() . 'admin/Dashboard' ?>" class="d-inline-block">
                    <img class="td-retina-data img-responsive" src="<?= base_url() ?>assets/image/logo/aoishocca.png" alt="" style="margin-left: 20px; width: 40px; height: 30px;">
                </a>
                AOI DASHBOARD
            </div>
            <div class="navbar-brand navbar-brand-xs">
                <a href="<?= base_url() . 'admin/Dashboard' ?>" class="d-inline-block">
                    <img src="<?= base_url() ?>assets/image/logo/aoishocca.png" alt="" style="width: 49px;">
                </a>
                AOI DASHBOARD
            </div>
        </div>
        <!-- /header with logos -->

        <!-- Mobile controls -->
        <div class="d-flex flex-1 d-md-none">
            <div class="navbar-brand mr-auto">
                <a href="<?= base_url() . 'admin/Dashboard' ?>" class="d-inline-block">
                    <!-- <img src="<?= base_url() ?>/uploads/images/viraloe-logo1.png" alt=""> -->
                </a>
            </div>  
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>
        <!-- /mobile controls -->

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                        <?php 
                            $query = $this->db->query('SELECT COUNT(*) AS TOTAL FROM transaksi_coin WHERE status = 1')->row();
                            $query1 = $this->db->query('SELECT COUNT(*) AS TOTAL FROM transaksi_poin WHERE status = 1')->row();
                            $total_koin = $query->TOTAL;
                            $total_poin = $query1->TOTAL;
                            $total = ($total_poin + $total_koin);
                        ?>
                        <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                            <i class="icon-git-compare"></i>
                            <span class="d-md-none ml-2">Notifikasi</span>
                            <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"><?php echo ($total != 0) ? $total : ''; ?></span>
                        </a>
                        <?php if($total != 0) { ?>
                            <div class="dropdown-menu dropdown-content wmin-md-350">
                                <div class="dropdown-content-header">
                                <span class="font-weight-semibold">Notifikasi</span>
                                <a href="#" class="text-default"><i class="icon-sync"></i></a>
                                </div>

                                <div class="dropdown-content-body dropdown-scrollable">
                                    <ul class="media-list">
                                        <?php if($total_koin != 0) { ?>
                                            <li class="media">
                                                <div class="mr-3">
                                                    <a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon"><i class="icon-git-pull-request"></i></a>
                                                </div>

                                                <div class="media-body">
                                                    Anda Memiliki <?php echo $total_koin ?> <a href="<?php echo base_url() ?>admin/transaksicoin">Transaksi Koin</a> belum terverifikasi
                                                </div>
                                            </li>
                                        <?php } ?>

                                        <?php if($total_poin != 0) { ?>
                                            <li class="media">
                                                <div class="mr-3">
                                                    <a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon"><i class="icon-git-pull-request"></i></a>
                                                </div>

                                                <div class="media-body">
                                                    Anda Memiliki <?php echo $total_poin ?> <a href="<?php echo base_url() ?>admin/transaksipoin">Transaksi Poin</a> belum terverifikasi
                                                </div>
                                            </li>
                                        <?php } ?>
                                        

                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        
                    </li>
            </ul>
            <span class="badge badge-pill ml-md-3 mr-md-auto"> </span>
            <ul class="navbar-nav">

                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url() ?>assets/limitless/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
                        <span><?= $this->session->userdata('name') ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?= base_url() ?>profil" class="dropdown-item"><i class="icon-user-plus"></i> Profil Saya</a>
                        <!--<a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>-->
                        <!--<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-indigo-400 ml-auto">58</span></a>-->
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url() ?>pengaturan" class="dropdown-item"><i class="icon-cog5"></i> Pengaturan</a>
                        <a href="<?= base_url() ?>authentication/keluar" class="dropdown-item"><i class="icon-switch2"></i> Keluar</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /navbar content -->
    </div>
    <!-- /main navbar -->
