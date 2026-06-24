<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Diogo da Silva Oliveira">
        <title>CronoFast</title>
        @vite(['resources/css/app.css', 'resources/css/grid.css'])
        <link rel="icon" type="image/x-icon" href="favicon.ico">
    </head>
    <body>
        @include('layouts.navigation')
        <main class="container">
            {{ $slot }}
        </main>
        @vite(['resources/js/app.js', 'resources/js/bootstrap.js'])
    </body>
</html>
