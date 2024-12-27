@props([
    'status',
])

@if ($status)
    <div
        x-data="{ open: true }"
        x-show="open"
        x-transition:leave="opacity-0 transition duration-300 ease-out"
        {{ $attributes->merge(['class' => ' px-6 py-4 text-lg font-medium text-white dark:bg-green-600/90 flex items-center justify-between']) }}
    >
        {{ $status }}
        <button type="button" x-on:click=" open = false">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                class="size-6 stroke-white"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
