<script type="text/javascript">

    $('#user_new_password').keyup(function () {
        var val=$(this).val();
        if(val==''){
            $('#user_current_password').attr('required',false);
        }
        else {
            $('#user_current_password').attr('required',true);
        }
    });


    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "Name Is Required And Spaces are not allowed");

    $('#update_admin_info').validate({
        rules: {
            user_email: {
                email: true,
                required: true
            },
            user_name: {
                required: true,
                noSpace: true,
                remote: {

                    url: $("#update_admin_info").attr('action'),

                    type: "post",
                    data:
                        {

                            name: function() {

                                return $( "#user_name" ).val();
                            }
                        }
                }
            },
            user_new_password: {
                required: false,
                minlength: 6
            },
            user_re_type_password: {
                equalTo: '#user_new_password'
            }

        }
    });

</script>