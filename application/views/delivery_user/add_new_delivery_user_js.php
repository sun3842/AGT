<script type="text/javascript">
    is_auto_create_user_checked();
    $('#is_auto_create_user').click(function () {
        if($(this).is(":checked")){
            $('.user_login_info').css('display','none');
        }else {
            $('.user_login_info').css('display','block');
        }

    });

    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "Name Is Required And Spaces are not allowed");

    $('#add_delivery_user_info').validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            user_email: {
                email: true,
                required: true
            },
            user_name: {
                required: true,
                noSpace: true,
                remote: {

                    url: $("#add_delivery_user_info").attr('action'),

                    type: "post",
                    data:
                        {

                            name: function() {

                                return $( "#user_name" ).val();
                            }
                        }
                }
            },
            user_password: {
                required: false,
                minlength: 6
            },
            user_re_type_password: {
                equalTo: '#user_password'
            }

        }
    });
    function is_auto_create_user_checked() {
        if($('#is_auto_create_user').is(":checked")){
            $('.user_login_info').css('display','none');
        }else {
            $('.user_login_info').css('display','block');
        }
    }
</script>