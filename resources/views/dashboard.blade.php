<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
                <!-- Divs with Company Information -->
                <div class="w-2/3">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 flex">
                            <div class="w-1/3">
                                <img src="{{ asset('images/dfactory.jpg') }}" alt="DFactory" class="w-full h-auto">
                            </div>
                            <div class="w-2/3 pl-6 text-white">
                                <h3 class="text-lg font-semibold">DFactory</h3>
                                <p>DFactory es una entidad innovadora dedicada a fomentar la digitalización y la transformación industrial mediante la integración de tecnologías avanzadas.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 flex">
                            <div class="w-1/3">
                                <img src="{{ asset('images/3dfactory.jpg') }}" alt="3DFactory" class="w-full h-auto">
                            </div>
                            <div class="w-2/3 pl-6 text-white">
                                <h3 class="text-lg font-semibold">3DFactory</h3>
                                <p>3DFactory es un centro de excelencia que se especializa en la fabricación aditiva, proporcionando soluciones de impresión 3D a diversas industrias.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 flex">
                            <div class="w-1/3">
                                <img src="{{ asset('images/incubadora.jpeg') }}" alt="Incubadora logística 4.0" class="w-full h-auto">
                            </div>
                            <div class="w-2/3 pl-6 text-white">
                                <h3 class="text-lg font-semibold">Incubadora logística 4.0</h3>
                                <p>La Incubadora logística 4.0 apoya a startups y empresas emergentes en la creación de soluciones logísticas innovadoras utilizando tecnologías de la Industria 4.0.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 flex">
                            <div class="w-1/3">
                                <img src="{{ asset('images/newpostbarcelona.png') }}" alt="New Post Barcelona" class="w-full h-auto">
                            </div>
                            <div class="w-2/3 pl-6 text-white">
                                <h3 class="text-lg font-semibold">New Post Barcelona</h3>
                                <p>New Post Barcelona es una iniciativa que promueve el desarrollo de nuevas tecnologías y servicios en el ámbito postal y logístico en la ciudad de Barcelona.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart Section -->
                <div class="w-1/3 pl-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6 text-white">
                        <canvas id="myPieChart"></canvas>
                        <h3 class="text-lg font-semibold mt-4">La zona franca</h3>
                        <p>Es un territorio delimitado de un país donde se goza de algunos beneficios tributarios, como la exención del pago de derechos de importación de mercancías, así como exoneraciones de algunos impuestos o una regulación diferente de estos.</p>
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
