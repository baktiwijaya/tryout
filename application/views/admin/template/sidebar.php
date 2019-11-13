<div class="sidebar sidebar-light sidebar-expand-md">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">
        <?php
        $results = $this->db->select('*')->from("settings")->where('id', 14)->get()->row();
        $website_logo = json_decode($results->details);
        ?>
        <?php $bu = base_url(); ?>
        <?php $bu_img = base_url(); ?>
        <?php $slug1 = $this->uri->segment(1); ?>
        <?php $slug = $this->uri->segment(2); ?>
        <?php $slug3 = $this->uri->segment(3); ?>
        <?php $selected = 'active'; ?>
        <!-- Main navigation -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <!-- <div class="mr-3">
                        <a href="#"><img src="../../../../global_assets/images/demo/users/face11.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div> -->

                    <div class="media-body">
                        <div class="media-title font-weight-semibold"><?= $this->session->userdata('name') ?></div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user"></i> &nbsp;
                            <?= $this->Global_m->getvalue('user_type','user_type','id',$this->session->userdata('user_type')) ?>
                            &nbsp;
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">UTAMA</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin/dashboard" class="nav-link active">
                        <i class="icon-home4"></i>
                        <span>
                            Beranda
                        </span>
                    </a>
                </li>
                <?php
                $mutama = $this->Crud_m->all_data('menu', '*', "parent = 0 and role ='" . $this->session->userdata('user_type') . "' and is_aktif = 1", 'order asc');
                foreach ($mutama as $value) :
                    ?>
                    <?php
                    $submenu = $this->Crud_m->all_data('menu', '*', "parent = '" . $value['id_menu'] . "' and role ='" . $this->session->userdata('user_type') . "' and is_aktif = 1", 'order asc');
                    $jum = $this->Crud_m->get('menu', 'count(*) as jumlah', "parent = '" . $value['id_menu'] . "' and role ='" . $this->session->userdata('user_type') . "' and is_aktif = 1", 1, NULL, TRUE);
                    if ($jum->jumlah > 0) {
                        ?>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link">
                                <i class="<?php echo $value['icon'] ?>"></i>
                                <span><?php echo $value['nama_menu'] ?></span>
                            </a>
                            <ul class="nav nav-group-sub">
                                <?php foreach ($submenu as $key) : ?>
                                    <li class="nav-item">
                                        <a href="<?= $bu; ?><?php echo $key['target'] ?>" class="nav-link">
                                            <i class="<?php echo $key['icon'] ?>"></i> <span><?php echo $key['nama_menu'] ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>    
                        </li>
                    <?php } else { ?>  
                        <li class="nav-item">
                            <a href="<?php echo $bu; ?><?php echo $value['target'] ?>" class="nav-link">
                                <i class="<?php echo $value['icon'] ?>"></i>
                                <span><?php echo $value['nama_menu'] ?></span>
                            </a>
                        </li>
                    <?php } ?>  
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->
</div>