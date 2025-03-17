<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="relative flex flex-col items-center font-sans antialiased dark:bg-zinc-800 dark:text-gray-200">
        <x-bg-decoration />

        <div class="relative z-10 min-h-screen w-full text-gray-800 dark:text-white">
            @include('layouts.navigation', ['unreadMsgs' => $unreadMsgs, 'favoritedOffers' => $favoritedOffers])

            <!-- Page Content -->
            <main class="mt-16">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
