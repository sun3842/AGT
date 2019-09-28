<script>


$('#loaded_ddt_list').DataTable({
    paging: true,
    scrollY: false,
    scrollX: false,
    pagingType: "first_last_numbers",
    pageLength: 10,
    lengthChange: true,
    responsive: true,

});

     var dt = $('#loaded_ddt_list').dataTable().api();
    $('#start_date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });
    $('#end_date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });

    $('#end_date').change(function () {
        var start_date=$('#start_date').val();
        var end_date=$(this).val();

        if(start_date=='' || start_date>end_date){
            $(this).val('');
        }
        else{
        }
    });
    $('#report_btn').click(function () {
        var start_date=$('#start_date').val();
        var end_date=$("#end_date").val();
        if(start_date==''){
            $('#start_date_validation').css('display','block');
        }
        else if(end_date==''){
            $('#end_date_validation').css('display','block');
        }
        else {
            $('#start_date_validation').css('display','none');
            $('#end_date_validation').css('display','none');

            $.ajax({
                url: '<?php echo base_url("ddt_load_unload_report")?>',
                type: "POST",
                data: { start: start_date, end: end_date},
                success: function (result) {
                    var load_ddts=$.parseJSON(result);
                    var total_number_ddt=load_ddts.length;
                    var load_from_inventory=0;
                    var load_from_customer=0;
                    var pending=0;
                    $('#total_ddt').html(total_number_ddt);
                    dt.clear().draw();
                    for(var i=0;i<total_number_ddt;i++){
                        if(load_ddts[i]['ddt_unloading_date_time']==null){
                            pending=pending+1;
                        }
                        if(load_ddts[i]['ddt_loading_from']==0){
                            load_from_inventory=load_from_inventory+1;
                        }
                        else if(load_ddts[i]['ddt_loading_from']==1){
                            load_from_customer=load_from_customer+1;
                        }

                        dt.row.add([load_ddts[i]["ref_ddt_id"],load_ddts[i]["date"],load_ddts[i]["time"],load_ddts[i]["loading_user_name"],load_ddts[i]["delivery_user_name"],load_ddts[i]["ddt_from"],load_ddts[i]["ddt_is_delivered"],'<a href="<?php echo base_url('single_ddt_loading_unloading_details/')?>'+load_ddts[i]['ref_ddt_id']+'" class="btn btn-info"><?php echo $this->lang->line('view_details')?></a>']);
                    }
                    $('#load_from_inventory_ddt').html(load_from_inventory);
                    $('#load_from_customer_ddt').html(load_from_customer);
                    $('#pending_ddt').html(pending);
                    dt.columns.adjust().draw();
                },
                error: function (error) {
                    alert(error);
                }
            });
        }
    });

    $('#date_selector').validate({
        rules: {
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            }
        }
    });
</script>