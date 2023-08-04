<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cebaf Graph Database') }}</title>

    <!-- Scripts -->
    @livewireStyles
    @livewireScripts
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('css')
    @stack('js')
</head>
<body class="font-sans antialiased">
<style>
    div.strapline, div.menubar{
    }
</style>
<div class="min-h-screen">
    <div class="container">

        <div class="row strapline">
            @include('includes.strapline')
        </div>
        <div class="row menubar">
            @include('includes.navbar')
        </div>


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>
