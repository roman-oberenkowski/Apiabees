<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Apiabees') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        @livewireScripts
        <script src="{{asset('js/app.js')}}" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-wrap overflow-hidden">

            <div class="w-full md:w-1/3 lg:w-3/10 xl:w-1/6 shadow md:h-full">
                <x-sidebar-nav></x-sidebar-nav>
            </div>

            <div class="w-full h-screen overflow-hidden md:w-2/3 lg:w-7/10 xl:w-5/6 order-first md:order-none md:h-screen">
                <x-header>
                    {{ $header }}
                </x-header>
                <main class="px-2 max-h-full overflow-y-auto">
                <x-flash />
                    <!-- Page Content -->
                    <section class="px-2 w-full overflow-hidden pb-16">
                        {{ $slot }}
                    </section>
                </main>
            </div>
        </div>

        @stack('modals')

    </body>
</html>
