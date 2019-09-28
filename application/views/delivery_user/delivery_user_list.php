<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.css')?>">
<style type="text/css">
    .table th{
        color: #009646;
    }
</style>

<div class="card">
    <div class="card-body">
        <h1 class="card-title heading"><?php echo $this->lang->line('delivery_user_list')?></h1>
        <table class="table table-striped table-hover" id="admin_user_list">
            <thead>
            <tr>
                <th>Sl</th>
                <th><?php echo $this->lang->line('user_name')?></th>
                <th><?php echo $this->lang->line('user_email')?></th>
                <th><?php echo $this->lang->line('user_status')?></th>
                <th><?php echo $this->lang->line('user_add_date')?></th>
                <th><?php echo $this->lang->line('action')?></th>
            </tr>
            </thead>
            <tbody>

            <?php $i=1;foreach ($delivery_users AS $delivery_user){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $delivery_user['delivery_user_user_name']?></td>
                    <td><?php echo $delivery_user['delivery_user_email_address']?></td>
                    <td><?php if($delivery_user['delivery_user_login_active']==1)echo '<span style="color: green">'.$this->lang->line('active').'</span>';else if($delivery_user['delivery_user_login_active']==0) echo '<span style="color: red">'.$this->lang->line('de_active').'</span>';?></td>
                    <td><?php echo date_format(new DateTime($delivery_user['delivery_user_creating_date_time']),'d-F-Y h:ia')?></td>
                    <td><a href="<?php echo base_url('delivery_user_details/'.$delivery_user['delivery_user_id'])?>" class="btn btn-info"><?php echo $this->lang->line('view')?></a></td>
                </tr>
                <?php $i++;}?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.js')?>"></script>