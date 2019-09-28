<script type="text/javascript">

    var new_ddt_id=$('#new_ddt_id').val();

    $('#qr_code_generate_btn').click(function(){

        //alert(new_ddt_id);
        var number_of_qr_code=$('#qr_code_number').val();



        if(parseInt(number_of_qr_code)<=0){
            $('#qr_code_number_label').css('display','block');
        }else{
            $('#qr_code_number_label').css('display','none');
            $('#qr_code_images').empty();
            var temp_new_ddt_id=new_ddt_id;
            for(var i=0;i<number_of_qr_code;i++){
                $('#qrcode').empty();
                $('#qrcode').qrcode({width: 128,height: 128,text: temp_new_ddt_id.toString()});
                var img=document.getElementById('qr_code').toDataURL();
                $('#qr_code_images').append('<img src="'+img+'" height="128px" width="128px" class="mx-3 my-3">');
                $('#qr_code_images').append('<input type="hidden" name="qr_code_image[]" value="'+img+'">');
                img='';
                temp_new_ddt_id=parseInt(temp_new_ddt_id,10)+1;
                //alert(temp_new_ddt_id);
            }


            $('#qr_code_valid_label').css('display','none');
        }


    });

    $('#ddt_add_submit_btn').click(function (e) {
        e.preventDefault();
        if($('#qr_code_images').contents().length==0){
            $('#qr_code_valid_label').css('display','block');
        }
        else {
            $('#add_ddt_form').submit();
        }
    });

    $('#search_box').keyup(function () {
        var val=$(this).val();
        if(val==''){
            $('#load_table').css('display','block');
            $('#search_table').css('display','none');
        }else {
            $('#load_table').css('display','none');
            $('#search_table').css('display','block');
        }
    });

    $('#load_ddt_table').DataTable({
        "processing": true,
        'serverSide': true,
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
        $(document).on('click','.deletebutton',function (e) {
            e.preventDefault();
//            alert('HI');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href=$(this).attr('href');

                } else {
//                        swal("Your imaginary file Not Deleted!");
                }
            });
        });

        $(document).on('click','.qr-print',function () {
            var val=$(this).attr('id');
            //alert(val);
            $('#qr-data').empty();
            $('#qr-data').append('<div class="col-12 pb-2" style="display: block">' +
                '<div class="col-12 ">' +
                '<img src="'+$("#ddt_img_"+val).attr('src')+'" height="128px" width="128px" style="display: block">' +
                '</div>' +
                '<div class="col-12">' +
                '<span style="font-size:small;">'+val+'</span> : <span style="font-size: small">'+$("#ddt_date_"+val).html()+'</span>' +
                '</div>' +
                '</div>');
            $('#print-div').css('display','block');
            window.print();
            $('#print-div').css('display','none');
            $('#qr-data').empty();
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
        $('#qr-data').empty();
        $('table tbody tr td .is_print').each(function () {

            var val=$(this).attr('datasrc');

            if($(this).is(':checked')){
                $('#qr-data').append('<div class="col-12 pb-2">' +
                    '<div class="col-12 ">' +
                    '<span><img src="'+$("#ddt_img_"+val).attr('src')+'" height="128px" width="128px" style="display: inline-block"><span>' +
                    '</div>' +
                    '<div class="col-12">' +
                    '<span style="font-size:small;">'+val+'</span> : <span style="font-size: small">'+$("#ddt_date_"+val).html()+'</span>' +
                    '</div>' +
                    '</div><br><br>');
            }
        });

        if($('#qr-data').contents().length==0){
            alert('No DDT Selected');
        }else {
            $('#print-div').css('display','block');
            window.print();
            $('#print-div').css('display','none');
            $('#qr-data').empty();
        }
    });

//    $('#check_all').click(function () {
    //        if($(this).is(':checked')) {
    //            $('table tbody tr td .is_print').each(function () {
    //                $(this).attr('checked',true);
    //            });
    //            $('#print_all_button').attr('disabled',false);
    //        }else {
    //            $('table tbody tr td .is_print').each(function () {
    //                $(this).attr('checked',false);
    //            });
    //            $('#print_all_button').attr('disabled',true);
    //        }
    //    });

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