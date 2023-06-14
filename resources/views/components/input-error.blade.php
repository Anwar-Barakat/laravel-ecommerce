@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 list-none']) }}>
        @foreach ((array) $messages as $message)
            <li class="text-danger list-none text-xs">{{ $message }}</li>
        @endforeach
    </ul>
@endif
