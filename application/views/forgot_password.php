<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>
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
            width: 100%;
            border-radius: 10px;
        }
        .user_list{
            display: none;
        }
        #language{
            position: relative;
            float: right;
            width: auto;
            border-radius: 0px;
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

                            <form class="pt-5" method="post" id="forgot_form">
                                    <div class="form-group">
                                        <label for="forgot_email"><?php echo $this->lang->line('user_email')?></label>
                                        <input type="text" class="form-control" id="forgot_email" name="forgot_email" aria-describedby="emailHelp" placeholder="<?php echo $this->lang->line('user_email')?>">
                                        <i class="far fa-user"></i>
                                        <label style="color: red;display: none" id="mail_valid_label"><?php echo $this->lang->line('mail_is_not_registered_yet')?></label>
                                    </div>
                                    <div class="form-group user_list">
                                        <label for="forgot_username"> <?php echo $this->lang->line('select_user_name')?> </label></br>
                                        <select id="forgot_username" name="forgot_username" class="form_control">
<!--                                            <option value="">Select</option>-->
                                        </select>
                                    </div>
                                    <div class="mt-5">
                                        <button type="button" id="submit_btn" class="btn btn-block btn-warning btn-lg font-weight-medium" style="word-wrap: break-word;white-space: normal;overflow-wrap:break-word "><?php echo $this->lang->line('recover_password')?></button>
                                    </div>
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

     total_user_number=0;
    $('#forgot_email').keyup(function () {
        var val=$(this).val();
//        alert(val);
        if(val!=''){
            $.ajax({
                url : $('#forgot_form').attr('action'),
                data :{email_address: val},
                type : 'POST',
                success : function (result) {
                    var res=$.parseJSON(result);
                    var size=res.length;
                    total_user_number=size;
                    if(size>1){
                        $('.user_list').css('display','block');
                    }else{
                        $('.user_list').css('display','none');
                    }
                    for(var i=0;i<size;i++){
                        $("#forgot_username").append('<option value="'+res[i]["admin_user_name"]+'">'+res[i]["admin_user_name"]+'</option>');
                    }
                },
                error : function (err) {
                    alert(err);
                }
            });
        }
    });

    $('#submit_btn').click(function () {
//        alert(total_user_number);
        if(total_user_number<=parseInt(0)){
//            alert('Email is not Valid');
            $('#mail_valid_label').css('display','block');
        }else {
            $('#forgot_form').submit();
        }
    });

    $('#forgot_form').validate({
        rules: {
            forgot_email: {
                required: true
            },
            forgot_username: {
                required: true
            }
        },
        messages:{
            forgot_username: "E-mail is not valid",
        }
    });
     $('#language').change(function () {
         var val=$(this).val();
         var url=$(this).attr('about');
         var location=$(this).attr('role');
         window.location.href=url+val+'/'+location;
     });
</script>
