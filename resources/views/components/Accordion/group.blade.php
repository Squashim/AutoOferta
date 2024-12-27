<div
    class="relative w-full overflow-hidden rounded-md border bg-gray-900 text-base font-medium dark:border-gray-700"
    x-data="{
        active: '',
        setActiveAccordion(id) {
            this.active = this.active == id ? '' : id
        },
    }"
>
    {{ $slot }}
</div>
