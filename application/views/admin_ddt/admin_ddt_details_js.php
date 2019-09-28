<script type="text/javascript" rel="script">
    <?php if($ddt_info['ddt_loading_from']==1){?>
    var map;
    var get_lat=parseFloat($('#load_lat').val());
    var get_lang=parseFloat($('#load_long').val());
    var lat_lang={lat: get_lat , lng: get_lang};
    function initMap() {
        map = new google.maps.Map(document.getElementById('ddt_received_from_map'), {
            center: lat_lang,
            zoom: 20
        });

        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        geocodeLatLng(geocoder, map, infowindow);

        function geocodeLatLng(geocoder, map, infowindow) {

            var latlng = {lat: get_lat, lng: get_lang};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setZoom(11);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                        $('#ddt_received_address').html(results[0].formatted_address);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }
    }
    <?php }?>
    <?php if($ddt_info['ddt_loading_from']==0 && $ddt_info['ddt_unloading_lat']!='' || $ddt_info['ddt_unloading_lng']!=''){?>
    var map;
    var get_lat=parseFloat($('#lat').val());
    var get_lang=parseFloat($('#long').val());
    var lat_lang={lat: get_lat , lng: get_lang};
    function initMap() {
        map = new google.maps.Map(document.getElementById('ddt_unload_in_map'), {
            center: lat_lang,
            zoom: 20
        });

        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        geocodeLatLng(geocoder, map, infowindow);

        function geocodeLatLng(geocoder, map, infowindow) {

            var latlng = {lat: get_lat, lng: get_lang};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setZoom(11);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                        $('#ddt_unload_address').html(results[0].formatted_address);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }
    }
    <?php }?>
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQnX6r_vbBWoTX-Cx8OuqIRtjsfR4l26g&callback=initMap"
        async defer></script>