<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- plugins:css -->

    <link rel="stylesheet" href="<?php echo base_url('assets/app_assets/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css');?>">
    <script src="<?php echo base_url('assets/app_assets/plugins/jquery-3.3.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/app_assets/plugins/jquery-validation/jquery.validate.js')?>"></script>
    <script src="<?php echo base_url('assets/app_assets/plugins/jquery-validation/additional-methods.js')?>"></script>
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/app_assets/images/logo.png')?>" />
    <style>
        i{

            padding-top: 2px;
            color: #009646;
        }

        select{
            position: relative;
            float: right;
        }
    </style>
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
        <div class="row">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-full-bg">

                <div class="row w-100">

                    <div class="col-lg-4 mx-auto">
                        <select name="language" role="<?php echo uri_string();?>" about="<?php echo base_url('set_language/')?>" id="language">
                            <option value="LANG_EN" <?php if($this->session->userdata('language')=='LANG_EN')echo 'selected'?>>ENGLISH</option>
                            <option value="LANG_IT" <?php if($this->session->userdata('language')=='LANG_IT')echo 'selected'?>>ITALIAN</option>
                        </select>
                        <div class="auth-form-dark text-left p-5">

                            <img src="<?php echo base_url('assets/app_assets/images/logo.png')?>" alt="logo" width="200px" height="auto" style="display: block;margin-right: auto;margin-left: auto">

                            <?php $this->load->view('flashMessage')?>

                            <form class="pt-5" method="post" id="login_form">
                                <form>
                                    <div class="form-group">
                                        <label for="login_name"><?php echo $this->lang->line('user_name')?></label>
                                        <input type="text" class="form-control" id="login_name" name="login_name" aria-describedby="emailHelp" placeholder="<?php echo $this->lang->line('user_name')?>">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="form-group">
                                        <label for="login_password"><?php echo $this->lang->line('password')?></label>
                                        <input type="password" class="form-control" id="login_password" name="login_password" placeholder="<?php echo $this->lang->line('password')?>">
                                        <i class="fas fa-unlock-alt"></i>
                                    </div>
                                    <div class="mt-5">
                                        <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium"><?php echo $this->lang->line('login')?></button>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <a href="<?php echo base_url('forgot_password')?>" class="auth-link"><?php echo $this->lang->line('forgot_password')?>?</a>
                                    </div>
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->

<!--<script src="--><?php //echo base_url('assets/app_assets/images/favicon.png')?><!--../../node_modules/popper.js/dist/umd/popper.min.js"></script>-->
<script src="<?php echo base_url('assets/app_assets/plugins/bootstrap-4/js/bootstrap.min.js')?>"></script>
<!-- endinject -->
<!-- inject:js -->
<!--<script src="../../js/off-canvas.js"></script>-->
<!--<script src="../../js/misc.js"></script>-->
<!-- endinject -->
</body>

</html>

<script type="text/javascript">
    $('#login_form').validate({
        rules: {
            login_name: {
                required: true
            },
            login_password: {
                required: true
            }
        }
    });
    $('#language').change(function () {
        var val=$(this).val();
        var url=$(this).attr('about');
        var location=$(this).attr('role');
        window.location.href=url+val+'/'+location;
    });
</script>
