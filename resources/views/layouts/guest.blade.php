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
    <body
        class="relative flex min-h-screen flex-col bg-gray-100 pt-6 font-sans text-gray-800 antialiased sm:justify-center sm:pt-0 dark:bg-zinc-800 dark:text-gray-200"
    >
        {{-- Content --}}
        <main
            {{ $attributes->merge(['class' => 'mx-auto mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:rounded-lg dark:bg-slate-700']) }}
        >
            {{ $slot }}
        </main>

        {{-- Decoration BG --}}
        <x-bg-decoration />
    </body>
</html>
