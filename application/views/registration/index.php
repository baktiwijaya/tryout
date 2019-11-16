<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tryout Shocca</title>
        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/limitless/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/limitless/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/limitless/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/limitless/css/layout.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/limitless/css/components.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/limitless/css/colors.min.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->
        <!-- Core JS files -->
        <script src="<?= base_url() ?>assets/limitless/global_assets/js/main/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/limitless/global_assets/js/main/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/limitless/global_assets/js/plugins/loaders/blockui.min.js"></script>
        <!-- /core JS files -->
        <!-- Theme JS files -->
        <script src="<?= base_url() ?>assets/limitless/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="<?= base_url() ?>assets/limitless/js/app.js"></script>
        <script src="<?= base_url() ?>assets/limitless/global_assets/js/demo_pages/login.js"></script>
        <!-- /theme JS files -->
    </head>
    <body>


        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content d-flex justify-content-center align-items-center">
                    <!-- Login form -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                               
                                <h5 class="mb-0">Masuk</h5>
                            </div>
                            <?php
                            $form_attributes = array('class' => 'login-form', 'id' => 'myform');
                            $exception = $this->session->userdata('exception');
                            $message = $this->session->userdata('message');
                            $session_id = $this->session->userdata('email');
                            ?>
                            <?= form_open('Authentication/check_user', $form_attributes); ?>
                            <div class="row-fluid">
                                <?php
                                if (isset($exception) && $exception != '') {
                                    echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>' . $exception . '</div>';
                                    $this->session->unset_userdata('exception');
                                }
                                ?>
                                <?php
                                if (isset($message) && $message != '') {
                                    echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>' . $message . '</div>';
                                    $this->session->unset_userdata('message');
                                }
                                ?>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control" placeholder="Alamat email" name="email">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" class="form-control" placeholder="Katasandi" name="password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <div class="form-check mb-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
                                        Ingatkan saya
                                    </label>
                                </div>
                                <a href="login_password_recover.html" class="ml-auto">Lupa katasandi?</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="mysubmit_for_login">MASUK <i class="icon-circle-right2 ml-2"></i></button>
                            </div>
                            <?= form_close(); ?>
                            <div class="form-group text-center text-muted content-divider">
                                <span class="px-2">Tidak Punya Akun ?</span>
                            </div>

                            <div class="form-group">
                                <a href="<?php echo base_url() ?>Authentication/signup" class="btn btn-light btn-block">Daftar</a>
                            </div>
                        </div>
                        
                        
                    </div>
                    

                    <!-- /login form -->
                </div>
                <!-- /content area -->

                <!-- Footer -->
                <div class="navbar navbar-expand-lg navbar-light">
                    <div class="text-center d-lg-none w-100">
                        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                            <i class="icon-unfold mr-2"></i>
                            Footer
                        </button>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text" style="width: 100%;text-align: center;">
                            <a href="<?= base_url() ?>">Alumni Osis Indonesia</a> &copy; <?= date('Y') ?> &mdash; Hak cipta dilindungi oleh undang-undang. :: <i>Halaman dimuat {elapsed_time} detik!</i></a>
                        </span>
                    </div>
                </div>
                <!-- /footer -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </body>
</html>
