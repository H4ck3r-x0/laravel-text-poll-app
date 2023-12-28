<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans py-8 bg-white text-gray-800 dark:text-white dark:bg-gray-900 min-h-screen ">
    <div class="mx-auto max-w-7xl px-6">
        @livewire('welcome.navigation')

        <div class="mt-20">
            {{ $slot }}
        </div>
    </div>
    <x-toast />
</body>

</html>
