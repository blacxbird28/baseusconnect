<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Baseus Connect</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
        <!-- Scripts -->
        @if (env('APP_ENV')!='prod')
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link href="{{ asset('build/dist/app.css') }}" rel="stylesheet">
        @endif

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-PHGLL0SNWB"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-PHGLL0SNWB');
        </script>

    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
                    <img src="{{ asset('images/logo-baseus-connect.png') }}" alt="" class="w-[300px]">
                </a>
            </div>

            <div class="w-full sm:max-w-xl my-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        @if (env('APP_ENV')=='prod')
        <script src="{{ asset('build/dist/app2.js') }}"></script>
        @endif
    </body>
</html>
