@props(['type' => 'submit', 'style' => 'primary', 'disabled' => false, 'onClick' => '', 'href' => null])

@php
    $baseClasses = 'duration-15 relative inline-flex items-center justify-center rounded-md border px-4 py-2 text-center text-xs font-semibold uppercase tracking-widest transition ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:pointer-events-none disabled:cursor-not-allowed disabled:select-none disabled:opacity-25 dark:focus:ring-offset-gray-800';

    $styleType = [
        'primary' => 'border-transparent bg-gray-800 text-white hover:bg-gray-800 focus:bg-gray-700 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:active:bg-gray-300',
        'secondary' => ' border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-300 dark:hover:bg-gray-700 dark:hover:text-gray-200',
        'edit' => 'border-transparent bg-sky-700 text-white hover:bg-sky-600 focus:bg-sky-800 active:bg-sky-900 dark:bg-sky-800 dark:text-gray-100 dark:hover:bg-sky-700 dark:focus:bg-sky-900 dark:active:bg-sky-600',
        'delete' => 'border-transparent bg-red-700 text-white hover:bg-red-600 focus:bg-red-800 active:bg-red-900 dark:bg-red-800 dark:text-gray-100 dark:hover:bg-red-700 dark:focus:bg-red-900 dark:active:bg-red-600',
    ];

    $classes = $baseClasses . ' ' . $styleType[$style] ?? $styleType['primary'];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span class="flex items-center gap-2">{{ $slot }}</span>
    </a>
@else
    <button
        x-data="{ loading: false, disabled: {{ json_encode($disabled) }} }"
        x-on:click="
            if (disabled || loading) return
            loading = true
            disabled = true

            if ('{{ $type }}' === 'submit') {
                $el.closest('form').submit()
                setTimeout(() => {
                    loading = false
                    disabled = false
                }, 1000)
            } else {
                try {
                    {{ $onClick }}
                    setTimeout(() => {
                        loading = false
                        disabled = false
                    }, 1000)
                } catch (e) {
                    console.error('Error in onClick handler:', e)
                    loading = false
                    disabled = false
                }
            }
        "
        :disabled="disabled || loading"
        {{ $attributes->merge(['class' => $classes]) }}
        type="{{ $type }}"
    >
        @if ($type === 'submit')
            <template x-if="loading">
                <svg
                    class="h-4 w-4 animate-spin text-slate-900"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C3.163 0 0 7.163 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 2.644 1.053 5.053 2.929 6.929l1.071-1.638z"
                    ></path>
                </svg>
            </template>
            <template x-if="!loading">
                <span>{{ $slot }}</span>
            </template>
        @else
            <span class="flex items-center gap-2">{{ $slot }}</span>
        @endif
    </button>
@endif
