@props([
    'type' => 'button',
    'color' => 'primary',
    'href' => null
])

@php
    $classes = match($color) {
        'primary' => 'btn-primary-custom',
        'secondary' => 'btn-secondary-custom',
        'danger' => 'btn-danger-custom',
        'warning' => 'btn-warning-custom',
        default => 'btn-primary-custom',
    };
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
