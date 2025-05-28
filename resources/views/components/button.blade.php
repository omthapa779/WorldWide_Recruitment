@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary', // 'primary' or 'secondary'
    'class' => '',
])

@php
    $baseClasses = 'button_link flex justify_c align_c';
    $variantClass = match($variant) {
        'secondary' => 'bg_orange hover:bg_dark',
        default => 'bg_dark hover:bg_blue',
    };
    $finalClass = "$baseClasses $variantClass $class";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $finalClass]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $finalClass]) }}>
        {{ $slot }}
    </button>
@endif
