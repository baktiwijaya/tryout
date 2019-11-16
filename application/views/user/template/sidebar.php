<?php $bu = base_url(); ?>

<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li class="nav-item <?php if($menu == 'Dashboard'){echo "active";} ?>"><a href="<?php echo base_url() ?>user/dashboard"><i class="icon-display4 position-left"></i> Dashboard</a></li>
            <?php
                $mutama = $this->Crud_m->all_data('menu', '*', "parent = 0 and role ='" . $this->session->userdata('user_type') . "' and is_aktif = 1", 'order asc');
                foreach ($mutama as $value) : ?>
                    <?php
                    $submenu = $this->Crud_m->all_data('menu', '*', "parent = '" . $value['id_menu'] . "' and role ='" . $this->session->userdata('user_type') . "' and is_aktif = 1", 'order asc');
                    $jum = $this->Crud_m->get('menu', 'count(*) as jumlah', "parent = '" . $value['id_menu'] . "' and role ='" . $this->session->userdata('user_type') . "' and is_aktif = 1", 1, NULL, TRUE);
                    if ($jum->jumlah > 0) {
                        ?>
                        <li class="dropdown <?php if($menu == $value['nama_menu']){echo "dropdown-toggle active";} ?>">
                            <a href="#" class="dropdown-item" data-toggle="dropdown">
                                <i class="icon-basket position-left"></i> <?php echo $value['nama_menu']; ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu width-250">
                                <?php foreach ($submenu as $key) : ?>
                                   <li class="dropdown  <?php if($smenu == $key['nama_menu']){echo "active";} ?>">
                                    <a href="<?php $bu ?><?php echo $key['target'] ?>" class="dropdown-item"><i class="<?php echo $key['icon'] ?>"></i> <?php echo $key['nama_menu']; ?></a>
                                </li>
                                <?php endforeach; ?>
                                
                            </ul>
                        </li>
                    <?php } else { ?>  
                        <li class="nav-item <?php if($menu == $value['nama_menu']){echo "active";} ?>"><a href="<?php $bu ?><?php echo $value['target'] ?>"><i class="<?php echo $value['icon'] ?> position-left"></i> <?php echo $value['nama_menu'] ?></a></li>
                    <?php } ?>  
                <?php endforeach; ?>
        </ul>
    </div>
</div>