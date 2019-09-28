<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url()?>">
                <span class="menu-title "><?php echo $this->lang->line('dashboard');?></span>
<!--                <i class="fas fa-tachometer-alt"></i>-->
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-ddt-list" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title"><?php echo $this->lang->line('ddt');?></span>
                <i class="fas fa-angle-down" style="font-size: medium"></i>
            </a>
            <div class="collapse" id="ui-ddt-list">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin_add_new_ddt')?>"><?php echo $this->lang->line('add_new_ddt');?></a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin_list_ddt')?>"><?php echo $this->lang->line('ddt_list');?></a></li>
                </ul>
            </div>
        </li>
        <?php if($this->session->userdata('user_type_id')==1){?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-user-list" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title"><?php echo $this->lang->line('admin_users');?></span>
                <i class="fas fa-angle-down" style="font-size: medium"></i>
            </a>
            <div class="collapse" id="ui-user-list">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('add_new_admin_user')?>"><?php echo $this->lang->line('add_new_admin_user');?></a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin_user_list')?>"><?php echo $this->lang->line('admin_user_list');?></a></li>
                </ul>
            </div>
        </li>

        <?php }?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-delivery-user-list" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title"><?php echo $this->lang->line('delivery_users');?></span>
                <i class="fas fa-angle-down" style="font-size: medium"></i>
            </a>
            <div class="collapse" id="ui-delivery-user-list">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('add_new_delivery_user')?>"><?php echo $this->lang->line('add_new_delivery_user');?></a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('delivery_user_list')?>"><?php echo $this->lang->line('delivery_user_list');?></a></li>
                </ul>
            </div>
        </li>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="--><?php //echo base_url('delivery_user_activity_list')?><!--">-->
<!--                <span class="menu-title">--><?php //echo $this->lang->line('delivery_user_activity');?><!--</span>-->
<!--<!--                <i class="fab fa-accessible-icon"></i>-->
<!--            </a>-->
<!--        </li>-->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-delivery-user-activity" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title"><?php echo $this->lang->line('delivery_user_activity');?></span>
                <i class="fas fa-angle-down" style="font-size: medium"></i>
            </a>
            <div class="collapse" id="ui-delivery-user-activity">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo  base_url('add_update_user_daily_activity') ?>"><?php echo $this->lang->line('add_update_user_delivery_point');?></a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('list_of_delivery_point')?>"><?php echo $this->lang->line('list_of_delivery_point');?></a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('delivery_user_activity_list');?>"><?php echo $this->lang->line('delivery_user_activity_report');?></a></li>
                </ul>
            </div>
        </li>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" data-toggle="collapse" href="#ui-report" aria-expanded="false" aria-controls="ui-basic">-->
<!--                <span class="menu-title">Report</span>-->
<!--                <i class="fas fa-angle-down" style="font-size: medium"></i>-->
<!--            </a>-->
<!--            <div class="collapse" id="ui-report">-->
<!--                <ul class="nav flex-column sub-menu">-->
<!--                    <li class="nav-item"> <a class="nav-link" href="--><?php //echo base_url('ddt_load_report')?><!--">DDT  loaded Report</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </li>-->

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('ddt_load_unload_report')?>">

                <span class="menu-title"><?php echo $this->lang->line('report');?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin_update_account')?>">

                <span class="menu-title"><?php echo $this->lang->line('account');?></span>
                <!--                <i class="fas fa-qrcode"></i>-->
            </a>
        </li>

    </ul>
</nav>



<!-- partial -->
<div class="content-wrapper">