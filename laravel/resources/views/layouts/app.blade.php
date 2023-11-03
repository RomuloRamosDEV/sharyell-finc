<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="index, follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <base href="{{ url('/') }}">

        <meta name="author" content="Uners Horizon">
        <meta name="copyright" content="{{ date('Y') }} Uners Horizon">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/layout/favicon-16x16.png') }}">

        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/stylus/main.styl'])
    </head>
    <body class="font-sans antialiased">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        @yield('content')

        @livewireScripts
        
        @livewireChartsScripts
    </body>
</html>
