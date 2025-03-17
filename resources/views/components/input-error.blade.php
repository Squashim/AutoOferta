@props([
    'messages',
])

@if ($messages)
    <ul
        {{ $attributes->merge(['class' => 'text-sm py-1 px-3 text-white space-y-1 rounded-md bg-red-800 opacity-90']) }}
    >
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
