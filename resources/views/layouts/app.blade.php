<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sincinaty') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-[#f6faff] via-[#eaf6fb] to-[#fbeee6]">
    {{-- Sidebar fijo --}}
    @include('components.sidebar')
    @include('navigation-menu')
    <div class="pl-64 min-h-screen">
        <main class="pt-20 py-6 px-4 sm:px-6 lg:px-8 mb-10">
            <div class="max-w-full overflow-x-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
