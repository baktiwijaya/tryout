<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
     <?php
        $bu = base_url();
        $bu_img = base_url();
    ?>
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

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#"><img src="../../../../global_assets/images/demo/users/face11.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold"><?= $this->Global_m->getvalue('nama_lengkap','user_info','id',$this->session->userdata('id')) ?></div>
                                <div class="font-size-xs opacity-50">
                                    <i class="icon-pin font-size-sm"></i> &nbsp;<?= $this->Global_m->getvalue('user_type','user_type','id',$this->session->userdata('user_type')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->


                <!-- Main navigation -->
                <div class="card card-sidebar-mobile">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        <!-- Main -->
                        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                        <li class="nav-item">
                            <a href="<?php echo $bu ?>admin/dashboard" class="nav-link">
                                <i class="icon-home4"></i>
                                <span>
                                    Dashboard
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
                                    <li class="nav-item nav-item-submenu <?php if($menu == $value['nama_menu']){echo 'nav-item-expanded nav-item-open';}?>">
                                        <a href="#" class="nav-link">
                                            <i class="<?php echo $value['icon'] ?>"></i>
                                            <span><?php echo $value['nama_menu'] ?></span>
                                        </a>
                                        <ul class="nav nav-group-sub">
                                            <?php foreach ($submenu as $key) : ?>
                                                <li class="nav-item">
                                                    <a href="<?= $bu; ?><?php echo $key['target'] ?>" class="nav-link <?php if($smenu == $key['nama_menu']){echo 'active';}?>">
                                                        <i class="<?php echo $key['icon'] ?>"></i> <span><?php echo $key['nama_menu'] ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a href="<?php echo $bu; ?><?php echo $value['target'] ?>" class="nav-link <?php if($menu == $value['nama_menu']){echo 'active';}?>">
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
