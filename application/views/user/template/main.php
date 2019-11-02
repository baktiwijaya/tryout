<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tryout Shocca</title>

        <?php $this->load->view('user/template/css') ?>
        <?php $this->load->view('user/template/js') ?>
    </head>
    <body>
        <!-- Main navbar -->
        <?php $this->load->view('user/template/header') ?>
        <!-- /main navbar -->

        <div class="page-content">
            <?php $this->load->view('user/template/sidebar') ?>

            <!-- Main content -->
            <div class="content-wrapper">
                <div class="page-header page-header-light">
                    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                        <div class="d-flex">
                            <div class="breadcrumb">
                                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?= $title; ?></a>
                                <a href="#" class="breadcrumb-item active">Content</a>
                            </div>
                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>  
                    </div>
                </div>
                <div class="content">
                    <?php $this->load->view($content) ?>
                </div>
                <?php $this->load->view('user/template/footer'); ?>
            </div>
    </body>
</html>
