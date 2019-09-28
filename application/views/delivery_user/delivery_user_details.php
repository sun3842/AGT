<div class="card">
    <div class="card-body">
        <h1 class="card-title heading"><?php echo $this->lang->line('delivery_user_account_information') ?></h1>
        <!--        <p class="card-description">-->
        <!--            Basic form elements-->
        <!--        </p>-->
        <h5 class="sub-heading"><?php echo $this->lang->line('user_personal_information') ?></h5>
        <form class="forms-sample" method="post" name="update_admin_info" id="update_admin_info"
              enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-xs-12"><span style="color: red">*</span><?php echo $this->lang->line('user_first_name') ?></label>
                <input type="text" class="form-control" name="first_name" placeholder="<?php echo $this->lang->line('first_name') ?>"
                       value="<?php echo $user_info['delivery_user_first_name'] ?>" readonly>
            </div>
            <div class="form-group">
                <label class="col-xs-12"><span style="color: red">*</span><?php echo $this->lang->line('user_last_name') ?></label>
                <input type="text" class="form-control" name="last_name" placeholder="<?php echo $this->lang->line('last_name') ?>"
                       value="<?php echo $user_info['delivery_user_last_name'] ?>" readonly>
            </div>
            <div class="form-group">
                <label class="col-xs-12"><span style="color: red">*</span> <?php echo $this->lang->line('user_email') ?></label>
                <input type="email" class="form-control" name="user_email" id="user_email" placeholder="<?php echo $this->lang->line('user_email') ?>"
                       value="<?php echo $user_info['delivery_user_email_address'] ?>" required readonly>
            </div>
            <div class="form-group">
                <label class="col-xs-12"><?php echo $this->lang->line('user_phone') ?></label>
                <input type="text" class="form-control" name="user_phone" id="user_phone"
                       placeholder="<?php echo $this->lang->line('user_phone_number') ?>" value="<?php echo $user_info['delivery_user_contact_number'] ?>"
                       readonly>
            </div>
            <div class="form-group">
                <label class="col-xs-12"><?php echo $this->lang->line('user_identity_number') ?></label>
                <input type="text" class="form-control" name="user_identity_number" id="user_identity_number"
                       placeholder="<?php echo $this->lang->line('user_identity_number') ?>" value="<?php echo $user_info['delivery_user_identity_number'] ?>">
            </div>
            <br><br>
            <h5 class="sub-heading"><?php echo $this->lang->line('update_login_information') ?></h5>

            <div class="user_login_info">
                <div class="form-group">
                    <label class="col-xs-12"><span style="color: red">*</span> <?php echo $this->lang->line('user_name') ?></label>
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="<?php echo $this->lang->line('user_name') ?>"
                           value="<?php echo $user_info['delivery_user_user_name'] ?>">
                </div>
                <div class="form-group">
                    <label class="col-xs-12"><?php echo $this->lang->line('user_new_password') ?></label>
                    <input type="password" class="form-control" name="user_new_password" id="user_new_password"
                           placeholder="<?php echo $this->lang->line('password') ?>">
                </div>
                <div class="form-group">
                    <label class="col-xs-12"><?php echo $this->lang->line('re_type_new_password') ?></label>
                    <input type="password" class="form-control" name="user_re_type_password" id="user_re_type_password"
                           placeholder="<?php echo $this->lang->line('password') ?>">
                </div>
                <input type="hidden" name="delivery_user_id" id="delivery_user_id" value="<?php echo $user_info['delivery_user_id']?>">
            </div>
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary mr-2" style="font-size: x-large"><?php echo $this->lang->line('update') ?></button>
                <?php if($user_info['delivery_user_login_active']==1){?>
                    <a  href="<?php echo base_url('de_active_delivery_user/'.$user_info['delivery_user_id'])?>" class="btn btn-warning mr-2" style="font-size: x-large"><?php echo $this->lang->line('de_active') ?></a>
                <?php } else if($user_info['delivery_user_login_active']==0){?>
                    <a  href="<?php echo base_url('active_delivery_user/'.$user_info['delivery_user_id'])?>" class="btn btn-success mr-2" style="font-size: x-large"><?php echo $this->lang->line('active') ?></a>
                <?php }?>
                <a  href="<?php echo base_url('remove_delivery_user/'.$user_info['delivery_user_id'])?>" class="btn btn-danger mr-2 deletebutton" style="font-size: x-large"><?php echo $this->lang->line('remove') ?></a>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo base_url('assets/app_assets/plugins/sweetalert.min.js')?>"></script>