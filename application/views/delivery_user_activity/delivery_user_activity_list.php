<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.min.css')?>"/>
<style type="text/css">
    .table th{
        color: #009646;
    }
</style>
<div class="card">
    <div class="card-body">
        <h1 class="card-title heading"><?php echo $this->lang->line('delivery_user_list')?></h1>
        <div class="row my-4">
            <div class="col-12 col-xs-6 col-sm-6 col-md-6 col-lg-6 p-2">
                <div class="row">
                    <div class="col-12">
                        <label style="float: right"><?php echo $this->lang->line('start_date')?>:</label>
                    </div>
                    <div class="col-12">
                        <input class="float-right" type="text" name="start_date" id="start_date" value="<?php $current_date=date("Y-m-d"); echo date_format(new DateTime($current_date),'Y-m-01')?>">
                    </div>
                    <div class="col-12">
                        <label id="start_date_validation" style="display: none" class="float-right"><?php echo $this->lang->line('start_date_is_required')?></label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xs-6 col-sm-6 col-md-6 col-lg-6 p-2" style="border-left: 1px solid green">
                <div class="col-12">
                    <label> <?php echo $this->lang->line('end_date')?>:</label>
                </div>
                <div class="col-12">
                    <input type="text" name="end_date" id="end_date" value="<?php $current_date=date("Y-m-d"); echo date_format(new DateTime($current_date),'Y-m-t')?>">
                </div>

                <div class="col-12">
                    <label id="end_date_validation" style="display: none"><?php echo $this->lang->line('end_date_is_required')?></label>
                </div>

            </div>
            <div class="col-12 p-2" style="text-align: center">
                <button class="btn btn-success" name="report_btn" id="report_btn"><?php echo $this->lang->line('generate_report')?></button>
            </div>
        </div>
        <?php
        $max_loaded=0;
        $max_loaded_name='None';
        $min_loaded=$delivery_users[0]['total_loaded'];
        $min_loaded_name=$delivery_users[0]['delivery_user_user_name'];
        $max_unloaded=0;
        $max_unloaded_name='None';
        $min_unloaded=$delivery_users[0]['total_delivered'];
        $min_unloaded_name=$delivery_users[0]['delivery_user_user_name'];
        foreach ($delivery_users AS $delivery_user){
            if($delivery_user['total_loaded']>$max_loaded){
                $max_loaded=$delivery_user['total_loaded'];
                $max_loaded_name=$delivery_user['delivery_user_user_name'];
            }
            else if($delivery_user['total_loaded']<$min_loaded){
                $min_loaded=$delivery_user['total_loaded'];
                $min_loaded_name=$delivery_user['delivery_user_user_name'];
            }
            if($delivery_user['total_delivered']>$max_unloaded){
                $max_unloaded=$delivery_user['total_delivered'];
                $max_unloaded_name=$delivery_user['delivery_user_user_name'];
            }
            else if($delivery_user['total_delivered']<$min_unloaded){
                $min_unloaded=$delivery_user['total_delivered'];
                $min_unloaded_name=$delivery_user['delivery_user_user_name'];
            }
        }
        ?>
        <div style="text-align: center;">
            <label style="border: 2px solid #2A236F"><strong ><?php echo $this->lang->line('max_ddt_loaded_user')?>:<span id="max_load" style="color: green;padding-right: 5px;padding-left: 5px"><?php echo $max_loaded_name;?> </span></strong> </label>
            <label style="border: 2px solid #2A236F"><strong ><?php echo $this->lang->line('min_ddt_loaded_user')?>:<span id="min_load" style="color: green;padding-right: 5px;padding-left: 5px"> <?php echo $min_loaded_name;?></span></strong> </label>
        </div>
        <div style="text-align: center;">
            <label style="border: 2px solid #2A236F"><strong ><?php echo $this->lang->line('max_ddt_unloaded_user')?>:<span id="max_unload" style="color: green;padding-right: 5px;padding-left: 5px"><?php echo $max_unloaded_name;?> </span></strong> </label>
            <label style="border: 2px solid #2A236F"><strong ><?php echo $this->lang->line('min_ddt_unloaded_user')?>:<span id="min_unload" style="color: green;padding-right: 5px;padding-left: 5px"> <?php echo $min_unloaded_name;?></span></strong> </label>

        </div>
        <table class="table table-striped table-hover" id="delivery_user_activity_list">
            <thead>
            <tr>
                <th>Sl</th>
                <th><?php echo $this->lang->line('user_name')?></th>
                <th><?php echo $this->lang->line('user_email')?></th>
                <th><?php echo $this->lang->line('join_date')?></th>
                <th><?php echo $this->lang->line('total_load')?></th>
                <th><?php echo $this->lang->line('total_transfer')?></th>
                <th><?php echo $this->lang->line('total_unload')?></th>
            </tr>
            </thead>
            <tbody>

            <?php $i=1;foreach ($delivery_users AS $delivery_user){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $delivery_user['delivery_user_user_name']?></td>
                    <td><?php echo $delivery_user['delivery_user_email_address']?></td>
                    <td><?php echo  date_format(new DateTime($delivery_user['delivery_user_creating_date_time']),'d-F-Y');?></td>
                    <td><?php echo $delivery_user['total_loaded'] ?></td>
                    <td><?php echo $delivery_user['total_transfered'] ?></td>
                    <td><?php echo $delivery_user['total_delivered'] ?></td>
                </tr>
                <?php $i++;}?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.js')?>"></script>
<script src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js')?>"></script>
