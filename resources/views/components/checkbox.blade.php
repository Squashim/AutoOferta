@props([
    'id',
    'name',
    'label',
    'required' => false,
    'value' => '',
    'checked' => false,
])
<label for="{{ $id }}" class="inline-flex cursor-pointer items-center">
    <input
        id="{{ $id }}"
        type="checkbox"
        @if ($required) required @endif
        @if ($checked) checked @endif
        @if ($value) value="{{ $value }}" @endif
        class="dark:bg-ray-300 cursor-pointer rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
        name="{{ $name }}"
    />
    <span class="ms-2 select-none text-sm">{{ $label }}</span>
</label>
