@props([
    'label' => '',
])
<div x-data="{ id: $id('accordion'), open: false }" class="cursor-pointer space-y-4">
    <button
        type="button"
        x-on:click="
            setActiveAccordion(id)
            open = ! open
        "
        class="flex w-full select-none items-center justify-between p-4 text-left text-sm"
    >
        <span {{ $attributes->merge(['class']) }}>{{ $label }}</span>

        <div x-show="active!=id" class="duration-200 ease-out">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </div>
        <div x-show="active==id" class="duration-200 ease-out">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
            </svg>
        </div>
    </button>

    <div x-collapse x-show="open" x-transition class="origin-top overflow-hidden" x-collapse.duration.500ms>
        <div class="grid auto-cols-fr items-center gap-4 p-4 pt-0 md:grid-cols-2">
            {{ $slot }}
        </div>
    </div>
</div>
