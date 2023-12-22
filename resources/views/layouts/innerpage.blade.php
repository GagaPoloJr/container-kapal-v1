<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <!-- CSS files -->

    @vite(['resources/css/tabler.min.css', 'resources/css/tabler-flags.min.css', 'resources/css/tabler-payments.min.css', 'resources/css/tabler-vendors.min.css', 'resources/css/demo.min.css'])
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    @vite(['resources/js/demo-theme.min.js'])
    @vite(['resources/css/custom.css','resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>

    <div class="page">
        <!-- Navbar -->
        <x-navbar />
        <div class="page-wrapper">
            <!-- Page header -->
            @if (isset($header))
                @include('components.header')
            @endif
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    {{-- <div class="row row-cards"> --}}

                    <!-- Page Content -->
                    {{ $slot }}
                    {{-- </div> --}}
                </div>
            </div>
            <x-footer />
        </div>

        <x-notification />
    </div>

    @stack('modals')

    <!-- Libs JS -->
    @vite(['resources/libs/apexcharts/dist/apexcharts.min.js', 'resources/libs/jsvectormap/dist/js/jsvectormap.min.js', 'resources/libs/jsvectormap/dist/maps/world.js', 'resources/libs/jsvectormap/dist/maps/world-merc.js'])


    <!-- Tabler Core -->

    @vite(['resources/js/tabler.min.js', 'resources/js/demo.min.js'])
    @livewireScripts
    @yield('scripts')
    @stack('scripts')
</body>

</html>
