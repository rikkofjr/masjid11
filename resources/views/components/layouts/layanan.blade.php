<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <script src="{{asset('js/vendor/autoNumeric.min.js')}}"></script>
        <script src="{{asset('js/vendor/jquery.min.js')}}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles        
    </head>
    <body class="bg-green-100">
        @include('sweetalert::alert')
        <main class="">
            
            {{ $slot }}
        </main>
                    
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
        <x-livewire-alert::scripts />
        
    </body>
</html>