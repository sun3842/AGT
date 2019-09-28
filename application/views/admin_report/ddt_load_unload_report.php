<link rel="stylesheet" type="text/css"
      href="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.css') ?>">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.min.css') ?>"/>

<style type="text/css">
    .table th {
        color: #009646;
    }
    .strt_date>label{
        float: right;
    }
</style>
<div class="card">
    <div class="card-body">
        <h2 class="heading"><?php echo $this->lang->line('ddt_report') ?></h2>
        <form method="post" id="date_selector" action="<?php echo base_url('print_report')?>">
            <div class="row my-4">

                <div class="col-12 col-xs-6 col-sm-6 col-md-6 col-lg-6 p-2">
                    <div class="row">
                        <div class="col-12">
                            <label style="float: right"><?php echo $this->lang->line('start_date') ?>:</label>
                        </div>
                        <div class="col-12 strt_date">
                            <input class="float-right" type="text" name="start_date" id="start_date"
                                   value="<?php $current_date = date("Y-m-d");
                                   echo date_format(new DateTime($current_date), 'Y-m-01') ?>">
                        </div>
                        <div class="col-12">
                            <label id="start_date_validation" style="display: none"
                                   class="float-right"><?php echo $this->lang->line('start_date_is_required') ?></label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xs-6 col-sm-6 col-md-6 col-lg-6 p-2" style="border-left: 1px solid green">
                    <div class="col-12">
                        <label><?php echo $this->lang->line('end_date') ?>:</label>
                    </div>
                    <div class="col-12">
                        <input type="text" name="end_date" id="end_date" value="<?php $current_date = date("Y-m-d");
                        echo date_format(new DateTime($current_date), 'Y-m-t') ?>">
                    </div>

                    <div class="col-12">
                        <label id="end_date_validation"
                               style="display: none"><?php echo $this->lang->line('end_date_is_required') ?></label>
                    </div>

                </div>
                <div class="col-12 p-2" style="text-align: center">
                    <button type="button" class="btn btn-success" name="report_btn"
                            id="report_btn"><?php echo $this->lang->line('generate_report') ?></button>
                </div>
                <div class="col-12 p-2" style="text-align: center">
                    <button type="submit" class="btn btn-info" name="print_btn" id="print_btn" value="print">Create PDF</button>
                </div>
            </div>
        </form>
        <?php
        $temp = 0;
        $temp_form_inventory = 0;
        $temp_form_customer = 0;
        foreach ($load_ddts AS $load_ddt) {
            if ($load_ddt['ddt_unloading_date_time'] == "") {
                $temp = $temp + 1;
            }
            if ($load_ddt['ddt_loading_from'] == 0) {
                $temp_form_inventory = $temp_form_inventory + 1;
            } else if ($load_ddt['ddt_loading_from'] == 1) {
                $temp_form_customer = $temp_form_customer + 1;
            }
        }
        ?>

        <div style="text-align: center;">
            <label style="border: 2px solid #2A236F"><strong><?php echo $this->lang->line('total_loaded_ddt') ?>:<span
                            id="total_ddt"
                            style="color: green;padding-right: 5px;padding-left: 5px"> <?php echo sizeof($load_ddts) . " " ?></span></strong>
            </label>
            <label style="border: 2px solid #2A236F"><strong><?php echo $this->lang->line('total_pending_ddt') ?>:<span
                            id="pending_ddt"
                            style="color: red;padding-right: 5px;padding-left: 5px"> <?php echo $temp . " " ?></span></strong>
            </label>
        </div>
        <div style="text-align: center;">
            <label style="border: 2px solid #2A236F"><strong><?php echo $this->lang->line('total_from_storage') ?>:<span
                            id="load_from_inventory_ddt"
                            style="padding-right: 5px;padding-left: 5px"> <?php echo $temp_form_inventory . " " ?></span></strong>
            </label>
            <label style="border: 2px solid #2A236F"><strong><?php echo $this->lang->line('total_from_customer') ?>
                    :<span id="load_from_customer_ddt"
                           style="padding-right: 5px;padding-left: 5px"> <?php echo $temp_form_customer . " " ?></span></strong>
            </label>
        </div>
        <table class="table table-striped table-hover" id="loaded_ddt_list">
            <thead>
            <tr>
                <th><?php echo $this->lang->line('ddt_id') ?></th>
                <th><?php echo $this->lang->line('loaded_date') ?></th>
                <th><?php echo $this->lang->line('loaded_time') ?></th>
                <th><?php echo $this->lang->line('loaded_user_name') ?></th>
                <th><?php echo $this->lang->line('delivery_user_name') ?></th>
                <th><?php echo $this->lang->line('ddt_from') ?></th>
                <th><?php echo $this->lang->line('ddt_status') ?></th>
                <th><?php echo $this->lang->line('action') ?></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($load_ddts AS $load_ddt) { ?>
                <tr>
                    <td><?php echo $load_ddt['ref_ddt_id'] ?></td>
                    <td><?php echo date_format(new DateTime($load_ddt['ddt_loading_date_time']), 'd-F-Y') ?></td>
                    <td><?php echo date_format(new DateTime($load_ddt['ddt_loading_date_time']), 'h:ia') ?></td>
                    <td><?php echo $load_ddt['loading_user_name'] ?></td>
                    <td><?php echo $load_ddt['delivery_user_name'] ?></td>
                    <td><?php if ($load_ddt['ddt_loading_from'] == 0) echo $this->lang->line('storage'); else if ($load_ddt['ddt_loading_from'] == 1) echo $this->lang->line('customer'); ?></td>
                    <td><?php if ($load_ddt['ddt_unloading_date_time'] == "") echo '<b><span style="color: red">' . $this->lang->line('pending') . '</span></b>'; else echo '<span style="color: green">' . $this->lang->line('delivered') . '</span>'; ?></td>
                    <td>
                        <a href="<?php echo base_url('single_ddt_loading_unloading_details/' . $load_ddt['ref_ddt_id']) ?>"
                           class="btn btn-info"><?php echo $this->lang->line('view_details') ?></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.js') ?>"></script>
<script src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>




