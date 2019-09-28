<div class="card">
    <div class="card-body">
        <h1><?php echo $this->lang->line('ddt_loading_unloading_details')?></h1>
        <div class="row py-2">
            <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-4">
            <div class="col-12 py-4">
                <img src="<?php echo base_url($ddt_details['ddt_image_location'])?>">
                <br>
                <span><?php echo $this->lang->line('ddt_id')?>:<?php echo $ddt_details['ref_ddt_id']?></span>
                <br>
                <span><?php echo $this->lang->line('delivery_status')?>:<?php if($ddt_details['ddt_unloading_date_time']=='') echo '<span style="color: red">'.$this->lang->line('pending').'</span>';else echo '<span style="color: green">'.$this->lang->line('delivered').'</span>'?></span>
                <br>
                <span><?php echo $this->lang->line('ddt_from')?>:<b><?php if($ddt_details['ddt_loading_from']==1) echo 'Customer';else echo 'Inventory'?></b></span>
            </div>
            <h4 class="sub-heading"><?php echo $this->lang->line('loaded_details')?></h4>
            <div class="col-12 py-4">
                <div class="row">
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_load_user_name')?>:<b><i><?php echo $ddt_details['loading_user_name']?></i></b></span>
                    </div>
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_load_date')?>:<b><i><?php echo date_format(new DateTime($ddt_details['ddt_loading_date_time']),'d-F-Y')?></i></b></span>
                    </div>
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_load_time')?>:<b><i><?php echo date_format(new DateTime($ddt_details['ddt_loading_date_time']),'h:ia')?></i></b></span>
                    </div>
                </div>

            </div>
            <h4 class="sub-heading"><?php echo $this->lang->line('transfer_details')?></h4>
            <div class="col-12 py-4">
                <div class="row">
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_transfer_user_name')?>:<b><i><?php if($ddt_details['transferring_user_name']=='')echo 'None';else echo $ddt_details['transferring_user_name'];?></i></b></span>
                    </div>
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_transfer_date')?>:<b><i><?php if($ddt_details['transferring_date_time']=='')echo 'None';else echo date_format(new DateTime($ddt_details['transferring_date_time']),'d-F-Y')?></i></b></span>
                    </div>
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_transfer_time')?>:<b><i><?php if($ddt_details['transferring_date_time']=='')echo 'None';else echo date_format(new DateTime($ddt_details['transferring_date_time']),'h:ia')?></i></b></span>
                    </div>
                </div>

            </div>

            <h4 class="sub-heading"><?php echo $this->lang->line('unload_details')?></h4>
            <div class="col-12 py-4">
                <div class="row">
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_unload_user_name')?>:<b><i><?php if($ddt_details['delivery_user_name']=='')echo 'None';else echo $ddt_details['delivery_user_name'];?></i></b></span>
                    </div>
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_unload_date')?>:<b><i><?php if($ddt_details['ddt_unloading_date_time']=='')echo 'None';else echo date_format(new DateTime($ddt_details['ddt_unloading_date_time']),'d-F-Y')?></i></b></span>
                    </div>
                    <div class="col-12">
                        <span><?php echo $this->lang->line('ddt_unload_time')?>:<b><i><?php if($ddt_details['ddt_unloading_date_time']=='')echo 'None';else echo date_format(new DateTime($ddt_details['ddt_unloading_date_time']),'h:ia')?></i></b></span>
                    </div>
                </div>

            </div>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-8">
            <?php if($ddt_details['ddt_loading_from']==1){?>
            <h4 class="sub-heading"><?php echo $this->lang->line('ddt_received_address')?></h4>
                <div class="col-12 py-4">
                    <address id="ddt_received_address">

                    </address>
                </div>

                <div class="col-12" id="ddt_received_from_map" style="height: 500px">

                </div>
                <input type="hidden" id="load_lat" value="<?php echo $ddt_details['ddt_loading_lat']?>">
                <input type="hidden" id="load_long" value="<?php echo $ddt_details['ddt_loading_lng']?>">
            <?php } else if($ddt_details['ddt_loading_from']==0){?>
                <h4 class="sub-heading"><?php echo $this->lang->line('ddt_unload_address')?></h4>
                <?php if($ddt_details['ddt_unloading_date_time']==''){?>
                    <span style="color: red"><?php echo $this->lang->line('ddt_not_unload_yet')?></span>
                    <?php }?>
                <?php if($ddt_details['ddt_unloading_lat']=='' || $ddt_details['ddt_unloading_lng']==''){?>
                    <address>
                        <?php echo $ddt_details['ddt_unloading_address_no_lan_lng']?>
                    </address>
                    <?php } else{?>
                    <div class="col-12 py-4">
                        <address id="ddt_unload_address"></address>
                    </div>

                    <div class="col-12" id="ddt_unload_in_map" style="height: 500px">

                    </div>
                    <input type="hidden" id="lat" value="<?php echo $ddt_details['ddt_unloading_lat']?>">
                    <input type="hidden" id="long" value="<?php echo $ddt_details['ddt_unloading_lng']?>">
                    <?php }?>

            <?php }?>
            </div>
        </div>
    </div>

</div>
