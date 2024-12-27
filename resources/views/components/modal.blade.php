@props([
    'name',
    'maxWidth' => '2xl',
])

@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div
    x-data="{ show: false }"
    x-init="
        $watch('show', (value) => {
            if (value) {
                document.body.classList.add('overflow-y-hidden')
            } else {
                document.body.classList.remove('overflow-y-hidden')
            }
        })
    "
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? (show = true) : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? (show = false) : null"
    x-show="show"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
    style="display: none"
>
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="duration-300 ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="duration-200 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div
        x-show="show"
        class="{{ $maxWidth }} mb-6 transform overflow-hidden rounded-lg bg-slate-700 shadow-xl transition-all sm:mx-auto sm:w-full"
        x-transition:enter="duration-300 ease-out"
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="duration-200 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>
