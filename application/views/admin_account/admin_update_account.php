<div class="card">
    <div class="card-body">
        <h1 class="card-title heading"><?php echo $this->lang->line('update_account_information');?></h1>
        <!--        <p class="card-description">-->
        <!--            Basic form elements-->
        <!--        </p>-->
        <h5 class="sub-heading"><?php echo $this->lang->line('update_personal_information');?></h5>
        <form class="forms-sample" method="post" name="update_admin_info" id="update_admin_info" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-xs-12"><?php echo $this->lang->line('user_first_name');?></label>
                <input type="text" class="form-control" name="first_name" placeholder="<?php echo $this->lang->line('first_name');?>" value="<?php echo $user_info['admin_user_first_name']?>">
            </div>
            <div class="form-group">
                <label class="col-xs-12"><?php echo $this->lang->line('user_last_name');?></label>
                <input type="text" class="form-control" name="last_name" placeholder="<?php echo $this->lang->line('last_name');?>" value="<?php echo $user_info['admin_user_last_name']?>">
            </div>
            <div class="form-group">
                <label class="col-xs-12"><span style="color: red">*</span> <?php echo $this->lang->line('user_email');?></label>
                <input type="email" class="form-control" name="user_email" id="user_email" placeholder="<?php echo $this->lang->line('user_email');?>" value="<?php echo $user_info['admin_user_email_address']?>" required>
            </div>
            <div class="form-group">
                <label class="col-xs-12"><?php echo $this->lang->line('user_phone');?></label>
                <input type="text" class="form-control" name="user_phone" id="user_phone"
                       placeholder="<?php echo $this->lang->line('user_phone_number');?>" value="<?php echo $user_info['admin_user_contact_number']?>">
            </div>
<!--            <div class="form-group">-->
<!--                <label class="col-xs-12">User Image</label>-->
<!--                <div>-->
<!--                    <img src="http://www.placehold.it/200x200&text=no+img" width="200px" height="200px"-->
<!--                         class="col-xs-12" id="user_img_preview">-->
<!--                </div>-->
<!--                <input type="file" name="user_img" id="user_img" class="file-upload-default">-->
<!--                <div class="input-group col-xs-12">-->
<!--                    <input type="text" class="form-control file-upload-info" disabled="" id="img_name" name="img_name"-->
<!--                           placeholder="Upload Image">-->
<!--                    <span class="input-group-append">-->
<!--                          <button class="file-upload-browse btn btn-info" type="button">Upload</button>-->
<!--                        </span>-->
<!--                </div>-->
<!--            </div>-->
            <br><br>
            <h5 class="sub-heading"><?php echo $this->lang->line('update_login_information');?></h5>

            <div class="user_login_info">
                <div class="form-group">
                    <label class="col-xs-12"><span style="color: red">*</span> <?php echo $this->lang->line('user_name');?></label>
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="<?php echo $this->lang->line('user_name');?>" value="<?php echo $user_info['admin_user_name']?>">
                </div>
                <div class="form-group">
                    <label class="col-xs-12"><span style="color: red">*</span> <?php echo $this->lang->line('user_current_password');?></label>
                    <input type="password" class="form-control" name="user_current_password" id="user_current_password"
                           placeholder="*****************">
                </div>
                <div class="form-group">
                    <label class="col-xs-12"><span style="color: red">*</span> <?php echo $this->lang->line('user_new_password');?></label>
                    <input type="password" class="form-control" name="user_new_password" id="user_new_password"
                           placeholder="<?php echo $this->lang->line('password');?>">
                </div>
                <div class="form-group">
                    <label class="col-xs-12"><span style="color: red">*</span> <?php echo $this->lang->line('re_type_new_password');?></label>
                    <input type="password" class="form-control" name="user_re_type_password" id="user_re_type_password"
                           placeholder="<?php echo $this->lang->line('password');?>">
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block mr-2" style="font-size: x-large"><?php echo $this->lang->line('update');?></button>
<!--            <input type="submit" class="btn btn-success btn-block mr-2" style="font-size: x-large" value="Update">-->
            <!--            <button class="btn btn-light">Cancel</button>-->
        </form>
    </div>
</div>