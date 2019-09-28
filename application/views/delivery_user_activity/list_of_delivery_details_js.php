
<script type="text/javascript" rel="script">
    var map;
    var get_lat=parseFloat($('#start_lat').html());
    var get_lang=parseFloat($('#start_lng').html());
    var lat_lang={lat: get_lat , lng: get_lang};
//    alert(get_lat);

    var marker;
    var infowindow;
    function initMap() {
        map = new google.maps.Map(document.getElementById('activity_map'), {
            center: lat_lang,
            zoom: 35
        });

        var start_location=$('#start_location').html();
         infowindow = new google.maps.InfoWindow;
         marker = new google.maps.Marker({
            position: lat_lang,
            map: map,
             title: start_location,
        });
//        infowindow.setContent('<b style="color: green">Start Location:</b>'+$('#start_location').html());
        infowindow.setContent('<b style="color: green"><?php echo $this->lang->line("start_location")?></b>');

        infowindow.open(map, marker);

        get_lat=parseFloat($('#end_lat').html());
        get_lang=parseFloat($('#end_lng').html());
        lat_lang={lat: get_lat , lng: get_lang};
        infowindow = new google.maps.InfoWindow;
         marker = new google.maps.Marker({
            position: lat_lang,
            map: map,
             title: $('#end_location').html(),
        });
//        infowindow.setContent('<b style="color: red">End Location:</b>'+$('#end_location').html());
        infowindow.setContent('<b style="color: red"><?php echo $this->lang->line("end_location")?></b>');

        infowindow.open(map, marker);

        var i=1;
        $('.ddt_ptp .lat_lng span .lat').each(function () {
            get_lat=parseFloat($(this).html());
            get_lang=parseFloat($(this).attr('about'));

//            alert(get_lang);
            var geocoder = new google.maps.Geocoder;
            infowindow = new google.maps.InfoWindow;
            geocodeLatLng(geocoder, map, infowindow);

            function geocodeLatLng(geocoder, map, infowindow) {

                var latlng = {lat: get_lat, lng: get_lang};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setZoom(12);
                             marker = new google.maps.Marker({
                                position: latlng,
                                map: map,
                                 title: results[0].formatted_address,
                            });

//                            infowindow.setContent('<span style="color: blueviolet">Location'+i+':</span> '+results[0].formatted_address);
                            infowindow.setContent('<span style="color: blueviolet"><?php echo $this->lang->line("location")?>'+i);
//                            $(this).parent().parent().parent().find($('.address')).find($('.location')).html(results[0].formatted_address);
//                            $(this).parent().parent().parent().append("<div>"+results[0].formatted_address+"</div>");
                            $('#location_'+i).html(results[0].formatted_address);
//                            alert(results[0].formatted_address);
                            i=i+1;
                            infowindow.open(map, marker);
//                            $('#ddt_received_address').html(results[0].formatted_address);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDh3Pcn7WugK7cOObAj1q4SNjyVaOpheaY&callback=initMap"
        async defer></script>