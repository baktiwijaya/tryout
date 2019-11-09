<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <?php $this->load->view('user/template/css'); ?>

    <?php $this->load->view('user/template/js'); ?>
    <!-- /theme JS files -->

</head>

<body>

    <!-- Main navbar -->
    <?php $this->load->view('user/template/header'); ?>
    <!-- /main navbar -->


    <!-- Second navbar -->
   <?php $this->load->view('user/template/sidebar'); ?>
    <!-- /second navbar -->


    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <i class="icon-arrow-left52 position-left"></i>
                    <span class="text-semibold">Home</span> - Dashboard
                    <small class="display-block">Good morning, Victoria Baker!</small>
                </h4>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
                <div class="content">
                    <?php $this->load->view($content);?>
                </div>
            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->


    <!-- Footer -->
    <?php $this->load->view('user/template/footer'); ?>
    <!-- /footer -->

</body>
</html>
