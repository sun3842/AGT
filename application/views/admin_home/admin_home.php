<style rel="stylesheet" type="text/css">
    .home>div{
        min-height: 200px;
        border: 1px solid #F6ECC0;
       margin: 1%;
        position: relative;

    }
    .home{
        margin-left: 10%;
    }
    @media only screen and (min-width: 320px){
        .home{
            margin-left: 0%;
            margin-right: 2%;
        }
    }
    @media only screen and (min-width: 1024px){
        .home{
            margin-left: 10%;
            margin-right: 0%;
        }
    }
    label{
        color: #393186;
    }
    P{
        color: #009746;
        font-size: medium;
    }

    .home>div:hover{
        transition: font-size 0.5s;
        font-size: 115%;
        /*box-shadow: 0px 0px;*/
        /*background-color: #dddddd;*/
        -webkit-box-shadow: 7px 3px 24px -1px rgba(0,0,0,0.18);
        -moz-box-shadow: 7px 3px 24px -1px rgba(0,0,0,0.18);
        box-shadow: 7px 3px 24px -1px rgba(0,0,0,0.18);
        border-radius: 10px 10px 10px 10px ;
    }
    p:hover{
        font-size: 115%;
    }
</style>


<div class="card">
    <div class="card-body">
        <h3 class="sub-heading card-title"><?php echo $this->lang->line('home')?></h3>
        <div class="row home" style="display: flex">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5" >
                <div class="row">
                    <div class="col-12" style="text-align: center">
                        <p><?php echo date('d-F-Y');?></p>
                    </div>

                    <?php

                    $total_ddt=sizeof($ddt_load_unload);
                    $from_storage=0;
                    $total_unloaded=0;

                    foreach ($ddt_load_unload AS $item){
                        if($item['ddt_loading_from']==0){
                            $from_storage=$from_storage+1;
                        }
                        if($item['ddt_unloading_date_time']!=''){
                            $total_unloaded=$total_unloaded+1;
                        }
                    }
                    ?>
                    <div class="col-12" style="border-bottom: 1px solid #009645;" >
                        <label><strong><?php echo $this->lang->line('loaded_ddt')?>: <span><?php echo $total_ddt;?></span></strong></label>
                    </div>
                    <div class="col-12">
                        <label><?php echo $this->lang->line('from_storage')?>: <span><?php echo $from_storage;?></span></label>
                    </div>
                    <div class="col-12">
                        <label><?php echo $this->lang->line('from_client')?>: <span><?php echo ($total_ddt-$from_storage);?></span></label>
                    </div>
                    <div class="col-12" style="border-bottom: 1px solid #009645;" >
                        <label><strong><?php echo $this->lang->line('unloaded_ddt')?>: <span><?php echo $total_unloaded?></span></strong></label>
                    </div>

                </div>

            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                <?php
                $total_delivery_users=sizeof($ddt_delivery_users);
                $total_active_users=0;
                foreach ($ddt_delivery_users AS $delivery_user){
                   if($delivery_user['delivery_user_login_active']==1){
                       $total_active_users=$total_active_users+1;
                   }
                }
                ?>
                <div class="col-12" style="text-align: center;margin-top: 12.5%">
                    <label><strong><?php echo $this->lang->line('delivery_users')?>: <span><?php echo $total_delivery_users;?></span></strong></label>
                </div>
                <div class="col-12" style="text-align: center">
                    <label><strong><?php echo $this->lang->line('active')?>: <span><?php echo $total_active_users;?></span></strong></label>
                </div>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5" style="margin-left: 25%;text-align: center">
                <div class="col-12" style="text-align: center">
                    <p><?php echo $this->lang->line('month')?>: <?php echo date('F');?></p>
                </div>

                <?php
                $total_created_qr_codes=sizeof($qr_codes);
                $total_used=0;
                foreach ($qr_codes AS $qr_code){
                    if($qr_code['ref_ddt_id']!=''){
                        $total_used=$total_used+1;
                    }
                }
                ?>

                <div class="col-12" >
                    <label><strong><?php echo $this->lang->line('total_generating_qr_code')?>: <span><?php echo $total_created_qr_codes?></span></strong></label>
                </div>
                <div class="col-12">
                    <label><?php echo $this->lang->line('total_used')?>: <span><?php echo $total_used?></span></label>
                </div>
                <div class="col-12">
                    <label><?php echo $this->lang->line('remaining')?>: <span><?php echo ($total_created_qr_codes-$total_used);?></span></label>
                </div>
            </div>
<!--            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">-->
<!---->
<!--            </div>-->
        </div>
    </div>
</div>

