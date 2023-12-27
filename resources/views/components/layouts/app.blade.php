<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans py-8 bg-gray-50 text-gray-800 dark:text-white dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-6">
        @livewire('welcome.navigation')

        <div class="mt-20">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
