<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="<?= base_url() ?>assets/image/logo/aoishocca.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

        <ul class="nav navbar-nav navbar-right">
           
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo base_url() ?>assets/user/images/placeholder.jpg" alt="">
                    <span><?php echo $this->Global_m->getvalue('nama_lengkap','user_info','id',$this->session->userdata('id')); ?></span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?php echo base_url() ?>user/user_profile"><i class="icon-user-plus"></i> My profile</a></li>
                    <li><a href="<?php echo base_url() ?>user/trans_history"><i class="icon-coins"></i> My balance</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url()?>authentication/keluar"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>