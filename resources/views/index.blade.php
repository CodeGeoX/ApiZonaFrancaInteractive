<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map of Points of Interest</title>
    <script>
        function initMap() {
            var bounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(41.3326, 2.0917), // Suroeste
                new google.maps.LatLng(41.3548, 2.1478)  // Noreste
            );

            var map = new google.maps.Map(document.getElementById('map'), {
                center: bounds.getCenter(),
                zoom: 14 // Ajusta el zoom según sea necesario
            });

            // Verifica si el JSON se genera correctamente
            var pointsOfInterest = @json($pointsOfInterest);
            console.log('Puntos de interés:', pointsOfInterest);
            

            pointsOfInterest.forEach(function(point) {
                var position = new google.maps.LatLng(parseFloat(point.latitude), parseFloat(point.longitude));
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: point.name
                });
                bounds.extend(position);
            });

            map.fitBounds(bounds);
            

            // Agregar evento de clic a los edificios del dashboard
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.building').forEach(function(building) {
                    building.addEventListener('click', function() {
                        var lat = parseFloat(this.getAttribute('data-lat'));
                        var lng = parseFloat(this.getAttribute('data-lng'));
                        var position = new google.maps.LatLng(lat, lng);
                        new google.maps.Marker({
                            position: position,
                            map: map,
                            title: this.querySelector('h3').textContent
                        });
                        map.setCenter(position);
                        map.setZoom(16);
                    });
                });
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2G0516RzxWaUzStSnr92YtbZUDUH_aJw&callback=initMap" async defer></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Map of Points of Interest
            </h2>
        </x-slot>

        <div class="container flex justify-center">
            <div id="map" style="height: 700px; width: 1200px; margin-left: 20%; margin-top: 2%"></div>
        </div>
    </x-app-layout>
</body>
</html>
