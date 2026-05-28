@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CronoFast | {{$title}}</title>

        @vite(['resources/css/auth.css'])
    </head>
    <body>
        {{ $slot }}
        @vite(['resources/js/auth.js'])
    </body>
</html>
