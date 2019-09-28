<script type="text/javascript">

    $('#load_ddt_table').DataTable({
        "processing": true,
        'serverSide': true,
        "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
        "language":{
            "searchPlaceholder": "DDT ID or YYYY-MM-DD",
        },
        "order":[],
        "ajax": {

            url: "<?php echo base_url('get_ddt_list')?>",
            type: "POST",

        },
        "columnDefs": [{
            'targets' :[0,1,2,3,4],
            'orderable': false
        }]
    });


    $(document).ready(function () {

        $(document).on('click','.qr-print',function () {
            var val=$(this).attr('id');
            //alert(val);
            $('#print-div').empty();
            $('#print-div').append('<div class="col-12 m-1 page">' +
                '<div class="col-12 ">' +
                '<img src="'+$("#ddt_img_"+val).attr('src')+'" height="80px" width="80px" style="display: block">' +
                '</div>' +
                '<div class="col-12">' +
                '<span style="font-size:small;">'+val+'</span> : <span style="font-size: small">'+$("#ddt_date_"+val).html()+'</span>' +
                '</div>' +
                '</div>');
            $('#print-div').css('display','block');
            print();
            $('#print-div').css('display','none');
            $('#print-div').empty();
        });
    });


    $(document).on('click','.is_print',function () {
        var temp=0;
        if($(this).is(':checked')){
            $(this).prop('checked',true);
        }else {
            $(this).prop('checked',false);
        }
        $('table tbody tr td .is_print').each(function () {

            if($(this).is(':checked')){
               temp=temp+1;
            }
        });
        if(temp>0){
            $('#print_all_button').attr('disabled',false);
        }else {
            $('#print_all_button').attr('disabled',true);
        }
    });



    $('#print_all_button').click(function () {
        $('#print-div').empty();
        $('table tbody tr td .is_print').each(function () {

            var val=$(this).attr('datasrc');

            if($(this).is(':checked')){
                $('#print-div').append('<div class="col-12 m-1 page">' +
                    '<div class="col-12 ">' +
                    '<span><img src="'+$("#ddt_img_"+val).attr('src')+'" height="80px" width="80px" style="display: inline-block"><span>' +
                    '</div>' +
                    '<div class="col-12">' +
                    '<span style="font-size:small;">'+val+'</span> : <span style="font-size: small">'+$("#ddt_date_"+val).html()+'</span>' +
                    '</div>' +
                    '</div>');
            }
        });

        if($('#print-div').contents().length==0){
            alert('No DDT Selected');
        }else {
            $('#print-div').css('display','block');
            print();
            $('#print-div').css('display','none');
            $('#print-div').empty();
        }
    });


$(document).on('click','#check_all',function () {
            if($(this).is(':checked')) {
                $('table tbody tr td .is_print').each(function () {
                    var id=$(this).attr('id');
                    //$('#'+id).removeAttribute('checked');
                    $('#'+id).prop('checked',true);
                });
                $('#print_all_button').attr('disabled',false);
            }else {
                $('table tbody tr td .is_print').each(function () {
                    var id=$(this).attr('id');
                    $("#"+id).prop('checked',false);
                });
                $('#print_all_button').attr('disabled',true);
            }
});

    $('.dataTables_filter input').change(function () {
        //alert('changed');
        $('#check_all').prop('checked',false);
        $('#print_all_button').attr('disabled',true);
    });

 $(document).on('click','.paginate_button',function () {
     $('#check_all').prop('checked',false);
     $('#print_all_button').attr('disabled',true);
 });
    $('select[name=load_ddt_table_length]').change(function () {
        $('#check_all').prop('checked',false);
        $('#print_all_button').attr('disabled',true);
    });
</script>