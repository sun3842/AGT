<link rel="stylesheet" type="text/css"
      href="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.css') ?>">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.min.css') ?>"/>

<div class="card">
    <div class="card-body">
        <h1 class="card-title heading"><?php echo $this->lang->line('add_or_update_user_daily_activity')?></h1>
        <form method="post" name="start_update_user_activity">
            <div class="row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding: 0px">
                    <div class="col-12">
                        <label><?php echo $this->lang->line('select_date')?></label>
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" name="activity_date" id="activity_date"
                               value="<?php $current_date = date('Y-m-d');
                               echo $current_date; ?>">
                    </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="col-12">
                        <label><?php echo $this->lang->line('select_delivery_user')?></label>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <select id="activity_user_name" name="activity_user_name" class="form-control" style="border: 1px solid green">
                            <option value=""><?php echo $this->lang->line('select')?></option>
                            <?php foreach ($delivery_users AS $delivery_user){?>
                                <option value="<?php echo $delivery_user['delivery_user_id']?>"><?php echo $delivery_user['delivery_user_user_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-12 pt-4">
                    <label><?php echo $this->lang->line('start_location')?></label>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" placeholder="<?php echo $this->lang->line('start_location')?>" class="form-control" name="activity_start" id="activity_start"
                           value="">
                </div>


                <input type="hidden" id="start_activity_lat" name="start_activity_lat" >
                <input type="hidden" id="start_activity_lng" name="start_activity_lng" >

                <div class="col-12 pt-4">
                    <label><?php echo $this->lang->line('end_location')?></label>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="text" placeholder="<?php echo $this->lang->line('end_location')?>" class="form-control" name="activity_end" id="activity_end"
                           value="">
                </div>
                <input type="hidden" id="end_activity_lat" name="end_activity_lat">
                <input type="hidden" id="end_activity_lng" name="end_activity_lng">
                <div class="col-12" style="text-align: center">
                    <button type="submit" class="btn btn-success btn-lg m-3" style="font-size: large" name="add_activity" id="add_activity" value="add"><?php echo $this->lang->line('add')?></button><button type="submit" class="btn btn-warning btn-lg m-3" style="font-size: large;display: none" id="update_activity" name="update_activity" value="update"><?php echo $this->lang->line('update')?></button>
                </div>
            </div>
        </form>
        <input type="hidden" value="<?php echo  date('Y-m-d');?>" id="current_date">
    </div>
</div>

<script src="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.js') ?>"></script>
<script src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQnX6r_vbBWoTX-Cx8OuqIRtjsfR4l26g&libraries=places"></script>