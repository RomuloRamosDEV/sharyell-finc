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
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/layout/favicon-32x32.png') }}">
        
        <link rel="shortcut icon" href="{{ asset('img/layout/mobile_icon_resized.png') }}" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/layout/mobile_icon_180x180.png') }}">
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        @livewireStyles
        
        <script>
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(() => console.log('Service Worker registered!'))
                    .catch(error => console.log('Service Worker registration failed:', error));
            }
        </script>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/stylus/main.styl'])
    </head>
    <body class="font-sans antialiased">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
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
