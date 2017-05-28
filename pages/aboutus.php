<h1>About Us</h1>

<style>
//Changed styles for myaccount section, border to keep design theme.
    #map {
        border: solid 2px #d6d6d6;
        height: 500px;
        width: 60%;
    }

</style>

<p>You can find us here!</p>

<div class="center-block" id="map"></div>

<script>
//Google maps API - Adapted to reflect Benefit Booking headquarters. Found at: https://developers.google.com/maps/documentation/javascript/
    function initMap() {
        var uluru = {
            lat: 52.194841,
            lng: -2.22597
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }

</script>

<!--Call Google maps API-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfyKAZu-tWXLScL6enWsCIxNhQnTgpbAk&callback=initMap">


</script>
