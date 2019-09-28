

<script type="text/javascript" rel="script">
    $(document).ready(function () {
        $('#activity_date').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
            maxDate:0,
        });

        $('#activity_date').change(function () {
            var val=$(this).val();
//            alert(val);
            var current_date=$('#current_date').val();
            if(val>current_date){
                $(this).val(current_date);
            }
        });
        $('#activity_date').focusout(function () {
           $('#activity_user_name').trigger('change');
        });
        $('#activity_user_name').change(function () {
            var name=$(this).val();
            var date=$('#activity_date').val();

//            alert(val);
            if(name!='' && date!=''){
                $.ajax({
                    url : $('#start_update_user_activity').attr('action'),
                    data :{select_date: date, select_user:name},
                    type : 'POST',
                    success : function (result) {
                        var res=$.parseJSON(result);
                        var size=res.length;
                        total_user_number=size;
                        if(size>0){
//                           alert('Update');
                            $('#add_activity').css('display','none');
                            $('#update_activity').css('display','inline-block');
                            $('#activity_start').val(res[0]['delivery_user_starting_address']);
                            $('#activity_end').val(res[0]['delivery_user_ending_address']);
                            $('#start_activity_lat').val(res[0]['delivery_user_starting_lat']);
                            $('#start_activity_lng').val(res[0]['delivery_user_starting_lng']);
                            $('#end_activity_lat').val(res[0]['delivery_user_ending_lat']);
                            $('#end_activity_lng').val(res[0]['delivery_user_ending_lng']);
                        }else{
                           $('#add_activity').css('display','inline-block');
                            $('#update_activity').css('display','none');
                            $('#activity_start').val('');
                            $('#activity_end').val('');
                            $('#start_activity_lat').val('');
                            $('#start_activity_lng').val('');
                            $('#end_activity_lat').val('');
                            $('#end_activity_lng').val('');
                        }
//                        for(var i=0;i<size;i++){
//                            $("#forgot_username").append('<option value="'+res[i]["admin_user_name"]+'">'+res[i]["admin_user_name"]+'</option>');
//                        }
                    },
                    error : function (err) {
                        alert(err);
                    }
                });
            }
        });
        function initialize_start_activity() {

            var ac = new google.maps.places.Autocomplete(
                (document.getElementById('activity_start')), {
                    types: ['geocode']
                });

            ac.addListener('place_changed', function() {

                var place = ac.getPlace();

                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

//                var html = '<div>Latitude: ' + place.geometry.location.lat() + '</div>';
//                html += '<div>Longitude: ' + place.geometry.location.lng() + '</div>';
//
//                document.getElementById('geometry').innerHTML = html;
                $('#start_activity_lat').val(place.geometry.location.lat());
                $('#start_activity_lng').val(place.geometry.location.lng());

            });
        }

        initialize_start_activity();

        function initialize_end_activity() {

            var ac = new google.maps.places.Autocomplete(
                (document.getElementById('activity_end')), {
                    types: ['geocode']
                });

            ac.addListener('place_changed', function() {

                var place = ac.getPlace();

                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

//                var html = '<div>Latitude: ' + place.geometry.location.lat() + '</div>';
//                html += '<div>Longitude: ' + place.geometry.location.lng() + '</div>';
//
//                document.getElementById('geometry').innerHTML = html;
                $('#end_activity_lat').val(place.geometry.location.lat());
                $('#end_activity_lng').val(place.geometry.location.lng());

            });
        }

        initialize_end_activity();
    });
</script>