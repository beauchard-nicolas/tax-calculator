<!-- Layout principal de l'application -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Configuration de base -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UK Tax Calculator')</title>
    
    <!-- Styles -->
    @vite('resources/css/app.css')
    
    <!-- Styles pour masquer les flèches des inputs numériques -->
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- En-tête -->
    @include('partials.header')
    
    <!-- Contenu principal -->
    <main class="container mx-auto px-4 flex-grow">
        @yield('content')
    </main>

    <!-- Pied de page -->
    @include('partials.footer')
</body>
</html>