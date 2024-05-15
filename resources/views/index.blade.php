<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map of Points of Interest</title>
    <script>
 function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: -34.397, lng: 150.644}
    });

    var pointsOfInterest = @json($pointsOfInterest);
    pointsOfInterest.forEach(function(point) {
        new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(point.latitude), parseFloat(point.longitude)),
            map: map,
            title: point.name
        });
    });
}



</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2G0516RzxWaUzStSnr92YtbZUDUH_aJw&callback=initMap" async defer></script>

</head>
<body>
    <h1>Map of Points of Interest</h1>
    <div id="map" style="height: 500px;"></div>
</body>
</html>
