<script type="text/javascript">




    $('.deletebutton').click(function(e){
        e.preventDefault();

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

    }) ;


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

                                return $( "#user_name" ).val()+'fa2a611ef69d2ba1983c46911e8a86f8'+$('#admin_user_id').val();
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