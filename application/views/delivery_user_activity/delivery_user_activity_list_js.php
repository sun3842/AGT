
<script>


    $('#delivery_user_activity_list').DataTable({
        paging: true,
        scrollY: false,
        scrollX: false,
        pagingType: "first_last_numbers",
        pageLength: 10,
        lengthChange: true,
        responsive: true,

    });

    var dt = $('#delivery_user_activity_list').dataTable().api();
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
                url: '<?php echo base_url("delivery_user_activity_list")?>',
                type: "POST",
                data: { start: start_date, end: end_date},
                success: function (result) {
                    var delivery_users_activity=$.parseJSON(result);
                    var total_number_delivery_user=delivery_users_activity.length;
                    dt.clear().draw();
                    var max_loaded=0;
                    var max_loaded_name='None';
                    var min_loaded=delivery_users_activity[0]['total_loaded'];
                    var min_loaded_name=delivery_users_activity[0]['delivery_user_user_name'];
                    var max_unloaded=0;
                    var max_unloaded_name='None';
                    var min_unloaded=delivery_users_activity[0]['total_delivered'];
                    var min_unloaded_name=delivery_users_activity[0]['delivery_user_user_name'];
                    for(var i=0;i<total_number_delivery_user;i++){

                        if(delivery_users_activity[i]['total_loaded']>max_loaded){
                            max_loaded=delivery_users_activity[i]['total_loaded'];
                            max_loaded_name=delivery_users_activity[i]['delivery_user_user_name'];
                        }
                        else if(delivery_users_activity[i]['total_loaded']<min_loaded){
                            min_loaded=delivery_users_activity[i]['total_loaded'];
                            min_loaded_name=delivery_users_activity[i]['delivery_user_user_name'];
                        }
                        if(delivery_users_activity[i]['total_delivered']>max_unloaded){
                            max_unloaded=delivery_users_activity[i]['total_delivered'];
                            max_unloaded_name=delivery_users_activity[i]['delivery_user_user_name'];
                        }
                        else if(delivery_users_activity[i]['total_delivered']<min_unloaded){
                            min_unloaded=delivery_users_activity[i]['total_delivered'];
                            min_unloaded_name=delivery_users_activity[i]['delivery_user_user_name'];
                        }

                        dt.row.add([i+1,delivery_users_activity[i]["delivery_user_user_name"],delivery_users_activity[i]["delivery_user_email_address"],delivery_users_activity[i]["delivery_user_creating_date_time"],delivery_users_activity[i]["total_loaded"],delivery_users_activity[i]["total_transfered"],delivery_users_activity[i]["total_delivered"]]);
                    }

                    dt.columns.adjust().draw();
                    $('#max_load').html(max_loaded_name);
                    $('#min_load').html(min_loaded_name);
                    $('#max_unload').html(max_unloaded_name);
                    $('#min_unload').html(min_unloaded_name);
                },
                error: function (error) {
                    alert(error);
                }
            });
        }
    });
</script>
