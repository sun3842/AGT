<style>
    p{
        margin-bottom: 2%;
    }
</style>
<div class="card">
    <div class="card-body">
        <h1 class="card-title heading"><?php echo $this->lang->line('ddt_details')?></h1>
        <h5 class="sub-heading"><?php echo $this->lang->line('ddt_info')?></h5>

        <p><img src="<?php echo base_url($ddt_info['ddt_qr_code_image_location'])?>" height="128px" width="128px"></p>
        <span><?php echo $this->lang->line('ddt_id')?>:<?php echo $ddt_info['ddt_id']; ?></span>
        <br>
        <?php if($ddt_info['ref_ddt_id']!=''){ ?>
            <span><?php echo $this->lang->line('delivery_status')?>:<?php if($ddt_info['ddt_unloading_date_time']=='') echo '<span style="color: red">'.$this->lang->line('pending').'</span>';else echo '<span style="color: green">'.$this->lang->line('delivered').'</span>'?></span>
            <br>
            <span><?php echo $this->lang->line('ddt_from')?>:<b><?php if($ddt_info['ddt_loading_from']==1) echo 'Customer';else echo 'Inventory'?></b></span>
        <?php } ?>

        <p style="color: #009646;font-size: medium" class="mt-4"><?php echo $this->lang->line('ddt_created_by')?></p>
        <p ><strong><?php echo $ddt_info['c_admin_user']?></strong><br><?php echo date_format(new DateTime($ddt_info['ddt_created_date_time']),'Y-F-d h:ia');?></p>
