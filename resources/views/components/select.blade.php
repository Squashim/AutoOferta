@props([
    'options' => [],
    'placeholder' => 'Wybierz opcję',
    'validationName' => '',
    'label' => null,
    'initialDisabled' => false,
    'editSelected' => '',
])

<div
    {{ $attributes->merge(['class' => 'relative ']) }}
    x-data="{
        open: false,
        slug: '{{ old($validationName, request()->get($validationName, $options->firstWhere('slug', $editSelected)->slug ?? '')) }}',
        activeIndex: -1,
        selected:
            '{{ old($validationName, request()->get($validationName, $options->firstWhere('slug', $editSelected)->slug ?? '')) ? $options->firstWhere('slug', old($validationName, request()->get($validationName, $options->firstWhere('slug', $editSelected)->slug ?? '')))->name : '' }}',
        options: {{ json_encode($options) }},
        disabled: {{ $initialDisabled ? 'true' : 'false' }},
        placeholder: '{{ $placeholder }}',
        toggle() {
            if (this.disabled) return
            if (this.open) {
                return this.close()
            }
            this.$refs.button.focus()
            this.open = true
        },
        close(focusAfter) {
            if (! this.open) return

            this.open = false
            this.activeIndex = -1
            focusAfter && focusAfter.focus()
        },
        selectOption(index) {
            this.selected = this.options[index].name
            this.slug = this.options[index].slug
            this.close(this.$refs.button)
            this.$dispatch('x-select-change', this.slug)
        },
        handleKeydown(event) {
            if (this.disabled) return
            if (! this.open) {
                if (event.key === 'Enter') {
                    this.toggle()
                }
                return
            }

            if (event.key === 'ArrowDown') {
                this.activeIndex = (this.activeIndex + 1) % this.options.length
            } else if (event.key === 'ArrowUp') {
                this.activeIndex =
                    (this.activeIndex - 1 + this.options.length) %
                    this.options.length
            } else if (event.key === 'Enter' && this.activeIndex !== -1) {
                this.selectOption(this.activeIndex)
            } else if (event.key === 'Escape') {
                this.close(this.$refs.button)
            }
        },
    }"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:keydown.arrow-down.prevent.stop="handleKeydown"
    x-on:keydown.arrow-up.prevent.stop="handleKeydown"
    x-on:keydown.enter.prevent.stop="handleKeydown"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
    x-id="['dropdown-button']"
>
    <label for="{{ $validationName }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }}
    </label>

    <input
        type="text"
        class="hidden appearance-none border-none bg-transparent focus:outline-none"
        name="{{ $validationName }}"
        id="{{ $validationName }}"
        x-bind:value="slug"
    />

    <button
        x-ref="button"
        type="button"
        x-bind:disabled="disabled"
        x-bind:aria-expanded="open"
        x-bind:aria-controls="$id('dropdown-button')"
        x-on:click="toggle()"
        class="mt-1 flex w-full min-w-48 items-center justify-between gap-2 rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-25 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
    >
        <span x-text="selected || placeholder "></span>
        <svg
            x-bind:class="{
                'rotate-180': open,
                'duration-300': true,
                'transition-transform': true,
            }"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-5 dark:text-gray-300"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    <menu
        x-show="open"
        x-ref="panel"
        x-transition.origin.top.left
        x-on:click.outside="close($refs.button)"
        x-bind:id="$id('dropdown-button')"
        style="display: none"
        role="menu"
        class="custom-scroll absolute z-10 mt-2 max-h-56 w-full min-w-48 overflow-y-auto rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
    >
        @if (trim($slot) !== '')
            {{ $slot }}
        @else
            <template x-for="(option, index) in options" x-bind:key="index">
                <li
                    role="menuitem"
                    class="cursor-pointer px-4 py-2 transition duration-150 first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-indigo-600"
                    x-bind:class="{
                        'bg-indigo-600': activeIndex === index || selected === option.name,
                    }"
                    x-on:click="selectOption(index)"
                    x-on:mouseenter="activeIndex = index"
                    x-on:mouseleave="activeIndex = -1"
                    x-text="option.name"
                ></li>
            </template>
        @endif
    </menu>
</div>
