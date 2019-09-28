<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/app_assets/images/logo.png')?>" alt="logo"></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/app_assets/images/logo.png')?>" alt="logo"></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav ml-lg-auto">
<!--            <li class="nav-item">-->
<!--                <form class="mt-2 mt-md-0 d-none d-lg-block search-input">-->
<!--                    <div class="input-group">-->
<!--                        <span class="input-group-addon d-flex align-items-center"><i class="icon-magnifier icons"></i></span>-->
<!--                        <input type="text" class="form-control" placeholder="Search...">-->
<!--                    </div>-->
<!--                </form>-->
<!--            </li>-->
            <li class="nav-item">
                <select name="language" role="<?php echo uri_string();?>" about="<?php echo base_url('set_language/')?>" id="language">
                    <option value="LANG_EN" <?php if($this->session->userdata('language')=='LANG_EN')echo 'selected'?>>ENGLISH</option>
                    <option value="LANG_IT" <?php if($this->session->userdata('language')=='LANG_IT')echo 'selected'?>>ITALIAN</option>
                </select>
            </li>
<!--            <li class="nav-item dropdown notification-dropdown">-->
<!--                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">-->
<!--                    <i class="icon-speech icons"></i>-->
<!--                    <span class="count"></span>-->
<!--                </a>-->
<!--                <div class="dropdown-menu navbar-dropdown preview-list notification-drop-down dropdownAnimation" aria-labelledby="notificationDropdown">-->
<!--                    <a class="dropdown-item preview-item">-->
<!--                        <div class="preview-thumbnail">-->
<!--                            <div class="preview-icon">-->
<!--                                <i class="icon-info mx-0"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="preview-item-content">-->
<!--                            <p class="preview-subject font-weight-medium">Application Error</p>-->
<!--                            <p class="font-weight-light small-text">-->
<!--                                Just now-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a class="dropdown-item preview-item">-->
<!--                        <div class="preview-thumbnail">-->
<!--                            <div class="preview-icon">-->
<!--                                <i class="icon-speech mx-0"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="preview-item-content">-->
<!--                            <p class="preview-subject">Settings</p>-->
<!--                            <p class="font-weight-light small-text">-->
<!--                                Private message-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a class="dropdown-item preview-item">-->
<!--                        <div class="preview-thumbnail">-->
<!--                            <div class="preview-icon">-->
<!--                                <i class="icon-envelope mx-0"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="preview-item-content">-->
<!--                            <p class="preview-subject">New user registration</p>-->
<!--                            <p class="font-weight-light small-text">-->
<!--                                2 days ago-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </li>-->
<!--            <li class="nav-item lang-dropdown d-none d-sm-block" style="margin-right: 6px">-->
<!--                <select>-->
<!--                    <option>English</option>-->
<!--                    <option>Italian</option>-->
<!--                </select>-->
<!--            </li>-->
            <li class="nav-item">
                <a class="nav-link profile-image" href="<?php echo base_url('logout')?>">
                    <strong><?php echo $this->lang->line('logout');?></strong>
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ml-auto" type="button" data-toggle="offcanvas">
            <span class="icon-menu icons"><i class="fas fa-align-justify"></i></span>
        </button>
    </div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <div class="row row-offcanvas row-offcanvas-right">