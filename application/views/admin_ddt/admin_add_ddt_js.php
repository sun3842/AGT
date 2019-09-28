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

</script>