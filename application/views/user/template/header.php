  
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
                    <img src="<?= base_url() ?>/uploads/images/viraloe-logo1.png" alt="">
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
            </ul>
            <span class="badge badge-pill ml-md-3 mr-md-auto"> </span>
            <ul class="navbar-nav">

                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url() ?>assets/limitless/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
                        <?php $id = $this->session->userdata('id'); ?>
                        <span><?php echo $this->Global_m->getvalue('nama_lengkap','user_info','id',$id); ?></span>
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
