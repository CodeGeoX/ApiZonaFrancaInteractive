<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de la Zona Franca</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
        }
        .card {
            transition: 0.3s;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            background-color: #ffffff;
            border-radius: 0; /* No border radius */
            overflow: hidden;
            width: 100%;
            margin: 0; /* No margin */
        }
        .card:hover {
            box-shadow: 0 12px 24px 0 rgba(0,0,0,0.3);
        }
        .center-card {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 0; /* No padding */
        }
        .header-image {
            width: 100%;
            height: auto;
            margin-bottom: 0;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7fafc;
        }
        .card-content img {
            width: 100%;
            border-bottom: 2px solid #e2e8f0;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Zona Franca') }}
            </h2>
        </x-slot>

        <div class="center-card">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm card">
                <div class="card-content">
                    <img src="images/zonafrancaImportante.jpg" alt="Zona Franca de Barcelona" class="header-image">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-center text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Zona Franca de Barcelona</h2>
                        <p class="text-center text-gray-600 dark:text-gray-400 mb-4">
                        La Zona Franca de Barcelona, también conocida como el Consorci de la Zona Franca (CZFB), es una extensa área industrial y logística ubicada en la ciudad de Barcelona, España. Esta zona es uno de los mayores motores económicos de la región y un punto estratégico para el comercio internacional debido a su proximidad al puerto de Barcelona y al aeropuerto de El Prat.                         </p>
                        <a href="https://www.zonafrancabarcelona.com" target="_blank" class="block text-center text-blue-500 dark:text-blue-400 font-bold">
                            Más información
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

</body>
</html>
