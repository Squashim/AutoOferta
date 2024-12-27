@props([
    "nameGroup" => "",
    "label" => "",
    "checked" => "",
    "value" => "",
])
<div class="me-4 flex items-center gap-2">
    <input
        type="radio"
        @if ($checked)
            checked
        @endif
        class="h-4 w-4 border-gray-300 bg-gray-100 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:ring-offset-gray-800 dark:focus:ring-indigo-600 dark:focus:ring-offset-slate-700"
        name="{{ $nameGroup }}"
        id="{{ $value }}"
        value="{{ $value }}"
    />
    <label
        for="{{ $value }}"
        class="ms-2 block cursor-pointer select-none font-medium text-gray-700 dark:text-gray-300"
    >
        {{ $label }}
    </label>
</div>
