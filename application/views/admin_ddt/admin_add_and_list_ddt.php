<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.css')?>">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">-->
<style type="text/css">
    .table th {
        color: #009646;
    }
    @media print {
        .navbar .navbar-brand-wrapper .navbar-brand img{
            display: none;
            visibility: collapse;
        }
        .navbar .navbar-menu-wrapper .navbar-toggler{
            display: none;
            visibility: collapse;
        }
        .nav-item{
            display: none;
            visibility: collapse;
        }
        .card{
            display: none;
            visibility: collapse;
        }
        .navbar{
            display: none;!important;
            visibility: collapse;
        }
        .sidebar{
            display: none;
            visibility: collapse;
        }
        .footer{
            display: none;
            visibility: collapse;
        }
        .print-div{
            display: block;
            page-break-after: avoid;!important;

        }


        html, body {

            margin: 0 !important;
            padding: 0 !important;
            border: none;!important;
            overflow: hidden;

        }

        @page  {
            size: 2in 16in;
            margin: 0mm;
            page-break-before: auto;
            page-break-inside: avoid;!important;
            page-break-after: avoid;!important;


        }

        div{
            padding: 0%;!important;
            margin: 0%;!important;
        }


    }

</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h1 class="card-title heading">DDT</h1>
            </div>

            <div class="col-12">
                <h5 class="sub-heading">ADD New DDT</h5>
            </div>
            <div class="col-12">
                <form method="post"  class="row" name="add_ddt_form" id="add_ddt_form">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                        <div class="form-group col-12">
                            <label>Select Delivery User Name</label>
                            <select class="form-control" name="delivery_user_name" id="delivery_user_name">
                                <option value="">Select</option>
                                <?php foreach ($delivery_users AS $delivery_user){?>
                                    <option value="<?php echo $delivery_user['delivery_user_id']?>"><?php echo $delivery_user['delivery_user_user_name']?></option>>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-12">
                        <div class="form-group">
                            <label class="col-xs-12">QR code number</label>
                            <input type="number" class="form-control" name="qr_code_number" id="qr_code_number" value="1" min="1">
                            <label style="display: none" id="qr_code_number_label">QR CODE Must Be Greater Than 0</label>
                        </div>
                        </div>

                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <button type="button" class="btn btn-info btn-block mt-5" id="qr_code_generate_btn" style="font-size: 1em">Generate QR Code</button>
                    </div>
                    <div class="col-12 mt-4">
                        <div id="qrcode" style="display: none"></div>
                        <div style="text-align: center" id="qr_code_images"></div>
                        <div style="text-align: center">
                            <label style="display: none" id="qr_code_valid_label">QR CODE IS REQUIRED.Please Generate QR Code First.</label>
                        </div>
                    </div>
                    <input type="hidden" id="new_ddt_id" name="new_ddt_id" value="<?php echo $new_ddt_id;?>">
                    <div class="col-12 mt-4">
                        <button type="submit" id="ddt_add_submit_btn" class="btn btn-success btn-block" style="font-size: medium">ADD</button>
                    </div>
                </form>
            </div>

        </div>
        <br><br>

        <h5 class="sub-heading">DDT List</h5>
        <div id="load_table" class="table-responsive">
            <div style="text-align: center"><input type="button" class="btn btn-primary btn-lg" value="Print ALL Checked" id="print_all_button" disabled></div>
            <table class="table table-striped table-hover" id="load_ddt_table">
                <thead>
                <tr>
                    <th width="15%"><input type="checkbox" id="check_all">Check/Uncheck All</th>
                    <th width="20%">DDT ID</th>
                    <th width="25">QR Code</th>
                    <th width="15%">Created Date</th>
                    <th width="25%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="print-div" class="print-div " style="display: none;">

    <div id="qr-data" class="row" style="display: inline-block;position: relative" >
    </div>

</div>

<script type="text/javascript" src="<?php echo base_url('assets/app_assets/plugins/qrcode.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.js')?>"></script>
<script src="<?php echo base_url('assets/app_assets/plugins/sweetalert.min.js')?>"></script>