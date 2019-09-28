<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.css')?>">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">-->
<style type="text/css">
    .table th {
        color: #009646;
    }
    .print-div:last-child {
        page-break-after: auto;
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
        .container-scroller{
           display: none;
        }
        .print-div{
            display: block;
            /*margin: 0 0 0 1%;*/
            /*padding: 0;*/
            /*page-break-after: avoid;!important;*/

        }


        html, body {

            margin: 0 !important;
            padding: 0 !important;
            border: none;!important;
            overflow: hidden;
        }

        head{
            display: none;
        }
        footer{
            display: none;
        }

        @page  {
            /********************************************   page Size Will Be Changed Here   **************************************************/
            size: 4.1in 35mm;!important;
            margin: 1em 0 0 0;

        }

        div.page{
            display: block;
            page-break-after: always;
        }

        div{
            padding: 0%;!important;
            margin: 0%;!important;
        }


    }

</style>
<div class="card">
    <div class="card-body">
        <br><br>

        <div class="col-12">
            <h1 class="card-title heading"><?php echo $this->lang->line('ddt')?></h1>
        </div>
        <h5 class="sub-heading"><?php echo $this->lang->line('ddt_list')?></h5>
        <div id="load_table" class="table-responsive">
            <div style="text-align: center"><input type="button" class="btn btn-primary btn-lg" value="<?php echo $this->lang->line('print_all_checked')?>" id="print_all_button" disabled></div>
            <table class="table table-striped table-hover" id="load_ddt_table">
                <thead>
                <tr>
                    <th width="15%"><input type="checkbox" id="check_all"><?php echo $this->lang->line('check_uncheck_all')?></th>
                    <th width="20%"><?php echo $this->lang->line('ddt_id')?></th>
                    <th width="15"><?php echo $this->lang->line('qr_code')?></th>
                    <th width="13%"><?php echo $this->lang->line('created_date')?></th>
                    <th width="12%"><?php echo $this->lang->line('status')?></th>
                    <th width="25%"><?php echo $this->lang->line('action')?></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>



<script type="text/javascript" src="<?php echo base_url('assets/app_assets/plugins/qrcode.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/app_assets/plugins/datatable/datatable.js')?>"></script>
<!--<script src="--><?php //echo base_url('assets/app_assets/plugins/sweetalert.min.js')?><!--"></script>-->