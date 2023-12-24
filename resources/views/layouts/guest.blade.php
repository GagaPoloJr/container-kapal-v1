<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
<body class="d-flex flex-column bg-white">

    {{ $slot }}

    @livewireScripts
</body>
</html>