<!--        <p style="color: #009646;font-size: medium">DDT Edited By</p>-->
<!--        <p><strong>--><?php //echo $ddt_info['e_admin_user']?><!--</strong><br>--><?php //echo date_format(new DateTime($ddt_info['ddt_edited_date_time']),'Y-F-d h:ia');?><!--</p>-->
<!--        <p style="color: #009646;font-size: medium">DDT Delivery User</p>-->
<!--        <form method="post">-->
<!--            <select class="form-control" name="delivery_user" id="delivery_user">-->
<!--                <option value="">Select</option>-->
<!--                --><?php //foreach ($delivery_users AS $delivery_user) {?>
<!--                    <option value="--><?php //echo $delivery_user['delivery_user_id']?><!--" --><?php //if($delivery_user['delivery_user_id']==$ddt_info['ddt_qr_created_delivery_user_id']) echo 'selected';?><!--><?php //echo $delivery_user['delivery_user_user_name']?><!--</option>-->
<!--                --><?php //}?>
<!--            </select>-->
<!--            <input type="hidden" value="--><?php //echo $ddt_info['ddt_id']?><!--" name="ddt_id" id="ddt_id">-->
<!--            <input  type="submit" value="Update" class="form-control btn btn-bg btn-success my-3" style="font-size: large;">-->
<!--        </form>-->
        <h2 class="card-title heading"><?php echo $this->lang->line('ddt_loading_unloading_details')?></h2>
        <div class="row">

            <?php if($ddt_info['ref_ddt_id']==''){?>
                <div class="col-12">
                    <label style="color: red"><?php echo $this->lang->line('ddt_not_loaded_yet')?></label>
                </div>

            <?php } else{ ?>
                <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-4">
                    <h4 class="sub-heading"><?php echo $this->lang->line('loaded_details')?></h4>
                    <div class="col-12 py-4">
                        <div class="row">
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_load_user_name')?>:<b><i><?php echo $ddt_info['load_user_name']?></i></b></span>
                            </div>
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_load_date')?>:<b><i><?php echo date_format(new DateTime($ddt_info['ddt_loading_date_time']),'d-F-Y')?></i></b></span>
                            </div>
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_load_time')?>:<b><i><?php echo date_format(new DateTime($ddt_info['ddt_loading_date_time']),'h:ia')?></i></b></span>
                            </div>
                        </div>

                    </div>
                    <h4 class="sub-heading"><?php echo $this->lang->line('transfer_details')?></h4>
                    <div class="col-12 py-4">
                        <div class="row">
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_transfer_user_name')?>:<b><i><?php if($ddt_info['transfer_user_name']=='')echo 'None';else echo $ddt_info['transfer_user_name'];?></i></b></span>
                            </div>
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_transfer_date')?>:<b><i><?php if($ddt_info['transferring_date_time']=='')echo 'None';else echo date_format(new DateTime($ddt_info['transferring_date_time']),'d-F-Y')?></i></b></span>
                            </div>
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_transfer_time')?>:<b><i><?php if($ddt_info['transferring_date_time']=='')echo 'None';else echo date_format(new DateTime($ddt_info['transferring_date_time']),'h:ia')?></i></b></span>
                            </div>
                        </div>

                    </div>

                    <h4 class="sub-heading"><?php echo $this->lang->line('unload_details')?></h4>
                    <div class="col-12 py-4">
                        <div class="row">
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_unload_user_name')?>:<b><i><?php if($ddt_info['delivery_user_name']=='')echo 'None';else echo $ddt_info['delivery_user_name'];?></i></b></span>
                            </div>
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_unload_date')?>:<b><i><?php if($ddt_info['ddt_unloading_date_time']=='')echo 'None';else echo date_format(new DateTime($ddt_info['ddt_unloading_date_time']),'d-F-Y')?></i></b></span>
                            </div>
                            <div class="col-12">
                                <span><?php echo $this->lang->line('ddt_unload_time')?>:<b><i><?php if($ddt_info['ddt_unloading_date_time']=='')echo 'None';else echo date_format(new DateTime($ddt_info['ddt_unloading_date_time']),'h:ia')?></i></b></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-8">
                    <?php if($ddt_info['ddt_loading_from']==1){?>
                        <h4 class="sub-heading"><?php echo $this->lang->line('ddt_received_address')?></h4>
                        <div class="col-12 py-4">
                            <address id="ddt_received_address">

                            </address>
                        </div>

                        <div class="col-12" id="ddt_received_from_map" style="height: 400px">

                        </div>
                        <input type="hidden" id="load_lat" value="<?php echo $ddt_info['ddt_loading_lat']?>">
                        <input type="hidden" id="load_long" value="<?php echo $ddt_info['ddt_loading_lng']?>">
                    <?php } else if($ddt_info['ddt_loading_from']==0){?>
                        <h4 class="sub-heading"><?php echo $this->lang->line('ddt_unload_address')?></h4>
                        <?php if($ddt_info['ddt_unloading_date_time']==''){?>
                            <span style="color: red"><?php echo $this->lang->line('ddt_not_unload_yet')?></span>
                        <?php }?>
                        <?php if($ddt_info['ddt_unloading_lat']=='' || $ddt_info['ddt_unloading_lng']==''){?>
                            <address>
                                <?php echo $ddt_info['ddt_unloading_address_no_lan_lng']?>
                            </address>
                        <?php } else{?>
                            <div class="col-12 py-4">
                                <address id="ddt_unload_address"></address>
                            </div>

                            <div class="col-12" id="ddt_unload_in_map" style="height: 400px">

                            </div>
                            <input type="hidden" id="lat" value="<?php echo $ddt_info['ddt_unloading_lat']?>">
                            <input type="hidden" id="long" value="<?php echo $ddt_info['ddt_unloading_lng']?>">
                        <?php }?>
                    <?php }?>
                </div>
            <?php } ?>
        </div>

        <?php if(($this->session->userdata('user_type_id')==1) || ($this->session->userdata('user_type_id')==0 && $ddt_info['ddt_unloading_date_time']=='')){ ?>
        <div class="row pt-4">
            <div class="col-12" style="text-align: center">
                <a class="btn btn-lg btn-danger text-white" style="display: <?php if($ddt_info['ddt_active']==0) echo 'none';?>" href="<?php echo base_url('lost_delete_ddt/'.$ddt_info['ddt_id'])?>">Lost/Delete</a> <a class="btn btn-lg btn-success text-white" style="display:<?php if($ddt_info['ddt_active']==0) echo 'inline-block'; else echo 'none';?> " href="<?php echo base_url('found_ddt/'.$ddt_info['ddt_id'])?>">Found</a>
            </div>
        </div>
        <?php } ?>

    </div>
</div>
