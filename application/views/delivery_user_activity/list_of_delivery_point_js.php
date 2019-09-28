

<script type="text/javascript" rel="script">
    $(document).ready(function () {
        $('#activity_date').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            maxDate: 0
        });

        $('#delivery_user_list').dataTable({
            paging: true,
        });
        var dt= $('#delivery_user_list').dataTable().api();

        $('#search_btn').click(function () {
            var date=$('#activity_date').val();
            if(date !=''){
                $.ajax({
                    url : $('#search_form').attr('action'),
                    data :{select_date: date},
                    type : 'POST',
                    success : function (result) {
                        var res=$.parseJSON(result);
                        var size=res.length;
                        console.log(size);
                        total_user_number=size;
                        dt.clear().draw();
                        for (var i=0; i<size; i++){
                            dt.row.add([i+1,res[i]["delivery_user_id"],res[i]["delivery_user_user_name"],res[i]["delivery_user_starting_address"],res[i]["delivery_user_ending_address"],res[i]["view_details"]]);

                        }
                        dt.columns.adjust().draw();
                    },
                    error : function (err) {
                        alert(err);
                    }
                });
            }
        });
    });
</script>