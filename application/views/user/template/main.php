<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tryout Shocca</title>

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
