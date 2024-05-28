<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map of Points of Interest</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <button onclick="editPoint(${point.id}, '${point.title}', '${point.description}')">Editar</button>
                        <button onclick="deletePoint(${point.id}, ${marker.getPosition().lat()}, ${marker.getPosition().lng()})">Eliminar</button>
                    </div>
                `;

                marker.addListener('click', function() {
                    infoWindow.setContent(contentString);
                    infoWindow.open(map, marker);
                });
            });

            // Add event listener for clicking on the map to add a new point of interest
            map.addListener('click', function(event) {
    const clickedLocation = event.latLng;
    Swal.fire({
        title: 'Agregar Punto de Interés',
        html: `
            <input type="text" id="newTitle" class="swal2-input" placeholder="Título">
            <input type="text" id="newDescription" class="swal2-input" placeholder="Descripción">
        `,
        focusConfirm: false,
        preConfirm: () => {
            const newTitle = Swal.getPopup().querySelector('#newTitle').value;
            const newDescription = Swal.getPopup().querySelector('#newDescription').value;
            if (!newTitle || !newDescription) {
                Swal.showValidationMessage('Ambos campos son obligatorios');
                return false;
            }
            return { newTitle, newDescription };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/addPoint', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    title: result.value.newTitle,
                    description: result.value.newDescription,
                    lat: clickedLocation.lat(),
                    long: clickedLocation.lng()
                })
            }).then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text) });
                }
                return response.json();
            }).then(data => {
                if (data.success) {
                    Swal.fire('Agregado', 'Punto de interés agregado exitosamente', 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', 'Error al agregar el punto de interés: ' + data.error, 'error');
                }
            }).catch(error => {
                console.error("Error en la solicitud:", error);
                Swal.fire('Error', 'Error en la solicitud: ' + error.message, 'error');
            });
        }
    });
});

        }

        function editPoint(id, currentTitle, currentDescription) {
            Swal.fire({
                title: 'Editar Punto de Interés',
                html: `
                    <input type="text" id="newTitle" class="swal2-input" value="${currentTitle}" placeholder="Título">
                    <input type="text" id="newDescription" class="swal2-input" value="${currentDescription}" placeholder="Descripción">
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const newTitle = Swal.getPopup().querySelector('#newTitle').value;
                    const newDescription = Swal.getPopup().querySelector('#newDescription').value;
                    if (!newTitle || !newDescription) {
                        Swal.showValidationMessage('Ambos campos son obligatorios');
                        return false;
                    }
                    return { newTitle, newDescription };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/editPoint/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            title: result.value.newTitle,
                            description: result.value.newDescription
                        })
                    }).then(response => response.json()).then(data => {
                        if (data.success) {
                            Swal.fire('Actualizado', 'Punto de interés actualizado exitosamente', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'Error al actualizar el punto de interés', 'error');
                        }
                    }).catch(error => {
                        console.error("Error en la solicitud:", error);
                        Swal.fire('Error', 'Error en la solicitud: ' + error, 'error');
                    });
                }
            });
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
<body class="bg-gray-100 dark:bg-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Panel de Administración
            </h2>
        </x-slot>

        <div class="container flex justify-center">
            <div id="map" style="height: 700px; width: 1200px; margin-top: 2%"></div>
        </div>
    </x-app-layout>
</body>
</html>
