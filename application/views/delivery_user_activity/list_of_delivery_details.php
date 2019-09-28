<div class="card">
    <div class="card-body">
        <h1 class="card-title heading"><?php echo $this->lang->line('user_activity_details')?></h1>
        <div class="row">



            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4 pb-4">
                <div class="col-12">
                    <label style="color: green"><?php echo $this->lang->line('start_location')?></label>
                </div>
                <div class="col-12">
                    <span id="start_location"><?php echo $delivery_user['delivery_user_starting_address'];?></span>
                </div>
                <div class="col-12">
                    <span>lat:<span id="start_lat"><?php echo $delivery_user['delivery_user_starting_lat']?></span></span>,<span>lng:<span id="start_lng"><?php echo $delivery_user['delivery_user_starting_lng']?></span></span>
                </div>
            </div>


                <?php $i=1; foreach ($ddt_ptp AS $item){ ?>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4 pb-4 ddt_ptp">
                        <div class="col-12">
                            <label style="color: blueviolet"><?php echo $this->lang->line('location')?> <?php echo $i;?></label>
                        </div>
                        <div class="col-12 address">
                            <span class="location" id="location_<?php echo $i;?>"></span>
                        </div>
                        <div class="col-12 lat_lng">
                            <span>lat:<span class="lat" about="<?php echo $item['lng']?>"><?php echo $item['lat']?></span></span>,<span>lng:<span class="lng"><?php echo $item['lng']?></span></span>
                        </div>
                    </div>
                    <?php $i++; } ?>




            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4 pb-4">
                <div class="col-12">
                    <label style="color: red"><?php echo $this->lang->line('end_location')?></label>
                </div>
                <div class="col-12">
                    <span id="end_location"><?php echo $delivery_user['delivery_user_ending_address'];?></span>
                </div>
                <div class="col-12">
                    <span>lat:<span id="end_lat"><?php echo $delivery_user['delivery_user_ending_lat']?></span></span>,<span>lng:<span id="end_lng"><?php echo $delivery_user['delivery_user_ending_lng']?></span></span>
                </div>
            </div>


            <div class="col-12" id="activity_map" style="height: 700px">

            </div>
        </div>
    </div>
</div>
