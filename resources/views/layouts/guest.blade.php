@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CronoFast | {{$title}}</title>

        @vite(['resources/css/auth.css'])
        <script src="https://sdk.mercadopago.com/js/v2"></script>
    </head>
    <body>
        {{ $slot }}
    </body>
    @vite(['resources/js/auth.js'])
</html>
