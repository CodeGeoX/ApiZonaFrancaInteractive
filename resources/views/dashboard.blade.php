<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .custom-card {
            margin-bottom: 20px;
        }
        .large-photo-card {
            display: flex;
            height: 500px; 
            width: 100%; 
        }
        .large-photo-card .text-content {
            flex: 2;
            padding: 20px;
            color: white;
        }
        .large-photo-card .photo-content {
            flex: 3;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .large-photo-card .photo-content img {
            width: 150%;
            height: 250%; 
            object-fit: contain; 
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between">
                <div class="w-full lg:w-[48%] lg:mr-4">
                    <div class="custom-card bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 h-72">
                        <div class="p-6 flex h-full">
                            <div class="w-1/2">
                                <img src="{{ asset('images/dfactory.jpg') }}" alt="DFactory" class="w-full h-full object-cover">
                            </div>
                            <div class="w-1/2 pl-6 text-gray-800 dark:text-gray-200 flex flex-col justify-center">
                                <h3 class="text-lg font-semibold">DFactory</h3>
                                <p>DFactory es una entidad innovadora dedicada a fomentar la digitalización y la transformación industrial mediante la integración de tecnologías avanzadas.</p>
                            </div>
                        </div>
                    </div>

                    <div class="custom-card bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 h-72">
                        <div class="p-6 flex h-full">
                            <div class="w-1/2">
                                <img src="{{ asset('images/3dfactory.jpg') }}" alt="3DFactory" class="w-full h-full object-cover">
                            </div>
                            <div class="w-1/2 pl-6 text-gray-800 dark:text-gray-200 flex flex-col justify-center">
                                <h3 class="text-lg font-semibold">3DFactory</h3>
                                <p>3DFactory es un centro de excelencia que se especializa en la fabricación aditiva, proporcionando soluciones de impresión 3D a diversas industrias.</p>
                            </div>
                        </div>
                    </div>                    
                    <div class="custom-card bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 h-72">
                        <div class="p-6 flex h-full">
                            <div class="w-1/2">
                                <img src="{{ asset('images/incubadora.jpeg') }}" alt="Incubadora logística 4.0" class="w-full h-full object-cover">
                            </div>
                            <div class="w-1/2 pl-6 text-gray-800 dark:text-gray-200 flex flex-col justify-center">
                                <h3 class="text-lg font-semibold">Incubadora logística 4.0</h3>
                                <p>La Incubadora logística 4.0 apoya a startups y empresas emergentes en la creación de soluciones logísticas innovadoras utilizando tecnologías de la Industria 4.0.</p>
                            </div>
                        </div>
                    </div>

                    <div class="custom-card bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 h-72">
                        <div class="p-6 flex h-full">
                            <div class="w-1/2">
                                <img src="{{ asset('images/newpostbarcelona.png') }}" alt="New Post Barcelona" class="w-full h-full object-cover">
                            </div>
                            <div class="w-1/2 pl-6 text-gray-800 dark:text-gray-200 flex flex-col justify-center">
                                <h3 class="text-lg font-semibold">New Post Barcelona</h3>
                                <p>New Post Barcelona es una iniciativa que promueve el desarrollo de nuevas tecnologías y servicios en el ámbito postal y logístico en la ciudad de Barcelona.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-[45%]">
                    <div class="custom-card bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 large-photo-card">
                        <div class="photo-content">
                            <img src="{{ asset('images/zonafrancaLogin.png') }}" alt="Vertical Photo 2" class="object-contain"> <!-- Cambiado a object-contain -->
                        </div>
                        <div class="text-content flex flex-col justify-center">
                            <p>Registrate ya, o si ya tienes una cuenta Inicia sessión para descubrir lso sitios más peculiares de la zona franca!!</p>
                        </div>
                    </div>

                    <div class="custom-card bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 large-photo-card">
                        <div class="photo-content">
                            <img src="{{ asset('images/zonafranca.png') }}" alt="Vertical Photo 2" class="object-contain"> <!-- Cambiado a object-contain -->
                        </div>
                        <div class="text-content flex flex-col justify-center">
                            <p>¡Descubre la nueva forma de explorar la Zona Franca con nuestra aplicación de mapa interactivo!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Exención de impuestos', 'Beneficios tributarios', 'Regulación diferente'],
                    datasets: [{
                        data: [40, 30, 30],
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                        hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                    }]
                },

                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    }
                }
            });
        });
    </script>
</body>
</html>