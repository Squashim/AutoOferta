@props([
    'href',
    'isActive' => false,
])

@php
    $activeStyle = $isActive ? 'bg-slate-800/50 text-white hover:bg-slate-800/80' : '';
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "duration-15 $activeStyle relative inline-flex items-center justify-center rounded-md px-4 py-2 text-center text-xs font-semibold uppercase tracking-widest text-gray-300 transition ease-in-out hover:bg-slate-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"]) }}
>
    {{ $slot }}
</a>
