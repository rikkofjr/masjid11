<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">
            Hello Laravel + Tailwind!
        </h1>

        {{-- Slot konten halaman --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Card 1 -->
    <div class="group relative p-6 rounded-2xl bg-white shadow-lg ring-1 ring-gray-300 transition-transform hover:scale-105">
        <div class="absolute top-0 right-0 p-2">
            <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">Aktif</span>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">Card Title</h2>
        <p class="text-gray-600 mb-4">Contoh card dengan efek hover scale, badge, dan ring offset.</p>

        <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
            <div class="bg-green-500 h-3 rounded-full transition-all duration-700 ease-in-out" style="width: 65%;"></div>
        </div>

        <button class="mt-2 inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
            Action
        </button>
    </div>

    <!-- Card 2 -->
    <div class="relative overflow-hidden rounded-2xl shadow-lg backdrop-blur bg-white/70 ring-1 ring-gray-300">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Backdrop Blur Card</h2>
            <p class="text-gray-600 mb-4">Card dengan efek blur background dan animasi pulse.</p>

            <div class="flex items-center space-x-3">
                <span class="w-3 h-3 bg-green-500 rounded-full animate-ping"></span>
                <span class="text-sm text-gray-500">Real-time Status</span>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="p-6 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-lg transition duration-500 hover:rotate-1">
        <h2 class="text-xl font-bold mb-2">Gradient Card</h2>
        <p class="mb-4">Card dengan background gradient dan efek rotasi saat hover.</p>

        <button class="mt-2 inline-flex items-center px-4 py-2 bg-white text-cyan-600 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
            Another Action
        </button>
    </div>

</div>
    </div>

</body>
</html>
