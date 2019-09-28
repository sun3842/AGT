

<div class="card">
    <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h1 class="card-title heading"><?php echo $this->lang->line('ddt')?></h1>
                    </div>

                    <div class="col-12">
                        <h5 class="sub-heading"><?php echo $this->lang->line('add_new_ddt')?></h5>
                    </div>
                    <div class="col-12">
                        <form method="post"  class="row" name="add_ddt_form" id="add_ddt_form">
                            <div class="col-12">

<!--                                <div class="form-group col-12">-->
<!--                                    <label>Select Delivery User Name</label>-->
<!--                                    <select class="form-control" name="delivery_user_name" id="delivery_user_name">-->
<!--                                        <option value="">Select</option>-->
<!--                                        --><?php //foreach ($delivery_users AS $delivery_user){?>
<!--                                            <option value="--><?php //echo $delivery_user['delivery_user_id']?><!--">--><?php //echo $delivery_user['delivery_user_user_name']?><!--</option>>-->
<!--                                        --><?php //} ?>
<!--                                    </select>-->
<!--                                </div>-->
                                <div class="form-group col-12">
                                <div class="form-group">
                                    <label class="col-12"><?php echo $this->lang->line('qr_code_number')?></label>
                                    <input type="number" class="form-control" name="qr_code_number" id="qr_code_number" value="1" min="1">
                                    <label style="display: none" id="qr_code_number_label"><?php echo $this->lang->line('qr_code_must_be_greater_than_0')?></label>
                                </div>
                                </div>

                            </div>
                            <div class="col-12" style="text-align: center">
                                <button type="button" class="btn btn-info btn-lg" id="qr_code_generate_btn" style="font-size: 2em"><?php echo $this->lang->line('generate_qr_code')?></button>
                            </div>
                            <div class="col-12 mt-4">
                                <div id="qrcode" style="display: none"></div>
                                <div style="text-align: center" id="qr_code_images"></div>
                                <div style="text-align: center;">
                                    <label style="display: none" id="qr_code_valid_label"><?php echo $this->lang->line('qr_code_is_required_please_generate_qr_code_first')?></label>
                                </div>
                            </div>
                            <input type="hidden" id="new_ddt_id" name="new_ddt_id" value="<?php echo $new_ddt_id;?>">
                            <div class="col-12" style="text-align: center;">
                                <button type="submit" id="ddt_add_submit_btn" class="btn btn-success btn-lg" style="font-size: xx-large"><?php echo $this->lang->line('add')?></button>
                            </div>
                        </form>
                    </div>

                </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/app_assets/plugins/qrcode.js') ?>"></script>