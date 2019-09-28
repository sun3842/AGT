<link rel="stylesheet" type="text/css"
      href="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.css') ?>">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.min.css') ?>"/>

<style type="text/css" rel="stylesheet">
    input[type='text']{
        border-radius: 4px;
    }
</style>
<div class="card">
    <div class="card-body">
        <h1 class="card-title heading"><?php echo $this->lang->line('list_of_delivery_user')?></h1>
        <form id="search_form"></form>
        <div class="row p-3">
            <div class="col-12 m-1" style="text-align: center">
                    <label><?php echo $this->lang->line('select_date')?></label>
            </div>
            <div class="col-12 m-1" style="text-align: center">
                <input type="text" name="activity_date" id="activity_date" value="<?php echo date('Y-m-d')?>" style="text-align: center;">
            </div>
            <div class="col-12 m-1" style="text-align: center">
                <button class="btn btn-info btn-lg" id="search_btn" name="search_btn"><?php echo $this->lang->line('submit')?></button>
            </div>
        </div>
        <table class="table table-striped table-hover" id="delivery_user_list">
            <thead>
            <tr>
                <th>Sl</th>
                <th><?php echo $this->lang->line('user_id')?></th>
                <th<?php echo $this->lang->line('user_name')?></th>
                <th><?php echo $this->lang->line('start_location')?></th>
                <th><?php echo $this->lang->line('end_location')?></th>
                <th><?php echo $this->lang->line('action')?></th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach ($delivery_users AS $delivery_user){ ?>
            <tr>
                <th><?php echo $i;?></th>
                <th><?php echo $delivery_user['delivery_user_id']?></th>
                <th><?php echo $delivery_user['delivery_user_user_name']?></th>
                <th><?php echo $delivery_user['delivery_user_starting_address']?></th>
                <th><?php echo $delivery_user['delivery_user_ending_address']?></th>
                <th><a href="<?php echo base_url('list_of_delivery_details/'.$delivery_user['delivery_user_starting_ending_points_id'])?>" class="btn btn-success"><?php echo $this->lang->line('view_details')?></a></th>
            </tr>
            <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.js') ?>"></script>
<script src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>