<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map of Points of Interest</title>
    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14, 
                center: {lat: 41.3361, lng: 2.1186} 
            });

            const pointsOfInterest = @json($pointsOfInterest);
            const infoWindow = new google.maps.InfoWindow();

            pointsOfInterest.forEach(function(point) {
                const marker = new google.maps.Marker({
                    position: { lat: parseFloat(point.lat), lng: parseFloat(point.long) },
                    map: map,
                    title: point.title
                });

                const contentString = `
                    <div>
                        <h2>${point.title}</h2>
                        <p>${point.description}</p>
                        <button onclick="editPoint(${point.id})">Editar</button>
                        <button onclick="deletePoint(${point.id}, ${marker.getPosition().lat()}, ${marker.getPosition().lng()})">Eliminar</button>
                    </div>
                `;

                marker.addListener('click', function() {
                    infoWindow.setContent(contentString);
                    infoWindow.open(map, marker);
                });
            });
        }

        function editPoint(id) {
            const newTitle = prompt("Ingrese el nuevo título:");
            const newDescription = prompt("Ingrese la nueva descripción:");
            if (newTitle && newDescription) {
                fetch(`/editPoint/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        title: newTitle,
                        description: newDescription
                    })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        alert("Punto de interés actualizado exitosamente");
                        location.reload();
                    } else {
                        alert("Error al actualizar el punto de interés");
                    }
                });
            }
        }

        function deletePoint(id, lat, lng) {
            if (confirm("¿Está seguro de que desea eliminar este punto de interés?")) {
                fetch(`/deletePoint/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        alert("Punto de interés eliminado exitosamente");
                        location.reload();
                    } else {
                        alert("Error al eliminar el punto de interés");
                    }
                });
            }
        }
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2G0516RzxWaUzStSnr92YtbZUDUH_aJw&callback=initMap"></script>
</head>
<body>
    <h1>Map of Points of Interest</h1>
    <div id="map" style="height: 500px; width: 100%;"></div>
</body>
</html>
