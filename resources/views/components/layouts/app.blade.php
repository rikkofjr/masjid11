<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>@yield('title')</title>
        
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
        
        @livewireStyles

        <!-- PWA  -->
        <meta name="theme-color" content="#6777ef"/>
        <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">
    </head>
    <body class="bg-white">
        <livewire:partials.navbar/>

        <main class="">
            {{ $slot }}
        </main>
                    
        <livewire:partials.footer/>
        @livewireScripts
        
        @stack('scripts')
        
  
        <x-livewire-alert::scripts />
       
    </body>
</html>